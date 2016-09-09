jQuery( document ).ready( function( $ ) {

	var $header = $( '.header-top' ),
		$headerHeight = $( '.header-top' ).outerHeight(),
		$headerOffset = $( '.custom-header' ).outerHeight(),
		$headerHiddenClass = 'site-header-hidden',
		$headerFixedClass = 'site-header-fixed';


	// adjust header margin based on height of menu
	function adjustHeaderMargin(){
		// check to see if on mobile by checking menu-toggle display
		if ( 'none' === $( '.menu-toggle').css( 'display') ) {
			// if yes, we want to bump the custom header down a bit, so the menu doesn't cut it off
			$( '.custom-header-image').css( 'margin-top', $headerHeight );
		}
	}

	//we add the scroll class to the navs
	function adjustScrollClass() {
		// Make sure we're not on a mobile screen
		if ( 'none' === $( '.menu-toggle').css( 'display') ) {

			if ( $( window ).scrollTop() <= $headerOffset && $header.hasClass( $headerFixedClass ) ) {
				$header.removeClass( $headerFixedClass );
				$header.addClass( $headerHiddenClass );

			} else if ( $( window ).scrollTop() >= $headerOffset ) {
				//If the scroll is more than the custom header
				$header.addClass( $headerFixedClass );
				$header.removeClass( $headerHiddenClass );
				$( '.custom-header' ).css( 'margin-top', $headerHeight );

			} else {
				//If not we remove it
				$header.removeClass( $headerFixedClass );
				$header.removeClass( $headerHiddenClass );
				$( '.custom-header' ).css( 'margin-top', 'auto' );
			}
		}
	}

	// Let's fire some JavaScript!

	// On load, we want to adjust the header margin
	adjustHeaderMargin();
	adjustScrollClass();

	// On scroll, we want to stick/unstick the header
	$( window ).on( 'scroll', function() {
		adjustScrollClass();
	} );

	// we also want to do the same on window rezize
	$( window ).on( 'resize', function() {
		setTimeout( adjustHeaderMargin, 500 );
	} );

} );
