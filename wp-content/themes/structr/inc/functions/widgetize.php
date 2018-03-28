<?php
/** File: widgetize.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This registers the different widget areas throughout the theme.
 *
 * @package Structr
 * @since Structr 1.0
 */

/**
 * Function: structr_widgets_init function.
 *
 * @access public
 * @return void
 */
function structr_widgets_init() {

	// PRIMARY SIDEBAR.
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'structr' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'The primary sidebar will be added to each layout with 2+ columns.', 'structr' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	// FOOTER SIDEBAR ONE.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'structr' ),
		'id'            => 'struc-foot-col-1',
		'description'   => __( 'This is an optional Footer Column Number 1. You can use up to four columns.', 'structr' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	// FOOTER SIDEBAR TWO.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'structr' ),
		'id'            => 'struc-foot-col-2',
		'description'   => __( 'This is an optional Footer Column Number 2. You can use up to four columns.', 'structr' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	// FOOTER SIDEBAR THREE.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'structr' ),
		'id'            => 'struc-foot-col-3',
		'description'   => __( 'This is an optional Footer Column Number 3. You can use up to four columns.', 'structr' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	// FOOTER SIDEBAR FOUR.
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'structr' ),
		'id'            => 'struc-foot-col-4',
		'description'   => __( 'This is an optional Footer Column Number 4. You can use up to four columns.', 'structr' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'structr_widgets_init' );


// Default fallback widget for an empty sidebar location.
if ( ! function_exists( 'structr_default_widget' ) ) {
	/**
	 * Function: structr_default_widget function.
	 *
	 * @access public
	 * @return void
	 */
	function structr_default_widget() {

		// Only show when activated in Customizer.
		if ( structr_default_widget_on() ) { ?>
			<aside class="widget default-widget">
				<h5 class="widget-title">
					<?php esc_html_e( 'Default Widget', 'structr' ); ?>
				</h5>
				<p><?php printf( wp_kses_post( 'This is a <strong>placeholder widget</strong>. It\'s displayed because you have a widgetized area activated but it\'s empty. You can add widgets to this area on the %s of your WordPress admin area.', 'structr' ), '<a href="' . esc_url( admin_url( '/widgets.php' ) ) . '">' . wp_kses_post( 'widgets page', 'structr' ) . '</a>' ); ?></p>
			</aside>
			<?php
		}
	}
}


/**
 * Function: struc_foot_col_class function.
 *
 * @access public
 * @param mixed $structr_classes footer column class.
 * @return $structr_classes
 */
function struc_foot_col_class( $structr_classes ) {

	$structr_cols = 0;
	$footer_widgets = array(
		'struc-foot-col-1',
		'struc-foot-col-2',
		'struc-foot-col-3',
		'struc-foot-col-4',
	);
	foreach ( $footer_widgets as $widget ) {
		if ( is_active_sidebar( $widget ) ) {
			$structr_cols = $structr_cols + 1;
		}
	}

	switch ( $structr_cols ) {
		case 0 :
			$structr_classes = 'no-foot-cols';
			break;
		case 1 :
			$structr_classes = 'one-col-foot';
			break;
		case 2 :
			$structr_classes = 'two-col-foot';
			break;
		case 3 :
			$structr_classes = 'three-col-foot';
			break;
		case 4 :
			$structr_classes = 'four-col-foot';
			break;
	}
	return $structr_classes;
}
add_filter( 'foot_col_class', 'struc_foot_col_class' );
