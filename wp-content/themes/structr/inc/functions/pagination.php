<?php
/** pagination.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This handles the output of pagination on archive pages.
 *
 * @package Structr
 * @since Structr 1.0
 */


/**
 * structr_num_posts_nav function.
 *
 * @access public
 * @return void
 */
function structr_num_posts_nav() {

	if ( is_singular() ) {
		return;
	}

	global $wp_query;

	$big      = 999999999;
	$paginate = paginate_links( array(
		'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'    => '?paged=%#%',
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'mid_size' => apply_filters( 'structr_pagination_mid_size', 1 ),
		'prev_text' => '<i class="fa fa-angle-left"></i> ' . __( 'Previous', 'structr' ),
		'next_text' => __( 'Next', 'structr' ) . ' <i class="fa fa-angle-right"></i>',
		'total'     => $wp_query->max_num_pages,
	) );

	if ( $paginate ) : ?>
	<div class="inside-pagination numbered-nav">
		<div class="pagination">
			<?php echo $paginate; ?>
		</div>
	</div>

<?php endif;

}

// Show standard page navigation - Prev/Next - or pagination?
if ( ! function_exists( 'structr_content_nav' ) ) {
	function structr_content_nav( $nav_id ) {
		global $wp_query, $post;
		$nav_class = 'navigation post-navigation';

		$post_navigation = apply_filters( 'post_navigation', array(
			'older_posts'   => __( 'Older posts', 'structr' ),
			'newer_posts'   => __( 'Newer posts', 'structr' ),
		) );

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}
		?>
		<div class="inside-pagination prev-next-nav">
			<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
				<div class="nav-links">
				<?php
				if ( $wp_query->max_num_pages > 1 && (is_home() || is_archive() || is_search() ) ) {
					if ( get_next_posts_link() ) { ?>
							<div class="nav-previous">
								<?php next_posts_link( $post_navigation['older_posts'] ); ?>
							</div>
							<?php
					}
					if ( get_previous_posts_link() ) { ?>
							<div class="nav-next">
								<?php previous_posts_link( $post_navigation['newer_posts'] ); ?>
							</div>
							<?php
					}
				}
				?>
				</div>
			</nav>
		</div>
		<?php
	}
}
