<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function twentyseventeen_body_classes( $classes ) {
	// Add class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Add class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add class if we're viewing the Customizer for easier styling of theme options.
	if ( is_customize_preview() ) {
		$classes[] = 'twentyseventeen-customizer';
	}

	// Add class on front page.
	if ( is_front_page() && 'posts' !== get_option( 'show_on_front' ) ) {
		$classes[] = 'twentyseventeen-front-page';
	}

	// Add class if no custom header or featured images.
	if ( ! has_header_image() && ( ! has_post_thumbnail() || is_home() ) ) {
		$classes[] = 'no-header-image';
	}

	// Add class if sidebar is used.
	if ( is_active_sidebar( 'sidebar-1' ) && ! is_page() ) {
		$classes[] = 'has-sidebar';
	}

	// Add class for one or two column page layouts.
	if ( is_page() && ! twentyseventeen_is_frontpage() && ! is_home() ) {
		if ( 'one-column' === get_theme_mod( 'page_options' ) ) {
			$classes[] = 'page-one-column';
		} else {
			$classes[] = 'page-two-column';
		}
	}

	// Get the colorschme or the default if there isn't one.
	$colors = twentyseventeen_sanitize_colorscheme( get_theme_mod( 'colorscheme', 'light' ) );
	$classes[] = 'colors-' . $colors;

	return $classes;
}
add_filter( 'body_class', 'twentyseventeen_body_classes' );

/**
 * Count our number of active panels.
 *
 * Primarily used to see if we have any panels active, duh.
 */
function twentyseventeen_panel_count() {
	$panels = array( '1', '2', '3', '4' );
	$panel_count = 0;

	foreach ( $panels as $panel ) {
		if ( get_theme_mod( 'panel_' . $panel ) ) {
			$panel_count++;
		}
	}

	return $panel_count;
}

/**
 * Checks to see if we're on the homepage or not.
 */
function twentyseventeen_is_frontpage() {
	if ( is_front_page() && ! is_home() ) {
		return true;
	}

	return false;
}

/**
 * Custom Active Callback to check for page.
 */
function twentyseventeen_is_page() {
	return ( is_page() && ! twentyseventeen_is_frontpage() );
}

/**
 * Display a default list of pages if no menu is selected.
 */
function twentyseventeen_fallback_menu() {
	wp_page_menu( array(
		'link_after' => twentyseventeen_get_svg( array( 'icon' => 'expand' ) )
	) );
}
