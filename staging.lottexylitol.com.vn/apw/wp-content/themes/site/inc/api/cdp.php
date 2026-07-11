<?php
defined('ABSPATH') or die();

function site_api_cdp_get_surveys($args = [])
{
    $args = shortcode_atts(array(
        'day' => '',
        'limit' => 0,
        'paged' => 1,
        'last_days' => 0,
    ), $args);

    // cau hinh rieng cho cdp
    $survey_ids = get_option('cdp_survey_ids', '');

    // neu chua co se lay setting cua trang survey
    if(is_string($survey_ids) && $survey_ids == '') {
        $survey_ids = site_admin_setting_get_values('survey_id');
    }

    if(is_array($survey_ids)) {
        $survey_ids = implode(',', $survey_ids);
    }

    $args['survey_id'] = $survey_ids;

    $data = site_answer_get_items($args);

    $response = [
        'code' => 200,
        'total_items' => $data['total_items'],
        'total_pages' => $data['total_pages'],
        'limit' => (int) $args['limit'],
        'items' => $data['items'],
        'message' => 'Request success'
    ];

    return $response;
}

function site_api_cdp_get_users($args = [])
{
    $args = shortcode_atts(array(
        'user_status' => '',
        'limit' => 0,
        'paged' => 1,
        'last_days' => 0,
    ), $args);

    if ($args['user_status'] === 'deleted') {
        $data = site_user_delete_get_items($args);

        $response = [
            'code' => 200,
            'total_items' => $data['total_items'],
            'total_pages' => $data['total_pages'],
            'limit'     => (int) $args['limit'],
            'items'     => $data['items'],
            'message' => 'Request success'
        ];

        if(isset($data['results'])) {
            $response['results'] = $data['results'];
        }
    } else {
        $response = [
            'code'      => 401,
            'message'   => 'Request fail'
        ];
    }

    return $response;
}

function site_api_cdp_get_users_activities($args = [])
{
    $args = shortcode_atts(array(
        'day' => '',
        'limit' => 0,
        'paged' => 1,
    ), $args);

    $args['post_type'] = true;

    $data = site_user_history_get_activities($args);

    $response = [
        'code' => 200,
        'total_items' => $data['total_items'],
        'total_pages' => $data['total_pages'],
        'limit'     => (int) $args['limit'],
        'items'     => $data['items'],
        'message' => 'Request success'
    ];

    return $response;
}

/**
 * Lucky Bottle 
 */
