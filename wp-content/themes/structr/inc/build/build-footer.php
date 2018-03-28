<?php
/** File: build-footer.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This is the main <footer> element of your site. It includes
 * up to four widget areas along with a copyright information bar.
 *
 * @package Structr
 * @since Structr 1.0
 */

/**
 * Function: structr_footer_element function.
 *
 * @access public
 * @return void
 */
function structr_footer_element() {
	global $structr_classes, $structr_cols, $structr_footer_choice, $structr_footer_widgets_choice;
	$footcols = struc_foot_col_class( $structr_classes ); ?>

	<?php
	if ( function_exists( 'struc_after_main_output' ) ) :
		struc_after_main_output(); // Structr hook after main content.
	endif;

	if ( function_exists( 'struc_foot_lead_area_output' ) ) :
		struc_foot_lead_area_output(); // Structr hook footer lead area.
	endif;
	?>

	<?php if ( 0 == $structr_footer_choice ) { ?>
		<div class="footer-area full">
		<?php if ( 0 == $structr_footer_widgets_choice ) { ?>
			<div class="inner">
				<footer class="site-footer">
					<div id="footer-columns" class="<?php echo ( esc_attr( $footcols ) ) ?> footer-widgets clearfix">
						<?php
						if ( function_exists( 'struc_foot_top_output' ) ) :
							struc_foot_top_output(); // Structr hook top of footer.
						endif;
						?>
						<div class="foot-col-inside clearfix">
							<?php if ( is_active_sidebar( 'struc-foot-col-1' ) ) { ?>
								<div class="foot-col col">
									<?php dynamic_sidebar( 'struc-foot-col-1' ); ?>
								</div>
							<?php } ?>
							<?php if ( is_active_sidebar( 'struc-foot-col-2' ) ) { ?>
								<div class="foot-col col">
									<?php dynamic_sidebar( 'struc-foot-col-2' ); ?>
								</div>
							<?php } ?>
							<?php if ( is_active_sidebar( 'struc-foot-col-3' ) ) { ?>
								<div class="foot-col col">
									<?php dynamic_sidebar( 'struc-foot-col-3' ); ?>
								</div>
							<?php } ?>
							<?php if ( is_active_sidebar( 'struc-foot-col-4' ) ) { ?>
								<div class="foot-col col">
									<?php dynamic_sidebar( 'struc-foot-col-4' ); ?>
								</div>
							<?php } ?>
						</div>
						<?php
						if ( function_exists( 'struc_foot_bottom_output' ) ) :
							struc_foot_bottom_output(); // Structr hook bottom of footer.
						endif;
						?>
					</div>
				</footer>
			</div>
		<?php } ?>
			<div class="site-info">
				<div class="inner">
					<span><?php echo wp_kses( get_theme_mod( 'structr_footer_copy', 'Built on the <a href="' . esc_url( __( 'http://structrpress.com/', 'structr' ) ) . '" target="_blank">' . sprintf( __( 'Structr Framework%s', 'structr' ),'' ) . '</a> for <a href="' . esc_url( __( 'http://wordpress.org/', 'structr' ) ) . '" target="_blank">' . sprintf( __( 'WordPress%s', 'structr' ),'' ) . '</a>, and made with love :)' ), 'structr' ); ?></span>

					<?php
					if ( function_exists( 'struc_site_info_output' ) ) :
						struc_site_info_output(); // Structr hook site info section.
					endif;
					?>
				</div>
			</div>
		</div><!-- footer-area -->

		<?php
		if ( function_exists( 'struc_after_html_output' ) ) :
			struc_after_html_output(); // Structr hook after html.
		endif;
		?>

	<?php }
}
