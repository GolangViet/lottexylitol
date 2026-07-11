<?php
defined('ABSPATH') or die();
/*
* Creating a database
*/
function site_user_history_admin_init()
{
    $user = wp_get_current_user();
    if ( ! in_array( 'administrator', $user->roles ) || get_option('tbuserhistory') != '') {
        return;
    }

    $site_create_userhistory = isset($_GET['site_create_userhistory']) ? $_GET['site_create_userhistory'] : 0;
    if( $site_create_userhistory == date('Ymd') ) {
        site_user_history_create_table();
    }

    add_settings_field(
		'site_userhistory',
		__( 'User History', 'site' ),
		function(){
            echo '<a href="'.add_query_arg(['site_create_userhistory' => date('Ymd')]).'">Create Table</a>'; 
        },
		'reading',
		'default',
		array()
	);
}
add_action('admin_init', 'site_user_history_admin_init');

function site_user_history_create_table()
{
    global $wpdb;

    $sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}userhistory` (
        `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `user_id` bigint NOT NULL,
        `name` varchar(500) NOT NULL,
        `description` text NULL,
        `post_title` text NULL,
        `post_type` varchar(50) NOT NULL,
        `post_id` bigint NOT NULL,
        `point` int NOT NULL,
        `created` datetime NOT NULL
    );";

    update_option('tbuserhistory', current_time('mysql'));

    return $wpdb->query($sql);
}

function site_user_history_get_fields($type = '')
{
    $fields = array(
        'user_id'   => 0,
        'name'      => '',
        'description' => '',
        'post_type' => '',
        'post_id'   => 0,
        'point'     => 0,
        'created'   => '',
    );

    if ($type == 'name') {
        $fields = array_keys($fields);
    }

    return $fields;
}

function site_user_history_insert_item($data = [])
{
    global $wpdb;

    $tbl_userhistory = $wpdb->prefix . 'userhistory';

    $fields = site_user_history_get_fields();

    $data = shortcode_atts($fields, $data);

    extract($data);

    if($post_type == 'survey') {
        $data['point'] = 5;
    } else if($post_type == 'gift') {
        $data['point'] = 0 - (int) get_post_meta($data['post_id'], "point", true);
    }
    
    if(in_array($data['post_type'], ['survey', 'gift'])) {
        $data['post_title'] = get_the_title($data['post_id']);
    } else if($data['post_type'] == 'contest') {
        $p = get_post($data['post_id']);
        $data['post_title'] = $p->post_excerpt;
    }

    if($data['created'] == '') {
        $data['created'] = current_time('mysql');
    }
    
    $type = array_map(function(){ return '%s'; }, $fields); 

    $wpdb->insert(
        $tbl_userhistory,
        $data,
        $type
    );

    // update user total point
    if($wpdb->insert_id > 0) {
        $query = "SELECT SUM(`point`) FROM $tbl_userhistory WHERE `user_id` = %s";

        $total = (int) $wpdb->get_var($wpdb->prepare($query, [$data['user_id']]));

        update_user_meta($data['user_id'], 'point', $total);

        // 
        if($post_type == 'gift') {
            // update_post_meta($data['post_id'], 'point', $total);
        }
    }
    
    return $wpdb->insert_id;
}

function site_user_history_get_items($args = [])
{
    global $wpdb;

    $tbl_userhistory = $wpdb->prefix . 'userhistory';

    extract(shortcode_atts(array(
        'user_id' => 0,
        'year' => '',
    ), $args));

    $query = "SELECT * FROM $tbl_userhistory";

    $wheres = [];

    if($user_id>0) {
        $wheres[] = "`user_id` = " . intval($user_id);
    }

    if($year!='') {
        $wheres[] = "DATE_FORMAT(`created`, '%Y') = " . intval($year);
    }

    if(count($wheres)>0) {
        $query .= ' WHERE ' . implode(' AND ', $wheres);
    }

    $query .= ' ORDER BY id DESC ';

    // The Query.
    $results = $wpdb->get_results($query, ARRAY_A);

    $list = array();

    if ( count($results)>0 ) {
        foreach ($results as $result) {
            $text = site_user_history_get_description($result);

            if($text != '') {
                $result['description'] = $text;
            }

            $list[] = [
                'name'          => $result['name'],
                'description'   => $result['description'],
                'created'       => site_get_date($result['created']),
            ];
        }
    }

    return $list;
}

