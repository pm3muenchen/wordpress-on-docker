<?php
/**
 * Deep Free: Customizer
 *
 * This file is based on Twenty Nineteen Theme
 * License: GPLv2 or later	
 *
 * @package WordPress
 * @subpackage deep_free
 * @since 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function deep_free_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'deep_free_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'deep_free_customize_partial_blogdescription',
			)
		);
	}

	/**
	 * Primary color.
	 */
	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'           => 'default',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'deep_free_sanitize_color_option',
		)
	);

	$wp_customize->add_control(
		'primary_color',
		array(
			'type'     => 'radio',
			'label'    => __( 'Primary Color', 'deep-free' ),
			'choices'  => array(
				'default' => _x( 'Default', 'primary color', 'deep-free' ),
				'custom'  => _x( 'Custom', 'primary color', 'deep-free' ),
			),
			'section'  => 'colors',
			'priority' => 5,
		)
	);

	// Add primary color hue setting and control.
	$wp_customize->add_setting(
		'primary_color_hue',
		array(
			'default'           => 199,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_color_hue',
			array(
				'description' => __( 'Apply a custom color for links.', 'deep-free' ),
				'section'     => 'colors',
				'mode'        => 'hue',
			)
		)
	);
}
add_action( 'customize_register', 'deep_free_customize_register' );

function deep_free_customize_css()
{
	if ( get_header_image() ) { ?>
		<style type="text/css">
            	header#masthead { background: url(<?php echo wp_kses_post(header_image()) ?>); }
        </style>
	<?php }   
}
add_action( 'wp_head', 'deep_free_customize_css');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function deep_free_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function deep_free_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function deep_free_customize_preview_js() {
	wp_enqueue_script( 'deep-customize-preview', DEEP_URL . '/assets/dist/js/backend/customize-preview.js', array(), DEEP_VERSION, true );
}
add_action( 'customize_preview_init', 'deep_free_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function deep_free_panels_js() {
	wp_enqueue_script( 'deep-customize-controls', DEEP_URL . '/assets/dist/js/backend/customize-controls.js', array(), DEEP_VERSION, true );
}
add_action( 'customize_controls_enqueue_scripts', 'deep_free_panels_js' );

/**
 * Sanitize custom color choice.
 *
 * @param string $choice Whether image filter is active.
 *
 * @return string
 */
function deep_free_sanitize_color_option( $choice ) {
	$valid = array(
		'default',
		'custom',
	);

	if ( in_array( $choice, $valid, true ) ) {
		return $choice;
	}

	return 'default';
}
