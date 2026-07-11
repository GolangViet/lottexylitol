<?php

$file = dirname(__DIR__) . '/apw/wp-load.php';
if (!file_exists($file)) die('Not found!');

// /** Make sure that the WordPress bootstrap has run before continuing. */
require_once($file);

if(function_exists('site_vietguys_api_send') == false) die('vietguys function not found!');

// $response = site_vietguys_api_refresh_token();
// header('Content-Type: application/json');
// echo $response;

$phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : (isset($_GET['phone']) ? sanitize_text_field($_GET['phone']) : '');
if($phone == '') echo 'Phone null!';

$response = site_vietguys_api_send($phone, '123456');

if(is_string($response)) {
    echo $response;
} else {
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

// vietguys_api_send();
// 9QbNlq0_6lffaH84Mxfn873FdOptY_u8yDTIdoGIkDUsH1znmRhNL9UUu8uvtmxQ7X3xK9st6sU0qHhXjT5uoe8HHONOe9QeJ35HX-haA_CHkUafoo8nP3zEP8iwRGk5

// $data = [
//     'access_token' => "9QbNlq0_6lffaH84Mxfn873FdOptY_u8yDTIdoGIkDUsH1znmRhNL9UUu8uvtmxQ7X3xK9st6sU0qHhXjT5uoe8HHONOe9QeJ35HX-haA_CHkUafoo8nP3zEP8iwRGk5",
//     'refresh_token' => "oL5eCupnyofcedRTFctee1NgVULgLR8svA697jwK78Ii20JdtBfTL9uagjlQU25aLFng2bhxz7ovIGIs9uPdtbjUaeA6aT6vE4tYS_lzJzgBLuid5VCszfLR-u7KVtpr",
//     'expired_at' => 1765006313614
// ];

// $refresh_token = site_vietguys_api_refresh_token();

// var_dump(['refresh_token' => $refresh_token]);

// update_option('vietguys_setting', $data);

// $access_token = site_vietguys_get_access_token();

// var_dump(['access_token' => $access_token]);

// echo date('Y-m-d H:i:s', 1765006313614);