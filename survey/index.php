<?php
// Author: A+LIVE
include_once('../app_config.php');
include (APP_PATH . 'libs/lotte-api.php');
$user = $lotte_api->get_current_user();
if( $user == false ) {
	echo '<meta http-equiv="refresh" content="0; url=/signin?redirect_to=' . urlencode($_SERVER['REQUEST_URI']).'">';
	exit;
}

// Kiem tra thoi han lam bai
$lotte_api->check_survey_expired();

$items = $lotte_api->get_surveys();

include(APP_PATH . 'libs/head.php');
?>
</head>

<body id="page-survey" class="product vn">
	<!-- Header
    ================================================== -->
	<?php include(APP_PATH . 'libs/header.php'); ?>
	<div id="wrap">
		<!-- Main Content
        ================================================== -->
		<main class="main bgmain">
			<div class="breadcrumb">
				<ul>
					<li><a href="/">Trang chủ</a></li>
					<li><a href="/activity-page">Hoạt động thành viên</a></li>
					<li>Bài khảo sát</li>
				</ul>
			</div>
			<div class="section">
				<h1 class="section-title">BÀI KHẢO SÁT</h1>
				<form class="box-survey js-survey-form">
					<p class="box-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras iaculis velit vitae dui semper suscipit.</p>

					<!-- <img class="visible-lg form-img xylitol wow fadeIn" width="217" src="<?php echo APP_ASSETS; ?>img/survey/xylitol.png" alt="" />
					<img class="visible-lg form-img girl wow fadeIn" width="396" src="<?php echo APP_ASSETS; ?>img/survey/girl.png" alt="" /> -->

					<div class="visible-lg form-img wow fadeIn girl lottie-icon" data-src="/assets/json/lego.json"></div>
					<div class="visible-lg form-img wow fadeIn xylitol-svg lottie-icon" data-src="/assets/json/product02/product02.json"></div>

					<?php if (is_array($items) && count($items) > 0) : ?>
					<div class="form-group list-survey">
						<?php foreach ($items as $item) : $input_name = $item['id']; ?>
						<div class="survey-item js-question-item" data-field="<?php echo $input_name; ?>" data-type="<?php echo $item['type'] ?>" data-required="<?php echo $item['required'] ?>" <?php echo isset($item['special']) ? 'data-special="1"' : '' ?> data-error="<?php echo $item['name']; ?>">
							<div class="question"><?php echo $item['name']; ?></div>
							<div class="answer">
								<?php if ($item['type'] == 'radio') : ?>
								<div class="group-radio2">
									<?php foreach ($item['answers'] as $input) :
										$id = $input_name . '_' . $input['key'];
										$data = isset($input['data']) ? $input['data'] : '';
									?>
									<div class="radio">
										<input type="radio" id="<?php echo $id ?>" name="<?php echo $input_name?>" value="<?php echo $input['key'] ?>" <?php echo $data != '' ? 'data-value="'.$data .'"' : '' ?> />
										<label for="<?php echo $id ?>" class="radio-label"><?php echo $input['label'] ?></label>
									</div>
									<?php endforeach; ?>
								</div>
								<?php elseif ($item['type'] == 'checkbox') : ?>
								<div class="group-checkbox">
									<?php foreach ($item['answers'] as $input) :
										$id = $input_name . '_' . $input['key'];
										$data = isset($input['data']) ? $input['data'] : '';
									?>
									<label class="checkbox<?php echo $data == 'other' ? ' other' : '' ?>">
										<?php echo $input['label'] ?>
										<input type="checkbox" id="<?php echo $id ?>" name="<?php echo $id ?>" value="<?php echo $input['key'] ?>" data-old="<?php echo $input['key'] ?>" <?php echo $data != '' ? 'data-value="'.$data .'"' : '' ?> />
										<span class="checkmark"></span>
									</label>
									<?php if($data == 'other'): ?>
									<div class="form-group input-extra">
										<input type="text" class="form-control js-fill-value" data-target="#<?php echo $id ?>">
									</div>
									<?php endif; ?>
									<?php endforeach; ?>
								</div>
								<?php elseif ($item['type'] == 'input') : ?>
								<div class="form-group">
									<input type="text" name="<?php echo $input_name ?>" class="form-control" placeholder="Nhập câu trả lời của bạn" <?php echo $item['required'] == 1 ? 'required data-error="Vui lòng trả lời câu hỏi"' : '' ?>/>
								</div>
								<?php endif; ?>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
					<div class="form-group txt-center group-bottom">
						<button type="submit" class="bt-green bt-survey hover">Hoàn thành khảo sát</button>
					</div>

					<input type="hidden" class="redirect_to" value="/survey/thanks" />
				</form>

			</div>
		</main>
	</div><!-- #wrap -->

	<!-- Footer
    ================================================== -->
	<?php include(APP_PATH . 'libs/footer.php'); ?>
	<!-- End Document
================================================== -->

	<?php include (APP_PATH . 'libs/popup-error.php'); ?>

	<script src="<?php echo APP_ASSETS; ?>js/lottie.js"></script>
	<script src="<?php echo APP_ASSETS; ?>js/script.js?v=<?php echo filemtime(APP_PATH . '/assets/js/script.js') ?>"></script>
</body>

</html>
