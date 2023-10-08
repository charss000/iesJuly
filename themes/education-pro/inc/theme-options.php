<?php
    /**
     * @package tx
     * @author theme_x
     * 
     *
     * ReduxFramework Theme Options Panel
     * 
     */
    if ( ! class_exists( 'Redux' ) ) {
        return;
    }
    // This is your option name where all the Redux data is stored.
    $opt_name = "tx";
    $theme = wp_get_theme(); // For use with some settings. Not necessary.
    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => false,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'education-pro' ),
        'page_title'           => esc_html__( 'Theme Options', 'education-pro' ),
        // Enabled the Webfonts typography module to use asynchronous fonts.
        'async_typography'          => false,
        // Disable to create your own google fonts loader.
        'disable_google_fonts_link' => false,
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-menu',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 40,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'customizer'           => true,
        // Enable basic customizer support
        'open_expanded'     => false,                    // Allow you to start the panel in an expanded way initially.
        'disable_save_warn' => false,                    // Disable the save warning when a user changes a field
        // OPTIONAL -> Give you extra features
        'page_priority'        => 61,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            =>  TX_IMAGES.'icon.png',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.
        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        // Set the theme of the option panel.  Use 'classic' to rever to the Redux 3 style.
        'admin_theme'               => 'wp',
        'database'             => '',
        'network_admin'             => true,
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => false,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    Redux::setArgs( $opt_name, $args );
    /*
     * ---> END ARGUMENTS
     */
    /*
     *
     * ---> START SECTIONS
     *
     */
    /*
        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for
     */
    // Global Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Global', 'education-pro' ),
        'id'               => 'global',
        'customizer_width' => '400px',
        'icon'             => 'el el-home'
    ) );
    // General Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'education-pro' ),
        'id'               => 'general',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'title'    => esc_html__('Favicon', 'education-pro'),
                'id'       => 'favicon',
                'type'     => 'media',
                'complier' => true,
                'url'      => true,
                'desc'     => esc_html__( 'You can upload .png, .jpg, .gif and .ico image format for favicon.', 'education-pro' ),
                'default'  => array(
                    'url'      => TX_IMAGES.'icon.png'
                )
            ),
            array(
                'id'        => 'mob_version',
                'type'      => 'switch',
                'title'     => esc_html__('Mobile Version', 'education-pro'),
                'desc'     => esc_html__('If you would like to display desktop version in mobile device you can disable mobile version.', 'education-pro'),
                'default'   => 1,
                'on'        => esc_html__('Enable', 'education-pro'),
                'off'       => esc_html__('Disable', 'education-pro')
            ),
            array(
                'id'        => 'preloader',
                'type'      => 'switch',
                'title'     => esc_html__('Preloader', 'education-pro'),
                'default'   => 0,
                'on'        => esc_html__('Enable', 'education-pro'),
                'off'       => esc_html__('Disable', 'education-pro')
            ),
            array(
                'id'       => 'preloader-bg-color',
                'type'     => 'color',
                'output'   => array('background-color' => '.pre-loader'),
                'title'    => esc_html__( 'Prealoader Background Color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
                'required'  => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'       => 'preloader-color',
                'type'     => 'color',
                'output'   => array('background-color' => '.sk-fading-circle .sk-circle:before'),
                'title'    => esc_html__( 'Prealoader animation Color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
                'required'  => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'       => 'selection-bg-color',
                'type'     => 'color',
                'output'   => array('background-color' => '::selection'),
                'title'    => esc_html__( 'Selection Background Color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'selection-text-color',
                'type'     => 'color',
                'output'   => array('color' => '::selection'),
                'title'    => esc_html__( 'Selection Text Color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'page-layout',
                'type'     => 'image_select',
                'title' => esc_html__('Layout', 'education-pro'),
                'options'  => array(
                    'full-width' => array('title' => 'Width', 'img' => TX_IMAGES .'body-full.png'),
                    'boxed'      => array('title' => 'Boxed', 'img' => TX_IMAGES .'body-boxed.png'),
                ),
                'default'  => 'full-width',
            ),
            array(
                'id'    => 'body-background',
                'title' => esc_html__( 'Body Background', 'education-pro' ),
                'type'  => 'background',
                'output'   => array('background' => 'body'),
                'transparent' => false,
                'default'  => array(
                    'background-color' => '',
                ),
            ),
            array(
                'id'    => 'wrap-background',
                'title' => esc_html__( 'Wrapper Background', 'education-pro' ),
                'type'  => 'background',
                'output'   => array('background' => '.tx-wrapper'),
                'transparent' => false,
                'default'  => array(
                    'background-color' => '',
                ),
                'required'  => array( 'page-layout', '=', 'boxed' ),
            ),
            array(
                'id'    => 'wrap-margin',
                'type'  => 'spacing',
                'output'         => array('.tx-wrapper'),
                'mode'           => 'margin',
                'units'          => array('px', 'em'),
                'units_extended' => 'false',
                'title'          => esc_html__('Wrapper Margin', 'education-pro'),
                'desc'          => esc_html__('Plase enter Top and Bottom value only. Left and Right value default "auto". Do not enter Left or Right value otherwise it will break layout. ', 'education-pro'),
                'default'            => array(
                    'margin-top'     => '0', 
                    'margin-right'   => '', 
                    'margin-bottom'  => '0', 
                    'margin-left'    => '',
                    'units'          => 'px', 
                ),
                'required'  => array( 'page-layout', '=', 'boxed' ),
                ),
            array(
                'id'             => 'wrap-padding',
                'type'           => 'spacing',
                'output'         => array('.tx-wrapper'),
                'mode'           => 'padding',
                'units'          => array('px', 'em'),
                'units_extended' => 'false',
                'title'          => esc_html__('Wrapper Padding', 'education-pro'),
                'default'            => array(
                    'padding-top'     => '', 
                    'padding-right'   => '', 
                    'padding-bottom'  => '', 
                    'padding-left'    => '',
                    'units'          => 'px', 
                ),
                'required'  => array( 'page-layout', '=', 'boxed' ),
            ),
            array(
                    'id'       => 'wrap-border-top',
                    'type'     => 'border',
                    'title'    => esc_html__('Wrapper Border', 'education-pro'),
                    'desc'     => esc_html__( 'Enter border width ex: 1, 2, 3 etc to enable border. 0 to disable.', 'education-pro' ),
                    'output'   => array('.tx-wrapper'),
                    'color'    => true,
                    'all'      => false,
                    'default'  => array(
                        'border-color'  => '', 
                        'border-style'  => 'solid', 
                        'border-top'    => '0',
                        'border-right'    => '0',
                        'border-bottom'    => '0',
                        'border-left'    => '0',
                        ),
                    'required'  => array( 'page-layout', '=', 'boxed' ),
                ),
            // General Color Options
            array(
                    'id'        => 'general-colors',
                    'type'      => 'info',
                    'title'     => esc_html__('Colors Options', 'education-pro'),
                    'style'     => 'success',
                ),
            array(
                'id'       => 'body',
                'type'     => 'color',
                'output'   => array('body'),
                'title'    => esc_html__( 'Body text color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'link-color',
                'type'     => 'color',
                'output'   => array('a'),
                'title'    => esc_html__( 'Link color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'link-hover-color',
                'type'     => 'color',
                'output'   => array('a:hover, a:focus'),
                'title'    => esc_html__( 'Link hover color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'h1-color',
                'type'     => 'color',
                'output'   => array('h1'),
                'title'    => esc_html__( 'H1 color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'h2-color',
                'type'     => 'color',
                'output'   => array('h2'),
                'title'    => esc_html__( 'H2 color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'h3-color',
                'type'     => 'color',
                'output'   => array('h3'),
                'title'    => esc_html__( 'H3 color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'h4-color',
                'type'     => 'color',
                'output'   => array('h4'),
                'title'    => esc_html__( 'H4 color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'h5-color',
                'type'     => 'color',
                'output'   => array('h5'),
                'title'    => esc_html__( 'H5 color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'h6-color',
                'type'     => 'color',
                'output'   => array('h6'),
                'title'    => esc_html__( 'H6 color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            // General Fonts Options
            array(
                    'id'        => 'general-fonts',
                    'type'      => 'info',
                    'title'     => esc_html__('Fonts Options', 'education-pro'),
                    'style'     => 'success',
                ),
            array(
                'id'       => 'typography-body',
                'type'     => 'typography',
                'title'    => esc_html__( 'Body', 'education-pro' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('body'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => false,
                'color'         => false,
                'text-align'    => false,
                'text-transform'=> true,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'typography-h1',
                'type'     => 'typography',
                'title'    => esc_html__( 'H1', 'education-pro' ),
                'subtitle' => esc_html__( 'Specify the H1 font properties.', 'education-pro' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('h1'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'text-align'    => false,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'typography-h2',
                'type'     => 'typography',
                'title'    => esc_html__( 'H2', 'education-pro' ),
                'subtitle' => esc_html__( 'Specify the H2 font properties.', 'education-pro' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('h2'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'text-align'    => false,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'typography-h3',
                'type'     => 'typography',
                'title'    => esc_html__( 'H3', 'education-pro' ),
                'subtitle' => esc_html__( 'Specify the H3 font properties.', 'education-pro' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('h3'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'text-align'    => false,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'typography-h4',
                'type'     => 'typography',
                'title'    => esc_html__( 'H4', 'education-pro' ),
                'subtitle' => esc_html__( 'Specify the H4 font properties.', 'education-pro' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('h4'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'text-align'    => false,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'typography-h5',
                'type'     => 'typography',
                'title'    => esc_html__( 'H5', 'education-pro' ),
                'subtitle' => esc_html__( 'Specify the H5 font properties.', 'education-pro' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('h5'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'text-align'    => false,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'typography-h6',
                'type'     => 'typography',
                'title'    => esc_html__( 'H6', 'education-pro' ),
                'subtitle' => esc_html__( 'Specify the H6 font properties.', 'education-pro' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('h6'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'color'         => false,
                'text-align'    => false,
                'text-transform'=> true,
                'subsets'       => true, 
            ),

        )
    ) );

    // Logo Options
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Logo', 'education-pro' ),
        'id'         => 'logo',
        'subsection' => true,
        'fields'     => array(
            array(
                'title'    => esc_html__('Logo', 'education-pro'),
                'id'       => 'tx_logo',
                'type'     => 'media',
                'complier' => true,
                'url'      => true,
                'desc'     => esc_html__( 'You can upload .png, .jpg, .gif image format.', 'education-pro' ),
                'default'  => array(
                    'url'=> TX_IMAGES . 'logo.png'
                )
            ),
            array(
                'id'            => 'logo-resize',
                'type'          => 'slider',
                'title'         => esc_html__( 'Logo Resize', 'education-pro' ),
                'min'           => 0,
                'step'          => 1,
                'max'           => 100,
                'display_value' => 'text'
            ),
            array(
                'id'             => 'logo_space',
                'type'           => 'spacing',
                'output'         => array('.tx_logo'),
                'mode'           => 'padding',
                'units'          => array('px', 'em'),
                'units_extended' => 'false',
                'title'          => esc_html__('Logo Padding', 'education-pro'),
            ),
            
        )
    ) );

    // Header Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header', 'education-pro' ),
        'id'               => 'header',
        'customizer_width' => '400px',
        'icon'             => 'el el-website',
        'fields'           =>  array(
            array(
                'id'       => 'header-layout',
                'type'     => 'image_select',
                'title' => esc_html__('Layout', 'education-pro'),
                'options'  => array(
                    'boxed'      => array('title' => 'Boxed', 'img' => TX_IMAGES .'header-boxed.png'),
                    'width' => array('title' => 'Width', 'img' => TX_IMAGES .'header-width.png'),
                    ),
                'default'  => 'boxed',
                'required'  => array('page-layout', '=', 'full-width')
            ),
            array(
                'id'        => 'header_overlay',
                'type'      => 'switch',
                'title'     => esc_html__('Header Overlay', 'education-pro'),
                'desc'     => esc_html__('For Transparent Header for Home page.', 'education-pro'),
                'default'   => 0,
                'on'        => esc_html__('Yes','education-pro'),
                'off'       => esc_html__('No','education-pro'),
            ),
            array(
                'id'        => 'sticky_header',
                'type'      => 'switch',
                'title'     => esc_html__('Sticky Header', 'education-pro'),
                'default'   => 0,
                'on'        => 'On',
                'off'       => 'Off',
            ),

            array(
                'id'        => 'sticky_main_header',
                'type'      => 'switch',
                'title'     => esc_html__('Sticky Main Header', 'education-pro'),
                'default'   => 0,
                'on'        => 'On',
                'off'       => 'Off',
                'required'  => array(
                                array( 'sticky_header', '=', '1' ),
                                array( 'header-select', '!=', 'header3' ),
                                array( 'header-select', '!=', 'header5' ),
                                array( 'header-select', '!=', 'header9' ),
                            ),
            ),
            array(
                'id'            => 'sticky-scroll',
                'type'          => 'slider',
                'title'         => esc_html__( 'Sticky Header Start From', 'education-pro' ),
                'default'       => 300,
                'min'           => 0,
                'step'          => 1,
                'max'           => 1000,
                'display_value' => 'text',
                'required'  => array('sticky_header', '=', '1' ),
            ),
        )
    ));   
    // Main Header options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Main Header', 'education-pro' ),
        'id'               => 'main-header',
        'subsection'       => true,
        'customizer_width' => '400px',
        'fields'           =>  array(
                array(
                    'id'        => 'header_on_off',
                    'type'      => 'switch',
                    'default'   => 1,
                    'on'        => 'Enable',
                    'off'       => 'Disable',
                ),
                array(
                    'id'             => 'main_header_margin_home',
                    'type'           => 'spacing',
                    'output'         => array('.home .main-header'),
                    'mode'           => 'margin',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Margin for Home page only.', 'education-pro'),
                    'required'  => array( 'header_on_off', '=', '1' )
                ), 
                array(
                    'id'             => 'main_header_padding',
                    'type'           => 'spacing',
                    'output'         => array('.main-header .container,.main-header .container-fluid'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Padding', 'education-pro'),
                    'required'  => array( 'header_on_off', '=', '1' )
                ),
                array(
                    'id'       => 'header-select',
                    'type'     => 'select',
                    'title' => esc_html__('Select Header Style', 'education-pro'),
                    'options'  => array(
                        'header1'  => esc_html__('Style 1','education-pro'),
                        'header2'  => esc_html__('Style 2','education-pro'),
                        'header3'  => esc_html__('Style 3','education-pro'),
                        'header4'  => esc_html__('Style 4','education-pro'),
                        'header5'  => esc_html__('Style 5','education-pro'),
                        'header6'  => esc_html__('Style 6','education-pro'),
                        'header7'  => esc_html__('Style 7','education-pro'),
                        'header8'  => esc_html__('Style 8','education-pro'),
                        'header9'  => esc_html__('Style 9','education-pro'),
                    ),
                    'default'  => 'header3',
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'header-style1',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 1', 'education-pro'),
                    'required'  => array( 'header-select', '=', 'header1' ),
                    'options'  => array(
                    'header-style1'  => array(
                      'alt' => 'Header Style 1',
                      'img' => TX_IMAGES .'h1.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style2',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 2', 'education-pro'),
                    'required'  => array( 'header-select', '=', 'header2' ),
                    'options'  => array(
                    'header-style2'  => array(
                      'alt' => 'Header Style 2',
                      'img' => TX_IMAGES .'h2.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style3',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 3', 'education-pro'),
                    'required'  => array( 'header-select', '=', 'header3' ),
                    'options'  => array(
                    'header-style13'  => array(
                      'alt' => 'Header Style 3',
                      'img' => TX_IMAGES .'h3.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style4',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 4', 'education-pro'),
                    'required'  => array( 'header-select', '=', 'header4' ),
                    'options'  => array(
                    'header-style4'  => array(
                      'alt' => 'Header Style 4',
                      'img' => TX_IMAGES .'h4.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style5',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 5', 'education-pro'),
                    'required'  => array( 'header-select', '=', 'header5' ),
                    'options'  => array(
                    'header-style5'  => array(
                      'alt' => 'Header Style 5',
                      'img' => TX_IMAGES .'h5.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style6',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 6', 'education-pro'),
                    'required'  => array( 'header-select', '=', 'header6' ),
                    'options'  => array(
                    'header-style6'  => array(
                      'alt' => 'Header Style 6',
                      'img' => TX_IMAGES .'h6.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style7',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 7', 'education-pro'),
                    'required'  => array( 'header-select', '=', 'header7' ),
                    'options'  => array(
                    'header-style7'  => array(
                      'alt' => 'Header Style 7',
                      'img' => TX_IMAGES .'h7.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style8',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 8', 'education-pro'),
                    'required'  => array( 'header-select', '=', 'header8' ),
                    'options'  => array(
                    'header-style8'  => array(
                      'alt' => 'Header Style 8',
                      'img' => TX_IMAGES .'h8.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'header-style9',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 9', 'education-pro'),
                    'required'  => array( 'header-select', '=', 'header9' ),
                    'options'  => array(
                    'header-style9'  => array(
                      'alt' => 'Header Style 9',
                      'img' => TX_IMAGES .'h9.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'banner-bussiness-switch',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Select', 'education-pro'),
                    'options' => array(
                        '1' => esc_html__('Banner', 'education-pro'),
                        '2' => esc_html__('Business Info', 'education-pro'),
                     ), 
                    'default' => '1',
                    'required'  => array( 'header-select', '=', array('header1','header5','header6','header7','header8') ),
                                
                ), 
                array(
                    'id'        => 'h_ads_switch',
                    'type'      => 'button_set',
                    'title'     => esc_html__('Change Ad Mode', 'education-pro'),
                    'options' => array(
                        '1' => esc_html__('Banner', 'education-pro'),
                        '2' => esc_html__('Adsense', 'education-pro'),
                     ), 
                    'default' => '1',
                    'required'  => array( 'banner-bussiness-switch', '=', '1' ),
                ),
                
                array(
                    'title'    => esc_html__('Ad Banner', 'education-pro'),
                    'id'       => 'head_ad_banner',
                    'subtitle' => esc_html__('Size 728x90','education-pro'),
                    'type'     => 'media',
                    'complier' => true,
                    'url'      => true,
                    'desc'     => esc_html__( 'You can upload png, jpg, gif image.', 'education-pro' ),
                    'default'  => array(
                      'url'=> TX_IMAGES . '728x90.jpg'
                    ),
                    'required'  => array(
                                   array( 'h_ads_switch', '=', '1' ),
                                   array( 'banner-bussiness-switch', '=', '1' ),
                                ),
                ),
                array(
                    'id'       => 'head_ad_banner_link',
                    'type'     => 'text',
                    'title'    => esc_html__('Banner link', 'education-pro'),
                    'required'  => array(
                                   array( 'h_ads_switch', '=', '1' ),
                                   array( 'banner-bussiness-switch', '=', '1' ),
                                ),
                ),
                array(
                    'id'       => 'head_ad_banner_link_new_window',
                    'type'     => 'checkbox',
                    'title'    => esc_html__('Open link in new window', 'education-pro'), 
                    'default'  => '0',
                    'required'  => array( 'h_ads_switch', '=', '1' ),
                ),
                array(
                    'id'       => 'head_ad_js',
                    'title'    => esc_html__( 'Adsense codes here.', 'education-pro' ),
                    'subtitle' => esc_html__('Size 728x90','education-pro'),
                    'type'     => 'ace_editor',
                    'mode'     => 'text',
                    'theme'    => 'chrome',
                    'desc'      => esc_html__('Example: Google Adsense etc', 'education-pro'),
                    'required'  => array(
                                   array( 'h_ads_switch', '=', '2' ),
                                   array( 'banner-bussiness-switch', '=', '1' ),
                                ),
                ),
                array(
                    'id'             => 'head_ads_space',
                    'type'           => 'spacing',
                    'output'         => array('.head_ads'),
                    'mode'           => 'margin',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Ad Space', 'education-pro'),
                    'desc'          => esc_html__('Default 10 0 10 0', 'education-pro'),
                    'required'  => array('banner-bussiness-switch', '=', '1' ),
                ),
                // business information from here
                array(
                    'id'          => 'bs-info',
                    'type'        => 'slides',
                    'title'       => esc_html__('Business information', 'education-pro'),
                    'subtitle'        => esc_html__('Maximum 3 items allowed. More than 3 items will break the layout.', 'education-pro'),
                    'required'    => array( 'banner-bussiness-switch', '=', '2' ),
                    'desc'        => esc_html__('Drag and drop sortings.', 'education-pro'),
                    'placeholder' => array(
                        'title'           => esc_html__('Title', 'education-pro'),
                        'description'     => esc_html__('Description', 'education-pro'),
                        'url'             => esc_html__('HTML tag allowed in above two fields.', 'education-pro'),
                    ),
                ),
                array(
                    'id'             => 'head_binfo_space',
                    'type'           => 'spacing',
                    'output'         => array('.bs-info-area'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Business Info Space', 'education-pro'),
                    'desc'          => esc_html__('Default 30 0 30 0', 'education-pro'),
                    'required'  => array('banner-bussiness-switch', '=', '2' ),
                ),
                array(
                    'id'       => 'bs-info-title-color',
                    'type'     => 'color',
                    'output'   => array('.info-box .c-box .title'),
                    'title'    => esc_html__( 'Business Info Title Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'    => array( 'banner-bussiness-switch', '=', '2' ),
                ),
                array(
                    'id'       => 'bs-info-desc-color',
                    'type'     => 'color',
                    'output'   => array('.info-box .c-box .desc'),
                    'title'    => esc_html__( 'Business Info Details Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'    => array( 'banner-bussiness-switch', '=', '2' ),
                ),
                array(
                    'id'       => 'bs-info-sep-color',
                    'type'     => 'color',
                    'output'   => array('border-color' => '.bs-info-content'),
                    'title'    => esc_html__( 'Business Info Separator Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'    => array( 'banner-bussiness-switch', '=', '2' ),
                ),
                array(
                    'id'       => 'typography-bs-info-title',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Business Info Title Font', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.info-box .c-box .title'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform' => true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required'    => array( 'banner-bussiness-switch', '=', '2' ),
                ),
                array(
                    'id'       => 'typography-bs-info-desc',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Business Info Details Font', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.info-box .c-box .desc'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform' => true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required'    => array( 'banner-bussiness-switch', '=', '2' ),
                ),
                
                // Main header color options
                array(
                    'id'        => 'main-header-colors',
                    'type'      => 'info',
                    'title'     => esc_html__('Colors Options', 'education-pro'),
                    'style'     => 'success',
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                // background from here               
                array(
                    'title' => esc_html__( 'Main Header Background Image', 'education-pro' ),
                    'id'    => 'header-bg',
                    'type'  => 'background',
                    'output'   => array('background'=>'#h-style-1,#h-style-2,#h-style-3,#h-style-4,#h-style-5,#h-style-6,#h-style-7,#h-style-8,#h-style-9'),
                    'background-color' => false,
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'main_head_bg_color_home',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '.home #h-style-1, .home #h-style-2, .home #h-style-3, .home #h-style-4, .home #h-style-5, .home #h-style-6, .home #h-style-7, .home #h-style-8, .home #h-style-9' ),
                    'title'    => esc_html__( 'Main header background color for Home Page only', 'education-pro' ),
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'sticky_head_bg_color_home',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '.home .sticky-header #h-style-1,.home .sticky-header #h-style-2,.home .sticky-header #h-style-3,.home .sticky-header #h-style-4,.home .sticky-header #h-style-5,.home .sticky-header #h-style-6,.home .sticky-header #h-style-7,.home .sticky-header #h-style-8,.home .sticky-header #h-style-9' ),
                    'title'    => esc_html__( 'Sticky header background color for Home Page only', 'education-pro' ),
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'main_head_cont_bg_color_home',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '.home .main-header .container' ),
                    'title'    => esc_html__( 'Main Header Content background color for Home Page only', 'education-pro' ),
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'main_head_bg_color_inner',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '#h-style-1,#h-style-2,#h-style-3,#h-style-4,#h-style-5,#h-style-6,#h-style-7,#h-style-8,#h-style-9' ),
                    'title'    => esc_html__( 'Main header background color for Inner Pages', 'education-pro' ),
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'sticky_head_bg_color_inner',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '.sticky-header #h-style-1,.sticky-header #h-style-2,.sticky-header #h-style-3,.sticky-header #h-style-4,.sticky-header #h-style-5,.sticky-header #h-style-6,.sticky-header #h-style-7,.sticky-header #h-style-8,.sticky-header #h-style-9' ),
                    'title'    => esc_html__( 'Sticky header background color for Inner Pages', 'education-pro' ),
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'main_head_bg_color_container',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '.main-header .container' ),
                    'title'    => esc_html__( 'Main header container background color', 'education-pro' ),
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'main_head_border',
                    'type'     => 'border',
                    'title'    => esc_html__('Bottom Border', 'education-pro'),
                    'desc'     => esc_html__( 'Enter border width, example 1, 2, 3 etc to enable border', 'education-pro' ),
                    'output'   => array('.main-header'),
                    'top' => false,
                    'right' => false,
                    'left' => false,
                    'color' => false,
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
                array(
                    'id'       => 'main_head_border_color',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'border-color' => '.main-header',
                     ),
                    'title'    => esc_html__( 'Border color', 'education-pro' ),
                    'required'  => array( 'header_on_off', '=', '1' ),
                ),
    )      
        ) ); 
    // Top header options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Top Header', 'education-pro'),
        'id'               => 'top-header',
        'subsection'       => true,
        'customizer_width' => '400px',
        'fields'           => array(
                array(
                'id'        => 'top_head',
                'type'      => 'switch',
                'default'   => 1,
                'on'        => esc_html__('Enable', 'education-pro'),
                'off'       => esc_html__('Disable', 'education-pro'),
                ),
                array(
                    'id'             => 'top_head_space',
                    'type'           => 'spacing',
                    'output'         => array('#top_head'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Space', 'education-pro'),
                    'required'  => array( 'top_head', '=', '1' )
                ),
                // welcome message
                array(
                'id'        => 'wm_switch',
                'type'      => 'switch',
                'title'    =>  esc_html__('Welcome Message', 'education-pro'),
                'default'   => 0,
                'on'        => esc_html__('On', 'education-pro'),
                'off'       => esc_html__('Off', 'education-pro'),
                'required'  => array( 'top_head', '=', '1' )
                ),
                array(
                    'id'       => 'welcome_msg',
                    'type'     => 'textarea',
                    'default'  => esc_html__('Welcome to Education Pro WordPress Theme.','education-pro'),
                    'required'  => array( 'wm_switch', '=', '1' )
                ),
                array(
                    'id'       => 'welcome_msg_color',
                    'type'     => 'color',
                    'output'   => array( '.welcome_msg' ),
                    'title'    => esc_html__( 'Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'wm_switch', '=', '1' )
                ),
                array(
                    'id'       => 'typography-welcome-msg',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Welcome Message', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.welcome_msg'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'line-height'   => true,
                    'text-transform'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required'  => array( 'wm_switch', '=', '1' )
                ),
                // date options
                array(
                'id'        => 'tx-date',
                'title'     => esc_html__( 'Date', 'education-pro' ),
                'type'      => 'switch',
                'default'   => 0,
                'on'        => esc_html__('On', 'education-pro'),
                'off'       => esc_html__('Off', 'education-pro'),
                'required'  => array( 'top_head', '=', '1' )
                ),
                // date color
                array(
                    'id'       => 'date-color',
                    'type'     => 'color',
                    'output'   => array( '.tx-date, .tx-date .fa-clock-o' ),
                    'title'    => esc_html__( 'Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'tx-date', '=', '1' )
                ),
                //Phone options
                array(
                    'id'        => 'tx-phone',
                    'title'     => esc_html__( 'Phone', 'education-pro' ),
                    'type'      => 'switch',
                    'default'   => 1,
                    'on'        => esc_html__('On', 'education-pro'),
                    'off'       => esc_html__('Off', 'education-pro'),
                    'required'  => array( 'top_head', '=', '1' )
                ), // phone number
                array( 
                    'title'     => esc_html__( 'Enter Phone Number', 'education-pro' ),
                    'id'        => 'phone-number',
                    'default'   => esc_html__('+1 229-226-7070', 'education-pro'),
                    'type'      => 'text',
                    'required'  => array( 'tx-phone', '=', '1' ),
                ),
                // phone color
                array(
                    'id'       => 'phone-color',
                    'type'     => 'color',
                    'output'   => array( '.phone-number' ),
                    'title'    => esc_html__( 'Phone Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'tx-phone', '=', '1' )
                ),
                // Email options
                array(
                    'id'        => 'tx-email',
                    'title'     => esc_html__( 'Email', 'education-pro' ),
                    'type'      => 'switch',
                    'default'   => 1,
                    'on'        => esc_html__('On', 'education-pro'),
                    'off'       => esc_html__('Off', 'education-pro'),
                    'required'  => array( 'top_head', '=', '1' )
                ), // email address
                array( 
                    'title'     => esc_html__( 'Enter Email Address', 'education-pro' ),
                    'id'        => 'email-address',
                    'default'   => esc_html__('info@website.com', 'education-pro'),
                    'type'      => 'text',
                    'required'  => array( 'tx-email', '=', '1' ),
                ),
                // email color
                array(
                    'id'       => 'email-color',
                    'type'     => 'color',
                    'output'   => array( '.email-address' ),
                    'title'    => esc_html__( 'Email Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'tx-email', '=', '1' )
                ),
                // news ticker options
                array(
                    'id'        => 'news_ticker',
                    'type'      => 'switch',
                    'title'     => esc_html__('News Ticker', 'education-pro'),
                    'default'   => 0,
                    'on'        => 'On',
                    'off'       => 'Off',
                    'required'  => array( 'top_head', '=', '1' )
                ),
                array(
                'id'            => 'newsticker-posts-per-page',
                'type'          => 'slider',
                'title'         => esc_html__( 'Count', 'education-pro' ),
                'default'       => 5,
                'min'           => 1,
                'step'          => 1,
                'max'           => 99,
                'display_value' => 'text',
                'required'  => array('news_ticker', '=', '1' ),
                ),
                array( 
                'title'     => esc_html__( 'News Ticker Text', 'education-pro' ),
                'id'        => 'news_ticker_bar_text',
                'default'   => esc_html__('Trending', 'education-pro'),
                'type'      => 'text',
                'required'  => array('news_ticker', '=', '1' ),
                ),
                // News ticker color / Tending color options
                array(
                    'id'       => 'news-ticker-title-color',
                    'type'     => 'color',
                    'output'   => array( '.news-ticker-title a' ),
                    'title'    => esc_html__( 'Text color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                ),
                array(
                    'id'       => 'news-ticker-title-hover',
                    'type'     => 'color',
                    'output'   => array( '.news-ticker-title a:hover' ),
                    'title'    => esc_html__( 'Text hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                ),
                array(
                    'id'       => 'tx_news_ticker_bar',
                    'type'     => 'color',
                    'output'   => array( 'background-color'=>'.tx_news_ticker_bar' ),
                    'title'    => esc_html__( 'Label background color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                ),
                array(
                    'id'       => 'tx_news_ticker_bar_color',
                    'type'     => 'color',
                    'output'   => array( 'color'=>'.tx_news_ticker_bar' ),
                    'title'    => esc_html__( 'Label text color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                            
                ),
                array(
                    'id'       => 'tx_news_ticker_nav_color',
                    'type'     => 'color',
                    'output'   => array( 'color'=>'.news-ticker-btns a' ),
                    'title'    => esc_html__( 'Nav text color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                            
                ),
                array(
                    'id'       => 'tx_news_ticker_nav_border_color',
                    'type'     => 'color',
                    'output'   => array( 'border-color'=>'.news-ticker-btns a' ),
                    'title'    => esc_html__( 'Nav border color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                            
                ),
                array(
                    'id'       => 'tx_news_ticker_nav_hover_color',
                    'type'     => 'color',
                    'output'   => array( 'color'=>'.news-ticker-btns a:hover' ),
                    'title'    => esc_html__( 'Nav hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                            
                ),
                array(
                    'id'       => 'tx_news_ticker_nav_background_hover_color',
                    'type'     => 'color',
                    'output'   => array( 'background-color'=>'.news-ticker-btns a:hover' ),
                    'title'    => esc_html__( 'Nav background hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                            
                ),
                array(
                    'id'       => 'tx_news_ticker_nav_border_hover_color',
                    'type'     => 'color',
                    'output'   => array( 'border-color'=>'.news-ticker-btns a:hover' ),
                    'title'    => esc_html__( 'Nav border hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array('news_ticker', '=', '1' ),
                            
                ),
                // top menu
                array(
                    'id'        => 'top_menu',
                    'title'     => esc_html__( 'Top Menu', 'education-pro' ),
                    'type'      => 'switch',
                    'default'   => 0,
                    'on'        => esc_html__('On', 'education-pro'),
                    'off'       => esc_html__('Off', 'education-pro'),
                    'required'  => array( 'top_head', '=', '1' )
                ),
                array(
                    'id'       => 'top-menu-link-color',
                    'type'     => 'color',
                    'output'   => array( '.top_menu > li > a' ), 
                    'title'    => esc_html__( 'Top Menu link color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'top_menu', '=', '1' )
                ),
                array(
                    'id'       => 'top-menu-link-hover-color',
                    'type'     => 'color',
                    'output'   => array( '.top_menu > li > a:hover, .top_menu > li > a:focus' ),
                    'title'    => esc_html__( 'Top Menu link hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'top_menu', '=', '1' )
                ),
                // login register
                array(
                'id'        => 'login_reg',
                'title'     => esc_html__( 'Login', 'education-pro' ),
                'type'      => 'switch',
                'default'   => 0,
                'on'        => esc_html__('On', 'education-pro'),
                'off'       => esc_html__('Off', 'education-pro'),
                'required'  => array( 'top_head', '=', '1' )
                ),
                array(
                'id'       => 'login-register',
                'type'     => 'text',
                'title'    => esc_html__('Enter text for Login','education-pro'),
                'default'  => 'Login',
                'required' => array( 'login_reg', '=', '1' ),
                ),
                array(
                'id'       => 'signup-text',
                'type'     => 'text',
                'title'    => esc_html__('Enter register page name','education-pro'),
                'default'  => 'lp-profile',
                'required' => array( 'login_reg', '=', '1' ),
                ),
                array(
                    'id'       => 'login-link-color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '.login_button' ),
                    'title'    => esc_html__( 'Login link color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array( 'login_reg', '=', '1' ),
                ),
                array(
                    'id'       => 'login-link-hover-color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '.login_button:hover,.login_button:focus' ),
                    'title'    => esc_html__( 'Login link hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array( 'login_reg', '=', '1' ),
                ),
                array(
                    'id'       => 'login-form-btn-color',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => '.tx-login input.submit_button' ),
                    'title'    => esc_html__( 'Login Form Button color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array( 'login_reg', '=', '1' ),
                ),
                array(
                    'id'       => 'login-form-btn-hov-color',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => '.tx-login input.submit_button:hover' ),
                    'title'    => esc_html__( 'Login Form Button hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array( 'login_reg', '=', '1' ),
                ),
                // social icons top header
                array(
                    'id'        => 'social_buton_top',
                    'title'     => esc_html__( 'Social Icons', 'education-pro' ),
                    'type'      => 'switch',
                    'default'   => 1,
                    'on'        => esc_html__('On', 'education-pro'),
                    'off'       => esc_html__('Off', 'education-pro'),
                    'required'  => array( 'top_head', '=', '1' )
                ),

                array(
                    'id'       => 'social-media-icon-header-color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '#header .top-header-right-area .social li a i' ),
                    'title'    => esc_html__( 'Social icon color on header', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'social_buton_top', '=', '1' )
                ),
                array(
                    'id'       => 'social-media-icon-header-hover-color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '#header .social li a:hover i' ),
                    'title'    => esc_html__( 'Hover Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'social_buton_top', '=', '1' )
                ),
                // Top header color options
                array(
                    'id'        => 'top-header-colors',
                    'type'      => 'info',
                    'title'     => esc_html__('Colors Options', 'education-pro'),
                    'style'     => 'success',
                    'required'  => array( 'top_head', '=', '1' )
                ),
                array(
                    'id'       => 'top_head_bg_color_home',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '.home #top_head',
                     ),
                    'title'    => esc_html__( 'Top header background color for Home Page only', 'education-pro' ),
                    'required'  => array( 'top_head', '=', '1' )
                ),
                array(
                    'id'       => 'top_head_bg_color_inner',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '#top_head, .home .sticky-header #top_head',
                     ),
                    'title'    => esc_html__( 'Top header background color for inner pages', 'education-pro' ),
                    'required'  => array( 'top_head', '=', '1' )
                ),
                array( 
                    'id'       => 'top_head_border',
                    'type'     => 'border',
                    'title'    => esc_html__('Bottom Border', 'education-pro'),
                    'desc'     => esc_html__( 'Enter border width, example 1, 2, 3 etc to enable border', 'education-pro' ),
                    'output'   => array('#top_head'),
                    'top' => false,
                    'right' => false,
                    'left' => false,
                    'color' => false,
                    'required'  => array( 'top_head', '=', '1' )
                ),
                array(
                    'id'       => 'top_head_border_color',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'border-color' => '#top_head',
                     ),
                    'title'    => esc_html__( 'Border color', 'education-pro' ),
                    'required'  => array( 'top_head', '=', '1' )
                ),
                // Top header font options
                array(
                    'id'        => 'top-header-fonts',
                    'type'      => 'info',
                    'title'     => esc_html__('Fonts Options', 'education-pro'),
                    'style'     => 'success',
                    'required'  => array( 'top_head', '=', '1' )
                ),
                array(
                    'id'       => 'typography-top-header',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Top header', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('#top_head'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'line-height' => true,
                    'word-spacing'  => true,
                    'text-transform'=> true,
                    'letter-spacing'=> true,
                    'color'         => false,
                    'subsets'       => false, 
                    'required'  => array( 'top_head', '=', '1' )
                ),

            )));    
    // Sub header options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Sub Header', 'education-pro'),
        'id'               => 'sub-header',
        'subsection'       => true,
        'desc'             => esc_html__( 'Sub header options','education-pro'),
        'customizer_width' => '400px',
        'fields'           => array(
                array(
                    'title'    => esc_html__( 'Enable / Disable','education-pro'),
                    'id'       => 'sub-header-switch',
                    'type'     => 'switch',
                    'on'       => esc_html__('Enable', 'education-pro'),
                    'off'      => esc_html__('Disable', 'education-pro'),
                    'default'  => 1,
                    ),
               
                array(
                    'title'    => esc_html__( 'Title','education-pro'),
                    'id'       => 'sub_h_title',
                    'type'     => 'switch',
                    'on'       => esc_html__('On', 'education-pro'),
                    'off'      => esc_html__('Off', 'education-pro'),
                    'required' => array('sub-header-switch', '=', '1' ),
                    'default'  => 1,
                ),
                array(
                    'id'       => 'sub_h_post_title',
                    'type'     => 'checkbox',
                    'required' => array('sub_h_title', '=', '1' ),
                    'options'  => array(
                        'page' => esc_html__('Page', 'education-pro'),
                        'post' => esc_html__('Posts', 'education-pro'),
                        'class' => esc_html__('Classes', 'education-pro'),
                        'teacher' => esc_html__('Teachers', 'education-pro'),
                        'lp_course' => esc_html__('LearnPress', 'education-pro'),
                        'product' => esc_html__('WooCommerce', 'education-pro'),
                    ),
                    'default' => array(
                        'page'    => '1', 
                        'post'    => '1',
                        'class'    => '1',
                        'teacher'    => '1',
                        'lp_course'    => '1',
                        'product'    => '1',
                    )
                ),
                array(
                    'title'    => esc_html__( 'Breadcrumbs','education-pro'),
                    'id'       => 'breadcrumbs',
                    'type'     => 'switch',
                    'on'       => esc_html__('On', 'education-pro'),
                    'off'      => esc_html__('Off', 'education-pro'),
                    'required' => array('sub-header-switch', '=', '1' ),
                    'default'  => 1,
                ),
                array(
                    'id'       => 'sub_h_post_breadcrumbs',
                    'type'     => 'checkbox',
                    'required' => array('breadcrumbs', '=', '1' ),
                    'options'  => array(
                        'page' => esc_html__('Page', 'education-pro'),
                        'post' => esc_html__('Posts', 'education-pro'),
                        'class' => esc_html__('Classes', 'education-pro'),
                        'teacher' => esc_html__('Teachers', 'education-pro'),
                        'lp_course' => esc_html__('LearnPress', 'education-pro'),
                        'product' => esc_html__('WooCommerce', 'education-pro'),
                    ),
                    'default' => array(
                        'page'    => '1', 
                        'post'    => '1',
                        'class'    => '1',
                        'teacher'    => '1',
                        'lp_course'    => '1',
                        'product'    => '1',
                    )
                ),
                array(
                    'id'             => 'sub_h_space',
                    'type'           => 'spacing',
                    'output'         => array('.sub-header, .sub-header-blog'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'required'  => array( 'sub-header-switch', '=', '1' ),
                    'units_extended' => 'false',
                    'title'          => __('Space', 'education-pro'),
                    'default'            => array(
                    'padding-top'     => '', 
                    'padding-right'   => '', 
                    'padding-bottom'  => '', 
                    'padding-left'    => '',
                    'units'          => 'px', 
                    )
                ),
                array(
                    'title' => esc_html__( 'Title color', 'education-pro' ),
                    'id'    => 'sub-header-title-color',
                    'type'  => 'color',
                    'output'   => array('.sub-header-title'),
                    'required' => array('sub-header-switch', '=', '1' ),
                    'transparent' => false,
                ),
                array(
                    'title' => esc_html__( 'Link color', 'education-pro' ),
                    'id'    => 'sub-header-link-color',
                    'type'  => 'color',
                    'output'   => array('.breadcrumbs span a'),
                    'required' => array('sub-header-switch', '=', '1' ),
                    'transparent' => false,
                ),
                array(
                    'title' => esc_html__( 'Link hover color', 'education-pro' ),
                    'id'    => 'sub-header-link-hover-color',
                    'type'  => 'color',
                    'output'   => array('.breadcrumbs span a:hover'),
                    'required' => array('sub-header-switch', '=', '1' ),
                    'transparent' => false,
                ),
                array(
                    'title' => esc_html__( 'Separate color', 'education-pro' ),
                    'id'    => 'sub-header-separate-color',
                    'type'  => 'color',
                    'output'   => array('.breadcrumbs .breadcrumbs__separator'),
                    'required' => array('sub-header-switch', '=', '1' ),
                    'transparent' => false,
                ),
                array(
                    'title' => esc_html__( 'Active link color', 'education-pro' ),
                    'id'    => 'sub-header-active-link-color',
                    'type'  => 'color',
                    'output'   => array('.breadcrumbs .breadcrumbs__current'),
                    'required' => array('sub-header-switch', '=', '1' ),
                    'transparent' => false,
                ),
                array(
                    'title' => esc_html__( 'Background', 'education-pro' ),
                    'id'    => 'sub-header-bg',
                    'type'  => 'background',
                    'output'   => array('background-color'=>'.sub-header'),
                    'required' => array('sub-header-switch', '=', '1' ),
                ),
                array(
                    'id'       => 'sub-header-bg-overlay',
                    'type'     => 'color_rgba',
                    'output'   => array( 
                    'background-color' => '.sub-header-overlay' ),
                    'title'    => esc_html__( 'Background Overlay Color', 'education-pro' ),
                    'required' => array('sub-header-switch', '=', '1' ),
                ),
                array(
                    'id'       => 'typography-sub-header',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Sub header Title', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.sub-header-title'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform' => true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required' => array('sub-header-switch', '=', '1' ),
                ),
                array(
                    'id'       => 'typography-breadcrumbs',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Breadcrumbs', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.breadcrumbs'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform' => true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required' => array('sub-header-switch', '=', '1' ),
                ),
            )
        ));
    // Menu options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Menu', 'education-pro'),
        'id'               => 'menu_opt',
        'subsection'       => true,
        'customizer_width' => '400px',
        'fields'           => array(
                array(
                    'id'       => 'menu-left-width',
                    'type'     => 'dimensions',
                    'output'   => 'nav.site-navigation.navigation',
                    'units'    => array('%'),
                    'desc'     => esc_html__('It has Menu Item only.','education-pro'),
                    'subtitle' => esc_html__('Default width 80%.','education-pro'),
                    'title'    => esc_html__('Menu Left Side Width', 'education-pro'),
                    'height'   => false,
                    'width'    => true,
                    'default'  => array(
                        'Width'   => '80', 
                    ),
                ),
                array(
                    'id'       => 'menu-right-width',
                    'type'     => 'dimensions',
                    'output'   => '.menu-area-right',
                    'desc'     => esc_html__('It has Menu button, Seach icon, Side Menu button.','education-pro'),
                    'subtitle' => esc_html__('Default width 20%.','education-pro'),
                    'units'    => array('%'),
                    'title'    => esc_html__('Menu Right Side Width', 'education-pro'),
                    'height'    => false,
                    'default'  => array(
                        'Width'   => '20', 
                    ),
                ),
                array(
                    'id'       => 'menu-alignment',
                    'type'     => 'select',
                    'title' => esc_html__('Menu Alignment', 'education-pro'),
                    'options'  => array(
                        'none'  => esc_html__('None','education-pro'),
                        'left'  => esc_html__('Left','education-pro'),
                        'right'  => esc_html__('Right','education-pro'),
                    ),
                    'default'  => 'none',
                ),
                array(
                    'id'             => 'menu_bar_padding',
                    'type'           => 'spacing',
                    'output'         => array('.menu-bar'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'title'          => esc_html__('Main Menu Bar Padding', 'education-pro'),
                ),
                array(
                    'id'             => 'menu_padding',
                    'type'           => 'spacing',
                    'output'         => array('.main-menu>li>a,.header-style-eight .main-menu>li>a, .header-style-four .main-menu>li>a, .header-style-one .main-menu>li>a, .header-style-seven .main-menu>li>a, .header-style-six .main-menu>li>a, .header-style-two .main-menu>li>a'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'title'          => esc_html__('Main Menu Item Padding', 'education-pro'),
                ),
               
                array(
                    'id'       => 'menu-border',
                    'type'     => 'border',
                    'title'    => esc_html__('Menu Bar Border', 'education-pro'),
                    'desc'     => esc_html__( 'Enter border width ex: 1, 2, 3 etc to enable border. 0 to disable.', 'education-pro' ),
                    'output'   => array('.menu-bar'),
                    'color'    => true,
                    'left'     => false,
                    'right'    => false,
                ),
                array(
                    'id'       => 'menu_bar_bg_color_home',
                    'title'    => esc_html__( 'Menu Bar background color for Home Page only', 'education-pro' ),
                    'type'     => 'color_rgba',
                    'mode'     => 'background',
                    'validate' => 'colorrgba',
                    'output'   => array( 'background-color' => '.home .menu-bar' ),
                ),
                array(
                    'id'       => 'menu_bar_bg_color_inner',
                    'title'    => esc_html__( 'Menu Bar background color for Inner Pages', 'education-pro' ),
                    'type'     => 'color_rgba',
                    'output'   => array( 
                        'background-color' => '.menu-bar, .home .sticky-header .menu-bar',
                    ),
                    
                ),
                array(
                    'id'       => 'menu-link-color',
                    'type'     => 'color',
                    'output'   => array( 'ul.main-menu>li>a,.navbar-collapse > ul > li > a,.navbar-collapse > ul > li > ul > li > a,.navbar-collapse > ul > li > ul > li > ul > li > a,.navbar-collapse > ul > li > span > i, .navbar-collapse > ul > li > ul > li > span > i,.mb-dropdown-icon:before,.tx-res-menu li a' ), 
                    'title'    => esc_html__( 'Main Menu link color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-link-color-home',
                    'type'     => 'color',
                    'output'   => array( '.home ul.main-menu>li>a,.home .navbar-collapse > ul > li > a,.home .navbar-collapse > ul > li > ul > li > a,.home .navbar-collapse > ul > li > ul > li > ul > li > a,.home .navbar-collapse > ul > li > span > i,.home .navbar-collapse > ul > li > ul > li > span > i,.home .mb-dropdown-icon:before,.tx-res-menu li a' ), 
                    'title'    => esc_html__( 'Main Menu link color Home Page', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-link-hover-color',
                    'type'     => 'color',
                    'output'   => array( 'ul.main-menu>li>a:hover, ul.main-menu>li>a:focus,ul.main-menu>li.menu-item-has-children a:hover,ul.main-menu>li.menu-item-has-children a:focus' ),
                    'title'    => esc_html__( 'Main Menu link hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-link-hover-color-home',
                    'type'     => 'color',
                    'output'   => array( '.home ul.main-menu>li>a:hover,.home ul.main-menu>li>a:focus,ul.main-menu>li.menu-item-has-children a:hover,.home ul.main-menu>li.menu-item-has-children a:focus' ),
                    'title'    => esc_html__( 'Main Menu link hover color Home Page', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-active-link-color',
                    'type'     => 'color',
                    'output'   => array( 'ul.main-menu>li.current-menu-item > a,ul.main-menu>li.current-page-ancestor > a, ul.main-menu>li.current-menu-ancestor > a, ul.main-menu>li.current-menu-parent > a, ul.main-menu>li.current_page_ancestor > a, ul.main-menu.active>a:hover' ),
                    'title'    => esc_html__( 'Main Menu link active color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-active-link-color-home',
                    'type'     => 'color',
                    'output'   => array( '.home ul.main-menu>li.current-menu-item > a,.home ul.main-menu>li.current-page-ancestor > a, .home ul.main-menu>li.current-menu-ancestor > a,.home ul.main-menu>li.current-menu-parent > a, .home ul.main-menu>li.current_page_ancestor > a, .home ul.main-menu.active>a:hover' ),
                    'title'    => esc_html__( 'Main Menu link active color Home Page', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-link-bg-hover-color',
                    'type'     => 'color',
                    'output'   => array('background-color' => 'ul.main-menu>li>a:hover, ul.main-menu>li>a:focus' ),
                    'title'    => esc_html__( 'Main Menu link background hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-link-bg-hover-color-home',
                    'type'     => 'color',
                    'output'   => array('background-color' => '.home ul.main-menu>li>a:hover, .home ul.main-menu>li>a:focus' ),
                    'title'    => esc_html__( 'Main Menu link background hover color Home Page', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-active-link-bg-color',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => 'ul.main-menu>li.current-menu-item > a,ul.main-menu>li.current-page-ancestor > a, ul.main-menu>li.current-menu-ancestor > a, ul.main-menu>li.current-menu-parent > a, ul.main-menu>li.current_page_ancestor > a, ul.main-menu.active>a:hover' ),
                    'title'    => esc_html__( 'Main Menu link active background color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'menu-active-link-bg-color-home',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => '.home ul.main-menu>li.current-menu-item > a,.home ul.main-menu>li.current-page-ancestor > a, .home ul.main-menu>li.current-menu-ancestor > a, .home ul.main-menu>li.current-menu-parent > a, .home ul.main-menu>li.current_page_ancestor > a, .home ul.main-menu.active>a:hover' ),
                    'title'    => esc_html__( 'Main Menu link active background color Home Page', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                // sub menu color
                array(
                    'id'       => 'sub-menu-bg-color',
                    'type'     => 'color',
                    'output'   => array( 'background-color' =>'.main-menu li > ul' ), 
                    'title'    => esc_html__( 'Sub Menu background color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sub-menu-link-color',
                    'type'     => 'color',
                    'output'   => array( 'color' =>'.main-menu li ul li a,.tx-mega-menu .mega-menu-item .depth0 li .depth1.standard.sub-menu li a' ), 
                    'title'    => esc_html__( 'Sub Menu link color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sub-menu-link-hover-color',
                    'type'     => 'color',
                    'output'   => array( 'color' =>'.tx-mega-menu .mega-menu-item .depth0 li .depth1.standard.sub-menu li a:hover,.tx-mega-menu .mega-menu-item .depth0 li .depth1.sub-menu li a:hover, ul.main-menu>li.menu-item-has-children a:hover' ), 
                    'title'    => esc_html__( 'Sub Menu link hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sub-menu-border-color',
                    'type'     => 'color',
                    'output'   => array( 'border-color' =>'.main-menu li ul li a' ), 
                    'title'    => esc_html__( 'Sub Menu border color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                // Mega menu color
                array(
                        'id'       => 'mega-menu-columns-border',
                        'type'     => 'border',
                        'title'    => esc_html__('Mega Menu Columns Separator', 'education-pro'),
                        'desc'     => esc_html__( 'Enter border width ex: 1, 2, 3 etc to enable border. 0 to disable.', 'education-pro' ),
                        'output'   => array('.tx-mega-menu .mega-menu-item .depth0.sub-menu> li'),
                        'color'    => true,
                        'top'      => false,
                        'left'     => false,
                        'bottom'   => false,
                    ),
                array(
                    'id'       => 'mega-menu-columns-title-color',
                    'type'     => 'color',
                    'output'   => array( 'color' =>'.tx-mega-menu .mega-menu-item .depth0 li .mega-menu-title' ), 
                    'title'    => esc_html__( 'Mega Menu Columns Title Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                
                // menu fonts
                array(
                    'id'       => 'menu-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Menu fonts', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.main-menu>li>a'),
                    'units'       =>'px',
                     'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'text-transform' => true,
                ),
                // Sub Menu fonts options
                array(
                    'id'       => 'sub-menu-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Sub Menu fonts', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.main-menu>li>ul>li>a,.main-menu>li>ul>li>ul>li>a,.main-menu>li>ul>li>ul>li>ul>li>a,.main-menu>li>ul>li>ul>li>ul>li>ul>li>a,.tx-mega-menu .mega-menu-item .depth0 li .depth1.standard.sub-menu li a,.tx-mega-menu .mega-menu-item .depth0 li .depth1 li a'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'text-transform' => true,
                ),
                array(
                    'id'        => 'menu-dropdown-icon',
                    'type'      => 'switch',
                    'title'     => esc_html__('Menu Dropdown Icon', 'education-pro'),
                    'default'   => 0,
                    'on'        => esc_html__('On','education-pro'),
                    'off'       => esc_html__('Off','education-pro'),
                ),
                array(
                    'id'            => 'menu-dropdown-icon-valign',
                    'type'          => 'slider',
                    'title'         => esc_html__( 'Menu Dropdown Icon Vertical Align', 'education-pro' ),
                    'min'           => 0,
                    'step'          => 1,
                    'max'           => 100,
                    'display_value' => 'text',
                    'required'  => array( 'menu-dropdown-icon', '=', '1' ),
                ),
                array(
                    'id'        => 'menu_item_border',
                    'type'      => 'switch',
                    'title'     => esc_html__('Menu Item Border on Hover', 'education-pro'),
                    'default'   => 0,
                    'on'        => esc_html__('On','education-pro'),
                    'off'       => esc_html__('Off','education-pro'),
                ),
                array(
                'id'       => 'menu_item_border_select',
                'type'     => 'select',
                'title'    => esc_html__('Select Position', 'education-pro'), 
                'options'  => array(
                    'menu_item_border_top' => 'Top',
                    'menu_item_border_bottom' => 'Bottom',
                    ),
                'default'  => 'menu_item_border_top',
                'required'  => array( 'menu_item_border', '=', '1' ),
                ),
                array(
                'id'       => 'menu-top-border-hover-color',
                'type'     => 'color',
                'output'   => array( '.main-menu>li:hover a:before' ),
                'title'    => esc_html__( 'Main Menu link top border hover color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
                'required'  => array( 'menu_item_border', '=', '1' ),
                ),
                // menu item separator
                array(
                    'id'        => 'menu-item-seprator',
                    'type'      => 'switch',
                    'title'     => esc_html__('Menu Item Separator', 'education-pro'),
                    'default'   => 0,
                    'on'        => esc_html__('On','education-pro'),
                    'off'       => esc_html__('Off','education-pro'),
                ),
                array(
                    'id'       => 'menu-item-seprator-border',
                    'type'     => 'border',
                    'title'    => esc_html__('Menu Item Separator Border', 'education-pro'),
                    'subtitle'    => esc_html__('It will show right border to separate.', 'education-pro'),
                    'desc'     => esc_html__( 'Enter border width ex: 1, 2, 3 etc to enable border. 0 to disable.', 'education-pro' ),
                    'output'   => array('.main-menu > li'),
                    'color'    => true,
                    'left'     => false,
                    'top'      => false,
                    'bottom'   => false,
                    'default'  => array(
                        'border-style'  => 'solid', 
                        'border-right' => '0px',
                        'border-top' => '0px',
                        'border-bottom' => '0px',
                    ),
                    'required'  => array( 'menu-item-seprator', '=', '1' ),
                ),
                //Responsive menu / mobile menu
                array(
                'id'        => 'res-mob-menu-info',
                'type'      => 'info',
                'title'     => esc_html__('Responsive / Mobile Menu settings', 'education-pro'),
                'style'     => 'success', //success warning
                ),
                array(
                    'id'          => 'mobile-top-menu-icon-color',
                    'type'        => 'color',
                    'output'      => array('color' => '#responsive-menu-top .navbar-header .navbar-toggle i'),
                    'title'       => esc_html__( 'Responsvie Top Menu icon color', 'education-pro' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required'  => array( 'top_menu', '=', '1' )
                    ),
                array(
                    'id'          => 'mobile-menu-icon-color',
                    'type'        => 'color',
                    'output'      => array('color' => '.navbar-header .navbar-toggle i'),
                    'title'       => esc_html__( 'Responsvie Main Menu icon color', 'education-pro' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    ),
                array(
                    'id'          => 'mobile-menu-item-color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Responsive Menu item color', 'education-pro' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    ),
                array(
                    'id'          => 'mobile-menu-bg-color',
                    'type'        => 'color',
                    'title'       => esc_html__( 'Responsive Menu background color', 'education-pro' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    ),
                array(
                    'id'          => 'mobile-menu-border-color',
                    'type'        => 'color',
                    'output'      => array('border-color' => '.navbar-collapse li,.top-nav-collapse li'),
                    'title'       => esc_html__( 'Responsvie Menu Dropdown border color', 'education-pro' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    ),
                // menu button options
                array(
                'id'        => 'menu-btn-info',
                'type'      => 'info',
                'title'     => esc_html__('Menu Button settings', 'education-pro'),
                'style'     => 'success', //success warning
                ),
                array(
                    'id'        => 'menu_btn_switch',
                    'type'      => 'switch',
                    'title'     => esc_html__('Menu Button', 'education-pro'),
                    'default'   => 0,
                    'on'        => 'On',
                    'off'       => 'Off',
                ),
                array( 
                    'title'     => esc_html__( 'Button Text', 'education-pro' ),
                    'id'        => 'menu_btn_txt',
                    'default'   => esc_html__('Button', 'education-pro'),
                    'type'      => 'text',
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array( 
                    'title'     => esc_html__( 'Button URL', 'education-pro' ),
                    'id'        => 'menu_btn_url',
                    'default'   => esc_html__('#', 'education-pro'),
                    'type'      => 'text',
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array(
                    'id'       => 'menu_btn_link_new_window',
                    'type'     => 'checkbox',
                    'title'    => esc_html__('Open link in new window', 'education-pro'), 
                    'default'  => 0,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array(
                    'id'             => 'menu_btn_padding',
                    'type'           => 'spacing',
                    'output'         => array('.tx-menu-btn'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Menu Button Padding', 'education-pro'),
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array(
                    'id'             => 'menu_btn_margin',
                    'type'           => 'spacing',
                    'output'         => array('.tx-menu-btn-wrap'),
                    'mode'           => 'margin',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Menu Button Margin', 'education-pro'),
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                // Menu button colors
                array(
                    'id'       => 'menu-btn-bg-color',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => '.tx-menu-btn' ), 
                    'title'    => esc_html__( 'Menu Button Background Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => true,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array(
                    'id'       => 'menu-btn-bg-hov-color',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => '.tx-menu-btn:hover,.tx-menu-btn:focus' ), 
                    'title'    => esc_html__( 'Menu Button Background Hover Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => true,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array(
                    'id'       => 'menu-btn-color',
                    'type'     => 'color',
                    'output'   => array( '.tx-menu-btn' ), 
                    'title'    => esc_html__( 'Menu Button Text Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array(
                    'id'       => 'menu-btn-hov-color',
                    'type'     => 'color',
                    'output'   => array( '.tx-menu-btn:hover,.tx-menu-btn:focus' ), 
                    'title'    => esc_html__( 'Menu Button Text Hover Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array(
                   'id'       => 'menu-btn-border',
                    'type'     => 'border',
                    'title'    => esc_html__('Menu Button Border', 'education-pro'),
                    'desc'     => esc_html__( 'Enter border width, example 1, 2, 3 etc to enable border', 'education-pro' ),
                    'output'   => array('.tx-menu-btn'),
                    'color' => false,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                    ),
                array(
                    'id'       => 'menu-btn-bord-color',
                    'type'     => 'color',
                    'output'   => array( 'border-color' => '.tx-menu-btn' ), 
                    'title'    => esc_html__( 'Menu Button Border Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => true,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                array(
                    'id'       => 'menu-btn-bord-hov-color',
                    'type'     => 'color',
                    'output'   => array( 'border-color' => '.tx-menu-btn:hover' ), 
                    'title'    => esc_html__( 'Menu Button Border Hover Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => true,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                // menu button fonts options
                array(
                    'id'       => 'menu-btn-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Menu Button', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.tx-menu-btn'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'text-transform' => true,
                    'required'  => array( 'menu_btn_switch', '=', '1' ),
                ),
                // cart icon options
                array(
                'id'        => 'cart-icon-info',
                'type'      => 'info',
                'title'     => esc_html__('Cart settings', 'education-pro'),
                'style'     => 'success', //success warning
                ),
                array(
                    'id'        => 'tx-cart',
                    'type'      => 'switch',
                    'title'     => esc_html__('Cart Icon', 'education-pro'),
                    'desc'     => esc_html__('Need to activate WooCommece plugin.', 'education-pro'),
                    'default'   => 0,
                    'on'        => 'On',
                    'off'       => 'Off',
                ),
                array(
                    'id'             => 'tx-cart_space',
                    'type'           => 'spacing',
                    'output'         => array('.tx-cart'),
                    'mode'           => 'margin',
                    'units'          => array('px', 'em'),
                    'units_extended' => false,
                    'title'          => esc_html__('Cart Space', 'education-pro'),
                    'required'  => array( 'tx-cart', '=', '1' ),
                ),
                array(
                    'id'       => 'tx-cart-icon-color',
                    'type'     => 'color',
                    'output'   => array( '.tx-cart' ),
                    'title'    => esc_html__( 'Header Cart icon color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'tx-cart', '=', '1' ),
                ),
                array(
                    'id'       => 'tx-cart-icon-hover-color',
                    'type'     => 'color',
                    'output'   => array( '.tx-cart:hover' ),
                    'title'    => esc_html__( 'Header Cart icon hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'tx-cart', '=', '1' ),
                ),
                array(
                'id'        => 'search-icon-info',
                'type'      => 'info',
                'title'     => esc_html__('Search Icon settings', 'education-pro'),
                'style'     => 'success', //success warning
                ),
                // search icon option
                array(
                    'id'        => 'search',
                    'type'      => 'switch',
                    'title'     => esc_html__('Search Icon', 'education-pro'),
                    'default'   => 1,
                    'on'        => 'On',
                    'off'       => 'Off',
                ),
                array(
                    'id'             => 'search_space',
                    'type'           => 'spacing',
                    'output'         => array('.search-icon'),
                    'mode'           => 'margin',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Search Space', 'education-pro'),
                    'required'  => array( 'search', '=', '1' ),
                ),
                //search icon color
                array(
                    'id'       => 'search-icon-color',
                    'type'     => 'color',
                    'output'   => array( '.search-icon' ),
                    'title'    => esc_html__( 'Header Search icon color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'search', '=', '1' ),
                ),
                array(
                    'id'       => 'search-icon-hover-color',
                    'type'     => 'color',
                    'output'   => array( '.search-icon:hover' ),
                    'title'    => esc_html__( 'Search icon hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'search', '=', '1' ),
                ),
                array(
                    'id'       => 'search-icon-close-color',
                    'type'     => 'color',
                    'output'   => array( '.search-box > .search-close,.search-box > .search-close i' ),
                    'title'    => esc_html__( 'Search close icon color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'search', '=', '1' ),
                ),
                array(
                    'id'       => 'search-icon-close-hover-color',
                    'type'     => 'color',
                    'output'   => array( '.search-box > .search-close:hover,.search-close:hover i,.search-box > .search-close:hover i' ),
                    'title'    => esc_html__( 'Search close icon hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'search', '=', '1' ),
                ),
                // side menu options
                array(
                'id'        => 'side-menu-info',
                'type'      => 'info',
                'title'     => esc_html__('Side Menu settings', 'education-pro'),
                'style'     => 'success', //success warning
                ),
                array(
                    'id'        => 'side_menu',
                    'type'      => 'switch',
                    'title'     => esc_html__('Side Menu', 'education-pro'),
                    'default'   => 1,
                    'on'        => 'On',
                    'off'       => 'Off',
                ),
                 array(
                    'id'             => 'side_menu_margin',
                    'type'           => 'spacing',
                    'output'         => array('#side-menu-icon'),
                    'mode'           => 'margin',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Side Menu Space', 'education-pro'),
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                // side menu colors
                array(
                    'id'       => 'side-menu-icon-color',
                    'type'     => 'color',
                    'output'   => array( '.side_menu_icon' ), 
                    'title'    => esc_html__( 'Side Menu Icon Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-icon-color-hover',
                    'type'     => 'color',
                    'output'   => array( '.side_menu_icon:hover' ), 
                    'title'    => esc_html__( 'Side Menu Icon Hover Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-icon-close-color',
                    'type'     => 'color',
                    'output'   => array( '.side-menu .s-menu-icon-close' ), 
                    'title'    => esc_html__( 'Side Menu Icon Close Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-icon-close-color-hover',
                    'type'     => 'color',
                    'output'   => array( '.side-menu .s-menu-icon-close:hover' ), 
                    'title'    => esc_html__( 'Side Menu Icon Close Hover Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-bg-color',
                    'type'     => 'color',
                    'output'   => array('background-color' => '#side-menu-wrapper' ), 
                    'title'    => esc_html__( 'Side Menu Background Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-text-color',
                    'type'     => 'color',
                    'output'   => array('#side-menu-wrapper' ), 
                    'title'    => esc_html__( 'Side Menu Text Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-link-color',
                    'type'     => 'color',
                    'output'   => array('.side-menu a' ), 
                    'title'    => esc_html__( 'Side Menu Link Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-link-hover-color',
                    'type'     => 'color',
                    'output'   => array('.side-menu a:hover' ), 
                    'title'    => esc_html__( 'Side Menu Link Hover Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-widget-title-color',
                    'type'     => 'color',
                    'output'   => array('#side-menu-wrapper .widget-title' ), 
                    'title'    => esc_html__( 'Side Menu Widget Title Color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                // side menu fonts options
                array(
                    'id'       => 'side-menu-icon-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Side Menu Icon', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('#side-menu-icon'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => false,
                    'word-spacing'  => false,
                    'letter-spacing'=> false,
                    'color'         => false,
                    'text-transform' => false,
                    'text-align'    => false,
                    'subsets'       => false, 
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Side Menu', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.side-menus'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'text-transform' => true,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-text-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Side Menu Text', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('#side-menu-wrapper p'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => false,
                    'acync_typography' => false,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'text-transform' => true,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
                array(
                    'id'       => 'side-menu-widget-title-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Side Menu Widget Title', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('#side-menu-wrapper .widget-title'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'text-transform' => true,
                    'required'  => array( 'side_menu', '=', '1' ),
                ),
            )));
        // Post options / blog options
        Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Posts', 'education-pro' ),
        'id'         => 'blog-option',
        'icon'       => 'fa fa-thumb-tack',
        'fields'     => array(
            // Sidebar index, archive
                array(
                'id'       => 'sidebar-select',
                'type'     => 'select',
                'title'    => esc_html__('Select Sidebar', 'education-pro'), 
                'desc'     => esc_html__('For blog, archive, category, tag pages sidebar.', 'education-pro'),
                'options'  => array(
                    'sidebar-right' => 'Right Sidebar',
                    'sidebar-left' => 'Left Sidebar',
                    'sidebar-none' => 'None',
                    ),
                'default'  => 'sidebar-right',
                ),
                // sidebar single post
                array(
                'id'       => 'sidebar-single',
                'type'     => 'select',
                'title'    => esc_html__('Single Sidebar', 'education-pro'), 
                'desc'     => esc_html__('For Single Post Sidebar', 'education-pro'),
                'options'  => array(
                    'sidebar-right' => 'Right Sidebar',
                    'sidebar-left' => 'Left Sidebar',
                    'sidebar-none' => 'None',
                    ),
                'default'  => 'sidebar-none',
                ),
                array(
                    'id' => 'cat_temp_style',
                    'title' => esc_html__('Category Page Style', 'education-pro'),
                    'type' => 'image_select',
                    'options' => array (
                        'cat_style_1' => array('title' => 'Style 1', 'img' => TX_IMAGES . 'cat-style-1.png'),
                        'cat_style_2' => array('title' => 'Style 2', 'img' => TX_IMAGES . 'cat-style-2.png'),
                        'cat_style_3' => array('title' => 'Style 3', 'img' => TX_IMAGES . 'cat-style-3.png'),
                    ),
                    'default'  => 'cat_style_1',
                ),
            array(
                'id'            => 'title-length',
                'type'          => 'slider',
                'title'         => esc_html__( 'Title Length', 'education-pro' ),
                'desc'         => esc_html__( 'Title Limit', 'education-pro' ),
                'default'       => 85,
                'min'           => 1,
                'step'          => 1,
                'max'           => 300,
                'display_value' => 'text'
                ),
            array(
                'id'            => 'excerpt-word-limit',
                'type'          => 'slider',
                'title'         => esc_html__( 'Excerpt Words', 'education-pro' ),
                'desc'         => esc_html__( 'Word limit for Excerpt in blog, archive, category, tag pages etc.', 'education-pro' ),
                'default'       => 35,
                'min'           => 1,
                'step'          => 1,
                'max'           => 55,
                'display_value' => 'text'
                ),
            array(
                'id'            => 'blog-posts-per-page',
                'type'          => 'slider',
                'title'         => esc_html__( 'Pagination', 'education-pro' ),
                'desc'         => esc_html__( 'Posts per page', 'education-pro' ),
                'default'       => 9,
                'min'           => 1,
                'step'          => 1,
                'max'           => 99,
                'display_value' => 'text'
                ),
            array(
                'id'            => 'tag_limit',
                'type'          => 'slider',
                'title'         => esc_html__( 'Tag Cloud Widget', 'education-pro' ),
                'desc'         => esc_html__( 'Tag Limit', 'education-pro' ),
                'default'       => 15,
                'min'           => 1,
                'step'          => 1,
                'max'           => 99,
                'display_value' => 'text'
                ),
            array(
                'id'        => 'read-more',
                'type'      => 'switch',
                'title'     => esc_html__('Read More Button', 'education-pro'),
                'default'   => 1,
                'on'        => 'On',
                'off'       => 'Off',
                ),
            array(
                'id'       => 'read-more-text',
                'type'     => 'text',
                'title'    => esc_html__('Change Text','education-pro'),
                'default'  => 'Read More',
                'required' => array( 'read-more', '=', '1' ),
                ),
            array(
                'id'        => 'post-meta-info',
                'type'      => 'info',
                'title'     => esc_html__('Post meta settings', 'education-pro'),
                'style'     => 'success', //success warning
                ),
            array(
                'id'        => 'post-time',
                'type'      => 'switch',
                'title'     => esc_html__('Time', 'education-pro'),
                'default'   => 1,
                'on'        => esc_html__('Show','education-pro'),
                'off'       => esc_html__('Hide','education-pro'),
                ),
            array(
                'id'        => 'post-author',
                'type'      => 'switch',
                'title'     => esc_html__('Author', 'education-pro'),
                'default'   => 1,
                'on'        => esc_html__('Show','education-pro'),
                'off'       => esc_html__('Hide','education-pro'),
                ),
            
            array(
                'id'        => 'post-comment',
                'type'      => 'switch',
                'title'     => esc_html__('Comments', 'education-pro'),
                'default'   => 1,
                'on'        => esc_html__('Show','education-pro'),
                'off'       => esc_html__('Hide','education-pro'),
                ),
            array(
                'id'        => 'post-views',
                'type'      => 'switch',
                'title'     => esc_html__('Views', 'education-pro'),
                'default'   => 1,
                'on'        => esc_html__('Show','education-pro'),
                'off'       => esc_html__('Hide','education-pro'),
                ),
            array(
                'id'        => 'social-share-header',
                'type'      => 'switch',
                'title'     => esc_html__('Social Share on Header', 'education-pro'),
                'default'   => 1,
                'on'        => esc_html__('Show','education-pro'),
                'off'       => esc_html__('Hide','education-pro'),
                ),
            
            
            // single post settings
            array(
                'id'        => 'comment-info',
                'type'      => 'info',
                'title'     => esc_html__('Single post settings', 'education-pro'),
                'style'     => 'success', //success warning
                ),
            
            array(
                'id'        => 'featured-image',
                'type'      => 'switch',
                'title'     => esc_html__('Featured Image', 'education-pro'),
                'default'   => 1,
                'on'        => esc_html__('Enable','education-pro'),
                'off'       => esc_html__('Disable','education-pro'),
                ),
            array(
                'id'        => 'posts-title',
                'type'      => 'switch',
                'title'     => esc_html__('Posts Title', 'education-pro'),
                'default'   => 1,
                'on'        => esc_html__('Enable','education-pro'),
                'off'       => esc_html__('Disable','education-pro'),
                ),
            array(
                'id'        => 'post-category',
                'type'      => 'switch',
                'title'     => esc_html__('Categories', 'education-pro'),
                'default'   => 1,
                'on'        => esc_html__('Enable','education-pro'),
                'off'       => esc_html__('Disable','education-pro'),
                ),
            array(
                'id'        => 'post-tag',
                'type'      => 'switch',
                'title'     => esc_html__('Tags', 'education-pro'),
                'default'   => 1,
                'on'        => esc_html__('Enable','education-pro'),
                'off'       => esc_html__('Disable','education-pro'),
                ),
            array(
                'id'        => 'social-share-footer',
                'type'      => 'switch',
                'title'     => esc_html__('Social Share on Footer', 'education-pro'),
                'default'   => 1,
                'on'        => esc_html__('Enable','education-pro'),
                'off'       => esc_html__('Disable','education-pro'),
                ),
            array(
                'id'        => 'related-posts',
                'type'      => 'switch',
                'title'     => esc_html__('Related posts', 'education-pro'),
                'default'   => 1,
                'on'        => esc_html__('Enable','education-pro'),
                'off'       => esc_html__('Disable','education-pro'),
                ),
            array(
                'id'        => 'prev-next-posts',
                'type'      => 'switch',
                'title'     => esc_html__('Prev / Next Posts', 'education-pro'),
                'default'   => 1,
                'on'        => esc_html__('Enable','education-pro'),
                'off'       => esc_html__('Disable','education-pro'),
                ),
            array(
                'id'        => 'author-bio-posts',
                'type'      => 'switch',
                'title'     => esc_html__('Author Bio', 'education-pro'),
                'default'   => 1,
                'on'        => esc_html__('Enable','education-pro'),
                'off'       => esc_html__('Disable','education-pro'),
                ),
            array(
                'id'        => 'comments-posts',
                'type'      => 'switch',
                'title'     => esc_html__('Comments', 'education-pro'),
                'default'   => 1,
                'on'        => esc_html__('Enable','education-pro'),
                'off'       => esc_html__('Disable','education-pro'),
                ),
            // Posts color
            array(
                'id'        => 'posts-colors',
                'type'      => 'info',
                'title'     => esc_html__('Posts Colors', 'education-pro'),
                'style'     => 'success', //success warning
                ),           
            array(
                'id'       => 'posts-title-color',
                'type'     => 'color',
                'output'   => array( '.details-box .post-title a,.entry-title a' ),
                'title'    => esc_html__( 'Posts title color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'post-title-hover-color',
                'type'     => 'color',
                'output'   => array( 'h1.entry-title a:hover,.details-box .post-title a:hover,.tx-cat-style3-right .post-title a:hover' ),
                'title'    => esc_html__( 'Post title hover color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-text-color',
                'type'     => 'color',
                'output'   => array( '.details-box p' ),
                'title'    => esc_html__( 'Post excerpt color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'post_meta_icon_color',
                'type'     => 'color',
                'output'   => array( 'color' => '.entry-meta i, .entry-footer i' ),
                'title'    => esc_html__( 'Post meta icon color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'post_meta_text_color',
                'type'     => 'color',
                'output'   => array( 'color' => '.entry-meta, .entry-footer' ),
                'title'    => esc_html__( 'Post meta text color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'post_meta_text_hov_color',
                'type'     => 'color',
                'output'   => array( 'color' => '.post .post-category a:hover, .post .comments-link a:hover, .post .post-tag a:hover,.nickname a:hover' ),
                'title'    => esc_html__( 'Post meta text hover color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-date-color',
                'type'     => 'color',
                'output'   => array( '.details-box .post-time' ),
                'title'    => esc_html__( 'Posts date color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-date-bg-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.details-box .post-time' ),
                'title'    => esc_html__( 'Posts date background color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-date-hov-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.blog-cols:hover .details-box .post-time' ),
                'title'    => esc_html__( 'Posts date hover color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-date-bg-hov-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.blog-cols:hover .details-box .post-time' ),
                'title'    => esc_html__( 'Posts date background hover color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-bottom-border-hov-color',
                'type'     => 'color',
                'output'   => array( 'border-color' => '.blog-cols:hover .details-box' ),
                'title'    => esc_html__( 'Posts bottom border hover color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-read-more-btn-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.tx-read-more, .tx-read-more a, .tx-read-more:after' ),
                'title'    => esc_html__( 'Posts read more button color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-read-more-btn-bg-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.tx-read-more' ),
                'title'    => esc_html__( 'Posts read more button background color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'posts-read-more-btn-hov-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.tx-read-more a:focus, .tx-read-more:focus, .tx-read-more:hover, .tx-read-more:hover a' ),
                'title'    => esc_html__( 'Posts read more button hover color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            // single post color settings
            array(
                'id'        => 'single-posts-colors',
                'type'      => 'info',
                'title'     => esc_html__('Single Post Colors', 'education-pro'),
                'style'     => 'success', //success warning
                ),
            array(
                'id'       => 'single-posts-title-color',
                'type'     => 'color',
                'output'   => array( '.single-post .entry-title' ),
                'title'    => esc_html__( 'Single Posts Title color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'single-posts-text-color',
                'type'     => 'color',
                'output'   => array( '.single-post .entry-content p' ),
                'title'    => esc_html__( 'Single Post text color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'related-post-bar-bg-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.related-posts-title' ),
                'title'    => esc_html__( 'Related Post Bar background color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'related-post-bar-title-color',
                'type'     => 'color',
                'output'   => '.related-posts-title',
                'title'    => esc_html__( 'Related Post Bar Title color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'related-post-overlay-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.related-posts-item .overlay' ),
                'title'    => esc_html__( 'Related Post overlay color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'related-post-title-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.related-posts-item .overlay a' ),
                'title'    => esc_html__( 'Related Post title color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'next-prev-post-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.single .page-link, .single .page-link a' ),
                'title'    => esc_html__( 'Previous Post / Next Post color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'next-prev-post-bg-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.single .page-link, .single .page-link a' ),
                'title'    => esc_html__( 'Previous Post / Next Post background color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'next-prev-post-hov-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.single .page-link:hover, .single .page-link:hover a, .single .page-link a:hover' ),
                'title'    => esc_html__( 'Previous Post / Next Post hover color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'next-prev-post-bg-hov-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.single .page-link:hover, .single .page-link:hover a, .single .page-link a:hover' ),
                'title'    => esc_html__( 'Previous Post / Next Post background hover color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'author-bg-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.author_bio_sec' ),
                'title'    => esc_html__( 'Author background color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'post_comment_form_btn_color',
                'type'     => 'color',
                'output'   => array( 'color' => '.form-submit input[type="submit"]' ),
                'title'    => esc_html__( 'Post comment form button text color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'post_comment_form_btn_hov_color',
                'type'     => 'color',
                'output'   => array( 'color' => '.form-submit input[type="submit"]:hover' ),
                'title'    => esc_html__( 'Post comment form button text hover color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'post_comment_form_btn_bg_color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.form-submit input[type="submit"]' ),
                'title'    => esc_html__( 'Post comment form button background color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'post_comment_form_btn_bg_hov_color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.form-submit input[type="submit"]:hover' ),
                'title'    => esc_html__( 'Post comment form button background hover color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            
            array(
                'id'       => 'form-control-focus',
                'type'     => 'color',
                'output'   => array( 'border-color' => '.form-control:focus' ),
                'title'    => esc_html__( 'Post comment form border focus color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            // Posts fonts
            array(
                'id'        => 'posts-fonts',
                'type'      => 'info',
                'title'     => esc_html__('Posts fonts', 'education-pro'),
                'style'     => 'success', //success warning
                ),
            array(
                'id'       => 'posts-title-font',
                'type'     => 'typography',
                'title'    => esc_html__( 'Post Title', 'education-pro' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('h1.entry-title, h1.entry-title a'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'posts-paragraph-font',
                'type'     => 'typography',
                'title'    => esc_html__( 'Post text', 'education-pro' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('.entry-content p'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'posts-blockquote-font',
                'type'     => 'typography',
                'title'    => esc_html__( 'Post blockquote', 'education-pro' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('.entry-content blockquote p'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'subsets'       => true, 
            ),
            )));

        // Classes Options
        Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Classes', 'education-pro' ),
        'id'         => 'classes-option',
        'icon'       => 'el el-th-large',
        'fields'     => array(
            array(
                'id'      => 'classes_post_type',
                'title'    => esc_html__('Classes Post Type','education-pro'),
                'desc'    => esc_html__('After Save Changes please refresh the page.','education-pro'),
                'type'    => 'switch',
                'on'      => esc_html__('Enable','education-pro'),
                'off'     => esc_html__('Disable','education-pro'),
                'default' => 1,
                ),
            array(
                    'id'        => 'class-slug-info',
                    'type'      => 'info',
                    'title'     => esc_html__('Classes button and slug text settings', 'education-pro'),
                    'style'     => 'success', //success warning
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'        => 'classes_title',
                    'type'      => 'text',
                    'title'     => esc_html__('Name', 'education-pro'),
                    'description' => esc_html__('Sevices menu and archive page title will be changed. After Save Changes please refresh the page.', 'education-pro'),
                    'default'   => 'Classes',
                    'required'  => array( 'classes_post_type', '=', '1' ),
                    ),
            array(
                    'id'        => 'class-slug',
                    'type'      => 'text',
                    'title'     => esc_html__('Classes slug / Permalink', 'education-pro'),
                    'description' => esc_html__('After change go to Settings > Permalinks and click Save changes.', 'education-pro'),
                    'default'   => 'class',
                    'required'  => array( 'classes_post_type', '=', '1' ),
                    ),
            array(
                    'id'        => 'classes-cat-slug',
                    'type'      => 'text',
                    'title'     => esc_html__('Classes category slug / Permalink', 'education-pro'),
                    'description' => esc_html__('After change go to Settings > Permalinks and click Save changes.', 'education-pro'),
                    'default'   => 'classes-category',
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'        => 'classes-colors-info',
                    'type'      => 'info',
                    'title'     => esc_html__('Classes Colors Settings', 'education-pro'),
                    'style'     => 'success', //success warning
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'classes-overlay-color',
                    'type'     => 'color_rgba',
                    'output'    => array('background-color' => '.tx-services-featured a:before, .tx-services-overlay-item:before'),
                    'title'    => esc_html__( 'Overlay Color', 'education-pro' ),
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'classes-title-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.tx-services-title a'),
                    'title'    => esc_html__( 'Title Color', 'education-pro' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'classes-title-hov-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.tx-services-title:hover,.tx-services-overlay-item .tx-services-title:hover'),
                    'title'    => esc_html__( 'Title Hover Color', 'education-pro' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'classes-title-holder-bg-color',
                    'type'     => 'color_rgba',
                    'output'    => array('background-color' => '.tx-services-title-holder'),
                    'title'    => esc_html__( 'Title Holder Background Color', 'education-pro' ),
                    'desc'    => esc_html__( 'For Overlay style only', 'education-pro' ),
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'classes-content-bg-color',
                    'type'     => 'color',
                    'output'    => array('background-color' => '.tx-services-content'),
                    'title'    => esc_html__( 'Content Background Color', 'education-pro' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'classes-excerpt-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.tx-services-excp'),
                    'title'    => esc_html__( 'Excerpt Color for Grid style only', 'education-pro' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'classes-excerpt-overlay-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.tx-services-overlay-item .tx-services-excp'),
                    'title'    => esc_html__( 'Excerpt Color for Overlay style only', 'education-pro' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'classes-cat-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.tx-serv-cat'),
                    'title'    => esc_html__( 'Category Color', 'education-pro' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'classes-cat-hov-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.tx-serv-cat:hover'),
                    'title'    => esc_html__( 'Category Hover Color', 'education-pro' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'classes-overlay-icon-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.tx-services-featured a:after, .tx-services-overlay-item i'),
                    'title'    => esc_html__( 'Overlay Icon Color', 'education-pro' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'classes-overlay-icon-hov-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.tx-services-overlay-item i:hover'),
                    'title'    => esc_html__( 'Overlay Icon Hover Color', 'education-pro' ),
                    'desc'    => esc_html__( 'For Overlay style only.', 'education-pro' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'        => 'classes-single-colors-info',
                    'type'      => 'info',
                    'title'     => esc_html__('Classes Single Page Colors Settings', 'education-pro'),
                    'style'     => 'success', //success warning
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'classes-download-btn-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.btn-brochure'),
                    'title'    => esc_html__( 'Download Button Text Color', 'education-pro' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'classes-download-btn-bg-color',
                    'type'     => 'color',
                    'output'    => array('background-color' => '.btn-brochure'),
                    'title'    => esc_html__( 'Download Button Background Color', 'education-pro' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'classes-download-btn-txt-hov-color',
                    'type'     => 'color',
                    'output'    => array('color' => '.btn-brochure:hover'),
                    'title'    => esc_html__( 'Download Button Text Hover Color', 'education-pro' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            array(
                    'id'       => 'classes-download-btn-bg-hov-color',
                    'type'     => 'color',
                    'output'    => array('background-color' => '.btn-brochure:hover'),
                    'title'    => esc_html__( 'Download Button Background Hover Color', 'education-pro' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required'  => array( 'classes_post_type', '=', '1' ),
                ),
            )));

        // Teachers options
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Teachers', 'education-pro' ),
        'id'         => 'teachers',
        'icon'       => 'fa fa-user',
        'fields'     => array(
            array(
                'id'      => 'teachers_post_type',
                'title'    => esc_html__('Teachers Post Type','education-pro'),
                'desc'    => esc_html__('After Save Changes please refresh the page.','education-pro'),
                'type'    => 'switch',
                'on'      => esc_html__('Enable','education-pro'),
                'off'     => esc_html__('Disable','education-pro'),
                'default' => 1,
                ),
            array(
                'id'            => 'teachers-per-page',
                'type'          => 'slider',
                'title'         => esc_html__( 'Teachers per page', 'education-pro' ),
                'default'       => 12,
                'min'           => 1,
                'step'          => 1,
                'max'           => 99,
                'display_value' => 'text',
                'required'  => array( 'teachers_post_type', '=', '1' ),
            ),          
            array(
                'id'      => 'teachers_social_profile',
                'title'   => esc_html__('Social Profile','education-pro'),
                'type'    => 'switch',
                'on'      => esc_html__('On','education-pro'),
                'off'     => esc_html__('Off','education-pro'),
                'default' => 1,
                'required'  => array( 'teachers_post_type', '=', '1' ),
                ),
            array(
               'id'       => 'teachers-profile-pic-border',
                'type'     => 'border',
                'title'    => esc_html__('Profile Picture Border', 'education-pro'),
                'desc'     => esc_html__( 'Enter border width, example 1, 2, 3 etc to enable border', 'education-pro' ),
                'output'   => array('.team-single-left img'),
                'color' => true,
                'default'  => array(
                    'border-color'  => '#dfdfdf', 
                    'border-style'  => 'solid', 
                    'border-top' => '0px',
                    'border-bottom' => '0px',
                    'border-left' => '0px',
                    'border-right' => '0px',
                ),
                'required'  => array( 'teachers_post_type', '=', '1' ),
                ),
            array(
               'id'       => 'teachers-hire-border',
                'type'     => 'border',
                'title'    => esc_html__('Button Border', 'education-pro'),
                'desc'     => esc_html__( 'Enter border width, example 1, 2, 3 etc to enable border', 'education-pro' ),
                'output'   => array('.single-team .hire_me'),
                'color' => true,
                'default'  => array(
                    'border-color'  => '#fff', 
                    'border-style'  => 'solid', 
                ),
                'required'  => array( 'teachers_post_type', '=', '1' ),
                ),
            array(
                    'id'        => 'teachers_title',
                    'type'      => 'text',
                    'title'     => esc_html__('Name', 'education-pro'),
                    'description' => esc_html__('Teachers menu and archive page title will be changed. After Save Changes please refresh the page.', 'education-pro'),
                    'default'   => 'Teachers',
                    'required'  => array( 'teachers_post_type', '=', '1' ),
                    ),
            array(
                    'id'        => 'teachers-slug',
                    'type'      => 'text',
                    'title'     => esc_html__('Teachers slug / Permalink', 'education-pro'),
                    'description' => esc_html__('After change go to Settings > Permalinks and click Save changes.', 'education-pro'),
                    'default'   => 'teacher',
                    'required'  => array( 'teachers_post_type', '=', '1' ),
                ),
            array(
                    'id'        => 'teachers-cat-slug',
                    'type'      => 'text',
                    'title'     => esc_html__('Teachers category slug / Permalink', 'education-pro'),
                    'description' => esc_html__('After change go to Settings > Permalinks and click Save changes.', 'education-pro'),
                    'default'   => 'teachers-category',
                    'required'  => array( 'teachers_post_type', '=', '1' ),
                ),
            array(
                'id'        => 'teachers-color-settings',
                'type'      => 'info',
                'title'     => esc_html__('Color Settings', 'education-pro'),
                'style'     => 'success',
                'required'  => array( 'teachers_post_type', '=', '1' ),
            ),
            array(
                    'id'       => 'teachers-overlay-bg-color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Teacher Image Overlay Color', 'education-pro' ),
                    'output'   => array('background-color' => '.team figcaption'),
                    'transparent' => false,
                    'validate' => 'color',
                    'required'  => array( 'teachers_post_type', '=', '1' ),
                ),
            array(
                'id'          => 'teacher-name-color',
                'type'        => 'color',
                'output'      => array('color' => '.team figcaption h4 a'),
                'title'       => esc_html__( 'Name Color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'teachers_post_type', '=', '1' ),
            ),
            array(
                'id'          => 'teacher-name-hov-color',
                'type'        => 'color',
                'output'      => array('color' => '.team figcaption h4 a:hover'),
                'title'       => esc_html__( 'Name Hover Color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'teachers_post_type', '=', '1' ),
            ),
            array(
                'id'          => 'teachers-cat-color',
                'type'        => 'color',
                'output'      => array('color' => '.team .team-cat a'),
                'title'       => esc_html__( 'Position Color', 'education-pro' ),
                'desc'       => esc_html__( 'Formaly Category Color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'teachers_post_type', '=', '1' ),
            ),
            array(
                'id'          => 'teachers-cat-hov-color',
                'type'        => 'color',
                'output'      => array('color' => '.team .team-cat a:hover, .team .team-cat a:focus'),
                'title'       => esc_html__( 'Position Hover Color', 'education-pro' ),
                'desc'       => esc_html__( 'Formaly Category Hover Color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'teachers_post_type', '=', '1' ),
            ),
            array(
                'id'          => 'teacher-bio-color',
                'type'        => 'color',
                'output'      => array('color' => '.team .team-bio'),
                'title'       => esc_html__( 'Bio Color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'teachers_post_type', '=', '1' ),
            ),
            array(
                'id'          => 'teacher-social-icon-color',
                'type'        => 'color',
                'output'      => array(
                    'color' => '.team-social i',
                    'border-color' => '.team-social li'
                ),
                'title'       => esc_html__( 'Social Icon Color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'teachers_post_type', '=', '1' ),
            ),
            array(
                'id'          => 'teacher-social-icon-hov-color',
                'type'        => 'color',
                'output'      => array(
                    'color' => '.team-social li:hover i',
                    'border-color' => '.team-social li:hover'
                ),
                'title'       => esc_html__( 'Social Icon Hover Color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'teachers_post_type', '=', '1' ),
            ),
            array(
                'id'        => 'teacher-single-color-settings',
                'type'      => 'info',
                'title'     => esc_html__('Single Profile Color Settings', 'education-pro'),
                'style'     => 'success',
                'required'  => array( 'teachers_post_type', '=', '1' ),
            ),
            array(
                'id'          => 'teacher-profile-pic-bg-color',
                'type'        => 'color',
                'output'      => array('background-color' => '.team_profile'),
                'title'       => esc_html__( 'Picture underneath background color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'teachers_post_type', '=', '1' ),
            ),

            )));
       
        // Widgets options
        Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Widgets', 'education-pro'),
        'id'               => 'sidebar-widgets',
        'icon'       => 'el el-pause',
        'fields'           => array(
                
                // sidebar color options
                array(
                    'id'       => 'sidebar-bg-color',
                    'type'     => 'color',
                    'output'   => array( 'background' => '#secondary .widget, #secondary_2 .widget,.theme-education-pro .lp-archive-courses .course-summary .course-summary-content .lp-entry-content.lp-content-area .course-summary-sidebar .course-summary-sidebar__inner .course-sidebar-secondary' ),
                    'title'    => esc_html__( 'Sidebar background color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sidebar-border-color',
                    'type'     => 'color',
                    'output'   => array( 'border-color' => '#secondary .widget, #secondary_2 .widget,.theme-education-pro .lp-archive-courses .course-summary .course-summary-content .lp-entry-content.lp-content-area .course-summary-sidebar .course-summary-sidebar__inner > div .widgettitle' ),
                    'title'    => esc_html__( 'Sidebar border color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sidebar-title-color',
                    'type'     => 'color',
                    'output'   => array( '.elementor h2.widgettitle, .elementor h3.widgettitle, #secondary h2.widgettitle, #secondary h3.widget-title, #secondary_2 h3.widget-title,.theme-education-pro .lp-archive-courses .course-summary .course-summary-content .lp-entry-content.lp-content-area .course-summary-sidebar .course-summary-sidebar__inner > div .widgettitle' ),
                    'title'    => esc_html__( 'Sidebar title color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sidebar-title-border-color',
                    'type'     => 'color',
                    'output'   => array( 'border-color' => '.elementor h2.widgettitle,.elementor h3.widgettitle,#secondary h2.widgettitle, #secondary h3.widget-title, #secondary_2 h3.widget-title,.theme-education-pro .lp-archive-courses .course-summary .course-summary-content .lp-entry-content.lp-content-area .course-summary-sidebar .course-summary-sidebar__inner > div .widgettitle' ),
                    'title'    => esc_html__( 'Sidebar title border color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sidebar-title-border-after-color',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => '.elementor h2.widgettitle:after,.elementor h3.widgettitle:after,#secondary h2.widgettitle:after, #secondary h3.widget-title:after, #secondary_2 h3.widget-title:after,.lp-archive-courses .course-summary .course-summary-content .lp-entry-content.lp-content-area .course-summary-sidebar .course-summary-sidebar__inner > div .widgettitle:after' ),
                    'title'    => esc_html__( 'Sidebar title border after color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sidebar-search-icon-color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '.search-form i' ),
                    'title'    => esc_html__( 'Sidebar search icon color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sidebar-search-icon-hover-color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '.search-form i:hover' ),
                    'title'    => esc_html__( 'Sidebar search icon hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sidebar-category-color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '#secondary li.cat-item a' ),
                    'title'    => esc_html__( 'Sidebar category color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                array(
                    'id'       => 'sidebar-category-hover-color',
                    'type'     => 'color',
                    'output'   => array( 'color' => '#secondary li.cat-item a:hover' ),
                    'title'    => esc_html__( 'Sidebar category hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                ),
                // sidebar fonts
                array(
                    'id'       => 'sidebar-title-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Sidebar Title', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('#secondary h2.widgettitle, #secondary h3.widget-title, #secondary_2 h3.widget-title'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                ),
                array(
                    'id'       => 'sidebar-recent-posts-title-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Recent Posts Widget Posts Title', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.rpt a'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                ),

        )));
        // Ads options
        Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Ads', 'education-pro' ),
        'id'         => 'ads-option',
        'icon'       => 'el el-bullhorn',
        'fields'     => array(
                
            // content post ads option from here         
                 array(
                    'id'        => 'post_ads',
                    'type'      => 'switch',
                    'title'     => esc_html__('Single Post Ads', 'education-pro'),
                    'default'   => 0,
                    'on'        => 'Enable',
                    'off'       => 'Disable',
                ),
                array(
                    'id'        => 's_ads_switch',
                    'type'      => 'switch',
                    'title'     => esc_html__('Content ad', 'education-pro'),
                    'subtitle' => esc_html__('Size 300x250','education-pro'),
                    'default'   => 1,
                    'on'        => 'Banner',
                    'off'       => 'Adsense',
                    'required' => array('post_ads','=','1'), 
                ),
                array(
                    'id'        => 's_ads_after_p',
                    'type'      => 'slider',
                    'title'     => esc_html__('After paragraph', 'education-pro'),
                    "default"   => 1,
                    "min"       => 1,
                    "step"      => 1,
                    "max"       => 10,
                    'display_value' => 'select',
                    'required' => array('post_ads','=','1'), 

                ),
                array(
                    'title'    => esc_html__('Ad Banner', 'education-pro'),
                    'id'       => 's_ad_banner',
                    'required'  => array( 's_ads_switch', '=', '1' ),
                    'type'     => 'media',
                    'complier' => true,
                    'url'      => true,
                    'desc'     => esc_html__( 'You can upload png, jpg, gif image.', 'education-pro' ),
                    'default'  => array(
                      'url'=> TX_IMAGES . '300x250.jpg'
                    ),
                    'required' => array( 
                                  array('post_ads','=','1'), 
                                  array('s_ads_switch','=','1'),
                    ),
                ),
                array(
                    'id'       => 's_ad_banner_link',
                    'type'     => 'text',
                    'title'    => esc_html__('Banner link', 'education-pro'),
                    'required' => array( 
                                  array('post_ads','=','1'), 
                                  array('s_ads_switch','=','1'),
                    ),
                ),
                array(
                'id'       => 's_ad_js',
                'title'    => esc_html__( 'Adsense codes here.', 'education-pro' ),
                'type'     => 'ace_editor',
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'desc'      => esc_html__('Example: Google Adsense etc', 'education-pro'),
                'required'  => array( 's_ads_switch', '=', '0' ),
                 ),

        )));
    
    if(class_exists('LearnPress')) :
    // -> START LearnPress options
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'LearnPress Courses','education-pro' ),
        'id'        => 'learnpress',
        'icon'      => 'fa fa-graduation-cap',
        'fields'    => array(
        // Courses page
            array(
                'id'        => 'courses_page_sec',
                'type'      => 'info',
                'title'     => esc_html__('Courses page', 'education-pro'),
                'style'     => 'success',
            ),
            array(
                'id'      => 'lp_search',
                'title'   => esc_html__('Search','education-pro'),
                'type'    => 'switch',
                'on'      => esc_html__('Show','education-pro'),
                'off'     => esc_html__('Hide','education-pro'),
                'default' => 1,

            ),
            array(
                'id'      => 'lp_layout',
                'title'   => esc_html__('LearnPress Courses Layout Switch','education-pro'),
                'type'    => 'switch',
                'on'      => esc_html__('Show','education-pro'),
                'off'     => esc_html__('Hide','education-pro'),
                'default' => 1,
            ),
            array(
                'id'            => 'lp_course_min_height',
                'type'          => 'slider',
                'title'         => esc_html__( 'LearnPress Course minimum height', 'education-pro' ),
                'min'           => 0,
                'step'          => 1,
                'max'           => 350,
                'display_value' => 'text',
            ),
            array(
                'id'          => 'lp-course-price',
                'type'        => 'color',
                'output'      => array('background-color' => '.lp-course-price'),
                'title'       => esc_html__( 'Course Price background color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-course-price-color',
                'type'        => 'color',
                'output'      => array('color' => '.lp-course-price'),
                'title'       => esc_html__( 'Course Price color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-course-reg-price-color',
                'type'        => 'color',
                'output'      => array('color' => '.lp-course-price .origin-price'),
                'title'       => esc_html__( 'Course Regular Price color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-course-featured-badge-bg-color',
                'type'        => 'color',
                'output'      => array('background' => '.lp-badge.featured-course'),
                'title'       => esc_html__( 'LearnPress Course Featured Badge background color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-course-title-color',
                'type'        => 'color',
                'output'      => array('color' => '.course-title a'),
                'title'       => esc_html__( 'Course Title color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-course-title-hover-color',
                'type'        => 'color',
                'output'      => array('color' => '.course-title a:hover'),
                'title'       => esc_html__( 'Course Title hover color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-course-cat-color',
                'type'        => 'color',
                'output'      => array('color' => '.course-cateogory a'),
                'title'       => esc_html__( 'Course Category color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-course-cat-hov-color',
                'type'        => 'color',
                'output'      => array('color' => '.type-lp_course:hover .course-cateogory a'),
                'title'       => esc_html__( 'Course Category hover color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-course-sep-color',
                'type'        => 'color',
                'output'      => array('border-color' => '.type-lp_course:hover .edu-course-footer'),
                'title'       => esc_html__( 'Course footer separator color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-single-course-btn-bg-color',
                'type'        => 'color',
                'output'      => array('background-color' => '.single-lp_course form[name="purchase-course"] .button-purchase-course, .single-lp_course form[name="enroll-course"] .lp-button'),
                'title'       => esc_html__( 'Single Course Button BG color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-single-course-btn-bg-hov-color',
                'type'        => 'color',
                'output'      => array('background-color' => '.single-lp_course form[name="purchase-course"] .button-purchase-course:hover, .single-lp_course form[name="enroll-course"] .lp-button:hover'),
                'title'       => esc_html__( 'Single Course Button BG hover color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-single-course-desc-tab-color',
                'type'        => 'color',
                'output'      => array('color' => '.single-lp_course .course-tabs .course-nav-tabs li a'),
                'title'       => esc_html__( 'Single Course description tab color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-single-course-desc-tab-top-line-color',
                'type'        => 'color',
                'output'      => array('background-color' => '.single-lp_course .course-tabs .course-nav-tabs li.active:before'),
                'title'       => esc_html__( 'Single Course description tab top line color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-single-course-desc-tab-bottom-line-hov-color',
                'type'        => 'color',
                'output'      => array('background-color' => '.single-lp_course .course-tabs .course-nav-tabs li:hover:after'),
                'title'       => esc_html__( 'Single Course description tab bottom line hover color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
            array(
                'id'          => 'lp-single-course-related-title-bg-color',
                'type'        => 'color',
                'output'      => array('background-color' => '.edu-ralated-course .related-title'),
                'title'       => esc_html__( 'Single Course Related bar BG color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
            ),
        )
    ));
    endif;

    if(class_exists('WooCommerce')) :
    // -> START Woocommerce options
    Redux::setSection( $opt_name, array(
        'title'     => esc_html__( 'WooCommerce','education-pro' ),
        'id'        => 'woocommerce',
        'icon'      => 'el el-shopping-cart',
        'fields'    => array(
            array(
                'id'            => 'woo-product-per-row',
                'type'          => 'slider',
                'title'         => esc_html__( 'Product per row', 'education-pro' ),
                'default'       => 3,
                'min'           => 1,
                'step'          => 1,
                'max'           => 6,
                'display_value' => 'text'
            ),
            array(
                'id'            => 'woo-product-per-page',
                'type'          => 'slider',
                'title'         => esc_html__( 'Product per page', 'education-pro' ),
                'default'       => 12,
                'min'           => 1,
                'step'          => 1,
                'max'           => 99,
                'display_value' => 'text'
            ),
            array(
                'id'       => 'woo-sidebar-select',
                'type'     => 'select',
                'title'    => esc_html__('Shop Sidebar', 'education-pro'), 
                'options'  => array(
                    'woo-sidebar-right' => 'Right Sidebar',
                    'woo-sidebar-left' => 'Left Sidebar',
                    'woo-sidebar-none' => 'No Sidebar',
                ),
                'default'  => 'woo-sidebar-right',
            ),
            array(
                'id'       => 'woo-single-sidebar-select',
                'type'     => 'select',
                'title'    => esc_html__('Single Product Sidebar', 'education-pro'), 
                'options'  => array(
                    'woo-single-sidebar-right' => 'Right Sidebar',
                    'woo-single-sidebar-left' => 'Left Sidebar',
                    'woo-single-sidebar-none' => 'No Sidebar',
                ),
                'default'  => 'woo-single-sidebar-right',
            ),
            array(
                'id'      => 'woo_number_result',
                'title'   => esc_html__('Display Result Count','education-pro'),
                'desc'   => esc_html__('Number of result in shop page','education-pro'),
                'type'    => 'switch',
                'on'      => esc_html__('Show','education-pro'),
                'off'     => esc_html__('Hide','education-pro'),
                'default' => 0,
            ),
            array(
                'id'      => 'woo_default_sorting_dropdown',
                'title'   => esc_html__('Display Ordering','education-pro'),
                'desc'   => esc_html__('Default sorting dropdown in shop page','education-pro'),
                'type'    => 'switch',
                'on'      => esc_html__('Show','education-pro'),
                'off'     => esc_html__('Hide','education-pro'),
                'default' => 0,
            ),
            array(
                'id'      => 'woo-new-badge',
                'title'   => esc_html__('Display New Badge','education-pro'),
                'desc'   => esc_html__('Show New badge on product in shop page','education-pro'),
                'type'    => 'switch',
                'on'      => esc_html__('Show','education-pro'),
                'off'     => esc_html__('Hide','education-pro'),
                'default' => 1,
            ),
            array(
                'id'            => 'woo-new-badge-days',
                'type'          => 'slider',
                'title'         => esc_html__( 'New badge display for days', 'education-pro' ),
                'default'       => 7,
                'min'           => 1,
                'step'          => 1,
                'max'           => 60,
                'display_value' => 'text',
                'required'  => array( 'woo-new-badge', '=', '1' ),
            ),
            array(
                'id'       => 'woo-new-badge-bg-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.woocommerce ul.products li.product .itsnew.onsale' ),
                'title'    => esc_html__( 'New badge background color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array( 'woo-new-badge', '=', '1' ),
            ),
            array(
                'id'       => 'woo-new-badge-text-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.woocommerce ul.products li.product .itsnew.onsale' ),
                'title'    => esc_html__( 'New badge text color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array( 'woo-new-badge', '=', '1' ),
            ),
             array(
                    'id'       => 'woo-new-badge-fonts',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'New badge font', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.woocommerce ul.products li.product .itsnew.onsale'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required' => array( 'woo-new-badge', '=', '1' ),
                ),
            // sale badge
            array(
                'id'       => 'woo-sale-badge-bg-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.woocommerce ul.products li.product .onsale' ),
                'title'    => esc_html__( 'Sale badge background color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => true,
            ),
            array(
                'id'       => 'woo-sale-badge-text-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.woocommerce ul.products li.product .onsale' ),
                'title'    => esc_html__( 'Sale badge text color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => true,
            ),
            array(
                    'id'       => 'woo-sale-badge-fonts',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Sale badge font', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.woocommerce ul.products li.product .onsale'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform'=> true,
                    'color'         => false,
                    'subsets'       => true, 
            ),
            // Featured badge
            array(
                'id'       => 'woo-featured-badge-bg-color',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.woocommerce ul.products li.product .featured.itsnew.onsale' ),
                'title'    => esc_html__( 'Featured badge background color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => true,
            ),
            array(
                'id'       => 'woo-featured-badge-text-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.woocommerce ul.products li.product .featured.itsnew.onsale' ),
                'title'    => esc_html__( 'Featured badge text color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => true,
            ),
            array(
                'id'       => 'woo-featured-badge-fonts',
                'type'     => 'typography',
                'title'    => esc_html__( 'Featured badge font', 'education-pro' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('.woocommerce ul.products li.product .featured.itsnew.onsale'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'subsets'       => true, 
            ),
            // Product colors settings
            array(
                'id'        => 'woo_prodcutsion_color_settings',
                'type'      => 'info',
                'title'     => esc_html__('Product colors settings', 'education-pro'),
                'style'     => 'success',
                ),    
            array(
                'id'       => 'woo-prod-name-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.woocommerce-loop-product__title' ),
                'title'    => esc_html__( 'Product name color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'woo-prod-name-fonts',
                'type'     => 'typography',
                'title'    => esc_html__( 'Product name font', 'education-pro' ),
                'google'   => true,
                'font-backup' => false,
                'output'      => array('.woocommerce-loop-product__title'),
                'units'       =>'px',
                'font-style'  => true,
                'all_styles'  => true,
                'word-spacing'  => true,
                'letter-spacing'=> true,
                'text-transform'=> true,
                'color'         => false,
                'subsets'       => true, 
            ),
            array(
                'id'       => 'woo-prod-price-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.woocommerce ul.products li.product .price' ),
                'title'    => esc_html__( 'Product price color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'woo-prod-reg-price-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.woocommerce ul.products li.product .price del' ),
                'title'    => esc_html__( 'Product regular price color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
        )
        ));
    endif; // check woocommerce installed or not
    
    // Social Media  / social share         
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Social Media', 'education-pro' ),
        'desc'            => esc_html__( 'Use [ep-social-media] for shortcode', 'education-pro' ),
        'id'               => 'social_media',
        'customizer_width' => '400px',
        'icon'             => 'el el-twitter',
        'fields'           =>  array(            
            array(
                'id'        => 'social',
                'type'      => 'switch',
                'default'   => 1,
                'on'        => esc_html__('Enable', 'education-pro'),
                'off'       => esc_html__('Disable', 'education-pro'),
                ),
            array(
                'id'       => 'behance',
                'type'     => 'text',
                'title'    => esc_html__('Behance','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'facebook',
                'type'     => 'text',
                'title'    => esc_html__('Facebook','education-pro'),
                'default'  => '#',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'flickr',
                'type'     => 'text',
                'title'    => esc_html__('Flickr','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'github',
                'type'     => 'text',
                'title'    => esc_html__('GitHub','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'instagram',
                'type'     => 'text',
                'title'    => esc_html__('Instagram','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'linkedin',
                'type'     => 'text',
                'title'    => esc_html__('LinkedIn','education-pro'),
                'default'  => '#',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'pinterest',
                'type'     => 'text',
                'title'    => esc_html__('Pinterest','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'qq',
                'type'     => 'text',
                'title'    => esc_html__('QQ','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'reddit',
                'type'     => 'text',
                'title'    => esc_html__('Reddit','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'skype',
                'type'     => 'text',
                'title'    => esc_html__('Skype','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'snapchat',
                'type'     => 'text',
                'title'    => esc_html__('Snapchat','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'soundcloud',
                'type'     => 'text',
                'title'    => esc_html__('SoundCloud','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'spotify',
                'type'     => 'text',
                'title'    => esc_html__('Spotify','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'stumbleupon',
                'type'     => 'text',
                'title'    => esc_html__('Stumbleupon','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'telegram',
                'type'     => 'text',
                'title'    => esc_html__('Telegram','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'tumblr',
                'type'     => 'text',
                'title'    => esc_html__('Tumblr','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'twitch',
                'type'     => 'text',
                'title'    => esc_html__('Twitch','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'twitter',
                'type'     => 'text',
                'title'    => esc_html__('Twitter','education-pro'),
                'default'  => '#',
                'required' => array( 'social', '=', '1' ),
                ),           
            array(
                'id'       => 'vimeo',
                'type'     => 'text',
                'title'    => esc_html__('Vimeo','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'vine',
                'type'     => 'text',
                'title'    => esc_html__('Vine','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
             array(
                'id'       => 'vk',
                'type'     => 'text',
                'title'    => esc_html__('VK','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'whatsapp',
                'type'     => 'text',
                'title'    => esc_html__('WhatsApp','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'wikipedia',
                'type'     => 'text',
                'title'    => esc_html__('Wikipedia','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'xing',
                'type'     => 'text',
                'title'    => esc_html__('Xing','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'yelp',
                'type'     => 'text',
                'title'    => esc_html__('Yelp','education-pro'),
                'default'  => '',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'youtube',
                'type'     => 'text',
                'title'    => esc_html__('Youtube','education-pro'),
                'default'  => '#',
                'required' => array( 'social', '=', '1' ),
                ),
            array(
                'id'       => 'social-media-icon-shortcode-color',
                'type'     => 'color',
                'output'   => array( 'color' => '#header .social li a i' ),
                'title'    => esc_html__( 'Social icon color on shortcode', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array( 'social', '=', '1' ),
            ),
            array(
                'id'       => 'social-media-icon-shortcode-color-hover',
                'type'     => 'color',
                'output'   => array( 'color' => '#header .social li a:hover i' ),
                'title'    => esc_html__( 'Social icon hover color on shortcode', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array( 'social', '=', '1' ),
            ),
            array(
                'id'       => 'social_share_bg_clr',
                'type'     => 'color',
                'output'   => array( 'background-color' => '.social-share' ),
                'title'    => esc_html__( 'Share on Background Color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array( 'social', '=', '1' ),
            ),
            array(
                'id'       => 'social_share_border_clr',
                'type'     => 'color',
                'output'   => array( 'border-color' => '.social-share' ),
                'title'    => esc_html__( 'Share on Border Color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array( 'social', '=', '1' ),
            ),
            array(
                'id'       => 'social-share-title-color',
                'type'     => 'color',
                'output'   => array( 'color' => '.social-share h5' ),
                'title'    => esc_html__( 'Share on text color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array( 'social', '=', '1' ),
            ),
           
    ) 
    ) );
    // -> START Footer options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Footer', 'education-pro' ),
        'id'               => 'footer',
        'desc'             => esc_html__('Footer Options.', 'education-pro'),
        'customizer_width' => '400px',
        'icon'             => 'el el-photo',
        'fields'           =>  array(
                array(
                'id'        => 'footer_top',
                'title'     => esc_html__( 'Footer Top', 'education-pro' ),
                'type'      => 'switch',
                'default'   => 1,
                'on'        => esc_html__('Enable', 'education-pro'),
                'off'       => esc_html__('Disable', 'education-pro'),
                ),
                array(
                'title'    => esc_html__('Footer Top Background', 'education-pro'),
                'id'       => 'footer_bg',
                'type'     => 'background',
                'output'   => array('background-color'=>'#footer-top'),
                'required' => array('footer_top', '=', '1' ),
                ),
                array(
                    'id'       => 'footer-text-color',
                    'type'     => 'color',
                    'output'    => array('#footer-top'),
                    'title'    => esc_html__( 'Footer Top text color', 'education-pro' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required' => array('footer_top', '=', '1' ),
                ),
                array(
                    'id'       => 'footer-link-color',
                    'type'     => 'color',
                    'output'    => array('#footer-top a'),
                    'title'    => esc_html__( 'Footer Top link color', 'education-pro' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required' => array('footer_top', '=', '1' ),
                    ),
                array(
                    'id'       => 'footer-link-hover-color',
                    'type'     => 'color',
                    'output'    => array('#footer-top a:hover'),
                    'title'    => esc_html__( 'Footer Top link hover color', 'education-pro' ),
                    'transparent' => false,
                    'validate'  => 'color',
                    'required' => array('footer_top', '=', '1' ),
                    ),
                array(
                    'id'          => 'footer-widget-title-color',
                    'type'        => 'color',
                    'output'      => array('#footer-top .widget-title'),
                    'title'       => esc_html__( 'Footer Top widget title color', 'education-pro' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required' => array('footer_top', '=', '1' ),
                    ),
                array(
                    'id'       => 'footer-top-fonts',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Footer Top font', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('#footer-top'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required' => array('footer_top', '=', '1' ),
                ),
                array(
                    'id'       => 'footer-widget',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Footer Top widget title font', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.widget-title'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required' => array('footer_top', '=', '1' ),
                ),
                array(
                    'id' => 'footer_layout',
                    'title' => esc_html__('Footer Layout', 'education-pro'),
                    'type' => 'image_select',
                    'options' => array (
                        'boxed' => array('title' => 'Boxed', 'img' => TX_IMAGES . 'footer-boxed.png'),
                        'width' => array('title' => 'Wide', 'img' => TX_IMAGES . 'footer-width.png'),
                    ),
                    'default'  => 'boxed',
                    'required'  => array( 
                                    array('footer_top', '=', '1' ),
                                    array( 'page-layout', '=', 'full-width' )
                                )
                ),
                array(
                    'id'       => 'footer_cols',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Footer Top Columns', 'education-pro' ),
                    'required' => array('footer_top', '=', '1' ),
                    'options'  => array(
                        '12'   => 'Footer Column 1',
                         '6'   => 'Footer Column 2',
                         '4'   => 'Footer Column 3',
                         '3'   => 'Footer Column 4',
                        ),
                    'default'  => '3',
                ),
                array(
                    'id'             => 'footer_top_space',
                    'type'           => 'spacing',
                    'output'         => array('#footer-top'),
                    'mode'           => 'padding',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Footer Padding', 'education-pro'),
                    'required'  => array('footer_top', '=', '1' ),
                ),
                array(
                    'id'       => 'footer-top-widget-alignment',
                    'type'     => 'select',
                    'title' => esc_html__('Footer Widgets Alignment', 'education-pro'),
                    'options'  => array(
                        'left'  => esc_html__('Left','education-pro'),
                        'center'  => esc_html__('Center','education-pro'),
                    ),
                     'default'  => 'left',
                    'required'  => array('footer_top', '=', '1' ),
                ),
                array(
                    'id'             => 'footer_top_widget_margin',
                    'type'           => 'spacing',
                    'output'         => array('#footer-top aside'),
                    'mode'           => 'margin',
                    'units'          => array('px', 'em'),
                    'units_extended' => 'false',
                    'title'          => esc_html__('Footer Widget Margin', 'education-pro'),
                    'required'  => array('footer_top', '=', '1' ),
                ),
                // Footer bottom options
                array(
                    'id'        => 'footer_bottom_sec',
                    'type'      => 'info',
                    'title'     => esc_html__('Footer Bottom Section', 'education-pro'),
                    'style'     => 'success',
                ),
                array(
                'id'        => 'footer_bottom',
                'title'     => esc_html__( 'Footer Bottom', 'education-pro' ),
                'type'      => 'switch',
                'default'   => 1,
                'on'        => esc_html__('Enable', 'education-pro'),
                'off'       => esc_html__('Disable', 'education-pro'),
                ),
                array(
                    'id'       => 'footer-select',
                    'type'     => 'select',
                    'title' => esc_html__('Select Footer Style', 'education-pro'),
                    'options'  => array(
                        'footer1'  => esc_html__('Style 1','education-pro'),
                        'footer2'  => esc_html__('Style 2','education-pro'),
                        'footer3'  => esc_html__('Style 3','education-pro'),
                    ),
                    'default'  => 'footer1',
                    'required'  => array( 'footer_bottom', '=', '1' ),
                ),
                array(
                    'id'       => 'footer-style1',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 1', 'education-pro'),
                    'required'  => array( 'footer-select', '=', 'footer1' ),
                    'options'  => array(
                    'header-style1'  => array(
                      'alt' => 'Footer Style 1',
                      'img' => TX_IMAGES .'f1.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'footer-style2',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 2', 'education-pro'),
                    'required'  => array( 'footer-select', '=', 'footer2' ),
                    'options'  => array(
                    'header-style1'  => array(
                      'alt' => 'Footer Style 2',
                      'img' => TX_IMAGES .'f2.png'
                    ),
                    ),
                ),
                array(
                    'id'       => 'footer-style3',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Style 3', 'education-pro'),
                    'required'  => array( 'footer-select', '=', 'footer3' ),
                    'options'  => array(
                    'header-style1'  => array(
                      'alt' => 'Footer Style 3',
                      'img' => TX_IMAGES .'f3.png'
                    ),
                    ),
                ),
                array(
                    'id'          => 'footer-bottom-bg-color',
                    'type'        => 'color',
                    'output'      => array('background-color' => '#footer'),
                    'title'       => esc_html__( 'Footer Bottom background color', 'education-pro' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required'  => array( 'footer_bottom', '=', '1' ),
                    ),
                array(
                    'id'          => 'footer-border-color',
                    'type'        => 'color',
                    'output'      => array('border-color' => '#footer'),
                    'title'       => esc_html__( 'Footer Bottom border color', 'education-pro' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required'  => array( 'footer_bottom', '=', '1' ),
                    ),
                // Footer menu options
                array(
                'id'        => 'footer-menu',
                'title'     => esc_html__( 'Footer Menu', 'education-pro' ),
                'type'      => 'switch',
                'default'   => 0,
                'on'        => esc_html__('On', 'education-pro'),
                'off'       => esc_html__('Off', 'education-pro'),
                'required'  => array( 'footer_bottom', '=', '1' ),
                ),
                // Footer Menu Color
                array(
                    'id'          => 'footer-menu-color',
                    'type'        => 'color',
                    'output'      => array('color' => '.footer-menu li a'),
                    'title'       => esc_html__( 'Footer menu color', 'education-pro' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required' => array('footer-menu', '=', '1' ),
                    ),
                array(
                    'id'          => 'footer-menu-hover-color',
                    'type'        => 'color',
                    'output'      => array('color' => '.footer-menu li a:hover'),
                    'title'       => esc_html__( 'Footer menu hover color', 'education-pro' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required' => array('footer-menu', '=', '1' ),
                    ),
                array(
                    'id'          => 'footer-menu-separator-color',
                    'type'        => 'color',
                    'output'      => array('color' => '.footer-menu li:after'),
                    'title'       => esc_html__( 'Footer menu seperator color', 'education-pro' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required' => array('footer-menu', '=', '1' ),
                    ),
                // footer menu fonts
                array(
                    'id'       => 'footer-menu-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Footer menu font', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.footer-menu li a'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'text-transform'=> true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'color'         => false,
                    'subsets'       => true, 
                    'required' => array('footer-menu', '=', '1' ),

                ),
                // social icon on footer
                array(
                'id'        => 'social_icons_footer',
                'title'     => esc_html__( 'Social Icons', 'education-pro' ),
                'type'      => 'switch',
                'default'   => 0,
                'on'        => esc_html__('On', 'education-pro'),
                'off'       => esc_html__('Off', 'education-pro'),
                'required'  => array( 'footer_bottom', '=', '1' ),
                ),
                array(
                'id'       => 'social-media-icon-footer-color',
                'type'     => 'color',
                'output'   => array( 'color' => '#footer .social li a' ),
                'title'    => esc_html__( 'Social icon color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array('social_icons_footer', '=', '1' ),
                ),
                array(
                'id'       => 'social-media-icon-footer-color-hover',
                'type'     => 'color',
                'output'   => array( 'color' => '#footer .social li a:hover' ),
                'title'    => esc_html__( 'Social icon hover color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array('social_icons_footer', '=', '1' ),
                ),
                // scroll to back to top
                array(
                'id'        => 'back_top',
                'title'     => esc_html__( 'Scroll to Top', 'education-pro' ),
                'type'      => 'switch',
                'default'   => 1,
                'on'        => esc_html__('On', 'education-pro'),
                'off'       => esc_html__('Off', 'education-pro'),
                'required'  => array( 'footer_bottom', '=', '1' ),
                ),
                array(
                'id'       => 'back_top_bg',
                'type'     => 'color',
                'output'   => array( 'background-color' => '#back_top' ),
                'title'    => esc_html__( 'Scroll to top background color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
                'required' => array('back_top', '=', '1' ),
                ),
                array(
                    'id'       => 'back_top_bg_hover',
                    'type'     => 'color',
                    'output'   => array( 'background-color' => '#back_top:hover,#back_top:focus' ),
                    'title'    => esc_html__( 'Scroll to top background hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array('back_top', '=', '1' ),
                ),
                array(
                    'id'       => 'back_top_border',
                    'type'     => 'color',
                    'output'   => array( 'border-color' => '#back_top' ),
                    'title'    => esc_html__( 'Scroll to top border color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array('back_top', '=', '1' ),
                ),
                array(
                    'id'       => 'back_top_border_hover',
                    'type'     => 'color',
                    'output'   => array( 'border-color' => '#back_top:hover,#back_top:focus' ),
                    'title'    => esc_html__( 'Scroll to top border hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array('back_top', '=', '1' ),
                ),
                array(
                    'id'       => 'back_top_icon',
                    'type'     => 'color',
                    'output'   => array( 'color' => '#back_top i' ),
                    'title'    => esc_html__( 'Scroll to top icon color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array('back_top', '=', '1' ),
                ),
                array(
                    'id'       => 'back_top_icon_hover',
                    'type'     => 'color',
                    'output'   => array( 'color' => '#back_top i:hover,#back_top i:focus, #back_top:hover i' ),
                    'title'    => esc_html__( 'Scroll to top icon hover color', 'education-pro' ),
                    'validate' => 'color',
                    'transparent' => false,
                    'required' => array('back_top', '=', '1' ),
                ),
                
                // copryright
                array(
                'id'       => 'copyright',
                'title'    =>  esc_html__('Copyright', 'education-pro'),
                'type'     => 'textarea',
                'default'  => '&copy; Education Pro WordPress Theme | All rights reserved.',
                'required'  => array( 'footer_bottom', '=', '1' ),
                ),
                array(
                'id'          => 'footer-copyright-text-color',
                'type'        => 'color',
                'output'      => array('color' => '.copyright'),
                'title'       => esc_html__( 'Footer copyright text color', 'education-pro' ),
                'transparent' => false,
                'validate'    => 'color',
                'required'  => array( 'footer_bottom', '=', '1' ),
                ),
                array(
                    'id'          => 'footer-copyright-link-color',
                    'type'        => 'color',
                    'output'      => array('color' => '.copyright a'),
                    'title'       => esc_html__( 'Footer copyright link color', 'education-pro' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required'  => array( 'footer_bottom', '=', '1' ),
                ),
                array(
                    'id'          => 'footer-copyright-link-hover-color',
                    'type'        => 'color',
                    'output'      => array('color' => '.copyright a:hover'),
                    'title'       => esc_html__( 'Footer copyright link hover color', 'education-pro' ),
                    'transparent' => false,
                    'validate'    => 'color',
                    'required'  => array( 'footer_bottom', '=', '1' ),
                ),
                array(
                    'id'       => 'footer-copyright',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Copyright text', 'education-pro' ),
                    'google'   => true,
                    'font-backup' => false,
                    'output'      => array('.copyright'),
                    'units'       =>'px',
                    'font-style'  => true,
                    'all_styles'  => true,
                    'word-spacing'  => true,
                    'letter-spacing'=> true,
                    'text-transform'=> true,
                    'color'         => false,
                    'subsets'       => true,
                    'required'  => array( 'footer_bottom', '=', '1' ),
                ),
    ),
    ));        
// -> Forms optons / contact form 7 options
if(function_exists('wpcf7')) :
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Forms', 'education-pro' ),
        'id'    => 'forms',
        'icon'  => 'el el-envelope',
        'fields'     => array(
            array(
                'id'       => 'contact_form_button_bg_color',
                'type'     => 'color',
                'output'   => array( 'background-color' => 'input.wpcf7-form-control.wpcf7-submit' ),
                'title'    => esc_html__( 'Contact Form Button Background', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'contact_form_button_bg_hov_color',
                'type'     => 'color',
                'output'   => array( 'background-color' => 'input.wpcf7-form-control.wpcf7-submit:hover' ),
                'title'    => esc_html__( 'Contact Form Button Background Hover', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'contact_form_button_border_color',
                'type'     => 'color',
                'output'   => array( 'border-color' => 'input.wpcf7-form-control.wpcf7-submit' ),
                'title'    => esc_html__( 'Contact Form Button Border', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'contact_form_button_color',
                'type'     => 'color',
                'output'   => array( 'color' => 'input.wpcf7-form-control.wpcf7-submit,.footer input.wpcf7-form-control.wpcf7-submit' ),
                'title'    => esc_html__( 'Contact Form Button Color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'contact_form_button_hover_color',
                'type'     => 'color',
                'output'   => array( 'color' => 'input.wpcf7-form-control.wpcf7-submit:hover' ),
                'title'    => esc_html__( 'Contact Form Button Hover Color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'contact_form_button_border_color_hover',
                'type'     => 'color',
                'output'   => array( 'border-color' => 'input.wpcf7-form-control.wpcf7-submit:hover' ),
                'title'    => esc_html__( 'Contact Form Button Border Hover Color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'contact_form_fields_border_color',
                'type'     => 'color',
                'output'   => array( 'border-color' => '.footer input.wpcf7-form-control.wpcf7-text,.footer textarea.wpcf7-form-control.wpcf7-textarea' ),
                'title'    => esc_html__( 'Contact Form Footer Fields Border Color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            
    )));
endif;
    // pagination options
    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Pagination', 'education-pro' ),
        'id'    => 'pagination',
        'icon'  => 'el el-resize-horizontal',
        'fields'     => array(
            array(
                'id'             => 'pagination_space',
                'type'           => 'spacing',
                'output'         => array('.tx-pagination, .learn-press-pagination'),
                'mode'           => 'padding',
                'units'          => array('px', 'em'),
                'units_extended' => 'false',
                'title'          => esc_html__('Pagination Space', 'education-pro'),
            ),
            array(
                'id'       => 'pagination_bg_color',
                'type'     => 'color',
                'output'   => array( 
                    'background-color' => '.tx-pagination a,.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span,.post-type-archive-lp_course .learn-press-pagination .page-numbers>li a'
                ),
                'title'    => esc_html__( 'Background color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'pagination_bg_hover_color',
                'type'     => 'color',
                'output'   => array( 
                    'background-color' => '.tx-pagination a:hover,.post-type-archive-lp_course .learn-press-pagination .page-numbers>li a:hover',
                    'border-color' => '.tx-pagination a:hover,.post-type-archive-lp_course .learn-press-pagination .page-numbers>li a:hover'
                     ),
                'title'    => esc_html__( 'Background hover color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'pagination_active_bg_color',
                'type'     => 'color',
                'output'   => array( 
                    'background-color' => '.tx-pagination span,.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,.post-type-archive-lp_course .learn-press-pagination .page-numbers>li span',
                    'border-color' => '.tx-pagination span,.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,.post-type-archive-lp_course .learn-press-pagination .page-numbers>li span' 
                ),
                'title'    => esc_html__( 'Current Page background color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'pagination_color',
                'type'     => 'color',
                'output'   => array( '.tx-pagination a,.post-type-archive-lp_course .learn-press-pagination .page-numbers>li a' ),
                'title'    => esc_html__( 'Number Color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'pagination_hover_color',
                'type'     => 'color',
                'output'   => array( '.tx-pagination a:hover,.post-type-archive-lp_course .learn-press-pagination .page-numbers>li a:hover' ),
                'title'    => esc_html__( 'Number Hover color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
            array(
                'id'       => 'pagination_active_color',
                'type'     => 'color',
                'output'   => array( 
                    'color' => '.tx-pagination span,.post-type-archive-lp_course .learn-press-pagination .page-numbers>li span',
                    'border-color' => '.tx-pagination span',
                ),
                'title'    => esc_html__( 'Current Page Number color', 'education-pro' ),
                'validate' => 'color',
                'transparent' => false,
            ),
    )));
    
    // -> START custom css
    Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'Custom CSS', 'education-pro' ),
            'id'         => 'css-code',
            'icon'  => 'el el-css',
            'fields'     => array(
                array(
                    'id'       => 'custom_css',
                    'type'     => 'ace_editor',
                    'title'    => esc_html__( 'Additonal CSS', 'education-pro' ),
                    'mode'     => 'css',
                    'theme'    => 'monokai',
                    'desc'     =>  esc_html__('After add the css code please use "!important" to make the code working properly.', 'education-pro'),
                    
                ),
            ),
        ) );
    // -> START custom javascript
    Redux::setSection( $opt_name, array(
            'title'      => esc_html__( 'Custom JS', 'education-pro' ),
            'id'         => 'js-code',
            'icon'  => 'fa fa-code',
            'fields'     => array(
                array(
                    'id'       => 'custom_js_head',
                    'title'    => esc_html__( 'JavaScript on Head', 'education-pro' ),
                    'type'     => 'ace_editor',
                    'mode'     => 'html',
                    'theme'    => 'monokai',
                    'desc'     => esc_html__( 'Script will be placed on before </head> tag', 'education-pro' ),
                ),
                array(
                    'id'       => 'custom_js_footer',
                    'title'    => esc_html__( 'JavaScript on Footer', 'education-pro' ),
                    'type'     => 'ace_editor',
                    'mode'     => 'html',
                    'theme'    => 'monokai',
                    'desc'     => esc_html__( 'Script will be placed on before </body> tag', 'education-pro' ),
                ),
            ),
        ) );

    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }
    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;
            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }
            $return['value'] = $value;
            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }
            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }
            return $return;
        }
    }
    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }
    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'education-pro' ),
                'desc'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'education-pro' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );
            return $sections;
        }
    }
    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;
            return $args;
        }
    }
    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';
            return $defaults;
        }
    }
    
    /* ---------------------------------------------------------
     Remove Redux Notice
    ------------------------------------------------------------ */
    if ( ! class_exists( 'reduxNewsflash' ) ):
        class reduxNewsflash {
            public function __construct( $parent, $params ) {}
        }
    endif;
    /* ---------------------------------------------------------
     Remove Redux Ads
    ------------------------------------------------------------ */
    add_filter( 'redux/tx/aURL_filter', '__return_empty_string' );
    /* ---------------------------------------------------------
    Remove Redux from Tools
    ------------------------------------------------------------ */
    add_action('admin_menu', 'tx_remove_redux_menu', 12);
    function tx_remove_redux_menu() {
        remove_submenu_page('tools.php', 'redux-framework');
    }

    
/* ==============================================================================
          EOF
================================================================================ */