function site_api_cdp_get_lucky_spins($args = [])
{
    if (class_exists('Lucky_Lotte') == false) {
        return site_api_cdp_get_template_response(500);
    }

    $params = shortcode_atts(array(
        'user_id' => '',
        'from_date' => '',
        'to_date' => '',
        'reward_type' => '',
        'limit' => 0,
        'paged' => 1,
        'last_days' => 0,
    ), $args);

    $params = array_map('sanitize_text_field', $params);

    extract($params);

    $lucky = Lucky_Lotte::instance();

    $filters = [];

    $errors = [];

    $gifts = $lucky->get_gifts(['type' => 'not empty']);
    if (count($gifts) > 0 && $reward_type != '') {

        // use to version 1.0
        if ($reward_type == 'gold-card') {
            $reward_type = 'lucky-card';
        }

        $gift_ids = [];

        foreach ($gifts as $id => $gift) {
            if ($gift['type'] == $reward_type) {
                $gift_ids[] = $id;
            } else if (empty($errors['type'])) {
                $errors['type'] = 1;
            }
        }

        $filters['gift_ids'] = $gift_ids;
    }

    if ($last_days > 0) {
        $filters['from'] = date('Y-m-d', strtotime('-' . $last_days . ' days'));
        $to_date = '';
    } else if ($from_date != '') {
        $filters['from'] = $from_date;

        if (preg_match('/^(\d{4}-\d{2}-\d{2})$/', $from_date) == false) {
            $errors['from'] = 1;
        }
    }

    if ($to_date != '') {
        $filters['to'] = $to_date;

        if (preg_match('/^(\d{4}-\d{2}-\d{2})$/', $from_date) == false) {
            $errors['to'] = 1;
        }
    }

    if ($user_id != '') {
        $filters['user_id'] = (int) str_replace('user_', '', $user_id);

        if ($filters['user_id'] == 0) {
            $errors['user_id'] = 1;
        }
    }

    // if (count($errors) > 0) {
    //     return site_api_cdp_get_template_response(400);
    // }

    $items = [];

    $total_items = 0;

    if ($limit > 0) {
        if ($paged < 1) {
            $paged = 1;
        }

        $total_items = (int) $lucky->count_results($filters);

        $filters['limit']   = $limit;
        $filters['offset']  = ($paged - 1) * $limit;
    }

    $results = $lucky->get_results($filters);

    if (count($results) > 0) {
        foreach ($results as $result) {
            $item = shortcode_atts(array(
                'user_id' => 0,
                'user_name' => '',
                'user_email' => '',
                'user_phone' => '',
            ), $result);

            $item['code_entered_time'] = !empty($result['code_entered_time']) ? $result['code_entered_time'] : '';

            $gift_id = (int) $result['gift_id'];

            // Gift info
            $gift = !empty($gifts[$gift_id]) ? $gifts[$gift_id] : [];

            $item['reward_id'] = !empty($gift['id']) ? $gift['id'] : '';
            $item['reward_name'] = !empty($gift['name']) ? $gift['name'] : '';
            $item['reward_type'] = !empty($gift['type']) ? $gift['type'] : '';
            $item['reward_time'] = !empty($result['created']) ? $result['created'] : '';

            $items[] = $item;
        }
    }

    $data = [
        'items' => $items,
        'total_items' => count($items),
        'total_pages' => 1,
        'limit' => count($items),
    ];

    if ($total_items > 0) {
        $data['limit'] = (int) $limit;
        $data['total_items'] = $total_items;
        $data['total_pages'] = ceil($total_items / $limit);
    }

    return site_api_cdp_get_template_response(200, $data);
}

function site_api_cdp_get_lucky_users___new($args = [])
{
    if (class_exists('Lucky_Lotte') == false) {
        return site_api_cdp_get_template_response(500);
    }

    $params = shortcode_atts(array(
        'user_id' => '',
        'email' => '',
        'limit' => 0,
        'paged' => 1,
        'last_days' => 0,
    ), $args);

    $params = array_map('sanitize_text_field', $params);

    extract($params);

    $filters = [];

    if ($user_id != '') {
        $user_id = (int) str_replace('user_', '', $user_id);

        if($user_id > 0) {
            $filters['user_id'] = $user_id;
        }
    }

    if (empty($filters['user_id']) && $email != '') {
        $user = get_user_by('email', $email);

        if (!empty($user->ID)) {
            $filters['user_id'] = $user->ID;
        }
    }
    
    if ($last_days > 0){
        $filters['from'] = date('Y-m-d', strtotime('-' . $last_days . ' days'));
    }

    $lucky = Lucky_Lotte::instance();

    $gifts = $lucky->get_gifts();

    $items = [];

    $total_items = 0;

    if ($limit > 0) {
        if ($paged < 1) {
            $paged = 1;
        }

        $total_items = (int) $lucky->count_results($filters);

        $filters['limit']   = $limit;
        $filters['offset']  = ($paged - 1) * $limit;
    }

    $results = $lucky->get_results($filters);

    $users = [];

    if (count($results) > 0) {
        foreach ($results as $result) {
            $user_id = $result['user_id'] = (int) $result['user_id'];

            if (!empty($users[$user_id])) {
                $user = $users[$user_id];
            } else {
                $user = shortcode_atts(array(
                    'user_id' => 0,
                    'user_name' => '',
                    'user_email' => '',
                    'user_phone' => '',
                ), $result);
            }

            $rewards = !empty($user['rewards_received']) ? $user['rewards_received'] : [];
            $first_spin_time = !empty($user['first_spin_time']) ? $user['first_spin_time'] : $result['created'];
            $last_spin_time = !empty($user['last_spin_time']) ? $user['last_spin_time'] : $result['created'];
            $total_spins = !empty($user['total_spins']) ? (int) $user['total_spins'] : 0;

            if ($first_spin_time > $result['created']) {
                $first_spin_time = $result['created'];
            }

            if ($last_spin_time < $result['created']) {
                $last_spin_time = $result['created'];
            }

            $gift_id = (int) $result['gift_id'];

            if (!empty($gifts[$gift_id])) {
                // Gift info
                $gift = $gifts[$gift_id];

                $rewards[] = [
                    'reward_id' => !empty($gift['id']) ? $gift['id'] : '',
                    'reward_name' => !empty($gift['name']) ? $gift['name'] : '',
                    'reward_type' => !empty($gift['type']) ? $gift['type'] : '',
                    'reward_time' => !empty($result['created']) ? $result['created'] : '',
                ];

                $total_spins += 1;
            }

            $user['spins_remaining'] = $spins_remaining;
            $user['total_spins'] = $total_spins;
            $user['first_spin_time'] = $first_spin_time;
            $user['last_spin_time'] = $last_spin_time;
            $user['rewards_received'] = $rewards;

            $users[$user_id] = $user;
        }

        foreach($users as $user) {
            $items[] = $user;
        }
    }

    $data = [
        'items' => $items,
        'total_items' => count($items),
        'total_pages' => 1,
        'limit' => count($items),
    ];

    if ($total_items > 0) {
        $data['limit'] = (int) $limit;
        $data['total_items'] = $total_items;
        $data['total_pages'] = ceil($total_items / $limit);
    }

    return site_api_cdp_get_template_response(200, $data);
}

