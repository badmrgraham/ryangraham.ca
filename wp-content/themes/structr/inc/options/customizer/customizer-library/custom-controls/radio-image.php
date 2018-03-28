<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Structr_Customizer_Radio_Image class.
 *
 * @extends WP_Customize_Control
 */

class Structr_Customizer_Radio_Image extends WP_Customize_Control {

	public $type = 'radio-image';



	public function render_content() {
		?>
		<div id="input_structr_content_layout" class="layout-radio-img">
			<div class="radio-set">
				<input class="img-radio image-select" type="radio" value="c1" id="structr_content_layout_c1" name="_customize-radio-structr_content_layout" <?php $this->link();
				checked( $this->value(), 'c1' ); ?>>
					<label for="structr_content_layout_c1">
						<img class="button-img" src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/c1.png" alt="c1" title="c1">
						<span class="radio-label">FULL / NO SB</span>
					</label>
				</input>
			</div>
			<div class="radio-set">
				<input class="img-radio image-select" type="radio" value="cs" id="structr_content_layout_cs" name="_customize-radio-structr_content_layout" <?php $this->link();
				checked( $this->value(), 'cs' ); ?>>
					<label for="structr_content_layout_cs">
						<img class="button-img" src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/cs.png" alt="cs" title="cs">
						<span class="radio-label">MAIN / SB</span>
					</label>
				</input>
			</div>
			<div class="radio-set">
				<input class="img-radio image-select" type="radio" value="sc" id="structr_content_layout_sc" name="_customize-radio-structr_content_layout" <?php $this->link();
				checked( $this->value(), 'sc' ); ?>>
					<label for="structr_content_layout_sc">
						<img class="button-img" src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/sc.png" alt="sc" title="sc">
						<span class="radio-label">SB / MAIN</span>
					</label>
				</input>
			</div>
			<div class="radio-set">
				<input class="img-radio image-select disabled" disabled="disabled" type="radio" value="c2" id="structr_content_layout_c2" name="_customize-radio-structr_content_layout" <?php $this->link();
				checked( $this->value(), 'c2' ); ?>>
					<label for="structr_content_layout_c2">
						<img class="button-img disabled" src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/c2.png" alt="c2" title="c2">
						<span class="premium-disabled">PREMIUM</span>
						<span class="radio-label">SB's UNDER</span>
					</label>
				</input>
			</div>
			<div class="radio-set">
				<input class="img-radio image-select disabled" disabled="disabled" type="radio" value="c3" id="structr_content_layout_c3" name="_customize-radio-structr_content_layout" <?php $this->link();
				checked( $this->value(), 'c3' ); ?>>
					<label for="structr_content_layout_c3">
						<img class="button-img disabled" src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/c3.png" alt="c3" title="c3">
						<span class="premium-disabled">PREMIUM</span>
						<span class="radio-label">SB's ABOVE</span>
					</label>
				</input>
			</div>
			<div class="radio-set">
				<input class="img-radio image-select disabled" disabled="disabled" type="radio" value="css" id="structr_content_layout_css" name="_customize-radio-structr_content_layout" <?php $this->link();
				checked( $this->value(), 'css' ); ?>>
					<label for="structr_content_layout_css">
						<img class="button-img disabled" src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/css.png" alt="css" title="css">
						<span class="premium-disabled">PREMIUM</span>
						<span class="radio-label">MAIN / SB / SB</span>
					</label>
				</input>
			</div>
			<div class="radio-set">
				<input class="img-radio image-select disabled" disabled="disabled" type="radio" value="scs" id="structr_content_layout_scs" name="_customize-radio-structr_content_layout" <?php $this->link();
				checked( $this->value(), 'scs' ); ?>>
					<label for="structr_content_layout_scs">
						<img class="button-img disabled" src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/scs.png" alt="scs" title="scs">
						<span class="premium-disabled">PREMIUM</span>
						<span class="radio-label">SB / MAIN / SB</span>
					</label>
				</input>
			</div>
			<div class="radio-set">
				<input class="img-radio image-select disabled" disabled="disabled" type="radio" value="ssc" id="structr_content_layout_ssc" name="_customize-radio-structr_content_layout" <?php $this->link();
				checked( $this->value(), 'ssc' ); ?>>
					<label for="structr_content_layout_ssc">
						<img class="button-img disabled" src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/ssc.png" alt="ssc" title="ssc">
						<span class="premium-disabled">PREMIUM</span>
						<span class="radio-label">SB / SB / MAIN</span>
					</label>
				</input>
			</div>
			<div class="radio-set">
				<input class="img-radio image-select disabled" disabled="disabled" type="radio" value="csb" id="structr_content_layout_csb" name="_customize-radio-structr_content_layout" <?php $this->link();
				checked( $this->value(), 'csb' ); ?>>
					<label for="structr_content_layout_csb">
						<img class="button-img disabled" src="<?php echo STRUCTR_THEME_DIR_URI ?>/inc/options/customizer/customizer-library/assets/img/csb.png" alt="csb" title="csb">
						<span class="premium-disabled">PREMIUM</span>
						<span class="radio-label">MAIN / SB / SB &#x2193;</span>
					</label>
				</input>
			</div>
		</div>

		<?php
	}
}
