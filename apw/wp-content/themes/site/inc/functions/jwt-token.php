<?php
defined('ABSPATH') or die();


function site_jwt_get_option($option_name = '', $option_value = null)
{
    $data = [
        'client_secret' => 'ydDKY1TuC6bZmhdXx5y8A11MlBqgbe1B',
        'algorithm' => 'HS256',
        'typ' => 'JWT',
    ];

    if (isset($data[$option_name])) {
        return $data[$option_name];
    }

    return $option_value;
}

function site_jwt_get_time()
{
    return current_time('U');
}

function site_jwt_authentication_base64_url_encode($text)
{
    return rtrim(strtr(base64_encode($text), '+/', '-_'), '=');
}

function site_jwt_authentication_base64_url_decode($text)
{
    return sanitize_text_field(base64_decode(str_pad(strtr($text, '-_', '+/'), strlen($text) % 4, '=', STR_PAD_RIGHT))); //phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_decode -- Using base64 for verifying standard basic authentication method
}

function site_jwt_auth_create_token($user, $exp = -1)
{
    $client_secret = site_jwt_get_option('client_secret');

    $iat = site_jwt_get_time();

    if ($exp == -1) {
        $exp = $iat + 60000000;
    } else {
        $exp = $iat + $exp;
    }

    // Create the token header.
    $header = wp_json_encode(
        array(
            'alg' => site_jwt_get_option('algorithm'),
            'typ' => 'JWT',
        )
    );

    // Create the token payload.
    $payload = wp_json_encode(
        array(
            'name' => $user->user_login,
            'iat'  => $iat,
            'exp'  => $exp,
        )
    );

    // Encode Header.
    $base64_url_header = site_jwt_authentication_base64_url_encode($header);

    // Encode Payload.
    $base64_url_payload = site_jwt_authentication_base64_url_encode($payload);

    // Create Signature Hash.
    $signature = hash_hmac('sha256', $base64_url_header . '.' . $base64_url_payload, $client_secret);

    // Encode Signature to Base64Url String.
    $base64_url_signature = site_jwt_authentication_base64_url_encode($signature);

    // Create JWT.
    $jwt = $base64_url_header . '.' . $base64_url_payload . '.' . $base64_url_signature;

    $token_data = array(
        // 'token_type' => 'Bearer',
        'code'       => 200,
        'iat'        => $iat,
        'expires_in' => $exp,
        'jwt_token'  => $jwt,
    );

    return $token_data;
}

function site_jwt_signature_validation($jwt_token = [])
{
    if (!is_array($jwt_token)) {
        $jwt_token = explode('.', $jwt_token);
    }

    $response = array(
        'code'              => 401,
        'error'             => 'TOKEN INVALID SIGNATURE',
        'message'           => 'JWT Signature is invalid.',
    );

    if (count($jwt_token) == 3) {
        $header = (array) json_decode(site_jwt_authentication_base64_url_decode($jwt_token[0]), true);

        $header = shortcode_atts(array(
            'alg' => '',
            'typ' => '',
        ), $header);

        if (site_jwt_get_option('algorithm') === $header['alg']) {
            $signature = hash_hmac('sha256', $jwt_token[0] . '.' . $jwt_token[1], site_jwt_get_option('client_secret'));
            $base64_url_signature = site_jwt_authentication_base64_url_encode($signature);

            if (isset($jwt_token[2]) && hash_equals($base64_url_signature, $jwt_token[2])) {
                $payload = json_decode(site_jwt_authentication_base64_url_decode($jwt_token[1]), true);

                $payload = shortcode_atts(array(
                    'name' => '',
                    'iat'  => 0,
                    'exp'  => 0,
                ), $payload);

                if ($payload['exp'] < site_jwt_get_time()) {
                    $response = array(
                        'code'              => 401,
                        'error'             => 'Token expired',
                        'message'           => 'JWT expired.',
                    );
                } else {
                    $response = array(
                        'code'              => 200,
                        'payload'           => $payload,
                        'message'           => 'JWT OK.',
                    );
                }
            }
        }
    }

    return $response;
}
