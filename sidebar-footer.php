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
	the_widget( 'WP_Widget_Archives' );
	the_widget( 'WP_Widget_Categories' );
	the_widget( 'WP_Widget_Recent_Posts' );
	the_widget( 'WP_Widget_Recent_Comments' );
}