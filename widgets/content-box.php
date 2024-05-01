<?php
namespace Medical_Elementor\Widgets;

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
class Content_Block extends Widget_Base {

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
		return 'content-box';
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
		return __( 'Content Box', 'medical-practice' );
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
				'label' => __( 'Content', 'elementor-hello-world' ),
			]
		);

        $this->add_control(
			'block_style',
			[
				'label' => esc_html__( 'Block Style', 'textdomain' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'option_1',
				'options' => [
					'option_1' => esc_html__( 'Style 1', 'textdomain' ),
					'option_2'  => esc_html__( 'Style 2', 'textdomain' ),
					'option_3' => esc_html__( 'Style 3', 'textdomain' ),
					'option_4' => esc_html__( 'Style 4', 'textdomain' ),
					'option_5' => esc_html__( 'Style 5', 'textdomain' ),
					'option_6' => esc_html__( 'Style 6', 'textdomain' ),
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'textdomain' ),
				'type' => Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Type your description here', 'textdomain' ),
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

		/* if( $settings['block_style'] == 'option_2' ){

		}elseif( $settings['block_style'] == 'option_3' ){

		}elseif( $settings['block_style'] == 'option_4' ){

		}else{

		} */

    ?>    
		
		<?php if( $settings['block_style'] == 'option_2' ) : ?>
			<div class="content-wrraper">
				<div class="row">
					<?php if( $settings['image']['url'] ) : ?>
					<div class="col-lg-8">
						<img src="<?php echo $settings['image']['url']; ?> " class="img-fluid">
					</div>
					<?php endif; ?>
					<div class="col-lg-4">
						<div class="content-box bg-black">
							<?php echo wpautop( $settings['description'] ); ?>
						</div>
					</div>
				</div>
			</div>

		<?php elseif( $settings['block_style'] == 'option_3' ) : ?>	
			<div class="content-wrraper">
				<div class="row">
					<?php if( $settings['image']['url'] ) : ?>
					<div class="col-lg-6 col-md-6">
						<div class="heading-position-image">
							<img src="<?php echo $settings['image']['url']; ?> " class="img-fluid">
						</div>
					</div>
					<?php endif; ?>
					<div class="col-lg-6 col-md-6">
						<div class="content-box heading-position">
							<?php echo wpautop( $settings['description'] ); ?>
						</div>
					</div>
				</div>
			</div>

		<?php elseif( $settings['block_style'] == 'option_4' ) : ?>	
			<div class="content-box simple-content-box">
				<?php 
					if( $settings['image']['url'] ) {
						echo '<img src="'.esc_url($settings['image']['url']).'" class="img-fluid">';
					}
				?>
				<?php echo wpautop( $settings['description'] ); ?>
			</div>	

		<?php elseif( $settings['block_style'] == 'option_5' ) : ?>	
			<div class="content-box simple-content-box rounded-image">
				<?php 
					if( $settings['image']['url'] ) {
						echo '<img src="'.esc_url($settings['image']['url']).'" class="img-fluid">';
					}
				?>
				<?php echo wpautop( $settings['description'] ); ?>
			</div>	
			
		<?php elseif( $settings['block_style'] == 'option_6' ) : ?>	
			<div class="content-wrraper">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="content-box">
							<?php echo wpautop( $settings['description'] ); ?>
						</div>
					</div>
					<?php if( $settings['image']['url'] ) : ?>
					<div class="col-lg-6 col-md-6">
						<img src="<?php echo $settings['image']['url']; ?> " class="img-fluid">
					</div>
					<?php endif; ?>
				</div>
			</div>		
		
		<?php else : ?>
			<div class="content-wrraper">
				<div class="row">
					<?php if( $settings['image']['url'] ) : ?>
					<div class="col-lg-6 col-md-6">
						<img src="<?php echo $settings['image']['url']; ?> " class="img-fluid">
					</div>
					<?php endif; ?>
					<div class="col-lg-6 col-md-6">
						<div class="content-box p-3">
							<?php echo wpautop( $settings['description'] ); ?>
						</div>
					</div>
				</div>
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
	/* protected function content_template() {
		?>
		<div class="title">
			{{{ settings.title }}}
		</div>
		<?php
	} */
}
