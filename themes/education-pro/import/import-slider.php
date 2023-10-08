<?php
/**
* 
* @package tx
* @author theme-x
* @link https://theme-x.org/
* ======================================================================
*   Import Slider
* ======================================================================
*/
// demo after import setup 
function tx_after_import_setup( $selected_import ) {

    if ( 'Demo One' === $selected_import['import_file_name'] ) {
        
        //Set Menu
        do_action( 'tx_demo_menu_setup' );
        //Set Front page
        $page = get_page_by_title( 'Home One');
        if ( isset( $page->ID ) ) {
          update_option( 'page_on_front', $page->ID );
          update_option( 'show_on_front', 'page' );
        }
        //LearnPress
        do_action('tx_learnpress_settings');

         // WooCommerce Settings
        do_action( 'tx_woocommerce_settings' );
        // Update WooCommerce Lookup Table
        do_action( 'tx_update_woocommerce_lookup_table' );
        // delete WooCommerce transient
        delete_transient('wc_products_onsale');

         //Import Revolution Slider
        if ( class_exists( 'RevSliderSlider' ) ) {

          $slider_urls = [TX_IMPORT_URL.'one/education-pro-one.zip'];
          tx_rev_slider_import($slider_urls);

        } //RevSliderSlider

    }elseif ( 'Demo RTL' === $selected_import['import_file_name'] ) {
        
        //Set Menu
        do_action( 'tx_demo_menu_setup' );
        //Set Front page
        $page = get_page_by_title( 'Home RTL');
        if ( isset( $page->ID ) ) {
          update_option( 'page_on_front', $page->ID );
          update_option( 'show_on_front', 'page' );
        }
        //LearnPress
        do_action('tx_learnpress_settings');

         // WooCommerce Settings
        do_action( 'tx_woocommerce_settings' );
        // Update WooCommerce Lookup Table
        do_action( 'tx_update_woocommerce_lookup_table' );
        // delete WooCommerce transient
        delete_transient('wc_products_onsale');

         //Import Revolution Slider
        if ( class_exists( 'RevSliderSlider' ) ) {

          $slider_urls = [TX_IMPORT_URL.'rtl/education-pro-rtl.zip'];
          tx_rev_slider_import($slider_urls);

        } //RevSliderSlider

    }elseif ( 'Demo Two' === $selected_import['import_file_name'] ) {
        
       //Set Menu
        do_action( 'tx_demo_menu_setup' );
         //Set Front page
        $page = get_page_by_title( 'Home Two');
        if ( isset( $page->ID ) ) {
          update_option( 'page_on_front', $page->ID );
          update_option( 'show_on_front', 'page' );
        }
        
        //LearnPress
        do_action('tx_learnpress_settings');

        //Import Revolution Slider
        if ( class_exists( 'RevSliderSlider' ) ) {

          $slider_urls = [TX_IMPORT_URL.'two/education-pro-two.zip'];
          tx_rev_slider_import($slider_urls);

        } //RevSliderSlider

    }elseif ( 'Kindergarten' === $selected_import['import_file_name'] ) {
        
       //Set Menu
        do_action( 'tx_demo_menu_setup' );
         //Set Front page
        $page = get_page_by_title( 'Home Kindergarten');
        if ( isset( $page->ID ) ) {
          update_option( 'page_on_front', $page->ID );
          update_option( 'show_on_front', 'page' );
        }
        
        //Import Revolution Slider
        if ( class_exists( 'RevSliderSlider' ) ) {

          $slider_urls = [TX_IMPORT_URL.'kindergarten/education-pro-kindergarten.zip'];
          tx_rev_slider_import($slider_urls);

        } //RevSliderSlider

    }elseif ( 'Driving School' === $selected_import['import_file_name'] ) {
        
       //Set Menu
        do_action( 'tx_demo_menu_setup' );
         //Set Front page
        $page = get_page_by_title( 'Home Driving School');
        if ( isset( $page->ID ) ) {
          update_option( 'page_on_front', $page->ID );
          update_option( 'show_on_front', 'page' );
        }
        
        //Import Revolution Slider
        if ( class_exists( 'RevSliderSlider' ) ) {

          $slider_urls = [TX_IMPORT_URL.'driving-school/ep-driving-school.zip'];
          tx_rev_slider_import($slider_urls);

        } //RevSliderSlider

    }

    
}
add_action( 'ocdi/after_import', 'tx_after_import_setup' );

/* ---------------------------------------------------------
    EOF
------------------------------------------------------------ */