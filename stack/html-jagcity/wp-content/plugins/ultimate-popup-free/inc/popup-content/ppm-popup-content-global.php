<?php
    function ppm_popup_free_get_option( $option, $section, $default = '' ) {

        $options = get_option( $section );

        if ( isset( $options[$option] ) ) {
            return $options[$option];
        }

        return $default;
    } 

    $global_popup_id = ppm_popup_free_get_option( 'global_popup_id', 'ppm_side_popup_global', '' ); 
    
    $popup_posts = query_posts('p='.$global_popup_id.'&post_type=ultimate-popup-free&posts_per_page=1');
    global $post;
    
?> 

<?php foreach($popup_posts as $post) : ?>
<?php setup_postdata($post); ?>

<?php 
   $enable_cross_button= get_post_meta($post->ID, 'enable_cross_button', true); 
   $ppm_popup_title= get_post_meta($post->ID, 'ppm_popup_title', true); 
   $ppm_popup_desc= get_post_meta($post->ID, 'ppm_popup_desc', true); 
   $ppm_popup_timeunit= get_post_meta($post->ID, 'ppm_popup_timeunit', true); 
   $ppm_popup_timevalue= get_post_meta($post->ID, 'ppm_popup_timevalue', true); 
   $ppm_popup_position= get_post_meta($post->ID, 'ppm_popup_position', true); 
   $ppm_popup_width= get_post_meta($post->ID, 'ppm_popup_width', true); 
   $ppm_popup_border_width= get_post_meta($post->ID, 'ppm_popup_border_width', true); 
   $ppm_popup_theme_color= get_post_meta($post->ID, 'ppm_popup_theme_color', true); 
   $popup_show_on= get_post_meta($post->ID, 'popup_show_on', true); 
   $popup_enable_cookie= get_post_meta($post->ID, 'popup_enable_cookie', true); 
   $when_popup_load= get_post_meta($post->ID, 'when_popup_load', true); 
   $ppm_popup_left_content= get_post_meta($post->ID, 'ppm_popup_left_content', true); 
   $ppm_form_code= get_post_meta($post->ID, 'ppm_form_code', true); 
?>

<div id="ppm-popup-<?php the_ID(); ?>" class="ppm-popup-wrapper ppm-popup-theme-id-1 <?php if($popup_show_on == '1') : ?>ppm-popup-halfway-scroll-activate<?php elseif($popup_show_on == '2') : ?>ppm-popup-automatic-activate<?php endif; ?>">
   
    <?php if($enable_cross_button == '1') : ?>
    <span class="cross-btn-ppm">x</span>
    <?php endif; ?>    
       
    <div class="ppm-popup-inner">
        <?php if($ppm_popup_title) : ?>
        <h2 class="ppm-popup-inner-title"><?php echo $ppm_popup_title; ?></h2>
        <?php endif; ?>

        <?php if($ppm_popup_desc) : ?>
        <p class="ppm-popup-inner-description"><?php echo $ppm_popup_desc; ?></p>
        <?php endif; ?>

        <div class="ppm-popup-shortcodes">
            <?php echo do_shortcode( $ppm_form_code ); ?>
        </div>
    </div> 
</div>


<style>
    
    #ppm-popup-<?php the_ID(); ?> {width: <?php echo $ppm_popup_width; ?>; border-width:<?php echo $ppm_popup_border_width; ?>;border-color:<?php echo $ppm_popup_theme_color; ?>}
    #ppm-popup-<?php the_ID(); ?> .ppm-popup-shortcodes input[type="submit"] {background:<?php echo $ppm_popup_theme_color; ?>}
    #ppm-popup-<?php the_ID(); ?> .cross-btn-ppm {color:<?php echo $ppm_popup_theme_color; ?>}
    <?php if($popup_show_on == '1') : ?>
        <?php if($ppm_popup_position == '2') : ?>
            #ppm-popup-<?php the_ID(); ?> {left: 0;bottom: -100%;}
            #ppm-popup-<?php the_ID(); ?>.ppm-popup-wrapper-activate {bottom: 0;} 
        <?php else : ?>    
            #ppm-popup-<?php the_ID(); ?> {right: 0;bottom: -100%;}
            #ppm-popup-<?php the_ID(); ?>.ppm-popup-wrapper-activate {bottom: 0;}
        <?php endif; ?>   
    
    <?php endif; ?>
</style>


<script type="text/javascript">
//<![CDATA[  
    
    
    
