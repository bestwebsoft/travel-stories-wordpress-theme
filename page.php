<?php /**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @subpackage Travel Stories
 * @since      Travel Stories 1.0
 */
get_header();
if ( have_posts() ) {
	the_post(); ?>
	<article class="travel-stories-single-chief-post">
		<div class="travel-stories-single-header-post">
			<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'featured_image' );
			} ?>
			<div class="travel-stories-single-post-name">
				<a><?php the_title(); ?></a>
			</div>
			<?php $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>', esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ), esc_attr( the_title_attribute( 'echo=0' ) ), esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) ); ?>
			<p class="travel-stories-single-post-date"><?php echo $date; ?></p>
			<p class="travel-stories-single-post-author"> <?php the_author_posts_link(); ?></p>
			<div class="clear"></div>
		</div>
		<div class="travel-stories-single-content">
			<div class="travel-stories-single-content-text">
				<?php the_content( ' ' ); ?>
				<div class="travel-stories-page-links">
					<?php wp_link_pages(); ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</article>
<?php }
wp_reset_postdata(); ?>
	<div class="travel-stories-single-related-posts-title">
		<p> <?php __( 'Related posts', 'travel-stories' ); ?></p>
		<div class="travel-stories-single-related-posts-title-line"></div>
	</div>
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
					<p class="travel-stories-category"><?php the_category( ',' ) ?></p>
					<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'travel_stories_post' );
					} ?>
					<div class="clear"></div>
				</article><!-- .post -->
			<?php }
		}
		wp_reset_postdata(); ?>
	</div><!-- travel-stories-single-posts -->
	<div class="clear"></div>
	<div class="travel-stories-single-comment">
		<?php comments_template(); ?>
	</div>
<?php get_footer();
