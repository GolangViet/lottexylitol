<?php
// Author: A+LIVE
include_once ('app_config.php');
include(APP_PATH.'libs/lotte-api.php');

if(isset($_GET['signout'])) {
    $lotte_api->logout();
    header('Location: /');
	exit;
}

$is_logged_in = $lotte_api->is_logged_in();

include (APP_PATH . 'libs/head.php');
?>
<link type="text/css" rel="stylesheet" href="<?php echo APP_ASSETS; ?>js/wow/animate.min.css">
<link type="text/css" rel="stylesheet" href="<?php echo APP_ASSETS; ?>js/slick/slick.css">
</head>

<body id="top" class="top vn">
    <!-- Header
    ================================================== -->
    <?php include (APP_PATH . 'libs/header.php'); ?>
    <div id="wrap">
        <!-- Main Content
        ================================================== -->
        <main class="main">
            <?php /*/ ?><div class="kv">
                <img class="pc" src="<?php echo APP_ASSETS; ?>img/top/kv_pc.jpg" alt="">
                <img class="sp" src="<?php echo APP_ASSETS; ?>img/top/kv_sp.jpg" alt="">
            </div><?php /*/ ?>
            <div class="visual">
                <ul class="vslider">
                    <li class="item slider01 item01">
                        <p class="lazy-bg" data-animation="fadeInRight" data-delay="0s">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_7_vi_pc.webp" alt="Xylitol" class="pc">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_7_vi_sp.webp" alt="Xylitol" class="sp">
                        </p>
                    </li>
                    <li class="item slider01 item01">
                        <p class="lazy-bg" data-animation="fadeInRight" data-delay="0s">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_6_pc.webp" alt="Xylitol" class="pc">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_6_sp.webp" alt="Xylitol" class="sp">
                        </p>
                    </li>
                    <li class="item slider01 item01">
                        <p class="lazy-bg" data-animation="fadeInRight" data-delay="0s">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_1_pc.webp" alt="Xylitol" class="pc">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_1_sp.webp" alt="Xylitol" class="sp">
                        </p>
                    </li>
                    <li class="item slider01 item01">
                        <p class="lazy-bg" data-animation="fadeInRight" data-delay="0s">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_2_pc.webp" alt="Xylitol" class="pc">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_2_sp.webp" alt="Xylitol" class="sp">
                        </p>
                    </li>
                    <li class="item slider01 item01">
                        <p class="lazy-bg" data-animation="fadeInRight" data-delay="0s">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_3_pc.webp" alt="Xylitol" class="pc">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_3_sp.webp" alt="Xylitol" class="sp">
                        </p>
                    </li>
                    <li class="item slider01 item01">
                        <p class="lazy-bg" data-animation="fadeInRight" data-delay="0s">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_4_pc.webp" alt="Xylitol" class="pc">
                            <img src="<?php echo APP_ASSETS; ?>img/top/slider/img_kv_4_sp.webp" alt="Xylitol" class="sp">
                        </p>
                    </li>
                </ul>
            </div>
            <div class="whatSet">
                <p class="bg1 wow fadeInRight bg-lazy">&nbsp;</p>
                <p class="bg2 wow fadeIn bg-lazy">&nbsp;</p>
                <div class="section wow fadeIn">
                    <h2 class="wow fadeIn">Tìm hiểu XYLITOL?</h2>
                    <ul class="whatlist">
                        <li class="item2"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_what2.png" alt="Xylitol" class="lazy"></li>
                        <li class="item3"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_what3.png" alt="Xylitol" class="lazy"></li>
                        <li class="item4"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_what4.png" alt="Xylitol" class="lazy"></li>
                    </ul>
                    <div class="desc wow fadeIn" data-wow-delay="0.5s">
                        <p>Xylitol đã được chứng minh giúp ngăn ngừa sâu răng hiệu quả trên toàn thế giới, và còn góp phần làm răng chắc khoẻ hơn. Trong tất cả các loại kẹo gum tại Việt Nam hiện nay,
                            chỉ kẹo gum nha khoa của Lotte Xylitol được Hội răng hàm mặt Việt Nam chứng nhận về khả năng giúp ngăn ngừa sâu răng.</p>
                        <p class="link"><a href="<?php echo APP_URL; ?>what-is-xylitol/" class="button1"><span>xem thêm</span></a></p>
                    </div>
                </div>
                <ul class="leaf wow fadeIn" data-wow-delay="0.5s">
                    <li class="item2"><img class="pc lazy" data-img-src="<?php echo APP_ASSETS; ?>img/common/img_leaf5.png" alt="leaf"><img class="sp lazy"
                            data-img-src="<?php echo APP_ASSETS; ?>img/common/img_leaf6.png" alt="leaf"></li>
                </ul>
            </div>

            <div class="whySet">
                <p class="bg wow fadeInLeft bg-lazy">&nbsp;</p>
                <div class="section">
                    <h2 class="wow fadeIn" data-wow-delay="0.5s">Tại sao chọn Xylitol?</h2>
                    <ul class="whylist wow fadeIn" data-wow-delay="1s">
                        <li class="item1">
                            <p class="pic lazy"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_why1.png" alt="Xylitol được hỗ trợ bởi chứng nhận khoa học" class="lazy"></p>
                            <h3>Xylitol được chứng minh bởi các nghiên cứu khoa học</h3>
                            <p class="text">Chính phủ khuyến khích sử dụng Xylitol từ thập niên 70.<br>* DMFT ở mỗi độ tuổi đã giảm dần qua các năm.</p>
                            <p class="note">*DMFT: Tỉ lệ răng sâu, răng rụng và răng trám.</p>
                        </li>
                        <li class="item2">
                            <p class="pic"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_why2.png" alt="Xylitol đảm bảo hiệu quả trên toàn thế giới" class="lazy"></p>
                            <h3>Xylitol đảm bảo hiệu <br class="pc"> quả trên toàn thế giới</h3>
                            <p class="text">Lợi ích giúp ngăn ngừa sâu răng của Xylitol đã được chứng nhận bởi các hiệp hội nha khoa ở nhiều nước trên thế giới.</p>
                        </li>
                        <li class="item3">
                            <p class="pic"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_why3.png" alt="Sức khỏe răng miệng tác động đến các vấn đề sức khỏe khác" class="lazy"></p>
                            <h3>Sức khỏe răng miệng tác động<br class="pc"> đến các vấn đề sức khỏe khác</h3>
                            <p class="text">Chăm sóc sức khỏe răng miệng không chỉ có ý nghĩa với răng, nướu và hơi thở mà còn tác động đến nhiều vấn đề sức khỏe khác bên trong cơ thể.</p>
                        </li>
                    </ul>
                    <p class="link"><a href="<?php echo APP_URL; ?>why-xylitol/" class="button1"><span>xem thêm</span></a></p>
                </div>
                <p class="bg2 bg-lazy">&nbsp;</p>
                <div class="per-img">
                    <div class="inner">
                        <img class="pc lazy" data-img-src="<?php echo APP_ASSETS; ?>img/top/product_lime_mint_mv.png" alt="">
                        <img class="sp lazy" data-img-src="<?php echo APP_ASSETS; ?>img/top/product_lime_mint_mv.png" width="108" alt="">
                    </div>
                </div>
            </div>

            <div class="productSet">
                <!-- <p class="bg1 wow fadeInRight" data-wow-delay="0s">&nbsp;</p> -->
                <!-- <p class="bg2 wow fadeInLeft" data-wow-delay="0s">&nbsp;</p> -->

                <div class="section wow fadeIn" data-wow-delay="0.2s">
                    <h2>Sản phẩm</h2>
                    <div class="productSet__slider productSet__slider--gum productSet__slider--gum-1">
                        <h3 class="product-title">Kẹo gum</h3>
                        <div class="productSet-slider-for slider-for-gum" data-slide="product">
                            <ul class="slide-for">
                                <li class="slide-for-item lime-mint lazy-before">
                                    <figure class="pro-img"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product1.png" alt="Hương Lime Mint" class="lazy"></figure>
                                    <p class="pro-name lime-mint-name">Hương Lime Mint</p>
                                </li>
                                <li class="slide-for-item fresh-mint lazy-before">
                                    <figure class="pro-img"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product2.png" alt="Hương Fresh Mint" class="lazy"></figure>
                                    <p class="pro-name fresh-mint-name">Hương Fresh Mint</p>
                                </li>
                                <li class="slide-for-item strawberry-mint lazy-before">
                                    <figure class="pro-img"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product3.png" alt="Hương Strawberry Mint" class="lazy"></figure>
                                    <p class="pro-name strawberry-mint-name">Hương <br class="pc">Strawberry Mint</p>
                                </li>
                                <li class="slide-for-item blueberry-mint lazy-before">
                                    <figure class="pro-img"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product4.png" alt="Hương Blueberry Mint" class="lazy"></figure>
                                    <p class="pro-name blueberry-mint-name">Hương <br class="pc">Blueberry Mint</p>
                                </li>
                                <li class="slide-for-item cool-mint lazy-before">
                                    <figure class="pro-img"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product5.png" alt="Hương Bạc Hà cực mạnh" class="lazy"></figure>
                                    <p class="pro-name cool-mint-name">Hương Bạc Hà cực mạnh</p>
                                </li>
                                <li class="slide-for-item assorted-fruits-flavor lazy-before">
                                    <figure class="pro-img"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product8.png" alt="Hương Trái cây hỗn hợp" class="lazy"></figure>
                                    <p class="pro-name assorted-fruits-flavor-name">Hương Trái cây hỗn hợp</p>
                                </li>
                                <li class="slide-for-item melon-flavor lazy-before">
                                    <figure class="pro-img"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product9.png" alt="Hương Melon Mint" class="lazy"></figure>
                                    <p class="pro-name melon-flavor-name">Hương Melon Mint</p>
                                </li>
                                <li class="slide-for-item nuocgiaikhat lazy-before">
                                    <figure class="pro-img"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_top_nuocgiaikhat.png" alt="Hương Nước giải khát hỗn hợp" class="lazy"></figure>
                                    <p class="pro-name nuocgiaikhat-name">Hương Nước giải khát hỗn hợp</p>
                                </li>
                            </ul>
                            <div class="btn-arrows btn-arrows-gum" data-arrows="product">
                                <p class="btn-arrow prev"></p>
                                <p class="btn-arrow next"></p>
                            </div>
                        </div>
                        <div class="productSet-slider-nav slider-nav-gum" data-slide="product">
                            <div class="slider-nav-gum-inner">
                                <ul class="slide-nav">
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product1.png" width="74" alt="Hương Lime Mint" class="lazy">
                                            <figcaption class="lime-mint-name">Hương Lime Mint</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product2.png" width="74" alt="Hương Fresh Mint" class="lazy">
                                            <figcaption class="fresh-mint-name">Hương Fresh Mint</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product3.png" width="74" alt="Hương Strawberry Mint" class="lazy">
                                            <figcaption class="strawberry-mint-name">Hương <br class="pc">Strawberry Mint</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product4.png" width="74" alt="Hương Blueberry Mint" class="lazy">
                                            <figcaption class="blueberry-mint-name">Hương <br class="pc">Blueberry Mint</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product5.png" width="74" alt="Hương Bạc Hà cực mạnh" class="lazy">
                                            <figcaption class="cool-mint-name">Hương Bạc Hà cực mạnh</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product8.png" width="74" alt="Hương Trái cây hỗn hợp" class="lazy">
                                            <figcaption class="assorted-fruits-flavor-name">Hương Trái cây hỗn hợp</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product9.png" width="74" alt="Hương Melon Mint" class="lazy">
                                            <figcaption class="melon-flavor-name">Hương Melon Mint</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_top_nuocgiaikhat.png" width="74" alt="Hương Nước giải khát hỗn hợp" class="lazy">
                                            <figcaption class="nuocgiaikhat-name">Hương Nước giải khát hỗn hợp</figcaption>
                                        </figure>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="productSet__slider productSet__slider--gum reverse">
                        <h3 class="product-title">Kẹo ngậm cho trẻ em</h3>
                        <div class="productSet-slider-for slider-for-gum slider-for-tablet-for-kids" data-slide="tablet-for-kids">
                            <ul class="slide-for">
                                <li class="slide-for-item strawberry-flavor lazy-before">
                                    <figure class="pro-img"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product_strawberry.png" alt="Hương Dâu" class="lazy"></figure>
                                    <p class="pro-name strawberry-flavor-name">Hương Dâu</p>
                                    <span class="note-doraemon pc"><img src="<?php echo APP_ASSETS; ?>/img/product/note-doraemon.png" alt=""></span>
                                </li>
                                <li class="slide-for-item grape-flavor lazy-before">
                                    <figure class="pro-img"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product_grape.png" alt="Hương Nho" class="lazy"></figure>
                                    <p class="pro-name grape-flavor-name">Hương Nho</p>
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
                                            <img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product_strawberry.png" width="74" alt="Hương Dâu" class="lazy">
                                            <figcaption class="strawberry-flavor-name">Hương Dâu</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product_grape.png" width="74" alt="Hương Nho" class="lazy">
                                            <figcaption class="grape-flavor-name">Hương Nho</figcaption>
                                        </figure>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="productSet__slider productSet__slider--gum">
                        <h3 class="product-title">Kẹo Gum cho trẻ em</h3>
                        <div class="productSet-slider-for slider-for-gum slider-for-chewing-gum" data-slide="chewing-gum">
                            <ul class="slide-for">
                                <li class="slide-for-item chewing-grape-flavor lazy-before">
                                    <figure class="pro-img"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product_chewing_grape.png" alt="Hương Nho" class="lazy"></figure>
                                    <p class="pro-name chewing-grape-flavor-name">Hương Nho</p>
                                    <span class="note-doraemon pc"><img src="<?php echo APP_ASSETS; ?>/img/product/note-doraemon.png" alt=""></span>
                                </li>
                                <li class="slide-for-item doraemon-strawberry-flavor lazy-before">
                                    <figure class="pro-img"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product_doraemon_strawberry.png" alt="Kẹo gum không đường Lotte Xylitol - Doraemon hương dâu 3g (Lotte Xylitol)" class="lazy"></figure>
                                    <p class="pro-name doraemon-strawberry-flavor-name">Kẹo gum không đường Lotte Xylitol - Doraemon hương dâu 3g (Lotte Xylitol)</p>
                                    <span class="note-doraemon pc"><img src="<?php echo APP_ASSETS; ?>/img/product/note-doraemon.png" alt=""></span>
                                </li>
                                <li class="slide-for-item doraemon-strawberry-flavor2 lazy-before">
                                    <figure class="pro-img"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product_doraemon_strawberry2.png" alt="Kẹo gum không đường Lotte Xylitol - Doraemon hương dâu 9g (Lotte Xylitol)" class="lazy"></figure>
                                    <p class="pro-name doraemon-strawberry-flavor2-name">Kẹo gum không đường Lotte Xylitol - Doraemon hương dâu 9g (Lotte Xylitol)</p>
                                    <span class="note-doraemon pc"><img src="<?php echo APP_ASSETS; ?>/img/product/note-doraemon.png" alt=""></span>
                                </li>
                                <li class="slide-for-item pokemon-strawberry-flavor lazy-before">
                                    <figure class="pro-img"><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product_pokemon_strawberry.png" alt="Hương dâu" class="lazy"></figure>
                                    <p class="pro-name pokemon-strawberry-flavor-name">Hương dâu</p>
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
                                            <img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product_chewing_grape.png" width="74" alt="Hương Nho" class="lazy">
                                            <figcaption class="chewing-grape-flavor-name">Hương Nho</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product_doraemon_strawberry.png" width="74" alt="Kẹo gum không đường Lotte Xylitol - Doraemon hương dâu 3g (Lotte Xylitol)" class="lazy">
                                            <figcaption class="doraemon-strawberry-flavor-name">Kẹo gum không đường Lotte Xylitol - Doraemon hương dâu 3g (Lotte Xylitol)</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product_doraemon_strawberry2.png" width="74" alt="Kẹo gum không đường Lotte Xylitol - Doraemon hương dâu 9g (Lotte Xylitol)" class="lazy">
                                            <figcaption class="doraemon-strawberry-flavor2-name">Kẹo gum không đường Lotte Xylitol - Doraemon hương dâu 9g (Lotte Xylitol)</figcaption>
                                        </figure>
                                    </li>
                                    <li class="slide-nav-item lazy-before">
                                        <figure>
                                            <img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_product_pokemon_strawberry.png" width="74" alt="Hương dâu" class="lazy">
                                            <figcaption class="pokemon-strawberry-flavor-name">Hương dâu</figcaption>
                                        </figure>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="movieSet deleteThis">
                <div class="inMovie">
                    <p class="bg1 wow fadeInLeft lazy-bg" data-wow-delay="0s">&nbsp;</p>
                    <div class="section wow fadeIn" data-wow-delay="0.2s">
                        <div class="clearfix">
                            <h2>Quảng cáo</h2>
                            <ul class="mslider">
                                <li class="item js-movie"></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <p class="link"><a href="<?php echo APP_URL; ?>movie/" class="button1"><span>xem thêm</span></a></p>
            </div>

            <div class="promoSet noDisplay">
                <p class="bg wow fadeInRight" data-wow-delay="0s">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="0.2s">
                    <div class="clearfix">
                        <h2>Khuyến mãi</h2>
                        <ul class="promolist">
                            <li class="item">
                                <p><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_promo1.jpg" alt="Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam" class="lazy"></p>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam</p>
                            </li>
                            <li class="item">
                                <p><img data-img-src="<?php echo APP_ASSETS; ?>img/top/img_promo2.jpg" alt="Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam" class="lazy"></p>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <p class="link"><a href="<?php echo APP_URL; ?>promotion/" class="button1"><span>xem thêm</span></a></p>
            </div>

            <div class="joinSet noDisplay">
                <div class="inJoin">
                    <p class="bg wow fadeInLeft" data-wow-delay="0s">&nbsp;</p>
                    <div class="section wow fadeIn" data-wow-delay="0.2s">
                        <h2>Tham gia Chiến dịch</h2>
                        <div class="yt">
                            <a href="https://www.youtube.com/watch?v=k_Z4N8bkReo?loop=0&modestbranding=1&controls=1&showinfo=0;autoplay=0&cc_load_policy=0;&controls=0&showinfo=0&rel=0&enablejsapi=1&version=3&playerapiid=mbYTP_id_1442377998983&origin=http%3A%2F%2Ftemplate.ridianur.com&allowfullscreen=true&wmode=transparent&autohide=1;iv_load_policy=3&color=#8AC007;html5=1;player_id=player1"
                                class="video" title="Lotte Xylitol Effect : Animation Ver" data-url="https://www.youtube.com/watch?v=k_Z4N8bkReo"><span class="img"><img
                                        src="<?php echo APP_ASSETS; ?>img/top/img_join.jpg" alt="Lotte Xylitol Effect : Animation Ver" class="pc"><img
                                        src="<?php echo APP_ASSETS; ?>img/top/img_join_sp.jpg" alt="Lotte Xylitol Effect : Animation Ver" class="sp"></span></a>
                        </div>
                        <ul class="leaf wow fadeIn" data-wow-delay="0.5s">
                            <li class="item1"><img src="<?php echo APP_ASSETS; ?>img/common/img_leaf3.png" alt="leaf"></li>
                            <li class="item2"><img src="<?php echo APP_ASSETS; ?>img/common/img_leaf4.png" alt="leaf"></li>
                        </ul>
                    </div>
                </div>
                <p class="link"><a href="<?php echo APP_URL; ?>promotion/" class="button1"><span>xem thêm</span></a></p>
            </div>
        </main>
        </main>
    </div><!-- #wrap -->

    <?php /*/ ?>
    <!-- Popup -->
    <section id="box-wellcom" class="box-wellcom">
        <div class="content">
            <h2 class="popup-title no-line c-green txt-center">Chào mừng bạn đến với Lotte Xylitol!</h2>
            <?php if($is_logged_in == false) :?>
            <p class="title-sub">Sốt xình xịch, đăng ký trở thành viên của Lotte Xylitol ngay hôm nay để nhận những phần quà hấp dẫn.</p>
            <?php else:?>
            <p class="title-sub">Tấp nập nhận quà và những ưu đãi cực kỳ hấp dẫn chỉ dành riêng cho các XYLITOL-ERS của Lotte Xylitol khi tham gia các hoạt động cực kỳ thú vị nhé!!</p>
            <?php endif;?>
            <ul class="member-incentives">
                <li class="u-sp-pb-44">
                    <span class="number">1</span>Thử sức trong cuộc thi ảnh cùng giải thưởng hấp dẫn
                    <div class="pkg pkg1"><img src="<?php echo APP_ASSETS; ?>img/common/pkg01.png" alt=""></div>
                </li>
                <li>
                    <span class="number">2</span>Trở thành đại sứ thương hiệu của Lotte Xylitol
                    <div class="pkg pkg3"><img src="<?php echo APP_ASSETS; ?>img/common/pkg03.png" alt=""></div>
                </li>
                <li><span class="number">3</span>Chơi game nhận quà</li>
            </ul>
            <div class="detail txt-center">
                <a href="/membership-activities" class="btn-dark-green btn-center">XEM CHI TIẾT</a>
            </div>
            <div class="box-bottom">
                <label class="checkbox">Không hiển thị lại thông báo này.
                    <input type="checkbox">
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>
    </section>
    <?php /*/ ?>
    <!-- Footer
    ================================================== -->

    <?php include (APP_PATH . 'libs/footer.php'); ?>
    <!-- End Document
