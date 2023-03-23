<?php
/**
 * Plugin Name: IdentityX
 * Plugin URI: https://github.com/parameter1/smg-idx-wordpress/tree/master
 * Description: A plugin providing authentication support via the IdentityX platform
 * Version: 1.2.0
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

add_action('user_register', [$handler, 'dispatch'], 10, 1);
add_action('profile_update', [$handler, 'dispatch'], 10, 3);
add_action('xprofile_updated_profile', [$handler, 'dispatch'], 10, 3);

// Disable email change notification
add_filter( 'send_email_change_email', '__return_false' );

/**
 * Register the API routes.
 * You *must* edit/save permalink settings in WP admin for routes to take effect!
 * @see /wp-admin/options-permalink.php
 */
$handler->registerUserApi();
$handler->registerIngestApi();
