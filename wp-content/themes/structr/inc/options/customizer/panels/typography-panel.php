<?php
/** main-page.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This file builds the theme customizer panel, sections and options
 * specifically for dealing with theme typography and Google fonts.
 *
 * @package Structr
 * @since Structr 1.0
 */


class Structr_Customize_Typography {

	/**
	 * register function.
	 *
	 * @access public
	 * @static
	 * @param mixed $wp_customize
	 * @return void
	 */
	public static function register( $wp_customize ) {

		$panel_id = 'typography';

		$wp_customize->add_panel( $panel_id, array(
			'priority'       => 40,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => 'Typography',
			'description'    => '',
		) );

		// ====================================== #
		// ==== GLOBAL FONT SETTINGS SECTION ==== #
		// ====================================== #
		$section_id = 'type_global';

		$wp_customize->add_section( $section_id,
			array(
				'title'      => __( 'Global Typography', 'structr' ),
				'priority'   => 10,
				'capability' => 'edit_theme_options',
				'panel'      => $panel_id,
			)
		);

		// font subset toggle heading setting
		$wp_customize->add_setting( 'structr_global_font_subset_head', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'customizer_library_sanitize_text',
		) );
		// font subset toggle heading control
		$wp_customize->add_control( new Structr_Customize_Subsection( $wp_customize, 'structr_global_font_subset_head', array(
			'label' => __( 'Include Google Font Subsets', 'structr' ),
			'description' => __( 'Checking the box below will toggle options for including Google font subsets to your typography.', 'structr' ),
			'section' => $section_id,
			'type'    => 'subsec-head',
			'settings' => 'structr_global_font_subset_head',
			'priority' => 10,

		) ) );
		// font subset toggle check setting
		$wp_customize->add_setting( 'structr_global_font_subset_check', array(
			'default' => 0,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'customizer_library_sanitize_checkbox',
		) );
		// font subset toggle check control
		$wp_customize->add_control( 'structr_global_font_subset_check', array(
	   		'description' => __( '<span class="cust-l-arr"><span class="dashicons dashicons-arrow-left-alt"></span></span> Check to Toggle Subset Options', 'structr' ),
			'section' => $section_id,
			'settings' => 'structr_global_font_subset_check',
			'type'    => 'checkbox',
			'priority' => 10,

		) );
	 	// font subsets setting
	 	$choices = customizer_library_get_google_font_subsets();
		$wp_customize->add_setting( 'global_font_subset', array(
			'default' => 'latin',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_multi_checkbox',
		) );

		// font subsets line break
		$wp_customize->add_setting( 'subset_hr', array(
			'default' => '',
			'sanitize_callback' => 'customizer_library_sanitize_text',
		) );
		// font subsets line break control
		$wp_customize->add_control( new Structr_Customize_Subsection( $wp_customize, 'subset_hr', array(
			'section' => $section_id,
			'type'    => 'line',
			'settings' => 'subset_hr',
			'priority' => 10,

		) ) );

		// font subsets control
		$wp_customize->add_control( new Structr_Customize_Control_Multicheck( $wp_customize, 'global_font_subset', array(
	   		'label' => null,
			'section' => $section_id,
			'settings' => 'global_font_subset',
			'priority' => 10,
			'choices' => $choices,

		) ) );

		/* Overall Font Family Control */
		structr_generate_font_control( $wp_customize, $section_id, __( 'Base/Main Conent Font Settings', 'structr' ), __( ' The settings below customize font family, font size and font styling within your post/page content areas and comment sections after your articles.', 'structr' ), 'main', false, $exclude = array() );

		// =============================================== #
		// ==== HEADINGS/TITLES FONT SETTINGS SECTION ==== #
		// =============================================== #
		/*
		$section_id = 'type_heading';

		$wp_customize->add_section( $section_id,
			array(
				'title'      => __( 'Titles + Heading Styles', 'structr' ),
				'priority'   => 20,
				'capability' => 'edit_theme_options',
				'panel'      => $panel_id
			)
		);

		// Post/Page Titles

		// headings / titles heading setting
		$wp_customize->add_setting( 'structr_headings_titles_head', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'customizer_library_sanitize_text'
		) );
		// headings / titles control
		$wp_customize->add_control( new Structr_Customize_Subsection( $wp_customize, 'structr_headings_titles_head', array(
			'label' => __( 'Headings & Titles Font Family', 'structr' ),
			'description' => __( 'Select the font family you would like to use for your headings (h1-h6) and for your post/page titles.', 'structr' ),
			'section' => $section_id,
			'type'    => 'subsection',
			'settings' => 'structr_headings_titles_head',
            'priority' => 10

		) ) );

		// upgrade premium setting
		$wp_customize->add_setting( 'structr_headings_upgrade', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'customizer_library_sanitize_text'
		) );
		// upgrade premium control
		$wp_customize->add_control( new Structr_Customize_Upgrades( $wp_customize, 'structr_headings_upgrade', array(
			'label'		=> __( 'Headings Type Settings', 'structr' ),
			'url' => 'https://structrpress.com/downloads/structr-framework/',
			'description' => sprintf(
				__( 'Want to Customize More Typography?<br /> %s.', 'structr' ),
				sprintf(
					'<a href="%1$s" target="_blank">%2$s</a>',
					esc_url( 'https://structrpress.com/downloads/structr-framework/' ),
					__( 'Upgrade to the full version of Structr', 'structr' )
				)
			),
			'section' => $section_id,
			'type'    => 'upgrade',
			'settings' => 'structr_headings_upgrade',
            'priority' => 20

		) ) );


		# ============================================ #
		# ==== SITE TITLE, TAGLINE & MENU SECTION ==== #
		# ============================================ #

		$section_id = 'type_header';

		$wp_customize->add_section( $section_id,
			array(
				'title'      => __( 'Header + Menu Styles', 'structr' ),
				'priority'   => 30,
				'capability' => 'edit_theme_options',
				'panel'      => $panel_id
			)
		);

		// Menu Items Family

		// menus type heading setting
		$wp_customize->add_setting( 'structr_menus_type_head', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'customizer_library_sanitize_text'
		) );
		// menus type heading control
		$wp_customize->add_control( new Structr_Customize_Subsection( $wp_customize, 'structr_menus_type_head', array(
			'label' => __( 'Menu Link Items Font Family', 'structr' ),
			'description' => __( 'Select the font family you would like to use font family for text/links in your menus.', 'structr' ),
			'section' => $section_id,
			'type'    => 'subsection',
			'settings' => 'structr_menus_type_head',
            'priority' => 10

		) ) );

		// upgrade premium setting
		$wp_customize->add_setting( 'structr_menus_type_upgrade', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'customizer_library_sanitize_text'
		) );
		// upgrade premium control
		$wp_customize->add_control( new Structr_Customize_Upgrades( $wp_customize, 'structr_menus_type_upgrade', array(
			'label'		=> __( 'Menus Type Settings', 'structr' ),
			'url' => 'https://structrpress.com/downloads/structr-framework/',
			'description' => sprintf(
				__( 'Want to Customize More Typography?<br /> %s.', 'structr' ),
				sprintf(
					'<a href="%1$s" target="_blank">%2$s</a>',
					esc_url( 'https://structrpress.com/downloads/structr-framework/' ),
					__( 'Upgrade to the full version of Structr', 'structr' )
				)
			),
			'section' => $section_id,
			'type'    => 'upgrade',
			'settings' => 'structr_menus_type_upgrade',
            'priority' => 20

		) ) );

		# =================================== #
		# ==== WIDGET AND FOOTER SECTION ==== #
		# =================================== #

		$section_id = 'type_widgetfoot';

		$wp_customize->add_section( $section_id,
			array(
				'title'      => __( 'Widget + Footer Styles', 'structr' ),
				'priority'   => 40,
				'capability' => 'edit_theme_options',
				'panel'      => $panel_id
			)
		);

		// Widget Title Styles

		// widgetfoot type heading setting
		$wp_customize->add_setting( 'structr_widgetfoot_type_head', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'customizer_library_sanitize_text'
		) );
		// widgetfoot type heading control
		$wp_customize->add_control( new Structr_Customize_Subsection( $wp_customize, 'structr_widgetfoot_type_head', array(
			'label' => __( 'Widget Area Title Font Styles', 'structr' ),
			'description' => __( 'Customize your widget area titles using the different typography settings provided below.', 'structr' ),
			'section' => $section_id,
			'type'    => 'subsection',
			'settings' => 'structr_widgetfoot_type_head',
            'priority' => 10

		) ) );

		// upgrade premium setting
		$wp_customize->add_setting( 'structr_widgetfoot_type_upgrade', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'customizer_library_sanitize_text'
		) );
		// upgrade premium control
		$wp_customize->add_control( new Structr_Customize_Upgrades( $wp_customize, 'structr_widgetfoot_type_upgrade', array(
			'label'		=> __( 'Widgets/Footer Type Settings', 'structr' ),
			'url' => 'https://structrpress.com/downloads/structr-framework/',
			'description' => sprintf(
				__( 'Want to Customize More Typography?<br /> %s.', 'structr' ),
				sprintf(
					'<a href="%1$s" target="_blank">%2$s</a>',
					esc_url( 'https://structrpress.com/downloads/structr-framework/' ),
					__( 'Upgrade to the full version of Structr', 'structr' )
				)
			),
			'section' => $section_id,
			'type'    => 'upgrade',
			'settings' => 'structr_widgetfoot_type_upgrade',
            'priority' => 20

		) ) );

		*/

	}
}

/**
 * my_customizer_script function.
 *
 * @access public
 * @return void
 */
function my_customizer_script() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
		
			/* Hiding/showing top bar style dropdown */
			var global_font_subset = $( '#customize-control-global_font_subset' );
			var subset_hr = $( '#customize-control-subset_hr' );
		
			/* on page load, hide or show adv. option */
			if( $( '#customize-control-structr_global_font_subset_check input' ).prop( "checked" ) ){
				global_font_subset.show();
				subset_hr.show();
			}
			else{
				global_font_subset.hide();
				subset_hr.hide();
			}
		
			/* on change, hide or show adv. option */
			$( '#customize-control-structr_global_font_subset_check input' ).change(function(){
				if( $(this).prop("checked") ) {
					global_font_subset.show();
					subset_hr.show();
				} else {
					global_font_subset.hide();
					subset_hr.hide();
				}
			});
		});
	</script>
<?php
}
add_action( 'customize_controls_print_footer_scripts', 'my_customizer_script' );
