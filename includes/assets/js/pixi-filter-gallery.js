 
( function( $ ) {
	var WidgetFilterHandler = function( $scope, $ ) {
        var pixifilter = $('.pixi-grid');
        if(pixifilter.length){
            $('.pixi-grid').imagesLoaded(function() {
                $('.pixi-filter').on('click', 'button', function() {
                    var filterValue = $(this).attr('data-filter');
                    var $grid = $(this).closest('.pixi-portfolio').find('.pixi-grid');
                    $grid.isotope({
                        filter: filterValue,
                        itemSelector: '.grid-item',
                        percentPosition: true,
                        masonry: {
                            columnWidth: '.grid-item',
                        }
                    });
                });
            });
        }

            
	};
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/pixi-img-gallery-filter.default', WidgetFilterHandler );
	} );
} )( jQuery );


 