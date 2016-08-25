<?php /**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @link       http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage Travel Stories
 * @since      Travel Stories 1.0
 */
if ( post_password_required() ) { /*check for password verification*/
	return;
}
if ( have_comments() || comments_open() ) : ?>
	<article id="comments" class="comments-area">
		<?php if ( have_comments() ) : ?>
			<h2 class="comments-title">
				<?php printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'travel-stories' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?>
			</h2>
			<ul class="commentlist">
				<?php wp_list_comments( array( 'style' => 'ul', 'callback' => 'travel_stories_comment' ) ); ?>
			</ul><!-- .commentlist -->
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : /* are there comments to navigate through*/ ?>
				<nav id="comment-nav" class="comment-navigation" role="navigation">
					<div class="nav-previous">
						<?php previous_comments_link( '&laquo;' . __( 'Previous Comments', 'travel-stories' ) ); ?>
					</div>
					<div class="nav-next">
						<?php next_comments_link( __( 'Next Comments', 'travel-stories' ) . '&raquo;' ); ?>
					</div>
				</nav><!-- #comment-nav .comment-navigation-->
			<?php endif; /* check for comment navigation */
		endif; /* have_comments() */
		if ( comments_open() ) :
			$args = array(
				'comment_notes_after' => '<p class="form-allowed-tags">' . __( 'You may use these', 'travel-stories' ) . '<abbr title="HyperText Markup Language"> HTML </abbr>' . __( 'tags and attributes', 'travel-stories' ) . ':' . ' <pre>' . allowed_tags() . '</pre>' . '</p>',
			);
			comment_form( $args ); /*custom comment form*/
		else : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'travel-stories' ); ?></p>
		<?php endif; ?><!-- comments_open() -->
	</article><!-- #comments .comments-area-->
<?php elseif ( is_single() ) : ?>
<article class="comments-area">
	<p class="no-comments"><?php _e( 'Comments are closed.', 'travel-stories' ); ?></p>
</article>
<?php endif; /* have_comments() || comments_open() */
