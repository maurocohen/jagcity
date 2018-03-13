<?php
/*
Plugin Name: Ultimate Popup Free
Plugin URI: http://ultimatepopup.com
Description: This plugin will enable an awesome side popup in your wordpress site. 
Author: Perfect Point Marketing
Author URI: http://perfectpointmarketing.com
Version: 1.0
*/

/* Adding Latest jQuery from Wordpress */
function ppm_side_popup_free_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'ppm_side_popup_free_jquery');

/*Some Set-up*/
define('PPM_SIDE_POPUP_FREE', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );



/* Including all files */
function ppm_side_popup_free_files() {
wp_enqueue_script('ultimate-popup-free-main-js', PPM_SIDE_POPUP_FREE.'js/ppm-side-popup.js', array('jquery'), 1.0, true);
wp_enqueue_script('ultimate-popup-free-cookie-js', PPM_SIDE_POPUP_FREE.'js/jquery.cookie.js', array('jquery'), 1.0, true);
wp_enqueue_script('ultimate-popup-free-modal-js', PPM_SIDE_POPUP_FREE.'js/jquery.easymodal.js', array('jquery'), 1.0, true);
wp_enqueue_style('ultimate-popup-free-main-css', PPM_SIDE_POPUP_FREE.'css/ppm-side-popup.css');
}
add_action( 'wp_enqueue_scripts', 'ppm_side_popup_free_files' );


require_once("inc/settings-api/class.settings-api.php");
require_once("inc/settings-api/ppm-popup-options.php");
require_once("inc/cmb2/ppm-side-popup-cpt-option.php");


add_action( 'init', 'ppm_side_popup_free_register_cpt' );
function ppm_side_popup_free_register_cpt() {
    register_post_type( 'ultimate-popup-free',
        array(
            'labels' => array(
                'name' => __( 'Popups' ),
                'singular_name' => __( 'Popup' )
            ),
            'supports' => array('title', 'thumbnail', 'page-attributes'),
            'public' => true,
            'menu_icon' => 'dashicons-building'
        )
    );
}

  

function ppm_popup_free_content_in_body(){
?>

<?php require_once("inc/popup-content/ppm-popup-content-global.php"); ?> 

<?php
}


function ppm_popup_free_get_option_in_func( $option, $section, $default = '' ) {

    $options = get_option( $section );

    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }

    return $default;
} 

$global_display_settings = ppm_popup_free_get_option_in_func( 'global_display_settings', 'ppm_side_popup_free_global', '2' ); 
$page_display_settings = ppm_popup_free_get_option_in_func( 'page_display_settings', 'ppm_side_popup_free_global', '2' ); 
$post_display_settings = ppm_popup_free_get_option_in_func( 'post_display_settings', 'ppm_side_popup_free_global', '2' ); 
    


if($global_display_settings == '1') :
    function ppm_popup_free_is_delacting_homepage() {
        
        if( is_front_page() ) :
            require_once("inc/popup-content/ppm-popup-content-global.php");
        endif;
    }
    add_action( 'wp_footer', 'ppm_popup_free_is_delacting_homepage' ); 
elseif($global_display_settings == '2') :

    if($page_display_settings == '2') :
    function ppm_popup_free_is_delacting_generalpage() {
        
        if( is_page() ) :
            require_once("inc/popup-content/ppm-popup-content-global.php");
        endif;
    }
    add_action( 'wp_footer', 'ppm_popup_free_is_delacting_generalpage' ); 
    endif;

    if($post_display_settings == '2') :
    function ppm_popup_free_is_delacting_singlepost() {
        
        if( is_single() ) :
            require_once("inc/popup-content/ppm-popup-content-global.php");
        endif;
    }
    add_action( 'wp_footer', 'ppm_popup_free_is_delacting_singlepost' );
    endif;
endif;    