function site_api_cdp_get_lucky_users($args = [])
{
    if (class_exists('Lucky_Lotte') == false) {
        return site_api_cdp_get_template_response(500);
    }

    global $wpdb;

    $table = $wpdb->prefix . 'lucky_results';

    $params = shortcode_atts(array(
        'user_id' => '',
        'email' => '',
        'limit' => 0,
        'paged' => 1,
        'last_days' => 0,
    ), $args);

    $params = array_map('sanitize_text_field', $params);

    extract($params);

    $wheres = [];

    $user_ids = [];

    if ($user_id != '') {
        $user_ids[] = (int) str_replace('user_', '', $user_id);
    }

    if ($email != '') {
        $user = get_user_by('email', $email);

        if (!empty($user->ID)) {
            $user_ids[] = $user->ID;
        }
    }

    if (count($user_ids) > 0) {
        $wheres[] = sprintf("user_id IN (%s)", implode(', ', $user_ids));
    }

    if ($last_days > 0){
        $day = date('Y-m-d', strtotime('-' . $last_days . ' days'));
        
        $wheres[] = "DATE_FORMAT(`created`, '%Y-%m-%d') >= '$day' ";
    }

    $where = '';

    if (count($wheres) > 0) {
        $where = ' WHERE ' . implode(' AND ', $wheres);
    }
    
    $group_by = ' GROUP BY `user_id` ORDER BY `id` ';

    $offset_limit = '';

    $total_items = 0;

    if ($limit > 0) {
        if ($paged < 1) {
            $paged = 1;
        }

        $offset_limit = sprintf(" LIMIT %d, %d", ($paged - 1) * $limit, $limit);

        $total_items = (int) $wpdb->get_var($wpdb->prepare('SELECT count(DISTINCT `user_id`) FROM %i ', $table) . $where);
    }

    $items = [];

    // The Query.
    $list = $wpdb->get_results($wpdb->prepare('SELECT * FROM %i ', $table) . $where . $group_by . $offset_limit, ARRAY_A);

    if (count($list) > 0) {
        $lucky = Lucky_Lotte::instance();

        $gifts = $lucky->get_gifts();

        foreach ($list as $item) {
            $user = shortcode_atts(array(
                'user_id' => 0,
                'user_name' => '',
                'user_email' => '',
                'user_phone' => '',
                'total_spins' => 0,
                'first_spin_time' => '',
                'last_spin_time' => '',
                'rewards_received' => [],
            ), $item);

            $user['user_id'] = (int) $user['user_id'];
            $user['spins_remaining'] = get_user_meta($user['user_id'], 'lucky_status', true) == 'completed' ? 0 : 1;

            $results = $lucky->get_results([
                'user_id' => $user['user_id'],
            ]);

            if (count($results) > 0) {
                foreach ($results as $result) {
                    $rewards = !empty($user['rewards_received']) ? $user['rewards_received'] : [];
                    $first_spin_time = !empty($user['first_spin_time']) ? $user['first_spin_time'] : $result['created'];
                    $last_spin_time = !empty($user['last_spin_time']) ? $user['last_spin_time'] : $result['created'];
                    $total_spins = !empty($user['total_spins']) ? (int) $user['total_spins'] : 0;

                    if ($first_spin_time > $result['created']) {
                        $first_spin_time = $result['created'];
                    }

                    if ($last_spin_time < $result['created']) {
                        $last_spin_time = $result['created'];
                    }

                    $gift_id = (int) $result['gift_id'];

                    if (!empty($gifts[$gift_id])) {
                        // Gift info
                        $gift = $gifts[$gift_id];

                        $rewards[] = [
                            'reward_id' => !empty($gift['id']) ? $gift['id'] : '',
                            'reward_name' => !empty($gift['name']) ? $gift['name'] : '',
                            'reward_type' => !empty($gift['type']) ? $gift['type'] : '',
                            'reward_time' => !empty($result['created']) ? $result['created'] : '',
                        ];

                        $total_spins += 1;
                    }

                    $user['total_spins'] = $total_spins;
                    $user['first_spin_time'] = $first_spin_time;
                    $user['last_spin_time'] = $last_spin_time;
                    $user['rewards_received'] = $rewards;
                }
            }

            $items[] = $user;
        }
    }

    $data = [
        'items' => $items,
        'total_items' => count($items),
        'total_pages' => 1,
        'limit' => count($items),
    ];

    if ($total_items > 0) {
        $data['limit'] = (int) $limit;
        $data['total_items'] = $total_items;
        $data['total_pages'] = ceil($total_items / $limit);
    }

    return site_api_cdp_get_template_response(200, $data);
}

