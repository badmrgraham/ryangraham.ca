<?php
/** api.php
 *
 * **** THIS IS A CORE STRUCTR FILE, DO NOT EDIT ITS CONTENTS
 * **** FOR MAKING CUSTOM CODE CHANGES, PLEASE USE A CHILD THEME
 * **** LEARN MORE HERE - https://codex.wordpress.org/Child_Themes
 * ****************************************************************
 *
 * This file is the bread and butter of the Structr Framework.
 * With this little API it becomes a breeze setting up new admin
 * options pages in WordPress, building input fields into them,
 * saving & displaying their content and connecting with separate
 * addon plugins/extensions for Structr.
 *
 * This api comes with inspiration from Alex Mangini of Kolakube.
 * He put together the very powerful, yet simple MD API for his
 * WordPress theme: Marketers Delight. Definitely check it out if
 * you have not heard about/seen it yet. Kid does stellar work!
 *
 * @package Structr
 * @since Structr 1.0
 */


// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class STRUC_API {

	public $_id;
	public $_slugify_id;
	public $_new_page;
	public $_get_option;
	public $_tab;
	public $_active_tab;
	public $group;
	public $admin_page;
	public $admin_tab = '';

	/**
	 * __construct function.
	 *
	 * @access public
	 * @param mixed $id (default: null)
	 * @return void
	 */
	public function __construct( $id = null ) {

		$this->_id = isset( $id ) ? $id : strtolower( get_class( $this ) );

		if ( method_exists( $this, 'construct' ) ) {
			$this->construct();
		}

		$this->_slugify_id   = preg_replace( '/^' . preg_quote( "{$this->group}_", '/' ) . '/', '', $this->_id );
		$this->_get_option = get_option( $this->_id );
		$this->_tab        = isset( $_GET['tab'] ) ? $_GET['tab'] : '';
		$this->_active_tab = $this->_tab ? $this->_tab : 'settings';

		// Register Settings
		if ( $this->admin_page || $this->admin_tab ) {
			add_action( 'admin_init', array( $this, '_register_setting' ) );
		}

		// Admin page
		if ( $this->admin_page ) {
			add_action( 'admin_menu', array( $this, 'add_menu' ) );
		}

		// Admin tab / content
		if ( is_array( $this->admin_tab ) && isset( $this->admin_tab['name'] ) ) {
			if ( ! isset( $this->admin_tab['priority'] ) ) {
				$this->admin_tab['priority'] = 10;
			}

			add_action( "{$this->group}_admin_tabs", array( $this, 'admin_tab' ), $this->admin_tab['priority'] );
		}

		if ( method_exists( $this, 'fields' ) && $this->_active_tab == $this->_slugify_id ) {
			add_action( "{$this->group}_admin_tab_content", array( $this, 'admin_tab_content' ) );
		}

		// Scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );

		if ( method_exists( $this, 'admin_print_footer_scripts' ) ) {
			add_action( 'admin_print_footer_scripts', array( $this, 'load_admin_print_footer_scripts' ) );
		}

	}

	/**
	 * add_menu function.
	 *
	 * @access public
	 * @return void
	 */
	public function add_menu() {
		$parent_slug = isset( $this->admin_page['parent_slug'] ) ? $this->admin_page['parent_slug'] : 'options-general.php';
		$capability  = isset( $this->admin_page['capability'] ) ? $this->admin_page['capability'] : 'edit_theme_options';
		$callback    = isset( $this->admin_page['callback'] ) ? $this->admin_page['callback'] : array( $this, 'admin_page' );
		$menu_slug   = isset( $this->admin_page['menu_slug'] ) ? $this->admin_page['menu_slug'] : $this->group;
		$icon        = isset( $this->admin_page['icon'] ) ? $this->admin_page['icon'] : '';
		$position    = isset( $this->admin_page['position'] ) ? $this->admin_page['position'] : 65;
		$menu_title  = isset( $this->admin_page['menu_title'] ) ? $this->admin_page['menu_title'] : $this->admin_page['name'];

		if ( empty( $this->admin_page['toplevel'] ) ) {
			$this->_new_page = add_theme_page( $this->admin_page['name'], $menu_title, $capability, $menu_slug, $callback, $icon, $position );
		} else { $this->_new_page = add_theme_page( $parent_slug, $this->admin_page['name'], $this->admin_page['name'], $capability, $menu_slug, $callback );
		}

		if ( ! empty( $this->admin_page['hide_menu'] ) ) {
			remove_submenu_page( $parent_slug, $menu_slug );
		}

	}

	/**
	 * _register_setting function.
	 *
	 * @access public
	 * @return void
	 */
	public function _register_setting() {
		register_setting( $this->_id, $this->_id, array( $this, 'admin_save' ) );
	}

	/**
	 * admin_header function.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_header() {
		$screen = get_current_screen();
		// Check to see if settings are updated
		if ( ! isset( $_REQUEST['settings-updated'] ) ) {
			$_REQUEST['settings-updated'] = false;
		}
	?>
		<?php if ( false !== $_REQUEST['settings-updated'] ) { ?>
			<div class="updated fade radius notice is-dismissible">
				<p><strong><?php _e( 'Your settings have been updated.', 'structr' ); ?></strong></p>
			</div>
		<?php } ?>
		<div class="structr-header structr-clear">

			<div class="structr-header-title">

				<h1 class="structr-inline"><?php _e( 'StructrPress Theme', 'structr' ); ?> <span class="title-count theme-count sp-version"><?php echo STRUCTR_THEME_VERSION; ?></span> <span class="panel-txt"> Guide Panel</span></h1>

			</div>

			<h2 class="nav-tab-wrapper structr-header-nav">
			
				<?php do_action( 'hook_first_admin_page_tab' ); ?>
				<a href="<?php echo admin_url( 'themes.php?page=sp' ); ?>" class="nav-tab<?php echo 'appearance_page_sp' == $screen->base ? ' nav-tab-active' : ''; ?>"><?php _e( 'Introduction', 'structr' ); ?></a>
				<?php if ( function_exists( 'struc_hooks_setup' ) || function_exists( 'struc_blocks_setup' ) ) { ?>
					<a href="<?php echo admin_url( 'themes.php?page=keys' ); ?>" class="nav-tab<?php echo 'appearance_page_keys' == $screen->base ? ' nav-tab-active' : ''; ?>"><?php _e( 'Licenses', 'structr' ); ?></a>
				<?php } ?>
				<a href="<?php echo admin_url( 'themes.php?page=addons' ); ?>" class="nav-tab<?php echo 'appearance_page_addons' == $screen->base ? ' nav-tab-active' : ''; ?>"><?php _e( 'Addons', 'structr' ); ?></a>
				<?php do_action( 'hook_last_admin_page_tab' ); ?>

			</h2>

				<?php if ( has_action( "{$this->group}_admin_tabs" ) ) : ?>
					<div class="structr-tabs">
						<?php do_action( "{$this->group}_admin_tabs" ); ?>
					</div>
				<?php endif; ?>

		</div>

<?php }


	/**
	 * admin_tab function.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_tab() {
	?>

		<a href="?page=<?php echo urlencode( $this->group ); ?>&tab=<?php echo $this->_slugify_id; ?>" class="structr-tab<?php echo $this->_slugify_id == $this->_active_tab ? ' structr-tab-active' : ''; ?>" title="<?php echo $this->admin_tab['name'] ?>">

			<?php if ( isset( $this->admin_tab['dashicon'] ) ) : ?>
				<i class="structr-tab-dashicon dashicons dashicons-admin-<?php echo $this->admin_tab['dashicon'] ?>"></i>
			<?php endif; ?>

			<?php echo $this->admin_tab['name'] ?>
		</a>

	<?php }


	/**
	 * admin_tab_content function.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_tab_content() {
		$save = isset( $this->admin_tab['save'] ) ? $this->admin_tab['save'] : true;
	?>

		<?php settings_fields( $this->_id ); ?>

		<?php $this->fields(); ?>

		<?php if ( $save ) : ?>
			<?php submit_button(); ?>
		<?php endif; ?>

	<?php }


	/**
	 * admin_save function.
	 *
	 * @access public
	 * @param mixed $input
	 * @return void
	 */
	public function admin_save( $input ) {
	    global $valid;
		foreach ( $this->register_fields() as $option => $field ) {
			$type           = isset( $field['type'] ) ? $field['type'] : '';
			$options        = isset( $field['options'] ) ? $field['options'] : '';
			$input[ $option ] = isset( $input[ $option ] ) ? $input[ $option ] : '';

			if ( 'text' == $type ) {
				$valid[ $option ] = sanitize_text_field( $input[ $option ] );

			} elseif ( 'number' == $type ) {
				$valid[ $option ] = preg_replace( '/\D/', '', $input[ $option ] );

			} elseif ( 'code' == $type ) {
				$valid[ $option ] = $input[ $option ];

			} elseif ( 'url' == $type ) {
				$valid[ $option ] = esc_url_raw( trim( $input[ $option ] ) );

			} elseif ( 'email' == $type ) {
				$valid[ $option ] = sanitize_email( $input[ $option ] );

			} elseif ( 'checkbox' == $type && $options ) {
				foreach ( $options as $check ) {
					$valid[ $option ][ $check ] = ! empty( $input[ $option ][ $check ] ) ? 1 : 0;

				}
			} elseif ( 'radio' == $type ) {
				$valid[ $option ] = in_array( $input[ $option ], $options ) ? $input[ $option ] : '';

			} elseif ( 'select' == $type ) {
				$valid[ $option ] = in_array( $input[ $option ], $options ) ? $input[ $option ] : '';

			} elseif ( 'media' == $type ) {
				$valid[ $option ] = esc_url( $input[ $option ] );

			} elseif ( 'date' == $type ) {
				$valid[ $option ] = date( 'Y-m-d H:i:s', strtotime( $input[ $option ] ) );

			} elseif ( 'textarea' == $type ) {
				$valid[ $option ] = wp_filter_nohtml_kses( $input[ $option ] );

			} elseif ( 'repeat' == $type ) {
				if ( is_array( $input[ $option ][0] ) && array_filter( $input[ $option ][0] ) ) {
					foreach ( $input[ $option ] as $repeat_count => $repeat_input ) {
						foreach ( $field['repeat_fields'] as $repeat_id => $repeat_field ) {
							if ( 'text' == $repeat_field['type'] ) {
								$valid[ $option ][ $repeat_count ][ $repeat_id ] = sanitize_text_field( $input[ $option ][ $repeat_count ][ $repeat_id ] );
							} elseif ( 'textarea' == $repeat_field['type'] ) {
								$valid[ $option ][ $repeat_count ][ $repeat_id ] = wp_filter_nohtml_kses( $input[ $option ][ $repeat_count ][ $repeat_id ] );
							} elseif ( 'checkbox' == $repeat_field['type'] && $repeat_field['options'] ) {
								foreach ( $repeat_field['options'] as $check ) {
									$valid[ $option ][ $repeat_count ][ $repeat_id ][ $check ] = ! empty( $input[ $option ][ $repeat_count ][ $repeat_id ][ $check ] ) ? 1 : 0;
								}
							} elseif ( 'media' == $repeat_field['type'] ) {
								$valid[ $option ][ $repeat_count ][ $repeat_id ] = esc_url( $input[ $option ][ $repeat_count ][ $repeat_id ] );
							}
						}
					}
				} else { 				$valid[ $option ] = false;
				}
			} elseif ( 'wp_editor' == $type ) {
				$valid[ $option ] = $input[ $option ];

			} elseif ( 'color' == $type ) {
				$valid[ $option ] = preg_match( '/^#[a-f0-9]{6}$/i', $input[ $option ] ) ? $input[ $option ] : '';
			}
		}

		return $valid;
	}


	/**
	 * admin_scripts function.
	 *
	 * @access public
	 * @return void
	 */
	public function admin_scripts() {
		$screen = get_current_screen();
		$module = ( $this->admin_tab && $this->_tab == $this->_slugify_id ) ? true : false;

		// register scripts
		wp_register_style( 'structr-admin', STRUC_API_CSS_URL . 'admin.css' );
		wp_register_script( 'structr-media', STRUC_API_JS_URL . 'media.js', array( 'jquery' ) );
		wp_register_script( 'structr-color-picker', STRUC_API_JS_URL . 'color-picker.js', array( 'wp-color-picker' ) );
		wp_register_script( 'structr-repeat', STRUC_API_JS_URL . 'repeat.js', array( 'jquery' ) );

		// enqueue
		wp_enqueue_style( 'structr-admin' );

		// admin page
		if ( $this->admin_page && $screen->base == $this->_new_page && method_exists( $this, 'admin_page_scripts' ) ) {
			$this->admin_page_scripts();
		}

		// module (admin page)
		if ( ( $this->admin_page && $screen->base == $this->_new_page ) ) {
			// meta box scripts
			wp_enqueue_script( 'postbox' );
			wp_enqueue_script( 'structr-postbox', STRUC_API_JS_URL . 'postbox.js', array( 'postbox' ), '', true );
		}
	}


	/**
	 * load_admin_print_footer_scripts function.
	 *
	 * @access public
	 * @return void
	 */
	public function load_admin_print_footer_scripts() {
		$screen = get_current_screen();
		$slug   = substr( $screen->base, -strlen( $this->set ) ) === $this->set; // check end of screen base for set

		if ( $slug && ( $this->admin_tab && $this->_active_tab == $this->_slugify_id ) ) {
			$this->admin_print_footer_scripts();
		}
	}


	/**
	 * register_fields function.
	 *
	 * @access public
	 * @return void
	 */
	public function register_fields() {
		return array();
	}


	/**
	 * field function.
	 *
	 * @access public
	 * @param mixed $type
	 * @param mixed $field
	 * @param mixed $values (default: null)
	 * @param mixed $args (default: null)
	 * @return void
	 */
	public function field( $type, $field, $values = null, $args = null ) {
		$screen = get_current_screen();
		$id     = esc_attr( "{$this->_id}_$field" );

		$_id        = ! empty( $screen->taxonomy ) ? "{$this->_id}_tax" . $_GET['tag_ID'] : $this->_id;
		$_get_option = ! empty( $screen->taxonomy ) ? get_option( $_id ) : $this->_get_option;

		$name   = esc_attr( "{$_id}[$field]" );
		$option = isset( $_get_option[ $field ] ) ? $_get_option[ $field ] : '';

		if ( $args && isset( $args['parent'] ) && isset( $args['count'] ) ) {
			$name   = esc_attr( "{$_id}[" . $args['parent'] . '][' . $args['count'] . "][$field]" );
			$id     = esc_attr( "{$_id}_" . $args['parent'] . '_' . $args['count'] . "_$field" );
			$option = isset( $_get_option[ $args['parent'] ][ $args['count'] ][ $field ] ) ? esc_attr( $_get_option[ $args['parent'] ][ $args['count'] ][ $field ] ) : '';
		}

		if ( 'text' == $type ) {
			$this->text( $field, $name, $id, $option, $args );
		}

		if ( 'textarea' == $type ) {
			$this->textarea( $field, $name, $id, $option, $args );
		}

		if ( 'number' == $type ) {
			$this->number( $field, $name, $id, $option, $args );
		}

		if ( 'code' == $type ) {
			$this->code( $field, $name, $id, $option );
		}

		if ( 'email' == $type ) {
			$this->email( $field, $name, $id, $option );
		}

		if ( 'url' == $type ) {
			$this->url( $field, $name, $id, $option );
		}

		if ( 'checkbox' == $type ) {
			$this->checkbox( $field, $name, $id, $option, $values, $args );
		}

		if ( 'select' == $type ) {
			$this->select( $field, $name, $id, $option, $values, $args );
		}

		if ( 'radio' == $type ) {
			$this->radio( $field, $name, $id, $option, $values, $args );
		}

		if ( 'media' == $type ) {
			$this->media( $field, $name, $id, $option, $args );
		}

		if ( 'date' == $type ) {
			$this->date( $field, $name, $id, $option );
		}

		if ( 'wp_editor' == $type ) {
			$this->wp_editor( $field, $name, $id, $option );
		}

		if ( 'repeat' == $type && method_exists( $this, $args['callback'] ) ) {
			$this->repeat( $field, $name, $option, $values, $args );
		}

		if ( 'color' == $type ) {
			$this->color( $field, $name, $id, $option, $args );
		}
	}


	/**
	 * text function.
	 *
	 * @access public
	 * @param mixed $field
	 * @param mixed $name
	 * @param mixed $id
	 * @param mixed $option
	 * @param mixed $args
	 * @return void
	 */
	public function text( $field, $name, $id, $option, $args ) {
		$value       = isset( $args['value'][ $field ] ) ? $args['value'][ $field ] : $option;
		$class_size  = isset( $args['atts']['size'] ) ? 'size="' . $args['atts']['size'] . '"' : 'class="regular-text"';
		$placeholder = isset( $args['atts']['placeholder'] ) ? ' placeholder="' . esc_attr( $args['atts']['placeholder'] ) . '"' : '';
		$readonly    = isset( $args['atts']['readonly_after_save'] ) && ! empty( $option ) ? ' readonly' : '';
	?>

		<input type="text" name="<?php echo $name; ?>" id="<?php echo $id; ?>" value="<?php echo $option; ?>"<?php echo $placeholder; ?> <?php echo $class_size; ?><?php echo $readonly; ?> />

	<?php }

	/**
	 * textarea function.
	 *
	 * @access public
	 * @param mixed $field
	 * @param mixed $name
	 * @param mixed $id
	 * @param mixed $option
	 * @param mixed $args
	 * @return void
	 */
	public function textarea( $field, $name, $id, $option, $args ) {
		$value       = isset( $args['value'][ $field ] ) ? $args['value'][ $field ] : $option;
	?>

		<textarea name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="large-text" rows="6"><?php echo stripslashes( esc_textarea( $option ) ); ?></textarea>

	<?php }


	/**
	 * number function.
	 *
	 * @access public
	 * @param mixed $field
	 * @param mixed $name
	 * @param mixed $id
	 * @param mixed $option
	 * @param mixed $args
	 * @return void
	 */
	public function number( $field, $name, $id, $option, $args ) {
		$value       = isset( $args['value'][ $field ] ) ? $args['value'][ $field ] : $option;
		$class_size  = isset( $args['atts']['size'] ) ? 'size="' . $args['atts']['size'] . '"' : 'class="regular-text"';
		$placeholder = isset( $args['atts']['placeholder'] ) ? ' placeholder="' . esc_attr( $args['atts']['placeholder'] ) . '"' : '';
	?>

		<input type="number" name="<?php echo $name; ?>" id="<?php echo $id; ?>" value="<?php echo $option; ?>"<?php echo $placeholder; ?> style="width: 50px;" />

	<?php }

	/**
	 * code function.
	 *
	 * @access public
	 * @param mixed $field
	 * @param mixed $name
	 * @param mixed $id
	 * @param mixed $option
	 * @return void
	 */
	public function code( $field, $name, $id, $option ) {
	?>

		<textarea name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="large-text" rows="15"><?php echo esc_textarea( $option ); ?></textarea>

	<?php }

	/**
	 * url function.
	 *
	 * @access public
	 * @param mixed $field
	 * @param mixed $name
	 * @param mixed $id
	 * @param mixed $option
	 * @return void
	 */
	public function url( $field, $name, $id, $option ) {
	?>

		<input type="url" name="<?php echo $name; ?>" id="<?php echo $id; ?>" value="<?php echo $option; ?>" class="regular-text" />

	<?php }

	/**
	 * email function.
	 *
	 * @access public
	 * @param mixed $field
	 * @param mixed $name
	 * @param mixed $id
	 * @param mixed $option
	 * @return void
	 */
	public function email( $field, $name, $id, $option ) {
	?>
		<input type="email" class="regular-text" value="<?php echo $option; ?>" id="<?php echo $id; ?>" name="<?php echo $name; ?>">

	<?php }

	/**
	 * checkbox function.
	 *
	 * @access public
	 * @param mixed $field
	 * @param mixed $name
	 * @param mixed $id
	 * @param mixed $option
	 * @param mixed $values
	 * @return void
	 */
	public function checkbox( $field, $name, $id, $option, $values ) {
	?>

		<?php foreach ( $values as $val => $label ) :
			$nameval = esc_attr( "{$name}[$val]" );
			$idval   = esc_attr( "{$id}_$val" );
			$check   = isset( $option[ $val ] ) ? $option[ $val ] : '';
		?>
			<p id="<?php sprintf( esc_attr( '%d', 'structr' ), $nameval ); ?>" class="structr-field">
				<input type="checkbox" name="<?php echo $nameval; ?>" id="<?php echo $idval; ?>" value="1"<?php echo checked( $check, 1, false ); ?> />

				<label for="<?php echo $idval; ?>"><?php echo $label; ?></label>
			</p>
		<?php endforeach; ?>

	<?php }

	/**
	 * select function.
	 *
	 * @access public
	 * @param mixed $field
	 * @param mixed $name
	 * @param mixed $id
	 * @param mixed $option
	 * @param mixed $values
	 * @return void
	 */
	public function select( $field, $name, $id, $option, $values ) {
		global $val, $label;
		$val = sprintf( esc_attr( '%d', 'structr' ), $val );
		$label = sprintf( esc_html( '%d', 'structr' ), $label );
	?>

		<select name="<?php echo $name; ?>" id="<?php echo $id; ?>">
			<?php foreach ( $values as $val => $label ) : ?>
				<option value="<?php echo $val ?>"<?php echo selected( $option, $val, false ); ?>><?php echo $label ?></option>
			<?php endforeach; ?>
		</select>

	<?php }

	/**
	 * radio function.
	 *
	 * @access public
	 * @param mixed $field
	 * @param mixed $name
	 * @param mixed $id
	 * @param mixed $option
	 * @param mixed $values
	 * @return void
	 */
	public function radio( $field, $name, $id, $option, $values ) {
		global $val, $label;
		$val = sprintf( esc_attr( '%d', 'structr' ), $val );
		$label = sprintf( esc_html( '%d', 'structr' ), $label );
	?>
		<fieldset><legend class="screen-reader-text"><span><?php echo $name; ?></span></legend><p>
			<?php foreach ( $values as $val => $label ) : ?>
			<label><input type="radio" <?php echo checked( $option, $val, false ); ?> value="<?php echo $val ?>" name="<?php echo $name; ?>"><?php echo $label ?></label><br>
			<?php endforeach; ?>
		</p></fieldset>

	<?php }

	/**
	 * repeat function.
	 *
	 * @access public
	 * @param mixed $field
	 * @param mixed $name
	 * @param mixed $option
	 * @param mixed $values
	 * @param mixed $args
	 * @return void
	 */
	public function repeat( $field, $name, $option, $values, $args ) {
		$r      = 0;
		$repeat = array(
			'parent' => $field,
			'count'  => 0,
			'value'  => $option,
		);

		$columns = isset( $args['columns'] ) ? ' columns-single columns-' . $args['columns'] : '';
		$col     = isset( $args['columns'] ) ? ' col' : '';
	?>

		<div class="structr-repeat">

			<?php if ( isset( $args['title'] ) ) : ?>
				<h3 class="structr-button-title"><?php echo esc_html( $args['title'] ); ?></h3>
			<?php endif; ?>

			<div class="structr-repeat-fields<?php echo $columns; ?>">

				<?php if ( ! is_array( $option ) ) : ?>

					<div id="new_repeat_field" class="structr-repeat-field<?php echo $col; ?>">

						<?php call_user_func( array( $this, $args['callback'] ), $repeat ); ?>

						<a href="#" class="structr-repeat-delete remove-button button"><?php _e( 'Remove Field', 'structr' ); ?></a>

					</div>

				<?php else : ?>

					<?php foreach ( $option as $field ) :
						$repeat['value'] = $field;
						$repeat['count'] = $r;
					?>

						<div id="new_repeat_field" class="structr-repeat-field<?php echo $col; ?>">

							<?php call_user_func( array( $this, $args['callback'] ), $repeat ); ?>

							<?php if ( ! isset( $args['show_delete'] ) ) : ?>
								<a href="#" class="structr-repeat-delete remove-button button"><?php _e( 'Remove Field', 'structr' ); ?></a>
							<?php endif; ?>

						</div>

					<?php $r++;
endforeach; ?>

				<?php endif; ?>

			</div>
			
			<a href="#" id="repeat_btn" class="structr-repeat-add button structr-spacer"><?php _e( 'Add New', 'structr' ); ?></a>

		</div>

		<?php wp_enqueue_script( 'structr-repeat' ); ?>

	<?php }

	/**
	 * media function.
	 *
	 * @access public
	 * @param mixed $field
	 * @param mixed $name
	 * @param mixed $id
	 * @param mixed $option
	 * @param mixed $args
	 * @return void
	 */
	public function media( $field, $name, $id, $option, $args ) {
		$value       = isset( $args['value'][ $field ] ) ? $args['value'][ $field ] : $option;
		$placeholder = isset( $args['atts']['placeholder'] ) ? ' placeholder="' . esc_attr( $args['atts']['placeholder'] ) . '"' : '';

		$src     = ! empty( $option ) ? $option : STRUC_API_IMG_URL . 'add-image.jpg';
		$display = ! empty( $option ) ? 'block' : 'none';
	?>

		<div class="structr-media">

			<p><img class="structr-media-preview-image" src="<?php echo $src; ?>" alt="<?php _e( 'Preview image', 'structr' ); ?>" /></p>

			<input type="url" class="structr-media-url regular-text" name="<?php echo $name; ?>" id="<?php echo $id; ?>" value="<?php echo $option; ?>" placeholder="<?php _e( 'http://', 'structr' ); ?>">

			<p class="structr-media-buttons">
				<input type="button" class="structr-media-remove button" value="<?php _e( 'Remove Image', 'structr' ); ?>" style="display: <?php echo $display; ?>;" />
			</p>

		</div>

		<?php wp_enqueue_media(); ?>
		<?php wp_enqueue_script( 'structr-media' ); ?>

	<?php }

	/**
	 * color function.
	 *
	 * @access public
	 * @param mixed $field
	 * @param mixed $name
	 * @param mixed $id
	 * @param mixed $option
	 * @param mixed $args
	 * @return void
	 */
	public function color( $field, $name, $id, $option, $args ) {
		$value       = isset( $args['value'][ $field ] ) ? $args['value'][ $field ] : $option;
		$placeholder = isset( $args['atts']['placeholder'] ) ? ' placeholder="' . esc_attr( $args['atts']['placeholder'] ) . '"' : '';
		$option      = ! empty( $option ) ? $option : $args['default'];
	?>

		<input type="text" name="<?php echo $name; ?>" id="<?php echo $id; ?>" value="<?php echo $option; ?>"<?php echo $placeholder; ?> class="structr-color-picker" />

		<?php wp_enqueue_style( 'wp-color-picker' ); ?>
		<?php wp_enqueue_script( 'structr-color-picker' ); ?>

	<?php }

	/**
	 * date function.
	 *
	 * @access public
	 * @param mixed $field
	 * @param mixed $name
	 * @param mixed $id
	 * @param mixed $option
	 * @return void
	 */
	public function date( $field, $name, $id, $option ) {
		$d_value = date( 'Y-m-d', strtotime( $option ) );
	?>
		<input type="date" name="<?php echo $name; ?>" value="<?php echo $d_value; ?>" class="jquery-ui-datepicker datepicker" id="<?php echo $id; ?>" />
		
		<?php wp_enqueue_script( 'jquery-ui-datepicker' ); ?>

	<?php }

	/**
	 * wp_editor function.
	 *
	 * @access public
	 * @param mixed $field
	 * @param mixed $name
	 * @param mixed $id
	 * @param mixed $option
	 * @return void
	 */
	public function wp_editor( $field, $name, $id, $option ) {
		global $wp_version;
		$rows = (isset( $field['rows'] )) ? $field['rows'] : 10;
		if ( $wp_version >= 3.3 && function_exists( 'wp_editor' ) ) {
			wp_editor( stripslashes( $option ), $id, array( 'textarea_name' => $name, 'textarea_rows' => $rows ) );
		} else {

		?>
		<textarea class="wp-core-ui wp-editor-wrap tmce-active" name="<?php echo $name; ?>" id="<?php echo $id; ?>" cols="80" rows="<?php echo $rows; ?>"><?php echo esc_textarea( stripslashes( $option ) ); ?></textarea>
		<?php } ?>
	<?php }

	/**
	 * label function.
	 *
	 * @access public
	 * @param mixed $field
	 * @param mixed $name
	 * @return void
	 */
	public function label( $field, $name ) {
	?>

		<label for="<?php sprintf( esc_attr_e( '%d', 'structr' ), "{$this->_id}_$field" ); ?>" class="structr-label"><?php echo $name; ?></label>

	<?php }

	/**
	 * desc function.
	 *
	 * @access public
	 * @param mixed $desc
	 * @return void
	 */
	public function desc( $desc ) {
	?>

		<p class="description"><?php echo $desc; ?></p>

	<?php }

}
