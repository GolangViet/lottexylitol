<?php
// Author: A+LIVE
include_once ('../../app_config.php');
include(APP_PATH.'libs/lotte-api.php');

if( $lotte_api->is_logged_in() ) {
	header('Location: /en/user');
	exit;
}

// $redirect_to = isset($_GET['redirect_to']) ? trim($_GET['redirect_to']) : '/en/activity-page/';
$redirect_to = $lotte_api->get_var('redirect_to', '/en/activity-page/');

include (APP_PATH . 'libs/head.php');

if(defined('RECAPTCHA_SITE_KEY')) :
?>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo RECAPTCHA_SITE_KEY ?>"></script>
<style>
.grecaptcha-badge {
	display: none !important;
}
</style>
<?php endif ?>
<style>
#box-thanks .content .title-sub{
	padding-bottom: 0;
}
#box-thanks .content .img-popup{
	margin-bottom: 20px;
}
</style>
</head>

<body id="page-register" class="product bg-bottom-style2 en">
	<!-- Header
	================================================== -->
	<?php include (APP_PATH . 'libs/header.php'); ?>
	<div id="wrap">
		<!-- Main Content
		================================================== -->
		<main class="main bgmain style1">
			<div class="breadcrumb">
				<ul>
					<li><a href="/en/">Top</a></li>
					<li class="white">Signin</li>
				</ul>
			</div>
			<div class="section">
				<h1 class="section-title white">Signin</h1>
				<form class="form-register js-signin-form" id="form-login" data-toggle="validator" role="form" autocomplete="off">
					<div class="bg"></div>
					<img class="visible-lg form-img tooth wow fadeInRight" width="363" src="<?php echo APP_ASSETS; ?>img/register/tooth.png" alt="" />
					<!-- <img class="visible-lg form-img green wow fadeIn" width="261" src="<?php echo APP_ASSETS; ?>img/register/green.png" alt="" />
					<img class="visible-lg form-img xylitol wow fadeIn" width="543" src="<?php echo APP_ASSETS; ?>img/register/xylitol.png" alt="" /> -->
					<div class="visible-lg form-img wow fadeIn green lottie-icon" data-src="/assets/json/lemon.json"></div>
					<div class="visible-lg form-img wow fadeIn xylitol lottie-icon" data-src="/assets/json/product01/product01.json"></div>
					<div class="form-group">
						<label for="inputPhone" class="control-label">Phone number/Email</label>
						<input class="form-control" type="text" data-field="username" data-phone-maxlength="10" data-phone-pattern="[0]{1}[1-9]{1}[0-9]{8}" id="inputPhone" placeholder="Enter your phone number"
							data-pattern-error="Please enter a valid email or phone number, 10 digits, starting with 0" data-required-error="Please enter a valid email or phone number, 10 digits, starting with 0">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="inputPassword" class="control-label">Password</label>
						<div class="input-contain">
							<div class="icon-visible-password"></div>
							<input type="password" data-field="password" class="form-control visible-password" id="inputPassword" placeholder="Choose a password" data-required-error="Please enter a password" required>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<p class="txt-right forget-password"><a href="/en/forgot/" class="c-green">Forgot Password</a></p>
					</div>
					<div class="form-group txt-center">
						<button type="submit" class="bt-green bt-signin hover">Signin</button>
					</div>
					<div class="form-group group-bottom">
						<p class="txt-center">Don't have an account? <a href="/en/signup/<?php echo $redirect_to != '' ? '?redirect_to=' . $redirect_to : '' ?>" class="c-green">Signup here.</a></p>
					</div>
					<input type="hidden" name="token" value="<?php echo uniqid() ;?>" />
					<input type="hidden" name="redirect_to" class="redirect_to" value="<?php echo $redirect_to ?>" />
				</form>
			</div>
		</main>
	</div><!-- #wrap -->

	<section id="box-thanks" class="box-thanks box-wellcom">
		<div class="content">
			<h2 class="popup-title no-line c-green txt-center">Thank <strong class="user-name">you</strong> for joining<br> the LOTTE Xylitol membership community!</h2>
			<p class="title-sub">Exciting campaigns, activities, and exclusive updates will be coming soon — stay tuned!</p>
			<div class="img-popup txt-center"><img width="152" src="<?php echo APP_ASSETS; ?>img/register/img_topup.webp" alt=""></div>
			<p class="text-thanks">The page will automatically redirect in <b class="redirect-time-count fs-24 c-green">5</b> seconds.<br>
			If the system does not redirect, please <a href="<?php echo $redirect_to ?>" class="link-signin">click here</a> to continue</p>
		</div>
	</section>

    <?php include (APP_PATH . 'libs/popup-error.php'); ?>

	<!-- Footer
	================================================== -->
	<?php include (APP_PATH . 'libs/footer.php'); ?>
	<!-- End Document
================================================== -->
	<script src="<?php echo APP_ASSETS; ?>js/validator.js"></script>
	<script src="<?php echo APP_ASSETS; ?>js/lottie.js"></script>
	<script src="<?php echo APP_ASSETS; ?>js/script.js"></script>

</body>

</html>
