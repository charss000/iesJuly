<?php
/**
* 
* @package tx
* @author theme_x
* 
* ============================
*       Page Sidebar Left
* ============================
*/
global $tx;

	  if (is_active_sidebar('sidebar-page-left')) : ?>
		<div id="secondary" class="widget-area col-lg-4 col-md-6 col-sm-12" role="complementary">
	        <?php dynamic_sidebar('sidebar-page-left'); ?>
		</div><!-- #secondary -->
	<?php endif;
