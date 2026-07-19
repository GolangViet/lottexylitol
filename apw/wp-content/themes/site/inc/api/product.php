<?php

defined('ABSPATH') or die();

function site_api_product_category_get_items()
{
    $output = ['code' => 200, 'message' => 'Request success', 'items' => site_product_get_terms()];

    return $output;
}
