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

<body id="about-photo-contest" class="about-photo-contest product vn">
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
                    <li>Cuộc thi hình ảnh</li>
                </ul>
            </div>
            <h1 class="section-title">
                GIới thiệu cuộc thi hình ảnh<br>
                Răng chắc khỏe cười rạng ngời
            </h1>
            <div class="section">
                <div class="section-contest">
                    <div class="title-contest">ĐỐI TƯỢNG tham gia</div>
                    <p class="text-content u-pb-60 u-sp-pb-34">Hoạt động dành cho thành viên của Lotte Xylitol.</p>
                    <div class="title-contest">THỂ LỆ tham gia</div>
                    <p class="text-content">Cuộc thi ảnh được tổ chức hàng quý, diễn ra xuyên suốt 3 tháng của quý<br>
                        Tham gia ngay bằng những bước sau :</p>
                    <ul class="step">
                        <li>
                            <div class="step-title"><span class="step-number">bước 1 : </span>Chọn ngay 1 trong 3 khung hình có sẵn, tải hình ảnh của bạn và ghép với các khung hình này nhé.</div>
                        </li>
                        <li>
                            <div class="step-title"><span class="step-number">bước 2 : </span>Tải xuống hình ảnh.</div>
                        </li>
                        <li>
                            <div class="step-title"><span class="step-number">bước 3 : </span>Đăng tải hình ảnh này lên trang facebook cá nhân chế độ công khai kèm hashtag #lottexylitol và con số may mắn
                                từ 1-1000.</div>
                        </li>
                        <li>
                            <div class="step-title"><span class="step-number">bước 4 : </span>Đăng tải link bài viết của bạn lên trang website.</div>
                        </li>
                    </ul>
                    <p class="text-content u-pb-30 u-sp-pb-24">05 bạn thực hiện chính xác, đầy đủ các bước sẽ được LOTTE XYLITOL lựa chọn ngẫu nhiên dựa trên con số may mắn để nhận quà đó! Nhanh tay chơi và shoot-your-shot thôi !</p>
                    <p class="text-content u-pb-60 u-sp-pb-32">Danh sách người chiến thắng sẽ được công bố trên Fan-site và Fanpage Lotte Xylitol</p>
                    <div class="title-contest">QUÀ TẶNG</div>
                    <div class="gift-contest row row-2 gutter-25">
                        <div class="col-3">
                            <div class="gift-contes-img">
                                <img src="<?php echo APP_ASSETS; ?>img/about-photo-contest/gift-img-01.jpg?v=20260407" alt="">
                            </div>
                            <div class="gift-contes-title">
                                01 Evoucher<br>
                                (100.000 VND)
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="gift-contes-img">
                                <img src="<?php echo APP_ASSETS; ?>img/about-photo-contest/gift-img-02.jpg" alt="">
                            </div>
                            <div class="gift-contes-title">
                                10 hũ kẹo gum Lotte Xylitol Lime mint Handy + 03 hũ kẹo gum Lotte Xylitol Lime mint Family
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="gift-contes-img">
                                <img src="<?php echo APP_ASSETS; ?>img/about-photo-contest/gift-img-03.jpg" alt="">
                            </div>
                            <div class="gift-contes-title">01 hộp Lotte Chocolat 12 bánh</div>
                        </div>
                    </div>
                    <div class="txt-center u-pb-72 u-sp-pb-36">
                        <a href="<?php echo $link ?>" class="btn-dark-green hover">tham gia ngay</a>
                    </div>
                    <div class="organizer-decisions">Ban tổ chức là người có quyền quyết định cuối cùng về kết quả chương trình.</div>
                </div>
                <div class="pkg pkg-lemon"><img src="<?php echo APP_ASSETS; ?>img/about-photo-contest/lemon.png" alt=""></div>
                <div class="pkg pkg-man"><img src="<?php echo APP_ASSETS; ?>img/about-photo-contest/man.png" alt=""></div>
                <div class="pkg pkg-xylitol"><img src="<?php echo APP_ASSETS; ?>img/about-photo-contest/xylitol.png?v=20260407" alt=""></div>
                <div class="pkg pkg-tooth"><img src="<?php echo APP_ASSETS; ?>img/about-photo-contest/tooth.png" alt=""></div>
                <div class="pkg pkg-baloon"><img src="<?php echo APP_ASSETS; ?>img/about-photo-contest/baloon.png" alt=""></div>
                <div class="pkg pkg-1"><img src="<?php echo APP_ASSETS; ?>img/about-photo-contest/pkg.png" alt=""></div>
            </div>
        </main>
    </div><!-- #wrap -->

    <!-- Footer
    ================================================== -->
    <?php include (APP_PATH . 'libs/footer.php'); ?>
    <!-- End Document
================================================== -->
    <script src="<?php echo APP_ASSETS; ?>js/lib/jquery.matchHeight.min.js"></script>
    <script>
        $( function ()
        {
            $( '.gift-contest .col-3 .gift-contes-title' ).matchHeight();
            $( '.gift-contest .col-3' ).matchHeight();
        } );
    </script>
</body>

</html>
