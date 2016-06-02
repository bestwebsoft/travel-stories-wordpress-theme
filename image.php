<?php /**
 * The template for image attachments
 *
 * @subpackage Travel Stories
 * @since      Travel Stories 1.0
 */
get_header(); ?>
	<div class="travel-stories-container">
		<?php if ( have_posts() ) {
			the_post(); ?>
			<article class="travel-stories-image-post">
				<div class="travel-stories-image-header-post">
					<?php do_action( 'travel_stories_the_attached_image' ); ?>
					<div class="clear"></div>
					<div class="travel-stories-image-post-name">
						<a><?php the_title(); ?></a>
					</div>
				</div>
				<div class="travel-stories-single-content-text">
					<div class="travel-stories-caption-text">
						<?php the_excerpt(); ?>
					</div>
					<div class="travel-stories-single-content">
						<div class="travel-stories-image-content">
							<?php the_content( ' ' ); ?>
						</div>
						<div class="travel-stories-page-links">
							<?php wp_link_pages(); ?>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</article>
		<?php }
		wp_reset_postdata(); ?>
		<nav class="travel-stories-single-block-previous-next-story">
			<div class="travel-stories-single-previous-story">
				<?php previous_image_link( false, '&laquo;&nbsp;' . __( 'previous image', 'travel-stories' ) ); ?>
			</div>
			<div class="travel-stories-single-next-story">
				<?php next_image_link( false, __( 'next image', 'travel-stories' ) . '&nbsp;&raquo;' ); ?>
			</div>
		</nav>
		<div class="clear"></div>
		<div class="travel-stories-single-comment">
			<?php comments_template(); ?>
		</div>
	</div>
<?php get_footer();
