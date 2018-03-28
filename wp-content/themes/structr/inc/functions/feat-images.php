<?php
/** feat-images.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This file handles the options & output of WordPress featured
 * images for posts/pages. There are numerous settings to save.
 *
 * @package Structr
 * @since Structr 1.0
 */


/**
 * move_feat_image_box function.
 *
 * @access public
 * @return void
 */
/*
function move_feat_image_box() {

	remove_meta_box( 'postimagediv', '', 'side' );

	add_meta_box( 'postimagediv', __( 'Featured Image Options', 'structr' ), 'post_thumbnail_meta_box', array( 'post', 'page', 'download' ), 'normal', 'high' );

}
add_action( 'do_meta_boxes', 'move_feat_image_box' );
*/


/**
 * structr_feat_img function.
 *
 * @access public
 * @param mixed $position (default: null)
 * @param mixed $size (default: null)
 * @param mixed $structr_atts (default: null)
 * @return void
 */
function structr_feat_img( $position = null, $size = null, $structr_atts = null ) {
	$position = ! empty( $position ) ? $position : structr_feat_img_position();
	$size     = ! empty( $size ) ? $size : structr_feat_img_size();
	$style    = '';

	$src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $size );
?>

	<div class="feat-img-container<?php echo structr_feat_img_alignment_classes( $position, $structr_atts ); ?>" <?php echo $style; ?>>
		<?php the_post_thumbnail( $size, array( 'class' => 'featured-img', 'itemprop' => 'image' ) ); ?>
		<?php structr_feat_img_caption(); ?>
	</div>

<?php }


/**
 * structr_feat_img_arch function.
 *
 * @access public
 * @param mixed $position_arch (default: null)
 * @param mixed $size (default: null)
 * @param mixed $structr_atts (default: null)
 * @return void
 */
function structr_feat_img_arch( $position_arch = null, $size = null, $structr_atts = null ) {
	$position_arch = ! empty( $position_arch ) ? $position_arch : structr_feat_img_position_arch();
	$size     = ! empty( $size ) ? $size : structr_feat_img_size_arch();
	$style    = '';

	$src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $size );
?>

	<div class="feat-img-container<?php echo structr_feat_img_alignment_classes_arch( $position_arch, $structr_atts ); ?>" <?php echo $style; ?>>
		<?php if ( get_theme_mod( 'structr_link_featured', 1 ) == 1 ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'structr' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
			<?php the_post_thumbnail( $size, array( 'class' => 'featured-img', 'itemprop' => 'image' ) ); ?>
			</a>
			<?php structr_feat_img_caption(); ?>

		<?php else : ?>
			<?php the_post_thumbnail( $size, array( 'class' => 'featured-img', 'itemprop' => 'image' ) ); ?>
			<?php structr_feat_img_caption(); ?>

		<?php endif; ?>
	</div>

<?php }


/**
 * structr_feat_img_caption function.
 *
 * @access public
 * @return void
 */
function structr_feat_img_caption() {
	$structr_caption = get_post_meta( get_the_ID(), 'structr_feat_img_caption', true );
	$structr_image   = get_posts( array(
			'p'         => get_post_thumbnail_id( get_the_ID() ),
			'post_type' => 'attachment',
	) );
?>
	<?php if ( isset( $structr_caption['add'] ) && $structr_image[0]->post_title ) : ?>
		<span class="feat-img-caption"><?php echo $structr_image[0]->post_title; ?></span>
	<?php endif; ?>

<?php }


/**
 * structr_feat_img_before_section function.
 *
 * @access public
 * @return void
 */
function structr_feat_img_before_section() {
	global $structr_atts;
	$position = structr_feat_img_position();
	$style = structr_feat_img_style();
?>

	<?php if ( 'before_section_fixed' == $position ) : ?>
		<div class="feat-img-container<?php echo structr_feat_img_alignment_classes( $position, $structr_atts ); ?>" <?php echo $style; ?>>
			<?php structr_feat_img_caption(); ?>
		</div>
	<?php elseif ( 'before_section' == $position ) : ?>
		<?php structr_feat_img(); ?>
	<?php endif; ?>

<?php }


/**
 * structr_feat_img_before_title function.
 *
 * @access public
 * @return void
 */
function structr_feat_img_before_title() {
	global $structr_atts;
	$position = structr_feat_img_position();
	$style = structr_feat_img_style();
?>

	<?php if ( 'before_title_fixed' == $position ) : ?>
		<div class="feat-img-container<?php echo structr_feat_img_alignment_classes( $position, $structr_atts ); ?>" <?php echo $style; ?>>
			<?php structr_feat_img_caption(); ?>
		</div>
	<?php elseif ( 'before_title' == $position ) : ?>
		<?php structr_feat_img(); ?>
	<?php endif; ?>

<?php }


