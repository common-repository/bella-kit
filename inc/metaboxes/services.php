<?php
/**
 * Metaboxes for the services custom post type
 *
 * @package    	Bella_Kit
 * @link        https://bellathemes.com/
 * Author:      Bellathemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


class Bella_Kit_Services {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	public function add_meta_box( $post_type ) {
        global $post;
		add_meta_box(
			'bellakit_services_metabox'
			,__( 'Service info', 'bella-kit' )
			,array( $this, 'render_meta_box_content' )
			,'services'
			,'advanced'
			,'high'
		);
	}

	public function save( $post_id ) {
	
		if ( ! isset( $_POST['bellakit_components_services_nonce'] ) )
			return $post_id;

		$nonce = $_POST['bellakit_components_services_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'bellakit_components_services' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		if ( 'services' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		$icon 		= isset( $_POST['bellakit_components_service_icon'] ) ? sanitize_text_field($_POST['bellakit_components_service_icon']) : false;
		$color 		= isset( $_POST['bellakit_components_service_icon_color'] ) ? sanitize_text_field($_POST['bellakit_components_service_icon_color']) : false;
		$thumb 		= isset( $_POST['bellakit_components_thumbnail'] ) ? sanitize_text_field($_POST['bellakit_components_thumbnail']) : false;
		$link 		= isset( $_POST['bellakit_components_service_url'] ) ? esc_url_raw($_POST['bellakit_components_service_url']) : false;
		$new_tab 	= isset( $_POST['bellakit_components_new_tab'] ) ? sanitize_text_field($_POST['bellakit_components_new_tab']) : false;
		$single 	= isset( $_POST['bellakit_components_enable_single'] ) ? sanitize_text_field($_POST['bellakit_components_enable_single']) : false;
		

		update_post_meta( $post_id, 'bellakit-service-icon', $icon );
		update_post_meta( $post_id, 'bellakit-service-icon-color', $color );
		update_post_meta( $post_id, 'bellakit-service-icon-thumbnail', $thumb );	
		update_post_meta( $post_id, 'bellakit-service-url', $link );
		update_post_meta( $post_id, 'bellakit-service-new-tab', $new_tab );
		update_post_meta( $post_id, 'bellakit-enable-service-single', $single );	
	}

	public function render_meta_box_content( $post ) {
		wp_nonce_field( 'bellakit_components_services', 'bellakit_components_services_nonce' ) ;
		$icon 		= esc_attr( get_post_meta( $post->ID, 'bellakit-service-icon', true ) ); 
		$color 		= esc_attr( get_post_meta( $post->ID, 'bellakit-service-icon-color', true ) ); 
		$thumbnail  = esc_attr( get_post_meta( $post->ID, 'bellakit-service-icon-thumbnail', true ) );
		$link 	    = esc_url( get_post_meta( $post->ID, 'bellakit-service-url', true ) );
		$new_tab    = esc_attr( get_post_meta( $post->ID, 'bellakit-service-new-tab', true ) );
		$pro_theme = Bella_Kit::checkPro();
	?>
		
		<div class="bellakit input-group">
			<p><strong><label for="bellakit_components_service_icon"><?php _e( 'Service icon', 'bella-kit' ); ?></label></strong></p>
			<p><em><?php echo __('Enter Font Awesome icon class. e.g.: <strong>fa fa-ambulance </strong>. Click <a href="https://fontawesome.com/icons/" target="_blank">here</a> to view full list of icons'); ?></em></p>
			<p><input type="text" class="widefat" id="bellakit_components_service_icon" name="bellakit_components_service_icon" value="<?php echo $icon; ?>" ></p>
			
			<p><em><?php echo __('Icon color'); ?></em></p>
			<p><input type="text" class="color-field" id="bellakit_components_service_icon_color" name="bellakit_components_service_icon_color" value="<?php echo $color; ?>" <?php echo $pro_theme?'':'disabled';?>></p>	

			
		</div>


		<div class="bellakit input-group">
			<p><strong><label><?php _e( 'URL', 'bella-kit' ); ?></label></strong></p>
			<p><em><?php _e('Enter external/internal url', 'bella-kit'); ?></em></p>
			<p><input type="text" class="widefat" id="bellakit_components_service_url" name="bellakit_components_service_url" value="<?php echo esc_url($link); ?>" <?php echo $pro_theme?'':'disabled';?>></p>
	        <p><input value="1" type="checkbox" name="bellakit_components_new_tab" <?php echo  $new_tab?'checked':'';?> <?php echo $pro_theme?'':'disabled';?>> <?php _e( 'Open new tab', 'bella-kit' ); ?></p>
		</div>
		
	<?php
	}
}



function Bella_Kit_services_metabox() {
    new Bella_Kit_Services();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'Bella_Kit_services_metabox' );
    add_action( 'load-post-new.php', 'Bella_Kit_services_metabox' );
}