<?php
/**
* 
* @package tx
* @author theme-x
* @link https://x-theme.com/
* ===================
* 	Functions
* ===================
*/

/* ---------------------------------------------------------
  Shortcode support for contact form 7
------------------------------------------------------------ */
function shortcodes_in_cf7( $form ) {
$form = do_shortcode( $form );
return $form;
}
add_filter( 'wpcf7_form_elements', 'shortcodes_in_cf7' );

// Enabled Shortcode for widget
add_filter('widget_text', 'do_shortcode');


/* ---------------------------------------------------------
  remove Elementor welcome screen after activate plugin
------------------------------------------------------------ */
add_action( 'admin_init', function() {
  if ( did_action( 'elementor/loaded' ) ) {
    remove_action( 'admin_init', [ \Elementor\Plugin::$instance->admin, 'maybe_redirect_to_getting_started' ] );
  }
}, 1 );


/* ---------------------------------------------------------
  Redux extension function
------------------------------------------------------------ */
$redux_opt_name = "tx";

if ( !function_exists( 'tx_redux_extension_loader' ) ) {
  function tx_redux_extension_loader( $ReduxFramework ) {
    $path    = dirname( __FILE__ ) . '/extensions/';
    $folders = scandir( $path, 1 );
    foreach ( $folders as $folder ) {
      if ( $folder === '.' or $folder === '..' or ! is_dir( $path . $folder ) ) {
        continue;
      }
      $extension_class = 'ReduxFramework_Extension_' . $folder;
      if ( ! class_exists( $extension_class ) ) {
        // In case you wanted override your override, hah.
        $class_file = $path . $folder . '/extension_' . $folder . '.php';
        $class_file = apply_filters( 'redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file );
        if ( $class_file ) {
          require_once $class_file;
        }
      }
      if ( ! isset( $ReduxFramework->extensions[ $folder ] ) ) {
        $ReduxFramework->extensions[ $folder ] = new $extension_class( $ReduxFramework );
      }
    }
  }
  // Modify {$redux_opt_name} to match your opt_name
  add_action( "redux/extensions/{$redux_opt_name}/before", 'tx_redux_extension_loader', 0 );
}

/* ---------------------------------------------------------
        remove Activate Demo Mode in pluigin
------------------------------------------------------------ */
    function tx_DemoModeLink() { 
        if ( class_exists('ReduxFrameworkPlugin') ) {
            remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
        }
        if ( class_exists('ReduxFrameworkPlugin') ) {
            remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
        }
    }
    add_action('init', 'tx_DemoModeLink');

/* ---------------------------------------------------------
  Title Limit
------------------------------------------------------------ */
function tx_title($n) {
  global $post;
  $title = get_the_title($post->ID);
  $title = substr($title,0,$n);
  echo $title;
}

/* ---------------------------------------------------------
  video embed for video post format
------------------------------------------------------------ */
if(!function_exists('tx_post_video_link')) :
  add_action( 'tx_post_video_link', 'tx_post_video_link' );
  function tx_post_video_link() {
    global $post;
    $post_video_link = get_post_meta( $post->ID, 'post_link', true );
    if(!empty($post_video_link)) :
    global $wp_embed;
    $post_embed = $wp_embed->run_shortcode('[embed width="1140"]'.$post_video_link.'[/embed]');
    echo $post_embed;

    endif;
  }
endif;



/* ---------------------------------------------------------
  EOF
------------------------------------------------------------ */

