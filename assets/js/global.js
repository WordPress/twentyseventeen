jQuery( document ).ready( function( $ ) {

	/**
	 * Making navigation 'stick'
	 */
	var $body = $( 'body' ),
		$navigation = $( '.navigation-top' ),
		$branding = $( '.site-branding' ),
		$navigationHiddenClass = 'site-navigation-hidden',
		$navigationFixedClass = 'site-navigation-fixed',
		$headerOffset,
		$navigationHeight,
		$resizeTimer;


	//we add the scroll class to the navs
	function adjustScrollClass() {
		// Make sure we're not on a mobile screen
		if ( 'none' === $( '.menu-toggle').css( 'display') ) {

			$headerOffset = $( '.custom-header' ).innerHeight();

			// Check to see if the nav is bigger than half the viewport size
			var navIsTooBig = (($(window).height() / 2) - $navigationHeight) <= 0;

			if ( $( window ).scrollTop() <= $headerOffset && $navigation.hasClass( $navigationFixedClass ) ) {
				 // If the navigation is just offscreen, add hidden class and make sure fixed class is removed
				$navigation.removeClass( $navigationFixedClass );
				$navigation.addClass( $navigationHiddenClass );

			} else if ( $( window ).scrollTop() >= $headerOffset && !navIsTooBig ) {
				 // Otherwise, if the scroll is more than the custom header
				 // and the nav isn't too big, switch navigation to 'fixed' class
				$navigation.addClass( $navigationFixedClass );
				$navigation.removeClass( $navigationHiddenClass );

			} else {
				// In all other cases, remove both classes
				$navigation.removeClass( $navigationFixedClass );
				$navigation.removeClass( $navigationHiddenClass );
			}
		}
	}

	function adjustHeaderHeight() {

		$navigationHeight = $navigation.innerHeight();

		if ( 'none' === $( '.menu-toggle').css( 'display') ) {
			$branding.css( 'margin-bottom', $navigationHeight );
		} else {
			$branding.css( 'margin-bottom', '0' );
		}
	}

	/**
	 * 'Scroll Down' arrow in menu area
	 */
	var $menuTop = 0;
	if( $( 'body' ).hasClass( 'admin-bar' ) ) {
		$menuTop = -32	;
	}
	$( '.menu-scroll-down' ).click( function( e ) {
		e.preventDefault();
		$( window ).scrollTo( '#primary' , {
			duration: 600,
			offset: { 'top': $menuTop }
		} );
	} );

	/**
	 * Add 'below-entry-meta' class to elements.
	 */
	function belowEntryMetaClass( param ) {
		if ( ! $body.hasClass( 'has-sidebar' ) || (
				$body.hasClass( 'search' ) ||
				$body.hasClass( 'single-attachment' ) ||
				$body.hasClass( 'error404' ) ||
				$body.hasClass( 'twentyseventeen-front-page'
			) ) ) {
			return;
		}

		var sidebar          	 = $( '#secondary' ),
			sidebarPos      	 = sidebar.offset(),
			sidebarPosBottom 	 = sidebarPos.top + ( sidebar.height() + 28 );

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
