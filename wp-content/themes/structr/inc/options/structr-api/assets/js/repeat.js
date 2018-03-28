jQuery( document ).ready( function( $ ) {

	var SP_Repeatable_Fields = {
		init: function() {
			this.add();
			this.remove();
		},

		add: function() {
			$( '.structr-repeat-add' ).click( function( e ) {
				e.preventDefault();

				var lastRepeatingGroup = $( this ).closest( '.structr-repeat' ).find( '.structr-repeat-field' ).last(),
					clone = lastRepeatingGroup.clone( true );

				clone.addClass( 'structr-repeat-field-new' );

				clone.find( 'input.regular-text, textarea, select' ).val( '' );
				clone.find( 'input.regular-text' ).prop( 'readonly', false );
				clone.find( 'input[type=checkbox]' ).attr( 'checked', false );

				clone.insertAfter( lastRepeatingGroup );

				SP_Repeatable_Fields.resetAtts( clone );
			});
		},

		remove: function() {
			$( '.structr-repeat-delete' ).click( function( e ) {
				e.preventDefault();

				var current = $( this ).parent( 'div' ), others = current.siblings( '.structr-repeat-field' );

				if ( others.length === 0 ) {
					alert( 'You must have at least have one field.' );
					return;
				}

				current.fadeOut( 'fast', function() {
					current.remove();

					others.each( function() {
						SP_Repeatable_Fields.resetAtts( $( this ) );
					});
				});

			});
		},

		resetAtts: function( section ) {
			var attrs = ['for', 'id', 'name'],
				tags  = section.find( 'input, label' ),
				idx   = section.index();

			tags.each( function() {
				var $this = $( this );

				$.each( attrs, function( i, attr ) {
					var attr_val = $this.attr( attr );

					if ( attr_val ) {
						$this.attr( attr, attr_val.replace( /(\d+)(?=\D+$)/, idx ) );
					}
				});
			});
		}

	}

	SP_Repeatable_Fields.init();

});
