<?php
/**
* 
* @package tx
* @author theme_x
* 
/* ---------------------------------------------------------
   Enqueue Styles and Scripts
------------------------------------------------------------ */ 

if(!function_exists('tx_enqueue')):
  add_action('wp_enqueue_scripts', 'tx_enqueue');
  function tx_enqueue() {
    
  // CSS
  wp_enqueue_style( 'bootstrap', TX_CSS . 'bootstrap.min.css' ); 
  wp_enqueue_style( 'tx-main', TX_CSS . 'main.min.css' );
  wp_enqueue_style( 'font-awesome-4', TX_CSS . 'font-awesome.min.css' ); // v4.7.0
  wp_enqueue_style( 'line-awesome', TX_CSS . 'line-awesome.min.css' );
  wp_enqueue_style( 'owl-carousel', TX_CSS . 'owl.carousel.min.css' );
  wp_enqueue_style( 'lightslider', TX_CSS . 'lightslider.min.css' );

  // rtl support
  if(is_rtl()):
    wp_enqueue_style( 'tx-rtl', TX_CSS . 'rtl.min.css');
  endif;

  // JS
  wp_enqueue_script( 'tx-main-scripts', TX_JS . 'main.min.js', array('jquery'), false, true );
  wp_enqueue_script( 'bootstrap', TX_JS . 'bootstrap.min.js', array('jquery'), false, true );
  wp_enqueue_script( 'owl-carousel', TX_JS . 'owl.carousel.min.js', array('jquery'), false, true );
  wp_enqueue_script( 'lightslider', TX_JS . 'lightslider.min.js', array('jquery'), false, true );
  
  // Load WP Comment Reply JS
  if( is_singular() && comments_open() ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
endif;

/* ---------------------------------------------------------
   Enqueue Styles for Admin
------------------------------------------------------------ */
if( !function_exists('tx_admin_enqueue') ):
  add_action('admin_enqueue_scripts', 'tx_admin_enqueue');
  function tx_admin_enqueue() {

    wp_enqueue_style( 'tx-admin-style', TX_CSS . 'admin.min.css' );
    wp_enqueue_style( 'font-awesome-admin', TX_CSS . 'font-awesome.min.css' ); // v4.7.0
   // wp_enqueue_style( 'wp-jquery-ui-dialog' );

    wp_enqueue_script( 'tx-admin-script', TX_JS . 'admin.min.js', array('jquery'), false, true );
   // wp_enqueue_script( 'jquery-ui-dialog', array('jquery') );
  }
endif;

/* ---------------------------------------------------------
    EOF
------------------------------------------------------------ */