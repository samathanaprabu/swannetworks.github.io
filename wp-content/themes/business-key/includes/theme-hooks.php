<?php
/**
 * Functions hooked to custom hook
 *
 * @package Business_Key
 */

if ( ! function_exists( 'business_key_add_master_header' ) ) :

	/**
	 * Add master header section.
	 *
	 * @since 1.0.0
	 */
	function business_key_add_master_header() {
		$header_layout = business_key_get_option( 'header_layout' );
		$header_layout = apply_filters( 'business_key_filter_theme_header_layout', $header_layout );

		// Check if singular.
		if ( is_singular() ) {
			$post_options = get_post_meta( get_the_ID(), 'business_key_settings', true );
			if ( isset( $post_options['header_layout'] ) && ! empty( $post_options['header_layout'] ) ) {
				$header_layout = $post_options['header_layout'];
			}
		}

		get_template_part( 'template-parts/header-layout', absint( $header_layout ) );
	}

endif;

add_action( 'business_key_action_header', 'business_key_add_master_header', 10 );

if ( ! function_exists( 'business_key_add_header_banner' ) ) :

	/**
	 * Add header banner.
	 *
	 * @since 1.0.0
	 */
	function business_key_add_header_banner() {
		// Hide header banner in builder template.
		if ( is_page_template( 'templates/builder.php' ) ) {
			return;
		}

		if ( is_404() ) {
			return;
		}

		get_template_part( 'template-parts/header-banner' );
	}

endif;

add_action( 'business_key_action_header', 'business_key_add_header_banner', 15 );

if ( ! function_exists( 'business_key_add_footer_widgets' ) ) :

	/**
	 * Add footer widgets.
	 *
	 * @since 1.0.0
	 */
	function business_key_add_footer_widgets() {
		get_template_part( 'template-parts/footer-widgets' );
	}

endif;

add_action( 'business_key_action_footer', 'business_key_add_footer_widgets', 15 );

if ( ! function_exists( 'business_key_add_footer_credits' ) ) :

	/**
	 * Add footer credits.
	 *
	 * @since 1.0.0
	 */
	function business_key_add_footer_credits() {
		get_template_part( 'template-parts/footer-credits' );
	}

endif;

add_action( 'business_key_action_footer', 'business_key_add_footer_credits', 20 );

if ( ! function_exists( 'business_key_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb
	 *
	 * @since 1.0.0
	 */
	function business_key_add_breadcrumb() {
		// Bail if home page.
		if ( is_front_page() || is_home() ) {
			return;
		}

		echo '<div id="breadcrumb"><div class="breadcrumb-wrapper">';
		business_key_simple_breadcrumb();
		echo '</div><!-- .breadcrumb-wrapper --></div><!-- #breadcrumb -->';
	}

endif;

add_action( 'business_key_action_breadcrumb', 'business_key_add_breadcrumb', 10 );

if ( ! function_exists( 'business_key_customize_banner_title' ) ) :

	/**
	 * Customize banner title.
	 *
	 * @since 1.0.0
	 *
	 * @param string $title Title.
	 * @return string Modified title.
	 */
	function business_key_customize_banner_title( $title ) {
		if ( is_home() ) {
			$title = business_key_get_option( 'blog_title' );
		} elseif ( is_singular() ) {
			$title = single_post_title( '', false );
		} elseif ( is_category() || is_tag() ) {
			$title = single_term_title( '', false );
		} elseif ( is_archive() ) {
			$title = strip_tags( get_the_archive_title() );
		} elseif ( is_search() ) {
			/* translators: %s: search term */
			$title = sprintf( esc_html__( 'Search Results for: %s', 'business-key' ), get_search_query() );
		} elseif ( is_404() ) {
			$title = esc_html__( '404!', 'business-key' );
		}

		return $title;
	}

endif;

add_filter( 'business_key_filter_banner_title', 'business_key_customize_banner_title' );

if ( ! function_exists( 'business_key_add_sidebar' ) ) :

	/**
	 * Add sidebar.
	 *
	 * @since 1.0.0
	 */
	function business_key_add_sidebar() {
		global $post;

		$global_layout = business_key_get_option( 'global_layout' );
		$global_layout = apply_filters( 'business_key_filter_theme_global_layout', $global_layout );

		// Check if single template.
		if ( $post && is_singular() ) {
			$post_options = get_post_meta( $post->ID, 'business_key_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$global_layout = $post_options['post_layout'];
			}
		}

		// Include primary sidebar.
		if ( 'no-sidebar' !== $global_layout ) {
			get_sidebar();
		}

		// Include secondary sidebar.
		switch ( $global_layout ) {
			case 'three-columns':
				get_sidebar( 'secondary' );
				break;

			default:
				break;
		}
	}

endif;

add_action( 'business_key_action_sidebar', 'business_key_add_sidebar' );
