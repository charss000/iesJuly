<?php
/**
* 
* @package tx
* @author theme_x
* 
* ======================================================================
*   This is main functions file you may add your custom functions here. 
* ======================================================================
*/

global $tx;
$theme = wp_get_theme();
if ( ! defined( 'TX_THEME_VERSION' ) ) {
  define('TX_THEME_VERSION', $theme->get('Version'));
}
if ( ! defined( 'TX_THEME_DIR' ) ) {
  define( 'TX_THEME_DIR', trailingslashit( get_template_directory() ) );
}
if ( ! defined( 'TX_THEME_URL' ) ) {
  define( 'TX_THEME_URL', trailingslashit( get_template_directory_uri() ) );
}
if ( ! defined( 'TX_STYLESHEET_DIR' ) ) {
  define( 'TX_STYLESHEET_DIR', trailingslashit( get_stylesheet_directory() ) );
}
if ( ! defined( 'TX_STYLESHEET_URL' ) ) {
  define( 'TX_STYLESHEET_URL', trailingslashit( get_stylesheet_directory_uri() ) );
}
if ( ! defined( 'TX_CSS' ) ) {
  define( 'TX_CSS', TX_THEME_URL . 'assets/css/' );
}
if ( ! defined( 'TX_JS' ) ) {
  define( 'TX_JS', TX_THEME_URL . 'assets/js/' );
}
if ( ! defined( 'TX_IMAGES' ) ) {
  define( 'TX_IMAGES', TX_THEME_URL . 'assets/images/' );
}
if ( ! defined( 'TX_IMPORT_URL' ) ) {
  define( 'TX_IMPORT_URL', 'https://themes.network/ep-d-data/' );
}
if ( ! defined( 'TX_DEMO_URL' ) ) {
  define( 'TX_DEMO_URL', 'https://themes.network/education-pro-' );
}

require_once TX_THEME_DIR . 'inc/updates.php'; // theme updates
require_once TX_THEME_DIR . 'inc/mega-menu.php'; // mega menu
require_once TX_THEME_DIR . 'inc/enqueue.php'; // enqueue
require_once TX_THEME_DIR . 'inc/tgm.php'; // TGM plugin activation
require_once TX_THEME_DIR . 'inc/custom-sidebars.php'; // Widgets Sidebars
require_once TX_THEME_DIR . 'inc/login.php'; // ajax login
require_once TX_THEME_DIR . 'inc/functions.php'; // functions
require_once TX_THEME_DIR . 'inc/welcome.php'; // welcome screen
require_once TX_THEME_DIR . 'inc/theme-options.php'; // Theme options
require_once TX_THEME_DIR . 'inc/post-meta.php'; // Post Meta Categories, Tags etc
require_once TX_THEME_DIR . 'inc/pagination.php'; // Pagination
require_once TX_THEME_DIR . 'inc/comments-callback.php'; // Comments callback
require_once TX_THEME_DIR . 'inc/dynamic-style.php'; // Dynamic Styles
require_once TX_THEME_DIR . 'inc/import.php'; // demo import
require_once TX_THEME_DIR . 'import/import-files.php'; // import files
require_once TX_THEME_DIR . 'import/import-slider.php'; // import sliders


// LearnPress plugin's functions for Education
if ( class_exists( 'LearnPress' ) ) {
  require_once TX_THEME_DIR . 'learnpress/lp-functions.php'; 
}

// Woocommerece plugin's functions for eCommerce Shop
if ( class_exists( 'WooCommerce' ) ) {
  require_once TX_THEME_DIR . 'woocommerce/woo-functions.php'; 
}


/* ---------------------------------------------------------
  Theme Setup
------------------------------------------------------------ */

