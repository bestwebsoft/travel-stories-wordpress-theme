<?php /**
 * The sidebar containing the main widget area
 *
 * Displays on posts and pages.
 *
 * If no active widgets are in this sidebar, hide it completely.
 *
 * @subpackage Travel Stories
 * @since      Travel Stories 1.0
 */
if ( is_active_sidebar( 'content_sidebar' ) ) {
	dynamic_sidebar( 'content_sidebar' );
} else { /*If sidebar no active display next widget */
	the_widget( 'WP_Widget_Meta' );
	the_widget( 'WP_Widget_Calendar' );
	the_widget( 'WP_Widget_Search' );
}