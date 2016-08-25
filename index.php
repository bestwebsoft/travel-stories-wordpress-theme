<?php /**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 *
 * @subpackage Travel Stories
 * @since      Travel Stories 1.0
 */
get_header(); ?>
	<div class="travel-stories-container">
		<div class="travel-stories-content">
			<?php global $query_string;
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post(); ?>
					<article <?php post_class( 'travel-stories-post' ); ?> >
						<a href="<?php the_permalink(); ?>">
							<div class="travel-stories-post-blackout"></div>
						</a>
						<p class="travel-stories-category">
							<?php $category = get_the_category();
							if ( $category ) {
								echo '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>';
							} ?>
						</p>
						<h1>
							<a class="travel-stories-post-name" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e( 'Permanent Link to ', 'travel-stories' );
							the_title_attribute(); ?>">
								<?php echo travel_stories_short_title( 70 ); ?>
							</a>
						</h1>
						<div class="travel-stories-post-line"></div>
						<?php $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>', esc_url( get_permalink() ), esc_attr( sprintf( __( 'Permalink to %s', 'travel-stories' ), the_title_attribute( 'echo=0' ) ) ), esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date( 'F j, Y' ) ) ); ?>
						<p class="travel-stories-post-date"><?php echo $date; ?></p>
						<p class="travel-stories-post-author"><?php the_author_posts_link(); ?></p>
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'travel_stories_post' );
						} ?>
					</article><!-- #post -->
				<?php } ?>
				<div class="clear"></div>
				<nav class="travel-stories-single-block-previous-next-story">
					<div class="travel-stories-single-previous-story">
						<?php previous_posts_link( '&lsaquo;' ); ?>
					</div>
					<div class="travel-stories-single-next-story">
						<?php next_posts_link( '&rsaquo;' ); ?>
					</div>
				</nav>
			<?php } ?>
		</div>
		<div class="clear"></div>
		<?php $travel_stories_posts_line = new WP_Query( array(
			'posts_per_page'      => 1,
			'post_type'           => 'post',
			'meta_key'            => '_travel_stories_featured',
			'meta_value'          => 1,
			'ignore_sticky_posts' => 1,
		) );
		if ( $travel_stories_posts_line->have_posts() ) { ?>
			<article class="travel-stories-featured-post">
				<?php $travel_stories_posts_line->the_post(); ?>
				<div class="travel-stories-featured-post-banner">
					<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'travel_stories_featured' );
					} ?>
					<div class="travel-stories-featured-post-blackout"></div>
				</div>
				<div class="travel-stories-featured-post-column">
					<p class="travel-stories-featured-category"><?php the_category( ',' ) ?></p>
					<h5>
						<a class="travel-stories-featured-post-name" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php _e( 'Permanent Link to ', 'travel-stories' );
						the_title_attribute(); ?>">
							<?php the_title(); ?>
						</a>
					</h5>
					<div class="travel-stories-featured-content">
						<?php the_excerpt(); ?>
					</div>
					<a class="travel-stories-more-futured" href="<?php echo get_permalink(); ?>"><?php _e( 'Learn More', 'travel-stories' ); ?></a>
				</div>
			</article>
		<?php }
		wp_reset_postdata(); ?>
	</div>
	<aside class="travel-stories-sidebar-widget">
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</aside>
<?php get_footer();
