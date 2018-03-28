<?php
/** File: build-header.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This is the main <header> element of your site.
 *
 * @package Structr
 * @since Structr 1.0
 */

/**
 * Function: structr_header_element function.
 *
 * @access public
 * @return void
 */
function structr_header_element() {
	global $structr_header_choice, $structr_main_menu_choice, $title; ?>

		<?php if ( 0 == $structr_header_choice ) { ?>
		<div class="header-area full">
			<div class="inner">
			<?php
			if ( function_exists( 'struc_head_top_output' ) ) :
				struc_head_top_output(); // Structr hook top of header.
			endif;
			?>
				<header id="masthead" class="site-header">
					<div class="site-branding">
					<?php if ( get_theme_mod( 'structr_logo', null ) ) : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url( get_theme_mod( 'structr_logo', null ) ); ?>" alt="<?php echo esc_attr( $title ); ?>">
						</a>
					<?php else : ?>
						<?php if ( 1 != get_theme_mod( 'structr_hide_title', 0 ) ) : ?>
						<h1 class="site-title"><a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php esc_html( bloginfo( 'name' ) ); ?></a></h1>
						<?php endif; ?>
						<?php if ( 1 != get_theme_mod( 'structr_hide_tagline', 0 ) ) : ?>
						<p class="site-description"><?php esc_html( bloginfo( 'description' ) ); ?></p>
						<?php endif; ?>
					<?php endif; ?>
					</div>

					<?php if ( 0 == $structr_main_menu_choice ) { ?>
						<?php if ( get_theme_mod( 'structr_show_main_menu', 1 ) == 1 ) : ?>
						<div class="main-menu-container inner">
							<nav id="site-navigation" class="main-navigation clear" role="navigation">
								<span class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( ' Menu', 'structr' ); ?></span>
								<?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => 'structr_menu_home', 'menu_id' => 'primary-menu' ) ); ?>
							</nav>
						</div>
						<?php endif; ?>
					<?php } ?>
				</header>
			<?php
			if ( function_exists( 'struc_head_bottom_output' ) ) :
				struc_head_bottom_output(); // Structr hook bottom of header.
			endif;
			?>
			</div>
		</div><!-- header-area -->
		<?php
		if ( function_exists( 'struc_head_lead_area_output' ) ) :
			struc_head_lead_area_output(); // Structr hook header lead area.
		endif;

		if ( function_exists( 'struc_before_main_output' ) ) :
			struc_before_main_output(); // Structr hook before main content.
		endif;
		?>
	<?php }
}
