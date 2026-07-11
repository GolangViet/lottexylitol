<?php
defined('ABSPATH') or die();

function site_api_get_routes()
{
    $routes = [
        [
            'name'          => '/cdp/surveys',
            'callback'      => 'site_api_cdp_get_surveys',
            'method'        => 'GET',
            'permission'    => 'cdp',
        ],[
            'name'          => '/cdp/users',
            'callback'      => 'site_api_cdp_get_users',
            'method'        => 'GET',
            'permission'    => 'cdp',
        ],[
            'name'          => '/cdp/users-activities',
            'callback'      => 'site_api_cdp_get_users_activities',
            'method'        => 'GET',
            'permission'    => 'cdp',
        ],[
            'name'          => '/cdp/lucky-wheel/spins',
            'callback'      => 'site_api_cdp_get_lucky_spins',
            'method'        => 'GET',
            'permission'    => 'cdp',
        ],[
            'name'          => '/cdp/lucky-wheel/users',
            'callback'      => 'site_api_cdp_get_lucky_users',
            'method'        => 'GET',
            'permission'    => 'cdp',
        ],[
            'name'          => '/cdp/lucky-wheel/rewards',
            'callback'      => 'site_api_cdp_get_lucky_rewards',
            'method'        => 'GET',
            'permission'    => 'cdp',
        ],[
            'name'          => '/game',
            'callback'      => 'site_api_game_get_info',
            'method'        => 'GET',
            'permission'    => 'token',
        ],[
            'name'          => '/game/token',
            'callback'      => 'site_api_game_get_token',
            'method'        => 'GET',
            'permission'    => 'token',
        ],[
            'name'          => '/game/update',
            'callback'      => 'site_api_game_update',
            'method'        => 'POST',
            'permission'    => 'token',
        ],
        [
            'name'          => '/user/signin',
            'callback'      => 'site_api_token_generate',
            'method'        => 'POST',
        ],[
            'name'          => '/user/signup',
            'callback'      => 'site_api_user_signup',
            'method'        => 'POST',
        ],[
            'name'          => '/user/info',
            'callback'      => 'site_api_user_update',
            'method'        => 'POST',
            'permission'    => 'token',
        ],[
            'name'          => '/user/info',
            'callback'      => 'site_api_user_get_info',
            'method'        => 'GET',
            'permission'    => 'token',
        ],[
            'name'          => '/user/gifts',
            'callback'      => 'site_api_user_get_gifts',
            'method'        => 'GET',
            'permission'    => 'token',
        ],[
            'name'          => '/user/gift',
            'callback'      => 'site_api_user_insert_gift',
            'method'        => 'POST',
            'permission'    => 'token',
        ],[
            'name'          => '/user/survey',
            'callback'      => 'site_api_survey_get_items',
            'method'        => 'GET',
            // 'permission'    => 'token',
        ],[
            'name'          => '/user/survey/brand',
            'callback'      => 'site_api_survey_brand_get_items',
            'method'        => 'GET',
            // 'permission'    => 'token',
        ],[
            'name'          => '/user/history',
            'callback'      => 'site_api_user_get_history',
            'method'        => 'GET',
            'permission'    => 'token',
        ],[
            'name'          => '/user/winner',
            'callback'      => 'site_api_winner_get_items',
            'method'        => 'GET',
            // 'permission'    => 'token',
        ],[
            'name'          => '/user/answer',
            'callback'      => 'site_api_answer_survey_normal',
            'method'        => 'POST',
            'permission'    => 'token',
        ],[
            'name'          => '/user/answer/brand',
            'callback'      => 'site_api_answer_survey_brand',
            'method'        => 'POST',
            'permission'    => 'token',
        ],[
            'name'          => '/user/avatar',
            'callback'      => 'site_api_user_update_avatar',
            'method'        => 'POST',
            'permission'    => 'token',
        ],[
            'name'          => '/user/contest',
            'callback'      => 'site_api_user_insert_contest',
            'method'        => 'POST',
            'permission'    => 'token',
        ],[
            'name'          => '/user/del-account',
            'callback'      => 'site_api_user_delete_account',
            'method'        => 'POST',
            'permission'    => 'token',
        ],[
            'name'          => '/user/forgot',
            'callback'      => 'site_api_user_forgot',
            'method'        => 'POST',
            // 'permission'    => 'token',
        ],[
            'name'          => '/user/verify/newpass',
            'callback'      => 'site_api_user_verify_newpass',
            'method'        => 'POST',
            // 'permission'    => 'token',
        ],[
            'name'          => '/user/phone/sms',
            'callback'      => 'site_api_user_phone_sms',
            'method'        => 'POST',
            // 'permission'    => 'token',
        ],[
            'name'          => '/user/phone/verify',
            'callback'      => 'site_api_user_phone_verify',
            'method'        => 'POST',
            // 'permission'    => 'token',
        ],[
            'name'          => '/page/brand',
            'callback'      => 'site_api_page_brand',
            'method'        => 'GET',
            // 'permission'    => 'token',
        ],[
            'name'          => '/must-buy/verify-code',
            'callback'      => 'site_api_must_buy_verify_code',
            'method'        => 'POST',
            'permission'    => 'token',
        ],[
            'name'          => '/must-buy/fill-blank',
            'callback'      => 'site_api_must_buy_fill_blank',
            'method'        => 'POST',
            'permission'    => 'token',
        ],[
            'name'          => '/must-buy/lucky',
            'callback'      => 'site_api_must_buy_lucky',
            'method'        => 'POST',
            'permission'    => 'token',
        ],[
            'name'          => '/must-buy/xexindentay',
            'callback'      => 'site_api_must_buy_luxury',
            'method'        => 'POST',
            'permission'    => 'token',
        ],[
            'name'          => '/history/must-buy',
            'callback'      => 'site_api_must_buy_history',
            'method'        => 'GET',
            'permission'    => 'token',
        ],[
            'name'          => '/must-buy/testing',
            'callback'      => 'site_api_must_buy_testing',
            'method'        => 'GET',
            // 'permission'    => 'token',
        ],[
            'name'          => '/luxury-list',
            'callback'      => 'site_api_must_buy_get_luxury',
            'method'        => 'GET',
            'permission'    => 'token',
        ],
    ];

    return $routes;
}

