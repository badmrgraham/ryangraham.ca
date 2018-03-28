<?php
/** File: layouts.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This file includes three switch statements for building column layouts.
 *
 * @package Structr
 * @since Structr 1.0
 */

/**
 * Function: structr_columns.
 *
 * @access public
 * @return void
 */
function structr_columns() {
	switch ( structr_get_layout() ) {
		case 'c1':
			structr_content();
			break;
		case 'cs':
		case 'sc':
			structr_content();
			get_sidebar( 'primary' );
			break;
		case '':
			printf( wp_kses( 'Error: Not a %s Option.', 'structr' ), esc_html( STRUCTR_THEME_NAME, 'structr' ) );
	}
}

/**
 * Function: structr_columns_singular.
 *
 * @access public
 * @return void
 */
function structr_columns_singular() {
	global $post;
	$single_layout = get_post_meta( $post->ID, '_singular-column', true );

	switch ( $single_layout ) {
		case 'c1':
			structr_content();
			break;
		case 'cs':
		case 'sc':
			structr_content();
			get_sidebar( 'primary' );
			break;
		default:

			// Defaults back to global setting for layout.
			structr_columns();
	}
}

/**
 * Function: structr_landing_columns.
 *
 * @access public
 * @return void
 */
function structr_landing_columns() {
	global $post;
	$single_layout = get_post_meta( $post->ID, '_singular-column', true );

	switch ( $single_layout ) {
		case 'c1':
			structr_content();
			break;
		default:
			structr_content();
			break;
	}
}
