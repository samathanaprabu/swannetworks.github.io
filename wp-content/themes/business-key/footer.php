<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Key
 */

?>
				</div><!-- .inner-wrapper -->

			</div><!-- .container -->

		</div><!-- #content -->

		<?php
		/**
		 * Hook - business_key_action_footer.
		 *
		 * @hooked business_key_add_footer_widgets - 15
		 * @hooked business_key_add_footer_credits - 20
		 */
		do_action( 'business_key_action_footer' );
		?>

	</div><!-- #page -->

	<?php wp_footer(); ?>
	</body>
</html>
