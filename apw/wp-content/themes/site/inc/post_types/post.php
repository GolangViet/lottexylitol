<?php
defined('ABSPATH') or die();

function site_post_json_save_post($post_id = 0, $post = null)
{
    /*
     * If this is an autosave, our form has not been submitted,
     * so we don't want to do anything.
     */
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    /* OK, it's safe for us to save the data now. */

    site_post_json_update_detail($post);

    $cat_slug = site_post_get_the_cat_slug($post);
    if ($cat_slug != '') {
        site_post_json_save_list($cat_slug);
    }
}
// add_action('save_post_post', 'site_post_json_save_post', 10, 2);

function site_post_json_post_updated($post_id = 0, $post_after = null, $post_before = null)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    if ($post_after == null || $post_before == null) {
        return $post_id;
    }

    /**
     * Remove old file
     */
    if ($post_after->post_name != $post_before->post_name) {
        $file = site_post_json_path('detail', $post_before->post_name);

        if (file_exists($file) && is_writable($file)) {
            @unlink($file);
        }
    }
}
// add_action('post_updated', 'site_post_json_post_updated', 10, 3);

function site_post_json_path($type = '', $name = '')
{
    global $site_news_folder;

    if(empty($site_news_folder)) {
        $site_news_folder = 'news';
    }

    $upload_dir = wp_upload_dir();

    $basedir = $upload_dir['basedir'] . '/' . $site_news_folder;
    if (!is_dir($basedir)) {
        @mkdir($basedir);
    }

    if($type != '') {
        $basedir .= '/' . $type;
        if (!is_dir($basedir)) {
            @mkdir($basedir);
        }    
    }

    if ($name != '') {
        $basedir .= "/{$name}.json";
    }

    return $basedir;
}

function site_post_json_get_file($type = '', $name = '', $output_type = 'data')
{
    $file = site_post_json_path($type, $name);

    if ($output_type == 'path') {
        return $file;
    }

    $content = '';

    if (file_exists($file)) {
        $content = file_get_contents($file);
    }

    if ($output_type == 'data') {
        $content = json_decode($content, true);
    }

    return $content;
}

