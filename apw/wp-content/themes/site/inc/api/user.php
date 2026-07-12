<?php
defined('ABSPATH') or die();

function site_api_user_signin($args = [])
{
    $args = shortcode_atts(array(
        'username' => '',
        'password' => '',
    ), $args);

    $args = array_map('sanitize_text_field', $args);

    $errors = site_validation_data($args, [
        'username' => 'required',
        'password' => 'required',
    ]);

    if (count($errors) == 0) {
        extract($args);

        $user = false;

        if (site_validation_email($username)) {
            $user = site_user_get_data_by('email', $username);
        } else if (site_validation_phone($username)) {
            $user = site_user_get_data_by('phone', $username);
        }

        if (is_object($user)) {
            if (wp_check_password($password, $user->user_pass, $user->ID)) {
                return $user;
            } else {
                $errors = [
                    'Password is not the correct'
                ];
            }
        } else {
            $errors = [
                'Username is not exists'
            ];
        }
    }

    return $errors;
}

function site_api_user_signup($args = [])
{
    $data = shortcode_atts(array(
        'name'      => '',
        'email'     => '',
        'phone'     => '',
        'address'   => '',
        'gender'    => '',
        // 'phone_country' => '',
        'city'      => '',
        'age'       => 0,
        'password'  => '',
        'code'      => '',
    ), $args);

    $data = array_map('sanitize_text_field', $data);

    $rules = [
        'name'      => 'required',
        'email'     => 'email:exists',
        'phone'     => 'phone:exists',
        'address'   => 'required',
        'gender'    => 'required',
        'password'  => 'required',
        // 'phone_country' => 'required',
        'city'      => 'required',
        'age'       => 'number',
        // 'code'      => 'required',
    ];

    if(defined('ISSTG') && ISSTG == true) {
        unset($rules['code']);
    }

    $isValidPhone = isValidVietnamPhone($data['phone'] ?? '');
    if (!$isValidPhone) {
        return ['code' => 401, 'error' => 'Số điện thoại không hợp lệ', 'message' => 'User signup fail'];
    }

    $errors = site_validation_data($data, $rules);

    if (count($errors) == 0) {

        // $response = site_api_user_phone_verify($data);
        // if($response['code'] != 200) {
        //     return $response;
        // }

        $answers = [];

        if(isset($args['answers'])) {
            $answers = $args['answers'];

            $lang = site_api_get_lang();

            $option_name = 'survey_id';

            if($lang == 'en') {
                $option_name .= '_en';
            }

            $answers['survey_id'] = get_option($option_name, 0);

            $valid = site_answer_validate_data($answers);

            if(isset($valid['errors'])) {
                $response = [
                    'code' => 401,
                    'error' => $valid['errors'],
                    'message' => 'Request fail'
                ];

                return $response;
            }
        }

        $utm = [];

        foreach($args as $key => $value) {
            if(substr($key,0,4) == 'utm_') {
                $utm[$key] = $value;
            }
        }

        if(count($utm)>0) {
            $data['utm'] = http_build_query($utm, '', '&');
        }

        $user_id = site_user_singup($data);

        if($user_id > 0){
            $user = get_user_by('ID', $user_id);

            if(count($answers)>0) {
                $response = site_api_answer_insert_item($answers, $user, $option_name);

                // if($response['code'] != 200) {
                //     return $response;
                // }
            }

            $jwt_token = '';

            // Must buy
            if(function_exists('site_api_must_buy_get_setting')) {
                $jwt_response = site_jwt_auth_create_token($user, site_api_must_buy_get_setting('token_expire'));
            } else {
                $jwt_response = site_jwt_auth_create_token($user);
            }

            if($jwt_response['code'] == 200) {
                $jwt_token = $jwt_response['jwt_token'];
            }

            delete_option('activation_'. $data['phone']);

            $response = [
                'code' => 200,
                'jwt_token' => $jwt_token,
                'message' => 'User signup success'
            ];
        } else {
            $response = [
                'code'      => 401,
                'error'     => 'Insert data fail',
                'message'   => 'User signup fail'
            ];
        }
    } else {
        $response = [
            'code'      => 401,
            'error'     => $errors,
            'message'   => 'User signup fail'
        ];
    }

    return $response;
}

