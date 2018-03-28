<?php
/** mode.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This file puts together the multi-dimensional arrays & default.
 * values for different options throughout the theme customizer.
 *
 * @package Structr
 * @since Structr 1.0
 */


/**
 * structr_demo_fonts function.
 *
 * @access public
 * @return void
 */
function structr_demo_fonts() {

	// Font options
	$fonts = array(
		esc_html( get_theme_mod( 'type_global_main_family', '' ) ),
	);

	$font_uri = customizer_library_get_google_font_uri( $fonts );

	// Load Google Fonts
	wp_enqueue_style( 'structr_demo_fonts', $font_uri, array(), null, 'screen' );

}
add_action( 'wp_enqueue_scripts', 'structr_demo_fonts' );


if ( ! function_exists( 'structr_font_style_mods' ) ) :
	/**
	 * structr_font_style_mods function.
	 *
	 * @access public
	 * @return void
	 */
	function structr_font_style_mods() {
		global $structr_defaults, $structr_setting_id;

		$structr_font_style_mods = array(
		'type_global_main' => array(
			'name'      => 'type_global_main',
			'family'    => esc_html( get_theme_mod( 'type_global_main_family', '' ) ),
			'size'      => esc_html( get_theme_mod( 'type_global_main_size', structr_get_default( $structr_setting_id ) ) ),
			'style'     => esc_html( get_theme_mod( 'type_global_main_style', 'normal' ) ),
		    'weight'    => esc_html( get_theme_mod( 'type_global_main_weight', '400' ) ),
		    'transform' => esc_html( get_theme_mod( 'type_global_main_transform', 'none' ) ),
		    'spacing'   => esc_html( get_theme_mod( 'type_global_main_spacing', 'normal' ) ),
		    'selectors' => 'body, button, input, select, textarea',
		),
			);
			return $structr_font_style_mods;
	}
endif;


if ( ! function_exists( 'structr_get_radio_image_options' ) ) :
	/**
	 * structr_get_radio_image_options function.
	 *
	 * @access public
	 * @return void
	 */
	function structr_get_radio_image_options() {
		$structr_column_options = array(
		'c1' => array(
			'value' 		=> 'c1',
		    'description' => esc_html__( 'FULL / NO SB', 'structr' ),
		    'label'   => STRUCTR_THEME_DIR_URI . '/inc/options/customizer/customizer-library/assets/img/c1.png',
		),
		'cs' => array(
			'value' 		=> 'cs',
		    'description' => esc_html__( 'MAIN / SB', 'structr' ),
		    'label'   => STRUCTR_THEME_DIR_URI . '/inc/options/customizer/customizer-library/assets/img/cs.png',
		),
		'sc' => array(
			'value' 		=> 'sc',
		    'description' => esc_html__( 'SB / MAIN', 'structr' ),
		    'label'   => STRUCTR_THEME_DIR_URI . '/inc/options/customizer/customizer-library/assets/img/sc.png',
		),
		'c2' => array(
			'value' 		=> 'c2',
		    'description' => esc_html__( 'SB\'s UNDER', 'structr' ),
		    'label'   => STRUCTR_THEME_DIR_URI . '/inc/options/customizer/customizer-library/assets/img/c2.png',
		),
		'c3' => array(
			'value' 		=> 'c3',
		    'description' => esc_html__( 'SB\'s ABOVE', 'structr' ),
		    'label'   => STRUCTR_THEME_DIR_URI . '/inc/options/customizer/customizer-library/assets/img/c3.png',
		),
		'css' => array(
			'value' 		=> 'css',
		    'description' => esc_html__( 'MAIN / SB / SB', 'structr' ),
		    'label'   => STRUCTR_THEME_DIR_URI . '/inc/options/customizer/customizer-library/assets/img/css.png',
		),
		'scs' => array(
			'value' 		=> 'scs',
		    'description' => esc_html__( 'SB / MAIN / SB', 'structr' ),
		    'label'   => STRUCTR_THEME_DIR_URI . '/inc/options/customizer/customizer-library/assets/img/scs.png',
		),
		'ssc' => array(
			'value' 		=> 'ssc',
		    'description' => esc_html__( 'SB / SB / MAIN', 'structr' ),
		    'label'   => STRUCTR_THEME_DIR_URI . '/inc/options/customizer/customizer-library/assets/img/ssc.png',
		),
		'csb' => array(
			'value' 		=> 'csb',
		    'description' => esc_html__( 'MAIN / SB / SB &#x2193;', 'structr' ),
		    'label'   => STRUCTR_THEME_DIR_URI . '/inc/options/customizer/customizer-library/assets/img/csb.png',
		),
			);
			return $structr_column_options;
	}
endif;

$structr_defaults = array(
	/**
	***************
	 ** Typography **
	 */
	/* Global */
	'type_global_main_size'        => 16,
);


if ( ! function_exists( 'structr_get_default' ) ) :
	/**
	 * structr_get_default function.
	 *
	 * @access public
	 * @param mixed $name
	 * @return void
	 */
	function structr_get_default( $name ) {
		global $structr_defaults;

		if ( array_key_exists( $name, $structr_defaults ) ) {
			return $structr_defaults[ $name ];
		}
		return '';
	}
endif;
