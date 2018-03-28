<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

class Structr_Customizer_Range_Slider extends WP_Customize_Control {
	public $type = 'range-slider';

	/**
	 * Render the control's content.
	 */
	public function render_content() {
		$id    = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
		$class = 'customize-control customize-control-' . $this->type;

			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( ! empty( $this->description ) ) : ?>
					<p><span class="description customize-control-description"><?php echo $this->description; ?></span></p>
				<?php endif; ?>
				<input <?php $this->link(); ?> type="range" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" class="mailtpl_range" />
				<div class="spinner-arr"><input id="input_<?php echo $this->id; ?>" class="font_value control-right" type="number" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> /></div><span class="px-label">px</span><span class="words-label">words</span>
			</label>
			<?php
	}
}



class Structr_Customizer_Width_Range_Slider extends WP_Customize_Control {
	public $type = 'range-width';

	/**
	 * Render the control's content.
	 */
	public function render_content() {
		$id    = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
		$class = 'customize-control customize-control-' . $this->type;

			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?><span class="cust-r-arrow"><span class="dashicons dashicons-arrow-right-alt"></span></span></span>
				<div class="spinner-arr"><input id="input_<?php echo $this->id; ?>" class="font_value" type="number" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> /></div><span class="px-label">px</span>
				<input <?php $this->link(); ?> type="range" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" class="mailtpl_range" />
			</label>
			<?php
	}
}