function site_post_json_save_list($cat_slug = 'news', $paged = 1)
{
    // The Query.
    $the_query = new WP_Query([
        'post_status' => 'publish',
        'category_name' => $cat_slug,
        'posts_per_page' => get_option('posts_per_page'),
        'paged' => $paged
    ]);

    $max_num_pages = $the_query->max_num_pages;
    
    if ($paged == 1) {
        $old_data = site_post_json_get_file($cat_slug, 'page-' . $paged);

        if (isset($old_data['max_num_pages']) && $old_data['max_num_pages'] > $max_num_pages) {
            for ($i = $max_num_pages + 1; $i < $old_data['max_num_pages']; $i++) {
                $file = site_post_json_path($cat_slug, 'page-' . $i);

                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }
    }

    $items = array();

    if ($the_query->have_posts()) {
        foreach ($the_query->posts as $p) {
            $items[] = site_post_json_get_detail_fields('summary', $p);

            // export detail json
            site_post_json_update_detail($p);
        }
    }

    $data = [
        'items' => $items,
        'paged' => $paged,
        'total' => $the_query->found_posts,
        'max_num_pages' => $max_num_pages,
    ];

    site_file_update_content(site_post_json_path($cat_slug, 'page-' . $paged), json_encode($data));

    if ($paged < $max_num_pages) {
        $paged++;

        site_post_json_save_list($cat_slug, $paged);
    }
}

function site_post_json_get_detail_fields($type = '', $post = null)
{
    $fields = array(
        'title'     => '',
        'name'      => '',
        'status'    => '',
        'thumbnail' => '',
    );

    if ($type == 'detail') {
        $fields['content'] = '';
    } else if ($type == 'summary') {
        $fields = array_merge($fields, [
            'excerpt' => '',
            'cat_name' => '',
        ]);
    }

    $fields = array_merge($fields, [
        'date' => '',
    ]);

    if (is_object($post)) {
        if ($type == 'summary') {
            if ($post->post_excerpt == '') {
                $post->post_excerpt = $post->post_content;
            }

            $post->post_excerpt = wp_trim_words($post->post_excerpt, 30);

            $categories = get_the_category($post->ID);

            if (!empty($categories)) {
                $fields['cat_name'] = esc_html($categories[0]->name);
            }
        } else if ($type == 'detail') {
            if (function_exists('pll_get_post')) {
                foreach (['vi', 'en'] as $slug) {
                    $id = pll_get_post($post->ID, $slug);

                    if ($id > 0 && $id != $post->ID) {
                        $fields['name_' . $slug] = get_post_field('post_name', $id);
                    }
                }
            }
        }

        $post->post_thumbnail = get_the_post_thumbnail_url($post, 'thumbnail');

        foreach ($fields as $key => $value) {
            $name = 'post_' . $key;

            $fields[$key] = isset($post->$name) ? $post->$name : $value;
        }
    }

    return $fields;
}

function site_post_json_delete_files()
{
    $news_dir = site_post_json_path();

    if(is_dir($news_dir) == false) return false;

    $folders = glob($news_dir . '/*', GLOB_ONLYDIR);
    
    $deleted = [];
    
    foreach($folders as $dir) {
        $files = glob($dir . '/*');

        foreach($files as $file) {
            if(@unlink($file)){
                $deleted[] = $file;
            }
        }

        @rmdir($dir);
    }

    @rmdir($news_dir);

    return count($deleted) > 0;
}

function site_post_json_update_detail($post = null)
{
    $update = false;

    $file = site_post_json_path('detail', $post->post_name);

    if ($post->post_status == 'publish') {
        $data = site_post_json_get_detail_fields('detail', $post);

        $list = get_post_meta($post->ID, '_wp_old_slug');
        if(is_array($list) && count($list)>0) {
            foreach($list as $old_name) {
                if($old_name != '' && $old_name != $post->post_name) {
                    $old_file = site_post_json_path('detail', $old_name);
                    if (file_exists($old_file)) {
                        @unlink($old_file);
                    }
                }
            }
        }

        $update = site_file_update_content($file, json_encode($data));
    } else if (file_exists($file)) {
        @unlink($file);
    }

    return $update;
}

function site_post_get_the_cat_slug($post = null)
{
    $categories = get_the_category($post);
    if (!empty($categories)) {
        return $categories[0]->slug;
    }

    return '';
}

function site_post_admin_bulk_actions($bulk_actions = [])
{
    $bulk_actions['export_json'] = __('Export JSON', 'external-image');

    return $bulk_actions;
}

function site_post_admin_action_export_json()
{
    global $pagenow;

    if(empty($pagenow) || $pagenow != 'edit.php') return;

    add_filter('bulk_actions-edit-post', 'site_post_admin_bulk_actions');
    
    $export_json  = isset($_REQUEST['export_json']) ? sanitize_text_field($_REQUEST['export_json']) : '';
    $post_type  = isset($_REQUEST['post_type']) ? sanitize_text_field($_REQUEST['post_type']) : '';
    $action     = isset($_REQUEST['action']) ? sanitize_text_field($_REQUEST['action']) : '';

    if($export_json != '') {
        $action = 'export_json';
    }
    
    if ($action == 'export_json' && $post_type == 'post') {

        site_custom_lock(true, 'export_json');

        // current news folder
        $news_dir = site_post_json_path();

        global $site_news_folder;

        $site_news_folder = 'news-backup';
        site_post_json_delete_files();

        // change folder name news-updating
        $site_news_folder = 'news-updating';
        site_post_json_delete_files();

        $notices = ' update at (' . current_time('mysql') .')';

        // use folders of static html
        $cat_slugs = [
            'tin-tuc',
            'news'
        ];

        $all_statuses = get_post_stati([], 'names');
        unset($all_statuses['publish']);

        foreach($cat_slugs as $cat_slug) {
            site_post_json_save_list($cat_slug);

            // delete post not publish
            $list = get_posts([
                'post_status' => array_values($all_statuses)
            ]);

            if(count($list) > 0) {
                foreach($list as $p) {
                    $file = site_post_json_path('detail', $p->post_name);

                    if (file_exists($file)) {
                        @unlink($file);
                    }
                }
            }
        }

        $code = 400;

        // backup current news
        if(rename($news_dir, $news_dir . '-backup')) {
            // change update news to news
            if(rename($news_dir . '-updating', $news_dir))
            {
                $code = 200;

                // remove all backup news
                $site_news_folder = 'news-backup';
                site_post_json_delete_files();

                $notices .= ' to (' . current_time('mysql') .')';
            } else {
                $notices = 'Rename folder [news-updating] to [news] fail!';
            }
        } else {
            $notices = 'Rename folder [news] to [news-backup] fail!';
        }

        // return folder name news
        $site_news_folder = 'news';

        site_custom_lock(false, 'export_json');

        update_user_meta(get_current_user_id(), 'export_json_notices', $code . ':' . $notices);

        wp_redirect(admin_url('edit.php'));
        exit();
    }
}
add_action('admin_init', 'site_post_admin_action_export_json');

function site_post_admin_notice_export_json()
{
    $user_id = get_current_user_id();

    $notices = get_user_meta($user_id, 'export_json_notices', true);

    if($notices !='') {
        $code = 200;

        // if(str_contains($notices, ':')) {
        //     list($code, $message) = explode(':', $notices, 2);
        // } else {
        //     $message = $notices;
        // }
        
        $html = '<div class="notice notice-'.($code == 200 ? 'success' : 'warning').' is-dismissible">';
        $html .= '<p>' . __('Export JSON Success', 'site') . "</p>";
        $html .= '</div>';

        echo $html;

        update_user_meta($user_id, 'export_json_notices', '');
    }
}
add_action('admin_notices', 'site_post_admin_notice_export_json');

function site_post_manage_posts_extra_tablenav($which = 'top')
{
    // global $pagenow;

    // if(empty($pagenow) || $pagenow != 'edit.php') return;

    echo '<div class="alignleft actions">';

    submit_button( __( 'Export JSON' ), 'secondary', 'export_json', false, array( 'id' => 'export-json' ) );

    echo '</div>';
}
// add_action('manage_posts_extra_tablenav', 'site_post_manage_posts_extra_tablenav');