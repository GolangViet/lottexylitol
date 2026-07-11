<?php
// Author: A+LIVE
include_once ('../../app_config.php');
include (APP_PATH . 'libs/lotte-api.php');
$user = $lotte_api->get_current_user();
if( $user == false ) {
	echo '<meta http-equiv="refresh" content="0; url=/signin?redirect_to=' . urlencode($_SERVER['REQUEST_URI']).'">';
	exit;
}
include (APP_PATH . 'libs/head.php');
?>
</head>

<body id="page-thank" class="product vn">
	<!-- Header
	================================================== -->
	<?php include (APP_PATH . 'libs/header.php'); ?>
	<div id="wrap">
		<!-- Main Content
		================================================== -->
		<main class="main bgmain">
			<div class="breadcrumb">
				<ul>
					<li><a href="/">Trang chủ</a></li>
					<li><a href="/activity-page">Hoạt động thành viên</a></li>
					<li>Cuộc thi hình ảnh</li>
				</ul>
			</div>
			<div class="section">
				<h1 class="section-title">
					Cuộc thi hình ảnh<br>
					Răng chắc khỏe cười rạng ngời
				</h1>
				<div class="thank-box">
					<h1 class="thank-box-title">Xin chúc mừng</h1>
					<p class="thank-text">Cảm ơn <?php echo $user['name'] ?> đã tham gia các hoạt động của Lotte Xylitol, đừng quên theo dõi website để nhận kết quả quả và các thông tin mới nhất từ Lotte Xylitol nhé.</p>
					<a href="/activity-page/" class="btn-dark-green btn-center">tiếp tục</a>
					<div class="pkg pkg-xylitol"><img src="<?php echo APP_ASSETS; ?>img/brand-ambassador/xylitol.png" alt=""></div>
					<div class="pkg pkg-xylitol2"><img src="<?php echo APP_ASSETS; ?>img/brand-ambassador/xylitol2.png" alt=""></div>
				</div>
			</div>
		</main>
	</div><!-- #wrap -->

	<!-- Footer
	================================================== -->
	<?php include (APP_PATH . 'libs/footer.php'); ?>
	<!-- End Document
================================================== -->
	<script src="<?php echo APP_ASSETS; ?>js/lottie.js"></script>
	<script src="<?php echo APP_ASSETS; ?>js/script.js"></script>
</body>

</html>