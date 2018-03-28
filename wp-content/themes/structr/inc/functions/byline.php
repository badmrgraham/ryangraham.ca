<?php
/** byline.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This file creates post bylines.
 *
 * @package Structr
 * @since Structr 1.0
 */

if ( ! function_exists( 'structr_posted_on' ) ) :
	function structr_posted_on() {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		if ( structr_byline_author_on() ) { ?>
			<span class="post-auth">
				<i class="fa fa-user"></i>
				<?php
				printf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_html( get_the_author() )
				);
				?>
			</span>
		<?php }

		if ( structr_byline_date_on() ) { ?>
			<span class="posted-on">
				<i class="fa fa-clock-o"></i>
				<?php
				printf( '<span class="date-pub">%2$s</span>',
					esc_url( get_permalink() ),
					$time_string
				);
				?>
			</span>
		<?php }

		if ( structr_byline_edit_on() ) { ?>
			<span class="post-edit">
			<?php edit_post_link( __( '<i class="fa fa-pencil"></i>Edit', 'structr' ), '<span class="edit-link"> ', '</span> ' ); ?>
			</span>
		<?php }

		if ( function_exists( 'struc_byline_info_output' ) ) :
			struc_byline_info_output(); // Structr hook last byline item
		endif;

		if ( structr_byline_comments_on() && ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><i class="fa fa-comments"></i><?php comments_popup_link( __( '0 Comments', 'structr' ), __( '1 Comment', 'structr' ), __( '% Comments', 'structr' ) ); ?></span>
		<?php endif;
	}


endif;
