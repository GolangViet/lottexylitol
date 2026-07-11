<?php
/*
* Creating a function to create our CPT
*/
function site_contest_init()
{
    register_post_type('contest', array(
        'labels' => array(
            'name'                => _x('Contests', 'Post Type General Name', 'site'),
            'singular_name'       => _x('Contest', 'Post Type Singular Name', 'site'),
            'menu_name'           => __('Contests', 'site'),
            'all_items'           => __('All Contests', 'site'),
            'view_item'           => __('View Contest', 'site'),
            'add_new_item'        => __('Add New Contest', 'site'),
            'add_new'             => __('Add New', 'site'),
            'edit_item'           => __('Edit Contest', 'site'),
            'update_item'         => __('Update Contest', 'site'),
            'search_items'        => __('Search Contest', 'site'),
            'not_found'           => __('Not Found', 'site'),
            'not_found_in_trash'  => __('Not found in Trash', 'site'),
        ),
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => false,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        // 'capabilities'       => ['delete_posts'],
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 30,
        // 'menu_icon'          => 'dashicons-list-view',
        'supports'           => array('title', 'excerpt')
    ));
}
add_action('init', 'site_contest_init');

function site_contest_get_posts($user_id = 0)
{
    $args = array(
        'post_type' => 'contest'
    );

    if($user_id > 0) {
        $args['author'] = $user_id;
    }
    
    // The Query.
    $the_query = new WP_Query($args);

    $list = array();

    if ($the_query->have_posts()) {
        $list = $the_query->posts;
    }

    return $list;
}

function site_contest_insert_post($args = [], $user = false)
{
    extract(shortcode_atts(array(
        'user_id' => 0,
        'title' => 'Photo Contest',
        'url' => '',
    ), $args));

    $data = array(
        'post_type' => 'contest',
        'post_title' => $title,
        'post_excerpt' => $url,
        'post_author' => $user_id,
    );

    if($user) {
        $info = site_user_get_info($user, 'answer');
        
        $data['post_content'] = base64_encode(json_encode($info));
    }

    $post_id = wp_insert_post($data);

    if(is_wp_error($post_id)){
        return 0;
    }

    return $post_id;
}