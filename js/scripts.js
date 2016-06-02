(function( $ ) {
	var travel_stories_search_toggle_none;
	/* Inside of this function, $() will work as an alias for jQuery()
	 and other libraries also using $ will not be accessible under this shortcut*/
	$( document ).ready( function() {
		/* travel_stories show or hide search box*/
		$( '.travel-stories-search-toggle' ).click( function() {
			$( '.travel-stories-search-toggle' ).css( 'display', 'none' );
			$( '#travel_stories_search_container' ).css( 'display', 'block' );
			$( '#travel-stories-search-box' ).focus();
		} );
		$( '#travel-stories-search-box' ).blur( function() {
			$( '#travel_stories_search_container' ).css( 'display', 'none' );
			$( '.travel-stories-search-toggle' ).css( 'display', 'block' );
		} );
		/* travel_stories options for JssorSlider*/
		var travel_stories_options = {
			$DragOrientation:       1, /*[Optional] Orientation to drag slide, 0 no drag, 1 horizontal, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)*/
			$ArrowNavigatorOptions: {
				/*[Optional] Options to specify and enable arrow navigator or not*/
				$Class:        $JssorArrowNavigator$, /*[Required] Class to create arrow navigator instance*/
				$ChanceToShow: 2, /*[Required] 0 Never, 1 Mouse Over, 2 Always*/
				$AutoCenter:   0, /*[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0*/
				$Steps:        1                                       /*[Optional] Steps to go for each navigation request, default value is 1*/
			}
		};
		/* travel_stories show menu box*/
		$( '#travel-stories-menu-toogle' ).click( function() {
			if ( $( 'div' ).is( '#travel_stories_page_wrapper' ) ) {
				$( '#travel_stories_page_wrapper' ).find( '.travel-stories-site-main-navigation' ).toggleClass( 'travel-stories-toggled-menu-on' );
			} else {
				if ( $( "div" ).is( "#travel_stories_single_wrapper" ) ) {
					$( '#travel_stories_single_wrapper' ).find( '.travel-stories-site-main-navigation' ).toggleClass( 'travel-stories-toggled-menu-on' );
				} else {
					$( '#travel_stories_wrapper' ).find( '.travel-stories-site-main-navigation' ).toggleClass( 'travel-stories-toggled-menu-on' );
				}
			}
		} );
		/* travel_stories close menu box*/
		$( '#travel_stories_close_menu' ).click( function() {
			if ( $( "div" ).is( "#travel_stories_page_wrapper" ) ) {
				$( '#travel_stories_page_wrapper' ).find( '.travel-stories-site-main-navigation' ).removeClass( 'travel-stories-toggled-menu-on' );
			} else {
				if ( $( "div" ).is( "#travel_stories_single_wrapper" ) ) {
					$( '#travel_stories_single_wrapper' ).find( '.travel-stories-site-main-navigation' ).removeClass( 'travel-stories-toggled-menu-on' );
				} else {
					$( '#travel_stories_wrapper' ).find( '.travel-stories-site-main-navigation' ).removeClass( 'travel-stories-toggled-menu-on' );
				}
			}
		} );
		/* travel_stories theme slider */
		if ( $( 'body' ).hasClass( 'home' ) ) {
			if ( typeof slider !== "undefined" ) {
				var travel_stories_jssor_slider = new $JssorSlider$( 'slider', travel_stories_options );
			}
		}

// 		$( '.travel-stories-content' ).on( 'click', '.travel-stories-single-block-previous-next-story a', function ( e ) {
// 			e.preventDefault();
// 			var link = $( this ).attr( 'href' );
// 			$( '.travel-stories-content' ).fadeOut( 500, function () {
// 				$( this ).load( link + ' .travel-stories-content', function () {
// 					$( this ).fadeIn( 500 );
// 				} );
// 			} );
// 		} );
	} );
} )( jQuery );