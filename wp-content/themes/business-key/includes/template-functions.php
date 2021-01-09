<?php
/**
 * Template functions
 *
 * @package Business_Key
 */

if ( ! function_exists( 'business_key_get_the_excerpt' ) ) :

	/**
	 * Fetch excerpt from the post.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $length      Excerpt length.
	 * @param WP_Post $post_object WP_Post instance.
	 * @return string Excerpt content.
	 */
	function business_key_get_the_excerpt( $length, $post_object = null ) {
		global $post;

		if ( is_null( $post_object ) ) {
			$post_object = $post;
		}

		$length = absint( $length );

		if ( 0 === $length ) {
			return;
		}

		$source_content = $post_object->post_content;

		if ( ! empty( $post_object->post_excerpt ) ) {
			$source_content = $post_object->post_excerpt;
		}

		$source_content  = strip_shortcodes( $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '&hellip;' );

		return $trimmed_content;
	}

endif;

if ( ! function_exists( 'business_key_fonts_url' ) ) :

	/**
	 * Return fonts URL.
	 *
	 * @since 1.0.0
	 * @return string Font URL.
	 */
	function business_key_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Oswald, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Oswald font: on or off', 'business-key' ) ) {
			$fonts[] = 'Oswald:300,400,500,700';
		}

		/* translators: If there are characters in your language that are not supported by Sintony, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Sintony font: on or off', 'business-key' ) ) {
			$fonts[] = 'Sintony:300,400,500,700';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}

endif;

if ( ! function_exists( 'business_key_primary_navigation_fallback' ) ) :

	/**
	 * Fallback for primary navigation.
	 *
	 * @since 1.0.0
	 */
	function business_key_primary_navigation_fallback() {
		echo '<ul>';
		echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'business-key' ) . '</a></li>';

		wp_list_pages(
			array(
				'title_li' => '',
				'depth'    => 1,
				'number'   => 5,
			)
		);

		echo '</ul>';
	}

endif;

if ( ! function_exists( 'business_key_get_single_post_category' ) ) :

	/**
	 * Get single post category.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Post $post_object WP_Post instance.
	 * @return array Category details.
	 */
	function business_key_get_single_post_category( $post_object = null ) {
		$output = array();

		global $post;

		if ( is_null( $post_object ) ) {
			$post_object = $post;
		}

		$terms = get_the_terms( $post_object, 'category' );

		if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
			$first_term        = array_shift( $terms );
			$output['name']    = $first_term->name;
			$output['slug']    = $first_term->slug;
			$output['term_id'] = $first_term->term_id;
			$output['url']     = get_term_link( $first_term );
		}

		return $output;
	}

endif;

if ( ! function_exists( 'business_key_get_social_links' ) ) :

	/**
	 * Get social links.
	 *
	 * @since 1.0.0
	 *
	 * @return array Social links.
	 */
	function business_key_get_social_links() {
		$output = array();

		$social_links = business_key_get_option( 'social_links' );

		if ( ! empty( $social_links ) ) {
			$exploded = explode( '|', $social_links );
			if ( ! empty( $exploded ) ) {
				$output = $exploded;
				$output = array_filter( $output );
			}
		}

		return $output;
	}

endif;

if ( ! function_exists( 'business_key_render_social_links' ) ) :

	/**
	 * Render social links.
	 *
	 * @since 1.0.0
	 *
	 * @param string $type Icon type.
	 */
	function business_key_render_social_links( $type = 'circle' ) {
		$social_links = business_key_get_social_links();
		if ( empty( $social_links ) ) {
			return;
		}

		echo '<div class="social-links ' . esc_attr( $type ) . '">';
		echo '<ul>';
		foreach ( $social_links as $link ) {
			echo '<li><a href="' . esc_url( $link ) . '"></a></li>';
		}
		echo '</ul>';
		echo '</div>';
	}

endif;

if ( ! function_exists( 'business_key_simple_breadcrumb' ) ) :

	/**
	 * Simple breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function business_key_simple_breadcrumb() {
		if ( ! function_exists( 'breadcrumb_trail' ) ) {
			require_once trailingslashit( get_template_directory() ) . 'vendors/breadcrumbs/breadcrumbs.php';
		}

		$bc_home_text    = business_key_get_option( 'bc_home_text' );
		$bc_enable_title = business_key_get_option( 'bc_enable_title' );

		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
			'show_title'  => (bool) $bc_enable_title,
			'labels'      => array(
				'home' => esc_html( $bc_home_text ),
			),
		);

		breadcrumb_trail( $breadcrumb_args );
	}

endif;

if ( ! function_exists( 'business_key_single_post_thumbnail' ) ) :

	/**
	 * Single post thumbnail.
	 *
	 * @since 1.0.0
	 */
	function business_key_single_post_thumbnail() {
		if ( has_post_thumbnail() ) {
			$args = array(
				'class' => 'aligncenter',
			);
			echo '<div class="entry-thumb">';
			the_post_thumbnail( 'large', $args );
			echo '</div><!-- .entry-thumb -->';
		}
	}

