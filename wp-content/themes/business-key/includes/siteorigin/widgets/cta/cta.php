<?php
/**
 * CTA widget
 *
 * Widget Name: Business Key CTA
 * Description: Displays call to action button with description.
 * Author: Axle Themes
 * Author URI: https://axlethemes.com
 *
 * @package Business_Key
 */

/**
 * CTA widget class.
 *
 * @since 1.0.0
 */
class Business_Key_CTA_Widget extends SiteOrigin_Widget {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		parent::__construct(
			'business-key-cta',
			esc_html__( 'Business Key: CTA', 'business-key' ),
			array(
				'description' => esc_html__( 'Displays call to action button with description.', 'business-key' ),
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
			'title'                 => array(
				'type'  => 'text',
				'label' => esc_html__( 'Title', 'business-key' ),
			),
			'subtitle'              => array(
				'type'  => 'text',
				'label' => esc_html__( 'Subtitle', 'business-key' ),
			),
			'primary_button_text'   => array(
				'type'    => 'text',
				'label'   => esc_html__( 'Primary Button Text', 'business-key' ),
				'default' => esc_html__( 'Learn More', 'business-key' ),
			),
			'primary_button_url'    => array(
				'type'    => 'link',
				'label'   => esc_html__( 'Primary Button URL', 'business-key' ),
				'default' => esc_url( home_url( '/' ) ),
			),
			'secondary_button_text' => array(
				'type'  => 'text',
				'label' => esc_html__( 'Secondary Button Text', 'business-key' ),
			),
			'secondary_button_url'  => array(
				'type'  => 'link',
				'label' => esc_html__( 'Secondary Button URL', 'business-key' ),
			),
			'settings'              => array(
				'type'   => 'section',
				'label'  => esc_html__( 'Settings', 'business-key' ),
				'hide'   => false,
				'fields' => array(
					'cta_title_color'    => array(
						'type'    => 'color',
						'label'   => esc_html__( 'Title Color', 'business-key' ),
						'default' => '#0d0f1a',
					),
					'cta_subtitle_color' => array(
						'type'    => 'color',
						'label'   => esc_html__( 'Subtitle Color', 'business-key' ),
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
			'cta_title_color'    => $instance['settings']['cta_title_color'],
			'cta_subtitle_color' => $instance['settings']['cta_subtitle_color'],
		);
	}

}

siteorigin_widget_register( 'business-key-cta', __FILE__, 'Business_Key_CTA_Widget' );
