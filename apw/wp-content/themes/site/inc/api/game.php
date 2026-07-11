<?php
defined('ABSPATH') or die();

function site_api_game_get_info()
{
    $user = site_api_get_current_user();

    $list = explode('-', $user->user_login);

    if(count($list) == 2) {
        $time = current_time('U');
        $game_expires = (int) get_user_meta($user->ID, 'game_expires', true);

        // Number of times played
        /*
        $number_of_times = (int) get_option('game_number_of_times');
        if($number_of_times > 0 ) {
            $game_count = (int) get_user_meta($user->ID, 'game_count', true);
            if($game_count >= $number_of_times) {
                $expires = strtotime(get_option('game_stop'));
                if($game_expires != $expires) {

                    $game_expires = $expires;

                    update_user_meta($user->ID, 'game_expires', $game_expires);
                }
            }
        }
        */

        if($time < $game_expires) {
            $response = [
                'code' => 401,
                'error' => 'YOUR GAME EXPIRED',
                'message' => 'Request fail'
            ];
        } else {
            // time of game api;
            update_user_meta($user->ID, 'game_play_start', time());

            $response = [
                'code' => 200,
                'data' => [
                    'user_id' => $list[1],
                    'name' => $user->display_name,
                ],
                'message' => 'Request success'
            ];
        }
    } else {
        $response = [
            'code' => 401,
            'error' => 'No permission',
            'message' => 'Request fail'
        ];
    }

    return $response;
}

function site_api_game_get_token()
{
    $user = site_api_get_current_user();

    // $exp = 5 * MINUTE_IN_SECONDS;

    $exp = 1 * YEAR_IN_SECONDS; // for test

    return site_jwt_auth_create_token($user, $exp);
}

function site_api_game_update($user = false)
{
    if($user == false) {
        $user = site_api_get_current_user();
    }
    
    // time of game api;
    $time = time();
    $game_play_start = (int) get_user_meta($user->ID, 'game_play_start', true);
    if($game_play_start < $time) {
        $list = explode('-', $user->user_login);

        // call game api get score
        $items = isset($list[1]) ? site_api_game_get_manage_score($list[1]) : [];
        if(count($items) == 0) {
            return;
        }

        $score = -1;

        foreach($items as $item) {
            $start_time = strtotime($item['start_time']);
            $end_time = strtotime($item['end_time']);

            if($start_time <= $game_play_start && $game_play_start <= $end_time && $time > $end_time) {
                $score = (int) $item['score'];

                break;
            }
        }

        if($score > -1) {
            update_user_meta($user->ID, 'game_play_start', 0);
            
            $expires = site_user_get_new_expires('game'); // Expires v1.1
            update_user_meta($user->ID, 'game_expires', $expires);

            // user history
            site_user_history_insert_item([
                'user_id' => $user->ID,
                'name' => 'game',
                'description' => 'score: ' . $score,
            ]);
    
            $response = [
                'code' => 200,
                'score' => $score,
                'message' => 'Request success'
            ];
        } else {
            $response = [
                'code' => 401,
                // 'test' => $test,
                'score' => $score,
                'message' => 'Request fail'
            ];
        }
    } else {
        $response = [
            'code' => 401,
            'error' => 'No game play',
            'message' => 'Request fail'
        ];
    }

    return $response;
}

function site_api_game_get_manage_score($user_id = 0)
{
    $file_env = dirname(ABSPATH) . '/game-api/.env';
    if(file_exists($file_env) == false) {
        return [];
    }

    $env = parse_ini_file($file_env);
    if(empty($env['API_AUTH_USER']) || empty($env['API_AUTH_PASSWD'])) {
        return [];
    }

    $headers = [
        'Accept: application/json',
        'X-Auth-Token: ' . base64_encode($env['API_AUTH_USER'] . ':' . $env['API_AUTH_PASSWD'])
    ];

    $authorization = site_get_header('authorization');
    if($authorization != '') {
        $headers[] = 'Authorization: ' . $authorization;
    }
    
    $url = site_get_domain() . '/game-api/manage/game-scores';

    $args = [
        'game_id' => '263d9a02-f62f-49f4-b9ef-77bec148cf9b',
        'order' => 'start_time.desc',
        'limit' => 1,
        // 'user_id' => '17255081259999',
    ];

    if($user_id > 0) {
        $args['user_id'] = $user_id;
    }

    if(count($args)>0) {
        $url .= '?' . http_build_query($args, '', '&');
    }

    $response = site_curl_send($url, [], $headers);
    if($response == '') {
        return [];
    }

    $response = json_decode($response, true);
    if(isset($response['statusCode']) && $response['statusCode'] == 200 && is_array($response['data'])) {
        return $response['data'];
    }

    return [];
}