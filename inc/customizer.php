<?php
/**
 * Twenty Seventeen Theme Customizer.
 *
 * @package Twenty Seventeen
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
	$wp_customize->add_panel( 'twentyseventeen_options_panel', array(
		'title'       => __( 'Theme Options', 'twentyseventeen' ),
		'description' => __( 'Configure your theme settings', 'twentyseventeen' ),
	) );

	// Panel 1
	$wp_customize->add_section( 'twentyseventeen_panel1', array(
		'title'           => __( 'Panel 1', 'twentyseventeen' ),
		'active_callback' => 'is_front_page',
		'panel'           => 'twentyseventeen_options_panel',
		'description'     => __( 'Add an image to your panel by setting a featured image in the page editor. If you don&rsquo;t select a page, this panel will not be displayed.', 'twentyseventeen' ),
	) );

	$wp_customize->add_setting( 'twentyseventeen_panel1', array(
		'default'           => false,
		'sanitize_callback' => 'twentyseventeen_sanitize_numeric_value',
	) );

	$wp_customize->add_control( 'twentyseventeen_panel1', array(
		'label'   => __( 'Panel Content', 'twentyseventeen' ),
		'section' => 'twentyseventeen_panel1',
		'type'    => 'dropdown-pages',
	) );

	$wp_customize->add_setting( 'twentyseventeen_panel1_layout', array(
		'default'           => 'one-column',
		'sanitize_callback' => 'twentyseventeen_sanitize_layout',
	) );

	$wp_customize->add_control( 'twentyseventeen_panel1_layout', array(
		'label'   => __( 'Panel Layout', 'twentyseventeen' ),
		'section' => 'twentyseventeen_panel1',
		'type'    => 'radio',
		'choices' => array(
			'one-column' => __( 'One Column', 'twentyseventeen' ),
			'two-column' => __( 'Two Column', 'twentyseventeen' ),
		),
	) );

	// Panel 2
	$wp_customize->add_section( 'twentyseventeen_panel2', array(
		'title'           => __( 'Panel 2', 'twentyseventeen' ),
		'active_callback' => 'is_front_page',
		'panel'           => 'twentyseventeen_options_panel',
		'description'     => __( 'Add an image to your panel by setting a featured image in the page editor. If you don&rsquo;t select a page, this panel will not be displayed.', 'twentyseventeen' ),
	) );

	$wp_customize->add_setting( 'twentyseventeen_panel2', array(
		'default'           => false,
		'sanitize_callback' => 'twentyseventeen_sanitize_numeric_value',
	) );

	$wp_customize->add_control( 'twentyseventeen_panel2', array(
		'label'   => __( 'Panel Content', 'twentyseventeen' ),
		'section' => 'twentyseventeen_panel2',
		'type'    => 'dropdown-pages',
	) );

	$wp_customize->add_setting( 'twentyseventeen_panel2_layout', array(
		'default'           => 'one-column',
		'sanitize_callback' => 'twentyseventeen_sanitize_layout',
	) );

	$wp_customize->add_control( 'twentyseventeen_panel2_layout', array(
		'label'   => __( 'Panel Layout', 'twentyseventeen' ),
		'section' => 'twentyseventeen_panel2',
		'type'    => 'radio',
		'choices' => array(
			'one-column' => __( 'One Column', 'twentyseventeen' ),
			'two-column' => __( 'Two Column', 'twentyseventeen' ),
		),
	) );

	// Panel 3
	$wp_customize->add_section( 'twentyseventeen_panel3', array(
		'title'           => __( 'Panel 3', 'twentyseventeen' ),
		'active_callback' => 'is_front_page',
		'panel'           => 'twentyseventeen_options_panel',
		'description'     => __( 'Add an image to your panel by setting a featured image in the page editor. If you don&rsquo;t select a page, this panel will not be displayed.', 'twentyseventeen' ),
	) );

	$wp_customize->add_setting( 'twentyseventeen_panel3', array(
		'default'           => false,
		'sanitize_callback' => 'twentyseventeen_sanitize_numeric_value',
	) );

	$wp_customize->add_control( 'twentyseventeen_panel3', array(
		'label'   => __( 'Panel Content', 'twentyseventeen' ),
		'section' => 'twentyseventeen_panel3',
		'type'    => 'dropdown-pages',
	) );

	$wp_customize->add_setting( 'twentyseventeen_panel3_layout', array(
		'default'           => 'one-column',
		'sanitize_callback' => 'twentyseventeen_sanitize_layout',
	) );

	$wp_customize->add_control( 'twentyseventeen_panel3_layout', array(
		'label'   => __( 'Panel Layout', 'twentyseventeen' ),
		'section' => 'twentyseventeen_panel3',
		'type'    => 'radio',
		'choices' => array(
			'one-column' => __( 'One Column', 'twentyseventeen' ),
			'two-column' => __( 'Two Column', 'twentyseventeen' ),
		),
	) );

	// Panel 4
	$wp_customize->add_section( 'twentyseventeen_panel4', array(
		'title'           => __( 'Panel 4', 'twentyseventeen' ),
		'active_callback' => 'is_front_page',
		'panel'           => 'twentyseventeen_options_panel',
		'description'     => __( 'Add an image to your panel by setting a featured image in the page editor. If you don&rsquo;t select a page, this panel will not be displayed.', 'twentyseventeen' ),
	) );

	$wp_customize->add_setting( 'twentyseventeen_panel4', array(
		'default'           => false,
		'sanitize_callback' => 'twentyseventeen_sanitize_numeric_value',
	) );

	$wp_customize->add_control( 'twentyseventeen_panel4', array(
		'label'   => __( 'Panel Content', 'twentyseventeen' ),
		'section' => 'twentyseventeen_panel4',
		'type'    => 'dropdown-pages',
	) );

	$wp_customize->add_setting( 'twentyseventeen_panel4_layout', array(
		'default'           => 'one-column',
		'sanitize_callback' => 'twentyseventeen_sanitize_layout',
	) );

	$wp_customize->add_control( 'twentyseventeen_panel4_layout', array(
		'label'   => __( 'Panel Layout', 'twentyseventeen' ),
		'section' => 'twentyseventeen_panel4',
		'type'    => 'radio',
		'choices' => array(
			'one-column' => __( 'One Column', 'twentyseventeen' ),
			'two-column' => __( 'Two Column', 'twentyseventeen' ),
		),
	) );

	// Footer Image
	$wp_customize->add_section( 'twentyseventeen_footer_settings', array(
		'title'	  => __( 'Footer Image', 'twentyseventeen' ),
		'panel'	  => 'twentyseventeen_options_panel',
		'default' => '',
	) );

	$wp_customize->add_setting('twentyseventeen_footer_image', array(
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
		'twentyseventeen_footer_image', array(
		'label'       => __( 'Footer Image', 'twentyseventeen' ),
		'section'     => 'twentyseventeen_footer_settings',
		'description' => __( 'Add an image to be displayed at the bottom of the Front Page template, above the footer.', 'twentyseventeen' ),
	) ) );
}
add_action( 'customize_register', 'twentyseventeen_customize_register' );


/**
 * Sanitize a numeric value
 */
function twentyseventeen_sanitize_numeric_value( $input ) {
	if ( is_numeric( $input ) ) {
		return intval( $input );
	} else {
		return 0;
	}
}

/**
 * Sanitize a radio button
 */
function twentyseventeen_sanitize_layout( $input ) {
	$valid = array(
		'one-column' => __( 'One Column', 'twentyseventeen' ),
		'two-column' => __( 'Two Column', 'twentyseventeen' ),
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function twentyseventeen_customize_preview_js() {
	wp_enqueue_script( 'twentyseventeen_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'twentyseventeen_customize_preview_js' );

/**
 * Some extra JavaScript to improve the user experience in the Customizer for this theme.
 */
function twentyseventeen_panels_js() {
	wp_enqueue_script( 'twentyseventeen_extra_js', get_template_directory_uri() . '/assets/js/panel-customizer.js', array(), '20151116', true );
}
add_action( 'customize_controls_enqueue_scripts', 'twentyseventeen_panels_js' );
