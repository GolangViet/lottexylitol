<?php
// Author: A+LIVE
include_once ('../app_config.php');
include (APP_PATH . 'libs/lotte-api.php');
$user = $lotte_api->get_current_user();
if( $user == false ) {
	echo '<meta http-equiv="refresh" content="0; url=/signin?redirect_to=' . urlencode($_SERVER['REQUEST_URI']).'">';
	exit;
}
include (APP_PATH . 'libs/head.php');
?>
</head>

<body id="member-benefit" class="member-benefit vn">
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
                    <li class="white">Lợi ích thành viên</li>
                </ul>
            </div>
            <div class="section section-2">
                <h1 class="section-title white">
                    Tham gia ngay các hoạt động<br class="pc">
                    để tích điểm đổi quà.
                </h1>
                <div class="group-link row-2">
                    <div class="col-2">
                        <div class="group-link-img">
                            <img src="/assets/img/common/img-survey.png" alt="">
                        </div>
                        <a href="/survey/" class="link"><span>Làm bài khảo sát</span></a>
                    </div>
                    <div class="col-2">
                        <div class="group-link-img">
                            <img src="/assets/img/common/img-game.png" alt="">
                        </div>
                        <a href="/game/" class="link"><span>CHƠI TRÒ CHƠI</span></a>
                    </div>
                </div>
                <div class="cloud">
                    <div class="cloud-icon lottie-icon" data-src="/assets/json/present.json"></div>
                    <div class="cloud-title">danh sách quà tặng</div>
                </div>
                <div class="gift-list row row-2">
                    <div class="col-3">
                        <div class="gift-item">
                            <div class="badge"><img src="<?php echo APP_ASSETS; ?>/img/gift/icon-clock.png" alt="">chỉ còn 3 phần quà</div>
                            <div class="gift-img"><img src="<?php echo APP_ASSETS; ?>/img/gift/gift-img-1.png" alt=""></div>
                            <div class="gift-detail">
                                <div class="gift-name">Lorem ipsum dolor</div>
                                <div class="gift-point">3,000 Điểm</div>
                            </div>
                            <div class="line"></div>
                            <div class="gift-quantity">Số lượng còn : <span>3</span></div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="gift-item">
                            <div class="gift-img"><img src="<?php echo APP_ASSETS; ?>/img/gift/gift-img-2.png" alt=""></div>
                            <div class="gift-detail">
                                <div class="gift-name">Lorem ipsum dolor</div>
                                <div class="gift-point">3,000 Điểm</div>
                            </div>
                            <div class="line"></div>
                            <div class="gift-quantity">Số lượng còn : <span>3</span></div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="gift-item">
                            <div class="gift-img"><img src="<?php echo APP_ASSETS; ?>/img/gift/gift-img-3.png" alt=""></div>
                            <div class="gift-detail">
                                <div class="gift-name">Lorem ipsum dolor</div>
                                <div class="gift-point">3,000 Điểm</div>
                            </div>
                            <div class="line"></div>
                            <div class="gift-quantity">Số lượng còn : <span>3</span></div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="gift-item">
                            <div class="gift-img"><img src="<?php echo APP_ASSETS; ?>/img/gift/gift-img-3.png" alt=""></div>
                            <div class="gift-detail">
                                <div class="gift-name">Lorem ipsum dolor</div>
                                <div class="gift-point">3,000 Điểm</div>
                            </div>
                            <div class="line"></div>
                            <div class="gift-quantity">Số lượng còn : <span>3</span></div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="gift-item">
                            <div class="gift-img"><img src="<?php echo APP_ASSETS; ?>/img/gift/gift-img-1.png" alt=""></div>
                            <div class="gift-detail">
                                <div class="gift-name">Lorem ipsum dolor</div>
                                <div class="gift-point">3,000 Điểm</div>
                            </div>
                            <div class="line"></div>
                            <div class="gift-quantity">Số lượng còn : <span>3</span></div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="gift-item">
                            <div class="gift-img"><img src="<?php echo APP_ASSETS; ?>/img/gift/gift-img-2.png" alt=""></div>
                            <div class="gift-detail">
                                <div class="gift-name">Lorem ipsum dolor</div>
                                <div class="gift-point">3,000 Điểm</div>
                            </div>
                            <div class="line"></div>
                            <div class="gift-quantity">Số lượng còn : <span>3</span></div>
                        </div>
                    </div>

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
</body>

</html>