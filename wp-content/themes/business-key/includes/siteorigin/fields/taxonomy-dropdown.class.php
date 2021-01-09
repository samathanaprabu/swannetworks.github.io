<?php
/**
 * Taxonomy dropdown field
 *
 * @package Business_Key
 */

/**
 * Class Business_Key_Field_Taxonomy_Dropdown
 *
 * @since 1.0.0
 */
class Business_Key_Field_Taxonomy_Dropdown extends SiteOrigin_Widget_Field_Select {

	/**
	 * Taxonomy.
	 *
	 * @access protected
	 * @var string
	 */
	protected $taxonomy;

	/**
	 * Show option all.
	 *
	 * @access protected
	 * @var string
	 */
	protected $show_option_all;

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	protected function initialize() {

		$args = array();

		$args['taxonomy']   = ( $this->taxonomy ) ? esc_attr( $this->taxonomy ) : 'category';
		$args['hide_empty'] = true;

		if ( $this->show_option_all ) {
			$this->options[] = esc_html( $this->show_option_all );
		}

		$terms = get_terms( $args );

		if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$this->options[ $term->term_id ] = $term->name;
			}
		}
	}
}
