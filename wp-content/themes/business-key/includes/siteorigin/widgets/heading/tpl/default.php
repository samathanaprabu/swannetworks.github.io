<?php
/**
 * Widget template
 *
 * @package Business_Key
 */

?>

<div class="segment segment-heading heading-align<?php echo esc_attr( $instance['settings']['heading_alignment'] ); ?>">
	<div class="heading-content">
		<?php if ( ! empty( $instance['title'] ) ) : ?>
			<?php
			$title_color = ( ! empty( $instance['settings']['title_color'] ) ) ? $instance['settings']['title_color'] : '';
			$title_style = '';
			if ( ! empty( $title_color ) && '#0d0f1a' !== $title_color ) {
				$title_style .= 'color:' . esc_attr( $title_color );
			}
			?>
			<h2 class="heading-title" <?php echo ( $title_style ) ? ' style="' . esc_attr( $title_style ) . '"' : ''; ?>><?php echo esc_html( $instance['title'] ); ?></h2>
		<?php endif; ?>

		<?php if ( true === $instance['settings']['divider_status'] ) : ?>
			<?php
			$divider_color = ( ! empty( $instance['settings']['divider_color'] ) ) ? $instance['settings']['divider_color'] : '';
			$divider_style = '';
			if ( ! empty( $divider_color ) && '#fc6c84' !== $divider_color ) {
				$divider_style .= 'background-color:' . esc_attr( $divider_color );
			}
			?>
			<span class="heading-divider" <?php echo ( $divider_style ) ? ' style="' . esc_attr( $divider_style ) . '"' : ''; ?>></span>
		<?php endif; ?>

		<?php if ( ! empty( $instance['subtitle'] ) ) : ?>
			<?php
			$subtitle_color = ( ! empty( $instance['settings']['subtitle_color'] ) ) ? $instance['settings']['subtitle_color'] : '';
			$subtitle_style = '';
			if ( ! empty( $subtitle_color ) && '#64707a' !== $subtitle_color ) {
				$subtitle_style .= 'color:' . esc_attr( $subtitle_color );
			}
			?>
			<p class="heading-subtitle" <?php echo ( $subtitle_style ) ? ' style="' . esc_attr( $subtitle_style ) . '"' : ''; ?>><?php echo esc_html( $instance['subtitle'] ); ?></p>
		<?php endif; ?>
	</div><!-- .heading-content -->
</div><!-- .segment .segment-heading -->
