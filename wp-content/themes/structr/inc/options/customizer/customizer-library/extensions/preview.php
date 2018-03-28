<?php

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function customizer_library_customize_preview_js() {

	wp_enqueue_script( 'customizer_library_customizer', STRUCTR_THEME_OPTIONS_URI . '/customizer/customizer-library/assets/js/customizer.js', array( 'customize-preview' ), '', true );

}
add_action( 'customize_preview_init', 'customizer_library_customize_preview_js' );


function customizer_library_customize_register( $wp_customize ) {

	$wp_customize->get_control( 'show_on_front' )->section = 'site_structure_section';
	$wp_customize->get_control( 'show_on_front' )->label = null;
	$wp_customize->get_control( 'show_on_front' )->priority = 20;
	$wp_customize->get_control( 'show_on_front' )->type = 'radio';
	$wp_customize->get_control( 'show_on_front' )->choices = array( 'posts' => __( 'Display Latest Posts on Front Page', 'structr' ), 'page' => __( 'Display A Static Page on Front Page', 'structr' ) );
	$wp_customize->get_setting( 'show_on_front' )->capability = 'manage_options';
	$wp_customize->get_setting( 'show_on_front' )->type = 'option';

	$wp_customize->get_control( 'page_on_front' )->section = 'site_structure_section';
	$wp_customize->get_control( 'page_on_front' )->label = __( 'Front page', 'structr' );
	$wp_customize->get_control( 'page_on_front' )->type = 'dropdown-pages';
	$wp_customize->get_control( 'page_on_front' )->priority = 30;
	$wp_customize->get_setting( 'page_on_front' )->capability = 'manage_options';
	$wp_customize->get_setting( 'page_on_front' )->type = 'option';

	$wp_customize->get_control( 'page_for_posts' )->section = 'site_structure_section';
	$wp_customize->get_control( 'page_for_posts' )->label = __( 'Posts page', 'structr' );
	$wp_customize->get_control( 'page_for_posts' )->type = 'dropdown-pages';
	$wp_customize->get_control( 'page_for_posts' )->priority = 40;
	$wp_customize->get_setting( 'page_for_posts' )->capability = 'manage_options';
	$wp_customize->get_setting( 'page_for_posts' )->type = 'option';

	$wp_customize->get_control( 'blogname' )->priority = 20;
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

	$wp_customize->get_control( 'blogdescription' )->priority = 40;
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->remove_section( 'header_image' );

	$wp_customize->get_control( 'background_color' )->priority = 20;
	$wp_customize->get_control( 'background_color' )->label = __( 'Background Color', 'structr' );
	$wp_customize->get_control( 'background_color' )->description = __( 'Used for entire site background', 'structr' );

	$wp_customize->remove_section( 'background_image' );
	$wp_customize->get_control( 'background_image' )->section = 'title_tagline';
	$wp_customize->get_control( 'background_image' )->label = null;
	$wp_customize->get_control( 'background_image' )->priority = 110;

	$wp_customize->get_control( 'background_repeat' )->section = 'title_tagline';
	$wp_customize->get_control( 'background_repeat' )->label = __( 'Site Background Repeat', 'structr' );
	$wp_customize->get_control( 'background_repeat' )->priority = 115;

	$wp_customize->get_control( 'background_attachment' )->section = 'title_tagline';
	$wp_customize->get_control( 'background_attachment' )->label = __( 'Site Background Attachment', 'structr' );
	$wp_customize->get_control( 'background_attachment' )->priority = 130;

}
add_action( 'customize_register', 'customizer_library_customize_register' );
