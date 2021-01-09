( function( $, api ) {

	/* === Upsell Section === */
	api.sectionConstructor['upsell'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

	/* === Dropdown Taxonomies Control === */
	api.controlConstructor['dropdown-taxonomies'] = api.Control.extend( {
		ready: function() {
			var control = this;

			$( 'select', control.container ).change(
				function() {
					control.setting.set( $( this ).val() );
				}
			);
		}
	} );

	/* === Dropdown Sidebars Control === */
	api.controlConstructor['dropdown-sidebars'] = api.Control.extend( {
		ready: function() {
			var control = this;

			$( 'select', control.container ).change(
				function() {
					control.setting.set( $( this ).val() );
				}
			);
		}
	} );

	/* === Radio Image Control === */
	api.controlConstructor['radio-image'] = api.Control.extend( {
		ready: function() {
			var control = this;

			$( 'input:radio', control.container ).change(
				function() {
					control.setting.set( $( this ).val() );
				}
			);
		}
	} );

	/* === Range Slider Control === */
	api.controlConstructor['range-slider'] = api.Control.extend( {
		ready: function() {
			var control = this;

			$( 'input.slider', control.container ).change(
				function() {
					$(this).parents( '.customize-control' ).find('span.value').text( $( this ).val() );
				}
			);
		}
	} );

	/* === Text Multiple Control === */
	api.controlConstructor['text-multiple'] = api.Control.extend( {
		ready: function() {
			var control = this;

			$( 'input.single-text', control.container ).change(
				function() {
					var all_values = $(this).parents( '.customize-control' ).find( 'input.single-text' ).map(
						function() {
							return this.value;
						}
						).get().join( '|' );

					if ( null === all_values ) {
						control.setting.set( '' );
					} else {
						control.setting.set( all_values );
					}
				}
			);
		}
	} );

	/* === Checkbox Multiple Control === */
	api.controlConstructor['checkbox-multiple'] = api.Control.extend( {
		ready: function() {
			var control = this;

			$( 'input:checkbox', control.container ).change(
				function() {

					// Get all of the checkbox values.
					var checkbox_values = $( 'input[type="checkbox"]:checked', control.container ).map(
						function() {
							return this.value;
						}
					).get();

					// Set the value.
					if ( null === checkbox_values ) {
						control.setting.set( '' );
					} else {
						control.setting.set( checkbox_values );
					}
				}
			);
		}
	} );

} )( jQuery, wp.customize );
