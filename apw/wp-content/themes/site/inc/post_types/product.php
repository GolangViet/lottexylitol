<?php

function site_product_init()
{
    register_taxonomy('product_cat', 'product', array(
        'labels' => array(
            'name'                       => _x('Product Categories', 'site'),
            'singular_name'              => _x('Product Category', 'site'),
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

    register_post_type('product', array(
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
        'menu_icon'          => 'dashicons-products',
        'supports'           => array('title'),
        'labels' => array(
            'name'                => _x('Products', 'Post Type General Name', 'site'),
            'singular_name'       => _x('Product', 'Post Type Singular Name', 'site'),
            'menu_name'           => __('Products', 'site'),
            'all_items'           => __('All Products', 'site'),
            'view_item'           => __('View Product', 'site'),
            'add_new_item'        => __('Add New Product', 'site'),
            'add_new'             => __('Add New', 'site'),
            'edit_item'           => __('Edit Product', 'site'),
            'update_item'         => __('Update Product', 'site'),
            'search_items'        => __('Search Product', 'site'),
            'not_found'           => __('Not Found', 'site'),
            'not_found_in_trash'  => __('Not found in Trash', 'site'),
        ),
    ));
}

add_action('init', 'site_product_init');

function site_product_get_terms($getChildren = false)
{
    $list = [];
    $items = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false]);
    if (empty($items)) {
        return $list;
    }

    foreach ($items as $item) {
        if ($item->parent == 0) {
            $children = [];
            foreach ($items as $sub_item) {
                if ($item->term_id == $sub_item->parent) {
                    $children[] = [
                        'name'        => $sub_item->name,
                        'slug'        => $sub_item->slug,
                        'id'          => $sub_item->term_id,
                        'description' => $sub_item->description,
                        'products'    => site_product_get_posts($sub_item->slug),
                        'general'     => get_field('general', site_product_category_get_id($sub_item->term_id)),
                        'css_class'   => get_field('css_class', site_product_category_get_id($sub_item->term_id)),
                    ];
                }
            }

            $list[] = [
                'children'  => $children,
                'slug'      => $item->slug,
                'name'      => $item->name,
                'id'        => $item->term_id,
                'general'   => get_field('general', site_product_category_get_id($item->term_id)),
                'css_class' => get_field('css_class', site_product_category_get_id($item->term_id)),
            ];
        }
    }

    return $list;
}

function site_product_category_get_id($id)
{
    return "product_cat_{$id}";
}

function site_product_get_posts($tax_slug = '')
{
    $args = ['post_type' => 'product'];
    if ($tax_slug != '') {
        $args['tax_query'] = [['taxonomy' => 'product_cat', 'field' => 'slug', 'terms' => [$tax_slug]]];
    }

    $list = [];
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
        foreach ($the_query->posts as $p) {
            $item = [
                'vn_group'      => [],
                'en_group'      => [],
                'id'            => $p->ID,
                'name'          => $p->post_title,
            ];
            if (function_exists('get_field')) {
                $item['vn_group'] = get_field('vn_group', $p->ID);
                $item['en_group'] = get_field('en_group', $p->ID);
            }

            $list[] = $item;
        }
    }

    return $list;
}

function site_product_enter_title_here($text = '', $post = null)
{
    if ($post->post_type == 'product') {
        $text = __('Title', 'site');
    }

    return $text;
}
add_filter('enter_title_here', 'site_product_enter_title_here', 10, 2);

function site_product_restrict_manage_posts($post_type = '', $which = '')
{
    if ($post_type != 'product' || $which != 'top') {
        return;
    }

    $tax = 'product_cat';
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
add_action('restrict_manage_posts', 'site_product_restrict_manage_posts', 10, 2);

function site_product_add_meta_box($post_type)
{
    if ($post_type != 'product') {
        return;
    }

    add_meta_box(
        'acd_meta_box',
        __('Product Custom Data', 'site'),
        'site_product_render_meta_box_content',
        $post_type,
        'advanced',
        'high'
    );
}
//add_action('add_meta_boxes', 'site_product_add_meta_box');

function site_product_render_meta_box_content($post = null)
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

function site_product_custom_add_post_column($columns = array(), $post_type = '')
{
    if ($post_type == 'product') {
        $list = array();
        foreach ($columns as $key => $column) {
            $list[$key] = $column;
            if ($key == 'title') {
                $list['product-status'] = __('Product Status', 'site');
            }
        }

        $columns = $list;
    }

    return $columns;
}

function site_product_custom_post_column($column = '', $post_id = null)
{
    if (get_post_type($post_id) == 'product' && $column == 'product-status') {
        if ($post_id == get_option('product_id')) {
            echo '<span class="dashicons dashicons-saved"></span>';
        }
    }
}

function site_product_admin_init()
{
    add_filter('manage_posts_columns', 'site_product_custom_add_post_column', 10, 2);
    add_action('manage_posts_custom_column', 'site_product_custom_post_column', 10, 2);
}
// add_action('admin_init', 'site_product_admin_init');
