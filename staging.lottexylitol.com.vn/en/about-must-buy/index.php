<?php
// Author: A+LIVE
include_once('../../app_config.php');
include(APP_PATH . 'libs/head.php');
include(APP_PATH . 'libs/lotte-api.php');

$user = $lotte_api->get_current_user();

// Check time in program
$is_coming = $lotte_api->is_mustbuy_coming_soon($mustbuy_from, $mustbuy_to);

if($is_coming) die('<meta http-equiv="refresh" content="0; url=/en/">');

$link = '/en/nhanqualientay/';
if ($user == false) {
    $link = APP_URL . $lang_link . 'signup?redirect_to=' . urlencode($link);
}

?>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>

<body id="about-must-buy" class="about-photo-contest product en about-must-buy">
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
                    <li>Nhận quà liền tay</li>
                </ul>
            </div>
            <div class="bottle-slogan lottie-icon" data-src="/assets/json/bottle-slogan-en/slogan-en.json"></div>
            <div class="section">
                <div class="section-contest section-about-must-buy">
                    <div class="content-auto-scroll">
                        <div class="title-contest">ELIGIBLE PARTICIPANTS</div>
                        <p class="text-content txt-bold u-pb-30 u-sp-pb-24">Customers who purchase Promotional Products directly at Lotte Xylitol gum retail stores nationwide.</p>
                        <p class="text-content txt-black u-pb-60 u-sp-pb-34">Consumers residing in Vietnam who buy Promotional Products within promotion areas during the promotion period.</p>
                        <div class="title-contest">CONDITIONS TO JOIN</div>
                        <p class="text-content txt-bold u-pb-30 u-sp-pb-24">Customers who purchase promotional products directly at Lotte Xylitol gum retail stores nationwide are eligible to join the program. Eligible products include:</p>
                        <p class="text-leaf">Lotte Xylitol Lime Mint Flavor</p>
                        <div class="row-cond">
                            <div class="item">
                                <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-01.png" width="125" alt="" />
                                <p>Handy Bottle 55.1g</p>
                            </div>
                            <div class="item">
                                <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-02.png" width="158" alt="" />
                                <p>Family Bottle 130.5g</p>
                            </div>
                        </div>
                        <p class="text-leaf">Sugar-free chewing gum LOTTE XYLITOL SUPER COOL</p>
                        <div class="row-cond">
                            <div class="item">
                                <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-03.png" width="125" alt="" />
                                <p>Handy Bottle 55.1g</p>
                            </div>
                            <div class="item">
                                <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-04.png" width="158" alt="" />
                                <p>Family Bottle 130.5g</p>
                            </div>
                        </div>
                        <p class="text-leaf">Lotte Xylitol Mixed Fruit Sugar-Free Gum</p>
                        <div class="row-cond">
                            <div class="item">
                                <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-05.png" width="125" alt="" />
                                <p>Handy Bottle 55.1g</p>
                            </div>
                            <div class="item">
                                <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-06.png" width="158" alt="" />
                                <p>Family Bottle 130.5g</p>
                            </div>
                        </div>
                        <p class="text-leaf">Lotte Xylitol Sugar-Free Gum for Kids with Strawberry Flavor</p>
                        <div class="row-cond content-center">
                            <div class="item">
                                <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-07.png" width="133" alt="" />
                                <p>Bag 22.56g</p>
                                <p><img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/txt-copyright.jpg" width="133" alt="" /></p>
                            </div>
                        </div>
                        <p class="text-leaf">Lotte Xylitol Sugar-Free Gum for Kids with Grape Flavor</p>
                        <div class="row-cond content-center">
                            <div class="item">
                                <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-08.png" width="133" alt="" />
                                <p>Bag 22.56g</p>
                                <p><img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/txt-copyright.jpg" width="133" alt="" /></p>
                            </div>
                        </div>
                        <div class="title-contest">PARTICIPATION RULES</div>
                        <ul class="step step-2">
                            <li>
                                <div class="step-title">STEP 1</div>
                                <p>After purchasing and successfully paying for the Promotional Product at Lotte Xylitol retail stores nationwide, customers will find a lucky code on the winning card inside the product.</p>
                            </li>
                            <li>
                                <div class="step-title">STEP 2</div>
                                <p>Use the QR code scanning feature on mobile phone to scan the QR code on the promotional product packaging. The screen will redirect customer to the website to join the promotion program.</p>
                            </li>
                            <li>
                                <div class="step-title">STEP 3</div>
                                <p>Enter the <strong class="txt-red">lucky code</strong> found on the winning card inside the product.</p>
                            </li>
                            <li>
                                <div class="step-title">STEP 4</div>
                                <p>Take part in the fill-in-the-blank game by selecting the correct answers from the given options. The screen will display the final correct answer after the game. Then, click the <strong>"Got it"</strong> button.</p>
                            </li>
                            <li>
                                <div class="step-title">STEP 5</div>
                                <p>Click the <strong>"Play Now"</strong> button to receive a random lucky prize.</p>
                            </li>
                        </ul>
                        <div class="title-contest">PRIZES</div>
                        <div class="gift-contest row row-2 gutter-25 m-w-670">
                            <div class="col-md-12">
                                <div class="gift-contes-img">
                                    <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-prize-gold-en.png" width="247" alt="LUCKY CARD">
                                </div>
                                <div class="gift-contes-title-2 txt-bold">
                                    <div class="sub-title">CHANCE PRIZE</div>
                                    <div class="title-2 txt-red">100 Lucky Cards*</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="gift-contes-img">
                                    <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-prize-200k.png" width="256" alt="E-VOUCHER Got-it 200K">
                                </div>
                                <div class="gift-contes-title-2">
                                    <div class="sub-title txt-bold">First Prize</div>
                                    <div class="title"><small>90 Got It electronic gift Vouchers (E-vouchers) valued at 200,000 VND each</small></div>
                                    <div class="title"><strong>200,000 VND</strong></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="gift-contes-img">
                                    <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-prize-20k-en.png" width="235" alt="MOBILE TOP-UP CARD 20K">
                                </div>
                                <div class="gift-contes-title-2">
                                    <div class="sub-title txt-bold">Second Prize</div>
                                    <div class="title"><small>350 mobile top-up cards</small></div>
                                    <div class="title"><strong>20,000 VND for each</strong></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="gift-contes-img">
                                    <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-prize-10k-en.png" width="235" alt="MOBILE TOP-UP CARD 10K">
                                </div>
                                <div class="gift-contes-title-2">
                                    <div class="sub-title txt-bold">Third Prize</div>
                                    <div class="title"><small>6,600 mobile top-up cards</small></div>
                                    <div class="title"><strong>10,000 VND for each</strong></div>
                                </div>
                            </div>
                        </div>
                        <p class="text-content txt-black txt-bold u-pb-30 u-sp-pb-20">
                            * Customers who win the <strong class="txt-red">"Lucky Card"</strong> prize will get a chance to join a special random draw for the Grand Prize, which will be conducted by the Lotte Xylitol Vietnam organizing team.<br>
                            The results will be announced on the Lotte Xylitol Vietnam fanpage.
                        </p>
                        <p class="text-content-2 u-pb-30 u-sp-pb-20">THE GRAND PRIZE INCLUDES 03 STANDARD HONDA VISION MOTORBIKES</p>
                        <p class="text-content text-center u-pb-30 u-sp-pb-20">
                            <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-prize-vision.png" width="185" alt="" />
                        </p>
                        <p class="text-content txt-black u-pb-30 u-sp-pb-20">
                            <strong>*Important: </strong><br>
                            Each customer is allowed a maximum of 5 incorrect prize code entries. If you enter the wrong code 5 times or more, your game access will be locked. Please contact the organizers via the Lotte Xylitol Vietnam fanpage for assistance in unlocking your access.
                        </p>
                        <p class="text-content txt-red u-pb-30 u-sp-pb-20">The customer information provided upon membership registration will be the basis for awarding prizes. Please ensure that all registration details are entered accurately. In case of any discrepancies, Lotte Xylitol reserves the right to withhold the prize and shall not be held liable.</p>
                        <div class="item-form m-w-670 u-pb-30 u-sp-pb-20">
                            <label class="checkbox">
                                I have read and agree to the <a class="link-u" href="/en/nhanqualientay/terms/">program’s terms and conditions</a>
                                <input type="checkbox" class="js-checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <br />
                            <label class="checkbox">
                                I have read and agree to <a class="link-u" href="/en/privacy-policy/" target="_blank">Lotte Xylitol Vietnam’s privacy policy</a>
                                <input type="checkbox" class="js-checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="text-content txt-black u-pb-60 u-sp-pb-40">LOTTE have the final decision-making authority regarding the result of the program</div>
                    </div>
                    <div class="txt-center float-btn-dark">
                        <a href="<?php echo $link ?>" class="btn-dark-green-2 hover js-submit disabled"><span>JOIN NOW</span></a>
                    </div>
                </div>
            </div>
        </main>
    </div><!-- #wrap -->

    <!-- Footer
    ================================================== -->
    <?php include(APP_PATH . 'libs/footer.php'); ?>
    <!-- End Document
================================================== -->
    <script src="<?php echo APP_ASSETS; ?>js/lottie.js"></script>
    <script>
        jQuery(function($) {
            $(document).on('change', '.js-checkbox', function(e) {
                $(this).parent().toggleClass('error', this.checked == false);
                $('.js-submit').toggleClass('disabled', is_all_checked() == false);
            });

            function is_all_checked() {
                return $('.js-checkbox').length == $('.js-checkbox:checked').length;
            }
        })
    </script>
</body>

</html>
