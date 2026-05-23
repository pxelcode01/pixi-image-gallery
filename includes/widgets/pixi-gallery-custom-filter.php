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
class pixi_image_gallery_custom_filter extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve widget name.
	 *
	 */
	public function get_name() {
		return 'pixi-img-gallery-custom-filter';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve  widget title.
	 */
	public function get_title() {
		return esc_html__( 'Pixi Custom Filter', 'pixi-image-gallery' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve  widget icon.
	 *
	 */
	public function get_icon() {
		return 'eicon-inner-section';
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
			'pixi-custom-post-filter',
			'popup-script',
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

		$this->add_control(
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

		$this->add_control(
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
			'show_content',
			[
				'label' => __( 'Show Content', 'pixi-image-gallery' ),
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

		$this->add_control(
			'cat_list',
			[
			  'label'     => esc_html__( 'Select Category', 'pixi-image-gallery' ),
			  'type'      => \Elementor\Controls_Manager::SELECT2,
			  'options'   => pixi_custom_taxonomy_list(),
			  'label_block' => true,
			  'multiple' => true,
			  'separator' => 'before',
			]
		);
		
	
		$this->add_control(
            'order',
            [
                'label' => __( 'Order', 'pixi-image-gallery' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
					'DESC'      => __( 'DESC', 'pixi-image-gallery' ),
					'ASC'       => __( 'ASC', 'pixi-image-gallery' ),
				],
				'default' => 'DESC',
            ]
        );

		$this->add_control(
            'order_by',
            [
                'label' => __( 'Order By', 'pixi-image-gallery' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
					'ID'      => __( 'ID', 'pixi-image-gallery' ),
					'date'       => __( 'Date', 'pixi-image-gallery' ),
					'name'       => __( 'Name', 'pixi-image-gallery' ),
					'rand'       => __( 'Random', 'pixi-image-gallery' ),
					'menu_order' => __( 'Menu Order', 'pixi-image-gallery' ),
					'none' => __( 'None', 'pixi-image-gallery' ),
				],
				'default' => 'none',
            ]
        );


        $this->add_control(
			'count',
			[
				'label' => __( 'Course Count', 'pixi-image-gallery' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => -1,
			]
		);

		$this->end_controls_section();

		

		//  Filter Control STyle controls

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

	}

	public function get_portfolio_tags($post_id){
		$gallery_tags = get_the_terms($post_id,'pixi_gallery_cat');
		$gallery_array = [];
		foreach($gallery_tags as $gallery_item){
			$gallery_array[$gallery_item->term_id] = $gallery_item->slug;
		}

		return join(' ',$gallery_array);
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
		$order = $settings['order'];
		$order_by = $settings['order_by'];
		$count = $settings['count'];
		$show_content = $settings['show_content'];
		

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

		

		?>

		<?php
		$pixi_args = array(
			'post_type'      => 'pixi_gallery_items',
			'posts_per_page' => $count,
			'orderby' => $order_by, 
			'order' => $order,
		);

		$pixi_loop = new \WP_Query($pixi_args);

		?>

		<!-- Start Portfolio here -->
		<div class="pixi-portfolio">
				<div class="pixi-filter">
					<?php 
					if ( 'yes' === $settings['enable_filter'] ) { 
						?>
						<button class="active" data-filter="*"><?php echo esc_html($settings['all_title'],'pixi-image-gallery');?></button>
						
					<?php } ?>
					
					<?php 
					$cat_item = $settings['cat_list'];

                    foreach ($cat_item as $key => $cat): 
						$term = get_term_by('slug', 'pixi_gallery_cat', 'pixi_gallery_items');
						?>
						<button data-filter=".<?php echo esc_attr($cat); ?>"><?php echo esc_html($cat); ?></button>
					<?php
                    endforeach;


				?>
					
					
				</div>                       


				<div class="row pixi-grid pixi-grid2 pixi-gallery-wrapper <?php echo esc_attr($settings['column_gap']); ?>">

				<?php
					while ( $pixi_loop->have_posts() ) :
						$pixi_loop->the_post();

						$portfolio_tags = $this->get_portfolio_tags(get_the_ID());
							
						?>

						<div class="<?php echo esc_attr($portfolio_tags ) ;?> col-xl-<?php echo esc_attr($settings['column_option']); ?> col-lg-<?php echo esc_attr($settings['column_option']); ?>  col-md-6 grid-item  ">

							<div class="pixi-inner-item">
								<?php if ('media' == $settings['link_option'] ){ ?>
									<a data-gall="pixiGallery"  class="port_popup img-fluid" href="<?php echo esc_url(the_post_thumbnail_url('large'),'pixi-image-gallery');?>">
								<?php } else { ?>
									<a target="_blank" href="<?php echo esc_url(the_permalink(),'pixi-image-gallery');?>">
								<?php } ?>

									<div class="<?php echo esc_attr($effect,'pixi-image-gallery');?>">
										<img src="<?php echo esc_url(the_post_thumbnail_url('large'),'pixi-image-gallery');?>" 
										alt="<?php the_title_attribute()?>"  class="img-fluid">
									</div>

									<?php if('yes' === $show_content):?>

									<div class="inner-content">
										<h3><?php the_title();?></h3>
										<?php the_content();?>
									</div>
									<?php endif; ?>
								</a>
							</div>
						</div> 
						<?php
					   endwhile; 
					  wp_reset_query();
					?>
			</div>
		</div>
		<!-- End Portfolio here -->    
		

		<?php 
		   
		

	}

}
