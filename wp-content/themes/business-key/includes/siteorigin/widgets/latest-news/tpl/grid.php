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

<div class="segment segment-latest-news segment-latest-news-<?php echo esc_attr( $instance['layout_mode'] ); ?>">

	<?php if ( $the_query->have_posts() ) : ?>

		<div class="latest-news-segment latest-news-grid-<?php echo absint( $instance['grid_design'] ); ?> latest-news-col-<?php echo absint( $instance['post_column'] ); ?>">
				<div class="inner-wrapper">
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

					<?php if ( ! empty( $instance['explore_button_url'] ) && ! empty( $instance['explore_button_text'] ) ) : ?>
						<div class="more-wrapper">
							<a href="<?php echo sow_esc_url( $instance['explore_button_url'] ); ?>" class="custom-button custom-secondary-button"><?php echo esc_html( $instance['explore_button_text'] ); ?></a>
						</div><!-- .more-wrapper -->
					<?php endif; ?>
				</div><!-- .inner-wrapper -->
		</div><!-- .latest-news-segment -->

	<?php endif; ?>

</div><!-- .segment .segment-latest-news -->
