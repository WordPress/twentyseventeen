( function( $ ) {

	// Variables and DOM Caching
	var $body = $( 'body' ),
			$customHeader = $body.find( '.custom-header' ),
			$customHeaderImage = $customHeader.find( '.custom-header-image' ),
			$branding = $customHeader.find( '.site-branding' ),
			$navigation = $body.find( '.navigation-top' ),
			$navWrap = $navigation.find( '.wrap' ),
			$navMenuItem = $navigation.find( '.menu-item' ),
			$menuToggle = $navigation.find( '.menu-toggle' ),
			$menuScrollDown = $navigation.find( '.menu-scroll-down' ),
			$sidebar = $body.find( '#secondary' ),
			$entryContent = $body.find( '.entry-content' ),
			$formatQuote = $body.find( '.format-quote blockquote' ),
			navigationFixedClass = 'site-navigation-fixed',
			navigationHeight,
			navigationOuterHeight,
			navPadding,
			navMenuItemHeight,
			idealNavHeight,
			navIsNotTooTall,
			headerOffset,
			menuTop,
			resizeTimer;

	/**
	 * Sets properties of navigation
	 */
	 function setNavProps() {
		 navigationHeight      = $navigation.height();
		 navigationOuterHeight = $navigation.outerHeight();
		 navPadding            = parseFloat( $navWrap.css( 'padding-top' ) ) * 2;
		 navMenuItemHeight     = $navMenuItem.outerHeight() * 2;
		 idealNavHeight        = navPadding + navMenuItemHeight;
		 navIsNotTooTall       = navigationHeight <= idealNavHeight;
	 }

	/**
	 * Makes navigation 'stick'
	 */
	function adjustScrollClass() {

		// Make sure we're not on a mobile screen
		if ( 'none' === $menuToggle.css( 'display' ) ) {

			// Make sure the nav isn't taller than two rows
			if ( navIsNotTooTall ) {

				// When there's a custom header image, the header offset includes the height of the navigation
				if ( $customHeaderImage.length ) {
					headerOffset = $customHeader.innerHeight() - navigationOuterHeight;
				} else {
					headerOffset = $customHeader.innerHeight();
				}

				// If the scroll is more than the custom header, set the fixed class
				if ( $( window ).scrollTop() >= headerOffset ) {
					$navigation.addClass( navigationFixedClass );
				} else {
					$navigation.removeClass( navigationFixedClass );
				}

			} else {

				// Remove 'fixed' class if nav is taller than two rows
				$navigation.removeClass( navigationFixedClass );
			}
		}
	}

	/**
	 * Sets margins of branding in header
	 */
	function adjustHeaderHeight() {
		if ( 'none' === $menuToggle.css( 'display' ) ) {
			$branding.css( 'margin-bottom', navigationOuterHeight );
		} else {
			$branding.css( 'margin-bottom', '0' );
		}
	}

	/**
	 * Sets icon for quotes
	 */
	 function setQuotesIcon() {
		 $( twentyseventeenScreenReaderText.quote ).prependTo( $formatQuote );
	 }

	/**
	 * 'Scroll Down' arrow in menu area
	 */
	if ( $( 'body' ).hasClass( 'blog' ) ) {
		menuTop -= 30; // The div for latest posts has no space above content, add some to account for this
	}
	if ( $( 'body' ).hasClass( 'admin-bar' ) ) {
		menuTop -= 32;
	}
	$( '.menu-scroll-down' ).click( function( e ) {
		e.preventDefault();
		$( window ).scrollTo( '#primary', {
			duration: 600,
			offset: { 'top': menuTop - $navigation.outerHeight() }
		} );
	} );

	/**
	 * Add 'below-entry-meta' class to elements.
	 */
	function belowEntryMetaClass( param ) {
		var sidebarPos, sidebarPosBottom;

		if ( ! $body.hasClass( 'has-sidebar' ) || (
			$body.hasClass( 'search' ) ||
			$body.hasClass( 'single-attachment' ) ||
			$body.hasClass( 'error404' ) ||
			$body.hasClass( 'twentyseventeen-front-page' )
		) ) {
			return;
		}

		sidebarPos       = $sidebar.offset();
		sidebarPosBottom = sidebarPos.top + ( $sidebar.height() + 28 );

		$entryContent.find( param ).each( function() {
			var $element = $( this ),
					elementPos = $element.offset(),
					elementPosTop = elementPos.top;

			// Add 'below-entry-meta' to elements below the entry meta.
			if ( elementPosTop > sidebarPosBottom ) {
				$element.addClass( 'below-entry-meta' );
			} else {
				$element.removeClass( 'below-entry-meta' );
			}
		});
	}

	// Fires on document ready
	$( document ).ready( function() {

		/**
		 * 'Scroll Down' arrow in menu area
		 */
		if ( $( 'body' ).hasClass( 'admin-bar' ) ) {
			menuTop = -32;
		}
		$menuScrollDown.click( function( e ) {
			e.preventDefault();
			$( window ).scrollTo( '#primary', {
				duration: 600,
				offset: { 'top': menuTop }
			} );
		} );

		// Let's fire some JavaScript!
		setNavProps();
		adjustScrollClass();
		adjustHeaderHeight();
		setQuotesIcon();
	} );

	// On scroll, we want to stick/unstick the navigation
	$( window ).on( 'scroll', function() {
		adjustScrollClass();
		adjustHeaderHeight();
	} );

	// Also want to make sure the navigation is where it should be on resize
	$( window ).resize( function() {
		setNavProps();
		setTimeout( adjustScrollClass, 500 );
		setTimeout( adjustHeaderHeight, 1000 );

		clearTimeout( resizeTimer );
		resizeTimer = setTimeout( function() {
			belowEntryMetaClass( 'blockquote.alignleft, blockquote.alignright' );
		}, 300 );
	} );

}( jQuery ) );
