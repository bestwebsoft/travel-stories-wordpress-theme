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
	$args     = array(
		'before_widget' => '<div class="widget %s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="Widget_title">',
		'after_title'   => '</h2>',
	);
	$instance = array();
	the_widget( 'WP_Widget_Meta', $instance, $args );
	the_widget( 'WP_Widget_Calendar', $instance, $args );
	the_widget( 'WP_Widget_Search', $instance, $args );
}
