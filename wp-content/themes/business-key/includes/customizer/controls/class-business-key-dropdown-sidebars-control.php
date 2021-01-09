<?php
/**
 * Custom dropdown sidebars control
 *
 * @package Business_Key
 */

/**
 * Custom dropdown sidebars control class.
 *
 * @since 1.0.0
 *
 * @see WP_Customize_Control
 */
class Business_Key_Dropdown_Sidebars_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'dropdown-sidebars';

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
		global $wp_registered_sidebars;

		$choices = array();

		$all_sidebars = $wp_registered_sidebars;

		if ( $all_sidebars ) {
			foreach ( $all_sidebars as $key => $sidebar ) {
				$choices[ $key ] = $sidebar['name'];
			}
		}

		$this->choices = $choices;

		parent::__construct( $manager, $id, $args );
	}

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
			<label>
				<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
				<# } #>
				<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
				<# } #>
				<select {{{ data.link }}} name="_customize-{{ data.type }}-{{ data.id }}" id="{{ data.id }}">
					<# _.each( data.choices, function( label, choice ) { #>

					<option value="{{ choice }}" <# if ( choice === data.value ) { #> selected="selected" <# } #>>{{{ label }}}</option>

					<# } ) #>
				</select>
			</label>
		<?php
	}

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {}
}
