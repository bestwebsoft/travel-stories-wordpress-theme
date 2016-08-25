<?php
/* Travel Stories functions and definitions
	Sets up the theme and provides some helper functions, which are used in the
	theme as custom template tags. Others are attached to action
	hook in WordPress to change core functionality.

	Functions that are not pluggable (not wrapped in function_exists()) are
	instead attached to a filter or action hook.

	For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API

	@subpackage Travel Stories
	@since Travel Stories 1.0 */

if ( ! isset( $content_width ) ) {
	$content_width = 1600;
}

function travel_stories_setup() {
	/* Makes Travel Stories available for translation.
		 Translations can be added to the /languages/ directory. */
	load_theme_textdomain( 'travel-stories', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	/* Adds RSS feed links to <head> for posts and comments. */
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	/* Adding custom header */
	$headerdefaults = array(
		'default-image'          => '',
		'width'                  => 1920,
		'height'                 => 300,
		'flex-width'             => false,
		'flex-height'            => false,
		'random-default'         => false,
		'header-text'            => true,
		'default-text-color'     => 'fff',
		'uploads'                => true,
		'wp-head-callback'       => 'travel_stories_header_style',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);

	/* Add theme support for Custom Background */
	$background_args = array(
		'default-color'          => 'e7eaef',
		'default-image'          => '',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);

	add_theme_support( 'custom-header', $headerdefaults );
	add_theme_support( 'custom-background', $background_args );
	/* Size for slider */
	add_image_size( 'travel_stories_slider', 2000, 1000, array( 'center', 'center' ) );
	/* Size for post */
	add_image_size( 'travel_stories_post', 700, 600, array( 'center', 'center' ) );
	/* Size for featured */
	add_image_size( 'travel_stories_featured', 1400, 700, array( 'center', 'center' ) );
	/* Styles the visual editor with editor-style.css */
	add_editor_style();
	register_nav_menu( 'header-menu', __( 'Header Menu', 'travel-stories' ) );
}

/* Styles the header image and text displayed on the blog */
function travel_stories_header_style() {
	$text_color   = get_header_textcolor();
	$display_text = display_header_text();

	if ( HEADER_TEXTCOLOR == $text_color ) { /* If no custom options for text are set, return default. */
		return;
	}
	/* If optins are set, we use them */ ?>
	<style type="text/css">
		/* Set custom header background */
		.travel-stories-header-head {
			background: url('<?php header_image() ?>') no-repeat top center;
		}

		<?php if ( 'blank' != $text_color ) { ?>
			.travel-stories-logo-text h1 a,
			#site-description,
			.travel-stories-logo-text-post h1 a {
				color: <?php echo '#' . $text_color; ?> !important;
			}
		<?php }
		if ( ! $display_text ) { /* Display text or not */ ?>
			.travel-stories-logo-text h1 a,
			.travel-stories-logo-text-post h1 a,
			#site-description {
				display: none;
			}
		<?php } ?>
	</style>
<?php }

/* Register our sidebars and widgetized areas. */
function travel_stories_sidebar_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Content sidebar', 'travel-stories' ),
		'id'            => 'content_sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="Widget_title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer widget area', 'travel-stories' ),
		'id'            => 'footer_sidebar',
		'before_widget' => '<div class="footer_widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="footer_title">',
		'after_title'   => '</h3>',
	) );
}

/* Proper way to enqueue scripts and styles */
function travel_stories_scripts() {
	if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_style( 'travel_stories_style', get_stylesheet_uri() );
	wp_enqueue_script( 'travel_stories_script', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ) );
	wp_enqueue_script( 'travel_stories_script_1', get_template_directory_uri() . '/js/jssor.js', array( 'jquery' ) );
	wp_enqueue_script( 'travel_stories_script_2', get_template_directory_uri() . '/js/jssor.slider.js', array( 'jquery' ) );
}

/* Adds a box to the main column on the Post and Page edit screens. Slider and Featured post*/
function travel_stories_add_meta_box() {
	add_meta_box(
		'travel_stories_sectionid',
		__( 'Slider box', 'travel-stories' ),
		'travel_stories_meta_box_callback',
		'post'
	);
	add_meta_box(
		'travel_stories_featured_sectionid',
		__( 'Featured box', 'travel-stories' ),
		'travel_stories_featured_box_callback',
		'post'
	);
}

/* Prints the box content.

	 @param WP_Post $post The object for the current post/page. */

function travel_stories_meta_box_callback( $post ) {
	/* Add an nonce field so we can check for it later. */
	wp_nonce_field( 'travel_stories_meta_box', 'travel_stories_meta_box_nonce' );
	/* Use get_post_meta() to retrieve an existing value
		 from the database and use the value for the form. */
	$value = get_post_meta( $post->ID, '_travel_stories_slider', true ); ?>
	<label for="travel_stories_slider_field">
		<?php _e( 'Display this post in the Slider', 'travel-stories' ); ?>
	</label>
	<input type="checkbox" id="travel_stories_slider_field" name="travel_stories_slider_field" value="1" <?php checked( $value, 1 ); ?> />
	<?php
}

/* Prints the box content.

	 @param WP_Post $post The object for the current post. */

