jQuery( document ).ready( function( $ ) {

	/**
	 * Making navigation 'stick'
	 */
	var $navigation = $( '.navigation-top' ),
		$headerOffset = $( '.custom-header' ).outerHeight(),
		$navigationHiddenClass = 'site-navigation-hidden',
		$navigationFixedClass = 'site-navigation-fixed';

	//we add the scroll class to the navs
	function adjustScrollClass() {
		// Make sure we're not on a mobile screen
		if ( 'none' === $( '.menu-toggle').css( 'display') ) {

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

	// Let's fire some JavaScript!
	adjustScrollClass();

	// On scroll, we want to stick/unstick the navigation
	$( window ).on( 'scroll', function() {
		adjustScrollClass();
	} );

	// Also want to make sure the navigation is where it should be on resize
	$( window ).resize( function() {
		setTimeout( adjustScrollClass, 500 );
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
