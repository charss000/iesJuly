<?php
/**
* 
* header style 4
*
*/
global $tx;
?>

<?php if ($tx['header_on_off']) : ?>
<div class="header-style-four">
    <div class="menu-bar"> <!-- menu bar -->
            <div class="container<?php echo tx_header_layout(); ?>">
                <div class="row">
                    <!-- Main Menu -->  
                    <?php get_template_part( 'template-parts/header/menu/main', 'menu' ); ?>
                    <div class="menu-area-right">
                    <!-- Side menu -->
                    <?php get_template_part( 'template-parts/header/menu/side', 'menu' ); ?>
                    <!-- Search icon -->
                    <?php do_action('tx_search_icon'); ?>
                    <!-- Cart icon -->
                    <?php do_action('tx_cart_icon'); ?>
                    <!-- Menu Button -->
                    <?php do_action('tx_menu_btn'); ?>
                    </div><!-- /.menu-area-righ -->
                </div> <!-- /.row -->
            </div><!-- /.container -->
    </div><!-- /.menu-bar -->

    <div id="h-style-4" class="main-header">
    	<div class="container<?php echo tx_header_layout(); ?>">
    		<!-- logo -->
    	    <div class="col-lg-4 col-sm-12 col-xs-12 i_ls_4 logo-center">
    	        <?php do_action('tx_logo'); ?>
    	    </div><!-- logo end -->
    	</div><!-- /.container -->
    </div><!-- /#h-style-4 -->
</div><!-- header-style-four -->
<?php endif; ?>