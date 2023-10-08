<?php
/**
* 
* @package tx
* @author theme_x
* 
* 
* Woocommerce Single Sidebar
* 
*/
global $tx;

	  if (is_active_sidebar('sidebar-woo-single')) : ?>
		<div id="secondary" class="widget-area col-lg-3 col-md-6 col-sm-12" role="complementary">
	        <?php dynamic_sidebar('sidebar-woo-single'); ?>
		</div><!-- #secondary -->
	<?php endif;
