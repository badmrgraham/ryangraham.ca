<?php
/** File: main-page.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This file uses the STRUC_API to build the main admin page for
 * the Structr Framework. It includes info & more about Structr.
 *
 * @package Structr
 * @since Structr 1.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * SP_SETTINGS class.
 *
 * @extends STRUC_API
 */
class SP_SETTINGS extends STRUC_API {

	/**
	 * Function: construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function construct() {
		$this->group = 'sp';

		$this->admin_page = array(
			'name'        => __( 'Stuctr Settings', 'structr' ),
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
		$screen = get_current_screen();
	?>
	<div class="wrap upgrade-wrap">
		<h2 class="headline" style="font-weight: bold;"><?php echo sprintf( wp_kses_post( 'Hello and Welcome to the %1$s Guide Panel!', 'structr' ), esc_html( STRUCTR_THEME_NAME ) ); ?></h2>
		<p>
			<?php echo wp_kses_post( 'First and foremost, <strong>THANK YOU</strong> for your interest in using the <strong>StructrPress Theme</strong> to build your <a href="http://wordpress.org/" target="_blank">WordPress</a> powered website! I can\'t tell you how much it means to me being able to provide a valuable tool to others and make their <em>WordPress building process</em> a pleasure, rather than a pain.', 'structr' );
			?>
		</p>
		<?php
		// The Regular Expression filter.
		$regex_url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';

		// Paragraph number two.
		$par_two = __( '<p>The theme panel gives an introduction to the <strong>StructrPress Theme</strong> and a few handy tips for making the most of your experience using it. You can find more in-depth information/documentation/tutorials on the https://structrpress.com/ The theme panel will evolve over time, as more features are developed.</p>', 'structr' );

		// Paragraph number three.
		$par_three = __( '<p><span>For now, check out the https://structrpress.com/ to see all the current extensions available for use with <strong>Structr</strong>, or visit the </span>', 'structr' );

		$par_three_two = __( '<span>https://structrpress.com/ to learn more about the framework and everything you can do with it. Documentation, tutorials and more extensions are currently being developed, so stay tuned!</span></p>', 'structr' );

		// Check if there is a url in the text.
		if ( preg_match( $regex_url, $par_two, $url_one ) || preg_match( $regex_url, $par_three, $url_one ) || preg_match( $regex_url, $par_three_two, $url_one ) ) {
			// make the urls hyper links.
			echo wp_kses_post( preg_replace( $regex_url, '<a href="' . $url_one[0] . '">StructrPress website</a>.', $par_two ), 'structr' );
			echo wp_kses_post( preg_replace( $regex_url, '<a href="' . $url_one[0] . 'wp-admin/themes.php?page=addons/">Addons Tab</a>', $par_three ), 'structr' );
			echo wp_kses_post( preg_replace( $regex_url, '<a href="' . $url_one[0] . '">StructrPress website</a>', $par_three_two ), 'structr' );
		} else {
			// if no urls in the text just return the text.
			echo wp_kses_post( $par_two, 'structr' );
			echo wp_kses_post( $par_three, 'structr' );
			echo wp_kses_post( $par_three_two, 'structr' );
		}
		?>
		<div class="screenshot">
			<img class="structr-screenshot" src="<?php echo esc_url( STRUCTR_THEME_DIR_URI, 'structr' ) . '/screenshot.png'; ?>" alt="Structr">
		</div>
	</div>

	<?php }

}

$sp_settings = new SP_SETTINGS;
