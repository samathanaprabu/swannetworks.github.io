<?php
/**
 * Custom heading control
 *
 * @package Business_Key
 */

/**
 * Custom heading control class.
 *
 * @since 1.0.0
 */
class Business_Key_Heading_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'heading';

	/**
	 * Pass data to the JS via JSON.
	 *
	 * @since 1.0.0
	 */
	public function to_json() {
		parent::to_json();

		$this->json['value'] = $this->value();
		$this->json['link']  = $this->get_link();
		$this->json['id']    = $this->id;
	}

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {}

	/**
	 * Content template.
	 *
	 * @since 1.0.0
	 */
	public function content_template() {
		?>
			<# if ( data.label ) { #>
				<h3><span class="customize-control-title">{{ data.label }}</span></h3>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{ data.description }}</span>
			<# } #>
		<?php
	}
}
