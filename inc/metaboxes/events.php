<?php

/**
 * Metaboxes for the event custom post type
 *
 * @package    	Bella_Kit
 * @link        https://bellathemes.com/
 * Author:      Bellathemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


class Bella_Kit_Events {

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	public function add_meta_box( $post_type ) {
        global $post;
		add_meta_box(
			'bellakit_event_metabox'
			,__( 'Event info', 'bella-kit' )
			,array( $this, 'render_meta_box_content' )
			,'events'
			,'advanced'
			,'high'
		);
	}

	public function save( $post_id ) {
	
		if ( ! isset( $_POST['bellakit_components_events_nonce'] ) )
			return $post_id;

		$nonce = $_POST['bellakit_components_events_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'bellakit_components_events' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		if ( 'timeline-events' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
	
		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		$date 	= isset( $_POST['bellakit_components_event_date'] ) ? sanitize_text_field($_POST['bellakit_components_event_date']) : false;
		$time 	= isset( $_POST['bellakit_components_event_time'] ) ? sanitize_text_field($_POST['bellakit_components_event_time']) : false;
		$venue 	= isset( $_POST['bellakit_components_event_venue'] ) ? sanitize_text_field($_POST['bellakit_components_event_venue']) : false;
		$icon 	= isset( $_POST['bellakit_components_event_icon'] ) ? sanitize_text_field($_POST['bellakit_components_event_icon']) : false;
		$color 	= isset( $_POST['bellakit_components_event_icon_color'] ) ? sanitize_text_field($_POST['bellakit_components_event_icon_color']) : '';	
		$link 	= isset( $_POST['bellakit_components_event_url'] ) ? esc_url_raw($_POST['bellakit_components_event_url']) : false;
		$new_tab = isset( $_POST['bellakit_components_new_tab'] ) ? sanitize_text_field($_POST['bellakit_components_new_tab']) : false;

		$thumbnail 	= isset( $_POST['bellakit_components_thumbnail'] ) ? sanitize_text_field($_POST['bellakit_components_thumbnail']) : false;
		$enable_timeline_single 	= isset( $_POST['bellakit_components_timeline_enable_single'] ) ? sanitize_text_field($_POST['bellakit_components_timeline_enable_single']) : false;
		$enable_event_single 	= isset( $_POST['bellakit_components_event_enable_single'] ) ? sanitize_text_field($_POST['bellakit_components_event_enable_single']) : false;

		update_post_meta( $post_id, 'bellakit-event-date', $date );
		update_post_meta( $post_id, 'bellakit-event-time', $time );
		update_post_meta( $post_id, 'bellakit-event-venue', $venue );
		update_post_meta( $post_id, 'bellakit-event-icon', $icon );
		update_post_meta( $post_id, 'bellakit-event-icon-color', $color );	
		update_post_meta( $post_id, 'bellakit-event-url', $link );
		update_post_meta( $post_id, 'bellakit-event-new-tab', $new_tab );
		update_post_meta( $post_id, 'bellakit-event-thumbnail', $thumbnail );
		
	}

	public function render_meta_box_content( $post ) {
		wp_nonce_field( 'bellakit_components_events', 'bellakit_components_events_nonce' );
		
		$date 	= esc_attr( get_post_meta( $post->ID, 'bellakit-event-date', true ) );
		$time 	= esc_attr( get_post_meta( $post->ID, 'bellakit-event-time', true ) );
		$venue 	= esc_attr( get_post_meta( $post->ID, 'bellakit-event-venue', true ) );
		$icon 	= esc_attr( get_post_meta( $post->ID, 'bellakit-event-icon', true ) );
		$color 	= esc_attr( get_post_meta( $post->ID, 'bellakit-event-icon-color', true ) );		
		$link 		    = esc_url( get_post_meta( $post->ID, 'bellakit-event-url', true ) );
		$new_tab  		= esc_attr( get_post_meta( $post->ID, 'bellakit-event-new-tab', true ) );
		$thumbnail 		= esc_attr( get_post_meta( $post->ID, 'bellakit-event-thumbnail', true ) );
		$pro_theme = Bella_Kit::checkPro();	
	?>

		<div class="bellakit input-group">
			<p><em><?php echo __('Event date. Please use <strong>yyyy-mm-dd</strong> format. e.g. 2017-07-18' , 'bella-kit'); ?></em></p>
			<p><input type="text" class="widefat" id="bellakit_components_event_date" name="bellakit_components_event_date" value="<?php echo $date; ?>" <?php echo $pro_theme?'':'disabled';?>></p>
			
			<p><em><?php echo __('Event Time e.g. 7:30 AM' , 'bella-kit' ); ?></em></p>
			<p><input type="text" class="widefat" id="bellakit_components_event_time" name="bellakit_components_event_time" value="<?php echo $time; ?>" <?php echo $pro_theme?'':'disabled';?>></p>
			
			<p><em><?php echo __('Event venue' , 'bella-kit'); ?></em></p>
			<p><input type="text" class="widefat" id="bellakit_components_event_venue" name="bellakit_components_event_venue" value="<?php echo $venue; ?>" <?php echo $pro_theme?'':'disabled';?>></p>


			<p><em><?php echo __('Event icon. e.g.: <strong>fa fa-ambulance</strong>. Click <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">here</a> to view full list of icons'); ?></em></p>
			<p><input type="text" class="widefat" id="bellakit_components_event_icon" name="bellakit_components_event_icon" value="<?php echo $icon; ?>" <?php echo $pro_theme?'':'disabled';?>></p>

			<p><em><?php echo __('Event icon color'); ?></em></p>
			<p><input type="text" class="color-field" id="bellakit_components_event_icon_color" name="bellakit_components_event_icon_color" value="<?php echo $color; ?>" <?php echo $pro_theme?'':'disabled';?>></p>	
			
			
			<p><input type="checkbox" name="bellakit_components_thumbnail" <?php echo  $thumbnail?'checked':'';?> <?php echo $pro_theme?'':'disabled';?>> <?php _e( 'Ignore Font Awesome icon and use featured image', 'bella-kit' ); ?></p>
		</div>

		<div class="bellakit input-group">
			<p><strong><label for="bellakit_components_event_url"><?php _e( 'URL', 'bella-kit' ); ?></label></strong></p>
			<p><em><?php echo __('Enter external/internal url'); ?></em></p>
			<p><input type="text" class="widefat" id="bellakit_components_event_url" name="bellakit_components_event_url" value="<?php echo $link; ?>" <?php echo $pro_theme?'':'disabled';?>></p>
			 <p><input value="1" type="checkbox" name="bellakit_components_new_tab" <?php echo  $new_tab?'checked':'';?> <?php echo $pro_theme?'':'disabled';?>> <?php _e( 'Open new tab', 'bella-kit' ); ?></p>
		</div>

		

	<?php
	}

}



function Bella_Kit_events_metabox() {
    new Bella_Kit_Events();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'Bella_Kit_events_metabox' );
    add_action( 'load-post-new.php', 'Bella_Kit_events_metabox' );
}