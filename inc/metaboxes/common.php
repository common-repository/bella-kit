<?php

/**
 * Metaboxes for page / post / cpt
 *
 * @package    	Bella_Kit
 * @link        https://bellathemes.com/
 * Author:      Bellathemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

class Bella_Kit_cpt_common_metabox {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	public function add_meta_box( $post_type ) {
        global $post;
        $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
       
		add_meta_box(
			'bellakit_featured_metabox'
			,__( 'Featured Post', 'bella-kit' )
			,array( $this, 'render_meta_box_content_featured' )
			,array('page', 'post','services' , 'team' , 'testimonials' , 'events' , 'projects' , 'clients' , 'pricing_tables' )
			,'side'
			,'high'
		);

		 if ( $pageTemplate != 'template-home.php' ){
        	add_meta_box(
				'bellakit_sidebar_metabox'
				,__( 'Sidebar', 'bella-kit' )
				,array( $this, 'render_meta_box_content_sidebar' )
				,array( 'page' )
				,'side'
				,'high'
			);
        }
			
		
	}

	public function save( $post_id ) {
	
		if ( ! isset( $_POST['bellakit_components_common_nonce'] ) )
			return $post_id;

		$nonce = $_POST['bellakit_components_common_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'bellakit_components_common' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		if ( 'clients' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		$featured 	= isset( $_POST['bellakit_components_is_featured'] ) ? sanitize_text_field($_POST['bellakit_components_is_featured']) : false;
		$sidebar_pos = isset( $_POST['bellakit_components_sidebar_pos'] ) ? sanitize_text_field($_POST['bellakit_components_sidebar_pos']) : false;
		$sidebar_id = isset( $_POST['bellakit_components_sidebar_id'] ) ? sanitize_text_field($_POST['bellakit_components_sidebar_id']) : false;
		update_post_meta( $post_id, 'bellakit-is-featured', $featured );
		update_post_meta( $post_id, 'bellakit-sidebar-pos', $sidebar_pos );
		update_post_meta( $post_id, 'bellakit-sidebar-id', $sidebar_id );

	}

	public function render_meta_box_content_featured( $post ) {
		wp_nonce_field( 'bellakit_components_common', 'bellakit_components_common_nonce' );

		$is_featured = esc_attr( get_post_meta( $post->ID, 'bellakit-is-featured', true ) );
		
		$pro_theme = Bella_Kit::checkPro();
	?>
		
		<p><input <?php echo $is_featured?'checked':'';?> type="checkbox" class="widefat" id="bellakit_components_is_featured" 
		name="bellakit_components_is_featured" value="1" <?php echo $pro_theme?'':'disabled';?>> <?php _e('Feature this post', 'bella-kit'); ?></p>	

	<?php
	}

	public function render_meta_box_content_sidebar( $post ) {
		wp_nonce_field( 'bellakit_components_common', 'bellakit_components_common_nonce' );
		 global $wp_registered_sidebars; 
		$sidebar_pos = esc_attr( get_post_meta( $post->ID, 'bellakit-sidebar-pos', true ) );
		$sidebar_id = esc_attr( get_post_meta( $post->ID, 'bellakit-sidebar-id', true ) );
		$pro_theme = Bella_Kit::checkPro();
	?>

		<p><?php _e('Sidebar for this page. It overwrites customizer\'s global sidebar setting.', 'bella-kit'); ?></p>	
        <p><input type="radio" name="bellakit_components_sidebar_pos" value="right" <?php echo $pro_theme?'':'disabled';?> <?php echo $sidebar_pos=='right'?'checked':'';?>> <span><?php _e('Right sidebar' , 'bella-kit' );?></span></p>
        <p><input type="radio" name="bellakit_components_sidebar_pos" value="left" <?php echo $pro_theme?'':'disabled';?> <?php echo $sidebar_pos=='left'?'checked':'';?>> <span><?php _e('Left sidebar' , 'bella-kit' );?></span></p>
        <p><input type="radio" name="bellakit_components_sidebar_pos" value="none" <?php echo $pro_theme?'':'disabled';?> <?php echo $sidebar_pos=='none'?'checked':'';?>> <span><?php _e('No sidebar' , 'bella-kit' );?></span></p>

        <p><strong><?php _e('Select Sidebar' , 'bella-kit' ); ?></strong></p>
        <p><?php _e('Works when either \'Left\' or \'Right\' sidebar is checked. It overwrites customizer\'s global sidebar setting.' , 'bella-kit')?></p>
         	<?php
		    	if( !empty( $wp_registered_sidebars ) && is_array($wp_registered_sidebars) ){
		    		foreach( $wp_registered_sidebars as $sidebar ): 
		    			$checked = $sidebar_id == $sidebar['id']?'checked':'';
		    	 ?>
		    	 	<p><input type="radio" value="<?php echo $sidebar['id'];?>" name="bellakit_components_sidebar_id" <?php echo $checked; ?> <?php echo $pro_theme?'':'disabled';?>> <?php echo $sidebar['name'];?></p>
		    	<?php
		    	 	endforeach;
		    	}
		    	?>
	<?php
	}
}


function Bella_Kit_common_metabox() {
    new Bella_Kit_cpt_common_metabox();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'Bella_Kit_common_metabox' );
    add_action( 'load-post-new.php', 'Bella_Kit_common_metabox' );
}
