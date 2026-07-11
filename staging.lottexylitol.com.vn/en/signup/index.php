<?php
// Author: A+LIVE
include_once('../../app_config.php');
include(APP_PATH . 'libs/lotte-api.php');

if ($lotte_api->is_logged_in()) {
    header('Location: /en/user');
    exit;
}

include(APP_PATH . 'libs/head.php');
include(APP_PATH . 'libs/lotte-form.php');

$items = $lotte_api->get_surveys();

// $redirect_to = isset($_GET['redirect_to']) ? trim($_GET['redirect_to']) : '/en/activity-page/';
$redirect_to = $lotte_api->get_var('redirect_to', '/en/activity-page/');

?>
</head>

<body id="page-register" class="product bg-bottom-style2">
    <!-- Header
	================================================== -->
    <?php include(APP_PATH . 'libs/header.php'); ?>
    <div id="wrap">
        <!-- Main Content
		================================================== -->
        <main class="main bgmain style1">
            <div class="breadcrumb">
                <ul>
                    <li><a href="/en/">Top</a></li>
                    <li class="white">Member Signup</li>
                </ul>
            </div>
            <div class="section">
                <h1 class="section-title white">Member Signup</h1>
                <div class="signup-desc">
                    Already have an account? Please <a href="/en/signin/<?php echo $redirect_to != '' ? '?redirect_to=' . $redirect_to : '' ?>">Signin</a>
                </div>
                <form class="form-register js-signup-form" data-toggle="validator" role="form">
                    <div class="bg"></div>
                    <img class="visible-lg form-img tooth wow fadeInRight" width="363" src="<?php echo APP_ASSETS; ?>img/register/tooth.png" alt="" />
                    <!-- <img class="visible-lg form-img green wow fadeIn" width="261" src="<?php echo APP_ASSETS; ?>img/register/green.png" alt="" />
					<img class="visible-lg form-img xylitol wow fadeIn" width="543" src="<?php echo APP_ASSETS; ?>img/register/xylitol.png" alt="" /> -->
                    <div class="visible-lg form-img wow fadeIn green lottie-icon" data-src="/assets/json/lemon.json"></div>
                    <div class="visible-lg form-img wow fadeIn xylitol lottie-icon" data-src="/assets/json/product01/product01.json"></div>

                    <div class="form-group">
                        <label for="inputName" class="control-label">Full Name</label>
                        <input type="text" data-field="name" class="form-control" id="inputName" placeholder="Enter your full name" data-error="Please enter full name" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="control-label">Email Address</label>
                        <input type="email" data-field="email" class="form-control" id="inputEmail" placeholder="Please enter a email address" data-error="Invalid email format" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group" id="group-phone">
                        <label for="inputPhone" class="control-label">Phone Number</label>
                        <div class="form-control">
                            <div class="selectbox" id="country-code">
                                <span class="select-text has-value">+84</span>
                                <select required>
                                    <option value="+84">+84</option>
                                </select>
                            </div>
                            <input type="text" data-field="phone" maxlength="10" pattern="[0]{1}[1-9]{1}[0-9]{8}" id="inputPhone" placeholder="Enter your phone number"
                                data-pattern-error="Please enter a valid phone number, 10 digits, starting with 0" data-error="Please enter a valid phone number, 10 digits, starting with 0" required>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <?php if (defined('ISSTG') == false || ISSTG == false) : ?>
                        <!-- <div class="form-group u-hidden" id="phone-verify">
                            <button type="button" class="btn-dark-green js-send-phone-code">Verify Now</button>
                        </div> -->
                    <?php endif ?>
                    <div class="form-group">
                        <label for="inputAddress" class="control-label">Address</label>
                        <input type="text" data-field="address" class="form-control" id="inputAddress" placeholder="Enter your address" data-error="Please enter an address" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group" id="city">
                        <label for="inputCity" class="control-label">Province/City</label>
                        <div class="form-control selectbox" id="inputCity">
                            <span class="select-text">Select your province/city</span>
                            <select data-field="city" required data-error="Please select an city">
                                <?php echo $lotte_form->get_options_html('city', '', '0:Select your province/city'); ?>
                            </select>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <div id="group-gender">
                            <label for="inputGender" class="control-label">Gender</label>
                            <div class="group-radio">
                                <?php
                                $list = $lotte_form->get_options('gender_en');
                                foreach ($list as $value => $label):
                                ?>
                                    <div class="radio">
                                        <input id="radio-<?php echo $value ?>" name="gender" data-field="gender" value="<?php echo $value ?>" type="radio" data-error="Please select your gender" required>
                                        <label for="radio-<?php echo $value ?>" class="radio-label"><?php echo $label ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group" id="age">
                        <label for="inputAge" class="control-label">Age</label>
                        <div class="form-control selectbox" id="inputAge">
                            <span class="select-text">Select your age</span>
                            <select data-field="age" required data-error="Please select your age">
                                <?php echo $lotte_form->get_options_html('age'); ?>
                            </select>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="control-label">Password</label>
                        <div class="input-contain">
                            <div class="icon-visible-password"></div>
                            <input type="password" data-field="password" class="form-control visible-password js-no-space" id="inputPassword" placeholder="Enter a password"
                                data-minlength="8" data-minlength-error="At least 8 characters."
                                data-maxlength="64" data-maxlength-error="Maximum 64 characters."
                                data-error="Please enter a password." required>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="inputRePassword" class="control-label">Confirm Password</label>
                        <div class="input-contain">
                            <div class="icon-visible-password"></div>
                            <input type="password" class="form-control visible-password" id="inputRePassword" data-match="#inputPassword" data-error="Passwords do not match."
                                placeholder="Enter a password" required>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group bd-bottom">
                        <p class="c-green fs-18">It only takes <b class="fs-24">1 minute</b> to complete the survey after completing the survey. 20 luckiest people in every month will randomly have the opportunity to receive 3 bottles of Lotte Xylitol candy and many other gifts are waiting for you.</p>
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
                                                <input type="text" name="<?php echo $input_name ?>" class="form-control" placeholder="Input your answer" <?php echo $item['required'] == 1 ? 'required data-error="Please answer the question '.$item['name'].'"' : '' ?>/>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label class="checkbox">
                            I have read and agreed to Lotte's<a href="/en/terms/" target="_blank"> terms and conditions,</a> and <a href="/en/privacy-policy/" target="_blank">privacy policy</a>
                            <input type="checkbox" name="agree" value="1" required data-field="agree">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="form-group txt-center">
                        <button type="submit" class="bt-green bt-register hover">Signup</button>
                    </div>
                    <div class="form-group group-bottom">
                        <p class="txt-center">Already have an account? Please <a href="/en/signin/<?php echo $redirect_to != '' ? '?redirect_to=' . $redirect_to : '' ?>" class="c-green">Signin</a></p>
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
                <h2 class="popup-title no-line c-green txt-center">Verify Phone Number</h2>
                <form class="form-register js-verify-phone-form" data-toggle="validator" role="form" autocomplete="off">
                    <div class="form-group js-message u-hidden">
                        <p class="text-center c-red">Please enter correct information</p>
                    </div>
                    <div class="form-group">
                        <label for="inputCode" class="control-label">OTP Code</label>
                        <input type="text" data-field="code" class="form-control" id="inputCode" data-error="Please Enter Verification OTP Code" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group txt-center">
                        <button type="submit" class="btn-dark-green hover">Verify</button>
                    </div>
                    <input type="hidden" name="phone" data-field="phone" class="input-phone" value="" />
                </form>
            </div>
        </section>
    <?php endif ?>

    <section id="box-thanks" class="box-thanks box-wellcom">
        <div class="content">
            <h2 class="popup-title no-line c-green txt-center">Thank you <strong class="user-name"></strong> for joining up <br class="u-pc" />as member of Lotte Xyltiol</h2>
            <p class="title-sub">Click to join now to have a chance to receive attractive gifts from Lotte Xylitol!</p>
            <div class="txt-center">
                <img width="710" src="<?php echo APP_ASSETS; ?>img/register/img-popup-2.png" alt="">
            </div>
            <p class="txt-center">
                <a href="<?php echo $redirect_to ?>" class="bt-green">Join now</a>
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
