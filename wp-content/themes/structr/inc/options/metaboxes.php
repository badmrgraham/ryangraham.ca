<?php
/** metaboxes.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This file builds the metaboxes that are displayed on the post
 * and page editor screens. Layouts, featured images, show/hide
 * content and custom sidebar metaboxes are all built here.
 *
 * @package Structr
 * @since Structr 1.0
 */


/**
 * structr_add_layout_meta_box function.
 *
 * @access public
 * @return void
 */
function structr_add_layout_meta_box() {

	$allowed = apply_filters( 'structr_metabox_capability', 'activate_plugins' );

	if ( ! current_user_can( $allowed ) ) {
		return;
	}

	$post_types = array( 'post', 'page' );
	foreach ( $post_types as $type ) {
		add_meta_box(
			'structr_layout_meta_box', // $id
			__( 'Custom Layout Setting','structr' ), // $title
			'structr_show_layout_meta_box', // $callback
			$type, // $page
			'normal', // $context
			'high' // $priority
		);
	}
}
add_action( 'add_meta_boxes', 'structr_add_layout_meta_box' );

/**
 * structr_add_content_meta_box function.
 *
 * @access public
 * @return void
 */
function structr_add_content_meta_box() {

	$allowed = apply_filters( 'structr_metabox_capability', 'activate_plugins' );

	if ( ! current_user_can( $allowed ) ) {
		return;
	}

	$post_types = array( 'post', 'page' );
	foreach ( $post_types as $type ) {
		add_meta_box(
			'structr_content_meta_box', // $id
			__( 'Create/Remove Elements','structr' ), // $title
			'structr_show_content_meta_box', // $callback
			$type, // $page
			'side', // $context
			'high' // $priority
		);
	}
}
add_action( 'add_meta_boxes', 'structr_add_content_meta_box' );

/**
 * structr_show_layout_meta_box function.
 *
 * @access public
 * @param mixed $post
 * @return void
 */
