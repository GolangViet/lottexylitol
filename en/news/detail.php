<?php
// Author: A+LIVE
include_once ('../../app_config.php');
include (APP_PATH . 'libs/lotte-news.php');

$p_name = isset($_GET['p']) ? trim($_GET['p']) : '';
$item = $lotte_news->get_detail($p_name);

if($item['title'] == '') {
    header('Location: /?error=404');
	exit;
}

if ($item['name_vi'] != '') {
    $lang_urls['vi'] = APP_URL . 'news/' . ($permalink ? '' : '?p=') . $item['name_vi'];
}

//set meta title in head
$titlepage = $item['title'];
$desPage = substr(trim(strip_tags($item['content'])), 0, 300);

include (APP_PATH . 'libs/head.php');
?>
</head>

<body id="news-title" class="product news-title en">
    <!-- Header
    ================================================== -->
    <?php include (APP_PATH . 'libs/header.php'); ?>
    <div id="wrap">
        <!-- Main Content
        ================================================== -->
        <main class="main bgmain">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/en/">Top</a></li>
                    <li><a href="/en/news">News</a></li>
                    <li><?php echo $titlepage ?></li>
                </ul>
            </div>
            <div class="section detail">
                <h1 class="section-title section-title-2"><?php echo $titlepage ?></h1>
                <div class="content">
                    <?php echo $item['content'] ?>
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