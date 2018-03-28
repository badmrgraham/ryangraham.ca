<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

if ( ! function_exists( 'structr_generate_font_control' ) ) :
	/**
	 * Adds all the required Font Controls (Family, variant, size etc) to the WP_Customize object
	 */
	function structr_generate_font_control( $wp_customize, $section_id, $group_label, $group_desc, $group_id, $use_section_id = false, $exclude = array() ) {

		$font_setting_id = ( ! $use_section_id ) ? $section_id . '_' . $group_id : $section_id;

		$structr_setting_id = $font_setting_id . '_family';

		$wp_customize->add_setting( $structr_setting_id, array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'customizer_library_sanitize_text',
		) );
		$wp_customize->add_control(
			new Structr_Customize_Headings(
				$wp_customize,
				$font_setting_id,
				array(
					'section' => $section_id,
					'type'    => 'subsec-head',
					'label'   => $group_label,
					'settings' => $structr_setting_id,
					'description' => $group_desc,
				)
			)
		);

		if ( ! in_array( 'family', $exclude ) ) :

			$font_choices = customizer_library_get_font_choices();

			$structr_setting_id = $font_setting_id . '_family';

			// site title font setting
			$wp_customize->add_setting( $structr_setting_id, array(
				'default' => 'serif',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'structr_sanitize_font_choices',
			) );
			$wp_customize->add_control( new Structr_Control_Advanced_Dropdown( $wp_customize, $structr_setting_id, array(
				'label' => __( 'Font Family', 'structr' ),
				'section' => $section_id,
				'settings' => $structr_setting_id,
				'choices' => $font_choices,
			) ) );

		endif;

		if ( ! in_array( 'size', $exclude ) ) :

			$structr_setting_id = $font_setting_id . '_size';

			$wp_customize->add_setting( $structr_setting_id, array(
				'default' => structr_get_default( $structr_setting_id ),
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'customizer_library_sanitize_range',
			) );
			$wp_customize->add_control( new Structr_Customizer_Range_Slider( $wp_customize, $structr_setting_id, array(
				'label' => __( 'Font Size (px)', 'structr' ),
				'section' => $section_id,
				'settings' => $structr_setting_id,
				'input_attrs' => array(
			        'min'   => 6,
			        'max'   => 60,
			        'step'  => 1,

				),
			) ) );

		endif;

		if ( ! in_array( 'style', $exclude ) ) :

			$choices = structr_get_font_styles();

			$structr_setting_id = $font_setting_id . '_style';

			$wp_customize->add_setting( $structr_setting_id, array(
				'default' => 'normal',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'structr_sanitize_font_style',
			) );

			$wp_customize->add_control( new Structr_Text_Style_Custom_Control( $wp_customize, $structr_setting_id, array(
				'label' => __( 'Font Style', 'structr' ),
				'section' => $section_id,
				'settings' => $structr_setting_id,
				'choices' => $choices,
			) ) );

		endif;

		if ( ! in_array( 'weight', $exclude ) ) :

			$choices = structr_get_font_weights();
			$structr_setting_id = $font_setting_id . '_weight';

			$wp_customize->add_setting( $structr_setting_id, array(
				'default' => '400',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'structr_sanitize_font_weight',
			) );

			$wp_customize->add_control( new Structr_Text_Weight_Custom_Control( $wp_customize, $structr_setting_id, array(
				'label' => __( 'Font Weight', 'structr' ),
				'section' => $section_id,
				'settings' => $structr_setting_id,
				'choices' => $choices,
			) ) );

		endif;

		if ( ! in_array( 'transform', $exclude ) ) :

			$choices = structr_get_font_transform();
			$structr_setting_id = $font_setting_id . '_transform';

			$wp_customize->add_setting( $structr_setting_id, array(
				'default' => 'none',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'structr_sanitize_font_transform',
			) );

			$wp_customize->add_control( new Structr_Text_Transform_Custom_Control( $wp_customize, $structr_setting_id, array(
				'label' => __( 'Text Transform', 'structr' ),
				'section' => $section_id,
				'settings' => $structr_setting_id,
				'choices' => $choices,
			) ) );

		endif;

		if ( ! in_array( 'spacing', $exclude ) ) :

			$choices = structr_get_font_spacing();
			$structr_setting_id = $font_setting_id . '_spacing';

			$wp_customize->add_setting( $structr_setting_id, array(
				'default' => 'normal',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'structr_sanitize_font_spacing',
			) );

			$wp_customize->add_control( new Structr_Text_Spacing_Custom_Control( $wp_customize, $structr_setting_id, array(
				'label' => __( 'Letter Spacing', 'structr' ),
				'section' => $section_id,
				'settings' => $structr_setting_id,
				'choices' => $choices,
			) ) );

		endif;
	}
endif;
