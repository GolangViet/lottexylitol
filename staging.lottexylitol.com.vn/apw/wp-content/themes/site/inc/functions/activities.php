<?php
defined('ABSPATH') or die();

/*
 * Since 1.0.0
 */
function site_activities_menu_pages()
{
	add_menu_page(
		'Activities',
		'Activities',
		'manage_options',
		'activities',
		'site_activities_admin_page',
		'dashicons-chart-line'
	);

	$user = wp_get_current_user();
	if (count(array_intersect(['administrator', 'must-buy'], $user->roles)) > 0) {
		add_submenu_page(
			'activities',
			'Lucky Bottle',
			'Lucky Bottle',
			'read',
			'lucky-bottle',
			'site_lucky_render_list_page'
		);

		add_submenu_page(
			'activities',
			'Lucky History',
			'Lucky History',
			'read',
			'lucky-history',
			'site_lucky_history_render_list_page'
		);
	}

	add_submenu_page(
		'activities',
		'Survey User',
		'Survey User',
		'manage_options',
		'survey-user',
		'site_answer_render_customer_list_page'
	);

	add_submenu_page(
		'activities',
		'Brand Ambassador',
		'Brand Ambassador',
		'manage_options',
		'survey-brand',
		'site_answer_render_customer_list_page'
	);

	add_submenu_page(
		'activities',
		'Photo Contest',
		'Photo Contest',
		'manage_options',
		'photo-contest',
		'site_contest_render_list_page'
	);

	add_submenu_page(
		'activities',
		'Game',
		'Game',
		'manage_options',
		'game',
		'site_game_render_list_page'
	);

	// dashicons-portfolio
}
add_action('admin_menu', 'site_activities_menu_pages');

function site_activities_admin_page()
{
	$parent_slug = 'activities';

	$list = site_activities_get_menus();

	?>
		<h1>
			<?php _e('Activities', 'site') ?>
		</h1>
		<ol>
			<?php
			foreach ($list as $item) {
				if ($item[2] != $parent_slug) {
					printf('<li><a href="%s">%s</a></li>', add_query_arg('page', $item[2], admin_url('admin.php')), $item[0]);
				}
			}
			?>
		</ol>
		<p style="margin-top: 30px;">
			<a class="button" href="options-reading.php#site-settings">Site Settings</a>
		</p>
	<?php
}

function site_activities_get_menus()
{
	global $submenu;

	$parent_slug = 'activities';

	return isset($submenu[$parent_slug]) ? $submenu[$parent_slug] : [];
}