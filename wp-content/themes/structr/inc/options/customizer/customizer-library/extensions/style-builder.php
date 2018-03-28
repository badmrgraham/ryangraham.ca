<?php

if ( ! class_exists( 'Customizer_Library_Styles' ) ) :

	class Customizer_Library_Styles {

		/**
		 * The one instance of Customizer_Library_Styles.
		 *
		 * @since 1.0.0.
		 *
		 * @var   Customizer_Library_Styles    The one instance for the singleton.
		 */
		private static $instance;

		/**
		 * The array for storing added CSS rule data.
		 *
		 * @since 1.0.0.
		 *
		 * @var   array    Holds the data to be printed out.
		 */

		public $data = array();

		/**
		 * Optional line ending character for debug mode.
		 *
		 * @since 1.0.0.
		 *
		 * @var   string    Line ending character used to better style the CSS.
		 */
		private $line_ending = '';

		/**
		 * Optional tab character for debug mode.
		 *
		 * @since 1.0.0.
		 *
		 * @var   string    Line ending character used to better style the CSS.
		 */
		private $tab = '';

		/**
		 * Instantiate or return the one Customizer_Library_Styles instance.
		 *
		 * @since  1.0.0.
		 *
		 * @return Customizer_Library_Styles
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Initialize the object.
		 *
		 * @since  1.0.0.
		 *
		 * @return Customizer_Library_Styles
		 */
		function __construct() {
			// Set line ending and tab
			if ( defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ) {
				$this->line_ending = "\n";
				$this->tab = "\t";
			}
		}

		public function add( $data ) {
			if ( ! isset( $data['selectors'] ) || ! isset( $data['declarations'] ) ) {
				return;
			}

			$entry = array();

			// Sanitize selectors
			$entry['selectors'] = array_map( 'trim', (array) $data['selectors'] );
			$entry['selectors'] = array_unique( $entry['selectors'] );

			// Sanitize declarations
			$entry['declarations'] = array_map( 'trim', (array) $data['declarations'] );

			// Check for media query
			if ( isset( $data['media'] ) ) {
				$media = $data['media'];
			} else {
				$media = 'all';
			}

			// Create new media query if it doesn't exist yet
			if ( ! isset( $this->data[ $media ] ) || ! is_array( $this->data[ $media ] ) ) {
				$this->data[ $media ] = array();
			}

			// Look for matching selector sets
			$match = false;
			foreach ( $this->data[ $media ] as $key => $rule ) {
				$diff1 = array_diff( $rule['selectors'], $entry['selectors'] );
				$diff2 = array_diff( $entry['selectors'], $rule['selectors'] );
				if ( empty( $diff1 ) && empty( $diff2 ) ) {
					$match = $key;
					break;
				}
			}

			// No matching selector set, add a new entry
			if ( false === $match ) {
				$this->data[ $media ][] = $entry;
			} // Yes, matching selector set, merge declarations
			else {
				$this->data[ $media ][ $match ]['declarations'] = array_merge( $this->data[ $media ][ $match ]['declarations'], $entry['declarations'] );
			}
		}

		public function build() {
			if ( empty( $this->data ) ) {
				return '';
			}

			$n = $this->line_ending;

			// Make sure the 'all' array is first
			if ( isset( $this->data['all'] ) && count( $this->data ) > 1 ) {
				$all = array( 'all' => $this->data['all'] );
				unset( $this->data['all'] );
				$this->data = array_merge( $all, $this->data );
			}

			$output = '';

			foreach ( $this->data as $query => $ruleset ) {
				$t = '';

				if ( 'all' !== $query ) {
					$output .= "\n@media " . $query . '{' . $n;
					$t = $this->tab;
				}

				// Build each rule
				foreach ( $ruleset as $rule ) {
					$output .= $this->parse_selectors( $rule['selectors'], $t ) . '{' . $n;
					$output .= $this->parse_declarations( $rule['declarations'], $t );
					$output .= $t . '}' . $n;
				}

				if ( 'all' !== $query ) {
					$output .= '}' . $n;
				}
			}
			return $output;
		}

		private function parse_selectors( $selectors, $tab = '' ) {

			$n      = $this->line_ending;
			$output = $tab . implode( ",{$n}{$tab}", $selectors );
			return $output;
		}

		private function parse_declarations( $declarations, $tab = '' ) {
			$n = $this->line_ending;
			$t = $this->tab . $tab;

			$output = '';

			foreach ( $declarations as $property => $value ) {
				// Exception for px/rem font size
				if ( 'font-size-px' === $property || 'font-size-rem' === $property ) {
					$property = 'font-size';
				}
				$output .= "{$t}{$property}:{$value};$n";
			}
			return $output;
		}
	}
endif;

if ( ! function_exists( 'customizer_library_styles' ) ) :
	function customizer_library_styles() {
		return Customizer_Library_Styles::instance();
	}
endif;

add_action( 'init', 'customizer_library_styles', 1 );
