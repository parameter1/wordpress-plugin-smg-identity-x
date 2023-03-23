<?php

// require_once(__DIR__.'/aws/Sqs/SqsClient.php'); // @todo
require_once(__DIR__.'/aws/aws-autoloader.php');

class IdentityXSqsClient {
  private $client;
  private $queue;
  public function __construct($key, $secret, $queueUrl, $region = 'us-east-2') {
    if (!$queueUrl) error_log('IdentityX SQS Queue URL is not configured!', E_USER_ERROR);
    $this->client = new \Aws\Sqs\SqsClient([
      'credentials' => ['key' => $key, 'secret'  => $secret],
      'region'  => $region,
      'version' => 'latest',
    ]);
    $this->queue = $queueUrl;
  }

  /**
   * Retrieves messages from the configured SQS Queue
   */
  public function retrieve() {
    return $this->client->receiveMessage([
      'QueueUrl'            => $this->queue,
      'MaxNumberOfMessages' => 10,
      'WaitTimeSeconds'     => 10,
    ]);
  }

  /**
   *
   */
  public function send($id, $email) {
    return $this->client->sendMessage([
      'QueueUrl'    => $this->queue,
      'MessageBody' => json_encode(['id' => $id, 'email' => $email]),
    ]);
  }

  /**
   *
   */
  public function delete($message) {
    return $this->client->deleteMessage([
      'QueueUrl'      => $this->queue,
      'ReceiptHandle' => $message['ReceiptHandle'],
    ]);
  }
}
