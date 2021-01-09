<?php
/**
 * Address widget
 *
 * Widget Name: Business Key Address
 * Description: Displays recent posts with thumbnail.
 * Author: Axle Themes
 * Author URI: https://axlethemes.com
 *
 * @package Business_Key
 */

/**
 * Address widget class.
 *
 * @since 1.0.0
 */
class Business_Key_Advanced_Recent_Posts_Widget extends SiteOrigin_Widget {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		parent::__construct(
			'business-key-advanced-recent-posts',
			esc_html__( 'Business Key: Advanced Recent Posts', 'business-key' ),
			array(
				'description' => esc_html__( 'Displays recent posts with thumbnail.', 'business-key' ),
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
				'default' => 'center',
				'options' => business_key_get_heading_alignment_options(),
			),
			'post_category'     => array(
				'label'           => esc_html__( 'Select Category', 'business-key' ),
				'type'            => 'taxonomy-dropdown',
				'show_option_all' => esc_html__( 'All Categories', 'business-key' ),
			),
			'post_number'       => array(
				'label'   => esc_html__( 'Number of Posts', 'business-key' ),
				'type'    => 'number',
				'default' => 5,
			),
			'featured_image'    => array(
				'label'   => esc_html__( 'Featured Image', 'business-key' ),
				'type'    => 'select',
				'default' => 'thumbnail',
				'options' => business_key_get_image_sizes_options( true, array( 'disable', 'thumbnail' ), false ),
			),
			'image_width'       => array(
				'label'       => esc_html__( 'Image Width', 'business-key' ),
				'description' => esc_html__( 'in px', 'business-key' ),
				'type'        => 'number',
				'default'     => 90,
			),
			'excerpt_length'    => array(
				'label'       => esc_html__( 'Excerpt Length', 'business-key' ),
				'description' => esc_html__( 'in words', 'business-key' ),
				'type'        => 'number',
				'default'     => 10,
			),
		);
	}

}

siteorigin_widget_register( 'business-key-advanced-recent-posts', __FILE__, 'Business_Key_Advanced_Recent_Posts_Widget' );
