<?php
defined('ABSPATH') or die();

function site_api_must_buy_get_setting($key = '')
{
    $setting = [
        // 'token_expire' => 20 * MINUTE_IN_SECONDS,
        
        'token_expire' => MONTH_IN_SECONDS,

        'max_input_error' => 5,
        
	    // Nhap toi da {value} code 1 ngay
	    'max_code_in_day' => -1, // {value} = -1 : unlimited
    ];

    if(isset($setting[$key])) {
        return $setting[$key];
    }

    return $setting;
}

function site_api_must_buy_verify_code($args = [])
{
    $user = site_api_get_current_user();

    $response = site_api_must_buy_check_lock($user);

    if(is_array($response)) return $response;

    $info = site_user_get_info($user, 'info');

    $code = isset($args['code']) ? sanitize_text_field($args['code']) : '';

    if($code == '') {
        return [
            'code'      => 400,
            'error'     => 4,
            'message'   => 'Code empty'
        ];
    }

    if($code == $info['lucky_code']) {
        return [
            'code'      => 200,
            'message'   => 'This code you are using'
        ];
    }

    $lucky = Lucky_Lotte::instance(['user_id' => $user->ID]);

    $code_item = $lucky->get_code(['code' => $code]);

    if(empty($code_item['status'])) {
        $fields = array(
			"name" => '',
			"email" => '',
			"phone" => '',
			"address" => '',
			"city" => '',
			"age" => '',
		);

        site_api_must_buy_update_input_error($user);

        $lucky_input_error = (int) site_lucky_lotte_get_meta($user->ID, 'input_error', 0);

        $input_error_info = $user_info = shortcode_atts($fields, $info);

        $input_error_info["error_times"] = $lucky_input_error;
        
        // log input code error
        $lucky->insert_history([
            'action' => 'code-error',
            'description' => $code,
            'user_info' => $input_error_info,
        ]);

        if(site_api_must_buy_is_locked_user($user)) {            
            // log user locked
            $lucky->insert_history([
                'action' => 'user-locked',
                'description' => $code,
                'user_info' => $user_info,
            ]);
        }

        return [
            'code'      => 404,
            'error'     => 4,
            'message'   => 'Code does not exist'
        ];
    }

    if($code_item['user_id'] > 0 && $code_item['user_id'] != $user->ID) {
        return [
            'code'      => 403,
            'error'     => 1,
            'message'   => 'Code already used'
        ];
    }

    if(in_array($code_item['status'], $lucky->get_code_status_used())) {
        return [
            'code'      => 403,
            'error'     => 1,
            'message'   => 'This code you have used'
        ];
    }

    $lucky->update_code(['status' => 'fill-blank'], ['code' => $code]);

    update_user_meta($user->ID, 'lucky_status', 'fill-blank');

    site_lucky_lotte_update_meta($user->ID, [
        'code' => $code,
        'code_entered_time' => current_time('mysql'),
        'step' => 'fill-blank',
        'input_error' =>  0, // reset
    ]);

    $response = [
        'code' => 200,
        'message' => 'Request success'
    ];

    return $response;
}

function site_api_must_buy_fill_blank($args = [])
{
    $user = site_api_get_current_user();

    $response = site_api_must_buy_check_lock($user);

    if(is_array($response)) return $response;

    extract(shortcode_atts([
        'answers' => '',
    ], $args));

    $response = [
        'code' => 400,
        'message' => 'Request fail',
    ];

    $data = explode('.', $answers);

    $count = count($data);

    if($count < 4) {
        // $response['error'] = 'Value invalid';

        return $response;
    }

    $token = $data[0];
    unset($data[0]);

    $question_index = $data[$count - 2];
    $time = end($data);

    if($time < time() || hash_equals($token, hash_hmac('sha256', implode('.', $data), 'fill-blank-' . $time)) == false) {
        // $response['error'] = 'Token invalid';

        return $response;
    }

    $info = site_user_get_info($user, 'info');

    if($info['lucky_step'] == 'fill-blank' && $info['lucky_code'] != '') {
        $lucky = Lucky_Lotte::instance(['user_id' => $user->ID]);

        $lucky->update_code(['status' => 'lucky'], ['code' => $info['lucky_code']]);

        update_user_meta($user->ID, 'lucky_status', 'lucky');

        site_lucky_lotte_update_meta($user->ID, ['step' => 'lucky']);

        // log input code error
        $lucky->insert_history([
            'action' => 'fill-blank',
            'description' => $info['lucky_code'] . ' - question ' . $question_index,
            'user_info' => $info,
        ]);

        $response = [
            'code' => 200,
            'message' => 'Request success'
        ];
    }

    return $response;
}

