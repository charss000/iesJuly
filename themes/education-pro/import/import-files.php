<?php
/**
* 
* @package tx
* @author theme_x
* 
* ======================================================================
*   Import content, widgets, theme options settings.
* ======================================================================
*/

// Demo Import files
function tx_import_files() {
  return [
    
    [
      'import_file_name'           => 'Demo One',
      'categories'                 => [ 'Courses', 'WooCommerce' ],
      'import_file_url'            => TX_IMPORT_URL.'one/content.xml',
      'import_widget_file_url'     => TX_IMPORT_URL.'one/widgets.json',
      'import_redux'               => [
        [
          'file_url'    => TX_IMPORT_URL.'one/redux_options.json',
          'option_name' => 'tx',
        ],
      ],
      'import_preview_image_url'   => TX_IMPORT_URL.'one/screenshot.jpg',
      'preview_url'                => TX_DEMO_URL.'one',
      'import_notice' => esc_html__( 'If the Slider Revolution or any of the plugins failed to activate or stuck on this page for a long time or get Internal Server Error (500) then please refresh the page and click the "Continue & Import" button again.', 'education-pro' ),    
    ], // one

    [
      'import_file_name'           => 'Demo RTL',
      'categories'                 => [ 'Courses', 'RTL', 'Arabic','WooCommerce' ],
      'import_file_url'            => TX_IMPORT_URL.'rtl/content.xml',
      'import_widget_file_url'     => TX_IMPORT_URL.'rtl/widgets.json',
      'import_redux'               => [
        [
          'file_url'    => TX_IMPORT_URL.'rtl/redux_options.json',
          'option_name' => 'tx',
        ],
      ],
      'import_preview_image_url'   => TX_IMPORT_URL.'rtl/screenshot.jpg',
      'preview_url'                => TX_DEMO_URL.'rtl',
      'import_notice' => esc_html__( 'If the Slider Revolution or any of the plugins failed to activate or stuck on this page for a long time or get Internal Server Error (500) then please refresh the page and click the "Continue & Import" button again.', 'education-pro' ),    
    ], // rtl

    [
      'import_file_name'           => 'Demo Two',
      'categories'                 => [ 'Courses' ],
      'import_file_url'            => TX_IMPORT_URL.'two/content.xml',
      'import_widget_file_url'     => TX_IMPORT_URL.'two/widgets.json',
      'import_redux'               => [
        [
          'file_url'    => TX_IMPORT_URL.'two/redux_options.json',
          'option_name' => 'tx',
        ],
      ],
      'import_preview_image_url'   => TX_IMPORT_URL.'two/screenshot.jpg',
      'preview_url'                => TX_DEMO_URL.'two',
      'import_notice' => esc_html__( 'If the Slider Revolution or any of the plugins failed to activate or stuck on this page for a long time or get Internal Server Error (500) then please refresh the page and click the "Continue & Import" button again.', 'education-pro' ),    
    ], // two

    [
      'import_file_name'           => 'Kindergarten',
      'categories'                 => [ 'School', 'Kindergarten' ],
      'import_file_url'            => TX_IMPORT_URL.'kindergarten/content.xml',
      'import_widget_file_url'     => TX_IMPORT_URL.'kindergarten/widgets.json',
      'import_redux'               => [
        [
          'file_url'    => TX_IMPORT_URL.'kindergarten/redux_options.json',
          'option_name' => 'tx',
        ],
      ],
      'import_preview_image_url'   => TX_IMPORT_URL.'kindergarten/screenshot.jpg',
      'preview_url'                => TX_DEMO_URL.'kindergarten',
      'import_notice' => esc_html__( 'If the Slider Revolution or any of the plugins failed to activate or stuck on this page for a long time or get Internal Server Error (500) then please refresh the page and click the "Continue & Import" button again.', 'education-pro' ),    
    ], // kindergarten

    [
      'import_file_name'           => 'Driving School',
      'categories'                 => [ 'School', 'Driving' ],
      'import_file_url'            => TX_IMPORT_URL.'driving-school/content.xml',
      'import_widget_file_url'     => TX_IMPORT_URL.'driving-school/widgets.json',
      'import_redux'               => [
        [
          'file_url'    => TX_IMPORT_URL.'driving-school/redux_options.json',
          'option_name' => 'tx',
        ],
      ],
      'import_preview_image_url'   => TX_IMPORT_URL.'driving-school/screenshot.jpg',
      'preview_url'                => TX_DEMO_URL.'driving-school',
      'import_notice' => esc_html__( 'If the Slider Revolution or any of the plugins failed to activate or stuck on this page for a long time or get Internal Server Error (500) then please refresh the page and click the "Continue & Import" button again.', 'education-pro' ),    
    ], // kindergarten

    


  ];
}

add_filter( 'ocdi/import_files', 'tx_import_files' );

/* ---------------------------------------------------------
    EOF
------------------------------------------------------------ */