<?php

global $wp_query;
$type = $wp_query->query_vars['idxHook'];

header('content-type: application/json; charset=utf8');
echo json_encode([
  'name' => $type,
  'payload' => [],
]);