function travel_stories_featured_box_callback( $post ) {
	/* Add an nonce field so we can check for it later. */
	wp_nonce_field( 'travel_stories_featured_box', 'travel_stories_featured_box_nonce' );
	/* Use get_post_meta() to retrieve an existing value
		 from the database and use the value for the form. */
	$value = get_post_meta( $post->ID, '_travel_stories_featured', true ); ?>
	<label for="travel_stories_featured_field">
		<?php _e( 'Display this post in the Featured block', 'travel-stories' ); ?>
	</label>
	<input type="checkbox" id="travel_stories_featured_field" name="travel_stories_featured_field" value="1" <?php checked( $value, 1 ); ?> />
	<?php
}

/* When the post is saved, saves our custom data.
	 @param int $post_id The ID of the post being saved. */

function travel_stories_save_meta_box_data( $post_id ) {
	/* We need to verify this came from our screen and with proper authorization,
		 because the save_post action can be triggered at other times. */
	/* Check if our nonce is set. */
	if ( ! isset( $_POST['travel_stories_meta_box_nonce'] ) && ! isset( $_POST['travel_stories_featured_box_nonce'] ) ) {
		return;
	}
	/* If this is an autosave, our form has not been submitted, so we don't want to do anything. */
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['travel_stories_meta_box_nonce'] ) ) {
		/* Verify that the nonce is valid. */
		if ( ! wp_verify_nonce( $_POST['travel_stories_meta_box_nonce'], 'travel_stories_meta_box' ) ) {
			return;
		}
		/* OK, it's safe for us to save the data now.
			 Make sure that it is set. */
		if ( isset( $_POST['travel_stories_slider_field'] ) ) {
			/* Update the meta field in the database. */
			update_post_meta( $post_id, '_travel_stories_slider', '1' );
		} else {
			if ( get_post_meta( $post_id, '_travel_stories_slider', true ) == '1' ) {
				delete_post_meta( $post_id, '_travel_stories_slider' );
			}
		}
	}
	if ( isset( $_POST['travel_stories_featured_box_nonce'] ) ) {
		/* Verify that the nonce is valid. */
		if ( ! wp_verify_nonce( $_POST['travel_stories_featured_box_nonce'], 'travel_stories_featured_box' ) ) {
			return;
		}
		/* OK, it's safe for us to save the data now.
			 Make sure that it is set. */
		if ( isset( $_POST['travel_stories_featured_field'] ) ) {
			/* Update the meta field in the database. */
			update_post_meta( $post_id, '_travel_stories_featured', '1' );
		} else {
			if ( get_post_meta( $post_id, '_travel_stories_featured', true ) == '1' ) {
				delete_post_meta( $post_id, '_travel_stories_featured' );
			}
		}
	}
}

/* Customize comments */
function travel_stories_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<div id="comment-<?php comment_ID(); ?>" class="comment-body">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, '74' ); ?>
			<cite class="fn">
				<?php echo get_comment_author_link(); ?>
			</cite>
			<span class="says"></span>
		</div>
		<!-- .comment-author.vcard -->
		<?php if ( '0' == $comment->comment_approved ) :
			__( 'Your comment is awaiting moderation', 'travel-stories' );
		endif; ?>
		<div class="comment-meta commentmetadata">
			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( '%1$s in %2$s', get_comment_date(), get_comment_time() ); ?></a>
			<?php edit_comment_link( __( 'Edit', 'travel-stories' ) ); ?>
		</div>
		<!-- .comment-meta.commentmetadata -->
		<div class="comment-content">
			<?php comment_text(); ?>
		</div>
		<!-- .comment-content -->
		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array(
				'depth'     => $depth,
				'max_depth' => $args['max_depth'],
			) ) ); ?>
		</div>
		<!-- .reply -->
	</div>
	<!-- #comment -->
<?php }

/* To change excerpt length */
function travel_stories_excerpt_length( $length ) {
	return 33;
}

function travel_stories_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'travel_stories_attachment_size', array(
		810,
		810,
	) ); // Filter the default Daily Stories attachment size.
	$next_attachment_url = wp_get_attachment_url();
	$attachment_ids      = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => - 1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	if ( count( $attachment_ids ) > 1 ) { // If there is more than 1 attachment in a gallery...
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}
		if ( ! empty( $next_id ) ) { // get the URL of the next image attachment...
			$next_attachment_url = get_attachment_link( $next_id );
		} else {  // or get the URL of the first image attachment.
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}
	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}

/* To change name post length */
function travel_stories_short_title( $maxchar = 70 ) {
	$title = get_the_title();

	if ( mb_strlen( $title ) < $maxchar ) {
		return $title;
	}

	$title = mb_substr( $title, 0, $maxchar );

	return $title;
}

add_action( 'after_setup_theme', 'travel_stories_setup' );
add_action( 'widgets_init', 'travel_stories_sidebar_widgets_init' );
add_action( 'wp_enqueue_scripts', 'travel_stories_scripts' );
add_action( 'add_meta_boxes', 'travel_stories_add_meta_box' );
add_action( 'save_post', 'travel_stories_save_meta_box_data' );
add_filter( 'excerpt_length', 'travel_stories_excerpt_length', 999 );
add_action( 'travel_stories_the_attached_image', 'travel_stories_the_attached_image' );
