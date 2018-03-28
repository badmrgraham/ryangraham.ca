<?php

if ( ! function_exists( 'sanitize_multi_checkbox' ) ) :
	function sanitize_multi_checkbox( $values ) {
		if ( ! is_array( $values ) ) {
			$multi_values = explode( ', ', $values );
		} else {
			$multi_values = $values;
		}

		if ( ! empty( $multi_values ) ) {
			array_map( 'sanitize_text_field', $multi_values );
			return $multi_values;
		} else {
			return array();
		}
	}
endif;


if ( ! function_exists( 'customizer_library_sanitize_text' ) ) :
	function customizer_library_sanitize_text( $string ) {
		global $allowedtags;
		return wp_kses( $string , $allowedtags );
	}
endif;


if ( ! function_exists( 'customizer_library_sanitize_checkbox' ) ) :
	function customizer_library_sanitize_checkbox( $value ) {
		if ( 1 == $value ) {
			return 1;
	    } else {
			return 0;
	    }
	}
endif;

if ( ! function_exists( 'customizer_library_sanitize_choices' ) ) :
	function customizer_library_sanitize_choices( $value, $setting ) {
		if ( is_object( $setting ) ) {
			$setting = $setting->id;
		}

		$choices = customizer_library_get_choices( $setting );
		$allowed_choices = array_keys( $choices );

		if ( ! in_array( $value, $allowed_choices ) ) {
			$value = customizer_library_get_default( $setting );
		}

		return $value;
	}
endif;


if ( ! function_exists( 'structr_sanitize_font_choices' ) ) :
	function structr_sanitize_font_choices( $value, $setting ) {
		if ( is_object( $setting ) ) {
			$setting = $setting->id;
		}
		$choices = customizer_library_get_font_choices( $setting );
		$allowed_choices = array_keys( $choices );
		if ( ! in_array( $value, $allowed_choices ) ) {
			$value = customizer_library_get_default( $setting );
		}
		return $value;
	}
endif;


if ( ! function_exists( 'structr_sanitize_font_style' ) ) :
	function structr_sanitize_font_style( $value, $setting ) {
		if ( is_object( $setting ) ) {
			$setting = $setting->id;
		}
		$choices = structr_get_font_styles( $setting );
		$allowed_choices = array_keys( $choices );
		if ( ! in_array( $value, $allowed_choices ) ) {
			$value = customizer_library_get_default( $setting );
		}
		return $value;
	}
endif;


if ( ! function_exists( 'structr_sanitize_font_weight' ) ) :
	function structr_sanitize_font_weight( $value, $setting ) {
		if ( is_object( $setting ) ) {
			$setting = $setting->id;
		}
		$choices = structr_get_font_weights( $setting );
		$allowed_choices = array_keys( $choices );
		if ( ! in_array( $value, $allowed_choices ) ) {
			$value = customizer_library_get_default( $setting );
		}
		return $value;
	}
endif;


if ( ! function_exists( 'structr_sanitize_font_transform' ) ) :
	function structr_sanitize_font_transform( $value, $setting ) {
		if ( is_object( $setting ) ) {
			$setting = $setting->id;
		}
		$choices = structr_get_font_transform( $setting );
		$allowed_choices = array_keys( $choices );
		if ( ! in_array( $value, $allowed_choices ) ) {
			$value = customizer_library_get_default( $setting );
		}
		return $value;
	}
endif;


if ( ! function_exists( 'structr_sanitize_font_spacing' ) ) :
	function structr_sanitize_font_spacing( $value, $setting ) {
		if ( is_object( $setting ) ) {
			$setting = $setting->id;
		}
		$choices = structr_get_font_spacing( $setting );
		$allowed_choices = array_keys( $choices );
		if ( ! in_array( $value, $allowed_choices ) ) {
			$value = customizer_library_get_default( $setting );
		}
		return $value;
	}
endif;


if ( ! function_exists( 'customizer_library_sanitize_file_url' ) ) :
	function customizer_library_sanitize_file_url( $url ) {

		$output = '';

		$filetype = wp_check_filetype( $url );
		if ( $filetype['ext'] ) {
			$output = esc_url_raw( $url );
		}

		return $output;
	}
endif;


if ( ! function_exists( 'sanitize_hex_color' ) ) :
	function sanitize_hex_color( $color ) {
		if ( '' === $color ) {
			return '';
		}

		// 3 or 6 hex digits, or the empty string.
		if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
			return $color;
		}

		return null;
	}
endif;


if ( ! function_exists( 'customizer_library_sanitize_range' ) ) :
	function customizer_library_sanitize_range( $value ) {

		if ( is_numeric( $value ) ) {
			return $value;
		}

		return 0;
	}
endif;
