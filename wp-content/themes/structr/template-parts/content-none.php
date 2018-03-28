<?php
/** content-search.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This is the content-none template for the Structr Framework.
 *
 * @package Structr
 * @since Structr 1.0
 */

global $options;

if ( is_404() ) {
	get_template_part( 'template-parts/404', 'index' );
} else { ?>

	<?php
	if ( function_exists( 'struc_before_content_col_output' ) ) :
		struc_before_content_col_output(); // Structr hook before content column
	endif;
	?>
	<article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<div class="inside-hcontent">
			<?php
			if ( function_exists( 'struc_before_headline_output' ) ) :
				struc_before_headline_output(); // Structr hook before headline
			endif;
			?>
				<h2 class="entry-title"><?php esc_html_e( 'Nothing Found', 'structr' ); ?></h2>
			</div>
		</header>
		<section class="no-results not-found">
			<div class="page-content">
				<div class="inside-content">
					<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			
						<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'structr' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
			
					<?php elseif ( is_search() ) : ?>
			
						<p><?php esc_html_e( 'It looks like the page you\'re looking for isn\'t here! See if the tools below can help you find what you\'re looking for:', 'structr' ); ?></p>
						<h4><?php esc_html_e( 'Search this Website', 'structr' ); ?></h4>
						<p><?php esc_html_e( 'If you have an idea of what you\'re looking for, try typing in a few of the best keywords you can think of to get the most relevant search results possible.', 'structr' ); ?></p>
						<?php get_search_form(); ?>
						
						<?php the_widget( 'WP_Widget_Recent_Posts', 'title=Browse Latest Posts&sortby=post_modified', 'before_title=<h4>&after_title=</h4>' ); ?>
						
						<?php
							$instance = array(
								'title'    => __( 'Browse By Month', 'structr' ),
								'dropdown' => 1,
							);
							$args = array(
								'before_widget' => '<div class="content-item-404-archives">',
								'after_widget'  => '</div>',
								'before_title'  => '<h4>',
								'after_title'   => '</h4>',
							);

							the_widget( 'WP_Widget_Archives', $instance, $args );
						?>
			
					<?php else : ?>
			
						<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'structr' ); ?></p>
						<?php get_search_form(); ?>
			
					<?php endif; ?>
				</div>
			</div>
		</section>
	</article>
	<?php
	if ( function_exists( 'struc_after_content_col_output' ) ) :
		struc_after_content_col_output(); // Structr hook after content column
	endif;
	?>

<?php
}
