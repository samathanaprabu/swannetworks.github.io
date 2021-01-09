<?php
/**
 * Theme options
 *
 * @package Business_Key
 */

$default = business_key_get_default_theme_options();

// Setting show_title.
$wp_customize->add_setting(
	'theme_options[show_title]', array(
		'default'           => $default['show_title'],
		'sanitize_callback' => 'business_key_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[show_title]', array(
		'label'    => esc_html__( 'Show Site Title', 'business-key' ),
		'section'  => 'title_tagline',
		'type'     => 'checkbox',
		'priority' => 11,
	)
);

// Setting show_tagline.
$wp_customize->add_setting(
	'theme_options[show_tagline]', array(
		'default'           => $default['show_tagline'],
		'sanitize_callback' => 'business_key_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[show_tagline]', array(
		'label'    => esc_html__( 'Show Tagline', 'business-key' ),
		'section'  => 'title_tagline',
		'type'     => 'checkbox',
		'priority' => 11,
	)
);

// Setting enable_ch_title.
$wp_customize->add_setting(
	'theme_options[enable_ch_title]', array(
		'default'           => $default['enable_ch_title'],
		'sanitize_callback' => 'business_key_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[enable_ch_title]', array(
		'label'   => esc_html__( 'Show Page Title', 'business-key' ),
		'section' => 'header_image',
		'type'    => 'checkbox',
	)
);

// Setting enable_ch_overlay.
$wp_customize->add_setting(
	'theme_options[enable_ch_overlay]', array(
		'default'           => $default['enable_ch_overlay'],
		'sanitize_callback' => 'business_key_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[enable_ch_overlay]', array(
		'label'   => esc_html__( 'Enable Overlay', 'business-key' ),
		'section' => 'header_image',
		'type'    => 'checkbox',
	)
);

// Setting enable_ch_opacity.
$wp_customize->add_setting(
	'theme_options[enable_ch_opacity]', array(
		'default'           => $default['enable_ch_opacity'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	new Business_Key_Range_Slider_Control(
		$wp_customize, 'theme_options[enable_ch_opacity]', array(
			'label'           => esc_html__( 'Overlay Opacity', 'business-key' ),
			'section'         => 'header_image',
			'settings'        => 'theme_options[enable_ch_opacity]',
			'active_callback' => 'business_key_is_custom_header_overlay_active_callback',
		)
	)
);

// Setting enable_ch_breadcrumb.
$wp_customize->add_setting(
	'theme_options[enable_ch_breadcrumb]', array(
		'default'           => $default['enable_ch_breadcrumb'],
		'sanitize_callback' => 'business_key_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[enable_ch_breadcrumb]', array(
		'label'       => esc_html__( 'Show Breadcrumb', 'business-key' ),
		'description' => esc_html__( 'Breadcrumb is displayed only in inner pages.', 'business-key' ),
		'section'     => 'header_image',
		'type'        => 'checkbox',
	)
);

// Setting bc_home_text.
$wp_customize->add_setting(
	'theme_options[bc_home_text]', array(
		'default'           => $default['bc_home_text'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[bc_home_text]', array(
		'label'           => esc_html__( 'Breadcrumb Home Text', 'business-key' ),
		'section'         => 'header_image',
		'type'            => 'text',
		'active_callback' => 'business_key_is_breadcrumb_active_callback',
	)
);

// Setting bc_enable_title.
$wp_customize->add_setting(
	'theme_options[bc_enable_title]', array(
		'default'           => $default['bc_enable_title'],
		'sanitize_callback' => 'business_key_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[bc_enable_title]', array(
		'label'           => esc_html__( 'Show Page Title in Breadcrumb', 'business-key' ),
		'section'         => 'header_image',
		'type'            => 'checkbox',
		'active_callback' => 'business_key_is_breadcrumb_active_callback',
	)
);

// Add theme options panel.
$wp_customize->add_panel(
	'theme_option_panel', array(
		'title'    => esc_html__( 'Theme Options', 'business-key' ),
		'priority' => 25,
	)
);

// Header section.
$wp_customize->add_section(
	'section_header', array(
		'title' => esc_html__( 'Header Options', 'business-key' ),
		'panel' => 'theme_option_panel',
	)
);

// Setting header_layout.
$wp_customize->add_setting(
	'theme_options[header_layout]', array(
		'default'           => $default['header_layout'],
		'sanitize_callback' => 'business_key_sanitize_select',
	)
);

$wp_customize->add_control(
	new Business_Key_Radio_Image_Control(
		$wp_customize, 'theme_options[header_layout]', array(
			'label'    => esc_html__( 'Header Layout', 'business-key' ),
			'section'  => 'section_header',
			'settings' => 'theme_options[header_layout]',
			'choices'  => business_key_get_header_layout_options(),
		)
	)
);

// Setting contact_number.
$wp_customize->add_setting(
	'theme_options[contact_number]', array(
		'default'           => $default['contact_number'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[contact_number]', array(
		'label'   => esc_html__( 'Contact Number', 'business-key' ),
		'section' => 'section_header',
		'type'    => 'text',
	)
);

// Setting contact_email.
$wp_customize->add_setting(
	'theme_options[contact_email]', array(
		'default'           => $default['contact_email'],
		'sanitize_callback' => 'sanitize_email',
	)
);
$wp_customize->add_control(
	'theme_options[contact_email]', array(
		'label'   => esc_html__( 'Contact Email', 'business-key' ),
		'section' => 'section_header',
		'type'    => 'text',
	)
);

// Setting enable_cart_icon.
$wp_customize->add_setting(
	'theme_options[enable_cart_icon]', array(
		'default'           => $default['enable_cart_icon'],
		'sanitize_callback' => 'business_key_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[enable_cart_icon]', array(
		'label'       => esc_html__( 'Show Cart Icon', 'business-key' ),
		'description' => esc_html__( 'Requires WooCommerce plugin active.', 'business-key' ),
		'section'     => 'section_header',
		'type'        => 'checkbox',
	)
);

// Social section.
$wp_customize->add_section(
	'section_social', array(
		'title' => esc_html__( 'Social Options', 'business-key' ),
		'panel' => 'theme_option_panel',
	)
);

// Setting social_links.
$wp_customize->add_setting(
	'theme_options[social_links]', array(
		'sanitize_callback' => 'business_key_sanitize_social_links',
	)
);

$wp_customize->add_control(
	new Business_Key_Text_Multiple_Control(
		$wp_customize, 'theme_options[social_links]', array(
			'label'       => esc_html__( 'Social Links', 'business-key' ),
			'description' => esc_html__( 'Enter full URL.', 'business-key' ),
			'section'     => 'section_social',
			'total'       => 5,
			'settings'    => 'theme_options[social_links]',
		)
	)
);

// Layout section.
$wp_customize->add_section(
	'section_layout', array(
		'title' => esc_html__( 'Layout Options', 'business-key' ),
		'panel' => 'theme_option_panel',
	)
);

// Setting global_layout.
$wp_customize->add_setting(
	'theme_options[global_layout]', array(
		'default'           => $default['global_layout'],
		'sanitize_callback' => 'business_key_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[global_layout]', array(
		'label'   => esc_html__( 'Global Layout', 'business-key' ),
		'section' => 'section_layout',
		'type'    => 'select',
		'choices' => business_key_get_global_layout_options(),
	)
);

// Setting archive_layout.
$wp_customize->add_setting(
	'theme_options[archive_layout]', array(
		'default'           => $default['archive_layout'],
		'sanitize_callback' => 'business_key_sanitize_select',
	)
);
$wp_customize->add_control(
	'theme_options[archive_layout]', array(
		'label'   => esc_html__( 'Archive Layout', 'business-key' ),
		'section' => 'section_layout',
		'type'    => 'select',
		'choices' => business_key_get_archive_layout_options(),
	)
);

// Blog section.
$wp_customize->add_section(
	'section_blog', array(
		'title' => esc_html__( 'Blog Options', 'business-key' ),
		'panel' => 'theme_option_panel',
	)
);

// Setting blog_title.
$wp_customize->add_setting(
	'theme_options[blog_title]', array(
		'default'           => $default['blog_title'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[blog_title]', array(
		'label'   => esc_html__( 'Blog Title', 'business-key' ),
		'section' => 'section_blog',
		'type'    => 'text',
	)
);

// Setting excerpt_length.
$wp_customize->add_setting(
	'theme_options[excerpt_length]', array(
		'default'           => $default['excerpt_length'],
		'sanitize_callback' => 'business_key_sanitize_positive_integer',
	)
);
$wp_customize->add_control(
	'theme_options[excerpt_length]', array(
		'label'       => esc_html__( 'Excerpt Length', 'business-key' ),
		'description' => esc_html__( 'in words', 'business-key' ),
		'section'     => 'section_blog',
		'type'        => 'number',
		'input_attrs' => array(
			'min'   => 1,
			'max'   => 200,
			'style' => 'width: 55px;',
		),
	)
);

// Setting read_more_text.
$wp_customize->add_setting(
	'theme_options[read_more_text]', array(
		'default'           => $default['read_more_text'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(
	'theme_options[read_more_text]', array(
		'label'   => esc_html__( 'Read More Text', 'business-key' ),
		'section' => 'section_blog',
		'type'    => 'text',
	)
);

// Footer section.
$wp_customize->add_section(
	'section_footer', array(
		'title' => esc_html__( 'Footer Options', 'business-key' ),
		'panel' => 'theme_option_panel',
	)
);

// Setting copyright_text.
$wp_customize->add_setting(
	'theme_options[copyright_text]', array(
		'default'           => $default['copyright_text'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'theme_options[copyright_text]', array(
		'label'   => esc_html__( 'Copyright Text', 'business-key' ),
		'section' => 'section_footer',
		'type'    => 'text',
	)
);

// Setting go_to_top_status.
$wp_customize->add_setting(
	'theme_options[go_to_top_status]', array(
		'default'           => $default['go_to_top_status'],
		'sanitize_callback' => 'business_key_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	'theme_options[go_to_top_status]', array(
		'label'   => esc_html__( 'Enable Go To Top', 'business-key' ),
		'section' => 'section_footer',
		'type'    => 'checkbox',
	)
);
