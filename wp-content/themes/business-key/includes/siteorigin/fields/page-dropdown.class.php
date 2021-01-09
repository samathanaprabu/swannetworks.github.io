<?php
/**
 * Page dropdown field
 *
 * @package Business_Key
 */

/**
 * Class Business_Key_Field_Page_Dropdown
 *
 * @since 1.0.0
 */
class Business_Key_Field_Page_Dropdown extends SiteOrigin_Widget_Field_Select {

	/**
	 * Show option none.
	 *
	 * @access protected
	 * @var string
	 */
	protected $show_option_none;

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	protected function initialize() {

		$args = array(
			'post_status' => 'publish',
		);

		if ( $this->show_option_none ) {
			$this->options[] = esc_html( $this->show_option_none );
		}

		$pages = get_pages();

		if ( ! empty( $pages ) ) {
			foreach ( $pages as $page ) {
				$this->options[ $page->ID ] = $page->post_title;
			}
		}
	}
}