function structr_show_layout_meta_box( $post ) {
	global $post, $current_screen, $structr_column_options;
		$structr_column_options = structr_get_radio_image_options();
	    $stored_meta = get_post_meta( $post->ID );
		$the_id = get_post_custom( $post->ID );
		$custom_body_class = isset( $the_id['_custom-body-class'] ) ? esc_attr( $the_id['_custom-body-class'][0] ) : '';
		$custom_post_class = isset( $the_id['_custom-post-class'] ) ? esc_attr( $the_id['_custom-post-class'][0] ) : '';
	if ( isset( $stored_meta['_singular-column'][0] ) ) :
		$stored_meta['_singular-column'][0] = $stored_meta['_singular-column'][0];
		else :
			$stored_meta['_singular-column'][0] = '';
		endif;
		if ( isset( $stored_meta['_singular-column'][0] ) && '' == $stored_meta['_singular-column'][0] ) :
			$checked = 'checked="checked"';
		else :
			$checked = '';
		endif;
		wp_nonce_field( 'structr_meta_box_nonce', 'meta_box_nonce' );
	    ?>
	
	<fieldset class="structr_layouts">
		<legend class="screen-reader-text">Custom Layout Settings</legend>
			<p class="default-layout-meta" style="font-weight: bold;"><input type="radio" name="_singular-column" id="meta-structr-layout-global" class="meta-structr-layout-global" value="default" checked="checked"> <label class="layout-global-meta" for="meta-structr-layout-global"><?php printf( __( 'USE DEFAULT COLUMN LAYOUT &#x2192; Setup in <span style="font-style: italic;">"Structr Design Options"</span> of the <a href="%s">Theme Customizer</a>', 'structr' ), admin_url( 'customize.php' ) ); ?></label></p>
			<label class="box" for="c1_singular-column" title="">
				<input class="ui-helper-hidden-accessible" type="radio" name="_singular-column" id="c1_singular-column" value="c1" <?php checked( $stored_meta['_singular-column'][0], 'c1' ); ?>>
				<img src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/c1.png" alt="c1" />
				<span class="meta-label">FULL / NO SB</span>
			</label>
			<label class="box" for="cs_singular-column" title="">
				<input class="ui-helper-hidden-accessible" type="radio" name="_singular-column" id="cs_singular-column" value="cs" <?php checked( $stored_meta['_singular-column'][0], 'cs' ); ?>>
				<img src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/cs.png" alt="cs" />
				<span class="meta-label">MAIN / SB</span>
			</label>
			<label class="box" for="sc_singular-column" title="">
				<input class="ui-helper-hidden-accessible" type="radio" name="_singular-column" id="sc_singular-column" value="sc" <?php checked( $stored_meta['_singular-column'][0], 'sc' ); ?>>
				<img src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/sc.png" alt="sc" />
				<span class="meta-label">SB / MAIN</span>
			</label>
			<label class="box disabled-label" for="c2_singular-column" title="">
				<input class="ui-helper-hidden-accessible disabled" disabled="disabled" type="radio" name="_singular-column" id="c2_singular-column" value="c2">
				<img class="button-img disabled-meta" src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/c2.png" alt="c2" />
				<span class="premium-disabled-meta">PREMIUM</span>
				<span class="meta-label">SB's UNDER</span>
			</label>
			<label class="box disabled-label" for="c3_singular-column" title="">
				<input class="ui-helper-hidden-accessible disabled" disabled="disabled" type="radio" name="_singular-column" id="c3_singular-column" value="c3">
				<img class="button-img disabled-meta" src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/c3.png" alt="c3" />
				<span class="premium-disabled-meta">PREMIUM</span>
				<span class="meta-label">SB's ABOVE</span>
			</label>
			<label class="box disabled-label" for="css_singular-column" title="">
				<input class="ui-helper-hidden-accessible disabled" disabled="disabled" type="radio" name="_singular-column" id="css_singular-column" value="css">
				<img class="button-img disabled-meta" src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/css.png" alt="css" />
				<span class="premium-disabled-meta">PREMIUM</span>
				<span class="meta-label">MAIN / SB / SB</span>
			</label>
			<label class="box disabled-label" for="scs_singular-column" title="">
				<input class="ui-helper-hidden-accessible disabled" disabled="disabled" type="radio" name="_singular-column" id="scs_singular-column" value="scs">
				<img class="button-img disabled-meta" src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/scs.png" alt="scs" />
				<span class="premium-disabled-meta">PREMIUM</span>
				<span class="meta-label">SB / MAIN / SB</span>
			</label>
			<label class="box disabled-label" for="ssc_singular-column" title="">
				<input class="ui-helper-hidden-accessible disabled" disabled="disabled" type="radio" name="_singular-column" id="ssc_singular-column" value="ssc">
				<img class="button-img disabled-meta" src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/ssc.png" alt="ssc" />
				<span class="premium-disabled-meta">PREMIUM</span>
				<span class="meta-label">SB / SB / MAIN</span>
			</label>
			<label class="box disabled-label" for="csb_singular-column" title="">
				<input class="ui-helper-hidden-accessible disabled" disabled="disabled" type="radio" name="_singular-column" id="csb_singular-column" value="csb">
				<img class="button-img disabled-meta" src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/csb.png" alt="csb" />
				<span class="premium-disabled-meta">PREMIUM</span>
				<span class="meta-label">MAIN / SB / SB &#x2193;</span>
			</label>
	</fieldset>
	<br class="clear">
	<hr class="upgrade-hr-meta">

	<div class="body-class-meta">	
		<p><label for="_custom-body-class"><strong><?php _e( 'ADD CUSTOM BODY CLASS &#x2192;', 'structr' ); ?></strong></label></p>
		<p class="body-class-input-meta"><input id="_custom-body-class" class="custom-class" name="_custom-body-class" value="<?php echo $custom_body_class; ?>" size="95" type="text" placeholder="<?php _e( ' Add custom classes for <body>, NO PERIODS! Single space between each class', 'structr' ); ?>" /></p>
		
		<p><label for="_custom-post-class"><strong><?php _e( 'ADD CUSTOM POST CLASS &#x2192;', 'structr' ); ?></strong></label></p>
		<p class="post-class-input-meta"><input id="_custom-post-class" class="custom-class" name="_custom-post-class" value="<?php echo $custom_post_class; ?>" size="95" type="text" placeholder="<?php _e( ' Add custom classes for <article>, NO PERIODS! Single space between each class', 'structr' ); ?>" /></p>
	</div>
<?php
}

