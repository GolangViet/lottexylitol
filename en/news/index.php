<?php
// Author: A+LIVE
include_once('../../app_config.php');
include(APP_PATH . 'libs/lotte-news.php');

// overwrite config
$lang_urls = [
	'vi' => APP_URL . 'news',
	'en' => APP_URL . 'en/news',
];

// use htaccess
$permalink = false;
if(file_exists(__DIR__ . '/.htaccess')) {
    $permalink = true;
    $lotte_news->detect_url('/en/news/');
}

$p_name = isset($_GET['p']) ? trim($_GET['p']) : '';
if ($p_name != '') {
    include(__DIR__ . '/detail.php');
    exit();
}
include(APP_PATH . 'libs/head.php');

$paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
$news = $lotte_news->get_list('news', $paged);

?>
</head>

<body id="news" class="product news-title news en">
    <!-- Header
    ================================================== -->
    <?php include(APP_PATH . 'libs/header.php'); ?>
    <div id="wrap">
        <!-- Main Content
        ================================================== -->
        <main class="main bgmain">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/en/">Top</a></li>
                    <li>News</li>
                </ul>
            </div>
            <div class="section">
                <h1 class="section-title">News</h1>
                <div class="news-list row-2">
                    <?php
                    foreach ($news['items'] as $item) :
                        $item = $lotte_news->map_data('summary', $item);

                        $thumbnail = APP_ASSETS . 'img/news/img1.png';

                        if ($item['thumbnail'] != '') {
                            $thumbnail = $item['thumbnail'];
                        }
                    ?>
                        <a href="/en/news/<?php echo ($permalink ? '' : '?p=' ) . $item['name']; ?>" class="news-item col-2">
                            <img class="news-item__img" src="<?php echo $thumbnail; ?>" alt="" />
                            <div class="news-item-content">
                                <div class="news-item-content__head">
                                    <div class="head-date"><?php echo $item['date']; ?></div>
                                    <?php if ($item['cat_name'] != '') : ?>
                                        <div class="head-category"><?php echo $item['cat_name']; ?></div>
                                    <?php endif ?>
                                </div>
                                <div class="news-item-content__title"><?php echo $item['title']; ?></div>
                            </div>
                        </a>
                    <?php endforeach ?>
                </div>
                <?php

                    echo $lotte_news->get_pagi_html([
                        'active' => $paged,
                        'total' => $news['total'],
                        'limit' => 6,
                        'link' => '/en/news/',
                        'number_pages' => 10,
                        'show_arrow' => 'always',
                    ]);

                ?>
            </div>
        </main>
    </div><!-- #wrap -->

    <!-- Footer
    ================================================== -->
    <?php include(APP_PATH . 'libs/footer.php'); ?>
    <!-- End Document
================================================== -->
    <script src="<?php echo APP_ASSETS; ?>js/lib/jquery.matchHeight.min.js"></script>
    <script>
        $(function() {
            $('.news-item .news-item-content .news-item-content__title').matchHeight();
            $('.news-item').matchHeight();
        });
    </script>
</body>

</html>