function site_api_must_buy_lucky()
{
    $user = site_api_get_current_user();

    $response = site_api_must_buy_check_lock($user);

    if(is_array($response)) return $response;

    $info = site_user_get_info($user, 'info');

    if($info['lucky_step'] != 'lucky' || empty($info['lucky_code'])) {
        return [
            'code' => 400,
            'message' => 'Request fail'
        ];
    }

    $lucky = Lucky_Lotte::instance(['user_id' => $user->ID]);

    $response = $lucky->random_gift([
        'code' => $info['lucky_code'],
        'code_entered_time' => site_lucky_lotte_get_meta($user->ID, 'code_entered_time', ''),
    ]);

    if(empty($response['result']) || $response['result'] == false) {
        // popup chuc may man lan sau
        if($response['code'] == 404) {
            site_lucky_lotte_clear_user_meta_lucky($user->ID);

            $response['code'] = 200;
        }

        unset($response['result']);

        return $response;
    }

    $result = $response['result'];

    $gift = $lucky->get_gift(['id' => $result['gift_id']]);
    if(empty($gift['id'])) {
        return [
            'code' => 400,
            'message' => 'Gift fail'
        ];
    }

    $data = '';

    if($gift['title'] != 'try again') {
        $gift['user_code'] = $result['user_code'];

        $data = site_api_must_buy_get_gift_html($gift);
    }

    update_user_meta($user->ID, 'lucky_status', 'completed');

    $response = [
        'code' => 200,
        'data' => $data,
        'message' => 'Request success'
    ];

    return $response;
}

function site_api_must_buy_luxury()
{
    $user = site_api_get_current_user();

    if(empty($user->roles) || in_array('administrator', $user->roles) == false) {
        return [
            'code' => 403,
            'message' => 'No permission to run',
        ];
    }

    $lucky = Lucky_Lotte::instance(['user_id' => $user->ID]);

    $response = $lucky->random_luxury();

    if($response['code'] != 200 || empty($response['result'])) {
        return $response;
    }

    $result = $response['result'];

    $data = [
        // 'phone' => substr($result['user_phone'], 0, 3) . '****' . substr($result['user_phone'], -3),
        'phone' => $result['user_phone'],
        'code'  => $result['user_code'],
    ];

    $response = [
        'code' => 200,
        'data' => $data,
        'message' => 'Request success'
    ];

    return $response;
}

function site_api_must_buy_get_luxury()
{
    $user = site_api_get_current_user();

    if(empty($user->roles) || in_array('administrator', $user->roles) == false) {
        return [
            'code' => 403,
            'message' => 'No permission to run',
        ];
    }

    $lucky = Lucky_Lotte::instance(['user_id' => $user->ID]);

    $items = $lucky->get_list_luxury();

    $response = [
        'code' => 200,
        'items' => $items,
        'message' => 'Request success'
    ];

    return $response;
}

function site_api_must_buy_history()
{
    $lang = site_get_lang();

    $user = site_api_get_current_user();

    $lucky = Lucky_Lotte::instance(['user_id' => $user->ID]);

    $results = $lucky->get_results([
        'user_id' => $user->ID,
        'orderby' => 'created',
    ]);

    $items = [];

    // Giai xe xin den tay
    $list_luxury = $lucky->get_list_luxury([
        'user_id' => $user->ID,
    ]);

    if(count($list_luxury) > 0) {
        foreach($list_luxury as $item) {
            if($lang == 'en') {
                $content = 'You have won the <span class="des-survey c-green">Xe Xịn Đến tay</span>';
            } else {
                $content = 'Bạn đã trúng <span class="des-survey c-green">Xe Xịn Đến Tay</span>';
            }

            $items[] = [
                'content' => $content,
                'created' => $item['created'],
            ];

            break;
        }
    }

    if(count($results) > 0) {
        $gifts = $lucky->get_gifts();

        foreach($results as $item) {
            if(empty($gifts[$item['gift_id']])) continue;

            $gift = $gifts[$item['gift_id']];

            if($lang == 'en') {
                if($gift['title'] == 'try again') {
                    $content = 'No chance of winning yet. See you next time.';
                } else {
                    $content = 'You have won the <span class="des-survey c-green">'. (isset($gift['name_en']) ? $gift['name_en'] : $item['name'] ) .'</span>';
                }
            } else {
                if($gift['title'] == 'try again') {
                    $content = 'Chưa có cơ hội trúng thưởng. Hẹn bạn lần sau nhé.';
                } else {
                    $content = 'Bạn đã trúng <span class="des-survey c-green">'. $gift['name'] .'</span>';
                }
            }

            $items[] = [
                'content' => $content,
                // 'created' => site_get_date($item['created']),
                'created' => $item['created'],
            ];
        }
    }

    $response = [
        'code' => 200,
        'items' => $items,
        'message' => 'Request success'
    ];

    return $response;
}