/**
 * structr_show_content_meta_box function.
 *
 * @access public
 * @param mixed $post
 * @return void
 */
function structr_show_content_meta_box( $post ) {
	global $post, $current_screen;
		$the_id = get_post_custom( $post->ID );
		$show_top_menu = isset( $the_id['_singular-top-menu'] ) ? $the_id['_singular-top-menu'][0] : 0;
		$show_main_menu = isset( $the_id['_singular-main-menu'] ) ? $the_id['_singular-main-menu'][0] : 0;
		$show_title = isset( $the_id['_singular-title'] ) ? $the_id['_singular-title'][0] : 0;
		$show_header = null;
		$show_footer_widgets = null;
		$show_footer = null;
		$create_sidebar_1 = isset( $the_id['_create-sidebar-1'] ) ? $the_id['_create-sidebar-1'][0] : 0;
		$create_sidebar_2 = null;
		$new_sidebars = array(
			'Sidebar 1'  => array(
				'name'   => '_create-sidebar-1',
				'label'  => __( 'Create <strong>Primary Sidebar</strong>', 'structr' ),
				'state'  => $create_sidebar_1,
			),
			'Sidebar 2'  => array(
				'name'   => '_create-sidebar-2',
				'label'  => __( 'Create <strong>Secondary Sidebar</strong>', 'structr' ),
				'state'  => $create_sidebar_2,
			),
		);
		wp_nonce_field( 'structr_meta_box_nonce', 'meta_box_nonce' );
	    ?>

	<div class="body-class-meta">
		<p><label><strong><?php _e( 'CREATE CUSTOM SIDEBARS &#x2192;', 'structr' ); ?></strong></label></p>
			<p class="input-group content-meta">
				<input id="_create-sidebar-1" class="create-sidebar" name="_create-sidebar-1" value="<?php echo $create_sidebar_1; ?>" type="checkbox" <?php checked( '1', $create_sidebar_1, '1' ); ?>>
				<label for="_create-sidebar-1">Create <strong>Primary Sidebar</strong> </label>
			</p>
<!--
			<p class="input-group content-meta">
				<input disabled="disabled" id="_create-sidebar-2" class="create-sidebar" name="_create-sidebar-2" value="<?php echo $create_sidebar_2; ?>" type="checkbox" <?php checked( '1', $create_sidebar_2, '1' ); ?>>
				<label class="disabled-check" for="_create-sidebar-2">Create <strong>Secondary Sidebar</strong> </label>
			</p>
-->
		<span class="content-meta-txt" style="text-align: justify; display: block; color: #A6A6A6; font-style: italic; margin-bottom: 1em;">
		<?php echo '<p style="font-size: 11px;">' . sprintf( __( 'Checking the box above will create a new <strong>Primary</strong> sidebar for this post/page. After saving, visit your <a href="%s" target="_blank">widgets page</a> & add widgets to the new sidebar. If custom sidebars are left empty, the default sidebars will be used.', 'structr' ), admin_url( 'widgets.php' ) ) . '</p>'; ?>
		</span>
	<hr class="content-meta">
	</div>
	<?php

	if ( 'page' == $current_screen->post_type || 'post' == $current_screen->post_type ) { ?>
		<div class="body-class-meta r-title">
			<p><label><strong><?php _e( 'REMOVE CONTENT ELEMENTS &#x2192;', 'structr' ); ?></strong></label></p>
			<p class="input-group content-meta">
				<input id="_singular-top-menu" name="_singular-top-menu" value="<?php echo $show_top_menu; ?>" size="30" type="checkbox" <?php checked( '1', $show_top_menu, '1' ); ?>>
				<label for="_singular-top-menu"><?php _e( 'Remove <strong>Top Menu</strong> ', 'structr' ); ?> </label>
			</p>
			<p class="input-group content-meta">
				<input id="_singular-main-menu" name="_singular-main-menu" value="<?php echo $show_main_menu; ?>" size="30" type="checkbox" <?php checked( '1', $show_main_menu, '1' ); ?>>
				<label for="_singular-main-menu"><?php _e( 'Remove <strong>Main Menu</strong> ', 'structr' ); ?> </label>
			</p>
			<p class="input-group content-meta">
				<input id="_singular-title" name="_singular-title" value="<?php echo $show_title; ?>" size="30" type="checkbox" <?php checked( '1', $show_title, '1' ); ?>>
				<label for="_singular-title"><?php _e( 'Remove <strong>Article Title</strong> ', 'structr' ); ?> </label>
			</p>
<!--
			<p class="input-group content-meta">
				<input disabled="disabled" id="_singular-header" name="_singular-header" value="<?php echo $show_header; ?>" size="30" type="checkbox" <?php checked( '1', $show_header, '1' ); ?>>
				<label class="disabled-check" for="_singular-header"><?php _e( 'Remove <strong>Entire Header</strong> ', 'structr' ); ?> </label>
			</p>
			<p class="input-group content-meta">
				<input disabled="disabled" id="_singular-footer-widgets" name="_singular-footer-widgets" value="<?php echo $show_footer_widgets; ?>" size="30" type="checkbox" <?php checked( '1', $show_footer_widgets, '1' ); ?>>
				<label class="disabled-check" for="_singular-footer-widgets"><?php _e( 'Remove <strong>Footer Widgets</strong> ', 'structr' ); ?> </label>
			</p>
			<p class="input-group content-meta">
				<input disabled="disabled" id="_singular-footer" name="_singular-footer" value="<?php echo $show_footer; ?>" size="30" type="checkbox" <?php checked( '1', $show_footer, '1' ); ?>>
				<label class="disabled-check" for="_singular-footer"><?php _e( 'Remove <strong>Entire Footer</strong> ', 'structr' ); ?> </label>
			</p>
-->
		</div>
		<?php
	}
}

