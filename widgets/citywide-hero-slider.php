<?php
namespace CityWide_Elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class CityWide_Hero_Slide extends Widget_Base {

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
		return 'hero-slide';
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
		return __( 'Hero Slider', 'citywide' );
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
		return 'eicon-slides';
	}

    /**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
        return [ 'owl-carousel', 'hero-owl-carousel' ];
    }

    public function get_style_depends() {
        return [ 'owl-carousel' ];
    }

	public function get_keywords() {
		return [ 'slides', 'carousel', 'image', 'title', 'slider' ];
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

        $repeater = new Repeater();

        $repeater->add_control(
			'slide_content',
			[
				'label' => esc_html__( 'Slide Content ', 'citywide' ),
				'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'MOVERS, RELOCATION & DISPOSAL SERVICES', 'citywide' ),
                'label_block' => true
			]
		);

        $repeater->add_control(
			'button_title',
			[
				'label' => esc_html__( 'Button Text', 'citywide' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Call Us Now', 'citywide' ),
                'label_block' => true
			]
		);

        $repeater->add_control(
			'website_link',
			[
				'label' => esc_html__( 'Link', 'citywide' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'citywide' ),
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

        $this->add_control(
			'slide_list',
			[
				'label' => esc_html__( 'Slide List', 'citywide' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'slide_content' => esc_html__( 'LAST MILE DELIVERY', 'citywide' ),
						'button_title' => esc_html__( 'Call Us Now', 'citywide' ),
					],
					[
						'slide_content' => esc_html__( 'CARGO TRANSPORTATION', 'citywide' ),
						'button_title' => esc_html__( 'Call Us Now', 'citywide' ),
					],
					[
						'slide_content' => esc_html__( 'MOVERS, RELOCATION & DISPOSAL SERVICES', 'citywide' ),
						'button_title' => esc_html__( 'Call Us Now', 'citywide' ),
					],
				]
			]
		);

		$this->end_controls_section();


        $this->start_controls_section(
			'slider_options',
			[
				'label' => __( 'Slider Options', 'self-summit' ),
				'type' => Controls_Manager::SECTION,
			]
		);

		$this->add_control(
			'navigation',
			[
				'label' => __( 'Navigation', 'self-summit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => __( 'Pause on Hover', 'self-summit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'self-summit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'dots',
			[
				'label' => __( 'Dots', 'self-summit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'auto_height',
			[
				'label' => __( 'Auto Height', 'self-summit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed', 'self-summit' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 400,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'infinite',
			[
				'label' => __( 'Infinite Loop', 'self-summit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
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

        if($settings['navigation'] == 'yes') {
			$nav = 'true';
		} else {
			$nav  = 'false';
		}                
		  
		if($settings['pause_on_hover'] == 'yes') {
			$pause = 'true';
		} else {
			$pause = 'false';
		}
		  
		if($settings['auto_height'] == 'yes') {
			$autoHeight = 'true';
		} else {
			$autoHeight = 'false';
		} 

		if($settings['autoplay'] == 'yes') {
			$autoplay = 'true';
		} else {
			$autoplay = 'false';
		}                
		  
		if($settings['infinite'] == 'yes') {
			$loop = 'true';
		} else {
			$loop = 'false';
		}

		if($settings['dots'] == 'yes') {
			$dots = 'true';
		} else {
			$dots = 'false';
		} 
    ?>    

        <?php if( $settings['slide_list'] ): ?>
        <div class="hero__content_slider hero-slider owl-carousel" data-items="[1]" data-margin="30" data-loop="<?php echo esc_attr($loop); ?>" data-nav="<?php echo esc_attr($nav); ?>" data-dots="<?php echo esc_attr($dots); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-autoheight="<?php echo esc_attr($auto_height); ?>" <?php if( $settings['autoplay'] == 'yes' ):  ?>data-autoplaySpeed="<?php echo esc_attr( $settings['autoplay_speed'] ); ?>" <?php endif; ?> data-autoplayHoverPause="<?php echo esc_attr($pause); ?>">
            <?php 
                foreach( $settings['slide_list'] as $slide ): 
                if ( ! empty( $slide['website_link']['url'] ) ) {
                    $this->add_link_attributes( 'website_link', $slide['website_link'] );
                }
            ?>
            <div class="single-wlc-slide">
                <?php echo wpautop( $slide['slide_content'] ); ?>
                <a <?php echo $this->get_render_attribute_string( 'website_link' ); ?>><?php echo esc_html( $slide['button_title'] ); ?></a>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

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
	protected function content_template() {
		?>
        <# if ( settings.slide_list.length ) { #>    
        <div class="hero__content_slider hero-slider owl-carousel" data-items="[1,1,1]" data-margin="30" data-loop="{{{ settings.loop }}}" data-nav="{{{ settings.nav }}}" data-dots="{{{ settings.dots }}}" data-autoplay="{{{ settings.autoplay }}}" data-autoheight="{{{ settings.auto_height }}}"<# if ( settings.autoplay ) { #>data-autoplaySpeed="{{{ settings.autoplay_speed }}}"<# } #> data-autoplayHoverPause="{{{ settings.pause }}}">

            <# _.each( settings.slide_list, function( item ) { #>
            <div class="single-wlc-slide">
                {{{ item.slide_content }}}
                <a href="{{ item.website_link.url }}">{{{ item.button_title }}}</a>
            </div>
            <# }); #>
        </div>
        <# } #>


		<?php
	}
}
