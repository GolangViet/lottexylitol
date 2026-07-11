<?php
// Author: A+LIVE
include_once('../../app_config.php');
include(APP_PATH . 'libs/head.php');
?>
<script src="<?php echo APP_ASSETS ?>js/lib/jquery-ui.js"></script>
<script src="<?php echo APP_ASSETS ?>js/lib/jquery.ui.touch-punch.min.js"></script>
<script>
    var i = 1;
    function zoomin ()
    {
        i++;
        var myImg = document.getElementById( "mapClick" );
        myImg.style.transform = "scale(" + i + ")";
        if ( i > 1 ) $( "#mapClick" ).draggable();
    }
    function zoomout ()
    {
        if ( i > 1 ) {
            i--;
            var myImg = document.getElementById( "mapClick" );
            myImg.style.transform = "scale(" + i + ")";
        }
    }
</script>
</head>

<body id="why" class='why subpage'>
    <!-- Header
    ================================================== -->
    <?php include(APP_PATH . 'libs/header.php'); ?>


    <div id="wrap">
        <!-- Main Content
        ================================================== -->
        <main class="bgmain">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/en/">Top</a></li>
                    <li>Why XYLITOL?</li>
                </ul>
            </div>
            <section class="whyBlock">
                <!-- start lead -->
                <div class="lead">
                    <img src="<?php echo APP_ASSETS; ?>img/why/ico_mint1.png" alt="" class="iconMint wow fadeInLeft" data-wow-delay="0.5s">
                    <img src="<?php echo APP_ASSETS; ?>img/why/ico_mint2.png" alt="" class="iconMint2 wow fadeInRight" data-wow-delay="0.7s">
                    <h1 class="bHead wow fadeIn" data-wow-delay="0s">Why XYLITOL?</h1>
                    <h2 class="wow fadeIn" data-wow-delay="0.2s">Xylitol is supported by <br class="sp">SCIENTIFIC CERTIFICATION.</h2>
                    <p class="wow fadeIn" data-wow-delay="0.4s">The government has encouraged the consumption of Xylitol since 1970’s .<br>
                        Started to teach the mechanism of Xylitol at kindergartens and schools .<br>
                        Began to provide Xylitol to kindergartens, schools, dental offices…<br>
                        DMFT of each age group has decreased year by year .</p>
                </div>
                <!-- end lead -->
                <!-- start chart -->
                <section class="chart wow fadeIn">
                    <span class="bgDotted wow fadeInRight"></span>
                    <!-- <span class="bgChart wow fadeInLeft" data-wow-delay="0.3s"></span> -->
                    <div class="chartImg">
                        <div class="chartInfo">
                            <div>
                                <p><img src="<?php echo APP_ASSETS; ?>img/why/img_chart.svg"
                                        alt="Nordblad A ym . Suun terveydenhuoltoa terveyskeskuksissa 1970-luvulta vuoteen 2000 . Stakes, Raportteja 278 , Helsinki 2004." class="pc">
                                    <img src="<?php echo APP_ASSETS; ?>img/why/img_chart_sp.svg"
                                        alt="Nordblad A ym . Suun terveydenhuoltoa terveyskeskuksissa 1970-luvulta vuoteen 2000 . Stakes, Raportteja 278 , Helsinki 2004." class="sp">
                                </p>
                                <p>
                                    <span class="pin orange pin1"><i>12.3 at 1975</i></span>
                                    <span class="pin orange pin2"><i>8.0 at 1982</i></span>
                                    <span class="pin orange pin3"><i>6.3 at 1985</i></span>
                                    <span class="pin orange pin4"><i>4.7 at 1988</i></span>
                                    <span class="pin orange pin5"><i>3.0 at 1991</i></span>
                                    <span class="pin orange pin6"><i>2.8 at 1994</i></span>
                                    <span class="pin orange pin7"><i>2.6 at 1997</i></span>
                                    <span class="pin orange pin8"><i>2.5 at 2000</i></span>

                                    <span class="pin green1 pin1"><i>11.5 at 1975</i></span>
                                    <span class="pin green1 pin2"><i>10.0 at 1982</i></span>
                                    <span class="pin green1 pin3"><i>8.5 at 1985</i></span>
                                    <span class="pin green1 pin4"><i>5.4 at 1988</i></span>
                                    <span class="pin green1 pin5"><i>4.7 at 1991</i></span>
                                    <span class="pin green1 pin6"><i>3.9 at 1994</i></span>
                                    <span class="pin green1 pin7"><i>3.7 at 1997</i></span>
                                    <span class="pin green1 pin8"><i>3.7 at 2000</i></span>

                                    <span class="pin green2 pin1"><i>7.0 at 1975</i></span>
                                    <span class="pin green2 pin2"><i>4.0 at 1982</i></span>
                                    <span class="pin green2 pin3"><i>3.0 at 1985</i></span>
                                    <span class="pin green2 pin4"><i>2.0 at 1988</i></span>
                                    <span class="pin green2 pin5"><i>1.0 at 1991</i></span>
                                    <span class="pin green2 pin6"><i>1.2 at 1994</i></span>
                                    <span class="pin green2 pin7"><i>1.3 at 1997</i></span>
                                    <span class="pin green2 pin8"><i>1.5 at 2000</i></span>

                                    <span class="pin pink pin1"><i>5.0 at 1975</i></span>
                                    <span class="pin pink pin2"><i>2.7 at 1982</i></span>
                                    <span class="pin pink pin3"><i>2.1 at 1985</i></span>
                                    <span class="pin pink pin4"><i>1.8 at 1988</i></span>
                                    <span class="pin pink pin5"><i>1.4 at 1991</i></span>
                                    <span class="pin pink pin6"><i>1.0 at 1994</i></span>
                                    <span class="pin pink pin7"><i>0.9 at 1997</i></span>
                                    <span class="pin pink pin8"><i>1.0 at 2000</i></span>

                                    <span class="pin yellow pin1"><i>3.6 at 1975</i></span>
                                    <span class="pin yellow pin2"><i>1.9 at 1982</i></span>
                                    <span class="pin yellow pin3"><i>1.2 at 1985</i></span>
                                    <span class="pin yellow pin4"><i>0.8 at 1988</i></span>
                                    <span class="pin yellow pin5"><i>0.7 at 1991</i></span>
                                    <span class="pin yellow pin6"><i>0.6 at 1994</i></span>
                                    <span class="pin yellow pin7"><i>0.5 at 1997</i></span>
                                    <span class="pin yellow pin8"><i>0.4 at 2000</i></span>

                                    <span class="pin blue pin1"><i>2.0 at 1975</i></span>
                                    <span class="pin blue pin2"><i>0.8 at 1982</i></span>
                                    <span class="pin blue pin3"><i>0.7 at 1985</i></span>
                                    <span class="pin blue pin4"><i>0.5 at 1988</i></span>
                                    <span class="pin blue pin5"><i>0.4 at 1991</i></span>
                                    <span class="pin blue pin6"><i>0.3 at 1994</i></span>
                                    <!-- <span class="pin blue pin7"><i>8.0 at 1997</i></span>
                                <span class="pin blue pin8"><i>8.0 at 2000</i></span> -->

                                    <span class="pin green3 pin1"><i>1.4 at 1975</i></span>
                                    <span class="pin green3 pin2"><i>0.2 at 1982</i></span>
                                    <span class="pin green3 pin3"><i>0.2 at 1985</i></span>
                                    <span class="pin green3 pin4"><i>0.2 at 1988</i></span>
                                    <span class="pin green3 pin5"><i>0.2 at 1991</i></span>
                                    <span class="pin green3 pin6"><i>0.2 at 1994</i></span>
                                    <span class="pin green3 pin7"><i>0.2 at 1997</i></span>
                                    <span class="pin green3 pin8"><i>0.2 at 2000</i></span>
                                </p>
                            </div>
                        </div>
                        <p class="sp"><img src="<?php echo APP_ASSETS; ?>img/why/txt_chart_sp.svg" alt="" class="wow fadeInLeft" data-wow-delay="1s"></p>
                        <p class="txt wow fadeIn" data-wow-delay="1s">Nordblad A ym . Suun terveydenhuoltoa terveyskeskuksissa 1970-luvulta vuoteen 2000 . <br>
                            Stakes, Raportteja 278 , Helsinki 2004.</p>
                    </div>
                </section>
                <!-- end chart -->
                 
                <!-- start problem -->
                <section class="problem">
                    <span class="bg bg-2 wow fadeInRight" data-wow-delay="1s"></span>
                    <div class="chart wow fadeIn">
                        <h2 class="chart-tlt wow fadeIn" data-wow-delay="0.2s">XYLITOL<br>does not produce acid</h2>
                        <div class="chartImg">
                            <div class="chartInfo">
                                <div>
                                    <p><img src="<?php echo APP_ASSETS; ?>img/why/img_chart.jpg"
                                            alt="Nordblad A ym . Suun terveydenhuoltoa terveyskeskuksissa 1970-luvulta vuoteen 2000 . Stakes, Raportteja 278 , Helsinki 2004."></p>
                                </div>
                            </div>
                            <p class="img-sub wow fadeIn" data-wow-delay="1s">Among of all the sugar alcohols, xylitol has the lowest acid production</p>
                        </div>
                    </div>
                    <div class="inner box-acid">
                        <ul class="promotionList">
                            <li class="clearfix wow fadeIn reverse" data-wow-delay="0.5s">
                                <div class="thumb">
                                    <img src="<?php echo APP_ASSETS; ?>img/why/img_photo1.jpg" alt="Heart Disease/Stroke Risk">
                                    <div class="img-sub">Normal fungal surface</div>
                                </div>
                                <div class="desc">
                                    <p class="tlt">Xylitol does not produce acid</p>
                                    <p class="txt">Normally, plaque on the surface of teeth is made up of about 10-15% good bacteria (mutans streptococci that are not sensitive to Xylitol) and about
                                        85-90% bad bacteria (mutans
                                        streptococci that are sensitive to Xylitol).<br>
                                        When there is food debris or sugar in the mouth, the bad bacteria ingest it and produce acid. This acid is what causes tooth decay. These bad bacteria store
                                        energy and multiply, releasing a sticky substance that sticks firmly to the surface of the teeth.<br>
                                        This makes them difficult to remove even with a toothbrush. Good bacteria do not release sticky substances.<br>
                                        This makes them easy to remove with a toothbrush and less likely to cause tooth decay.<br>
                                    </p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn padding" data-wow-delay="0.5s">
                                <div class="thumb">
                                    <img src="<?php echo APP_ASSETS; ?>img/why/img_photo2.jpg" alt="Increase the Risk of Dementia">
                                    <div class="img-sub">Bacteria surface that ingested XYLITOL</div>
                                </div>
                                <div class="desc">
                                    <p class="txt">
                                        When Xylitol is present, bad bacteria try to ingest it and produce acid in the same way as they would with other sugars, but are unable to do so.<br>
                                        In the end, they end up excreting the Xylitol they ingested.<br>
                                        However, the bad bacteria then take in the Xylitol once it has been excreted. In this case, Xylitol does not provide energy for the bad bacteria.<br>
                                        Instead, they consume energy and their numbers decrease. Good bacteria do not ingest Xylitol. Therefore, they do not consume energy and their numbers gradually
                                        increase.<br>
                                    </p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn reverse" data-wow-delay="0.5s">
                                <div class="thumb">
                                    <img src="<?php echo APP_ASSETS; ?>img/why/img_photo3.jpg" alt="Respiratory Disease">
                                    <div class="img-sub">Bacteria surface of those who<br>regularly ingested XYLITOL</div>
                                </div>
                                <div class="desc">
                                    <p class="txt">If you continue to eat Xylitol three times a day after meals, most of the bacteria will become good bacteria.<br>It has been reported that if you
                                        continue to eat Xylitol (for more than two weeks), about 75-83% of the bacteria will become good bacteria. The increased good bacteria are less likely to cause
                                        cavities and can be easily removed with a toothbrush. This also reduces the amount of plaque on the surface of the teeth.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="inner dentalHealth">
                        <div class="txtLead">
                            <span class="leaf7 leaf wow fadeInUp" data-wow-delay="0.7s"><img src="<?php echo APP_ASSETS; ?>img/why/bg_leaf7.png" alt="leaf"></span>
                            <h2 class="wow fadeIn" data-wow-delay="0.5s">If you don't take care of dental health,<br>what does your health go ?</h2>
                            <p class="txt wow fadeIn" data-wow-delay="1s">Taking care of dental health is not just important for your teeth, gums, and breath but also affects <br>
                                other medical problems inside your body. Having poor oral hygiene can lead to a variety of dental<br>
                                problems and other diseases that you may not be aware of.</p>
                        </div>
                        <ul class="promotionList">
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <div class="thumb">
                                    <img src="<?php echo APP_ASSETS; ?>img/why/img_photo5.jpg" alt="Heart Disease/Stroke Risk">
                                </div>
                                <div class="desc">
                                    <h3 class="wow fadeIn">Heart Disease / Stroke Risk</h3>
                                    <p class="txt">Heart Disease/Stroke RiskPeople with periodontal disease have more likely twofold greater risk to suffer from heart disease and arterial narrowing
                                        caused by bacteria and plaque entering the bloodstream through the gums.<br>
                                        These bacteria contain a clot-promoting protein that can clog arteries and increase the risk of heart attack...
                                    </p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <div class="thumb">
                                    <img src="<?php echo APP_ASSETS; ?>img/why/img_photo6.jpg" alt="Increase the Risk of Dementia">
                                </div>
                                <div class="desc">
                                    <h3 class="wow fadeIn">Increase the Risk of Dementia</h3>
                                    <p class="txt">Increase the Risk of DementiaTooth loss due to poor dental health is considered to increase the risk factor for memory loss and early stage of
                                        Alzheimer’s disease. One study called ‘Behavioral and Brain Functions’ found that gum infections will release substances that may cause brain inflammation and
                                        destroy the brain cells.
                                    </p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <div class="thumb">
                                    <img src="<?php echo APP_ASSETS; ?>img/why/img_photo7.jpg" alt="Respiratory Disease">
                                </div>
                                <div class="desc">
                                    <h3 class="wow fadeIn">Respiratory Disease</h3>
                                    <p class="txt">Respiratory DiseaseA study published in Periodontology Journal uncovered that bacteria from periodontal disease are able to travel through the
                                        bloodstream then attack lungs and acute. Especially for people who already have lungs and acute problems, the risk of suffering from respiratory disease is
                                        considered to be higher.
                                    </p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <div class="thumb">
                                    <img src="<?php echo APP_ASSETS; ?>img/why/img_photo4.jpg" alt="Respiratory Disease">
                                </div>
                                <div class="desc">
                                    <h3 class="wow fadeIn">Genital Disease</h3>
                                    <p class="txt">Genital DiseaseMen with periodontal disease are 7 times as likely to develop erectile dysfunction as men with good dental hygiene. Pregnant women who
                                        suffer from gums infections may lead to blood infection and increase the risk of premature birth. A research presented at the European Society of Human
                                        Reproduction and Embryology also found that women having gum disease took an average of seven months to conceive..
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>
                <!-- end problem -->


                <!-- start tips -->
                <section class="tips">
                    <span class="bg wow fadeInLeft" data-wow-delay="0.5s"></span>
                    <div class="inner">
                        <div class="txtLead">
                            <span class="leaf1 leaf wow fadeInUp" data-wow-delay="0.5s"><img src="<?php echo APP_ASSETS; ?>img/why/bg_leaf4.png" alt="leaf"></span>
                            <span class="leaf2 leaf wow fadeInUp" data-wow-delay="0.7s"><img src="<?php echo APP_ASSETS; ?>img/why/bg_leaf6.png" alt="leaf"></span>
                            <span class="leaf3 leaf wow fadeInUp" data-wow-delay="0.9s"><img src="<?php echo APP_ASSETS; ?>img/why/bg_leaf5.png" alt="leaf"></span>
                            <h2 class="wow fadeInUp" data-wow-delay="1s">Tips of dental health care</h2>
                            <p class="txt wow fadeInUp" data-wow-delay="1.3s">When you have a good oral health, you are confident in your daily <br>communication also you are confident to shine.</p>
                        </div>

                        <ul class="promotionList">
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_pic1.jpg" alt="01. Proper Brushing"></p>
                                <div class="desc">
                                    <h3><span class="clearfix">01.</span><em>Proper Brushing</em></h3>
                                    <p class="txt">Proper BrushingWhen brushing your teeth, you need to position the bristles at an angle of 45 degrees with the gum line and tooth surface. The
                                        brushing motion must be gently up-and-down in order to avoid blood oozing from the gums. Lastly, don’t forget to brush the surfaces of your tongue and the roof
                                        of your mouth to remove bacteria, which might cause bad breath. Brushing at least twice a day can help preventing acid buildup from the breakdown of food by
                                        bacteria. If you do not have time for brushing due to the working schedule, the easiest way is to rinse your mouth with water right after eating to eliminate
                                        the amount of food stuck on the tooth surface and spit.</p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_pic2.jpg" alt="02. Do Flossing"></p>
                                <div class="desc">
                                    <h3><span class="clearfix">02.</span><em>Do Flossing</em></h3>
                                    <p class="txt">Do FlossingBrushing and rinsing your mouth with water can help removing all the remaining food stuck in hard-to-brush position like back teeth and
                                        spit. Flossing is considered to be the best way to clean up your teeth completely; however it’s been deemed as time and money wasting from Vietnamese people for
                                        long time. If you aware of its benefits, let’s start flossing at least once a day right after brushing your teeth to achieve the best outcome.</p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_pic3.jpg" alt="03. Avoid Tobacco"></p>
                                <div class="desc">
                                    <h3><span class="clearfix">03.</span><em>Avoid Tobacco</em></h3>
                                    <p class="txt">Avoid TobaccoStaying away from tobacco will save you from oral cancer and periodontal complications. Besides, your teeth might not suffer from side
                                        effects caused by tobacco smell eliminators such as candy, tea or coffee, which are considered to be the main reason behind yellow teeth, stained teeth and high
                                        risk of cavities.</p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_pic4.jpg" alt="04. Limit Alcohol, Sodas and Coffee"></p>
                                <div class="desc">
                                    <h3><span class="clearfix">04.</span><em>Limit Alcohol, Sodas and Coffee</em></h3>
                                    <p class="txt">Limit Alcohol, Sodas and CoffeeAlthough these beverages contain a high level of phosphorous, a necessary mineral for healthy teeth, but too much
                                        phosphorous can deplete calcium level of the body. This causes dental hygiene problems such as tooth decay and gum disease. Besides, the saccharose and food dye
                                        in these kinds of beverage might make pearly white teeth appear dull and discoloured in a very short time of continuous using.</p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_pic5.jpg" alt="05. Fortify Calcium, Vitamins and Minerals That Are Good For Teeth"></p>
                                <div class="desc">
                                    <h3><span class="clearfix">05.</span><em>Fortify Calcium, Vitamins and Minerals That Are Good <br class="pc">For Teeth</em></h3>
                                    <p class="txt">Fortify Calcium, Vitamins and Minerals That Are Good For TeethCalcium is essential for teeth as well as your bones. You can drink milk, eat dairy
                                        products such as yogurt, cheese or take calcium supplements according to your age and body’s actual demand. Calcium, Vitamin D, Copper, Zinc, Iodine, Iron and
                                        Potassium are necessary to maintain the health of gums and teeth, while Vitamin B is also essential for the protection of gums and teeth from cracking and
                                        bleeding.</p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_pic6.jpg" alt="06. Drink Enough Water"></p>
                                <div class="desc">
                                    <h3><span class="clearfix">06.</span><em>Drink Enough Water</em></h3>
                                    <p class="txt">Drink Enough WaterKeeping your mouth moist is really important, because a dry mouth is the perfect atmosphere for plaque development, which is
                                        considered the main cause of cavities and gum diseases. Mouth dryness is caused by smoking, alcohol, caffeine and especially some over-the-counter drugs.
                                        Drinking plenty of water might help moisturizing your mouth, promoting the healthful action of saliva which supports for good digestion, fighting with germs and
                                        preventing cavities.</p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_product1.png" alt="07. Use Xylitol Products" style="margin-left: auto;margin-right: auto; width: 50%;">
                                </p>
                                <div class="desc">
                                    <h3><span class="clearfix">07.</span><em>Use Xylitol Products</em></h3>
                                    <p class="txt">Use Xylitol ProductsXylitol helps reducing the plaque development on the tooth surface, the main cause of cavities. The benefit of preventing tooth
                                        decay product containing Xylitol such as gum and toothpaste has been proved to decrease the number of people who have cavities after a long time usage in many
                                        countries all over the world.</p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_pic8.jpg" alt="08. Visit Your Dentist"></p>
                                <div class="desc">
                                    <h3><span class="clearfix">08.</span><em>Visit Your Dentist</em></h3>
                                    <p class="txt">Visit Your DentistYou should visit your dentist at least twice a year to have a full oral health checkup. The professional testing and x-rays exam
                                        might help you to find the risk of tooth decay at early stage to prevent from the very first step of its development.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>
                <!-- end tips -->

                <section class="voice">
                    <span class="bg wow fadeIn" data-wow-delay="0.7s"></span>
                    <div class="inner clearfix">
                        <div class="desc wow fadeIn" data-wow-delay="1s">
                            <p>When you have a good oral health, <br class="sp">you are confident in<br class="pc"> your daily communication also you are confident to shine.</p>
                            <p>So, always keep your teeth healthy near you, <br>with LOTTE XYLITOL DENTAL GUM.</p>
                        </div>
                        <p class="img wow fadeIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/why/product_lime_mint_mv.png"
                                alt="When you have a good oral health, you are confident in your daily communication also you are confident to shine."></p>
                    </div>
                </section>


            </section>
        </main>

    </div><!-- #wrap -->

    <!-- Footer
    ================================================== -->
    <?php include(APP_PATH . 'libs/footer.php'); ?>

    <script>
        $( window ).bind( "load resize", function ()
        {
            if ( $( window ).innerWidth() > 1280 ) {
                var w = Math.max( document.documentElement.clientWidth, window.innerWidth || 0 );
                var wVoice = ( w - 1280 ) / 6;
                $( '.voice' ).css( 'margin-bottom', -( 200 + wVoice ) );
            }

            if ( $( window ).innerWidth() > 1500 ) {
                var problemDotted = -( 130 + ( ( w - 1500 ) / 6 ) );
                $( '.problem .bgDotted' ).css( 'top', problemDotted );
            }
        } );
        $( window ).bind( "load", function ()
        {
            if ( $( window ).innerWidth() < 1280 ) {
                setTimeout( function ()
                {
                    $( '.chart' ).css( 'visibility', 'visible' );
                }, 1000 );
            }
            if ( $( window ).innerWidth() > 1280 ) {
                setTimeout( function ()
                {
                    $( '.chart' ).css( 'visibility', 'visible' );
                }, 2000 );
            }
        } );
    </script>

    <!-- End Document
================================================== -->
</body>

</html>
