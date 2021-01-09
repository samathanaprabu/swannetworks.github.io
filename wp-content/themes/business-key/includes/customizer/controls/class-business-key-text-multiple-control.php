<?php
/**
 * Custom text multiple control
 *
 * @package Business_Key
 */

/**
 * Custom text multiple control class.
 *
 * @since 1.0.0
 */
class Business_Key_Text_Multiple_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'text-multiple';

	/**
	 * Total.
	 *
	 * @access public
	 * @var total
	 */
	public $total;

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
		$total = 5;
		if ( isset( $args['total'] ) ) {
			$total = absint( $args['total'] );
		}
		$args['total'] = $total;
		$this->total   = absint( $total );

		parent::__construct( $manager, $id, $args );
	}


	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since 1.0.0
	 */
	public function to_json() {
		parent::to_json();

		$this->json['value']   = ! is_array( $this->value() ) ? explode( '|', $this->value() ) : $this->value();
		$this->json['total']   = $this->total;
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

			<# var $_items = _.range( data.total ) #>

			<# var cnt = 0 #>
			<# _.each( $_items, function() { #>

				<input type="text" value="{{ data.value[cnt] }}" class="single-text" />
				<# cnt++ #>

			<# } ) #>
			<input type="hidden" {{{ data.link }}} name="_customize-{{ data.type }}-{{ data.id }}" id="{{ data.id }}" value="{{ data.value }}" />

		<?php
	}

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {}
}
