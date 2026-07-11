<?php
// Author: A+LIVE
include_once('../../app_config.php');
include(APP_PATH.'libs/head.php');
?>
<link type="text/css" rel="stylesheet" href="<?php echo APP_ASSETS; ?>js/wow/animate.min.css">
<link type="text/css" rel="stylesheet" href="<?php echo APP_ASSETS; ?>js/slick/slick.css">
</head>

<body id="what" class="what about">
    <!-- Header
    ================================================== -->
    <?php include(APP_PATH.'libs/header.php'); ?>

    <div id="wrap">
        <!-- Main Content
        ================================================== -->
        <main class="main bgmain">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/en/">Top</a></li>
                    <li>What’s XYLITOL</li>
                </ul>
            </div>
        	<h1 class="bHead wow fadeIn">What’s xylitol</h1>
        	<div class="whatSet1">
                <div class="section wow fadeIn">
                    <h2 class="subHead">What is Xylitol made from? Is it safe for the human body?</h2>
                    <p class="text">We will introduce basic knowledge about xylitol, from such basic questions to its power to prevent tooth decay.</p>
                    <p class="leaf1"><img src="<?php echo APP_ASSETS; ?>img/what/img_leaf1.png" alt="leaf"></p>
                </div>
                
                <div class="whatgum">
                	<p class="bgdot">&nbsp;</p>
                	<p class="bg wow fadeInRight">&nbsp;</p>
                    <div class="section">
                    	<div class="desc desc-head wow fadeIn" data-wow-delay="1.5s">
                            <h3 class="bHead wow fadeIn">Did you know?<br>Basic information<br>
                            about "xylitol"</h3>
                        </div>
                        <ul class="wow fadeIn" data-wow-delay="1s">
                            <li class="item1"><img src="<?php echo APP_ASSETS; ?>img/what/img_what1.jpg" alt="Xylitol"></li>
                        </ul>
                    </div>
                    <p class="leaf2 wow fadeIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/what/img_leaf2.png" alt="leaf"></p>
                </div>
                
                <div>
                	<p class="bgdot">&nbsp;</p>
                	<p class="bg wow fadeInRight">&nbsp;</p>
                    <div class="section section-text">
                    	<div class="wow fadeIn" data-wow-delay="1.5s">
                    	    <h3 class="bHead wow fadeIn">The sweetener XYLITOL is a natural ingredient.</h3>
                    	    <p class="wow fadeIn u-pb-40 u-sp-pb-20">Xylitol is a natural sweetener found in many fruits and vegetables. For example, strawberries contain about 300 mg of Xylitol per 100 grams of dry weight. In the human body, the liver also produces about 15 grams of Xylitol per day.</p>
                    	    <h3 class="bHead wow fadeIn">Two ways xylitol prevents tooth decay.</h3>
                    	    <p class="wow fadeIn u-pb-40 u-sp-pb-20">Xylitol, which we ingest in gum or tablets, is made from Xylan hemicellulose, which is extracted from trees such as white birch.<br>In Japan, it was approved as a food additive in April 1997. However, Xylitol had been known to be safe for the human body for over 10 years prior to this, having been used as an ingredient in intravenous fluids. In the United States, due to its safety, it is treated as a food that "it is okay to consume any amount of it per day."</p>
                            <h3 class="bHead wow fadeIn">XYLITOL and tooth decay prevention have been studied in countries around the world.</h3>
                    	    <p class="wow fadeIn u-pb-40 u-sp-pb-20">The first study revealing that Xylitol prevents tooth decay was published in 1975. Since then, active research has been conducted in Japan and around the world. The now common use of Xylitol gum to prevent tooth decay is one result of this research. In addition, various research into caries prevention continues, such as using Xylitol as a sugar substitute, or incorporating it into tablets, candy, and toothpaste. No other sweetener has been recognized as having caries-preventing effects in so many long-term studies as Xylitol.</p>
                            <h3 class="bHead wow fadeIn">Two ways XYLITOL prevents tooth decay.</h3>
                    	    <p class="wow fadeIn u-pb-40 u-sp-pb-20">There are two main reasons why Xylitol prevents cavities.<br>The first is that <span class="c-green c-fw-600">it does not cause cavities</span>. Xylitol does not produce any acid in the mouth. It also has the ability to neutralize acid. It also helps to make saliva more easily, keeping the mouth less susceptible to cavities. The other is that it prevents the onset <span class="c-green c-fw-600">and progression of cavities</span>. It makes it harder for plaque, which causes cavities, to build up and promotes remineralization of teeth.<br>Furthermore, xylitol has <span class="c-green c-fw-600">the ability to weaken the activity of bacteria (Streptococcus mutans), which are considered to be a major cause of cavities.</span> This effect on cavity-causing bacteria is unique to xylitol and not seen in other sweeteners.</p>
                    	    <h3 class="bHead wow fadeIn">XYLITOL enhances your daily cavity prevention efforts.</h3>
                    	    <p class="wow fadeIn">Having Xylitol alone will not prevent cavities. To protect your teeth from cavities, it is important to brush your teeth correctly and use a toothpaste that contains fluoride.<br>Xylitol is highly effective when added to your regular cavity prevention routine, as it makes <span class="c-green c-fw-600">plaque easier to remove,</span> improves the effectiveness of brushing, and works with fluoride to make teeth harder. It can be added to your daily habits and provides solid support for cavity prevention. That is Xylitol.</p>
                    	</div>
                    </div>
                </div>
            </div>
            
        </main>
    </div><!-- #wrap -->

    <!-- Footer
    ================================================== -->
    <?php include(APP_PATH.'libs/footer.php'); ?>
<!-- End Document
================================================== -->
<script src="<?php echo APP_ASSETS; ?>js/wow/wow.js"></script>
<script src="<?php echo APP_ASSETS; ?>js/slick/slick.js"></script>
<script>
$('.threeCols').slick({
	autoplay: false,
	autoplaySpeed: 3000,
	speed: 800,
	arrows: true,
	dots: false,
	fade: false,
	pauseOnHover: false,
	pauseOnFocus: false,
	pauseOnDotsHover: false,
	centerMode: true,
	centerPadding: '0px',
	slidesToShow: 3,
	variableWidth: false,
	responsive: [
		{
		  breakpoint: 767,
		  settings: {
			slidesToShow: 1,
			variableWidth: false,
		  }
		}
	]
});
</script>
</body>
</html>