function site_api_user_update($args = [])
{
    $args = shortcode_atts(array(
        'name'      => '',
        'email'     => '',
        'phone'     => '',
        'address'   => '',
        'gender'    => '',
        // 'phone_country' => '',
        'city'      => '',
        'age'       => 0,
        'cccd'      => '', // must buy game
        'newpassword' => '',
        'oldpassword' => '',
    ), $args);

    $args = array_map('sanitize_text_field', $args);

    $errors = site_validation_data($args, [
        'name'      => 'required',
        'email'     => 'email',
        'phone'     => 'phone',
        'address'   => 'required',
        'gender'    => 'required',
        // 'phone_country' => 'required',
        'city'      => 'required',
        'age'       => 'number',
    ]);

    $user = site_api_get_current_user();

    if($args['oldpassword'] == '' || !wp_check_password($args['oldpassword'], $user->user_pass, $user->ID)) {

        $errors[] = 'Password is not the correct';

    } else if($args['newpassword']!='') {
        $args['password'] = $args['newpassword'];

        unset($args['oldpassword']);
        unset($args['newpassword']);
    }

    if (count($errors) == 0) {
        $info = site_user_get_info($user);

        if ($args['phone'] != $info['phone']) {
            $error = site_validation_item($args['phone'], 'phone', 'exists');

            if($error != '') {
                $errors['phone'] = $error;
            }
        }

        if ($args['email'] != $info['email']) {
            $error = site_validation_item($args['email'], 'email', 'exists');

            if($error != '') {
                $errors['email'] = $error;
            }
        }
    }

    if (count($errors) > 0) {
        $response = [
            'code'      => 401,
            'error'     => $errors,
            'message'   => 'User update fail'
        ];
    } else if(count($args) > 0) {
        $args['ID'] = $user->ID;

        site_user_update($args);

        $updated = [];

        foreach($args as $key => $value) {
            if(in_array($key, ['city', 'age', 'gender'])) {
                $value = site_user_get_options($key, $value);
            }

            if(isset($info[$key]) && $info[$key] != $value) {
                $updated[] = $key . '=' . $info[$key];
            }
        }

        // user history
        site_user_history_insert_item([
            'user_id'   => $user->ID,
            'name'      => 'update info',
            'description' => 'old: ' . implode(",", $updated),
        ]);

        $response = [
            'code' => 200,
            'message' => 'User update success'
        ];
    } else {
        $response = [
            'code'      => 200,
            'message'   => 'Request success'
        ];
    }

    return $response;
}

function site_api_user_get_info()
{
    $user = site_api_get_current_user();

    // Check and update game score
    $response = site_api_game_update($user);

    $info = site_user_get_info($user, 'info');

    $response = [
        'code' => 200,
        'user' => $info,
        // 'score' => $response['score'],
        'message' => 'Request success'
    ];

    return $response;
}

function site_api_user_get_gifts($args = [])
{
    $response = [
        'code' => 200,
        'args' => $args,
        'message' => 'Request success'
    ];

    return $response;
}

function site_api_user_get_history($args = [])
{
    $args = shortcode_atts(array(
        'year' => '',
    ), $args);

    $user = site_api_get_current_user();

    $args['user_id'] = $user->ID;

    $years = site_user_history_get_years($args);

    if($args['year'] == '' && count($years)>0) {
        $args['year'] = end($years);
    }

    $items = site_user_history_get_items($args);

    $response = [
        'code' => 200,
        'items' => $items,
        'years' => $years,
        'message' => 'Request success'
    ];

    return $response;
}

function site_api_user_insert_gift($args = [])
{
    extract(shortcode_atts(array(
        'id' => '',
    ), $args));

    $errors = [];

    if ($id == 0 || get_post_type($id) != 'gift') {
        $errors['id'] = 'Empty';
    } else {
        $user = site_api_get_current_user();

        $user_point = (int) get_user_meta($user->ID, 'point', true);

        // check user point
        $gift_point = (int) get_post_meta($id, 'point', true);
        if($gift_point > $user_point) {
            $errors['point'] = 'Not enough';
        }
    }

    if (count($errors) == 0) {

        // user history
        site_user_history_insert_item([
            'user_id'   => $user->ID,
            'name'      => 'get gift',
            'post_type' => 'gift',
            'post_id'   => $id
        ]);

        $response = [
            'code' => 200,
            'message' => 'Request success'
        ];
    } else {
        $response = [
            'code'      => 401,
            'error'     => $errors,
            'message'   => 'Request fail'
        ];
    }

    return $response;
}

