<?php
include_once('../app_config.php');
include(APP_PATH . 'libs/lotte-api.php');

header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json");

$response = [
    'code' => 400,
    // 'ser' => $_SERVER,
    'message' => 'Bad request'
];

if (empty($_SERVER['REQUEST_URI'])) {
    die(json_encode($response));
}

session_start();

$is_local = $_SERVER['REMOTE_ADDR'] === '::1';

$uri = $_SERVER['REQUEST_URI'];

$parts = explode('?', str_replace('/api', '', $uri));

$loadfile = dirname(__DIR__) . '/apw/wp-load.php';

// run only localhost to dev
if ($is_local) {
    $loadfile = dirname(dirname(__DIR__)) . '/lotte-wp/apw/wp-load.php';
}

$pathname = rtrim($parts[0], '/');

if ($pathname == '') {
    $response['message'] = 'Bad request route';

    die(json_encode($response));
}

$recaptcha_check = false;

// Always check csrf for all action of must-buy
if (strpos($pathname, '/must-buy/') === 0) {
    $recaptcha_check = true;

    $csrf = !empty($_POST['csrf']) ? trim($_POST['csrf']) : '';

    if ($csrf == '' || $lotte_api->check_csrf($csrf) == false) {
        die(json_encode([
            'code' => 403,
            'message' => 'CSRF invalid'
        ]));
    }
} else if ($pathname == '/user/signin') {
    $recaptcha_check = true;
}

// run only localhost to dev
if (ISSTG || $is_local) {
    $recaptcha_check = false;
}

// recaptcha siteverify before require wp
if ($recaptcha_check && defined('RECAPTCHA_SECRET_KEY') && isset($_POST['g-recaptcha-response'])) {

    $request_google_api = true;

    $recaptcha_log = [];

    if (isset($_SESSION['recaptcha_response'])) {
        $recaptcha_log[] = 'Check recaptcha_response';

        if ($_SESSION['recaptcha_response'] == $_POST['g-recaptcha-response']) {
            $recaptcha_log[] = 'OK';

            $body = [
                'success' => true
            ];

            $request_google_api = false;
        } else {
            $recaptcha_log[] = 'NG';
        }
    }

    if ($request_google_api) {
        $recaptcha_log[] = 'Request google api';

        $curl_body = $lotte_api->curl_send('https://www.google.com/recaptcha/api/siteverify', array(
            'secret'    => RECAPTCHA_SECRET_KEY,
            'response'  => $_POST['g-recaptcha-response'],
            'remoteip'  => $_SERVER['REMOTE_ADDR'],
        ), array(
            'referer' => APP_URL
        ));

        $recaptcha_log[] = 'Curl_body: ' . $curl_body;

        if (empty($curl_body) || substr($curl_body, 0, 1) != '{') {
            $response['message'] = 'Bad request recaptcha';

            die(json_encode($response));
        }

        $body = json_decode($curl_body, true);
    }

    // file_put_contents(__DIR__ . '/recap-' . $pathname . '-' . time() . '.log', implode("\n", $recaptcha_log));

    if (empty($body['success']) || $body['success'] != true) {
        $response['recaptcha'] = $body;

        if ($pathname == '/user/signin') {
            $response['error'] = 'Đăng nhập không thành công!';
        } else {
            $response['error'] = 'Mã an toàn google recaptcha không chính xác!';
        }

        die(json_encode($response));
    } else {
        $_SESSION['recaptcha_response'] = $_POST['g-recaptcha-response'];
    }
}

/**
 * Require WP Core
 */
if (file_exists($loadfile)) {
    require_once $loadfile;
} else {
    $response['message'] = 'Bad request core';

    die(json_encode($response));
}

if (function_exists('site_api_request_route')) {
    $response = site_api_request_route($pathname);
} else {
    $response['message'] = 'Bad request route core';
}

// if (isset($response['code'])) {
//     http_response_code($response['code']);
// }

die(json_encode($response));
