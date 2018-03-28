<?php
/** File: header.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This file includes everything inside the <head> section of your site
 * it also includes the 'top-menu' area and first Structr Hook location
 *
 * @package Structr
 * @since Structr 1.0
 */

global $structr_top_menu_choice;
$char = get_bloginfo( 'charset' );
$ping = get_bloginfo( 'pingback_url' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo esc_html( $char, 'structr' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php echo esc_url( $ping, 'structr' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'struc_before_html_output' ) ) :
		struc_before_html_output(); // Structr hook before html.
	endif;
	?>

	<?php if ( 0 == $structr_top_menu_choice ) { ?>
		<?php if ( get_theme_mod( 'structr_show_top_menu', 1 ) == 1 ) : ?>
		<div class="top-area full">
			<div class="inner">
				<nav id="site-navigation-top" class="top-navigation clear" role="navigation">
					<span class="menu-toggle" aria-controls="top-menu" aria-expanded="false"><?php esc_html_e( ' Menu', 'structr' ); ?></span>
					<?php wp_nav_menu( array( 'theme_location' => 'top', 'menu_id' => 'top-menu', 'fallback_cb' => 'structr_menu_home' ) ); ?>
				</nav>
			</div>
		</div><!-- top-area -->
		<?php endif; ?>
	<?php } ?>