if( !function_exists('tx_theme_setup') ) :
  add_action( 'after_setup_theme', 'tx_theme_setup' );
  function tx_theme_setup() {

    // menu setup
    register_nav_menus (array(
      'top_menu'    => esc_html__('Top Menu','education-pro'),
      'main_menu'   => esc_html__('Main Menu','education-pro'),
      'left_menu'   => esc_html__('Left Menu(for header style 9 only)','education-pro'),
      'right_menu'  => esc_html__('Right Menu(for header style 9 only)','education-pro'),
      'side_menu'   => esc_html__('Side Header Menu','education-pro'),
      'footer_menu' => esc_html__('Footer Menu','education-pro'),
      'mobile_menu' => esc_html__('Mobile Menu(for header style 9 only)','education-pro'),
    ));

    // Makes theme available for translation.
    load_theme_textdomain( 'education-pro', TX_THEME_DIR . '/languages' );

    // Supported posts formats
    add_theme_support( 'post-formats', array( 'gallery', 'video' ) );

    // Add RSS Links to head section
    add_theme_support( 'automatic-feed-links' );

    // Title tag support
    add_theme_support( 'title-tag' );

    // Custom logo support
    add_theme_support( 'custom-logo', array(
      'height'      => 100,
      'width'       => 400,
      'flex-height' => true,
      'flex-width'  => true,
      'header-text' => array( 'site-title', 'site-description' ),
    ) );

    // Custom header support
    $args = array(
        'width'              => 1920,
        'height'             => 100,
        'flex-width'         => true,
        'flex-height'        => true,
    );
    add_theme_support( 'custom-header', $args );

    // Custom backgrounds support
    add_theme_support( 'custom-background', array() );

if ( class_exists( 'WooCommerce' ) ) {
    // WooCommerce support
    add_theme_support('woocommerce');

    // WooCommerce product gallery zoom support
    add_theme_support( 'wc-product-gallery-zoom' );

    // WooCommerce product gallery lightbox support
    add_theme_support( 'wc-product-gallery-lightbox' );

    // WooCommerce product gallery slider support
    add_theme_support( 'wc-product-gallery-slider' );
}
    // Enable WP Responsive embedded content
    add_theme_support( 'responsive-embeds' );

    // Enable WP Gutenberg Align Wide
    add_theme_support( 'align-wide' );

    // Enable WP Gutenberg Block Style
    add_theme_support( 'wp-block-styles' );

    // Add support for editor styles.
    add_theme_support( 'editor-styles' );

    // Partial refresh support in the Customize
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Enable support for custom Editor Style.
    add_editor_style( 'custom-editor-style.css' );

    // Enable Custom Color Scheme For Block Style
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => esc_html__( 'deep cerise', 'education-pro' ),
            'slug' => 'deep-cerise',
            'color' => '#e51681',
        ),    
        array(
            'name' => esc_html__( 'strong magenta', 'education-pro' ),
            'slug' => 'strong-magenta',
            'color' => '#a156b4',
        ),
        array(
            'name' => esc_html__( 'light grayish magenta', 'education-pro' ),
            'slug' => 'light-grayish-magenta',
            'color' => '#d0a5db',
        ),
        array(
            'name' => esc_html__( 'very light gray', 'education-pro' ),
            'slug' => 'very-light-gray',
            'color' => '#eee',
        ),
        array(
            'name' => esc_html__( 'very dark gray', 'education-pro' ),
            'slug' => 'very-dark-gray',
            'color' => '#444',
        ),
        array(
            'name'  =>  esc_html__( 'strong blue', 'education-pro' ),
            'slug'  => 'strong-blue',
            'color' => '#0073aa',
        ),
        array(
            'name'  =>  esc_html__( 'lighter blue', 'education-pro' ),
            'slug'  => 'lighter-blue',
            'color' => '#229fd8',
        ),
    ) );

    // Block Font Sizes
    add_theme_support( 'editor-font-sizes', array(
        array(
            'name' => esc_html__( 'Small', 'education-pro' ),
            'size' => 12,
            'slug' => 'small'
        ),
        array(
            'name' => esc_html__( 'Regular', 'education-pro' ),
            'size' => 16,
            'slug' => 'regular'
        ),
        array(
            'name' => esc_html__( 'Large', 'education-pro' ),
            'size' => 36,
            'slug' => 'large'
        ),
        array(
            'name' => esc_html__( 'Huge', 'education-pro' ),
            'size' => 50,
            'slug' => 'larger'
        )
    ) );

    // Content Width
    if ( ! isset( $content_width ) ) {
      $content_width = 1140;
    }
  }
