(function($){
	'use strict';

	// Animated Heading widget
	var widgetAnimatedHeading = function( $scope, $ ) {
	var animatedHeading = $scope.find('.tx-animated-heading-wrap');
				
		if ( animatedHeading.length > 0 ) {
			
			var settings = animatedHeading.data('settings'),
				animatedText = animatedHeading.find( '.tx-animated-txt' ),
				animatedID = $(animatedText).attr('id');

			if(settings.styles === 'typed') {

				var	typed = new Typed('#'+animatedID, settings);

			} else if (settings.styles === 'animated') {
				
				$(animatedText).Morphext(settings);
			}

		} 

	};

	// Circle Progress Bar widget
	var widgetCircleProgressBar = function( $scope, $ ) {
	var cpb = $scope.find('.tx-circle-progress-bar');

		if ( cpb.length > 0 ) {

			var settings = cpb.data("settings");

			cpb.asPieProgress({
		        namespace: 'pie_progress'
		    }); 

			cpb.asPieProgress('start');

		}

	};

	// Countdown widget
	var widgetCountdown = function( $scope, $ ) {
	var countdown = $scope.find('.tx-countdown-wrapper');
				
		if ( countdown.length > 0 ) {
			
			var	countdownItem = countdown.find( '.tx-countdown-content' ),
				countdownID = $(countdownItem).attr('id');

			$('#'+countdownID).countdown();

		} 

	};

	// Carousel Widget
	var widgetCarousel = function( $scope, $ ) {
	var txCarousel = $scope.find('.tx-carousel').eq(0);

		if ( txCarousel.length > 0 ) {

			var settings = txCarousel.data("settings"),
				display_mobile = settings["display_mobile"],
				display_tablet = settings["display_tablet"],
				display_laptop = settings["display_laptop"],
				display_desktop = settings["display_desktop"],
				gutter = settings["gutter"],
				autoplay = settings["autoplay"],
				pause_on_hover = settings["pause_on_hover"],
				navigation = settings["navigation"],
				dots = settings["dots"],
				loop = settings["loop"],
				autoplay_timeout = settings["autoplay_timeout"],
				smart_speed = settings["smart_speed"];

			txCarousel.owlCarousel({
		        loop: loop,
		        margin: gutter,
		        autoplay: autoplay,
		        smartSpeed: smart_speed,
		        autoplayTimeout: autoplay_timeout,
		        autoplayHoverPause: pause_on_hover,
		        lazyLoad: true,
		        nav: navigation,
		        dots: dots,
		        navText: ['<i class="la la-angle-left"></i>','<i class="la la-angle-right"></i>'],
		        responsive:{
		            0:{
		                items: display_mobile
		            },
		            600:{
		                items: display_tablet
		            },
		            1000:{
		                items: display_laptop
		            },
		             1400:{
		                items: display_desktop
		            }
		        }

		    });

		}

	};

	// Table Widget
	var widgetTable = function($scope, $) {
	var $_this = $scope.find(".tx-table-wrap"),
		$id = $_this.data("table_id");

		if (typeof enableProSorter !== "undefined" && $.isFunction(enableProSorter)) {
			$(document).ready(function() {
				enableProSorter(jQuery, $_this);
			});
		}

		var $th = $scope.find(".tx-table").find("th");
		var $tbody = $scope.find(".tx-table").find("tbody");

		$tbody.find("tr").each(function(i, item) {
			$(item)
				.find("td .td-content-wrapper")
					.each(function(index, item) {
						$(this).prepend('<div class="th-mobile-screen">' + $th.eq(index).html() + "</div>");
				});
		});
	};


	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ep-animated-heading.default', widgetAnimatedHeading ); // Animated Heading
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ep-classes-carousel.default', widgetCarousel ); // Classes Carousel
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ep-circle-progress-bar.default', widgetCircleProgressBar ); // Circle Progress Bar
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ep-countdown.default', widgetCountdown ); // Countdown
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/ep-courses-carousel.default', widgetCarousel ); // LearnPress Courses Carousel
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/ep-news-ticker.default', widgetCarousel ); // News Ticker
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/ep-post-carousel.default', widgetCarousel ); // Post Carousel
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/ep-profile-carousel.default', widgetCarousel ); // Profile Carousel
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/ep-teachers-carousel.default', widgetCarousel ); // Teachers Carousel
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/ep-testimonial.default', widgetCarousel ); // Testimonial Carousel
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/ep-woocommerce-carousel.default', widgetCarousel ); // woocommerce product Carousel
 		elementorFrontend.hooks.addAction( 'frontend/element_ready/ep-table.default', widgetTable ); // Table
 	} );


})( jQuery );


/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */


