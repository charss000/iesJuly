<?php
/**
* 
* @package tx
* @author theme_x
*
*
* Template Name: Teachers Full Width
*
*/
global $tx;
get_header();
?>

<div class="container-fluid">
	<div class="row">
		<?php
		global $tx;
		if ( get_query_var('paged') ) :
			  $paged = get_query_var('paged');
		elseif ( get_query_var('page') ) :
		      $paged = get_query_var('page');
		else :
		      $paged = 1;
		endif;
		
		$args = array(
	      'post_type' => 'teacher',
	      'posts_per_page' => $tx['teachers-per-page'],
	      'paged' => $paged
	    );

		$query = new WP_Query( $args ); ?>
  		<?php if ( $query->have_posts() ) : ?>
  	 	
  		
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			<div class="col-lg-2 col-xs-12 col-sm-6">
				<div class="team">
				<figure>
					<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php the_post_thumbnail('tx-tf-thumb'); ?>		
					</a>
					
					<figcaption>
						<h4><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h4>
						<?php
							global $post;
					        $terms = get_the_terms( $post->ID, 'teachers-category' );
					        if ( $terms && ! is_wp_error( $terms ) ) :
					          $taxonomy = array();
					          foreach ( $terms as $term ) :
					            $taxonomy[] = $term->name;
					          endforeach;
					          $cat_name = join( " ", $taxonomy);
					          $cat_link = get_term_link( $term );
					      else:
					      	$cat_name = '';
					      	endif;
						?>
						<?php if(!empty($cat_name)) : ?>
						<p class="team-cat"><a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a></p>
						<?php endif; ?>
						<div class="team-bio"><?php echo tx_excerpt_limit(15); ?></div>
						<ul class="team-social">
							<?php
							$team_fb = get_post_meta( $post->ID, 'team_fb', true );
							$team_tw = get_post_meta( $post->ID, 'team_tw', true );
							$team_gp = get_post_meta( $post->ID, 'team_gp', true );
							$team_ln = get_post_meta( $post->ID, 'team_ln', true );
							$team_in = get_post_meta( $post->ID, 'team_in', true );
							?>
							<?php if($team_fb) : ?>
							<li><a href="<?php echo esc_url($team_fb); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
							<?php endif; ?>
							<?php if($team_tw) : ?>
							<li><a href="<?php echo esc_url($team_tw); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
							<?php endif; ?>
							<?php if($team_gp) : ?>
							<li><a href="<?php echo esc_url($team_gp); ?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
							<?php endif; ?>
							<?php if($team_ln) : ?>
							<li><a href="<?php echo esc_url($team_ln); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
							<?php endif; ?>
							<?php if($team_in) : ?>
							<li><a href="<?php echo esc_url($team_in); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
							<?php endif; ?>
						</ul>
					</figcaption>
					</a>
				</figure>
				</div><!-- team -->
			</div>	<!-- col-md-3 col-xs-12 col-sm-6 -->
		<?php endwhile; ?>
 		
	    
		<?php wp_reset_postdata(); ?>

		<?php else:  ?>
	    <?php get_template_part('template-parts/content/content', 'none'); ?>
	  	<?php endif; ?>
	  	<div class="tx-clear"></div>
	  	<!-- pagination -->
		<?php tx_pagination_number($query->max_num_pages,"",$paged); ?>
		

<?php get_footer(); ?>
