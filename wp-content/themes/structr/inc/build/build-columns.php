<?php
/** File: build-columns.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This file creates the main column layouts for standard & single pages.
 *
 * @package Structr
 * @since Structr 1.0
 */

/**
 * Function: structr_standard_content function.
 *
 * @access public
 * @return void
 */
function structr_standard_content() {
	?>
	<div class="main-area full">
		<div class="inner">
		<?php
		if ( function_exists( 'struc_before_content_output' ) ) :
			struc_before_content_output(); // Structr hook before content area.
		endif;
		?>
			<div id="main-content" class="site-content">
				<?php structr_columns(); ?>
			</div>
		<?php
		if ( function_exists( 'struc_after_content_output' ) ) :
			struc_after_content_output(); // Structr hook after content area.
		endif;
		?>
		</div>
	</div><!-- main-area -->
<?php
}
add_action( 'main_area', 'structr_standard_content' );

/**
 * Function: structr_singular_content function.
 *
 * @access public
 * @return void
 */
function structr_singular_content() {
	global $post; ?>
	<div class="main-area full">
		<div class="inner">
		<?php
		if ( function_exists( 'struc_before_content_output' ) ) :
			struc_before_content_output(); // Structr hook before content area.
		endif;
		?>
			<?php if ( has_post_thumbnail() && get_theme_mod( 'structr_feat_img_single', 1 ) == 1 ) : ?>
				<?php structr_feat_img_before_section(); ?>
			<?php endif; ?>
			<div id="main-content" class="site-content">
				<?php structr_columns_singular(); ?>
			</div>
		<?php
		if ( function_exists( 'struc_after_content_output' ) ) :
			struc_after_content_output(); // Structr hook after content area.
		endif;
		?>
		</div>
	</div><!-- main-area -->
<?php
}
add_action( 'main_area_singular', 'structr_singular_content' );