endif;

/* ------------------------------------------------------------------------
  Enable support for Post Thumbnails on posts, pages and custom post type.
--------------------------------------------------------------------------- */ 
if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );
    add_image_size('tx-xxl-thumb', 1920, 1280, false); // Double Extra large thumbnail
    add_image_size('tx-xxl-gallery', 1920, 1280, false); // Double Extra large thumbnail
    add_image_size('tx-1920x600-thumb', 1920, 600, true); // full width 1920x600px
    add_image_size('tx-xl-thumb', 1140, 550, true); // Extra large thumbnail
    add_image_size('tx-l-thumb', 770, 420, true); // large thumbnail
    add_image_size('tx-s-thumb', 100, 75, true); // small thumbnail
    add_image_size('tx-m-thumb', 580, 460, true ); // medium thumbnail
    add_image_size('tx-ms-size', 350, 220, true ); // medium small
    add_image_size('tx-bc-thumb', 360, 220, true); // blog three cols, two cols
    add_image_size('tx-serv-thumb', 360, 260, true); // classes
    add_image_size('tx-t-thumb', 263, 300, true); // teacher
    add_image_size('tx-tf-thumb', 320, 360, true); // teacher full width template
    add_image_size('tx-ts-thumb', 458, 545, true); // teacher single thumbnail
    add_image_size('tx-r-thumb', 270, 188, true); // related post thumbnail
    add_image_size('tx-c-thumb', 320, 220, true); // Posts carousel widget thumbnail
    add_image_size('tx-timeline-thumb', 460, 300, true); // Timeline widget thumbnail

  function max_title_length( $title ) {
    global $tx;
      if (class_exists('ReduxFramework')) {

        $max = $tx['title-length']; 
        if( strlen( $title ) > $max ) {
        return substr( $title, 0, $max );
        } else {
        return $title;
        }

      }else{

        $max = 85;
      if( strlen( $title ) > $max ) {
      return substr( $title, 0, $max );
      } else {
      return $title;
      }
  }
}

add_filter( 'the_title', 'max_title_length');

/* ---------------------------------------------------------
  Excerpt word limit
------------------------------------------------------------ */
  function tx_excerpt($limit) {
    global $tx;
    if (class_exists('ReduxFramework')) {
     $limit = $tx['excerpt-word-limit'];
    }else{
      $limit = 35;
    }
      $excerpt = explode(' ', '<p class="tx-excerpt">'.get_the_excerpt().'</p>', $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      if(class_exists('ReduxFramework')) {
        $rmt = $tx['read-more-text'];
        if($tx['read-more']) :
          
          $excerpt .= '<div class="tx-read-more"><a href="'. esc_url(get_permalink()) .'">'. esc_html($rmt) .'</a></div>';

        endif;
      }
      return $excerpt;
  }
  add_filter('the_excerpt', 'tx_excerpt');

/* ---------------------------------------------------------
  Excerpt word limit
------------------------------------------------------------ */
function tx_excerpt_limit($limit) {

      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt);
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);

      return $excerpt;
  }

/* ---------------------------------------------------------
  Content word limit
------------------------------------------------------------ */
  function tx_content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
  }

/* ---------------------------------------------------------
  Page content
------------------------------------------------------------ */

if(!function_exists('tx_content_page')) :
  add_action( 'tx_content_page', 'tx_content_page' );
  function tx_content_page() { ?>
        <div id="primary" class="col-md-12">
            <div id="main" class="site-main">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/content/content', 'page'); ?>
                    <?php
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                <?php endwhile; // end of the loop.  ?>
            </div><!-- #main -->
        </div><!-- #primary -->

<?php }

