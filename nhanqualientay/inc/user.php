<?php
defined('APP_PATH') or die();
?>
<link type="text/css" rel="stylesheet" href="<?php echo APP_ASSETS; ?>js/wow/animate.min.css">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
</head>

<body id="user" class="user vn user-must-buy">
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
                    <li>Thông tin cá nhân</li>
                </ul>
            </div>
            <div class="section section-2">
                <h1 class="section-title pc">THÔNG TIN CÁ NHÂN</h1>
                <div class="profile content-josefin-sans">
                    <div class="left">
                        <div class="info">
                            <div class="info-title sp">THÔNG TIN CÁ NHÂN</div>
                            <div class="avt js-avatar-image" data-error="Lưu ảnh mới không thành công" data-success="Lưu ảnh mới thành công">
                                <label for="avatar-image" role="button">
                                    <img src="<?php echo $lotte_api->get_user_field('avatar_url');?>" alt="" />
                                </label>
                                <input type="file" id="avatar-image" class="u-hidden" accept="image/png, image/jpeg" data-accept-error="Vui lòng chọn hình theo định dạng (jpg, png)" data-size-error="Vui lòng chọn hình dưới 1MB"/>
                                <div class="button">
                                    <button class="js-avatar-submit u-hidden btn-change">Lưu ảnh mới</button>
                                </div>
                            </div>
                            <div class="box-gray">
                                <div class="info-title--2"><?php echo $lotte_api->get_user_field('name')?></div>
                                <div class="email-tmp"><?php echo $lotte_api->get_user_field('email')?></div>
                                <div class="other"><span class="gender"><?php echo $lotte_api->get_user_field('gender')?></span> | <span class="age"><?php echo $lotte_api->get_user_field('age')?> tuổi</span></div>
                            </div>
                        </div>
                        <div class="info-other">
                            <p class="info-title--2">Số điện thoại</p>
                            <p class="phone">(+84) <?php echo $lotte_api->get_user_field('phone')?></p>
                            <p class="info-title--2">Địa chỉ</p>
                            <p class="address"><?php echo $lotte_api->get_user_field('address')?></p>
                            <a href="#edit-profile" class="btn-edit-profile edit-profile">Chỉnh sửa thông tin cá nhân</a>
                        </div>
                        <a href="#remove-profile" class="btn-remove-profile remove-profile pc">Bạn muốn xoá tài khoản ?</a>
                    </div>
                    <div class="right">
                        <div class="history u-mb-20 js-history-must-buy">
                            <div class="title">THÔNG TIN TRÚNG THƯỞNG</div>
                            <div class="line"></div>
                            <div class="js-history-must-buy__items">
                                <!-- <div class="content">
                                    <div class="content-des txt-black">Bạn đã trúng <span class="des-survey c-green">Giải Thẻ May Mắn</span></div>
                                </div>
                                <div class="content">
                                    <div class="content-des txt-black">Bạn đã trúng <span class="des-survey c-green">Giải Nhất E-voucher Goit trị giá 200,000 VND</span></div>
                                </div>
                                <div class="content">
                                    <div class="content-des txt-black">Bạn đã trúng <span class="des-survey c-green">Giải Nhì Thẻ cào điện thoại trị giá 20,000 VND</span></div>
                                </div> -->
                            </div>
                        </div>
                        <div class="history js-history">
                            <div class="title">Lịch sử hoạt động</div>
                            <div class="line"></div>
                            <ul class="filter js-history__filter">
                                <!-- <li class="active">2024</li>
                                <li>2023</li> -->
                            </ul>
                            <div class="js-history__items">
                                <!-- <div class="content">
                                    <div class="content-date">23 / 01 / 2024</div>
                                    <div class="content-des txt-black">Làm bài khảo sát <span class="des-survey c-green">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span></div>
                                </div> -->
                            </div>
                            <a href="/membership-activities/" class="btn-dark-green">kiếm quà</a>
                        </div>
                        <?php if(isset($_GET['dev'])) :?>
                        <div class="history u-mt-20">
                            <div class="title">Thời hạn các hoạt động</div>
                            <div class="line"></div>
                            <?php
                                $activities = $lotte_api->get_activity_info();

                                $labels = [
                                    'survey_brand' => 'Đại sứ Lotte Xylitol',
                                    'contest' => 'Cuộc thi hình ảnh',
                                    'game' => 'Giải Cứu Răng Xinh',
                                ];

                                foreach($activities as $name => $value) {
                                    $label  = str_replace('_expires', '', $name);
                                    if(strpos($name, 'expires') > -1 && isset($labels[$label])) {
                                        $day = $value > 0 ? date('Y-m-d', $value) : 'chưa chơi';
                                        $label = $labels[$label];

                                        echo "<p><b class='c-green'>$label</b> : <b class='c-green'>$day</b> ($value) </p>";
                                    }
                                }
                            ?>
                        </div>
                        <?php endif;?>
                    </div>
                    <a href="#remove-profile" class="btn-remove-profile remove-profile sp">Bạn muốn xoá tài khoản?</a>
                </div>
            </div>
        </main>
    </div><!-- #wrap -->

    <!-- Popup -->

    <div id="edit-profile" class="popup-edit">
        <div class="content">
            <h2 class="popup-title c-green txt-center">
                <span>CHỈNH SỬA<br></span>THÔNG TIN CÁ NHÂN
            </h2>
            <form class="form-register js-profile-form" data-toggle="validator" role="form" autocomplete="off">
                <div class="form-group">
                    <label for="inputName" class="control-label">Họ tên</label>
                    <input type="text" data-field="name" class="form-control" id="inputName" value="<?php echo $lotte_api->get_user_field('name')?>" data-error="Vui lòng nhập họ tên" required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Địa chỉ Email</label>
                    <input type="email" data-field="email" class="form-control" id="inputEmail" value="<?php echo $lotte_api->get_user_field('email')?>" data-error="Email chưa đúng định dạng" required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group" id="group-phone">
                    <label for="inputPhone" class="control-label">Số điện thoại</label>
                    <div class="form-control">
                        <div class="selectbox" id="country-code">
                            <span class="select-text has-value">+84</span>
                            <select required>
                                <option value="+84">+84</option>
                            </select>
                        </div>
                        <input type="text" data-field="phone" maxlength="10" pattern="[0]{1}[1-9]{1}[0-9]{8}" id="inputPhone" value="<?php echo $lotte_api->get_user_field('phone')?>" data-pattern-error="vui lòng nhập đúng số điện thoại"
                            data-required-error="Vui lòng nhập số điện thoại" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputAddress" class="control-label">Địa chỉ</label>
                    <input type="text" data-field="address" class="form-control" id="inputAddress" value="<?php echo $lotte_api->get_user_field('address')?>" data-error="Vui lòng chọn giới tính" required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group" id="city">
                    <label for="inputCity" class="control-label">Tỉnh/Thành phố</label>
                    <div class="form-control selectbox" id="inputCity">
                        <span class="select-text has-value"><?php echo $city = $lotte_api->get_user_field('city'); ?></span>
                        <select data-field="city" required data-error="Vui lòng chọn thành phố">
                            <?php echo $lotte_form->get_options_html('city', ['label' => $city], '0:Chọn tỉnh/thành phố của bạn'); ?>
                        </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <div id="group-gender">
                        <label for="inputGender" class="control-label">Giới tính</label>
                        <div class="group-radio">
                            <?php foreach($lotte_form->get_options('gender') as $value => $label) : ?>
                            <div class="radio">
                                <input id="radio-<?php echo $value ?>" name="gender" data-field="gender" value="<?php echo $value ?>" type="radio" data-error="Vui lòng chọn giới tính" required <?php echo $lotte_api->get_user_field('gender') == $label ? 'checked' : '' ?>>
                                <label for="radio-<?php echo $value ?>" class="radio-label"><?php echo $label ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group" id="age">
                    <label for="inputAge" class="control-label">Tuổi</label>
                    <div class="form-control selectbox" id="inputAge">
                        <span class="select-text has-value"><?php echo $age = $lotte_api->get_user_field('age')?></span>
                        <select data-field="age" required data-error="Vui lòng chọn độ tuổi">
                            <?php echo $lotte_form->get_options_html('age', ['label' => $age]); ?>
                        </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputCCCD" class="control-label">CCCD</label>
                    <input type="text" data-field="cccd" class="form-control" id="inputCCCD" value="<?php echo $lotte_api->get_user_field('cccd')?>" data-error="Vui lòng nhập CCCD">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="control-label">MẬT KHẨU HIỆN TẠI</label>
                    <div class="input-contain">
                        <div class="icon-visible-password"></div>
                        <input type="password" data-field="oldpassword" class="form-control visible-password" id="inputPassword" value="Chọn mật khẩu" data-required-error="Vui lòng nhập mật khẩu." required autocomplete="off">
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="control-label">MẬT KHẨU MỚI</label>
                    <div class="input-contain">
                        <div class="icon-visible-password"></div>
                        <input type="password" data-field="newpassword" class="form-control visible-password c-green" id="inputPasswordNew" value="Chọn mật khẩu" data-required-error="Vui lòng nhập mật khẩu." autocomplete="off">
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputRePassword" class="control-label">NHẬP LẠI MẬT KHẨU MỚI</label>
                    <div class="input-contain">
                        <div class="icon-visible-password"></div>
                        <input type="password" class="form-control visible-password c-green" id="inputRePassword" data-match="#inputPasswordNew" data-error="Mật khẩu chưa khớp." value="Chọn mật khẩu" autocomplete="off">
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group txt-center">
                    <button type="submit" class="btn-dark-green hover">LƯU THÔNG TIN</button>
                </div>
                <div class="form-group group-bottom">
                    <div class="c-green txt-center close-popup">Thoát chỉnh sửa thông tin</div>
                </div>
                <input type="hidden" name="redirect_to" class="redirect_to" value="/user/" />
            </form>
        </div>
    </div>

    <div id="remove-profile" class="popup-remove">
        <form class="content js-remove-form">
            <p>Tôi muốn xóa tài khoản bao gồm toàn bộ thông tin cá nhân và các hoạt động của tôi trên website</p>
            <div class="form-group">
                <label for="inputPassword" class="control-label">MẬT KHẨU HIỆN TẠI</label>
                <div class="input-contain">
                    <div class="icon-visible-password"></div>
                    <input type="password" name="<?php echo uniqid() ?>" data-field="password" class="form-control visible-password" id="inputPassword" value="Chọn mật khẩu" data-error="Vui lòng nhập mật khẩu" autocomplete="new password">
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <a class="btn-comfirm-remove js-submit">XÁC NHẬN XÓA TÀI KHOẢN</a>
        </form>
    </div>

    <?php include (APP_PATH . 'libs/popup-error.php'); ?>

    <!-- Footer
    ================================================== -->
    <?php include (APP_PATH . 'libs/footer.php'); ?>
    <!-- End Document
================================================== -->
    <script src="<?php echo APP_ASSETS; ?>js/validator.js"></script>
    <script src="<?php echo APP_ASSETS; ?>js/script.js"></script>
    <script src="<?php echo APP_ASSETS; ?>js/must-buy.js"></script>
</body>

</html>
