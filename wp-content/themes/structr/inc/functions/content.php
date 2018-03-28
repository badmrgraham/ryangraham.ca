<?php
/** content.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This includes a few functions for different content elements.
 *
 * @package Structr
 * @since Structr 1.0
 */


/**
 * my_password_form function.
 *
 * @access public
 * @return void
 */
function structr_my_password_form() {
	global $post;
	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<form class="protected" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    ' . __( '<p><strong>To view this protected post, enter the password below:</strong></p>', 'structr' ) . '
    <label for="' . $label . '">' . __( 'Password:', 'structr' ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /><input type="submit" name="Submit" value="' . esc_attr__( ' Submit ', 'structr' ) . '" />
    </form>
    ';
	return $o;
}
add_filter( 'the_password_form', 'structr_my_password_form' );


/**
 * structr_cerpts function.
 *
 * @access public
 * @param mixed $content
 * @return void
 */
function structr_cerpts( $content ) {
	global $more_link_text;

	if ( get_theme_mod( 'structr_post_excerpt_link', 1 ) != 0 ) {
		$more_link_text = apply_filters( 'more_link_text', esc_html( get_theme_mod( 'structr_excerpt_link_text', __( 'Read More', 'structr' ) . ' &rarr;' ) ) );

		if ( get_theme_mod( 'structr_excerpt_link_text', __( 'Read More', 'structr' ) . ' &rarr;' ) == '' ) {
			return str_replace( '[&hellip;]', '', $content );
		} else {
			return str_replace( '[&hellip;]',
				'&hellip;</p> <div class="continue-reading"><a class="more-link" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . $more_link_text . '</a></div>',
				$content
			);
		}
	}
	return $content;
}
add_filter( 'get_the_excerpt', 'structr_cerpts' );


/**
 * structr_custom_excerpt_length function.
 *
 * @access public
 * @param mixed $length
 * @return void
 */
function structr_custom_excerpt_length( $length ) {
	return esc_html( get_theme_mod( 'structr_excerpt_length', 55 ) );
}
add_filter( 'excerpt_length', 'structr_custom_excerpt_length', 999 );
