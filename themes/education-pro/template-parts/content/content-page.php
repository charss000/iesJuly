<?php
/**
* 
* @package tx
* @author theme_x
* 
*
*
*/
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'education-pro'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->
</div><!-- #post-## -->