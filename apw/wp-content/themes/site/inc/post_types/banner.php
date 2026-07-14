<?php

function site_banner_init()
{
    register_taxonomy('banner_cat', 'banner', array(
        'labels' => array(
            'name'                       => _x('Banner Categories', 'site'),
            'singular_name'              => _x('Banner Category', 'site'),
            'search_items'               => __('Search Category', 'site'),
            'popular_items'              => __('Popular Category', 'site'),
            'all_items'                  => __('All Categories', 'site'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => __('Edit Category', 'site'),
            'update_item'                => __('Update Category', 'site'),
            'add_new_item'               => __('Add New Category', 'site'),
            'new_item_name'              => __('New Category Name', 'site'),
            'separate_items_with_commas' => __('Separate Category with commas', 'site'),
            'add_or_remove_items'        => __('Add or remove Category', 'site'),
            'choose_from_most_used'      => __('Choose from the most used Category', 'site'),
            'not_found'                  => __('No Category found.', 'site'),
            'menu_name'                  => __('Categories', 'site'),
        ),
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'hierarchical'          => true,
        'has_archive'           => false,
        'public'                => false,
    ));

    register_post_type('banner', array(
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 30,
        'menu_icon'          => 'dashicons-format-image',
        'supports'           => array('title'),
        'labels' => array(
            'name'                => _x('Banners', 'Post Type General Name', 'site'),
            'singular_name'       => _x('Banner', 'Post Type Singular Name', 'site'),
            'menu_name'           => __('Banners', 'site'),
            'all_items'           => __('All Banners', 'site'),
            'view_item'           => __('View Banner', 'site'),
            'add_new_item'        => __('Add New Banner', 'site'),
            'add_new'             => __('Add New', 'site'),
            'edit_item'           => __('Edit Banner', 'site'),
            'update_item'         => __('Update Banner', 'site'),
            'search_items'        => __('Search Banner', 'site'),
            'not_found'           => __('Not Found', 'site'),
            'not_found_in_trash'  => __('Not found in Trash', 'site'),
        ),
    ));
}

add_action('init', 'site_banner_init');

function site_banner_get_terms()
{
    $list = [];
    $items = get_terms(['taxonomy' => 'banner_cat', 'hide_empty' => false]);
    if (empty($items)) {
        return $list;
    }

    foreach ($items as $item) {
        if ($item->parent == 0) {
            $children = [];
            foreach ($items as $sub_item) {
                if ($item->term_id == $sub_item->parent) {
                    $children[] = [
                        'name'  => $sub_item->name, 'slug'  => $sub_item->slug, 'description'  => $sub_item->description,
                    ];
                }
            }

            $list[] = ['name' => $item->name, 'slug' => $item->slug, 'children' => $children];
        }
    }

    return $list;
}

function site_banner_get_posts($tax_slug = '')
{
    $args = ['post_type' => 'banner'];
    if ($tax_slug != '') {
        $args['tax_query'] = [['taxonomy' => 'banner_cat', 'field' => 'slug', 'terms' => [$tax_slug]]];
    }

    $list = [];
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
        foreach ($the_query->posts as $p) {
            $item = [
                'desktop_image' => '',
                'desktop_url'   => '',
                'mobile_image'  => '',
                'mobile_url'    => '',
                'id'            => $p->ID,
                'name'          => $p->post_title,
            ];
            if (function_exists('get_field')) {
                $item['mobile_image'] = get_field_object('mobile_image', $p->ID);
                $item['desktop_image'] = get_field_object('desktop_image', $p->ID);
                $item['mobile_url'] = (string) get_field('mobile_url', $p->ID);
                $item['desktop_url'] = (string) get_field('desktop_url', $p->ID);
            }

            $list[] = $item;
        }
    }

    return $list;
}

function site_banner_enter_title_here($text = '', $post = null)
{
    if ($post->post_type == 'banner') {
        $text = __('Title', 'site');
    }

    return $text;
}
add_filter('enter_title_here', 'site_banner_enter_title_here', 10, 2);

function site_banner_restrict_manage_posts($post_type = '', $which = '')
{
    if ($post_type != 'banner' || $which != 'top') {
        return;
    }

    $tax = 'banner_cat';
    $dropdown_options = [
        'hide_empty'      => 0,
        'hierarchical'    => 1,
        'show_count'      => 0,
        'name'            => $tax,
        'taxonomy'        => $tax,
        'value_field'     => 'slug',
        'orderby'         => 'name',
        'show_option_all' => get_taxonomy($tax)->labels->all_items,
        'selected'        => isset($_GET[$tax]) ? trim($_GET[$tax]) : '',
    ];

    echo '<label class="screen-reader-text" for="cat">' . get_taxonomy($tax)->labels->filter_by_item . '</label>';

    wp_dropdown_categories($dropdown_options);
}
add_action('restrict_manage_posts', 'site_banner_restrict_manage_posts', 10, 2);

function site_banner_add_meta_box($post_type)
{
    if ($post_type != 'banner') {
        return;
    }

    add_meta_box(
        'acd_meta_box',
        __('Banner Custom Data', 'site'),
        'site_banner_render_meta_box_content',
        $post_type,
        'advanced',
        'high'
    );
}
//add_action('add_meta_boxes', 'site_banner_add_meta_box');

function site_banner_render_meta_box_content($post = null)
{
?>
    <table class="form-table" role="presentation">
        <tbody>
            <tr class="row">
                <td scope="row"><label><?php _e('Phone', 'site') ?></label></td>
                <td>
                    <input
                        type="text"
                        value="<?php esc_attr_e($post->post_excerpt) ?>"
                        name="post_excerpt"
                        class="large-text" />
                </td>
            </tr>
            <tr class="row">
                <td scope="row"><label><?php _e('City', 'site') ?></label></td>
                <td>
                    <textarea
                        name="post_content"
                        class="large-text"><?php esc_html_e($post->post_content) ?></textarea>
                </td>
            </tr>
        </tbody>
    </table>
<?php
}

function site_banner_custom_add_post_column($columns = array(), $post_type = '')
{
    if ($post_type == 'banner') {
        $list = array();
        foreach ($columns as $key => $column) {
            $list[$key] = $column;
            if ($key == 'title') {
                $list['banner-status'] = __('Banner Status', 'site');
            }
        }

        $columns = $list;
    }

    return $columns;
}

function site_banner_custom_post_column($column = '', $post_id = null)
{
    if (get_post_type($post_id) == 'banner' && $column == 'banner-status') {
        if ($post_id == get_option('banner_id')) {
            echo '<span class="dashicons dashicons-saved"></span>';
        }
    }
}

function site_banner_admin_init()
{
    add_filter('manage_posts_columns', 'site_banner_custom_add_post_column', 10, 2);
    add_action('manage_posts_custom_column', 'site_banner_custom_post_column', 10, 2);
}
// add_action('admin_init', 'site_banner_admin_init');
