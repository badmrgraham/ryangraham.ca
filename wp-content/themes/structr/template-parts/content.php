<?php
/** content.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This is the main content template for the Structr Framework.
 *
 * @package Structr
 * @since Structr 1.0
 */


$more_link_text = apply_filters( 'more_link_text', esc_html( get_theme_mod( 'structr_excerpt_link_text', __( 'Read More', 'structr' ) . ' &rarr;' ) ) );
$feed_tags_text = apply_filters( 'feed_tags_text', __( 'Tags: ', 'structr' ) );
$feed_post_page_nav = apply_filters( 'feed_post_page_nav', __( 'Pages: ', 'structr' ) ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemprop="blogPost" itemtype="http://schema.org/BlogPosting" itemscope="itemscope">
	<?php if ( has_post_thumbnail() && get_theme_mod( 'structr_feat_img_home', 1 ) == 1 ) : ?>
		<?php structr_feat_img_before_title_arch(); ?>
	<?php endif; ?>
	
	<header class="entry-header">
		<div class="inside-hcontent">
		<?php
		if ( function_exists( 'struc_before_headline_output' ) ) :
			struc_before_headline_output(); // Structr hook before headline
		endif;
		?>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	
			<?php
			if ( 'post' === get_post_type() ) {
				if ( structr_has_byline_items() ) { ?>
					<div class="byline entry-meta">
						<?php structr_posted_on(); ?>
					</div>
					<?php
				}
			}
			?>
		</div>
	</header>
	
	<?php
	if ( function_exists( 'struc_after_byline_output' ) ) :
		struc_after_byline_output(); // Structr hook after byline
	endif;
	?>
	
	<?php if ( is_search() || get_theme_mod( 'structr_post_excerpts' ) !== 0 ) :
		global $structr_caption, $structr_image;
	?>
		<div class="entry-summary">
			<div class="inside-content">
				<?php the_excerpt(); ?>
			</div>
		</div>
		<?php else : ?>
		<div class="entry-content">
			<div class="inside-content">
				<?php
				the_content( $more_link_text );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'structr' ),
					'after'  => '</div>',
				) );
				?>
			</div>
		</div>
	<?php endif; ?>
</article>
