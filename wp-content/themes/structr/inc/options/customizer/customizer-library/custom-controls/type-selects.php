<?php
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

if ( ! class_exists( 'Structr_Text_Style_Custom_Control' ) ) :
	class Structr_Text_Style_Custom_Control extends WP_Customize_Control {
		public $type = 'style';

		public function render_content() {
			$choices = structr_get_font_styles();
			$id    = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
			$class = 'customize-control customize-control-' . $this->type;

			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?>>
					<?php
					foreach ( $choices as $value => $label ) {
						echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
					}
					?>
				</select>
			</label>
			<?php
		}
	}
endif;

if ( ! class_exists( 'Structr_Text_Weight_Custom_Control' ) ) :
	class Structr_Text_Weight_Custom_Control extends WP_Customize_Control {
		public $type = 'weight';

		public function render_content() {
			$choices = structr_get_font_weights();
			$id    = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
			$class = 'customize-control customize-control-' . $this->type;

			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?>>
					<?php
					foreach ( $choices as $value => $label ) {
						echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
					}
					?>
				</select>
			</label>
			<?php
		}
	}
endif;


if ( ! class_exists( 'Structr_Text_Transform_Custom_Control' ) ) :
	class Structr_Text_Transform_Custom_Control extends WP_Customize_Control {
		public $type = 'transform';

		public function render_content() {
			$choices = structr_get_font_transform();
			$id    = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
			$class = 'customize-control customize-control-' . $this->type;

			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?>>
					<?php
					foreach ( $choices as $value => $label ) {
						echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
					}
					?>
				</select>
			</label>
			<?php
		}
	}
endif;


if ( ! class_exists( 'Structr_Text_Spacing_Custom_Control' ) ) :
	class Structr_Text_Spacing_Custom_Control extends WP_Customize_Control {
		public $type = 'spacing';

		public function render_content() {
			$choices = structr_get_font_spacing();
			$id    = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
			$class = 'customize-control customize-control-' . $this->type;

			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?>>
					<?php
					foreach ( $choices as $value => $label ) {
						echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . $label . '</option>';
					}
					?>
				</select>
			</label>
			<?php
		}
	}
endif;
