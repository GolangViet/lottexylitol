<?php
// Author: A+LIVE
include_once('../app_config.php');
include(APP_PATH . 'libs/lotte-api.php');

$is_logged_in = $lotte_api->is_logged_in();

// Check time in program
$is_coming = $lotte_api->is_mustbuy_coming_soon($mustbuy_from, $mustbuy_to);

if($is_coming) die('<meta http-equiv="refresh" content="0; url=/">');

// $link = '/activity-page';
$link = '/nhanqualientay/';
if ($is_logged_in == false) {
    // $link = $login_link;
    $link = APP_URL . $lang_link . 'signup?redirect_to=' . urlencode($link);
}

include(APP_PATH . 'libs/head.php');
?>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>

<body id="about-must-buy" class="about-photo-contest product vn about-must-buy">
    <!-- Header
    ================================================== -->
    <?php include(APP_PATH . 'libs/header.php'); ?>
    <div id="wrap">
        <!-- Main Content
        ================================================== -->
        <main class="main bgmain">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="/membership-activities/">Hoạt động thành viên</a></li>
                    <li>Nhận quà liền tay</li>
                </ul>
            </div>
            <div class="bottle-slogan lottie-icon" data-src="/assets/json/bottle-slogan/slogan.json"></div>
            <!-- <h1 class="section-title"><img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-must-buy-slogan.png" alt="Lucky Bottle" /></h1> -->
            <div class="section">
                <div class="section-contest section-about-must-buy">
                    <div class="content-auto-scroll">
                        <div class="title-contest">ĐỐI TƯỢNG THAM GIA</div>
                        <p class="text-content txt-bold">Khách hàng mua Sản Phẩm Khuyến Mại trực tiếp tại hệ thống cửa hàng bán lẻ sản phẩm kẹo gum Lotte Xylitol trên phạm vi toàn quốc</p>
                        <p class="text-content txt-black u-pb-60 u-sp-pb-34">Là người tiêu dùng trên lãnh thổ Việt Nam, thực hiện mua Sản Phẩm Khuyến Mại tại địa bàn khuyến mại trong Thời Gian Khuyến Mại.</p>
                        <div class="title-contest">Điều kiện tham gia</div>
                        <p class="text-content txt-bold u-pb-30 u-sp-pb-24">Khách hàng mua Sản Phẩm Khuyến Mại trực tiếp tại hệ thống cửa hàng bán lẻ sản phẩm kẹo gum Lotte Xylitol trên phạm vi toàn quốc sẽ đủ điều kiện tham gia Chương trình. Bao gồm các sản phẩm:</p>
                        <p class="text-leaf">Kẹo gum không đường <br class="u-sp" />LOTTE XYLITOL hương Lime Mint</p>
                        <div class="row-cond">
                            <div class="item">
                                <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-01.png" width="125" alt="" />
                                <p>Hũ cầm tay 55.1g</p>
                            </div>
                            <div class="item">
                                <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-02.png" width="158" alt="" />
                                <p>Hũ gia đình 130.5g</p>
                            </div>
                        </div>
                        <p class="text-leaf">Kẹo gum không đường <br class="u-sp" />Lotte Xylitol Super Cool</p>
                        <div class="row-cond">
                            <div class="item">
                                <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-03.png" width="125" alt="" />
                                <p>Hũ cầm tay 55.1g</p>
                            </div>
                            <div class="item">
                                <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-04.png" width="158" alt="" />
                                <p>Hũ gia đình 130.5g</p>
                            </div>
                        </div>
                        <p class="text-leaf">Kẹo gum không đường LOTTE XYLITOL hương Trái Cây Hỗn Hợp</p>
                        <div class="row-cond">
                            <div class="item">
                                <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-05.png" width="125" alt="" />
                                <p>Hũ cầm tay 55.1g</p>
                            </div>
                            <div class="item">
                                <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-06.png" width="158" alt="" />
                                <p>Hũ gia đình 130.5g</p>
                            </div>
                        </div>
                        <p class="text-leaf">Kẹo gum không đường LOTTE XYLITOL cho trẻ em hương Dâu</p>
                        <div class="row-cond content-center">
                            <div class="item">
                                <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-07.png" width="133" alt="" />
                                <p>Túi 22.56g</p>
                                <p><img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/txt-copyright.jpg" width="133" alt="" /></p>
                            </div>
                        </div>
                        <p class="text-leaf">Kẹo gum không đường LOTTE XYLITOL cho trẻ em hương NHO</p>
                        <div class="row-cond content-center">
                            <div class="item">
                                <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-xylitol-08.png" width="133" alt="" />
                                <p>Túi 22.56g</p>
                                <p><img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/txt-copyright.jpg" width="133" alt="" /></p>
                            </div>
                        </div>
                        <div class="title-contest">Thể lệ tham gia</div>
                        <ul class="step step-2">
                            <li>
                                <div class="step-title">BƯỚC 1</div>
                                <p>Sau khi mua sắm và thanh toán thành công Sản Phẩm Khuyến Mại tại hệ thống cửa hàng bán lẻ sản phẩm Lotte Xylitol trên phạm vi toàn quốc. Khách hàng sẽ tìm thấy một mã dự thưởng nằm trên thẻ trúng thưởng trong sản phẩm.</p>
                            </li>
                            <li>
                                <div class="step-title">BƯỚC 2</div>
                                <p>Sử dụng tính năng quét mã QR trên điện thoại, quét mã QR có trên bao bì của sản phẩm khuyến mại, màn hình sẽ chuyển đến trang web để tham gia chương trình khuyến mại.</p>
                            </li>
                            <li>
                                <div class="step-title">BƯỚC 3</div>
                                <p>Nhập <strong class="txt-red">Mã dự thưởng*</strong> trên thẻ trúng thưởng trong sản phẩm.</p>
                            </li>
                            <li>
                                <div class="step-title">BƯỚC 4</div>
                                <p>Tham gia trò chơi điền vào chỗ trống bằng cách đọc kỹ câu hỏi và chọn các đáp án chính xác nhất trong số các đáp án. Màn hình hiện đáp án chính xác cuối cùng sau trò chơi. Sau đó chọn nút <strong>“Hiểu rồi”</strong>.</p>
                            </li>
                            <li>
                                <div class="step-title">BƯỚC 5</div>
                                <p>Bấm nút <strong>“Chơi ngay”</strong> để nhận phần quà may mắn ngẫu nhiên.</p>
                            </li>
                        </ul>
                        <div class="title-contest">PHẦN QUÀ</div>
                        <div class="gift-contest row row-2 gutter-25 m-w-670">
                            <div class="col-md-12">
                                <div class="gift-contes-img">
                                    <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-prize-gold.png" width="247" alt="">
                                </div>
                                <div class="gift-contes-title-2 txt-bold">
                                    <div class="sub-title">GIẢI THƯỞNG CƠ HỘI</div>
                                    <div class="title-2 txt-red">100 THẺ MAY MẮN*</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="gift-contes-img">
                                    <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-prize-200k.png" width="256" alt="">
                                </div>
                                <div class="gift-contes-title-2">
                                    <div class="sub-title txt-bold">GIẢI NHẤT</div>
                                    <div class="title"><small>90 Thẻ quà tặng điện tử (Evoucher) Gotit trị giá</small></div>
                                    <div class="title"><strong>200,000 VND</strong></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="gift-contes-img">
                                    <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-prize-20k.png" width="235" alt="">
                                </div>
                                <div class="gift-contes-title-2">
                                    <div class="sub-title txt-bold">GIẢI NHÌ</div>
                                    <div class="title"><small>350 thẻ nạp tiền điện thoại di động</small></div>
                                    <div class="title"><strong>20,000 VND</strong></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="gift-contes-img">
                                    <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-prize-10k.png" width="235" alt="">
                                </div>
                                <div class="gift-contes-title-2">
                                    <div class="sub-title txt-bold">GIẢI BA</div>
                                    <div class="title"><small>6,600 thẻ nạp tiền điện thoại di động</small></div>
                                    <div class="title"><strong>10,000 VND</strong></div>
                                </div>
                            </div>
                        </div>
                        <p class="text-content txt-black txt-bold u-pb-30 u-sp-pb-20">* Những khách hàng quay trúng giải<br>
                            <strong class="txt-red">“Thẻ may mắn”</strong> sẽ được tham gia vòng quay ngẫu nhiên dành riêng cho Giải Đặc Biệt, được quay ngẫu nhiên bởi ban tổ chức Lotte Xylitol Việt Nam.<br>
                            Kết quả sẽ được thông báo trên fanpage Lotte Xylitol Việt Nam
                        </p>
                        <p class="text-content-2 u-pb-30 u-sp-pb-20">Giải Đặc biệt bao gồm 03 Xe honda Vision bản tiêu chuẩn.</p>
                        <p class="text-content text-center u-pb-30 u-sp-pb-20">
                            <img loading="lazy" src="<?php echo APP_ASSETS; ?>img/about-must-buy/img-prize-vision.png" width="185" alt="" />
                        </p>
                        <p class="text-content txt-black u-pb-30 u-sp-pb-20">
                            <strong>*Lưu ý: </strong><br>
                            Mỗi khách hàng không được nhập sai mã dự thưởng 5 lần. Nếu nhập sai từ 5 lần trở lên sẽ bị khoá quyền chơi và cần liên hệ ban tổ chức thông qua fanpage Lotte Xylitol Việt Nam để được hỗ trợ mở khoá quyền chơi.
                        </p>
                        <p class="text-content txt-red u-pb-30 u-sp-pb-20">Thông tin khách hàng khi đăng ký thành viên sẽ là căn cứ để trao giải thưởng, vui lòng nhập chính xác thông tin đăng ký. Nếu có sai sót, Lotte Xylitol có quyền không trao giải thưởng và không chịu trách nhiệm.</p>
                        <div class="item-form m-w-670 u-pb-30 u-sp-pb-20">
                            <label class="checkbox">
                                Tôi đã đọc và đồng ý <a class="link-u" href="/nhanqualientay/terms/">thể lệ và điều khoản tham gia chương trình</a>
                                <input type="checkbox" class="js-checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <br />
                            <label class="checkbox">
                                Tôi đã đọc và đồng ý với <a class="link-u" href="/privacy-policy/" target="_blank">chính sách về quyền riêng tư</a> của Lotte Xylitol Việt Nam
                                <input type="checkbox" class="js-checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="text-content txt-black u-pb-60 u-sp-pb-40">Ban tổ chức là người có quyền quyết định cuối cùng về kết quả chương trình.</div>
                    </div>
                    <div class="txt-center float-btn-dark">
                        <a href="<?php echo $link ?>" class="btn-dark-green-2 hover js-submit disabled"><span>THAM GIA NGAY</span></a>
                    </div>
                </div>
            </div>
        </main>
    </div><!-- #wrap -->

    <!-- Footer
    ================================================== -->
    <?php include(APP_PATH . 'libs/footer.php'); ?>
    <!-- End Document
================================================== -->
    <script src="<?php echo APP_ASSETS; ?>js/lottie.js"></script>
    <script>
        jQuery(function($) {
            $(document).on('change', '.js-checkbox', function(e) {
                $(this).parent().toggleClass('error', this.checked == false);
                $('.js-submit').toggleClass('disabled', is_all_checked() == false);
            });

            function is_all_checked() {
                return $('.js-checkbox').length == $('.js-checkbox:checked').length;
            }
        })
    </script>
</body>

</html>
