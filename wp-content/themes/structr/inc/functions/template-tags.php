<?php
/** File: template-tags.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * Handles categorization, after-post output & comments.
 *
 * @package Structr
 * @since Structr 1.0
 */

/**
 * Function: structr_categorized_blog
 *
 * @access public
 * @return $all_the_cool_cats
 */
function structr_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'structr_categories' ) ) ) {

		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		) );

		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'structr_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats >= 1 ) {
		return true;
	} else {
		return false;
	}
}



if ( ! function_exists( 'structr_entry_footer' ) ) :
	/**
	 * Function: structr_entry_footer function.
	 *
	 * @access public
	 * @return void
	 */
	function structr_entry_footer() {
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( esc_html__( ', ', 'structr' ) );
			if ( $categories_list && structr_cats_after_on() ) {
				printf( wp_kses_post( '<p class="cat-links"><i class="fa fa-archive"></i> %1$s </p>', 'structr' ), wp_kses_post( $categories_list, 'structr' ) );
			}

			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'structr' ) );
			if ( $tags_list && structr_tags_after_on() ) {
				printf( wp_kses_post( '<p class="tags-links"><i class="fa fa-tags"></i> %1$s </p>', 'structr' ), wp_kses_post( $tags_list ) );
			}
		}
	}
endif;



if ( ! function_exists( 'structr_comment_template' ) ) :
	/**
	 * Function: structr_comment_template function.
	 *
	 * @access public
	 * @param mixed $comment comment content.
	 * @param mixed $args comment reply link.
	 * @param mixed $depth size of comment tree.
	 * @return void
	 */
	function structr_comment_template( $comment, $args, $depth ) {
		global $comment;
		$avatar_size = apply_filters( 'avatar_size', 26 );

		switch ( $comment->comment_type ) {

			case 'pingback' :
			case 'trackback' : ?>
				<div class="pingback">
					<span>
						<?php
						echo esc_html__( 'Pingback: ', 'structr' ),
						comment_author_link(),
						edit_comment_link( __( ' (Edit) ', 'structr' ) );
						?>
					</span>
				<?php
				break;

			default : ?>
				<div <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment-body">
						<footer class="comment-meta">
							<div class="comment-author vcard">
								<div class="comment-avatar">
									<?php echo get_avatar( $comment, $avatar_size ); ?>
								</div>
							</div>
							<?php
							if ( '0' === $comment->comment_approved ) : ?>
								<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'structr' ); ?></em><br />
								<?php
							endif;
							?>
							<div class="comment-meta commentmetadata">
								<cite class="fn"><?php echo esc_html_e( 'by ', 'structr' ) . get_comment_author_link(); ?></cite>
								<span class="comment-date">
									<i class="fa fa-clock-o" style="margin-right: 3px;"></i><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
										<time pubdate datetime="<?php comment_time( 'c' ); ?>"><?php echo get_comment_date(); ?></time>
									</a>
									<?php edit_comment_link( __( ' (Edit) ', 'structr' ) ); ?>
								</span>
							</div>
						</footer>
						<div class="comment-content">
							<?php comment_text(); ?>
						</div>
						<?php if ( comments_open() ) : ?>
							<div class="reply">
								<?php
								comment_reply_link(
									array_merge( $args, array(
										'reply_text'	=> '' . __( 'Reply', 'structr' ),
										'depth'			=> $depth,
										'max_depth'		=> $args['max_depth'],
									) )
								);
								?>
							</div>
						<?php endif; ?>
					</article>
				<?php
			break;
		}
	}
endif;


/**
 * Function: structr_category_transient_flusher function.
 *
 * @access public
 * @return void
 */
function structr_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	delete_transient( 'structr_categories' );
}
add_action( 'edit_category', 'structr_category_transient_flusher' );
add_action( 'save_post',     'structr_category_transient_flusher' );
