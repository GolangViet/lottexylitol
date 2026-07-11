<?php

$params = [
    'game_id' => '263d9a02-f62f-49f4-b9ef-77bec148cf9b',
    'order' => 'start_time.desc',
];

$url = 'https://staging.lottexylitol.com.vn/game-api/manage/game-scores?' . http_build_query($params, '', '&');

$headers = array(
    'Accept: application/json',
    'Authorization: Basic ' . base64_encode('xylitol:xylitol335'),
    'X-Auth-Token: YXBpdXNlcjo0ZjZYVDZNUUE4SGdPNFk=',
);

$response = curl_send($url, $headers);
if($response != '') {
    header('Content-type: application/json');
    die($response);
}

die('Error');


/** functions */
function curl_send( $url = '', $headers = array() ) 
{
    if (filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED) == false) return false;
    
    $ch = curl_init();
    $timeout = 5;
    
    $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.134 Safari/537.36 Edg/103.0.1264.77';

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

    // customize follow server
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    if (count($headers) > 0) {
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    
    $response = curl_exec($ch);

    // Then, after your curl_exec call:
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    // $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);

    curl_close($ch);

    return $body;
}
