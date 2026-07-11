<?php
// Author: A+LIVE
include_once ('../app_config.php');
include (APP_PATH . 'libs/lotte-api.php');

$user = $lotte_api->get_current_user();
if($user == false) {
    header('Location: /signin?redirect_to=' . urlencode($_SERVER['REQUEST_URI']));
    exit();
}

include (APP_PATH . 'libs/head.php');

$info = (array) $lotte_api->get_activity_info();

$contest_start = isset($info['contest_start']) ? $info['contest_start'] : '';
$contest_expires = isset($info['contest_expires']) ? (int) $info['contest_expires'] : -1;
$contest_link = isset($info['contest_link']) ? $info['contest_link'] : '';

$survey_start = isset($info['survey_start']) ? $info['survey_start'] : '';
$survey_expires = isset($info['survey_expires']) ? (int) $info['survey_expires'] : -1;
$survey_link = isset($info['survey_link']) ? $info['survey_link'] : '';

$survey_brand_start = isset($info['survey_brand_start']) ? $info['survey_brand_start'] : '';
$survey_brand_expires = isset($info['survey_brand_expires']) ? (int) $info['survey_brand_expires'] : -1;
$survey_brand_link = isset($info['survey_brand_link']) ? $info['survey_brand_link'] : '';

$game_start = isset($info['game_start']) ? $info['game_start'] : '';
$game_expires = isset($info['game_expires']) ? (int) $info['game_expires'] : -1;
$game_link = isset($info['game_link']) ? $info['game_link'] : '';

$coming_soon = isset($_GET['coming-soon']);

?>
</head>

