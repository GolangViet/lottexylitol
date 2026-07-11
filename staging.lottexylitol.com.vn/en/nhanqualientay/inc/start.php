<?php
defined('APP_PATH') or die();
?>
<div class="section-contest section-must-buy start<?php echo $is_terms ? '' : ' active'?>" id="start">
    <div class="text__shadow txt-upper">
        OPEN THE CAP, FIND THE CODE,<br />
        WIN THE PRIZE NOW!
    </div>
    <div class="image">
        <?php /*/ ?> <img src="<?php echo APP_ASSETS; ?>img/must-buy/img-start-en.png" alt="" /> <?php /*/ ?>
        <div class="lottie-icon" data-src="/assets/json/must-buy-home/homepage.json"></div>
    </div>
    <div class="start__button">
        <a class="btn-dark-green-2 shadow"<?php echo $is_coming ? '' : ' href="/en/about-must-buy/"' ?>>
            <span>PROGRAM RULES</span>
        </a>
        <br>
        <?php if ($step == 'lock') : ?>
            <a class="btn-dark-green-2 btn-dark-green-2--red shadow js-btn-lock">
                <span>JOIN NOW</span>
            </a>
        <?php else: ?>
            <a class="btn-dark-green-2 btn-dark-green-2--red shadow js-btn-start">
                <span>JOIN NOW</span>
            </a>
        <?php endif ?>
    </div>
</div>
