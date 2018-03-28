<?php
/**
 * editor Customizer Control.
 *
 * Creates a TinyMCE textarea.
 *
 * @package     Kirki
 * @subpackage  Controls
 * @copyright   Copyright (c) 2015, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Early exit if the class already exists
if ( ! class_exists( 'Structr_Customize_Control_Editor' ) ) {
	return;
}

class Structr_Customize_Control_Editor extends WP_Customize_Control {

	  /**
	   * Render the content on the theme customizer page
	   */
	public function render_content() {
		?>
		<label>
		  <span class="customize-control-title customize-text_editor"><?php echo esc_html( $this->label ); ?></span>
		  <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>">
			<?php
				$settings = array(
				'textarea_name' => $this->id,
				'media_buttons' => false,
				'drag_drop_upload' => false,
				'teeny' => false,
			);
			wp_editor( $this->value(), $this->id, $settings );

			do_action( 'admin_footer' );
			do_action( 'admin_print_footer_scripts' );

				?>
				</label>
			<?php
	}
}
