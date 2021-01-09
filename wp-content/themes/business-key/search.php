<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Business_Key
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			if ( have_posts() ) :
			?>

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'search' );

				endwhile;

				the_posts_pagination();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
/**
 * Hook - business_key_action_sidebar.
 *
 * @hooked: business_key_add_sidebar - 10
 */
do_action( 'business_key_action_sidebar' );

get_footer();
