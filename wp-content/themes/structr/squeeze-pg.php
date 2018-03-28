<?php
/** Template Name: Squeeze Page
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This squeeze page template will remove all sidebars, widget areas,
 * header/footer elements, leaving just an article area for content.
 *
 * @package Structr
 * @since Structr 1.0
 */

global $post;

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
	<div class="main-area full">
		<div class="inner">
			<div id="main-content" class="site-content">
				<?php structr_landing_columns(); ?>
			</div>
		</div>
	</div> <?php

	get_footer();
