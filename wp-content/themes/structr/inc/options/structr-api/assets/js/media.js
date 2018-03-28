jQuery( document ).ready( function( $ ) {

	var structr_media_media_frame;

	$( document.body ).on( 'click.SPMediaUploaderOpenMediaManager', '.structr-media-preview-image', function( e ) {

		e.preventDefault();

		$div = $( e.target ).closest( '.structr-media' );

		if ( structr_media_media_frame ) {
			structr_media_media_frame.open();

			return;
		}

		structr_media_media_frame = wp.media.frames.structr_media_media_frame = wp.media({
			frame:    'select',
			multiple: false,
			title:    'Select Image',
			library:  { type: 'image' },
			button:   { text: 'Use Image' }
		});

		structr_media_media_frame.on( 'select', function() {
			selection = structr_media_media_frame.state().get( 'selection' );

			if ( ! selection ) {
				return;
			}

			selection.each( function( attachment ) {
				$div.find( '.structr-media-url' ).val( attachment.attributes.sizes.full.url );
				$div.find( '.structr-media-preview-image' ).attr( 'src', attachment.attributes.sizes.full.url );
				$div.find( '.structr-media-remove' ).show();
			});
		});

		structr_media_media_frame.open();
	});

	$( document.body ).on( 'click.SPMediaRemove', '.structr-media-remove', function( e ) {
		e.preventDefault();

		$div = $( this ).closest( '.structr-media' );

		$( this ).hide();
		$div.find( '.structr-media-url' ).val( '' );
		$div.find( '.structr-media-preview-image' ).attr( 'src', '' );
	});

});
