jQuery( document ).ready( function( $ ) {

	/**
	 * Making navigation 'stick'
	 */
	var $body = $( 'body' ),
		$navigation = $( '.navigation-top' ),
		$navWrap = $navigation.find( '.wrap' ),
		$navMenuItem = $navigation.find( '.menu-item' ),
		navigationHeight,
		navigationOuterHeight,
		navPadding,
		navMenuItemHeight,
		idealNavHeight,
		navIsNotTooTall,
		$branding = $( '.site-branding' ),
		$navigationFixedClass = 'site-navigation-fixed',
		$headerOffset,
		$resizeTimer,
		$menuTop = 0;

	// We add the scroll class to the navs
	function adjustScrollClass() {

		// Make sure we're not on a mobile screen
		if ( 'none' === $( '.menu-toggle' ).css( 'display' ) ) {

			// Make sure the nav isn't taller than two rows
			navigationHeight  = $navigation.height();
			navPadding        = parseFloat( $navWrap.css( 'padding-top' ) ) * 2;
			navMenuItemHeight = $navMenuItem.outerHeight() * 2;
			idealNavHeight    = navPadding + navMenuItemHeight;
			navIsNotTooTall   = navigationHeight <= idealNavHeight;

			if ( navIsNotTooTall ) {

				// When there's a custom header image, the header offset includes the height of the navigation
				if ( $( '.custom-header-image' ).length ) {
					$headerOffset = $( '.custom-header' ).innerHeight() - navigationOuterHeight;
				} else {
					$headerOffset = $( '.custom-header' ).innerHeight();
				}

				if ( $( window ).scrollTop() >= $headerOffset ) {

					// If the scroll is more than the custom header, switch navigation to 'fixed' class
					$navigation.addClass( $navigationFixedClass );

				} else {

					// Otherwise, remove 'fixed' class
					$navigation.removeClass( $navigationFixedClass );
				}

			} else {

				// Otherwise, remove 'fixed' class if nav is taller than two rows
				$navigation.removeClass( $navigationFixedClass );
			}
		}
	}

	function adjustHeaderHeight() {

		navigationOuterHeight = $navigation.outerHeight();

		if ( 'none' === $( '.menu-toggle' ).css( 'display' ) ) {
			$branding.css( 'margin-bottom', navigationOuterHeight );
		} else {
			$branding.css( 'margin-bottom', '0' );
		}
	}

	/**
	 * 'Scroll Down' arrow in menu area
	 */
	if ( $( 'body' ).hasClass( 'blog' ) ) {
		$menuTop -= 30; // The div for latest posts has no space above content, add some to account for this
	}
	if ( $( 'body' ).hasClass( 'admin-bar' ) ) {
		$menuTop -= 32;
	}
	$( '.menu-scroll-down' ).click( function( e ) {
		e.preventDefault();
		$( window ).scrollTo( '#primary', {
			duration: 600,
			offset: { 'top': $menuTop - $navigation.outerHeight() }
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
