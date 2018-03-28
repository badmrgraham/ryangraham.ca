<?php
/** content-single.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This is the single content template for the Structr Framework.
 *
 * @package Structr
 * @since Structr 1.0
 */

global $structr_title_choice;
$post_page_nav = apply_filters( 'post_page_nav', __( 'Pages:', 'structr' ) ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemprop="blogPost" itemtype="http://schema.org/BlogPosting" itemscope="itemscope">
	<?php if ( has_post_thumbnail() && get_theme_mod( 'structr_feat_img_single', 1 ) == 1 ) : ?>
		<?php structr_feat_img_before_title(); ?>
	<?php endif; ?>

	<header class="entry-header">
		<div class="inside-hcontent">
		<?php
		if ( function_exists( 'struc_before_headline_output' ) ) :
			struc_before_headline_output(); // Structr hook before headline
		endif;
		?>
			<?php if ( 0 == $structr_title_choice ) { ?>
				<?php the_title( sprintf( '<h2 class="entry-title">', esc_url( get_permalink() ) ), '</h2>' ); ?>
			<?php } ?>
	
			<?php
			if ( structr_has_byline_items() ) { ?>
				<div class="byline entry-meta">
					<?php structr_posted_on(); ?>
				</div>
				<?php
			}
			?>
		</div>
	</header>
	
	<?php
	if ( function_exists( 'struc_after_byline_output' ) ) :
		struc_after_byline_output(); // Structr hook after byline
	endif;
	?>

	<div class="entry-content">
		<div class="inside-content">
			<?php
			the_content();

			wp_link_pages( array(
				'before' => '<nav class="page-links post-meta-footer">' . $post_page_nav,
				'after'  => '</nav>',
			) );
			?>
		</div>
	</div>
</article>
<?php
if ( structr_has_entry_footer() ) { ?>
	<div class="post-cats-tags">
		<div class="inside-cats-tags">
			<?php structr_entry_footer(); ?>
		</div>
	</div>
<?php
}
?>

<?php
if ( function_exists( 'struc_after_article_content_output' ) ) :
	struc_after_article_content_output(); // Structr hook after article content
endif;
?>

<?php
if ( get_theme_mod( 'structr_comment_posts', 1 ) == 1 ) {
	if ( ! comments_open() || comments_open() || '0' != get_comments_number() ) {
		comments_template( '', true );
	}
} ?>

<div class="inside-pagination prev-next-nav">
	<?php the_post_navigation(); ?>
</div>
