<?php

/**
 * Get the bootstrap!
 */
if ( file_exists(  __DIR__ . '/init.php' ) ) {
  require_once  __DIR__ . '/init.php';
} elseif ( file_exists(  __DIR__ . '/init.php' ) ) {
  require_once  __DIR__ . '/init.php';
}

add_filter( 'cmb2_meta_boxes', 'ppm_pupup_free_cpt_option_metabox' );
function ppm_pupup_free_cpt_option_metabox( array $ultimate_popup_free_metaboxes ) {
   $ultimate_popup_free_metaboxes['ppm_popup_free_metabox'] = array(
       'id'           => 'ppm_popup_free_metabox',
       'title'        => __( 'Popup Settings', 'quickstart' ),
       'object_types' => array( 'ultimate-popup-free' ), // Post type
       'context'      => 'normal',
       'priority'     => 'default',
       'show_names'   => true,
       'fields'       => array(
            array(
                "name"    => __( 'Popup title', 'quickstart' ),
                "id"      =>  "ppm_popup_title",
                "type"    => "text",
                "desc"    => "Add popup title here.",
                "default"    => "Your AWESOME Popup Title",
            ),
            array(
                "name"    => __( 'Popup description', 'quickstart' ),
                "id"      =>  "ppm_popup_desc",
                "type"    => "textarea_small",
                "desc"    => "Popup description will show after the popup title. HTML Allowed",
                "default"    => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.",
            ),
            array(
                "name"    => __( 'Popup form code', 'quickstart' ),
                "id"      =>  "ppm_form_code",
                "type"    => "textarea_code",
                "desc"    => "Paste popup form code here. You can use HTML, JS or WordPress shortcode here.",
            ),
            array(
                "name"    => __( 'Popup width', 'quickstart' ),
                "id"      =>  "ppm_popup_width",
                "type"    => "text",
                "desc"    => "Set popup width here. You can use px or % value here. Don\'t forget to add px or % with values",
                "default"    => "450px",
            ),
            array(
                "name"    => __( 'Popup border width', 'quickstart' ),
                "id"      =>  "ppm_popup_border_width",
                "type"    => "text",
                "desc"    => "Set border width here. 0px = no border",
                "default"    => "8px",
            ),
            array(
                "name"    => __( 'Popup theme (Only available in premium version)', 'quickstart' ),
                "id"      =>  "ppm_popup_theme",
                "desc"    => "<span class='pop-premium-warning'>Popup theme only work on premium version. <a href='http://codecanyon.net/item/ultimate-popup-wordpress/13011293?ref=perfectpoint' target='_blank'>Click here</a> for purchase now.</span>",
                "type"    => "radio",
                "default"    => "1",
                "options" => array(
                    "1" => __( "Theme 1", "cmb" ),
                    "2" => __( "Theme 2", "cmb" ),
                    "3" => __( "Theme 3", "cmb" ),
                    "4" => __( "Theme 4", "cmb" ),
                    "5" => __( "Theme 5", "cmb" ),
                    "6" => __( "Theme 6", "cmb" ),
                    "7" => __( "Theme 7", "cmb" ),
                    "8" => __( "Theme 8", "cmb" ),
                    "9" => __( "Theme 9", "cmb" ),
                ),                 
            ),
            array(
                "name"    => __( 'Popup color', 'quickstart' ),
                "id"      =>  "ppm_popup_theme_color",
                "type"    => "colorpicker",
                "default"    => "#00619e",
                "desc"    => "Set popup theme color here. You can select color or use add HEX code here.",
            ),
            array(
                "name"    => __( 'Show cross Button?', 'quickstart' ),
                "id"      =>  "enable_cross_button",
                "type"    => "select",
                "desc"    => "If you want to show cross button, select yes. Otherwise select no.",
                "default" => "1",
                "options" => array(
                    "1" => __( "Yes", "cmb" ),
                    "2" => __( "No", "cmb" ),
                ),                
            ),
            array(
                "name"    => __( 'Popup show on', 'quickstart' ),
                "id"      =>  "popup_show_on",
                "type"    => "select",
                "desc"    => "<strong>Warning:</strong> Before close tab will not work on mobile!",
                "default" => "1",
                "options" => array(
                    "1" => __( "On halfway Scroll", "cmb" ),
                    "2" => __( "Automatically", "cmb" ),
                    "3" => __( "Before close tab", "cmb" ),
                ),                
            ),
            array(
                "name"    => __( 'When popup will load?', 'quickstart' ),
                "id"      =>  "when_popup_load",
                "type"    => "select",
                "default" => "1",
                "desc"    => "Select when popup will load.",
                "options" => array(
                    "1" => __( "Load after page load", "cmb" ),
                    "2" => __( "Load before page load", "cmb" ),
                ),                
            ),
            array(
                "name"    => __( 'Enable cookie?', 'quickstart' ),
                "id"      =>  "popup_enable_cookie",
                "type"    => "select",
                "default" => "1",
                "desc"    => "If you want to use popup with cookie, select yes. After that, configure cookie expiry below.",
                "options" => array(
                    "1" => __( "Yes - Display popup on first visit only", "cmb" ),
                    "2" => __( "No - Display popup everytime", "cmb" ),
                ),                
            ),
            array(
                "name"    => __( 'Popup time unit', 'quickstart' ),
                "id"      =>  "ppm_popup_timeunit",
                "type"    => "select",
                "default" => "1",
                "desc"    => "Select popup time unit here.",
                "options" => array(
                    "1" => __( "Day", "cmb" ),
                    "2" => __( "Hour", "cmb" ),
                    "3" => __( "Minute", "cmb" ),
                ),                
            ),
            array(
                "name"    => __( 'Popup time value', 'quickstart' ),
                "id"      =>  "ppm_popup_timevalue",
                "type"    => "text",
                "desc"    => "Select popup time value here.",
                "default"    => "1",
            ),  
            array(
                "name"    => __( 'Popup position', 'quickstart' ),
                "id"      =>  "ppm_popup_position",
                "type"    => "select",
                "default" => "1",
                "desc"    => "On scroll halfway, where from popup will show? Select that here.",
                "options" => array(
                    "1" => __( "Bottom right", "cmb" ),
                    "2" => __( "Bottom left", "cmb" ),
                ),                
            ),           
         
		)
	);
	return $ultimate_popup_free_metaboxes;
}


