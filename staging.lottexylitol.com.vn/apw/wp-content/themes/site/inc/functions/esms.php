<?php

function esms_get_settings()
{
    $esms_settings = array(
        'apikey'        =>  'B81A420C520C04534E66DDE167C278',
        'secretkey'     =>  '8FD424FC7F7A490B64FCDFA7D10ADA',
        'smstype'       =>  2, // 2: Brandname, 8: Phone 9,
        'is_unicode'    =>  1,
        'brandname'     =>  'XYLITOL', // [Baotrixemay] to test
        'sandbox'       =>  '0',
    );

    return $esms_settings;
}

/**
 * https://developers.esms.vn/esms-api/ham-gui-tin/tin-nhan-sms-otp-cskh
 */
function esms_send_single($YourPhone = '', $Content = '')
{
    $esms_settings = esms_get_settings();

    $APIKey = $esms_settings['apikey'];
    $SecretKey = $esms_settings['secretkey'];
    $smstype = $esms_settings['smstype'];
    $is_unicode = $esms_settings['is_unicode'];
    $brandname = $esms_settings['brandname'];
    $sandbox = $esms_settings['sandbox'];

    if (!$YourPhone || !$Content || !$APIKey || !$SecretKey || !$smstype) return false;

    if ($is_unicode == 1) {
        $Content = remove_accents($Content);
        $is_unicode_convert = 0;
    } else {
        $is_unicode_convert = 1;
    }

    $SendContent = urlencode($Content);

    $params = "Phone=$YourPhone&ApiKey=$APIKey&SecretKey=$SecretKey&Content=$SendContent&SmsType=$smstype&IsUnicode=$is_unicode_convert&Sandbox=$sandbox";

    if (($smstype == 1 || $smstype == 2) && $brandname) {
        $params .= '&Brandname=' . $brandname;
    }

    $data = "http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?" . $params;

    $resp = wp_remote_request($data);
    
    $http_code = wp_remote_retrieve_response_code($resp);
    if ($http_code != '200') {
        return ["CodeResult" => "503"];
    }

    $body = wp_remote_retrieve_body($resp);
    return (array) json_decode($body, true);

    // https://developers.esms.vn/esms-api/bang-ma-loi
    /*
    $http_code = wp_remote_retrieve_response_code($resp);
    if ($http_code != '200') {
        $body = wp_remote_retrieve_body($resp);
        $obj = json_decode($body, true);

        $obj['data_request'] = $params;
        return $obj;
    }

    return [
        "HttpCode" => "$http_code",
        "CodeResult" => "99",
        "CountRegenerate" => "0",
        "ErrorMessage" => "Call RestAPI error: " . json_encode($resp['response']),
        "Params" => $params,
        "Request" => $data,
    ];
    */
}

function esms_get_balance()
{
    $esms_settings = esms_get_settings();
    
    $APIKey = $esms_settings['apikey'];
    $SecretKey = $esms_settings['secretkey'];

    if (!$APIKey || !$SecretKey) return false;

    $data = "http://rest.esms.vn/MainService.svc/json/GetBalance/$APIKey/$SecretKey";

    $resp = wp_remote_request($data);
    $http_code = wp_remote_retrieve_response_code($resp);
    if ($http_code == '200') {
        $body = wp_remote_retrieve_body($resp);
        $obj = json_decode($body, true);
        if ($obj['CodeResponse'] == 100) {
            return $obj['Balance'];
        }
    }
    return false;
}

/*

curl --location --request POST 'https://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_post_json/' \
--header 'Content-Type: application/json' \
--data-raw '{
   "ApiKey": "APIKEYCUABAN",
   "Content": "280391 la ma xac minh dang ky Baotrixemay cua ban",
   "Phone": "0901888484",
   "SecretKey": "SECRETKEYCUABAN",
   "Brandname": "Baotrixemay",
   "SmsType": "2",
   "IsUnicode": "0",
   "campaignid": "Cảm ơn sau mua hàng tháng 7",
   "RequestId": "c82cd356-bf49-4113-9466-65a7f6359c96",
   "CallbackUrl": "https://esms.vn/webhook/"
}'

*/
