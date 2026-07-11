<?php
die('<meta http-equiv="refresh" content="0; url=/membership-activities/">');
// Author: A+LIVE
include_once('../app_config.php');
include(APP_PATH . 'libs/lotte-api.php');

$csrf_token = $lotte_api->get_csrf();

$user = $lotte_api->get_current_user();
if ($user == false || empty($user['lucky_luxury'])) {
    echo '<meta http-equiv="refresh" content="0; url=/">';
    exit;
}

include(APP_PATH . 'libs/head.php');

// $results = [1,2,3];

$results = $lotte_api->get_list_luxury();

$show_snsBox = false;

$class = 'p-must-buy';

if (defined('RECAPTCHA_SITE_KEY')) :
?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo RECAPTCHA_SITE_KEY ?>"></script>
    <style>
        .grecaptcha-badge {
            display: none !important;
        }
    </style>
<?php endif ?>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
<meta name="csrf" content="<?php echo $csrf_token ?>" />
</head>

<body id="about-photo-contest" class="about-photo-contest product vn about-must-buy <?php echo $class ?>">
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
                    <li><a href="/membership-activities/">Hoạt động thành viên</a></li>
                    <li>Lucky Bottle</li>
                </ul>
            </div>
            <div class="bottle-slogan bottle-slogan--2 lottie-icon" data-src="/assets/json/bottle-slogan/slogan.json"></div>
            <div class="section">
                <div class="section-contest section-must-buy lucky active" id="lucky">
                    <img src="<?php echo APP_ASSETS; ?>img/must-buy/img-quet-qr-screen-2.png" alt="" />
                    <div class="play__button">
                        <div class="play__lucky" data-src="/assets/json/must-buy/lac-ngay.json"></div>
                        <p>
                            <a class="btn-dark-green-2 shadow js-btn-welcome">
                                <span>CHƠI NGAY</span>
                            </a>
                        </p>
                    </div>
                </div>
                <?php if(is_array($results) && count($results) > 0) : ?>
                <div class="section-table-results">
                    <h3>DANH SÁCH TRÚNG THƯỞNG</h3>
                    <table>
                        <?php foreach($results as $item) : ?>
                        <tr>
                            <th colspan="2"><?php echo $item['user_name'] ?></th>
                        </tr>
                        <tr>
                            <td>
                                <div class="flex-name">
                                    <img width="17" height="17" src="<?php echo APP_ASSETS; ?>img/must-buy/icon-phone.png" alt="" />
                                    <span><?php echo $item['user_phone'] ?></span>
                                </div>
                            </td>
                            <td>
                                <div class="flex-name">
                                    <img width="25" height="25" src="<?php echo APP_ASSETS; ?>img/must-buy/icon-barcode.png" alt="" />
                                    <span><?php echo $item['user_code'] ?></span>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </table>
                </div>
                <?php endif ?>
            </div>
        </main>
    </div><!-- #wrap -->

    <section id="modal-lucky" class="modal-must-buy-lucky">
        <div class="content content-josefin-sans">
            <div class="lucky-content">
                <div class="lucky-title">XIN CHÚC MỪNG</div>
                <div class="lucky-text">
                    số điện thoại <span class="js-phone">091****123</span><br>
                    đã nhận được <strong class="txt-red">giải đặc biệt</strong><br>
                    từ vòng quay may mắn
                </div>
                <div class="lucky-image" style="margin-bottom: 0;">
                    <img src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-prize-vision.png" alt="" />
                </div>
                <div class="lucky-text-2">
                    01 xe honda vision<br>
                    bản tiêu chuẩn
                </div>
            </div>
            <div class="lucky-bottom">Ban tổ chức Lotte Xylitol sẽ<br> liên hệ để xác nhận trúng giải</div>
        </div>
    </section>

    <section id="box-lucky-welcome" class="box-thanks box-wellcom box-must-buy">
        <div class="content content-josefin-sans txt-center">
            <div class="txt-green-2 txt-upper txt-bold u-mb-20 u-sp-mb-20">
                Bấm lắc ngay để chọn ra <br>
                người chơi may mắn <br>
                trúng xe honda vision
            </div>
            <div class="code-description u-mb-20 u-sp-mb-20">
                <img src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-01.png" alt="" />
            </div>
            <div class="form-group u-mb-30">
                <a class="btn-dark-green-2 shadow-2 hover js-btn-play"><span>LẮC NGAY</span></a>
            </div>
            <div class="txt-green-2">
                Kết quả được chọn ngẫu nhiên từ người trúng thưởng giải Thẻ may mắn.
            </div>
        </div>
    </section>

    <!-- Footer
    ================================================== -->
    <?php

    include(APP_PATH . 'libs/popup-error.php');

    include(APP_PATH . 'libs/footer.php');

    ?>
    <!-- End Document
================================================== -->
    <script src="<?php echo APP_ASSETS; ?>js/lottie.js"></script>
    <?php
    include(APP_PATH . 'xexindentay/script.php');
    ?>
</body>

</html>
