<?php
// Author: A+LIVE
include_once('../../../app_config.php');
include(APP_PATH.'libs/head.php');
?>
<link type="text/css" rel="stylesheet" href="<?php echo APP_ASSETS; ?>js/wow/animate.min.css">
</head>

<body id="product" class="product">
    <!-- Header
    ================================================== -->
    <?php include(APP_PATH.'libs/header.php'); ?>
    <div id="wrap">
        <!-- Main Content
        ================================================== -->
        <main class="main bgmain wow fadeIn">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/en/">Top</a></li>
                    <li>Products</li>
                </ul>
            </div>
        	<h1 class="bHead">Products</h1>
            <div class="prodCat">
                <div class="section">
                    <div class="prodCat-box">
                        <ul class="clearfix">
                            <li><a href="<?php echo APP_URL; ?>en/product/"><span>GUM</span></a></li>
                            <li class="active"><a href="<?php echo APP_URL; ?>en/product/tablet/"><span>TABLET</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        	<div class="prodSet1">
                <div class="section">
                    <ul class="prodAnchor wow fadeIn" data-wow-delay="0.3s">
                        <li><a href="#an1"><span>Watermelon Mint</span></a></li>
                        <li><a href="#an2"><span>Pepper Mint</span></a></li>
                        <li><a href="#an3"><span>Orange Mint</span></a></li>
                    </ul>
                </div>
            </div>

            <div class="prodSet2 pro-tablet watermelon"><p class="myAn" id="an1">&nbsp;</p>
            	<p class="bg wow fadeInRight">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="2s">
                	<h3 class="bHead">Watermelon Mint</h3>
                    <p class="text">Watermelon Mint flavor that you can taste sweet & cool. <br class="pc">It is suitable for summer season.</p>
                    <ul class="prod_list">
                    	<li><img src="<?php echo APP_ASSETS; ?>img/product/img_tablet4.png" alt=""><span>Tablet<em>20.88g</em></span></li>
                    </ul>
                </div>
                <p class="pic wow zoomIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/product/pic_tablet4.png" alt="" class="pc"><img src="<?php echo APP_ASSETS; ?>img/product/pic_tablet4_sp.png" alt="" class="sp"></p>
            </div>

            <div class="prodSet2 pro-tablet fresh"><p class="myAn" id="an2">&nbsp;</p>
            	<p class="bg wow fadeInRight">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="2s">
                	<h3 class="bHead">Pepper Mint</h3>
                    <p class="text">Pepper Mint flavor helps you to be always refreshing <br class="pc">and ready for the new things.</p>
                    <ul class="prod_list">
                    	<li><img src="<?php echo APP_ASSETS; ?>img/product/img_tablet2.png" alt=""><span>Tablet<em>20.88g</em></span></li>
                    </ul>
                </div>
                <p class="pic wow zoomIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/product/pic_tablet2.png" alt="" class="pc"><img src="<?php echo APP_ASSETS; ?>img/product/pic_tablet2_sp.png" alt="" class="sp"></p>
            </div>

            <div class="prodSet2 pro-tablet orange"><p class="myAn" id="an3">&nbsp;</p>
            	<p class="bg wow fadeInRight">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="2s">
                	<h3 class="bHead">Orange Mint</h3>
                    <p class="text">Orange Mint flavor gives you the refreshing feeling <br class="pc">with moderate coolness & sweetness.</p>
                    <ul class="prod_list">
                    	<li><img src="<?php echo APP_ASSETS; ?>img/product/img_tablet3.png" alt=""><span>Tablet<em>20.88g</em></span></li>
                    </ul>
                </div>
                <p class="pic wow zoomIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/product/pic_tablet3.png" alt="" class="pc"><img src="<?php echo APP_ASSETS; ?>img/product/pic_tablet3_sp.png" alt="" class="sp"></p>
            </div>

           <div class="btn-flex">
                <p class="cm-btn__product js-popup"><span>BUY NOW</span></p>
           </div>
        </main>
    </div><!-- #wrap -->

    <div id="popup-brand">
        <div class="popup-outer">
            <div class="popup-inner">
                <p class="popup-close">
                    <img src="<?php echo APP_ASSETS; ?>img/common/ico_close.png" width="14" alt="close" class="pc">
                    <img src="<?php echo APP_ASSETS; ?>img/common/ico_close_white.png" width="21" alt="close" class="sp">
                </p>
                <div class="popup-lst">
                    <a class="popup-item ico_shopee" href="https://shopee.vn/lotte_official_store" target="_blank" rel="noopener"><img src="<?php echo APP_ASSETS; ?>img/common/ico_shopee.png" width="160" alt="shoppe"></a>

                    <a class="popup-item ico_lazada" href="https://www.lazada.vn/shop/lotte/" target="_blank" rel="noopener"><img src="<?php echo APP_ASSETS; ?>img/common/ico_lazada.png" width="191" alt="lazada"></a>

                    <a class="popup-item ico_aeon" href="https://aeoneshop.com/products/search/Lotte%20Xylitol" target="_blank" rel="noopener"><img src="<?php echo APP_ASSETS; ?>img/common/ico_aeon.png" width="197" alt="aeon"></a>

                    <a class="popup-item ico_coopxtra" href="https://www.lottemart.vn/vi-tbh/category?q=lotte+xylitol+lime+mint" target="_blank" rel="noopener"><img src="<?php echo APP_ASSETS; ?>img/common/ico_coopxtra.png" width="166" alt="coopxtra"></a>

                    <a class="popup-item ico_speed" href="http://speedl.vn/ProductDetail.do?prd_seq=8582" target="_blank" rel="noopener"><img src="<?php echo APP_ASSETS; ?>img/common/ico_speed.png" width="200" alt="speed"></a>

                    <a class="popup-item ico_vinmart" href="https://vinmart.com/searchpves/xylitol" target="_blank" rel="noopener"><img src="<?php echo APP_ASSETS; ?>img/common/ico_vinmart.png" width="152" alt="vinmart"></a>

                    <a class="popup-item ico_emart" href="https://emartmall.com.vn/index.php?search=xylitol&submit_search=&route=product%2Fsearch&sub_category=true&description=true&search_category_id=&search_store_id=0&search_type=recent_search" target="_blank" rel="noopener"><img src="<?php echo APP_ASSETS; ?>img/common/ico_emart.png" width="175" alt="emart"></a>

                    <a class="popup-item ico_tiki" href="https://tiki.vn/cua-hang/lotte-official-store" target="_blank" rel="noopener"><img src="<?php echo APP_ASSETS; ?>img/common/ico_tiki.png" alt="tiki"></a>

                    <!--<a class="popup-item ico_coopmart" style="cursor:initial" rel="noopener"></a>-->
                </div>
            </div>
        </div>
    </div>
    <!-- Footer
    ================================================== -->
    <?php include(APP_PATH.'libs/footer.php'); ?>
<!-- End Document
================================================== -->
<script src="<?php echo APP_ASSETS; ?>js/wow/wow.js"></script>
<script src="<?php echo APP_ASSETS; ?>js/lib/jquery.matchHeight.min.js"></script>
<script>
    $(function(){
        $('.prodAnchor li a').matchHeight();
    });
</script>
<script>
    $(window).on('load', function(event) {
        if($('#popup-brand').length && $('.js-popup').length){
            $('.js-popup').on('click', function(event) {
                $('#popup-brand').addClass("popup-brand__active");
            });
            $('.popup-close').on('click', function(event) {
                $('#popup-brand').removeClass("popup-brand__active");
            });
        }
    });
</script>
</body>
</html>
