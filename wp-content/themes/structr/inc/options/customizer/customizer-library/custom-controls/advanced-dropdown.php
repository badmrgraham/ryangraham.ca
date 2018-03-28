<?php
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

if ( ! class_exists( 'Structr_Control_Advanced_Dropdown' ) ) :
	class Structr_Control_Advanced_Dropdown extends WP_Customize_Control {
		public $type = 'family';
		private $fonts = false;

		public function render_content() {
			$font_choices = customizer_library_get_font_choices();

		?>
		<label>
			<span class="customize-control-title" style="display: inline-block;"><?php echo esc_html( $this->label . ' - ' ); ?><span class="font-amount"><?php _e( 'Choose from ', 'structr' ); ?><span class="font-totals"><?php echo count( $font_choices ); ?></span><?php _e( ' Fonts', 'structr' ); ?></span></span>
			<select class="chosen-select" <?php $this->link(); ?>>
				<?php
				foreach ( $font_choices as $value => $label ) {
					if ( 0 === $value || 1 === $value ) {
						echo '<option value="' . esc_attr( $value ) . '"' . 'disabled="disabled"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';

					} else {
						echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
					}
				}
				?>
			</select>
		</label>
		<script>
		jQuery(document).ready(function() {
		   jQuery('.chosen-select').chosen({width: "100%"});
		});
		</script>
		<?php
		}
	}
endif;
