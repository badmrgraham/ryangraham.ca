<?php
/** customizer.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This file builds the options for use in the theme customizer.
 *
 * @package Structr
 * @since Structr 1.0
 */


/**
 * customizer_library_demo_options function.
 *
 * @access public
 * @return void
 */
function customizer_library_demo_options() {

	// Stores all controls added below
	$options = array();

	// Stores all sections added below
	$sections = array();

	// Stores all panels added below
	$panels = array();

	// Adds sections to $options array
	$options['sections'] = $sections;

	// ========================================
	// = SITE IDENTITY SECION - 10            =
	// ========================================
	$section = 'title_tagline';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Site Identity', 'structr' ),
		'priority' => 10,

	);

	$options['structr_title_tag_desc'] = array(
		'id' => 'structr_title_tag_desc',
		'label'		=> __( 'Site Title & Tagline Options', 'structr' ),
		'description' => __( 'Customize and/or remove title/tagline', 'structr' ),
		'section' => $section,
		'type'      => 'subsection',
		'priority'	=> 10,
		'default' => '',

	);

	$options['blogname'] = array(
		'id' => 'blogname',
		'section' => $section,
		'transport' => 'postMessage',
		'priority'	=> 20,

	);
	$options['structr_hide_title'] = array(
		'id' => 'structr_hide_title',
		'label'		=> __( 'Remove Site Title', 'structr' ),
		'section' => $section,
		'type'      => 'checkbox',
		'priority'	=> 30,
		'default' => 0,

	);

	$options['blogdescription'] = array(
		'id' => 'blogdescription',
		'section' => $section,
		'transport' => 'postMessage',
		'priority'	=> 40,

	);
	$options['structr_hide_tagline'] = array(
		'id' => 'structr_hide_tagline',
		'label'		=> __( 'Remove Site Tagline', 'structr' ),
		'section' => $section,
		'type'      => 'checkbox',
		'sanitize_callback'	=> 'customizer_library_sanitize_checkbox',
		'priority'	=> 50,
		'default' => 0,

	);

	$options['structr_logo_desc'] = array(
		'id' => 'structr_logo_desc',
		'label'		=> __( 'Logo Image (replaces title/tagline)', 'structr' ),
		'description' => __( 'Replace title & tagline with a logo image', 'structr' ),
		'section' => $section,
		'type'      => 'subsection',
		'priority'	=> 60,
		'default' => '',

	);

	$options['structr_logo'] = array(
		'id' => 'structr_logo',
		'label'   => '',
		'section' => $section,
		'type'    => 'image',
		'default' => null,
		'priority' => 70,

	);

	$options['structr_favicon_desc'] = array(
		'id' => 'structr_favicon_desc',
		'label'		=> __( 'Site Icon (a.k.a. Favicon Image)', 'structr' ),
		'description' => __( 'Add a favicon image to your site..', 'structr' ),
		'section' => $section,
		'type'      => 'subsection',
		'priority'	=> 80,
		'default' => '',

	);

	$options['site_icon'] = array(
		'id' => 'site_icon',
		'label'   => '',
		'section' => $section,
		'type'    => 'image',
		'default' => null,
		'priority' => 90,

	);

	$options['structr_bg_img_desc'] = array(
		'id' => 'structr_bg_img_desc',
		'label'		=> __( 'Background Image/Style Options', 'structr' ),
		'description' => __( 'Add/customize background image.', 'structr' ),
		'section' => $section,
		'type'      => 'subsection',
		'priority'	=> 100,
		'default' => '',

	);

	$options['background_image'] = array(
		'id' => 'background_image',
		'section' => $section,
		'label' => null,
		'priority'	=> 110,

	);
	$options['background_repeat'] = array(
		'id' => 'background_repeat',
		'section' => $section,
		'label' => __( 'Site Background Repeat', 'structr' ),
		'priority'	=> 120,

	);
	$options['background_position_x'] = array(
		'id' => 'background_position_x',
		'section' => $section,
		'label' => __( 'Site Background Position', 'structr' ),
		'priority'	=> 130,

	);
	$options['background_attachment'] = array(
		'id' => 'background_attachment',
		'section' => $section,
		'label' => __( 'Site Background Attachment', 'structr' ),
		'priority'	=> 140,

	);

	// ========================================
	// = LAYOUT OPTIONS SECTION - 20          =
	// ========================================
	$section = 'site_structure_section';

	$sections[] = array(
		'id' => $section,
		'title'		=> __( 'Site Layout', 'structr' ),
		'priority' => 20,

	);

	$options['structr_front_display_hdlne'] = array(
		'id' => 'structr_front_display_hdlne',
		'label'		=> __( 'Set the Output of your Front Page', 'structr' ),
		'description' => __( ' Use your post archive (blog) or a static page', 'structr' ),
		'section' => $section,
		'priority' => 10,
		'type' => 'subsection',

	);
	$options['show_on_front'] = array(
		'id' => 'show_on_front',
		'default' => 'posts',
	);
	$options['page_on_front'] = array(
		'id' => 'page_on_front',
	);
	$options['page_for_posts'] = array(
		'id' => 'page_for_posts',
	);

	$options['structr_layout_design_hdlne'] = array(
		'id' => 'structr_layout_design_hdlne',
		'label'		=> __( 'Website Container Maximum Width', 'structr' ),
		'description' => __( 'Select your sites global layout options here. The "Site Width" value is the max width (in pixels) that your content elements will span within the page.', 'structr' ),
		'section' => $section,
		'priority' => 50,
		'type' => 'subsection',
	);

	$options['structr_container_width'] = array(
		'default' => 1170,
		'id' => 'structr_container_width',
		'label' => __( 'Max Width for Site', 'structr' ),
		'section' => $section,
		'type' => 'range-width',
		'priority' => 60,
		'input_attrs' => array(
	        'min'   => 770,
	        'max'   => 2000,
	        'step'  => 5,

	),
	);

	$options['structr_column_design_hdlne'] = array(
		'id' => 'structr_column_design_hdlne',
		'label'		=> __( 'Default Site Column Layout Option', 'structr' ),
		'description' => __( 'The "Column Layout" is the default setup for your content/sidebar columns. Column layouts can also be customized on a per-post/page basis.', 'structr' ),
		'section' => $section,
		'priority' => 70,
		'type' => 'subsection',

	);

	$choices = structr_get_radio_image_options();
	$options['structr_content_layout'] = array(
		'id' => 'structr_content_layout',
		'section' => $section,
		'priority' => 80,
		'type'    => 'radio-image',
		'choices' => $choices,
		'default' => 'cs',

	);

	/*
	$options['structr_upgrade_layout'] = array(
		'id' => 'structr_upgrade_layout',
		'section' => $section,
		'label'		=> __( 'More Layout Settings', 'structr' ),
		'url' => 'https://structrpress.com/downloads/structr-framework/',
		'description' => sprintf(
			__( 'Want to use all 9 layout options?<br /> %s.', 'structr' ),
			sprintf(
				'<a href="%1$s" target="_blank">%2$s</a>',
				esc_url( 'https://structrpress.com/downloads/structr-framework/' ),
				__( 'Upgrade to the full version of Structr', 'structr' )
			)
		),
		'priority' => 90,
		'type' => 'upgrade'
	);
	*/

	// ========================================
	// = CONTENT OPTIONS PANEL - 20           =
	// ========================================
	$panel = 'structr_content_panel';
	$panels[] = array(
		'id' => $panel,
		'title' => __( 'Site Content', 'structr' ),
		'priority' => 30,

	);

	// SHOW / HIDE SECTION >> Content Section - 10 -
	$section = 'show_hide_content_section';
	$sections[] = array(
		'id' => $section,
		'title'		=> __( 'Menus + Images + Byline', 'structr' ),
		'priority'	=> 10,
		'panel' => $panel,

	);

	$options['structr_display_content_hdlne'] = array(
		'id' => 'structr_display_content_hdlne',
		'label'		=> __( 'Display/hide website elements', 'structr' ),
		'description' => __( 'Control the output of various elements', 'structr' ),
		'section' => $section,
		'type'      => 'subsection',
		'priority'	=> 10,
		'default' => '',

	);

	$options['structr_menus_head'] = array(
		'id' => 'structr_menus_head',
		'label'		=> __( 'Menus', 'structr' ),
		'section' => $section,
		'type'      => 'heading',
		'priority'	=> 20,

	);
	$options['structr_show_top_menu'] = array(
		'id' => 'structr_show_top_menu',
		'label' => __( 'Display the Top Menu', 'structr' ),
		'section' => $section,
		'type' => 'checkbox',
		'default' => 1,
		'priority' => 30,

	);
	$options['structr_show_main_menu'] = array(
		'id' => 'structr_show_main_menu',
		'label' => __( 'Display the Main Menu', 'structr' ),
		'section' => $section,
		'type' => 'checkbox',
		'default' => 1,
		'priority' => 40,

	);
	$options['structr_feat_img_head'] = array(
		'id' => 'structr_feat_img_head',
		'label'		=> __( 'Featured Images', 'structr' ),
		'section' => $section,
		'type'      => 'heading',
		'priority'	=> 50,
		'default' => '',

	);

	$options['structr_feat_img_home'] = array(
		'id' => 'structr_feat_img_home',
		'label'  => __( 'Display on Homepage & Feeds', 'structr' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
		'priority' => 60,

	);
	$options['structr_link_featured'] = array(
		'id' => 'structr_link_featured',
		'label'		=> __( 'Link Image to Single Post', 'structr' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
		'priority'    => 70,

	);
	$options['structr_feat_img_single'] = array(
		'id' => 'structr_feat_img_single',
		'label'  => __( 'Display on Single Posts', 'structr' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
		'priority' => 80,

	);

	$options['structr_byline_head'] = array(
		'id' => 'structr_byline_head',
		'label'		=> __( 'Byline Elements', 'structr' ),
		'section' => $section,
		'type'      => 'heading',
		'priority'	=> 90,
		'default' => '',

	);
	$options['structr_byline_author'] = array(
		'id' => 'structr_byline_author',
		'label'		=> __( 'Post Author', 'structr' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
		'priority' => 100,

	);
	$options['structr_byline_date'] = array(
		'id' => 'structr_byline_date',
		'label'		=> __( 'Post Date', 'structr' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
		'priority'    => 110,

	);
	$options['structr_byline_edit'] = array(
		'id' => 'structr_byline_edit',
		'label'		=> __( 'Edit Link', 'structr' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
		'priority'    => 120,

	);
	$options['structr_byline_comments'] = array(
		'id' => 'structr_byline_comments',
		'label'		=> __( 'Comments Link', 'structr' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
		'priority'    => 130,

	);

	// SOCIAL PROFILE LINKS SECTION >> Content Section - 20 -
	/*
	$section = 'structr_social_media';
	$sections[] = array(
		'id' => $section,
		'title'		=> __( 'Social Profile Icon Links', 'structr' ),
		'priority'	=> 20,
		'panel' => $panel

	);

	$options['my_social_settings_hdlne'] = array(
		'id' => 'my_social_settings_hdlne',
		'label'		=> __( 'Social Icon Links Menu URL\'s', 'structr' ),
		'description' => __( 'Add URL\'s to your social profiles below', 'structr' ),
		'section' => $section,
		'type'      => 'subsection',
		'priority'	=> 10,
		'default' => NULL

	);

	$options['structr_upgrade_socials'] = array(
		'id' => 'structr_upgrade_socials',
		'section' => $section,
		'label'		=> __( 'Social Icon Settings', 'structr' ),
		'url' => 'https://structrpress.com/downloads/structr-framework/',
		'description' => sprintf(
			__( 'Want to add social profile icons?<br /> %s.', 'structr' ),
			sprintf(
				'<a href="%1$s" target="_blank">%2$s</a>',
				esc_url( 'https://structrpress.com/downloads/structr-framework/' ),
				__( 'Upgrade to the full version of Structr', 'structr' )
			)
		),
		'priority' => 20,
		'type' => 'upgrade'
	);
	*/

	// WIDGETS, EXCERPTS, PAGI SECTION >> Content Section - 30 -
	$section = 'widget_excerpt_pagi_section';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Widgets + Excerpts + Pagination', 'structr' ),
		'priority' => 30,
		'panel' => $panel,

	);

	$options['structr_display_elements_hdlne'] = array(
		'id' => 'structr_display_elements_hdlne',
		'label'		=> __( 'Widgets, Excerpts & Pagination', 'structr' ),
		'description' => __( 'Customize the look & output below', 'structr' ),
		'section' => $section,
		'type'      => 'subsection',
		'priority'	=> 10,
		'default' => null,

	);

	$options['structr_widgets_head'] = array(
		'id' => 'structr_widgets_head',
		'label'		=> __( 'Default Widgets', 'structr' ),
		'section' => $section,
		'type'      => 'heading',
		'priority'	=> 20,
		'default' => null,

	);

	$options['structr_default_widgets'] = array(
		'id' => 'structr_default_widgets',
		'label'  => __( 'Display Default Widgets', 'structr' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
		'priority' => 30,

	);

	$options['structr_excerpt_head'] = array(
		'id' => 'structr_excerpt_head',
		'label'		=> __( 'Post Excerpts', 'structr' ),
		'section' => $section,
		'type'      => 'heading',
		'priority'	=> 40,
		'default' => '',

	);

	$options['structr_post_excerpts'] = array(
		'id' => 'structr_post_excerpts',
		'label'  => __( 'Display Post Excerpts', 'structr' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
		'priority' => 50,

	);
	$options['structr_excerpt_length'] = array(
		'default' => 55,
		'id' => 'structr_excerpt_length',
		'label' => __( 'Excerpt Length (words)', 'structr' ),
		'section' => $section,
		'type' => 'range-slider',
		'priority' => 60,
		'input_attrs' => array(
	        'min'   => 5,
	        'max'   => 200,
	        'step'  => 1,

	),
	);

	$options['structr_excerpt_link_head'] = array(
		'id' => 'structr_excerpt_link_head',
		'label'		=> __( 'Post Excerpt Link', 'structr' ),
		'section' => $section,
		'type'      => 'heading',
		'priority'	=> 70,
		'default' => '',

	);

	$options['structr_post_excerpt_link'] = array(
		'id' => 'structr_post_excerpt_link',
		'label'  => __( 'Display Post Excerpt Link', 'structr' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
		'priority' => 80,

	);
		$options['structr_excerpt_link_text'] = array(
			'id' => 'structr_excerpt_link_text',
			'label'   => __( 'Read More Link Text', 'structr' ),
			'section' => $section,
			'type'    => 'text',
			'default' => __( 'Read More', 'structr' ) . ' &rarr;',
			'priority' => 90,
		);

	$options['structr_pagi_head'] = array(
		'id' => 'structr_pagi_head',
		'label'		=> __( 'Post Navigation Output', 'structr' ),
		'section' => $section,
		'type'      => 'heading',
		'priority'	=> 100,
		'default' => '',

	);
	$options['structr_home_pagi'] = array(
		'id' => 'structr_home_pagi',
		'label'		=> __( 'Use Numbered Pagination?', 'structr' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
		'priority' => 110,

	);

	// COMMENTS & POST FOOTER SECTION >> Content Section - 40 -
	$section = 'comments_post_footer_section';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Comments + Post Footer', 'structr' ),
		'priority' => 40,
		'panel' => $panel,

	);

	$options['structr_display_comments_hdlne'] = array(
		'id' => 'structr_display_comments_hdlne',
		'label'		=> __( 'Comment Sections/Notices Output', 'structr' ),
		'description' => __( 'Globally turn on/off the comment sections', 'structr' ),
		'section' => $section,
		'type'      => 'subsection',
		'priority'	=> 10,
		'default' => null,

	);

	$options['structr_comments_head'] = array(
		'id' => 'structr_comments_head',
		'label'		=> __( 'Comment Sections', 'structr' ),
		'section' => $section,
		'type'      => 'heading',
		'priority'	=> 20,
		'default' => null,

	);

	$options['structr_comment_posts'] = array(
		'id' => 'structr_comment_posts',
		'label'  => __( 'Display Comments on Posts', 'structr' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
		'priority' => 30,

	);
	$options['structr_comment_pages'] = array(
		'id' => 'structr_comment_pages',
		'label'  => __( 'Display Comments on Pages', 'structr' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
		'priority' => 40,

	);

	$options['structr_comm_cl_notice'] = array(
		'id' => 'structr_comm_cl_notice',
		'label'  => __( 'Display \'Comments Closed\' Notice', 'structr' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
		'priority' => 50,

	);
	$options['structr_comm_em_notice'] = array(
		'id' => 'structr_comm_em_notice',
		'label'  => __( 'Display \'Comments Empty\' Notice', 'structr' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
		'priority' => 60,

	);

	$options['structr_display_cat_tag_hdlne'] = array(
		'id' => 'structr_display_cat_tag_hdlne',
		'label'		=> __( 'Categories/Tags After Post Output', 'structr' ),
		'description' => __( ' Globally turn on/off the output of category and tag lists after the single post content section', 'structr' ),
		'section' => $section,
		'type'      => 'subsection',
		'priority'	=> 70,
		'default' => null,

	);

	$options['structr_cat_tag_head'] = array(
		'id' => 'structr_cat_tag_head',
		'label'		=> __( 'Category/Tag Lists', 'structr' ),
		'section' => $section,
		'type'      => 'heading',
		'priority'	=> 80,
		'default' => null,

	);

	$options['structr_cats_after_posts'] = array(
		'id' => 'structr_cats_after_posts',
		'label'  => __( 'Display Category List After Posts', 'structr' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
		'priority' => 90,

	);
	$options['structr_tags_after_posts'] = array(
		'id' => 'structr_tags_after_posts',
		'label'  => __( 'Display Tag List After Posts', 'structr' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
		'priority' => 100,

	);

	// FOOTER COPYRIGHT/SITE INFO SECTION >> Content Section - 50 -
	$section = 'footer_copy_info_section';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Site Information Footer', 'structr' ),
		'priority' => 50,
		'panel' => $panel,

	);

	$options['structr_footer_txt_hdlne'] = array(
		'id' => 'structr_footer_txt_hdlne',
		'label'		=> __( 'Footer Copyright/Site Info Text', 'structr' ),
		'description' => __( ' Customize the footer site info section', 'structr' ),
		'section' => $section,
		'type'      => 'subsection',
		'priority'	=> 10,
		'default' => null,

	);

	$options['structr_footer_copy'] = array(
		'id' => 'structr_footer_copy',
		'label'		=> '',
		'description' => '',
		'section' => $section,
		'type'      => 'textarea',
		'priority'	=> 20,
		'transport' => 'postMessage',
		'default' => 'Built on the <a href="' . esc_url( __( 'http://structrpress.com/', 'structr' ) ) . '" target="_blank">' . sprintf( __( 'Structr Framework%s', 'structr' ),'' ) . '</a>' . ' for ' . '<a href="' . esc_url( __( 'http://wordpress.org/', 'structr' ) ) . '" target="_blank">' . sprintf( __( 'WordPress%s', 'structr' ),'' ) . '</a>' . ', and made with love :)',

	);

	// ========================================
	// = COLORS OPTIONS PANEL - 30            =
	// ========================================
	$panel = 'structr_colors_panel';
	$panels[] = array(
		'id' => $panel,
		'title' => __( 'Site Colors', 'structr' ),
		'priority' => 30,

	);

	// GLOBAL COLORS SECTION >> Colors Panel - 10 -
	$section = 'colors';
	$sections[] = array(
		'id' => $section,
		'title'		=> __( 'Global Colors', 'structr' ),
		'priority'	=> 10,
		'panel' => $panel,

	);

	$options['global_color_content_hdlne'] = array(
		'id' => 'global_color_content_hdlne',
		'label'		=> __( 'Site Content Base Color Options', 'structr' ),
		'description' => __( 'Set colors for global website elements', 'structr' ),
		'section' => $section,
		'type'      => 'subsection',
		'priority'	=> 10,
		'default' => '',

	);

	$options['background_color'] = array(
		'id' => 'background_color',
		'section' => $section,
		'priority'  => 30,
	);

	$options['content_background'] = array(
		'id' => 'content_background',
		'label'   => __( 'Content Background', 'structr' ),
		'description' => __( 'Used for post/page backgrounds', 'structr' ),
		'section' => $section,
		'type'    => 'color',
		'priority'  => 40,
		'default' => '#ffffff',
	);

	$options['primary_text'] = array(
		'id' => 'primary_text',
		'label'   => __( 'Primary Text', 'structr' ),
		'description' => __( 'Used for main content text', 'structr' ),
		'section' => $section,
		'type'    => 'color',
		'priority'  => 50,
		'default' => '#2e2e2e',
	);

	$options['secondary_text'] = array(
		'id' => 'secondary_text',
		'label'   => __( 'Secondary Text', 'structr' ),
		'description' => __( 'Used for secondary elements', 'structr' ),
		'section' => $section,
		'type'    => 'color',
		'priority'  => 60,
		'default' => '#A7A7A7',
	);

	$options['link_text'] = array(
		'id' => 'link_text',
		'label'   => __( 'Links Color', 'structr' ),
		'description' => __( 'Used for main content links', 'structr' ),
		'section' => $section,
		'type'    => 'color',
		'priority'  => 70,
		'default' => '#53a2ba',
	);

	$options['link_hover_text'] = array(
		'id' => 'link_hover_text',
		'label'   => __( 'Links Hover Color', 'structr' ),
		'description' => __( 'Used for main content links', 'structr' ),
		'section' => $section,
		'type'    => 'color',
		'priority'  => 80,
		'default' => '#A7A7A7',
	);

	/*
    // HEADER COLORS SECTION >> Colors Panel - 20 -
	$section = 'header_colors_section';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Header Colors', 'structr' ),
		'priority' => 20,
		'panel' => $panel

	);

	$options['header_color_content_hdlne'] = array(
		'id' => 'header_color_content_hdlne',
		'label'		=> __( 'Header Area Color Options', 'structr' ),
		'description' => __( 'Set colors for elements in the header', 'structr' ),
		'section' => $section,
		'type'      => 'subsection',
		'priority'	=> 10,
		'default' => ''

	);

	$options['structr_upgrade_head_colors'] = array(
		'id' => 'structr_upgrade_head_colors',
		'section' => $section,
		'label'		=> __( 'Header Color Settings', 'structr' ),
		'url' => 'https://structrpress.com/downloads/structr-framework/',
		'description' => sprintf(
			__( 'Want to Customize More Colors?<br /> %s.', 'structr' ),
			sprintf(
				'<a href="%1$s" target="_blank">%2$s</a>',
				esc_url( 'https://structrpress.com/downloads/structr-framework/' ),
				__( 'Upgrade to the full version of Structr', 'structr' )
			)
		),
		'priority' => 20,
		'type' => 'upgrade'
	);

    // MENU COLORS SECTION >> Colors Panel - 30 -
	$section = 'menu_colors_section';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Menu Colors', 'structr' ),
		'priority' => 30,
		'panel' => $panel

	);

	$options['menu_color_content_hdlne'] = array(
		'id' => 'menu_color_content_hdlne',
		'label'		=> __( 'Menu Areas/Links Color Options', 'structr' ),
		'description' => __( 'Set colors for menus, submenus & menu links', 'structr' ),
		'section' => $section,
		'type'      => 'subsection',
		'priority'	=> 10,
		'default' => ''

	);

	$options['structr_upgrade_menu_colors'] = array(
		'id' => 'structr_upgrade_menu_colors',
		'section' => $section,
		'label'		=> __( 'Header Color Settings', 'structr' ),
		'url' => 'https://structrpress.com/downloads/structr-framework/',
		'description' => sprintf(
			__( 'Want to Customize More Colors?<br /> %s.', 'structr' ),
			sprintf(
				'<a href="%1$s" target="_blank">%2$s</a>',
				esc_url( 'https://structrpress.com/downloads/structr-framework/' ),
				__( 'Upgrade to the full version of Structr', 'structr' )
			)
		),
		'priority' => 20,
		'type' => 'upgrade'
	);

    // CONTENT COLORS SECTION >> Colors Panel - 40 -
	$section = 'content_colors_section';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Content Colors', 'structr' ),
		'priority' => 40,
		'panel' => $panel

	);

	$options['main_color_content_hdlne'] = array(
		'id' => 'main_color_content_hdlne',
		'label'		=> __( 'Main Content Area Color Options', 'structr' ),
		'description' => __( 'Set colors for article titles, bylines & more', 'structr' ),
		'section' => $section,
		'type'      => 'subsection',
		'priority'	=> 10,
		'default' => ''

	);

	$options['structr_upgrade_content_colors'] = array(
		'id' => 'structr_upgrade_content_colors',
		'section' => $section,
		'label'		=> __( 'Header Color Settings', 'structr' ),
		'url' => 'https://structrpress.com/downloads/structr-framework/',
		'description' => sprintf(
			__( 'Want to Customize More Colors?<br /> %s.', 'structr' ),
			sprintf(
				'<a href="%1$s" target="_blank">%2$s</a>',
				esc_url( 'https://structrpress.com/downloads/structr-framework/' ),
				__( 'Upgrade to the full version of Structr', 'structr' )
			)
		),
		'priority' => 20,
		'type' => 'upgrade'
	);

    // SIDEBAR COLORS SECTION >> Colors Panel - 50 -
	$section = 'sidebar_colors_section';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Sidebar Colors', 'structr' ),
		'priority' => 50,
		'panel' => $panel

	);

	$options['sidebar_color_content_hdlne'] = array(
		'id' => 'sidebar_color_content_hdlne',
		'label'		=> __( 'Sidebar Area Color Options', 'structr' ),
		'description' => __( 'Set colors for sidebar areas, links & widgets', 'structr' ),
		'section' => $section,
		'type'      => 'subsection',
		'priority'	=> 10,
		'default' => ''

	);

	$options['structr_upgrade_sidebar_colors'] = array(
		'id' => 'structr_upgrade_sidebar_colors',
		'section' => $section,
		'label'		=> __( 'Header Color Settings', 'structr' ),
		'url' => 'https://structrpress.com/downloads/structr-framework/',
		'description' => sprintf(
			__( 'Want to Customize More Colors?<br /> %s.', 'structr' ),
			sprintf(
				'<a href="%1$s" target="_blank">%2$s</a>',
				esc_url( 'https://structrpress.com/downloads/structr-framework/' ),
				__( 'Upgrade to the full version of Structr', 'structr' )
			)
		),
		'priority' => 20,
		'type' => 'upgrade'
	);

    // FOOTER COLORS SECTION >> Colors Panel - 60 -
	$section = 'footer_colors_section';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Footer Colors', 'structr' ),
		'priority' => 60,
		'panel' => $panel

	);

	$options['footer_color_content_hdlne'] = array(
		'id' => 'footer_color_content_hdlne',
		'label'		=> __( 'Footer Area Color Options', 'structr' ),
		'description' => __( 'Set colors for footer area, links & widgets', 'structr' ),
		'section' => $section,
		'type'      => 'subsection',
		'priority'	=> 10,
		'default' => ''

	);

	$options['structr_upgrade_foot_colors'] = array(
		'id' => 'structr_upgrade_foot_colors',
		'section' => $section,
		'label'		=> __( 'Header Color Settings', 'structr' ),
		'url' => 'https://structrpress.com/downloads/structr-framework/',
		'description' => sprintf(
			__( 'Want to Customize More Colors?<br /> %s.', 'structr' ),
			sprintf(
				'<a href="%1$s" target="_blank">%2$s</a>',
				esc_url( 'https://structrpress.com/downloads/structr-framework/' ),
				__( 'Upgrade to the full version of Structr', 'structr' )
			)
		),
		'priority' => 20,
		'type' => 'upgrade'
	);
	*/

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();
}
add_action( 'init', 'customizer_library_demo_options' );


function structr_premium_customize_section( $active, $section ) {

	if ( 'accordion-section-structr_premium' == $section->id ) {
		$active = false;
	}

	return $active;
}
add_filter( 'customize_section_active', 'structr_premium_customize_section', 10, 2 );
