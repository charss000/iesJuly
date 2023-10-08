<?php
/*
Plugin Name: Educaton Pro Core
Plugin URI: https://themes.network/
Description: This plugin is required for Education Pro Theme.
Author: theme_x
Author URI: https://themes.network/
Domain Path: /languages
Text Domain: education-pro-core
Version: 2.2.2
*/

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit; 

// Plugin Version
define('TX_PLUGIN_VERSION', '2.2.2');

// Plugin Path
define( 'TX_PLUGIN_PATH', ABSPATH . 'wp-content/plugins/education-pro-core/' );

// Plugin URL
define( 'TX_PLUGIN_URL', plugins_url( '', __FILE__ ) );

/**
 * Include language
 */
add_action( 'after_setup_theme', 'tx_load_plugin_textdomain' );
function tx_load_plugin_textdomain() {
	load_plugin_textdomain( 'education-pro-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

if ( !class_exists( 'ReduxFramework' ) ) :
require_once TX_PLUGIN_PATH . 'inc/redux-core/framework.php'; // Redux Framework
endif;
require_once TX_PLUGIN_PATH . 'inc/functions.php'; // Functions
require_once TX_PLUGIN_PATH . 'inc/cpt.php'; // Custom Post Type
require_once TX_PLUGIN_PATH . 'inc/gallery.php'; // for gallery post format
require_once TX_PLUGIN_PATH . 'inc/breadcrumbs.php'; // Breadcrumbs
require_once TX_PLUGIN_PATH . 'inc/social-media.php'; // Social Media
require_once TX_PLUGIN_PATH . 'inc/meta/author-bio.php'; // Author Bio
require_once TX_PLUGIN_PATH . 'inc/meta/post.php'; // Posts meta
require_once TX_PLUGIN_PATH . 'inc/meta/classes.php'; // Classes meta
require_once TX_PLUGIN_PATH . 'inc/meta/teachers.php'; // Teachers meta
require_once TX_PLUGIN_PATH . 'inc/widgets/recent-post-widget.php'; // recent-post-widget
require_once TX_PLUGIN_PATH . 'inc/widgets/posts-gallery-widget.php'; // posts-gallery-widget
require_once TX_PLUGIN_PATH . 'inc/widgets/posts-carousel-widget.php'; // posts-carousel-widget
require_once TX_PLUGIN_PATH . 'inc/widgets/category-widget.php'; //  category widget
require_once TX_PLUGIN_PATH . 'inc/widgets/tag-widget.php'; //  Tag widget
require_once TX_PLUGIN_PATH . 'inc/handler.php'; // Elementor support handler

/* ---------------------------------------------------------
  Enqueue Scripts
------------------------------------------------------------ */
  add_action( 'wp_enqueue_scripts', 'tx_plugin_enqueue_scripts' );
  function tx_plugin_enqueue_scripts() {
    // CSS
    wp_enqueue_style('tx-style', TX_PLUGIN_URL . '/assets/css/style.min.css');

    // rtl css
    if(is_rtl()):
      wp_enqueue_style('tx-style-rtl', TX_PLUGIN_URL . '/assets/css/style-rtl.min.css');
    endif;

    // JS
    wp_enqueue_script('tx-scripts', TX_PLUGIN_URL . '/assets/js/tx-scripts.min.js', array('jquery'), TX_PLUGIN_VERSION, true);
  }
  
/* ---------------------------------------------------------
  Admin Enqueue Scripts
------------------------------------------------------------ */

  add_action( 'admin_enqueue_scripts', 'tx_plugin_admin_enqueue_scripts' );
  function tx_plugin_admin_enqueue_scripts() {
    if( isset($_GET["page"]) && $_GET["page"] == "EducationPro") {
      wp_enqueue_script('search-options', TX_PLUGIN_URL . '/assets/js/search-options.min.js', array('jquery'), TX_PLUGIN_VERSION, true);
      
        // localize script
        wp_localize_script(
            'search-options',
            'tx_search_options',
            esc_html__('Search Options', 'education-pro-core')
        );
    }
  }

/* ---------------------------------------------------------
  Remove Query Strings From Static Resources
------------------------------------------------------------ */
function tx_remove_script_version( $src ) {
  $parts = explode( '?ver', $src );
        return $parts[0];
}
add_filter( 'script_loader_src', 'tx_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'tx_remove_script_version', 15, 1 );

/* ---------------------------------------------------------
  Update checker
------------------------------------------------------------ */
require TX_PLUGIN_PATH . 'inc/update/update.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
  'https://themes.network/x-doc/education-pro-core.json',
  __FILE__,
  'education-pro-core'
);

/* ------------------------------------------------------------------------------
   EOF
--------------------------------------------------------------------------------- */