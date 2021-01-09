<?php
/**
 * Footer credits
 *
 * @package Business_Key
 */

?>

<footer id="colophon" class="site-footer">
	<div class="container">
		<div class="colophon-top">
			<?php business_key_render_social_links(); ?>

			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-footer',
					'container_id'   => 'footer-navigation',
					'fallback_cb'    => false,
				)
			);
			?>
		</div><!-- .colophon-top -->

		<div class="colophon-bottom">
			<?php $copyright_text = business_key_get_option( 'copyright_text' ); ?>
			<?php if ( ! empty( $copyright_text ) ) : ?>
				<div class="copyright">
					<?php echo wp_kses_post( wpautop( $copyright_text ) ); ?>
				</div><!-- .copyright -->
			<?php endif; ?>

			<div class="site-info">
				<?php echo esc_html__( 'Business Key by', 'business-key' ) . ' <a target="_blank" rel="nofollow" href="https://axlethemes.com/">Axle Themes</a>'; ?>
			</div><!-- .site-info -->
		</div><!-- .colophon-bottom -->
	</div><!-- .container -->
</footer><!-- #colophon -->
