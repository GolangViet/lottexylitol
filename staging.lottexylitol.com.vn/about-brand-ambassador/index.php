<?php
// Author: A+LIVE
include_once ('../app_config.php');
include (APP_PATH . 'libs/lotte-api.php');

$user = $lotte_api->get_current_user();

$link = '/activity-page';
if($user == false) {
    $link = $login_link;
}

include (APP_PATH . 'libs/head.php');

$brand = $lotte_api->get_page('brand');

$info = [
    'about_ba_title' => 'Câu hỏi tháng 10',
    'question_name' => 'Lotte Xylitol có ý nghĩa như thế nào với bạn. Hãy thể hiện cảm nghĩ của bạn về Lotte Xylitol nhé.',
];

if(is_array($brand)) {
    if(!empty($brand['about_ba_title'])) {
        $info['about_ba_title'] = $brand['about_ba_title'];
    }

    if(!empty($brand['questions'])) {
        foreach($brand['questions'] as $question) {
            if(!empty($question['name'])) {
                $info['question_name'] = $question['name'];
                break;
            }
        }
    }
}

?>
</head>

<body id="about-brand-ambassador" class="about-photo-contest about-brand-ambassador product vn">
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
                    <li>Đại sứ Lotte Xylitol</li>
                </ul>
            </div>
            <h1 class="section-title">Đại sứ Lotte Xylitol</h1>
            <div class="section">
                <div class="section-contest">
                    <div class="section-small">
                        <div class="title-contest">Đối Tượng Tham Gia</div>
                        <p class="text-content u-pb-60 u-sp-pb-34">Hoạt động dành cho thành viên của Lotte Xylitol.</p>
                        <div class="title-contest"><?php echo $info['about_ba_title'] ?></div>
                        <p class="text-content u-pb-60 u-sp-pb-34"><?php echo $info['question_name'] ?></p>
                        <div class="title-contest">Thể Lệ Tham Gia</div>
                        <p class="text-content">Hoạt động “Đại sứ Lotte Xylitol” được tổ chức hàng tháng. </p>
                        <p class="text-star u-mt-26 u-sp-mt-16">Tham gia chia sẻ suy nghĩ của bạn về Lotte Xylitol  (Câu hỏi sẽ được cập nhật mỗi tháng) </p>
                        <p class="text-star">05 bạn có chia sẻ thú vị nhất về Lotte Xylitol sẽ nhận được hộp quà đặc biệt từ Lotte Xylitol </p>
                        <p class="text-star">Danh sách người chiến thắng sẽ được công bố trên cả Fan-site và Fanpage Lotte Xylitol.</p>
                        <div class="title-contest u-mt-60 u-sp-mt-30">QUÀ TẶNG</div>
                        <p class="text-content">01 hộp quà đặc biệt bao gồm :</p>
                        <div class="gift-ambassador">
                            <div class="gift-ambassador-img"><img src="<?php echo APP_ASSETS; ?>img/about-brand-ambassador/img-01.jpg" alt=""></div>
                            <div class="gift-ambassador-title">
                                01 hũ kẹo gum Lotte Xylitol limemint với hình ảnh của ca sĩ Orange kèm chữ ký<br>
                                + 01 bàn chải điện<br>
                                + 04 hộp kẹo gum Lotte Xylitol dạng vỉ<br>
                                + 01 Giấy chứng nhận “Đại sứ thương hiệu” của Lotte Xylitol.
                            </div>
                        </div>
                        <div class="txt-center u-pb-66 u-sp-pb-36">
                            <a href="<?php echo $link ?>" class="btn-dark-green hover">tham gia ngay</a>
                        </div>
                        <div class="organizer-decisions">Ban tổ chức là người có quyền quyết định cuối cùng về kết quả chương trình.</div>
                    </div>
                </div>
                <div class="pkg pkg-gift"><img src="<?php echo APP_ASSETS; ?>img/about-brand-ambassador/gift.png" alt=""></div>
                <div class="pkg pkg-xylitol"><img src="<?php echo APP_ASSETS; ?>img/about-photo-contest/xylitol.png?v=20260407" alt=""></div>
                <div class="pkg pkg-text-xylitol"><img src="<?php echo APP_ASSETS; ?>img/about-brand-ambassador/text-xylitol.png" alt=""></div>
                <div class="pkg pkg-xylitol-baloon"><img src="<?php echo APP_ASSETS; ?>img/about-brand-ambassador/xylitol-baloon.png" alt=""></div>
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
