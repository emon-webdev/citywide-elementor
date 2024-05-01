<?php
namespace CityWide_Elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class CityWide_Contact_Info extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'contact-info';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'contact info', 'citywide' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-info-box';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'citywide' ];
	}



	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'citywide' ),
			]
		);

        $this->add_control(
			'address',
			[
				'label' => esc_html__( 'Address', 'citywide' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'The Westcom, 1 Tuas South Avenue 6 #06-13, Singapore 637021', 'citywide' ),
                'label_block' => true
			]
		);

        $this->add_control(
			'email_address',
			[
				'label' => esc_html__( 'Email Address', 'citywide' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'enquiry@citywide.sg', 'citywide' ),
                'label_block' => true
			]
		);

        $this->add_control(
			'phone',
			[
				'label' => esc_html__( 'Mobile', 'citywide' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '+65 85881503', 'citywide' ),
                'label_block' => true
			]
		);

		$this->add_control(
			'iframe_map',
			[
				'label' => esc_html__( 'Map', 'citywide' ),
				'type' => Controls_Manager::TEXTAREA,
                'label_block' => true
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
    ?>    

        <div class="contact-info-inner">
            <div class="contact-info">
                <ul>
                    <?php if( !empty( $settings['address'] ) ) : ?>
                    <li>
                        <span class="label">
                            <span class="icon"><i class="fa fa-map-marker"></i></span>
                            <?php _e('Address :', 'citywide'); ?>
                        </span> 
                        <span><?php echo esc_html( $settings['address'] ); ?></span>
                    </li>
                    <?php endif; ?>

                    <?php if( !empty( $settings['email_address'] ) ) : ?>
                    <li>
                        <span class="label">
                            <span class="icon"><i class="fa fa-envelope-o"></i></span> 
                            <?php _e('Email :', 'citywide'); ?>
                        </span> 
                        <span><?php echo esc_html( $settings['email_address'] ); ?></span>
                    </li>
                    <?php endif; ?>

                    <?php if( !empty( $settings['phone'] ) ) : ?>
                    <li>
                        <span class="label">
                            <span class="icon"><i class="fa fa-phone"></i></span> 
                            <?php _e('Mobile :', 'citywide'); ?>
                        </span> 
                        <span><?php echo esc_html( $settings['phone'] ); ?></span>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
            <?php if( $settings['iframe_map'] ) : ?>
            <div class="map">
                <?php echo $settings['iframe_map']; ?>
            </div>
            <?php endif; ?>
        </div>

    <?php    
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	/* protected function content_template() {
		?>
		<div class="title">
			{{{ settings.title }}}
		</div>
		<?php
	} */
}
