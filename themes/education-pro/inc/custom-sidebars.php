<?php
/**
* 
* @package tx
* @author theme_x
* 
*
*
*/

/* ---------------------------------------------------------
  Sidebars setup
------------------------------------------------------------ */
if( !function_exists('tx_widget_setup') ) :


      add_action('widgets_init','tx_widget_setup'); 
      function tx_widget_setup() {

      // Right Sidebar 
      register_sidebar(array(
            'name'          => esc_html__( 'Post Sidebar', 'education-pro' ),
            'id'            => 'sidebar-post',
            'description'   => esc_html__('Display in blog, post archive.', 'education-pro'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );

      // Sidebar Single 
      register_sidebar(array(
            'name'          => esc_html__( 'Post Single Sidebar', 'education-pro' ),
            'id'            => 'sidebar-single',
            'description'   => esc_html__('Display in single post', 'education-pro'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );

      // Sidebar Page Right
      register_sidebar(array(
            'name'          => esc_html__( 'Page Sidebar Right', 'education-pro' ),
            'id'            => 'sidebar-page',
            'description'   => esc_html__('Will show in page right side', 'education-pro'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );

      // Sidebar Page Left
      register_sidebar(array(
            'name'          => esc_html__( 'Page Sidebar Left', 'education-pro' ),
            'id'            => 'sidebar-page-left',
            'description'   => esc_html__('Will show in page left side', 'education-pro'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );

      // Sidebar Classes
      global $tx;
      if(isset($tx['classes_post_type']) && $tx['classes_post_type'] == 1) :
      register_sidebar(array(
            'name'          => sprintf(esc_html__('%1$s Single Post Sidebar', 'education-pro'),$tx['classes_title'] ),
            'id'            => 'sidebar-classes',
            'description'   => sprintf(esc_html__('Will display in %1$s single page.', 'education-pro'),$tx['classes_title']),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );
      endif;

      // Sidebar Teachers
      global $tx;
      if(isset($tx['teachers_post_type']) && $tx['teachers_post_type'] == 1) :
      register_sidebar(array(
            'name'          => sprintf(esc_html__( '%1$s Single Post Sidebar', 'education-pro' ),$tx['teachers_title']),
            'id'            => 'sidebar-teachers',
            'description'   => sprintf(esc_html__('Will display in %1$s single page.', 'education-pro'),$tx['teachers_title']),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );
      endif;

      // WooCommerce Sidebar
      if(class_exists('WooCommerce')) :
      register_sidebar(array(
            'name'          => esc_html__( 'WooCommerce Shop Sidebar', 'education-pro' ),
            'id'            => 'sidebar-woo',
            'description'   => esc_html__('Will display in WooCommerce Shop page', 'education-pro'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );

      // WooCommerce Single Sidebar
      register_sidebar(array(
            'name'          => esc_html__( 'WooCommerce Single Post Sidebar', 'education-pro' ),
            'id'            => 'sidebar-woo-single',
            'description'   => esc_html__('Will display in WooCommerce Single product page', 'education-pro'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );
      endif;

      // Side Menu
      global $tx;
      if(isset($tx['side_menu']) && $tx['side_menu'] == 1) :
      register_sidebar(array(
            'name'          => esc_html__( 'Hamburger / Side Menu ', 'education-pro' ),
            'id'            => 'side-menu-widget',
            'description'   => esc_html__('Side menu widget', 'education-pro'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',

      ) );
      endif;

      // Mega Menu
      for($x = 1; $x < 5; $x++) {
      register_sidebar(array(
            'id'            => 'mega-menu-'.$x,
            'name'          => esc_html__('Mega Menu | '.$x, 'education-pro'),
            'description'   => esc_html__('Widgets for Mega Menu', 'education-pro'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            ));
      }

      // Footer
      for($x = 1; $x < 7; $x++) {
      register_sidebar(array(
            'id'            => 'footer-'.$x,
            'name'          => esc_html__('Footer | '.$x, 'education-pro'),
            'description'   => esc_html__('Widgets for Footer', 'education-pro'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
            ));
      }

      
}    

endif;

/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */ 