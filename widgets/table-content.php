<?php
namespace Medical_Elementor\Widgets;

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
class Table_Content extends Widget_Base {

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
		return 'table-content';
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
		return __( 'Table Box', 'medical-practice' );
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
		return 'eicon-table';
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

		$repeater = new Repeater();

		$repeater->add_control(
			'block_style',
			[
				'label' => esc_html__( 'Block Style', 'textdomain' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'option_1',
				'options' => [
					'option_1' => esc_html__( 'Style 1', 'textdomain' ),
					'option_2'  => esc_html__( 'Style 2', 'textdomain' ),
				],
			]
		);

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'conditions' => [
					'terms' => [
						[
							'name' => 'block_style',
							'operator' => '==',
							'value' => 'option_2',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'list_title',
			[
				'label' => esc_html__( 'Title', 'textdomain' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'conditions' => [
					'terms' => [
						[
							'name' => 'block_style',
							'operator' => '!=',
							'value' => 'option_2',
						],
					],
				],
			]
		);

		$repeater->add_control(
			'list_content',
			[
				'label' => esc_html__( 'Content', 'textdomain' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'List Content' , 'textdomain' ),
				'show_label' => false,
			]
		);

		$this->add_control(
			'table_list',
			[
				'label' => esc_html__( 'Table Row List', 'textdomain' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__( 'Title #1', 'textdomain' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'textdomain' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

/*         $this->add_control(
			'table_list',
			[
				'label' => esc_html__( 'Repeater List', 'textdomain' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'block_style',
						'label' => esc_html__( 'Block Options', 'textdomain' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'option_1',
                        'options' => [
                            'option_1' => esc_html__( 'Style 1', 'textdomain' ),
                            'option_2'  => esc_html__( 'Style 2', 'textdomain' ),
                            'option_3'  => esc_html__( 'Style 3', 'textdomain' ),
                        ],
						'label_block' => true,
					],
					[
						'name' => 'image',
						'label' => esc_html__( 'Choose Image', 'textdomain' ),
						'type' => Controls_Manager::MEDIA,
						'label_block' => true,
                        'conditions' => [
                            'terms' => [
                                [
                                    'name' => 'block_style',
                                    'operator' => '==',
                                    'value' => 'option_3',
                                ],
                            ],
                        ],
					],
					[
						'name' => 'list_title',
						'label' => esc_html__( 'Title', 'textdomain' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
                        'conditions' => [
                            'terms' => [
                                [
                                    'name' => 'block_style',
                                    'operator' => '==',
                                    'value' => 'option_1',
                                ],
                            ],
                        ],
					],
					[
						'name' => 'heading_title',
						'label' => esc_html__( 'Title', 'textdomain' ),
						'type' => Controls_Manager::TEXTAREA,
						'label_block' => true,
                        'conditions' => [
                            'terms' => [
                                [
                                    'name' => 'block_style',
                                    'operator' => '==',
                                    'value' => 'option_2',
                                ],
                                [
                                    'name' => 'block_style',
                                    'operator' => '!=',
                                    'value' => 'option_3',
                                ]
                            ],
                        ],
					],
					[
						'name' => 'list_content',
						'label' => esc_html__( 'Content', 'textdomain' ),
						'type' => Controls_Manager::WYSIWYG,
						'show_label' => false,
					]
				],
				'default' => [
					[
						'list_title' => esc_html__( 'Title #1', 'textdomain' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'textdomain' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		); */

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
	
	



		<?php
			if( $settings['table_list'] ){
				echo'<div class="table-wrapper">';
					foreach( $settings['table_list'] as $item ){
						if( $item['block_style'] ==  'option_2' ){
							$className = ' space-bottom';
						}else{
							$className = ' line-bottom';
						}
					echo'<div class="row'.esc_attr( $className ).'  item-'.esc_attr( $item['_id'] ).'">
							<div class="col-lg-3">';
								if( $item['block_style'] ==  'option_2' && $item['image']['url'] ){
									echo'<div class="image"><img src="'.esc_url( $item['image']['url'] ).'" /></div>';
								}else{
									echo'<div class="table-header"><h4>'.$item['list_title'].'</h4></div>';
								}
							echo'</div>
							<div class="col-lg-9">
								<div class="table-content">'.wpautop( $item['list_content'] ).'</div>
							</div>
						
						</div>';
					}
				
				echo'</div>';


			}
		?>	

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
