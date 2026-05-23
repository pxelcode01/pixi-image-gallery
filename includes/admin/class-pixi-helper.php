<?php 
// Register Custom Post Type pixi gallery items
function create_pixigalleryitems_cpt() {

	$labels = array(
		'name' => _x( 'Pixi Gallerys', 'Post Type General Name', 'pixi-image-gallery' ),
		'singular_name' => _x( 'pixi gallery items', 'Post Type Singular Name', 'pixi-image-gallery' ),
		'menu_name' => _x( 'Pixi Gallerys', 'Admin Menu text', 'pixi-image-gallery' ),
		'name_admin_bar' => _x( 'pixi gallery items', 'Add New on Toolbar', 'pixi-image-gallery' ),
		'archives' => __( 'pixi gallery items Archives', 'pixi-image-gallery' ),
		'attributes' => __( 'pixi gallery items Attributes', 'pixi-image-gallery' ),
		'parent_item_colon' => __( 'Parent pixi gallery items:', 'pixi-image-gallery' ),
		'all_items' => __( 'Pixi Gallerys', 'pixi-image-gallery' ),
		'add_new_item' => __( 'Add New pixi gallery items', 'pixi-image-gallery' ),
		'add_new' => __( 'Add New', 'pixi-image-gallery' ),
		'new_item' => __( 'New pixi gallery items', 'pixi-image-gallery' ),
		'edit_item' => __( 'Edit pixi gallery items', 'pixi-image-gallery' ),
		'update_item' => __( 'Update pixi gallery items', 'pixi-image-gallery' ),
		'view_item' => __( 'View pixi gallery items', 'pixi-image-gallery' ),
		'view_items' => __( 'View Pixi Gallerys', 'pixi-image-gallery' ),
		'search_items' => __( 'Search pixi gallery items', 'pixi-image-gallery' ),
		'not_found' => __( 'Not found', 'pixi-image-gallery' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'pixi-image-gallery' ),
		'featured_image' => __( 'Featured Image', 'pixi-image-gallery' ),
		'set_featured_image' => __( 'Set featured image', 'pixi-image-gallery' ),
		'remove_featured_image' => __( 'Remove featured image', 'pixi-image-gallery' ),
		'use_featured_image' => __( 'Use as featured image', 'pixi-image-gallery' ),
		'insert_into_item' => __( 'Insert into pixi gallery items', 'pixi-image-gallery' ),
		'uploaded_to_this_item' => __( 'Uploaded to this pixi gallery items', 'pixi-image-gallery' ),
		'items_list' => __( 'Pixi Gallerys list', 'pixi-image-gallery' ),
		'items_list_navigation' => __( 'Pixi Gallerys list navigation', 'pixi-image-gallery' ),
		'filter_items_list' => __( 'Filter Pixi Gallerys list', 'pixi-image-gallery' ),
	);
	$args = array(
		'label' => __( 'pixi gallery items', 'pixi-image-gallery' ),
		'description' => __( '', 'pixi-image-gallery' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-format-gallery',
		'supports' => array('title', 'editor', 'thumbnail'),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => true,
		'exclude_from_search' => false,
		'show_in_rest' => false,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'pixi_gallery_items', $args );

}
add_action( 'init', 'create_pixigalleryitems_cpt', 0 );

// Register Taxonomy Category
function create_category_tax() {

	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'pixi-image-gallery' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'pixi-image-gallery' ),
		'search_items'      => __( 'Search Categories', 'pixi-image-gallery' ),
		'all_items'         => __( 'All Categories', 'pixi-image-gallery' ),
		'parent_item'       => __( 'Parent Category', 'pixi-image-gallery' ),
		'parent_item_colon' => __( 'Parent Category:', 'pixi-image-gallery' ),
		'edit_item'         => __( 'Edit Category', 'pixi-image-gallery' ),
		'update_item'       => __( 'Update Category', 'pixi-image-gallery' ),
		'add_new_item'      => __( 'Add New Category', 'pixi-image-gallery' ),
		'new_item_name'     => __( 'New Category Name', 'pixi-image-gallery' ),
		'menu_name'         => __( 'Category', 'pixi-image-gallery' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( '', 'pixi-image-gallery' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => true,
		'show_in_rest' => true,
	);
	register_taxonomy( 'pixi_gallery_cat', array('pixi_gallery_items'), $args );

}
add_action( 'init', 'create_category_tax' );

//  Create Custom post
// function pixi_gallery_custom_post_type() {
//     register_post_type('pixi_gallery_items',
//         array(
//             'labels'      => array(
//                 'name'          => __('Pixi Gallerys', 'pixi-image-gallery'),
//                 'singular_name' => __('Pixi Gallery', 'pixi-image-gallery'),
//             ),
//                 'public'      => true,
//                 'has_archive' => true,
//                 'supports'      => array( 'title', 'editor', 'thumbnail' ),
//         )
//     );
// }
// add_action('init', 'pixi_gallery_custom_post_type');


// Creat Taxonomoy
// function pixi_img_gallery_taxonomy() {
//     $args = array(
//         'label'        => __( 'Category', 'pixi-image-gallery' ),
//         'public'       => true,
//         'rewrite'      => false,
//         'hierarchical' => true
//     );
     
//     register_taxonomy( 'pixi_gallery_cat', 'pixi_gallery_items', $args );
// }
// add_action( 'init', 'pixi_img_gallery_taxonomy', 0 );



/**
 * Render  Custom POst type fucntion
 */

function pixi_custom_taxonomy_list( ) {
    $taxonomy_name = 'pixi_gallery_cat';
    $elements = get_terms( $taxonomy_name, array('hide_empty' => false) );

    $cpt_cat_array = array();

    if ( !empty($elements) ) {
        foreach ( $elements as $element ) {

            $info = get_term($element, $taxonomy_name);
            $cpt_cat_array[ $info->slug ] = $info->name;
        }
    }

    return $cpt_cat_array;
}

// 

// function pixi_taxonomy_name( ) {
//     $taxonomy_name = 'pixi_gallery_cat';
//     $elements =  wp_get_post_terms(get_the_ID(), $taxonomy_name, array('hide_empty' => false) );
//     $cpt_cat_array = array();

//     if ( !empty($elements) ) {
//         foreach ( $elements as $element ) {

//             $info = get_term($element, $taxonomy_name);
//             $cpt_cat_array[ $info->slug ] = $info->name;
//         }
//     }

//     return $cpt_cat_array;
// }

	
// cusotm post type taxonomy lits


// function pixi_taxonomy_lists (){
//     $taxonomy_name = 'pixi_gallery_cat';

//     $terms = get_the_terms( get_the_ID(),$taxonomy_name, array('hide_empty' => false) );

//     if ($terms && ! is_wp_error($terms)) :
//         $tslugs_arr = array();

//         foreach ($terms as $term) {
//             $tslugs_arr[$term->term_id] = $term->slug;
//         }
//         return $tslugs_arr;
//     endif;

// }
    
    // function pixi_taxonomy_lists (){
    // $taxonomy_name = 'pixi_gallery_cat';

    // $terms = get_the_terms( get_the_ID(),$taxonomy_name, array('hide_empty' => false) );

    // if ($terms && ! is_wp_error($terms)) :
    //     $tslugs_arr = array();

    //     foreach ($terms as $term) {
    //         $tslugs_arr[$term->term_id] = $term->slug;
    //     }
    //     return join( " ", $tslugs_arr);
    // endif;

    // }