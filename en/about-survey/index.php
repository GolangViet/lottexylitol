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

<body id="about-brand-ambassador" class="about-photo-contest about-brand-ambassador about-survey product en">
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
                    <li>Survey</li>
                </ul>
            </div>
            <h1 class="section-title">Survey</h1>
            <div class="section">
                <div class="section-contest">
                    <div class="section-small">
                        <div class="title-contest">Participants</div>
                        <p class="text-content u-pb-60 u-sp-pb-34">Lotte Xylitol members.</p>
                        <div class="title-contest">Participation Rules</div>
                        <p class="text-content">The survey is conducted every 6 months.</p>
                        <p class="text-star u-mt-26 u-sp-mt-16">Participate and complete the survey about Lotte Xylitol for a chance to receive an attractive gift, including a combo of 3 handy bottle Lotte Xylitol with Lemon Mint flavor.</p>
                        <div class="title-contest u-mt-60 u-sp-mt-30">gift</div>
                        <p class="text-content">combo of 3 Lotte Xylitol Handy jars with Lemon Mint flavor.</p>
                        <div class="gift-survey">
                            <img src="<?php echo APP_ASSETS; ?>img/about-survey/img01.png" alt="">
                        </div>
                        <div class="txt-center u-pb-66 u-sp-pb-36">
                            <a href="<?php echo $link ?>" class="btn-dark-green hover">join now</a>
                        </div>
                        <div class="organizer-decisions">LOTTE XYLITOL have the final decision on any results.</div>
                    </div>
                </div>
                <div class="pkg pkg-xylitol"><img src="<?php echo APP_ASSETS; ?>img/about-photo-contest/xylitol.png?v=20260407" alt=""></div>
                <div class="pkg pkg-board"><img src="<?php echo APP_ASSETS; ?>img/about-survey/board.png" alt=""></div>
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
