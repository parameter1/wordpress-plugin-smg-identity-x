<?php

// require_once(__DIR__.'/aws/CloudWatch/CloudWatchClient.php'); // @todo
require_once(__DIR__.'/aws/aws-autoloader.php');

use Aws\CloudWatch\CloudWatchClient;

class IdentityXCloudWatch {
  private $client;
  public function __construct($key = null, $secret = null, $region = 'us-east-2') {
    if ($key && $secret) {
      $this->client = CloudWatchClient::factory([
        'key'     => $key,
        'secret'  => $secret,
        'region'  => $region,
      ]);
    } else {
      trigger_error('IdentityX: AWS credentials are not present, metric logging is disabled.');
    }
  }

  public function success($method) {
    // do the thing
    if ($this->client) {
      $this->client->putMetricData([
        // ...
      ]);
    }
  }

  public function failure($method, $message) {
    // do the other thing
    if ($this->client) {
      $this->client->putMetricData([
        // ...
      ]);
    } else {
      trigger_error(sprintf('IdentityX: error in %s: %s', $method, $message), E_USER_WARNING);
    }
  }
}
