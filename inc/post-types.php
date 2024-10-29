<?php

/**
 * Registers all required custom post type
 *
 * @package    	Bella_Kit
 * @link        https://bellathemes.com/
 * Author:      Bellathemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
global $enable_cpt;
$enable_cpt = get_option('bellakit_components_enable_cpt');
// Register the Services custom post type
if( isset( $enable_cpt['services']) ):
function Bellakit_register_services(){ 
	global $enable_cpt;
	$labels = array(
		'name'                  => _x( 'Services', 'Post Type General Name', 'bella-kit' ),
		'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'bella-kit' ),
		'menu_name'             => __( 'Services', 'bella-kit' ),
		'name_admin_bar'        => __( 'Services', 'bella-kit' ),
		'archives'              => __( 'Item Archives', 'bella-kit' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bella-kit' ),
		'all_items'             => __( 'All Services', 'bella-kit' ),
		'add_new_item'          => __( 'Add New Service', 'bella-kit' ),
		'add_new'               => __( 'Add New Service', 'bella-kit' ),
		'new_item'              => __( 'New Service', 'bella-kit' ),
		'edit_item'             => __( 'Edit Service', 'bella-kit' ),
		'update_item'           => __( 'Update Service', 'bella-kit' ),
		'view_item'             => __( 'View Service', 'bella-kit' ),
		'search_items'          => __( 'Search Service', 'bella-kit' ),
		'not_found'             => __( 'Not found', 'bella-kit' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bella-kit' ),
		'featured_image'        => __( 'Featured Image', 'bella-kit' ),
		'set_featured_image'    => __( 'Set featured image', 'bella-kit' ),
		'remove_featured_image' => __( 'Remove featured image', 'bella-kit' ),
		'use_featured_image'    => __( 'Use as featured image', 'bella-kit' ),
		'insert_into_item'      => __( 'Insert into item', 'bella-kit' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bella-kit' ),
		'items_list'            => __( 'Items list', 'bella-kit' ),
		'items_list_navigation' => __( 'Items list navigation', 'bella-kit' ),
		'filter_items_list'     => __( 'Filter items list', 'bella-kit' ),
	);
	$args = array(
		'label'                 => __( 'Service', 'bella-kit' ),
		'description'           => __( 'A post type for your services', 'bella-kit' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 26,
		'menu_icon'             => 'dashicons-portfolio',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite' 				=> array( 'slug' => 'services' ),		
	);

	if( isset( $enable_cpt['category']['services'] ) ){
		$args['taxonomies'] = array( 'category' );
   }
   

	register_post_type( 'services', $args );

}
 add_action( 'init', 'Bellakit_register_services', 0 );
endif;

// Register the Team custom post type
if( isset( $enable_cpt['team']) ):
function Bellakit_register_team() {	
	global $enable_cpt;
	$labels = array(
		'name'                  => _x( 'Team', 'Post Type General Name', 'bella-kit' ),
		'singular_name'         => _x( 'Team', 'Post Type Singular Name', 'bella-kit' ),
		'menu_name'             => __( 'Team', 'bella-kit' ),
		'name_admin_bar'        => __( 'Team', 'bella-kit' ),
		'archives'              => __( 'Item Archives', 'bella-kit' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bella-kit' ),
		'all_items'             => __( 'All Team', 'bella-kit' ),
		'add_new_item'          => __( 'Add New Team', 'bella-kit' ),
		'add_new'               => __( 'Add New Team', 'bella-kit' ),
		'new_item'              => __( 'New Team', 'bella-kit' ),
		'edit_item'             => __( 'Edit Team', 'bella-kit' ),
		'update_item'           => __( 'Update Team', 'bella-kit' ),
		'view_item'             => __( 'View Team', 'bella-kit' ),
		'search_items'          => __( 'Search Team', 'bella-kit' ),
		'not_found'             => __( 'Not found', 'bella-kit' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bella-kit' ),
		'featured_image'        => __( 'Featured Image', 'bella-kit' ),
		'set_featured_image'    => __( 'Set featured image', 'bella-kit' ),
		'remove_featured_image' => __( 'Remove featured image', 'bella-kit' ),
		'use_featured_image'    => __( 'Use as featured image', 'bella-kit' ),
		'insert_into_item'      => __( 'Insert into item', 'bella-kit' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bella-kit' ),
		'items_list'            => __( 'Items list', 'bella-kit' ),
		'items_list_navigation' => __( 'Items list navigation', 'bella-kit' ),
		'filter_items_list'     => __( 'Filter items list', 'bella-kit' ),
	);
	$args = array(
		'label'                 => __( 'Team', 'bella-kit' ),
		'description'           => __( 'A post type for your team', 'bella-kit' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 26,
		'menu_icon'             => 'dashicons-businessman',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite' 				=> array( 'slug' => 'team' ),		
	);
	if( isset( $enable_cpt['category']['team'] ) ){
		$args['taxonomies'] = array( 'category' );
   }
   
	register_post_type( 'team', $args );

}
add_action( 'init', 'Bellakit_register_team', 0 );
endif;


// Register the Testimonials custom post type
if( isset( $enable_cpt['testimonials']) ):
function Bellakit_register_testimonials() {

    global $enable_cpt;
	$labels = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'bella-kit' ),
		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'bella-kit' ),
		'menu_name'             => __( 'Testimonials', 'bella-kit' ),
		'name_admin_bar'        => __( 'Testimonials', 'bella-kit' ),
		'archives'              => __( 'Item Archives', 'bella-kit' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bella-kit' ),
		'all_items'             => __( 'All Testimonials', 'bella-kit' ),
		'add_new_item'          => __( 'Add New Testimonial', 'bella-kit' ),
		'add_new'               => __( 'Add New Testimonial', 'bella-kit' ),
		'new_item'              => __( 'New Testimonial', 'bella-kit' ),
		'edit_item'             => __( 'Edit Testimonial', 'bella-kit' ),
		'update_item'           => __( 'Update Testimonial', 'bella-kit' ),
		'view_item'             => __( 'View Testimonial', 'bella-kit' ),
		'search_items'          => __( 'Search Testimonial', 'bella-kit' ),
		'not_found'             => __( 'Not found', 'bella-kit' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bella-kit' ),
		'featured_image'        => __( 'Featured Image', 'bella-kit' ),
		'set_featured_image'    => __( 'Set featured image', 'bella-kit' ),
		'remove_featured_image' => __( 'Remove featured image', 'bella-kit' ),
		'use_featured_image'    => __( 'Use as featured image', 'bella-kit' ),
		'insert_into_item'      => __( 'Insert into item', 'bella-kit' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bella-kit' ),
		'items_list'            => __( 'Items list', 'bella-kit' ),
		'items_list_navigation' => __( 'Items list navigation', 'bella-kit' ),
		'filter_items_list'     => __( 'Filter items list', 'bella-kit' ),
	);
	$args = array(
		'label'                 => __( 'Testimonial', 'bella-kit' ),
		'description'           => __( 'A post type for your testimonials', 'bella-kit' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'taxonomies'            => array( 'testimonial-category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 26,
		'menu_icon'             => 'dashicons-heart',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite' 				=> array( 'slug' => 'testimonials' ),
	);

	if( isset( $enable_cpt['category']['testimonials'] ) ){
		$args['taxonomies'] = array( 'category' );
   }
   
	register_post_type( 'testimonials', $args );

}
add_action( 'init', 'Bellakit_register_testimonials', 0 );
endif;


// Register the Projects custom post type
if( isset( $enable_cpt['projects']) ):
function Bellakit_register_projects() {	
	global $enable_cpt;
	$labels = array(
		'name'                  => _x( 'Projects', 'Post Type General Name', 'bella-kit' ),
		'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'bella-kit' ),
		'menu_name'             => __( 'Projects', 'bella-kit' ),
		'name_admin_bar'        => __( 'Projects', 'bella-kit' ),
		'archives'              => __( 'Item Archives', 'bella-kit' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bella-kit' ),
		'all_items'             => __( 'All Projects', 'bella-kit' ),
		'add_new_item'          => __( 'Add New Project', 'bella-kit' ),
		'add_new'               => __( 'Add New Project', 'bella-kit' ),
		'new_item'              => __( 'New Project', 'bella-kit' ),
		'edit_item'             => __( 'Edit Project', 'bella-kit' ),
		'update_item'           => __( 'Update Project', 'bella-kit' ),
		'view_item'             => __( 'View Project', 'bella-kit' ),
		'search_items'          => __( 'Search Project', 'bella-kit' ),
		'not_found'             => __( 'Not found', 'bella-kit' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bella-kit' ),
		'featured_image'        => __( 'Featured Image', 'bella-kit' ),
		'set_featured_image'    => __( 'Set featured image', 'bella-kit' ),
		'remove_featured_image' => __( 'Remove featured image', 'bella-kit' ),
		'use_featured_image'    => __( 'Use as featured image', 'bella-kit' ),
		'insert_into_item'      => __( 'Insert into item', 'bella-kit' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bella-kit' ),
		'items_list'            => __( 'Items list', 'bella-kit' ),
		'items_list_navigation' => __( 'Items list navigation', 'bella-kit' ),
		'filter_items_list'     => __( 'Filter items list', 'bella-kit' ),
	);
	$args = array(
		'label'                 => __( 'Project/Portfolio', 'bella-kit' ),
		'description'           => __( 'A post type for your projects', 'bella-kit' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 26,
		'menu_icon'             => 'dashicons-desktop',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite' 				=> array( 'slug' => 'projects' ),		
	);

	if( isset( $enable_cpt['category']['projects'] ) ){
		$args['taxonomies'] = array( 'category' );
   }
   

	register_post_type( 'projects', $args );

}
add_action( 'init', 'Bellakit_register_projects', 0 );
endif;






// Register the Clients custom post type
if( isset( $enable_cpt['clients']) ):
function Bellakit_register_clients() {
	global $enable_cpt;
	$labels = array(
		'name'                  => _x( 'Clients', 'Post Type General Name', 'bella-kit' ),
		'singular_name'         => _x( 'Client', 'Post Type Singular Name', 'bella-kit' ),
		'menu_name'             => __( 'Clients', 'bella-kit' ),
		'name_admin_bar'        => __( 'Clients', 'bella-kit' ),
		'archives'              => __( 'Item Archives', 'bella-kit' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bella-kit' ),
		'all_items'             => __( 'All Clients', 'bella-kit' ),
		'add_new_item'          => __( 'Add New Client', 'bella-kit' ),
		'add_new'               => __( 'Add New Client', 'bella-kit' ),
		'new_item'              => __( 'New Client', 'bella-kit' ),
		'edit_item'             => __( 'Edit Client', 'bella-kit' ),
		'update_item'           => __( 'Update Client', 'bella-kit' ),
		'view_item'             => __( 'View Client', 'bella-kit' ),
		'search_items'          => __( 'Search Client', 'bella-kit' ),
		'not_found'             => __( 'Not found', 'bella-kit' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bella-kit' ),
		'featured_image'        => __( 'Featured Image', 'bella-kit' ),
		'set_featured_image'    => __( 'Set featured image', 'bella-kit' ),
		'remove_featured_image' => __( 'Remove featured image', 'bella-kit' ),
		'use_featured_image'    => __( 'Use as featured image', 'bella-kit' ),
		'insert_into_item'      => __( 'Insert into item', 'bella-kit' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bella-kit' ),
		'items_list'            => __( 'Items list', 'bella-kit' ),
		'items_list_navigation' => __( 'Items list navigation', 'bella-kit' ),
		'filter_items_list'     => __( 'Filter items list', 'bella-kit' ),
	);
	$args = array(
		'label'                 => __( 'Client', 'bella-kit' ),
		'description'           => __( 'A post type for your clients', 'bella-kit' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 26,
		'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite' 				=> array( 'slug' => 'clients' ),
	);

	if( isset( $enable_cpt['category']['clients'] ) ){
		$args['taxonomies'] = array( 'category' );
   }
   
	register_post_type( 'clients', $args );

}
add_action( 'init', 'Bellakit_register_clients', 0 );
endif;




// Register the  Pricing tables post type
if( isset( $enable_cpt['pricing_tables']) ):
function Bellakit_register_pricing_tables() {
	global $enable_cpt;
	$labels = array(
		'name'                  => _x( 'Pricing Tables', 'Post Type General Name', 'bella-kit' ),
		'singular_name'         => _x( 'Pricing Table', 'Post Type Singular Name', 'bella-kit' ),
		'menu_name'             => __( 'Pricing Tables', 'bella-kit' ),
		'name_admin_bar'        => __( 'Pricing Tables', 'bella-kit' ),
		'archives'              => __( 'Item Archives', 'bella-kit' ),
		'parent_item_colon'     => __( 'Parent Item:', 'bella-kit' ),
		'all_items'             => __( 'All Pricing Tables', 'bella-kit' ),
		'add_new_item'          => __( 'Add New Pricing Table', 'bella-kit' ),
		'add_new'               => __( 'Add New Pricing Table', 'bella-kit' ),
		'new_item'              => __( 'New Pricing Table', 'bella-kit' ),
		'edit_item'             => __( 'Edit Pricing Table', 'bella-kit' ),
		'update_item'           => __( 'Update Pricing Table', 'bella-kit' ),
		'view_item'             => __( 'View Pricing Table', 'bella-kit' ),
		'search_items'          => __( 'Search Pricing Table', 'bella-kit' ),
		'not_found'             => __( 'Not found', 'bella-kit' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'bella-kit' ),
		'featured_image'        => __( 'Featured Image', 'bella-kit' ),
		'set_featured_image'    => __( 'Set featured image', 'bella-kit' ),
		'remove_featured_image' => __( 'Remove featured image', 'bella-kit' ),
		'use_featured_image'    => __( 'Use as featured image', 'bella-kit' ),
		'insert_into_item'      => __( 'Insert into item', 'bella-kit' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'bella-kit' ),
		'items_list'            => __( 'Items list', 'bella-kit' ),
		'items_list_navigation' => __( 'Items list navigation', 'bella-kit' ),
		'filter_items_list'     => __( 'Filter items list', 'bella-kit' ),
	);
	$args = array(
		'label'                 => __( 'Pricing Tables', 'bella-kit' ),
		'description'           => __( 'A post type for your Pricing Tables', 'bella-kit' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 26,
		'menu_icon'             => 'dashicons-format-chat',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'rewrite' 				=> array( 'slug' => 'pricing_tables' ),		
	);

	if( isset( $enable_cpt['category']['pricing_tables'] ) ){
		$args['taxonomies'] = array( 'category' );
   }
   
	register_post_type( 'pricing_tables', $args );

}
add_action( 'init', 'Bellakit_register_pricing_tables', 0 );
endif;