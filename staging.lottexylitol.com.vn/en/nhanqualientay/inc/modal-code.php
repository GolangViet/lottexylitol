<?php
defined('APP_PATH') or die();
?>
<section id="box-code" class="box-thanks box-wellcom box-must-buy">
    <div class="content content-josefin-sans">
        <h2 class="gift-contes-title-2 txt-bold u-mb-20 u-sp-mb-20">
            ENTER LUCKY CODE <br>TO JOIN THE GAME
        </h2>
        <div class="code-description u-mb-20 u-sp-mb-20">
            OPEN THE CAP, FIND THE CODE,<br class="u-sp" />
            WIN THE PRIZE NOW!
        </div>
        <form class="form-code js-verify-code-form" data-toggle="validator" role="form" autocomplete="off">
            <input type="hidden" value="<?php echo $csrf_token ?>" data-field="csrf" />
            <div class="form-group js-message u-hidden" data-message="Lucky code has been verified!">
                <p class="text-center c-red"></p>
            </div>
            <div class="form-group">
                <input type="text" data-field="code" class="form-control" id="inputcode" placeholder="Enter lucky code" data-error="Please enter lucky code" minlength="8" required>
                <div class="help-block with-errors"></div>
            </div>
            <div class="form-group txt-center">
                <button type="submit" class="btn-dark-green-2 hover shadown"><span>SUBMIT LUCKY CODE</span></button>
            </div>
        </form>
    </div>
</section>
<section id="box-code-error" class="box-thanks box-wellcom box-must-buy">
    <div class="content content-josefin-sans txt-center">
        <div class="txt-green-2 u-pb-60 u-sp-pb-60">
            <div class="error error-1 u-hidden">
                This lucky code has already been used. Please purchase more products to get a new lucky code and don’t miss your chance to win!
            </div>
            <div class="error error-2">
                Your play has been locked.<br>
                Please contact the Lotte Xylitol fanpage<br>
                for assistance with unlocking.
            </div>
            <div class="error error-3 u-hidden">
                Better luck next time.<br>
                Please purchase more products to get a new lucky code and don’t miss your chance to win!
            </div>
            <div class="error error-4 u-hidden">
                This lucky code  is incorrect.<br>
                Please use another lucky code.
            </div>
        </div>
        <div class="form-group">
            <a class="btn-dark-green-2 shadow-2 hover btn-back js-btn-back-code"><span>GO BACK</span></a>
        </div>
    </div>
</section>
