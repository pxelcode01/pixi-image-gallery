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
class pixi_image_gallery_lite extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve widget name.
	 *
	 */
	public function get_name() {
		return 'pixi-img-gallery';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve  widget title.
	 */
	public function get_title() {
		return esc_html__( 'Pixi Image Gallery', 'pixi-image-gallery' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve  widget icon.
	 *
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
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
	 * Register  widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.

	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'pixi-image-gallery' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'select_content_style',
			[
				'label' => esc_html__( 'Select Layout Style', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => esc_html__( 'Default', 'pixi-image-gallery' ),
					'overlay'  => esc_html__( 'Image Overlay', 'pixi-image-gallery' ),
					'hover-content'  => esc_html__( 'Hover-content', 'pixi-image-gallery' ),
				],
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
				'default' => '3',
				'options' => [
					'1' => esc_html__( '1', 'pixi-image-gallery' ),
					'2' => esc_html__( '2', 'pixi-image-gallery' ),
					'3' => esc_html__( '3', 'pixi-image-gallery' ),
					'4' => esc_html__( '4', 'pixi-image-gallery' ),
					'5'  => esc_html__( '5', 'pixi-image-gallery' ),
					'6'  => esc_html__( '6', 'pixi-image-gallery' ),
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
					'g-custom' => esc_html__( 'Custom', 'pixi-image-gallery' ),
				],
			]
		);

		$this->add_responsive_control(
			'content_item_spacing',
			[
				'label' => esc_html__( 'Spacing', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .pixi-portfolio .pixi-inner-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
			'column_display',
			[
				'label' => esc_html__( 'Display', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'flex',
				'options' => [
					'default' => esc_html__( 'None', 'pixi-image-gallery' ),
					'block' => esc_html__( 'Block', 'pixi-image-gallery' ),
					'flex' => esc_html__( 'Flex', 'pixi-image-gallery' ),
				],
				'selectors' => [
					'{{WRAPPER}} .pixi-gallery-wrapper .gallery-inner ' => 'display: {{UNIT}};',
				],
			]
		);

		$this->add_control(
			'column_align',
			[
				'label' => esc_html__( 'Vertical Align', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'center',
				'options' => [
					'none' => esc_html__( 'None', 'pixi-image-gallery' ),
					'start' => esc_html__( 'Top', 'pixi-image-gallery' ),
					'center' => esc_html__( 'Center', 'pixi-image-gallery' ),
					'end' => esc_html__( 'Bottom', 'pixi-image-gallery' ),
				],
				'selectors' => [
					'{{WRAPPER}} .pixi-gallery-wrapper .gallery-inner ' => 'align-items: {{UNIT}};',
				],
			]
		);

		// Repeater Start

		$repeater = new \Elementor\Repeater();

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
			'show_content',
			[
				'label' => esc_html__( 'Show Conent', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'pixi-image-gallery' ),
				'label_off' => esc_html__( 'Hide', 'pixi-image-gallery' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your title', 'pixi-image-gallery' ),
				'default' => esc_html__( 'John Doe', 'pixi-image-gallery' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'condition' => [
					'show_content' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'heading_tag',
			[
				'label' => 'Title Tag',
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'h4',
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
				],
			]
		);

		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( 'Content', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Enter your content', 'pixi-image-gallery' ),
				'default' => esc_html__( 'Creative Designer', 'pixi-image-gallery' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'show_content' => 'yes',
				],
			]
		);


		$repeater->add_control(
			'link_option',
			[
				'label' => esc_html__( 'Link', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'media',
				'options' => [
					'none'  => esc_html__( 'None', 'pixi-image-gallery' ),
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

		// Repeater End


		$this->end_controls_section();


		//  STyle controls

		$this->start_controls_section(
			'img_style_section',
			[
				'label' => esc_html__( 'Image', 'pixi-image-gallery' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'img_border',
				'label' => __( 'Border', 'pixi-image-gallery' ),
				'selector' => '{{WRAPPER}}  .pixi-inner-item img',
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


	
		$this->start_controls_section(
			'main_content_style_section',
			[
				'label' => esc_html__( 'Main Content', 'pixi-image-gallery' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_align',
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
				'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .pixi-content .heading-title,
					{{WRAPPER}} .pixi-content p' => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->start_controls_tabs(
			'title_style_tabs'
		);

		$this->start_controls_tab(
			'title_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'pixi-image-gallery' ),
			]
		);
        $this->add_control(
			'item_title',
			[
				'label' => esc_html__( 'Color', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pixi-content .heading-title' => 'color: {{VALUE}}',
				],
			]
		);
	

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'pixi-image-gallery' ),
			]
		);
        $this->add_control(
			'item_hover_title',
			[
				'label' => esc_html__( 'Color', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-single-item.overlay:hover > .pixi-content .heading-title' => 'color: {{VALUE}}',
				],
			]
		);
    

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'item_title_typography',
				'selector' => '{{WRAPPER}} .pixi-content .heading-title',
			]
		);

		
        $this->start_controls_tabs(
			'desc_style_tabs'
		);

		$this->start_controls_tab(
			'desc_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'pixi-image-gallery' ),
			]
		);
        $this->add_control(
			'item_content',
			[
				'label' => esc_html__( 'Color', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pixi-content p' => 'color: {{VALUE}}',
				],
			]
		);
	

		$this->end_controls_tab();

		$this->start_controls_tab(
			'desc_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'pixi-image-gallery' ),
			]
		);
        $this->add_control(
			'item_hover_content',
			[
				'label' => esc_html__( 'Color', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery-single-item.overlay:hover > .pixi-content p' => 'color: {{VALUE}}',
				],
			]
		);
		

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'item_desc_typography',
				'selector' => '{{WRAPPER}} .pixi-content p',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'overlay_content_bg_color',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .gallery-single-item.overlay::after',
			]
		);

		$this->add_control(
			'text_content_padding',
			[
				'label' => esc_html__( 'Padding', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pixi-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Spacing', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pixi-content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'desc_margin',
			[
				'label' => esc_html__( 'Description Spacing', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pixi-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$select_content_style = $settings['select_content_style'];

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

		if('default' == $select_content_style){
			$layout= "default";
		}
		elseif('overlay' == $select_content_style){
			$layout= "overlay";
		}
		elseif('hover-content' == $select_content_style){
			$layout= "hover-content";
		}
		else{
			$layout="";
		}

		
		?>
		<div class="pixi-gallery-wrapper">
			<div class="gallery-inner gallery-columns-<?php echo esc_attr($settings['column_option']); ?> ">

				<?php foreach($settings['gallery_lists'] as $gallery_item){
					?>
					<div class="pixi-inner-item elementor-repeater-item-<?php echo esc_attr( $gallery_item['_id'] )?>">
						<?php if ('media' == $gallery_item['link_option'] ){ ?>
							<a data-gall="pixiGallery"  class="port_popup img-fluid" href="<?php echo esc_url($gallery_item['widget_image']['url'],'pixi-image-gallery');?>">
						<?php } else { ?>
							<a target="_blank" href="<?php echo esc_url($gallery_item['widget_link']['url'],'pixi-image-gallery');?>">
						<?php } ?>
							<div class="gallery-single-item <?php echo esc_attr($effect,'pixi-image-gallery');?> <?php echo esc_attr($layout,'pixi-image-gallery');?>">
								<div class="gallery-single-item-img">
									<img src="<?php echo esc_url($gallery_item['widget_image']['url'],'pixi-image-gallery');?>" 
										alt="<?php the_title_attribute()?>"  class="img-fluid">
								</div>	

								<?php 	if ( 'yes' === $gallery_item['show_content'] ) { ?>
									<div class="pixi-content">
									<?php 
										if ( ! empty( $gallery_item['title'] ) ) {

											// Allowed tags for safety
											$allowed_tags = ['h1','h2','h3','h4','h5','h6','div','span'];
											$tag = in_array( $tag, $allowed_tags ) ? $tag : 'h4';

											// Reset attributes (VERY IMPORTANT to avoid duplicate classes)
											$this->remove_render_attribute( 'title_' . $index );

											// Add ONLY one class
											$this->add_render_attribute(
												'title_' . $index,
												[
													'class' => 'heading-title',
													'title' => $gallery_item['title'], // optional
												]
											);

											// Render
											echo sprintf(
												'<%1$s %2$s>%3$s</%1$s>',
												esc_html( $tag ),
												$this->get_render_attribute_string( 'title_' . $index ),
												esc_html( $gallery_item['title'] )
											);
										}
										?>

										<?php if(!empty($gallery_item['content']))  { ?>
											<p><?php echo wp_kses($gallery_item['content'],'pixi-image-gallery');?></p>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>

	
	


		<?php 

	}

}
