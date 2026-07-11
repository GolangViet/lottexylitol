<?php
// Author: A+LIVE
include_once ('../app_config.php');
include(APP_PATH.'libs/lotte-api.php');

if( $lotte_api->is_logged_in() ) {
	header('Location: /user');
	exit;
}

$utm = '';

foreach($_GET as $key => $value) {
	if(substr($key, 0, 4) == 'utm_') {
		$utm .= "&{$key}={$value}";
	}
}

// $redirect_to = isset($_GET['redirect_to']) ? trim($_GET['redirect_to']) : '/activity-page/';
$redirect_to = $lotte_api->get_var('redirect_to', '/activity-page/');

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

<body id="page-register" class="product bg-bottom-style2 vn">
	<!-- Header
	================================================== -->
	<?php include (APP_PATH . 'libs/header.php'); ?>
	<div id="wrap">
		<!-- Main Content
		================================================== -->
		<main class="main bgmain style1">
			<div class="breadcrumb">
				<ul>
					<li><a href="/">Trang chủ</a></li>
					<li class="white">Đăng nhập</li>
				</ul>
			</div>
			<div class="section">
				<h1 class="section-title white">Đăng nhập</h1>
				<form class="form-register js-signin-form" id="form-login" data-toggle="validator" role="form" autocomplete="off">
					<div class="bg"></div>
					<img class="visible-lg form-img tooth wow fadeInRight" width="363" src="<?php echo APP_ASSETS; ?>img/register/tooth.png" alt="" />
					<!-- <img class="visible-lg form-img green wow fadeIn" width="261" src="<?php echo APP_ASSETS; ?>img/register/green.png" alt="" />
					<img class="visible-lg form-img xylitol wow fadeIn" width="543" src="<?php echo APP_ASSETS; ?>img/register/xylitol.png" alt="" /> -->
					<div class="visible-lg form-img wow fadeIn green lottie-icon" data-src="/assets/json/lemon.json"></div>
					<div class="visible-lg form-img wow fadeIn xylitol lottie-icon" data-src="/assets/json/product01/product01.json"></div>
					<div class="form-group">
						<label for="inputPhone" class="control-label">Số điện thoại/Email</label>
						<input class="form-control" type="text" data-field="username" data-phone-maxlength="10" data-phone-pattern="[0]{1}[1-9]{1}[0-9]{8}" id="inputPhone" placeholder="Nhập số điện thoại của bạn"
							data-pattern-error="Vui lòng nhập đúng email hoặc số điện thoại, 10 số, bắt đầu bằng số 0" data-required-error="Vui lòng nhập đúng email hoặc số điện thoại, 10 số, bắt đầu bằng số 0">
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="inputPassword" class="control-label">Mật khẩu</label>
						<div class="input-contain">
							<div class="icon-visible-password"></div>
							<input type="password" data-field="password" class="form-control visible-password" id="inputPassword" placeholder="Nhập mật khẩu" data-required-error="Vui lòng nhập mật khẩu" required>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<p class="txt-right forget-password"><a href="/forgot/" class="c-green">Quên mật khẩu</a></p>
					</div>
					<div class="form-group txt-center">
						<button type="submit" class="bt-green bt-signin hover">Đăng nhập</button>
					</div>
					<div class="form-group group-bottom">
						<p class="txt-center">Chưa có tài khoản, <a href="/signup/<?php echo $redirect_to != '' ? '?redirect_to=' . $redirect_to : '' ?>" class="c-green">Đăng ký</a> tại đây.</p>
					</div>
					<input type="hidden" name="token" value="<?php echo uniqid() ;?>" />
					<input type="hidden" name="redirect_to" class="redirect_to" value="<?php echo $redirect_to ?>" />
				</form>
			</div>
		</main>
	</div><!-- #wrap -->

	<section id="box-thanks" class="box-thanks box-wellcom">
		<div class="content">
			<h2 class="popup-title no-line c-green txt-center">Cảm ơn <strong class="user-name">bạn</strong> đã đăng nhập<br> và trở thành thành viên LOTTE Xylitol!</h2>
			<p class="title-sub">Hãy cùng đón chờ các hoạt động và chương trình hấp dẫn trong thời gian tới nhé!</p>
			<div class="img-popup txt-center"><img width="152" src="<?php echo APP_ASSETS; ?>img/register/img_topup.webp" alt=""></div>
			<p class="text-thanks">Trang sẽ tự động chuyển trong vòng <b class="redirect-time-count fs-24 c-green">5</b> giây.<br>
			Nếu hệ thống không tự chuyển, vui lòng <a href="<?php echo $redirect_to ?>" class="link-signin">nhấp vào đây</a> để tiếp tục</p>
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
