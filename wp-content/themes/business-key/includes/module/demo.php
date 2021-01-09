<?php
/**
 * Demo configuration
 *
 * @package Business_Key
 */

$config = array(
	'static_page'    => 'version-1',
	'posts_page'     => 'blog',
	'menu_locations' => array(
		'menu-1'      => 'header-menu',
		'menu-footer' => 'footer-menu',
	),
	'ocdi'           => array(
		array(
			'import_file_name'             => esc_html__( 'Theme Demo Content', 'business-key' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo/widget.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo/customizer.dat',
		),
	),
	'intro_content'  => esc_html__( 'NOTE: In demo import, category selection could be omitted in old (non-fresh) WordPress setup. After import is complete, please go to Widgets admin page under Appearance menu and select the appropriate category in the widgets.', 'business-key' ),

);

Business_Key_Demo::init( apply_filters( 'business_key_demo_filter', $config ) );
