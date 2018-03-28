<?php
/**
 * Add controls for arbitrary heading, description, line
 *
 * @package 	Customizer_Library
 * @author		Devin Price
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

if ( ! class_exists( 'Structr_Customize_Headings' ) ) :
	class Structr_Customize_Headings extends WP_Customize_Control {

		public $content = '';
		public function render_content() {
			switch ( $this->type ) {
				default:
				case 'heading' :
					if ( isset( $this->label ) ) {
						echo '<span class="customize-control-heading customize-control-title">' . esc_html( $this->label ) . '</span>';
					}
					if ( isset( $this->content ) ) {
						echo $this->content;
					}
					if ( isset( $this->description ) ) {
						echo '<span class="customize-control-heading customize-control-description">' . esc_html( $this->description ) . '</span>';
					}
					break;

				case 'subsec-head':
					if ( isset( $this->label ) ) {
						echo '<span class="customize-control-subsection customize-control-title">' . esc_html( $this->label ) . '</span>';
					}
					if ( isset( $this->description ) ) {
						echo '<p class="customize-control-subsection customize-control-description"><span class="cust-info">Info:</span> ' . esc_html( $this->description ) . '</p>';
					}
					break;

				case 'line':
					echo '<hr class="custzer-hr" />';
					break;
			}
		}
	}
endif;


if ( ! class_exists( 'Structr_Customize_Subsection' ) ) :
	class Structr_Customize_Subsection extends WP_Customize_Control {

		public $type = 'subsection';
		public function render_content() {

			if ( isset( $this->label ) ) {
				echo '<span class="customize-control-subsection customize-control-title">' . esc_html( $this->label ) . '</span>';
			}
			if ( isset( $this->description ) ) {
				echo '<p class="customize-control-subsection customize-control-description"><span class="cust-info">Info:</span> ' . esc_html( $this->description ) . '</p>';
			}
		}
	}
endif;
