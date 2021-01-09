<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Key
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'business-key' ); ?></a>
			<a id="mobile-trigger" href="#mob-menu"><i class="fa fa-align-left"></i></a>
			<div id="mob-menu">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'container'      => '',
						'fallback_cb'    => 'business_key_primary_navigation_fallback',
					)
				);
				?>
			</div><!-- #mob-menu -->

			<?php
			/**
			 * Hook - business_key_action_header.
			 *
			 * @hooked business_key_add_master_header - 10
			 * @hooked business_key_add_header_banner - 15
			 */
			do_action( 'business_key_action_header' );
			?>

			<div id="content" class="site-content">

				<div class="container">

					<div class="inner-wrapper">
