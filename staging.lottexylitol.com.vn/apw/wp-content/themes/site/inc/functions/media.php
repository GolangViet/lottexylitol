<?php
defined('ABSPATH') or die();

function site_upload_dir($list) {
    
    $upload_name = 'uploads';
    
    $list['basedir']    = dirname(ABSPATH)      . '/' . $upload_name;
    $list['baseurl']    = dirname(home_url())   . '/' . $upload_name;
    $list['path']       = $list['basedir'] . $list['subdir'];
    $list['url']        = $list['baseurl'] . $list['subdir'];

	return $list;
}
add_filter('upload_dir', 'site_upload_dir');

function site_wp_get_attachment_url($url) {
	return str_replace(home_url(), dirname(home_url()), $url);
}
// add_filter('wp_get_attachment_url', 'site_wp_get_attachment_url');

function site_wp_get_attachment_image_src($image = []) {
    
    if(isset($image[0]) && is_string($image[0])) {
        $image[0] = site_wp_get_attachment_url($image[0]);
    }

	return $image;
}
// add_filter('wp_get_attachment_image_src', 'site_wp_get_attachment_image_src');

function site_media_manager_html()
{
    $current_url  = set_url_scheme('//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    $images = site_media_get_posts();

    ob_start();
    if (count($images) > 0) : ?>
        <div class="image-manager">
            <?php
            foreach ($images as $p) {
                echo '<div class="card" style="width: 10rem;">';
                echo '<a href="' . $p->guid . '" target="_blank">' . wp_get_attachment_image($p->ID, 'thumbnail', false, ['style' => 'margin-right: 10px;', 'class' => 'card-img-top']) . '</a>';
                echo '<div class="card-body"><h5 class="card-title">'. $p->post_title .'</h5></div>';
                echo '</div>';
            }
            ?>
        </div>
    <?php
    endif;
    ?>
    <form method="post" class="g-3 needs-validation" enctype="multipart/form-data">
        <input type="hidden" name="site_action_upload" value="<?php echo wp_create_nonce('upload_nonce') ?>">
        <input type="hidden" name="redirect_to" value="<?php echo $current_url ?>">
        <div class="mb-3">
            <label for="formFile" class="form-label">Choose an image</label><br>
            <input class="form-control" type="file" id="formFile" name="media" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Data base64</label><br>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="media_content"></textarea>
        </div>
        <button type="submit" name="action" value="upload" class="btn btn-primary">Upload</button>
    </form>
    <?php

    return ob_get_clean();
}

function site_media_submit()
{
    if (!is_user_logged_in()) {
        return;
    }

    if (isset($_POST['site_action_upload'])) {
        $redirect_to = esc_url(sanitize_text_field(isset($_REQUEST['redirect_to']) ? $_REQUEST['redirect_to'] : home_url()));

        if (wp_verify_nonce($_POST['site_action_upload'], 'upload_nonce')) {

            if (isset($_FILES['media']) && isset($_FILES['media']['name']) && $_FILES['media']['name'] != '') {
                $upload_dir = wp_upload_dir();

                $file = $upload_dir['path'] . '/' . $_FILES['media']['name'];

                if (copy($_FILES['media']['tmp_name'], $file)) {
                    site_media_save($file);

                    wp_redirect($redirect_to . '?msg=upload-success');
                    exit();
                }
            } else if (isset($_POST['media_content']) && $_POST['media_content'] != '') {

                site_media_save_file($_POST['media_content']);

                wp_redirect($redirect_to . '?msg=upload-base64-success');
                exit();
            }

            wp_redirect($redirect_to . '?msg=upload-fail');
            exit();
        }

        wp_redirect($redirect_to . '?msg=token-fail');
        exit();
    }
}
// add_action('wp', 'site_media_submit');

function site_media_save_file($content = '', $user_id = 0, $parent_post_id = 0)
{
    // $content = 'data:image/png;base64,iVBO==';

    $upload_dir = wp_upload_dir();

    $ext = site_media_get_image_extension($content);
    if($ext == '') {
        return false;
    }

    $decoded = site_media_get_base64_decode($content);
    if($decoded == '') {
        return false;
    }

    $filename = 'media-' . $user_id . '-' . time() . '.' . $ext;
    
    $file = $upload_dir['path'] . '/' . $filename;

    file_put_contents($file, $decoded);

    return site_media_save($file, $user_id, $parent_post_id);
}

function site_media_save($filename = '', $user_id = 0, $parent_post_id = 0)
{
    // Check the type of file. We'll use this as the 'post_mime_type'.
    $filetype = wp_check_filetype(basename($filename), null);

    // Get the path to the upload directory.
    $wp_upload_dir = wp_upload_dir();

    // Prepare an array of post data for the attachment.
    $attachment = array(
        'guid'           => $wp_upload_dir['url'] . '/' . basename($filename),
        'post_mime_type' => $filetype['type'],
        'post_title'     => preg_replace('/\.[^.]+$/', '', basename($filename)),
        'post_content'   => '',
        'post_status'    => 'inherit'
    );

    if ($user_id > 0) {
        $attachment['post_author'] = $user_id;
    }

    // Insert the attachment.
    $attach_id = wp_insert_attachment($attachment, $filename, $parent_post_id);

    // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    // Generate the metadata for the attachment, and update the database record.
    $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
    wp_update_attachment_metadata($attach_id, $attach_data);

    if ($parent_post_id > 0) {
        set_post_thumbnail($parent_post_id, $attach_id);
    }

    return $attach_id;
}

function site_media_manager_in_content()
{
    if (is_user_logged_in()) {
        return site_media_manager_html();
    }

    return '';
}
// add_shortcode('site_media_manager', 'site_media_manager_in_content');

function site_media_get_posts($user_id = 0)
{
    $list = get_posts([
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'author' => $user_id,
    ]);


    return $list;
}

function site_media_get_image_extension($file_content = '')
{
    $list = explode(';', str_replace('data:', '', $file_content));

    $image_types = [
        'image/png'     => 'png',
        'image/jpeg'    => 'jpg',
        'image/gif'     => 'gif',
    ];

    return isset($image_types[$list[0]]) ? $image_types[$list[0]] : '';
}

function site_media_get_base64_decode($file_content = '')
{
    $list = explode(',', $file_content);

    if(empty($list[1]) || $list[1] == '') {
        return '';
    }

    $content = str_replace(' ', '+', $list[1]);
    $decoded = base64_decode($content);
    
    return $decoded;
}