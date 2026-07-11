<?php
// Author: A+LIVE
include_once ('../../app_config.php');
include(APP_PATH . 'libs/lotte-api.php');
$user = $lotte_api->get_current_user();
if( $user == false ) {
	echo '<meta http-equiv="refresh" content="0; url=/en/signin?redirect_to=' . urlencode($_SERVER['REQUEST_URI']).'">';
	exit;
}

// Kiem tra thoi han
$lotte_api->check_contest_expired();

include (APP_PATH . 'libs/head.php');
?>
<link type="text/css" rel="stylesheet" href="<?php echo APP_ASSETS; ?>js/slick/slick.css">
</head>

<body id="photo-contest" class="photo-contest product en">
    <!-- Header
    ================================================== -->
    <?php include (APP_PATH . 'libs/header.php'); ?>
    <div id="wrap">
        <!-- Main Content
        ================================================== -->
        <main class="main bgmain">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/en/">Top</a></li>
                    <li><a href="/en/membership-activities/">Membership Activities</a></li>
                    <li>Photo Contest</li>
                </ul>
            </div>
            <h1 class="section-title">
                Photo Contest<br>
                Strong teeth, bright smile
            </h1>
            <div class="section section-contest">
                <div class="create-photo">
                    <div class="frame">
                        <div class="frame-title">Select a frame</div>
                        <a class="arrows arrow-prev"><img src="<?php echo APP_ASSETS; ?>img/photo-contest/arrow.png" alt=""></a>
                        <a class="arrows arrow-next"><img class="u-pc" src="<?php echo APP_ASSETS; ?>img/photo-contest/arrow-w.png" alt=""><img class="u-sp"
                                src="<?php echo APP_ASSETS; ?>img/photo-contest/arrow.png" alt=""></a>
                        <div class="frame-slider">
                            <div class="slide-item">
                                <div class="frame-img"><img src="<?php echo APP_ASSETS; ?>img/photo-contest/frame-01.png" alt=""></div>
                                <a href="" class="frame-btn" data-img="<?php echo APP_ASSETS; ?>img/photo-contest/frame-01.png">Select</a>
                            </div>
                            <div class="slide-item">
                                <div class="frame-img"><img class="select-img" src="<?php echo APP_ASSETS; ?>img/photo-contest/frame-02.png" alt=""></div>
                                <a href="" class="frame-btn" data-img="<?php echo APP_ASSETS; ?>img/photo-contest/frame-02.png">Select</a>
                            </div>
                            <div class="slide-item">
                                <div class="frame-img"><img src="<?php echo APP_ASSETS; ?>img/photo-contest/frame-03.png" alt=""></div>
                                <a href="" class="frame-btn" data-img="<?php echo APP_ASSETS; ?>img/photo-contest/frame-03.png">Select</a>
                            </div>
                        </div>
                    </div>
                    <div class="photo-preview">
                        <div class="photo-preview-inner">
                            <div class="frame-title">Your photo</div>
                            <div class="img-preview icon">
                                <label for="upload-img" class="upload-in-frame"></label>
                                <canvas id="img-preview"></canvas>
                            </div>
                            <a class="upload-img">
                                <input type="file" id="upload-img" name="upload-img" accept="image/*">
                                <label for="upload-img">Upload photo</label>
                            </a>
                            <a class="download-img">DOWNLOAD photo</a>
                            <div class="pkg pkg-girl"><img src="<?php echo APP_ASSETS; ?>img/photo-contest/pkg-girl.png" alt=""></div>
                            <div class="pkg pkg-xylitol"><img src="<?php echo APP_ASSETS; ?>img/photo-contest/pkg-xylitol.png" alt=""></div>
                        </div>
                        <a href="/en/about-photo-contest/" class="instruct u-pc">Participation instructions</a>
                    </div>
                </div>
                <a href="/en/about-photo-contest/" class="instruct u-sp">Participation instructions</a>
                <div class="frame-title white">Paste Facebook link</div>
                <input type="text" name="link-fb" id="link-fb" class="js-contest-url" placeholder="Paste Facebook link ..." data-error="Please enter facebook link">
                <a href="#" class="submit-link js-contest-submit">SUBMIT LINK</a>
                <input type="hidden" class="redirect_to" value="/en/photo-contest/thanks/" />
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