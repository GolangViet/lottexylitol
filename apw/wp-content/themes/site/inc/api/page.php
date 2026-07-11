<?php

function site_api_page_brand()
{
    $lang = site_api_get_lang();

    if($lang == 'en') {
        $survey_id = get_option('survey_brand_id_en', 0);
    } else {
        $survey_id = get_option('survey_brand_id', 0);
    }

    $item = [];

    $item['title'] = get_the_title($survey_id);
    $item['about_ba_title'] = get_field('about_ba_title', $survey_id);
    $item['questions'] = site_survey_page_get_items($survey_id);

    $response = [
        'code' => 200,
        'item' => $item,
        'message' => 'Request success'
    ];

    return $response;
}