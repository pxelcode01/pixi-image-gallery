<?php 


namespace Pixi_Image_Gallery;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Plugin class.
 *
 * The main class that initiates and runs the addon.
 *
 * @since 1.0.0
 */
final class Plugin {

	/**
	 * Addon Version
	 *
	 * @since 1.0.0
	 * @var string The addon version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */
	const MINIMUM_PHP_VERSION = '7.2';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \Elementor_Test_Addon\Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \Elementor_Test_Addon\Plugin An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}

	}

	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function is_compatible() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'pixi-image-gallery' ),
			'<strong>' . esc_html__( 'Pixi Image Gallery', 'pixi-image-gallery' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'pixi-image-gallery' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pixi-image-gallery' ),
			'<strong>' . esc_html__( 'Pixi Image Gallery', 'pixi-image-gallery' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'pixi-image-gallery' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pixi-image-gallery' ),
			'<strong>' . esc_html__( 'Pixi Image Gallery', 'pixi-image-gallery' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'pixi-image-gallery' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {

		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		add_action( 'elementor/elements/categories_registered', [$this, 'custom_pixi_widget_categories' ] );

		add_action( 'elementor/frontend/after_enqueue_styles', [$this, 'pixi_frontend_stylesheets'] );

		add_action( 'elementor/frontend/after_register_scripts', [$this , 'pixi_frontend_scripts'] );

	}

	/**
	 * Register Widgets
	 *
	 * Load widgets files and register new Elementor widgets.
	 *
	 * Fired by `elementor/widgets/register` action hook.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */

	public function register_widgets( $widgets_manager ) {

		require_once( __DIR__ . '/widgets/pixi-gallery.php' );
		require_once( __DIR__ . '/widgets/pixi-gallery-filter.php' );
		require_once( __DIR__ . '/widgets/pixi-gallery-custom-filter.php' );

		$widgets_manager->register( new \Pixi_Image_Gallery\pixi_image_gallery_lite() );
		$widgets_manager->register( new \Pixi_Image_Gallery\pixi_image_gallery_filter() );
		$widgets_manager->register( new \Pixi_Image_Gallery\pixi_image_gallery_custom_filter() );

	}


	/**
	 * Enqueue/Registers styles
	 */

	function pixi_frontend_stylesheets() {
		wp_enqueue_style( 'gallery-common-style', plugins_url( 'assets/css/common.css', __FILE__ ) );
		wp_enqueue_style( 'bootstrap-style', plugins_url( 'assets/css/bootstrap.min.css', __FILE__ ) );
		// enequeue files
		wp_enqueue_style( 'animate', plugins_url( 'assets/css/animate.css', __FILE__ ) );
		wp_enqueue_style( 'venobox', plugins_url( 'assets/css/venobox.min.css', __FILE__ ) );
	}


	/**	
	 * Enqueue/Registers scripts
	 */
	
	function pixi_frontend_scripts() {
		wp_enqueue_script( 'venobox', plugins_url( 'assets/js/venobox.min.js', __FILE__ ), [ 'jquery' ] );
		wp_enqueue_script( 'isotope', plugins_url( 'assets/js/isotope.pkgd.min.js', __FILE__ ), [ 'jquery' ] );
		wp_enqueue_script( 'image-loaded', plugins_url( 'assets/js/imagesloaded.pkgd.min.js', __FILE__ ), [ 'isotope','jquery' ] );
		wp_enqueue_script( 'pixi-filter', plugins_url( 'assets/js/pixi-filter-gallery.js', __FILE__ ),[ 'isotope','jquery','image-loaded' ] );
		wp_enqueue_script( 'pixi-custom-post-filter', plugins_url( 'assets/js/pixi-custom-filter-gallery.js', __FILE__ ,[ 'isotope','jquery','image-loaded' ] ) );
		wp_enqueue_script( 'main-scripts', plugins_url( 'assets/js/main.js', __FILE__ ) );
		wp_enqueue_script( 'popup-script', plugins_url( 'assets/js/popup-script.js', __FILE__ ) );
	}

	/**
	 * Register Custom Category
	 */


	function custom_pixi_widget_categories( $elements_manager ) {

		$categories = [];
		$categories['pixi-category'] =
			[
				'title'  => esc_html__( 'Pixi Image Gallery', 'pixi-image-gallery' ),
				'icon'  => 'fa fa-plug'
			];

		$old_categories = $elements_manager->get_categories();
		$categories = array_merge($categories, $old_categories);

		$set_categories = function ( $categories ) {
			$this->categories = $categories;
		};

		$set_categories->call( $elements_manager, $categories );

	}

   
    

}
