( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */ 
	var WidgetHeroSliderHandler = function( $scope, $ ) {
		console.log( $scope );
/*         $scope.find('.blog-slider').owlCarousel({
            items :3,
            loop: true,
            margin : 30,
            nav:true,
            autoplay:false,
            autoHeight:true,
        }); */
		$scope.find('.hero-slider').each(function() {
			var a = $(this),
				items = a.data('items') || [3,1,1],
				margin = a.data('margin'),
				loop = a.data('loop'),
				nav = a.data('nav'),
				dots = a.data('dots'),
				center = a.data('center'),
				autoplay = a.data('autoplay'),
				autoplayHoverPause = a.data('autoplayHoverPause'),
				autoplaySpeed = a.data('$autoplaySpeed'),
				rtl = a.data('rtl'),
				autoheight = a.data('autoheight');

			var options = {
				nav: nav || false,
				navText:['<i class="fa fa-angle-left fa-2x"></i>', '<i class="fa fa-angle-right fa-2x"></i>'],
				loop: loop || false,
				dots: dots || false,
				center: center || false,
				autoplay: autoplay || false,
				autoHeight: autoheight || false,
				rtl: rtl || false,
				margin: margin || 0,
				autoplayTimeout: autoplaySpeed || 3000,
				autoplaySpeed: 400,
				autoplayHoverPause: autoplayHoverPause || false,
                animateOut: 'fadeOut',
				responsive: {
					0: { items: items[1] || 1 },
					576: { items: items[1] || 1 },
					1200: { items: items[0] || 1,}
				}
			};

			a.owlCarousel(options);
		});
	};
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/hero-slide.default', WidgetHeroSliderHandler );
	} );
} )( jQuery );
