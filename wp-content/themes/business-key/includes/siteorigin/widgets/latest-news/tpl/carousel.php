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

<div class="segment segment-carousel segment-latest-news segment-latest-news-<?php echo esc_attr( $instance['layout_mode'] ); ?>">

	<?php if ( $the_query->have_posts() ) : ?>

		<?php
		$carousel_data = array(
			'slides_to_show'   => absint( $instance['post_display'] ),
			'slides_to_scroll' => 1,
			'dots'             => ( ( true === $instance['enable_pager'] ) ? true : false ),
			'arrows'           => ( ( true === $instance['enable_arrow'] ) ? true : false ),
			'prev_arrow'       => '<span data-role="none" class="slick-prev" tabindex="0"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></span>',
			'next_arrow'       => '<span data-role="none" class="slick-next" tabindex="0"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>',
		);

		if ( true === $instance['enable_autoplay'] ) {
			$carousel_data['autoplay']       = true;
			$carousel_data['autoplay_speed'] = 1000 * absint( $instance['transition_delay'] );
		}

		$carousel_attributes_text = '';

		foreach ( $carousel_data as $key => $item ) {
			$carousel_attributes_text .= ' ';
			$carousel_attributes_text .= ' data-' . esc_attr( $key ) . '="' . esc_attr( $item ) . '"';
		}
		?>

		<div class="latest-news-segment">
			<div class="latest-news-carousel-wrapper" <?php echo $carousel_attributes_text; ?>> <?php // WPCS: XSS OK. ?>
				<?php
				while ( $the_query->have_posts() ) :
					$the_query->the_post();
				?>

					<?php $image_class = ( has_post_thumbnail() ) ? 'featured-image-enabled' : 'featured-image-disabled'; ?>

					<div class="latest-news-item <?php echo esc_attr( $image_class ); ?>">
						<div class="latest-news-wrapper">
							<div class="latest-news-thumb">
								<a href="<?php the_permalink(); ?>">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php
									$img_attributes = array( 'class' => 'aligncenter' );
									the_post_thumbnail( esc_attr( $instance['featured_image'] ), $img_attributes );
									?>
								<?php endif; ?>
								</a>
							</div><!-- .latest-news-thumb -->
							<div class="latest-news-text-content">
							<div class="news-meta-wrapper">

								<div class="entry-meta latest-news-meta">
									<span class="posted-on"><a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span>
									<?php $category = business_key_get_single_post_category(); ?>
									<?php if ( ! empty( $category ) ) : ?>
										<span class="comments-link latest-news-category"><a href="<?php echo esc_url( $category['url'] ); ?>"><?php echo esc_html( $category['name'] ); ?></a></span>
									<?php endif; ?>
								</div><!-- .latest-news-meta -->
								<h3 class="latest-news-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								</div> <!-- .news-meta-wrapper -->
								<?php if ( absint( $instance['excerpt_length'] ) > 0 ) : ?>
									<div class="latest-news-summary">
										<?php
										$excerpt = business_key_get_the_excerpt( absint( $instance['excerpt_length'] ) );
										echo wp_kses_post( wpautop( $excerpt ) );
										?>
									</div><!-- .latest-news-summary -->
								<?php endif; ?>

								<?php if ( ! empty( $instance['more_text'] ) ) : ?>
									<a href="<?php the_permalink(); ?>" class="more-link"><?php echo esc_html( $instance['more_text'] ); ?></a>
								<?php endif; ?>
							</div><!-- .latest-news-text-content -->
						</div><!-- .latest-news-wrapper -->
					</div><!-- .latest-news-item  -->

				<?php endwhile; ?>
			</div><!-- .latest-news-carousel-wrapper -->

			<?php if ( ! empty( $instance['explore_button_url'] ) && ! empty( $instance['explore_button_text'] ) ) : ?>
				<div class="more-wrapper">
					<a href="<?php echo sow_esc_url( $instance['explore_button_url'] ); ?>" class="custom-button custom-secondary-button"><?php echo esc_html( $instance['explore_button_text'] ); ?></a>
				</div><!-- .more-wrapper -->
			<?php endif; ?>
		</div><!-- .latest-news-segment -->

	<?php endif; ?>

</div><!-- .segment .segment-latest-news -->
