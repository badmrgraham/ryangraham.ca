<?php
/** content-search.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This is the content-search template for the Structr Framework.
 *
 * @package Structr
 * @since Structr 1.0
 */

global $post;

$search_title = apply_filters( 'search_title', __( 'Search Results for:', 'structr' ) ); ?>

<header class="page-header">
	<div class="archive-head">
		<h2 class="entry-title">
			<?php echo $search_title, ' <span>', get_search_query(), '</span>'; ?>
		</h2>
	</div>
</header>
<?php
while ( have_posts() ) {
	the_post();
	get_template_part( 'template-parts/content', get_post_format() );
}

if ( get_theme_mod( 'structr_home_pagi', 1 ) == 1 ) {

	structr_num_posts_nav();

} else {

	structr_content_nav( 'home-nav' );

}
