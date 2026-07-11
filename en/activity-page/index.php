<?php
// Author: A+LIVE
include_once ('../../app_config.php');
include (APP_PATH . 'libs/lotte-api.php');

$user = $lotte_api->get_current_user();
if($user == false) {
    header('Location: /en/signin?redirect_to=' . urlencode($_SERVER['REQUEST_URI']));
    exit();
}

include (APP_PATH . 'libs/head.php');

$info = (array) $lotte_api->get_activity_info($lang);

$contest_start = isset($info['contest_start']) ? $info['contest_start'] : '';
$contest_expires = isset($info['contest_expires']) ? (int) $info['contest_expires'] : 0;
$contest_link = isset($info['contest_link']) ? $info['contest_link'] : '';

$survey_start = isset($info['survey_start']) ? $info['survey_start'] : '';
$survey_expires = isset($info['survey_expires']) ? (int) $info['survey_expires'] : 0;
$survey_link = isset($info['survey_link']) ? $info['survey_link'] : '';

$survey_brand_start = isset($info['survey_brand_start']) ? $info['survey_brand_start'] : '';
$survey_brand_expires = isset($info['survey_brand_expires']) ? (int) $info['survey_brand_expires'] : 0;
$survey_brand_link = isset($info['survey_brand_link']) ? $info['survey_brand_link'] : '';

$game_start = isset($info['game_start']) ? $info['game_start'] : '';
$game_expires = isset($info['game_expires']) ? (int) $info['game_expires'] : 0;
$game_link = isset($info['game_link']) ? $info['game_link'] : '';

$coming_soon = isset($_GET['coming-soon']);

?>
</head>

