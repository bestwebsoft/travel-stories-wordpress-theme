<?php /**
 * The footer sidebar containing the main widget area
 *
 * Displays on widgets.
 *
 * If no active widgets are in this footer sidebar, hide it completely.
 *
 * @subpackage Travel Stories
 * @since      Travel Stories 1.0
 */
if ( is_active_sidebar( 'footer_sidebar' ) ) {
	dynamic_sidebar( 'footer_sidebar' );
} else { /*If sidebar no active display next widget */
	$args     = array(
		'before_widget' => '<div class="footer_widget %s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="footer_title">',
		'after_title'   => '</h3>',
	);
	$instance = array();
	the_widget( 'WP_Widget_Archives', $instance, $args );
	the_widget( 'WP_Widget_Categories', $instance, $args );
	the_widget( 'WP_Widget_Recent_Posts', $instance, $args );
	the_widget( 'WP_Widget_Recent_Comments', $instance, $args );
}
