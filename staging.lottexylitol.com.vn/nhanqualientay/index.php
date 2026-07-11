<?php
die('<meta http-equiv="refresh" content="0; url=/membership-activities/">');
// Author: A+LIVE
include_once(dirname(__DIR__) . '/app_config.php');
include(APP_PATH . 'libs/lotte-api.php');

include(APP_PATH . 'libs/head-must-buy.php');

include(APP_PATH . 'libs/head.php');

$show_snsBox = false;

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
<?php if ($step != 'lock') : ?>
    <link rel="stylesheet" href="<?php echo APP_ASSETS; ?>css/jquery-ui.css">
<?php endif ?>
<meta name="csrf" content="<?php echo $csrf_token ?>" />
</head>

<body id="about-photo-contest" class="about-photo-contest product vn about-must-buy <?php echo $class ?>" <?php echo $body_attr ?>>
    <!-- Header
    ================================================== -->
    <?php include(APP_PATH . 'libs/header.php'); ?>
    <?php

    require_once(MUSTBUY_PATH . '/inc/wrap.php');

    if ($lotte_api->get_time() > $time_to) {
        $is_coming = true;
        require_once(MUSTBUY_PATH . '/inc/modal-end.php');
    } else if ($is_coming) {
        require_once(MUSTBUY_PATH . '/inc/modal-coming.php');
    } else {
        if ($step != 'lock') {
            require_once(MUSTBUY_PATH . '/inc/modal-start.php');

            if ($user != false) {
                require_once(MUSTBUY_PATH . '/inc/modal-lucky.php');
            }
        }

        if ($user != false) {
            require_once(MUSTBUY_PATH . '/inc/modal-code.php');
        }

        require_once(MUSTBUY_PATH . '/inc/modal-noti.php');
    }

    require_once(APP_PATH . 'libs/popup-error.php');

    ?>
    <!-- Footer
    ================================================== -->
    <?php
    include(APP_PATH . 'libs/footer.php');
    ?>
    <!-- End Document
================================================== -->
    <script src="<?php echo APP_ASSETS; ?>js/lottie.js"></script>
    <?php if ($is_coming == false) : ?>
    <script>
        var error_expired = 'Phiên đăng nhập của bạn đã hết hạn sau 20 phút không hoạt động. Vui lòng <a href="<?php echo $login_link ?>"><b>đăng nhập</b></a> lại để tiếp tục';
    </script>
    <script src="<?php echo APP_ASSETS; ?>js/lib/jquery-ui-1.14.1.min.js"></script>
    <script src="<?php echo APP_ASSETS; ?>js/lib/jquery.ui.touch-punch.min.js"></script>
    <script src="<?php echo APP_ASSETS; ?>js/must-buy.js?v=<?php echo filemtime(APP_PATH . '/assets/js/must-buy.js') ?>"></script>
    <script>
        jQuery(function($){
            $.fancybox({'padding': 0, content: $('#modal-noti')});

            $(window).on('load', function () {
                var intervalID = setInterval(function () {
                    let p = $('.modal-noti-countdown'),
                        value = parseInt(p.text()) - 1;

                    p.text(value);

                    if(value <= 0) {
                        clearInterval(intervalID);

                        // $('#modal-noti').addClass('u-hidden');

                        $.fancybox.close();
                    }
                }, 1000);
            });
        })
    </script>
    <?php endif ?>
</body>

</html>
