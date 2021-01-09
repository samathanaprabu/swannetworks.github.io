<?php
/**
 * Header template
 *
 * @package Business_Key
 */

?>

<header id="masthead" class="site-header">
	<div class="container">
		<div class="site-header-wrapper">
			<?php business_key_render_site_branding(); ?>

			<?php business_key_render_contact_info(); ?>

			<?php $enable_cart_icon = business_key_get_option( 'enable_cart_icon' ); ?>

			<?php if ( business_key_woocommerce_status() && true === $enable_cart_icon ) : ?>
				<?php business_key_display_cart_icon(); ?>
			<?php endif; ?>

			<div id="main-navigation">
				<nav id="site-navigation" class="main-navigation">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'fallback_cb'    => 'business_key_primary_navigation_fallback',
					) );
					?>
				</nav><!-- #site-navigation -->
			</div><!-- #main-navigation -->
		</div> <!-- .site-header-wrapper -->
	</div><!-- .container -->
</header><!-- #masthead -->
