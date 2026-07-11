<?php
// Author: A+LIVE
include_once ('../../../app_config.php');
include (APP_PATH . 'libs/lotte-api.php');
$user = $lotte_api->get_current_user();
if( $user == false ) {
	echo '<meta http-equiv="refresh" content="0; url=/en/signin?redirect_to=' . urlencode($_SERVER['REQUEST_URI']).'">';
	exit;
}
include (APP_PATH . 'libs/head.php');
?>
</head>

<body id="page-thank" class="product en">
	<!-- Header
	================================================== -->
	<?php include (APP_PATH . 'libs/header.php'); ?>
	<div id="wrap">
		<!-- Main Content
		================================================== -->
		<main class="main bgmain">
			<div class="breadcrumb">
				<ul>
                    <li><a href="/en/">Top</a></li>
                    <li><a href="/en/membership-activities/">Membership Activities</a></li>
                    <li>Photo Contest</li>
                </ul>
			</div>
			<div class="section">
				<h1 class="section-title">
					Photo Contest<br>
					Strong teeth, bright smile
				</h1>
				<div class="thank-box">
					<h1 class="thank-box-title">Congratulations</h1>
					<p class="thank-text">Thank <?php echo $user['name'] ?> for participating in Lotte Xylitol's activities. Don't forget to follow our website to receive the results and exciting updates from Lotte Xylitol.</p>
					<a href="/en/membership-activities/" class="btn-dark-green btn-center">continue</a>
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