function site_api_cdp_get_lucky_rewards($args = [])
{
    if (class_exists('Lucky_Lotte') == false) {
        return site_api_cdp_get_template_response(500);
    }

    $args;

    $lucky = Lucky_Lotte::instance();

    $gifts = $lucky->get_gifts();

    $list = [];

    if (count($gifts) > 0) {
        // if status = 0 is cancel prize
        $statistic_gifts = $lucky->statistic_results([
            'status' => 1
        ]);

        $total_all = 0;

        foreach ($gifts as $gift) {
            $total_all += $gift['total'];
        }

        foreach ($gifts as $gift_id => $gift) {
            // if($gift['type'] == '') continue;

            $remaining = (int) $gift['total'];
            
            if(!empty($statistic_gifts[$gift_id])) {
                $remaining -= intval($statistic_gifts[$gift_id]);
            }

            $list[] = [
                'reward_id' => $gift_id,
                'reward_name' => $gift['name'],
                'reward_type' => !empty($gift['type']) ? $gift['type'] : null,
                'reward_value' => !empty($gift['value']) ? $gift['value'] : null,
                "probability" => round($remaining / $total_all * 100, 2),
                "total_quantity" => (int) $gift['total'],
                "remaining_quantity" => $remaining,
                "status" => "active"
            ];
        }
    }

    return site_api_cdp_get_template_response(200, $list);
}

function site_api_cdp_get_template_response($code = 200, $data = [])
{

    if ($code == 400) {
        $response = [
            'code' => 400,
            // 'contents' => [
            //     'success' => 'false',
            //     'error' => 'Invalid parameters'
            // ],
            'message' => 'Bad request'
        ];
    } else if ($code == 500) {
        $response = [
            'code' => 500,
            // 'contents' => [
            //     'success' => 'false',
            //     'error' => 'Internal server error'
            // ],
            'message' => 'Server error'
        ];
    } else if (isset($data['total_items'])) {
        $response = [
            'code' => 200,
            'total_items'   => $data['total_items'],
            'total_pages'   => isset($data['total_pages']) ? $data['total_pages'] : null,
            'limit'         => isset($data['limit']) ? $data['limit'] : null,
            'items'         => isset($data['items']) ? $data['items'] : null,
            'message' => 'Success'
        ];
    } else {
        $response = [
            'code' => 200,
            // 'contents' => [
            //     'success' => 'true',
            //     'data' => $data,
            // ],
            'items' => $data,
            'message' => 'Success'
        ];
    }

    return $response;
}
