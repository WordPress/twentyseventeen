jQuery( document ).ready( function( $ ) {

	/**
	 * Making navigation 'stick'
	 */
	var $body = $( 'body' ),
		$navigation = $( '.navigation-top' ),
		$branding = $( '.site-branding' ),
		$navigationFixedClass = 'site-navigation-fixed',
		$headerOffset,
		$navigationHeight,
		$resizeTimer,
		$menuTop = 0;

	// We add the scroll class to the navs
	function adjustScrollClass() {

		// Make sure we're not on a mobile screen
		if ( 'none' === $( '.menu-toggle' ).css( 'display' ) ) {

			// When there's a custom header image, the header offset includes the height of the navigation
			$navigationHeight = $navigation.outerHeight();
			if ( $( '.custom-header-image' ).length ) {
				$headerOffset = $( '.custom-header' ).innerHeight() - $navigationHeight;
			} else {
				$headerOffset = $( '.custom-header' ).innerHeight();
			}

			if ( $( window ).scrollTop() >= $headerOffset ) {

				// If the scroll is more than the custom header, switch navigation to 'fixed' class
				$navigation.addClass( $navigationFixedClass );

			} else {

				// In all other cases, remove both classes
				$navigation.removeClass( $navigationFixedClass );
			}
		}
	}

	function adjustHeaderHeight() {

		$navigationHeight = $navigation.outerHeight();

		if ( 'none' === $( '.menu-toggle' ).css( 'display' ) ) {
			$branding.css( 'margin-bottom', $navigationHeight );
		} else {
			$branding.css( 'margin-bottom', '0' );
		}
	}

	/**
	 * 'Scroll Down' arrow in menu area
	 */
	if ( $( 'body' ).hasClass( 'admin-bar' ) ) {
		$menuTop = -32;
	}
	$( '.menu-scroll-down' ).click( function( e ) {
		e.preventDefault();
		$( window ).scrollTo( '#primary', {
			duration: 600,
			offset: { 'top': $menuTop }
		} );
	} );

	/**
	 * Add 'below-entry-meta' class to elements.
	 */
	function belowEntryMetaClass( param ) {
		var sidebar, sidebarPos, sidebarPosBottom;

		if ( ! $body.hasClass( 'has-sidebar' ) || (
				$body.hasClass( 'search' ) ||
				$body.hasClass( 'single-attachment' ) ||
				$body.hasClass( 'error404' ) ||
				$body.hasClass( 'twentyseventeen-front-page'
			) ) ) {
			return;
		}

		sidebar          = $( '#secondary' );
		sidebarPos       = sidebar.offset();
		sidebarPosBottom = sidebarPos.top + ( sidebar.height() + 28 );

		$( '.entry-content' ).find( param ).each( function() {
			var element              = $( this ),
				elementPos           = element.offset(),
				elementPosTop        = elementPos.top;

			// Add 'below-entry-meta' to elements below the entry meta.
			if ( elementPosTop > sidebarPosBottom ) {
				element.addClass( 'below-entry-meta' );
			} else {
				element.removeClass( 'below-entry-meta' );
			}
		} );
	}

	// Let's fire some JavaScript!
	adjustScrollClass();
	adjustHeaderHeight();

	$( document ).ready( function() {
		belowEntryMetaClass( 'blockquote.alignleft, blockquote.alignright' );
	} );

	// On scroll, we want to stick/unstick the navigation
	$( window ).on( 'scroll', function() {
		adjustScrollClass();
		adjustHeaderHeight();
	} );

	// Also want to make sure the navigation is where it should be on resize
	$( window ).resize( function() {
		setTimeout( adjustScrollClass, 500 );
		setTimeout( adjustHeaderHeight, 1000 );

		clearTimeout( $resizeTimer );
		$resizeTimer = setTimeout( function() {
			belowEntryMetaClass( 'blockquote.alignleft, blockquote.alignright' );
		}, 300 );
	} );

} );
