<?php

/**
 * Metaboxes for the Pricing tables custom post type
 *
 * @package    	Bella_Kit
 * @link        https://bellathemes.com/
 * Author:      Bellathemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

class Bella_Kit_pricing_tables {

    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post', array( $this, 'save' ) );
    }

    public function add_meta_box( $post_type ) {
        add_meta_box(
            'bellakit_components_pricing_metabox'
            ,__( 'Pricing Table Info', 'bella-kit' )
            ,array( $this, 'render_meta_box_content' )
            ,'pricing_tables'
            ,'advanced'
            ,'high'
        );
    }

    public function save( $post_id ) {
    
        if ( ! isset( $_POST['bellakit_components_pricing_box'] ) ||
        ! wp_verify_nonce( $_POST['bellakit_components_pricing_box'], 'bellakit_components_pricing_box' ) )
            return;
        
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;
        
        if (!current_user_can('edit_post', $post_id))
            return;
        

        $price    = isset( $_POST['bellakit_components_pricing_price'] ) ? wp_kses_post($_POST['bellakit_components_pricing_price']) : false;
        $duration = isset( $_POST['bellakit_components_pricing_duration'] ) ? wp_kses_post($_POST['bellakit_components_pricing_duration']) : false;
        $label    = isset( $_POST['bellakit_components_pricing_button_label'] ) ? sanitize_text_field($_POST['bellakit_components_pricing_button_label']) : false;
        $link     = isset( $_POST['bellakit_components_pricing_button_link'] ) ? esc_url_raw($_POST['bellakit_components_pricing_button_link']) : false;
        $type     = isset( $_POST['bellakit_components_pricing_button_type'] ) ? sanitize_text_field($_POST['bellakit_components_pricing_button_type']) : false;
        $currency = isset( $_POST['bellakit_components_pricing_currency'] ) ? sanitize_text_field($_POST['bellakit_components_pricing_currency']) : false;


        update_post_meta( $post_id, 'bellakit-pricing-price', $price );
        update_post_meta( $post_id, 'bellakit-pricing-duration', $duration );
        update_post_meta( $post_id, 'bellakit-pricing-button-label', $label );
        update_post_meta( $post_id, 'bellakit-pricing-button-link', $link );
        update_post_meta( $post_id, 'bellakit-pricing-button-type', $type );
        update_post_meta( $post_id, 'bellakit-pricing-currency', $currency );
        
        
        //Repeatable
        $old = get_post_meta($post_id, 'bellakit-pricing-features', true);
        $new = array();
        
        $names = $_POST['name'];    
        $count = count( $names );
        
        for ( $i = 0; $i < $count; $i++ ) {
            if ( $names[$i] != '' ) :
                $new[$i]['name'] = stripslashes( strip_tags( $names[$i] ) );
            endif;
        }

        if ( !empty( $new ) && $new != $old )
            update_post_meta( $post_id, 'bellakit-pricing-features', $new );
        elseif ( empty($new) && $old )
            delete_post_meta( $post_id, 'bellakit-pricing-features', $old );
    }

    public function render_meta_box_content( $post ) {
        global $post;

        $repeatable_fields = get_post_meta($post->ID, 'bellakit-pricing-features', true);

        wp_nonce_field( 'bellakit_components_pricing_box', 'bellakit_components_pricing_box' );

        $price    = get_post_meta( $post->ID, 'bellakit-pricing-price', true );
        $duration = get_post_meta( $post->ID, 'bellakit-pricing-duration', true );
        $text     = get_post_meta( $post->ID, 'bellakit-pricing-button-label', true );
        $link     = get_post_meta( $post->ID, 'bellakit-pricing-button-link', true );
        $cta_btn  = get_post_meta( $post->ID, 'bellakit-pricing-button-type', true );
        $currency = get_post_meta( $post->ID, 'bellakit-pricing-currency', true );
        $pro_theme = Bella_Kit::checkPro();

        ?>
        <div class="bellakit input-group">
            
            
            <p><label for="bellakit_components_pricing_price"><?php _e( 'Price', 'bella-kit' ); ?></label></p>
            <p><input type="text" class="widefat" id="bellakit_components_pricing_price" name="bellakit_components_pricing_price" value="<?php echo $price; ?>" <?php echo $pro_theme?'':'disabled';?>></p>
            
            <p><label><?php _e('Pricing Currency' , 'bella-kit' )?></label></p>
            <p><input type="text" class="widefat" id="bellakit_components_pricing_currency" name="bellakit_components_pricing_currency" value="<?php echo $currency; ?>" <?php echo $pro_theme?'':'disabled';?>></p>
      
            <p><label for="bellakit_components_pricing_duration"><?php _e( 'Price Duration: e.g. /Mo, /Year', 'bella-kit' ); ?></label></p>
            <p><input type="text" class="widefat" id="bellakit_components_pricing_duration" name="bellakit_components_pricing_duration" value="<?php echo $duration; ?>" <?php echo $pro_theme?'':'disabled';?>></p>
            

            <p><label for="bellakit_components_pricing_button_label"><?php _e( 'Button label', 'bella-kit' ); ?></label></p>            
            <p><input type="text" class="widefat" id="bellakit_components_pricing_button_label" name="bellakit_components_pricing_button_label" value="<?php echo $text; ?>" <?php echo $pro_theme?'':'disabled';?>></p>
            
            <p><label for="bellakit_components_pricing_button_link"><?php _e( 'Button link', 'bella-kit' ); ?></label></p>
            <p><input type="text" class="widefat" id="bellakit_components_pricing_button_link" name="bellakit_components_pricing_button_link" value="<?php echo $link; ?>" <?php echo $pro_theme?'':'disabled';?>></p>
       
            <p>

            <label for="bellakit_components_pricing_button_type"><?php esc_html_e( 'Button Type:', 'bella-kit' ); ?></label> 

            <select class="widefat"  name="bellakit_components_pricing_button_type" <?php echo $pro_theme?'':'disabled';?>>
                
                <option value="def-btn" <?php echo $cta_btn=='def-btn'?'selected':'';?>><?php esc_html_e( 'Default Button' , 'bella-kit' ); ?></option>

                <option value="primary_btn" <?php echo $cta_btn=='primary_btn'?'selected':'';?>><?php esc_html_e( 'Primary Button' , 'bella-kit' ); ?></option>

                <option value="secondary_btn" <?php echo $cta_btn=='secondary_btn'?'selected':'';?>><?php esc_html_e( 'Secondary Button' , 'bella-kit' ); ?></option>

                <option value="tertiary_btn" <?php echo $cta_btn=='tertiary_btn'?'selected':'';?>><?php esc_html_e( 'Tertiary Button' , 'bella-kit' ); ?></option>

                <option value="quaternary_btn" <?php echo $cta_btn=='quaternary_btn'?'selected':'';?>><?php esc_html_e( 'Quaternary Button' , 'bella-kit' ); ?></option>

            </select>

        </p>


        </div>
        
    
       
      
        <table id="repeatable-fieldset" width="100%">
        <thead>
            <tr>
                <th width="40%"><strong><?php _e( 'Features' , 'bella-kit' )?></strong></th>
            </tr>
        </thead>
        <tbody>
        <?php
        
        if ( $repeatable_fields ) :
        
        foreach ( $repeatable_fields as $field ) {
        ?>
        <tr>
            <td style="width:100%;"><input type="text" class="widefat" name="name[]" value="<?php if($field['name'] != '') echo esc_attr( $field['name'] ); ?>" <?php echo $pro_theme?'':'disabled';?> /></td>
                    
            <td><a class="button remove-feature" href="#">X</a></td>
        </tr>
        <?php
        }
        else :
        ?>
        <tr>
            <td style="width:100%;"><input type="text" class="widefat" name="name[]" <?php echo $pro_theme?'':'disabled';?>/></td>
                    
            <td><a class="button remove-feature" href="#">X</a></td>
        </tr>
        <?php endif; ?>
        
        <tr class="empty-feature-row screen-reader-text">
            <td><input type="text" class="widefat" name="name[]" /></td>
                                  
            <td><a class="button remove-feature" href="#">X</a></td>
        </tr>
        </tbody>
        </table>
        
        <p><a id="add-feature" class="button button-primary" href="#" <?php echo $pro_theme?'':'disabled';?>>Add More</a></p>
        <?php
    }

}

function Bella_Kit_pricing_metabox() {
    new Bella_Kit_pricing_tables();
}

if ( is_admin() ) {
    add_action( 'load-post.php', 'Bella_Kit_pricing_metabox' );
    add_action( 'load-post-new.php', 'Bella_Kit_pricing_metabox' );
}