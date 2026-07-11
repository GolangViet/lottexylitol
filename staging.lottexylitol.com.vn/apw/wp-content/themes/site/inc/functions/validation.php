<?php
defined('ABSPATH') or die();

/**
 * validation
 */
function site_validation_data($data = [], $valids = [])
{
    $errors = [];

    foreach ($valids as $field => $require) {
        if (isset($data[$field]) && $data[$field] != '') {
            $value = $data[$field];

            foreach(explode(',', $require) as $require) {
                $list = explode(':', $require);

                $error = site_validation_item($value, $list[0], isset($list[1]) ? $list[1] : null);
                
                if($error != '') {
                    $errors[$field] = $error;

                    break;
                }
            }
        } else {
            $errors[$field] = 'Empty';
        }
    }

    return $errors;
}

/**
 * validation item
 */
function site_validation_item($value = '', $type = '', $rule = null)
{
    $error = '';

    if ($type == 'email') {
        if (site_validation_email($value) == false) {
            $error = "Incorrect email";
        } else if ($rule == 'exists' && site_user_field_exists('email', $value)) {
            $error = "Exists";
        }
    } else if ($type == 'phone') {
        if (site_validation_phone($value) == false) {
            $error = "Incorrect phone";
        } else if ($rule == 'exists' && site_user_field_exists('phone', $value)) {
            $error = "Exists";
        }
    } else if ($type == 'preg' && is_string($rule) && preg_match($rule, $value) == false) {
        $error = "Incorrect preg " . $rule;
    } else if ($type == 'number') {
        if (is_numeric($value) == false || $value == 0) {
            $error = "Incorrect number";
        }
    } else if ($type == 'phone_country') {
        if (site_validation_phone_country($value) == false) {
            $error = "Incorrect phone country";
        }
    } else if ($type == 'length') {
        if (strlen($value) != $rule) {
            $error = "Incorrect length";
        }
    } else if ($type == 'minlength') {
        if (strlen($value) < $rule) {
            $error = "Incorrect minlength";
        }
    } else if ($type == 'maxlength') {
        if (strlen($value) > $rule) {
            $error = "Incorrect maxlength";
        }
    } else if ($type == 'min' && is_numeric($rule)) {
        if ($value < $rule) {
            $error = "Incorrect min";
        }
    } else if ($type == 'max' && is_numeric($rule)) {
        if ($value > $rule) {
            $error = "Incorrect max";
        }
    }

    return $error;
}

/**
 * validation email
 */
function site_validation_email($value = '')
{
    if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
        return true;
    }

    return false;
}

/**
 * validation phone number
 */
function site_validation_phone($value = '')
{
    $value = site_remove_to_tel($value);

    if (strlen($value) == 10 && preg_match('/[0-9]/', $value) && substr($value, 0, 1) == '0') {
        return true;
    }

    return false;
}

/**
 * validation phone country
 */
function site_validation_phone_country($value = '')
{
    if (strlen($value) > 1 && substr($value, 0, 1) == '+' && preg_match('/[0-9]/', substr($value, 1))) {
        return true;
    }

    return false;
}

/**
 * validation password
 */
function site_validation_password($value = '')
{
    if (
        preg_match('/[0-9]/', $value) 
        && preg_match('/[a-z]/', $value) 
        && preg_match('/[A-Z]/', $value)
        // && preg_match('/[!@#$%^&*]/', $value)
    ) {
        return true;
    }

    return false;
}

/**
 * validation url
 */
function site_validation_url($value = '')
{
    if (filter_var($value, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED)) {
        return true;
    }

    return false;
}