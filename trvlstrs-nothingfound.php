<?php /**
 * The template for displaying help content
 * if post(s) or page not found.
 *
 * @subpackage Travel Stories 1.0
 * @since      Travel Stories 1.0
 */ ?>
<article id="post-0" <?php post_class(); ?>>
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
		<div class="entry">
			<p><?php _e( 'Ready to publish your first post?', 'travel-stories' ); ?>
				<a href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>"><?php _e( 'Get started here', 'travel-stories' ) ?></a>
			</p>
		</div><!-- .entry -->
	<?php elseif ( is_search() ) : ?>
		<div class="entry">
			<p><?php _e( 'Sorry, but no results match your search query. Please try again with some different keywords.', 'travel-stories' ); ?></p>
		</div>
		<?php get_search_form();
	else : ?>
		<div class="entry">
			<p><?php _e( 'The page you are looking for is not found. Maybe try a search?', 'travel-stories' ); ?></p>
		</div>
		<?php get_search_form();
	endif; ?>
</article>