<?php
// Author: A+LIVE
include_once('../../app_config.php');
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
                    <div class="prodCat-box" style="border: none">
                        <ul class="clearfix" style="display: flex; justify-content: center">
                            <li class="active"><a href="<?php echo APP_URL; ?>en/product/"><span>Lotte Xylitol Chewing Gum</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        	<div class="prodSet1">
                <div class="section">
                    <ul class="prodAnchor wow fadeIn" data-wow-delay="0.3s">
                        <!-- <li><a href="#an0">Watermelon Mint</a></li> -->
                        <li><a href="#an1">Lime Mint</a></li>
                        <li><a href="#an2">Fresh Mint</a></li>
                        <li><a href="#an3">Strawberry Mint</a></li>
                        <li><a href="#an4">Blueberry Mint</a></li>
                        <li><a href="#an5">Super Cool</a></li>
                        <li><a href="#an6">Assorted Fruit Flavour</a></li>
                        <li><a href="#an7">Melon Mint</a></li>
                    </ul>
                </div>
            </div>
            <div class="prodCat">
                <div class="section">
                    <div class="prodCat-box" style="border: none">
                        <ul class="clearfix" style="display: flex; justify-content: center">
                            <li class="active"><a href="<?php echo APP_URL; ?>product/"><span>Lotte Xylitol Tablet For Kids</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        	<div class="prodSet1">
                <div class="section">
                    <ul class="prodAnchor wow fadeIn" data-wow-delay="0.5s">
                        <li><a href="#an7"><span>Strawberry Flavour</span></a></li>
                        <li><a href="#an8"><span>Grape Flavour</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="prodCat">
                <div class="section">
                    <div class="prodCat-box" style="border: none">
                        <ul class="clearfix" style="display: flex; justify-content: center">
                            <li class="active"><a href="<?php echo APP_URL; ?>product/"><span>Lotte Xylitol Chewing Gum For Kids</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        	<div class="prodSet1">
                <div class="section">
                    <ul class="prodAnchor wow fadeIn" data-wow-delay="0.5s">
                        <li><a href="#an11"><span>Lotte Xylitol for kids Grape Flavour</span></a></li>
                        <li><a href="#an9"><span>Lotte Xylitol Doraemon Strawberry Flavour 3g</span></a></li>
                        <li><a href="#an10"><span>Lotte Xylitol Doraemon Strawberry Flavour 9g</span></a></li>
                        <li><a href="#an12"><span>Lotte Xylitol Pokémon Strawberry Flavour 3g</span></a></li>
                    </ul>
                </div>
            </div>

            <!-- <div class="prodSet2 watermelon"><p class="myAn" id="an0">&nbsp;</p>
                <p class="bg wow fadeInRight">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="2s">
                    <h3 class="bHead">Watermelon Mint</h3>
                    <p class="text">Special flavor, Watermelon-mint developed with Ms.Hoang Yen Chibi. <br class="pc">Sweet & cool taste suitable for summer season.</p>
                    <ul class="prod_list">
                        <li style="padding-top:50px;"><img src="<?php echo APP_ASSETS; ?>img/product/img_watermelon1.png" alt=""><span>Handy Bottle ～Actress Ver<em>55.1g</em></span></li>
                        <li style="padding-top:50px;"><img src="<?php echo APP_ASSETS; ?>img/product/img_watermelon2.png" alt=""><span>Handy Bottle ～Singer Ver<em>55.1g</em></span></li>
                        <li style="padding-top:50px;"><img src="<?php echo APP_ASSETS; ?>img/product/img_watermelon3.png" alt=""><span>Handy Bottle ～Lifestyle Ver<em>55.1g</em></span></li>
                    </ul>
                </div>
                <p class="pic wow zoomIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/product/pic_watermelon.png" alt="" class="pc"><img src="<?php echo APP_ASSETS; ?>img/product/pic_watermelon_sp.png" alt="" class="sp"></p>
            </div> -->

            <div class="prodSet2 lime"><p class="myAn" id="an1">&nbsp;</p>
            	<p class="bg wow fadeInRight" data-wow-delay="0.5s">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="2s">
                	<h3 class="bHead">Lotte Xylitol Chewing Gum Lime Mint Flavour</h3>
                    <p class="text">Lime Mint Flavor with cool and gentle, aftertaste brings a relaxing feeling.</p>
                    <ul class="prod_list">
                    	<li><img src="<?php echo APP_ASSETS; ?>img/product/img_lime1.png" alt=""><span>Blister<em>11.6g</em></span></li>