endif;

/* ---------------------------------------------------------
  Post format
------------------------------------------------------------ */
function tx_post_format( $template ) {
    if ( is_single() && has_post_format() ) {
        $post_format_template = locate_template( 'single-' . get_post_format() . '.php' );
        if ( $post_format_template ) {
            $template = $post_format_template;
        }
    }

    return $template;
}   
add_filter( 'template_include', 'tx_post_format' );

/* ----------------------------------------------------------------
    Index, Archives, Category etc post page Sidebar / No Sidebar
----------------------------------------------------------------- */
if(!function_exists('tx_sidebar_no_sidebar')) :
  function tx_sidebar_no_sidebar() {
    if (class_exists('ReduxFramework')) {
      global $tx;
      if($tx['sidebar-select'] == null || $tx['sidebar-select'] == 'sidebar-none') {
        echo 12;
      } else {
       echo 8;
      }
    }else{
      echo 8;
    }

  }
endif;

/* ---------------------------------------------------------
    Single Post Sidebar / No Sidebar
------------------------------------------------------------ */
if(!function_exists('tx_single_sidebar')) :
  function tx_single_sidebar() {
    global $tx;
    if($tx['sidebar-single'] == null || $tx['sidebar-single'] == 'sidebar-none') {
      echo 12;
    } else {
     echo 8;
    }
  }
endif;

/* ---------------------------------------------------------
    Add sideber class to body for index, archive etc page
------------------------------------------------------------ */
if ( !function_exists('tx_sidebar_class_body_archive')) :

    add_filter('body_class', 'tx_sidebar_class_body_archive');
    function tx_sidebar_class_body_archive($classes = '') {
        global $tx;
        if($tx['sidebar-select'] == 'sidebar-right') {
        $classes[] = 'sidebar-right';
        }

        elseif ($tx['sidebar-select'] == 'sidebar-left') {
            $classes[] = 'sidebar-left';
        }else{
            $classes[] = 'no-sidebar';
        }
    return $classes;

    }
endif;

/* ---------------------------------------------------------
    Add sideber class to body for single post
------------------------------------------------------------ */
if ( !function_exists('tx_sidebar_classes_body_single')) :

    add_filter('body_class', 'tx_sidebar_classes_body_single');
    function tx_sidebar_classes_body_single($classes = '') {
        global $tx;
        if($tx['sidebar-single'] == 'sidebar-right') {
        $classes[] = 'sidebar-right';
        }

        elseif ($tx['sidebar-single'] == 'sidebar-left') {
            $classes[] = 'sidebar-left';
        }else{
            $classes[] = 'no-sidebar';
        }
    return $classes;

    }
endif;

/* ---------------------------------------------------------
    Remove Category: and Tag: word from archive title
------------------------------------------------------------ */
if(!function_exists('tx_remove_cat_tag_word')) :
function tx_remove_cat_tag_word( $title ) {
    if ( is_category() || is_tag() ) {
        $title = single_cat_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'tx_remove_cat_tag_word' );
endif;

/* ---------------------------------------------------------
    Tag limit
------------------------------------------------------------ */

//Register tag cloud filter callback
add_filter('widget_tag_cloud_args', 'tx_tag_widget_limit');
//Limit number of tags inside widget
function tx_tag_widget_limit($args) {
    global $tx;
//Check if taxonomy option inside widget is set to tags
if(isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag'){
$args['number'] = $tx['tag_limit']; //Limit number of tags
}
return $args;
}

// Set locale for change the comma to decimal avoid brakes Elementor generated CSS style.
setlocale(LC_NUMERIC, 'en_US.UTF-8');

// Notice: WP_Scripts::localize was called incorrectly.
add_filter('doing_it_wrong_trigger_error', function () {return false;}, 10, 0);

/* ---------------------------------------------------------
    EOF
------------------------------------------------------------ */