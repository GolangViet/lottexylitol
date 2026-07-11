<?php
defined('ABSPATH') or die();

function site_user_init()
{
    $roles_version_key = 'site_user_roles_version';

    $roles_version_value = (int) get_option($roles_version_key, 0);

    if ($roles_version_value < 1) {
        add_role('cdp', 'CDP', array('read' => true, 'level_0' => true));

        update_option($roles_version_key, 1);

        $roles_version_value = 1;
    }

    if ($roles_version_value < 1.1) {
        add_role('must-buy', 'Must Buy', array('read' => true, 'publish' => true, 'level_0' => true));

        update_option($roles_version_key, 1.1);
    }
}
add_action('admin_init', 'site_user_init');

function site_user_get_fields($map_data = [])
{
    $fields = [
        'display_name'  => 'name',
        'user_email'    => 'email',
        'user_nicename' => 'phone',
        'user_pass'     => 'password',
    ];

    if (count($map_data) > 0) {
        foreach ($fields as $key => $name) {
            $fields[$key] = isset($map_data[$name]) ? $map_data[$name] : '';
        }
    }

    return $fields;
}

function site_user_get_metas($map_data = [])
{
    $metas = [
        // 'phone_country',
        'address'  ,
        'city'     ,
        'gender'   ,
        'age'      ,
        'utm'      ,
        'cccd'     ,
    ];

    if(count($map_data)>0) {
        $fields = [];

        foreach ($metas as $name) {
            $fields[$name] = isset($map_data[$name]) ? $map_data[$name] : '';
        }

        return $fields;
    }

    return $metas;
}

function site_user_get_options($type = '', $key = null)
{
    $options = [];

    if($type == 'gender') {
        $options = [
            "0" => __("Male", 'site'),
            "1" => __("Female", 'site'),
            "2" => __("Other", 'site'),
        ];
    } else if($type == 'age') {
        $options = [
            "1" => "1 - 15",
            "2" => "16 - 20",
            "3" => "21 - 25",
            "4" => "26 - 30",
            "5" => "31 - 35",
            "6" => "36 - 40",
            "7" => "41 - 45",
            "8" => "46 - 50",
            "9" => "51 - 55",
            "10" => "56 - 60",
            "11" => "60 - 65",
            "12" => "66 - 70",
            "13" => "71 - 75",
            "14" => "76 - 80",
        ];
    } else if($type == 'city') {
        $options = [
            "1" => "Hà Nội",
            "2" => "TP. Hồ Chí Minh",
            "3" => "Hải Phòng",
            "4" => "Đà Nẵng",
            "5" => "Cần Thơ",
            "6" => "An Giang",
            "7" => "Bà Rịa-Vũng Tàu",
            "8" => "Bắc Giang",
            "9" => "Bắc Kạn",
            "10" => "Bạc Liêu",
            "11" => "Bắc Ninh",
            "12" => "Bến Tre",
            "13" => "Bình Định",
            "14" => "Bình Dương",
            "15" => "Bình Phước",
            "16" => "Bình Thuận",
            "17" => "Cà Mau",
            "18" => "Cao Bằng",
            "19" => "Đắk Lắk",
            "20" => "Đắk Nông",
            "21" => "Điện Biên",
            "22" => "Đồng Nai",
            "23" => "Đồng Tháp",
            "24" => "Gia Lai",
            "25" => "Hà Giang",
            "26" => "Hà Nam",
            "27" => "Hà Tĩnh",
            "28" => "Hải Dương",
            "29" => "Hậu Giang",
            "30" => "Hòa Bình",
            "31" => "Hưng Yên",
            "32" => "Khánh Hòa",
            "33" => "Kiên Giang",
            "34" => "Kon Tum",
            "35" => "Lai Châu",
            "36" => "Lâm Đồng",
            "37" => "Lạng Sơn",
            "38" => "Lào Cai",
            "39" => "Long An",
            "40" => "Nam Định",
            "41" => "Nghệ An",
            "42" => "Ninh Bình",
            "43" => "Ninh Thuận",
            "44" => "Phú Thọ",
            "45" => "Phú Yên",
            "46" => "Quảng Bình",
            "47" => "Quảng Nam",
            "48" => "Quảng Ngãi",
            "49" => "Quảng Ninh",
            "50" => "Quảng Trị",
            "51" => "Sóc Trăng",
            "52" => "Sơn La",
            "53" => "Tây Ninh",
            "54" => "Thái Bình",
            "55" => "Thái Nguyên",
            "56" => "Thanh Hóa",
            "57" => "Thừa Thiên - Huế",
            "58" => "Tiền Giang",
            "59" => "Trà Vinh",
            "60" => "Tuyên Quang",
            "61" => "Vĩnh Long",
            "62" => "Vĩnh Phúc",
            "63" => "Yên Bái",
        ];
    }

    if($key != null) {
        if(isset($options[$key])) {
            return $options[$key];
        }
        
        return '';
    }

    return $options;
}

/**
 * user: singup
 */
function site_user_singup($data = [])
{
    $fields = site_user_get_fields($data);

    $fields['user_login'] = site_user_generate_username();

    $fields['meta_input'] = site_user_get_metas($data);

    $user_id = wp_insert_user($fields);

    if (is_wp_error( $user_id ) ) {
        return 0;
    }

    return $user_id;
}

/**
 * user: update
 */
function site_user_update($data = [])
{
    $fields = site_user_get_fields($data);

    $fields['ID'] = $data['ID'];

    $user_id = wp_update_user($fields);

    $metas = site_user_get_metas($data);

    foreach($metas as $name => $value) {
        update_user_meta($user_id, $name, $value);
    }

	return $user_id;
}

