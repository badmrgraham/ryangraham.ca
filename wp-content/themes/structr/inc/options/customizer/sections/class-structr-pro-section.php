<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Structr_Customizer_Pro_Section {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $manager
	 * @return void
	 */
	public function sections( $manager ) {

		structr_require_pro_section();

		// Register custom section types.
		$manager->register_section_type( 'Structr_Customizer_Pro_Section_Link' );

		// Register sections.
		$manager->add_section(
			new Structr_Customizer_Pro_Section_Link(
				$manager,
				'section_premium',
				array(
					'title'    => esc_html__( 'StructrPress Pro', 'structr' ),
					'premium_text' => esc_html__( 'Get Premium', 'structr' ),
					'premium_url'  =>  esc_url( 'https://structrpress.com/downloads/structr-framework/', 'structr' ),
					'priority' => 5,
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */

	public function enqueue_control_scripts() {

		wp_enqueue_script( 'section-premium-customize-controls', STRUCTR_THEME_OPTIONS_URI . '/customizer/customizer-library/assets/js/customize-controls.js', array( 'customize-controls' ) );

	}

}

// Doing this customizer thang!
Structr_Customizer_Pro_Section::get_instance();
