<?php
/**
 * Theme Customizer
 *
 * @package Business_Key
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function business_key_customize_register( $wp_customize ) {
	// Load custom controls.
	require_once trailingslashit( get_template_directory() ) . 'includes/customizer/control.php';

	// Load customize helpers.
	require_once trailingslashit( get_template_directory() ) . 'includes/helpers.php';

	// Load customize sanitize.
	require_once trailingslashit( get_template_directory() ) . 'includes/customizer/sanitize.php';

	// Load customize callback.
	require_once trailingslashit( get_template_directory() ) . 'includes/customizer/callback.php';

	// Load customize options.
	require_once trailingslashit( get_template_directory() ) . 'includes/customizer/option.php';

	$wp_customize->get_setting( 'blogname' )->transport        = 'refresh';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'refresh';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

		$wp_customize->selective_refresh->add_partial(
			'blogname', array(
				'selector'        => '.site-title a',
				'render_callback' => 'business_key_customize_partial_blogname',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'blogdescription', array(
				'selector'        => '.site-description',
				'render_callback' => 'business_key_customize_partial_blogdescription',
			)
		);
	}

	$wp_customize->get_section( 'header_image' )->title = esc_html__( 'Custom Header', 'business-key' );

	// Upsell section.
	$wp_customize->add_section(
		new Business_Key_Upsell_Section( $wp_customize, 'custom_theme_upsell',
			array(
				'title'    => esc_html__( 'Business Key Pro', 'business-key' ),
				'pro_text' => esc_html__( 'Buy Pro', 'business-key' ),
				'pro_url'  => 'https://axlethemes.com/wordpress-themes/business-key-pro/',
				'priority' => 1,
			)
		)
	);
}

add_action( 'customize_register', 'business_key_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0.0
 */
function business_key_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since 1.0.0
 */
function business_key_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Enqueue Customizer assets.
 *
 * @since 1.0.0
 */
function business_key_customizer_control_scripts() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'business-key-customize-controls', get_template_directory_uri() . '/css/customize-controls' . $min . '.css', array(), '2.0.2' );
	wp_enqueue_script( 'business-key-customize-controls', get_template_directory_uri() . '/js/customize-controls' . $min . '.js', array( 'customize-controls' ), '2.0.2' );
}

add_action( 'customize_controls_enqueue_scripts', 'business_key_customizer_control_scripts', 0 );
