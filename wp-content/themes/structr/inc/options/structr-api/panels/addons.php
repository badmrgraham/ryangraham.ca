<?php
/** File: addons.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This file uses the STRUC_API to build the addons admin page for
 * the Structr Framework. This is a tab built for displaying addons.
 *
 * @package Structr
 * @since Structr 1.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ADDONS_SETTINGS class.
 *
 * @extends STRUC_API
 */
class ADDONS_SETTINGS extends STRUC_API {

	/**
	 * Function: construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function construct() {
		$this->group = 'addons';

		$this->admin_page = array(
			'parent_slug' => 'themes.php',
			'name' => __( 'Addons', 'structr' ),
			'hide_menu'   => true,
		);

		$this->admin_tab = array(
			'save'     => false,
		);
	}


	/**
	 * Function: admin_page function.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_page() {
	?>

		<div class="wrap structr">

			<?php $this->admin_header(); ?>

			<form id="structr-form" method="post" action="options.php">
				<?php do_action( "{$this->group}_admin_tab_content" ); ?>
			</form>

		</div>

	<?php }



	/**
	 * Function: fields function.
	 *
	 * @access public
	 * @return void
	 */
	public function fields() {
		$button_text = ! empty( $addon['button_text'] ) ? $addon['button_text'] : __( 'Get Addon', 'structr' );
		$button_classes = ! empty( $addon['button_classes'] ) ? ' ' . $addon['button_classes'] : '';
		$addons = array(
			'0' => array(
					'name' => __( 'Structr Blocks - Page Builder', 'structr' ),
					'id' => 'struc_blocks_setup',
					'package' => 'structr_package_blocks',
					'url' => esc_url( 'http://structrpress.com/downloads/structr-blocks/' ),
					'desc'  => __( 'A page builder without the fluff. Create blocks, add content to them & re-order them at will. Makes the creation of sales pages a breeze!', 'structr' ),
					'img' => get_template_directory_uri() . '/img/structrpress-banner.png',

			),
			'10' => array(
					'name' => __( 'Structr Hooks - Visual Guide', 'structr' ),
					'id' => 'struc_hooks_setup',
					'package' => 'structr_package_hooks',
					'url' => esc_url( 'http://structrpress.com/downloads/structr-hooks/' ),
					'desc'  => __( 'Fine tune your StructrPress website using the Simple Hooks addon. Just activate the plugin & enjoy the visual hooks editor options.', 'structr' ),
					'img' => get_template_directory_uri() . '/img/structrpress-banner.png',

			),
			'20' => array(
					'name' => __( 'Structr Blog - Pro Layouts', 'structr' ),
					'id' => 'struc_blog_setup',
					'package' => 'structr_package_blog',
					'url' => esc_url( 'https://structrpress.com/downloads/structr-blog/' ),
					'desc'  => __( 'Customize layouts even further with Structr Blog. Create grid column layouts up to 5 columns + Masonry grids up to 3 columns.', 'structr' ),
					'img' => get_template_directory_uri() . '/img/structrpress-banner.png',

			),
		);

		?>
		<div class="wrap addons-wrap">
			<div class="form-table structr-features">
				<div id="addon-columns" class="three-col-addons">
					<?php
					foreach ( $addons as $addon ) {
						if ( ! function_exists( $addon['id'] ) ) :
							echo
							'<div class="addon-col col addon-inactive">
								<div class="addon-col-inside">
									<a title="' . esc_attr( $addon['name'], 'structr' ) . ': ' . esc_attr( 'Not activated.', 'structr' ) . '" href="' . esc_url( $addon['url'], 'structr' ) . '" target="_blank"><img src="' . esc_url( $addon['img'], 'structr' ) . '" alt="' . esc_attr( $addon['name'], 'structr' ) . '" />
									</a>
									<h4>' . esc_html( $addon['name'], 'structr' ) . '</h4>
				
									<p>' . esc_html( $addon['desc'], 'structr' ) . '</p>
									
									<p class="the-state red"><span class="dashicons dashicons-no"></span> ' . esc_html( 'Not Installed', 'structr' ) . '</p>';

							if ( ! empty( $addon['url'] ) ) :
								echo '<a href="' . esc_url( $addon['url'], 'structr' ) . '" class="button' . esc_attr( $button_classes, 'structr' ) . '" target="_blank">' . esc_html( $button_text, 'structr' ) . '</a>';
									endif;
								echo
								'</div>
							</div>';
						elseif ( function_exists( $addon['id'] ) ) :
							echo
							'<div class="addon-col col addon-active">
								<div class="addon-col-inside">
									<a title="' . esc_attr( $addon['name'], 'structr' ) . ': ' . esc_attr( 'Activated.', 'structr' ) . '" href="' . esc_url( $addon['url'], 'structr' ) . '" target="_blank"><img src="' . esc_url( $addon['img'], 'structr' ) . '" alt="' . esc_attr( $addon['name'], 'structr' ) . '" />
									</a>
									<h4>' . esc_html( $addon['name'], 'structr' ) . '</h4>
				
									<p>' . esc_html( $addon['desc'], 'structr' ) . '</p>
				
									<p class="the-state green"><span class="dashicons dashicons-yes"></span> ' . esc_html( 'Installed', 'structr' ) . '</p>
		
								</div>
							</div>';
						endif;
					}
					?>
				</div>
			</div>
		</div>

	<?php }
}

$addons_settings = new ADDONS_SETTINGS;