function site_api_user_upload($args = [])
{
    $args = shortcode_atts(array(
        'image'      => '',
    ), $args);

    $errors = [];

    if($args['image'] == '') {
        $errors['image'] = 'Empty';
    }

    if (count($errors) == 0) {
        $user = site_api_get_current_user();

        $attach_id = site_media_save_file($args['image'], $user->ID);

        // user history
        site_user_history_insert_item([
            'user_id'   => $user->ID,
            'name'      => 'upload photo',
            'post_type' => 'attachment',
            'post_id'   => $attach_id
        ]);

        $response = [
            'code' => 200,
            'message' => 'Request success'
        ];
    } else {
        $response = [
            'code'      => 401,
            'error'    => $errors,
            'message' => 'Request fail'
        ];
    }

    return $response;
}

function site_api_user_update_avatar($args = [])
{
    $args = shortcode_atts(array(
        'image' => '',
    ), $args);

    $errors = [];

    if($args['image'] == '') {
        $errors['image'] = 'Empty';
    }

    if (count($errors) == 0) {
        $user = site_api_get_current_user();

        $attach_id = site_media_save_file($args['image'], $user->ID);

        if($attach_id > 0) {
            $avatar_id = (int) get_user_meta($user->ID, 'avatar_id', true);
            if($avatar_id > 0) {
                wp_delete_attachment($avatar_id, true);
            }

            update_user_meta($user->ID, 'avatar_id', $attach_id);

            $response = [
                'code' => 200,
                'message' => 'Request success'
            ];
        } else {
            $response = [
                'code'      => 401,
                'error'    => 'Process data fail',
                'message' => 'Request fail'
            ];
        }
    } else {
        $response = [
            'code'      => 401,
            'error'    => $errors,
            'message' => 'Request fail'
        ];
    }

    return $response;
}

function site_api_user_insert_comment($args = [])
{
    $user = site_api_get_current_user();

    // user history
    site_user_history_insert_item([
        'user_id'   => $user->ID,
        'name'      => 'insert comment',
        'post_type' => 'comment',
        'post_id'   => time()
    ]);

    $response = [
        'code' => 200,
        'args' => $args,
        'message' => 'Request success'
    ];

    return $response;
}

function site_api_user_delete_account($args = [])
{
    extract(shortcode_atts(array(
        'password' => '',
    ), $args));

    $user = site_api_get_current_user();
    if ($password != '' && wp_check_password($password, $user->user_pass, $user->ID)) {
        if(function_exists('wp_delete_user') == false) {
            require_once(ABSPATH.'wp-admin/includes/user.php');
        }

        $info = site_user_get_info($user, 'single');

        if(wp_delete_user($user->ID)) {

            site_user_delete_insert_item([
                'user_id' => $user->ID,
                'user_login' => $user->user_login,
                'phone' => md5($info['phone']),
            ]);

            $avatar_id = (int) get_user_meta($user->ID, 'avatar_id', true);
            if($avatar_id > 0) {
                wp_delete_attachment($avatar_id, true);
            }

            $response = [
                'code' => 200,
                'message' => 'Request success'
            ];
        } else {
            $response = [
                'code'      => 401,
                'message'   => 'Request fail'
            ];
        }
    } else {
        $response = [
            'code'      => 401,
            'error'     => 'Password is not the correct',
            'message'   => 'Request fail'
        ];
    }

    return $response;
}