/**
 * structr_feat_img_before_title_arch function.
 *
 * @access public
 * @return void
 */
function structr_feat_img_before_title_arch() {
	global $structr_atts;
	$style = structr_feat_img_arch_style();
	$position_arch = structr_feat_img_position_arch();
?>

	<?php if ( 'before_title_arch_fixed' == $position_arch ) : ?>
		<?php if ( get_theme_mod( 'structr_link_featured', 1 ) == 1 ) : ?>
			<div class="feat-img-container<?php echo structr_feat_img_alignment_classes_arch( $position_arch, $structr_atts ); ?>" <?php echo $style; ?>>
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'structr' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"></a>
			<?php structr_feat_img_caption(); ?>
			</div>
		<?php else : ?>
			<div class="feat-img-container<?php echo structr_feat_img_alignment_classes_arch( $position_arch, $structr_atts ); ?>" <?php echo $style; ?>>
				<?php structr_feat_img_caption(); ?>
			</div>
		<?php endif; ?>
	<?php elseif ( 'before_title_arch' == $position_arch ) : ?>
		<?php structr_feat_img_arch(); ?>
	<?php endif; ?>
<?php }


/**
 * structr_feat_img_position function.
 *
 * @access public
 * @return void
 */
function structr_feat_img_position() {
	return get_post_meta( get_the_ID(), 'structr_feat_img_position', true );
}


/**
 * structr_feat_img_position_arch function.
 *
 * @access public
 * @return void
 */
function structr_feat_img_position_arch() {
	return get_post_meta( get_the_ID(), 'structr_feat_img_position_arch', true );
}


/**
 * structr_feat_img_size function.
 *
 * @access public
 * @return void
 */
function structr_feat_img_size() {
	$position = structr_feat_img_position();

	if ( 'before_section' == $position || 'before_title' == $position || 'before_title_fixed' == $position ) {
		return 'full';
	} else { return 'large';
	}
}


/**
 * structr_feat_img_size_arch function.
 *
 * @access public
 * @return void
 */
function structr_feat_img_size_arch() {
	$position_arch = structr_feat_img_position_arch();

	if ( 'before_title_arch' == $position_arch || 'before_title_arch_fixed' == $position_arch ) {
		return 'full';
	} else { return 'large';
	}
}


/**
 * structr_feat_img_style function.
 *
 * @access public
 * @param mixed $url (default: null)
 * @param mixed $size (default: null)
 * @return void
 */
function structr_feat_img_style( $url = null, $size = null ) {
	$size = isset( $size ) ? $size : 'large';
	$structr_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $size );
	$url  = ! empty( $url ) ? $url : $structr_image[0];
	$the_id = get_post_custom( get_the_ID() );
	$feat_img_height = isset( $the_id['feat_img_height'] ) ? esc_attr( $the_id['feat_img_height'][0] ) : 300;

	return ' style="background-image: url(\'' . $url . '\'); height: ' . $feat_img_height . 'px;"';
}


/**
 * structr_feat_img_arch_style function.
 *
 * @access public
 * @param mixed $url (default: null)
 * @param mixed $size (default: null)
 * @return void
 */
function structr_feat_img_arch_style( $url = null, $size = null ) {
	$size = isset( $size ) ? $size : 'large';
	$structr_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $size );
	$url  = ! empty( $url ) ? $url : $structr_image[0];
	$the_id = get_post_custom( get_the_ID() );
	$feat_img_arch_height = isset( $the_id['feat_img_arch_height'] ) ? esc_attr( $the_id['feat_img_arch_height'][0] ) : 250;

	return ' style="background-image: url(\'' . $url . '\'); height: ' . $feat_img_arch_height . 'px;"';
}


/**
 * structr_feat_img_alignment_classes function.
 *
 * @access public
 * @param mixed $position
 * @param mixed $structr_atts
 * @return void
 */
function structr_feat_img_alignment_classes( $position, $structr_atts ) {

	if ( 'before_section' == $position ) {
		return ' before-section';
	} elseif ( 'before_title' == $position ) {
		return ' before-title';
	} elseif ( 'before_title_fixed' == $position ) {
		return ' before-title-fixed';
	} else { return;
	}
}


/**
 * structr_feat_img_alignment_classes_arch function.
 *
 * @access public
 * @param mixed $position_arch
 * @param mixed $structr_atts
 * @return void
 */
function structr_feat_img_alignment_classes_arch( $position_arch, $structr_atts ) {

	if ( 'before_title_arch' == $position_arch ) {
		return ' before-title';
	} elseif ( 'before_title_arch_fixed' == $position_arch ) {
		return ' before-title-fixed';
	} else { return;
	}
}
