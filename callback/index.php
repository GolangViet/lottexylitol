<?php

// header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
// header("Content-Type: application/json");

$data = json_decode(file_get_contents('php://input'), true);

$folder = __DIR__ . '/#data';

if(!is_dir($folder)) {
    @mkdir($folder);
}

$filename = date('Ymd-His');

file_put_contents($folder . '/' . $filename . '.json', json_encode([
    'data'      => $data,
    'post'      => $_POST,
    'request'   => $_REQUEST,
]));

// if(!is_array($data)) {
//     $data = $_POST;
// }

// if (count($data) > 0) {
//     if (isset($data['data']) && isset($data['data']['tracking_id'])) {
//         $filename .= '-' . $data['data']['tracking_id'];
//     }

//     file_put_contents($folder . '/' . $filename . '.json', json_encode($data));
// }

// $response = [
//     'code' => 200,
//     'message' => 'Success'
// ];

// die(json_encode($response));
