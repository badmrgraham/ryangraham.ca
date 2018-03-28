<?php
if ( ! function_exists( 'structr_get_font_styles' ) ) :
	function structr_get_font_styles() {
		return array(
			'normal' => __( 'Normal', 'structr' ),
			'italic' => __( 'Italic', 'structr' ),
			'oblique' => __( 'Oblique', 'structr' ),
		);
	}
endif;

if ( ! function_exists( 'structr_get_font_weights' ) ) :
	function structr_get_font_weights() {
		return array(
			'100' => __( 'Extra Light', 'structr' ),
			'200' => __( 'Light', 'structr' ),
			'300' => __( 'Thin', 'structr' ),
			'400' => __( 'Normal', 'structr' ),
			'500' => __( 'Medium', 'structr' ),
			'600' => __( 'Semi-Bold', 'structr' ),
			'700' => __( 'Bold', 'structr' ),
			'800' => __( 'Extra Bold', 'structr' ),
			'900' => __( 'Black', 'structr' ),
		);
	}
endif;

if ( ! function_exists( 'structr_get_font_transform' ) ) :
	function structr_get_font_transform() {
		return array(
			'none' => __( 'None', 'structr' ),
			'capitalize' => __( 'Capitalize', 'structr' ),
			'lowercase' => __( 'Lowercase', 'structr' ),
			'uppercase' => __( 'Uppercase', 'structr' ),
		);
	}
endif;

if ( ! function_exists( 'structr_get_font_spacing' ) ) :
	function structr_get_font_spacing() {
		return array(
			'-10px' => __( '-10px', 'structr' ),
			'-9px' => __( '-9px', 'structr' ),
			'-8px' => __( '-8px', 'structr' ),
			'-7px' => __( '-7px', 'structr' ),
			'-6px' => __( '-6px', 'structr' ),
			'-5px' => __( '-5px', 'structr' ),
			'-4px' => __( '-4px', 'structr' ),
			'-3px' => __( '-3px', 'structr' ),
			'-2px' => __( '-2px', 'structr' ),
			'-1px' => __( '-1px', 'structr' ),
			'normal' => __( 'Normal', 'structr' ),
			'1px' => __( '1px', 'structr' ),
			'2px' => __( '2px', 'structr' ),
			'3px' => __( '3px', 'structr' ),
			'4px' => __( '4px', 'structr' ),
			'5px' => __( '5px', 'structr' ),
			'6px' => __( '6px', 'structr' ),
			'7px' => __( '7px', 'structr' ),
			'8px' => __( '8px', 'structr' ),
			'9px' => __( '9px', 'structr' ),
			'10px' => __( '10px', 'structr' ),
		);
	}
endif;

if ( ! function_exists( 'customizer_library_get_all_fonts' ) ) :
	function customizer_library_get_all_fonts() {
		$heading1       = array( 1 => array( 'label' => sprintf( '%s', __( 'Standard Fonts', 'structr' ) ) ) );
		$standard_fonts = customizer_library_get_standard_fonts();
		$heading2       = array( 2 => array( 'label' => sprintf( '%s', __( 'Google Fonts', 'structr' ) ) ) );
		$google_fonts   = customizer_library_get_google_fonts();

		return apply_filters( 'customizer_library_all_fonts', array_merge( $heading1, $standard_fonts, $heading2, $google_fonts ) );
	}
endif;

if ( ! function_exists( 'customizer_library_get_font_choices' ) ) :
	function customizer_library_get_font_choices() {
		$fonts   = customizer_library_get_all_fonts();
		$choices = array();

		// Repackage the fonts into value/label pairs
		foreach ( $fonts as $key => $font ) {
			$choices[ $key ] = $font['label'];
		}
		return $choices;
	}
endif;

