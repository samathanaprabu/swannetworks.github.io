<?php
/**
 * Custom checkbox multiple control
 *
 * @package Business_Key
 */

/**
 * Custom checkbox multiple control class.
 *
 * @since 1.0.0
 */
class Business_Key_Checkbox_Multiple_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'checkbox-multiple';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since 1.0.0
	 */
	public function to_json() {
		parent::to_json();

		$this->json['value']   = ! is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value();
		$this->json['choices'] = $this->choices;
		$this->json['link']    = $this->get_link();
		$this->json['id']      = $this->id;
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {
		wp_enqueue_style( 'business-key-customize-controls' );
		wp_enqueue_script( 'business-key-customize-controls' );
	}

	/**
	 * Content template.
	 *
	 * @since 1.0.0
	 */
	public function content_template() {
		?>
			<# if ( ! data.choices ) {
				return;
			} #>
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>

			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>

			<ul>
				<# _.each( data.choices, function( label, choice ) { #>
					<li>
						<label>
							<input type="checkbox" value="{{ choice }}" <# if ( -1 !== data.value.indexOf( choice ) ) { #> checked="checked" <# } #> />
							{{ label }}
						</label>
					</li>
				<# } ) #>
			</ul>
		<?php
	}

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {}
}
