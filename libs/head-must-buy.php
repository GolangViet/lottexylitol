<?php
defined('APP_PATH') or die();

$mustbuy_dir    = 'nhanqualientay';
$mustbuy_lang_dir= $lang_link . $mustbuy_dir;

define('MUSTBUY_PATH', APP_PATH . $mustbuy_lang_dir);

if(ISSTG && !empty($_GET['end-date'])) {
    $mustbuy_to = $_GET['end-date'] . ' 23:59:59';
}

$csrf_token     = $lotte_api->get_csrf();

$signup_link    = '';
$step           = 'start';
$lucky_code     = '';
$body_attr      = [];
$is_terms       = preg_match('/\/(terms)/i', $_SERVER['REQUEST_URI']);
$fill_blank_index = -1;
$time_from      = strtotime($mustbuy_from);
$time_to        = strtotime($mustbuy_to);
$is_coming      = $lotte_api->is_mustbuy_coming_soon($mustbuy_from, $mustbuy_to);
$is_ajax        = !empty($_GET['wrap']) && intval($_GET['wrap']) > time();

$user = $lotte_api->get_current_user();

if ($user == false) {
    $utm = '';

    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == 'utm_') {
            $utm .= "&{$key}={$value}";
        }
    }

    $signup_link = "/{$lang_link}signup?redirect_to=" . urlencode("/{$mustbuy_lang_dir}/") . $utm;

    // echo '<meta http-equiv="refresh" content="0; url=/signin?redirect_to=' . urlencode($_SERVER['REQUEST_URI']) . $utm . '">';
    // exit;
} else if($is_coming == false){

    if (!empty($user['lucky_step'])) {
        $step = $user['lucky_step'];
        // if ($step == 'fill-blank') {
        //     $step = 'start';
        // }
    }

    // $step = 'lock'; // test

    if ($step != 'lock') {
        $lucky_code = $user['lucky_code'];
    }

    $jwt_token = explode('.', $_COOKIE['lot_token']);
    $payload = json_decode(base64_decode($jwt_token[1]), true);
    $fill_blank_old = -1;

    if(!empty($_COOKIE['lot_fill_blank'])) {
        $fill_blank_params = explode('.', $_COOKIE['lot_fill_blank']);

        if(count($fill_blank_params) > 1) {
            if($is_ajax) {
                // reset new question
                $fill_blank_old = (int) $fill_blank_params[0];
            } else if($payload['exp'] == $fill_blank_params[1]) {
                // use old question
                $fill_blank_index = (int) $fill_blank_params[0];
            } else {
                // reset new question
                $fill_blank_old = (int) $fill_blank_params[0];
            }
        }
    }

    if($fill_blank_index == -1){
        // random in 5 questions
        while($fill_blank_index == -1 || $fill_blank_index == $fill_blank_old) {
            $fill_blank_index = rand(0, 4);
        }

        @setcookie('lot_fill_blank', $fill_blank_index . '.' . $payload['exp'], $payload['exp'], '/');
    }
}

$class = 'p-must-buy';

if ($step == 'start') {
    $class .= ' p-must-buy-start';
}

$next_step = 'start';

if ($lucky_code == '') {
    $next_step = 'code';
}

if ($step == 'lock') {
    $class .= ' p-must-buy-locked';
} else if($lucky_code != '' && ($step == 'fill-blank' || $step == 'lucky')) {
    $body_attr['data-show'] = $step;
}

// is ajax - choi lai
if ($is_ajax) {
    require_once(APP_PATH . '/'. $mustbuy_lang_dir . '/inc/wrap.php');
    die;
}

if(isset($_SERVER['HTTP_REFERER']) && preg_match('/(signin|signup|about-must-buy)/i', $_SERVER['HTTP_REFERER'])) {
    $body_attr['data-show'] = $step;
}

if($is_terms) {
    unset($body_attr['data-show']);
}

$body_attr['data-step'] = $step;

foreach($body_attr as $key => $value) {
    $body_attr[$key] = $key . '="' . $value .'"';
}

$body_attr = implode(' ', $body_attr);
