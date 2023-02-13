<?php
/**
 * Plugin Name: IdentityX
 * Plugin URI: https://github.com/parameter1/smg-idx-wordpress/tree/master
 * Description: A plugin providing authentication support via the IdentityX platform
 * Version: 0.0.2
 * Author: Parameter1 LLC
 * Author URI: https://parameter1.com
 */

require_once(__DIR__.'/identity-x/admin.php');

$apiKey = get_option('identityx_apiKey');
$apiHost = get_option('identityx_apiHost', 'https://www.labpulse.com');

add_action('xprofile_updated_profile', function ($user_id) use ($apiKey, $apiHost) {
  if (!$apiKey) return;
  $userdata = BP_XProfile_ProfileData::get_all_for_user($user_id);
  $ch = curl_init(sprintf('%s/api/update-identityx-user', $apiHost));
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['user' => $userdata]));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "content-type: application/json",
    "authorization: Bearer " . base64_encode($apiKey),
  ]);
  curl_exec($ch);
  curl_close($ch);
}, 10, 3);

// Create IdentityX hook target
$pattern = '^hook/identity-x/([a-z0-9-]+)';

add_action('init', function() use ($pattern) {
  add_rewrite_tag('%idxHook%', '([^&]+)');
  add_rewrite_rule($pattern, 'index.php?idxHook=$matches[1]', 'top');
});

// Flush rewrite rules if the route doesn't exist yet.
add_action('wp_loaded', function () use ($pattern) {
  $rules = get_option('rewrite_rules');
  if (!isset($rules[$pattern])) {
    flush_rewrite_rules();
  }
});

// The hook handler
add_action('template_redirect', function () {
  global $wp_query;
  if (!isset($wp_query->query_vars['idxHook'])) return;
  // include the hook handler
  require_once(__DIR__.'/identity-x/hook-handler.php');
  exit;
});
