<?php
/** Template: comments.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * The template for displaying Comments.
 *
 * @package Structr
 * @since Structr 1.0
 */

if ( post_password_required() ) {
	return;
} ?>

<div id="comments" class="comments-area">
	<div class="inside-content commentors">

		<?php if ( have_comments() ) : ?>

		<div class="comm-list">
			<h5 class="comments-title">
				<?php
				$count = get_comments_number();
				if ( 1 !== $count ) {
					printf( esc_html__( '%1$s responses to &ldquo;%2$s&rdquo;', 'structr' ), esc_html( number_format_i18n( $count ), 'structr' ), '<span><em>' . get_the_title() . '</em></span>' );
				} else {
					printf( esc_html( 'One response to &ldquo;%1$s&rdquo;', 'structr' ), '<span><em>' . get_the_title() . '</em></span>' );
				}
				?>
			</h5>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-above" class="navigation comment-navigation inside-pagination prev-next-nav" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'structr' ); ?></h2>
				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'structr' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'structr' ) ); ?></div>

				</div>
			</nav>
			<?php endif; ?>

			<div class="comment-list">
			<?php
				wp_list_comments( array(
					'style'		=> 'div',
					'callback'	=> 'structr_comment_template',
				) );
			?>
			</div>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below" class="navigation comment-navigation inside-pagination prev-next-nav" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'structr' ); ?></h2>
				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'structr' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'structr' ) ); ?></div>

				</div>
			</nav>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<?php if ( is_singular( array( 'post', 'page' ) ) ) : ?>
			<?php if ( ! comments_open() && ! have_comments() && ( 0 !== structr_closed_comm_on() ) ) : ?>
				<p class="disabled-comments"><?php esc_html_e( 'Comments have been closed/disabled for this content.', 'structr' ); ?></p>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( is_singular( array( 'post', 'page' ) ) ) : ?>
			<?php if ( ! comments_open() && have_comments() && ( 0 !== structr_closed_comm_on() ) ) : ?>
				<p class="disabled-comments has-comments"><?php esc_html_e( 'Comments have been closed/disabled for this content.', 'structr' ); ?></p>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( is_singular( array( 'post', 'page' ) ) ) : ?>
			<?php if ( comments_open() && '0' === get_comments_number() && ( 0 !== structr_empty_comm_on() ) ) : ?>
				<p class="empty-comments-notice">No comments have been made. Use <a href="<?php echo esc_url( __( '#respond', 'structr' ) ); ?>"><?php printf( esc_html__( 'this form ', 'structr' ) ); ?></a>to start the conversation :)</p>
			<?php endif; ?>
		<?php endif; ?>
	</div>

	<?php if ( comments_open() ) : ?>
	<div class="inside-content commentors-form">
		<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		comment_form(
			array(
				'id_form' => 'commentform',
				'id_submit' => 'submit',
				'title_reply' => __( 'Leave a Reply', 'structr' ),
				'title_reply_to' => __( 'Leave a Reply to %s', 'structr' ),
				'cancel_reply_link' => __( 'Cancel Reply', 'structr' ),
				'label_submit' => __( 'Post Comment', 'structr' ),
				'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
				'must_log_in' => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'structr' ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',
				'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'structr' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
				'comment_notes_before' => '',
				'comment_notes_after' => '',
				'fields' => apply_filters( 'comment_form_default_fields',
					array(
						'author' => '<p class="comment-form-author comment-form-field"><label for="author">' . __( 'Name', 'structr' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label><input id="author" name="author" type="text" placeholder="' . __( 'Enter Your Name', 'structr' ) . '"' . $aria_req . ' /></p>',
						'email' => '<p class="comment-form-email comment-form-field"><label for="email">' . __( 'Email', 'structr' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label><input id="email" name="email" type="text" placeholder="' . __( 'Enter Your Email', 'structr' ) . '"' . $aria_req . ' /></p>',
						'url' => '<p class="comment-form-url comment-form-field"><label for="url">' . __( 'Website', 'structr' ) . '</label><input id="url" name="url" type="text" placeholder="' . __( 'Enter Website URL', 'structr' ) . '" /></p>',
				) ),
		) );
		?>
	</div>
	<?php endif; ?>
</div><!-- #comments -->
