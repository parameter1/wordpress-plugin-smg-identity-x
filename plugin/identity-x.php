<?php
/**
 * Plugin Name: IdentityX
 * Plugin URI: https://github.com/parameter1/smg-idx-wordpress/tree/master
 * Description: A plugin providing authentication support via the IdentityX platform
 * Version: 0.1.1
 * Author: Parameter1 LLC
 * Author URI: https://parameter1.com
 */

require_once(__DIR__.'/identity-x/admin.php');
require_once(__DIR__.'/identity-x/hook-handler.php');

$apiKey = get_option('identityx_apiKey');
$apiHost = get_option('identityx_apiHost');
$idxApiKey = get_option('identityx_idx_api_key');
$idxAppId = get_option('identityx_idx_app_id');
$queueUrl = get_option('identityx_aws_sqs_queue_url');
$awsAccessKeyId = get_option('identityx_aws_access_key_id');
$awsSecretAccessKey = get_option('identityx_aws_secret_access_key');
$awsRegion = get_option('identityx_aws_region', 'us-east-2');

// Do nothing if no keys are present!
if (!$apiKey || !$idxApiKey) return;

$handler = new IdentityXHooks(
  $apiKey,
  $apiHost,
  $queueUrl,
  $idxApiKey,
  $idxAppId,
  $awsAccessKeyId,
  $awsSecretAccessKey,
  $awsRegion,
);

add_action('profile_update', [$handler, 'dispatch'], 10, 3);
add_action('xprofile_updated_profile', [$handler, 'dispatch'], 10, 3);

// Create IdentityX hook target
$pattern = '^api/identity-x/user$';

add_action('init', function() use ($pattern) {
  add_rewrite_tag('%idxHook%', '([^&]+)');
  add_rewrite_rule($pattern, 'index.php?idxHook=$matches[1]', 'top');
});

// Flush rewrite rules if the route doesn't exist yet.
add_action('wp_loaded', function () use ($pattern) {
  $rules = get_option('rewrite_rules');
  if (!isset($rules[$pattern])) flush_rewrite_rules();
});

// The hook handler
add_action('template_redirect', function () use ($handler) {
  global $wp_query;
  if (!isset($wp_query->query_vars['idxHook'])) return;
  // include the hook handler

  header('content-type: application/json; charset=utf8');
  try {
    $payload = json_decode(file_get_contents('php://input'), true);
    if (!is_array($payload['emails']) || !count($payload['emails'])) {
      throw new \InvalidArgumentException('Emails property must be specified as an array!');
    }
    $handler->userApi($payload['emails']);
  } catch (\InvalidArgumentException $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
  } catch (\Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
  }
  exit;
});

// Create cron interval
add_filter('cron_schedules', function ($arr) {
  $arr['every_second'] = ['interval' => 1, 'display' => 'Every One Second'];
  return $arr;
});

// schedule event processing
add_action('identityx_cron_hook', [$handler, 'process'], 1);

if (!wp_next_scheduled('identityx_cron_hook')) {
  wp_schedule_event(time(), 'every_second', 'identityx_cron_hook', [] , true);
}
