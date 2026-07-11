<?php
ini_set('display_errors', 'Off');
$curr_url = explode("/","$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
if($curr_url[1] == 'test'){
	$real_link = 'test/';
}else{
	$real_link = '';
}

$url = $_SERVER['HTTP_HOST'].'/'.$real_link;
$protocol = empty($_SERVER["HTTPS"]) ? 'http://' : 'https://';

// get host.
$app_url = $protocol.$_SERVER['HTTP_HOST'].'/'.$real_link;
define('APP_URL', $app_url);
define('APP_PATH', dirname(__FILE__).'/');
define("APP_URL_SHORT", "//".$url);
define("APP_URL_HTTPS", "https://".$url);
define('APP_ASSETS', APP_URL_SHORT.'assets/');
define('APP_PATH_WP', dirname(__FILE__).'/wp/');

define("APP_SP_URL",  APP_URL."sp/");
define("APP_SP_PATH", APP_PATH."sp/");

define("ISSTG", preg_match('/(staging)/i', $_SERVER['HTTP_HOST']) || $_SERVER['REMOTE_ADDR'] === '::1' || $_SERVER['REMOTE_ADDR'] === '127.0.0.1');

if(ISSTG == false) {
	define("RECAPTCHA_SITE_KEY", '6LccE3sqAAAAADPOhRVsfCzec-i1s-LnS0C3y1Dl');
	define("RECAPTCHA_SECRET_KEY", '6LccE3sqAAAAABMvvK-o_6VgUqaDZvyppNaKck0o');
}

$show_snsBox = true;

/* email list for forms */

//contact
$aMailtoContact = array('vntesttongali@gmail.com');
$aBccToContact = array('vntesttongali2@gmail.com');
$fromContact = "vntesttongali@gmail.com";

//event
$aMailtoEvent = array('vntesttongali@gmail.com');
$aBccToEvent = array('vntesttongali2@gmail.com');
$fromEvent = "vntesttongali@gmail.com";

//request
$aMailtoRequest = array('vntesttongali@gmail.com');
$aBccToRequest = array('vntesttongali2@gmail.com');
$fromRequest = "vntesttongali@gmail.com";

$request_uri = ltrim(str_replace('en/', '', $_SERVER['REQUEST_URI']), '/');

$lang_urls = [
	'vi' => APP_URL . $request_uri,
	'en' => APP_URL . 'en/'. $request_uri,
];

/* set language link */
$curr_url = explode("/","$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
$lang = $curr_url[1];
$folder = isset($curr_url[2]) ? trim($curr_url[2]) : '';
if($lang == 'en' || $folder == 'en') {
	$html_lang = 'en';
	$alter_lang = 'vi';
	$lang_link = 'en/';

	if($curr_url[1] == 'test'){
		$alter_href = str_replace('/en', '', $_SERVER['REQUEST_URI']);
		$btn_lang = str_replace('/test/en/', '', $_SERVER['REQUEST_URI']);
	}else{
		$alter_href = str_replace('/en', '', $_SERVER['REQUEST_URI']);
		$btn_lang = str_replace('/en/', '', $_SERVER['REQUEST_URI']);
	}

	$navi_intro = 'About<br class="pc"> Lotte Xylitol';
	$navi_membership = 'Membership<br class="pc"> Benefit';
	$navi_membership_promote = 'Membership<br class="pc"> Activities';
	$navi_gallery = 'Gallery';
	$navi_ambassador = 'LOTTE XYLITOL Brand Ambassador';
	$navi_photo = 'Photo Contest';
	$navi_game = 'Join Game';
	$navi_survey = 'Take Survey';
	$navi_signup = 'Signup';
	$navi_signin = 'Signin';
	$navi_profile = 'My Profile';
	$navi_signout = 'Signout';

	$navi_learn_about = 'What’s Xylitol';
	$navi_news = "News";
	$navi_promotion = 'Promotion';
	$navi_movie = 'Movie Gallery';
	$navi_product = 'Product';
	$navi_why = 'Why XYLITOL';
	$navi_what = 'What’s XYLITOL';
	$navi_what_why = 'What’s & Why<br class="pc"> Xylitol?';
	$navi_must_buy = 'Nhận quà liền tay';

	$navi_campaign = 'Campaign detail';
	$navi_how = 'How to attend';
	$navi_example = 'Example Video';
	$navi_award = 'Award';

	$footer_why = 'Why XYLITOL';
	$footer_what = 'What’s XYLITOL';

	$footer_address = 'Address: Land Lot No. 1183, Vo Minh Duc Street, Thu Dau Mot Ward, Ho Chi Minh City, Vietnam';
	$footer_link_contact = 'https://lotte.com.vn/en/service/';

	$txt_footer = 'Please press the like button!';
	$txt_privacy = 'Privacy policy';
	$txt_terms = 'Terms and conditions';
	$txt_contact = 'Contact us';

	$popup_error_txt = 'Please enter accurate information!';
	$popup_error_loading = 'Loading ...';
}else{
	$html_lang = 'vi';
	$alter_lang = 'en';
	$lang_link = '';

	if($curr_url[1] == 'test'){
		$currpath = str_replace('/test/', '', $_SERVER['REQUEST_URI']);
		$alter_href = '/test/en/'.$currpath;
		$btn_lang = 'en/'.$currpath;
	}else{
		$alter_href = '/en'.$_SERVER['REQUEST_URI'];
		$btn_lang = 'en'.$_SERVER['REQUEST_URI'];
	}

	$navi_intro = 'Giới thiệu<br class="pc"> lotte xylitol';
	$navi_membership = 'Quyền lợi<br class="pc"> thành viên';
	$navi_gallery = 'thư viện';
	$navi_ambassador = 'Đại sứ Lotte Xylitol';
	$navi_photo = 'CUỘC THI HÌNH ẢNH';
	$navi_membership_promote = 'hoạt động<br class="pc"> thành viên';
	$navi_game = 'Tham gia game';
	$navi_survey = 'Làm khảo sát';
	$navi_signup = 'Đăng ký';
	$navi_signin = 'Đăng nhập';
	$navi_profile = 'HỒ SƠ CỦA TÔI';
	$navi_signout = 'Thoát';

	$navi_learn_about = 'tìm hiểu <br class="pc">về xylitol';
	$navi_news = "Tin tức";
	$navi_promotion = 'Khuyến mãi';
	$navi_movie = 'Quảng cáo';
	$navi_product = 'Sản phẩm';
	$navi_why = 'Tại sao chọn XYLITOL';
	$navi_what = 'Tìm hiểu Xylitol';
	$navi_what_why = 'TÌM HIỂU & <br>TẠI SAO CHỌN <br class="pc">XYLITOL';
	$navi_must_buy = 'Nhận quà liền tay';

	$navi_campaign = 'Thể lệ';
	$navi_how = 'Cách thức tham gia';
	$navi_example = 'Video hướng dẫn';
	$navi_award = 'GIẢI THƯỞNG';

	$footer_why = 'tại sao chọn XYLITOL';
	$footer_what = 'Tìm hiểu Xylitol';

	$footer_address = 'Địa chỉ: Thửa đất 1183, đường Võ Minh Đức, phường Thủ Dầu Một, Thành phố Hồ Chí Minh.';
	$footer_link_contact = 'https://lotte.com.vn/service/';

	$txt_footer = 'Hãy nhấn nút Like!';
	$txt_privacy = 'Bảo mật';
	$txt_terms = 'Điều kiện và Điều khoản';
	$txt_contact = 'Liên hệ';

	$popup_error_txt = 'Vui lòng nhập chính xác các thông tin!';
	$popup_error_loading = 'Đang xử lý ...';
}

$login_link = APP_URL . $lang_link . 'signin?redirect_to=' . urlencode($_SERVER['REQUEST_URI']);
$logout_link = APP_URL . '?signout=' . time();

/**
 * Must buy setting
 */
$mustbuy_from    = '2025-12-15 00:00:00';
$mustbuy_to      = '2026-03-17 23:59:59';
