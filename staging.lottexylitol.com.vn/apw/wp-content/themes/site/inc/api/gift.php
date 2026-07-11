<?php
defined('ABSPATH') or die();

function site_api_gift_get_items()
{
    $items = site_gift_get_posts();

    $response = [
        'code' => 200,
        'items' => $items,
        'message' => 'Request success'
    ];

    return $response;
}