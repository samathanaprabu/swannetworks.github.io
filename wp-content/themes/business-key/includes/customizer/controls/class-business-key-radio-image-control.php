<?php
/**
 * Custom radio image control
 *
 * @package Business_Key
 */

/**
 * Custom radio image control class.
 *
 * @since 1.0.0
 */
class Business_Key_Radio_Image_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'radio-image';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since 1.0.0
	 */
	public function to_json() {
		parent::to_json();

		$this->json['choices'] = $this->choices;
		$this->json['link']    = $this->get_link();
		$this->json['value']   = $this->value();
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

			<# _.each( data.choices, function( args, choice ) { #>
				<label>
					<input type="radio" value="{{ choice }}" name="_customize-{{ data.type }}-{{ data.id }}" {{{ data.link }}} <# if ( choice == data.value ) { #> checked="checked" <# } #> />

					<span class="screen-reader-text">{{ args.label }}</span>

					<img src="{{ args.url }}" alt="{{ args.label }}" />
				</label>
			<# } ) #>
		<?php
	}

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {}
}
