<?php
/** File: framework.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This file builds each section of the theme into its 'framework'.
 *
 * @package Structr
 * @since Structr 1.0
 */

/**
 * Function: structr function.
 *
 * @access public
 * @return void
 */
function structr() {
	global $options, $post;
	$options = get_option( 'struc_hooks_ops' );

	get_header();

	structr_header_element();

	if ( is_singular() ) {
		do_action( 'main_area_singular' );
	} else {
		do_action( 'main_area' );
	}

	structr_footer_element();

	get_footer();
}
