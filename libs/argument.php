<?php
$pagename = str_replace(array('/', '.php'), '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$pagename = $pagename ? $pagename : 'default';

if($curr_url[1] == 'test'){
	$real_name = 'test';
}else{
	$real_name = '';
}

switch ($pagename) {
	case $real_name.'enwhat-is-xylitol':
		if(!isset($titlepage)) $titlepage = 'What’s XYLITOL | LOTTE XYLITOL GUM | Protect your teeth from tooth decay';
		if(!isset($desPage)) $desPage = '';
		if(!isset($keyPage)) $keyPage = '';
		if(!isset($txtH1)) $txtH1 = 'What’s XYLITOL';
	break;
	case $real_name.'enwhy-xylitol':
		if(!isset($titlepage)) $titlepage = 'Why XYLITOL? | LOTTE XYLITOL GUM | Protect your teeth from tooth decay';
		if(!isset($desPage)) $desPage = '';
		if(!isset($keyPage)) $keyPage = '';
		if(!isset($txtH1)) $txtH1 = 'Why XYLITOL?';
	break;
	case $real_name.'enproduct':
		if(!isset($titlepage)) $titlepage = 'PRODUCTS | LOTTE XYLITOL GUM | Protect your teeth from tooth decay';
		if(!isset($desPage)) $desPage = '';
		if(!isset($keyPage)) $keyPage = '';
		if(!isset($txtH1)) $txtH1 = 'PRODUCTS';
	break;
	case $real_name.'enmovie':
		if(!isset($titlepage)) $titlepage = 'MOVIE GALLERY | LOTTE XYLITOL GUM | Protect your teeth from tooth decay';
		if(!isset($desPage)) $desPage = '';
		if(!isset($keyPage)) $keyPage = '';
		if(!isset($txtH1)) $txtH1 = 'MOVIE GALLERY';
	break;
	case $real_name.'enpromotion':
		if(!isset($titlepage)) $titlepage = 'PROMOTION | LOTTE XYLITOL GUM | Protect your teeth from tooth decay';
		if(!isset($desPage)) $desPage = '';
		if(!isset($keyPage)) $keyPage = '';
		if(!isset($txtH1)) $txtH1 = 'PROMOTION';
	break;
	case $real_name.'enprivacy-policy':
		if(!isset($titlepage)) $titlepage = 'PRIVACY POLICY | LOTTE XYLITOL GUM | Protect your teeth from tooth decay';
		if(!isset($desPage)) $desPage = '';
		if(!isset($keyPage)) $keyPage = '';
		if(!isset($txtH1)) $txtH1 = 'PRIVACY POLICY';
	break;
	case $real_name.'enterms':
		if(!isset($titlepage)) $titlepage = 'TERMS AND CONDITIONS | LOTTE XYLITOL GUM | Protect your teeth from tooth decay';
		if(!isset($desPage)) $desPage = '';
		if(!isset($keyPage)) $keyPage = '';
		if(!isset($txtH1)) $txtH1 = 'TERMS AND CONDITIONS';
	break;
	case $real_name.'en':
		if(!isset($titlepage)) $titlepage = 'LOTTE XYLITOL GUM | Protect your teeth from tooth decay';
		if(!isset($desPage)) $desPage = '';
		if(!isset($keyPage)) $keyPage = '';
		if(!isset($txtH1)) $txtH1 = 'PROTECT YOUR TEETH FROM TOOTH DECAY';
	break;
	
	case $real_name.'what-is-xylitol':
		if(!isset($titlepage)) $titlepage = 'XYLITOL là gì? | LOTTE XYLITOL GUM | Bảo vệ răng bạn khỏi sâu răng';
		if(!isset($desPage)) $desPage = '';
		if(!isset($keyPage)) $keyPage = '';
		if(!isset($txtH1)) $txtH1 = 'XYLITOL LÀ GÌ?';
	break;
	case $real_name.'why-xylitol':
		if(!isset($titlepage)) $titlepage = 'Tại sao là XYLITOL? | LOTTE XYLITOL GUM | Bảo vệ răng bạn khỏi sâu răng';
		if(!isset($desPage)) $desPage = '';
		if(!isset($keyPage)) $keyPage = '';
		if(!isset($txtH1)) $txtH1 = 'TẠI SAO LÀ XYLYTOL?';
	break;
	case $real_name.'product':
		if(!isset($titlepage)) $titlepage = 'SẢN PHẨM | LOTTE XYLITOL GUM | Bảo vệ răng bạn khỏi sâu răng';
		if(!isset($desPage)) $desPage = '';
		if(!isset($keyPage)) $keyPage = '';
		if(!isset($txtH1)) $txtH1 = 'SẢN PHẨM';
	break;
	case $real_name.'movie':
		if(!isset($titlepage)) $titlepage = 'THƯ VIỆN PHIM ẢNH | LOTTE XYLITOL GUM | Bảo vệ răng bạn khỏi sâu răng';
		if(!isset($desPage)) $desPage = '';
		if(!isset($keyPage)) $keyPage = '';
		if(!isset($txtH1)) $txtH1 = 'THƯ VIỆN PHIM ẢNH';
	break;
	case $real_name.'promotion':
		if(!isset($titlepage)) $titlepage = 'KHUYẾN MÃI | LOTTE XYLITOL GUM | Bảo vệ răng bạn khỏi sâu răng';
		if(!isset($desPage)) $desPage = '';
		if(!isset($keyPage)) $keyPage = '';
		if(!isset($txtH1)) $txtH1 = 'KHUYẾN MÃI';
	break;
	case $real_name.'privacy-policy':
		if(!isset($titlepage)) $titlepage = 'CHÍNH SÁCH BẢO MẬT | LOTTE XYLITOL GUM | Bảo vệ răng bạn khỏi sâu răng';
		if(!isset($desPage)) $desPage = '';
		if(!isset($keyPage)) $keyPage = '';
		if(!isset($txtH1)) $txtH1 = 'CHÍNH SÁCH BẢO MẬT';
	break;
	case $real_name.'terms':
		if(!isset($titlepage)) $titlepage = 'ĐIỀU KHOẢN VÀ ĐIỀU KIỆN | LOTTE XYLITOL GUM | Bảo vệ răng bạn khỏi sâu răng';
		if(!isset($desPage)) $desPage = '';
		if(!isset($keyPage)) $keyPage = '';
		if(!isset($txtH1)) $txtH1 = 'ĐIỀU KHOẢN VÀ ĐIỀU KIỆN';
	break;
	
	default:
		if(!isset($titlepage)) $titlepage = 'LOTTE XYLITOL GUM | Bảo vệ răng bạn khỏi sâu răng';
		if(!isset($desPage)) $desPage = '';
		if(!isset($keyPage)) $keyPage = '';
		if(!isset($txtH1)) $txtH1 = 'BẢO VỆ RĂNG BẠN KHỎI SÂU RĂNG';
}

?>