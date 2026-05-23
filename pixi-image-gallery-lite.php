<?php
/**
 * Plugin Name: Pixi Filterable Image Gallery 
 * Description: Creative Elementor Image Gallery, Filterable Gallery,Creative layout
 * Plugin URI:  #
 * Version:     1.0.8
 * Author:      Esrat Sultana
 * Author URI:  https://esrat.net/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Requires PHP:      7.2
 * Elementor tested up to:     3.5.0
 * Elementor Pro tested up to: 3.5.0
 * Requires Plugins: elementor
 * 
 * Text Domain: pixi-image-gallery
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PIXI_IMAGE_GALLERY_VERSION', '1.0.5' );

//  INitiate plugins widgets

function pixi_image_gallery() {

	// Load plugin file
	require_once( __DIR__ . '/includes/plugin.php' );

	// Run the plugin
	\Pixi_Image_Gallery\Plugin::instance();

}
add_action( 'plugins_loaded', 'pixi_image_gallery' );



/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pixi-image-gallery-activator.php
 */
function activate_pixi_image_gallery() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/admin/class-pixi-image-gallery-activator.php';
	Pixi_Image_Gallery_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pixi-image-gallery-deactivator.php
 */
function deactivate_pixi_image_gallery() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/admin/class-pixi-image-gallery-deactivator.php';
	Pixi_Image_Gallery_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pixi_image_gallery' );
register_deactivation_hook( __FILE__, 'deactivate_pixi_image_gallery' );



/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/admin/class-pixi-image-gallery.php';

/**
 * The core plugin Helper Class
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/admin/class-pixi-helper.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pixi_image_gallery() {

	$plugin = new Pixi_Image_Gallery();
	$plugin->run();

}
run_pixi_image_gallery();



