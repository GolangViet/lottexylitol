<?php

/**
 * ABS functions and definitions
 *
 * @package WordPress
 * @subpackage ABS
 * @since ABS 1.0
 */
//@ini_set( 'upload_max_size' , '20M' );
//@ini_set( 'post_max_size', '20M');
//@ini_set( 'max_execution_time', '300' );

/**
 * Theme setup.
 */
function site_setup()
{
	/*
	 * Make Twenty Fourteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Fourteen, use a find and
	 * replace to change 'twentyfourteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain('twentyfourteen', get_template_directory() . '/languages');

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support('post-thumbnails');

	/* navigation position */
	add_theme_support('menus');

	//add more size for pages
	// add_image_size('product-thumb', 285, 285, true);

	// This theme uses its own gallery styles.
	add_filter('use_default_gallery_style', '__return_false');

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style(array('assets/css/editor-style.css', get_template_directory()));
}
add_action('after_setup_theme', 'site_setup');

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Main 1.0
 */
function site_scripts()
{
	$cores 	= array('jquery');

	$url 	= site_get_template_directory_assets();

	$time 	= current_time('YmdHis');

	// Add CSS
	// wp_enqueue_style('style', 	$url . 'css/style.css', '', $time);

	// Add JS
	// wp_enqueue_script('script', 	$url . 'js/script.js',  $cores, $time, true);
}
// add_action('wp_enqueue_scripts', 'site_scripts');


/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image except in Multisite signup and activate pages.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Twenty Fourteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function site_body_classes($classes)
{
	if (site_is_mobile()) {
		$classes[] = 'mobile-device';
	} else {
		$classes[] = 'desktop-device';
	}

	return $classes;
}
add_filter('body_class', 'site_body_classes');

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @since main 1.0
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
function site_post_classes($classes)
{
	if (!post_password_required() && !is_attachment() && has_post_thumbnail()) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter('post_class', 'site_post_classes');

/** MORE **/
show_admin_bar(false);

//Create Nav Menu
if (function_exists('register_nav_menus')) {
	// register_nav_menus(array(
	// 	'primary' 	=> 'Main Menu',
	// ));
}

function site_get_template_directory_assets($file = '')
{
	return get_template_directory_uri() . '/assets/' . $file;
}

function site_get_assets($file = '')
{
	return site_get_template_directory_assets($file);
}

function site_the_assets($file = '')
{
	echo site_get_assets($file);
}

function site_is_mobile()
{
	return preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $_SERVER['HTTP_USER_AGENT']) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
}

function site_get_lang()
{
	$lang = explode('_', get_locale());

	return $lang[0];
}

// show in admin
if (is_admin()) :

	function site_theme_setup()
	{
		// Set default values for the upload none box
		update_option('image_default_link_type', 'none');
	}
	add_action('after_setup_theme', 'site_theme_setup');

endif;

require get_theme_file_path('/inc/init.php');
