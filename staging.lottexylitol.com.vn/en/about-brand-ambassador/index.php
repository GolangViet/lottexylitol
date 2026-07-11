<?php
// Author: A+LIVE
include_once ('../../app_config.php');
include (APP_PATH . 'libs/lotte-api.php');
$user = $lotte_api->get_current_user();

$link = '/en/activity-page';
if($user == false) {
    $link = $login_link;
}

include (APP_PATH . 'libs/head.php');

$brand = $lotte_api->get_page('brand');

$info = [
    'about_ba_title' => "October's Question",
    'question_name' => "What does Lotte Xylitol mean to you? Please express your love for Lotte Xylitol freely with some detailed reasons.",
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

<body id="about-brand-ambassador" class="about-photo-contest about-brand-ambassador product en">
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
                    <li>LOTTE XYLITOL Brand Ambassador</li>
                </ul>
            </div>
            <h1 class="section-title">LOTTE XYLITOL Brand Ambassador</h1>
            <div class="section">
                <div class="section-contest">
                    <div class="section-small">
                        <div class="title-contest">Participants</div>
                        <p class="text-content u-pb-60 u-sp-pb-34">Lotte Xylitol members.</p>
                        <div class="title-contest"><?php echo $info['about_ba_title'] ?></div>
                        <p class="text-content u-pb-60 u-sp-pb-34"><?php echo $info['question_name'] ?></p>
                        <div class="title-contest">Activity Rules</div>
                        <p class="text-content">The “Lotte Xylitol Ambassador” activity is held monthly.</p>
                        <p class="text-star u-mt-26 u-sp-mt-16">Participate by sharing your thoughts about Lotte Xylitol (questions will be updated monthly) </p>
                        <p class="text-star">05 participants with the most interesting shares about Lotte Xylitol will receive a special gift box from Lotte Xylitol.</p>
                        <p class="text-star">The winner list will be announced on both the Fan-site and Lotte Xylitol Fanpage</p>
                        <div class="title-contest u-mt-60 u-sp-mt-30">Prizes</div>
                        <p class="text-content">01 special gift box including:</p>
                        <div class="gift-ambassador">
                            <div class="gift-ambassador-img"><img src="<?php echo APP_ASSETS; ?>img/about-brand-ambassador/img-01.jpg" alt=""></div>
                            <div class="gift-ambassador-title">
                                01 Lotte Xylitol gum limemint with Orange's singer image and singanture.<br>
                                + 01 Electric toothbrush<br>
                                + 04 boxes Lotte Xylitol Blister<br>
                                + A “Brand Ambassador” certificate from Lotte Xylitol
                            </div>
                        </div>
                        <div class="txt-center u-pb-66 u-sp-pb-36">
                            <a href="<?php echo $link ?>" class="btn-dark-green hover">join now</a>
                        </div>
                        <div class="organizer-decisions">LOTTE XYLITOL have the final decision on any results.</div>
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
