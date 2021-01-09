<?php
/**
 * Theme setup
 *
 * @package Business_Key
 */

if ( ! function_exists( 'business_key_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since 1.0.0
	 */
	function business_key_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'business-key', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails.
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'business-key-thumb', 570, 450, true );
		add_image_size( 'business-key-landscape', 800, 400, true );

		// Register nav menus.
		register_nav_menus(
			array(
				'menu-1'      => esc_html__( 'Primary', 'business-key' ),
				'menu-footer' => esc_html__( 'Footer', 'business-key' ),
			)
		);

		// Add support for HTML5 markup.
		add_theme_support(
			'html5', array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Enable support for selective refresh of widgets in Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Enable support for custom logo.
		add_theme_support(
			'custom-logo', array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		// Enable admin editor style.
		add_editor_style( array( business_key_fonts_url(), 'css/editor-style' . $min . '.css' ) );

		// Enable support for WooCommerce.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );

		// Add support for Custom Header.
		add_theme_support(
			'custom-header', apply_filters(
				'business_key_custom_header_args', array(
					'default-image'  => get_template_directory_uri() . '/images/custom-header.png',
					'width'          => 1920,
					'height'         => 315,
					'flex-height'    => true,
					'header-text'    => false,
					'random-default' => false,
				)
			)
		);

		// Register default headers.
		register_default_headers(
			array(
				'main-banner' => array(
					'url'           => '%s/images/custom-header.png',
					'thumbnail_url' => '%s/images/custom-header.png',
					'description'   => esc_html_x( 'Main Banner', 'custom header image description', 'business-key' ),
				),
			)
		);
	}

endif;

add_action( 'after_setup_theme', 'business_key_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @since 1.0.0
 *
 * @global int $content_width
 */
function business_key_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'business_key_content_width', 640 );
}

add_action( 'after_setup_theme', 'business_key_content_width', 0 );

/**
 * Register widget area.
 *
 * @since 1.0.0
 */
function business_key_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Primary Sidebar', 'business-key' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your primary sidebar.', 'business-key' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Secondary Sidebar', 'business-key' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Add widgets here to appear in your secondary sidebar.', 'business-key' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	for ( $i = 1; $i <= 4; $i++ ) {
		register_sidebar(
			array(
				/* translators: %s: footer number */
				'name'          => sprintf( esc_html__( 'Footer %d', 'business-key' ), $i ),
				'id'            => 'footer-' . $i,
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}
}

add_action( 'widgets_init', 'business_key_widgets_init' );

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function business_key_scripts() {
	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/vendors/font-awesome/css/font-awesome' . $min . '.css', '', '4.7.0' );

	$fonts_url = business_key_fonts_url();

	if ( ! empty( $fonts_url ) ) {
		wp_enqueue_style( 'business-key-google-fonts', $fonts_url, array(), null );
	}

	wp_enqueue_style( 'jquery-sidr', get_template_directory_uri() . '/vendors/sidr/css/jquery.sidr.dark' . $min . '.css', '', '2.2.1' );

	wp_enqueue_style( 'business-key-style', get_stylesheet_uri(), array(), '2.0.2' );

	$css               = '';
	$enable_ch_overlay = business_key_get_option( 'enable_ch_overlay' );

	if ( true === $enable_ch_overlay ) {
		$enable_ch_opacity = business_key_get_option( 'enable_ch_opacity' );

		$css .= '#custom-header:after{opacity:' . esc_attr( $enable_ch_opacity / 100 ) . ';}';
	}

	if ( $css ) {
		wp_add_inline_style( 'business-key-style', $css );
	}

	wp_enqueue_script( 'jquery-sidr', get_template_directory_uri() . '/vendors/sidr/js/jquery.sidr' . $min . '.js', array( 'jquery' ), '2.2.1', true );

	wp_enqueue_script( 'business-key-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'business-key-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'business-key-custom', get_template_directory_uri() . '/js/custom' . $min . '.js', array( 'jquery' ), '2.0.2', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'business_key_scripts' );
