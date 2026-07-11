<?php
defined('APP_PATH') or die();
$list_from  = explode('|', date('H|i|d/m/Y', $time_from));
$list_to    = explode('|', date('H|i|d/m/Y', $time_to));
?>
<section id="modal-coming" class="modal-must-buy-coming">
    <div class="content content-josefin-sans">
        <div class="comming-content">
            <div class="comming-row">
                <div class="comming-logo">
                    <a href="/"><img loading="lazy" width="106" src="/assets/img/common/logo.png" alt="BẢO VỆ RĂNG BẠN KHỎI SÂU RĂNG" /></a>
                </div>
                <div class="comming-slogan">
                    <img loading="lazy" width="157" src="/assets/img/must-buy/comming/slogan.png" alt="" />
                </div>
            </div>
            <div class="comming-title txt-green-2">Chương trình chưa bắt đầu.</div>
            <div class="comming-description txt-green" data-time="<?php echo date('Y-m-d H:i:s', $time_now) ?>">
                Giữ lại thẻ trúng thưởng <span class="txt-green-2">và quét mã QR</span> từ <?php printf('%s giờ %s phút ngày %s', $list_from[0], $list_from[1], $list_from[2]) ?> đến <?php printf('%s giờ %s phút ngày %s', $list_to[0], $list_to[1], $list_to[2]) ?> <span class="txt-green-2">để cung cấp thông tin nhận thưởng.</span>
            </div>
        </div>
        <div class="comming-footer">
            <a href="https://www.facebook.com/share/p/19ymesJDBF/" class="btn-dark-green-2 shadow" target="_blank"><span>THÔNG TIN CHƯƠNG TRÌNH</span></a>
        </div>
    </div>
</section>