<?php if($when_popup_load == '2') : ?>
    jQuery(document).ready(function(){    
<?php else : ?>
    jQuery(window).load(function(){   
<?php endif; ?>
        
      

    <?php if($popup_enable_cookie == '2') : ?>
    
        <?php if($popup_show_on == '2') : ?>
            jQuery("#ppm-popup-<?php the_ID(); ?>").easyModal({
                autoOpen: true,
                closeButtonClass: '.cross-btn-ppm'
            });

            jQuery('#ppm-popup-<?php the_ID(); ?>').addClass('ppm-popup-wrapper-activate');

        <?php else : ?>

            // Popup is showing first time!
            jQuery(window).scroll(function () { 
              if (jQuery(window).scrollTop() > jQuery('body').height() / 2) {
                jQuery('#ppm-popup-<?php the_ID(); ?>').addClass('ppm-popup-wrapper-activate');
              } 
            });  

        <?php endif; ?>      
    
    <?php else : ?>
    
    <?php if($popup_show_on == '4') : ?>
    jQuery('body').mouseleave(function() {    
    <?php endif; ?>

    if (jQuery.cookie('popupTemporaryCookie<?php the_ID(); ?>')) {

        // Popup is hiding after showing first time!
        jQuery("#ppm-popup-<?php the_ID(); ?>").hide();

    } else if (jQuery.cookie('popupLongerCookie<?php the_id(); ?>')) {
        
    <?php if($popup_show_on == '2') : ?>
        jQuery("#ppm-popup-<?php the_ID(); ?>").easyModal({
            autoOpen: true,
            closeButtonClass: '.cross-btn-ppm'
        });
    
        jQuery('#ppm-popup-<?php the_ID(); ?>').addClass('ppm-popup-wrapper-activate');
        
    <?php elseif($popup_show_on == '3') : ?>
        jQuery('body').mouseleave(function() { 
        
            jQuery("#ppm-popup-<?php the_ID(); ?>").easyModal({
                autoOpen: true,
                closeButtonClass: '.cross-btn-ppm',
                overlayOpacity:0
            });
            
            jQuery(".cross-btn-ppm, .lean-overlay").click(function(){
                jQuery('body').addClass('ppm-popup-wrapper-hide');
            });

            jQuery('#ppm-popup-<?php the_ID(); ?>').addClass('ppm-popup-wrapper-activate');
        });        
        
    <?php else : ?>
        
        // Popup is showing again!
        jQuery(window).scroll(function () { 
          if (jQuery(window).scrollTop() > jQuery('body').height() / 2) {
            jQuery('#ppm-popup-<?php the_ID(); ?>').addClass('ppm-popup-wrapper-activate');
          } 
        });
        
    <?php endif; ?>        



    } else {
        
    <?php if($popup_show_on == '2') : ?>
        jQuery("#ppm-popup-<?php the_ID(); ?>").easyModal({
            autoOpen: true,
            closeButtonClass: '.cross-btn-ppm'
        });
    
        jQuery('#ppm-popup-<?php the_ID(); ?>').addClass('ppm-popup-wrapper-activate');
        
    <?php elseif($popup_show_on == '3') : ?>
        
        jQuery('body').mouseleave(function() { 
            jQuery("#ppm-popup-<?php the_ID(); ?>").easyModal({
                autoOpen: true,
                closeButtonClass: '.cross-btn-ppm',
                overlayOpacity:0
            });
            
            jQuery(".cross-btn-ppm, .lean-overlay").click(function(){
                jQuery('body').addClass('ppm-popup-wrapper-hide');
            });            

            jQuery('#ppm-popup-<?php the_ID(); ?>').addClass('ppm-popup-wrapper-activate');
       });    
        
    <?php else : ?>
        
        // Popup is showing first time!
        jQuery(window).scroll(function () { 
          if (jQuery(window).scrollTop() > jQuery('body').height() / 2) {
            jQuery('#ppm-popup-<?php the_ID(); ?>').addClass('ppm-popup-wrapper-activate');
          } 
        });  
        
    <?php endif; ?>       

    }
        
      

    var expiresAt = new Date();
    
    <?php if($ppm_popup_timeunit == '1') : ?>
    expiresAt.setTime(expiresAt.getTime() + <?php echo $ppm_popup_timevalue; ?>*24*60*60*1000); // Days               
    <?php elseif($ppm_popup_timeunit == '2') : ?>
    expiresAt.setTime(expiresAt.getTime() + <?php echo $ppm_popup_timevalue; ?>*60*60*1000); // Hours  
    <?php else : ?>
    expiresAt.setTime(expiresAt.getTime() + <?php echo $ppm_popup_timevalue; ?>*60*1000); // Minutes  
    <?php endif; ?>


    jQuery.cookie('popupLongerCookie<?php the_id(); ?>', new Date());
    jQuery.cookie('popupTemporaryCookie<?php the_ID(); ?>', true, { expires: expiresAt });  
    
    <?php endif; ?>
        
    <?php if($popup_show_on == '4') : ?>
    });
    <?php endif; ?>          

});

//]]>
</script>

<?php endforeach; ?>  