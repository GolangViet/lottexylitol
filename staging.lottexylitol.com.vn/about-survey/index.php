<?php
// Author: A+LIVE
include_once ('../app_config.php');
include (APP_PATH . 'libs/head.php');
include (APP_PATH . 'libs/lotte-api.php');
$user = $lotte_api->get_current_user();

$link = '/activity-page';
if($user == false) {
    $link = $login_link;
}
?>
</head>

<body id="about-brand-ambassador" class="about-photo-contest about-brand-ambassador about-survey product vn">
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
                    <li><a href="/membership-activities/">Hoạt động thành viên</a></li>
                    <li>Làm khảo sát</li>
                </ul>
            </div>
            <h1 class="section-title">Khảo sát</h1>
            <div class="section">
                <div class="section-contest">
                    <div class="section-small">
                        <div class="title-contest">ĐỐI TƯỢNG tham gia</div>
                        <p class="text-content u-pb-60 u-sp-pb-34">Hoạt động dành cho thành viên của Lotte Xylitol. </p>
                        <div class="title-contest">THỂ LỆ tham gia</div>
                        <p class="text-content">Khảo sát được tổ chức 6 tháng/lần.</p>
                        <p class="text-star u-mt-26 u-sp-mt-16">Tham gia và hoàn thành khảo sát về Lotte Xylitol để có hội nhận được phần quà hấp dẫn là combo 3 hũ Lotte Xylitol Handy hương chanh bạc hà.</p>
                        <div class="title-contest u-mt-60 u-sp-mt-30">QUÀ TẶNG</div>
                        <p class="text-content">combo 3 hũ Lotte Xylitol Handy hương chanh bạc hà.</p>
                        <div class="gift-survey">
                            <img src="<?php echo APP_ASSETS; ?>img/about-survey/img01.png" alt="">
                        </div>
                        <div class="txt-center u-pb-66 u-sp-pb-36">
                            <a href="<?php echo $link ?>" class="btn-dark-green hover">tham gia ngay</a>
                        </div>
                    </div>
                </div>
                <div class="pkg pkg-xylitol"><img src="<?php echo APP_ASSETS; ?>img/about-photo-contest/xylitol.png?v=20260407" alt=""></div>
                <div class="pkg pkg-board"><img src="<?php echo APP_ASSETS; ?>img/about-survey/board.png" alt=""></div>
                <div class="pkg pkg-gift"><img src="<?php echo APP_ASSETS; ?>img/about-survey/gift.png" alt=""></div>
                <div class="pkg pkg-baloon"><img src="<?php echo APP_ASSETS; ?>img/about-survey/baloon.png" alt=""></div>
                <div class="pkg pkg-1"><img src="<?php echo APP_ASSETS; ?>img/about-brand-ambassador/pkg02.png" alt=""></div>
                <div class="pkg pkg-2"><img src="<?php echo APP_ASSETS; ?>img/about-brand-ambassador/pkg01.png" alt=""></div>
            </div>
        </main>
    </div><!-- #wrap -->

    <!-- Footer
    ================================================== -->
    <?php include (APP_PATH . 'libs/footer.php'); ?>
    <!-- End Document
================================================== -->
</body>

</html>
