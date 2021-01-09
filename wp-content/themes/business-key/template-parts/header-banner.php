<?php
/**
 * Header banner
 *
 * @package Business_Key
 */

$ch_style = '';

$ch_image = get_header_image();

if ( ! empty( $ch_image ) ) {
	$ch_style = 'background-image:url(' . esc_url( $ch_image ) . ');';
}

$ch_heading = apply_filters( 'business_key_filter_banner_title', '' );

$enable_ch_title      = business_key_get_option( 'enable_ch_title' );
$enable_ch_breadcrumb = business_key_get_option( 'enable_ch_breadcrumb' );

if ( ( true === $enable_ch_title && ! empty( $ch_heading ) ) || true === $enable_ch_breadcrumb || ! empty( $ch_image ) ) {
	$status_class = 'ch-enabled';
} else {
	$status_class = 'ch-disabled';
}
?>

<div id="custom-header" style="<?php echo esc_attr( $ch_style ); ?>" class="<?php echo esc_attr( $status_class ); ?>">
	<?php if ( ! empty( $ch_heading ) ) : ?>
		<?php
		$tag = 'h1';
		if ( is_front_page() ) {
			$tag = 'h2';
		}
		?>
		<div class="custom-header-content">
			<div class="container">
				<?php if ( true === $enable_ch_title ) : ?>
					<?php echo '<' . esc_attr( $tag ) . ' class="page-title">'; ?>
					<?php echo esc_html( $ch_heading ); ?>
					<?php echo '</' . esc_attr( $tag ) . '>'; ?>
				<?php endif; ?>

				<?php if ( true === $enable_ch_breadcrumb ) : ?>
					<?php
					/**
					 * Hook - business_key_action_breadcrumb.
					 *
					 * @hooked business_key_add_breadcrumb - 10
					 */
					do_action( 'business_key_action_breadcrumb' );
					?>
				<?php endif; ?>
			</div><!-- .container -->
		</div><!-- .custom-header-content -->
	<?php endif; ?>
</div><!-- #custom-header -->
