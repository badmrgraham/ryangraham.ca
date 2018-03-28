/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

jQuery( document ).ready( function() {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			jQuery( '.site-title a' ).text( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			jQuery( '.site-description' ).text( to );
		} );
	} );

	wp.customize("structr_footer_copy", function(value) {
		value.bind(function(newval) {
			jQuery( ".site-info .inner span" ).html( newval );
		} );
	});

} );
