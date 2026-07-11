<?php
defined('APP_PATH') or die();
?>
<link type="text/css" rel="stylesheet" href="<?php echo APP_ASSETS; ?>js/wow/animate.min.css">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
</head>

<body id="user" class="user en user-must-buy">
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
                    <li>Profile</li>
                </ul>
            </div>
            <div class="section section-2">
                <h1 class="section-title pc">Profile</h1>
                <div class="profile content-josefin-sans">
                    <div class="left">
                        <div class="info">
                            <div class="info-title sp">Profile</div>
                            <div class="avt js-avatar-image" data-error="Save failed" data-success="Saved successfully">
                                <label for="avatar-image" role="button">
                                    <img src="<?php echo $lotte_api->get_user_field('avatar_url');?>" alt="" />
                                </label>
                                <input type="file" id="avatar-image" class="u-hidden" accept="image/png, image/jpeg" data-accept-error="Please choose image (jpg, png)" data-size-error="Please choose an image under 1MB"/>
                                <div class="button">
                                    <button class="js-avatar-submit u-hidden btn-change">Save</button>
                                </div>
                            </div>
                            <div class="box-gray">
                                <div class="info-title--2"><?php echo $lotte_api->get_user_field('name')?></div>
                                <div class="email-tmp"><?php echo $lotte_api->get_user_field('email')?></div>
                                <div class="other"><span class="gender"><?php echo $lotte_api->get_user_field('gender')?></span> | <span class="age"><?php echo $lotte_api->get_user_field('age')?> age</span></div>
                            </div>
                        </div>
                        <div class="info-other">
                            <p class="info-title--2">Phone Number</p>
                            <p class="phone">(+84) <?php echo $lotte_api->get_user_field('phone')?></p>
                            <p class="info-title--2">Address</p>
                            <p class="address"><?php echo $lotte_api->get_user_field('address')?></p>
                            <a href="#edit-profile" class="btn-edit-profile edit-profile">Edit Profile</a>
                        </div>
                        <a href="#remove-profile" class="btn-remove-profile remove-profile pc">Do you want to delete your account?</a>
                    </div>
                    <div class="right">
                        <div class="history u-mb-20 js-history-must-buy">
                            <div class="title">Winning Information</div>
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
                            <div class="title">Activity History</div>
                            <div class="line"></div>
                            <ul class="filter js-history__filter"></ul>
                            <div class="js-history__items"></div>
                            <a href="/en/membership-activities/" class="btn-dark-green">Earn Rewards</a>
                        </div>
                    </div>
                    <a href="#remove-profile" class="btn-remove-profile remove-profile sp">Do you want to delete your account?</a>
                </div>
            </div>
        </main>
    </div><!-- #wrap -->

    <!-- Popup -->

    <div id="edit-profile" class="popup-edit">
        <div class="content">
            <h2 class="popup-title c-green txt-center">
                <span>edit<br></span>profile
            </h2>
            <form class="form-register js-profile-form" data-toggle="validator" role="form" autocomplete="off">
                <div class="form-group">
                    <label for="inputName" class="control-label">Full Name</label>
                    <input type="text" data-field="name" class="form-control" id="inputName" value="<?php echo $lotte_api->get_user_field('name')?>" data-error="Please enter full name" required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Email Address</label>
                    <input type="email" data-field="email" class="form-control" id="inputEmail" value="<?php echo $lotte_api->get_user_field('email')?>" data-error="Invalid email format" required>
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
                        <input type="text" data-field="phone" maxlength="10" pattern="[0]{1}[1-9]{1}[0-9]{8}" id="inputPhone" value="<?php echo $lotte_api->get_user_field('phone')?>" data-pattern-error="Please enter a phone number"
                            data-required-error="Please enter a phone number" required>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputAddress" class="control-label">Address</label>
                    <input type="text" data-field="address" class="form-control" id="inputAddress" value="<?php echo $lotte_api->get_user_field('address')?>" data-error="Please enter an address" required>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group" id="city">
						<label for="inputCity" class="control-label">Province/City</label>
						<div class="form-control selectbox" id="inputCity">
							<span class="select-text has-value"><?php echo $city = $lotte_api->get_user_field('city')?></span>
							<select data-field="city" required data-error="Please select an city">
                                <?php echo $lotte_form->get_options_html('city', ['label' => $city], '0:Select your province/city'); ?>
							</select>
						</div>
						<div class="help-block with-errors"></div>
					</div>
                <div class="form-group">
                    <div id="group-gender">
                        <label for="inputGender" class="control-label">Gender</label>
                        <div class="group-radio">
                            <?php foreach($lotte_form->get_options('gender_en') as $value => $label) : ?>
                            <div class="radio">
                                <input id="radio-<?php echo $value ?>" name="gender" data-field="gender" value="<?php echo $value ?>" type="radio" data-error="Please select gender" required <?php echo $lotte_api->get_user_field('gender') == $label ? 'checked' : '' ?>>
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
                        <span class="select-text has-value"><?php echo $age = $lotte_api->get_user_field('age')?></span>
                        <select data-field="age" required data-error="Please select age">
                            <?php echo $lotte_form->get_options_html('age', ['label' => $age]); ?>
                        </select>
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputCCCD" class="control-label">CCCD</label>
                    <input type="text" data-field="cccd" class="form-control" id="inputCCCD" value="<?php echo $lotte_api->get_user_field('cccd')?>" data-error="Please enter CCCD">
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="control-label">Current password</label>
                    <div class="input-contain">
                        <div class="icon-visible-password"></div>
                        <input type="password" data-field="oldpassword" class="form-control visible-password" id="inputPassword" value="Please enter a password" data-required-error="Please enter a password." required autocomplete="off">
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="control-label">New PASSWORD</label>
                    <div class="input-contain">
                        <div class="icon-visible-password"></div>
                        <input type="password" data-field="newpassword" class="form-control visible-password c-green" id="inputPasswordNew" value="Please enter a password" data-required-error="Please enter a password." autocomplete="off">
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="inputRePassword" class="control-label">Confirm Password</label>
                    <div class="input-contain">
                        <div class="icon-visible-password"></div>
                        <input type="password" class="form-control visible-password c-green" id="inputRePassword" data-match="#inputPasswordNew" data-error="Password does not match." value="Please enter a password" autocomplete="off">
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group txt-center">
                    <button type="submit" class="btn-dark-green hover">Save Information</button>
                </div>
                <div class="form-group group-bottom">
                    <div class="c-green txt-center close-popup">Exit Edit Profile</div>
                </div>
                <input type="hidden" name="redirect_to" class="redirect_to" value="/en/user/" />
            </form>
        </div>
    </div>

    <div id="remove-profile" class="popup-remove">
        <form class="content js-remove-form">
            <p>I want to delete my account including all personal information and activities on the website</p>
            <div class="form-group">
                <label for="inputPassword" class="control-label">Current password</label>
                <div class="input-contain">
                    <div class="icon-visible-password"></div>
                    <input type="password" name="<?php echo uniqid() ?>" data-field="password" class="form-control visible-password" id="inputPassword" value="Chọn mật khẩu" data-error="Please enter a password" autocomplete="new password">
                </div>
                <div class="help-block with-errors"></div>
            </div>
            <a class="btn-comfirm-remove js-submit">Confirm Account Deletion</a>
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
