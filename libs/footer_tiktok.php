<footer class="footer footerTiktok">
  <p class="copyright">&copy; 2021 Lotte Vietnam, all rights reserved</p>
</footer>
<script src="<?php echo APP_ASSETS; ?>js/lib/common.js"></script>
<script src="<?php echo APP_ASSETS; ?>js/lib/webfont.js"></script>
<script>
var isiPad = navigator.userAgent.match(/iPad/i) != null;
if (isiPad) {
  $('html').addClass('is-ipad');
}
function isiPadPro11(){var i=window.devicePixelRatio||1,e=window.screen.width*i,n=window.screen.height*i;return 1668===e&&2388===n||2388===e&&1668===n}
  if(isiPadPro11()) $('html').addClass('iPadPro11');
if(isiPadPro11()) $('html').addClass('iPadPro11');

$(window).load(function() {
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
  },2000)


  WebFont.load({
    google: {
      api: 'https://fonts.googleapis.com/css2',
      families: [
        'Roboto:wght@500&display=swap'
      ]
    }
  });
  WebFont.load({
    google: {
      api: 'https://fonts.googleapis.com/css2',
      families: [
        'Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap'
      ]
    }
  });
});

$(window).scroll(function() {
    var header = $('header').height();
    var tiktokMv = $('.tiktok-mv').height() - header;
    if ($(window).scrollTop() - header > 0 ) {
        $('header').addClass('scroll');
    } else {$('header').removeClass('scroll');}
    if ($(window).scrollTop() - header*2 > 0 ) {
        $('header').addClass('headerUp');
    } else {$('header').removeClass('headerUp');}
    if ($(window).scrollTop() - tiktokMv > 0 ) {
        $('header').addClass('hFixed');
    } else {$('header').removeClass('hFixed');}
});

jQuery(document).ready(function($) {
  /* menu SP */
  $('.navBtn, .close_sp, .navi_sp li a').click(function() {
      $("body").toggleClass("layerMenuOn");
  });
  $('.menu-trigger').on('click', function(){
    $(this).toggleClass('active');
    //return false;
  });
});

$('.js-anchor').on('click', function (event) {
  event.preventDefault();
  var targetHref  = $(this).attr('href');
  var $wh = $(window).outerHeight();
  console.log($wh);
  var targetArr   = targetHref.split('/');
  var targetID    = targetArr.length - 1;

  if ($(targetArr[targetID]).length) {
    var gutter;
    if (window.matchMedia('(max-width: 767px)').matches) {
      gutter = $('.header').outerHeight() + 50;
      $('.menu-trigger').removeClass('active');
      $('body').removeClass('layerMenuOn');
    } else {
      gutter = ($wh / 5);
    }
    var val    = $(targetArr[targetID]).offset().top - gutter;
    $('html, body').animate({ scrollTop: val }, 500);
  }
});

</script>
