<?php
namespace Citywide_Elementor\Widgets;

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
class Citywide_Testimonial_Carousel extends Widget_Base {

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
		return 'testimonial-carousel';
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
		return __( 'Testimonial', 'medical-practice' );
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
		return 'eicon-testimonial-carousel';
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
        return [ 'owl-carousel', 'testimonial-owl-carousel' ];
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

		$repeater = new Repeater();

		$repeater->add_control(
			'author_image',
			[
				'label' => esc_html__( 'Author Image', 'textdomain' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'auhtor_name',
			[
				'label' => esc_html__( 'Name', 'citywide' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Name' , 'citywide' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'post_date',
			[
				'label' => esc_html__( 'Date', 'citywide' ),
				'type' => Controls_Manager::DATE_TIME,
			]
		);

		$repeater->add_control(
			'item_description',
			[
				'label' => esc_html__( 'Testimonial', 'citywide' ),
				'type' => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Type your Testimonial here', 'citywide' ),
			]
		);


		$repeater->add_control(
			'review_source',
			[
				'label' => esc_html__( 'Source Image', 'textdomain' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);

		$this->add_control(
			'testimonial_list',
			[
				'label' => esc_html__( 'Testimonial List', 'citywide' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'auhtor_name' => esc_html__( 'Title #1', 'citywide' ),
						'item_description' => esc_html__( 'Item content. Click the edit button to change this text.', 'textdomain' ),
					],
					[
						'auhtor_name' => esc_html__( 'Title #2', 'citywide' ),
						'item_description' => esc_html__( 'Item content. Click the edit button to change this text.', 'textdomain' ),
					],
					[
						'auhtor_name' => esc_html__( 'Title #3', 'citywide' ),
						'item_description' => esc_html__( 'Item content. Click the edit button to change this text.', 'textdomain' ),
					],
				],
				'title_field' => '{{{ auhtor_name }}}',
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
		

		<div class="blog-sluder-area">
			<div class="container">
				<div class="row">
					<div class="col">
						<?php if( $settings['testimonial_list'] ): ?>
							<div class="owl-carousel testimonial-slider" data-items="[3,2,1]" data-margin="30" data-loop="<?php echo esc_attr($loop); ?>" data-nav="<?php echo esc_attr($nav); ?>" data-dots="<?php echo esc_attr($dots); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" <?php if( $settings['autoplay'] == 'yes' ):  ?>data-autoplaySpeed="<?php echo esc_attr( $settings['autoplay_speed'] ); ?>" <?php endif; ?> data-autoplayHoverPause="<?php echo esc_attr($dots); ?>">
								<?php
									foreach( $settings['testimonial_list'] as $item ):
									$date_time_value = $item['post_date'];
									$formatted_date = date('Y-d-m', strtotime($date_time_value));
								?>

									<div class="single-slide">
										<div class="side-top">
											<?php
												if( $item['author_image']['url'] ){
													echo '<div class="author-thumbnil">
														<img class="img-fluid" src="'.esc_url( $item['author_image']['url'] ).'" />
													</div>';
												}else{
													$title = $item['auhtor_name'];
													$title_first_letter = substr($title, 0, 1);
													echo '<div class="author-name-thumbnil">'.esc_html( $title_first_letter ).'</div>';
												}
											?>

											<div class="author-title">
												<h3><?php echo $item['auhtor_name']; ?></h3>
												<span><?php echo $formatted_date; ?></span>
											</div>
											<?php 
												if( !empty( $item['review_source']['url'] ) ){
													echo'<div class="review-source"><img src="'.esc_url( $item['review_source']['url'] ).'" /></div>';
												}
											?>
										</div>
										<div class="side-content">
											<div class="review-star"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>
											<?php echo wpautop( $item['item_description'] ); ?>
										</div>
									</div>



								<?php
									endforeach; 
								?>

							</div>

						<?php endif; ?>	
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
