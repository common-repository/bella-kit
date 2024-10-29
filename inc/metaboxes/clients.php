<?php

/**
 * Metaboxes for the Clients custom post type
 *
 * @package    	Bella_Kit
 * @link        https://bellathemes.com/
 * Author:      Bellathemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

class Bella_Kit_Clients {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	public function add_meta_box( $post_type ) {
        global $post;
		add_meta_box(
			'bellakit_clients_metabox'
			,__( 'Client info', 'bella-kit' )
			,array( $this, 'render_meta_box_content' )
			,'clients'
			,'advanced'
			,'high'
		);
	}

	public function save( $post_id ) {
	
		if ( ! isset( $_POST['bellakit_components_clients_nonce'] ) )
			return $post_id;

		$nonce = $_POST['bellakit_components_clients_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'bellakit_components_clients' ) )
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

		$link 	    = isset( $_POST['bellakit_components_client_url'] ) ? esc_url_raw($_POST['bellakit_components_client_url']) : false;
		$new_tab 	= isset( $_POST['bellakit_components_new_tab'] ) ? sanitize_text_field($_POST['bellakit_components_new_tab']) : false;
		update_post_meta( $post_id, 'bellakit-client-url', $link );
		update_post_meta( $post_id, 'bellakit-client-new-tab', $new_tab );

	}

	public function render_meta_box_content( $post ) {
		wp_nonce_field( 'bellakit_components_clients', 'bellakit_components_clients_nonce' );

		$link      = esc_url( get_post_meta( $post->ID, 'bellakit-client-url', true ) );
		$new_tab   = esc_attr( get_post_meta( $post->ID, 'bellakit-client-new-tab', true ) );
		$pro_theme = Bella_Kit::checkPro();
	?>
		<div class="bellakit input-group">
			<p><strong><label><?php _e( 'URL', 'bella-kit' ); ?></label></strong></p>
			<p><em><?php _e('Enter external/internal url', 'bella-kit'); ?></em></p>
			<p><input type="text" class="widefat" id="bellakit_components_client_url" name="bellakit_components_client_url" value="<?php echo $link; ?>" <?php echo $pro_theme?'':'disabled';?>></p>
	        <p><input value="1" type="checkbox" name="bellakit_components_new_tab" <?php echo  esc_attr($new_tab)?'checked':'';?> <?php echo $pro_theme?'':'disabled';?>> <?php _e( 'Open new tab', 'bella-kit' ); ?></p>
        </div>

	<?php
	}
}


function Bella_Kit_clients_metabox() {
    new Bella_Kit_Clients();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'Bella_Kit_clients_metabox' );
    add_action( 'load-post-new.php', 'Bella_Kit_clients_metabox' );
}
