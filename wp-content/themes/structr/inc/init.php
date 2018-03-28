<?php
/** init.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * Structr constants, functions and definitions.
 *
 * @package Structr
 * @since Structr 1.0
 */

// Define Structr Framework Constants
define( 'STRUCTR_THEME_NAME', 'StructrPress Theme' );
define( 'STRUCTR_THEME_VERSION', '1.0.5' );
define( 'STRUCTR_THEME_AUTHOR', 'Thomas Soler' );
define( 'STRUCTR_THEME_URI', 'https://structrpress.com' );
define( 'STRUCTR_THEME_DIR', get_template_directory() );
define( 'STRUCTR_THEME_DIR_CHILD', get_stylesheet_directory() );
define( 'STRUCTR_THEME_DIR_URI', get_template_directory_uri() );
define( 'STRUCTR_THEME_STYLESHEET', get_stylesheet_uri() );
define( 'STRUCTR_THEME_BUILD', STRUCTR_THEME_DIR . '/inc/build' );
define( 'STRUCTR_THEME_OPTIONS', STRUCTR_THEME_DIR . '/inc/options' );
define( 'STRUCTR_THEME_OPTIONS_URI', STRUCTR_THEME_DIR_URI . '/inc/options' );
define( 'STRUCTR_THEME_FUNCTIONS', STRUCTR_THEME_DIR . '/inc/functions' );
define( 'STRUCTR_THEME_META_IMG', STRUCTR_THEME_OPTIONS . '/img' );

// Define Structr API Constants
define( 'STRUC_API_DIR', get_stylesheet_directory() . '/inc/options/structr-api/' );
define( 'STRUC_API_URL', get_template_directory_uri() . '/inc/options/structr-api/' );
define( 'STRUC_API_JS_URL', STRUC_API_URL . 'assets/js/' );
define( 'STRUC_API_CSS_URL', STRUC_API_URL . 'assets/css/' );
define( 'STRUC_API_IMG_URL', STRUC_API_URL . 'assets/img/' );

// Require the important API files
require_once( STRUC_API_DIR . 'api.php' );
require_once( STRUC_API_DIR . 'panels/main-page.php' );
require_once( STRUC_API_DIR . 'panels/addons.php' );
if ( function_exists( 'struc_hooks_setup' ) || function_exists( 'struc_blocks_setup' ) ) {
	require_once( STRUC_API_DIR . 'panels/licenses.php' );
}

// Require the framework/build files (structre)
require_once( STRUCTR_THEME_DIR . '/inc/framework.php' );
require_once( STRUCTR_THEME_BUILD . '/build-loops.php' );
require_once( STRUCTR_THEME_BUILD . '/build-header.php' );
require_once( STRUCTR_THEME_BUILD . '/build-columns.php' );
require_once( STRUCTR_THEME_BUILD . '/build-footer.php' );

// Require the fuction files for theme options
require_once( STRUCTR_THEME_OPTIONS . '/conditionals.php' );
require_once( STRUCTR_THEME_OPTIONS . '/metaboxes.php' );
require_once( STRUCTR_THEME_OPTIONS . '/customizer/customizer-library/customizer-library.php' );
require_once( STRUCTR_THEME_OPTIONS . '/customizer/customizer.php' );
require_once( STRUCTR_THEME_OPTIONS . '/customizer/panels/typography-panel.php' );
require_once( STRUCTR_THEME_OPTIONS . '/customizer/mods.php' );
require_once( STRUCTR_THEME_OPTIONS . '/customizer/styles.php' );
require_once( STRUCTR_THEME_OPTIONS . '/customizer/sections/class-structr-pro-section.php' );

function structr_require_pro_section() {
	// Load custom sections.
	require_once( STRUCTR_THEME_OPTIONS . '/customizer/sections/structr-pro-section/structr-pro-section.php' );
}

// Require the rest of the function files
require_once( STRUCTR_THEME_FUNCTIONS . '/menus.php' );
require_once( STRUCTR_THEME_FUNCTIONS . '/layouts.php' );
require_once( STRUCTR_THEME_FUNCTIONS . '/widgetize.php' );
require_once( STRUCTR_THEME_FUNCTIONS . '/byline.php' );
require_once( STRUCTR_THEME_FUNCTIONS . '/pagination.php' );
require_once( STRUCTR_THEME_FUNCTIONS . '/feat-images.php' );
require_once( STRUCTR_THEME_FUNCTIONS . '/content.php' );
require_once( STRUCTR_THEME_FUNCTIONS . '/class-atts.php' );
require_once( STRUCTR_THEME_FUNCTIONS . '/template-tags.php' );