function site_api_user_insert_contest($args = [])
{
    $args = shortcode_atts(array(
        'url' => '',
    ), $args);

    $errors = [];

    if($args['url'] == '' || site_validation_url($args['url']) == false) {
        $errors['url'] = 'Incorrect URL';
    }

    $user = site_api_get_current_user();

    $time = current_time('U');
    $contest_expires = (int) get_user_meta($user->ID, 'contest_expires', true);
    if($contest_expires > $time) {
        $response = [
            'code' => 401,
            'error' => 'YOUR CONTEST ENDED',
            'message' => 'Request fail'
        ];

        return $response;
    }

    if (count($errors) == 0) {
        $info = site_user_get_info($user, 'info');

        $args['user_id'] = $user->ID;
        $args['title'] = $info['name'];

        // user contest
        $post_id = site_contest_insert_post($args, $user);

        if ($post_id > 0) {
            $value = site_user_get_new_expires('contest'); // Expires v1.1
            update_user_meta($user->ID, 'contest_expires', $value);

            $contest_count = (int) get_user_meta($user->ID, 'contest_count', true);
            update_user_meta($user->ID, 'contest_count', $contest_count + 1);

            // user history
            site_user_history_insert_item([
                'user_id'   => $user->ID,
                'name'      => 'insert contest',
                'post_type' => 'contest',
                'post_id'   => $post_id
            ]);

            $response = [
                'code' => 200,
                'message' => 'Request success'
            ];
        } else {
            $response = [
                'code'      => 401,
                'error'     => 'Insert data fail',
                'message'   => 'Request fail'
            ];
        }
    } else {
        $response = [
            'code'      => 401,
            'error'    => $errors,
            'message' => 'Request fail'
        ];
    }

    return $response;
}

function site_api_user_forgot($args = [])
{
    extract(shortcode_atts(array(
        'email' => '',
    ), $args));

    $errors = [];

    if($email == '' || site_validation_email($email) == false) {
        $errors['email'] = 'User is not exists';
    } else {
        $user = site_user_get_data_by('email', $email);
        if(empty($user->ID)) {
            $errors['email'] = 'User is not exists';
        }
    }

    if(count($errors) == 0) {
        $code = site_hasher_get_code();

        $hashed = site_hasher_get_pass( $code );

        $key_saved = wp_update_user(
            array(
                'ID'                  => $user->ID,
                'user_activation_key' => $hashed,
            )
        );

        if($key_saved) {
            if(site_api_get_lang() == 'en') {
                $message = sprintf("Hi %s,\n\nWe received your request for a single-use code to use with your account.\n\nYour single-use code is: %s\n\nIf you didn't request this code, you can safely ignore this email. Someone else might have typed your email address by mistake.\n\nThanks", $email, $code);
            } else {
                $message = sprintf("Chào %s,\n\nChúng tôi đã nhận được yêu cầu của bạn về mã sử dụng một lần để sử dụng với tài khoản của bạn.\n\nMã sử dụng một lần của bạn là: %s.\n\nNếu bạn không yêu cầu mã này, bạn có thể bỏ qua email này một cách an toàn. Có thể người khác đã nhập nhầm địa chỉ email của bạn.\n\nCảm ơn", $email, $code);
            }

            $subject = __('Reset password', 'site');

            if(wp_mail($email, $subject, $message)) {
                $response = [
                    'code' => 200,
                    'message' => 'Request success'
                ];
            } else {
                $response = [
                    'code'    => 401,
                    'error'    => 'Send mail fail',
                    'message' => 'Request fail'
                ];
            }
        } else {
            $response = [
                'code'    => 401,
                'error'    => 'Create code fail',
                'message' => 'Request fail'
            ];
        }
    } else {
        $response = [
            'code'    => 401,
            'error'    => $errors,
            'message' => 'Request fail'
        ];
    }

    return $response;
}

function site_api_user_verify_newpass($args = [])
{
    $data = shortcode_atts(array(
        'code'  => 0,
        'email' => '',
        'newpassword' => '',
    ), $args);

    $data = array_map('sanitize_text_field', $data);

    $errors = site_validation_data($data, [
        'code'      => 'min:111111',
        'email'     => 'email',
        'newpassword' => 'required',
    ]);

    if(count($errors) == 0) {
        extract($data);

        $user = site_user_get_data_by('email', $email);
        if(empty($user->user_login)) {
            $errors[] = 'User is not exists';
        } else {
            $result = check_password_reset_key( $code, $user->user_login );
            if ( is_wp_error( $result ) ) {
                $errors[] = 'Incorrect code';
            } else {
                wp_set_password($newpassword, $user->ID);

                update_user_meta($user->ID, 'reset-pass-at', current_time('U'));

                $response = [
                    'code' => 200,
                    'message' => 'Request success'
                ];
            }
        }
    }

    if(count($errors) > 0) {
        $response = [
            'code'    => 401,
            'error'    => $errors,
            'message' => 'Request fail'
        ];
    }

    return $response;
}

