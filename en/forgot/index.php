<?php
// Author: A+LIVE
include_once ('../../app_config.php');
include(APP_PATH.'libs/lotte-api.php');

if( $lotte_api->is_logged_in() ) {
	header('Location: /en/user');
	exit;
}

// $redirect_to = isset($_GET['redirect_to']) ? trim($_GET['redirect_to']) : '/en/user/';

include (APP_PATH . 'libs/head.php');
?>
</head>

<body id="page-register" class="product bg-bottom-style2">
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
					<li class="white">Reset password</li>
				</ul>
			</div>
			<div class="section">
				<h1 class="section-title white">Reset password</h1>
				<form class="form-register js-forgot-form" id="form-login" data-toggle="validator" role="form" autocomplete="off">
					<div class="bg"></div>
					<img class="visible-lg form-img tooth wow fadeInRight" width="363" src="<?php echo APP_ASSETS; ?>img/register/tooth.png" alt="" />
					<div class="visible-lg form-img wow fadeIn green lottie-icon" data-src="/assets/json/lemon.json"></div>
					<div class="visible-lg form-img wow fadeIn xylitol lottie-icon" data-src="/assets/json/product01/product01.json"></div>
					<div class="form-group">
						<p class="text-center">
							Please enter your email address to receive the activation code.
						</p>
					</div>
					<div class="form-group">
						<label for="inputEmail" class="control-label">Email Address</label>
						<input type="email" data-field="email" class="form-control" id="inputEmail" data-error="Invalid email format" required>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group txt-center">
						<button type="submit" class="bt-green bt-signin hover">Continue</button>
					</div>
					<input type="hidden" name="token" value="<?php echo uniqid() ;?>" />
					<input type="hidden" name="redirect_to" class="redirect_to" value="/en/forgot/" />
				</form>
			</div>
		</main>
	</div><!-- #wrap -->

	<section id="box-forgot" class="box-thanks box-wellcom">
		<div class="content">
			<h2 class="popup-title no-line c-green txt-center">Reset password</h2>
			<form class="form-register js-verify-newpass-form" data-toggle="validator" role="form" autocomplete="off">
				<div class="form-group js-message u-hidden">
					<p class="text-center c-red">Please enter correct information</p>
				</div>
                <div class="form-group">
                    <label for="inputCode" class="control-label">Single Code</label>
                    <input type="text" data-field="code" class="form-control" id="inputCode" data-error="Please enter activation code" required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="control-label">New PASSWORD</label>
                    <div class="input-contain">
                        <div class="icon-visible-password"></div>
                        <input type="password" data-field="newpassword" class="form-control visible-password c-green" id="inputPasswordNew" value="Please enter a password" data-required-error="Please enter a password." autocomplete="off">
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputRePassword" class="control-label">Confirm Password</label>
                    <div class="input-contain">
                        <div class="icon-visible-password"></div>
                        <input type="password" class="form-control visible-password c-green" id="inputRePassword" data-match="#inputPasswordNew" data-error="Password does not match." value="Please enter a password" autocomplete="off">
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group txt-center">
                    <button type="submit" class="btn-dark-green hover">Save Information</button>
                </div>
				<input type="hidden" name="email" data-field="email" class="input-email" value="" />
				<input type="hidden" name="redirect_to" class="redirect_to" value="/en/signin/" />
			</form>
		</div>
	</section>

	<section id="box-thanks" class="box-thanks box-wellcom">
		<div class="content">
			<h2 class="popup-title no-line c-green txt-center">Password reset successful!</h2>
			<p class="title-sub">Join exciting activities now to have a chance to receive attractive gifts<br class="u-pc">
			from Lotte Xylitol!</p>
			<div class="img-popup"><img src="<?php echo APP_ASSETS; ?>img/register/img-popup.png" alt=""></div>
			<p class="text-thanks">The page will automatically redirect in <b class="redirect-time-count fs-24 c-green">5</b> seconds.<br>
			If the system does not redirect, please <a href="/en/signin/" class="link-signin">click here</a> to continue</p>
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
