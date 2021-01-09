<?php
/**
 * Plugin recommendations
 *
 * @package Business_Key
 */

// Load TGM library.
require_once trailingslashit( get_template_directory() ) . 'vendors/tgm/class-tgm-plugin-activation.php';

if ( ! function_exists( 'business_key_register_recommended_plugins' ) ) :

	/**
	 * Register recommended plugins.
	 *
	 * @since 1.0.0
	 */
	function business_key_register_recommended_plugins() {
		$plugins = array(
			array(
				'name'     => esc_html__( 'Page Builder by SiteOrigin', 'business-key' ),
				'slug'     => 'siteorigin-panels',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'SiteOrigin Widgets Bundle', 'business-key' ),
				'slug'     => 'so-widgets-bundle',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'WooCommerce', 'business-key' ),
				'slug'     => 'woocommerce',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'One Click Demo Import', 'business-key' ),
				'slug'     => 'one-click-demo-import',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'MailChimp for WordPress', 'business-key' ),
				'slug'     => 'mailchimp-for-wp',
				'required' => false,
			),
		);

		tgmpa( $plugins );
	}

endif;

add_action( 'tgmpa_register', 'business_key_register_recommended_plugins' );
