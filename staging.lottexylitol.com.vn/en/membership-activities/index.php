<?php
// Author: A+LIVE
include_once ('../../app_config.php');
include (APP_PATH . 'libs/head.php');
include (APP_PATH . 'libs/lotte-api.php');

$tabs = $lotte_api->get_winners();

$tab_labels = [
    'brand-ambassador' => 'Brand Ambassador',
    'photo-contest' => 'Photo Contest',
];

?>
</head>

<body id="membership-activities" class="membership-activities product en">
    <!-- Header
    ================================================== -->
    <?php include (APP_PATH . 'libs/header.php'); ?>
    <div id="wrap">
        <!-- Main Content
        ================================================== -->
        <main class="main">
            <section class="section-kv">
                <div class="breadcrumb">
                    <ul>
                        <li><a href="/en/">Top</a></li>
                        <li class="white">Membership Activities</li>
                    </ul>
                </div>
                <h1 class="kv-title">
                    <span class="kv-title text-small">Become a Loyal Fan of Lotte Xylitol 2026:</span>
                    Easy To Join - Get Cool Gifts
                    <span class="kv-title text-small">Are you interest in a brand new activity?</span>
                    Easy to participate and easy to get cool gifts. Join now and become a loyal fan of Lotte Xylitol.
                </h1>
                <div class="kv-img pc"><img src="<?php echo APP_ASSETS; ?>img/membership-activities/kv-img.png" alt=""></div>
                <div class="kv-img sp"><img src="<?php echo APP_ASSETS; ?>img/membership-activities/kv-img-sp.png" alt=""></div>
            </section>
            <div class="cloud">
                <?php /*/ ?><div class="cloud-icon lottie-icon" data-src="/assets/json/present.json"></div><?php /*/ ?>
                <img class="cloud-icon lottie-icon" src="<?php echo APP_ASSETS; ?>img/membership-activities/icon.png" alt="">
                <div class="cloud-title">How to join:</div>
            </div>
            <section class="section section-how-to-join">
                <ul class="step">
                    <li>
                        <div class="step-title"><span class="step-number">Step 1 :</span> Visit the website https://lottexylitol.com.vn/vn/</div>
                    </li>
                    <li>
                        <div class="step-title"><span class="step-number">Step 2 :</span> Sign up for an account and complete your personal information.</div>
                    </li>
                    <li class="u-pt-32">
                        <div class="step-title"><span class="step-number">Step 3 :</span> Participate in activities and earn rewards.</div>
                        <div class="step-content content-center__">
                            <?php /*/ ?><div class="step-content-item">
                                <div class="step-content-img">
                                    <img src="<?php echo APP_ASSETS; ?>img/membership-activities/img-01.png" alt="">
                                </div>
                                <div class="step-content-title">Surveys</div>
                                <div class="step-content-text">Complete the survey after signing up and update the survey every 6 months to receive 3 handy bottle Lotte Xylitol Lime Mint. </div>
                                <a href="/en/about-survey" class="btn-dark-green hover">Learn more</a>
                            </div><?php /*/ ?>
                            <div class="step-content-item">
                                <div class="step-content-img">
                                    <img src="<?php echo APP_ASSETS; ?>img/membership-activities/img-01.jpg?v=20260407" alt="">
                                </div>
                                <div class="step-content-title">Lotte Xylitol Brand Ambassador</div>
                                <div class="step-content-text">
                                    Participate in the monthly Lotte Xylitol Brand Ambassador activity to receive a super attractive gift box, including<br>
                                    - 01 Lotte Xylitol gum limemint with Orange's singer image and singanture.<br>
                                    - 01 Electric toothbrush<br>
                                    - 04 boxes Lotte Xylitol Blister<br>
                                    - A “Brand Ambassador” certificate from Lotte Xylitol
                                </div>
                                <a href="/en/about-brand-ambassador" class="btn-dark-green hover">Learn more</a>
                            </div>
                            <div class="step-content-item">
                                <div class="step-content-img">
                                    <img src="<?php echo APP_ASSETS; ?>img/membership-activities/img-02.jpg?v=20260407" alt="">
                                </div>
                                <div class="step-content-title">Photo Contest</div>
                                <div class="step-content-text">
                                    Participate in the Lotte Xylitol Photo Contes to win attractive prizes such as <br>
                                    - 01 Lotte Chocolat (12 pax) <br>
                                    - 10 Lotte Xylitol Limemint Handy Bottle <br>
                                    - 03 Lotte Xylitol Limemine Family Bottle<br>
                                    - 01 E-Vouchers worth 100,000 VND
                                </div>
                                <a href="/en/about-photo-contest" class="btn-dark-green hover">Learn more</a>
                            </div>
                            <div class="step-content-item">
                                <div class="step-content-img">
                                    <img src="<?php echo APP_ASSETS; ?>img/membership-activities/img-03.jpg?v=20260407" alt="">
                                </div>
                                <div class="step-content-title">Game</div>
                                <div class="step-content-text">
                                    Game “Embrace your sparkling smile” is held  bi-weekly and lasts for one week to receive 01 Lotte Xylitol Handy Botte.
                                </div>
                                <a href="/en/about-game" class="btn-dark-green hover">Learn more</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </section>
            <div class="organizer-decisions">LOTTE XYLITOL have the final decision on any results</div>
            <div class="cloud winter">
                <img class="cloud-icon winter-icon lottie-icon" src="<?php echo APP_ASSETS; ?>img/membership-activities/winter-icon.png" alt="">
                <div class="cloud-title">Winner List</div>
            </div>
            <?php if($tabs && count($tabs)>0) :?>
            <section class="section winners-list">
                <div class="winners-tab">
                    <span class="survey-contest-label sp"></span>
                    <ul class="survey-contest">
                        <?php
                            foreach($tabs as $i => $tab) {
                                if(count($tab['list']) == 0) continue;

                                echo '<li class="survey-contest-item'. ($i == 0 ? ' active' : '').'">'
                                    . (isset($tab_labels[$tab['slug']]) ? $tab_labels[$tab['slug']] : $tab['name'])
                                    .'</li>';
                            }
                        ?>
                    </ul>
                </div>
                <div class="survey-contest-table">
                    <?php foreach($tabs as $i => $tab) :
                        if(count($tab['list']) == 0) continue;
                    ?>
                    <div class="table-content<?php echo ($i > 0 ? ' u-hidden' : '') ?>">
                        <?php if($tab['slug'] == 'photo-contest') :?>
                        <div class="txt-center"><img src="<?php echo APP_ASSETS; ?>img/membership-activities/icon-tooth.png" alt="" /></div>
                        <div class="step-title u-mb-30 content-center">Strong teeth, bright smile</div>
                            <?php foreach($tab['list'] as $key => $item) : $time = strtotime($key . '-01'); ?>
                            <div class="step-title u-ml-30 u-sp-ml-2 u-mb-30"><span class="step-number"><?php echo date('F Y', $time) ?></span></div>
                            <div class="winner-photos">
                                <?php foreach($item['winners'] as $winner) : ?>
                                <div class="winner-photo">
                                    <div class="photo"><?php echo $winner['photo'] != '' ? '<img src="' . $winner['photo'] .'" alt="" />' : '' ?></div>
                                    <div class="name"><?php echo $winner['name'] ?></div>
                                </div>
                                <?php endforeach ?>
                            </div>
                            <?php endforeach ?>
                        <?php else: ?>
                            <?php foreach($tab['list'] as $key => $item) : $time = strtotime($key . '-01'); ?>
                            <div class="step-title u-ml-30 u-sp-ml-2 u-mb-10"><span class="step-number"><?php echo date('F Y', $time) ?></span></div>
                            <div class="winner-question c-green u-mb-30"><?php echo $item['question'] ?></div>
                            <div class="winner-items">
                                <?php foreach($item['winners'] as $winner) : ?>
                                <div class="winner-item box-readmore">
                                    <div class="winner-info">
                                        <div class="avatar"><?php echo $winner['avatar'] != '' ? '<img src="' . $winner['avatar'] .'" alt="" />' : '' ?></div>
                                        <div class="name"><?php echo $winner['name'] ?></div>
                                    </div>
                                    <div class="box-readmore__desc">
                                        <div class="description"><?php echo $winner['description'] ?></div>
                                    </div>
                                    <div class="btn-readmore txt-right u-hidden">
                                        <a href="#"><em>Read more</em> ...</a>
                                    </div>
                                </div>
                                <?php endforeach ?>
                            </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                    <?php endforeach ?>
                </div>
            </section>
            <?php endif; ?>
        </main>
    </div><!-- #wrap -->

    <!-- Footer
    ================================================== -->
    <?php include (APP_PATH . 'libs/footer.php'); ?>
    <!-- End Document
================================================== -->
<script src="<?php echo APP_ASSETS; ?>js/lottie.js"></script>
<script src="<?php echo APP_ASSETS; ?>js/lib/jquery.matchHeight.min.js"></script>
    <script>
        $( function (){
            $( '.step-content .step-content-text' ).matchHeight();
            $( '.step-content .step-content-title' ).matchHeight();
            $( '.step-content' ).matchHeight();
        } );
    </script>
</body>

</html>
