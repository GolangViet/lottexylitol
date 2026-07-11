<?php
// Author: A+LIVE
include_once ('../app_config.php');
include (APP_PATH . 'libs/head.php');
include (APP_PATH . 'libs/lotte-api.php');

$tabs = $lotte_api->get_winners();

?>
</head>

<body id="membership-activities" class="membership-activities product vn">
    <!-- Header
    ================================================== -->
    <?php include (APP_PATH . 'libs/header.php'); ?>
    <div id="wrap">
        <!-- Main Content
        ================================================== -->
        <main class="main">
            <section class="section-kv">
                <div class="breadcrumb">
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li class="white">Hoạt động thành viên</li>
                    </ul>
                </div>
                <h1 class="kv-title">
                    <span class="kv-title text-small">Trở thành fan cứng của Lotte Xylitol 2026:</span>
                    Tham gia dễ dàng - Nhận thưởng hấp dẫn !
                    <span class="kv-title text-small">Bạn muốn tham gia một chương trình thú vị, dễ dàng và có cơ hội nhận được nhiều giải thưởng hấp dẫn ?</span>
                    Hãy tham gia ngay và trở thành fan cứng của Lotte Xylitol nhé.
                </h1>
                <div class="kv-img pc"><img src="<?php echo APP_ASSETS; ?>img/membership-activities/kv-img.png" alt=""></div>
                <div class="kv-img sp"><img src="<?php echo APP_ASSETS; ?>img/membership-activities/kv-img-sp.png" alt=""></div>
            </section>
            <div class="cloud">
                <?php /*/ ?><div class="cloud-icon lottie-icon" data-src="/assets/json/present.json"></div><?php /*/ ?>
                <img class="cloud-icon lottie-icon" src="<?php echo APP_ASSETS; ?>img/membership-activities/icon.png" alt="">
                <div class="cloud-title">CÁCH THỨC THAM GIA</div>
            </div>
            <section class="section section-how-to-join">
                <ul class="step">
                    <li>
                        <div class="step-title"><span class="step-number">bước 1 : </span>Truy cập website https://lottexylitol.com.vn/vn/</div>
                    </li>
                    <li>
                        <div class="step-title"><span class="step-number">bước 2 : </span>Đăng ký tài khoản và hoàn thành thông tin cá nhân</div>
                    </li>
                    <li class="u-pt-32">
                        <div class="step-title"><span class="step-number">bước 3 : </span>Tham gia các hoạt động và nhận thưởng</div>
                        <div class="step-content content-center__">
                            <?php /*/ ?><div class="step-content-item">
                                <div class="step-content-img">
                                    <img src="<?php echo APP_ASSETS; ?>img/membership-activities/img-01.png" alt="">
                                </div>
                                <div class="step-content-title">khảo sát</div>
                                <div class="step-content-text">Hoàn thành khảo sát sau khi đăng ký và
                                    cập nhật khảo sát sau mỗi 6 tháng để nhận được 03 hũ kẹo gum Lotte Xylitol hương chanh bạc hà.</div>
                                <a href="/about-survey" class="btn-dark-green hover">Tìm hiểu chi tiết</a>
                            </div><?php /*/ ?>
                            <div class="step-content-item">
                                <div class="step-content-img">
                                    <img src="<?php echo APP_ASSETS; ?>img/membership-activities/img-01.jpg?v=20260407" alt="">
                                </div>
                                <div class="step-content-title">Đại sứ Lotte Xylitol</div>
                                <div class="step-content-text">
                                    Tham dự hoạt động Đại sứ thương hiệu Lotte Xylitol hằng tháng nhận hộp quà siêu hấp dẫn gồm:<br>
                                    -  01 hũ kẹo gum Lotte Xylitol limemint với hình ảnh của ca sĩ Orange kèm chữ ký<br>
                                    -  01 bàn chải điện<br>
                                    -  04 hộp kẹo gum Lotte Xylitol dạng vỉ<br>
                                    -  01 Giấy chứng nhận “Đại sứ thương hiệu” của Lotte Xylitol.
                                </div>
                                <a href="/about-brand-ambassador" class="btn-dark-green hover">Tìm hiểu chi tiết</a>
                            </div>
                            <div class="step-content-item">
                                <div class="step-content-img">
                                    <img src="<?php echo APP_ASSETS; ?>img/membership-activities/img-02.jpg?v=20260407" alt="">
                                </div>
                                <div class="step-content-title">CUỘC THI HÌNH ẢNH</div>
                                <div class="step-content-text">
                                    Tham dự cuộc thi hình ảnh cùng Lotte Xylitol hàng quý để nhận được nhiều phần thưởng hấp dẫn như:<br>
                                    - 01 hộp Lotte Chocolat 12 bánh<br>
                                    - 10 hũ kẹo gum Lotte Xylitol Lime mint Handy <br>
                                    - 03 hũ kẹo gum Lotte Xylitol Lime mint Family<br>
                                    - 01 Evoucher 100.000 VND
                                </div>
                                <a href="/about-photo-contest" class="btn-dark-green hover">Tìm hiểu chi tiết</a>
                            </div>
                            <div class="step-content-item">
                                <div class="step-content-img">
                                    <img src="<?php echo APP_ASSETS; ?>img/membership-activities/img-03.jpg?v=20260407" alt="">
                                </div>
                                <div class="step-content-title">GIẢI CỨU RĂNG XINH</div>
                                <div class="step-content-text">
                                    Tham gia ngay vào Game “Giải Cứu Răng Xinh” cùng Lotte Xylitol siêu vui nhộn, được tổ chức mỗi 2 tuần một lần để có cơ hội nhận ngay 1 hũ kẹo gum Lotte Xylitol Handy.
                                </div>
                                <a href="/about-game" class="btn-dark-green hover">Tìm hiểu chi tiết</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </section>
            <div class="organizer-decisions">Ban tổ chức là người có quyền quyết định cuối cùng về kết quả chương trình.</div>
            <div class="cloud winter">
                <img class="cloud-icon winter-icon lottie-icon" src="<?php echo APP_ASSETS; ?>img/membership-activities/winter-icon.png" alt="">
                <div class="cloud-title">Danh sách người chiến thắng</div>
            </div>
            <?php if($tabs && count($tabs)>0) :?>
            <section class="section winners-list">
                <div class="winners-tab">
                    <span class="survey-contest-label sp"></span>
                    <ul class="survey-contest">
                        <?php
                            foreach($tabs as $i => $tab){
                                if(count($tab['list']) == 0) continue;

                                echo '<li class="survey-contest-item'. ($i == 0 ? ' active' : '').'">'.$tab['name'].'</li>';
                            }
                        ?>
                    </ul>
                </div>
                <div class="survey-contest-table">
                    <?php foreach($tabs as $i => $tab) :
                        if(count($tab['list']) == 0) continue;
                    ?>
                    <div class="table-content<?php echo ($i > 0 ? ' u-hidden' : '') ?>">
                        <?php if($tab['slug'] == 'photo-contest') :?>
                        <div class="txt-center"><img src="<?php echo APP_ASSETS; ?>img/membership-activities/icon-tooth.png" alt="" /></div>
                        <div class="step-title u-mb-30 content-center">Răng chắc khoẻ, cười rạng ngời</div>
                            <?php foreach($tab['list'] as $key => $item) : list($year, $month) = explode('-', $key); ?>
                            <div class="step-title u-ml-30 u-sp-ml-2 u-mb-30"><span class="step-number"><?php printf('THÁNG %d, %d', $month, $year) ?></span></div>
                            <div class="winner-photos">
                                <?php foreach($item['winners'] as $winner) : ?>
                                <div class="winner-photo">
                                    <div class="photo"><?php echo $winner['photo'] != '' ? '<img src="' . $winner['photo'] .'" alt="" />' : '' ?></div>
                                    <div class="name"><?php echo $winner['name'] ?></div>
                                </div>
                                <?php endforeach ?>
                            </div>
                            <?php endforeach ?>
                        <?php else: ?>
                            <?php foreach($tab['list'] as $key => $item) : list($year, $month) = explode('-', $key); ?>
                            <div class="step-title u-ml-30 u-sp-ml-2 u-mb-10"><span class="step-number"><?php printf('THÁNG %d, %d', $month, $year) ?></span></div>
                            <div class="winner-question c-green u-mb-30"><?php echo $item['question'] ?></div>
                            <div class="winner-items">
                                <?php foreach($item['winners'] as $winner) : ?>
                                <div class="winner-item box-readmore">
                                    <div class="winner-info">
                                        <div class="avatar"><?php echo $winner['avatar'] != '' ? '<img src="' . $winner['avatar'] .'" alt="" />' : '' ?></div>
                                        <div class="name"><?php echo $winner['name'] ?></div>
                                    </div>
                                    <div class="box-readmore__desc">
                                        <div class="description"><?php echo $winner['description'] ?></div>
                                    </div>
                                    <div class="btn-readmore txt-right u-hidden">
                                        <a href="#"><em>Xem thêm</em> ...</a>
                                    </div>
                                </div>
                                <?php endforeach ?>
                            </div>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                    <?php endforeach ?>
                </div>
            </section>
            <?php endif; ?>
        </main>
    </div><!-- #wrap -->

    <!-- Footer
    ================================================== -->
    <?php include (APP_PATH . 'libs/footer.php'); ?>
    <!-- End Document
================================================== -->
    <script src="<?php echo APP_ASSETS; ?>js/lottie.js">
    </script>
    <script src="<?php echo APP_ASSETS; ?>js/lib/jquery.matchHeight.min.js"></script>
    <script>
        $( function (){
            $( '.step-content .step-content-text' ).matchHeight();
            $( '.step-content' ).matchHeight();
        } );
    </script>
</body>

</html>
