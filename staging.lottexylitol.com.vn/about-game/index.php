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

<body id="about-game" class="about-game about-photo-contest about-brand-ambassador about-survey product vn">
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
                    <li>Giới thiệu game</li>
                </ul>
            </div>
            <h1 class="section-title">Giới thiệu game</h1>
            <div class="section">
                <div class="section-contest">
                    <div class="section-small">
                        <div class="title-contest">ĐỐI TƯỢNG tham gia</div>
                        <p class="text-content u-pb-60 u-sp-pb-34">Hoạt động dành cho thành viên của Lotte Xylitol.</p>
                        <div class="title-contest">THỂ LỆ tham gia</div>
                        <p class="text-content">Tham gia ngay vào Game “Giải Cứu Răng Xinh” cùng Lotte Xylitol siêu vui nhộn</p>
                        <div class="txt-center u-pb-60 u-sp-pb-34 u-mt-26 u-sp-mt-16">
                            <span class="text-star u-inline-block">được tổ chức mỗi 2 tuần một lần!</span>
                        </div>
                        <div class="title-contest">Thể lệ trò chơi</div>
                        <p class="text-content u-pb-60 u-sp-pb-34">Răng của bạn đang bị tấn công bởi hàng loạt vi khuẩn gây sâu răng!
                        Nhiệm vụ của bạn là di chuyển hũ kẹo gum LOTTE XYLITOL để bắn hạ các vi khuẩn, giúp răng khỏe mạnh và trắng sáng trở lại.</p>
                        <div class="title-contest">Cách chơi</div>
                        <div class="txt-center">
                            <img width="250" src="<?php echo APP_ASSETS; ?>img/about-game/img01.png" alt="">
                        </div>
                        <div class="text-star u-mt-26 u-sp-mt-16">Mỗi vi khuẩn bị tiêu diệt, bạn sẽ nhận được 1 điểm.</div>
                        <div class="text-star u-mt-26 u-sp-mt-16">Trò chơi có 10 cấp độ, cấp độ càng cao, vi khuẩn xuất hiện càng nhiều.</div>
                        <div class="text-star u-mt-26 u-sp-mt-16">Hãy nhanh tay tiêu diệt vi khuẩn trước khi chúng chạm đến vạch an toàn và lấp đầy. Nếu vi khuẩn chạm đến vạch an toàn và lấp đầy, trò chơi sẽ kết thúc.</div>
                        <div class="title-contest u-mt-60 u-sp-mt-30">Kết quả và QUÀ TẶNG</div>
                        <p class="text-content">Kết quả cuối cùng dựa trên số điểm bạn đạt được từ việc tiêu diệt vi khuẩn.</p>
                        <div class="text-star u-pb-30 u-sp-pb-30 u-mt-26 u-sp-mt-16">Trong vòng 2 phút, 10 người chơi đạt điểm cao nhất sẽ chiến thắng và nhận được phần quà hấp dẫn là 1 hũ Lotte Xylitol Lime Mint Handy.</div>
                        <div class="txt-center">
                            <img src="<?php echo APP_ASSETS; ?>img/about-game/img-02.jpg" alt="">
                        </div>
                        <div class="txt-center u-pb-72 u-sp-pb-36">
                            <a href="<?php echo $link ?>" class="btn-dark-green hover">tham gia ngay</a>
                        </div>
                        <div class="organizer-decisions" style="text-transform: none;">
                            <p>Trong trường hợp có nhiều người chơi sở hữu cùng số điểm, Ban tổ chức sẽ dựa trên các tiêu chí phụ (ví dụ: thời gian hoàn thành sớm hơn hoặc người chơi thực hiện đầy đủ các bước đăng ký hợp lệ, đẩy đủ, không trùng lặp,...) để lựa chọn người chiến thắng hợp lệ.</p>
                            <p>Quyết định của Ban Tổ Chức là quyết định cuối cùng trong mọi trường hợp khiếu nại hoặc tranh chấp liên quan đến kết quả chương trình.</p>
                        </div>
                    </div>
                </div>
                <div class="pkg pkg-xylitol"><img src="<?php echo APP_ASSETS; ?>img/about-photo-contest/xylitol.png?v=20260407" alt=""></div>
                <div class="pkg pkg-board"><img src="<?php echo APP_ASSETS; ?>img/about-game/tooth.png" alt=""></div>
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
