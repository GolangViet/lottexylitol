<?php
defined('APP_PATH') or die();
?>
<section id="box-start" class="box-thanks box-wellcom box-must-buy">
    <div class="content content-josefin-sans">
        <form class="form-term js-term-form" data-toggle="validator" data-step="<?php echo $step ?>" role="form" autocomplete="off" data-modal="<?php echo $next_step ?>">
            <div class="description u-pb-30 u-sp-pb-20">
                <strong class="txt-green-2">STEP 1:</strong><br class="ipSE-hide">
                Enter the lucky code found on the winning card inside the product.<br><br>
                <strong class="txt-green-2">STEP 2:</strong><br class="ipSE-hide">
                Join the fill-in-the-blank game by carefully reading the questions and selecting the most accurate answers from the options. The correct final answer will be displayed after the game. Then, click the "Got it" button.<br><br>
                <strong class="txt-green-2">STEP 3:</strong><br class="ipSE-hide">
                Click "Play Now" to receive a random lucky prize.<br><br>
                <strong class="txt-green-2">STEP 4:</strong><br class="ipSE-hide">
                Check your reward information in your profile page to claim your prize.
            </div>
            <div class="u-pb-30 u-sp-pb-20 ipSE-row-2">
                <label class="checkbox">
                    I have read and agree to the <a class="link-u js-btn-terms">program’s terms and conditions</a>
                    <input type="checkbox" required>
                    <span class="checkmark"></span>
                </label>
                <br>
                <label class="checkbox">
                    I have read and agree to <a class="link-u" href="/en/privacy-policy/" target="_blank">Lotte Xylitol Vietnam’s privacy policy</a>
                    <input type="checkbox" required>
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="form-group txt-center">
                <?php if ($signup_link != '') : ?>
                    <a class="btn-dark-green-2 hover shadow txt-upper disabled js-button" href="<?php echo $signup_link ?>"><span>PLAY NOW</span></a>
                <?php else: ?>
                    <button type="submit" class="btn-dark-green-2 hover shadow txt-upper disabled js-button"><span>PLAY NOW</span></button>
                <?php endif ?>
            </div>
        </form>
    </div>
</section>