if ( ! function_exists( 'customizer_library_get_google_font_uri' ) ) :
	function customizer_library_get_google_font_uri( $fonts ) {

		// De-dupe the fonts
		$fonts         = array_unique( $fonts );
		$allowed_fonts = customizer_library_get_google_fonts();
		$family        = array();

		// Validate each font and convert to URL format
		foreach ( $fonts as $font ) {
			$font = trim( $font );

			// Verify that the font exists
			if ( array_key_exists( $font, $allowed_fonts ) ) {
				// Build the family name and variant string (e.g., "Open+Sans:regular,italic,700")
				$family[] = urlencode( $font . ':' . join( ',', customizer_library_choose_google_font_variants( $font, $allowed_fonts[ $font ]['variants'] ) ) );
			}
		}

		// Convert from array to string
		if ( empty( $family ) ) {
			return '';
		} else {
			$request = '//fonts.googleapis.com/css?family=' . implode( '|', $family );
		}

		// Load the font subset
		$subset = get_theme_mod( 'global_font_subset', customizer_library_get_default( 'global_font_subset' ) );

		if ( 'all' === $subset ) {
			$subsets_available = customizer_library_get_google_font_subsets();

			// Remove the all set
			unset( $subsets_available['all'] );

			// Build the array
			$subsets = array_keys( $subsets_available );
		} else {
			$subsets = array(
				$subset,
			);
			if ( 'latin' !== $subset ) {
				$subsets[] = 'latin';
			}
		}

		// Append the subset string
		if ( ! empty( $subsets ) ) {
			$request .= urlencode( '&subset=' . join( ',', $subsets ) );
		}
		return esc_url( $request );
	}
endif;

if ( ! function_exists( 'customizer_library_get_google_font_subsets' ) ) :
	function customizer_library_get_google_font_subsets() {
		return array(
			'all'          => __( 'All', 'structr' ),
			'latin'        => __( 'Latin', 'structr' ),
			'greek'        => __( 'Greek', 'structr' ),
			'latin-ext'    => __( 'Latin Extended', 'structr' ),
			'greek-ext'    => __( 'Greek Extended', 'structr' ),
			'cyrillic'     => __( 'Cyrillic', 'structr' ),
			'khmer'        => __( 'Khmer', 'structr' ),
			'cyrillic-ext' => __( 'Cyrillic Extended', 'structr' ),
			'devanagari'   => __( 'Devanagari', 'structr' ),
			'vietnamese'   => __( 'Vietnamese', 'structr' ),
		);
	}
endif;

if ( ! function_exists( 'customizer_library_choose_google_font_variants' ) ) :
	function customizer_library_choose_google_font_variants( $font, $variants = array() ) {
		$chosen_variants = array();
		if ( empty( $variants ) ) {
			$fonts = customizer_library_get_google_fonts();

			if ( array_key_exists( $font, $fonts ) ) {
				$variants = $fonts[ $font ]['variants'];
			}
		}

		// If a "regular" variant is not found, get the first variant
		if ( ! in_array( 'regular', $variants ) ) {
			$chosen_variants[] = $variants[0];
		} else {
			$chosen_variants[] = 'regular';
		}

		// Only add "italic" if it exists
		if ( in_array( 'italic', $variants ) ) {
			$chosen_variants[] = 'italic';
		}

		// Only add "100" if it exists
		if ( in_array( '100', $variants ) ) {
			$chosen_variants[] = '100';
		}

		// Only add "100italic" if it exists
		if ( in_array( '100italic', $variants ) ) {
			$chosen_variants[] = '100italic';
		}

		// Only add "200" if it exists
		if ( in_array( '200', $variants ) ) {
			$chosen_variants[] = '200';
		}

		// Only add "200italic" if it exists
		if ( in_array( '200italic', $variants ) ) {
			$chosen_variants[] = '200italic';
		}

		// Only add "300" if it exists
		if ( in_array( '300', $variants ) ) {
			$chosen_variants[] = '300';
		}

		// Only add "300italic" if it exists
		if ( in_array( '300italic', $variants ) ) {
			$chosen_variants[] = '300italic';
		}

		// Only add "500" if it exists
		if ( in_array( '500', $variants ) ) {
			$chosen_variants[] = '500';
		}

		// Only add "500italic" if it exists
		if ( in_array( '500italic', $variants ) ) {
			$chosen_variants[] = '500italic';
		}

		// Only add "600" if it exists
		if ( in_array( '600', $variants ) ) {
			$chosen_variants[] = '600';
		}

		// Only add "600italic" if it exists
		if ( in_array( '600italic', $variants ) ) {
			$chosen_variants[] = '600italic';
		}

		// Only add "700" if it exists
		if ( in_array( '700', $variants ) ) {
			$chosen_variants[] = '700';
		}

		// Only add "700italic" if it exists
		if ( in_array( '700italic', $variants ) ) {
			$chosen_variants[] = '700italic';
		}

		// Only add "800" if it exists
		if ( in_array( '800', $variants ) ) {
			$chosen_variants[] = '800';
		}

		// Only add "800italic" if it exists
		if ( in_array( '800italic', $variants ) ) {
			$chosen_variants[] = '800italic';
		}

		// Only add "900" if it exists
		if ( in_array( '900', $variants ) ) {
			$chosen_variants[] = '900';
		}

		// Only add "900italic" if it exists
		if ( in_array( '900italic', $variants ) ) {
			$chosen_variants[] = '900italic';
		}
		return apply_filters( 'customizer_library_font_variants', array_unique( $chosen_variants ), $font, $variants );
	}
