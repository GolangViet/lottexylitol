<?php echo('<?xml version="1.0" encoding="UTF-8"?>'); ?>
<!DOCTYPE html>
<html lang="<?php echo $html_lang; ?>">
<head>
<meta charset="utf-8">
<link rel="alternate" href="<?php echo $protocol.$_SERVER['HTTP_HOST'].$alter_href; ?>" hreflang="<?php echo $alter_lang; ?>">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php
	// set viewport by user agent.
	require_once 'ua.class.php';
	$ua = new UserAgent();
	if($ua->set() === 'tablet') :
		// set width when you use the tablet
		$width = '1024px';
?>
<meta content="width=<?php echo $width; ?>" name="viewport">
<?php else: ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<?php endif; ?>

<?php
include(APP_PATH.'libs/function.php');
include(APP_PATH.'libs/argument.php');
?>
<title><?php echo $titlepage; ?></title>
<meta name="description" content="<?php echo $desPage; ?>">
<meta name="keywords" content="<?php echo $keyPage; ?>">

<!--facebook-->
<meta property="og:title" content="<?php echo $titlepage; ?>">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo $current_url; ?>">
<meta property="og:image" content="<?php echo isset($ogimg) ? $ogimg : APP_URL.'assets/img/common/ogp.png'; ?>">
<meta property="og:site_name" content="<?php echo isset($ogsitename) ? $ogsitename : 'LOTTE XYLITOL GUM'; ?>">
<meta property="og:description" content="<?php echo $desPage; ?>">
<meta property="fb:app_id" content="">
<!--/facebook-->
<script>
var IS_PSI = navigator.userAgent.includes("Google Page Speed") !== false || navigator.userAgent.includes("Lighthouse") !== false || navigator.userAgent.includes("Speed Insights") !== false;
</script>
<!--css-->
<link type="text/css" rel="stylesheet" href="<?php echo APP_ASSETS; ?>js/wow/animate.min.css">
<link href="<?php echo APP_ASSETS; ?>css/jquery.fancybox.css" rel="stylesheet">
<link href="<?php echo APP_ASSETS; ?>css/fonts.css" rel="stylesheet">
<link href="<?php echo APP_ASSETS; ?>css/style.css" rel="stylesheet">
<link href="<?php echo APP_ASSETS; ?>css/custom.css" rel="stylesheet">
<link href="<?php echo APP_ASSETS; ?>css/new-styles.css?v=<?php echo filemtime(APP_PATH . '/assets/css/new-styles.css') ?>" rel="stylesheet">
<!--/css-->

<!-- Favicons ==================================================-->
<link rel="icon" href="<?php echo APP_ASSETS; ?>img/common/icon/favicon.png" type="image/vnd.microsoft.icon">

<!-- iPad icons -->
<link rel="apple-touch-icon-precomposed" href="<?php echo APP_ASSETS; ?>img/common/icon/72x72.png" sizes="72x72">
<link rel="apple-touch-icon-precomposed" href="<?php echo APP_ASSETS; ?>img/common/icon/144x144.png" sizes="144x144">
<!-- iPhone and iPod touch icons -->
<link rel="apple-touch-icon-precomposed" href="<?php echo APP_ASSETS; ?>img/common/icon/57x57.png" sizes="57x57">
<link rel="apple-touch-icon-precomposed" href="<?php echo APP_ASSETS; ?>img/common/icon/114x114.png" sizes="114x114">
<!-- Nokia Symbian -->
<link rel="nokia-touch-icon" href="<?php echo APP_ASSETS; ?>img/common/icon/57x57.png" sizes="57x57">
<!-- Android icon precomposed so it takes precedence -->
<link rel="apple-touch-icon-precomposed" href="<?php echo APP_ASSETS; ?>img/common/icon/114x114.png" sizes="114x114">
<script src="<?php echo APP_ASSETS; ?>js/lib/jquery1-12-4.min.js"></script>

<!--[if lt IE 9]>
<script src="//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Tag Manager GTM-WHFSD9K-->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WHFSD9K');</script>
<!-- End Google Tag Manager  GTM-WHFSD9K-->
<!-- Google Tag Manager GTM-N4S38Q9Z-->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N4S38Q9Z');</script>
<!-- End Google Tag Manager GTM-N4S38Q9Z-->

<?php
	//wp_head();
?>
