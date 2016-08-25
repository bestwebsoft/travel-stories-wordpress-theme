<?php /**
 * The template for displaying Archive pages
 *
 * @link       http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage Travel Stories
 * @since      Travel Stories 1.0
 */
get_header(); ?>
	<div class="travel-stories-page-content">
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>
				<article class="travel-stories-page-post">
					<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'travel_stories_post' );
						} ?>
					</a>
					<div class="travel-stories-page-post-name">
						<h1>
							<a class="travel-stories-post-name" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e( 'Permanent Link to ', 'travel-stories' );
							the_title_attribute(); ?>">
								<?php echo travel_stories_short_title( 70 ); ?>
							</a>
						</h1>
					</div>
					<p class="travel-stories-page-author"><?php the_author_posts_link(); ?></p>
					<p class="travel-stories-page-category"> <?php the_category( ',' ) ?></p>
					<div class="travel-stories-page-excerpt">
						<?php the_excerpt(); ?>
					</div>
					<a class="travel-stories-page-more" href="<?php echo get_permalink(); ?>"><?php _e( 'Learn More', 'travel-stories' ); ?></a>
				</article>
			<?php endwhile; ?>
			<div class="clear"></div>
			<nav class="travel-stories-single-block-previous-next-story">
				<div class="travel-stories-single-previous-story">
					<?php previous_posts_link( '&laquo;&nbsp;' . __( 'previous stories', 'travel-stories' ) ); ?>
				</div>
				<div class="travel-stories-single-next-story">
					<?php next_posts_link( __( 'next stories', 'travel-stories' ) . '&nbsp;&raquo;' ); ?>
				</div>
			</nav>
		<?php else :
			get_template_part( 'trvlstrs', 'nothingfound' );
		endif;/* have_posts() */
		wp_reset_postdata(); ?>
	</div>
	<div class="clear"></div>
<?php get_footer();
