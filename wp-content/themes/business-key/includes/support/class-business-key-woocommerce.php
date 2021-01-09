<?php
/**
 * WooCommerce support class
 *
 * @package Business_Key
 */

/**
 * Woocommerce support class.
 *
 * @since 1.0.0
 */
class Business_Key_Woocommerce {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 1.0.0
	 */
	public function init() {
		// Register widgets.
		add_action( 'widgets_init', array( $this, 'register_woo_sidebars' ) );

		// Wrapper.
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
		add_action( 'woocommerce_before_main_content', array( $this, 'woo_wrapper_start' ), 10 );
		add_action( 'woocommerce_after_main_content', array( $this, 'woo_wrapper_end' ), 10 );

		// Breadcrumb.
		add_filter( 'woocommerce_breadcrumb_defaults', array( $this, 'custom_woocommerce_breadcrumbs_defaults' ) );
		add_action( 'wp', array( $this, 'hooking_woo' ) );

		// Sidebar.
		add_action( 'woocommerce_sidebar', array( $this, 'add_secondary_sidebar' ), 11 );

		// Sidebar filter.
		add_filter( 'business_key_filter_default_sidebar_id', array( $this, 'sidebar_defaults' ), 10, 2 );

		// Customizer options.
		add_action( 'customize_register', array( $this, 'customizer_fields' ) );

		// Add default options.
		add_filter( 'business_key_filter_default_theme_options', array( $this, 'default_options' ) );

		// Modify global layout.
		add_filter( 'business_key_filter_theme_global_layout', array( $this, 'modify_global_layout' ), 15 );

		// Remove archive title.
		add_filter( 'woocommerce_show_page_title', '__return_false' );

		// Remove product title.
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

		// Loop columns.
		add_filter( 'loop_shop_columns', array( $this, 'custom_loop_columns' ) );

		// Loop columns.
		add_filter( 'loop_shop_per_page', array( $this, 'custom_loop_shop_per_page' ) );

		// Upsell columns.
		add_filter( 'woocommerce_upsells_columns', array( $this, 'custom_upsell_columns' ) );

		// Related posts loop columns.
		add_filter( 'woocommerce_related_products_columns', array( $this, 'custom_related_products_columns' ) );
	}

	/**
	 * Default options.
	 *
	 * @param  array $input Passed default options.
	 * @return array Modified default options.
	 */
	public function default_options( $input ) {
		$input['woo_page_layout']       = 'right-sidebar';
		$input['woo_sidebar_primary']   = '';
		$input['woo_sidebar_secondary'] = '';
		$input['woo_sidebar_secondary'] = '';
		$input['woo_product_per_page']  = 9;
		$input['woo_product_per_row']   = 3;
		$input['woo_sorting_dropdown']  = true;

		return $input;
	}

	/**
	 * Hooking Woocommerce.
	 *
	 * @since 1.0.0
	 */
	public function hooking_woo() {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

		if ( 'disabled' !== business_key_get_option( 'breadcrumb_type' ) && is_woocommerce() ) {
			add_action( 'business_key_add_breadcrumb', 'woocommerce_breadcrumb', 10 );
			remove_action( 'business_key_add_breadcrumb', 'business_key_add_breadcrumb', 10 );
		}

		// Fixing primary sidebar.
		$global_layout = business_key_get_option( 'global_layout' );
		$global_layout = apply_filters( 'business_key_filter_theme_global_layout', $global_layout );

		if ( in_array( $global_layout, array( 'no-sidebar' ), true ) ) {
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		}

		// Hide page title.
		if ( is_shop() ) {
			add_filter( 'woocommerce_show_page_title', '__return_false' );
		}

		// Hide custom header in shop page.
		if ( is_shop() && is_front_page() ) {
			remove_action( 'business_key_action_before_content', 'business_key_add_header_banner', 6 );
		}

		// Custom shop title.
		if ( is_shop() && ! is_front_page() ) {
			add_filter( 'business_key_filter_banner_title', array( $this, 'custom_shop_title' ) );
		}

		$woo_sorting_dropdown = business_key_get_option( 'woo_sorting_dropdown' );
		if ( false === $woo_sorting_dropdown ) {
			// Hide sorting dropdown.
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
		}
	}

	/**
	 * Modify global layout.
	 *
	 * @since 1.0.0
	 *
	 * @param string $layout Layout.
	 */
	public function modify_global_layout( $layout ) {
		$woo_page_layout = business_key_get_option( 'woo_page_layout' );

		if ( is_woocommerce() && ! empty( $woo_page_layout ) ) {
			$layout = esc_attr( $woo_page_layout );
		}

		// Fix layout in shop.
		if ( is_shop() ) {
			$shop_id = absint( wc_get_page_id( 'shop' ) );
			if ( $shop_id > 0 ) {
				$post_options = get_post_meta( $shop_id, 'business_key_settings', true );
				if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
					$layout = esc_attr( $post_options['post_layout'] );
				}
			}
		}

