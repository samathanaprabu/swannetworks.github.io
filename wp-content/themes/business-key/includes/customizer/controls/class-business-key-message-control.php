<?php
/**
 * Custom message control
 *
 * @package Business_Key
 */

/**
 * Custom message control class.
 *
 * @since 1.0.0
 */
class Business_Key_Message_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'message';

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
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{ data.description }}</span>
			<# } #>
		<?php
	}
}
