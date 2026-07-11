<?php

function site_hasher_class()
{
    global $wp_hasher;

    // Now insert the key, hashed, into the DB.
    if (empty($wp_hasher)) {
        require_once ABSPATH . WPINC . '/class-phpass.php';
        $wp_hasher = new PasswordHash(8, true);
    }

    return $wp_hasher;
}

function site_hasher_get_pass($key = '')
{
    if ($key == '') return '';

    $wp_hasher = site_hasher_class();

    $hashed = time() . ':' . $wp_hasher->HashPassword($key);

    return $hashed;
}

function site_hasher_check_pass($key = '', $activation_key = '')
{
    if ($key == '' || $activation_key == '') return false;

    if (str_contains($activation_key, ':')) {
        $wp_hasher = site_hasher_class();

        $expiration_duration = DAY_IN_SECONDS;

        list($pass_request_time, $pass_key) = explode(':', $activation_key, 2);
        $expiration_time                      = $pass_request_time + $expiration_duration;

        $hash_is_correct = $wp_hasher->CheckPassword($key, $pass_key);

        if ($hash_is_correct && $expiration_time && time() < $expiration_time) {
            return true;
        }
    }

    return false;
}

function site_hasher_get_code()
{
    return rand(111111, 999999);
}
