jQuery( document ).ready( function() {
	jQuery( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on( 'change', function() {
		checkbox_values = jQuery( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
			function() { return this.value; }
		).get().join( ',' );
		jQuery( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
	});
});


jQuery( document ).ready( function() {
	wp.customizerCtrlEditor = {

		init: function() {

			jQuery( window ).load(function(){

				jQuery( 'textarea.wp-editor-area' ).each(function(){
					var tArea = jQuery( this ),
						id = tArea.attr( 'id' ),
						input = jQuery( 'input[data-customize-setting-link="' + id + '"]' ),
						editor = tinyMCE.get( id ),
						setChange,
						content;

					if (editor) {
						editor.onChange.add(function (ed, e) {
							ed.save();
							content = editor.getContent();
							clearTimeout( setChange );
							setChange = setTimeout(function(){
								input.val( content ).trigger( 'change' );
							},500);
						});
					}

					if (editor) {
						editor.onChange.add(function (ed, e) {
							ed.save();
							content = editor.getContent();
							clearTimeout( setChange );
							setChange = setTimeout(function(){
								input.val( content ).trigger( 'change' );
							},500);
						});
					}

					tArea.css({
						visibility: 'visible'
					}).on('keyup', function(){
						content = tArea.val();
						clearTimeout( setChange );
						setChange = setTimeout(function(){
							input.val( content ).trigger( 'change' );
						},500);
					});
				});
			});
		}

	};

	wp.customizerCtrlEditor.init();

});



// Structr Premium Section Link
( function( api ) {

	// Extends our custom "section_premium" section.
	api.sectionConstructor['section_premium'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	});

})( wp.customize );
