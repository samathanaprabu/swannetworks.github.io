<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business_Key
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			if ( have_posts() ) :

				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content' );

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
