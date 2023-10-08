<?php
/**
* 
* @package tx
* @author theme_x
* ======================================================================
*   Demo Data Import 
* ======================================================================
*/

// Demo instruction
function tx_plugin_intro_text( $message ) {
  
    $message = '<p style="font-size: 18px;color:#D85245;">'. esc_html__( '&#8594; Important Instruction:', 'education-pro' ) .'</p>';
    $message .= '<p style="font-size:15px">'. esc_html__( '&#9957; Best if used on new WordPress install.', 'education-pro' ) .'</p>';
    $message .= '<p style="font-size:15px">'. esc_html__( '&#9957; Before start importing demo data please check your server resources to meet our server minimum requirements below.', 'education-pro' ) .'</p>';
    $message .= '<p style="font-size:15px">'. esc_html__( '&#9957; If you plan to import more than one demo then please clear the existing demo before import the new demo. You can use the "WP Reset" plugin to reset everything.', 'education-pro' ) .'</p>';
    $message .= '<p style="font-size:15px">'. esc_html__( '&#9957; If the import process gets stuck, please reload the page and click the "Continue & Import" button again', 'education-pro' ) .'</p>';

    $message .= '<h3>'. esc_html__('Server Minimum Requirements','education-pro').'</h3>';
    $message .= '<p>'.esc_html__('&#8680; PHP version 7.4 or greater.','education-pro').'</p>';
    $message .= '<p>'.esc_html__('&#8680; MySQL version 5.6 or greater OR MariaDB version 10.1 or greater.','education-pro').'</p>';
    $message .= '<p>'.esc_html__('&#8680; WP Memory limit of 256 MB or greater','education-pro').'</p>';
    $message .= '<p>'.esc_html__('&#8680; max_execution_time 360 (This needs to be increased if your server is slow and cannot import data.)','education-pro').'</p>';
    $message .= '<p>'.esc_html__('&#8680; PHP Post Max Size: 256 MB or greater','education-pro').'</p>';
    $message .= '<p>'.esc_html__('&#8680; Upload File Size: 256 MB','education-pro').'</p>';
    $message .= '<p>'.esc_html__('&#8680; PHP Time Limit: 360','education-pro').'</p>';
    $message .= '<p>'.esc_html__('&#8680; Wordpress version 5.0 or greater','education-pro').'</p>';
 
    return $message;
}
add_filter( 'ocdi/plugin_intro_text', 'tx_plugin_intro_text' );

// Demo admin menu
function tx_plugin_page_setup( $default_settings ) {
    $default_settings['page_title']  = esc_html__( 'Education Pro Theme Demo Data Import' , 'education-pro' );
    $default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'education-pro' );
 
    return $default_settings;
}
add_filter( 'ocdi/plugin_page_setup', 'tx_plugin_page_setup' );

// Demo menu setup
function tx_demo_menu_setup() {
  
          //Set Menu
          $top_menu = get_term_by( 'name', 'Top Menu', 'nav_menu' );
          $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
          $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
          $left_menu = get_term_by( 'name', 'Left Menu(for header style 9 only)', 'nav_menu' );
          $right_menu = get_term_by( 'name', 'Right Menu(for header style 9 only)', 'nav_menu' );
          $side_menu = get_term_by( 'name', 'Side Menu', 'nav_menu' );
          $mobile_menu = get_term_by( 'name', 'Mobile Menu', 'nav_menu' );
          set_theme_mod( 'nav_menu_locations' , array( 
                'top_menu' => $top_menu->term_id,
                'main_menu' => $main_menu->term_id,
                'footer_menu'  => $footer_menu->term_id,
                'left_menu'  => $left_menu->term_id,
                'right_menu'  => $right_menu->term_id,
                'side_menu'  => $side_menu->term_id,
                'mobile_menu'  => $mobile_menu->term_id,
               ) 
          );
          // remove hello world post 
        wp_delete_post( 1, true );

}
add_action('tx_demo_menu_setup', 'tx_demo_menu_setup');

// LearnPress Settings
add_action('tx_learnpress_settings', 'tx_learnpress_settings');
function tx_learnpress_settings() {
  $lp_pages = array(
    'learn_press_courses_page_id' => 'All Courses',
    'learn_press_profile_page_id' => 'Profile',
    'learn_press_checkout_page_id'  => 'Course Checkout',
    'learn_press_become_a_teacher_page_id'  => 'Become A Teacher',
    'learn_press_term_conditions_page_id' => 'Term Conditions',
  );
  foreach( $lp_pages as $lp_page_name => $lp_page_title ) {
    $lp_page = get_page_by_title( $lp_page_title );
      if( isset( $lp_page->ID ) && $lp_page->ID ) {
        update_option($lp_page_name, $lp_page->ID);
      }
  }
  flush_rewrite_rules();
}

