<?php
/**
 * Widget template
 *
 * @package Business_Key
 */

$qargs = array(
	'posts_per_page' => absint( $instance['post_number'] ),
	'no_found_rows'  => true,
);

if ( absint( $instance['post_category'] ) > 0 ) {
	$qargs['cat'] = absint( $instance['post_category'] );
}

$the_query = new WP_Query( $qargs );
?>

<div class="segment segment-advanced-recent-posts heading-<?php echo esc_attr( $instance['heading_alignment'] ); ?>">

	<?php if ( ! empty( $instance['title'] ) ) : ?>
		<?php echo $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title']; ?>
	<?php endif; ?>

	<?php if ( $the_query->have_posts() ) : ?>

		<div class="advanced-recent-posts-wrapper">
			<?php
			while ( $the_query->have_posts() ) :
				$the_query->the_post();
			?>

				<div class="advanced-recent-posts-item">

					<?php if ( 'disable' !== $instance['featured_image'] && has_post_thumbnail() ) : ?>
						<div class="advanced-recent-posts-thumb">
							<a href="<?php the_permalink(); ?>">
								<?php
								$img_attributes = array(
									'style' => 'max-width:' . absint( $instance['image_width'] ) . 'px;',
								);
								the_post_thumbnail( esc_attr( $instance['featured_image'] ), $img_attributes );
								?>
							</a>
						</div>
					<?php endif; ?>

					<div class="advanced-recent-posts-text-wrap">
						<h3 class="advanced-recent-posts-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>

						<div class="advanced-recent-posts-meta entry-meta">
							<span class="advanced-recent-posts-date posted-on"><?php the_time( get_option( 'date_format' ) ); ?></span>
						</div>

						<?php if ( absint( $instance['excerpt_length'] ) > 0 ) : ?>
							<div class="advanced-recent-posts-summary">
								<?php
								$excerpt = business_key_get_the_excerpt( absint( $instance['excerpt_length'] ) );
								echo wp_kses_post( wpautop( $excerpt ) );
								?>
							</div>
						<?php endif; ?>
					</div><!-- .advanced-recent-posts-text-wrap -->

				</div><!-- .advanced-recent-posts-item  -->

			<?php endwhile; ?>
		</div><!-- .advanced-recent-posts-wrapper -->

	<?php endif; ?>

</div><!-- .segment .segment-advanced-recent-posts -->
