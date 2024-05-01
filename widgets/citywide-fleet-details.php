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
class CityWide_Fleet_Details extends Widget_Base {

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
		return 'fleet-details';
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
		return __( 'Fleet Details', 'citywide' );
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
			'fleet_style',
			[
				'label' => esc_html__( 'Hero Style', 'citywide' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => [
					'style_1' => esc_html__( 'Image Right', 'citywide' ),
					'style_2' => esc_html__( 'Image Left', 'citywide' ),
				]
			]
		);

        $this->add_control(
			'price',
			[
				'label' => esc_html__( 'Price', 'citywide' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '$180', 'citywide' ),
			]
		);


        $this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'citywide' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true
			]
		);

        $this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'citywide' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '24 FT', 'citywide' ),
                'label_block' => true
			]
		);

		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'citywide' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Accommodates up to 12 regular sized pallets. Best for transportation of heavy cargo pallets. Recommended for moving of Warehouses, Offices, HDB 4 Room Flats and bigger.', 'citywide' ),
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
        $offest = $settings['fleet_style'] == 'style_1' ? ' offset-md-2' : '';
        $reverse_offest = $settings['fleet_style'] == 'style_2' ? ' offset-md-2 text-end' : '';
        if( $settings['fleet_style'] == 'style_2' ){
            $className = ' flex-md-row-reverse';
            $titleClass = 'title-left';
        }else{
            $className = '';
            $titleClass = 'title-right';
        }
        /* if( $settings['fleet_style'] == 'style_1' ){
            $classD = ' col-md-7';
        }else{
            $classD = ' col-md-6';
        } */
        /* <?php echo esc_attr($reverse_offest); ?> */
    ?>    

        <div class="fleet__detail-area">
            <div class="container">
                <div class="row<?php echo esc_attr($className); ?>">
                    <div class="col-md-4<?php echo esc_attr($reverse_offest); ?>">
                        <div class="fleet-squre-pirce text-center">
                            <h3><?php _e('Price starts from', 'citywide'); ?></h3>
                            <h2><?php echo esc_html($settings['price']); ?></h2>
                            <h3><?php _e('per trip', 'citywide'); ?></h3>
                        </div>
                    </div>
                    <?php
                        if(!empty($settings['image']['url'])){
                            echo'<div class="col-md-6'.esc_attr($offest).'">
                            <div class="fleet-large-image"><img class="img-fluid" src="'.esc_url($settings['image']['url']).'" /></div>
                        </div>';
                        }
                    ?>
                    <div class="w-100"></div>
                    <div class="col-md-12">
                        <div class="fleet__detail-content mt-5">
                            <h2 class="<?php echo esc_attr( $titleClass ); ?>"><?php echo esc_html($settings['title']); ?></h2>
                            <?php echo wpautop( $settings['description'] ); ?>
                        </div>
                    </div>
                </div>
            </div>
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
