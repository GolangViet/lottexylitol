<?php
defined('APP_PATH') or die();
?>
<div id="wrap">
    <!-- Main Content
    ================================================== -->
    <main class="main bgmain" data-time="<?php echo date('Y-m-d H:i:s') ?>">
        <div class="breadcrumb">
            <ul>
                <li><a href="/en/">Top</a></li>
                <li><a href="/en/membership-activities/">Membership Activities</a></li>
                <li>Nhận quà liền tay</li>
            </ul>
        </div>
        <div class="bottle-slogan bottle-slogan--2 lottie-icon" data-src="/assets/json/bottle-slogan-en/slogan-en.json"></div>
        <div class="section">
            <?php
            require_once('start.php');

            if ($is_coming == false) {
                require_once('terms.php');

                if ($user != false && $step != 'lock') {
                    require_once('fill-blank.php');
                    require_once('lucky.php');
                }
            }
            ?>
        </div>
    </main>
</div><!-- #wrap -->
