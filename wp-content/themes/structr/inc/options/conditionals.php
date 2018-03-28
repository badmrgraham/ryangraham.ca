<?php
/** File: conditionals.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This file includes a bunch of conditionals that determine both
 * layout and content that is shown or hidden with options.
 *
 * @package Structr
 * @since Structr 1.0
 */

/**
 * structr_get_layout function.
 *
 * @access public
 * @return void
 */
function structr_get_layout() {
	$option = get_theme_mod( 'structr_content_layout', 'cs' );
	switch ( $option ) {
		case 'c1':
			$structr_layout = 'c1';
		break;

		case 'sc':
			$structr_layout = 'sc';
		break;

		case 'cs':

			$structr_layout = 'cs';
		break;
	}
	return $structr_layout;
}


/**
 * structr_get_column_count function.
 *
 * @access public
 * @return void
 */
function structr_get_column_count() {
	$option = get_theme_mod( 'structr_content_layout', 'cs' );
	if ( 'c1' == $option ) {
		return 1;
	} elseif ( 'sc' == $option || 'cs' == $option ) {
		return 2;
	}
}


/**
 * structr_default_widget_on function.
 *
 * @access public
 * @return void
 */
function structr_default_widget_on() {
	if ( 1 == get_theme_mod( 'structr_default_widgets', 1 ) ) {
		return true;
	} else {
		return false;
	}
}


/**
 * structr_byline_author_on function.
 *
 * @access public
 * @return void
 */
function structr_byline_author_on() {
	$option = get_theme_mod( 'structr_byline_author', 1 );
	if ( 1 == $option ) {
		return true;
	} else {
		return false;
	}
}


/**
 * structr_byline_date_on function.
 *
 * @access public
 * @return void
 */
function structr_byline_date_on() {
	$option = get_theme_mod( 'structr_byline_date', 1 );
	if ( 1 == $option ) {
		return true;
	} else {
		return false;
	}
}


/**
 * structr_byline_edit_on function.
 *
 * @access public
 * @return void
 */
function structr_byline_edit_on() {
	$option = get_theme_mod( 'structr_byline_edit', 1 );
	if ( 1 == $option ) {
		return true;
	} else {
		return false;
	}
}


/**
 * structr_byline_comments_on function.
 *
 * @access public
 * @return void
 */
function structr_byline_comments_on() {
	$option = get_theme_mod( 'structr_byline_comments', 1 );
	if ( 1 == $option ) {
		return true;
	} else {
		return false;
	}
}


/**
 * structr_has_byline_items function.
 *
 * @access public
 * @return void
 */
function structr_has_byline_items() {
	if ( structr_byline_author_on() || structr_byline_date_on() || structr_byline_edit_on() || structr_byline_comments_on() ) {
		return true;
	} else {
		return false;
	}
}


/**
 * structr_cats_after_on function.
 *
 * @access public
 * @return void
 */
function structr_cats_after_on() {
	$option = get_theme_mod( 'structr_cats_after_posts', 1 );
	if ( 0 != $option ) {
		return true;
	} else {
		return false;
	}
}

/**
 * structr_tags_after_on function.
 *
 * @access public
 * @return void
 */
function structr_tags_after_on() {
	$option = get_theme_mod( 'structr_tags_after_posts', 1 );
	if ( 0 != $option ) {
		return true;
	} else {
		return false;
	}
}

/**
 * structr_closed_comm_on function.
 *
 * @access public
 * @return void
 */
function structr_closed_comm_on() {
	$option = get_theme_mod( 'structr_comm_cl_notice', 1 );
	if ( 0 !== $option ) {
		return true;
	} else {
		return false;
	}
}

/**
 * structr_empty_comm_on function.
 *
 * @access public
 * @return void
 */
function structr_empty_comm_on() {
	$option = get_theme_mod( 'structr_comm_em_notice', 1 );
	if ( 0 !== $option ) {
		return true;
	} else {
		return false;
	}
}

/**
 * structr_has_entry_footer function.
 *
 * @access public
 * @return void
 */
function structr_has_entry_footer() {
	if ( structr_cats_after_on() || structr_tags_after_on() ) {
		return true;
	} else {
		return false;
	}
}
