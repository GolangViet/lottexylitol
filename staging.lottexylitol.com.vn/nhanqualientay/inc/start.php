<?php
defined('APP_PATH') or die();
?>
<div class="section-contest section-must-buy start<?php echo $is_terms ? '' : ' active'?>" id="start">
    <div class="text__shadow txt-upper">
        Mở nắp, tìm mã may mắn,<br />
        cơ hội trúng thưởng ngay!
    </div>
    <div class="image">
        <?php /*/ ?> <img src="<?php echo APP_ASSETS; ?>img/must-buy/img-start.png" alt="" /> <?php /*/ ?>
        <div class="lottie-icon" data-src="/assets/json/must-buy-home/homepage.json"></div>
    </div>
    <div class="start__button">
        <a class="btn-dark-green-2 shadow"<?php echo $is_coming ? '' : ' href="/about-must-buy/"' ?>>
            <span>THỂ LỆ CHƯƠNG TRÌNH</span>
        </a>
            <br>
        <?php if ($step == 'lock') : ?>
            <a class="btn-dark-green-2 btn-dark-green-2--red shadow js-btn-lock">
                <span>THAM GIA NGAY</span>
            </a>
        <?php else: ?>
            <a class="btn-dark-green-2 btn-dark-green-2--red shadow js-btn-start">
                <span>THAM GIA NGAY</span>
            </a>
        <?php endif ?>
    </div>
</div>
