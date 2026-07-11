<?php
define('APP_PATH', dirname(__DIR__) . '/');

include(APP_PATH . 'libs/lotte-api.php');

// Offset 7 hours
$datetime = date('Y-m-d H:i:s', $lotte_api->get_time());

echo 'Offset 7 hours: ';

echo $datetime;
