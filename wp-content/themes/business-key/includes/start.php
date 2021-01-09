<?php
/**
 * Load required files
 *
 * @package Business_Key
 */

// Load template functions.
require_once trailingslashit( get_template_directory() ) . 'includes/template-functions.php';

// Load helpers.
require_once trailingslashit( get_template_directory() ) . 'includes/helpers.php';

// Load core functions.
require_once trailingslashit( get_template_directory() ) . 'includes/core.php';

// Load setup.
require_once trailingslashit( get_template_directory() ) . 'includes/setup.php';

// Load extras.
require_once trailingslashit( get_template_directory() ) . 'includes/extras.php';

// Load theme hooks.
require_once trailingslashit( get_template_directory() ) . 'includes/theme-hooks.php';

// Load metabox.
require_once trailingslashit( get_template_directory() ) . 'includes/module/metabox.php';

// Custom template tags.
require_once trailingslashit( get_template_directory() ) . 'includes/template-tags.php';

// Customizer options.
require_once trailingslashit( get_template_directory() ) . 'includes/customizer.php';

// Load plugin recommendations.
require_once trailingslashit( get_template_directory() ) . 'includes/tgm.php';

// Load SiteOrigin.
require_once trailingslashit( get_template_directory() ) . 'includes/siteorigin/siteorigin.php';

// Load WooCommerce support.
if ( class_exists( 'WooCommerce' ) ) {
	require_once trailingslashit( get_template_directory() ) . 'includes/support/class-business-key-woocommerce.php';
}

if ( is_admin() ) {
	// Load about.
	require_once trailingslashit( get_template_directory() ) . 'vendors/about/class-about.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/module/about.php';

	// Load demo.
	require_once trailingslashit( get_template_directory() ) . 'vendors/demo/class-demo.php';
	require_once trailingslashit( get_template_directory() ) . 'includes/module/demo.php';
}
