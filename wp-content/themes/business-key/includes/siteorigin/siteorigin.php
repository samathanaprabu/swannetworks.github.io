<?php
/**
 * Support for Site Origin builder
 *
 * @package Business_Key
 */

if ( ! function_exists( 'business_key_register_so_widgets_folder' ) ) :

	/**
	 * Register widget folders.
	 *
	 * @since 1.0.0
	 *
	 * @param array $folders Folders.
	 * @return array Modified folders.
	 */
	function business_key_register_so_widgets_folder( $folders ) {

		$folders[] = trailingslashit( get_template_directory() ) . 'includes/siteorigin/widgets/';
		return $folders;
	}

endif;

add_filter( 'siteorigin_widgets_widget_folders', 'business_key_register_so_widgets_folder' );

if ( ! function_exists( 'business_key_add_tab_in_so_builder_widgets_panel' ) ) :

	/**
	 * Add tab in builder widgets section.
	 *
	 * @since 1.0.0
	 *
	 * @param array $tabs Tabs.
	 * @return array Modified tabs.
	 */
	function business_key_add_tab_in_so_builder_widgets_panel( $tabs ) {

		$tabs['business-key'] = array(
			'title'  => esc_html__( 'Business Key Widgets', 'business-key' ),
			'filter' => array(
				'groups' => array( 'business-key' ),
			),
		);

		return $tabs;
	}

endif;

add_filter( 'siteorigin_panels_widget_dialog_tabs', 'business_key_add_tab_in_so_builder_widgets_panel' );

if ( ! function_exists( 'business_key_group_theme_widgets_in_so_builder' ) ) :

	/**
	 * Grouping theme widgets in builder.
	 *
	 * @since 1.0.0
	 *
	 * @param array $widgets Widgets array.
	 * @return array Modified widgets array.
	 */
	function business_key_group_theme_widgets_in_so_builder( $widgets ) {

		if ( isset( $GLOBALS['wp_widget_factory'] ) && ! empty( $GLOBALS['wp_widget_factory']->widgets ) ) {

			$all_widgets = array_keys( $GLOBALS['wp_widget_factory']->widgets );

			foreach ( $all_widgets as $widget ) {
				if ( false !== strpos( $widget, 'Business_Key_' ) ) {
					$widgets[ $widget ]['groups'] = array( 'business-key' );
					$widgets[ $widget ]['icon']   = 'dashicons dashicons-star-filled';
				}
			}
		}

		return $widgets;
	}

endif;

add_filter( 'siteorigin_panels_widgets', 'business_key_group_theme_widgets_in_so_builder' );

if ( ! function_exists( 'business_key_custom_fields_class_prefixes' ) ) :

	/**
	 * Class prefixes.
	 *
	 * @since 1.0.0
	 *
	 * @param array $class_prefixes Array of prefixes.
	 * @return array Modified array.
	 */
	function business_key_custom_fields_class_prefixes( $class_prefixes ) {

		$class_prefixes[] = 'Business_Key_Field_';
		return $class_prefixes;
	}
endif;

add_filter( 'siteorigin_widgets_field_class_prefixes', 'business_key_custom_fields_class_prefixes' );

if ( ! function_exists( 'business_key_custom_fields_class_paths' ) ) :

	/**
	 * Class paths.
	 *
	 * @since 1.0.0
	 *
	 * @param array $class_paths Array of class paths.
	 * @return array Modified array.
	 */
	function business_key_custom_fields_class_paths( $class_paths ) {

		$class_paths[] = trailingslashit( get_template_directory() ) . 'includes/siteorigin/fields/';
		return $class_paths;
	}
endif;

add_filter( 'siteorigin_widgets_field_class_paths', 'business_key_custom_fields_class_paths' );

if ( ! function_exists( 'business_key_customize_default_row_style_fields' ) ) :

	/**
	 * Row style fields.
	 *
	 * @since 1.0.0
	 *
	 * @param array $fields Array of fields.
	 * @return array Modified array.
	 */
	function business_key_customize_default_row_style_fields( $fields ) {

		$fields['row_stretch']['default'] = 'full';

		return $fields;
	}
endif;

add_filter( 'siteorigin_panels_row_style_fields', 'business_key_customize_default_row_style_fields' );

if ( ! function_exists( 'business_key_customize_so_widgets_status' ) ) :

	/**
	 * Make widgets active.
	 *
	 * @since 1.0.0
	 *
	 * @param array $active Array of widgets.
	 * @return array Modified array.
	 */
	function business_key_customize_so_widgets_status( $active ) {
		$active['siteorigin-panels-builder']          = true;
		$active['business-key-heading']               = true;
		$active['heading']                            = true;
		$active['business-key-cta']                   = true;
		$active['cta']                                = true;
		$active['business-key-latest-news']           = true;
		$active['latest-news']                        = true;
		$active['business-key-featured-page']         = true;
		$active['featured-page']                      = true;
		$active['business-key-advanced-recent-posts'] = true;
		$active['advanced-recent-posts']              = true;
		$active['sow-accordion']                      = true;
		$active['accordion']                          = true;
		$active['sow-features']                       = true;
		$active['features']                           = true;
		$active['sow-contact-form']                   = true;
		$active['contact-form']                       = true;
		$active['sow-hero']                           = true;
		$active['hero']                               = true;

		return $active;
	}

endif;

add_filter( 'siteorigin_widgets_active_widgets', 'business_key_customize_so_widgets_status' );
