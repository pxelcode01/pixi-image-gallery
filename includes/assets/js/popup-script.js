/**
*
* -----------------------------------------------------------------------------
*
* Template : pixi Image Gallery
* Author : Esrat Sultana
* Author URI : https:://esrat.net

* -----------------------------------------------------------------------------
*
**/

( function( $ ) {
	var WidgetHelloWorldHandler = function( $scope, $ ) {

        new VenoBox({
            selector: ".port_popup",
         });
            
	};
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/pixi-img-gallery-custom-filter.default', WidgetHelloWorldHandler );
	} );
} )( jQuery );
