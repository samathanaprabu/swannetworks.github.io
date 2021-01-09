<?php
/**
 * Custom Customizer Controls and Sections
 *
 * @package Business_Key
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

$classes = array(
	'class-business-key-checkbox-multiple-control.php',
	'class-business-key-dropdown-taxonomies-control.php',
	'class-business-key-dropdown-sidebars-control.php',
	'class-business-key-heading-control.php',
	'class-business-key-message-control.php',
	'class-business-key-radio-image-control.php',
	'class-business-key-range-slider-control.php',
	'class-business-key-text-multiple-control.php',
	'class-business-key-upsell-section.php',
);

foreach ( $classes as $class ) {
	require_once trailingslashit( get_template_directory() ) . 'includes/customizer/controls/' . $class;
}

// Register custom controls and sections.
$wp_customize->register_control_type( 'Business_Key_Heading_Control' );
$wp_customize->register_control_type( 'Business_Key_Message_Control' );
$wp_customize->register_control_type( 'Business_Key_Dropdown_Taxonomies_Control' );
$wp_customize->register_control_type( 'Business_Key_Dropdown_Sidebars_Control' );
$wp_customize->register_control_type( 'Business_Key_Radio_Image_Control' );
$wp_customize->register_control_type( 'Business_Key_Range_Slider_Control' );
$wp_customize->register_control_type( 'Business_Key_Checkbox_Multiple_Control' );
$wp_customize->register_control_type( 'Business_Key_Text_Multiple_Control' );
$wp_customize->register_section_type( 'Business_Key_Upsell_Section' );
