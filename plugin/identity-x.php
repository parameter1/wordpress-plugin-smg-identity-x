<?php
/**
 * Plugin Name: IdentityX
 * Plugin URI: https://github.com/parameter1/smg-idx-wordpress/tree/master
 * Description: A plugin providing authentication support via the IdentityX platform
 * Version: 0.0.5
 * Author: Parameter1 LLC
 * Author URI: https://parameter1.com
 */

require_once(__DIR__.'/identity-x/admin.php');
require_once(__DIR__.'/identity-x/hook-handler.php');

$apiKey = get_option('identityx_apiKey');
$apiHost = get_option('identityx_apiHost');
$idxApiKey = get_option('identityx_idx_api_key');
$queueUrl = get_option('identityx_aws_sqs_queue_url');
$awsConfig = [
  get_option('identityx_aws_access_key_id'),
  get_option('identityx_aws_secret_access_key'),
  get_option('identityx_aws_region', 'us-east-2')
];

// Do nothing if no keys are present!
if (!$apiKey || !$idxApiKey) return;

$handler = new IdentityXHooks($apiKey, $apiHost, $queueUrl, $idxApiKey, $awsConfig);

add_action('xprofile_updated_profile', [$handler, 'dispatch'], 10, 3);

// Create IdentityX hook target
$pattern = '^hook/identity-x/([a-z0-9-]+)';

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
  $handler->handle($wp_query);
});

// Create cron interval
add_filter('cron_schedules', function ($arr) {
  $arr['every_minute'] = ['interval' => 60, 'display' => 'Every One Minute'];
  return $arr;
});

// schedule event processing
add_action('identityx_cron_hook', [$handler, 'process'], 1);

if (!wp_next_scheduled('identityx_cron_hook')) {
  wp_schedule_event(time(), 'every_minute', 'identityx_cron_hook', [] , true);
}
