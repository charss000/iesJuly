<?php
/**
* 
* @package tx
* @author theme_x
* 
*===========================
* Default Page template
*===========================
*/

global $tx;

get_header();

?>

<div class="container space-content">
	<div class="row">
    	<?php tx_content_page(); ?>


<?php get_footer();