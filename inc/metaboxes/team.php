<?php

/**
 * Metaboxes for the team custom post type
 *
 * @package    	Bella_Kit
 * @link        https://bellathemes.com/
 * Author:      Bellathemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */



class Bella_Kit_Team {

	public function __construct() {
	

		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	public function add_meta_box( $post_type ) {
        global $post;
		add_meta_box(
			'bellakit_team_metabox'
			,__( 'Team info', 'bella-kit' )
			,array( $this, 'render_meta_box_content' )
			,'team'
			,'advanced'
			,'high'
		);
	}

	public function save( $post_id ) {
	
		if ( ! isset( $_POST['bellakit_components_team_nonce'] ) )
			return $post_id;

		$nonce = $_POST['bellakit_components_team_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'bellakit_components_team' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		if ( 'team' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}


		$designation= isset( $_POST['bellakit_components_team_position'] ) ? sanitize_text_field($_POST['bellakit_components_team_position']) : false;
		$facebook 	= isset( $_POST['bellakit_components_team_facebook'] ) ? esc_url_raw($_POST['bellakit_components_team_facebook']) : false;
		$twitter 	= isset( $_POST['bellakit_components_team_twitter'] ) ? esc_url_raw($_POST['bellakit_components_team_twitter']) : false;
		$google 	= isset( $_POST['bellakit_components_team_google'] ) ? esc_url_raw($_POST['bellakit_components_team_google']) : false;
		$linkedin 	= isset( $_POST['bellakit_components_team_linkedin'] ) ? esc_url_raw($_POST['bellakit_components_team_linkedin']) : false;
		$instagram 	= isset( $_POST['bellakit_components_team_instagram'] ) ? esc_url_raw($_POST['bellakit_components_team_instagram']) : false;
		$link 		= isset( $_POST['bellakit_components_team_url'] ) ? esc_url_raw($_POST['bellakit_components_team_url']) : false;
		$new_tab 	= isset( $_POST['bellakit_components_new_tab'] ) ? sanitize_text_field($_POST['bellakit_components_new_tab']) : false;
		$enable_single  = isset( $_POST['bellakit_enable_team_single'] ) ? sanitize_text_field($_POST['bellakit_enable_team_single']) : false;
		
		update_post_meta( $post_id, 'bellakit-team-designation', $designation );
		update_post_meta( $post_id, 'bellakit-team-facebook', $facebook );
		update_post_meta( $post_id, 'bellakit-team-twitter', $twitter );
		update_post_meta( $post_id, 'bellakit-team-google-plus', $google );
		update_post_meta( $post_id, 'bellakit-team-linkedin', $linkedin );
		update_post_meta( $post_id, 'bellakit-team-instagram', $instagram );
		update_post_meta( $post_id, 'bellakit-team-url', $link );
		update_post_meta( $post_id, 'bellakit-team-new-tab', $new_tab );
		
	}

	public function render_meta_box_content( $post ) {
		wp_nonce_field( 'bellakit_components_team', 'bellakit_components_team_nonce' );

		$designation = esc_attr( get_post_meta( $post->ID, 'bellakit-team-designation', true ) );
		$facebook    = esc_url( get_post_meta( $post->ID, 'bellakit-team-facebook', true ) );
		$twitter  	 = esc_url( get_post_meta( $post->ID, 'bellakit-team-twitter', true ) );
		$google   	 = esc_url( get_post_meta( $post->ID, 'bellakit-team-google-plus', true ) );
		$linkedin 	 = esc_url( get_post_meta( $post->ID, 'bellakit-team-linkedin', true ) );
		$instagram   = esc_url( get_post_meta( $post->ID, 'bellakit-team-instagram', true ) );
		$link        = esc_url( get_post_meta( $post->ID, 'bellakit-team-url', true ) );
		$new_tab     = esc_attr( get_post_meta( $post->ID, 'bellakit-team-new-tab', true ) );
			
		$pro_theme = Bella_Kit::checkPro();

	?>  
		<div class="bellakit input-group">
			<p><strong><label for="bellakit_components_team_position"><?php _e( 'Designation', 'bella-kit' ); ?></label></strong></p>
			<p><input type="text" class="widefat" id="bellakit_components_team_position" name="bellakit_components_team_position" value="<?php echo esc_html($designation); ?>"></p>	
		</div>

		<div class="bellakit input-group">
			<p><strong><label><?php _e( 'Social Media', 'bella-kit' ); ?></label></strong></p>
			<p><em><?php _e( 'Please leave unnecessary social media link empty', 'bella-kit' ); ?></em></p>

			<p><em><?php _e( 'Facebook', 'bella-kit' ); ?></em></p>
			<p><input type="text" class="widefat" id="bellakit_components_team_facebook" name="bellakit_components_team_facebook" value="<?php echo$facebook; ?>" <?php echo $pro_theme?'':'disabled';?>></p>				
			
			<p><em><?php _e( 'Twitter', 'bella-kit' ); ?></em></p>
			<p><input type="text" class="widefat" id="bellakit_components_team_twitter" name="bellakit_components_team_twitter" value="<?php echo $twitter; ?>" <?php echo $pro_theme?'':'disabled';?>></p>
			
			<p><em><?php _e( 'Google+', 'bella-kit' ); ?></em></p>
			<p><input type="text" class="widefat" id="bellakit_components_team_google" name="bellakit_components_team_google" value="<?php echo $google; ?>" <?php echo $pro_theme?'':'disabled';?>></p>

			<p><em><?php _e( 'Linkedin', 'bella-kit' ); ?></em></p>
			<p><input type="text" class="widefat" id="bellakit_components_team_linkedin" name="bellakit_components_team_linkedin" value="<?php echo $linkedin; ?>" <?php echo $pro_theme?'':'disabled';?>></p>
			
			<p><em><?php _e( 'Instagram', 'bella-kit' ); ?></em></p>
			<p><input type="text" class="widefat" id="bellakit_components_team_instagram" name="bellakit_components_team_instagram" value="<?php echo $instagram; ?>" <?php echo $pro_theme?'':'disabled';?>></p>
		</div>

		<div class="bellakit input-group">
			<p><strong><label for="bellakit_components_team_url"><?php _e( 'URL', 'bella-kit' ); ?></label></strong></p>
			<p><em><?php _e('Enter external/internal url', 'bella-kit'); ?></em></p>
			<p><input type="text" class="widefat" id="bellakit_components_team_url" name="bellakit_components_team_url" value="<?php echo $link; ?>" <?php echo $pro_theme?'':'disabled';?>></p>
	        <p><input value="1" type="checkbox" name="bellakit_components_new_tab" <?php echo  $new_tab?'checked':'';?> <?php echo $pro_theme?'':'disabled';?>> <?php _e( 'Open new tab', 'bella-kit' ); ?></p>
		</div>
	<?php
	}

	
}


function Bella_Kit_employees_metabox() {
    new Bella_Kit_Team();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'Bella_Kit_employees_metabox' );
    add_action( 'load-post-new.php', 'Bella_Kit_employees_metabox' );
}