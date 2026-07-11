<?php
defined('ABSPATH') or die();
/*
* Creating a database
*/
function site_user_delete_admin_init()
{
    $user = wp_get_current_user();
    if ( ! in_array( 'administrator', $user->roles ) || get_option('tbuserdeleted') != '') {
        return;
    }

    $site_create_userdeleted = isset($_GET['site_create_userdeleted']) ? $_GET['site_create_userdeleted'] : 0;
    if( $site_create_userdeleted == date('Ymd') ) {
        site_user_delete_create_table();
    }

    add_settings_field(
		'site_userdeleted',
		__( 'User Deleted', 'site' ),
		function(){
            echo '<a href="'.add_query_arg(['site_create_userdeleted' => date('Ymd')]).'">Create Table</a>'; 
        },
		'reading',
		'default',
		array()
	);
}
add_action('admin_init', 'site_user_delete_admin_init');

function site_user_delete_create_table()
{
    global $wpdb;

    $sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}userdeleted` (
        `id` bigint NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `user_id` bigint NOT NULL,
        `user_login` varchar(60) NOT NULL,
        `phone` varchar(20) NOT NULL,
        `created` datetime NOT NULL
    );";

    update_option('tbuserdeleted', current_time('mysql'));

    return $wpdb->query($sql);
}

function site_user_delete_insert_item($data = [])
{
    global $wpdb;

    $tbl_userdeleted = $wpdb->prefix . 'userdeleted';

    $data = shortcode_atts(array(
        'user_id' => '',
        'user_login' => '',
        'phone' => '',
        'created' => '',
    ), $data);

    if($data['created'] == '') {
        $data['created'] = current_time('mysql');
    }

    $type = array_map(function(){ return '%s'; }, $data);

    $wpdb->insert(
        $tbl_userdeleted,
        $data,
        $type
    );
    
    return $wpdb->insert_id;
}

function site_user_delete_get_items($args = [])
{
    global $wpdb;

    $tbl_userdeleted = $wpdb->prefix . 'userdeleted';

    extract(shortcode_atts(array(
        'limit' => 0,
        'paged' => 1,
        'last_days' => 0,
    ), $args));

    $query = "SELECT * FROM $tbl_userdeleted";

    $where = '';

    $day = '';

    $wheres = [];

    if ($last_days > 0){
        $day = date('Y-m-d', strtotime('-' . $last_days . ' days'));
        
        $wheres[] = "DATE_FORMAT(`created`, '%Y-%m-%d') >= '$day' ";
    }

    if(count($wheres)>0) {
        $where = ' WHERE ' . implode(' AND ', $wheres);

        $query .= $where;
    }

    $total_items = 0;

    if($limit > 0) {
        if($paged < 1) {
            $paged = 1;
        }

        $query .= sprintf(" LIMIT %d, %d", ($paged - 1) * $limit, $limit);

        $total_items = (int) $wpdb->get_var($wpdb->prepare('SELECT count(*) FROM %i ' . $where, $tbl_userdeleted));
    }

    // The Query.
    $results = $wpdb->get_results($query, ARRAY_A);

    $list = array();

    if ( count($results)>0 ) {
        foreach ($results as $result) {
            $list[] = [
                'user_id'       => $result['user_id'],
                // 'user_login'    => $result['user_login'],
                'phone'         => $result['phone'],
                'created'       => $result['created'],
            ];
        }
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