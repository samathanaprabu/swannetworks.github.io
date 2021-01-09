<?php
/**
 * Functions hooked to core hooks
 *
 * @package Business_Key
 */

if ( ! function_exists( 'business_key_custom_body_class' ) ) :

	/**
	 * Custom body class.
	 *
	 * @since 1.0.0
	 *
	 * @param array $classes One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function business_key_custom_body_class( $classes ) {
		global $post;

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Global layout.
		$global_layout = business_key_get_option( 'global_layout' );
		$global_layout = apply_filters( 'business_key_filter_theme_global_layout', $global_layout );

		// Check if single template.
		if ( $post && is_singular() ) {
			$post_options = get_post_meta( $post->ID, 'business_key_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$global_layout = $post_options['post_layout'];
			}
		}

		$classes[] = 'global-layout-' . esc_attr( $global_layout );

		// Common class for three columns.
		switch ( $global_layout ) {
			case 'three-columns':
				$classes[] = 'three-columns-enabled';
				break;

			default:
				break;
		}

		// Header layout.
		$header_layout = business_key_get_option( 'header_layout' );
		$header_layout = apply_filters( 'business_key_filter_theme_header_layout', $header_layout );

		// Check if single template.
		if ( $post && is_singular() ) {
			$post_options = get_post_meta( $post->ID, 'business_key_settings', true );
			if ( isset( $post_options['header_layout'] ) && ! empty( $post_options['header_layout'] ) ) {
				$header_layout = $post_options['header_layout'];
			}
		}

		$classes[] = 'header-layout-' . absint( $header_layout );

		// Archive layout.
		$archive_layout = business_key_get_option( 'archive_layout' );
		$archive_layout = apply_filters( 'business_key_filter_theme_archive_layout', $archive_layout );
		$classes[]      = 'archive-layout-' . esc_attr( $archive_layout );

		// Footer layout.
		$classes[] = 'footer-layout-1';

		return $classes;
	}

endif;

add_filter( 'body_class', 'business_key_custom_body_class' );

if ( ! function_exists( 'business_key_pingback_header' ) ) :

	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 *
	 * @since 1.0.0
	 */
	function business_key_pingback_header() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}

endif;

add_action( 'wp_head', 'business_key_pingback_header' );

if ( ! function_exists( 'business_key_implement_excerpt_length' ) ) :

	/**
	 * Implement excerpt length.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length The number of words.
	 * @return int Excerpt length.
	 */
	function business_key_implement_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		$excerpt_length = business_key_get_option( 'excerpt_length' );
		$excerpt_length = apply_filters( 'business_key_filter_excerpt_length', $excerpt_length );

		if ( absint( $excerpt_length ) > 0 ) {
			$length = absint( $excerpt_length );
		}

		return $length;
	}

endif;

add_filter( 'excerpt_length', 'business_key_implement_excerpt_length', 999 );

if ( ! function_exists( 'business_key_implement_read_more' ) ) :

	/**
	 * Implement read more in excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function business_key_implement_read_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more = '&hellip;';
		return $more;
	}

endif;

add_filter( 'excerpt_more', 'business_key_implement_read_more' );

if ( ! function_exists( 'business_key_content_more_link' ) ) :

	/**
	 * Implement read more in content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more_link Read More link element.
	 * @param string $more_link_text Read More text.
	 * @return string Link.
	 */
	function business_key_content_more_link( $more_link, $more_link_text ) {
		$read_more_text = business_key_get_option( 'read_more_text' );

		if ( ! empty( $read_more_text ) ) {
			$more_link = str_replace( $more_link_text, esc_html( $read_more_text ), $more_link );
		}

		return $more_link;
	}

endif;

add_filter( 'the_content_more_link', 'business_key_content_more_link', 10, 2 );

if ( ! function_exists( 'business_key_footer_goto_top' ) ) :

	/**
	 * Go to top.
	 *
	 * @since 1.0.0
	 */
	function business_key_footer_goto_top() {
		$go_to_top_status = business_key_get_option( 'go_to_top_status' );
		if ( true === $go_to_top_status ) {
			echo '<a href="#page" class="scrollup" id="btn-scrollup"><i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>';
		}
	}

endif;

add_action( 'wp_footer', 'business_key_footer_goto_top', 0 );

if ( ! function_exists( 'business_key_custom_archive_title' ) ) :

	/**
	 * Custom archive title.
	 *
	 * @since 1.0.0
	 *
	 * @param string $title Archive Title.
	 * @return string Modified archive title.
	 */
	function business_key_custom_archive_title( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		} elseif ( is_tax() ) {
			$title = single_term_title( '', false );
		}

		return $title;
	}

endif;

add_filter( 'get_the_archive_title', 'business_key_custom_archive_title' );
