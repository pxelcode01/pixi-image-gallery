<div class="ele-inner-item ele-inner-col ele-hover-style-2">
    <div class="ele-image">
        <img src="<?php echo esc_url($settings['widget_inage']['url'],'pixi-image-gallery');?>" alt="<?php echo esc_attr($settings['widget_title'],'pixi-image-gallery');?>" class="img-fluid">

        <div class="portfolio-icon">
            <ul>
                <li><a href="<?php echo esc_url($settings['widget_link']['url'],'pixi-image-gallery');?>"><i class="lni lni-link"></i></a></li>
                <li><a class="port_popup" href="<?php echo esc_url($settings['widget_link']['url'],'pixi-image-gallery');?>"><i class="lni lni-search-alt"></i></a></li>
            </ul>
        </div>
    </div>

    <div class="ele-portfolio-content">
        <h3 class="ele-title"> <a href="<?php echo esc_url($settings['widget_link']['url'],'pixi-image-gallery');?>"> <?php echo esc_html($settings['widget_title'],'pixi-image-gallery');?></a></h3>
        <strong><?php echo esc_html($settings['widget_desc'],'pixi-image-gallery');?></strong>
    </div>
</div>
