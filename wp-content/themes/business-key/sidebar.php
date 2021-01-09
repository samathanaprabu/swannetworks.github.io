<?php
/**
 * Primary sidebar
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Key
 */

$default_sidebar = apply_filters( 'business_key_filter_default_sidebar_id', 'sidebar-1', 'primary' );
if ( is_singular() ) {
	global $post;
	$post_options = get_post_meta( $post->ID, 'business_key_settings', true );
	if ( isset( $post_options['sidebar_location_primary'] ) && ! empty( $post_options['sidebar_location_primary'] ) ) {
		$default_sidebar = esc_attr( $post_options['sidebar_location_primary'] );
	}
}
?>
<div id="sidebar-primary" class="widget-area sidebar" role="complementary">
	<?php if ( is_active_sidebar( $default_sidebar ) ) : ?>
		<?php dynamic_sidebar( $default_sidebar ); ?>
	<?php else : ?>
		<?php
		/**
		 * Hook - business_key_action_default_sidebar.
		 */
		do_action( 'business_key_action_default_sidebar', $default_sidebar, 'primary' );
		?>
	<?php endif; ?>
</div><!-- #sidebar-primary -->