<body id="page-activity" class="page-activity product en">
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
                    <li class="white">Activity page</li>
                </ul>
            </div>
            <h1 class="section-title white">activity page</h1>
            <div class="section">
                <div class="activity-grid">
                    <?php /*/ ?><div class="activity-item">
                        <div class="activity-img"><img src="<?php echo APP_ASSETS; ?>img/activity/activity-01.png" alt=""></div>
                        <div class="activity-title js-activity"><span>SURVEY</span>
                            <div class="activity-sub">Organization time</div>
                        </div>
                        <div class="activity-content">
                            <?php if($survey_start == '') :?>
                            <div class="activity-text">The survey has ended, please come back next time or participate in other activities now to receive many attractive gifts</div>
                            <?php elseif($survey_expires <= 0) :?>
                            <div class="activity-text">Become a loyal fan of Lotte Xylitol. Take a survey - Receive cool gifts</div>
                            <a href="<?php echo $survey_link ?>" data-exp="<?php echo $survey_expires ?>" class="activity-btn">Join now!</a>
                            <?php elseif($survey_link == '#') :?>
                            <div class="activity-text">You joined this activity, please come back after 6 months from the date that you join the activity or join other activities in our fan site.</div>
                            <div class="activity-btn">JOIN OTHER ACTIVITIES</div>
                            <?php else :?>
                            <div class="activity-text">You completed a survey over 6 months ago. It's time to participate in a new survey and receive exciting gifts. Share your opinions to help Lotte Xylitol serve you better.</div>
                            <a href="<?php echo $survey_link ?>" data-exp="<?php echo $survey_expires ?>" class="activity-btn">Join now!</a>
                            <?php endif;?>
                            <div class="pkg pkg1"><img src="<?php echo APP_ASSETS; ?>img/activity/pkg01.png" alt=""></div>
                            <div class="pkg pkg2"><img src="<?php echo APP_ASSETS; ?>img/activity/pkg02.png" alt=""></div>
                        </div>
                    </div><?php /*/ ?>
                    <div class="activity-item">
                        <div class="activity-img"><img src="<?php echo APP_ASSETS; ?>img/activity/activity-02.png" alt=""></div>
                        <div class="activity-title js-activity"><span>Photo Contest</span>
                            <div class="activity-sub">Organization time: 3 months/time</div>
                        </div>
                        <div class="activity-content">
                            <?php if($contest_start == '') :?>
                            <div class="activity-text">The photo contest has ended, please come back next time or participate in other activities now to receive many attractive gifts</div>
                            <?php elseif($contest_expires <= 0) :?>
                            <div class="activity-text">Test your skills in the Lotte Xylitol photo contest for a chance to win quarterly lucky draw prizes.</div>
                            <a href="<?php echo $contest_link ?>" data-exp="<?php echo $contest_expires ?>" class="activity-btn">Join now!</a>
                            <?php elseif($contest_link == '#') :?>
                            <div class="activity-text">You joined this activity and since this is monthly based activity, please come back and join it in the next time or join other activities.</div>
                            <div class="activity-btn">JOIN OTHER ACTIVITIES</div>
                            <?php else :?>
                            <div class="activity-text">Welcome back to the Lotte Xylitol photo contest.It's time to rejoin the contest and receive more exciting gifts.</div>
                            <a href="<?php echo $contest_link ?>" data-exp="<?php echo $contest_expires ?>" class="activity-btn">Join now!</a>
                            <?php endif;?>
                            <div class="pkg pkg1"><img src="<?php echo APP_ASSETS; ?>img/activity/pkg01.png" alt=""></div>
                            <div class="pkg pkg2"><img src="<?php echo APP_ASSETS; ?>img/activity/pkg02.png" alt=""></div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-img"><img src="<?php echo APP_ASSETS; ?>img/activity/activity-03.png" alt=""></div>
                        <div class="activity-title js-activity"><span>Lotte Xylitol Brand Ambassador</span>
                            <div class="activity-sub">Organization time: 1 month/time</div>
                        </div>
                        <div class="activity-content">
                            <?php if($survey_brand_start == '') :?>
                            <div class="activity-text">The Lotte Xylitol Brand Ambassador has ended, please come back next time or participate in other activities now to receive many attractive gifts</div>
                            <?php elseif($survey_brand_expires <= 0) :?>
                            <div class="activity-text">Become a Lotte Xylitol Brand Ambassador!<br>Join now for a chance to receive exciting gifts from Lotte Xylitol.</div>
                            <a href="<?php echo $survey_brand_link ?>" data-exp="<?php echo $survey_brand_expires ?>" class="activity-btn">Join now!</a>
                            <?php elseif($survey_brand_link == '#') :?>
                            <div class="activity-text">You joined this activity and since this is monthly based activity, please come back and join it in the next time or join other activities.</div>
                            <div class="activity-btn">JOIN OTHER ACTIVITIES</div>
                            <?php else :?>
                            <div class="activity-text">Welcome back to the Lotte Xylitol Brand Ambassador program!It's time to rejoin the program and receive more exciting gifts.</div>
                            <a href="<?php echo $survey_brand_link ?>" data-exp="<?php echo $survey_brand_expires ?>" class="activity-btn">Join now!</a>
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
                            <strong>Coming Soon</strong>
                        </div>
                    </div>
                    <?php else :?>
                    <div class="activity-item">
                        <div class="activity-img"><img src="<?php echo APP_ASSETS; ?>img/activity/activity-04.png" alt=""></div>
                        <div class="activity-title js-activity"><span>Embrace your sparkling smile</span>
                            <div class="activity-sub">Organization time: 2 weeks/time</div>
                        </div>
                        <div class="activity-content">
                            <?php if($game_start == '') :?>
                            <div class="activity-text">The Embrace your sparkling smile Game has ended, please come back next time or participate in other activities now to receive many attractive gifts</div>
                            <?php elseif($game_link == '#') :?>
                            <div class="activity-text">You joined this activity and since this is monthly based activity, please come back and join it in the next time or join other activities.</div>
                            <div class="activity-btn">JOIN OTHER ACTIVITIES</div>
                            <?php else :?>
                            <div class="activity-text">Join the challenge of killing bacteria that cause tooth decay with game Embrace your sparkling smile Game to receive attractive gifts</div>
                            <a href="<?php echo $game_link ?>" data-exp="<?php echo $game_expires ?>" class="activity-btn">Join now!</a>
                            <?php endif;?>
                            <div class="pkg pkg1"><img src="<?php echo APP_ASSETS; ?>img/activity/pkg01.png" alt=""></div>
                            <div class="pkg pkg2"><img src="<?php echo APP_ASSETS; ?>img/activity/pkg02.png" alt=""></div>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
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
