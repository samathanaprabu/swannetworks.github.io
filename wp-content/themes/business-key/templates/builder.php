<?php
/**
 * Template for Page Builder
 *
 * Template name: Page Builder
 *
 * @package Business_Key
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
endif;

get_footer();
