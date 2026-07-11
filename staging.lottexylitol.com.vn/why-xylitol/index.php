<?php
// Author: A+LIVE
include_once('../app_config.php');
include(APP_PATH . 'libs/head.php');
?>
<script src="<?php echo APP_ASSETS ?>js/lib/jquery-ui.js"></script>
<script src="<?php echo APP_ASSETS ?>js/lib/jquery.ui.touch-punch.min.js"></script>
<script>
    var i = 1;
    function zoomin ()
    {
        i++;
        var myImg = document.getElementById( "mapClick" );
        myImg.style.transform = "scale(" + i + ")";
        if ( i > 1 ) $( "#mapClick" ).draggable();
    }
    function zoomout ()
    {
        if ( i > 1 ) {
            i--;
            var myImg = document.getElementById( "mapClick" );
            myImg.style.transform = "scale(" + i + ")";
        }
    }
</script>
</head>

<body id="why" class='why subpage vn'>
    <!-- Header
    ================================================== -->
    <?php include(APP_PATH . 'libs/header.php'); ?>


    <div id="wrap">
        <!-- Main Content
        ================================================== -->
        <main class="bgmain">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li>Tại sao chọn XYLITOL?</li>
                </ul>
            </div>
            <section class="whyBlock">
                <!-- start lead -->
                <div class="lead">
                    <img src="<?php echo APP_ASSETS; ?>img/why/ico_mint1.png" alt="" class="iconMint wow fadeInLeft" data-wow-delay="0.5s">
                    <img src="<?php echo APP_ASSETS; ?>img/why/ico_mint2.png" alt="" class="iconMint2 wow fadeInRight" data-wow-delay="0.7s">
                    <h1 class="bHead wow fadeIn" data-wow-delay="0s">Tại sao chọn XYLITOL?</h1>
                    <h2 class="wow fadeIn" data-wow-delay="0.2s">Xylitol được khuyến khích bởi <br class="sp">các Hiệp Hội Nha Khoa.</h2>
                    <p class="wow fadeIn" data-wow-delay="0.4s">Chính phủ Phần Lan khuyến khích sử dụng Xylitol từ thập niên 70.<br>
                        Tổ chức các buổi giảng dạy cơ chế của Xylitol ở nhà trẻ và trường học.<br>
                        Cung cấp Xylitol cho nhà trẻ, trường học, phòng khám nha khoa…<br>
                        Tỉ lệ răng sâu, răng rụng và răng trám ở mỗi độ tuổi đã giảm dần qua các năm.</p>
                </div>
                <!-- end lead -->

                <!-- start chart -->
                <section class="chart wow fadeIn">
                    <span class="bgDotted wow fadeInRight"></span>
                    <!-- <span class="bgChart wow fadeInLeft" data-wow-delay="0.3s"></span> -->
                    <div class="chartImg">
                        <div class="chartInfo">
                            <div>
                                <p><img src="<?php echo APP_ASSETS; ?>img/why/img_chart.svg"
                                        alt="Nordblad A ym . Suun terveydenhuoltoa terveyskeskuksissa 1970-luvulta vuoteen 2000 . Stakes, Raportteja 278 , Helsinki 2004." class="pc">
                                    <img src="<?php echo APP_ASSETS; ?>img/why/img_chart_sp.svg"
                                        alt="Nordblad A ym . Suun terveydenhuoltoa terveyskeskuksissa 1970-luvulta vuoteen 2000 . Stakes, Raportteja 278 , Helsinki 2004." class="sp">
                                </p>
                                <p>
                                    <span class="pin orange pin1"><i>12.3 at 1975</i></span>
                                    <span class="pin orange pin2"><i>8.0 at 1982</i></span>
                                    <span class="pin orange pin3"><i>6.3 at 1985</i></span>
                                    <span class="pin orange pin4"><i>4.7 at 1988</i></span>
                                    <span class="pin orange pin5"><i>3.0 at 1991</i></span>
                                    <span class="pin orange pin6"><i>2.8 at 1994</i></span>
                                    <span class="pin orange pin7"><i>2.6 at 1997</i></span>
                                    <span class="pin orange pin8"><i>2.5 at 2000</i></span>

                                    <span class="pin green1 pin1"><i>11.5 at 1975</i></span>
                                    <span class="pin green1 pin2"><i>10.0 at 1982</i></span>
                                    <span class="pin green1 pin3"><i>8.5 at 1985</i></span>
                                    <span class="pin green1 pin4"><i>5.4 at 1988</i></span>
                                    <span class="pin green1 pin5"><i>4.7 at 1991</i></span>
                                    <span class="pin green1 pin6"><i>3.9 at 1994</i></span>
                                    <span class="pin green1 pin7"><i>3.7 at 1997</i></span>
                                    <span class="pin green1 pin8"><i>3.7 at 2000</i></span>

                                    <span class="pin green2 pin1"><i>7.0 at 1975</i></span>
                                    <span class="pin green2 pin2"><i>4.0 at 1982</i></span>
                                    <span class="pin green2 pin3"><i>3.0 at 1985</i></span>
                                    <span class="pin green2 pin4"><i>2.0 at 1988</i></span>
                                    <span class="pin green2 pin5"><i>1.0 at 1991</i></span>
                                    <span class="pin green2 pin6"><i>1.2 at 1994</i></span>
                                    <span class="pin green2 pin7"><i>1.3 at 1997</i></span>
                                    <span class="pin green2 pin8"><i>1.5 at 2000</i></span>

                                    <span class="pin pink pin1"><i>5.0 at 1975</i></span>
                                    <span class="pin pink pin2"><i>2.7 at 1982</i></span>
                                    <span class="pin pink pin3"><i>2.1 at 1985</i></span>
                                    <span class="pin pink pin4"><i>1.8 at 1988</i></span>
                                    <span class="pin pink pin5"><i>1.4 at 1991</i></span>
                                    <span class="pin pink pin6"><i>1.0 at 1994</i></span>
                                    <span class="pin pink pin7"><i>0.9 at 1997</i></span>
                                    <span class="pin pink pin8"><i>1.0 at 2000</i></span>

                                    <span class="pin yellow pin1"><i>3.6 at 1975</i></span>
                                    <span class="pin yellow pin2"><i>1.9 at 1982</i></span>
                                    <span class="pin yellow pin3"><i>1.2 at 1985</i></span>
                                    <span class="pin yellow pin4"><i>0.8 at 1988</i></span>
                                    <span class="pin yellow pin5"><i>0.7 at 1991</i></span>
                                    <span class="pin yellow pin6"><i>0.6 at 1994</i></span>
                                    <span class="pin yellow pin7"><i>0.5 at 1997</i></span>
                                    <span class="pin yellow pin8"><i>0.4 at 2000</i></span>

                                    <span class="pin blue pin1"><i>2.0 at 1975</i></span>
                                    <span class="pin blue pin2"><i>0.8 at 1982</i></span>
                                    <span class="pin blue pin3"><i>0.7 at 1985</i></span>
                                    <span class="pin blue pin4"><i>0.5 at 1988</i></span>
                                    <span class="pin blue pin5"><i>0.4 at 1991</i></span>
                                    <span class="pin blue pin6"><i>0.3 at 1994</i></span>
                                    <!-- <span class="pin blue pin7"><i>8.0 at 1997</i></span>
                                <span class="pin blue pin8"><i>8.0 at 2000</i></span> -->

                                    <span class="pin green3 pin1"><i>1.4 at 1975</i></span>
                                    <span class="pin green3 pin2"><i>0.2 at 1982</i></span>
                                    <span class="pin green3 pin3"><i>0.2 at 1985</i></span>
                                    <span class="pin green3 pin4"><i>0.2 at 1988</i></span>
                                    <span class="pin green3 pin5"><i>0.2 at 1991</i></span>
                                    <span class="pin green3 pin6"><i>0.2 at 1994</i></span>
                                    <span class="pin green3 pin7"><i>0.2 at 1997</i></span>
                                    <span class="pin green3 pin8"><i>0.2 at 2000</i></span>
                                </p>
                            </div>
                        </div>
                        <p class="sp"><img src="<?php echo APP_ASSETS; ?>img/why/txt_chart_sp.svg" alt="" class="wow fadeInLeft" data-wow-delay="1s"></p>
                        <p class="txt wow fadeIn" data-wow-delay="1s">Nordblad A ym . Suun terveydenhuoltoa terveyskeskuksissa 1970-luvulta vuoteen 2000 . <br>
                            Stakes, Raportteja 278 , Helsinki 2004.</p>
                    </div>
                </section>
                <!-- end chart -->


                <!-- start problem -->
                <section class="problem">
                    <span class="bg bg-2 wow fadeInRight" data-wow-delay="1s"></span>
                    <div class="chart wow fadeIn">
                        <h2 class="chart-tlt wow fadeIn" data-wow-delay="0.2s">XYLITOL<br>không tạo ra axit</h2>
                        <div class="chartImg">
                            <div class="chartInfo">
                                <div>
                                    <p><img src="<?php echo APP_ASSETS; ?>img/why/img_chart.jpg"
                                            alt="Nordblad A ym . Suun terveydenhuoltoa terveyskeskuksissa 1970-luvulta vuoteen 2000 . Stakes, Raportteja 278 , Helsinki 2004."></p>
                                </div>
                            </div>
                            <p class="img-sub wow fadeIn" data-wow-delay="1s">Trong tất cả các loại rượu đường, Xylitol có khả năng tạo ra axit thấp nhất</p>
                        </div>
                    </div>
                    <div class="inner box-acid">
                        <ul class="promotionList">
                            <li class="clearfix wow fadeIn reverse" data-wow-delay="0.5s">
                                <div class="thumb">
                                    <img src="<?php echo APP_ASSETS; ?>img/why/img_photo1.jpg" alt="Heart Disease/Stroke Risk">
                                    <div class="img-sub">Bề mặt răng bình thường</div>
                                </div>
                                <div class="desc">
                                    <p class="tlt">Xylitol không tạo ra axit</p>
                                    <p class="txt">Thông thường, mảng bám trên bề mặt răng được tạo thành từ khoảng 10-15% vi khuẩn tốt (streptococci mutans không nhạy cảm với Xylitol) và khoảng 85-90% vi khuẩn xấu (streptococci mutans nhạy cảm với Xylitol).<br>
                                    Khi có mảnh vụn thức ăn hoặc đường trong miệng, vi khuẩn có hại sẽ ăn vào và tạo ra axit. Axit này là nguyên nhân gây sâu răng. Những vi khuẩn xấu này tích trữ năng lượng và sinh sôi, giải phóng một chất dính bám chặt vào bề mặt răng.<br>
                                    Điều này khiến chúng khó loại bỏ ngay cả khi dùng bàn chải đánh răng. Vi khuẩn tốt không tiết ra chất dính.<br>
                                    Điều này giúp chúng dễ dàng được loại bỏ bằng bàn chải đánh răng và ít gây sâu răng hơn.<br>
                                    </p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn padding" data-wow-delay="0.5s">
                                <div class="thumb">
                                    <img src="<?php echo APP_ASSETS; ?>img/why/img_photo2.jpg" alt="Increase the Risk of Dementia">
                                    <div class="img-sub">Bề mặt răng có vi khuẩn ăn Xylitol</div>
                                </div>
                                <div class="desc">
                                    <p class="txt">
                                    Khi có Xylitol, vi khuẩn xấu sẽ cố gắng ăn nó và tạo ra axit giống như cách chúng làm với các loại đường khác, nhưng không thể làm được như vậy.<br>
                                    Cuối cùng, chúng bài tiết ra Xylitol mà chúng ăn vào.<br>
                                    Tuy nhiên, vi khuẩn xấu sau đó sẽ hấp thụ Xylitol sau khi nó được bài tiết ra ngoài. <br>
                                    Trong trường hợp này, Xylitol không cung cấp năng lượng cho vi khuẩn có hại.<br>
                                    Thay vào đó, chúng tiêu thụ năng lượng và số lượng của chúng giảm đi. Vi khuẩn tốt không ăn Xylitol. Vì vậy, chúng không tiêu tốn năng lượng và số lượng của chúng tăng dần.
                                    </p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn reverse" data-wow-delay="0.5s">
                                <div class="thumb">
                                    <img src="<?php echo APP_ASSETS; ?>img/why/img_photo3.jpg" alt="Respiratory Disease">
                                    <div class="img-sub">Vi khuẩn trên bề mặt răng của người thường xuyên ăn Xylitol</div>
                                </div>
                                <div class="desc">
                                    <p class="txt">Nếu bạn tiếp tục ăn Xylitol ba lần một ngày sau bữa ăn, hầu hết vi khuẩn trên răng sẽ trở thành vi khuẩn tốt.<br>
                                    Có báo cáo cho rằng nếu bạn tiếp tục ăn Xylitol (trong hơn hai tuần), khoảng 75-83% vi khuẩn sẽ trở thành vi khuẩn tốt. Lượng vi khuẩn có lợi tăng lên ít có khả năng gây sâu răng và có thể dễ dàng loại bỏ bằng bàn chải đánh răng. Điều này cũng làm giảm lượng mảng bám trên bề mặt răng.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="inner dentalHealth">
                        <div class="txtLead">
                            <span class="leaf7 leaf wow fadeInUp" data-wow-delay="0.7s"><img src="<?php echo APP_ASSETS; ?>img/why/bg_leaf7.png" alt="leaf"></span>
                            <h2 class="wow fadeIn" data-wow-delay="0.5s">Nếu bạn không chăm sóc sức khoẻ răng miệng,<br>sức khoẻ của bạn sẽ ra sao?</h2>
                            <p class="txt wow fadeIn" data-wow-delay="1s">Chăm sóc sức khỏe răng miệng không chỉ có ý nghĩa với răng, nướu và hơi thở mà còn tác động <br class="pc">đến nhiều vấn đề sức khỏe khác bên trong cơ thể. Sức khỏe răng miệng kém có thể dẫn đến một <br class="pc">loạt vấn đề nha khoa và các bệnh khác mà bạn có thể không nhận ra.</p>
                        </div>
                        <ul class="promotionList">
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <div class="thumb">
                                    <img src="<?php echo APP_ASSETS; ?>img/why/img_photo5.jpg" alt="Heart Disease/Stroke Risk">
                                </div>
                                <div class="desc">
                                    <h3 class="wow fadeIn">Bệnh Tim/Đột Quỵ</h3>
                                    <p class="txt">Những người mắc bệnh nha chu có gấp đôi nguy cơ bị bệnh tim và hẹp động mạch do vi khuẩn và mảng bám thâm nhập vào máu thông qua nướu răng. Các vi khuẩn này có chứa một loại protein làm tăng huyết khối có thể gây nghẽn động mạch và tăng nguy cơ dẫn đến đau tim. Số lượng vi khuẩn gây bệnh tăng cao sẽ dẫn đến tắc nghẽn động mạch cảnh cung cấp máu đến não và vùng đầu, nguyên nhân chính gây ra đột quỵ.</p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <div class="thumb">
                                    <img src="<?php echo APP_ASSETS; ?>img/why/img_photo6.jpg" alt="Increase the Risk of Dementia">
                                </div>
                                <div class="desc">
                                    <h3 class="wow fadeIn">Tăng Nguy Cơ Mất Trí Nhớ</h3>
                                    <p class="txt">Răng rụng do sức khỏe răng miệng kém là một trong những nguyên nhân gây mất trí nhớ và là dấu hiệu của bệnh Alzheimer. Một nghiên cứu về “các chức năng của bộ não và hành vi” cho thấy sự nhiễm trùng nướu sẽ giúp giải phóng các chất có khả năng gây viêm não và tiêu diệt các tế bào thần kinh.</p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <div class="thumb">
                                    <img src="<?php echo APP_ASSETS; ?>img/why/img_photo7.jpg" alt="Respiratory Disease">
                                </div>
                                <div class="desc">
                                    <h3 class="wow fadeIn">Bệnh Đường Hô Hấp</h3>
                                    <p class="txt">Một nghiên cứu được công bố trên tạp chí Journal of Periodontology cho thấy vi khuẩn từ bệnh nha chu sau khi thâm nhập vào máu sẽ tấn công phổi và phế quản. Đặc biệt những người có tiền sử bệnh hô hấp thì nguy cơ mắc bệnh lại sẽ càng cao hơn.</p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <div class="thumb">
                                    <img src="<?php echo APP_ASSETS; ?>img/why/img_photo4.jpg" alt="Respiratory Disease">
                                </div>
                                <div class="desc">
                                    <h3 class="wow fadeIn">Bệnh Đường Sinh Sản</h3>
                                    <p class="txt">Nam giới mắc bệnh nha chu có khả năng bị rối loạn cương gấp 7 lần so với nam giới chăm sóc tốt sức khỏe răng miệng. Đối với nữ giới đang mang thai, nhiễm trùng nướu có thể dẫn đến nhiễm trùng máu và tăng nguy cơ sinh non. Một nghiên cứu được trình bày tại Hiệp hội Sinh sản và Phôi học Châu Âu còn cho thấy rằng những phụ nữ mắc bệnh nướu răng cần trung bình bảy tháng để thụ thai, trong khi những người không mắc bệnh về nướu chỉ mất trung bình 5 tháng.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>
                <!-- end problem -->


                <!-- start tips -->
                <section class="tips">
                    <span class="bg wow fadeInLeft" data-wow-delay="0.5s"></span>
                    <div class="inner">
                        <div class="txtLead">
                            <span class="leaf1 leaf wow fadeInUp" data-wow-delay="0.5s"><img src="<?php echo APP_ASSETS; ?>img/why/bg_leaf4.png" alt="leaf"></span>
                            <span class="leaf2 leaf wow fadeInUp" data-wow-delay="0.7s"><img src="<?php echo APP_ASSETS; ?>img/why/bg_leaf6.png" alt="leaf"></span>
                            <span class="leaf3 leaf wow fadeInUp" data-wow-delay="0.9s"><img src="<?php echo APP_ASSETS; ?>img/why/bg_leaf5.png" alt="leaf"></span>
                            <h2 class="wow fadeInUp" data-wow-delay="1s">Bí quyết chăm sóc răng miệng</h2>
                            <p class="txt wow fadeInUp" data-wow-delay="1.3s">Việc chăm sóc răng miệng tốt sẽ giúp bạn thêm tự tin trong giao tiếp hàng ngày,<br> và đó cũng là bí quyết để bạn luôn tự
                                tin tỏa sáng mọi lúc mọi nơi.</p>
                        </div>

                        <ul class="promotionList">
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_pic1.jpg" alt="01. Proper Brushing"></p>
                                <div class="desc">
                                    <h3><span class="clearfix">01.</span><em>Chải Răng Đúng Cách</em></h3>
                                    <p class="txt">Khi đánh răng, bạn cần đặt lông bàn chải nghiêng 45 độ so với nướu và bề mặt răng. Động tác chải cần được thực hiện nhẹ nhàng theo chiều từ trên
                                        xuống dưới để tránh gây chảy máu chân răng. Cuối cùng, bạn đừng quên chải bề mặt lưỡi và vòm họng nhằm loại bỏ các vi khuẩn khiến hơi thở có mùi. Hãy cố gắng
                                        đánh răng ít nhất 2 lần mỗi ngày để ngăn ngừa sự hình thành axit từ thức ăn bị phân hủy do vi khuẩn. Nếu không có thời gian chải răng vì công việc bận rộn, cách
                                        đơn giản nhất là súc miệng với nước sạch ngay sau khi ăn để giảm bớt lượng thức ăn thừa còn tồn đọng trên bề mặt và kẽ răng.</p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_pic2.jpg" alt="02. Do Flossing"></p>
                                <div class="desc">
                                    <h3><span class="clearfix">02.</span><em>Dùng Chỉ Nha Khoa</em></h3>
                                    <p class="txt">Việc chải răng và dùng nước súc miệng không thể giúp loại bỏ hết các mảng thức ăn thừa còn bám lại ở những vị trí khó chải như kẽ răng và mặt sau của
                                        răng. Chỉ nha khoa là một giải pháp tối ưu giúp bạn làm sạch răng hoàn toàn, tuy nhiên lại thường bị bỏ qua do chúng ta sợ mất thời gian và tốn thêm chi phí.
                                        Nếu bạn đã hiểu rõ tác dụng của chỉ nha khoa, hãy dùng ít nhất một lần mỗi ngày ngay sau khi đánh răng để đạt được hiệu quả cao nhất.</p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_pic3.jpg" alt="03. Avoid Tobacco"></p>
                                <div class="desc">
                                    <h3><span class="clearfix">03.</span><em>Không Hút Thuốc Lá</em></h3>
                                    <p class="txt">Tránh xa khỏi thuốc lá sẽ giúp bạn tránh khỏi nguy cơ bị ung thư vòm họng và các biến chứng nha chu. Đồng thời răng bạn cũng không phải chịu tác dụng
                                        phụ của những chất giúp khử mùi hôi thuốc lá như kẹo, trà hay cà phê, vốn dĩ là nguyên nhân gây vàng răng, ố răng và tăng nguy cơ sâu răng nếu sử dụng thường
                                        xuyên.</p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_pic4.jpg" alt="04. Limit Alcohol, Sodas and Coffee"></p>
                                <div class="desc">
                                    <h3><span class="clearfix">04.</span><em>Hạn Chế Thức Uống Có Cồn, Soda Và Cà Phê</em></h3>
                                    <p class="txt">Mặc dù các loại đồ uống này chứa lượng phốt-pho cao, một khoáng chất cần thiết cho răng khỏe mạnh, nhưng quá nhiều phốt-pho có thể làm cạn kiệt mức
                                        canxi của cơ thể. Điều này gây ra vấn đề về răng miệng như sâu răng và bệnh nướu răng. Bên cạnh đó, chất saccharose và màu thực phẩm trong các loại nước giải
                                        khát này có thể làm cho răng màu trắng ngọc xuất hiện màu trắng đục và xỉn màu trong một thời gian rất ngắn khi sử dụng liên tục.</p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_pic5.jpg" alt="05. Fortify Calcium, Vitamins and Minerals That Are Good For Teeth"></p>
                                <div class="desc">
                                    <h3><span class="clearfix">05.</span><em>Bổ Sung Canxi, Vitamin & Các Chất Có Lợi Cho Răng</em></h3>
                                    <p class="txt">Canxi cần thiết cho răng cũng tương tự như cho xương. Bạn có thể uống sữa, ăn các chế phẩm từ sữa như ya-ua, phô mai hoặc sử dụng thực phẩm bổ sung
                                        có chứa canxi phù hợp với độ tuổi và nhu cầu thực tế của cơ thể. Canxi, Vitamin D, Đồng, Kẽm, Iốt, Sắt và Kali là những chất cần thiết cho sức khỏe của nướu và
                                        răng, trong khi đó Vitamin B giúp bảo vệ nướu và chân răng khỏi bị nứt nẻ và chảy máu.</p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_pic6.jpg" alt="06. Drink Enough Water"></p>
                                <div class="desc">
                                    <h3><span class="clearfix">06.</span><em>Uống Đủ Nước</em></h3>
                                    <p class="txt">Giữ ẩm cho khoang miệng là rất quan trọng vì miệng khô là môi trường lý tưởng cho các mảng bám phát triển, nguyên nhân chính gây ra sâu răng và các
                                        bệnh về nướu. Các tác nhân gây khô miệng gồm có hút thuốc, uống rượu bia, cà phê và đặc biệt là các loại thuốc không được kê đơn. Việc uống nhiều nước sẽ giúp
                                        giữ ẩm cho khoang miệng, kích thích hoạt động của nước bọt giúp hỗ trợ tiêu hóa, đẩy lùi vi khuẩn và ngăn ngừa sâu răng.</p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_product1.png" alt="07. Use Xylitol Products" style="margin-left: auto;margin-right: auto; width: 50%;">
                                </p>
                                <div class="desc">
                                    <h3><span class="clearfix">07.</span><em>Sử Dụng Các Sản Phẩm Có Chứa Xylitol</em></h3>
                                    <p class="txt">Xylitol giúp làm giảm sự phát triển mảng bám trên bề mặt răng, nguyên nhân chính gây sâu răng. Công dụng ngăn ngừa sâu răng của các sản phẩm có chứa
                                        Xylitol như kẹo gum, kem đánh răng… đã được chứng thực ở nhiều quốc gia trên thế giới với tỉ lệ người bị sâu răng giảm đáng kể sau thời gian dài sử dụng.</p>
                                </div>
                            </li>
                            <li class="clearfix wow fadeIn" data-wow-delay="0.5s">
                                <p class="thumb"><img src="<?php echo APP_ASSETS; ?>img/why/img_pic8.jpg" alt="08. Visit Your Dentist"></p>
                                <div class="desc">
                                    <h3><span class="clearfix">08.</span><em>Kiểm Tra Răng Định Kỳ</em></h3>
                                    <p class="txt">Hãy đến các phòng khám nha khoa để kiểm tra sức khỏe răng miệng toàn diện ít nhất 2 lần mỗi năm. Các xét nghiệm chuyên sâu và chụp X-Quang có thể
                                        giúp bạn phát hiện sớm nguy cơ gây sâu răng để phòng ngừa từ giai đoạn phát triển bệnh đầu tiên.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>
                <!-- end tips -->

                <section class="voice">
                    <span class="bg wow fadeIn" data-wow-delay="0.7s"></span>
                    <div class="inner clearfix">
                        <div class="desc wow fadeIn" data-wow-delay="1s">
                            <p>Việc chăm sóc răng miệng tốt sẽ giúp bạn thêm tự tin trong giao tiếp hàng ngày, và đó cũng là bí quyết để bạn luôn tự tin tỏa sáng mọi lúc mọi nơi.</p>
                            <p>Vì vậy, luôn giữ cho răng của bạn khoẻ mạnh với <br>KẸO GUM NHA KHOA LOTTE XYLITOL.</p>
                        </div>
                        <p class="img wow fadeIn" data-wow-delay="1s"><img src="<?php echo APP_ASSETS; ?>img/why/product_lime_mint_mv.png"
                                alt="When you have a good oral health, you are confident in your daily communication also you are confident to shine."></p>
                    </div>
                </section>


            </section>
        </main>

    </div><!-- #wrap -->

    <!-- Footer
    ================================================== -->
    <?php include(APP_PATH . 'libs/footer.php'); ?>
    <script src="<?php echo APP_ASSETS; ?>js/top.js"></script>
    <script>
        $( window ).bind( "load resize", function ()
        {
            if ( $( window ).innerWidth() > 1280 ) {
                var w = Math.max( document.documentElement.clientWidth, window.innerWidth || 0 );
                var wVoice = ( w - 1280 ) / 6;
                // $( '.voice' ).css( 'margin-bottom', -( 200 + wVoice ) );
            }
            if ( $( window ).innerWidth() > 1500 ) {
                var problemDotted = -( 130 + ( ( w - 1500 ) / 6 ) );
                $( '.problem .bgDotted' ).css( 'top', problemDotted );
            }
        } );
        $( window ).bind( "load", function ()
        {
            if ( $( window ).innerWidth() < 1280 ) {
                setTimeout( function ()
                {
                    $( '.chart' ).css( 'visibility', 'visible' );
                }, 1000 );
            }
            if ( $( window ).innerWidth() > 1280 ) {
                setTimeout( function ()
                {
                    $( '.chart' ).css( 'visibility', 'visible' );
                }, 2000 );
            }
        } );
    </script>

    <!-- End Document
================================================== -->
</body>

</html>