<?php
/**
 * Template part for displaying single post
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_Key
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'hentry' ); ?>>

	<?php business_key_single_post_thumbnail(); ?>
	<div class="entry-content-outer-wrapper">
		<div class="custom-entry-date">
			<span class="entry-day"><?php the_time( esc_html_x( 'd', 'date format', 'business-key' ) ); ?></span>
			<span class="entry-month"><?php the_time( esc_html_x( 'M', 'date format', 'business-key' ) ); ?></span>
		</div><!-- .custom-entry-date -->

		<div class="entry-content-wrapper">

			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php business_key_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>

			<div class="entry-content">
				<?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'business-key' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-key' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->

		</div><!-- .entry-content-wrapper -->
	</div><!-- .entry-content-outer-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->
