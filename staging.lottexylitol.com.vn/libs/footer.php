<footer class="footer">
	<a href="javascript:;" class="btnTop abso"><span>TOP</span></a>
    <?php if($show_snsBox) :?>
	<div class="snsBox" style="display: none;">
		<h2 class="bHead"><?php echo $txt_footer; ?></h2>
		<div class="clearfix snsBox-flex">
			<div class="likeBlock">
                <div class="fb-page" data-href="{url}" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="{url}"><a href="{url}">Lotte Xylitol</a></blockquote></div></div>
            </div>
			<!-- <div class="commentBlock" id="js-facebook"></div> -->
		</div>
	</div>
    <?php endif; ?>
	<div class="inner">
        <ul class="clearfix fNavi">
            <li><a href="<?php echo APP_URL; ?><?php echo $lang_link; ?>what-is-xylitol/"><?php echo $footer_what; ?></a></li>
            <li><a href="<?php echo APP_URL; ?><?php echo $lang_link; ?>why-xylitol/"><?php echo $footer_why; ?></a></li>
            <li><a href="<?php echo APP_URL; ?><?php echo $lang_link; ?>product/"><?php echo $navi_product; ?></a></li>
            <li><a href="<?php echo APP_URL; ?><?php echo $lang_link; ?>movie/"><?php echo $navi_movie; ?></a></li>
            <!-- <li><a href="<?php echo APP_URL; ?><?php echo $lang_link; ?>promotion/"><?php echo $navi_promotion; ?></a></li> -->
        </ul>
        <p class="fSNS"><a href="https://www.facebook.com/LotteXylitolVietnam/" target="_blank"><img src="<?php echo APP_ASSETS; ?>img/common/icon/ico_fb2.svg" alt="FaceBook" class="opa"></a><a href="https://www.youtube.com/channel/UCycxhWW6INM8cUvgV9dLZMg" target="_blank"><img src="<?php echo APP_ASSETS; ?>img/common/icon/ico_yt2.svg" alt="YouTube" class="opa"></a></p>
        <?php if($lang == 'en') : ?>
        <p class="fSNS">
            Name: Lotte Vietnam Co., Ltd<br>
            <?php echo $footer_address; ?><br>
            Tax Code: 3700232139
        </p>
        <?php else: ?>
        <p class="fSNS">
            Tên: Công ty TNHH Lotte Việt Nam<br>
            <?php echo $footer_address; ?><br>
            MST: 3700232139
        </p>
        <?php endif ?>
	</div>
	<div class="copyright clearfix">
        <ul class="clearfix sfNavi">
            <li><a href="<?php echo APP_URL; ?><?php echo $lang_link; ?>privacy-policy/"><?php echo $txt_privacy; ?></a></li>
            <li><a href="<?php echo APP_URL; ?><?php echo $lang_link; ?>terms/"><?php echo $txt_terms; ?></a></li>
            <li><a href="<?php echo $footer_link_contact; ?>" target="_blank"><?php echo $txt_contact; ?></a></li>
        </ul><p class="txt">&copy; 2018 Lotte Vietnam, all rights reserved</p>
	</div>
</footer>
<script src="<?php echo APP_ASSETS; ?>js/jquery.fancybox.pack.js"></script>
<script src="<?php echo APP_ASSETS; ?>js/lib/common.js?v=<?php echo filemtime(APP_PATH . '/assets/js/lib/common.js') ?>"></script>
<script src="<?php echo APP_ASSETS; ?>js/lib/smoothscroll.js"></script>
<script src="<?php echo APP_ASSETS; ?>js/lib/biggerlink.js"></script>
<script src="<?php echo APP_ASSETS; ?>js/functions.min.js"></script>
<script src="<?php echo APP_ASSETS; ?>js/wow/wow.js"></script>
<script src="<?php echo APP_ASSETS; ?>js/lib/webfont.js"></script>
<script>
$(window).load(function(){
    setTimeout(function(){
        if(IS_PSI === false) {
            APP_ASSETS = '<?php echo APP_ASSETS; ?>';
              WebFont.load({
                // load fonts from local resource
                custom: {
                  families: ['fonts'],
                  urls: [APP_ASSETS + 'css/fonts.css']
                }
              });
        }

        function changeFBComment(){
            $('#js-facebook').append('<div class="fb-comments" data-href="https://www.facebook.com/LotteXylitolVietnam" data-width="462" data-numposts="5"></div>');
            FB.XFBML.parse();
        }

        function changeFBPagePlugin(width, height, url) {
            if (!isNaN(width) && !isNaN(height)) {
                $(".fb-page").attr("data-width", width).attr("data-height", height);
            }
            if (url) {
                $(".fb-page").attr("data-href", url);
            }
            FB.XFBML.parse();
        }

        changeFBPagePlugin(462,480,'https://www.facebook.com/LotteXylitolVietnam');
        // changeFBComment();

    },2000)
});
</script>
