<?php
/**
 * Enables/Disables custom post type and respective custom taxonomy
 *
 * @package    	Bella_Kit
 * @link        https://bellathemes.com/
 * Author:      Bellathemes
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

function bellakit_components_cpt_settings(){

/* CPT Setting Section */
add_settings_section( 
    'bellakit_components_cpt',
    __('Custom Post Type Setting' , 'bella-kit'),
    'bellakit_components_cpt_setting_callback',
    'bellakit_components_enable_cpt'
);

/* CPT settings fields */
add_settings_field(  
    'bellakit_components_enable_cpt',                      
    __('Enable Custom post types' , 'bella-kit'),               
    'bellakit_components_enable_cpts_callback',   
    'bellakit_components_enable_cpt',                     
    'bellakit_components_cpt',
   array('services' =>'service-category','team'=>'team-category','testimonials'=>'testimonial-category','projects'=>'project-category','clients'=>'client-category', 'pricing_tables' => 'pricing_table-category')
);

register_setting('bellakit_components_enable_cpt', 'bellakit_components_enable_cpt');

}

function bellakit_components_cpt_setting_callback() { 
   
  echo __('<p> Please enable  <strong>Custom Post Types</strong> according to your requirement. </p>' , 'bella-kit');
    
}

function bellakit_components_enable_cpts_callback( $args ){
	$options = get_option('bellakit_components_enable_cpt');
		
	foreach( $args as $cpt=>$tax):
    $cpt_checked = '';
    $cat_checked = '';
    $tax_checked = '';
    $arch_checked = '';
    $style = 'style="display:none;"';
	if( isset( $options[$cpt])){
		$cpt_checked = 'checked';
        $style = '';

	}
    if( isset( $options['category'][$cpt])){
        $cat_checked = 'checked';
    }
    if( isset( $options['taxonomy'][$cpt])){
        $tax_checked = 'checked';
    }

    echo '<div class="bellakit input-group">';
	   echo '<p><input '.$cpt_checked.' type="checkbox" name="bellakit_components_enable_cpt['.$cpt.']" value="1" class="bellakit-grouped"> <strong>'.ucfirst( implode(' ' , explode('_', $cpt) )  ).'</strong></p>';

    echo '</div>';
   endforeach;
}

function bellakit_components_cpt_form_callback() {
?>
<form method="post" action="options.php">  
            <?php 
           
                settings_fields( 'bellakit_components_enable_cpt' );
                do_settings_sections( 'bellakit_components_enable_cpt' );               

            ?>             
            <?php submit_button(); ?>  
        </form> 
 <?php 

    }

add_action('admin_init' , 'bellakit_components_cpt_settings');