<?php
/**
 * Heading widget
 *
 * Widget Name: Business Key Heading
 * Description: Displays title and subtitle.
 * Author: Axle Themes
 * Author URI: https://axlethemes.com
 *
 * @package Business_Key
 */

/**
 * Heading widget class.
 *
 * @since 1.0.0
 */
class Business_Key_Heading_Widget extends SiteOrigin_Widget {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		parent::__construct(
			'business-key-heading',
			esc_html__( 'Business Key: Heading', 'business-key' ),
			array(
				'description' => esc_html__( 'Displays title and subtitle.', 'business-key' ),
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
			'title'    => array(
				'type'  => 'text',
				'label' => esc_html__( 'Title', 'business-key' ),
			),
			'subtitle' => array(
				'type'  => 'text',
				'label' => esc_html__( 'Subtitle', 'business-key' ),
			),
			'settings' => array(
				'label'  => esc_html__( 'Settings', 'business-key' ),
				'type'   => 'section',
				'hide'   => false,
				'fields' => array(
					'heading_alignment' => array(
						'label'   => esc_html__( 'Heading Alignment', 'business-key' ),
						'type'    => 'select',
						'default' => 'center',
						'options' => business_key_get_heading_alignment_options(),
					),
					'divider_status'    => array(
						'type'    => 'checkbox',
						'label'   => esc_html__( 'Enable Divider', 'business-key' ),
						'default' => true,
					),
					'title_color'       => array(
						'label'   => esc_html__( 'Title Color', 'business-key' ),
						'type'    => 'color',
						'default' => '#0d0f1a',
					),
					'divider_color'     => array(
						'label'   => esc_html__( 'Divider Color', 'business-key' ),
						'type'    => 'color',
						'default' => '#fc6c84',
					),
					'subtitle_color'    => array(
						'label'   => esc_html__( 'Subtitle Color', 'business-key' ),
						'type'    => 'color',
						'default' => '#64707a',
					),
				),
			),
		);
	}

}

siteorigin_widget_register( 'business-key-heading', __FILE__, 'Business_Key_Heading_Widget' );