/**
 * structr_single_sidebar_posts function.
 *
 * @access public
 * @param string $meta_key (default: '')
 * @return void
 */
function structr_single_sidebar_posts( $meta_key = '' ) {

	if ( empty( $meta_key ) ) {
		return false;
	}

	if ( false === get_transient( 'structr_single_sidebar_posts_' . $meta_key ) ) {

		$args = array(
			'fields'     => 'ids',
			'post_type'  => array( 'post', 'page' ),
			'post_status'  => array( 'publish', 'draft', 'auto-draft', 'pending', 'inherit' ),
			'meta_key'   => $meta_key,
			'meta_value' => 1,
			'nopaging'   => true,
		);

		$items = get_posts( $args );

		if ( ! $items ) {
			return false;
		}

		set_transient( 'structr_single_sidebar_posts_' . $meta_key, $items, 0 );
	}

	$items = get_transient( 'structr_single_sidebar_posts_' . $meta_key );

	return $items;
}

/**
 * singular_widgets_init function.
 *
 * @access public
 * @return void
 */
function singular_widgets_init() {

	$sidebar_1_items = structr_single_sidebar_posts( '_create-sidebar-1' );

	if ( ! empty( $sidebar_1_items ) ) {

		foreach ( $sidebar_1_items as $side1_id ) {

			$side1_title = get_the_title( $side1_id );

			register_sidebar( array(
				'name'				=> 'Primary &#8212; ' . esc_html( $side1_title ),
				'id'				=> 'sidebar-1-' . absint( $side1_id ),
				'description'   	=> sprintf( __( 'Custom "Primary Sidebar" for Post/Page &#x2192; "%s". When populated, it will replace the default "Primary Sidebar".', 'structr' ), esc_html( $side1_title ) ),
				'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
				'after_widget' 		=> '</aside>',
				'before_title' 		=> '<h4 class="widget-title">',
				'after_title' 		=> '</h4>',
			) );
		}
	}
}
add_action( 'widgets_init', 'singular_widgets_init', 20 );