function site_api_request_route($pathname = '')
{
    $routes = site_api_get_routes();

    $response = [
        'code' => 400,
        'message' => 'Bad route'
    ];

    foreach ($routes as $route) {
        $method = isset($route['method']) ? strtoupper($route['method']) : '';
        $name = isset($route['name']) ? strtolower($route['name']) : '';
        if ($name === $pathname && $method === $_SERVER['REQUEST_METHOD']) {
            if (function_exists($route['callback'])) {
                $permission = isset($route['permission']) ? strtolower($route['permission']) : '';

                $check = true;

                if (in_array($permission, ['token', 'cdp'])) {
                    $role = '';

                    if ($permission == 'cdp') {
                        $role = $permission;
                        $permission = 'token';
                    }

                    $response = site_api_permission_check($permission, $role);
                    if (is_array($response)) {
                        $check = false;
                    }
                }

                if ($check) {
                    $args = [];

                    $content_type = site_api_get_header('content-type');

                    if($content_type == 'application/json' || $content_type == 'text/plain') {
                        $args = site_api_get_data_json();
                    } else if ($method == 'POST') {
                        $args = $_POST;
                    } else if ($method == 'GET') {
                        $args = $_GET;
                    }

                    // set lang;
                    if(isset($_GET['lang']) && trim($_GET['lang']) == 'en') {
                        global $locale;

                        $locale = 'en';
                    }

                    $response = call_user_func($route['callback'], $args);
                }
            } else {
                $response = [
                    'code' => 400,
                    'message' => 'Bad route callback'
                ];
            }

            break;
        }
    }

    return site_api_response_json($response);
}

function site_api_response_json($response = [])
{
    if(isset($response['error'])) {
        if(is_array($response['error'])) {
            $errors = [];

            foreach($response['error'] as $key => $text) {
                $text = __($text, 'site');

                if(is_string($key)) {
                    $text = __($key, 'site') . ' ' . $text;
                }
    
                $errors[] = $text;
            }
    
            $response['error'] = implode(',', $errors);
        } else {
            $response['error'] = __($response['error'], 'site');
        }
    }

    if($response['code'] == 200) {
        $response['message'] = __('Request success', 'site');
    } else {
        $response['message'] = __($response['message'], 'site');
    }

    return $response;
}

function site_api_permission_check($type = '', $role = '')
{
    $response = [
        'code' => 401,
        'message' => 'No permission'
    ];

    if ($type == 'token') {
        $jwt_token = site_api_get_header('token');
        if ($jwt_token == '') {
            $response = [
                'code' => 401,
                'message' => 'Token null'
            ];
        } else {
            $response = site_jwt_signature_validation($jwt_token);
            if ($response['code'] == 200 && isset($response['payload'])) {
                $payload = $response['payload'];

                $user = get_user_by('login', $payload['name']);
                if (is_object($user) && isset($user->ID)) {
                    $reset_pass_at = (int) get_user_meta($user->ID, 'reset-pass-at', true);
                    if($reset_pass_at > $payload['iat']) {
                        $response = [
                            'code' => 401,
                            'message' => 'Token expired'
                        ];
                    } else if($role != '' && in_array($role, $user->roles) == false) {
                        $response = [
                            'code' => 401,
                            'message' => 'User is not permission'
                        ];
                    } else {
                        global $site_user;

                        $site_user = $user;
    
                        $response = true;    
                    }
                } else {
                    $response = [
                        'code' => 401,
                        'message' => 'User is not exists'
                    ];
                }
            }
        }
    }

    return $response;
}

function site_api_get_header($name = '')
{
    global $site_headers;

    $headers = [];

    if(isset($site_headers)) {
        $headers = $site_headers;
    } else {
        foreach (getallheaders() as $key => $value) {
            $headers[strtolower($key)] = $value;
        }

        // api need keys
        foreach (['token', 'authorization'] as $key) {
            $value = 'HTTP_' . strtoupper($key);
            if(empty($headers[$key]) && !empty($_SERVER[$value])) {
                $headers[$key] = $_SERVER[$value];
            }
        }

        $site_headers = $headers;
    }

    $name = trim($name);
    if($name != '') {
        $name = strtolower($name);
        
        if (isset($headers[$name])) {
            return $headers[$name];
        }

        return '';
    }

    return $headers;
}

function site_api_get_current_user($type = '')
{
    global $site_user;
    
    if (isset($site_user)) {
        if($type == 'info') {
            return site_user_get_info($site_user);
        }

        return $site_user;
    }

    return false;
}

function site_api_get_data_json()
{
    $data = json_decode(file_get_contents('php://input'), true);

    return $data;
}

function site_api_get_lang()
{
    $lang = explode('_', get_locale());

	return $lang[0];
}