// Sets up defaults + adds support for various WordPress features
if ( ! function_exists( 'structr_theme_setup' ) ) {

	function structr_theme_setup() {
		global $content_width;

		// Sets width for things like video embeds. WP still requires.
		if ( ! isset( $content_width ) ) {
			$content_width = 675;
		}

		// Add Feed Links
		add_theme_support( 'automatic-feed-links' );

		// Enable Thumbnails/Featured Images
		add_theme_support( 'post-thumbnails' );

		// Creates nice titles for SEO
		add_theme_support( 'title-tag' );

		// Add Support for Custom Header
		$head_text = array();
		$head_text['header-text'] = false;
		add_theme_support( 'custom-header', $head_text );

		// Load Textdomain
		load_theme_textdomain( 'structr', STRUCTR_THEME_DIR . '/lang' );

		// Register WordPress menus
		add_action( 'init', 'structr_register_menus' );

		// Enqueue frontend scripts/styles
		add_action( 'wp_enqueue_scripts', 'structr_frontend_scripts' );

		// Enqueue backend scripts/styles
		add_action( 'admin_enqueue_scripts', 'structr_backend_scripts' );

		// Enqueue theme customizer scripts/styles
		add_action( 'customize_controls_enqueue_scripts', 'structr_customizer_styles_scripts' );

		// Remove Emojis from Admin area
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );

		// Add Text-Editor Styling Support
		add_editor_style( '/css/editor-style.css' );

		// Add Support for HTML5 in these fields
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

		// Add Custom Background Support
		add_theme_support( 'custom-background',
			apply_filters( 'structr_custom_bg',
				array(
					'default-image' => STRUCTR_THEME_DIR_URI . '/img/noise.png',
					'default-color' => 'f2f2f2',
					'default-repeat' => 'repeat',
					'default-position-x' => 'left',
					'default-attachment' => 'fixed',
				)
			)
		);
	}
}
add_action( 'after_setup_theme', 'structr_theme_setup' );

// Navigation Menus Function
function structr_register_menus() {
	// Nav Menus
	register_nav_menus(
		array(
		'primary' => esc_html__( 'Primary Menu', 'structr' ),
		'top' => esc_html__( 'Top Menu', 'structr' ),
		)
	);
}

// Frontend Scripts Function
function structr_frontend_scripts() {

	// Default stylesheet
	wp_enqueue_style( 'structr-style', STRUCTR_THEME_DIR_URI . '/style.css' );

	// Fontawesome styles
	wp_enqueue_style( 'fontawesome', STRUCTR_THEME_DIR_URI . '/css/fonts/font-awesome/css/font-awesome.min.css' );

	// Ionicons styles
	wp_enqueue_style( 'ionicons', STRUCTR_THEME_DIR_URI . '/css/fonts/ionicons/css/ionicons.min.css' );

	// Structr Social Icons
	wp_enqueue_style( 'structr-socials', STRUCTR_THEME_DIR_URI . '/css/fonts/struc-socials/css/struc-socials.css' );

	// Navigation drop-down script
	wp_enqueue_script( 'structr-navigation', STRUCTR_THEME_DIR_URI . '/js/navigation.js', array(), STRUCTR_THEME_VERSION, true );

	// Correct tab order keyboard script
	wp_enqueue_script( 'structr-skip-link-focus-fix', STRUCTR_THEME_DIR_URI . '/js/skip-link-focus-fix.js', array(), STRUCTR_THEME_VERSION, true );

	/* Load the comment reply JavaScript. */
	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

// Determines if we are on edit page or not
function structr_is_edit_page( $new_edit = null ) {
	global $pagenow;
	// make sure we are on the backend
	if ( ! is_admin() ) { return false;
	}

	if ( 'edit' == $new_edit ) {
		return in_array( $pagenow, array( 'post.php' ) );
	} elseif ( 'new' == $new_edit ) { // check for new post page
		return in_array( $pagenow, array( 'post-new.php' ) );
	} else { // check for either new or edit
		return in_array( $pagenow, array( 'post.php', 'post-new.php', 'themes.php' ) );
	}
}

// Backend Scripts Function
function structr_backend_scripts() {
	$current_screen = get_current_screen();
	// Metabox stylesheet
	if ( structr_is_edit_page() ) {
		wp_enqueue_style( 'strucr-meta-admin-css', STRUCTR_THEME_DIR_URI . '/css/admin.css' );
	}
}

// Customizer Scripts Function
function structr_customizer_styles_scripts() {

	wp_enqueue_script( 'structr-customize-controls-script', STRUCTR_THEME_OPTIONS_URI . '/customizer/customizer-library/assets/js/customize-controls.js', array( 'jquery' ), STRUCTR_THEME_VERSION );

	wp_enqueue_style( 'structr-customizer-meta', STRUCTR_THEME_OPTIONS_URI . '/customizer/customizer-library/assets/css/customizer-meta.css' );

	wp_enqueue_script( 'structr-chosen', STRUCTR_THEME_OPTIONS_URI . '/customizer/customizer-library/assets/chosen/chosen.jquery.js', array( 'jquery' ), STRUCTR_THEME_VERSION );

	wp_enqueue_style( 'structr-chosen', STRUCTR_THEME_OPTIONS_URI . '/customizer/customizer-library/assets/chosen/chosen.css' );

}
