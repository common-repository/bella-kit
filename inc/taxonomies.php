<?php
/**
 * Register taxonomies for respective custom post types
 *
 * @package    	Bella_Kit
 * @link        https://bellathemes.com/
 * Author:      Bellathemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

global $enable_cpt;

// Register service-category
if( isset( $enable_cpt['taxonomy']['services'] ) ):
	function Bellakit_register_service_category() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Service Categories', 'taxonomy general name', 'bella-kit' ),
			'singular_name'     => _x( 'Service Category', 'taxonomy singular name', 'bella-kit' ),
			'search_items'      => __( 'Search Service Category', 'bella-kit' ),
			'all_items'         => __( 'All Service Category', 'bella-kit' ),
			'parent_item'       => __( 'Parent Service Category', 'bella-kit' ),
			'parent_item_colon' => __( 'Parent Service Category:', 'bella-kit' ),
			'edit_item'         => __( 'Edit Service Category', 'bella-kit' ),
			'update_item'       => __( 'Update Service Category', 'bella-kit' ),
			'add_new_item'      => __( 'Add New Service Category', 'bella-kit' ),
			'new_item_name'     => __( 'New Service Category Name', 'bella-kit' ),
			'menu_name'         => __( 'Service Category', 'bella-kit' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'service-category' ),
		);

		register_taxonomy( 'service-category', array( 'services' ), $args );
	}
	add_action( 'init', 'Bellakit_register_service_category' );
endif;

// Register team-category
if( isset( $enable_cpt['taxonomy']['team'] ) ):
	function Bellakit_register_team_category() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Team Categories', 'taxonomy general name', 'bella-kit' ),
			'singular_name'     => _x( 'Team Category', 'taxonomy singular name', 'bella-kit' ),
			'search_items'      => __( 'Search Team Category', 'bella-kit' ),
			'all_items'         => __( 'All Team Category', 'bella-kit' ),
			'parent_item'       => __( 'Parent Team Category', 'bella-kit' ),
			'parent_item_colon' => __( 'Parent Team Category:', 'bella-kit' ),
			'edit_item'         => __( 'Edit Team Category', 'bella-kit' ),
			'update_item'       => __( 'Update Team Category', 'bella-kit' ),
			'add_new_item'      => __( 'Add New Category', 'bella-kit' ),
			'new_item_name'     => __( 'New Team Category Name', 'bella-kit' ),
			'menu_name'         => __( 'Team Category', 'bella-kit' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'team-category' ),
		);

		register_taxonomy( 'team-category', array( 'team' ), $args );
	}
	add_action( 'init', 'Bellakit_register_team_category' );
endif;

// Register testimonial-category
if( isset( $enable_cpt['taxonomy']['testimonials'] ) ):
	function Bellakit_register_testimonial_category() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Testimonial Categories', 'taxonomy general name', 'bella-kit' ),
			'singular_name'     => _x( 'Testimonial Category', 'taxonomy singular name', 'bella-kit' ),
			'search_items'      => __( 'Search Testimonial Category', 'bella-kit' ),
			'all_items'         => __( 'All Testimonial Category', 'bella-kit' ),
			'parent_item'       => __( 'Parent Testimonial Category', 'bella-kit' ),
			'parent_item_colon' => __( 'Parent Testimonial Category:', 'bella-kit' ),
			'edit_item'         => __( 'Edit Testimonial Category', 'bella-kit' ),
			'update_item'       => __( 'Update Testimonial Category', 'bella-kit' ),
			'add_new_item'      => __( 'Add New Testimonial Category', 'bella-kit' ),
			'new_item_name'     => __( 'New Testimonial Category Name', 'bella-kit' ),
			'menu_name'         => __( 'Testimonial Category', 'bella-kit' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'testimonial-category' ),
		);

		register_taxonomy( 'testimonial-category', array( 'testimonials' ), $args );
	}
	add_action( 'init', 'Bellakit_register_testimonial_category' );
endif;


// Register project-category
if( isset( $enable_cpt['taxonomy']['projects'] ) ):
	function Bellakit_register_project_category() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Project Categories', 'taxonomy general name', 'bella-kit' ),
			'singular_name'     => _x( 'Project Category', 'taxonomy singular name', 'bella-kit' ),
			'search_items'      => __( 'Search Project Category', 'bella-kit' ),
			'all_items'         => __( 'All Project Project Category', 'bella-kit' ),
			'parent_item'       => __( 'Parent Project Category', 'bella-kit' ),
			'parent_item_colon' => __( 'Parent Project Category:', 'bella-kit' ),
			'edit_item'         => __( 'Edit Project Category', 'bella-kit' ),
			'update_item'       => __( 'Update Project Category', 'bella-kit' ),
			'add_new_item'      => __( 'Add New Project Category', 'bella-kit' ),
			'new_item_name'     => __( 'New Project Category Name', 'bella-kit' ),
			'menu_name'         => __( 'Project Category', 'bella-kit' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'project-category' ),
		);

		register_taxonomy( 'project-category', array( 'projects' ), $args );
	}
	add_action( 'init', 'Bellakit_register_project_category' );
endif;


// Register event-category
if( isset( $enable_cpt['taxonomy']['events'] ) ):
	function Bellakit_register_event_category() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Event Categories', 'taxonomy general name', 'bella-kit' ),
			'singular_name'     => _x( 'Event Category', 'taxonomy singular name', 'bella-kit' ),
			'search_items'      => __( 'Search Event Category', 'bella-kit' ),
			'all_items'         => __( 'All Event Category', 'bella-kit' ),
			'parent_item'       => __( 'Parent Event Category', 'bella-kit' ),
			'parent_item_colon' => __( 'Parent Event Category:', 'bella-kit' ),
			'edit_item'         => __( 'Edit Event Category', 'bella-kit' ),
			'update_item'       => __( 'Update Event Category', 'bella-kit' ),
			'add_new_item'      => __( 'Add New Event Category', 'bella-kit' ),
			'new_item_name'     => __( 'New Event Category Name', 'bella-kit' ),
			'menu_name'         => __( 'Event Category', 'bella-kit' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'event-category' ),
		);

		register_taxonomy( 'event-category', array( 'events' ), $args );
	}
	add_action( 'init', 'Bellakit_register_event_category' );
endif;

// Register client-category
if( isset( $enable_cpt['taxonomy']['clients'] ) ):
	function Bellakit_register_client_category() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Client Categories', 'taxonomy general name', 'bella-kit' ),
			'singular_name'     => _x( 'Client Category', 'taxonomy singular name', 'bella-kit' ),
			'search_items'      => __( 'Search Client Category', 'bella-kit' ),
			'all_items'         => __( 'All Client Category', 'bella-kit' ),
			'parent_item'       => __( 'Parent Client Category', 'bella-kit' ),
			'parent_item_colon' => __( 'Parent Client Category:', 'bella-kit' ),
			'edit_item'         => __( 'Edit Client Category', 'bella-kit' ),
			'update_item'       => __( 'Update Client Category', 'bella-kit' ),
			'add_new_item'      => __( 'Add New Client Category', 'bella-kit' ),
			'new_item_name'     => __( 'New Client Category Name', 'bella-kit' ),
			'menu_name'         => __( 'Client Category', 'bella-kit' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'client-category' ),
		);

		register_taxonomy( 'client-category', array( 'clients' ), $args );
	}
	add_action( 'init', 'Bellakit_register_client_category' );
endif;

// Register faq-category
if( isset( $enable_cpt['taxonomy']['faqs'] ) ):
	function Bellakit_register_faq_category() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'FAQs Categories', 'taxonomy general name', 'bella-kit' ),
			'singular_name'     => _x( 'FAQs Category', 'taxonomy singular name', 'bella-kit' ),
			'search_items'      => __( 'Search FAQs Category', 'bella-kit' ),
			'all_items'         => __( 'All FAQs Category', 'bella-kit' ),
			'parent_item'       => __( 'Parent FAQs Category', 'bella-kit' ),
			'parent_item_colon' => __( 'Parent FAQs Category:', 'bella-kit' ),
			'edit_item'         => __( 'Edit FAQs Category', 'bella-kit' ),
			'update_item'       => __( 'Update FAQs Category', 'bella-kit' ),
			'add_new_item'      => __( 'Add New FAQs Category', 'bella-kit' ),
			'new_item_name'     => __( 'New FAQs Category Name', 'bella-kit' ),
			'menu_name'         => __( 'FAQs Category', 'bella-kit' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'faq-category' ),
		);

		register_taxonomy( 'faq-category', array( 'faqs' ), $args );
	}
	add_action( 'init', 'Bellakit_register_faq_category' );
endif;

// Register pricing_table-category
if( isset( $enable_cpt['taxonomy']['pricing_tables'] ) ):
	function Bellakit_register_pricing_table_category() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Pricing Categories', 'taxonomy general name', 'bella-kit' ),
			'singular_name'     => _x( 'Pricing Category', 'taxonomy singular name', 'bella-kit' ),
			'search_items'      => __( 'Search Pricing Category', 'bella-kit' ),
			'all_items'         => __( 'All Pricing Category', 'bella-kit' ),
			'parent_item'       => __( 'Parent Pricing Category', 'bella-kit' ),
			'parent_item_colon' => __( 'Parent Pricing Category:', 'bella-kit' ),
			'edit_item'         => __( 'Edit Pricing Category', 'bella-kit' ),
			'update_item'       => __( 'Update Pricing Category', 'bella-kit' ),
			'add_new_item'      => __( 'Add New Pricing Category', 'bella-kit' ),
			'new_item_name'     => __( 'New Pricing Category Name', 'bella-kit' ),
			'menu_name'         => __( 'Pricing Category', 'bella-kit' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'pricing_table-category' ),
		);

		register_taxonomy( 'pricing_table-category', array( 'pricing_tables' ), $args );
	}
	add_action( 'init', 'Bellakit_register_pricing_table_category' );
endif;
