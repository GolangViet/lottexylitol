<?php
require_once (APP_PATH . 'libs/lotte-api.php');
// $user = $lotte_api->get_current_user();
$user = $lotte_api->is_logged_in();
if($user != false) {
	$user = [
		'avatar_url' => '/assets/img/user/avatar.jpg',
		'name' => $lang == 'en' ? 'Account' : 'Tài khoản',
	];
}
$is_coming = $lotte_api->is_mustbuy_coming_soon($mustbuy_from, $mustbuy_to);
?>
<div id="fb-root"></div>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WHFSD9K" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N4S38Q9Z" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<header class="header hFixed">
	<div class="inner clearfix">
		<h1 id="logo"><a href="<?php echo APP_URL . $lang_link; ?>" class="logo"><img src="<?php echo APP_ASSETS; ?>img/common/logo<?php echo $lang == 'en' ? '-en' : '' ?>.png" alt="<?php echo $txtH1; ?>" class="opa"></a></h1>
		<nav class="hNavi pc">
			<ul class="tNavi">
				<li class="navRegister">
					<a href="<?php echo APP_URL . $lang_link; ?>movie"><?php echo $navi_gallery; ?></a>
				</li>
				<?php if($user == false) :?>
				<li class="navRegister navLang">
					<a href="<?php echo APP_URL . $lang_link; ?>signup"><?php echo $navi_signup; ?></a><em>&nbsp;</em>
					<a href="<?php echo $login_link; ?>"><?php echo $navi_signin; ?></a>
				</li>
				<?php else: ?>
				<li class="navProfile has-submenu">
					<a class="profile-link" href="<?php echo APP_URL . $lang_link; ?>user">
						<img width="30" src="<?php echo $user['avatar_url']; ?>" alt="" />
						<?php echo $user['name']; ?>
					</a>
					<ul class="subProfile submenu">
						<li><a href="<?php echo APP_URL . $lang_link; ?>user"><?php echo $navi_profile; ?></a></li>
						<li><a href="<?php echo $logout_link ?>"><?php echo $navi_signout; ?></a></li>
					</ul>
				</li>
				<?php endif;?>
				<li class="navLang">
					<a href="<?php echo $lang_urls['en']; ?>" class="btnEn">EN</a>
					<em>&nbsp;</em>
					<a href="<?php echo $lang_urls['vi']; ?>" class="btnVn">VN</a>
				</li>
			</ul>
			<ul class="clearfix gNavi">
				<li class="navMembershipPromote has-submenu">
					<a href="<?php echo APP_URL . $lang_link; ?>what-is-xylitol"><img src="<?php echo APP_ASSETS; ?>img/common/icon/icon-learn-about.svg" alt="icon" class="menu-icon"><?php echo $navi_what_why ?></a>
					<ul class="submenu">
						<li class="navWhyXylitol"><a href="<?php echo APP_URL . $lang_link; ?>what-is-xylitol"><?php echo $navi_what; ?></a></li>
						<li class="navWhyXylitol"><a href="<?php echo APP_URL . $lang_link; ?>why-xylitol"><?php echo $navi_why; ?></a></li>
					</ul>
				</li>
				<li class="navIntro">
					<a href="<?php echo APP_URL . $lang_link; ?>about-xylitol"><img src="<?php echo APP_ASSETS; ?>img/common/icon/icon-intro.svg" alt="icon" class="menu-icon"><?php echo $navi_intro; ?></a>
				</li>
				<li class="navLearnAbout">
					<a href="<?php echo APP_URL . $lang_link; ?>product"><img src="<?php echo APP_ASSETS; ?>img/common/icon/icon-product.svg" alt="icon" class="menu-icon"><?php echo $navi_product; ?></a>
				</li>
				<?php /*/ ?>
				<li class="navMembershipPromote has-submenu">
					<a class="hover" href="<?php echo APP_URL . $lang_link; ?>membership-activities/"><img src="<?php echo APP_ASSETS; ?>img/common/icon/icon-star.svg" alt="icon" class="menu-icon"><?php echo $navi_membership_promote; ?></a>
					<ul class="submenu">
						<?php if($is_coming == false) : ?>
						<li class="navMustBuy"><a href="<?php echo APP_URL . $lang_link; ?>nhanqualientay/"><?php echo $navi_must_buy; ?></a></li>
						<?php endif ?>
						<li class="navPhot"><a href="<?php echo APP_URL . $lang_link; ?>about-photo-contest/"><?php echo $navi_photo; ?></a></li>
						<li class="navAmbassador"><a href="<?php echo APP_URL . $lang_link; ?>about-brand-ambassador/"><?php echo $navi_ambassador; ?></a></li>
						<li class="navGame noDisplay-tmp"><a href="<?php echo APP_URL . $lang_link; ?>about-game/"><?php echo $navi_game; ?></a></li>
					</ul>
				</li>
				<?php /*/ ?>
				<li class="navNews">
					<a href="<?php echo APP_URL . $lang_link; ?>news"><img src="<?php echo APP_ASSETS; ?>img/common/icon/icon-news.svg" alt="icon" class="menu-icon"><?php echo $navi_news; ?></a>
				</li>
			</ul>
		</nav>

		<div class="navBtn sp">
			<p class="hamburMenu"><a href="javascript:void(0)" class="menu-trigger" id="menu-trigger07"><span></span><span></span><span></span></a></p>
		</div>
		<div class="layerMenu">
			<div class="layerIn">
				<div class="layerRoll">
					<ul class="layerNav clearfix">
						<li class="navMembershipPromote js-submenu has-submenu">
							<a href="<?php echo APP_URL . $lang_link; ?>what-is-xylitol" class="hover">
								<div class="img-contain"><img src="<?php echo APP_ASSETS; ?>img/common/icon/icon-learn-about.svg" alt="icon" class="menu-icon"></div>
								<?php echo $navi_what_why ?>
								<span class="open-submenu"></span>
							</a>
							<ul class="submenu">
								<li class="navWhatIsXylitol"><a href="<?php echo APP_URL . $lang_link; ?>what-is-xylitol"><?php echo $navi_what; ?></a></li>
								<li class="navWhyXylitol"><a href="<?php echo APP_URL . $lang_link; ?>why-xylitol"><?php echo $navi_why; ?></a></li>
							</ul>
						</li>
						<li class="navIntro"><a href="<?php echo APP_URL . $lang_link; ?>about-xylitol">
								<div class="img-contain"><img src="<?php echo APP_ASSETS; ?>img/common/icon/icon-intro.svg" alt="icon" class="menu-icon"></div><?php echo $navi_intro; ?>
							</a></li>
						<li class="navLearnAbout"><a href="<?php echo APP_URL . $lang_link; ?>product">
								<div class="img-contain"><img src="<?php echo APP_ASSETS; ?>img/common/icon/icon-product.svg" alt="icon" class="menu-icon"></div><?php echo $navi_product; ?>
							</a></li>
						<?php /*/ ?>
						<li class="navMembershipPromote js-submenu has-submenu">
							<a href="<?php echo APP_URL . $lang_link; ?>membership-activities/" class="hover">
								<div class="img-contain"><img src="<?php echo APP_ASSETS; ?>img/common/icon/icon-star.svg" alt="icon" class="menu-icon"></div>
								<?php echo $navi_membership_promote; ?>
								<span class="open-submenu"></span>
							</a>
							<ul class="submenu">
								<?php if($is_coming == false) : ?>
								<li class="navMustBuy"><a href="<?php echo APP_URL . $lang_link; ?>nhanqualientay/"><?php echo $navi_must_buy; ?></a></li>
								<?php endif;?>
								<li class="navPhot"><a href="<?php echo APP_URL . $lang_link; ?>about-photo-contest/"><?php echo $navi_photo; ?></a></li>
								<li class="navAmbassador"><a href="<?php echo APP_URL . $lang_link; ?>about-brand-ambassador/"><?php echo $navi_ambassador; ?></a></li>
								<li class="navGame noDisplay-tmp"><a href="<?php echo APP_URL . $lang_link; ?>about-game/"><?php echo $navi_game; ?></a></li>
							</ul>
						</li>
						<?php /*/ ?>
						<li class="navNews"><a href="<?php echo APP_URL . $lang_link; ?>news">
							<div class="img-contain"><img src="<?php echo APP_ASSETS; ?>img/common/icon/icon-news.svg" alt="icon" class="menu-icon"></div><?php echo $navi_news; ?>
						</a></li>
						<li class="navGallery">
							<a href="<?php echo APP_URL . $lang_link; ?>movie">
								<div class="img-contain"><img src="<?php echo APP_ASSETS; ?>img/common/icon/icon-gallery.svg" alt="icon" class="menu-icon"></div><?php echo $navi_gallery; ?>
							</a>
						</li>
						<?php if($user == false) :?>
						<li class="navRegister">
							<a href="<?php echo APP_URL . $lang_link; ?>signup"><?php echo $navi_signup; ?></a><em>&nbsp;</em>
							<a href="<?php echo $login_link; ?>"><?php echo $navi_signin; ?></a>
						</li>
						<?php else: ?>
						<li class="navProfile navMembershipPromote js-submenu has-submenu">
							<a href="<?php echo APP_URL . $lang_link; ?>user" class="hover profile-link">
								<div class="img-contain"><img class="menu-icon" src="<?php echo $user['avatar_url']; ?>" alt="" /></div>
								<?php echo $user['name']; ?>
								<span class="open-submenu"></span>
							</a>
							<ul class="subProfile submenu">
								<li><a href="<?php echo APP_URL . $lang_link; ?>user"><?php echo $navi_profile; ?></a></li>
								<li><a href="<?php echo $logout_link ?>"><?php echo $navi_signout; ?></a></li>
							</ul>
						</li>
						<?php endif;?>
					</ul>
					<ul class="clearfix snsLang">
						<li class="navFb"><a href="https://www.facebook.com/LotteXylitolVietnam/" target="_blank"><img src="<?php echo APP_ASSETS; ?>img/common/icon/ico_fb.svg" alt="FaceBook"
									class="opa"></a><a href="https://www.youtube.com/channel/UCycxhWW6INM8cUvgV9dLZMg" target="_blank"><img src="<?php echo APP_ASSETS; ?>img/common/icon/ico_yt.svg"
									alt="YouTube" class="opa"></a></li>
						<li class="navLang navRegister">
							<a href="<?php echo $lang_urls['en']; ?>" class="btnEn"><span>English</span></a>
							<a href="<?php echo $lang_urls['vi']; ?>" class="btnVn"><span>Vietnamese</span></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</header>
<div id="box-membership">
	<div class="content">
		<h2 class="popup-title no-line c-green txt-center">QUYỀN LỢI THÀNH VIÊN
			<span class="sub-title">Trở thành fan cứng Lotte Xylitol - Tại sao không bạn ơi??<br class="pc">Vừa giải trí, vừa có quà cực “xịn”</span>
		</h2>
		<div class="img-gift">
			<img src="/assets/img/common/img-gift.png" alt="">
		</div>
		<div class="detail">
			<a href="" class="btn-dark-green btn-center">XEM CHI TIẾT</a>
		</div>
		<div class="box-bottom">
			<label class="checkbox">Không hiển thị lại.
				<input type="checkbox">
				<span class="checkmark"></span>
			</label>
		</div>
	</div>
</div>
