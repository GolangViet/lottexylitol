<?php
// Author: A+LIVE
include_once('../app_config.php');
include(APP_PATH.'libs/head.php');
include (APP_PATH . 'libs/lotte-api.php');
$productCategories = $lotte_api->get_product_categories();

?>
<link type="text/css" rel="stylesheet" href="<?php echo APP_ASSETS; ?>js/wow/animate.min.css">
</head>

<body id="product" class="product vn">
    <!-- Header
    ================================================== -->
    <?php include(APP_PATH.'libs/header.php'); ?>
    <div id="wrap">
        <!-- Main Content
        ================================================== -->
        <main class="main bgmain wow fadeIn">
            <div class="breadcrumb">
				<ul>
					<li><a href="/">Trang chủ</a></li>
					<li>Sản phẩm</li>
				</ul>
			</div>
            <h1 class="bHead">Sản phẩm</h1>

            <?php if (!empty($productCategories)) { ?>
                <?php foreach ($productCategories as $productCategory) { ?>
                    <?php $productCategoryChildren = $productCategory['children'] ?? []; ?>
                    <?php $generalProductCategory = $productCategory['general']['vn_group'] ?? []; ?>

                    <div class="prodCat">
                        <div class="section">
                            <div class="prodCat-box" style="border: none">
                                <ul class="clearfix" style="display: flex; justify-content: center">
                                    <li class="active"><a href="#"><span><?php echo $generalProductCategory['title'] ?? '' ?></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($productCategoryChildren)) { ?>
                        <div class="prodSet1">
                            <div class="section">
                                <ul class="prodAnchor wow fadeIn" data-wow-delay="0.3s">
                                    <?php foreach ($productCategoryChildren as $productCategoryChild) { ?>
                                        <?php $generalProductCategoryChild = $productCategoryChild['general']['vn_group'] ?? []; ?>
                                        <li>
                                            <a href="#an<?php echo $productCategoryChild['id'] ?? 0; ?>">
                                                <span><?php echo $generalProductCategoryChild['short_title'] ?? ''; ?></span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>

            <?php if (!empty($productCategories)) { ?>
                <?php foreach ($productCategories as $productCategory) { ?>
                    <?php $productCategoryChildren = $productCategory['children'] ?? []; ?>

                    <?php if (!empty($productCategoryChildren)) { ?>
                        <?php foreach ($productCategoryChildren as $productCategoryChild) { ?>
                            <?php $productCategoryProducts = $productCategoryChild['products'] ?? []; ?>
                            <?php $productCategoryDetail = $productCategoryChild['general']['vn_group'] ?? []; ?>

                            <div class="prodSet2 <?php echo $productCategoryChild['css_class'] ?? ''; ?>">
                                <p class="myAn" id="an<?php echo $productCategoryChild['id'] ?? 0; ?>">&nbsp;</p>
                                <p
                                    style="
                                        <?php echo '--product-set-background-pc: url(' . ($productCategoryDetail['desktop']['background']['url'] ?? '') . ');'; ?>
                                        <?php echo '--product-set-background-sp: url(' . ($productCategoryDetail['mobile']['background']['url'] ?? '') . ');'; ?>
                                    "
                                    class="bg wow fadeInRight"
                                    data-wow-delay="0.5s">&nbsp;</p>
                                <div class="section wow fadeIn" data-wow-delay="2s">
                                    <h3 class="bHead"><?php echo $productCategoryDetail['title'] ?? '' ?></h3>
                                    <p class="text"><?php echo $productCategoryDetail['description'] ?? '' ?></p>

                                    <?php if (!empty($productCategoryProducts)) { ?>
                                        <ul class="prod_list">
                                            <?php foreach ($productCategoryProducts as $productItem) { ?>
                                                <?php $productDetail = $productItem['vn_group'] ?? []; ?>

                                                <li>
                                                    <img
                                                        src="<?php echo $productDetail['thumbnail']['url'] ?? ''; ?>"
                                                        alt="<?php echo $productDetail['unit']['label'] ?? ''; ?>" />
                                                    <span>
                                                        <?php echo $productDetail['unit']['label'] ?? ''; ?>
                                                        <em>
                                                            <?php echo $productDetail['weight']['value'] ?? ''; ?>
                                                            <?php echo $productDetail['weight']['unit']['value'] ?? ''; ?>
                                                        </em>
                                                    </span>
                                                </li>

                                            <?php } ?>
                                        </ul>
                                    <?php } ?>

                                    <?php if (!empty($productCategoryDetail['desktop']['copyright']['url'] ?? '')) { ?>
                                        <img
                                            src="<?php echo $productCategoryDetail['desktop']['copyright']['url'] ?? ''; ?>"
                                            alt="<?php echo $productCategoryDetail['title'] ?? ''; ?>"
                                            class="note" />
                                    <?php } ?>

                                </div>
                                <p class="pic wow zoomIn" data-wow-delay="1s">
                                    <img
                                        src="<?php echo $productCategoryDetail['desktop']['thumbnail']['url'] ?? ''; ?>"
                                        alt="<?php echo $productCategoryDetail['title'] ?? ''; ?>"
                                        class="pc" />
                                    <img
                                        src="<?php echo $productCategoryDetail['mobile']['thumbnail']['url'] ?? ''; ?>"
                                        alt="<?php echo $productCategoryDetail['title'] ?? ''; ?>"
                                        class="sp">
                                </p>
                            </div>

                        <?php } ?>
                    <?php } ?>

                <?php } ?>
            <?php } ?>

            <div class="btn-flex">
                <p class="cm-btn__product js-popup"><span>MUA NGAY</span></p>
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