add_action( 'admin_head', 'cmb_metabox_free_hide_show' );
function cmb_metabox_free_hide_show() {

	// Bring the post type global into scope
	global $post_type;

	// If the current post type doesn't match, return, ie. end execution here
	if( 'ultimate-popup-free' != $post_type )
		return;

	// Else we reach this point and do whatever
	?>
	<script>
        jQuery(document).ready(function($){
            

              
    
            
$('.cmb2-id-popup-enable-cookie select option[selected=selected], .cmb2-id-popup-show-on select option[selected=selected]').each(function(){
    if($(this).val() == '2')
    { // or this.value == 'volvo'
        $(".cmb2-id-ppm-popup-timeunit, .cmb2-id-ppm-popup-timevalue").hide();
    }
    else
    {
        $(".cmb2-id-ppm-popup-timeunit, .cmb2-id-ppm-popup-timevalue").show();
    }    
});   
            
$(".cmb2-id-popup-enable-cookie select, .cmb2-id-popup-show-on select").change(function(){

    if($(this).val() == "2")
    {
        $(".cmb2-id-ppm-popup-timeunit, .cmb2-id-ppm-popup-timevalue").hide();
    }
    else
    {
        $(".cmb2-id-ppm-popup-timeunit, .cmb2-id-ppm-popup-timevalue").show();
    }
});             

      
    
            
$('.cmb2-id-popup-show-on select option[selected=selected]').each(function(){
    if($(this).val() == '2')
    { // or this.value == 'volvo'
        $(".cmb2-id-ppm-popup-position").hide();
    }
    else
    {
        $(".cmb2-id-ppm-popup-position").show();
    }    
});   
            
$(".cmb2-id-popup-show-on select").change(function(){

    if($(this).val() == "2")
    {
        $(".cmb2-id-ppm-popup-position").hide();
    }
    else
    {
        $(".cmb2-id-ppm-popup-position").show();
    }
});  
     
            
$('.cmb2-id-popup-show-on select option[selected=selected]').each(function(){
    if($(this).val() == '3')
    { // or this.value == 'volvo'
        $(".cmb2-id-popup-enable-cookie").addClass("popup-selected-halfway-scroll");
    }
    else
    {
        $(".cmb2-id-popup-enable-cookie").removeClass("popup-selected-halfway-scroll");
    }    
});   
            
$(".cmb2-id-popup-show-on select").change(function(){

    if($(this).val() == "3")
    {
        $(".cmb2-id-popup-enable-cookie").addClass("popup-selected-halfway-scroll");
    }
    else
    {
        $(".cmb2-id-popup-enable-cookie").removeClass("popup-selected-halfway-scroll");
    }
});  
        

            
        });
    </script>
    
    
    <style>
        .postbox-container .cmb2-id-ppm-popup-theme .cmb-th,
        .postbox-container .cmb2-id-ppm-popup-theme .cmb-td {
            float: none;
            width:auto
        }
        
        .postbox-container .cmb2-id-ppm-popup-theme .cmb-td ul.cmb2-radio-list {overflow: hidden;}
        .postbox-container .cmb2-id-ppm-popup-theme .cmb-td ul.cmb2-radio-list li{background: #f1f1f1;
float: left;
margin-bottom: 20px;
margin-right: 20px;
padding: 10px;
text-align: center;
width: 230px;}
        .postbox-container .cmb2-id-ppm-popup-theme .cmb-td ul.cmb2-radio-list li:hover,
        .postbox-container .cmb2-id-ppm-popup-theme .cmb-td ul.cmb2-radio-list li.active{}
        .postbox-container .cmb2-id-ppm-popup-theme .cmb-td ul.cmb2-radio-list li label{background-size:100% auto;
display: block;
height: 160px;
margin-top: 10px;
text-indent: -9999px;background-repeat:no-repeat;background-position:center center}
        .postbox-container .cmb2-id-ppm-popup-theme .cmb-td ul.cmb2-radio-list li label[for=ppm_popup_theme1]{background-image:url(../wp-content/plugins/ultimate-popup-free/img/theme_1.png)}
        .postbox-container .cmb2-id-ppm-popup-theme .cmb-td ul.cmb2-radio-list li label[for=ppm_popup_theme2]{background-image:url(../wp-content/plugins/ultimate-popup-free/img/theme_2.png)}
        .postbox-container .cmb2-id-ppm-popup-theme .cmb-td ul.cmb2-radio-list li label[for=ppm_popup_theme3]{background-image:url(../wp-content/plugins/ultimate-popup-free/img/theme_3.png)}
        .postbox-container .cmb2-id-ppm-popup-theme .cmb-td ul.cmb2-radio-list li label[for=ppm_popup_theme4]{background-image:url(../wp-content/plugins/ultimate-popup-free/img/theme_4.png)}
        .postbox-container .cmb2-id-ppm-popup-theme .cmb-td ul.cmb2-radio-list li label[for=ppm_popup_theme5]{background-image:url(../wp-content/plugins/ultimate-popup-free/img/theme_5.png)}
        .postbox-container .cmb2-id-ppm-popup-theme .cmb-td ul.cmb2-radio-list li label[for=ppm_popup_theme6]{background-image:url(../wp-content/plugins/ultimate-popup-free/img/theme_6.png)}
        .postbox-container .cmb2-id-ppm-popup-theme .cmb-td ul.cmb2-radio-list li label[for=ppm_popup_theme7]{background-image:url(../wp-content/plugins/ultimate-popup-free/img/theme_7.png)}
        .postbox-container .cmb2-id-ppm-popup-theme .cmb-td ul.cmb2-radio-list li label[for=ppm_popup_theme8]{background-image:url(../wp-content/plugins/ultimate-popup-free/img/theme_8.png)}
        .postbox-container .cmb2-id-ppm-popup-theme .cmb-td ul.cmb2-radio-list li label[for=ppm_popup_theme9]{background-image:url(../wp-content/plugins/ultimate-popup-free/img/theme_9.png)}
        .postbox-container .cmb2-id-ppm-popup-theme .cmb-td ul.cmb2-radio-list li label[for=ppm_popup_theme10]{background-image:url(../wp-content/plugins/ultimate-popup-free/img/theme_10.png)}
        
        
        .cmb2-id-popup-enable-cookie.popup-selected-halfway-scroll::before {
            background-color: #fcf8e3;
            color: #8a6d3b;
            content: "You are using popup by Before close tab. That need to enalbe cookie. Make sure you selected Yes here.";
            display: block;
            font-size: 12px;
            margin-bottom: 10px;
            margin-top: -15px;
            padding: 5px;
        }   
        .pop-premium-warning {
            background: #f2dede none repeat scroll 0 0;
            color: #a94442;
            display: block;
        }  
        .cmb-row.cmb-type-radio.cmb2-id-ppm-popup-theme {
            background: #f2dede none repeat scroll 0 0;
            padding: 15px !important;
        }        
        
    </style>
	<?php
}