endif;

if ( ! function_exists( 'customizer_library_get_standard_fonts' ) ) :
	function customizer_library_get_standard_fonts() {
		return array(
			'serif' => array(
				'label' => _x( 'Serif', 'font style', 'structr' ),
				'stack' => 'Georgia,Times,"Times New Roman",serif',
			),
			'sans-serif' => array(
				'label' => _x( 'Sans Serif', 'font style', 'structr' ),
				'stack' => '"Helvetica Neue",Helvetica,Arial,sans-serif',
			),
			'monospace' => array(
				'label' => _x( 'Monospaced', 'font style', 'structr' ),
				'stack' => 'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace',

			),
		);
	}
endif;

if ( ! function_exists( 'customizer_library_get_font_stack' ) ) :
	function customizer_library_get_font_stack( $font ) {

		$all_fonts = customizer_library_get_all_fonts();

		// Sanitize font choice
		$font = customizer_library_sanitize_font_choice( $font );

		$sans = '"Helvetica Neue", sans-serif';
		$serif = 'Georgia, serif';

		// Use stack if one is identified
		if ( isset( $all_fonts[ $font ]['stack'] ) && ! empty( $all_fonts[ $font ]['stack'] ) ) {
			$stack = $all_fonts[ $font ]['stack'];
		} else {
			$stack = '"' . $font . '", ' . $sans;
		}
		return $stack;
	}
endif;

if ( ! function_exists( 'customizer_library_sanitize_font_choice' ) ) :
	function customizer_library_sanitize_font_choice( $value ) {
		if ( is_int( $value ) ) {
			// The array key is an integer, so the chosen option is a heading, not a real choice
			return '';
		} elseif ( array_key_exists( $value, customizer_library_get_font_choices() ) ) {
			return $value;
		} else {
			return '';
		}
	}
endif;

