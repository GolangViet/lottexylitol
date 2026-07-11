<?php
defined('ABSPATH') or die();

// Admin - Setting
require get_theme_file_path('/inc/admin/setting.php');

// Functions
require get_theme_file_path('/inc/functions/answer.php');
require get_theme_file_path('/inc/functions/answer-list-table.php');
require get_theme_file_path('/inc/functions/custom.php');
require get_theme_file_path('/inc/functions/jwt-token.php');
require get_theme_file_path('/inc/functions/media.php');
require get_theme_file_path('/inc/functions/user-delete.php');
require get_theme_file_path('/inc/functions/user-history.php');
require get_theme_file_path('/inc/functions/user-email.php');
require get_theme_file_path('/inc/functions/user.php');
require get_theme_file_path('/inc/functions/validation.php');
require get_theme_file_path('/inc/functions/activities.php');
require get_theme_file_path('/inc/functions/contest-list-table.php');
require get_theme_file_path('/inc/functions/game-list-table.php');
require get_theme_file_path('/inc/functions/esms.php');
require get_theme_file_path('/inc/functions/hasher.php');
require get_theme_file_path('/inc/functions/class-lucky.php');
require get_theme_file_path('/inc/functions/lucky-list-table.php');
require get_theme_file_path('/inc/functions/lucky-history-list-table.php');

if(file_exists($vietguys_file = get_theme_file_path('/inc/functions/vietguys.php'))) {
    require $vietguys_file;
}

// Post Type
require get_theme_file_path('/inc/post_types/contest.php');
// require get_theme_file_path('/inc/post_types/gift.php');
require get_theme_file_path('/inc/post_types/post.php');
require get_theme_file_path('/inc/post_types/survey.php');
require get_theme_file_path('/inc/post_types/winner.php');

// Translate
require get_theme_file_path('/inc/languages/translate.php');

// API
require get_theme_file_path('/inc/api/route.php');
require get_theme_file_path('/inc/api/token.php');
require get_theme_file_path('/inc/api/user.php');
require get_theme_file_path('/inc/api/survey.php');
require get_theme_file_path('/inc/api/answer.php');
require get_theme_file_path('/inc/api/gift.php');
require get_theme_file_path('/inc/api/cdp.php');
require get_theme_file_path('/inc/api/winner.php');
require get_theme_file_path('/inc/api/game.php');
require get_theme_file_path('/inc/api/page.php');
require get_theme_file_path('/inc/api/must-buy.php');
