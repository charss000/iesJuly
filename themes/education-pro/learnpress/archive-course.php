<?php
/**
 * Template for displaying content of archive courses page.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

defined( 'ABSPATH' ) || exit;


/**
 * @since 4.0.0
 *
 * @see LP_Template_General::template_header()
 */
do_action( 'learn-press/template-header' );
?>
</div>
<div class="row">
<div class="container">


<?php
/**
 * LP Hook
 */
do_action( 'learn-press/before-main-content' );
?>

<div class="lp-content-area">
	<div class="row">

	<div class="col-lg-9 col-md-12">

	<?php
	/**
	 * LP Hook
	 */
	do_action( 'learn-press/before-courses-loop' );
	LP()->template( 'course' )->begin_courses_loop();

	if ( LP_Settings_Courses::is_ajax_load_courses() && ! LP_Settings_Courses::is_no_load_ajax_first_courses() ) {
		echo '<div class="lp-archive-course-skeleton" style="width:100%">';
		echo lp_skeleton_animation_html( 10, 'random', 'height:20px', 'width:100%' );
		echo '</div>';
	} else {
		if ( have_posts() ) {
			while ( have_posts() ) :
				the_post();

				learn_press_get_template_part( 'content', 'course' );

			endwhile;
		} else {
			LP()->template( 'course' )->no_courses_found();
		}

		if ( LP_Settings_Courses::is_ajax_load_courses() ) {
			echo '<div class="lp-archive-course-skeleton no-first-load-ajax" style="width:100%; display: none">';
			echo lp_skeleton_animation_html( 10, 'random', 'height:20px', 'width:100%' );
			echo '</div>';
		}
	}

	LP()->template( 'course' )->end_courses_loop();
?>
	</div>


<?php if (is_active_sidebar('archive-courses-sidebar')) : ?>
	<div id="secondary" class="col-lg-3 col-md-6 lp-sidebar">
	<?php dynamic_sidebar('archive-courses-sidebar'); ?>
	</div><!-- sidebar -->
<?php endif; ?>

</div>
<?php
	/**
	 * @since 3.0.0
	 */
	do_action( 'learn-press/after-courses-loop' );


	/**
	 * LP Hook
	 */
	do_action( 'learn-press/after-main-content' );

	/**
	 * LP Hook
	 *
	 * @since 4.0.0
	 */
	//do_action( 'learn-press/sidebar' );
	?>

</div>
</div></div>
<?php
/**
 * @since 4.0.0
 *
 * @see   LP_Template_General::template_footer()
 */
do_action( 'learn-press/template-footer' );
