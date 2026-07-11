<?php
die('<meta http-equiv="refresh" content="0; url=/en/membership-activities/">');
// Author: A+LIVE
include_once('../../app_config.php');
include(APP_PATH . 'libs/lotte-api.php');

$csrf_token = $lotte_api->get_csrf();

$user = $lotte_api->get_current_user();
if ($user == false || empty($user['lucky_luxury'])) {
    echo '<meta http-equiv="refresh" content="0; url=/en/">';
    exit;
}

include(APP_PATH . 'libs/head.php');

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
<style>
.modal-must-buy-lucky .lucky-title {
    font-size: 22px;
}
</style>
</head>

<body id="about-photo-contest" class="about-photo-contest product en about-must-buy <?php echo $class ?>">
    <!-- Header
    ================================================== -->
    <?php include(APP_PATH . 'libs/header.php'); ?>
    <div id="wrap">
        <!-- Main Content
        ================================================== -->
        <main class="main bgmain">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/en/">Top</a></li>
                    <li><a href="/en/membership-activities/">Membership Activities</a></li>
                    <li>Lucky Bottle</li>
                </ul>
            </div>
            <div class="bottle-slogan bottle-slogan--2 lottie-icon" data-src="/assets/json/bottle-slogan-en/slogan-en.json"></div>
            <div class="section">
                <div class="section-contest section-must-buy lucky active" id="lucky">
                    <img src="<?php echo APP_ASSETS; ?>img/must-buy/img-quet-qr-screen-2.png" alt="" />
                    <div class="play__button">
                        <div class="play__lucky" data-src="/assets/json/must-buy/lac-ngay.json"></div>
                        <p>
                            <a class="btn-dark-green-2 shadow js-btn-welcome">
                                <span>PLAY NOW</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div><!-- #wrap -->

    <section id="modal-lucky" class="modal-must-buy-lucky">
        <div class="content content-josefin-sans">
            <div class="lucky-content">
                <div class="lucky-title">CONGRATULATIONS</div>
                <div class="lucky-text">
                    PHONE NUMBER <span class="js-phone">091****123</span><br>
                    HAS WON THE <strong class="txt-red">GRAND PRIZE</strong><br>
                    FROM THE LUCKY DRAW
                </div>
                <div class="lucky-image" style="margin-bottom: 0;">
                    <img src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-prize-vision.png" alt="" />
                </div>
                <div class="lucky-text-2">
                    01 STANDARD HONDA VISION MOTORBIKE
                </div>
            </div>
            <div class="lucky-bottom">THE ORGANIZER  LOTTE XYLITOL WILL CONTACT YOU TO CONFIRM YOUR PRIZE</div>
        </div>
    </section>

    <section id="box-lucky-welcome" class="box-thanks box-wellcom box-must-buy">
        <div class="content content-josefin-sans txt-center">
            <div class="txt-green-2 txt-upper txt-bold u-mb-20 u-sp-mb-20">
                TAP TO SHAKE AND SELECT THE LUCKY WINNER OF THE HONDA VISION MOTORBIKE
            </div>
            <div class="code-description u-mb-20 u-sp-mb-20">
                <img src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-01.png" alt="" />
            </div>
            <div class="form-group u-mb-30">
                <a class="btn-dark-green-2 shadow-2 hover js-btn-play"><span>SHAKE IT NOW</span></a>
            </div>
            <div class="txt-green-2">
                The results are randomly selected from the winners of the 'Lucky Card' prize.
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
