<?php
/** File: build-loops.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * Instead of building the loop into every template, let's use
 * the 'DRY' (Don't Repeat Yourself) method and create one
 * file that handles all the loops.
 *
 * @package Structr
 * @since Structr 1.0
 */

/**
 * Function: structr_content function.
 *
 * @access public
 * @return void
 */
function structr_content() {
	global $options;
	?>
	<div id="content" class="content-area">
	<?php
	if ( have_posts() ) {

		// homepage.
		if ( is_home() ) {

			if ( function_exists( 'struc_before_content_col_output' ) ) :
				struc_before_content_col_output(); // Structr hook before content column.
				endif;

			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content' );
			}

			if ( get_theme_mod( 'structr_home_pagi', 1 ) == 1 ) {

				structr_num_posts_nav();

			} else {

				structr_content_nav( 'home-nav' );

			}

			if ( function_exists( 'struc_after_content_col_output' ) ) :
				struc_after_content_col_output(); // Structr hook after content column.
				endif;

			// Single posts.
		} elseif ( is_single() && ! is_attachment() ) {

			if ( function_exists( 'struc_before_content_col_output' ) ) :
				struc_before_content_col_output(); // Structr hook before content column.
				endif;

			$postformat = ( get_post_format() ? get_post_format() : 'single' );

			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', $postformat );
			}

			if ( function_exists( 'struc_after_content_col_output' ) ) :
				struc_after_content_col_output(); // Structr hook after content column.
				endif;

			// Pages.
		} elseif ( is_page() ) {

			if ( function_exists( 'struc_before_content_col_output' ) ) :
				struc_before_content_col_output(); // Structr hook before content column.
				endif;

			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', 'page' );
			}

			if ( function_exists( 'struc_after_content_col_output' ) ) :
				struc_after_content_col_output(); // Structr hook after content column.
				endif;

			// Search results.
		} elseif ( is_search() ) {

			if ( function_exists( 'struc_before_content_col_output' ) ) :
				struc_before_content_col_output(); // Structr hook before content column.
				endif;

			get_template_part( 'template-parts/content', 'search' );

			if ( function_exists( 'struc_after_content_col_output' ) ) :
				struc_after_content_col_output(); // Structr hook after content column.
				endif;

			// Archives.
		} elseif ( is_archive() ) {

			if ( function_exists( 'struc_before_content_col_output' ) ) :
				struc_before_content_col_output(); // Structr hook before content column.
				endif;

			get_template_part( 'template-parts/content', 'archive' );

			if ( function_exists( 'struc_after_content_col_output' ) ) :
				struc_after_content_col_output(); // Structr hook after content column.
				endif;

			// Attachment pages.
		} elseif ( is_attachment() ) {

			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', 'attachment' );
			}

			// 404 error page.
		} elseif ( is_404() ) {

			if ( function_exists( 'struc_before_content_col_output' ) ) :
				struc_before_content_col_output(); // Structr hook before content column.
				endif;

			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/404', 'index' );
			}

			if ( function_exists( 'struc_after_content_col_output' ) ) :
				struc_after_content_col_output(); // Structr hook after content column.
				endif;

			// Anything Else.
		} else {

			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content', get_post_format() );
			}
		}
	} else {
		get_template_part( 'template-parts/content', 'none' );
	}
	?>
	</div>
<?php
}
