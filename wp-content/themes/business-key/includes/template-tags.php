<?php
/**
 * Custom template tags for this theme
 *
 * @package Business_Key
 */

if ( ! function_exists( 'business_key_posted_on' ) ) :

	/**
	 * Prints HTML with meta information for the current post.
	 *
	 * @since 1.0.0
	 */
	function business_key_posted_on() {
		if ( is_search() ) {
			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf(
				$time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			$posted_on = sprintf(
				'%s',
				'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);

			$byline = sprintf(
				'%s',
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);

			echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
		}

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'business-key' ) );
			if ( $categories_list ) {
				printf( '<span class="cat-links">%s</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'business-key' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">%s</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( '0 Comments', 'business-key' ) );
			echo '</span>';
		}
	}
endif;