<body id="page-activity" class="page-activity product vn">
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
                    <li class="white">Hoạt động thành viên</li>
                </ul>
            </div>
            <h1 class="section-title white">Hoạt động thành viên</h1>
            <div class="section">
                <div class="activity-grid">
                    <?php /*/ ?><div class="activity-item">
                        <div class="activity-img"><img src="<?php echo APP_ASSETS; ?>img/activity/activity-01.png" alt=""></div>
                        <div class="activity-title js-activity"><span>KHẢO SÁT</span>
                            <div class="activity-sub">Thời gian tổ chức: 6 tháng/lần</div>
                        </div>
                        <div class="activity-content">
                            <?php if($survey_start == '') :?>
                            <div class="activity-text">Thời gian tham gia cuộc thi ảnh đã hết, vui lòng quay lại vào lần sau hoặc tham gia ngay các hoạt động khác để nhận nhiều phần quà hấp dẫn</div>
                            <?php elseif($survey_expires <= 0) :?>
                            <div class="activity-text">Trở thành fan cứng của Lotte Xylitol. Tham gia khảo sát, nhận quà liền tay!</div>
                            <a href="<?php echo $survey_link ?>" data-exp="<?php echo $survey_expires ?>" class="activity-btn">THAM GIA NGAY</a>
                            <?php elseif($survey_link == '#') :?>
                            <div class="activity-text">Bạn đã hoàn thành khảo sát gần đây. Vui lòng quay lại sau 6 tháng kể từ ngày làm khảo sát hoặc tham gia ngay các hoạt động khác.</div>
                            <div class="activity-btn">THAM GIA CÁC HOẠT ĐỘNG KHÁC</div>
                            <?php else :?>
                            <div class="activity-text">Bạn đã làm khảo sát hơn 6 tháng trước. Đã đến lúc tham gia khảo sát mới và nhận quà hấp dẫn. Hãy chia sẻ ý kiến của bạn để Lotte Xylitol phục vụ bạn tốt hơn hơn.</div>
                            <a href="<?php echo $survey_link ?>" data-exp="<?php echo $survey_expires ?>" class="activity-btn">THAM GIA NGAY</a>
                            <?php endif;?>
                            <div class="pkg pkg1"><img src="<?php echo APP_ASSETS; ?>img/activity/pkg01.png" alt=""></div>
                            <div class="pkg pkg2"><img src="<?php echo APP_ASSETS; ?>img/activity/pkg02.png" alt=""></div>
                        </div>
                    </div><?php /*/ ?>
                    <div class="activity-item">
                        <div class="activity-img"><img src="<?php echo APP_ASSETS; ?>img/activity/activity-02.png" alt=""></div>
                        <div class="activity-title js-activity"><span>CUỘC THI HÌNH ẢNH</span>
                            <div class="activity-sub">Thời gian tổ chức: 3 tháng/lần</div>
                        </div>
                        <div class="activity-content">
                            <?php if($contest_start == '') :?>
                            <div class="activity-text">Thời gian tham gia cuộc thi ảnh đã hết, vui lòng quay lại vào lần sau hoặc tham gia ngay các hoạt động khác để nhận nhiều phần quà hấp dẫn</div>
                            <?php elseif($contest_expires <= 0) :?>
                            <div class="activity-text">Thử sức trong cuộc thi ảnh của Lotte Xylitol, nhận ngay cơ hội quay số may mắn trúng thưởng hàng quý.</div>
                            <a href="<?php echo $contest_link ?>" data-exp="<?php echo $contest_expires ?>" class="activity-btn">THAM GIA NGAY</a>
                            <?php elseif($contest_link == '#') :?>
                            <div class="activity-text">Bạn đã tham gia cuộc thi ảnh của Lotte Xylitol gần đây. Vui lòng quay lại sau 3 tháng kể từ ngày tham gia hoạt động hoặc tham gia ngay các hoạt động khác để nhận thêm nhiều phần quà hấp dẫn.</div>
                            <div class="activity-btn">THAM GIA CÁC HOẠT ĐỘNG KHÁC</div>
                            <?php else :?>
                            <div class="activity-text">Chào mừng bạn đã trở lại với cuộc thi ảnh của Lotte Xylitol. Đã đến lúc tham gia lại chương trình và nhận lấy nhiều phần quà hấp dẫn</div>
                            <a href="<?php echo $contest_link ?>" data-exp="<?php echo $contest_expires ?>" class="activity-btn">THAM GIA NGAY</a>
                            <?php endif;?>
                            <div class="pkg pkg1"><img src="<?php echo APP_ASSETS; ?>img/activity/pkg01.png" alt=""></div>
                            <div class="pkg pkg2"><img src="<?php echo APP_ASSETS; ?>img/activity/pkg02.png" alt=""></div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-img"><img src="<?php echo APP_ASSETS; ?>img/activity/activity-03.png" alt=""></div>
                        <div class="activity-title js-activity"><span>đại SỨ lotte xylitol</span>
                            <div class="activity-sub">Thời gian tổ chức: 1 tháng/lần</div>
                        </div>
                        <div class="activity-content">
                            <?php if($survey_brand_start == '') :?>
                            <div class="activity-text">Thời gian tham gia hoạt động Đại sứ thương hiệu của Lotte Xylitol đã hết, vui lòng quay lại vào lần sau hoặc tham gia ngay các hoạt động khác để nhận nhiều phần quà hấp dẫn</div>
                            <?php elseif($survey_brand_expires <= 0) :?>
                            <div class="activity-text">Trở thành Đại sứ thương hiệu của Lotte Xylitol!<br >Tham gia ngay để có cơ hội nhận những phần quà hấp dẫn từ Lotte Xylitol.</div>
                            <a href="<?php echo $survey_brand_link ?>" data-exp="<?php echo $survey_brand_expires ?>" class="activity-btn">THAM GIA NGAY</a>
                            <?php elseif($survey_brand_link == '#') :?>
                            <div class="activity-text">Bạn đã tham gia hoạt động Đại sứ thương hiệu của Lotte Xylitol gần đây. Vui lòng quay lại sau 1 tháng kể từ ngày tham gia hoạt động hoặc tham gia ngay các hoạt động khác để nhận thêm nhiều phần quà hấp dẫn.</div>
                            <div class="activity-btn">THAM GIA CÁC HOẠT ĐỘNG KHÁC</div>
                            <?php else :?>
                            <div class="activity-text">Chào mừng bạn đã trở lại với chương trình Đại sứ thương hiệu Lotte Xylitol!Đã đến lúc tham gia lại chương trình và nhận lấy nhiều phần quà hấp dẫn.</div>
                            <a href="<?php echo $survey_brand_link ?>" data-exp="<?php echo $survey_brand_expires ?>" class="activity-btn">THAM GIA NGAY</a>
                            <?php endif;?>
                            <div class="pkg pkg1"><img src="<?php echo APP_ASSETS; ?>img/activity/pkg01.png" alt=""></div>
                            <div class="pkg pkg2"><img src="<?php echo APP_ASSETS; ?>img/activity/pkg02.png" alt=""></div>
                        </div>
                    </div>
                    <?php if($coming_soon) :?>
                    <div class="activity-item coming-soon">
                        <div class="activity-img u-sp">
                            <img width="100" src="<?php echo APP_ASSETS; ?>img/activity/pkg01.png" alt="" />
                        </div>
                        <div class="activity-title">
                            <strong>Hoạt động <br >sắp diễn ra</strong>
                        </div>
                    </div>
                    <?php else :?>
                    <div class="activity-item">
                        <div class="activity-img"><img src="<?php echo APP_ASSETS; ?>img/activity/activity-04.png" alt=""></div>
                        <div class="activity-title js-activity"><span>Giải Cứu Răng Xinh</span>
                            <div class="activity-sub">Thời gian tổ chức: 2 tuần/lần</div>
                        </div>
                        <div class="activity-content">
                            <?php if($game_start == '') :?>
                            <div class="activity-text">Thời gian tham gia thử thách diệt vi khuẩn gây sâu răng với Game Giải Cứu Răng Xinh đã hết, vui lòng quay lại vào lần sau hoặc tham gia ngay các hoạt động khác để nhận nhiều phần quà hấp dẫn</div>
                            <div class="activity-btn">THAM GIA CÁC HOẠT ĐỘNG KHÁC</div>
                            <?php elseif($game_link == '#') :?>
                            <div class="activity-text">Bạn đã tham gia thử thách diệt vi khuẩn gây sâu răng với Game Giải Cứu Răng Xinh của Lotte Xylitol gần đây. Vui lòng quay lại sau 2 tuần kể từ ngày tham gia hoạt động hoặc tham gia ngay các hoạt động khác để nhận thêm nhiều phần quà hấp dẫn.</div>
                            <div class="activity-btn">THAM GIA CÁC HOẠT ĐỘNG KHÁC</div>
                            <?php else :?>
                            <div class="activity-text">Vượt qua thử thách diệt vi khuẩn gây sâu răng với Game Giải Cứu Răng Xinh để nhận quà hấp dẫn</div>
                            <a href="<?php echo $game_link ?>" data-exp="<?php echo $game_expires ?>" class="activity-btn">THAM GIA NGAY</a>
                            <?php endif?>
                            <div class="pkg pkg1"><img src="<?php echo APP_ASSETS; ?>img/activity/pkg01.png" alt=""></div>
                            <div class="pkg pkg2"><img src="<?php echo APP_ASSETS; ?>img/activity/pkg02.png" alt=""></div>
                        </div>
                    </div>
                    <?php endif?>
                </div>
            </div>
        </main>
    </div><!-- #wrap -->

    <!-- Footer
    ================================================== -->
    <?php include (APP_PATH . 'libs/footer.php'); ?>
    <!-- End Document
================================================== -->

</html>
