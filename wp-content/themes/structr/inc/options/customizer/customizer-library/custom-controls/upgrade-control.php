<?php
/**
 * Add controls for upgrading to Structr Premium
 *
 * @package 	Customizer_Library
 * @since 1.0.0
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

if ( ! class_exists( 'Structr_Customize_Upgrades' ) ) :
	class Structr_Customize_Upgrades extends WP_Customize_Control {
		public $description = '';
		public $url = '';
		public $type = 'upgrade';

		public function render_content() {
			?>
			<hr class="upgrade-hr" />
			<span class="upgrade-premium"><?php echo sprintf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( $this->url ), __( 'Upgrade to Premium','structr' ) ) ?></span>
			<p class="description customize-control-description" style="margin-top:5px;"><?php echo $this->description ?></p>
			<?php
		}
	}
endif;
