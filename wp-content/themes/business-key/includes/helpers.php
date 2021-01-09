<?php
/**
 * Helper functions
 *
 * @package Business_Key
 */

if ( ! function_exists( 'business_key_get_image_sizes_options' ) ) :

	/**
	 * Returns image sizes options.
	 *
	 * @since 1.0.0
	 *
	 * @param bool  $add_disable    True for adding No Image option.
	 * @param array $allowed        Allowed image size options.
	 * @param bool  $show_dimension True to show dimension.
	 * @return array Image size options.
	 */
	function business_key_get_image_sizes_options( $add_disable = true, $allowed = array(), $show_dimension = true ) {
		global $_wp_additional_image_sizes;

		$choices = array();
		if ( true === $add_disable ) {
			$choices['disable'] = esc_html__( 'No Image', 'business-key' );
		}

		$choices['thumbnail'] = esc_html__( 'Thumbnail', 'business-key' );
		$choices['medium']    = esc_html__( 'Medium', 'business-key' );
		$choices['large']     = esc_html__( 'Large', 'business-key' );
		$choices['full']      = esc_html__( 'Full (original)', 'business-key' );

		if ( true === $show_dimension ) {
			foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
				$choices[ $_size ] = $choices[ $_size ] . ' (' . get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
			}
		}

		if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
			foreach ( $_wp_additional_image_sizes as $key => $size ) {
				$choices[ $key ] = $key;
				if ( true === $show_dimension ) {
					$choices[ $key ] .= ' (' . $size['width'] . 'x' . $size['height'] . ')';
				}
			}
		}

		if ( ! empty( $allowed ) ) {
			foreach ( $choices as $key => $value ) {
				if ( ! in_array( $key, $allowed, true ) ) {
					unset( $choices[ $key ] );
				}
			}
		}

		return $choices;
	}

endif;

if ( ! function_exists( 'business_key_get_alignment_options' ) ) :

	/**
	 * Returns alignment options.
	 *
	 * @since 1.0.0
	 *
	 * @param array $allowed Allowed options.
	 *
	 * @return array Options array.
	 */
	function business_key_get_alignment_options( $allowed = array() ) {
		$output = array();

		$choices = array(
			'none'   => esc_html_x( 'None', 'alignment', 'business-key' ),
			'left'   => esc_html_x( 'Left', 'alignment', 'business-key' ),
			'center' => esc_html_x( 'Center', 'alignment', 'business-key' ),
			'right'  => esc_html_x( 'Right', 'alignment', 'business-key' ),
		);

		if ( ! empty( $allowed ) ) {
			foreach ( $choices as $key => $value ) {
				if ( in_array( $key, $allowed, true ) ) {
					$output[ $key ] = $value;
				}
			}
		} else {
			$output = $choices;
		}

		return $output;
	}

endif;

if ( ! function_exists( 'business_key_get_heading_alignment_options' ) ) :

	/**
	 * Returns heading alignment options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function business_key_get_heading_alignment_options() {
		return business_key_get_alignment_options( array( 'left', 'center', 'right' ) );
	}

endif;

if ( ! function_exists( 'business_key_get_numbers_dropdown_options' ) ) :

	/**
	 * Returns numbers dropdown options.
	 *
	 * @since 1.0.0
	 *
	 * @param int    $min    Min.
	 * @param int    $max    Max.
	 * @param string $prefix Prefix.
	 * @param string $suffix Suffix.
	 * @return array Options array.
	 */
	function business_key_get_numbers_dropdown_options( $min = 1, $max = 4, $prefix = '', $suffix = '' ) {
		$output = array();

		if ( $min <= $max ) {
			for ( $i = $min; $i <= $max; $i++ ) {
				$string       = $prefix . $i . $suffix;
				$output[ $i ] = $string;
			}
		}

		return $output;
	}

endif;

if ( ! function_exists( 'business_key_get_global_layout_options' ) ) :

	/**
	 * Returns global layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function business_key_get_global_layout_options() {
		$output = array(
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'business-key' ),
			'right-sidebar' => esc_html__( 'Right Sidebar', 'business-key' ),
			'three-columns' => esc_html__( 'Three Columns', 'business-key' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'business-key' ),
		);

		return $output;
	}

endif;

if ( ! function_exists( 'business_key_get_archive_layout_options' ) ) :

	/**
	 * Returns archive layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function business_key_get_archive_layout_options() {
		$output = array(
			'simple'        => esc_html__( 'Simple', 'business-key' ),
			'excerpt-left'  => esc_html__( 'Excerpt Left', 'business-key' ),
			'excerpt-right' => esc_html__( 'Excerpt Right', 'business-key' ),
		);

		return $output;
	}

endif;

if ( ! function_exists( 'business_key_get_header_layout_options' ) ) :

	/**
	 * Returns header layout options.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $add_default Whether to add default or not.
	 * @return array Options array.
	 */
	function business_key_get_header_layout_options( $add_default = false ) {
		$output = array(
			'1' => array(
				'label' => esc_html__( 'One', 'business-key' ),
				'url'   => get_template_directory_uri() . '/images/header-layout-1.png',
			),
			'2' => array(
				'label' => esc_html__( 'Two', 'business-key' ),
				'url'   => get_template_directory_uri() . '/images/header-layout-2.png',
			),
		);

		if ( true === $add_default ) {
			$item = array(
				'label' => esc_html__( 'Default', 'business-key' ),
				'url'   => get_template_directory_uri() . '/images/header-layout-default.png',
			);
			array_unshift( $output, $item );
		}

		return $output;
	}

endif;
