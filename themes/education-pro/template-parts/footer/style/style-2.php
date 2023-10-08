<?php
/**
* 
* @package tx
* @author theme_x
* 
*
* Footer Style 2
*
*/
global $tx;
?>
<div class="container footer-style-2">
    <div class="row">
<div class="col-md-4 col-xs-12">
    <div class="row">
    <!-- social link start -->
    <?php if ( class_exists( 'ReduxFramework' ) ) : ?>
        <?php if($tx['social_icons_footer'])  : ?>
            
        <?php if ($tx['social']) { ?>
        <div class="social_media"> 
            <?php if (function_exists('tx_social_media')) :
                    echo tx_social_media(); 
            endif;
            ?>
        </div>
        <?php }
        endif; 
    endif ?> <!-- social link end -->
</div>
</div>
<div class="col-md-4 col-xs-12">
    <div class="copyright">
    <?php  if ( class_exists( 'ReduxFramework' ) ) { ?>
        <p><?php echo wp_kses_post($tx['copyright']); ?></p>
    <?php } else { ?>
        <p>Copryright &copy; <?php echo date("Y"); ?>, By <a href="https://themeforest.net/user/theme-x">theme-x</a> | All rights reserved.</p>
    <?php } ?>
    </div>
</div>

<div class="col-md-4 col-xs-12">
    <div class="row">
    <!-- footer menu start -->
    <?php 
    if ( class_exists( 'ReduxFramework' ) ) : 
        if($tx['footer-menu'])  : 
        	if ( has_nav_menu( 'footer_menu' ) ) {
            	wp_nav_menu( array(
                    'theme_location' => 'footer_menu',
                    'menu_class'     => 'footer-menu',
                    'depth'          => 1,
                    ) );
            }
        endif; 
    endif; ?><!-- footer menu end -->
    </div>
</div>



    </div> <!-- /.row -->
</div><!-- /.container -->