if ( ! function_exists( 'customizer_library_get_google_fonts' ) ) :
	function customizer_library_get_google_fonts() {
		return apply_filters( 'customizer_library_get_google_fonts', array(
			'ABeeZee' => array(
				'label'    => 'ABeeZee',
				'variants' => array(
					'regular',
					'italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Adamina' => array(
				'label'    => 'Adamina',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Advent Pro' => array(
				'label'    => 'Advent Pro',
				'variants' => array(
					'100',
					'200',
					'300',
					'regular',
					'500',
					'600',
					'700',
				),
				'subsets' => array(
					'latin',
					'greek',
					'latin-ext',
				),
			),
			'Alegreya' => array(
				'label'    => 'Alegreya',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
					'900',
					'900italic',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Alegreya SC' => array(
				'label'    => 'Alegreya SC',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
					'900',
					'900italic',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Alegreya Sans' => array(
				'label'    => 'Alegreya Sans',
				'variants' => array(
					'100',
					'100italic',
					'300',
					'300italic',
					'regular',
					'italic',
					'500',
					'500italic',
					'700',
					'700italic',
					'800',
					'800italic',
					'900',
					'900italic',
				),
				'subsets' => array(
					'latin',
					'vietnamese',
					'latin-ext',
				),
			),
			'Alegreya Sans SC' => array(
				'label'    => 'Alegreya Sans SC',
				'variants' => array(
					'100',
					'100italic',
					'300',
					'300italic',
					'regular',
					'italic',
					'500',
					'500italic',
					'700',
					'700italic',
					'800',
					'800italic',
					'900',
					'900italic',
				),
				'subsets' => array(
					'latin',
					'vietnamese',
					'latin-ext',
				),
			),
			'Alex Brush' => array(
				'label'    => 'Alex Brush',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Alfa Slab One' => array(
				'label'    => 'Alfa Slab One',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Alice' => array(
				'label'    => 'Alice',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Allan' => array(
				'label'    => 'Allan',
				'variants' => array(
					'regular',
					'700',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Allerta' => array(
				'label'    => 'Allerta',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Allerta Stencil' => array(
				'label'    => 'Allerta Stencil',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Allura' => array(
				'label'    => 'Allura',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Almendra' => array(
				'label'    => 'Almendra',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Almendra Display' => array(
				'label'    => 'Almendra Display',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Almendra SC' => array(
				'label'    => 'Almendra SC',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Amarante' => array(
				'label'    => 'Amarante',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Amaranth' => array(
				'label'    => 'Amaranth',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Andika' => array(
				'label'    => 'Andika',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'cyrillic',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Anonymous Pro' => array(
				'label'    => 'Anonymous Pro',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'greek-ext',
					'cyrillic',
					'greek',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Arapey' => array(
				'label'    => 'Arapey',
				'variants' => array(
					'regular',
					'italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Arbutus' => array(
				'label'    => 'Arbutus',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Arbutus Slab' => array(
				'label'    => 'Arbutus Slab',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Architects Daughter' => array(
				'label'    => 'Architects Daughter',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Archivo Black' => array(
				'label'    => 'Archivo Black',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Archivo Narrow' => array(
				'label'    => 'Archivo Narrow',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Arimo' => array(
				'label'    => 'Arimo',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'greek-ext',
					'cyrillic',
					'greek',
					'vietnamese',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Arvo' => array(
				'label'    => 'Arvo',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Asap' => array(
				'label'    => 'Asap',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Aubrey' => array(
				'label'    => 'Aubrey',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Audiowide' => array(
				'label'    => 'Audiowide',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Autour One' => array(
				'label'    => 'Autour One',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Averia Gruesa Libre' => array(
				'label'    => 'Averia Gruesa Libre',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Bad Script' => array(
				'label'    => 'Bad Script',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'cyrillic',
				),
			),
			'Bangers' => array(
				'label'    => 'Bangers',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Bayon' => array(
				'label'    => 'Bayon',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'khmer',
				),
			),
			'Bevan' => array(
				'label'    => 'Bevan',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Bigelow Rules' => array(
				'label'    => 'Bigelow Rules',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Bitter' => array(
				'label'    => 'Bitter',
				'variants' => array(
					'regular',
					'italic',
					'700',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Bokor' => array(
				'label'    => 'Bokor',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'khmer',
				),
			),
			'Bonbon' => array(
				'label'    => 'Bonbon',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Bree Serif' => array(
				'label'    => 'Bree Serif',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Bubblegum Sans' => array(
				'label'    => 'Bubblegum Sans',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Bubbler One' => array(
				'label'    => 'Bubbler One',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Buda' => array(
				'label'    => 'Buda',
				'variants' => array(
					'300',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Buenard' => array(
				'label'    => 'Buenard',
				'variants' => array(
					'regular',
					'700',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Butcherman' => array(
				'label'    => 'Butcherman',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Cabin' => array(
				'label'    => 'Cabin',
				'variants' => array(
					'regular',
					'italic',
					'500',
					'500italic',
					'600',
					'600italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Cabin Condensed' => array(
				'label'    => 'Cabin Condensed',
				'variants' => array(
					'regular',
					'500',
					'600',
					'700',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Cabin Sketch' => array(
				'label'    => 'Cabin Sketch',
				'variants' => array(
					'regular',
					'700',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Cambo' => array(
				'label'    => 'Cambo',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Candal' => array(
				'label'    => 'Candal',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Cantarell' => array(
				'label'    => 'Cantarell',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Cantata One' => array(
				'label'    => 'Cantata One',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Cantora One' => array(
				'label'    => 'Cantora One',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Capriola' => array(
				'label'    => 'Capriola',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Cardo' => array(
				'label'    => 'Cardo',
				'variants' => array(
					'regular',
					'italic',
					'700',
				),
				'subsets' => array(
					'latin',
					'greek-ext',
					'greek',
					'latin-ext',
				),
			),
			'Carter One' => array(
				'label'    => 'Carter One',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Caudex' => array(
				'label'    => 'Caudex',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'greek-ext',
					'greek',
					'latin-ext',
				),
			),
			'Ceviche One' => array(
				'label'    => 'Ceviche One',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Cherry Cream Soda' => array(
				'label'    => 'Cherry Cream Soda',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Cherry Swash' => array(
				'label'    => 'Cherry Swash',
				'variants' => array(
					'regular',
					'700',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Chewy' => array(
				'label'    => 'Chewy',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Chicle' => array(
				'label'    => 'Chicle',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Chivo' => array(
				'label'    => 'Chivo',
				'variants' => array(
					'regular',
					'italic',
					'900',
					'900italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Cinzel' => array(
				'label'    => 'Cinzel',
				'variants' => array(
					'regular',
					'700',
					'900',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Cinzel Decorative' => array(
				'label'    => 'Cinzel Decorative',
				'variants' => array(
					'regular',
					'700',
					'900',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Clicker Script' => array(
				'label'    => 'Clicker Script',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Coda' => array(
				'label'    => 'Coda',
				'variants' => array(
					'regular',
					'800',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Coda Caption' => array(
				'label'    => 'Coda Caption',
				'variants' => array(
					'800',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Combo' => array(
				'label'    => 'Combo',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Comfortaa' => array(
				'label'    => 'Comfortaa',
				'variants' => array(
					'300',
					'regular',
					'700',
				),
				'subsets' => array(
					'latin',
					'cyrillic',
					'greek',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Coming Soon' => array(
				'label'    => 'Coming Soon',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Contrail One' => array(
				'label'    => 'Contrail One',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Convergence' => array(
				'label'    => 'Convergence',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Cookie' => array(
				'label'    => 'Cookie',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Copse' => array(
				'label'    => 'Copse',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Courgette' => array(
				'label'    => 'Courgette',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Cousine' => array(
				'label'    => 'Cousine',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'greek-ext',
					'cyrillic',
					'greek',
					'vietnamese',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Covered By Your Grace' => array(
				'label'    => 'Covered By Your Grace',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Crafty Girls' => array(
				'label'    => 'Crafty Girls',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Creepster' => array(
				'label'    => 'Creepster',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Crete Round' => array(
				'label'    => 'Crete Round',
				'variants' => array(
					'regular',
					'italic',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Crimson Text' => array(
				'label'    => 'Crimson Text',
				'variants' => array(
					'regular',
					'italic',
					'600',
					'600italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Croissant One' => array(
				'label'    => 'Croissant One',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Crushed' => array(
				'label'    => 'Crushed',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Cuprum' => array(
				'label'    => 'Cuprum',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'cyrillic',
					'latin-ext',
				),
			),
			'Cutive' => array(
				'label'    => 'Cutive',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Cutive Mono' => array(
				'label'    => 'Cutive Mono',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Damion' => array(
				'label'    => 'Damion',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Didact Gothic' => array(
				'label'    => 'Didact Gothic',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'greek-ext',
					'cyrillic',
					'greek',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Dosis' => array(
				'label'    => 'Dosis',
				'variants' => array(
					'200',
					'300',
					'regular',
					'500',
					'600',
					'700',
					'800',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Droid Sans' => array(
				'label'    => 'Droid Sans',
				'variants' => array(
					'regular',
					'700',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Droid Sans Mono' => array(
				'label'    => 'Droid Sans Mono',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Droid Serif' => array(
				'label'    => 'Droid Serif',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Exo' => array(
				'label'    => 'Exo',
				'variants' => array(
					'100',
					'100italic',
					'200',
					'200italic',
					'300',
					'300italic',
					'regular',
					'italic',
					'500',
					'500italic',
					'600',
					'600italic',
					'700',
					'700italic',
					'800',
					'800italic',
					'900',
					'900italic',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Exo 2' => array(
				'label'    => 'Exo 2',
				'variants' => array(
					'100',
					'100italic',
					'200',
					'200italic',
					'300',
					'300italic',
					'regular',
					'italic',
					'500',
					'500italic',
					'600',
					'600italic',
					'700',
					'700italic',
					'800',
					'800italic',
					'900',
					'900italic',
				),
				'subsets' => array(
					'latin',
					'cyrillic',
					'latin-ext',
				),
			),
			'Fira Sans' => array(
				'label'    => 'Fira Sans',
				'variants' => array(
					'300',
					'300italic',
					'400',
					'400italic',
					'500',
					'500italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'greek',
					'cyrillic',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Fira Mono' => array(
				'label'    => 'Fira Mono',
				'variants' => array(
					'400',
					'700',
				),
				'subsets' => array(
					'latin',
					'greek',
					'cyrillic',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Fredoka One' => array(
				'label'    => 'Fredoka One',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Freehand' => array(
				'label'    => 'Freehand',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'khmer',
				),
			),
			'Grand Hotel' => array(
				'label'    => 'Grand Hotel',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Gravitas One' => array(
				'label'    => 'Gravitas One',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Gudea' => array(
				'label'    => 'Gudea',
				'variants' => array(
					'regular',
					'italic',
					'700',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Handlee' => array(
				'label'    => 'Handlee',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Josefin Sans' => array(
				'label'    => 'Josefin Sans',
				'variants' => array(
					'100',
					'100italic',
					'300',
					'300italic',
					'regular',
					'italic',
					'600',
					'600italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Josefin Slab' => array(
				'label'    => 'Josefin Slab',
				'variants' => array(
					'100',
					'100italic',
					'300',
					'300italic',
					'regular',
					'italic',
					'600',
					'600italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Jura' => array(
				'label'    => 'Jura',
				'variants' => array(
					'300',
					'regular',
					'500',
					'600',
				),
				'subsets' => array(
					'latin',
					'greek-ext',
					'cyrillic',
					'greek',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Karla' => array(
				'label'    => 'Karla',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Lato' => array(
				'label'    => 'Lato',
				'variants' => array(
					'100',
					'100italic',
					'300',
					'300italic',
					'regular',
					'italic',
					'700',
					'700italic',
					'900',
					'900italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Leckerli One' => array(
				'label'    => 'Leckerli One',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Lobster' => array(
				'label'    => 'Lobster',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'cyrillic',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Lobster Two' => array(
				'label'    => 'Lobster Two',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Lora' => array(
				'label'    => 'Lora',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'cyrillic',
					'latin-ext',
				),
			),
			'Macondo' => array(
				'label'    => 'Macondo',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Macondo Swash Caps' => array(
				'label'    => 'Macondo Swash Caps',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Magra' => array(
				'label'    => 'Magra',
				'variants' => array(
					'regular',
					'700',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Maiden Orange' => array(
				'label'    => 'Maiden Orange',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Marmelad' => array(
				'label'    => 'Marmelad',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'cyrillic',
					'latin-ext',
				),
			),
			'Marvel' => array(
				'label'    => 'Marvel',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Mate' => array(
				'label'    => 'Mate',
				'variants' => array(
					'regular',
					'italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Mate SC' => array(
				'label'    => 'Mate SC',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Maven Pro' => array(
				'label'    => 'Maven Pro',
				'variants' => array(
					'regular',
					'500',
					'700',
					'900',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Merienda' => array(
				'label'    => 'Merienda',
				'variants' => array(
					'regular',
					'700',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Merienda One' => array(
				'label'    => 'Merienda One',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Merriweather' => array(
				'label'    => 'Merriweather',
				'variants' => array(
					'300',
					'300italic',
					'regular',
					'italic',
					'700',
					'700italic',
					'900',
					'900italic',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Merriweather Sans' => array(
				'label'    => 'Merriweather Sans',
				'variants' => array(
					'300',
					'300italic',
					'regular',
					'italic',
					'700',
					'700italic',
					'800',
					'800italic',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Neuton' => array(
				'label'    => 'Neuton',
				'variants' => array(
					'200',
					'300',
					'regular',
					'italic',
					'700',
					'800',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Noticia Text' => array(
				'label'    => 'Noticia Text',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'vietnamese',
					'latin-ext',
				),
			),
			'Noto Sans' => array(
				'label'    => 'Noto Sans',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'greek-ext',
					'cyrillic',
					'greek',
					'vietnamese',
					'latin-ext',
					'devanagari',
					'cyrillic-ext',
				),
			),
			'Noto Serif' => array(
				'label'    => 'Noto Serif',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'greek-ext',
					'cyrillic',
					'greek',
					'vietnamese',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Nova Cut' => array(
				'label'    => 'Nova Cut',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Nova Flat' => array(
				'label'    => 'Nova Flat',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Nova Mono' => array(
				'label'    => 'Nova Mono',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'greek',
				),
			),
			'Nova Oval' => array(
				'label'    => 'Nova Oval',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Nova Round' => array(
				'label'    => 'Nova Round',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Nova Script' => array(
				'label'    => 'Nova Script',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Nova Slim' => array(
				'label'    => 'Nova Slim',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Open Sans' => array(
				'label'    => 'Open Sans',
				'variants' => array(
					'300',
					'300italic',
					'regular',
					'italic',
					'600',
					'600italic',
					'700',
					'700italic',
					'800',
					'800italic',
				),
				'subsets' => array(
					'latin',
					'greek-ext',
					'cyrillic',
					'greek',
					'vietnamese',
					'latin-ext',
					'devanagari',
					'cyrillic-ext',
				),
			),
			'Open Sans Condensed' => array(
				'label'    => 'Open Sans Condensed',
				'variants' => array(
					'300',
					'300italic',
					'700',
				),
				'subsets' => array(
					'latin',
					'greek-ext',
					'cyrillic',
					'greek',
					'vietnamese',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Oregano' => array(
				'label'    => 'Oregano',
				'variants' => array(
					'regular',
					'italic',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Overlock' => array(
				'label'    => 'Overlock',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
					'900',
					'900italic',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Overlock SC' => array(
				'label'    => 'Overlock SC',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'PT Mono' => array(
				'label'    => 'PT Mono',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'cyrillic',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'PT Sans' => array(
				'label'    => 'PT Sans',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'cyrillic',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'PT Sans Caption' => array(
				'label'    => 'PT Sans Caption',
				'variants' => array(
					'regular',
					'700',
				),
				'subsets' => array(
					'latin',
					'cyrillic',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'PT Sans Narrow' => array(
				'label'    => 'PT Sans Narrow',
				'variants' => array(
					'regular',
					'700',
				),
				'subsets' => array(
					'latin',
					'cyrillic',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'PT Serif' => array(
				'label'    => 'PT Serif',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'cyrillic',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'PT Serif Caption' => array(
				'label'    => 'PT Serif Caption',
				'variants' => array(
					'regular',
					'italic',
				),
				'subsets' => array(
					'latin',
					'cyrillic',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Pacifico' => array(
				'label'    => 'Pacifico',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Pompiere' => array(
				'label'    => 'Pompiere',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Pontano Sans' => array(
				'label'    => 'Pontano Sans',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Port Lligat Sans' => array(
				'label'    => 'Port Lligat Sans',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Port Lligat Slab' => array(
				'label'    => 'Port Lligat Slab',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Prata' => array(
				'label'    => 'Prata',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Preahvihear' => array(
				'label'    => 'Preahvihear',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'khmer',
				),
			),
			'Press Start 2P' => array(
				'label'    => 'Press Start 2P',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'cyrillic',
					'greek',
					'latin-ext',
				),
			),
			'Princess Sofia' => array(
				'label'    => 'Princess Sofia',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Puritan' => array(
				'label'    => 'Puritan',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Quantico' => array(
				'label'    => 'Quantico',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Quattrocento' => array(
				'label'    => 'Quattrocento',
				'variants' => array(
					'regular',
					'700',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Quattrocento Sans' => array(
				'label'    => 'Quattrocento Sans',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Radley' => array(
				'label'    => 'Radley',
				'variants' => array(
					'regular',
					'italic',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Raleway' => array(
				'label'    => 'Raleway',
				'variants' => array(
					'100',
					'200',
					'300',
					'regular',
					'500',
					'600',
					'700',
					'800',
					'900',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Rambla' => array(
				'label'    => 'Rambla',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Roboto' => array(
				'label'    => 'Roboto',
				'variants' => array(
					'100',
					'100italic',
					'300',
					'300italic',
					'regular',
					'italic',
					'500',
					'500italic',
					'700',
					'700italic',
					'900',
					'900italic',
				),
				'subsets' => array(
					'latin',
					'greek-ext',
					'cyrillic',
					'greek',
					'vietnamese',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Roboto Condensed' => array(
				'label'    => 'Roboto Condensed',
				'variants' => array(
					'300',
					'300italic',
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'greek-ext',
					'cyrillic',
					'greek',
					'vietnamese',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Roboto Slab' => array(
				'label'    => 'Roboto Slab',
				'variants' => array(
					'100',
					'300',
					'regular',
					'700',
				),
				'subsets' => array(
					'latin',
					'greek-ext',
					'cyrillic',
					'greek',
					'vietnamese',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Rokkitt' => array(
				'label'    => 'Rokkitt',
				'variants' => array(
					'regular',
					'700',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Rosario' => array(
				'label'    => 'Rosario',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Scada' => array(
				'label'    => 'Scada',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'cyrillic',
					'latin-ext',
				),
			),
			'Share' => array(
				'label'    => 'Share',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Source Code Pro' => array(
				'label'    => 'Source Code Pro',
				'variants' => array(
					'200',
					'300',
					'regular',
					'500',
					'600',
					'700',
					'900',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Source Sans Pro' => array(
				'label'    => 'Source Sans Pro',
				'variants' => array(
					'200',
					'200italic',
					'300',
					'300italic',
					'regular',
					'italic',
					'600',
					'600italic',
					'700',
					'700italic',
					'900',
					'900italic',
				),
				'subsets' => array(
					'latin',
					'vietnamese',
					'latin-ext',
				),
			),
			'Source Serif Pro' => array(
				'label'    => 'Source Serif Pro',
				'variants' => array(
					'400',
					'600',
					'700',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Spinnaker' => array(
				'label'    => 'Spinnaker',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Spirax' => array(
				'label'    => 'Spirax',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Squada One' => array(
				'label'    => 'Squada One',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Stalemate' => array(
				'label'    => 'Stalemate',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Tangerine' => array(
				'label'    => 'Tangerine',
				'variants' => array(
					'regular',
					'700',
				),
				'subsets' => array(
					'latin',
				),
			),
			'The Girl Next Door' => array(
				'label'    => 'The Girl Next Door',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Titan One' => array(
				'label'    => 'Titan One',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Titillium Web' => array(
				'label'    => 'Titillium Web',
				'variants' => array(
					'200',
					'200italic',
					'300',
					'300italic',
					'regular',
					'italic',
					'600',
					'600italic',
					'700',
					'700italic',
					'900',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Ubuntu' => array(
				'label'    => 'Ubuntu',
				'variants' => array(
					'300',
					'300italic',
					'regular',
					'italic',
					'500',
					'500italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'greek-ext',
					'cyrillic',
					'greek',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Ubuntu Condensed' => array(
				'label'    => 'Ubuntu Condensed',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
					'greek-ext',
					'cyrillic',
					'greek',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Ubuntu Mono' => array(
				'label'    => 'Ubuntu Mono',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
					'greek-ext',
					'cyrillic',
					'greek',
					'latin-ext',
					'cyrillic-ext',
				),
			),
			'Ultra' => array(
				'label'    => 'Ultra',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Vidaloka' => array(
				'label'    => 'Vidaloka',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Volkhov' => array(
				'label'    => 'Volkhov',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Vollkorn' => array(
				'label'    => 'Vollkorn',
				'variants' => array(
					'regular',
					'italic',
					'700',
					'700italic',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Waiting for the Sunrise' => array(
				'label'    => 'Waiting for the Sunrise',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Walter Turncoat' => array(
				'label'    => 'Walter Turncoat',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
			'Yanone Kaffeesatz' => array(
				'label'    => 'Yanone Kaffeesatz',
				'variants' => array(
					'200',
					'300',
					'regular',
					'700',
				),
				'subsets' => array(
					'latin',
					'latin-ext',
				),
			),
			'Yellowtail' => array(
				'label'    => 'Yellowtail',
				'variants' => array(
					'regular',
				),
				'subsets' => array(
					'latin',
				),
			),
		) );
	}
endif;
