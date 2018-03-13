<?php
/**
 * This page shows the procedural or functional example
 *
 * OOP way example is given on the main plugin file.
 *
 * @author Tareq Hasan <tareq@weDevs.com>
 */


/**
 * Registers settings section and fields
 */
function ppm_side_popup_free_admin_init() {

    $sections = array(
        array(
            'id' => 'ppm_side_popup_free_global',
            'title' => __( 'Global popup settings', 'expand-coming-soon' )
        ),
        array(
            'id' => 'ppm_side_popup_free_help',
            'title' => __( 'Help', 'expand-coming-soon' )
        )
    );

    $fields = array(
        'ppm_side_popup_free_global' => array(
            array(
                'name' => 'global_display_settings',
                'label' => __( 'Popup will appear in?', 'expand-coming-soon' ),
                'desc' => __( 'Select where popup will appear', 'expand-coming-soon' ),
                'type' => 'select',
                'default' => '2',
                'options' => array(
                    '1' => 'Activate on homepage only',
                    '2' => 'Activate on all pages',
                    '3' => 'Disable popup on homepage'
                )
            ), 
            array(
                'name' => 'global_popup_id',
                'label' => __( 'Global Popup ID', 'expand-coming-soon' ),
                'desc' => __( 'Insert Global Popup ID here. Click on help tab if you don\'t know how to get popup ID.', 'expand-coming-soon' ),
                'type' => 'text',
                'default' => ''
            ),
            array(
                'name' => 'page_display_settings',
                'label' => __( 'Page popup settings', 'expand-coming-soon' ),
                'desc' => __( '<strong>Enable different popup for pages:</strong> It enables different popup on single pages, you need to create popup for single page & insert popup shortcode on that page edit. <br/><strong>Use same popup from homepage:</strong> It will show same popup from homepage.', 'expand-coming-soon' ),
                'type' => 'select',
                'default' => '1',
                'options' => array(
                    '1' => 'Enable different popup for pages',
                    '2' => 'Use same popup from homepage'
                )
            ), 
            array(
                'name' => 'post_display_settings',
                'label' => __( 'Post popup settings', 'expand-coming-soon' ),
                'desc' => __( '<strong>Enable different popup for posts:</strong> It enables different popup on single posts, you need to create popup for post & insert popup shortcode on that post edit. <br/><strong>Use same popup from homepage:</strong> It will show same popup from homepage.', 'expand-coming-soon' ),
                'type' => 'select',
                'default' => '1',
                'options' => array(
                    '1' => 'Enable different popup for posts',
                    '2' => 'Use same popup from homepage'
                )
            ),            
        ),

    );

    $settings_api = WeDevs_Settings_API_Ultimate_Popup_Free::getInstance();

    //set sections and fields
    $settings_api->set_sections( $sections );
    $settings_api->set_fields( $fields );

    //initialize them
    $settings_api->admin_init();
}

add_action( 'admin_init', 'ppm_side_popup_free_admin_init' );


add_action( 'admin_menu', 'ppm_side_popup_free_admin_menu' );

function ppm_side_popup_free_admin_menu() {
    // Add an item to the menu.
    add_menu_page(
        __( 'PPM Popup Free Settings', 'textdomain' ),
        __( 'Popup Settings', 'textdomain' ),
        'manage_options',
        'ppm-popup-free-settings',
        'ppm_side_popup_free_options_functions',
        'dashicons-exerpt-view'
    );
}


/**
 * Display the plugin settings options page
 */
function ppm_side_popup_free_options_functions() {
    $settings_api = WeDevs_Settings_API_Ultimate_Popup_Free::getInstance();

    echo '
    <style>
        .ppm-popup-option-cl .form-wrap p, .ppm-popup-option-cl p.description, p.help, span.description {display: block;}
    </style>
    <div class="wrap ppm-popup-option-cl">';
    settings_errors();

    $settings_api->show_navigation();
    $settings_api->show_forms();

    echo '</div>';
}