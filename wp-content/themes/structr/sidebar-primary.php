<?php
/** sidebar-primary.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * Primary sidebar area (on the right) with widget areas & hooks
 *
 * @package Structr
 * @since Structr 1.0
 */
?>

<div id="aside-one" class="widget-area sidebars sidebar-one border-box" role="complementary">
	<?php
	if ( function_exists( 'struc_before_primary_sb_output' ) ) :
		struc_before_primary_sb_output(); // Structr hook before primary sidebar
	endif;

		// Display Sidebar 1 only if there is no post/page specific sidebar with content
		$singular_sidebar_1 = get_post_meta( get_the_ID(), '_create-sidebar-1', true );
	if ( '' !== $singular_sidebar_1 || 0 !== $singular_sidebar_1 ) {
		if ( ! dynamic_sidebar( 'sidebar-1-' . get_the_ID() ) ) {
			if ( ! dynamic_sidebar( 'sidebar-1' ) ) {
				structr_default_widget();
			}
		}
	} else {
		if ( ! dynamic_sidebar( 'sidebar-1' ) ) {
			structr_default_widget();
		}
	}

	if ( function_exists( 'struc_after_primary_sb_output' ) ) :
		struc_after_primary_sb_output(); // Structr hook after primary sidebar
	endif;
	?>
</div>
