<?php
// Author: A+LIVE
include_once ('../app_config.php');
include (APP_PATH . 'libs/lotte-api.php');

$user = $lotte_api->get_current_user();
if($user == false) {
    echo '<meta http-equiv="refresh" content="0; url=/signin?redirect_to=' . urlencode($_SERVER['REQUEST_URI']).'">';
	exit;
}

// Kiem tra thoi han
$lotte_api->check_game_expired();

$game_token = $lotte_api->get_token();

include (APP_PATH . 'libs/head.php');

$show_snsBox = false;

?>
</head>

<body id="top" class="top hide-snsbox game-page vn">
    <!-- Header
    ================================================== -->
    <?php include (APP_PATH . 'libs/header.php'); ?>
    <div id="wrap">
        <!-- Main Content
        ================================================== -->
        <main class="main bgmain">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="/membership-activities/">Hoạt động thành viên</a></li>
                    <li>Giải cứu răng xinh</li>
                </ul>
            </div>
            <div class="section-game">
                <div class="section">
                    <h1 class="section-title">Giải cứu răng xinh</h1>
                    <div class="game-player">
                        <iframe frameBorder="0" style="background:transparent; max-width: 535px; max-height: 668px; margin: auto;" allowtransparency="true" width="100%" height="667px" allow="autoplay" src="/game/player.html?v=1.0.0&lang=vi&token=<?php echo $game_token ?>"></iframe>
                    </div>
                </div>
            </div>
        </main>
    </div><!-- #wrap -->

    <!-- Footer 
    ================================================== -->
    <?php include (APP_PATH . 'libs/footer.php'); ?>
    <!-- End Document
================================================== -->
</body>

</html>