		return $layout;
	}

	/**
	 * Add extra customizer options for WooCommerce.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function customizer_fields( $wp_customize ) {
		$default = business_key_get_default_theme_options();

		// WooCommerce Section.
		$wp_customize->add_section(
			'section_theme_woocommerce',
			array(
				'title'       => esc_html__( 'WooCommerce Options', 'business-key' ),
				'description' => esc_html__( 'Settings specific to WooCommerce. Note: WooCommerce Page means shop page, product page and product archive page.', 'business-key' ),
				'panel'       => 'theme_option_panel',
			)
		);

		// Setting - woo_page_layout.
		$wp_customize->add_setting(
			'theme_options[woo_page_layout]',
			array(
				'default'           => $default['woo_page_layout'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'business_key_sanitize_select',
			)
		);
		$wp_customize->add_control(
			'theme_options[woo_page_layout]',
			array(
				'label'   => esc_html__( 'Content Layout', 'business-key' ),
				'section' => 'section_theme_woocommerce',
				'type'    => 'select',
				'choices' => business_key_get_global_layout_options(),
			)
		);

		// Setting - woo_sidebar_primary.
		$wp_customize->add_setting(
			'theme_options[woo_sidebar_primary]',
			array(
				'default'           => $default['woo_sidebar_primary'],
				'sanitize_callback' => 'business_key_sanitize_select',
			)
		);
		$wp_customize->add_control(
			new Business_Key_Dropdown_Sidebars_Control(
				$wp_customize, 'theme_options[woo_sidebar_primary]',
				array(
					'label'       => esc_html__( 'Primary Sidebar', 'business-key' ),
					'description' => esc_html__( 'Choose Primary Sidebar for WooCommerce pages. If not selected default sidebar will be displayed.', 'business-key' ),
					'section'     => 'section_theme_woocommerce',
					'settings'    => 'theme_options[woo_sidebar_primary]',
				)
			)
		);

		// Setting - woo_sidebar_secondary.
		$wp_customize->add_setting(
			'theme_options[woo_sidebar_secondary]',
			array(
				'default'           => $default['woo_sidebar_secondary'],
				'sanitize_callback' => 'business_key_sanitize_select',
			)
		);
		$wp_customize->add_control(
			new Business_Key_Dropdown_Sidebars_Control(
				$wp_customize, 'theme_options[woo_sidebar_secondary]',
				array(
					'label'       => esc_html__( 'Secondary Sidebar', 'business-key' ),
					'description' => esc_html__( 'Choose Secondary Sidebar for WooCommerce pages. If not selected default sidebar will be displayed.', 'business-key' ),
					'section'     => 'section_theme_woocommerce',
					'settings'    => 'theme_options[woo_sidebar_secondary]',
				)
			)
		);

		// Setting - woo_product_per_page.
		$wp_customize->add_setting(
			'theme_options[woo_product_per_page]',
			array(
				'default'           => $default['woo_product_per_page'],
				'sanitize_callback' => 'business_key_sanitize_positive_integer',
			)
		);
		$wp_customize->add_control(
			'theme_options[woo_product_per_page]',
			array(
				'label'       => esc_html__( 'Products Per Page', 'business-key' ),
				'section'     => 'section_theme_woocommerce',
				'type'        => 'number',
				'input_attrs' => array(
					'min'   => 1,
					'max'   => 100,
					'style' => 'width: 55px;',
				),
			)
		);

		// Setting - woo_product_per_row.
		$wp_customize->add_setting(
			'theme_options[woo_product_per_row]',
			array(
				'default'           => $default['woo_product_per_row'],
				'sanitize_callback' => 'business_key_sanitize_positive_integer',
			)
		);
		$wp_customize->add_control(
			'theme_options[woo_product_per_row]',
			array(
				'label'       => esc_html__( 'Products Per Page', 'business-key' ),
				'section'     => 'section_theme_woocommerce',
				'type'        => 'number',
				'input_attrs' => array(
					'min'   => 3,
					'max'   => 4,
					'style' => 'width: 55px;',
				),
			)
		);

		// Setting - woo_sorting_dropdown.
		$wp_customize->add_setting(
			'theme_options[woo_sorting_dropdown]',
			array(
				'default'           => $default['woo_sorting_dropdown'],
				'sanitize_callback' => 'business_key_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			'theme_options[woo_sorting_dropdown]',
			array(
				'label'   => esc_html__( 'Enable Sorting Dropdown', 'business-key' ),
				'section' => 'section_theme_woocommerce',
				'type'    => 'checkbox',
			)
		);
	}

	/**
	 * Register Woocommerce sidebars.
	 *
	 * @since 1.0.0
	 */
	public function register_woo_sidebars() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'WooCommerce Primary', 'business-key' ),
				'id'            => 'sidebar-woocommerce-primary',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'WooCommerce Secondary', 'business-key' ),
				'id'            => 'sidebar-woocommerce-secondary',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}

	/**
	 * Add secondary sidebar in Woocommerce.
	 *
	 * @since 1.0.0
	 */
	public function add_secondary_sidebar() {
		$global_layout = business_key_get_option( 'global_layout' );
		$global_layout = apply_filters( 'business_key_filter_theme_global_layout', $global_layout );

		switch ( $global_layout ) {
			case 'three-columns':
				get_sidebar( 'secondary' );
				break;

			default:
				break;
		}
	}

	/**
	 * Woocommerce content wrapper start.
	 *
	 * @since 1.0.0
	 */
	public function woo_wrapper_start() {
		echo '<div id="primary">';
		echo '<main role="main" class="site-main" id="main">';
	}

	/**
	 * Woocommerce content wrapper end.
	 *
	 * @since 1.0.0
	 */
	public function woo_wrapper_end() {
		echo '</main><!-- #main -->';
		echo '</div><!-- #primary -->';
	}

	/**
	 * Woocommerce breadcrumb defaults.
	 *
	 * @since 1.0.0
	 *
	 * @param array $defaults Breadcrumb defaults.
	 * @return array Modified breadcrumb defaults.
	 */
	public function custom_woocommerce_breadcrumbs_defaults( $defaults ) {
		$defaults['delimiter']   = '';
		$defaults['wrap_before'] = '<div id="breadcrumb" itemprop="breadcrumb"><ul id="crumbs">';
		$defaults['wrap_after']  = '</ul></div>';
		$defaults['before']      = '<li>';
		$defaults['after']       = '</li>';
		$defaults['home']        = esc_html__( 'Home', 'business-key' );

		return $defaults;
	}

	/**
	 * Modify woo sidebar id defaults.
	 *
	 * @param  string $id       Sidebar ID.
	 * @param  string $location Sidebar position.
	 * @return string           Modified default sidebar id.
	 */
	public function sidebar_defaults( $id, $location ) {
		if ( ! is_woocommerce() ) {
			return $id;
		}

		switch ( $location ) {
			case 'primary':
				$woo_sidebar_primary = business_key_get_option( 'woo_sidebar_primary' );
				if ( ! empty( $woo_sidebar_primary ) ) {
					$id = esc_attr( $woo_sidebar_primary );
				}
				break;
			case 'secondary':
				$woo_sidebar_secondary = business_key_get_option( 'woo_sidebar_secondary' );
				if ( ! empty( $woo_sidebar_secondary ) ) {
					$id = esc_attr( $woo_sidebar_secondary );
				}
				break;

			default:
				break;
		}

		return $id;
	}

	/**
	 * Custom loop columns.
	 *
	 * @since 1.0.0
	 *
	 * @param int $column Number.
	 * @return int Modified number.
	 */
	public function custom_loop_columns( $column ) {
		$woo_product_per_row = business_key_get_option( 'woo_product_per_row' );

		if ( absint( $woo_product_per_row ) > 0 ) {
			$column = absint( $woo_product_per_row );
		}

		return $column;
	}

	/**
	 * Custom loop shop per page.
	 *
	 * @since 1.0.0
	 *
	 * @param int $col Number.
	 * @return int Modified number.
	 */
	public function custom_loop_shop_per_page( $col ) {
		$woo_product_per_page = business_key_get_option( 'woo_product_per_page' );

		if ( absint( $woo_product_per_page ) > 0 ) {
			$col = absint( $woo_product_per_page );
		}

		return $col;
	}

	/**
	 * Custom upsell columns.
	 *
	 * @since 1.0.0
	 *
	 * @param int $column Number.
	 * @return int Modified number.
	 */
	public function custom_upsell_columns( $column ) {
		$woo_product_per_row = business_key_get_option( 'woo_product_per_row' );

		if ( absint( $woo_product_per_row ) > 0 ) {
			$column = absint( $woo_product_per_row );
		}

		return $column;
	}

	/**
	 * Columns in related products.
	 *
	 * @since 1.0.0
	 *
	 * @param int $column Number.
	 * @return int Modified number.
	 */
	public function custom_related_products_columns( $column ) {
		$woo_product_per_row = business_key_get_option( 'woo_product_per_row' );

		if ( absint( $woo_product_per_row ) > 0 ) {
			$column = absint( $woo_product_per_row );
		}

		return $column;
	}

	/**
	 * Custom shop title.
	 *
	 * @since 1.0.0
	 */
	public function custom_shop_title() {
		$shop_title   = esc_html__( 'Shop', 'business-key' );
		$shop_page_id = get_option( 'woocommerce_shop_page_id' );

		if ( $shop_page_id ) {
			$shop_title = get_the_title( $shop_page_id );
		}

		return $shop_title;
	}
}

// Initialize.
$business_key_woocommerce = new Business_Key_Woocommerce();
