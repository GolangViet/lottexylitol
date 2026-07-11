<?php
defined('ABSPATH') or die();

function site_api_answer_survey_brand($args = [])
{
    $user = site_api_get_current_user();

    $lang = site_api_get_lang();

    $survey_key = 'survey_brand_id';

    if($lang == 'en') {
        $survey_key .= '_en';
    }

    return site_api_answer_insert_item($args, $user, $survey_key);
}

function site_api_answer_survey_normal($args = [])
{
    $user = site_api_get_current_user();

    $lang = site_api_get_lang();

    $survey_key = 'survey_id';

    if($lang == 'en') {
        $survey_key .= '_en';
    }

    return site_api_answer_insert_item($args, $user, $survey_key);
}

function site_api_answer_insert_item($args = [], $user = false, $option_name = 'survey_id')
{
    if($user == false) {
        $user = site_api_get_current_user();
    }

    $time = current_time('U');

    $survey_key_expires = 'survey_expires';
    // $survey_key_count = 'survey_count';

    if(preg_match('/(survey_brand)/i', $option_name)) {
        $survey_key_expires = 'survey_brand_expires';
        // $survey_key_count = 'survey_brand_count';
    }

    $survey_expires = (int) get_user_meta($user->ID, $survey_key_expires, true);
    $survey_id  = (int) get_option($option_name, 0);
    if($survey_id == 0) {
        $response = [
            'code' => 401,
            'error' => 'SURVEY NO ACTIVE',
            'message' => 'Request fail'
        ];
    } else if($survey_expires > $time) {
        $response = [
            'code' => 401,
            'error' => 'YOUR SURVEY EXPIRED',
            'message' => 'Request fail'
        ];
    } else if(count($args) > 0) {
        $args['survey_id'] = $survey_id;
        
        $valid = site_answer_validate_data($args);

        if(isset($valid['errors'])) {
            $response = [
                'code' => 401,
                'error' => $valid['errors'],
                'message' => 'Request fail'
            ];

            return $response;
        }
        
        $info = site_user_get_info($user, 'answer');

        $info['survey_id']  = $survey_id;
        $info['user_id']    = $user->ID;    
        $info['answers']    = $valid['answers'];
        
        $insert_id = site_answer_insert_item($info);
        if($insert_id>0) {
            
            if($survey_key_expires == 'survey_brand_expires') {
                $value = site_user_get_new_expires('survey_brand'); // Expires v1.1
            } else {
                $value = site_user_get_new_expires('survey'); // Expires v1.1
            }
            update_user_meta($user->ID, $survey_key_expires, $value);
            
            // $survey_count = (int) get_user_meta($user->ID, $survey_key_count, true);
            // update_user_meta($user->ID, $survey_key_count, $survey_count + 1);

            // user history
            site_user_history_insert_item([
                'user_id' => $user->ID,
                'name' => 'answer',
                'post_type' => 'survey',
                'post_id' => $survey_id
            ]);

            $response = [
                'code' => 200,
                'message' => 'Request success'
            ];
        } else {
            $response = [
                'code' => 401,
                'error' => 'ADD DATA FAIL',
                'message' => 'Request fail'
            ];
        }
    } else {
        $response = [
            'code' => 401,
            'error' => 'DATA EMPTY',
            'message' => 'Request fail'
        ];
    }

    return $response;
}

