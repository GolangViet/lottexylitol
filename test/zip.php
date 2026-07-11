<?php
@ini_set('display_errors', 1);
@ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(empty($_GET['abs']) || trim($_GET['abs']) != 'dev') die();


$zip = new ZipArchive();
$filename = 'zip-' . date('Ymd-His') . '.zip';

if ($zip->open(__DIR__ . '/'. $filename, ZipArchive::CREATE)!==TRUE) {
    die("cannot open ($filename)/n");
}

$rows = explode("/n", '

about-xylitol/index.php 
assets/css/new-styles.css 
assets/img/product/bg_melon.png     
assets/img/product/bg_melon_sp.png  
assets/img/product/img_melon.png    
assets/img/product/pic_melon.png    
assets/img/product/pic_melon_sp.png 
assets/img/top/bg_prod14.png           
assets/img/top/bg_prod14_sp.png        
assets/img/top/img_melon-flavor_af.png 
assets/img/top/img_product9.png        
assets/img/top/slider/img_kv_6_pc.jpg 
assets/img/top/slider/img_kv_6_sp.jpg 
assets/img/what/history-122025.png 
assets/js/top.js 
en/about-xylitol/index.php 
en/index.php 
en/product/index.php 
index.php 
product/index.php 

');

$dir = dirname(__DIR__);

foreach($rows as $file) {
    $file = trim($file);

    if($file == '' || !file_exists($dir . "/" . $file)) continue;

    $zip->addFile($dir . "/" . $file, $file);
}

$zip->close();