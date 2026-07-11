<?php
/*
 * Admin Column
 */
defined('ABSPATH') or die();

/*
 * Since 1.0.0
 * 
 * @param string $path 
 * 
 * @return string;
 */
function ad_column_custom_url($path = '')
{
	return plugins_url($path, ad_column_custom_index());
}

/*
 * Since 1.0.0
 * 
 * @param string $path 
 * 
 * @return string;
 */
function ad_column_custom_assets_url($path = '')
{
	return ad_column_custom_url('/media/' . ltrim($path, '/'));
}

/*
 * Since 1.0.0
 * 
 * @return string;
 */
function ad_column_custom_ver()
{
	return '2023110915';
}

/*
 * Since 1.0.0
 * 
 * @param string $path 
 * 
 * @return string;
 */
function ad_column_custom_path($path = '')
{
	return dirname(ad_column_custom_index()) . '/' . ltrim($path, '/');
}

/*
 * Since 1.0.0
 * 
 * Update 1.0.18
 * 
 * @return array;
 */
function ad_column_custom_get_post_types($field = '')
{
	global $wp_post_types;

	$list = array(
		'user' => __('Users', 'admin-column-custom'),
	);

	// change 'public' to 'show_in_menu'
	$list = array_merge($list, wp_filter_object_list($wp_post_types, ['show_in_menu' => true], 'AND', 'label'));

	unset($list['attachment']);

	if($field == 'key') {
		$list = array_keys($list);
	}
	
	return $list;
}

/*
 * Since 1.0.10
 * 
 * @param string $type 
 * 
 * @return string;
 */
function ad_column_get_option($type = '')
{
	return get_option('ad_column_' . $type);
}

/*
 * Since 1.0.15
 * 
 * @param integer $post_id 
 * 
 * @return string;
 */
function ad_column_get_page_path($post_id = 0)
{
	if ($post_id == 0) return '';

	$p = get_post($post_id);

	$path = $p->post_name;

	while ($p->post_parent > 0) {
		$p = get_post($p->post_parent);

		$path = $p->post_name . '/' . $path;
	}

	return $path;
}

/*
 * Since 1.0.20
 * 
 * @refer get_field (ACF) 
 * 
 * @param string $selector 
 * 
 * @return string;
 */
function ad_column_get_field($selector, $post_id = false, $format_value = true, $escape_html = false)
{
	$value = '';

	if (function_exists('get_field')) {
		$value = get_field($selector, $post_id, $format_value, $escape_html);

		if (is_array($value) || is_object($value)) {
			return '';
		}
	}

	return $value;
}
