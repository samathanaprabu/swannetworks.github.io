<?php
/**
 * Custom range slider control
 *
 * @package Business_Key
 */

/**
 * Custom range slider control class.
 *
 * @since 1.0.0
 */
class Business_Key_Range_Slider_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'range-slider';

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    Optional. Arguments to override class property defaults.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		$this->choices = ( isset( $args['choices'] ) ) ? $args['choices'] : array();

		parent::__construct( $manager, $id, $args );
	}


	/**
	 * Pass data to the JS via JSON.
	 *
	 * @since 1.0.0
	 */
	public function to_json() {
		parent::to_json();

		$this->json['value']   = $this->value();
		$this->json['link']    = $this->get_link();
		$this->json['id']      = $this->id;
		$this->json['choices'] = wp_parse_args(
			$this->choices, array(
				'min'  => '0',
				'max'  => '100',
				'step' => '1',
			)
		);
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
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
			<input type="range" min="{{ data.choices['min'] }}" max="{{ data.choices['max'] }}" step="{{ data.choices['step'] }}" {{{ data.link }}} value="{{ data.value }}" class="slider" />
			<span class="value">{{ data.value }}</span>
		<?php
	}
}
