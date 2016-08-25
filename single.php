<?php /**
 * The template for displaying all single posts
 *
 * @subpackage Travel Stories
 * @since      Travel Stories 1.0
 */
get_header(); ?>
	<div class="travel-stories-container">
		<?php if ( have_posts() ) {
			the_post(); ?>
			<article class="travel-stories-single-chief-post">
				<div class="travel-stories-single-header-post">
					<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'featured_image' );
					} ?>
					<div class="test">
						<div class="travel-stories-single-post-blackout"></div>
						<p class="travel-stories-single-category">
							<?php $category = get_the_category();
							if ( $category ) {
								echo '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>';
							} ?>
						</p>
						<div class="travel-stories-single-post-name">
							<?php the_title( '<span>', '</span>' ); ?>
						</div>
						<?php $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>', esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ), esc_attr( the_title_attribute( 'echo=0' ) ), esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) ); ?>
						<p class="travel-stories-single-post-date"><?php echo $date; ?></p>
						<p class="travel-stories-single-post-author"> <?php the_author_posts_link(); ?></p>
					</div>
					<div class="clear"></div>
				</div>
				<div class="travel-stories-single-content">
					<div class="travel-stories-single-content-text">
						<?php the_content( ' ' ); ?>
						<div class="travel-stories-page-links">
							<?php wp_link_pages(); ?>
						</div>
						<?php if ( has_category() ) : ?>
							<div class="travel-stories-category-box">
								<p> <?php echo __( 'Categories:', 'travel-stories' ) . '&nbsp;';
									the_category( ', ' ); ?></p>
							</div>
						<?php endif; ?>
						<?php if ( has_tag() ) : ?>
							<div class="travel-stories-tag-box">
								<p> <?php the_tags( __( 'Tags:', 'travel-stories' ) . '&nbsp;', ', ', '.' ) ?></p>
							</div>
						<?php endif; ?>
						<div class="clear"></div>
					</div>
				</div>
			</article>
		<?php }
		wp_reset_postdata(); ?>
		<div class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'travel-stories' ), '<span class="travel-stories-edit-link">', '</span>' ); ?>
		</div>
		<!--.entry-meta-->
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
					</article>
				<?php }
			} ?>
		</div>
		<?php wp_reset_postdata(); ?>
		<!-- travel-stories-single-posts -->
		<div class="clear"></div>
		<nav class="travel-stories-single-block-previous-next-story">
			<div class="travel-stories-single-previous-story">
				<?php previous_post_link( __( 'previous story', 'travel-stories' ) . '<p>%link</p>' ); ?>
			</div>
			<div class="travel-stories-single-next-story">
				<?php next_post_link( __( 'next story', 'travel-stories' ) . '<p>%link</p>' ); ?>
			</div>
		</nav>
		<div class="clear"></div>
		<div class="travel-stories-single-comment">
			<?php comments_template(); ?>
		</div>
	</div>
<?php get_footer();
