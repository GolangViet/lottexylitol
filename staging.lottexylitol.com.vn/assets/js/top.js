$(function () {
	//begin vslider
	function mainSlider() {
		var BasicSlider = $('.vslider');
		BasicSlider.on('init', function (e, slick) {
			var $firstAnimatingElements = $('.slick-slide:first-child').find('[data-animation]');
			doAnimations($firstAnimatingElements);
		});

		BasicSlider.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
			var $animatingElements = $('.slick-slide[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
			doAnimations($animatingElements);
		});

		BasicSlider.slick({
			autoplay: true,
			autoplaySpeed: 5000,
			speed: 1000,
			arrows: false,
			dots: true,
			fade: true,
			pauseOnHover: false,
			pauseOnFocus: false,
			pauseOnDotsHover: false,
		});

		function doAnimations(elements) {
			var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
			elements.each(function () {
				var $this = $(this);
				var $animationDelay = $this.data('delay');
				var $animationType = 'animated ' + $this.data('animation');
				$this.css({
					'animation-delay': $animationDelay,
					'-webkit-animation-delay': $animationDelay
				});
				$this.addClass($animationType).one(animationEndEvents, function () {
					$this.removeClass($animationType);
				});
			});
		}
	}
	mainSlider();
	//end vslider


	//begin product slider

	function initSyncedSlider(identifier) {

		var sliderForSelector = '[data-slide="' + identifier + '"] .slide-for';
		var sliderNavSelector = '[data-slide="' + identifier + '"] .slide-nav';
		var arrowsContainerSelector = '[data-arrows="' + identifier + '"]';

		var $sliderFor = $(sliderForSelector).slick({
			autoplay: false,
			autoplaySpeed: 4500,
			speed: 1000,
			arrows: false,
			dots: false,
			fade: true,
			asNavFor: sliderNavSelector,
			slidesToShow: 1,
			slidesToScroll: 1,
		}).on('beforeChange', function (event, slick, currentSlide, nextSlide) {

			nextSlide = parseInt(nextSlide) + 1;
			var $currentArrowBtnContainer = $(arrowsContainerSelector);

			$currentArrowBtnContainer.removeClass(function (index, className) {
				return (className.match(/\bbtn-arrow\d+/g) || []).join(' ');
			});

			$currentArrowBtnContainer.addClass('btn-arrow' + nextSlide);

		});

		$(sliderNavSelector).slick({
			autoplay: false,
			slidesToShow: 8,
			slidesToScroll: 1,
			asNavFor: $sliderFor,
			arrows: false,
			dots: false,
			focusOnSelect: true,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 1,
					}
				}
			]
		});

		var $arrowsContainer = $(arrowsContainerSelector);

		$arrowsContainer.find('.prev').click(function () {
			$sliderFor.slick('slickPrev');
		});

		$arrowsContainer.find('.next').click(function () {
			$sliderFor.slick('slickNext');
		});
	}

	initSyncedSlider('product');
	initSyncedSlider('tablet-for-kids');
	initSyncedSlider('chewing-gum');
	//end product slider

	//begin product slider
	var $sliderTablet = $('.slider-for-tablet .slide-for').slick({
		autoplay: false,
		autoplaySpeed: 4500,
		speed: 1000,
		arrows: false,
		dots: false,
		fade: true,
		asNavFor: '.slider-nav-tablet .slide-nav',
		slidesToShow: 1,
		slidesToScroll: 1,
	}).on('beforeChange', function (event, slick, currentSlide, nextSlide) {
		nextSlide = parseInt(nextSlide) + 1; //increase nextSlide to 1 because skipping first item
		$('.btn-arrows-tablet').attr('class', 'btn-arrows btn-arrows-tablet btn-arrow' + nextSlide);
	});

	$('.slider-nav-tablet .slide-nav').slick({
		autoplay: false,
		slidesToShow: 5,
		slidesToScroll: 1,
		asNavFor: '.slider-for-tablet .slide-for',
		arrows: false,
		dots: false,
		focusOnSelect: true,
	});

	var $arrows = $('.btn-arrows-tablet');
	var $next = $arrows.children(".btn-arrows-tablet .prev");
	var $prev = $arrows.children(".btn-arrows-tablet .next");

	$('.btn-arrows-tablet .next').click(function () {
		var i = $next.index(this);
		$sliderTablet.eq(i).slick('slickNext');
	});
	$('.btn-arrows-tablet .prev').click(function () {
		var i = $prev.index(this);
		$sliderTablet.eq(i).slick('slickPrev');
	});
	//end product slider


	$('.promolist').slick({
		autoplay: false,
		autoplaySpeed: 3000,
		speed: 500,
		arrows: false,
		dots: false,
		fade: false,
		pauseOnHover: false,
		pauseOnFocus: false,
		pauseOnDotsHover: false,
		centerMode: false,
		centerPadding: '0px',
		slidesToShow: 2,
		slidesToScroll: 1,
		variableWidth: false,
		responsive: [
			{
				breakpoint: 767,
				settings: {
					slidesToShow: 1,
					variableWidth: true,
				}
			}
		]
	});
	// var hide_popup = sessionStorage.getItem( 'hide-popup' );
	// if ( !hide_popup )
	// {
	// 	$( window ).on( 'load', function ( e ) {
	// 		$.fancybox( {
	// 			'padding': 0,
	// 			content: $( '#box-wellcom' )
	// 		} );
	// 	} );
	// }
	$('.box-bottom input').on('click', function () {
		if ($(this).prop('checked')) {
			sessionStorage.setItem('hide-popup', true);
		}
	});





});

