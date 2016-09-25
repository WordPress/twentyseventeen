jQuery( document ).ready( function( $ ) {

	/**
	 * Making navigation 'stick'
	 */
	var $navigation = $( '.navigation-top' ),
		$branding = $( '.site-branding' ),
		$navigationHiddenClass = 'site-navigation-hidden',
		$navigationFixedClass = 'site-navigation-fixed',
		$headerOffset,
		$navigationHeight;

	//we add the scroll class to the navs
	function adjustScrollClass() {
		// Make sure we're not on a mobile screen
		if ( 'none' === $( '.menu-toggle').css( 'display') ) {

			$headerOffset = $( '.custom-header' ).innerHeight();

			if ( $( window ).scrollTop() <= $headerOffset && $navigation.hasClass( $navigationFixedClass ) ) {
				 // If the navigation is just offscreen, add hidden class and make sure fixed class is removed
				$navigation.removeClass( $navigationFixedClass );
				$navigation.addClass( $navigationHiddenClass );

			} else if ( $( window ).scrollTop() >= $headerOffset ) {
				 // Otherwise, if the scroll is more than the custom header, switch navigation to 'fixed' class
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

	// Let's fire some JavaScript!
	adjustScrollClass();
	adjustHeaderHeight();

	// On scroll, we want to stick/unstick the navigation
	$( window ).on( 'scroll', function() {
		adjustScrollClass();
		adjustHeaderHeight();
	} );

	// Also want to make sure the navigation is where it should be on resize
	$( window ).resize( function() {
		setTimeout( adjustScrollClass, 500 );
		setTimeout( adjustHeaderHeight, 1000 );
	} );

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

} );
