<?php
/**
* 
* @package tx
* @author theme_x
* 
*
* Right Menu
*
**/
					if ( has_nav_menu( 'right_menu' ) ) {
	                    wp_nav_menu( array(
	                    'theme_location' => 'right_menu',
	                    'menu_class'     => 'nav navbar-nav main-menu tx-mega-menu',
	                    'depth'          => 5,
	                    ) );
	                } ?>