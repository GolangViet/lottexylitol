<?php
// Author: A+LIVE
include_once ('../app_config.php');
include (APP_PATH . 'libs/lotte-api.php');
$user = $lotte_api->get_current_user();
if( $user == false ) {
	echo '<meta http-equiv="refresh" content="0; url=/signin?redirect_to=' . urlencode($_SERVER['REQUEST_URI']).'">';
	exit;
}

// Kiem tra thoi han
$lotte_api->check_contest_expired();

include (APP_PATH . 'libs/head.php');
?>
</head>

<body id="photo-contest" class="photo-contest product vn">
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
            <h1 class="section-title">
                Cuộc thi hình ảnh<br>
                Răng chắc khỏe cười rạng ngời
            </h1>
            <div class="section section-contest">
                <div class="create-photo">
                    <div class="frame">
                        <div class="frame-title">CHỌN FRAME CÓ SẴN</div>
                        <a class="arrows arrow-prev"><img src="<?php echo APP_ASSETS; ?>img/photo-contest/arrow.png" alt=""></a>
                        <a class="arrows arrow-next"><img class="u-pc" src="<?php echo APP_ASSETS; ?>img/photo-contest/arrow-w.png" alt=""><img class="u-sp"
                                src="<?php echo APP_ASSETS; ?>img/photo-contest/arrow.png" alt=""></a>
                        <div class="frame-slider">
                            <div class="slide-item">
                                <div class="frame-img"><img src="<?php echo APP_ASSETS; ?>img/photo-contest/frame-01.png" alt=""></div>
                                <a href="" class="frame-btn" data-img="<?php echo APP_ASSETS; ?>img/photo-contest/frame-01.png">chọn</a>
                            </div>
                            <div class="slide-item">
                                <div class="frame-img"><img class="select-img" src="<?php echo APP_ASSETS; ?>img/photo-contest/frame-02.png" alt=""></div>
                                <a href="" class="frame-btn" data-img="<?php echo APP_ASSETS; ?>img/photo-contest/frame-02.png">chọn</a>
                            </div>
                            <div class="slide-item">
                                <div class="frame-img"><img src="<?php echo APP_ASSETS; ?>img/photo-contest/frame-03.png" alt=""></div>
                                <a href="" class="frame-btn" data-img="<?php echo APP_ASSETS; ?>img/photo-contest/frame-03.png">chọn</a>
                            </div>
                        </div>
                    </div>
                    <div class="photo-preview">
                        <div class="photo-preview-inner">
                            <div class="frame-title">ảnh chụp của bạn</div>
                            <div class="img-preview icon">
                                <label for="upload-img" class="upload-in-frame"></label>
                                <canvas id="img-preview"></canvas>
                            </div>
                            <a class="upload-img">
                                <input type="file" id="upload-img" name="upload-img" accept="image/*">
                                <label for="upload-img">TẢI LÊN HÌNH ẢNH</label>
                            </a>
                            <a class="download-img">TẢI VỀ HÌNH ẢNH</a>
                            <div class="pkg pkg-girl"><img src="<?php echo APP_ASSETS; ?>img/photo-contest/pkg-girl.png" alt=""></div>
                            <div class="pkg pkg-xylitol"><img src="<?php echo APP_ASSETS; ?>img/photo-contest/pkg-xylitol.png" alt=""></div>
                        </div>
                        <a href="/about-photo-contest/" class="instruct u-pc">HƯỚNG DẪN THAM GIA</a>
                    </div>
                </div>
                <a href="/about-photo-contest/" class="instruct u-sp">HƯỚNG DẪN THAM GIA</a>
                <div class="frame-title white">Khung dán link facebook</div>
                <input type="text" name="link-fb" id="link-fb" class="js-contest-url" placeholder="Nhập link facebook..." data-error="Vui lòng nhập link facebook">
                <a href="#" class="submit-link js-contest-submit">Gửi thông tin</a>
                <input type="hidden" class="redirect_to" value="/photo-contest/thanks/" />
            </div>
        </main>
    </div><!-- #wrap -->

    <!-- Footer 
    ================================================== -->
    <?php include (APP_PATH . 'libs/footer.php'); ?>
    <!-- End Document
================================================== -->

    <?php include (APP_PATH . 'libs/popup-error.php'); ?>
    
    <script src="<?php echo APP_ASSETS; ?>js/slick/slick.js"></script>
    <script src="<?php echo APP_ASSETS; ?>js/script.js"></script>
    <script>
        $( '.frame-slider' ).slick( {
            arrows: true,
            dots: false,
            vertical: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow: $( '.arrow-next' ),
            nextArrow: $( '.arrow-prev' ),
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        vertical: false,
                    }
                },
            ]
        } );
    </script>
</body>

</html>