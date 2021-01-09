<?php
/**
 * Callback functions for active_callback
 *
 * @package Business_Key
 */

if ( ! function_exists( 'business_key_is_breadcrumb_active_callback' ) ) :

	/**
	 * Check if breadcrumb is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function business_key_is_breadcrumb_active_callback( $control ) {
		if ( $control->manager->get_setting( 'theme_options[enable_ch_breadcrumb]' )->value() ) {
			return true;
		} else {
			return false;
		}
	}

endif;

if ( ! function_exists( 'business_key_is_custom_header_overlay_active_callback' ) ) :

	/**
	 * Check if custom header overlay is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function business_key_is_custom_header_overlay_active_callback( $control ) {
		if ( $control->manager->get_setting( 'theme_options[enable_ch_overlay]' )->value() ) {
			return true;
		} else {
			return false;
		}
	}

endif;
