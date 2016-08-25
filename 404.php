<?php /**
 * The template for 404 page
 *
 * @subpackage Travel Stories
 * @since      Travel Stories 1.0
 */
get_header(); ?>
<article class="searh-post">
	<div class="travel-stories-page-name">
		<?php _e( '404 error: page not found', 'travel-stories' ); ?>
	</div>
	<div class="travel-stories-page-line"></div>
	<div class="travel-stories-404-content">
		<p><?php _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'travel-stories' ); ?></p>

		<p><?php _e( 'Please try using our search box below to look for the information on the Internet.', 'travel-stories' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</article> <!-- .post -->
<div class="travel-stories-single-posts">
	<?php $travel_stories_posts = new WP_Query( array(
		'posts_per_page'      => 3,
		'post_type'           => 'post',
		'ignore_sticky_posts' => 1,
	) );
	if ( $travel_stories_posts->have_posts() ) {
		while ( $travel_stories_posts->have_posts() ) {
			$travel_stories_posts->the_post(); ?>
			<article class="travel-stories-post">
				<div class="travel-stories-post-blackout"></div>
				<h1>
					<a class="travel-stories-post-name" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e( 'Permanent Link to ', 'travel-stories' );
					the_title_attribute(); ?>">
						<?php the_title(); ?>
					</a>
				</h1>
				<div class="travel-stories-post-line"></div>
				<p class="travel-stories-post-author"><?php the_author_posts_link(); ?></p>
				<p class="travel-stories-category"> <?php the_category( ',' ) ?></p>
				<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'travel_stories_post' );
				} ?>
				<div class="clear"></div>
			</article><!-- .post -->
		<?php }
	}
	wp_reset_postdata(); ?>
</div>
<div class="clear"></div>
<?php get_footer();