endif;

if ( ! function_exists( 'business_key_archive_post_thumbnail' ) ) :

	/**
	 * Archive post thumbnail.
	 *
	 * @since 1.0.0
	 */
	function business_key_archive_post_thumbnail() {
		$archive_layout = business_key_get_option( 'archive_layout' );

		$image_size = ( 'simple' === $archive_layout ) ? 'business-key-landscape' : 'business-key-thumb';
		?>
		<div class="entry-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php
					$args = array(
						'class' => 'business-key-post-thumb',
					);
					the_post_thumbnail( $image_size, $args );
					?>
				<?php endif; ?>
			</a>
		</div><!-- .entry-thumb -->
		<?php
	}

endif;

if ( ! function_exists( 'business_key_render_site_branding' ) ) :

	/**
	 * Render site branding.
	 *
	 * @since 1.0.0
	 */
	function business_key_render_site_branding() {
		$show_title   = business_key_get_option( 'show_title' );
		$show_tagline = business_key_get_option( 'show_tagline' );
		?>
		<div class="site-branding">
			<?php business_key_the_custom_logo(); ?>
			<?php if ( true === $show_title || true === $show_tagline ) : ?>
				<div id="site-identity">
					<?php if ( true === $show_title ) : ?>
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ( true === $show_tagline ) : ?>
						<?php
						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) :
						?>
							<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php endif; ?>
					<?php endif; ?>
				</div><!-- #site-identity -->
			<?php endif; ?>
		</div><!-- .site-branding -->
		<?php
	}

endif;

if ( ! function_exists( 'business_key_the_custom_logo' ) ) :

	/**
	 * Render logo.
	 *
	 * @since 1.0.0
	 */
	function business_key_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}

endif;

if ( ! function_exists( 'business_key_render_contact_info' ) ) :

	/**
	 * Render contact info.
	 *
	 * @since 1.0.0
	 */
	function business_key_render_contact_info() {
		$contact_number = business_key_get_option( 'contact_number' );
		$contact_email  = business_key_get_option( 'contact_email' );

		if ( empty( $contact_number ) && empty( $contact_email ) ) {
			return;
		}
		?>
		<div class="quick-contact">
			<ul>
				<?php if ( ! empty( $contact_number ) ) : ?>
					<li class="quick-call">
						<a href="<?php echo esc_url( 'tel:' . preg_replace( '/\D+/', '', $contact_number ) ); ?>"><span class="contact-label"><?php esc_html_e( 'Call Us:', 'business-key' ); ?></span><span class="contact-value"><?php echo esc_html( $contact_number ); ?></span></a>
					</li>
				<?php endif; ?>
				<?php if ( ! empty( $contact_email ) ) : ?>
					<li class="quick-email">
						<a href="<?php echo esc_url( 'mailto:' . $contact_email ); ?>"><span class="email-label"><?php esc_html_e( 'Email:', 'business-key' ); ?></span><span class="email-icon"><i class="fa fa-envelope" aria-hidden="true"></i></span><span class="email-value"><?php echo esc_html( antispambot( $contact_email ) ); ?></span></a>
					</li>
				<?php endif; ?>
			</ul>
		</div><!-- .quick-contact -->
		<?php
	}

endif;

if ( ! function_exists( 'business_key_woocommerce_status' ) ) :

	/**
	 * Return WooCommerce status.
	 *
	 * @since 1.0.0
	 *
	 * @return bool Active status.
	 */
	function business_key_woocommerce_status() {
		return class_exists( 'WooCommerce' );
	}

endif;

if ( ! function_exists( 'business_key_read_more' ) ) :

	/**
	 * Display read more link.
	 *
	 * @since 1.0.0
	 */
	function business_key_read_more() {
		global $post;
		$read_more_text = business_key_get_option( 'read_more_text' );
		if ( empty( $read_more_text ) ) {
			return;
		}
		?>
		<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" class="more-link"><?php echo esc_html( $read_more_text ); ?></a>
		<?php
	}

endif;

if ( ! function_exists( 'business_key_display_cart_icon' ) ) :

	/**
	 * Display cart content.
	 *
	 * @since 1.0.0
	 */
	function business_key_display_cart_icon() {
		$output  = '';
		$output .= '<div id="cart-section">';
		$output .= '<a href="' . esc_url( wc_get_cart_url() ) . '" class="cart-icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i><strong>' . absint( WC()->cart->get_cart_contents_count() ) . '</strong></a>';
		$output .= '</div>';
		echo $output;
	}

endif;
