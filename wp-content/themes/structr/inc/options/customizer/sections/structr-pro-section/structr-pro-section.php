<?php
/**
 * Pro customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Structr_Customizer_Pro_Section_Link extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'section_premium';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $premium_text = '';

	/**
	 * Custom premium button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $premium_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['premium_text'] = $this->premium_text;
		$json['premium_url']  = esc_url( $this->premium_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() {
	?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.premium_text && data.premium_url ) { #>
					<a href="{{ data.premium_url }}" class="button button-secondary alignright" target="_blank">{{ data.premium_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}
