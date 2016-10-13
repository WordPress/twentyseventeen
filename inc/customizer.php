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
	 * Custom colors.
	 */
	$wp_customize->add_setting( 'colorscheme', array(
		'default'           => 'light',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'twentyseventeen_sanitize_colorscheme',
	) );

	$wp_customize->add_setting( 'colorscheme_hue', array(
		'default'           => 250,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'absint', // The hue is stored as a positive integer.
	) );

	$wp_customize->add_control( 'colorscheme', array(
		'type'    => 'radio',
		'label'    => __( 'Color Scheme', 'twentyseventeen' ),
		'choices'  => array(
			'light'  => __( 'Light', 'twentyseventeen' ),
			'dark'   => __( 'Dark', 'twentyseventeen' ),
			'custom' => __( 'Custom', 'twentyseventeen' ),
		),
		'section'  => 'colors',
		'priority' => 5,
	) );

	$wp_customize->add_control( 'colorscheme_hue', array(
		'type'    => 'range',
		'input_attrs' => array(
			'min' => 0,
			'max' => 359,
			'step' => 1,
		),
		'section'  => 'colors',
		'priority' => 6,
		'description' => 'Temporary hue slider will be replaced with a visual hue picker that is only shown when a custom scheme is selected', // temporary, intentionally untranslated
		// @todo change this to a visual hue picker control, ideally extending the color control and leveraging iris by adding a `hue` mode in core
		// See https://core.trac.wordpress.org/ticket/38263
		// @todo only show this control when the colorscheme is custom
	) );

	/**
	 * Add the Theme Options section
	 */
	$wp_customize->add_panel( 'twentyseventeen_options_panel', array(
		'title'       => __( 'Theme Options', 'twentyseventeen' ),
		'description' => __( 'Configure your theme settings', 'twentyseventeen' ),
	) );

	// Page Options.
	$wp_customize->add_section( 'twentyseventeen_page_options', array(
		'title'           => __( 'Single Page Layout', 'twentyseventeen' ),
		'active_callback' =>'twentyseventeen_is_page',
		'panel'           => 'twentyseventeen_options_panel',
	) );

	$wp_customize->add_setting( 'twentyseventeen_page_options', array(
		'default'           => 'two-column',
		'sanitize_callback' => 'twentyseventeen_sanitize_layout',
	) );

	$wp_customize->add_control( 'twentyseventeen_page_options', array(
		'label'       => __( 'Single Page Layout', 'twentyseventeen' ),
		'section'     => 'twentyseventeen_page_options',
		'type'        => 'radio',
		'description' => __( 'When no sidebar widgets are assigned, you can opt to display single pages with a one column or two column layout. When the two column layout is assigned, the page title is in one column and content is in the other.', 'twentyseventeen' ),
		'choices'     => array(
			'one-column' => __( 'One Column', 'twentyseventeen' ),
			'two-column' => __( 'Two Column', 'twentyseventeen' ),
		),
	) );

	// Panel 1.
	$wp_customize->add_section( 'twentyseventeen_panel_1', array(
		'title'           => __( 'Panel 1', 'twentyseventeen' ),
		'active_callback' => 'is_front_page',
		'panel'           => 'twentyseventeen_options_panel',
		'description'     => __( 'Add an image to your panel by setting a featured image in the page editor. If you don&rsquo;t select a page, this panel will not be displayed.', 'twentyseventeen' ),
	) );

	$wp_customize->add_setting( 'twentyseventeen_panel_1', array(
		'default'           => false,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'twentyseventeen_panel_1', array(
		'label'   => __( 'Panel Content', 'twentyseventeen' ),
		'section' => 'twentyseventeen_panel_1',
		'type'    => 'dropdown-pages',
	) );

	// Panel 2.
	$wp_customize->add_section( 'twentyseventeen_panel_2', array(
		'title'           => __( 'Panel 2', 'twentyseventeen' ),
		'active_callback' => 'is_front_page',
		'panel'           => 'twentyseventeen_options_panel',
		'description'     => __( 'Add an image to your panel by setting a featured image in the page editor. If you don&rsquo;t select a page, this panel will not be displayed.', 'twentyseventeen' ),
	) );

	$wp_customize->add_setting( 'twentyseventeen_panel_2', array(
		'default'           => false,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'twentyseventeen_panel_2', array(
		'label'   => __( 'Panel Content', 'twentyseventeen' ),
		'section' => 'twentyseventeen_panel_2',
		'type'    => 'dropdown-pages',
	) );

	// Panel 3.
	$wp_customize->add_section( 'twentyseventeen_panel_3', array(
		'title'           => __( 'Panel 3', 'twentyseventeen' ),
		'active_callback' => 'is_front_page',
		'panel'           => 'twentyseventeen_options_panel',
		'description'     => __( 'Add an image to your panel by setting a featured image in the page editor. If you don&rsquo;t select a page, this panel will not be displayed.', 'twentyseventeen' ),
	) );

	$wp_customize->add_setting( 'twentyseventeen_panel_3', array(
		'default'           => false,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'twentyseventeen_panel_3', array(
		'label'   => __( 'Panel Content', 'twentyseventeen' ),
		'section' => 'twentyseventeen_panel_3',
		'type'    => 'dropdown-pages',
	) );

	// Panel 4.
	$wp_customize->add_section( 'twentyseventeen_panel_4', array(
		'title'           => __( 'Panel 4', 'twentyseventeen' ),
		'active_callback' => 'is_front_page',
		'panel'           => 'twentyseventeen_options_panel',
		'description'     => __( 'Add an image to your panel by setting a featured image in the page editor. If you don&rsquo;t select a page, this panel will not be displayed.', 'twentyseventeen' ),
	) );

	$wp_customize->add_setting( 'twentyseventeen_panel_4', array(
		'default'           => false,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'twentyseventeen_panel_4', array(
		'label'   => __( 'Panel Content', 'twentyseventeen' ),
		'section' => 'twentyseventeen_panel_4',
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
 * Sanitize the colorscheme.
 */
function twentyseventeen_sanitize_colorscheme( $input ) {
	$valid = array( 'light', 'dark', 'custom' );

	if ( in_array( $input, $valid ) ) {
		return $input;
	} else {
		return 'light';
	}
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

/**
 * Add colorscheme body class.
 */
function twentyseventeen_body_class_colors( $classes ) {
	// Get the colorschme or the default if there isn't one.
	$colors = twentyseventeen_sanitize_colorscheme( get_theme_mod( 'colorscheme', 'light' ) );
	$classes[] = 'colors-' . $colors;
	return $classes;
}
add_filter( 'body_class', 'twentyseventeen_body_class_colors' );

/**
 * Display custom color CSS.
 */
function twentyseventeen_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( 'color-patterns.php' );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo twentyseventeen_custom_colors_css(); ?>
	</style>
<?php }
add_action( 'wp_head', 'twentyseventeen_colors_css_wrap' );
