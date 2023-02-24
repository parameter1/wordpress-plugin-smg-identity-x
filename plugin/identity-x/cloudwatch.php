<?php

// require_once(__DIR__.'/aws/CloudWatch/CloudWatchClient.php'); // @todo
require_once(__DIR__.'/aws/aws-autoloader.php');

use Aws\CloudWatch\CloudWatchClient;

class IdentityXCloudWatch {
  private $client;
  public function __construct($key = null, $secret = null, $region = 'us-east-2') {
    if ($key && $secret) {
      $this->client = new CloudWatchClient([
        'credentials' => ['key' => $key, 'secret'  => $secret],
        'region'  => $region,
        'version' => 'latest',
      ]);
    } else {
      trigger_error('IdentityX: AWS credentials are not present, metric logging is disabled.');
    }
  }

  public function success($method) {
    // do the thing
    if ($this->client) {
      $this->client->putMetricData([
        'Namespace' => 'IdentityXWordpressPlugin',
        'MetricData' => [[
          'MetricName'      => sprintf('%sSuccess', ucfirst($method)),
          'Timestamp'       => time(),
          'Value'           => 1,
          'Unit'            => 'Count',
        ]]
      ]);
    }
  }

  public function failure($method, $message) {
    // do the other thing
    trigger_error(sprintf('IdentityX: error in %s: %s', $method, $message), E_USER_WARNING);
    if ($this->client) {
      $this->client->putMetricData([
        'Namespace' => 'IdentityXWordpressPlugin',
        'MetricData' => [[
          'MetricName'      => sprintf('%sError', ucfirst($method)),
          'Timestamp'       => time(),
          'Value'           => 1,
          'Unit'            => 'Count',
        ]]
      ]);
    }
  }
}
