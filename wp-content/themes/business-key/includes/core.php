<?php
/**
 * Core functions
 *
 * @package Business_Key
 */

if ( ! function_exists( 'business_key_get_option' ) ) :

	/**
	 * Get theme option.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function business_key_get_option( $key ) {
		$business_key_default_options = business_key_get_default_theme_options();

		if ( empty( $key ) ) {
			return;
		}

		$default       = ( isset( $business_key_default_options[ $key ] ) ) ? $business_key_default_options[ $key ] : '';
		$theme_options = get_theme_mod( 'theme_options', $business_key_default_options );
		$theme_options = array_merge( $business_key_default_options, $theme_options );

		$value = '';

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		$value = apply_filters( "business_key_option_{$key}", $value, $key, $default );

		return $value;
	}

endif;

if ( ! function_exists( 'business_key_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function business_key_get_default_theme_options() {
		$defaults = array();

		// Title tagline.
		$defaults['show_title']   = true;
		$defaults['show_tagline'] = true;

		// Header.
		$defaults['header_layout']    = 1;
		$defaults['contact_number']   = '';
		$defaults['contact_email']    = '';
		$defaults['enable_cart_icon'] = true;

		// Custom Header.
		$defaults['enable_ch_title']      = true;
		$defaults['enable_ch_overlay']    = true;
		$defaults['enable_ch_opacity']    = 30;
		$defaults['enable_ch_breadcrumb'] = true;
		$defaults['bc_home_text']         = esc_html__( 'Home', 'business-key' );
		$defaults['bc_enable_title']      = true;

		// Layout.
		$defaults['global_layout']  = 'right-sidebar';
		$defaults['archive_layout'] = 'simple';

		// Blog.
		$defaults['blog_title']     = esc_html__( 'Blog', 'business-key' );
		$defaults['excerpt_length'] = 40;
		$defaults['read_more_text'] = esc_html__( 'Read More', 'business-key' );

		// Footer.
		$defaults['copyright_text']   = esc_html__( 'Copyright &copy; All rights reserved.', 'business-key' );
		$defaults['go_to_top_status'] = true;

		return apply_filters( 'business_key_filter_default_theme_options', $defaults );
	}

endif;