<!--                        <li><img src="--><?php //echo APP_ASSETS; ?><!--img/product/img_lime2.png" alt=""><span>Mini Bottle<em>26.1g</em></span></li>-->
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_lime3.png" alt=""><span>Handy Bottle<em>55.1g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_lime4.png" alt=""><span>Family Bottle<em>130.5g</em></span></li>
                        <!-- <li><img src="<?php echo APP_ASSETS; ?>img/product/img_lime5.png" alt=""><span>Jar<em>275.5g</em></span></li> -->
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_lime6.png" alt=""><span>Pillow Bag<em>159.5g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_lime7.png" alt=""><span>Pillow Bag<em>319g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_lime8.png" alt=""><span>Mini Bottle<em>26.1g</em></span></li>
                    </ul>
                </div>
                <p class="pic wow zoomIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/product/pic_lime.png" alt="" class="pc"><img src="<?php echo APP_ASSETS; ?>img/product/pic_lime_sp.png" alt="" class="sp"></p>
            </div>

            <div class="prodSet2 fresh"><p class="myAn" id="an2">&nbsp;</p>
            	<p class="bg wow fadeInRight">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="2s">
                	<h3 class="bHead">Lotte Xylitol Chewing Gum Fresh Mint Flavour</h3>
                    <p class="text">Fresh Mint flavor helps you to be always refreshing and ready for the new things.</p>
                    <ul class="prod_list">
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_fresh2.png" alt=""><span>Handy Bottle<em>55.1g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_fresh3.png" alt=""><span>Family Bottle<em>130.5g</em></span></li>
                    </ul>
                </div>
                <p class="pic wow zoomIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/product/pic_fresh.png" alt="" class="pc"><img src="<?php echo APP_ASSETS; ?>img/product/pic_fresh_sp.png" alt="" class="sp"></p>
            </div>

            <div class="prodSet2 strawberry"><p class="myAn" id="an3">&nbsp;</p>
            	<p class="bg wow fadeInRight">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="2s">
                	<h3 class="bHead">Lotte Xylitol Chewing Gum Strawberry Mint Flavour</h3>
                    <p class="text">Sweet Strawberry flavor in combination with cool mint that matches women and kids taste.</p>
                    <ul class="prod_list">
                    	<li><img src="<?php echo APP_ASSETS; ?>img/product/img_strawberry1.png" alt=""><span>Blister<em>11.6g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_strawberry2.png" alt=""><span>Handy Bottle<em>55.1g</em></span></li>
                    </ul>
                </div>
                <p class="pic wow zoomIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/product/pic_strawberry.png" alt="" class="pc"><img src="<?php echo APP_ASSETS; ?>img/product/pic_strawberry_sp.png" alt="" class="sp"></p>
            </div>

            <div class="prodSet2 blueberry"><p class="myAn" id="an4">&nbsp;</p>
            	<p class="bg wow fadeInRight">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="2s">
                	<h3 class="bHead">Lotte Xylitol Chewing Gum Blueberry Mint Flavour</h3>
                    <p class="text">Rich Blueberry flavor in combination with cool mint that matches women and kids taste.</p>
                    <ul class="prod_list">
                    	<li><img src="<?php echo APP_ASSETS; ?>img/product/img_blueberry1.png" alt=""><span>Blister<em>11.6g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_blueberry2.png" alt=""><span>Mini Bottle<em>26.1g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_blueberry3.png" alt=""><span>Handy Bottle<em>55.1g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_blueberry4.png" alt=""><span>Family Bottle<em>130.5g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_blueberry5.png" alt=""><span>Pillow Bag<em>159.5g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_blueberry6.png" alt=""><span>Pillow Bag<em>319g</em></span></li>
                    </ul>
                </div>
                <p class="pic wow zoomIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/product/pic_blueberry.png" alt="" class="pc"><img src="<?php echo APP_ASSETS; ?>img/product/pic_blueberry_sp.png" alt="" class="sp"></p>
            </div>

            <div class="prodSet2 cool"><p class="myAn" id="an5">&nbsp;</p>
            	<p class="bg wow fadeInRight">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="2s">
                	<h3 class="bHead">Lotte Xylitol Chewing Gum Super Cool</h3>
                    <p class="text">Super strong Mint Flavor with tip-top cool for your confident shining.</p>
                    <ul class="prod_list">
                    	<li><img src="<?php echo APP_ASSETS; ?>img/product/img_cool1.png" alt=""><span>Blister<em>11.6g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_cool2.png" alt=""><span>Handy Bottle<em>55.1g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_cool3.png" alt=""><span>Family Bottle<em>130.5g</em></span></li>
                        <!-- <li><img src="<?php echo APP_ASSETS; ?>img/product/img_cool4.png" alt=""><span>Jar<em>275.5g</em></span></li> -->
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_cool5.png" alt=""><span>Pillow Bag<em>159.5g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_cool6.png" alt=""><span>Pillow Bag<em>319g</em></span></li>
                    </ul>
                </div>
                <p class="pic wow zoomIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/product/pic_cool.png" alt="" class="pc"><img src="<?php echo APP_ASSETS; ?>img/product/pic_cool_sp.png" alt="" class="sp"></p>
            </div>

            <div class="prodSet2 assorted"><p class="myAn" id="an6">&nbsp;</p>
            	<p class="bg wow fadeInRight">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="2s">
                	<h3 class="bHead">Lotte Xylitol Chewing Gum Assorted Fruit Flavour</h3>
                    <p class="text">Assorted Fruit Flavour featuring a refreshing combination of peach, melon, blueberry, and cool mint.</p>
                    <ul class="prod_list">
                    	<li><img src="<?php echo APP_ASSETS; ?>img/product/img_assorted.png" alt=""><span>Handy Bottle<em>55.1g</em></span></li>
                    	<li><img src="<?php echo APP_ASSETS; ?>img/product/img_assorted1.png" alt=""><span>Family Bottle<em>130.5g</em></span></li>
                    </ul>
                </div>
                <p class="pic wow zoomIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/product/pic_assorted.png" alt="" class="pc"><img src="<?php echo APP_ASSETS; ?>img/product/pic_assorted_sp.png" alt="" class="sp"></p>
            </div>

            <div class="prodSet2 melon"><p class="myAn" id="an7">&nbsp;</p>
            	<p class="bg wow fadeInRight">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="2s">
                	<h3 class="bHead">Lotte Xylitol Chewing Gum Melon Mint Flavour</h3>
                    <p class="text">Melon flavor combined with a refreshing mint taste</p>
                    <ul class="prod_list">
                    	<li><img src="<?php echo APP_ASSETS; ?>img/product/img_melon.png" width="120" alt=""><span>Handy Bottle<em>55.1g</em></span></li>
                    </ul>
                </div>
                <p class="pic wow zoomIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/product/pic_melon.png" alt="" class="pc"><img src="<?php echo APP_ASSETS; ?>img/product/pic_melon_sp.png" alt="" class="sp"></p>
            </div>

            <div class="prodSet2 tablet_straw"><p class="myAn" id="an7">&nbsp;</p>
            	<p class="bg wow fadeInRight">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="2s">
                	<h3 class="bHead">Lotte Xylitol Tablet for kids Strawberry Flavour</h3>
                    <p class="text">Sweet strawberry tablet and adorable Doraemon coloring card – enjoy the treat and unleash your creativity!</p>
                    <div class="prod_list">
                        <ul>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_tablet_straw.png" width="120" alt=""><span>Box<em>225.6g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_tablet_straw1.png" width="120" alt=""><span>Pouch<em>22.56g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_tablet_straw2.png" width="120" alt=""><span>Pouch<em>22.56g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_tablet_straw3.png" width="120" alt=""><span>Pouch<em>22.56g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_tablet_straw4.png" width="120" alt=""><span>Pouch<em>22.56g</em></span></li>
                        </ul>
                        <img src="<?php echo APP_ASSETS; ?>img/product/note-doraemon.png" alt="" class="note">
                    </div>
                </div>
                <p class="pic wow zoomIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/product/pic_tablet_straw.png" alt="" class="pc"><img src="<?php echo APP_ASSETS; ?>img/product/pic_tablet_straw_sp.png" alt="" class="sp"></p>
            </div>

            <div class="prodSet2 tablet_grape"><p class="myAn" id="an8">&nbsp;</p>
            	<p class="bg wow fadeInRight">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="2s">
                	<h3 class="bHead">Lotte Xylitol Tablet for kids Grape Flavour</h3>
                    <p class="text">Sweet grape tablet and adorable Doraemon coloring card – enjoy the treat and unleash your creativity!</p>
                    <div class="prod_list">
                        <ul>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_tablet_grape.png" width="120" alt=""><span>Box<em>225.6g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_tablet_grape1.png" width="120" alt=""><span>Pouch<em>22.56g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_tablet_grape2.png" width="120" alt=""><span>Pouch<em>22.56g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_tablet_grape3.png" width="120" alt=""><span>Pouch<em>22.56g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_tablet_grape4.png" width="120" alt=""><span>Pouch<em>22.56g</em></span></li>
                        </ul>
                        <img src="<?php echo APP_ASSETS; ?>img/product/note-doraemon.png" alt="" class="note">
                    </div>
                </div>
                <p class="pic wow zoomIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/product/pic_tablet_grape.png" alt="" class="pc"><img src="<?php echo APP_ASSETS; ?>img/product/pic_tablet_grape_sp.png" alt="" class="sp"></p>
            </div>

            <div class="prodSet2 doraemon_grape"><p class="myAn" id="an11">&nbsp;</p>
            	<p class="bg wow fadeInRight">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="2s">
                	<h3 class="bHead">Lotte Xylitol Chewing Gum For Kids – Grape Flavor</h3>
                    <p class="text">Sweet grape-flavored gum without mint’s cooling taste– easy to enjoy and loved by kids.</p>
                    <div class="prod_list">
                        <ul>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_doraemon_grape.png" width="120" alt=""><span>Box<em>52.2g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_doraemon_grape1.png" width="120" alt=""><span>Blister<em>8.7g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_doraemon_grape2.png" width="120" alt=""><span>Blister<em>8.7g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_doraemon_grape3.png" width="120" alt=""><span>Blister<em>8.7g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_doraemon_grape4.png" width="120" alt=""><span>Blister<em>8.7g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_doraemon_grape5.png" width="120" alt=""><span>Blister<em>8.7g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_doraemon_grape6.png" width="120" alt=""><span>Blister<em>8.7g</em></span></li>
                        </ul>
                        <img src="<?php echo APP_ASSETS; ?>img/product/note-doraemon.png" alt="" class="note">
                    </div>
                </div>
                <p class="pic wow zoomIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/product/pic_doraemon_grape.png" alt="" class="pc"><img src="<?php echo APP_ASSETS; ?>img/product/pic_doraemon_grape_sp.png" alt="" class="sp"></p>
            </div>

            <div class="prodSet2 doraemon_straw"><p class="myAn" id="an9">&nbsp;</p>
            	<p class="bg wow fadeInRight">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="2s">
                	<h3 class="bHead">Lotte Xylitol Doraemon Chewing Gum for Kids – Strawberry Flavor 3g</h3>
                    <p class="text">Sweet strawberry flavor without mint’s cooling taste, with adorable Doraemon figures.</p>
                    <div class="prod_list">
                        <ul>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_doraemon_straw_ball.png" width="120" alt=""><span>Ball<em>3g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_doraemon_straw_ball1.png" width="120" alt=""><span>Ball<em>3g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_doraemon_straw_ball2.png" width="120" alt=""><span>Ball<em>3g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_doraemon_straw_ball3.png" width="120" alt=""><span>Ball<em>3g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_doraemon_straw_ball4.png" width="120" alt=""><span>Ball<em>3g</em></span></li>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_doraemon_straw_ball5.png" width="120" alt=""><span>Ball<em>3g</em></span></li>
                        </ul>
                        <img src="<?php echo APP_ASSETS; ?>img/product/note-doraemon.png" alt="" class="note">
                    </div>
                </div>
                <p class="pic wow zoomIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/product/pic_doraemon_straw.png" alt="" class="pc"><img src="<?php echo APP_ASSETS; ?>img/product/pic_doraemon_straw_sp.png" alt="" class="sp"></p>
            </div>

            <div class="prodSet2 doraemon_straw2"><p class="myAn" id="an10">&nbsp;</p>
            	<p class="bg wow fadeInRight">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="2s">
                	<h3 class="bHead">Lotte Xylitol Doraemon Chewing Gum for Kids – Strawberry Flavor 9g</h3>
                    <p class="text">Sweet strawberry flavor without mint’s cooling taste, with cute Doraemon character tattoos.</p>
                    <div class="prod_list">
                        <ul>
                            <li><img src="<?php echo APP_ASSETS; ?>img/product/img_doraemon_straw.png" width="150" alt=""><span>Box<em>9g</em></span></li>
                        </ul>
                        <img src="<?php echo APP_ASSETS; ?>img/product/note-doraemon.png" alt="" class="note">
                    </div>
                </div>
                <p class="pic wow zoomIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/product/pic_doraemon_straw2.png" alt="" class="pc"><img src="<?php echo APP_ASSETS; ?>img/product/pic_doraemon_straw2_sp.png" alt="" class="sp"></p>
            </div>

            <div class="prodSet2 pokemon_straw"><p class="myAn" id="an12">&nbsp;</p>
            	<p class="bg wow fadeInRight">&nbsp;</p>
                <div class="section wow fadeIn" data-wow-delay="2s">
                	<h3 class="bHead">Lotte Xylitol Pokémon<br class="sp"> Chewing Gum<br>for Kids <br>Strawberry Flavor 3g</h3>
                    <p class="text">Sweet strawberry flavor without mint’s cooling taste, with collectible Pokémon stamps.</p>
                    <ul class="prod_list">
                    	<li><img src="<?php echo APP_ASSETS; ?>img/product/img_pokemon_straw1.png" width="120" alt=""><span>Box<em>3g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_pokemon_straw2.png" width="120" alt=""><span>Box<em>3g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_pokemon_straw3.png" width="120" alt=""><span>Box<em>3g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_pokemon_straw4.png" width="120" alt=""><span>Box<em>3g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_pokemon_straw5.png" width="120" alt=""><span>Box<em>3g</em></span></li>
                        <li><img src="<?php echo APP_ASSETS; ?>img/product/img_pokemon_straw6.png" width="120" alt=""><span>Box<em>3g</em></span></li>
                    </ul>
                    <img src="<?php echo APP_ASSETS; ?>img/product/note-pokemon.png" alt="" class="note">
                </div>
                <p class="pic wow zoomIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/product/pic_pokemon_straw.png" alt="" class="pc"><img src="<?php echo APP_ASSETS; ?>img/product/pic_pokemon_straw_sp.png" alt="" class="sp"></p>
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