function site_api_must_buy_testing($args = [])
{
    return ['code' => 400, 'message' => 'Request fail'];

    $user = get_user_by('ID', 93);

    $lucky = Lucky_Lotte::instance(['user_id' => $user->ID]);

    $rates_before = $rates = $lucky->get_rates();

    $response = [
        // 'rates_before' => $rates_before,
        'rates' => $rates,
        'code' => 200,
        // 'data' => $data,
        'message' => 'Request success'
    ];

    return $response;
}

/** all functions support */
function site_api_must_buy_get_gift_html($gift = [])
{
    $lang = site_api_get_lang();

    $sub = $lang == 'en' ? '_en' : '';
    $heading = $lang == 'en' ?  'CONGRATULATIONS' : 'XIN CHÚC MỪNG';

    $info = [
        'title'         => 'title' . $sub,
        'image'         => 'image' . $sub,
        'description'   => 'description' . $sub,
        'user_code'     => 'user_code',
    ];

    foreach($info as $key => $name) {
        $info[$key] = isset($gift[$name]) ? $gift[$name] : '';
    }

    // if($info['user_code'] != '') {
    //     $label = $lang == 'en' ? 'Prize Code' : 'Mã số trúng thưởng';
    //     $info['description'] .= "\n<small>({$label}: {$info['user_code']})</small>";
    // }

    $html = '<div id="'.hash_hmac('sha256', 'time:' . time(), 'gift-html').'">';
    $html .= '<div class="u-mb-20 lucky-title">'.$heading.'</div>';
    $html .= '<div class="lucky-text">'.nl2br($info['title']).'</div>';
    $html .= '<div class="lucky-image"><img src="/assets/img/about-must-buy/'.$info['image'].'" alt="" /></div>';

    if($gift['type'] == 'lucky-card') {
        $html .= '<div class="u-mb-20 lucky-text-3">'. $info['description'] .'</div>';
    } else {
        $html .= '<div class="u-mt-20 u-mb-20 lucky-text-2">'. nl2br($info['description']) .'</div>';
    }

    $html .= '</div>';

    $html = site_jwt_authentication_base64_url_encode(urlencode($html));

    return $html;
}

function site_api_must_buy_check_lock($user)
{
    if(site_api_must_buy_is_locked_user($user)) {
        return [
            'code'      => 400,
            'error'     => 2,
            'message'   => 'Lock user'
        ];
    }

    return null;
}

function site_api_must_buy_update_input_error($user, $type = 'increase')
{
    $input_error = (int) site_lucky_lotte_get_meta($user->ID, 'input_error', 0);

    if($type == 'reset') {
        $input_error = 0;
    } else {
        $input_error += 1;
    }

    return site_lucky_lotte_update_meta($user->ID, ['input_error' => $input_error]);
}

function site_api_must_buy_is_locked_user($user = null)
{
    if(is_object($user) && isset($user->ID)) {
        $user_id = $user->ID;
    } else {
        $user_id = (int) $user;
    }

    if($user_id == 0) return true;

    $lucky_input_error = (int) site_lucky_lotte_get_meta($user_id, 'input_error', 0);

    return $lucky_input_error >= site_api_must_buy_get_setting('max_input_error');
}

function site_api_must_buy_filter_user_get_info($info = [], $user = null)
{
    if(empty($user) || empty($user->ID)) return $info;

    if(site_api_must_buy_is_locked_user($user->ID)) {
        $info['lucky_step'] = 'lock';
        $info['lucky_code'] = '';
    } else {
        $info['lucky_step'] = site_lucky_lotte_get_meta($user->ID, 'step', '');
        $info['lucky_code'] = site_lucky_lotte_get_meta($user->ID, 'code', '');

        if($info['lucky_step'] == '') {
            $info['lucky_step'] = 'start';
        }

        if(is_array($user->roles) && in_array('administrator', $user->roles)) {
            $info['lucky_luxury'] = strtotime('+1 hours');
        }
    }

    return $info;
}
add_filter('site_user_get_info', 'site_api_must_buy_filter_user_get_info', 10, 3);

