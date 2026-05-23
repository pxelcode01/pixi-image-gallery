<?php
namespace Pixi_Image_Gallery;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Widget 2.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class pixi_image_gallery_filter extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve widget name.
	 *
	 */
	public function get_name() {
		return 'pixi-img-gallery-filter';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve  widget title.
	 */
	public function get_title() {
		return esc_html__( 'Pixi Image Filter', 'pixi-image-gallery' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve  widget icon.
	 *
	 */
	public function get_icon() {
		return 'eicon-gallery-masonry';
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the  widget belongs to.
	 *
	 */
	public function get_categories() {
		return [ 'pixi-category' ];
	}


	/**
	 * Get widget style depends
	 *
	 * Retrieve the list of categories the  widget belongs to.
	 *
	 */


	public function get_style_depends() {
		return [
			'gallery-common-style',
			'bootstrap',
		];
	}
	
	/**
	 * Get widget Script depends
	 *
	 * Retrieve the list of categories the  widget belongs to.
	 *
	 */

	public function get_script_depends() {
		return [
			'isotope',
			'image-loaded',
			'pixi-filter',
			'main-scripts',
		];
	}
	
	

	/**
	 * Register  widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.

	 */
	protected function register_controls() {

		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Settings', 'pixi-image-gallery' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

	

		$this->add_control(
			'hover_effects_style',
			[
				'label' => esc_html__( 'Hover Effects', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => esc_html__( 'Default', 'pixi-image-gallery' ),
					'zoomIn'  => esc_html__( 'Zoom In', 'pixi-image-gallery' ),
					'shrink' => esc_html__( 'Shrink', 'pixi-image-gallery' ),
					'zoomLeft' => esc_html__( 'Zoom Left', 'pixi-image-gallery' ),
				],
			]
		);

		$this->add_control(
			'column_option',
			[
				'label' => esc_html__( 'Column', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'12'  => esc_html__( '1', 'pixi-image-gallery' ),
					'6' => esc_html__( '2', 'pixi-image-gallery' ),
					'4' => esc_html__( '3', 'pixi-image-gallery' ),
					'3' => esc_html__( '4', 'pixi-image-gallery' ),
				],
			]
		);

		$this->add_control(
			'column_gap',
			[
				'label' => esc_html__( 'Columns Gap', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => esc_html__( 'Default', 'pixi-image-gallery' ),
					'g-0' => esc_html__( 'No Gap', 'pixi-image-gallery' ),
					'g-1' => esc_html__( 'Narrrow', 'pixi-image-gallery' ),
					'g-2' => esc_html__( 'Extended', 'pixi-image-gallery' ),
					'g-3' => esc_html__( 'Wide', 'pixi-image-gallery' ),
					'g-4' => esc_html__( 'Wider', 'pixi-image-gallery' ),
					'g-custom' => esc_html__( 'Custom', 'pixi-image-gallery' ),
				],
			]
		);

		$this->add_responsive_control(
			'custom_column_gap',
			[
				'label' => esc_html__( 'Custom Column Gap', 'eduhash-toolkit' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'condition' => [
					'column_gap' => 'g-custom',
				],
				'selectors' => [
					'{{WRAPPER}} .pixi-gallery-wrapper .gallery-inner ' => 'margin-bottom: -{{SIZE}}{{UNIT}}; margin-right: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pixi-gallery-wrapper .pixi-inner-item' => 'padding-right: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_item_spacing',
			[
				'label' => esc_html__( 'Spacing', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .pixi-portfolio .pixi-inner-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'enable_filter',
			[
				'label' => __( 'Show Filter', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'pixi-image-gallery' ),
				'label_off' => __( 'Hide', 'pixi-image-gallery' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);


		$this->end_controls_section();

		// filter option

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Filter Controls', 'pixi-image-gallery' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'enable_filter' => 'yes',
				)
			]
		);


		$this->add_control(
			'all_title',
			[
				'label' => esc_html__( 'Gallery All Label', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'All', 'pixi-image-gallery' ),
				'placeholder' => esc_html__( 'Type your title here', 'pixi-image-gallery' ),
				'condition' => array(
					'enable_filter' => 'yes',
				)
			]
		);


		$filter_repeater = new \Elementor\Repeater();

		

		$filter_repeater->add_control(
			'filter_name',
			[
				'label' => esc_html__( 'Filter Label', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Gallery Item', 'pixi-image-gallery' ),
				'placeholder' => esc_html__( 'Type your title here', 'pixi-image-gallery' ),
			]
		);


		$this->add_control(
			'filter_lists',
			[
				'label' => __( 'Filter Item', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $filter_repeater->get_controls(),
				'title_field' => '{{{ filter_name }}}',
				'condition' => array(
					'enable_filter' => 'yes',
				),
				'default' => [
					[
						'filter_name' => esc_html__( 'Gallery Item', 'pixi-image-gallery' ),
					],
					[
						'filter_name' => esc_html__( 'Gallery Item 2', 'pixi-image-gallery' ),
					],
					[
						'filter_name' => esc_html__( 'Gallery Item 3', 'pixi-image-gallery' ),
					],
					[
						'filter_name' => esc_html__( 'Gallery Item 4', 'pixi-image-gallery' ),
					],
				],
			]
		);

		// Repeater End
		$this->end_controls_section();

		// filter option

		$this->start_controls_section(
			'item_content_section',
			[
				'label' => esc_html__( 'Gallery Content', 'pixi-image-gallery' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		

		// Repeater Start

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'layout_style',
			[
				'label' => esc_html__( 'Layout Style', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => esc_html__( 'Default', 'pixi-image-gallery' ),
					'style-2'  => esc_html__( 'Hover Content', 'pixi-image-gallery' ),
					'style-3'  => esc_html__( 'Overlay Content', 'pixi-image-gallery' ),
				],
			]
		);


		$repeater->add_control(
			'control_name',
			[
				'label' => esc_html__( 'Control Name', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Gallery Item', 'pixi-image-gallery' ),
				'placeholder' => esc_html__( 'Use the gallery control name from Control Settings. Separate multiple 
				items with comma (e.g. Gallery Item, Gallery Item 2)', 'pixi-image-gallery' ),
				'label_block' => true,
				'rows' => 3,
			]
		);

		$repeater->add_control(
			'widget_image',
			[
				'label' => esc_html__( 'Choose Image', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'content_title',
			[
				'label' => esc_html__( 'Title', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Marketing Website', 'pixi-image-gallery' ),
				'placeholder' => esc_html__( 'Type your content here', 'pixi-image-gallery' ),
				'condition' => [
					'layout_style' => ['style-2','style-3'],
				],
				'label_block' => true,
			]
		);


		$repeater->add_control(
			'content_desc',
			[
				'label' => esc_html__( 'Description', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Web Design', 'pixi-image-gallery' ),
				'placeholder' => esc_html__( 'Type your content here', 'pixi-image-gallery' ),
				'condition' => [
					'layout_style' => ['style-2','style-3'],
				],
				'label_block' => true,
			]
		);


		$repeater->add_control(
			'link_option',
			[
				'label' => esc_html__( 'Link', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'media',
				'options' => [
					'media'  => esc_html__( 'Media File', 'pixi-image-gallery' ),
					'custom' => esc_html__( 'Custom Link', 'pixi-image-gallery' ),
				],
			]
		);

		$repeater->add_control(
			'widget_link',
			[
				'label' => esc_html__( 'Link', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'pixi-image-gallery' ),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'condition' => array(
					'link_option' => ['custom'],
				)
			]
		);
		

		$this->add_control(
			'gallery_lists',
			[
				'label' => __( 'Gallery Images', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'widget_image' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
					],
					[
						'widget_image' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
					],
					[
						'widget_image' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
					],
					[
						'widget_image' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
					],
					[
						'widget_image' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
					],
					[
						'widget_image' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
					],

				],
			]
		);

		$this->end_controls_section();


		//  Filter Control STyle controls


		//  STyle controls

		$this->start_controls_section(
			'img_style_section',
			[
				'label' => esc_html__( 'Image', 'pixi-image-gallery' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'image_radius',
			[
				'label' => esc_html__( 'Border radius', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pixi-inner-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'img_width',
			[
				'label' => esc_html__( 'Width', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .pixi-inner-item img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'img_border',
				'label' => __( 'Border', 'pixi-image-gallery' ),
				'selector' => '{{WRAPPER}}  .pixi-inner-item img',
			]
		);

		$this->end_controls_section();

		//  Hover Style content 

		$this->start_controls_section(
			'hover_content_style_section',
			[
				'label' => esc_html__( 'Hover Content Style', 'pixi-image-gallery' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'hover_content_align',
			[
				'label' => esc_html__( 'Alignment', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'pixi-image-gallery' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'pixi-image-gallery' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'pixi-image-gallery' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .pixi-inner-content ' => 'text-align: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'hover_title_typography',
				'selector' => '{{WRAPPER}} .pixi-inner-content h4',
				'label' => esc_html__( 'Title Typograghy', 'pixi-image-gallery' ),
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'hover_desc_typography',
				'selector' => '{{WRAPPER}} .pixi-inner-content p',
				'label' => esc_html__( 'Description Typograghy', 'pixi-image-gallery' ),
			]
		);

		$this->add_control(
			'hover_content_title_color',
			[
				'label' => esc_html__( 'Title Color', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pixi-inner-content h4' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'hover_content_desc_color',
			[
				'label' => esc_html__( 'Content Color', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pixi-inner-content p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hover_content_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pixi-inner-content' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'hover_content_padding',
			[
				'label' => esc_html__( 'Padding', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pixi-inner-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'hover_content_radius',
			[
				'label' => esc_html__( 'Border radius', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pixi-inner-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		//  Filtering content style

		$this->start_controls_section(
			'filter_style_section',
			[
				'label' => esc_html__( 'Filter Style', 'pixi-image-gallery' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'filter_align',
			[
				'label' => esc_html__( 'Alignment', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'pixi-image-gallery' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'pixi-image-gallery' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'pixi-image-gallery' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .pixi-portfolio .pixi-filter ' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'filter_typography',
				'selector' => '{{WRAPPER}} .pixi-portfolio .pixi-filter button',
			]
		);

		$this->add_control(
			'filter_radius',
			[
				'label' => esc_html__( 'Border radius', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pixi-portfolio .pixi-filter button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'filter_border',
				'label' => __( 'Border', 'pixi-image-gallery' ),
				'selector' => '{{WRAPPER}}  .pixi-portfolio .pixi-filter button',
			]
		);
		$this->add_control(
			'filter_active_border_color',
			[
				'label' => esc_html__( 'Active Border Color', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pixi-portfolio .pixi-filter button.active' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'filter_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pixi-portfolio .pixi-filter button' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'filter_active_bg_color',
			[
				'label' => esc_html__( 'Active Background', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pixi-portfolio .pixi-filter button.active' => 'background: {{VALUE}}',
					'{{WRAPPER}} .pixi-portfolio .pixi-filter button:hover' => 'background: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'filter_text_color',
			[
				'label' => esc_html__( 'Color', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pixi-portfolio .pixi-filter button' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'filter_active_text_color',
			[
				'label' => esc_html__( 'Active text Color', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pixi-portfolio .pixi-filter button.active' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pixi-portfolio .pixi-filter button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'filter_padding',
			[
				'label' => esc_html__( 'Padding', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pixi-portfolio .pixi-filter button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'filter_spacing',
			[
				'label' => esc_html__( 'Spacing', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],

				'selectors' => [
					'{{WRAPPER}} .pixi-portfolio .pixi-filter' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'filter_item_spacing',
			[
				'label' => esc_html__( 'Item Spacing', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pixi-portfolio .pixi-filter button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

		


		// content Style

		$this->start_controls_section(
			'content_style_section',
			[
				'label' => esc_html__( 'Content Item', 'pixi-image-gallery' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'item_border',
				'label' => __( 'Border', 'pixi-image-gallery' ),
				'selector' => '{{WRAPPER}}  .pixi-inner-item',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'item_box_shadow',
				'label' => __( 'Box Shadow', 'pixi-image-gallery' ),
				'selector' => '{{WRAPPER}} .pixi-inner-item',
			]
		);

		$this->add_control(
			'content_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pixi-inner-item' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pixi-inner-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_radius',
			[
				'label' => esc_html__( 'Border radius', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pixi-inner-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render  widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$hover_effects_style = $settings['hover_effects_style'];

		if('zoomIn' == $hover_effects_style){
			$effect= "zoomIn";
		}
		elseif('shrink' == $hover_effects_style){
			$effect= "shrink";
		}
		elseif('zoomLeft' == $hover_effects_style){
			$effect= "zoomLeft";
		}
		else{
			$effect="";
		}

	

		$dynamic_id = rand(2345,565079);
		?>

		<!-- Start Portfolio here -->
		<div class="pixi-portfolio" id="pixi-<?php echo esc_attr($dynamic_id);?>">
				<div class="pixi-filter">
					<?php 
					if ( 'yes' === $settings['enable_filter'] ) { 
						?>
						<button class="active" data-filter="*"><?php echo esc_html($settings['all_title'],'pixi-image-gallery');?></button>
						
				
					
					<?php foreach($settings['filter_lists'] as $filter_item){ 
						$remove_space_filter = str_replace(' ', '', $filter_item['filter_name']);

						$final_filter_name = str_replace(',', ' ', $remove_space_filter);

						?>
						<button data-filter=".<?php echo esc_attr($final_filter_name,'pixi-image-gallery')?>"><?php echo esc_html($filter_item['filter_name'],'pixi-image-gallery');?></button>
					<?php } }?>
				</div>                       


				<div class="row pixi-grid pixi-gallery-wrapper <?php echo esc_attr($settings['column_gap']); ?>">
				<?php foreach($settings['gallery_lists'] as $gallery_item){ 
						
						$control_name_lists = explode(", ", $gallery_item['control_name']);

						$control_single_name = implode(" " ,$control_name_lists);

						$new_str_name = str_replace(' ', '', $gallery_item['control_name']);

						$new_str_name = str_replace(',', ' ', $new_str_name);

					?>

					<?php 
						if('style-2' == $gallery_item['layout_style']){
							$layout_class= "hover-content-style";
						}
				
						if('style-3' == $gallery_item['layout_style']){
							$layout_class= "overlay-content-style";
						}
					?>

					<div class="col-xl-<?php echo esc_attr($settings['column_option']); ?> col-lg-<?php echo esc_attr($settings['column_option']); ?>  col-md-<?php echo esc_attr($settings['column_option']); ?> grid-item <?php echo esc_attr($new_str_name,'pixi-image-gallery'); ?> elementor-repeater-item-<?php echo esc_attr( $gallery_item['_id'] )?>">

						<div class="pixi-inner-item <?php echo esc_attr($layout_class,'pixi-image-gallery');?>">
							<?php if ('media' == $gallery_item['link_option'] ){ ?>
								<a data-gall="pixiGallery"  class="port_popup img-fluid" href="<?php echo esc_url($gallery_item['widget_image']['url'],'pixi-image-gallery');?>">
							<?php } else { ?>
								<a target="_blank" href="<?php echo esc_url($gallery_item['widget_link']['url'],'pixi-image-gallery');?>">
							<?php } ?>
								<div class="pixi-inner-img <?php echo esc_attr($effect,'pixi-image-gallery');?> ">
									<img src="<?php echo esc_url($gallery_item['widget_image']['url'],'pixi-image-gallery');?>" 
									alt="<?php the_title_attribute()?>"  class="img-fluid">

										<div class="pixi-inner-content">
											<h4><?php echo esc_html($gallery_item['content_title'],'pixi-image-gallery');?></h4>
											<p><?php echo esc_html($gallery_item['content_desc'],'pixi-image-gallery');?></p>
										</div>
								</div>
							</a>
						</div>
					</div> 
					<?php } ?>
			</div>
		</div>
		<!-- End Portfolio here -->    
		
			
	


		<?php 

		

	}

}