function site_api_user_phone_sms($args = [])
{
    // Disable on staging
    // if(defined('ISSTG') && ISSTG == true) {
    //     return [
    //         'code' => 200,
    //         'message' => 'No verify on staging'
    //     ];
    // }

    $data = shortcode_atts(array(
        'phone'     => '',
    ), $args);

    $errors = site_validation_data($data, [
        'phone'     => 'phone:exists',
    ]);

    if(count($errors) == 0) {
        extract($data);

        $code = site_hasher_get_code();

        $hashed = site_hasher_get_pass($code);

        if(update_option('activation_'. $phone, $hashed) == false) {
            $errors[] = 'Create code fail';
        } else if($_SERVER['REMOTE_ADDR'] === '::1'){
            // Testing on local
            return [
                'code' => 200,
                'data' => $code,
                'message' => 'Testing on local'
            ];
        } else if(0 && function_exists('site_vietguys_api_send')){
            $json = site_vietguys_api_send($phone, $code);

            if(is_string($json) && $json != '') {
                $json = json_decode($json, true);

                // error : 0 la thanh cong, 1 co loi phat sinh
                $error = isset($json['error']) ? intval($json['error']) : -1;

                // error_code : Ma loi (neu co, danh sach ma o bang)
                if($error == 1 || isset($json['error_code'])) {
                    $errors[] = isset($json["log"]) ? $json["log"] : 'vgsms fail';
                } else {
                    $response = [
                        'code' => 200,
                        'message' => 'Request success',
                    ];
                }
            } else {
                $errors[] = 'vgsms send fail';
            }
        } else {
            // esms
            // $esms_settings = esms_get_settings();
            // $message = sprintf("%s la ma xac minh dang ky %s cua ban", $code, $esms_settings['brandname']);

            if(site_get_lang() == 'vi') {
                $message = sprintf("XYLITOL %d la ma xac minh cua ban tai https://lottexylitol.com.vn/. Vui long khong chia se ma voi bat ky ai.", $code);
            } else {
                $message = sprintf("XYLITOL %d is your OTP code at https://lottexylitol.com.vn/. Please do not share the OTP code with anyone.", $code);
            }

            $json = ['CodeResult' => '100'];

            $json = esms_send_single($phone, $message);

            if(empty($json['CodeResult']) || $json['CodeResult'] != '100') {
                $errors[] = isset($json["ErrorMessage"]) ? $json["ErrorMessage"] : 'esms fail';
            } else {
                $response = [
                    'code' => 200,
                    // 'data' => $message,
                    'message' => 'Request success',
                ];
            }
        }
    }

    if(count($errors) > 0) {
        $response = [
            'code'    => 401,
            'error'    => $errors,
            'message' => 'Request fail'
        ];
    }

    return $response;
}

function site_api_user_phone_verify($args = [])
{
    // Disable on staging
    // if(defined('ISSTG') && ISSTG == true) {
    //     return [
    //         'code' => 200,
    //         'message' => 'No verify on staging'
    //     ];
    // }

    $data = shortcode_atts(array(
        'code'      => '',
        'phone'     => '',
    ), $args);

    $errors = site_validation_data($data, [
        'code'      => 'min:111111',
        'phone'     => 'phone',
    ]);

    if(count($errors) == 0) {
        extract($data);

        $activation_key = get_option('activation_'. $phone, '');
        if($activation_key == '') {
            $errors[] = 'Activation key empty';
        } else if(site_hasher_check_pass($code, $activation_key) == false){
            $errors[] = 'Incorrect code';
        }
    }

    if(count($errors) > 0) {
        $response = [
            'code'    => 401,
            'error'    => $errors,
            'message' => 'Request fail'
        ];
    } else {
        $response = [
            'code' => 200,
            'message' => 'Request success'
        ];
    }

    return $response;
}
