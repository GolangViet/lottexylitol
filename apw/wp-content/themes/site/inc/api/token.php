<?php
defined('ABSPATH') or die();

/**
 * token: generate
 * 
 * $args : array($username, $password)
 *
 */
function site_api_token_generate($args = [])
{
    $user = site_api_user_signin($args);

    if(is_object($user) && isset($user->ID)) {

        // Must buy
        if(function_exists('site_api_must_buy_get_setting')) {
            $response = site_jwt_auth_create_token($user, site_api_must_buy_get_setting('token_expire'));
        } else {
            $response = site_jwt_auth_create_token($user);
        }

        if($response['code'] == 200) {
            // $info = site_user_get_info($user, 'info');

            $response['name'] = $user->display_name;
        }
    } else {
        $response = [
            'code'      => 401,
            'error'     => $user,
            'message'   => 'User signin invalid'
        ];
    }
    
    return $response;
}

/**
 * token: refresh
 *
 */
function site_api_token_refresh()
{
    $user = site_api_get_current_user();

    if(is_object($user) && isset($user->ID)) {

        return site_jwt_auth_create_token($user);

    } else {
        $response = [
            'code' => 401,
            'message' => 'Token refresh fail'
        ];
    }

    return $response;
}
