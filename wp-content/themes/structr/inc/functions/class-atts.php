<?php
/** class-atts.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This adds CSS classes to different areas of your site.
 *
 * @package Structr
 * @since Structr 1.0
 */


/**
 * structr_post_top function.
 *
 * @access public
 * @param mixed $structr_classes
 * @return void
 */
function structr_post_top( $structr_classes ) {
	global $wp_query;
	if ( 0 == $wp_query->current_post ) { $structr_classes[] = 'top';
	}
	return $structr_classes;
}
add_filter( 'post_class', 'structr_post_top' );



/**
 * structr_templates_body_class function.
 *
 * @access public
 * @param mixed $structr_classes
 * @return void
 */
function structr_templates_body_class( $structr_classes ) {

	if ( is_page_template( 'landing-pg.php' ) ) {
		$structr_classes[] = 'landing';
	} elseif ( is_page_template( 'squeeze-pg.php' ) ) {
		$structr_classes[] = 'squeeze';
	}
	return $structr_classes;
}
add_filter( 'body_class', 'structr_templates_body_class' );



/**
 * structr_body_classes function.
 *
 * @access public
 * @param mixed $structr_classes
 * @return void
 */
function structr_body_classes( $structr_classes ) {
	global $post, $structr_layout;

	if ( is_multi_author() ) {
		$structr_classes[] = 'group-blog';
	}

	if ( is_singular() ) {
		$single_layout = get_post_meta( $post->ID, '_singular-column', true );
	}

	if ( is_singular() ) {
		if ( 'default' == $single_layout || '' == $single_layout ) {
			if ( 1 == structr_get_column_count() ) {
				$structr_classes[] = 'one-col';
			} elseif ( 2 == structr_get_column_count() ) {
				$structr_classes[] = 'two-col';
			}
			$structr_classes[] = structr_get_layout();
		} elseif ( 'c1' == $single_layout ) {
			$structr_classes[] = 'one-col';
			$structr_classes[] = $single_layout;
		} elseif ( 'cs' == $single_layout || 'sc' == $single_layout ) {
			$structr_classes[] = 'two-col';
			$structr_classes[] = $single_layout;
		}
	} else {
		if ( 1 == structr_get_column_count() ) {
			$structr_classes[] = 'one-col';
		} elseif ( 2 == structr_get_column_count() ) {
			$structr_classes[] = 'two-col';
		}
		$structr_classes[] = structr_get_layout();
	}
	return $structr_classes;
}
add_filter( 'body_class', 'structr_body_classes' );



/**
 * structr_singular_body_class function.
 *
 * @access public
 * @param mixed $structr_classes
 * @return void
 */
function structr_singular_body_class( $structr_classes ) {
	global $post, $structr_top_menu_choice, $structr_main_menu_choice, $structr_header_choice, $structr_title_choice, $structr_footer_widgets_choice, $structr_footer_choice;

	if ( is_singular() ) {
		$structr_top_menu_choice = get_post_meta( $post->ID, '_singular-top-menu', true );
		$structr_main_menu_choice = get_post_meta( $post->ID, '_singular-main-menu', true );
		$structr_title_choice = get_post_meta( $post->ID, '_singular-title', true );
		$singular_body_class = get_post_meta( $post->ID, '_custom-body-class', true );

		if ( '' !== $singular_body_class ) {
			$structr_classes[] = $singular_body_class;
		}

		if ( is_page() && 1 === $structr_top_menu_choice ) {
			$structr_classes[] = 'no-top-menu';
		}
		if ( is_page() && 1 === $structr_main_menu_choice ) {
			$structr_classes[] = 'no-main-menu';
		}
		if ( is_page() && 1 === $structr_title_choice ) {
			$structr_classes[] = 'no-title';
		}
	}
	return $structr_classes;
}
add_filter( 'body_class', 'structr_singular_body_class' );



/**
 * structr_singular_post_class function.
 *
 * @access public
 * @param mixed $structr_classes
 * @return void
 */
function structr_singular_post_class( $structr_classes ) {
	global $post;

	if ( is_singular() ) {

		$singular_post_class = get_post_meta( $post->ID, '_custom-post-class', true );

		if ( '' !== $singular_post_class ) {
			$structr_classes[] = $singular_post_class;
		}
	}
	return $structr_classes;
}
add_filter( 'post_class', 'structr_singular_post_class' );
