<?php
// Author: A+LIVE
include_once('../app_config.php');
include(APP_PATH . 'libs/head.php');
?>
<link type="text/css" rel="stylesheet" href="<?php echo APP_ASSETS; ?>js/wow/animate.min.css">
<link type="text/css" rel="stylesheet" href="<?php echo APP_ASSETS; ?>js/slick/slick.css">
</head>

<body id="what" class="what vn">
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
                    <li>Giới thiệu về LOTTE XYLITOL</li>
                </ul>
            </div>
            <h1 class="bHead wow fadeIn">Xylitol:<br> Bí mật ngọt ngào từ thiên nhiên</h1>
            <div class="whatSet1">
                <div class="section wow fadeIn">
                    <p class="text">Bạn đã bao giờ tự hỏi xylitol là gì và liệu nó có an toàn cho cơ thể chúng ta không? Hãy cùng khám phá những điều thú vị về chất tạo ngọt tự nhiên này và cách nó
                        giúp bảo vệ răng miệng của chúng ta.</p>
                    <p class="leaf1"><img src="<?php echo APP_ASSETS; ?>img/what/img_leaf1.png" alt="leaf"></p>
                </div>
            </div>
            <!-- start map -->
            <div id="why">
                <section class="mapBlock">
                    <span class="bgMap wow fadeInLeft" data-wow-delay="0.2s"></span>
                    <span class="bgMap2 wow fadeIn" data-wow-delay="1s"></span>
                    <div class="inner">
                        <span class="imgProduct wow zoomIn" data-wow-delay="1.5s"><img src="<?php echo APP_ASSETS; ?>img/why/img_product.png"
                                alt="Xylitol Gum’s benefit that can prevent cavities has been approved by Dental Associations in many countries all over the world."></span>
                        <h2 class="wow fadeIn" data-wow-delay="1s">Lợi ích giúp ngăn ngừa sâu răng của Xylitol <br class="pc">đã được chứng nhận bởi các hiệp hội nha khoa <br class="pc">ở nhiều nước
                            trên thế giới.</h2>
                        <div class="mapImg wow fadeIn" data-wow-delay="0.5s">
                            <em class="btnPlus sp" onclick="zoomin()"><img src="<?php echo APP_ASSETS; ?>img/why/ico_plus.svg" alt="+"></em>
                            <em class="btnSub sp" onclick="zoomout()"><img src="<?php echo APP_ASSETS; ?>img/why/ico_sub.svg" alt="-"></em>
                            <div id="scroll">
                                <div id="mapClick" class="wow fadeIn" data-wow-delay="2s">
                                    <img src="<?php echo APP_ASSETS; ?>img/why/img_map.png" alt="Xylitol map">
                                    <span class="map vietnam"><i>VietNam</i></span>
                                    <span class="map japan"><i>Japan</i></span>
                                    <span class="map korea"><i>Korea</i></span>
                                    <span class="map norway"><i>Norway</i></span>
                                    <span class="map estonia"><i>Estonia</i></span>
                                    <span class="map holland"><i>Holland</i></span>
                                    <span class="map canada"><i>Canada</i></span>
                                    <span class="map ireland"><i>Ireland</i></span>
                                    <span class="map finland"><i>Finland</i></span>
                                    <span class="map england"><i>England</i></span>
                                    <span class="map belgium"><i>Belgium</i></span>
                                    <span class="map belize"><i>Belize</i></span>
                                    <span class="map swiden"><i>Sweden</i></span>
                                    <span class="map island"><i>Island</i></span>
                                    <span class="map latvia"><i>Latvia</i></span>
                                    <span class="map lithuania"><i>Lithuania</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mapInfo clearfix">
                        <p class="thumb wow fadeIn" data-wow-delay="1s"><span class="wow fadeIn" data-wow-delay="1.5s"><img src="<?php echo APP_ASSETS; ?>img/why/img_doctor.png" alt="Doctor"
                                    class="pc"><img src="<?php echo APP_ASSETS; ?>img/why/img_doctor_sp.png" alt="Lotte Xylitol" class="sp"></span></p>
                        <ul class="wow fadeIn" data-wow-delay="2s">
                            <li>
                                <span class="bg"></span>
                                <div class="clearfix">
                                    <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_rhm.svg" alt="In Vietnam"></p>
                                    <div class="desc">
                                        <h3>Tại Việt Nam</h3>
                                        <p>Hội răng hàm mặt Việt Nam đã chứng nhận khả năng giúp ngăn ngừa sâu răng của kẹo gum Lotte Xylitol thông qua các kiểm nghiệm về nha khoa. Hiện chỉ có kẹo gum
                                            Lotte Xylitol được chứng nhận này trong tất cả các loại kẹo gum.</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <span class="bg"></span>
                                <div class="clearfix">
                                    <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_jp.png" alt="In Japan"></p>
                                    <div class="desc">
                                        <h3>Tại Nhật Bản</h3>
                                        <p>Ngay cả ở Nhật Bản, nơi Lotte Xylitol được sinh ra, <br class="pc">sản phẩm này được chứng nhận chính thức như một loại thực phẩm được chỉ định sử dụng cho
                                            sức khoẻ.</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
            <!-- end map -->

            <div class="section dentalgum clearfix">
                <div class="wow fadeIn" data-wow-delay="0.5s">
                    <div class="bText">
                        <div class="bImg"><img src="<?php echo APP_ASSETS; ?>img/what/img_product1.png" alt=" "></div>
                        <div class="item">
                            <h3 class="tlt">Sản phẩm chứa Xylitol<br>của Lotte</h3>
                            <p class="ttl">Kẹo gum</p>
                            <div class="txt">
                                <p>Kẹo gum Xylitol của Lotte chứa hơn 50% xylitol có vị ngọt. Bên cạnh đó, chỉ duy nhất sản phẩm Lotte Xylitol được Hội răng hàm mặt Việt Nam chứng nhận.</p>
                                <br>
                                <p>Kẹo gum Xylitol đã được chứng minh có thể ngăn ngừa sâu răng. Và cách hiệu quả nhất là nhai 2 viên kẹo gum có chứa Xylitol của Lotte sau mỗi bữa ăn.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="whatSet3">
                <p class="bgdot">&nbsp;</p>
                <div class="section teeth">
                    <h3 class="bHead wow fadeIn">Nếu ăn Kẹo Gum Nha Khoa LOTTE XYLITOL hoặc không <br>Răng của bạn sẽ như thế nào ?</h3>
                    <p class="img1 wow fadeIn"><img src="<?php echo APP_ASSETS; ?>img/what/img_sugar_vn.png" alt="In case of eating LOTTE XYLITOL DENTAL GUM or not How will your teeth ?"></p>
                </div>

                <div class="sugars">
                    <p class="bg wow fadeInRight">&nbsp;</p>
                    <div class="section suga wow fadeIn" data-wow-delay="0.5s">
                        <h3 class="bHead">Các loại đường khác</h3>
                        <ul class="threeCols clearfix">
                            <li>
                                <p><img src="<?php echo APP_ASSETS; ?>img/what/img_sugar1_vn.png" alt="Vi khuẩn Streptococcus Mutans là một trong những nguyên nhân chính gây ra sâu răng"></p>
                                <p>Vi khuẩn Streptococcus Mutans là một trong những nguyên nhân chính gây ra sâu răng</p>
                            </li>
                            <li>
                                <p><img src="<?php echo APP_ASSETS; ?>img/what/img_sugar2_vn.png" alt="Vi khuẩn hấp thụ đường còn sót lại trên bề mặt răng và kẽ răng"></p>
                                <p>Vi khuẩn hấp thụ đường còn sót lại trên bề mặt răng và kẽ răng</p>
                            </li>
                            <li>
                                <p><img src="<?php echo APP_ASSETS; ?>img/what/img_sugar3_vn.png" alt="Vi khuẩn chuyển hoá đường thành axit ăn mòn men răng và gây sâu răng"></p>
                                <p>Vi khuẩn chuyển hoá đường thành axit ăn mòn men răng và gây sâu răng</p>
                            </li>
                        </ul>

                    </div>

                    <div class="section xyli wow fadeIn" data-wow-delay="0.5s">
                        <h3 class="bHead">Xylitol</h3>
                        <ul class="threeCols clearfix">
                            <li>
                                <p><img src="<?php echo APP_ASSETS; ?>img/what/img_xylitol4.png" alt="Vi khuẩn Streptococcus Mutans hấp thụ Xylitol"></p>
                                <p>Vi khuẩn Streptococcus Mutans hấp thụ Xylitol</p>
                            </li>
                            <li>
                                <p><img src="<?php echo APP_ASSETS; ?>img/what/img_xylitol5.png" alt="Vi khuẩn không thể tạo ra axit. Vi khuẩn hấp thụ Xylitol càng nhiều thì càng yếu đi"></p>
                                <p>Vi khuẩn không thể tạo ra axit. Vi khuẩn hấp thụ Xylitol càng nhiều thì càng yếu đi</p>
                            </li>
                            <li>
                                <p><img src="<?php echo APP_ASSETS; ?>img/what/img_xylitol6.png" alt="Vi khuẩn bị triệt tiêu khả năng sinh ra axit."></p>
                                <p>Vi khuẩn bị triệt tiêu khả năng sinh ra axit.</p>
                            </li>
                        </ul>
                    </div>
                    <div class="whatSet4">
                        <p class="wow fadeInLeft">&nbsp;</p>
                        <div class="inner wow fadeIn" data-wow-delay="0.8s">
                            <div class="inside">
                                <div class="section">
                                    <h3 class="bHead-2">Tăng Cường <br class="pc">Canxi</h3>
                                    <div class="desc">
                                        <ul class="calciBox">
                                            <li>
                                                <div class="in"><span>Kích thích bài tiết<br>nước bọt, trong<br>nước bọt có chứa<br>Canxi</span></div>
                                            </li>
                                            <li>
                                                <div class="in"><span>Giúp men răng<br>khỏe không bị<br>ăn mòn</span></div>
                                            </li>
                                            <li>
                                                <div class="in"><span>Thúc đẩy quá trình<br>tái tạo Canxi,<br>răng trở nên<br>chắc khỏe hơn</span></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="transImg sp"><img src="<?php echo APP_ASSETS; ?>img/what/img_canxi_sp.png" alt="Enhances Calcium"></p>
                    </div>
                </div>


            </div>

            <div class="whatSet2">
                <p class="bg">&nbsp;</p>
                <div class="section">
                    <h3 class="bHead">Lịch Sử</h3>
                    <div class="history">
                        <p class="bgline wow fadeIn">&nbsp;</p>
                        <ul>
                            <li class="item2 item2-6">
                                <p class="year wow fadeIn"><span>2025</span></p>
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.4s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/history-122025.png" alt="Ra mắt sản phẩm Lotte Xylitol hương Melon Mint" class="size2"></p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">Tháng 12 <br class="pc">
                                            Ra mắt sản phẩm Lotte Xylitol hương Melon Mint</p>
                                    </div>
                                </div>
                            </li>
                            <li class="item2 item2-1">
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.4s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/history-092025.png" alt="Lotte Xylitol Cool chính thức đổi thành Lotte Xylitol Super Cool" class="size1"></p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">Tháng 9 <br class="pc">
                                            Lotte Xylitol Cool chính thức đổi thành Lotte Xylitol Super Cool</p>
                                    </div>
                                </div>
                            </li>
                            <li class="item2 item2-2">
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.4s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/history-082025.png" alt="Ra mắt sản phẩm Lotte Xylitol Doraemon hương dâu 3g " class="size1"></p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">Tháng 8 <br class="pc">
                                            Ra mắt sản phẩm Lotte Xylitol Doraemon hương dâu 3g </p>
                                    </div>
                                </div>
                            </li>
                            <li class="item2 item2-3">
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.4s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/history-072025.png" alt="Ra mắt dòng sản phẩm Lotte Xylitol cho trẻ em " class="size1"></p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">Tháng 7 <br class="pc">
                                            Ra mắt dòng sản phẩm Lotte Xylitol cho trẻ em </p>
                                    </div>
                                </div>
                            </li>
                            <li class="item2 item2-4">
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.4s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/history-052025.png" alt="Ra mắt sản phẩm Lotte Xylitol Doraemon hương dâu 9g"></p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">Tháng 5 <br class="pc">
                                            Ra mắt sản phẩm Lotte Xylitol Doraemon hương dâu 9g</p>
                                    </div>
                                </div>
                            </li>
                            <li class="item2 item2-4">
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.4s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/history-052025-2.png" alt="Ra mắt sản phẩm Lotte Xylitol Pokémon hương dâu 9g"></p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">Tháng 5 <br class="pc">
                                            Ra mắt sản phẩm Lotte Xylitol Pokémon hương dâu 9g</p>
                                    </div>
                                </div>
                            </li>
                            <li class="item2 item2-5">
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.4s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/keo-gum-khong-duong-lotte-xylitol.png" alt="Ra mắt Kẹo gum không đường Lotte Xylitol hương trái cây hỗn hợp" class="size1"></p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">Tháng 2 <br class="pc">
                                            Ra mắt Kẹo gum không đường Lotte Xylitol hương trái cây hỗn hợp</p>
                                    </div>
                                </div>
                            </li>
                            <li class="item6 item6-1">
                                <p class="year wow fadeIn"><span>2024</span></p>
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">Tháng 10<br class="pc">
                                            Ra mắt LOTTE XYLITOL BlueBerry Mint túi 110 viên.<br class="pc">
                                            Ra mắt LOTTE XYLITOL Cool túi 110 viên.</p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.4s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/img_history19.png" alt="enewal to new design." class="size1"></p>
                                    </div>
                                </div>
                            </li>
                            <li class="item6 item6-2">
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">Tháng 4
                                            <br class="pc">Ra mắt LOTTE XYLITOL Lime Mint túi 110 viên.<br class="pc">LOTTE XYLITOL Lime Mint Bag 110 pcs launched
                                        </p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.4s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/img_history20.png" alt="LOTTE XYLITOL Cool of the greatest refreshing sensation in XYLITOL history released"
                                                class="size1"></p>
                                    </div>
                                </div>
                            </li>
                            <li class="item2">
                                <p class="year wow fadeIn"><span>2021</span></p>
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.4s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/img_history18.png" alt="Ra mắt Kẹo gum LOTTE XYLITOL hương Tắc (Quất) Bạc Hà" class="size1"></p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">Ra mắt Kẹo gum LOTTE XYLITOL <br>hương Dưa Hấu Bạc Hà</p>
                                    </div>
                                </div>
                            </li>
                            <li class="item1">
                                <p class="year wow fadeIn"><span>2020</span></p>
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">Ra mắt Kẹo gum LOTTE XYLITOL <br>hương Tắc (Quất) Bạc Hà</p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.4s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/img_history17.png" alt="Ra mắt Kẹo gum LOTTE XYLITOL hương Tắc (Quất) Bạc Hà" class="size1"></p>
                                    </div>
                                </div>
                            </li>
                            <li class="item11">
                                <p class="year wow fadeIn"><span>2019</span></p>
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.2s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/img_history14.png" alt="Cải tiến mẫu mã và chất lượng" class="size1"></p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.4s">
                                        <p class="text">Cải tiến mẫu mã và chất lượng</p>
                                    </div>
                                </div>
                            </li>
                            <li class="item12">
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.2s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/img_history15.png" alt="Ra mắt viên ngậm LOTTE XYLITOL" class="size1"></p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.4s">
                                        <p class="text">Ra mắt viên ngậm LOTTE XYLITOL</p>
                                    </div>
                                </div>
                            </li>
                            <li class="item1">
                                <p class="year wow fadeIn"><span>2017</span></p>
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">LOTTE XYLITOL Cool thay đổi thiết kế mới</p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.4s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/img_history9.png" alt="LOTTE XYLITOL Cool thay đổi thiết kế mới" class="size1"></p>
                                    </div>
                                </div>
                            </li>
                            <li class="item2">
                                <p class="year wow fadeIn"><span>2016</span></p>
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.2s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/img_history8.png" alt="Nhận chứng nhận VOSA và Halal" class="size2"></p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.4s">
                                        <p class="text">Nhận chứng nhận của Hội Răng Hàm Mặt Việt Nam và chứng nhận Halal</p>
                                    </div>
                                </div>
                            </li>
                            <li class="item3">
                                <p class="year wow fadeIn"><span>2015</span></p>
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">Thay đổi thiết kế mới.</p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.4s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/img_history6.png" alt="Thay đổi thiết kế mới." class="size1"></p>
                                    </div>
                                </div>
                            </li>
                            <li class="item4">
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">Lần đầu tiên ra mắt <br>LOTTE XYLITOL Cool <br>the mát tột đỉnh</p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.4s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/img_history7.png" alt="Lần đầu tiên ra mắt LOTTE XYLITOL Cool the mát tột đỉnh" class="size1"></p>
                                    </div>
                                </div>
                            </li>
                            <li class="item5">
                                <p class="year wow fadeIn"><span>2013</span></p>
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.2s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/img_history10.png" alt="Hương Apple Mint  phát hành." class="size1"></p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">Ra mắt hương Apple Mint<br class="sp"><span class="dis">Ngưng bán vào năm 2015</span></p>
                                    </div>
                                </div>
                            </li>
                            <li class="item6">
                                <p class="year wow fadeIn"><span>2012</span></p>
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">Ra mắt hũ Mini</p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.4s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/img_history16.png" alt="Ra mắt hũ Mini" class="size1"></p>
                                    </div>
                                </div>
                            </li>
                            <li class="item7">
                                <p class="year wow fadeIn"><span>2010</span></p>
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">Ra mắt hương Strawberry Mint</p>
                                    </div>
                                    <div class="colR  wow fadeIn" data-wow-delay="0.4s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/img_history11.png" alt="Hương Strawberry Mint  phát hành." class="size1"></p>
                                    </div>
                                </div>
                            </li>
                            <li class="item9">
                                <p class="year wow fadeIn"><span>2007</span></p>
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.2s">&nbsp;</div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.4s">
                                        <p class="text">Ra mắt các loại bao bì đa dạng: <br class="sp">dạng gói, hũ cầm tay, hũ family...</p>
                                    </div>
                                </div>
                            </li>
                            <li class="item8">
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.2s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/img_history12.png" alt="Hương Fresh Mint phát hành." class="size1"></p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.4s">
                                        <p class="text">Ra mắt hương Fresh Mint</p>
                                    </div>
                                </div>
                            </li>
                            <li class="item10">
                                <p class="year wow fadeIn"><span>2006</span></p>
                                <div>
                                    <div class="colL wow fadeIn" data-wow-delay="0.2s">
                                        <p class="text">Ra mắt kẹo gum LOTTE XYLITOL tại Việt Nam<br>(Hương Lime Mint và Hương Blueberry Mint)</p>
                                    </div>
                                    <div class="colR wow fadeIn" data-wow-delay="0.4s">
                                        <p><img src="<?php echo APP_ASSETS; ?>img/what/img_history13.png" alt="LOTTE XYLITOL GUM phát hành tại Việt Nam (Hương Lime Mint và Hương Blueberry Mint)"
                                                class="size3"></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="whatSet5">
                <p class="bgdot">&nbsp;</p>
                <div class="section wow fadeIn">
                    <p class="leaf"><img src="<?php echo APP_ASSETS; ?>img/common/img_leaf4.png" alt="leaf"></p>
                    <div class="text">
                        <p>Vậy tại sao <br class="sp">Kẹo Gum Lotte Xylitol cần thiết cho bạn?</p>
                    </div>
                    <h3 class="bHead"><a href="<?php echo APP_URL; ?>why-xylitol/"><span>Tại sao chọn XYLITOL?</span></a></h3>
                    <div class="clearfix">
                        <p class="img_bot wow fadeIn" data-wow-delay="0.5s"><img src="<?php echo APP_ASSETS; ?>img/what/img_product1.png" alt=" "></p>
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
    <script src="<?php echo APP_ASSETS; ?>js/wow/wow.js"></script>
    <script src="<?php echo APP_ASSETS; ?>js/slick/slick.js"></script>
    <script>
        $( '.threeCols' ).slick( {
            autoplay: false,
            autoplaySpeed: 3000,
            speed: 800,
            arrows: true,
            dots: false,
            fade: false,
            pauseOnHover: false,
            pauseOnFocus: false,
            pauseOnDotsHover: false,
            centerMode: true,
            centerPadding: '0px',
            slidesToShow: 3,
            variableWidth: false,
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        variableWidth: false,
                    }
                }
            ]
        } );
    </script>
</body>

</html>
