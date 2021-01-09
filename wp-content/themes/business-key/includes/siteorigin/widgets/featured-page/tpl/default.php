<?php
/**
 * Widget template
 *
 * @package Business_Key
 */

?>

<div class="segment segment-featured-page heading-<?php echo esc_attr( $instance['heading_alignment'] ); ?>">

	<?php if ( absint( $instance['page_id'] ) > 0 ) : ?>

		<?php
		$qargs = array(
			'p'             => absint( $instance['page_id'] ),
			'post_type'     => 'page',
			'no_found_rows' => true,
		);

		$the_query = new WP_Query( $qargs );
		?>

		<?php if ( $the_query->have_posts() ) : ?>

			<?php
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
			?>
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( esc_attr( $instance['image_size'] ), array( 'class' => 'align' . esc_attr( $instance['image_alignment'] ) ) ); ?>
				<?php endif; ?>

				<div class="featured-page-content">
					<?php if ( ! empty( $instance['title'] ) ) : ?>
						<?php echo $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title']; ?>
					<?php endif; ?>

					<?php if ( true === $instance['divider_status'] ) : ?>
						<span class="heading-divider"></span>
					<?php endif; ?>

					<div class="page-content-summary">
						<?php if ( 'full' === $instance['content_type'] ) : ?>
							<?php the_content( '' ); ?>
						<?php else : ?>
							<?php
							$excerpt = business_key_get_the_excerpt( absint( $instance['excerpt_length'] ) );
							echo wp_kses_post( wpautop( $excerpt ) );
							?>
						<?php endif; ?>
					</div><!-- .page-content-summary -->

					<?php if ( ! empty( $instance['more_button_url'] ) && ! empty( $instance['more_button_text'] ) ) : ?>
						<a href="<?php echo sow_esc_url( $instance['more_button_url'] ); ?>" class="custom-button custom-secondary-button"><?php echo esc_html( $instance['more_button_text'] ); ?></a>
					<?php endif; ?>
				</div><!-- .featured-page-content -->

			<?php endwhile; ?>

			<?php wp_reset_postdata(); ?>

		<?php endif; ?>

	<?php else : ?>

		<?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
			<p><?php esc_html_e( 'Please select page to display content.', 'business-key' ); ?></p>
		<?php endif; ?>

	<?php endif; ?>

</div><!-- .segment .segment-featured-page -->
