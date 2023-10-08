<?php
/**
* 
* @package tx
* @author theme_x
* 
*/

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'tx_register_required_plugins' );

function tx_register_required_plugins() {
    
    $plugins = array(
        
        // Education Pro Core
        array(
            'name'               => esc_html__( 'Education Pro Core', 'education-pro' ), // The plugin name.
            'slug'               => 'education-pro-core', // The plugin slug (typically the folder name).
            'source'             => TX_THEME_DIR . 'inc/plugins/education-pro-core.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
        array(
            'name'               => esc_html__( 'One Click Demo Import', 'avas' ), // The plugin name.
            'slug'               => 'one-click-demo-import', // The plugin slug (typically the folder name).
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),

    );

    $config = array(
        'id'           => 'ep',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'ep-install-plugins', // Menu slug.
        'has_notices'  => false,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '', // Message to output right before the plugins table.
    );
    tgmpa( $plugins, $config );
}

/* ---------------------------------------------------------
   EOF
------------------------------------------------------------ */ 