// WooCommerce Settings
add_action('tx_woocommerce_settings', 'tx_woocommerce_settings');
function tx_woocommerce_settings() {
      $woopages = array(
        'woocommerce_shop_page_id'      => 'Shop',
        'woocommerce_cart_page_id'     => 'Shopping Cart',
        'woocommerce_checkout_page_id'   => 'Checkout',
        'woocommerce_myaccount_page_id'  => 'My Account'
      );
      foreach( $woopages as $woo_page_name => $woo_page_title ) {
        $woopage = get_page_by_title( $woo_page_title );
        if( isset( $woopage->ID ) && $woopage->ID ) {
          update_option($woo_page_name, $woopage->ID);
        }
      }

      if( class_exists('WC_Admin_Notices') ) {
        WC_Admin_Notices::remove_notice('install');
      }
      delete_transient( '_wc_activation_redirect' );
      
      
      flush_rewrite_rules();
}

// Update WooCommerce Lookup Table
add_action('tx_update_woocommerce_lookup_table', 'tx_update_woocommerce_lookup_table');
function tx_update_woocommerce_lookup_table() {
      if( function_exists('wc_update_product_lookup_tables_is_running') && function_exists('wc_update_product_lookup_tables') ){
        if( !wc_update_product_lookup_tables_is_running() ){
          if( !defined('WP_CLI') ){
            define('WP_CLI', true);
          }
          wc_update_product_lookup_tables();
        }
      }
}

// Import Slider Revolution
function tx_rev_slider_import($slider_urls) {

        foreach( $slider_urls as $slider_url ) {

          if (!class_exists('WP_Http'))
              include_once( ABSPATH . WPINC . '/class-http.php' );
          $http = new WP_Http();

          $response = $http->request($slider_url);

          if ($response['response']['code'] != 200) {
              return false;
          }

          $upload = wp_upload_bits(basename($slider_url), null, $response['body']);

          if (!empty($upload['error'])) {
              return false;
          }

          $file_path = $upload['file'];

          $slider = new RevSliderSliderImport();

          $slider->importSliderFromPost(true,true,$file_path);

        }
        return $slider_urls;
}

// Demo plugin setup
function tx_register_plugins( $plugins ) {
  // List of plugins used by all theme demos.
  $theme_plugins = [
    [
          'name'               => esc_html__( 'Elementor', 'education-pro' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
    ],
    [
          'name'               => esc_html__( 'Contact Form 7', 'education-pro' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
    ],
    [
          'name'               => esc_html__( 'Slider Revolution', 'education-pro' ), // The plugin name.
          'slug'               => 'revslider', // The plugin slug (typically the folder name).
          'source'             => TX_THEME_DIR . 'inc/plugins/revslider.zip', // The plugin source.
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
    ],    
  ];

  // Check if user is on the theme recommended plugins step and a demo was selected.
  if (
    isset( $_GET['step'] ) &&
    $_GET['step'] === 'import' &&
    isset( $_GET['import'] )
  ) {
 
    // One
    if ( $_GET['import'] === '0' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'education-pro' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'education-pro' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Woocommerce', 'education-pro' ), // The plugin name.
          'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Slider Revolution', 'education-pro' ), // The plugin name.
          'slug'               => 'revslider', // The plugin slug (typically the folder name).
          'source'             => TX_THEME_DIR . 'inc/plugins/revslider.zip', // The plugin source.
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'LearnPress', 'education-pro' ), // The plugin name.
          'slug'               => 'learnpress', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'LearnPress Course Review', 'education-pro' ), // The plugin name.
          'slug'               => 'learnpress-course-review', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
      ];
    }

    // RTL
    if ( $_GET['import'] === '1' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'education-pro' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'education-pro' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Woocommerce', 'education-pro' ), // The plugin name.
          'slug'               => 'woocommerce', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Slider Revolution', 'education-pro' ), // The plugin name.
          'slug'               => 'revslider', // The plugin slug (typically the folder name).
          'source'             => TX_THEME_DIR . 'inc/plugins/revslider.zip', // The plugin source.
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'LearnPress', 'education-pro' ), // The plugin name.
          'slug'               => 'learnpress', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'LearnPress Course Review', 'education-pro' ), // The plugin name.
          'slug'               => 'learnpress-course-review', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
      ];
    }

    // Two
    if ( $_GET['import'] === '2' ) {
      $theme_plugins = [
        [
          'name'               => esc_html__( 'Elementor', 'education-pro' ), // The plugin name.
          'slug'               => 'elementor', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Contact Form 7', 'education-pro' ), // The plugin name.
          'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'LearnPress', 'education-pro' ), // The plugin name.
          'slug'               => 'learnpress', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'Slider Revolution', 'education-pro' ), // The plugin name.
          'slug'               => 'revslider', // The plugin slug (typically the folder name).
          'source'             => TX_THEME_DIR . 'inc/plugins/revslider.zip', // The plugin source.
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
        [
          'name'               => esc_html__( 'LearnPress Course Review', 'education-pro' ), // The plugin name.
          'slug'               => 'learnpress-course-review', // The plugin slug (typically the folder name).
          'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ],
      ];
    }


  }
 
  return array_merge( $plugins, $theme_plugins );
}
add_filter( 'ocdi/register_plugins', 'tx_register_plugins' );

/* ---------------------------------------------------------
    EOF
------------------------------------------------------------ */