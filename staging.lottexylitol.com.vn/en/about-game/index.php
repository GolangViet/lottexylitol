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
                    <li>Game</li>
                </ul>
            </div>
            <h1 class="section-title">Game</h1>
            <div class="section">
                <div class="section-contest">
                    <div class="section-small">
                        <div class="title-contest">Participants</div>
                        <p class="text-content u-pb-60 u-sp-pb-34">Activity for Lotte Xylitol members.</p>
                        <div class="title-contest">Participation Rules</div>
                        <p class="text-content u-pb-60 u-sp-pb-34">Game “Embrace your sparkling smile” is held bi-weekly and lasts for one week.</p>
                        <div class="title-contest">Game Rules</div>
                        <p class="text-content u-pb-60 u-sp-pb-34">Your teeth are being attacked by a bunch of cavity-causing bacteria! Your mission is to move the LOTTE XYLITOL gum bottle to shoot down the bacteria, helping your teeth become healthy and bright again.</p>
                        <div class="title-contest">How to Play</div>
                        <div class="txt-center">
                            <img width="250" src="<?php echo APP_ASSETS; ?>img/about-game/img01.png" alt="">
                        </div>
                        <p class="text-star u-mt-26 u-sp-mt-16">For each bacterias destroyed, you will receive 1 point.</p>
                        <p class="text-star u-mt-26 u-sp-mt-16">The game has 10 levels; the higher the level, the more bacteria will appear. </p>
                        <p class="text-star u-mt-26 u-sp-mt-16">Quickly destroy the bacteria before they reach the safety line and fill it up. If the bacteria reach the safety line and fill it up, the game will be end.</p>
                        <div class="title-contest u-mt-60 u-sp-mt-30">Result & Gifts</div>
                        <p class="text-content">The final result is based on the points you earn from destroying bacteria.</p>
                        <p class="text-star u-pb-30 u-sp-pb-30 u-mt-26 u-sp-mt-16">Within 2 minutes, the top 10 players with the highest scores will win and receive an attractive prize of 01 Lotte Xylitol Lime Mint Handy Bottle.</p>
                        <div class="txt-center">
                            <img src="<?php echo APP_ASSETS; ?>img/about-game/img-02.jpg" alt="">
                        </div>
                        <div class="txt-center u-pb-72 u-sp-pb-36">
                            <a href="<?php echo $link ?>" class="btn-dark-green hover">Join now</a>
                        </div>
                        <div class="organizer-decisions" style="text-transform: none;">
                            <p>In the event of a tie where multiple players have the same score, the Organizing Committee will determine the valid winner based on tie-breaking criteria (e.g., faster completion time or full compliance with registration requirements, ensuring entries are complete and unique).</p>
                            <p>The Organizing Committee's decision is final in all cases of complaints or disputes related to the Minigame results.</p>
                        </div>
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
