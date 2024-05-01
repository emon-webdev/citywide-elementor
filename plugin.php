<?php
namespace CityWide_Elementor;


/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}



	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'testimonial-owl-carousel', plugins_url( '/assets/js/blog-owl-carousel.js', __FILE__ ), [ 'jquery' ], false, true );
		wp_register_script( 'hero-owl-carousel', plugins_url( '/assets/js/hero-active-carousel.js', __FILE__ ), [ 'jquery' ], false, true );
		/* wp_enqueue_script( 'carousel-js', plugins_url( '/assets/js/owl.carousel.min.js', __FILE__ ), array( 'jquery' ), '2.3.4', true );
		return [
			'carousel-js'
		]; */
	}





	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {
		// Its is now safe to include Widgets files
		//require_once( __DIR__ . '/widgets/services.php' );
		require_once( __DIR__ . '/widgets/citywide-fleet.php' );
		require_once( __DIR__ . '/widgets/citywide-fleet-details.php' );
		require_once( __DIR__ . '/widgets/testimonial-carousel.php' );
		require_once( __DIR__ . '/widgets/citywide-contact-info.php' );
		require_once( __DIR__ . '/widgets/citywide-pricetable.php' );
		require_once( __DIR__ . '/widgets/citywide-hero-slider.php' );
/* 		require_once( __DIR__ . '/widgets/content-box.php' );
		require_once( __DIR__ . '/widgets/table-content.php' );
		require_once( __DIR__ . '/widgets/doctor-team.php' );
		require_once( __DIR__ . '/widgets/price-table.php' );
		require_once( __DIR__ . '/widgets/blog-carousel.php' ); */


		// Register Widgets
		//$widgets_manager->register( new Widgets\Medical_Services() );
		$widgets_manager->register( new Widgets\CityWide_Fleet_Product() );
		$widgets_manager->register( new Widgets\CityWide_Fleet_Details() );
		$widgets_manager->register( new Widgets\Citywide_Testimonial_Carousel() );
		$widgets_manager->register( new Widgets\CityWide_Contact_Info() );
		$widgets_manager->register( new Widgets\CityWide_Price_Table() );
		$widgets_manager->register( new Widgets\CityWide_Hero_Slide() );
/* 		$widgets_manager->register( new Widgets\Content_Block() );
		$widgets_manager->register( new Widgets\Table_Content() );
		$widgets_manager->register( new Widgets\Doctor_Team() );
		$widgets_manager->register( new Widgets\Price_Table() );
		$widgets_manager->register( new Widgets\M_Blog_Carousel() ); */

	}

	/**
	* Register scripts and styles for Elementor test widgets.
	*/

	function medical_enqueue_scripts() {
		wp_enqueue_style( 'owl-carousel', plugins_url('assets/css/owl.carousel.min.css', __FILE__) );
		wp_enqueue_script( 'owl-carousel', plugins_url('assets/js/owl.carousel.min.js', __FILE__), array( 'jquery' ), '2.3.4', true );
	}
	



	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget styles
		//add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		add_action( 'wp_enqueue_scripts', array( $this, 'medical_enqueue_scripts' ) );
		
		//$this->add_page_settings_controls();
	}
}

// Instantiate Plugin Class
Plugin::instance();
