<?php
/** content-attachment.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This is the content-attachments template for the Structr Framework.
 *
 * @package Structr
 * @since Structr 1.0
 */

global $post, $options;
$metadata = wp_get_attachment_metadata();
$attachment_size = apply_filters( 'structr_attachment_size', array( 1200, 1200 ) );
$attachment_page_nav = apply_filters( 'attachment_page_nav', __( 'Pages:', 'structr' ) );
$attachment_navigation = apply_filters( 'attachment_navigation', array(
	'previous_image' => __( 'Previous', 'structr' ),
	'next_image'     => __( 'Next', 'structr' ),
	)
);
?>
<article style="border-bottom: none;" id="post-<?php echo the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="inside-hcontent">
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
			<div class="byline entry-meta">
				<span class="attachment-byline"><?php _e( 'Published ', 'structr' ); ?><span class="entry-date"><time class="entry-date" datetime="<?php esc_attr( get_the_date( 'c' ) ); ?>" pubdate><?php echo esc_html( get_the_date() ); ?></time></span> <?php _e( 'at ', 'structr' ); ?><a href="<?php wp_get_attachment_url(); ?>" title="Link to full-size image"><?php echo $metadata['width']; ?> &times; <?php echo $metadata['height']; ?></a> <?php _e( 'in ', 'structr' ); ?><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="Return to <?php echo get_the_title( $post->post_parent ); ?>" rel="gallery"><?php echo get_the_title( $post->post_parent ); ?></a></span>
			</div>
		</div>
	</header>
	<section class="entry-content">
		<div class="inside-content">
			<div class="entry-attachment">
				<div class="attachment">
					<?php
						$attachments = array_values( get_children( array(
							'post_parent'    => $post->post_parent,
							'post_status'    => 'inherit',
							'post_type'      => 'attachment',
							'post_mime_type' => 'image',
							'order'          => 'ASC',
							'orderby'        => 'menu_order ID',
						) ) );
						foreach ( $attachments as $k => $attachment ) {
							if ( $attachment->ID == $post->ID ) {
								break;
							}
						}
						$k++;

						if ( count( $attachments ) > 1 ) {
							( ( isset( $attachments[ $k ] ) ) ?
								$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID ) :
								$next_attachment_url = get_attachment_link( $attachments[0]->ID ) );
						} else {
							$next_attachment_url = wp_get_attachment_url();
						}
					?>
					<a href="<?php $next_attachment_url; ?>" title="<?php esc_attr( get_the_title() ); ?>" rel="attachment">
						<?php echo wp_get_attachment_image( $post->ID, $attachment_size ); ?>
					</a>
				</div>
				<?php
				if ( ! empty( $post->post_excerpt ) ) { ?>
						<div class="entry-caption">
							<?php the_excerpt() ?>
						</div>
						<?php
				}

					wp_link_pages( array(
						'before' => '<nav class="page-links post-meta-footer">' . $attachment_page_nav,
						'after'  => '</nav>',
					) );
				?>
			</div>
		</div>
	</section>
</article>
<div class="prev-next-nav">
	<nav class="post-navigation image-navigation clearfix">
		<div class="nav-previous image-nav border-box">
			<?php previous_image_link( false, $attachment_navigation['previous_image'] ); ?>
		</div>
		<div class="nav-next image-nav border-box">
			<?php next_image_link( false, $attachment_navigation['next_image'] ); ?>
		</div>
	</nav>
</div>
