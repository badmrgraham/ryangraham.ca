<?php
/** 404.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This is the 404 Not Found template for the Structr Framework.
 *
 * @package Structr
 * @since Structr 1.0
 */

$error_404 = apply_filters( 'error_404_content', array(
	'error_title'   => __( 'Oops! Looks like we have an error.', 'structr' ),
	'error_content' => __( 'Use the search form and other tools below to find what you were looking for.', 'structr' ),
) ); ?>

<?php
if ( function_exists( 'struc_before_content_col_output' ) ) :
	struc_before_content_col_output(); // Structr hook before content column
endif;
?>

<article id="post-0" class="post error404 not-found">
	<header class="entry-header">
		<div class="inside-hcontent">
		<?php
		if ( function_exists( 'struc_before_headline_output' ) ) :
			struc_before_headline_output(); // Structr hook before headline
		endif;
		?>
			<h2 class="entry-title"><?php echo $error_404['error_title']; ?></h2>
		</div>
	</header>
	<section class="error-404 not-found">
		<div class="page-content">
			<div class="inside-content">
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
			</div>
		</div>
	</section>
</article>

<?php
if ( function_exists( 'struc_after_content_col_output' ) ) :
	struc_after_content_col_output(); // Structr hook after content column
endif;
?>
