<?php
// Author: A+LIVE
$language = "en";
include_once('../app_config.php');
include(APP_PATH.'libs/head.php');
include (APP_PATH . 'libs/lotte-api.php');

$is_logged_in = $lotte_api->is_logged_in();
?>
<link type="text/css" rel="stylesheet" href="<?php echo APP_ASSETS; ?>js/wow/animate.min.css">
<link type="text/css" rel="stylesheet" href="<?php echo APP_ASSETS; ?>js/slick/slick.css">
<link href="<?php echo APP_ASSETS; ?>css/jquery.fancybox.css" rel="stylesheet">
</head>

<body id="top" class="top en">
    <!-- Header
    ================================================== -->
    <?php include(APP_PATH.'libs/header.php'); ?>

    <div id="wrap">
        <!-- Main Content
        ================================================== -->
        <main class="main">
            <div class="visual">
                <ul class="vslider">
                    <li class="item slider01 item01">
                        <p class="lazy-bg" data-animation="fadeInRight" data-delay="0s">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_6_en_pc.webp" alt="Xylitol" class="pc">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_6_en_sp.webp" alt="Xylitol" class="sp">
                        </p>
                    </li>
                    <li class="item slider01 item01">
                        <p class="lazy-bg" data-animation="fadeInRight" data-delay="0s">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_1_en_pc.webp" alt="Xylitol" class="pc">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_1_en_sp.webp" alt="Xylitol" class="sp">
                        </p>
                    </li>
                    <li class="item slider01 item01">
                        <p class="lazy-bg" data-animation="fadeInRight" data-delay="0s">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_2_en_pc.webp" alt="Xylitol" class="pc">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_2_en_sp.webp" alt="Xylitol" class="sp">
                        </p>
                    </li>
                    <li class="item slider01 item01">
                        <p class="lazy-bg" data-animation="fadeInRight" data-delay="0s">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_3_en_pc.webp" alt="Xylitol" class="pc">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_3_en_sp.webp" alt="Xylitol" class="sp">
                        </p>
                    </li>
                    <li class="item slider01 item01">
                        <p class="lazy-bg" data-animation="fadeInRight" data-delay="0s">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_4_en_pc.webp" alt="Xylitol" class="pc">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_4_en_sp.webp" alt="Xylitol" class="sp">
                        </p>
                    </li>
                </ul>
            </div>

            <div class="whatSet">
                <p class="bg1 wow fadeInRight">&nbsp;</p>
                <p class="bg2 wow fadeIn">&nbsp;</p>
                <div class="section wow fadeIn">
                    <h2 class="wow fadeIn">Whatʼs XYLITOL?</h2>
                    <ul class="whatlist">
                        <li class="item2"><img src="<?php echo APP_ASSETS; ?>img/top/img_what2.png" alt="Xylitol"></li>
                        <li class="item3"><img src="<?php echo APP_ASSETS; ?>img/top/img_what3.png" alt="Xylitol"></li>
                        <li class="item4"><img src="<?php echo APP_ASSETS; ?>img/top/img_what4.png" alt="Xylitol"></li>
                    </ul>
                    <div class="desc wow fadeIn" data-wow-delay="0.5s">
                        <p>Xylitol is proved that it helps to prevent the cavity worldwide, and also make your teeth stronger & healthier. Only LOTTE XYLITOL dental gum is approved by VOSA (Vietnam Odonto Stomatology Association) concerning its effection, helping to prevent the cavity in the gum category.</p>
                        <p class="link"><a href="<?php echo APP_URL; ?>en/what-is-xylitol/" class="button1"><span>MORE</span></a></p>
                    </div>
                </div>
                <ul class="leaf wow fadeIn" data-wow-delay="0.5s">
                   <li class="item2"><img class="pc" src="<?php echo APP_ASSETS; ?>img/common/img_leaf5.png" alt="leaf"><img class="sp" src="<?php echo APP_ASSETS; ?>img/common/img_leaf6.png" alt="leaf"></li>
                </ul>
            </div>

            <div class="whySet">
                <p class="bg wow fadeInLeft">&nbsp;</p>
                <div class="section">
                    <h2 class="wow fadeIn" data-wow-delay="0.5s">Why Xylitol?</h2>
                     <ul class="whylist wow fadeIn" data-wow-delay="1s">
                        <li class="item1">
                            <p class="pic"><img src="<?php echo APP_ASSETS; ?>img/top/img_why1.png" alt="Xylitol supported by scientific certification"></p>
                            <h3>Xylitol supported<br>by scientific certification</h3>
                            <p class="text">The government has encouraged <br>the consumption of Xylitol since 1970’s.<br>*DMFT of each age group has decreased year by year.</p>
                            <p class="note">*DMFT: Mean number of decayed, missing or filled teeth.</p>
                        </li><li class="item2">
                            <p class="pic"><img src="<?php echo APP_ASSETS; ?>img/top/img_why2.png" alt="Xylitol is guaranteed effect all over the world"></p>
                            <h3>Xylitol is guaranteed effect<br>all over the world</h3>
                            <p class="text">Xylitol Gum’s benefit that can help to prevent the cavity has been approved by Dental Associations <br class="sp">in many countries all over the world.</p>
                        </li><li class="item3">
                            <p class="pic"><img src="<?php echo APP_ASSETS; ?>img/top/img_why3.png" alt="Dental health affects other medical problems"></p>
                            <h3>Dental health affects other<br>medical problems</h3>
                            <p class="text">Taking care of dental health is not just important for your teeth, gums, and breath but also affects other medical problems inside your body.</p>
                        </li>
                    </ul>
                    <p class="link"><a href="<?php echo APP_URL; ?>en/why-xylitol/" class="button1"><span>MORE</span></a></p>
                </div>
                <p class="bg2">&nbsp;</p>
                <div class="per-img">
                    <div class="inner">
                        <img class="pc" src="<?php echo APP_ASSETS; ?>img/top/product_lime_mint_mv.png" alt="">
                        <img class="sp" src="<?php echo APP_ASSETS; ?>img/top/product_lime_mint_mv.png" width="108" alt="">
                    </div>
                </div>
            </div>

            <div class="productSet">
                <!-- <p class="bg1 wow fadeInRight" data-wow-delay="0s">&nbsp;</p> -->
                <!-- <p class="bg2 wow fadeInLeft" data-wow-delay="0s">&nbsp;</p> -->
                <div class="section wow fadeIn" data-wow-delay="0.2s">
                    <h2>Products</h2>
                    <div class="productSet__slider productSet__slider--gum">
                        <h3 class="product-title">Gum</h3>
                        <div class="productSet-slider-for slider-for-gum" data-slide="product">
                            <ul class="slide-for">
                                <li class="slide-for-item lime-mint">
                                    <figure class="pro-img"><img src="<?php echo APP_ASSETS; ?>img/top/img_product1.png" alt=""></figure>
                                    <p class="pro-name lime-mint-name">Lime Mint</p>
                                </li>
                                <li class="slide-for-item fresh-mint">
                                    <figure class="pro-img"><img src="<?php echo APP_ASSETS; ?>img/top/img_product2.png" alt=""></figure>
                                    <p class="pro-name fresh-mint-name">Fresh Mint</p>
                                </li>
                                <li class="slide-for-item strawberry-mint">
                                    <figure class="pro-img"><img src="<?php echo APP_ASSETS; ?>img/top/img_product3.png" alt=""></figure>
                                    <p class="pro-name strawberry-mint-name">Strawberry Mint</p>
                                </li>
                                <li class="slide-for-item blueberry-mint">
                                    <figure class="pro-img"><img src="<?php echo APP_ASSETS; ?>img/top/img_product4.png" alt=""></figure>
                                    <p class="pro-name blueberry-mint-name">Blueberry Mint</p>
                                </li>
                                <li class="slide-for-item cool-mint">
                                    <figure class="pro-img"><img src="<?php echo APP_ASSETS; ?>img/top/img_product5.png" alt=""></figure>
                                    <p class="pro-name cool-mint-name">Super Cool</p>
                                </li>
                                <li class="slide-for-item assorted-fruits-flavor lazy-before">
                                    <figure class="pro-img"><img src="<?php echo APP_ASSETS; ?>img/top/img_product8.png" alt=""></figure>
                                    <p class="pro-name assorted-fruits-flavor-name">Assorted Fruits Flavor</p>
                                </li>
                                <li class="slide-for-item melon-flavor lazy-before">
                                    <figure class="pro-img"><img src="<?php echo APP_ASSETS; ?>img/top/img_product9.png" alt=""></figure>
                                    <p class="pro-name melon-flavor-name">Melon Mint</p>
                                </li>
                            </ul>
                            <div class="btn-arrows btn-arrows-gum top30" data-arrows="product">
                                <p class="btn-arrow prev"></p>
                                <p class="btn-arrow next"></p>
                            </div>
                        </div>
                        <div class="productSet-slider-nav slider-nav-gum" data-slide="product">
                            <div class="slider-nav-gum-inner">
                                <ul class="slide-nav">
                                    <li class="slide-nav-item">
                                        <figure>
                                            <img src="<?php echo APP_ASSETS; ?>img/top/img_product1.png" width="74" alt="">
                                            <figcaption class="lime-mint-name">Lime Mint</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item">
                                        <figure>
                                            <img src="<?php echo APP_ASSETS; ?>img/top/img_product2.png" width="74" alt="">
                                            <figcaption class="fresh-mint-name">Fresh Mint</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item">
                                        <figure>
                                            <img src="<?php echo APP_ASSETS; ?>img/top/img_product3.png" width="74" alt="">
                                            <figcaption class="strawberry-mint-name">Strawberry Mint</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item">
                                        <figure>
                                            <img src="<?php echo APP_ASSETS; ?>img/top/img_product4.png" width="74" alt="">
                                            <figcaption class="blueberry-mint-name">Blueberry Mint</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item">
                                        <figure>
                                            <img src="<?php echo APP_ASSETS; ?>img/top/img_product5.png" width="74" alt="">
                                            <figcaption class="cool-mint-name">Cool</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img src="<?php echo APP_ASSETS; ?>img/top/img_product8.png" width="74" alt="">
                                            <figcaption class="assorted-fruits-flavor-name">Assorted Fruits Flavor</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img src="<?php echo APP_ASSETS; ?>img/top/img_product9.png" width="74" alt="">
                                            <figcaption class="melon-flavor-name">Melon Mint</figcaption>
                                        </figure>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="productSet__slider productSet__slider--gum reverse">
                        <h3 class="product-title">Lotte Xylitol tablet for kids</h3>
                        <div class="productSet-slider-for slider-for-gum slider-for-tablet-for-kids" data-slide="tablet-for-kids">
                            <ul class="slide-for">
                                <li class="slide-for-item strawberry-flavor lazy-before">
                                    <figure class="pro-img"><img src="<?php echo APP_ASSETS; ?>img/top/img_product_strawberry.png" alt="HStrawberry flavor" class="lazy"></figure>
                                    <p class="pro-name strawberry-flavor-name">Strawberry flavor</p>
                                    <span class="note-doraemon pc"><img src="<?php echo APP_ASSETS; ?>/img/product/note-doraemon.png" alt=""></span>
                                </li>
                                <li class="slide-for-item grape-flavor lazy-before">
                                    <figure class="pro-img"><img src="<?php echo APP_ASSETS; ?>img/top/img_product_grape.png" alt="Grape flavor" class="lazy"></figure>
                                    <p class="pro-name grape-flavor-name">Grape flavor</p>
                                    <span class="note-doraemon pc"><img src="<?php echo APP_ASSETS; ?>/img/product/note-doraemon.png" alt=""></span>
                                </li>
                            </ul>
                            <div class="btn-arrows btn-arrows-tablet-for-kids" data-arrows="tablet-for-kids">
                                <p class="btn-arrow prev"></p>
                                <p class="btn-arrow next"></p>
                            </div>
                        </div>
                        <div class="productSet-slider-nav slider-nav-gum" data-slide="tablet-for-kids">
                            <div class="slider-nav-gum-inner">
                                <ul class="slide-nav">
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img src="<?php echo APP_ASSETS; ?>img/top/img_product_strawberry.png" width="74" alt="Strawberry flavor" class="lazy">
                                            <figcaption class="strawberry-flavor-name">Strawberry flavor</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img src="<?php echo APP_ASSETS; ?>img/top/img_product_grape.png" width="74" alt="Grape flavor" class="lazy">
                                            <figcaption class="grape-flavor-name">Grape flavor</figcaption>
                                        </figure>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="productSet__slider productSet__slider--gum">
                        <h3 class="product-title">Lotte Xylitol chewing gum for kids</h3>
                        <div class="productSet-slider-for slider-for-gum slider-for-chewing-gum" data-slide="chewing-gum">
                            <ul class="slide-for">
                                <li class="slide-for-item  chewing-grape-flavor lazy-before">
                                    <figure class="pro-img"><img src="<?php echo APP_ASSETS; ?>img/top/img_product_chewing_grape.png" alt="Grape flavor" class="lazy"></figure>
                                    <p class="pro-name chewing-grape-flavor-name">Grape flavor</p>
                                    <span class="note-doraemon pc"><img src="<?php echo APP_ASSETS; ?>/img/product/note-doraemon.png" alt=""></span>
                                </li>
                                <li class="slide-for-item doraemon-strawberry-flavor lazy-before">
                                    <figure class="pro-img"><img src="<?php echo APP_ASSETS; ?>img/top/img_product_doraemon_strawberry.png" alt="Lotte Xylitol - Doraemon chewing gum strawberry flavor 3g" class="lazy"></figure>
                                    <p class="pro-name doraemon-strawberry-flavor-name">Lotte Xylitol - Doraemon chewing gum strawberry flavor 3g</p>
                                    <span class="note-doraemon pc"><img src="<?php echo APP_ASSETS; ?>/img/product/note-doraemon.png" alt=""></span>
                                </li>
                                <li class="slide-for-item doraemon-strawberry-flavor2 lazy-before">
                                    <figure class="pro-img"><img src="<?php echo APP_ASSETS; ?>img/top/img_product_doraemon_strawberry2.png" alt="Lotte Xylitol - Doraemon chewing gum strawberry flavor 9g" class="lazy"></figure>
                                    <p class="pro-name doraemon-strawberry-flavor2-name">Lotte Xylitol - Doraemon chewing gum strawberry flavor 9g</p>
                                    <span class="note-doraemon pc"><img src="<?php echo APP_ASSETS; ?>/img/product/note-doraemon.png" alt=""></span>
                                </li>
                                <li class="slide-for-item pokemon-strawberry-flavor lazy-before">
                                    <figure class="pro-img"><img src="<?php echo APP_ASSETS; ?>img/top/img_product_pokemon_strawberry.png" alt="Strawberry flavor" class="lazy"></figure>
                                    <p class="pro-name pokemon-strawberry-flavor-name">Strawberry flavor</p>
                                    <span class="note-pokemon"><img src="<?php echo APP_ASSETS; ?>/img/product/note-pokemon.png" alt=""></span>
                                </li>
                            </ul>
                            <div class="btn-arrows btn-arrows-chewing-gum" data-arrows="chewing-gum">
                                <p class="btn-arrow prev"></p>
                                <p class="btn-arrow next"></p>
                            </div>
                        </div>
                        <div class="productSet-slider-nav slider-nav-gum" data-slide="chewing-gum">
                            <div class="slider-nav-gum-inner">
                                <ul class="slide-nav">
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img src="<?php echo APP_ASSETS; ?>img/top/img_product_chewing_grape.png" width="74" alt="Grape flavor" class="lazy">
                                            <figcaption class="chewing-grape-flavor-name">Grape flavor</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img src="<?php echo APP_ASSETS; ?>img/top/img_product_doraemon_strawberry.png" width="74" alt="Lotte Xylitol - Doraemon chewing gum strawberry flavor 3g" class="lazy">
                                            <figcaption class="doraemon-strawberry-flavor-name">Lotte Xylitol - Doraemon chewing gum strawberry flavor 3g</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img src="<?php echo APP_ASSETS; ?>img/top/img_product_doraemon_strawberry2.png" width="74" alt="Lotte Xylitol - Doraemon chewing gum strawberry flavor 9g" class="lazy">
                                            <figcaption class="doraemon-strawberry-flavor2-name">Lotte Xylitol - Doraemon chewing gum strawberry flavor 9g</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img src="<?php echo APP_ASSETS; ?>img/top/img_product_pokemon_strawberry.png" width="74" alt="Strawberry flavor" class="lazy">
                                            <figcaption class="pokemon-strawberry-flavor-name">Strawberry flavor</figcaption>
                                        </figure>
                                    </li>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    </div>
                    <p class="link"><a href="<?php echo APP_URL; ?>en/product/" class="button1"><span>MORE</span></a></p>
                </div>
            </div>

            <div class="movieSet deleteThis">
                <div class="inMovie">
                    <p class="bg1 wow fadeInLeft" data-wow-delay="0s">&nbsp;</p>
                    <div class="section wow fadeIn" data-wow-delay="0.2s">
                        <div class="clearfix">
                            <h2>Movie <br class="pc">Gallery</h2>
                            <ul class="mslider">
                                <li class="item"><div class="movie"><a href="https://www.youtube.com/watch?v=iKG-An3IC9I?loop=0&modestbranding=1&controls=1&showinfo=0;autoplay=1&cc_load_policy=0;&controls=0&showinfo=0&rel=0&enablejsapi=1&version=3&playerapiid=mbYTP_id_1442377998983&origin=http%3A%2F%2Ftemplate.ridianur.com&allowfullscreen=true&wmode=transparent&autohide=1;iv_load_policy=3&color=#8AC007;html5=1;player_id=player1" class="video" title="[LOTTE XYLITOL 2018 Campaign] Risk of the cavity (female ver.)" data-url="https://www.youtube.com/watch?v=iKG-An3IC9I"><span class="img"><img src="<?php echo APP_ASSETS; ?>img/top/img_movie.jpg" alt="[LOTTE XYLITOL 2018 Campaign] Risk of the cavity (female ver.)" class="pc"><img src="<?php echo APP_ASSETS; ?>img/top/img_movie_sp.jpg" alt="[LOTTE XYLITOL 2018 Campaign] Risk of the cavity (female ver.)" class="sp"></span></a></div></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <p class="link"><a href="<?php echo APP_URL; ?>en/movie/" class="button1"><span>MORE</span></a></p>
            </div>

            <div class="promoSet noDisplay">
                <p class="bg wow fadeInRight" data-wow-delay="0s">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="0.2s">
                    <div class="clearfix">
                        <h2>Promotion</h2>
                        <ul class="promolist">
                            <li class="item">
                                <p><img src="<?php echo APP_ASSETS; ?>img/top/img_promo1.jpg" alt="Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam"></p>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam</p>
                            </li><li class="item">
                                <p><img src="<?php echo APP_ASSETS; ?>img/top/img_promo2.jpg" alt="Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam"></p>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <p class="link"><a href="<?php echo APP_URL; ?>en/promotion/" class="button1"><span>MORE</span></a></p>
            </div>

            <div class="joinSet noDisplay">
                <div class="inJoin">
                    <p class="bg wow fadeInLeft" data-wow-delay="0s">&nbsp;</p>
                    <div class="section wow fadeIn" data-wow-delay="0.2s">
                        <h2>Join the campaign</h2>
                        <div class="yt">
                            <a href="https://www.youtube.com/watch?v=k_Z4N8bkReo?loop=0&modestbranding=1&controls=1&showinfo=0;autoplay=0&cc_load_policy=0;&controls=0&showinfo=0&rel=0&enablejsapi=1&version=3&playerapiid=mbYTP_id_1442377998983&origin=http%3A%2F%2Ftemplate.ridianur.com&allowfullscreen=true&wmode=transparent&autohide=1;iv_load_policy=3&color=#8AC007;html5=1;player_id=player1" class="video" title="Lotte Xylitol Effect : Animation Ver" data-url="https://www.youtube.com/watch?v=k_Z4N8bkReo"><span class="img"><img src="<?php echo APP_ASSETS; ?>img/top/img_join.jpg" alt="Lotte Xylitol Effect : Animation Ver" class="pc"><img src="<?php echo APP_ASSETS; ?>img/top/img_join_sp.jpg" alt="Lotte Xylitol Effect : Animation Ver" class="sp"></span></a>
                        </div>
                        <ul class="leaf wow fadeIn" data-wow-delay="0.5s">
                            <li class="item1"><img src="<?php echo APP_ASSETS; ?>img/common/img_leaf3.png" alt="leaf"></li>
                            <li class="item2"><img src="<?php echo APP_ASSETS; ?>img/common/img_leaf4.png" alt="leaf"></li>
                        </ul>
                    </div>
                </div>
                <p class="link"><a href="<?php echo APP_URL; ?>en/promotion/" class="button1"><span>MORE</span></a></p>
            </div>
        </main>
    </div><!-- #wrap -->

    <?php /*/ ?>
    <!-- Popup -->
    <section id="box-wellcom" class="box-wellcom">
        <div class="content">
            <h2 class="popup-title no-line c-green txt-center">Welcome to Lotte Xylitol!</h2>
            <?php if($is_logged_in == false) :?>
            <p class="title-sub">Exciting gifts and exclusive offers await all Lotte Xylitol fans when you join our fun activities!</p>
            <ul class="member-incentives">
                <li class="u-sp-pb-44">
                    <span class="number">1</span>Test your selfie skills in the photo contest with exciting prizes.
                    <div class="pkg pkg1"><img src="<?php echo APP_ASSETS; ?>img/common/pkg01.png" alt=""></div>
                </li>
                <li>
                    <span class="number">2</span>Become a Brand Ambassador of Lotte Xylitol.
                    <div class="pkg pkg3"><img src="<?php echo APP_ASSETS; ?>img/common/pkg03.png" alt=""></div>
                </li>
                <li><span class="number">3</span>Play a funny games and win prizes.</li>
            </ul>
            <?php else:?>
            <p class="title-sub">Enjoy exclusive offers and attractive gifts just for Lotte Xylitol members when participating in the following activities:</p>
            <ul class="member-incentives">
                <li class="u-sp-pb-44">
                    <span class="number">1</span>Test your skills in the photo contest with exciting prizes.
                    <div class="pkg pkg1"><img src="<?php echo APP_ASSETS; ?>img/common/pkg01.png" alt=""></div>
                </li>
                <li>
                    <span class="number">2</span>Become a brand ambassador for Lotte Xylitol.
                    <div class="pkg pkg3"><img src="<?php echo APP_ASSETS; ?>img/common/pkg03.png" alt=""></div>
                </li>
                <li><span class="number">3</span>Play games and win prizes.</li>
            </ul>
            <?php endif;?>
            <div class="detail txt-center">
                <a href="/en/membership-activities" class="btn-dark-green btn-center">Learn more</a>
            </div>
            <div class="box-bottom">
                <label class="checkbox">Do not show this message again
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>
    </section>
    <?php /*/ ?>
    <!-- Footer
    ================================================== -->
    <?php include(APP_PATH.'libs/footer.php'); ?>
<!-- End Document
================================================== -->
<script src="<?php echo APP_ASSETS; ?>js/wow/wow.js"></script>
<script src="<?php echo APP_ASSETS; ?>js/jquery.fancybox.pack.js"></script>
<script src="<?php echo APP_ASSETS; ?>js/slick/slick.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script> -->
<script src="<?php echo APP_ASSETS; ?>js/top.js?v=20260507"></script>
<script>

    $(window).bind("load resize", function() {
                var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
        if($(window).innerWidth() > 1490) {
                var posT = (w - 1490)/11;
                $('.prod_slider li .inside').css('background-position-y', posT);
        }
        if($(window).innerWidth() < 1490) {
                var posT1 = (w - 1490)/11;
                $('.prod_slider .slick-list').css({'margin-top': posT1});
                $('.prod_slider li .inside').css('background-position-y', 0);
        }
        if($(window).innerWidth() < 768) {
                $('.prod_slider .slick-list').css({'margin-top': 0});
                $('.prod_slider li .inside').css('background-position-y', 10);
        }
    });
</script>
</body>
</html>