function ppm_popup_free_generate_shortcode($atts){
	extract( shortcode_atts( array(
		'id' => '',
	), $atts) );
	
    $q = new WP_Query(
        array('posts_per_page' => 1, 'p' =>$id, 'post_type' => 'ultimate-popup-free')
        );		
		
		
	$list = '<div id="ppm-popup-post-shortcode-wrap">';
	while($q->have_posts()) : $q->the_post();
    
    $post_id = get_the_ID();
    $enable_cross_button = get_post_meta($post_id, 'enable_cross_button', true);
    $ppm_popup_title= get_post_meta($post_id, 'ppm_popup_title', true); 
    $ppm_popup_desc= get_post_meta($post_id, 'ppm_popup_desc', true); 
    $ppm_popup_timeunit= get_post_meta($post_id, 'ppm_popup_timeunit', true); 
    $ppm_popup_timevalue= get_post_meta($post_id, 'ppm_popup_timevalue', true); 
    $ppm_popup_position= get_post_meta($post_id, 'ppm_popup_position', true); 
    $ppm_popup_width= get_post_meta($post_id, 'ppm_popup_width', true); 
    $ppm_popup_border_width= get_post_meta($post_id, 'ppm_popup_border_width', true); 
    $ppm_popup_theme_color= get_post_meta($post_id, 'ppm_popup_theme_color', true); 
    $popup_show_on= get_post_meta($post_id, 'popup_show_on', true); 
    $popup_enable_cookie= get_post_meta($post_id, 'popup_enable_cookie', true); 
    $when_popup_load= get_post_meta($post_id, 'when_popup_load', true);
    $ppm_popup_left_content= get_post_meta($post_id, 'ppm_popup_left_content', true); 
    $ppm_form_code= get_post_meta($post_id, 'ppm_form_code', true); 
    $popup_inner_bg = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
    
    if($popup_show_on == '1') {
    $list .='<div id="ppm-popup-'.$post_id.'" class="ppm-popup-wrapper ppm-popup-theme-id-1 ppm-popup-halfway-scroll-activate">';
    } elseif($popup_show_on == '2') {
    $list .='<div id="ppm-popup-'.$post_id.'" class="ppm-popup-wrapper ppm-popup-theme-id-1 ppm-popup-automatic-activate">';
    }else {
    $list .='<div id="ppm-popup-'.$post_id.'" class="ppm-popup-wrapper ppm-popup-theme-id-1">';
    }
    
    if($enable_cross_button == '1') {
        $list .='<span class="cross-btn-ppm">x</span>';
    }

    $list .='<div class="ppm-popup-inner">';
        if($ppm_popup_title) :
        $list .='<h2 class="ppm-popup-inner-title">'.$ppm_popup_title.'</h2>';
        endif;

        if($ppm_popup_desc) :
        $list .='<p class="ppm-popup-inner-description">'.$ppm_popup_desc.'</p>';
        endif;

        $list .='
        <div class="ppm-popup-shortcodes">
            '.do_shortcode( $ppm_form_code ).'
        </div>                     
        ';

    
    $list .='</div> </div>';
    
    
    $list .='
<style>
    
    #ppm-popup-'.$post_id.' {width: '.$ppm_popup_width.'; border-width:'.$ppm_popup_border_width.';border-color:'.$ppm_popup_theme_color.'}
    ';

    $list .='#ppm-popup-'.$post_id.' .ppm-popup-shortcodes input[type="submit"] {background:'.$ppm_popup_theme_color.'}';

    $list .='#ppm-popup-'.$post_id.' .cross-btn-ppm {color:'.$ppm_popup_theme_color.'}';
    
    
    
    if($popup_show_on == '1') :
        if($ppm_popup_position == '2') :
            $list .='
            #ppm-popup-'.$post_id.' {left: 0;bottom: -100%;}
            #ppm-popup-'.$post_id.'.ppm-popup-wrapper-activate {bottom: 0;}             
            ';
        else :   
            $list .='
            #ppm-popup-'.$post_id.' {right: 0;bottom: -100%;}
            #ppm-popup-'.$post_id.'.ppm-popup-wrapper-activate {bottom: 0;}            
            ';
        endif;  
    
    endif;

$list .='
</style>


<script type="text/javascript">
//<![CDATA[  
';
    
    
if($when_popup_load == '2') :
    $list .='jQuery(document).ready(function(){';
else :
    $list .='jQuery(window).load(function(){';
endif;
        
      

    if($popup_enable_cookie == '2') :
    
        if($popup_show_on == '2') :
            $list .='
            jQuery("#ppm-popup-'.$post_id.'").easyModal({
                autoOpen: true,
                closeButtonClass: ".cross-btn-ppm"
            });

            jQuery("#ppm-popup-'.$post_id.'").addClass("ppm-popup-wrapper-activate");
            ';
        else :
            $list .='
            // Popup is showing first time!
            jQuery(window).scroll(function () { 
              if (jQuery(window).scrollTop() > jQuery("body").height() / 2) {
                jQuery("#ppm-popup-'.$post_id.'").addClass("ppm-popup-wrapper-activate");
              } 
            });  
            ';
        endif;     
    
    else :
    
    if($popup_show_on == '4') :
    $list .='
    jQuery("body").mouseleave(function() { 
    ';
    endif;
    
    $list .='
    if (jQuery.cookie("popupTemporaryCookie'.$post_id.'")) {

        // Popup is hiding after showing first time!
        jQuery("#ppm-popup-'.$post_id.'").hide();

    } else if (jQuery.cookie("popupLongerCookie'.$post_id.'")) {
    ';
    
    if($popup_show_on == '2') :
        $list .='
        jQuery("#ppm-popup-'.$post_id.'").easyModal({
            autoOpen: true,
            closeButtonClass: ".cross-btn-ppm"
        });
    
        jQuery("#ppm-popup-'.$post_id.'").addClass("ppm-popup-wrapper-activate");
        ';
    elseif($popup_show_on == '3') :
        $list .='
        jQuery("body").mouseleave(function() { 
        
            jQuery("#ppm-popup-'.$post_id.'").easyModal({
                autoOpen: true,
                closeButtonClass: ".cross-btn-ppm",
                overlayOpacity:0
            });
            
            jQuery(".cross-btn-ppm, .lean-overlay").click(function(){
                jQuery("body").addClass("ppm-popup-wrapper-hide");
            });

            jQuery("#ppm-popup-'.$post_id.'").addClass("ppm-popup-wrapper-activate");
        });        
        ';
    else :
        $list .='
        // Popup is showing again!
        jQuery(window).scroll(function () { 
          if (jQuery(window).scrollTop() > jQuery("body").height() / 2) {
            jQuery("#ppm-popup-'.$post_id.'").addClass("ppm-popup-wrapper-activate");
          } 
        });
        ';
    endif;      


    $list .='
    } else {
    ';
    
    if($popup_show_on == '2') :
        $list .='
        jQuery("#ppm-popup-'.$post_id.'").easyModal({
            autoOpen: true,
            closeButtonClass: ".cross-btn-ppm"
        });
    
        jQuery("#ppm-popup-'.$post_id.'").addClass("ppm-popup-wrapper-activate");
        ';
    elseif($popup_show_on == '3') :
        $list .='
        jQuery("body").mouseleave(function() { 
            jQuery("#ppm-popup-'.$post_id.'").easyModal({
                autoOpen: true,
                closeButtonClass: ".cross-btn-ppm",
                overlayOpacity:0
            });
            
            jQuery(".cross-btn-ppm, .lean-overlay").click(function(){
                jQuery("body").addClass("ppm-popup-wrapper-hide");
            });            

            jQuery("#ppm-popup-'.$post_id.'").addClass("ppm-popup-wrapper-activate");
       });    
       ';
    else :
        $list .='
        // Popup is showing first time!
        jQuery(window).scroll(function () { 
          if (jQuery(window).scrollTop() > jQuery("body").height() / 2) {
            jQuery("#ppm-popup-'.$post_id.'").addClass("ppm-popup-wrapper-activate");
          } 
        });  
        ';
    endif;    
    
    $list .='
    }
        
      

    var expiresAt = new Date();
    ';
    
    if($ppm_popup_timeunit == '1') :
        $list .='expiresAt.setTime(expiresAt.getTime() + '.$ppm_popup_timevalue.'*24*60*60*1000); // Days';               
    elseif($ppm_popup_timeunit == '2') :
        $list .='expiresAt.setTime(expiresAt.getTime() + '.$ppm_popup_timevalue.'*60*60*1000); // Hours';  
    else :
        $list .='expiresAt.setTime(expiresAt.getTime() + '.$ppm_popup_timevalue.'*60*1000); // Minutes';  
    endif;

    $list .='
    jQuery.cookie("popupLongerCookie'.$post_id.'", new Date());
    jQuery.cookie("popupTemporaryCookie'.$post_id.'", true, { expires: expiresAt });  
    ';
    endif;
        
    if($popup_show_on == '4') :
    $list .='});';
    endif;  
    
$list .='
});

//]]>
</script>
';
    
    endwhile;
    $list.= '</div>';
	wp_reset_query();
	return $list;
}
add_shortcode('ultimate_popup', 'ppm_popup_free_generate_shortcode');


function ultimatepopup_free_add_mce_button() {
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'ultimatepopup_free_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'ultimatepopup_free_register_mce_button' );
	}
}
add_action('admin_head', 'ultimatepopup_free_add_mce_button');

function ultimatepopup_free_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['ultimatepopup_free_mce_button'] = plugin_dir_url( __FILE__ ) .'/js/ultimatepopup-mce-button.js';
	return $plugin_array;
}

function ultimatepopup_free_register_mce_button( $buttons ) {
	array_push( $buttons, 'ultimatepopup_free_mce_button' );
	return $buttons;
}