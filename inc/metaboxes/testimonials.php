<?php

/**
 * Metaboxes for the testimonials custom post type
 *
 * @package    	Bella_Kit
 * @link        https://bellathemes.com/
 * Author:      Bellathemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


class Bella_Kit_Testimonials {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	public function add_meta_box( $post_type ) {
        global $post;
		add_meta_box(
			'bellakit_testimonials_metabox'
			,__( 'Client info', 'bella-kit' )
			,array( $this, 'render_meta_box_content' )
			,'testimonials'
			,'advanced'
			,'high'
		);
	}

	public function save( $post_id ) {
	
		if ( ! isset( $_POST['bellakit_components_testimonials_nonce'] ) )
			return $post_id;

		$nonce = $_POST['bellakit_components_testimonials_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'bellakit_components_testimonials' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		if ( 'testimonials' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}


		$name 	= isset( $_POST['bellakit_components_client_name'] ) ? sanitize_text_field($_POST['bellakit_components_client_name']) : false;
		$company 	= isset( $_POST['bellakit_components_company_name'] ) ? sanitize_text_field($_POST['bellakit_components_company_name']) : false;
		$designation 	= isset( $_POST['bellakit_components_client_designation'] ) ? sanitize_text_field($_POST['bellakit_components_client_designation']) : false;

		update_post_meta( $post_id, 'bellakit-client-name', $name );
		update_post_meta( $post_id, 'bellakit-company-name', $company );
		update_post_meta( $post_id, 'bellakit-client-designation', $designation );

	}

	public function render_meta_box_content( $post ) {
		wp_nonce_field( 'bellakit_components_testimonials', 'bellakit_components_testimonials_nonce' );

		$name 	 = esc_attr( get_post_meta( $post->ID, 'bellakit-client-name', true ) );
		$company = esc_attr( get_post_meta( $post->ID, 'bellakit-company-name', true ) );
		$designation = esc_attr( get_post_meta( $post->ID, 'bellakit-client-designation', true ) );
		$pro_theme = Bella_Kit::checkPro();

	?>
		
		<div class="bellakit input-group">
			<p><strong><label for="bellakit_components_client_name"><?php _e( 'Name', 'bella-kit' ); ?></label></strong></p>
			<p><input type="text" class="widefat" id="bellakit_components_client_name" name="bellakit_components_client_name" value="<?php echo $name; ?>" ></p>
			
			<p><strong><label for="bellakit_components_company_name"><?php _e( 'Company name', 'bella-kit' ); ?></label></strong></p>
			<p><input type="text" class="widefat" id="bellakit_components_company_name" name="bellakit_components_company_name" value="<?php echo $company; ?>" <?php echo $pro_theme?'':'disabled';?>></p>	
			
			<p><strong><label for="bellakit_components_client_designation"><?php _e( 'Designation', 'bella-kit' ); ?></label></strong></p>
			<p><input type="text" class="widefat" id="bellakit_components_client_designation" name="bellakit_components_client_designation" value="<?php echo $designation; ?>" <?php echo $pro_theme?'':'disabled';?>></p>	
		</div>
	<?php
	}
}



function Bella_Kit_testimonials_metabox() {
    new Bella_Kit_Testimonials();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'Bella_Kit_testimonials_metabox' );
    add_action( 'load-post-new.php', 'Bella_Kit_testimonials_metabox' );
}
