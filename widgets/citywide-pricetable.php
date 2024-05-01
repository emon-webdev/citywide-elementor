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
class CityWide_Price_Table extends Widget_Base {

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
		return 'price-table';
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
		return __( 'Price Table', 'citywide' );
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
		return 'eicon-price-table';
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
			'price_style',
			[
				'label' => esc_html__( 'Layout Style', 'citywide' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style_1',
				'options' => [
					'style_1'  => esc_html__( 'Layout 1', 'citywide' ),
					'style_2' => esc_html__( 'Layout 2', 'citywide' ),
					'style_3' => esc_html__( 'Layout 3', 'citywide' ),
				]
			]
		);

        $this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'citywide' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '14 FT', 'citywide' ),
                'label_block' => true
			]
		);

        $this->add_control(
			'price_content',
			[
				'label' => esc_html__( 'Price Content ', 'citywide' ),
				'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'price_style',
                            'operator' => '==',
                            'value' => 'style_1',
                        ],
                    ],
                ]
			]
		);

        $this->add_control(
			'price_list',
			[
				'label' => esc_html__( 'Pirce List', 'citywide' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					
					[
						'name' => 'list_subtitle',
						'label' => esc_html__( 'Sub Title', 'citywide' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( 'per trip (point a to b)' , 'citywide' ),
						'label_block' => true,
					],
                    [
						'name' => 'list_title',
						'label' => esc_html__( 'Price', 'citywide' ),
						'type' => Controls_Manager::TEXT,
						'default' => esc_html__( '$110' , 'citywide' ),
						'label_block' => true,
					],
					[
						'name' => 'list_time',
						'label' => esc_html__( 'Hour', 'citywide' ),
						'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( '/ 3 hours' , 'citywide' ),
					]
				],
				'default' => [
					[
						'list_subtitle' => esc_html__( 'per trip (point a to b)', 'citywide' ),
						'list_title' => esc_html__( '$110', 'citywide' ),
						'list_time' => esc_html__( '/ 3 hours', 'citywide' ),
					]
				],
				'title_field' => '{{{ list_subtitle }}}',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'price_style',
                            'operator' => '==',
                            'value' => 'style_2',
                        ],
                        [
                            'name' => 'price_style',
                            'operator' => '==',
                            'value' => 'style_3',
                        ]
                    ],
                ]
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

        if( $settings['price_style'] == 'style_2' ){
           $className = 'price-list-wrap'; 
           $topClass = ' price-table-medium';
        }elseif( $settings['price_style'] == 'style_3' ){
            $topClass = ' price-list-large';
            $className = 'price-list-wider'; 
        }else{
            $className = 'price-content';
            $topClass = '';
        }

    ?>    

        <div class="citywide_price-table<?php echo esc_attr($topClass); ?>">
            <?php if( $settings['title'] ) : ?>
            <div class="table-header">
                <h3><?php echo esc_html( $settings['title'] ); ?></h3>
            </div>
            <?php endif; ?>
            <div class="<?php echo esc_attr($className); ?> gradient-bg-price">
                <?php 
                    if( $settings['price_style'] == 'style_2' ){
                        if ($settings['price_list'] ){
                            foreach( $settings['price_list'] as $item ){
                                echo'
                                    <div class="single-price-list item-' . esc_attr( $item['_id'] ) . '">
                                        <h4>'.esc_html( $item['list_subtitle'] ).'</h4>
                                        <div>
                                            <h3>'.esc_html( $item['list_title'] ).'</h3>
                                            <span>'.esc_html( $item['list_time'] ).'</span>
                                        </div>
                                    </div>
                                ';
                            }
                        }
                    }elseif( $settings['price_style'] == 'style_3' ){
                        if ($settings['price_list'] ){
                            foreach( $settings['price_list'] as $item ){
                                echo'
                                    <div class="single-price-wider-list item-' . esc_attr( $item['_id'] ) . '">
                                        <h4>'.esc_html( $item['list_subtitle'] ).'</h4>
                                        <h3>'.esc_html( $item['list_title'] ).'</h3>
                                        <h4>'.esc_html( $item['list_time'] ).'</h4>
                                    </div>
                                ';
                            }
                        }
                    }else{
                        echo wpautop( $settings['price_content'] ); 
                    }
                
                ?>
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
	protected function content_template() {

		?>
        <#
            if(settings.price_style == 'style_2'){
                var class_name = 'price-list-wrap';
                var top_class = 'price-table-medium';
            }else if( settings.price_style == 'style_3' ){
                var top_class = 'price-table-large';
                var class_name = 'price-list-wider';
            }else{
                var class_name = 'price-content';
                var top_class = '';
            }
        #>


        <div class="citywide_price-table {{ top_class }}">
            <# if ( settings.title ) { #>
            <div class="table-header">
                <h3>{{{ settings.title }}}</h3>
            </div>
            <# } #>
            <div class="{{ class_name }} gradient-bg-price">
            <#
                if( settings.price_style == 'style_2'){
                    if(settings.price_list.length ){
                        _.each( settings.price_list, function( item ){ #>
                            <div class="single-price-list item-{{ item._id }}">
                                <h4>{{{ item.list_subtitle }}}</h4>
                                <div>
                                    <h3>{{{ item.list_title }}}</h3>
                                    <span>{{{ item.list_time }}}</span>
                                </div>
                            </div>
                    <#  });
                    }
                    
                }else if( settings.price_style == 'style_3' ){
                    if(settings.price_list.length ){
                        _.each( settings.price_list, function( item ){ #>
                            <div class="single-price-wider-list item-{{ item._id }}">
                                <h4>{{{ item.list_subtitle }}}</h4>
                                <h3>{{{ item.list_title }}}</h3>
                                <h4>{{{ item.list_time }}}</h4>
                            </div>
                    <#  });
                    }
                }else{ #>
                    {{{ settings.price_content }}}
                <# }
            #>
            </div>
        </div>

		<?php
	}
}
