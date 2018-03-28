<?php
/** Template Name: Landing Page
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This landing page template will remove all sidebars & widget
 * areas from your page and leave you with a basic header, footer &
 * content area that can be populated in the post editor.
 *
 * @package Structr
 * @since Structr 1.0
 */

global $post, $structr_footer_choice;

$char = get_bloginfo( 'charset' );
$ping = get_bloginfo( 'pingback_url' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php echo $char; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php echo $ping; ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="header-area full">
		<div class="inner">
		<?php
		if ( function_exists( 'struc_head_top_output' ) ) :
			struc_head_top_output(); // Structr hook top of header
		endif;
		?>
			<header id="masthead" class="site-header">
				<div class="site-branding">
				<?php if ( get_theme_mod( 'structr_logo' ) ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo esc_url( get_theme_mod( 'structr_logo' ) ); ?>" alt="<?php echo esc_attr( $title ); ?>">
					</a>
				<?php else : ?>
					<h1 class="site-title"><a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php endif; ?>
				</div>
			</header>
		</div>
	</div><!-- header-area -->
	<div class="main-area full">
		<div class="inner">
			<div id="main-content" class="site-content">
				<?php structr_landing_columns(); ?>
			</div>
		</div>
	</div> <?php

	if ( 0 == $structr_footer_choice ) { ?>
		<div class="footer-area full">
			<div class="site-info">
				<div class="inner">
					<span> Structr Theme By: </span> <a href="<?php echo esc_url( __( 'https://webpagejourney.com.org/', 'structr' ) ); ?>"><?php printf( esc_html__( 'Thomas %s', 'structr' ), 'Soler' ); ?></a>
					<span class="sep"> | </span>
					<a href="<?php echo esc_url( __( 'http://structrpress.com/', 'structr' ) ); ?>"><?php printf( esc_html__( 'Built with the %s for WordPress', 'structr' ), 'Structr Framework' ); ?></a>
					
					<?php
					if ( function_exists( 'struc_site_info_output' ) ) :
						struc_site_info_output(); // Structr hook site info section
					endif;
					?>
					
				</div>
			</div>
		</div><!-- footer-area -->
	<?php }

	get_footer();
