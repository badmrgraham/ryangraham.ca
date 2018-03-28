<?php
/** content-page.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This is the content-page template for the Structr Framework.
 *
 * @package Structr
 * @since Structr 1.0
 */

global $structr_title_choice ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<?php structr_feat_img_before_title(); ?>
	<?php endif; ?>
	<?php if ( 0 == $structr_title_choice ) { ?>
	<header class="entry-header">
		<div class="inside-hcontent">
		<?php
		if ( function_exists( 'struc_before_headline_output' ) ) :
			struc_before_headline_output(); // Structr hook before headline
		endif;
		?>
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		</div>
		<?php } ?>
	</header>

	<div class="entry-content">
		<div class="inside-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'structr' ),
					'after'  => '</div>',
				) );
			?>
		</div>
	</div>
</article>
<?php

if ( get_theme_mod( 'structr_comment_pages', 0 ) == 1 ) {
	if ( comments_open() || '0' != get_comments_number() ) {
		comments_template( '', true );
	}
}
