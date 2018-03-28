<?php
/** styles.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This file controls the output of Google fonts and other styling
 * options available through the WordPress Theme Customizer.
 *
 * @package Structr
 * @since Structr 1.0
 */


if ( ! function_exists( 'customizer_library_demo_build_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :

	/**
	 * customizer_library_demo_build_styles function.
	 *
	 * @access public
	 * @return void
	 */
	function customizer_library_demo_build_styles() {
		global $structr_font_style_mods;
		$name = isset( $key['name'] ) ? print_r( $key['name'] ) : '';
		$structr_font_style_mods = structr_font_style_mods();

		foreach ( $structr_font_style_mods as $key ) {

			// All Font Family Styles
			$families = array( 'serif' );
			$setting = $name . '_family';
			$mod = $key['family'];
			$stack = customizer_library_get_font_stack( $mod );

			if ( in_array( array( 'serif' ) != $mod, $families ) ) {

				Customizer_Library_Styles()->add( array(
					'selectors' => array(
					$key['selectors']
					),
					'declarations' => array(
					'font-family' => $stack,
					),
				) );
			}

			// All Font Size Styles
			$setting = $name . '_font_size';
			$mod = $key['size'];

			if ( structr_get_default( $setting ) != $mod ) {

				Customizer_Library_Styles()->add( array(
					'selectors' => array(
					$key['selectors']
					),
					'declarations' => array(
					'font-size' => $mod . 'px',
					),
				) );
			}

			// All Font Style Styles
			$setting = $name . '_font_style';
			$mod = $key['style'];

			if ( 'normal' != $mod ) {

				Customizer_Library_Styles()->add( array(
					'selectors' => array(
					$key['selectors']
					),
					'declarations' => array(
					'font-style' => $mod,
					),
				) );
			}

			// All Font Weight Styles
			$setting = $name . '_font_weight';
			$mod = $key['weight'];

			if ( '400' != $mod ) {

				Customizer_Library_Styles()->add( array(
					'selectors' => array(
					$key['selectors']
					),
					'declarations' => array(
					'font-weight' => $mod,
					),
				) );
			}

			// All Font Transform Styles
			$setting = $name . '_text_transform';
			$mod = $key['transform'];

			if ( 'none' != $mod ) {

				Customizer_Library_Styles()->add( array(
					'selectors' => array(
					$key['selectors']
					),
					'declarations' => array(
					'text-transform' => $mod,
					),
				) );
			}

			// All Letter Spacing Styles
			$setting = $name . '_letter_spacing';
			$mod = $key['spacing'];

			if ( 'normal' != $mod ) {

				Customizer_Library_Styles()->add( array(
					'selectors' => array(
					$key['selectors']
					),
					'declarations' => array(
					'letter-spacing' => $mod,
					),
				) );
			}
		}

		// Main Container Width
		$setting = 'structr_container_width';
		$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

		if ( customizer_library_get_default( $setting ) !== $mod || '1170' != $mod ) {

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
				'body .inner'
				),
				'declarations' => array(
				'max-width' => $mod . 'px',
				),
			) );

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
				'.inner, .structr-blocks-enabled .main-area .inner'
				),
				'declarations' => array(
				'padding' => '0 1em',
				),
				'media' => 'screen and ( max-width:' . $mod . 'px )',
			) );

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
				'.struc-social-area ul li:last-child a'
				),
				'declarations' => array(
				'padding-right' => '1em',
				),
				'media' => 'screen and ( max-width:' . $mod . 'px )',
			) );

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
				'.main-area .inner, .top-area .inner, .structr-blocks-enabled .main-area .blocks-temp-two.inner'
				),
				'declarations' => array(
				'padding' => '0',
				),
				'media' => 'screen and ( max-width:' . $mod . 'px )',
			) );

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
				'.footer-area.full .inner'
				),
				'declarations' => array(
				'padding' => '0 1.5em',
				),
				'media' => 'screen and ( max-width:' . $mod . 'px )',
			) );
		}

		// GLOBAL COLORS SECTION >> Colors Panel - 10 -
		// Content Area Background Color
		$setting = 'content_background';
		$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

		if ( customizer_library_get_default( $setting ) !== $mod ) {

			$color = sanitize_hex_color( $mod );

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
				'.hentry, .post.no-results, .post.error404, .post-cats-tags, .archive-head, #comments'
				),
				'declarations' => array(
				'background-color' => $color,
				),
			) );
		}

		// Primary Text Color
		$setting = 'primary_text';
		$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

		if ( customizer_library_get_default( $setting ) !== $mod ) {

			$color = sanitize_hex_color( $mod );

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
				'body, button, input, select, textarea'
				),
				'declarations' => array(
				'color' => $color,
				),
			) );
		}

		// Secondary Text Color
		$setting = 'secondary_text';
		$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

		if ( customizer_library_get_default( $setting ) !== $mod ) {

			$color = sanitize_hex_color( $mod );

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
				'blockquote, .post-cats-tags'
				),
				'declarations' => array(
				'color' => $color,
				),
			) );
		}

		// Links Text Color
		$setting = 'link_text';
		$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

		if ( customizer_library_get_default( $setting ) !== $mod ) {

			$color = sanitize_hex_color( $mod );

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
				'a'
				),
				'declarations' => array(
				'color' => $color,
				),
			) );

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
				'button, input[type="submit"], input[type="button"]'
				),
				'declarations' => array(
				'background-color' => $color,
				),
			) );
		}

		// Links Hover Color
		$setting = 'link_hover_text';
		$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

		if ( customizer_library_get_default( $setting ) !== $mod ) {

			$color = sanitize_hex_color( $mod );

			Customizer_Library_Styles()->add( array(
				'selectors' => array(
				'a:hover, button:hover, input[type="submit"]:hover, input[type="button"]:hover'
				),
				'declarations' => array(
				'color' => $color,
				),
			) );
		}
	}
endif;
add_action( 'customizer_library_styles', 'customizer_library_demo_build_styles' );


if ( ! function_exists( 'customizer_library_demo_styles' ) ) :

	/**
	 * customizer_library_demo_styles function.
	 *
	 * @access public
	 * @return void
	 */
	function customizer_library_demo_styles() {

		do_action( 'customizer_library_styles' );

		// Echo the rules
		$css = Customizer_Library_Styles()->build();

		if ( ! empty( $css ) ) {
			echo "\n<!-- Begin Custom CSS -->\n<style type=\"text/css\" id=\"demo-custom-css\">\n";
			if ( 1 == get_theme_mod( 'structr_hide_tagline' ) ) {
				echo '.main-menu-container { top: -2px; }';
			}
			echo $css;
			echo "\n</style>\n<!-- End Custom CSS -->\n";
		}
	}
endif;
add_action( 'wp_head', 'customizer_library_demo_styles', 11 );