function site_api_must_buy_user_personal_options($profile_user)
{
    $user = wp_get_current_user();
    if ( !in_array( 'administrator', $user->roles ) ) {
        return;
    }

    ?>
    <tr>
        <th scope="row"><?php esc_attr_e('Lucky Bottle Lock'); ?></th>
        <td>
            <?php
                if(site_api_must_buy_is_locked_user($profile_user)) {
                    $url = add_query_arg(['user_id' => $profile_user->ID, 'lucky-bottle-unlock' => wp_create_nonce('lucky-bottle-unlock')]);

                    printf('<a href="%s"><b>%s</b></a>', esc_url($url), __('Locked', 'site') );
                } else {
                    esc_attr_e('None', 'site');
                }
            ?>
        </td>
    </tr>
    <?php
}
// add_action('personal_options', 'site_api_must_buy_user_personal_options', 5, 1);

function site_api_must_buy_admin_init()
{
    $data = wp_unslash($_REQUEST);

    if(!empty($data['user_id']) && !empty($data['lucky-bottle-unlock']) && wp_verify_nonce($data['lucky-bottle-unlock'], 'lucky-bottle-unlock')) {
        $uri = explode('?', $_SERVER['REQUEST_URI']);

        unset($data['lucky-bottle-unlock']);

        if(site_lucky_lotte_update_meta($data['user_id'], ['input_error' => 0]))
        {
            $data['unlock'] = 'success';
        }

        wp_redirect(add_query_arg($data, $uri[0]));
        exit();
    }
}
// add_action('admin_init', 'site_api_must_buy_admin_init');

/** clear user meta after random_gift */
function site_lucky_lotte_clear_user_meta_lucky($user_id = 0)
{
    if($user_id > 0) {
        site_lucky_lotte_update_meta($user_id, ['code' => '', 'code_entered_time' => '', 'step' => '']);
    }
}
add_action('class_lucky_lotte_random_gift_completed', 'site_lucky_lotte_clear_user_meta_lucky');

function site_lucky_lotte_update_meta($user_id = 0, $new_data = [])
{
    $data = (array) site_lucky_lotte_get_meta($user_id);

    if(count($new_data) > 0) {
        $count = 0;

        foreach($new_data as $key => $value) {
            if(isset($data[$key]) && $data[$key] != $value) {
                $data[$key] = $value;

                $count++;
            }
        }

        if($count > 0 && update_user_meta($user_id, 'lucky_data', $data)) {
            global $lucky_meta_data;

            $lucky_meta_data = $data;

            return true;
        }
    }

    return false;
}

function site_lucky_lotte_get_meta($user_id = 0, $key = '', $default = '')
{
    global $lucky_meta_data;

    if (empty($lucky_meta_data)) {
        $data = shortcode_atts([
            'code' => '',
            'code_entered_time' => current_time('mysql'),
            'step' => '',
            'input_error' => 0,
        ], (array) get_user_meta($user_id, 'lucky_data', true));

        $lucky_meta_data = $data;
    } else {
        $data = $lucky_meta_data;
    }

    // if(empty($data['code'])) {}

    if ($key != '') {
        if (isset($data[$key])) {
            return $data[$key];
        }

        return $default;
    }

    return $data;
}

/**
 * Menu: Settings -> Discussion
 *
 * wp-admin/options-discussion.php
 */
function site_lucky_lotte_admin_options_discussion()
{
    $option_page = 'discussion';

    /**
	 * Heading: site
	 */
	add_settings_field(
		'heading_custom',
		'<h2 class="title" id="'.$option_page.'-settings">' . __( 'Lucky Bottle Settings', 'site' ) . ':</h2>',
		function(){ echo ''; },
		$option_page,
		'default',
		array()
	);

    /**
	 * field: luxury_user_ids
	 */
	register_setting(
		$option_page,
		'luxury_user_ids'
	);

	add_settings_field(
		'luxury_user_ids',
		__( 'Users', 'site' ) . ' (xexindentay)',
		function(){
            $user_ids = get_option('luxury_user_ids', '');

			echo '<input value="'.esc_attr(trim($user_ids)).'" id="luxury_user_ids" name="luxury_user_ids">' . "\n";
		},
		$option_page,
		'default',
		array( 'label_for' => 'luxury_user_ids' )
	);
	// End `luxury_user_ids`
}
add_action('admin_init', 'site_lucky_lotte_admin_options_discussion', 90);
