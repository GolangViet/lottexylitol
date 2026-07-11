<?php
// Author: A+LIVE
include_once ('../app_config.php');
include(APP_PATH.'libs/lotte-api.php');

if( $lotte_api->is_logged_in() ) {
	header('Location: /user');
	exit;
}

// $redirect_to = isset($_GET['redirect_to']) ? trim($_GET['redirect_to']) : '/user/';

include (APP_PATH . 'libs/head.php');
?>
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
					<li class="white">Đặt lại mật khẩu</li>
				</ul>
			</div>
			<div class="section">
				<h1 class="section-title white">Đặt lại mật khẩu</h1>
				<form class="form-register js-forgot-form" id="form-login" data-toggle="validator" role="form" autocomplete="off">
					<div class="bg"></div>
					<img class="visible-lg form-img tooth wow fadeInRight" width="363" src="<?php echo APP_ASSETS; ?>img/register/tooth.png" alt="" />
					<div class="visible-lg form-img wow fadeIn green lottie-icon" data-src="/assets/json/lemon.json"></div>
					<div class="visible-lg form-img wow fadeIn xylitol lottie-icon" data-src="/assets/json/product01/product01.json"></div>
					<div class="form-group">
						<p class="text-center">
							Vui lòng nhập địa chỉ email để nhận mã kích hoạt.
						</p>
					</div>
					<div class="form-group">
						<label for="inputEmail" class="control-label">Địa chỉ Email</label>
						<input type="email" data-field="email" class="form-control" id="inputEmail" data-error="Email chưa đúng định dạng" required>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group txt-center">
						<button type="submit" class="bt-green bt-signin hover">Tiếp tục</button>
					</div>
					<input type="hidden" name="token" value="<?php echo uniqid() ;?>" />
					<input type="hidden" name="redirect_to" class="redirect_to" value="/forgot/" />
				</form>
			</div>
		</main>
	</div><!-- #wrap -->

	<section id="box-forgot" class="box-thanks box-wellcom">
		<div class="content">
			<h2 class="popup-title no-line c-green txt-center">Đặt lại mật khẩu</h2>
			<form class="form-register js-verify-newpass-form" data-toggle="validator" role="form" autocomplete="off">
				<div class="form-group js-message u-hidden">
					<p class="text-center c-red">Vui lòng nhập đúng thông tin</p>
				</div>
                <div class="form-group">
                    <label for="inputCode" class="control-label">Mã kích hoạt</label>
                    <input type="text" data-field="code" class="form-control" id="inputCode" data-error="Vui lòng nhập mã kích hoạt" required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="control-label">MẬT KHẨU MỚI</label>
                    <div class="input-contain">
                        <div class="icon-visible-password"></div>
                        <input type="password" data-field="newpassword" class="form-control visible-password c-green" id="inputPasswordNew" data-error="Vui lòng nhập mật khẩu." required autocomplete="off">
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputRePassword" class="control-label">NHẬP LẠI MẬT KHẨU MỚI</label>
                    <div class="input-contain">
                        <div class="icon-visible-password"></div>
                        <input type="password" class="form-control visible-password c-green" id="inputRePassword" data-match="#inputPasswordNew" data-error="Mật khẩu chưa khớp." required autocomplete="off">
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
				<div class="form-group txt-center">
                    <button type="submit" class="btn-dark-green hover">LƯU THÔNG TIN</button>
                </div>
				<input type="hidden" name="email" data-field="email" class="input-email" value="" />
				<input type="hidden" name="redirect_to" class="redirect_to" value="/signin/" />
			</form>
		</div>
	</section>

	<section id="box-thanks" class="box-thanks box-wellcom">
		<div class="content">
			<h2 class="popup-title no-line c-green txt-center">Đặt lại mật khẩu thành công!</h2>
			<p class="title-sub">Tham gia ngay các hoạt động thú vị để có cơ hội nhận quà hấp dẫn<br class="u-pc">
			từ Lotte Xylitol nào !</p>
			<div class="img-popup"><img src="<?php echo APP_ASSETS; ?>img/register/img-popup.png" alt=""></div>
			<p class="text-thanks">Trang sẽ tự động chuyển trong vòng <b class="redirect-time-count fs-24 c-green">5</b> giây.<br>
			Nếu hệ thống không tự chuyển, vui lòng <a href="/signin/" class="link-signin">nhấp vào đây</a> để tiếp tục</p>
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
