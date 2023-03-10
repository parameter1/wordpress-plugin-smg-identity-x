<?php

require_once(__DIR__.'/client-cloudwatch.php');
require_once(__DIR__.'/client-sqs.php');
include_once(__DIR__.'/graphql/queries/user-by-id.php');

class IdentityXHooks {
  private $apiKey;
  private $apiHost;
  private $idxApiKey;
  private $cloudwatch;
  private $sqs;
  private $appId;

  public function __construct(
    $apiKey,
    $apiHost,
    $queueUrl,
    $idxApiKey,
    $appId,
    $awsAccessKeyId,
    $awsSecretAccessKey,
    $awsRegion,
  ) {
    $this->apiHost = $apiHost;
    $this->apiKey = $apiKey;
    $this->appId = $appId;
    $this->idxApiKey = $idxApiKey;
    $this->cloudwatch = new IdentityXCloudWatchClient($awsAccessKeyId, $awsSecretAccessKey, $awsRegion);
    $this->sqs = new IdentityXSqsClient($awsAccessKeyId, $awsSecretAccessKey, $queueUrl, $awsRegion);
  }

  /**
   * Sends outgoing webhook to IdentityX when user details change
   * @todo push directly to cloudwatch, no apigateway
   * @todo use guzzle
   */
  public function dispatch($user_id) {
    try {
      // @todo set role for full profile when everything is updated ** if not already set **
      $user = get_user_by('ID', $user_id);
      $ch = curl_init(sprintf('%s/prod/enqueue-idx', $this->apiHost));
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'id' => $user_id,
        'email' => $user->user_email,
      ]));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "content-type: application/json",
        sprintf("x-api-key: %s", $this->apiKey),
      ]);
      curl_exec($ch);
      curl_close($ch);
      $this->cloudwatch->success('dispatch');
    } catch (\Exception $e) {
      $this->cloudwatch->failure('dispatch', $e);
    }
  }

  /**
   * Ensures the request has the proper API key, and returns a 401 JSON response if not.
   */
  protected function validateAuth() {
    if ($_SERVER['HTTP_AUTHORIZATION'] !== sprintf('Bearer %s', $this->apiKey)) {
      if (!headers_sent()) header('content-type: application/json; charset=utf8');
      http_response_code(401);
      echo json_encode(['error' => 'API key missing or invalid.']);
      exit;
    }
  }

  /**
   * Registers an API route
   * @param {string}   $pattern   The regexp pattern to register
   * @param {string}   $arg       The internal WP var to use
   * @param {callable} $handler   The function to call with the request payload.
   */
  protected function registerApi($pattern, $arg, callable $handler) {
    add_action('init', function() use ($pattern, $arg) {
      add_rewrite_tag(sprintf('%%%s%%', $arg), '([^&]+)');
      add_rewrite_rule($pattern, sprintf('index.php?%s=$matches[1]', $arg), 'top');
    });

    // Flush rewrite rules if the route doesn't exist yet.
    add_action('wp_loaded', function () use ($pattern) {
      $rules = get_option('rewrite_rules');
      if (!isset($rules[$pattern])) flush_rewrite_rules();
    });

    // The hook handler
    add_action('template_redirect', function () use ($arg, $handler) {
      global $wp_query;
      if (!isset($wp_query->query_vars[$arg])) return;
      $this->validateAuth();
      header('content-type: application/json; charset=utf8');
      try {
        $payload = json_decode(file_get_contents('php://input'), true);
        $response = call_user_func($handler, $payload);
        if ($response) echo $response;
      } catch (\InvalidArgumentException $e) {
        http_response_code(400);
        echo json_encode(['error' => $e->getMessage()]);
      } catch (\Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
      }
      exit;
    });
  }

  /**
   * Registers the ingest API
   */
  public function registerIngestApi() {
    return $this->registerApi('^api/identity-x/ingest$', 'idxIngestApi', function($payload) {
      if (!is_array($payload) || !count($payload)) {
        throw new \InvalidArgumentException('Records must be sent as an array!');
      }
      return $this->ingestApi($payload);
    });
  }

  /**
   * Registers the user API
   */
  public function registerUserApi() {
    return $this->registerApi('^api/identity-x/user$', 'idxUserApi', function($payload) {
      if (!is_array($payload['emails']) || !count($payload['emails'])) {
        throw new \InvalidArgumentException('Emails property must be specified as an array!');
      }
      return $this->userApi($payload['emails']);
    });
  }

  /**
   * Handles incoming requests from Amazon SQS/Lambda function to update Wordpress user data.
   */
  protected function ingestApi(array $records = []) {
    $batchItemFailures = [];
    $errors = [];
    foreach ($records as $record) {
      try {
        $messageId = $record['messageId'];
        $body = json_decode($record['body'], true);
        $id = $body['id'];
        $email = $body['email'];
        // @todo handle ids/externalId for changed emails?
        if (!$id) throw new InvalidArgumentException('IdentityX id must be specified!');
        if (!$email) throw new InvalidArgumentException('Email must be specified!');
        $this->upsertUser($id, $email);
      } catch (\Exception $e) {
        error_log(sprintf('Unable to process message: %s', $e->getMessage()), E_USER_WARNING);
        $batchItemFailures[] = $messageId;
        $errors[] = $e->getMessage();
      }
    }
    return json_encode([
      'name' => 'user-update',
      'batchItemFailures' => $batchItemFailures,
      'errors' => $errors,
    ]);
  }

  /**
   * Handles incoming requests to retrieve user data
   */
  protected function userApi($emails) {
    $this->validateAuth();
    $payload = array_map(function($email) {
      $user = get_user_by('email', $email);
      $data = BP_XProfile_ProfileData::get_all_for_user($user->ID);
      return array_reduce(array_keys($data), function ($obj, $key) use ($data) {
        $field = $data[$key];
        switch (gettype($field)) {
          case 'array':
            if (is_serialized($field['field_data'])) {
              $val = unserialize($field['field_data']);
              if (is_array($val)) {
                $val = array_map(function ($v) {
                  // Decode values (ampersands/etc)
                  return html_entity_decode($v);
                }, $val);
              }
              $obj[$key] = $val;
            } else {
              $obj[$key] = $field['field_data'];
            }
            break;
          default:
            $obj[$key] = $field;
            break;
        }
        return $obj;
      }, []);
    }, $emails);
    return json_encode($payload);
  }

  /**
   * Retrieves a user by id from the IdentityX API
   */
  private function retrieveUser($id) {
    global $idxQueryUserById; // @import GQL query
    $client = new GuzzleHttp\Client();
    $response = $client->request('POST', 'https://identity-x.parameter1.com/graphql', [
      'headers' => [
        'content-type'  => 'application/json',
        'authorization' => sprintf('OrgUserApiToken %s', $this->idxApiKey),
        'x-app-id'      => $this->appId,
      ],
      'body' => json_encode([
        'query'     => $idxQueryUserById,
        'variables' => ['id' => $id],
      ]),
    ]);
    $json = json_decode($response->getBody(), true);
    if (array_key_exists('data', $json) && array_key_exists('appUserById', $json['data'])) {
      return $json['data']['appUserById'];
    }
    return [];
  }

  /**
   * Updates the user, creating first if not present.
   */
  private function upsertUser($id, $email) {
    $payload = $this->retrieveUser($id);
    $user = get_user_by('email', $email);
    if (!$user) $user = $this->createUser($payload);
    $updates = [
      'wp' => [],
      'xp' => [],
    ];
    $builtInFields = [
      'givenName'   => 'first_name',
      'familyName'  => 'last_name',
      // 'role'        => 'role', // @TBD
    ];
    $mappedFields = [
      // Free-form
      'city'              => 'City',
      'countryCode'       => 'Country', // @todo review translation, bad values?
      'organization'      => 'Organization',
      'organizationTitle' => 'OrganizationTitle',
      'phoneNumber'       => 'Mobile Phone',
      'postalCode'        => 'Postal Code',

      // Select fields
      'Org Types'         => 'Organization Type',
      'Profession'        => 'Profession',
      'Technology'        => 'Technologies',
      'Subspecialty'      => 'Specialties',
    ];
    foreach ($payload as $fieldName => $value) {
      if ($fieldName === 'id') continue;
      if ($fieldName === 'email') continue;
      if ($fieldName === 'customSelectFieldAnswers') {
        foreach ($payload['customSelectFieldAnswers'] as $answer) {
          $name = $answer['field']['name'];
          $multiple = (boolean) $answer['field']['multiple'];
          if (array_key_exists($name, $mappedFields) && count($answer['answers'])) {
            $values = array_map(function($a) { return $a['option']['label']; }, $answer['answers']);
            $updates['xp'][$mappedFields[$name]] = $multiple ? $values : array_shift($values);
          }
        }
      } elseif (array_key_exists($fieldName, $builtInFields)) {
        $updates['wp'][$builtInFields[$fieldName]] = $value;
      } elseif (array_key_exists($fieldName, $mappedFields)) {
        $updates['xp'][$mappedFields[$fieldName]] = $value;
      } elseif ($fieldName === 'region') {
        if ($payload['countryCode'] === 'US') {
          $updates['xp']['Region'] = $value['name'];
        } else {
          $updates['xp']['Region Non-U.S'] = $value['name'];
        }
      } else {
        throw new InvalidArgumentException(sprintf('Unknown field "%s"!', $fieldName));
      }
    }

    // Update core fields
    if (count($updates['wp']) >= 1) wp_update_user(array_merge(['ID' => $user->ID], $updates['wp']));

    // Set custom fields to user
    foreach ($updates['xp'] as $key => $value) {
      $saved = xprofile_set_field_data($key, $user->ID, $value);
      if (!$saved) throw new InvalidArgumentException(sprintf('The field "%s" could not be saved with value "%s"!', $key, var_export($value, true)));
    }

    return $user;
  }

  /**
   *
   */
  private function createUser($payload) {
    $fn = $payload['givenName'];
    $ln = $payload['familyName'];
    $userId = wp_insert_user([
      'user_email'      => $payload['email'],
      'user_login'      => $payload['email'],
      'nickname'        => sprintf('%s-%s', strtolower($fn), strtolower($ln)),
      'user_registered' => (new \DateTime())->format('Y-m-d H:i:s'),
    ]);
    $user = get_user_by('ID', $userId);
    return $user;
  }
}
