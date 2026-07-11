<?php
// Author: A+LIVE
include_once ('../app_config.php');
include (APP_PATH . 'libs/head.php');
?>
</head>

<body id="gift" class="news-title gift vn">
    <!-- Header
    ================================================== -->
    <?php include (APP_PATH . 'libs/header.php'); ?>
    <div id="wrap">
        <!-- Main Content
        ================================================== -->
        <main class="main bgmain">
            <div class="breadcrumb">
                <ul>
                    <li><a href="">Trang chủ</a></li>
                    <li>Đổi quà tặng</li>
                </ul>
            </div>
            <div class="section section-2">
                <h1 class="section-title">đổi quà tặng</h1>
                <div class="profile">
                    <div class="profile-block">
                        <div class="profile-avt"><img src="<?php echo APP_ASSETS; ?>img/gift/avt.png" alt=""></div>
                        <div class="profile-name">Savannah Nguyen</div>
                    </div>
                    <div class="score">
                        <p class="score-title">Điểm đang có</p>
                        <p class="score-point">8000</p>
                    </div>
                </div>
                <div class="cloud">
                    <div class="cloud-icon lottie-icon" data-src="/assets/json/present.json"></div>
                    <div class="cloud-title">danh sách quà tặng</div>
                </div>
                <div class="gift-list row-2">
                    <div class="col-3">
                        <div class="gift-item">
                            <div class="badge"><img src="<?php echo APP_ASSETS; ?>img/gift/icon-clock.png" alt="">chỉ còn 3 phần quà</div>
                            <div class="gift-img"><img src="<?php echo APP_ASSETS; ?>img/gift/gift-img-1.png" alt=""></div>
                            <div class="gift-detail">
                                <div class="gift-name">Lorem ipsum dolor</div>
                                <div class="gift-point">3,000 Điểm</div>
                            </div>
                            <div class="line"></div>
                            <div class="gift-quantity">Số lượng còn : <span>3</span></div>
                            <a href="#box-gift" class="btn-dark-green btn-center gift-btn"><img src="<?php echo APP_ASSETS; ?>img/gift/icon-gift.png" alt="">đổi quà</a>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="gift-item">
                            <div class="gift-img"><img src="<?php echo APP_ASSETS; ?>img/gift/gift-img-2.png" alt=""></div>
                            <div class="gift-detail">
                                <div class="gift-name">Lorem ipsum dolor</div>
                                <div class="gift-point">3,000 Điểm</div>
                            </div>
                            <div class="line"></div>
                            <div class="gift-quantity">Số lượng còn : <span>3</span></div>
                            <a href="#box-gift" class="btn-dark-green btn-center gift-btn"><img src="<?php echo APP_ASSETS; ?>img/gift/icon-gift.png" alt="">đổi quà</a>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="gift-item">
                            <div class="gift-img"><img src="<?php echo APP_ASSETS; ?>img/gift/gift-img-3.png" alt=""></div>
                            <div class="gift-detail">
                                <div class="gift-name">Lorem ipsum dolor</div>
                                <div class="gift-point">3,000 Điểm</div>
                            </div>
                            <div class="line"></div>
                            <div class="gift-quantity">Số lượng còn : <span>3</span></div>
                            <a href="#box-gift" class="btn-dark-green btn-center gift-btn"><img src="<?php echo APP_ASSETS; ?>img/gift/icon-gift.png" alt="">đổi quà</a>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="gift-item">
                            <div class="gift-img"><img src="<?php echo APP_ASSETS; ?>img/gift/gift-img-3.png" alt=""></div>
                            <div class="gift-detail">
                                <div class="gift-name">Lorem ipsum dolor</div>
                                <div class="gift-point">3,000 Điểm</div>
                            </div>
                            <div class="line"></div>
                            <div class="gift-quantity">Số lượng còn : <span>3</span></div>
                            <a href="#box-gift" class="btn-dark-green btn-center gift-btn disable"><img src="<?php echo APP_ASSETS; ?>img/gift/icon-gift.png" alt="">đổi quà</a>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="gift-item">
                            <div class="gift-img"><img src="<?php echo APP_ASSETS; ?>img/gift/gift-img-1.png" alt=""></div>
                            <div class="gift-detail">
                                <div class="gift-name">Lorem ipsum dolor</div>
                                <div class="gift-point">3,000 Điểm</div>
                            </div>
                            <div class="line"></div>
                            <div class="gift-quantity">Số lượng còn : <span>3</span></div>
                            <a href="#box-gift" class="btn-dark-green btn-center gift-btn disable"><img src="<?php echo APP_ASSETS; ?>img/gift/icon-gift.png" alt="">đổi quà</a>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="gift-item">
                            <div class="gift-img"><img src="<?php echo APP_ASSETS; ?>img/gift/gift-img-2.png" alt=""></div>
                            <div class="gift-detail">
                                <div class="gift-name">Lorem ipsum dolor</div>
                                <div class="gift-point">3,000 Điểm</div>
                            </div>
                            <div class="line"></div>
                            <div class="gift-quantity">Số lượng còn : <span>3</span></div>
                            <a href="#box-gift" class="btn-dark-green btn-center gift-btn disable"><img src="<?php echo APP_ASSETS; ?>img/gift/icon-gift.png" alt="">đổi quà</a>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div><!-- #wrap -->

    <!-- Popup Gift -->
    <div id="box-gift">
        <div class="box-gift-content">
            <h2 class="popup-title c-green">chúc mừng bạn<br class="sp"> đã đổi quà thành công !</h2>
            <div class="box-gift-score">
                <p class="score-title">Điểm CÒN LẠI</p>
                <p class="score-point">8000</p>
            </div>
            <div class="box-gift-line"></div>
            <div class="info">
                <div class="info-title pc">THÔNG TIN NHẬN QUÀ CỦA BẠN</div>
                <form id="form-gift" data-toggle="validator" role="form">
                    <div class="form-group">
                        <label for="inputName" class="control-label">họ tên</label>
                        <input type="text" class="form-control" id="inputName" placeholder="Savannah Nguyen" data-error="Vui lòng nhập họ tên" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="control-label">ĐỊA CHỈ EMAIL</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="savannah.nguyen@example.com" data-error="Email chưa đúng định dạng" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group" id="group-phone">
						<label for="inputPhone" class="control-label">Số điện thoại</label>
						<div class="form-control">
							<div class="selectbox" id="country-code">
								<span class="select-text has-value">+84</span>
								<select required>
									<option value="0">+84</option>
									<option value="1">+30</option>
									<option value="2">+10</option>
								</select>
							</div>
							<input type="text" maxlength="11" pattern="^[0-9]*$" id="inputPhone" placeholder="Nhập số điện thoại của bạn" data-pattern-error="vui lòng nhập đúng số điện thoại"
								data-required-error="Vui lòng nhập số điện thoại" required>
						</div>
						<div class="help-block with-errors"></div>
					</div>
                    <div class="form-group">
                        <label for="inputAddress" class="control-label">địa chỉ NHẬN QUÀ</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="2118 Thornridge Cir. Syracuse, Connecticut 35624" data-error="Vui lòng nhập địa chỉ" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group" id="city">
								    <label for="inputCity" class="control-label">Tỉnh/Thành phố</label>					    
									    <div class="form-control selectbox" id="inputCity">
									    	<span class="select-text">Chọn tỉnh/thành phố của bạn</span>
										    <select required data-error="Vui lòng chọn thành phố">
										      <option value="">Chọn tỉnh/thành phố của bạn</option>
										      <option value="1">Hồ Chí Minh</option>
										      <option value="2">Hà Nội</option>
										      <option value="3">Đà Nẵng</option>
										   	</select>
									 		</div>
									 		<div class="help-block with-errors"></div>					 		
								  </div>
                    <div class="form-group txt-center">
                        <button type="submit" class="btn-dark-green btn-center gift-btn hover">XÁC NHẬN THÔNG TIN NHẬN QUÀ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer
    ================================================== -->
    <?php include (APP_PATH . 'libs/footer.php'); ?>
    <!-- End Document
================================================== -->
<script src="<?php echo APP_ASSETS; ?>js/lottie.js"></script>
</body>

</html>