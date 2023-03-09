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
   * Processes available entries in the configured SQS queue
   */
  public function process() {
    $result = $this->sqs->retrieve();
    $messages = is_array($result->get('Messages')) ? $result->get('Messages') : [];
    foreach ($messages as $message) {
      try {
        $this->handle($message);
        $this->sqs->delete($message);
      } catch (\Exception $e) {
        error_log(sprintf('Unable to process message: %s', $e->getMessage()), E_USER_WARNING);
      }
    }
  }

  /**
   * Handles incoming requests to update user data from IdentityX
   */
  public function handle($message) {
    $payload = json_decode($message['Body'], true);

    // @todo look up by external id for changed emails
    if (!array_key_exists('email', $payload) || !$payload['email']) throw new InvalidArgumentException('Email must be specified!');

    $found = get_user_by('email', $payload['email']);
    $user = $this->retrieveUser($payload['id']);

    if ($found) return $this->updateUser($user, $found);
    return $this->createUser($payload);
  }

  /**
   * Ensures the request has the proper API key, and returns a 401 JSON response if not.
   */
  public function validateAuth() {
    if ($_SERVER['HTTP_AUTHORIZATION'] !== sprintf('Bearer %s', $this->apiKey)) {
      if (!headers_sent()) header('content-type: application/json; charset=utf8');
      http_response_code(401);
      echo json_encode(['error' => 'API key missing or invalid.']);
      exit;
    }
  }

  /**
   * Registers the user API
   */
  public function registerUserApi() {
    $pattern = '^api/identity-x/user$';
    $arg = 'idxUserApi';

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
    add_action('template_redirect', function () use ($arg) {
      global $wp_query;
      if (!isset($wp_query->query_vars[$arg])) return;
      header('content-type: application/json; charset=utf8');
      try {
        $payload = json_decode(file_get_contents('php://input'), true);
        if (!is_array($payload['emails']) || !count($payload['emails'])) {
          throw new \InvalidArgumentException('Emails property must be specified as an array!');
        }
        $this->userApi($payload['emails']);
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
   * Handles incoming requests to retrieve user data
   */
  public function userApi($emails) {
    $this->validateAuth();
    $payload = array_map(function($email) {
      $user = get_user_by('email', $email);
      $data = BP_XProfile_ProfileData::get_all_for_user($user->ID);
      return array_reduce(array_keys($data), function ($obj, $key) use ($data) {
        $field = $data[$key];
        switch (gettype($field)) {
          case 'array':
            if ($field['field_type'] === 'multiselectbox') {
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
    echo json_encode($payload);
  }

  /**
   *
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
   *
   */
  private function updateUser($payload, $user) {
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
      } elseif ($fieldName === 'regionCode') {
        if ($payload['countryCode'] === 'US') {
          $updates['xp']['Region'] = $value;
        } else {
          $updates['xp']['Region Non-U.S'] = $value;
        }
      } else {
        throw new InvalidArgumentException(sprintf('Unknown field "%s"!', $fieldName));
      }
    }

    // @todo how to bypass hooks to prevent recursion?

    // Update core fields
    if (count($updates['wp']) >= 1) wp_update_user(array_merge(['ID' => $user->ID], $updates['wp']));

    // Set custom fields to user
    foreach ($updates['xp'] as $key => $value) {
      $saved = xprofile_set_field_data($key, $user->ID, $value);
      if (!$saved) throw new InvalidArgumentException(sprintf('The field "%s" could not be saved with value "%s"!', $key, $value));
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
    return updateUser($payload, $user);
  }
}
