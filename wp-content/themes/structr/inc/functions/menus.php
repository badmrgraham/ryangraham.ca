<?php
/** File: menus.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This file bulds the main menu & assigns a fallback link if empty.
 *
 * @package Structr
 * @since Structr 1.0
 */

/**
 * structr_menu_home function.
 *
 * @access public
 * @return void
 */
function structr_menu_home() {
	?>
	<div class="menu-testing-menu-container">
		<ul class="menu nav-menu">
			<li class="menu-item">
				<a href="<?php echo esc_url( home_url( '/' ) . 'wp-admin/nav-menus.php' ); ?>" title="<?php echo get_bloginfo( 'description' ); ?>"><?php _e( 'Assign a Menu', 'structr' ); ?></a>
			</li>
		</ul>
	</div>
<?php }
