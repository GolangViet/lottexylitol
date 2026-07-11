<?php
defined('ABSPATH') or die();

/*
* Creating a function to create our CPT
*/
function site_gift_init()
{
    register_post_type('gift', array(
        'labels' => array(
            'name'                => _x('Gifts', 'Post Type General Name', 'site'),
            'singular_name'       => _x('Gift', 'Post Type Singular Name', 'site'),
            'menu_name'           => __('Gifts', 'site'),
            'all_items'           => __('All Gifts', 'site'),
            'view_item'           => __('View Gift', 'site'),
            'add_new_item'        => __('Add New Gift', 'site'),
            'add_new'             => __('Add New', 'site'),
            'edit_item'           => __('Edit Gift', 'site'),
            'update_item'         => __('Update Gift', 'site'),
            'search_items'        => __('Search Gift', 'site'),
            'not_found'           => __('Not Found', 'site'),
            'not_found_in_trash'  => __('Not found in Trash', 'site'),
        ),
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        // 'show_in_rest'       => true,
        'menu_position'      => 30,
        'menu_icon'          => 'dashicons-awards',
        'supports'           => array('title', 'thumbnail')
    ));
}
add_action('init', 'site_gift_init');

function site_gift_get_posts($tax_slug = '')
{
    $args = array(
        'post_type' => 'gift'
    );

    if ($tax_slug != '') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'gift_cat',
                'field' => 'slug',
                'terms' => $tax_slug,
            ),
        );
    }

    // The Query.
    $the_query = new WP_Query($args);

    $list = array();

    if ($the_query->have_posts()) {
        foreach ($the_query->posts as $p) {
            $list[] = array(
                'id'    => $p->ID,
                'name'  => $p->post_title,
                'point' => site_point_format((int) get_post_meta($p->ID, "point", true)),
                'remaining' => (int) get_post_meta($p->ID, "remaining", true),
            );
        }
    }

    return $list;
}

function site_gift_add_meta_box($post_type)
{
    if ($post_type == 'gift') {
        add_meta_box(
            'acd_meta_box',
            __('Gift Data', 'site'),
            'site_gift_render_meta_box_content',
            $post_type,
            'advanced',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'site_gift_add_meta_box');

function site_gift_save_meta_box($post_id = 0)
{
    /*
     * We need to verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times.
     */
    if (get_post_type($post_id) != 'gift') {
        return $post_id;
    }

    // Check if our nonce is set.
    if (!isset($_POST['site_gift_box_nonce'])) {
        return $post_id;
    }

    $nonce = sanitize_text_field($_POST['site_gift_box_nonce']);

    // Verify that the nonce is valid.
    if (!wp_verify_nonce($nonce, 'site_gift_box')) {
        return $post_id;
    }

    /*
        * If this is an autosave, our form has not been submitted,
        * so we don't want to do anything.
        */
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    /* OK, it's safe for us to save the data now. */
    $point = isset($_POST['point']) ? sanitize_text_field($_POST['point']) : [];
    $total = isset($_POST['total']) ? sanitize_text_field($_POST['total']) : [];

    update_post_meta($post_id, "point", $point);
    update_post_meta($post_id, "total", $total);
}
add_action('save_post', 'site_gift_save_meta_box');

function site_gift_render_meta_box_content($post)
{
    // Add an nonce field so we can check for it later.
    wp_nonce_field('site_gift_box', 'site_gift_box_nonce');

    $point = (int) get_post_meta($post->ID, "point", true);
    $total = (int) get_post_meta($post->ID, "total", true);
    $remaining = (int) get_post_meta($post->ID, "remaining", true);

    ?>
        <table class="form-table" role="presentation">
            <tr>
                <th scope="row"><label><?php _e('Point', 'site') ?></label></th>
                <td>
                    <input value="<?php esc_attr_e($point) ?>" name="point" type="text" class="large-text" />
                </td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('Total', 'site') ?></label></th>
                <td>
                    <input value="<?php esc_attr_e($total) ?>" name="total" type="text" class="large-text" />
                </td>
            </tr>
            <tr>
                <th scope="row"><label><?php _e('Remaining', 'site') ?></label></th>
                <td>
                    <input value="<?php esc_attr_e($remaining) ?>" type="text" class="large-text" disabled />
                </td>
            </tr>
        </table>
    <?php
}

function site_gift_add_post_column($columns = array(), $post_type = '')
{
    if ($post_type == 'gift') {
        $list = array();

        foreach ($columns as $key => $column) {
            $list[$key] = $column;

            if ($key == 'title') {
                $list['point'] = __('Point', 'site');
                $list['total'] = __('Total', 'site');
                $list['remaining'] = __('Remaining', 'site');
            }
        }

        $columns = $list;
    }

    return $columns;
}

function site_gift_post_column($column = '', $post_id = 0)
{
    if (get_post_type($post_id) == 'gift') {
        switch ($column) {
            case 'point':
                $value = (int) get_post_meta($post_id, $column, true);
                esc_attr_e(site_point_format($value));
                break;

            case 'remaining':
            case 'total':
                $value = (int) get_post_meta($post_id, $column, true);

                esc_attr_e($value);
                break;
        }
    }
}

function site_gift_admin_init()
{
    add_filter('manage_posts_columns', 'site_gift_add_post_column', 10, 2);
    add_action('manage_posts_custom_column', 'site_gift_post_column', 10, 2);
}
add_action('admin_init', 'site_gift_admin_init');