/**
 * user: field_exists
 */
function site_user_field_exists($field = '', $value = '')
{
    $user = site_user_get_data_by($field, $value);
    if (is_object($user) && isset($user->ID)) {
        return $user->ID > 0;
    }

    return false;
}

/**
 * user: get_data_by
 */
function site_user_get_data_by($field = '', $value = '')
{
    if ($field === 'email') {
        // user_email
        return get_user_by('email', $value);
    } else if ($field === 'phone') {
        // user_nicename
        return get_user_by('slug', $value);
    } else if ($field === 'login') {
        // user_login
        return get_user_by('login', $value);
    }

    return false;
}

/**
 * user: get_info_by
 */
function site_user_get_info_by($field = '', $value = '')
{
    $info = [];

    $user = site_user_get_data_by($field, $value);
    if (is_object($user) && isset($user->ID)) {
        $info = site_user_get_info($user);
    }

    return $info;
}

/**
 * user: get_info_by
 */
function site_user_get_info($user = false, $type = '')
{
    $info = [];

    if (is_object($user) && isset($user->ID)) {
        $excludes = ['user_pass'];

        foreach (site_user_get_fields() as $user_field => $name) {
            if (!in_array($user_field, $excludes)) {
                $info[$name] = isset($user->$user_field) ? $user->$user_field : '';
            }
        }

        foreach (site_user_get_metas() as $name) {
            $info[$name] = get_user_meta($user->ID, $name, true);
        }
        
        $avatar_id = (int) get_user_meta($user->ID, 'avatar_id', true);
        if($avatar_id > 0) {
            $info['avatar_url'] = wp_get_attachment_image_url($avatar_id, 'medium');
        } else {
            $info['avatar_url'] = get_avatar_url($user->ID);
        }

        // get option value 
        if ($type == 'info' || $type == 'answer') {
            foreach (['city', 'age', 'gender'] as $name) {
                if ($info[$name] != '') {
                    $info[$name] = site_user_get_options($name, $info[$name]);
                }
            }
        }
        
        $activity_options = site_user_get_activity_options();

        foreach ($activity_options as $name) {
            if ($type == 'info' || $type == $name) {
                $info = site_user_set_meta_by($user->ID, $info, $name);
            }
        }

        if ($type == 'info' || $type == 'gift') {
            $info['gift_count'] = (int) get_user_meta($user->ID, 'gift_count', true);
        }

        if ($type == 'info') {
            $info['point'] = (int) get_user_meta($user->ID, 'point', true);
        }

        $info = apply_filters('site_user_get_info', $info, $user, $type);
    }

    return $info;
}

function site_user_generate_username()
{
    return 'lotter-' . current_time('U') . rand(1000,9999);
}

function site_user_personal_options($profile_user)
{
    $user = wp_get_current_user();
    if ( !in_array( 'administrator', $user->roles ) ) {
        return;
    }

    if ( !in_array( 'subscriber', $profile_user->roles ) ) {
        return;
    }

    $info = site_user_get_info($profile_user, 'info');

    $fields = [
        'phone' => 'Phone',
        'city' => 'City',
        'age' => 'Age', 
        'gender' => 'Gender',
        'cccd' => 'CCCD',
    ];

    $activity_options = site_user_get_activity_options();
    foreach ($activity_options as $name) {
        $label = str_replace('_', ' ', $name);

        $fields[$name . '_expires'] = ucwords($label . ' expires');
        $fields[$name . '_count'] = ucwords($label . ' count');
    }

    foreach($fields as $key => $label):
    ?>
        <tr>
            <th scope="row"><?php _e($label); ?></th>
            <td><input type="text" value="<?php isset($info[$key]) ? esc_attr_e($info[$key]) : ''; ?>" class="regular-text code" /></td>
        </tr>
    <?php
    endforeach;
}
add_action('personal_options', 'site_user_personal_options');

function site_user_set_meta_by($user_id, $info = [], $name = '')
{
    $prefix = $name . '_';

    $info[$prefix . 'expires'] = (int) get_user_meta($user_id, $prefix . 'expires', true);

    if($name == 'game') {
        $info[$prefix . 'play_start'] = (int) get_user_meta($user_id, $prefix . 'play_start', true);
    }

    return $info;
}

function site_user_get_activity_options()
{
    return [
        'survey',
        'survey_brand',
        'contest',
        'game',
    ];
}

function site_user_get_new_expires($name = '')
{
    $data = [
        'survey'        => '+6 months',
        'survey_brand'  => '+1 month',
        'contest'       => '+3 months',
        'game'          => '+2 weeks',
    ];

    if ($name != '') {
        return strtotime(isset($data[$name]) ? $data[$name] : '+1 year');
    }

    return $data;
}

function site_user_action_updated_option($option, $old_value, $value)
{
    $activity_options = site_user_get_activity_options();

    $delete_all = true;

    foreach ($activity_options as $name) {
        if ($option == $name . '_start' || $option == $name . '_stop') {
            if ($old_value != $value) {
                delete_metadata('user', 0, $name . '_expires', '', $delete_all);
                delete_metadata('user', 0, $name . '_count', '', $delete_all);

                if ($name == 'game') {
                    delete_metadata('user', 0, $name . '_play_start', '', $delete_all);
                }
            }

            break;
        }
    }
}
add_action('updated_option', 'site_user_action_updated_option', 10, 3);