function site_user_history_get_years($args = [])
{
    global $wpdb;

    extract(shortcode_atts(array(
        'user_id' => 0,
    ), $args));

    $query = "SELECT DATE_FORMAT(`created`, '%Y') AS `year` FROM `{$wpdb->prefix}userhistory` ";

    $wheres = [];

    if($user_id>0) {
        $wheres[] = "`user_id` = " . intval($user_id);
    }

    if(count($wheres)>0) {
        $query .= ' WHERE ' . implode(' AND ', $wheres);
    }

    $query .= ' GROUP BY `year` ORDER BY `year` ';

    return $wpdb->get_col($query, 0);
}

function site_user_history_get_activities($args = [])
{
    global $wpdb;

    $tbl_userhistory = $wpdb->prefix . 'userhistory';

    extract(shortcode_atts(array(
        'user_id' => 0,
        'day' => '',
        'limit' => 0,
        'paged' => 1,
    ), $args));

    $query = "SELECT * FROM $tbl_userhistory";

    $wheres = [ "name IN ('answer', 'game', 'insert contest')" ];

    if($user_id>0) {
        $wheres[] = "`user_id` = " . intval($user_id);
    }

    if(strpos($day, '-') > 0){
        $day = substr($day, 0, 10);

        $wheres[] = "DATE_FORMAT(`created`, '%Y-%m-%d') = '$day' ";
    }

    $where = '';
    
    if(count($wheres)>0) {
        $where = ' WHERE ' . implode(' AND ', $wheres);

        $query .= $where;
    }

    $query .= ' ORDER BY user_id ASC, id DESC ';

    $total_items = 0;

    if($limit > 0) {
        if($paged < 1) {
            $paged = 1;
        }

        $query .= sprintf(" LIMIT %d, %d", ($paged - 1) * $limit, $limit);

        $total_items = (int) $wpdb->get_var($wpdb->prepare('SELECT count(*) FROM %i ' . $where, $tbl_userhistory));
    }

    // The Query.
    $results = $wpdb->get_results($query, ARRAY_A);

    $list = array();

    if ( count($results)>0 ) {
        $survey_ids = site_admin_setting_get_values('survey_id');

        foreach ($results as $result) {
            $user_id = $result['user_id'];

            if(empty($list[$user_id])) {
                $list[$user_id] = [
                    "user_id" => $user_id,
                    "phone" => get_the_author_meta('user_nicename', $user_id),
                    "activities" => []
                ];
            }

            if($result['name'] == 'insert contest') {
                $activity = 'photo-contest';
            } else if($result['name'] == 'answer') {
                if(in_array($result['post_id'], $survey_ids)) {
                    $activity = 'survey';
                } else {
                    $activity = 'brand-ambassador';
                }
            } else {
                $activity = $result['name'];
            }

            $list[$user_id]["activities"][] = [
                "activity" => $activity,
                "joined_date" => $result['created']
            ];
        }

        $list = array_values($list);
    }

    $data = [
        'items' => $list,
        'total_items' => count($list),
        'total_pages' => 1,
    ];

    if($total_items > 0) {
        $data['total_items'] = $total_items;
        $data['total_pages'] = ceil($total_items / $limit);
    }

    return $data;
}

function site_user_history_get_description($result = [])
{
    extract($result);

    $value = '';

    $list = [
        // "answer" => "Take the survey %s",
        "answer" => "You have participated in the activity %s",
        "get gift" => "Use %s points to exchange for gift %s",
        "rate" => "Rate product %s",
        "game" => "Your score: %s",
        // "insert contest" => "Insert contest %s",
        "insert contest" => "You have participated in the activity %s",
        "update info" => "Update info",
    ];

    if (isset($list[$name])) {
        $text = __($list[$name], 'site');

        $text = str_replace('%s', '<span class="des-product c-green">%s</span>', $text);

        if ($name == 'get gift') {
            if($point < 0) $point = 0 - $point;

            $value = sprintf($text, $point, $post_title);
        } else if($name == 'game'){
            $data = explode(':', $result['description']);

            $value = sprintf($text, isset($data[1]) ? $data[1] : 0);
        } else {
            if(in_array($name,["answer"])) {
                if (site_get_lang()=='en' && function_exists('pll_get_post')) {
                    $post_id = pll_get_post($post_id, 'en');
                }

                $post_title = get_the_title($post_id);
            } else if($name == "insert contest") {
                $post_title = __('Photo Contest', 'site');
            }
            
            $value = sprintf($text, $post_title);
        }
    }

    return $value;
}

function site_user_history_delete_user($id = 0)
{
    if($id == 0) return ;

    global $wpdb;

    $wpdb->delete($wpdb->prefix . 'userhistory', array('user_id' => $id));
}
add_action('deleted_user', 'site_user_history_delete_user');