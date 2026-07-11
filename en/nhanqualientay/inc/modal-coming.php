<?php
defined('APP_PATH') or die();
$list_from  = explode('|', date('H:i|F d, Y', $time_from));
$list_to    = explode('|', date('H:i|F d, Y', $time_to));
?>
<section id="modal-coming" class="modal-must-buy-coming">
    <div class="content content-josefin-sans">
        <div class="comming-content">
            <div class="comming-row">
                <div class="comming-logo">
                    <a href="/en/"><img loading="lazy" width="106" src="/assets/img/common/logo.png" alt="BẢO VỆ RĂNG BẠN KHỎI SÂU RĂNG" /></a>
                </div>
                <div class="comming-slogan">
                    <img loading="lazy" width="157" src="/assets/img/must-buy/comming/slogan-en.png" alt="" />
                </div>
            </div>
            <div class="comming-title txt-green-2">The program has not yet started.</div>
            <div class="comming-description txt-green">
                Please keep your winning card <span class="txt-green-2">and scan the QR code</span> from <?php printf('%s on %s', $list_from[0], $list_from[1]) ?> to <?php printf('%s on %s', $list_to[0], $list_to[1]) ?>, <span class="txt-green-2">to provide redemption information.</span>
            </div>
        </div>
        <div class="comming-footer">
            <a href="https://docs.google.com/document/d/1vaCGufAN16uh8evFpMPU3u8XCd1nog3Ka0AzgLfNW_A/edit?tab=t.0" class="btn-dark-green-2 shadow" target="_blank"><span>PROGRAM INFORMATION</span></a>
        </div>
    </div>
</section>
