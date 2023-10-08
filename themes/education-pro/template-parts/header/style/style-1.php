<?php
/**
* 
* header style 1
*
*/
global $tx;
?>

<?php if ($tx['header_on_off']) : ?>
<div class="header-style-one">    
    <div id="h-style-1" class="main-header">
        <div class="container<?php echo tx_header_layout(); ?>">
        	<div class="row">
                <!-- logo -->
                <div class="col-lg-3 col-sm-12">
                    <div class="row">
                        <?php do_action('tx_logo'); ?>
                    </div>
                </div><!-- logo end -->
                <div class="col-lg-9 col-sm-12"><!-- banner / business info-->
                    <div class="main-header-right-area row">
                        <?php if($tx['banner-bussiness-switch'] == '1') : ?>
                        <?php tx_head_ads(); ?>
                        <?php endif; ?>
                        <?php if($tx['banner-bussiness-switch'] == '2') : ?>
                        <?php get_template_part( 'template-parts/header/business', 'info' ); ?>
                        <?php endif; ?>
                    </div>
                </div><!-- banner / business info-->
        	</div> <!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /#h-style-1 -->

    <div class="menu-bar"><!-- menu bar -->
        <div class="container<?php echo tx_header_layout(); ?>">
            <div class="row">
                <!-- Main Menu -->	
                <?php //do_action('tx_main_menu'); ?>
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
</div><!-- header-style-one -->
<?php endif; ?>