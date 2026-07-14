<?php

defined('ABSPATH') or die();

function site_api_home_banner_get_items()
{
    $output = ['code' => 200, 'items' => [], 'message' => 'Request success'];
    $items = site_banner_get_posts('home-banners');
    if (empty($items)) {
        return $output;
    }

    $output['items'] = $items;

    return $output;
}