/**
 * structr_save_layout_meta function.
 *
 * @access public
 * @param mixed $post_id
 * @return void
 */
function structr_save_layout_meta( $post_id ) {
	global $options;

	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );

	if ( ! isset( $_POST['meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['meta_box_nonce'], 'structr_meta_box_nonce' ) ) {
		return;
	}

	if ( $is_autosave || $is_revision ) {
		return;
	}

	if ( isset( $_POST['_singular-column'] ) ) {
		update_post_meta( $post_id, '_singular-column', esc_attr( $_POST['_singular-column'] ) );

	} elseif ( ! isset( $_POST['_singular-column'] ) ) {
		et_theme_mod( 'structr_content_layout' ) == $_POST['_singular-column'];
	}

	$allowed = array();

	if ( isset( $_POST['_custom-body-class'] ) ) {
		update_post_meta( $post_id, '_custom-body-class', wp_kses( $_POST['_custom-body-class'], $allowed ) );
	}

	if ( isset( $_POST['_custom-post-class'] ) ) {
		update_post_meta( $post_id, '_custom-post-class', wp_kses( $_POST['_custom-post-class'], $allowed ) );
	}

	$new_sidebar_1 = isset( $_POST['_create-sidebar-1'] ) ? 1 : 0;
		update_post_meta( $post_id, '_create-sidebar-1', $new_sidebar_1 );

	$show_top_menu_ = isset( $_POST['_singular-top-menu'] ) ? 1 : 0;
		update_post_meta( $post_id, '_singular-top-menu', $show_top_menu_ );

	$show_main_menu_ = isset( $_POST['_singular-main-menu'] ) ? 1 : 0;
		update_post_meta( $post_id, '_singular-main-menu', $show_main_menu_ );

	$show_title_ = isset( $_POST['_singular-title'] ) ? 1 : 0;
		update_post_meta( $post_id, '_singular-title', $show_title_ );

	delete_transient( 'structr_single_sidebar_posts__create-sidebar-1' );
}
add_action( 'save_post', 'structr_save_layout_meta' );

/**
 * structr_feat_img_metabox function.
 *
 * @access public
 * @return void
 */
function structr_feat_img_metabox() {
	add_action( 'save_post', 'structr_save_feat_img_meta', 10, 2 );
}
add_action( 'load-post.php', 'structr_feat_img_metabox' );
add_action( 'load-post-new.php', 'structr_feat_img_metabox' );

/**
 * add_structr_feat_img_meta function.
 *
 * @access public
 * @param mixed $content
 * @return void
 */
function add_structr_feat_img_meta( $content ) {
	ob_start();

	echo $content;

	structr_feat_img_meta();

	return ob_get_clean();
}
add_filter( 'admin_post_thumbnail_html', 'add_structr_feat_img_meta', 1, 5 );

/**
 * structr_feat_img_meta function.
 *
 * @access public
 * @return void
 */
function structr_feat_img_meta() {
	$position        = get_post_meta( get_the_ID(), 'structr_feat_img_position', true );
	$position_arch   = get_post_meta( get_the_ID(), 'structr_feat_img_position_arch', true );
	$position_values = array(
		'before_section' => __( 'Full Site Width - Above Columns', 'structr' ),
		'before_title'   => __( 'Main Content Width - Above Headline', 'structr' ),
		'before_title_fixed'   => __( 'Main Content Width - Above Headline (fixed height)', 'structr' ),
	);
	$position_values_arch = array(
		'before_title_arch'   => __( 'Main Content Width - Above Headline', 'structr' ),
		'before_title_arch_fixed'   => __( 'Main Content Width - Above Headline (fixed height)', 'structr' ),
	);

	$structr_caption     = get_post_meta( get_the_ID(), 'structr_feat_img_caption', true );
	$caption_add = isset( $structr_caption['add'] ) ? 1 : 0;

	$the_id = get_post_custom( get_the_ID() );
	$feat_img_height = isset( $the_id['feat_img_height'] ) ? esc_attr( $the_id['feat_img_height'][0] ) : '';
	$feat_img_arch_height = isset( $the_id['feat_img_arch_height'] ) ? esc_attr( $the_id['feat_img_arch_height'][0] ) : '';

?>

	<?php wp_nonce_field( basename( __FILE__ ), 'structr_feat_img_nonce' ); ?>

	<div class="structr-feat-img-meta">
		<div>
			<!-- Position Single -->
			<p class="position-heading-single"><label for="structr_feat_img_position"><b><?php _e( 'WordPress Featured Image Position (single post pages)', 'structr' ); ?></b></label></p>

			<select name="structr_feat_img_position" id="structr_feat_img_position">
				<?php foreach ( $position_values as $val => $label ) : ?>
					<option value="<?php echo $val; ?>"<?php echo selected( $position, $val, false ); ?>><?php echo $label; ?></option>
				<?php endforeach; ?>
				<option value="before_section_fixed"<?php echo selected( 'structr_feat_img_position', 'before_section_fixed', false ); ?> disabled>Full Site Width - Above Columns (fixed height)</option>
				<option value="before_post"<?php echo selected( 'structr_feat_img_position', 'before_post', false ); ?> disabled>Below Post Byline - Article Width</option>
				<option value="right_post"<?php echo selected( 'structr_feat_img_position', 'right_post', false ); ?> disabled>Inside Post Article - Aligned Right of Text</option>
				<option value="left_post"<?php echo selected( 'structr_feat_img_position', 'left_post', false ); ?> disabled>Inside Post Article - Aligned Left of Text</option>
			</select>
			
			<div id="showimagemeta">
				<p class="position-heading-single"><label for="feat_img_height"><b><?php _e( 'Fixed Image Height', 'structr' ); ?></b></label></p>
				<input id="feat_img_height" class="custom-class" name="feat_img_height" value="<?php echo $feat_img_height; ?>" size="4" type="text" placeholder="<?php _e( '300', 'structr' ); ?>" /><span> px</span>
			</div>
		</div>
		<div>
			<!-- Position Archives -->
			<p class="position-heading-arch"><label for="structr_feat_img_position_arch"><b><?php _e( 'WordPress Featured Image Position (blog/archive pages)', 'structr' ); ?></b></label></p>

			<select name="structr_feat_img_position_arch" id="structr_feat_img_position_arch">
				<?php foreach ( $position_values_arch as $val => $label ) : ?>
					<option value="<?php echo $val; ?>"<?php echo selected( $position_arch, $val, false ); ?>><?php echo $label; ?></option>
				<?php endforeach; ?>
				<option value="before_post_arch"<?php echo selected( 'structr_feat_img_position_arch', 'before_post_arch', false ); ?> disabled>Below Post Byline - Article Width</option>
				<option value="right_post_arch"<?php echo selected( 'structr_feat_img_position_arch', 'right_post_arch', false ); ?> disabled>Inside Post Article - Aligned Right of Text</option>
				<option value="left_post_arch"<?php echo selected( 'structr_feat_img_position_arch', 'left_post_arch', false ); ?> disabled>Inside Post Article - Aligned Left of Text</option>
			</select>

			<div id="show_arch_imagemeta">
				<p class="position-heading-single"><label for="feat_img_arch_height"><b><?php _e( 'Fixed Image Height', 'structr' ); ?></b></label></p>
				<input id="feat_img_arch_height" class="custom-class" name="feat_img_arch_height" value="<?php echo $feat_img_arch_height; ?>" size="4" type="text" placeholder="<?php _e( '250', 'structr' ); ?>" /><span> px</span>
			</div>
		</div>
		<div>
			<!-- Caption -->
			<p class="heading-caption"><label for="structr_feat_img_caption"><b><?php _e( 'Featured Image Caption', 'structr' ); ?></b></label></p>

			<p><input type="checkbox" name="structr_feat_img_caption[add]" id="structr_feat_img_caption_add" value="1"<?php echo checked( $caption_add, 1, false ); ?> /> <label for="structr_feat_img_caption_add"><?php _e( 'Add image caption (bottom corner)', 'structr' ); ?></label></p>

			<p class="description"><?php _e( 'Select + Edit Featured Image for caption meta option.', 'structr' ); ?></p>

		</div>
	</div>
	
	<script>					
	jQuery(document).ready(function () {
	    toggleFields();

	    jQuery("#structr_feat_img_position").change(function () {
	        toggleFields();
	    });
	    
	    jQuery("#structr_feat_img_position_arch").change(function () {
	        toggleFields();
	    });
	});
	
	function toggleFields() {
		
	    if (jQuery("#structr_feat_img_position").val() == 'before_section_fixed' || jQuery("#structr_feat_img_position").val() == 'before_title_fixed' )
	        jQuery("#showimagemeta").show();
	    else
	        jQuery("#showimagemeta").hide();
		
	    if (jQuery("#structr_feat_img_position_arch").val() == 'before_title_arch_fixed' )
	        jQuery("#show_arch_imagemeta").show();
	    else
	        jQuery("#show_arch_imagemeta").hide();
	}
	</script>

<?php }

/**
 * structr_save_feat_img_meta function.
 *
 * @access public
 * @param mixed $post_id
 * @param mixed $post
 * @return void
 */
function structr_save_feat_img_meta( $post_id, $post ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if (
		( ! isset( $_POST['structr_feat_img_nonce'] ) || ! wp_verify_nonce( $_POST['structr_feat_img_nonce'], basename( __FILE__ ) ) )
	) {
		return;
	}

	$post_type = get_post_type_object( $post->post_type );

	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
		return;
	}

	$keys = array_merge( array(
		// featured image
		'structr_feat_img_position' => array(
			'type' => 'select',
			'options' => array(
				'before_section',
				'before_title',
				'before_title_fixed',
			),
		),
		'structr_feat_img_position_arch' => array(
			'type' => 'select',
			'options' => array(
				'before_title_arch',
				'before_title_arch_fixed',
			),
		),
		'feat_img_height' => array(
			'type' => 'text',
		),
		'feat_img_arch_height' => array(
			'type' => 'text',
		),
		'structr_feat_img_caption' => array(
			'type' => 'checkbox',
			'options' => array(
				'add'
			),
		),
	) );

	// run keys through save meta functions
	foreach ( $keys as $key => $fields ) {
		$type    = isset( $fields['type'] ) ? $fields['type'] : '';
		$options = isset( $fields['options'] ) ? $fields['options'] : '';

		$new = isset( $_POST[ $key ] ) ? $_POST[ $key ] : '';

		if ( is_array( $type ) && 'checkbox' == $type ) {
			foreach ( $options as $check ) {
				$new[ $check ] = isset( $new[ $check ] ) ? 1 : 0;

			}
		} elseif ( 'select' == $type ) {
			$new = in_array( $new, $options ) ? $new : '';
		}

			$value = get_post_meta( $post_id, $key, true );

		if ( $new && $new != $value ) {
			update_post_meta( $post_id, $key, $new );
		} elseif ( '' == $new && $value ) {
			delete_post_meta( $post_id, $key, $value );
		}
	}
}

/**
 * structr_edd_add_comments_support function.
 *
 * @access public
 * @param mixed $supports
 * @return void
 */
function structr_edd_add_comments_support( $supports ) {
	$supports[] = 'comments';
	return $supports;
}
add_filter( 'edd_download_supports', 'structr_edd_add_comments_support' );
