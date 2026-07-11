<?php
// Author: A+LIVE
include_once ('../../app_config.php');
include (APP_PATH . 'libs/head.php');
include (APP_PATH . 'libs/lotte-api.php');
$user = $lotte_api->get_current_user();

$link = '/en/activity-page';
if($user == false) {
    $link = $login_link;
}
?>
</head>

<body id="about-photo-contest" class="about-photo-contest product en">
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
                PHOTO CONTEST<br>
                Strong teeth, bright smile
            </h1>
            <div class="section">
                <div class="section-contest">
                    <div class="title-contest">Participants</div>
                    <p class="text-content u-pb-60 u-sp-pb-34">Lotte Xylitol members.</p>
                    <div class="title-contest">Activity rules</div>
                    <p class="text-content">The photo contest is held quarterly <br class="u-pc">and runs throughout the three months of each quarter.<br>
                    Join the game with llowing steps:</p>
                    <ul class="step">
                        <li>
                            <div class="step-title"><span class="step-number">Step 1 : </span>Choose one of the three available frames, upload your photo, and combine it with the selected frame.</div>
                        </li>
                        <li>
                            <div class="step-title"><span class="step-number">Step 2 : </span>Download the image.</div>
                        </li>
                        <li>
                            <div class="step-title"><span class="step-number">Step 3 : </span>Post the image on your personal Facebook page with public visibility, including the hashtag #lottexylitol and a lucky number from 1-1000.</div>
                        </li>
                        <li>
                            <div class="step-title"><span class="step-number">Step 4 : </span> Upload the link to your post on the website.</div>
                        </li>
                    </ul>
                    <p class="text-content u-pb-30 u-sp-pb-24">05 participants who complete all steps correctly will be randomly selected by LOTTE XYLITOL based on their lucky number to receive prizes! Hurry up and shoot your shot!</p>
                    <p class="text-content u-pb-60 u-sp-pb-32">The winner list will be announced on the Fan-site and Lotte Xylitol Fanpage.</p>
                    <div class="title-contest">Prizes</div>
                    <div class="gift-contest row row-2 gutter-25">
                        <div class="col-3">
                            <div class="gift-contes-img">
                                <img src="<?php echo APP_ASSETS; ?>img/about-photo-contest/gift-img-01.jpg?v=20260407" alt="">
                            </div>
                            <div class="gift-contes-title">
                                01 E-Vouchers worth<br> 100,000 VND
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="gift-contes-img">
                                <img src="<?php echo APP_ASSETS; ?>img/about-photo-contest/gift-img-02.jpg" alt="">
                            </div>
                            <div class="gift-contes-title">
                                10 Lotte Xylitol Limemint Handy Bottle + 03 Lotte Xylitol Limemine Family Bottle
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="gift-contes-img">
                                <img src="<?php echo APP_ASSETS; ?>img/about-photo-contest/gift-img-03.jpg" alt="">
                            </div>
                            <div class="gift-contes-title">01 Lotte Chocolat (12 pax)</div>
                        </div>
                    </div>
                    <div class="txt-center u-pb-72 u-sp-pb-36">
                        <a href="<?php echo $link ?>" class="btn-dark-green hover">join now</a>
                    </div>
                    <div class="organizer-decisions">LOTTE XYLITOL have the final decision on any results.</div>
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
