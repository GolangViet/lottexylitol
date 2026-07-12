<?php
// Author: A+LIVE
include_once('../app_config.php');
include(APP_PATH . 'libs/lotte-api.php');

if ($lotte_api->is_logged_in()) {
    header('Location: /user');
    exit;
}

include(APP_PATH . 'libs/head.php');
include(APP_PATH . 'libs/lotte-form.php');

$items = $lotte_api->get_surveys();

// $redirect_to = isset($_GET['redirect_to']) ? trim($_GET['redirect_to']) : '/activity-page/';
$redirect_to = $lotte_api->get_var('redirect_to', '/activity-page/');

?>
</head>

<body id="page-register" class="product bg-bottom-style2 vn">
    <!-- Header
	================================================== -->
    <?php include(APP_PATH . 'libs/header.php'); ?>
    <div id="wrap">
        <!-- Main Content
		================================================== -->
        <main class="main bgmain style1">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/">Trang chủ</a></li>
                    <li class="white">Đăng ký</li>
                </ul>
            </div>
            <div class="section">
                <h1 class="section-title white">Đăng ký thành viên</h1>
                <div class="signup-desc">
                    Đã có tài khoản, vui lòng <a href="/signin/<?php echo $redirect_to != '' ? '?redirect_to=' . $redirect_to : '' ?>">Đăng nhập.</a>
                </div>
                <form class="form-register js-signup-form" data-toggle="validator" role="form">
                    <div class="bg"></div>
                    <img class="visible-lg form-img tooth wow fadeInRight" width="363" src="<?php echo APP_ASSETS; ?>img/register/tooth.png" alt="" />
                    <!-- <img class="visible-lg form-img green wow fadeIn" width="261" src="<?php echo APP_ASSETS; ?>img/register/green.png" alt="" />
					<img class="visible-lg form-img xylitol wow fadeIn" width="543" src="<?php echo APP_ASSETS; ?>img/register/xylitol.png" alt="" /> -->
                    <div class="visible-lg form-img wow fadeIn green lottie-icon" data-src="/assets/json/lemon.json"></div>
                    <div class="visible-lg form-img wow fadeIn xylitol lottie-icon" data-src="/assets/json/product01/product01.json"></div>

                    <div class="form-group">
                        <label for="inputName" class="control-label">Họ và tên</label>
                        <input type="text" data-field="name" class="form-control" id="inputName" placeholder="Nhập họ tên của bạn" data-error="Vui lòng nhập họ tên" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="control-label">Địa chỉ Email</label>
                        <input type="email" data-field="email" class="form-control" id="inputEmail" placeholder="Nhập địa chỉ email của bạn" data-error="Email chưa đúng định dạng" required>
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
                            <input type="text" data-field="phone" maxlength="10" pattern="[0]{1}[1-9]{1}[0-9]{8}" id="inputPhone" placeholder="Nhập số điện thoại của bạn"
                                data-pattern-error="Vui lòng nhập đúng số điện thoại, 10 số, bắt đầu bằng số 0" data-error="Vui lòng nhập đúng số điện thoại, 10 số, bắt đầu bằng số 0" required>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <?php if (defined('ISSTG') == false || ISSTG == false) : ?>
                        <!-- <div class="form-group u-hidden" id="phone-verify">
                            <button type="button" class="btn-dark-green js-send-phone-code">Xác thực ngay</button>
                        </div> -->
                    <?php endif ?>
                    <div class="form-group">
                        <label for="inputAddress" class="control-label">Địa chỉ</label>
                        <input
                            required
                            type="text"
                            data-field="address"
                            class="form-control js-trim-space"
                            id="inputAddress"
                            placeholder="Nhập địa chỉ của bạn"
                            data-minlength="1"
                            data-minlength-error="Ít nhất 1 ký tự."
                            data-maxlength="255"
                            data-maxlength-error="Tối đa 255 ký tự."
                            data-error="Vui lòng nhập địa chỉ" />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group" id="city">
                        <label for="inputCity" class="control-label">Tỉnh/Thành phố</label>
                        <div class="form-control selectbox" id="inputCity">
                            <span class="select-text">Chọn tỉnh/thành phố của bạn</span>
                            <select data-field="city" required data-error="Vui lòng chọn thành phố">
                                <?php echo $lotte_form->get_options_html('city', '', '0:Chọn tỉnh/thành phố của bạn'); ?>
                            </select>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <div id="group-gender">
                            <label for="inputGender" class="control-label">Giới tính</label>
                            <div class="group-radio">
                                <?php
                                $list = $lotte_form->get_options('gender');
                                foreach ($list as $value => $label):
                                ?>
                                    <div class="radio">
                                        <input id="radio-<?php echo $value ?>" name="gender" data-field="gender" value="<?php echo $value ?>" type="radio" data-error="Vui lòng chọn giới tính" required>
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
                            <span class="select-text">Chọn độ tuổi của bạn</span>
                            <select data-field="age" required data-error="Vui lòng chọn độ tuổi">
                                <?php echo $lotte_form->get_options_html('age'); ?>
                            </select>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="control-label">Mật khẩu</label>
                        <div class="input-contain">
                            <div class="icon-visible-password"></div>
                            <input type="password" data-field="password" class="form-control visible-password js-no-space" id="inputPassword" placeholder="Nhập mật khẩu"
                                data-minlength="8" data-minlength-error="Tối thiểu 8 ký tự."
                                data-maxlength="64" data-maxlength-error="Tối đa 64 ký tự."
                                data-error="Vui lòng nhập mật khẩu." required>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="inputRePassword" class="control-label">Nhập lại mật khẩu</label>
                        <div class="input-contain">
                            <div class="icon-visible-password"></div>
                            <input type="password" class="form-control visible-password" id="inputRePassword" data-match="#inputPassword" data-error="Mật khẩu chưa khớp."
                                placeholder="Nhập mật khẩu" required>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group bd-bottom">
                        <p class="c-green fs-18">Chỉ mất <b class="fs-24">1 phút</b> để hoàn thành bảng khảo sát để gia nhập làm thành viên của Lotte Xylitol. 20 người may mắn nhất hàng tháng sau khi làm khảo sát sẽ được chọn ngẫu nhiên nhận ngay 3 hũ kẹo Lotte Xylitol và còn nhiều phần quà khác đang chờ đón bạn</p>
                    </div>
                    <?php if (is_array($items) && count($items) > 0) : ?>
                        <div class="form-group list-survey bd-bottom">
                            <?php foreach ($items as $item) : $input_name = $item['id']; ?>
                                <div class="survey-item js-question-item" data-field="<?php echo $input_name; ?>" data-type="<?php echo $item['type'] ?>" data-required="<?php echo $item['required'] ?>" <?php echo isset($item['special']) ? 'data-special="1"' : '' ?> data-error="<?php echo $item['name'] ?>">
                                    <div class="question"><?php echo $item['name']; ?></div>
                                    <div class="answer">
                                        <?php if ($item['type'] == 'radio') : ?>
                                            <div class="group-radio2">
                                                <?php foreach ($item['answers'] as $input) :
                                                    $id = $input_name . '_' . $input['key'];
                                                    $data = isset($input['data']) ? $input['data'] : '';
                                                ?>
                                                    <div class="radio">
                                                        <input type="radio" id="<?php echo $id ?>" name="<?php echo $input_name ?>" value="<?php echo $input['key'] ?>" <?php echo $data != '' ? 'data-value="' . $data . '"' : '' ?> />
                                                        <label for="<?php echo $id ?>" class="radio-label"><?php echo $input['label'] ?></label>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php elseif ($item['type'] == 'checkbox') : ?>
                                            <div class="group-checkbox">
                                                <?php foreach ($item['answers'] as $input) :
                                                    $id = $input_name . '_' . $input['key'];
                                                    $data = isset($input['data']) ? $input['data'] : '';
                                                ?>
                                                    <label class="checkbox<?php echo $data == 'other' ? ' other' : '' ?>">
                                                        <?php echo $input['label'] ?>
                                                        <input type="checkbox" id="<?php echo $id ?>" name="<?php echo $id ?>" value="<?php echo $input['key'] ?>" data-old="<?php echo $input['key'] ?>" <?php echo $data != '' ? 'data-value="' . $data . '"' : '' ?> />
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <?php if ($data == 'other'): ?>
                                                        <div class="form-group input-extra">
                                                            <input type="text" class="form-control js-fill-value" data-target="#<?php echo $id ?>">
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php elseif ($item['type'] == 'input') : ?>
								        <div class="form-group">
                                            <input type="text" name="<?php echo $input_name ?>" class="form-control" placeholder="Nhập câu trả lời của bạn" <?php echo $item['required'] == 1 ? 'required data-error="Vui lòng trả lời câu hỏi"' : '' ?> />
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label class="checkbox">
                            Tôi đã đọc và đồng ý với <a href="/terms/" target="_blank">điều khoản điều kiện</a>, <a href="/privacy-policy/" target="_blank">chính sách bảo mật</a> của Lotte.
                            <input type="checkbox" name="agree" value="1" required data-field="agree">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group txt-center">
                        <button type="submit" class="bt-green bt-register hover">Đăng Ký</button>
                    </div>
                    <div class="form-group group-bottom">
                        <p class="txt-center">Đã có tài khoản, vui lòng <a href="/signin/<?php echo $redirect_to != '' ? '?redirect_to=' . $redirect_to : '' ?>" class="c-green">Đăng nhập.</a></p>
                    </div>
                    <?php
                    foreach ($_GET as $key => $value) {
                        if (substr($key, 0, 4) == 'utm_') {
                            echo '<input type="hidden" data-field="' . $key . '" value="' . trim($value) . '" />' . "\n";
                        }
                    }
                    ?>
                    <input type="hidden" name="code" data-field="code" class="input-code" value="" />
                    <input type="hidden" name="redirect_to" class="redirect_to" value="<?php echo $redirect_to ?>" />
                </form>
            </div>
        </main>
    </div><!-- #wrap -->

    <!-- Popup -->

    <?php if (false) : ?>
        <section id="box-verify-phone" class="box-thanks box-wellcom">
            <div class="content">
                <h2 class="popup-title no-line c-green txt-center">Xác minh số điện thoại</h2>
                <form class="form-register js-verify-phone-form" data-toggle="validator" role="form" autocomplete="off">
                    <div class="form-group js-message u-hidden" data-message="Xác minh số điện thoại thành công!">
                        <p class="text-center c-red"></p>
                    </div>
                    <div class="form-group">
                        <label for="inputCode" class="control-label">Mã xác thực</label>
                        <input type="text" data-field="code" class="form-control" id="inputCode" data-error="Vui lòng nhập mã xác thực" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group txt-center">
                        <button type="submit" class="btn-dark-green hover">XÁC THỰC</button>
                    </div>
                    <input type="hidden" name="phone" data-field="phone" class="input-phone" value="" />
                </form>
            </div>
        </section>
    <?php endif ?>

    <section id="box-thanks" class="box-thanks box-wellcom">
        <div class="content">
            <h2 class="popup-title no-line c-green txt-center">Cám ơn bạn <strong class="user-name"></strong> đã đăng ký <br class="u-pc" />làm thành viên Lotte Xylitol</h2>
            <p class="title-sub">Bấm nút “Tham gia ngay” để có cơ hội nhận các phần quà hấp dẫn.</p>
            <div class="txt-center">
                <img width="710" src="<?php echo APP_ASSETS; ?>img/register/img-popup-2.png" alt="">
            </div>
            <p class="txt-center">
                <a href="<?php echo $redirect_to ?>" class="bt-green">Tham gia ngay</a>
            </p>
        </div>
    </section>

    <?php include(APP_PATH . 'libs/popup-error.php'); ?>

    <!-- Footer
	================================================== -->
    <?php include(APP_PATH . 'libs/footer.php'); ?>
    <!-- End Document
================================================== -->
    <script src="<?php echo APP_ASSETS; ?>js/validator.js?v=<?php echo filemtime(APP_PATH . '/assets/js/validator.js') ?>"></script>
    <script src="<?php echo APP_ASSETS; ?>js/lottie.js"></script>
    <script src="<?php echo APP_ASSETS; ?>js/script.js?v=<?php echo filemtime(APP_PATH . '/assets/js/script.js') ?>"></script>
</body>

</html>
