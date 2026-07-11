<?php
defined('ABSPATH') or die();

function site_api_survey_get_items()
{
    $lang = site_api_get_lang();

    if($lang == 'en') {
        $survey_id = get_option('survey_id_en', 0);
    } else {
        $survey_id = get_option('survey_id', 0);
    }

    $items = site_survey_get_items($survey_id);

    $response = [
        'code' => 200,
        'items' => $items,
        'message' => 'Request success'
    ];

    return $response;
}

function site_api_survey_brand_get_items()
{
    $lang = site_api_get_lang();

    if($lang == 'en') {
        $survey_id = get_option('survey_brand_id_en', 0);
    } else {
        $survey_id = get_option('survey_brand_id', 0);
    }

    $items = site_survey_get_items($survey_id);

    $response = [
        'code' => 200,
        'items' => $items,
        'message' => 'Request success'
    ];

    return $response;
}
