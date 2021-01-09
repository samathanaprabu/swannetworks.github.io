<?php
/**
 * Latest news widget
 *
 * Widget Name: Business Key Latest News
 * Description: Displays latest posts.
 * Author: Axle Themes
 * Author URI: https://axlethemes.com
 *
 * @package Business_Key
 */

/**
 * Latest news widget class.
 *
 * @since 1.0.0
 */
class Business_Key_Latest_News_Widget extends SiteOrigin_Widget {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		parent::__construct(
			'business-key-latest-news',
			esc_html__( 'Business Key: Latest News', 'business-key' ),
			array(
				'description' => esc_html__( 'Displays latest posts.', 'business-key' ),
			),
			array(),
			false,
			plugin_dir_path( __FILE__ )
		);
	}

	/**
	 * Get widget form.
	 *
	 * @since 1.0.0
	 *
	 * @return array Widget form.
	 */
	public function get_widget_form() {

		return array(
			'post_category'       => array(
				'label'           => esc_html__( 'Select Category', 'business-key' ),
				'type'            => 'taxonomy-dropdown',
				'show_option_all' => esc_html__( 'All Categories', 'business-key' ),
			),
			'post_number'         => array(
				'label'   => esc_html__( 'Number of Posts', 'business-key' ),
				'type'    => 'number',
				'default' => 3,
			),
			'layout_mode'         => array(
				'label'         => esc_html__( 'Layout Mode', 'business-key' ),
				'type'          => 'radio',
				'default'       => 'grid',
				'state_emitter' => array(
					'callback' => 'in',
					'args'     => array(
						'layout_type[grid]: grid',
						'layout_type[carousel]: carousel',
					),
				),
				'options'       => array(
					'grid'     => esc_html__( 'Grid', 'business-key' ),
					'carousel' => esc_html__( 'Carousel', 'business-key' ),
				),
			),
			'grid_design'         => array(
				'label'         => esc_html__( 'Grid Design', 'business-key' ),
				'type'          => 'select',
				'default'       => 1,
				'options'       => business_key_get_numbers_dropdown_options( 1, 2 ),
				'state_handler' => array(
					'layout_type[grid]'  => array( 'show' ),
					'_else[layout_type]' => array( 'hide' ),
				),
			),
			'post_column'         => array(
				'label'         => esc_html__( 'Number of Columns', 'business-key' ),
				'type'          => 'select',
				'default'       => 3,
				'options'       => business_key_get_numbers_dropdown_options( 1, 3 ),
				'state_handler' => array(
					'layout_type[grid]'  => array( 'show' ),
					'_else[layout_type]' => array( 'hide' ),
				),
			),
			'post_display'        => array(
				'label'         => esc_html__( 'Posts to Display', 'business-key' ),
				'type'          => 'select',
				'default'       => 3,
				'options'       => business_key_get_numbers_dropdown_options( 1, 3 ),
				'state_handler' => array(
					'layout_type[carousel]' => array( 'show' ),
					'_else[layout_type]'    => array( 'hide' ),
				),
			),
			'transition_delay'    => array(
				'label'         => esc_html__( 'Transition Delay', 'business-key' ),
				'description'   => esc_html__( 'in seconds', 'business-key' ),
				'type'          => 'number',
				'default'       => 3,
				'state_handler' => array(
					'layout_type[carousel]' => array( 'show' ),
					'_else[layout_type]'    => array( 'hide' ),
				),
			),
			'enable_autoplay'     => array(
				'label'         => esc_html__( 'Enable Autoplay', 'business-key' ),
				'type'          => 'checkbox',
				'default'       => false,
				'state_handler' => array(
					'layout_type[carousel]' => array( 'show' ),
					'_else[layout_type]'    => array( 'hide' ),
				),
			),
			'enable_arrow'        => array(
				'label'         => esc_html__( 'Enable Arrow', 'business-key' ),
				'type'          => 'checkbox',
				'default'       => true,
				'state_handler' => array(
					'layout_type[carousel]' => array( 'show' ),
					'_else[layout_type]'    => array( 'hide' ),
				),
			),
			'enable_pager'        => array(
				'label'         => esc_html__( 'Enable Pager', 'business-key' ),
				'type'          => 'checkbox',
				'default'       => false,
				'state_handler' => array(
					'layout_type[carousel]' => array( 'show' ),
					'_else[layout_type]'    => array( 'hide' ),
				),
			),
			'featured_image'      => array(
				'label'   => esc_html__( 'Featured Image', 'business-key' ),
				'type'    => 'select',
				'default' => 'business-key-thumb',
				'options' => business_key_get_image_sizes_options( false ),
			),
			'more_text'           => array(
				'label'   => esc_html__( 'More Text', 'business-key' ),
				'type'    => 'text',
				'default' => esc_html__( 'Read More', 'business-key' ),
			),
			'excerpt_length'      => array(
				'label'       => esc_html__( 'Excerpt Length', 'business-key' ),
				'description' => esc_html__( 'in words', 'business-key' ),
				'type'        => 'number',
				'default'     => 15,
			),
			'explore_button_text' => array(
				'label'   => esc_html__( 'Explore Button Text', 'business-key' ),
				'type'    => 'text',
				'default' => esc_html__( 'Explore More', 'business-key' ),
			),
			'explore_button_url'  => array(
				'label'   => esc_html__( 'Explore Button URL', 'business-key' ),
				'type'    => 'link',
				'default' => '',
			),
		);
	}

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	public function initialize() {
		$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		$this->register_frontend_scripts(
			array(
				array(
					'jquery-slick',
					get_template_directory_uri() . '/vendors/slick/slick' . $min . '.js',
					array( 'jquery' ),
					'1.5.9',
				),
			)
		);

		$this->register_frontend_styles(
			array(
				array(
					'jquery-slick',
					get_template_directory_uri() . '/vendors/slick/slick' . $min . '.css',
					array(),
					'1.5.9',
				),
			)
		);
	}

	/**
	 * Template name.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Instance.
	 * @return string Template name
	 */
	public function get_template_name( $instance ) {
		return ( 'carousel' === $instance['layout_mode'] ) ? 'carousel' : 'grid';
	}
}

siteorigin_widget_register( 'business-key-latest-news', __FILE__, 'Business_Key_Latest_News_Widget' );
