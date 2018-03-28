<?php
/** licenses-tab.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This file uses the STRUC_API to build the license key page for
 * the Structr Framework. This is a tab built off the main admin page.
 *
 * @package Structr
 * @since Structr 1.0
 */


// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * KEYS_SETTINGS class.
 *
 * @extends STRUC_API
 */
class KEYS_SETTINGS extends STRUC_API {

	/**
	 * construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function construct() {
		$this->group = 'keys';

		$this->admin_page = array(
			'parent_slug' => 'themes.php',
			'name' => __( 'License Keys', 'structr' ),
			'hide_menu'   => true,
		);

		$this->admin_tab = array(
			'save'     => true,
		);

	}



	/**
	 * admin_page function.
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
	 * fields function.
	 *
	 * @access public
	 * @return void
	 */
	public function fields() {
	?>

		<div id="poststuff" class="structr-content-wrap">

			<?php $this->desc( sprintf( __( 'License keys for all of your StructrPress products will be available on this page. <strong>To enable automatic updates you must be using a valid license key.</strong> All of your license keys can be found in your <a href="%s" target="_blank">StructrPress account</a>. If your license key has expired, please renew your license.', 'structr' ), STRUCTR_THEME_URI . '/downloads' ) ); ?>

			<!-- Hooked-in Licenses -->

			<table class="form-table">
				<tbody>

					<?php do_action( 'sp_hook_licenses' ); ?>

				</tbody>
			</table>

		</div>

	<?php }

}

$keys_settings = new KEYS_SETTINGS;
