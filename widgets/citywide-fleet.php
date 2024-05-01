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
class CityWide_Fleet_Product extends Widget_Base {

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
		return 'fleet-product';
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
		return __( 'Fleet Product', 'citywide' );
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
		return 'eicon-product-price';
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
		return [ 'general' ];
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
				'label' => esc_html__( 'Product Style', 'citywide' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => [
					'style_1'  => esc_html__( 'With Price', 'citywide' ),
					'style_2' => esc_html__( 'Without Price', 'citywide' ),
				]
			]
		);

        $this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true
			]
		);

        $this->add_control(
			'price',
			[
				'label' => __( 'Price', 'citywide' ),
				'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '110$', 'citywide' ),
				'conditions' => [
					'terms' => [
						[
							'name' => 'fleet_style',
							'operator' => '!=',
							'value' => 'style_2',
						]
					]
				]
			]
		);


        $this->add_control(
			'button_label',
			[
				'label' => __( 'Label', 'citywide' ),
				'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '14FT Lorry', 'citywide' ),
                'label_block' => true
			]
		);

        $this->add_control(
			'website_link',
			[
				'label' => esc_html__( 'Link', 'textdomain' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'textdomain' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
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

        if ( ! empty( $settings['website_link']['url'] ) ) {
			$this->add_link_attributes( 'website_link', $settings['website_link'] );
		}

    ?>    

        <div class="fleet-product">
			<?php if( $settings['fleet_style'] == 'style_1' ) : ?>
            <div class="price"><span><?php _e('From', 'citywide'); ?></span> <span><?php echo esc_html( $settings['price'] ); ?></span></div>
			<?php endif; ?>
            <img src="<?php echo esc_url( $settings['image']['url'] ); ?>">
            <a <?php echo $this->get_render_attribute_string( 'website_link' ); ?>><?php echo esc_html( $settings['button_label'] ); ?></a>
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
