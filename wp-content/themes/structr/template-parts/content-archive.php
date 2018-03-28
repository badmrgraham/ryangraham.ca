<?php
/** content-archive.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This is the content-archive template for the Structr Framework.
 *
 * @package Structr
 * @since Structr 1.0
 */

?>
<header class="page-header">
	<div class="archive-head">
		<h2 class="entry-title">
			<?php
			if ( is_category() ) :
				single_cat_title();

				elseif ( is_tag() ) :
					single_tag_title();

				elseif ( is_author() ) :

					the_post();
					echo get_avatar( get_the_author_meta( 'ID' ), 32 );
					printf( __( ' Articles by %s', 'structr' ), '<span class="vcard">' . get_the_author() . '</span>' );

					rewind_posts();

				elseif ( is_day() ) :
					printf( __( 'Day: %s', 'structr' ), '<span>' . get_the_date() . '</span>' );

				elseif ( is_month() ) :
					printf( __( 'Month: %s', 'structr' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

				elseif ( is_year() ) :
					printf( __( 'Year: %s', 'structr' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

				elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
					_e( 'Asides', 'structr' );

				elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
					_e( 'Images', 'structr' );

				elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
					_e( 'Videos', 'structr' );

				elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
					_e( 'Quotes', 'structr' );

				elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
					_e( 'Links', 'structr' );

				else :
					_e( 'Archives', 'structr' );

				endif;
			?>
		</h2>
		<?php
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>
	</div>
</header>
<?php

while ( have_posts() ) : the_post();
	get_template_part( 'template-parts/content', get_post_format() );
endwhile;

if ( get_theme_mod( 'structr_home_pagi', 1 ) == 1 ) {

	structr_num_posts_nav();

} else {

	structr_content_nav( 'home-nav' );

}
