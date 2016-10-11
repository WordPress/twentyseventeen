<?php
/**
 * Twenty Seventeen Theme Customizer
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function twentyseventeen_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Add the Theme Options section
	 */
	$wp_customize->add_panel( 'options_panel', array(
		'title'       => __( 'Theme Options', 'twentyseventeen' ),
		'description' => __( 'Configure your theme settings', 'twentyseventeen' ),
	) );

	// Page Options.
	$wp_customize->add_section( 'page_options', array(
		'title'           => __( 'Single Page Layout', 'twentyseventeen' ),
		'active_callback' => 'twentyseventeen_is_page',
		'panel'           => 'options_panel',
	) );

	$wp_customize->add_setting( 'page_options', array(
		'default'           => 'two-column',
		'sanitize_callback' => 'twentyseventeen_sanitize_layout',
	) );

	$wp_customize->add_control( 'page_options', array(
		'label'       => __( 'Single Page Layout', 'twentyseventeen' ),
		'section'     => 'page_options',
		'type'        => 'radio',
		'description' => __( 'When no sidebar widgets are assigned, you can opt to display single pages with a one column or two column layout. When the two column layout is assigned, the page title is in one column and content is in the other.', 'twentyseventeen' ),
		'choices'     => array(
			'one-column' => __( 'One Column', 'twentyseventeen' ),
			'two-column' => __( 'Two Column', 'twentyseventeen' ),
		),
	) );

	// Panel 1.
	$wp_customize->add_section( 'panel_1', array(
		'title'           => __( 'Panel 1', 'twentyseventeen' ),
		'active_callback' => 'is_front_page',
		'panel'           => 'options_panel',
		'description'     => __( 'Add an image to your panel by setting a featured image in the page editor. If you don&rsquo;t select a page, this panel will not be displayed.', 'twentyseventeen' ),
	) );

	$wp_customize->add_setting( 'panel_1', array(
		'default'           => false,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'panel_1', array(
		'label'   => __( 'Panel Content', 'twentyseventeen' ),
		'section' => 'panel_1',
		'type'    => 'dropdown-pages',
	) );

	// Panel 2.
	$wp_customize->add_section( 'panel_2', array(
		'title'           => __( 'Panel 2', 'twentyseventeen' ),
		'active_callback' => 'is_front_page',
		'panel'           => 'options_panel',
		'description'     => __( 'Add an image to your panel by setting a featured image in the page editor. If you don&rsquo;t select a page, this panel will not be displayed.', 'twentyseventeen' ),
	) );

	$wp_customize->add_setting( 'panel_2', array(
		'default'           => false,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'panel_2', array(
		'label'   => __( 'Panel Content', 'twentyseventeen' ),
		'section' => 'panel_2',
		'type'    => 'dropdown-pages',
	) );

	// Panel 3.
	$wp_customize->add_section( 'panel_3', array(
		'title'           => __( 'Panel 3', 'twentyseventeen' ),
		'active_callback' => 'is_front_page',
		'panel'           => 'options_panel',
		'description'     => __( 'Add an image to your panel by setting a featured image in the page editor. If you don&rsquo;t select a page, this panel will not be displayed.', 'twentyseventeen' ),
	) );

	$wp_customize->add_setting( 'panel_3', array(
		'default'           => false,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'panel_3', array(
		'label'   => __( 'Panel Content', 'twentyseventeen' ),
		'section' => 'panel_3',
		'type'    => 'dropdown-pages',
	) );

	// Panel 4.
	$wp_customize->add_section( 'panel_4', array(
		'title'           => __( 'Panel 4', 'twentyseventeen' ),
		'active_callback' => 'is_front_page',
		'panel'           => 'options_panel',
		'description'     => __( 'Add an image to your panel by setting a featured image in the page editor. If you don&rsquo;t select a page, this panel will not be displayed.', 'twentyseventeen' ),
	) );

	$wp_customize->add_setting( 'panel_4', array(
		'default'           => false,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'panel_4', array(
		'label'   => __( 'Panel Content', 'twentyseventeen' ),
		'section' => 'panel_4',
		'type'    => 'dropdown-pages',
	) );
}
add_action( 'customize_register', 'twentyseventeen_customize_register' );

/**
 * Sanitize a radio button.
 */
function twentyseventeen_sanitize_layout( $input ) {
	$valid = array(
		'one-column' => __( 'One Column', 'twentyseventeen' ),
		'two-column' => __( 'Two Column', 'twentyseventeen' ),
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	}
	return '';
}

/**
 * Custom Active Callback to check for page.
 */
function twentyseventeen_is_page() {
	return ( is_page() && ! twentyseventeen_is_frontpage() );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function twentyseventeen_customize_preview_js() {
	wp_enqueue_script( 'twentyseventeen-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'twentyseventeen_customize_preview_js' );

/**
 * Some extra JavaScript to improve the user experience in the Customizer for this theme.
 */
function twentyseventeen_panels_js() {
	wp_enqueue_script( 'twentyseventeen-panel-customizer', get_template_directory_uri() . '/assets/js/panel-customizer.js', array(), '20151116', true );
}
add_action( 'customize_controls_enqueue_scripts', 'twentyseventeen_panels_js' );
