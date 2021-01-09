( function( $ ) {

	'use strict';

	var Business_Key_Front = {
		init: function () {
			this.setup_carousel();
		},

		setup_carousel: function () {
			if ($().slick === undefined) {
				return;
			}

			var carousel_elements = $('.latest-news-carousel-wrapper');

			carousel_elements.each( function () {
				var carousel_elem = $(this);
				var arrows = carousel_elem.data('arrows') ? true : false;
				var dots = carousel_elem.data('dots') ? true : false;
				var autoplay = carousel_elem.data('autoplay') ? true : false;
				var autoplay_speed = carousel_elem.data('autoplay_speed') || 3000;
				var speed = carousel_elem.data('speed') || 300;
				var pause_on_hover = carousel_elem.data('pause_on_hover') ? true : false;
				var slides_to_show = carousel_elem.data('slides_to_show') || 4;
				var prev_arrow = carousel_elem.data('prev_arrow') || '<button type="button" class="slick-prev">&lt;</button>';
				var next_arrow = carousel_elem.data('next_arrow') || '<button type="button" class="slick-next">&gt;</button>';
				var slides_to_scroll = carousel_elem.data('slides_to_scroll') || 1;
				var tablet_breakpoint = carousel_elem.data('tablet_breakpoint') || 800;
				var tablet_slides_to_show = carousel_elem.data('tablet_slides_to_show') || 2;
				var tablet_slides_to_scroll = carousel_elem.data('tablet_slides_to_scroll') || 1;
				var mobile_breakpoint = carousel_elem.data('mobile_breakpoint') || 480;
				var mobile_slides_to_show = carousel_elem.data('mobile_slides_to_show') || 1;
				var mobile_slides_to_scroll = carousel_elem.data('mobile_slides_to_scroll') || 1;

				carousel_elem.slick({
					arrows: arrows,
					dots: dots,
					infinite: true,
					autoplay: autoplay,
					autoplaySpeed: autoplay_speed,
					speed: speed,
					prevArrow: prev_arrow,
					nextArrow: next_arrow,
					pauseOnHover: pause_on_hover,
					slidesToShow: slides_to_show,
					slidesToScroll: slides_to_scroll,
					responsive: [
					{
						breakpoint: tablet_breakpoint,
						settings: {
							slidesToShow: tablet_slides_to_show,
							slidesToScroll: tablet_slides_to_scroll
						}
					},
					{
						breakpoint: mobile_breakpoint,
						settings: {
							slidesToShow: mobile_slides_to_show,
							slidesToScroll: mobile_slides_to_scroll
						}
					}
					]
				});
			});
		}
	};

	$(document).ready(function($){

		Business_Key_Front.init();

		// Trigger mobile menu.
		$('#mobile-trigger').sidr({
			timing: 'ease-in-out',
			speed: 500,
			source: '#mob-menu',
			renaming: false,
			name: 'sidr-main'
		});

		$('#sidr-main').find( '.sub-menu' ).before( '<span class="dropdown-toggle"><strong class="dropdown-icon"></strong>' );

		$('#sidr-main').find( '.dropdown-toggle').on('click',function(e){
			e.preventDefault();
			$(this).next('.sub-menu').slideToggle();
			$(this).toggleClass( 'toggle-on' );
		});

		// Implement go to top.
		var $scroll_obj = $( '#btn-scrollup' );
		$( window ).scroll(function(){
			if ( $( this ).scrollTop() > 100 ) {
				$scroll_obj.fadeIn();
			} else {
				$scroll_obj.fadeOut();
			}
		});

		$scroll_obj.click(function(){
			$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
			return false;
		});
	});

} )( jQuery );
