<?php

add_action('admin_menu', 'identityx_menu');
add_filter('plugin_action_links_identityx/identityx.php', 'identityx_admin_plugin_settings_link');

function identityx_admin_plugin_settings_link($links) {
  $settings_link = sprintf('<a href="%s">%s</a>', admin_url('options-general.php?page=identityx'), __('Settings', 'identityx'));
  array_unshift($links, $settings_link);
  return $links;
}

function identityx_menu() {
  add_options_page('IdentityX Options', 'IdentityX', 'manage_options', 'identityx', 'identityx_options');
}

function identityx_options() {
  if (!current_user_can('manage_options')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
  }

  // Ensure rewrite rules are flushed!
  flush_rewrite_rules();

  echo "<style type=\"text/css\">.idx_form .row {padding-bottom: 1rem;} .idx_form .row label > input {display: block; margin-top: .25rem; min-width: 300px;}</style>";

  foreach ([
    'identityx_apiHost',
    'identityx_apiKey',
    'identityx_idx_api_key',
    'identityx_idx_app_id',
    'identityx_aws_sqs_queue_url',
    'identityx_aws_access_key_id',
    'identityx_aws_secret_access_key',
    'identityx_aws_region'
    ] as $key) {
    if (isset($_POST[$key])) update_option($key, $_POST[$key]);
  }
  if (!empty($_POST)) {
    echo "<div class=\"updated\"><p><strong>" . __('settings saved.', 'menu-test' ) . "</strong></p></div>";
  }

  $apiHost = get_option('identityx_apiHost');
  $apiKey = get_option('identityx_apiKey');
  $idx_api_key = get_option('identityx_idx_api_key');
  $idx_app_id = get_option('identityx_idx_app_id');
  $aws_sqs_queue_url = get_option('identityx_aws_sqs_queue_url');
  $aws_access_key_id = get_option('identityx_aws_access_key_id');
  $aws_secret_access_key = get_option('identityx_aws_secret_access_key');
  $aws_region = get_option('identityx_aws_region', 'us-east-2');

  echo <<<EOT

  <div class="wrap">
    <h2>IdentityX</h2>

    <div class="idx idx_hero">
      <p>Configure the IdentityX API key and hostname below.</p>
    </div>

    <div class="idx idx_form">
      <form name="identityx_settings" method="post" action="">
        <div class="row">
          <label>
            <strong>API Gateway URL</strong>
            <input type="text" value="{$apiHost}" name="identityx_apiHost" placeholder="https://..." />
          </label>
        </div>
        <div class="row">
          <label>
            <strong>API Gateway Key</strong>
            <input type="password" value="{$apiKey}" name="identityx_apiKey" placeholder="f000fd-fd0dff0d-ffd0d0df" />
          </label>
        </div>
        <div class="row">
          <label>
            <strong>IdentityX API Key</strong>
            <input type="password" value="{$idx_api_key}" name="identityx_idx_api_key" placeholder="eyJhbGci..." />
          </label>
        </div>
        <div class="row">
          <label>
            <strong>IdentityX Application ID</strong>
            <input type="text" value="{$idx_app_id}" name="identityx_idx_app_id" placeholder="62a20ab439..." />
          </label>
        </div>
        <div class="row">
          <label>
            <strong>SQS Queue URL</strong>
            <input type="text" value="{$aws_sqs_queue_url}" name="identityx_aws_sqs_queue_url" placeholder="https://..." />
          </label>
        </div>
        <div class="row">
          <label>
            <strong>AWS Access Key</strong>
            <input type="text" value="{$aws_access_key_id}" name="identityx_aws_access_key_id" placeholder="AKIA..." />
          </label>
        </div>
        <div class="row">
          <label>
            <strong>AWS Secret Access Key</strong>
            <input type="password" value="{$aws_secret_access_key}" name="identityx_aws_secret_access_key" />
          </label>
        </div>
        <div class="row">
          <label>
            <strong>AWS Region</strong>
            <input type="text" value="{$aws_region}" name="identityx_aws_region" placeholder="us-east-2" />
          </label>
        </div>
        <div class="row">
          <button type="submit" class="btn btn-submit button-primary">Save options</button>
        </div>
      </form>
    </div>
  </div>
EOT;
}
