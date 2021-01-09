<?php
/**
 * Sanitization functions
 *
 * @package Business_Key
 */

if ( ! function_exists( 'business_key_sanitize_select' ) ) :

	/**
	 * Sanitize select.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed                $input The value to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return mixed Sanitized value.
	 */
	function business_key_sanitize_select( $input, $setting ) {
		$input = sanitize_text_field( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

endif;

if ( ! function_exists( 'business_key_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	function business_key_sanitize_checkbox( $checked ) {
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}

endif;

if ( ! function_exists( 'business_key_sanitize_positive_integer' ) ) :

	/**
	 * Sanitize positive integer.
	 *
	 * @since 1.0.0
	 *
	 * @param int                  $input Number to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return int Sanitized number; otherwise, the setting default.
	 */
	function business_key_sanitize_positive_integer( $input, $setting ) {
		$input = absint( $input );

		// If the input is an positive integer, return it.
		// otherwise, return the default.
		return ( $input ? $input : $setting->default );
	}

endif;

if ( ! function_exists( 'business_key_sanitize_dropdown_pages' ) ) :

	/**
	 * Sanitize dropdown pages.
	 *
	 * @since 1.0.0
	 *
	 * @param int                  $page_id Page ID.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return int|string Page ID if the page is published; otherwise, the setting default.
	 */
	function business_key_sanitize_dropdown_pages( $page_id, $setting ) {
		// Ensure $input is an absolute integer.
		$page_id = absint( $page_id );

		// If $page_id is an ID of a published page, return it; otherwise, return the default.
		return ( 'publish' === get_post_status( $page_id ) ? $page_id : $setting->default );
	}

endif;

if ( ! function_exists( 'business_key_sanitize_image' ) ) :

	/**
	 * Sanitize image.
	 *
	 * @since 1.0.0
	 *
	 * @param string               $image Image filename.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return string The image filename if the extension is allowed; otherwise, the setting default.
	 */
	function business_key_sanitize_image( $image, $setting ) {
		// Array of valid image file types.
		$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png',
			'bmp'          => 'image/bmp',
			'tif|tiff'     => 'image/tiff',
			'ico'          => 'image/x-icon',
		);

		// Return an array with file extension and mime_type.
		$file = wp_check_filetype( $image, $mimes );

		// If $image has a valid mime_type, return it; otherwise, return the default.
		return ( $file['ext'] ? esc_url_raw( $image ) : $setting->default );
	}

endif;

if ( ! function_exists( 'business_key_sanitize_number_range' ) ) :

	/**
	 * Sanitize number range.
	 *
	 * @since 1.0.0
	 *
	 * @param int                  $input Number to check within the numeric range defined by the setting.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return int|string The number, if it is zero or greater and falls within the defined range; otherwise, the setting default.
	 */
	function business_key_sanitize_number_range( $input, $setting ) {
		// Ensure input is an absolute integer.
		$input = absint( $input );

		// Get the input attributes associated with the setting.
		$atts = $setting->manager->get_control( $setting->id )->input_attrs;

		// Get min.
		$min = ( isset( $atts['min'] ) ? $atts['min'] : $input );

		// Get max.
		$max = ( isset( $atts['max'] ) ? $atts['max'] : $input );

		// Get Step.
		$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );

		// If the input is within the valid range, return it; otherwise, return the default.
		return ( $min <= $input && $input <= $max && is_int( $input / $step ) ? $input : $setting->default );
	}

endif;

if ( ! function_exists( 'business_key_sanitize_textarea' ) ) :

	/**
	 * Sanitize textarea.
	 *
	 * @since 1.0.0
	 *
	 * @param string $input Content to be sanitized.
	 * @return string Sanitized content.
	 */
	function business_key_sanitize_textarea( $input ) {
		return wp_kses_post( $input );
	}

endif;

if ( ! function_exists( 'business_key_sanitize_social_links' ) ) :

	/**
	 * Sanitize social links.
	 *
	 * @since 1.0.0
	 *
	 * @param mixed $input The value to sanitize.
	 * @return mixed Sanitized value.
	 */
	function business_key_sanitize_social_links( $input ) {
		if ( empty( $input ) ) {
			return '';
		}

		$items    = explode( '|', $input );
		$filtered = array_map( 'esc_url_raw', $items );
		$output   = implode( '|', $filtered );

		return $output;
	}

endif;
