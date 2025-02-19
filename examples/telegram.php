<?php
include_once('init.php');
$response = $client->telegram->send([
  'to' => '79260000000',
  'txt' => '12345',
]);
printf("Telegram Request ID: %s\n", $response->request_id);

$response = $client->telegram->status(['id' => $response->request_id]);
printf("Telegram Status: %s\n", var_export($response, 1));