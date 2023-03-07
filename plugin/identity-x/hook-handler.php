<?php

require_once(__DIR__.'/client-cloudwatch.php');

class IdentityXHooks {
  private $apiKey;
  private $apiHost;
  private $idxApiKey;
  private $cloudwatch;
  private $sqs;

  public function __construct($apiKey, $apiHost, $queueUrl, $idxApiKey, array $awsConfig = []) {
    $this->apiHost = $apiHost;
    $this->apiKey = $apiKey;
    $this->idxApiKey = $idxApiKey;
    list($awsKey, $awsSecret, $awsRegion) = $awsConfig;
    $this->cloudwatch = new IdentityXCloudWatchClient($awsKey, $awsSecret, $awsRegion);
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
   * Handles incoming requests to update user data from IdentityX
   */
  public function handle($wp_query) {
    $type = $wp_query->query_vars['idxHook'];
    header('content-type: application/json; charset=utf8');

    function updateUser($payload, $user) {
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
        'Organization Type' => 'Organization Type',
        'Profession' => 'Profession',
        'Technology' => 'Technologies',
        'Subspecialty' => 'Specialties',
      ];
      foreach ($payload as $fieldName => $value) {
        if ($fieldName === 'email') continue;
        if (array_key_exists($fieldName, $builtInFields)) {
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

      // Update core fields
      if (count($updates['wp']) >= 1) wp_update_user(array_merge(['ID' => $user->ID], $updates['wp']));

      // Set custom fields to user
      foreach ($updates['xp'] as $key => $value) {
        $saved = xprofile_set_field_data($key, $user->ID, $value);
        if (!$saved) throw new InvalidArgumentException(sprintf('The field "%s" could not be saved with value "%s"!', $key, $value));
      }

      return $user;
    }

    function createUser($payload) {
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

    try {
      // @todo verify api key
      $payload = json_decode(file_get_contents('php://input'), true);
      if (!array_key_exists('email', $payload) || !$payload['email']) throw new InvalidArgumentException('Email must be specified.');
      $found = get_user_by('email', $payload['email']);
      $user = $found ? updateUser($payload, $found) : createUser($payload);

      echo json_encode([
        'name'    => $type,
        'payload' => $payload,
        'user'    => $user->ID,
      ]);
      $this->cloudwatch->success('handle');
    } catch (\InvalidArgumentException $e) {
      http_response_code(400);
      echo json_encode([
        'name' => $type,
        'error' => $e->getMessage(),
      ]);
      $this->cloudwatch->failure('handle', $e->getMessage());
    } catch (\Exception $e) {
      http_response_code(500);
      echo json_encode([
        'name' => $type,
        'error' => $e->getMessage(),
      ]);
      $this->cloudwatch->failure('handle', $e->getMessage());
    }
    // End the response
    exit;
  }

  /**
   * Processes available entries in the configured SQS queue
   */
  public function process() {
    error_log(sprintf('Handler processing from %s.', $this->queueUrl), E_USER_NOTICE);
  }
}
