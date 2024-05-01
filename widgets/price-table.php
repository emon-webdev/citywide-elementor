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
class Price_Table extends Widget_Base {

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
		return __( 'Table of Content', 'medical-practice' );
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
			'content_table_header',
			[
				'label' => __( 'Table Header', 'medical-practice' ),
			]
		);

		$repeater_header = new Repeater();


		$repeater_header->add_control(
			'heading',
			[
				'label' => esc_html__( 'Content', 'medical-practice' ),
				'type' => Controls_Manager::TEXTAREA,
				'show_label' => false,
                'placeholder' => __( 'Table Data Header', 'medical-practice' ),
				'default' => __( 'Table Data Header', 'medical-practice' ),
			]
		);

		

        $repeater_header->add_control(
			'align', [ 
				'label' => __( 'Alignment', 'medical-practice' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'medical-practice' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'medical-practice' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'medical-practice' ),
						'icon' => 'eicon-text-align-right',
					]
				],
				'default' => 'left',
			]
		);

        $this->add_control(
			'table_header',
			[
				'label' => esc_html__( 'Table Header Cel', 'medical-practice' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater_header->get_controls(),
                'default' => [
					[
						'heading' => esc_html__( 'Table Header', 'medical-practice' ),
					],
					[
						'heading' => esc_html__( 'Table Header', 'medical-practice' ),
					],
				],
				'title_field' => '{{{ heading }}}',
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'content_table_body',
            [
                'label' => esc_html__( 'Table Body', 'medical-practice' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();


        $repeater->add_control(
			'row', [
				'label' => __( 'New Row', 'medical-practice' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'medical-practice' ),
				'label_on' => __( 'Yes', 'medical-practice' ),
			]
		);

		$repeater->add_control(
			'table_content',
			[
				'label' => esc_html__( 'Content', 'medical-practice' ),
				'type' => Controls_Manager::WYSIWYG,
				'show_label' => false,
                'placeholder' => __( 'Table Data', 'medical-practice' ),
				'default' => __( 'Table Data', 'medical-practice' ),
			]
		);
        
        $repeater->add_control(
			'align', [ 
				'label' => __( 'Alignment', 'medical-practice' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'medical-practice' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'medical-practice' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'medical-practice' ),
						'icon' => 'eicon-text-align-right',
					]
				],
				'default' => 'left',
			]
		);

		$this->add_control(
			'table_body',
			[
				'label' => esc_html__( 'Table Body Cell', 'medical-practice' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
                'default' => [
					[
						'table_content' => __( 'Table Data', 'medical-practice' ),
					],
					[
						'table_content' => __( 'Table Data', 'medical-practice' ),
					],
				],
				'title_field' => '{{{ table_content }}}',
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
    
    
	
    <table class="table table-bordered">
        <thead class="table-light">    
            <tr>
                <?php
					foreach ($settings['table_header'] as $index => $item) {
						$repeater_setting_key = $this->get_repeater_setting_key( 'heading', 'table_header', $index );
						$this->add_inline_editing_attributes( $repeater_setting_key );
						echo '<th class="repeater-item-'.$item['_id'].'" '.$this->get_render_attribute_string( $repeater_setting_key ).'>'.$item['heading'].'</th>';
					}
				?>
            </tr>
        </thead>
       
        <tbody>
            <tr>
                <?php
					foreach ($settings['table_body'] as $index => $item) {
						$table_body_key = $this->get_repeater_setting_key( 'table_content', 'table_body', $index );

						$this->add_render_attribute( $table_body_key, 'class', 'repeater-item-'.$item['_id'] );
						$this->add_inline_editing_attributes( $table_body_key );

						if($item['row'] == 'yes'){
							echo '</tr><tr>';
						}

						echo '<td '.$this->get_render_attribute_string( $table_body_key ).' >'.$item['table_content'].'</td>';
					}
				?>
            </tr>
        </tbody>
    </table>

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
		<table class="table table-bordered">
			<thead class="table-light">
				<tr>
					<#
					if ( settings.table_header ) {
						_.each( settings.table_header, function( item, index ) {
							var iconTextKey = view.getRepeaterSettingKey( 'heading', 'table_header', index );

							view.addRenderAttribute( iconTextKey, 'class', 'repeater-item-'+item._id );
							view.addInlineEditingAttributes( iconTextKey );
							#>
							<th {{{ view.getRenderAttributeString( iconTextKey ) }}}>{{{ item.heading }}}</th>
						<#
						} );
					} #>
				</tr>
			</thead>
			<tbody>
				<tr>
					<#
					if ( settings.table_body ) {
						_.each( settings.table_body, function( item, index ) {
							if( 'yes' === item.row){
								newRow = '</tr><tr>';
							}else{
								newRow = '';
							}

							var tdTextKey = view.getRepeaterSettingKey( 'table_content', 'table_body', index );
							
							view.addRenderAttribute( tdTextKey, 'class', 'repeater-item-'+item._id );
							view.addInlineEditingAttributes( tdTextKey );

							#>
							{{{newRow}}}
							<td {{{ view.getRenderAttributeString( tdTextKey ) }}}>{{{ item.table_content }}}</td>
						<#
						} );
					} #>
				</tr>
			</tbody>
		</table>
		<?php
	}
}