================================================== -->
    <script src="<?php echo APP_ASSETS; ?>js/wow/wow.js"></script>
    <script src="<?php echo APP_ASSETS; ?>js/slick/slick.js"></script>
    <script src="<?php echo APP_ASSETS; ?>js/top.js?v=20260507"></script>
    <script>

        $( window ).bind( "load resize", function ()
        {
            var w = Math.max( document.documentElement.clientWidth, window.innerWidth || 0 );
            if ( $( window ).innerWidth() > 1490 ) {
                var posT = ( w - 1490 ) / 11;
                $( '.prod_slider li .inside' ).css( 'background-position-y', posT );
            }
            if ( $( window ).innerWidth() < 1490 ) {
                var posT1 = ( w - 1490 ) / 11;
                $( '.prod_slider .slick-list' ).css( { 'margin-top': posT1 } );
                $( '.prod_slider li .inside' ).css( 'background-position-y', 0 );
            }
            if ( $( window ).innerWidth() < 768 ) {
                $( '.prod_slider .slick-list' ).css( { 'margin-top': 0 } );
                $( '.prod_slider li .inside' ).css( 'background-position-y', 10 );
            }
        } );
    </script>
    <script>
        $( window ).load( function ()
        {
            $( '.lazy' ).each( function ()
            {
                var $imgSrc = $( this ).data( 'img-src' ),
                    $this = $( this );
                setTimeout( function ()
                {
                    $this.attr( "src", $imgSrc );
                }, 2000 )
            } );
            setTimeout( function ()
            {
                $( '.js-movie' ).append( '<div class="movie"><a href="https://www.youtube.com/watch?v=5XOz3Tj-ADE?loop=0&modestbranding=1&controls=1&showinfo=0;autoplay=1&cc_load_policy=0;&controls=0&showinfo=0&rel=0&enablejsapi=1&version=3&playerapiid=mbYTP_id_1442377998983&origin=http%3A%2F%2Ftemplate.ridianur.com&allowfullscreen=true&wmode=transparent&autohide=1;iv_load_policy=3&color=#8AC007;html5=1;player_id=player1" class="video" title="[LOTTE XYLITOL 2018 Campaign] Risk of the cavity (female ver.)" data-url="https://www.youtube.com/watch?v=5XOz3Tj-ADE"><span class="img"><img src="<?php echo APP_ASSETS; ?>img/top/img_movie.jpg" alt="[LOTTE XYLITOL 2018 Campaign] Risk of the cavity (female ver.)" class="pc"><img src="<?php echo APP_ASSETS; ?>img/top/img_movie.jpg" alt="[LOTTE XYLITOL 2018 Campaign] Risk of the cavity (female ver.)" class="sp"></span></a></div>' );

            }, 2000 )


        } )
    </script>
</body>

</html>
