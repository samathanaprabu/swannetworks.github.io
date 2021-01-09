<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_Key
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php business_key_archive_post_thumbnail(); ?>

	<div class="entry-content-outer-wrapper">
		<div class="custom-entry-date">
			<span class="entry-day"><?php the_time( esc_html_x( 'd', 'date format', 'business-key' ) ); ?></span>
			<span class="entry-month"><?php the_time( esc_html_x( 'M', 'date format', 'business-key' ) ); ?></span>
		</div><!-- .custom-entry-date -->
		<div class="entry-content-wrapper">
			<header class="entry-header">
				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			</header><!-- .entry-header -->
			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php business_key_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>

			<div class="entry-content">
				<?php the_excerpt(); ?>
				<?php if ( ! is_singular() ) : ?>
					<?php business_key_read_more(); ?>
				<?php endif; ?>
			</div><!-- .entry-content -->
		</div><!-- .entry-content-wrapper -->
	</div><!-- .entry-content-outer-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->
