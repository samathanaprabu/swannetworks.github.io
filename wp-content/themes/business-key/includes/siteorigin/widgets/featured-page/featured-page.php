<?php
/**
 * Featured Page widget
 *
 * Widget Name: Business Key Featured Page
 * Description: Displays message with an image.
 * Author: Axle Themes
 * Author URI: https://axlethemes.com
 *
 * @package Business_Key
 */

/**
 * Featured Page widget class.
 *
 * @since 1.0.0
 */
class Business_Key_Featured_Page_Widget extends SiteOrigin_Widget {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		parent::__construct(
			'business-key-featured-page',
			esc_html__( 'Business Key: Featured Page', 'business-key' ),
			array(
				'description' => esc_html__( 'Displays featured page.', 'business-key' ),
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
			'title'             => array(
				'type'  => 'text',
				'label' => esc_html__( 'Title', 'business-key' ),
			),
			'heading_alignment' => array(
				'label'   => esc_html__( 'Title Alignment', 'business-key' ),
				'type'    => 'select',
				'default' => 'left',
				'options' => business_key_get_heading_alignment_options(),
			),
			'divider_status'    => array(
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Enable Divider', 'business-key' ),
				'default' => true,
			),
			'page_id'           => array(
				'type'             => 'page-dropdown',
				'label'            => esc_html__( 'Page', 'business-key' ),
				'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'business-key' ),
			),
			'content_type'      => array(
				'type'    => 'radio',
				'label'   => esc_html__( 'Show Content', 'business-key' ),
				'default' => 'short',
				'options' => array(
					'short' => esc_html__( 'Short', 'business-key' ),
					'full'  => esc_html__( 'Full', 'business-key' ),
				),
			),
			'excerpt_length'    => array(
				'label'       => esc_html__( 'Excerpt Length', 'business-key' ),
				'description' => esc_html__( 'in words.', 'business-key' ) . '&nbsp;' . esc_html__( 'Applies when Short is selected in Show Content.', 'business-key' ),
				'type'        => 'number',
				'default'     => 35,
			),
			'image_size'        => array(
				'label'   => esc_html__( 'Image Size', 'business-key' ),
				'type'    => 'select',
				'default' => 'business-key-thumb',
				'options' => business_key_get_image_sizes_options( false ),
			),
			'image_alignment'   => array(
				'label'   => esc_html__( 'Image Alignment', 'business-key' ),
				'type'    => 'select',
				'default' => 'left',
				'options' => business_key_get_alignment_options( array( 'left', 'right' ) ),
			),
			'more_button_text'  => array(
				'label'   => esc_html__( 'More Button Text', 'business-key' ),
				'type'    => 'text',
				'default' => esc_html__( 'Know More', 'business-key' ),
			),
			'more_button_url'   => array(
				'label'   => esc_html__( 'More Button URL', 'business-key' ),
				'type'    => 'link',
				'default' => '',
			),
			'settings'          => array(
				'type'   => 'section',
				'label'  => esc_html__( 'Settings', 'business-key' ),
				'hide'   => false,
				'fields' => array(
					'page_title_color'   => array(
						'type'    => 'color',
						'label'   => esc_html__( 'Title Color', 'business-key' ),
						'default' => '#0d0f1a',
					),
					'page_divider_color' => array(
						'type'    => 'color',
						'label'   => esc_html__( 'Divider Color', 'business-key' ),
						'default' => '#fc6c84',
					),
					'page_content_color' => array(
						'type'    => 'color',
						'label'   => esc_html__( 'Content Color', 'business-key' ),
						'default' => '#64707a',
					),
				),
			),
		);
	}

	/**
	 * Less variables.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Widget instance.
	 * @return array Less variables.
	 */
	public function get_less_variables( $instance ) {
		if ( empty( $instance ) ) {
			return array();
		}

		return array(
			'page_title_color'   => ( '#0d0f1a' !== $instance['settings']['page_title_color'] ) ? $instance['settings']['page_title_color'] : '',
			'page_divider_color' => ( '#fc6c84' !== $instance['settings']['page_divider_color'] ) ? $instance['settings']['page_divider_color'] : '',
			'page_content_color' => ( '#64707a' !== $instance['settings']['page_content_color'] ) ? $instance['settings']['page_content_color'] : '',
		);
	}
}

siteorigin_widget_register( 'business-key-featured-page', __FILE__, 'Business_Key_Featured_Page_Widget' );
