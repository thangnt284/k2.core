<?php
/**
 * Name: K2 FRAMEWORK
 * Author: K2 Team
 * Version: 1.0.0
 */

if ( ! class_exists( 'K2Framework' ) ) {
	class K2Framework {
		public $plugin_dir;
		public $plugin_url;
		public $theme_dir;
		public $k2_framework_dir;
		public $k2_framework_url;

        /**
         * K2Framework constructor.
         * @param null $file
         */
		public function __construct( $file = null ) {
			if ( ! isset( $file ) ) {
				$file = dirname( __FILE__ );
			}

			$this->plugin_dir = dirname( $file );
			$this->plugin_url = plugin_dir_url( $file );
			$this->theme_dir  = get_template_directory();

			$this->fsflex_dir = dirname( __FILE__ );
			$this->fsflex_url = plugin_dir_url( __FILE__ );
			add_action( 'admin_enqueue_scripts', array( $this, 'fs_register_fsflex_styles' ) );
			$this->file = $file;
		}


		/**
		 * CREATE AND SHOW SETTINGS PAGE
		 *
		 * @param array $options
		 * @param array $data_value
		 */
		public function fs_create_page_settings( $options = array(), $data_value = array() ) {

			$body = $this->fs_create_tabs__( $options, $data_value );

			$data = array(
				'slug'         => $options['slug'],
				'title'        => $options['title'],
				'description'  => $options['description'],
				'body'         => $body,
				'button_class' => 'btn-primary'
			);

			$this->fs_get_template_e( 'templates/ui/settings', $data );
		}


		/**
		 * CREATE AND SHOW TAB
		 *
		 * @param array $options
		 * @param array $data
		 */
		public function fs_create_tabs_e( $options = array(), $data = array() ) {
			echo $this->fs_create_tabs__( $options, $data );
		}


		/**
		 * CREATE TAB
		 *
		 * @param array $options
		 * @param array $data
		 *
		 * @return string
		 */
		public function fs_create_tabs__( $options = array(), $data = array() ) {
			$this->fs_add_enqueue_scripts( array(
				'jquery',
				'roboto',
				'animation',
				'material_icon',
				'bootstrap',
				'datetimepicker',
				'bootstrap_select',
				'tags_input',
				'jquery_spinner',
				'multi_select',
				'nouislider',
				'range_slider',
				'inputmask',
				'default_style',
				'custom'
			) );

			$options = array_merge( array(
				'slug' => 'example',
				'tabs' => array()
			), $options );

			$tabs = apply_filters( $options['slug'] . '/tabs', $options['tabs'] );
			if ( is_array( $tabs ) ) {
				foreach ( $tabs as $id => $tab ) {
					$tabs[ $id ]['content'] = isset( $tabs[ $id ]['content'] ) ? $tabs[ $id ]['content'] : '';
					if ( isset( $tab['fields'] ) ) {
						$fields = apply_filters( $options['slug'] . '/tabs/' . $id . '/fields', $tab['fields'] );
						if ( is_array( $fields ) ) {
							foreach ( $fields as $field ) {
								if ( $field['field'] !== 'custom' ) {
									if ( isset( $field['name'] ) ) {
										if ( isset( $data[ $field['name'] ] ) ) {
											if ( $data[ $field['name'] ] === 'on' ) {
												$field['checked'] = true;
											} else {
												$field['value'] = $data[ $field['name'] ];
											}
										}
										$field['name'] = "{$options['slug']}[{$field['name']}]";
									}
									$tabs[ $id ]['content'] .= $this->fs_create_element__( $field['element'], $field );

								} elseif
								( isset( $field['action'] ) ) {
									$tabs[ $id ]['content'] .= $this->fs_get_action_result( $field['action'] );
								}
							}
						}
					}
				}
			}

			return $this->fs_get_template__( 'templates/ui/tabs', array( 'tabs' => $tabs ) );
		}


		/** SHOW CUSTOM FIELD
		 *
		 * @param $action_name
		 *
		 * @return string
		 */
		public
		function fs_get_action_result(
			$action_name
		) {
			ob_start();
			do_action( $action_name );

			return ob_get_clean();
		}

		/** CREATE AND SHOW ROW
		 *
		 * @param string $element
		 * @param array $data
		 */
		public
		function fs_create_element_e(
			$element = 'field', $data = array()
		) {
			echo $this->fs_create_element__( $element, $data );
		}

		/** CREATE ROW
		 *
		 * @param string $element
		 * @param array $data
		 *
		 * @return string
		 */
		public
		function fs_create_element__(
			$element = 'field', $data = array()
		) {
			$data = array_merge( array(
				'label'   => '',
				'content' => ''
			), $data );

			if ( $element === 'field' ) {
				$data['content'] = $this->fs_create_field__( $data );
			}

			$template = "templates/elements/{$element}";

			return $this->fs_get_template__( $template, $data );
		}

		/** CREATE AND SHOW FIELD
		 *
		 * @param array $data
		 */
		public
		function fs_create_field_e(
			$data = array()
		) {
			echo $this->fs_create_field__( $data );
		}

		/** CREATE FIELD
		 *
		 * @param array $data
		 *
		 * @return string
		 */
		public
		function fs_create_field__(
			$data = array()
		) {
			$data = array_merge(
				array(
					'field'       => 'input',
					'type'        => 'text',
					'icon'        => null,
					'id'          => null,
					'class'       => null,
					'name'        => null,
					'value'       => null,
					'placeholder' => null,
					'options'     => array(),
					'description' => null,
					'checked'     => false,
				), $data );

			$template = "templates/fields/{$data['field']}";

			return $this->fs_get_template__( $template, $data );
		}

		/** GET AND SHOW TEMPLATE CONTENT
		 *
		 * @param $template
		 * @param array $data
		 * @param null $folder
		 */
		public
		function fs_get_template_e(
			$template, $data = array(), $folder = null
		) {
			echo $this->fs_get_template__( $template, $data, $folder );
		}

		/** GET TEMPLATE CONTENT
		 *
		 * @param $template
		 * @param array $data
		 * @param null $folder
		 *
		 * @return string
		 */
		public
		function fs_get_template__(
			$template_file, $data = array(), $folder = null
		) {
			$template = $this->fsflex_dir . DIRECTORY_SEPARATOR . $template_file . '.php';

			if ( isset( $folder ) ) {
				$template = $this->plugin_dir . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $template_file . '.php';
			}

			extract( $data );
			if ( file_exists( $template ) ) {
				ob_start();
				include $template;

				return ob_get_clean();
			} else {
				return $template;
			}
		}


		/** REQUIRE ALL FILE IN FOLDER
		 *
		 * @param $foldername
		 */
		public
		function fs_require_folder(
			$foldername
		) {
			$dir = $this->plugin_dir . DIRECTORY_SEPARATOR . $foldername;
			if ( ! is_dir( $dir ) ) {
				return;
			}
			$files = array_diff( scandir( $dir ), array( '..', '.' ) );
			foreach ( $files as $file ) {
				$patch = $dir . DIRECTORY_SEPARATOR . $file;
				if ( file_exists( $patch ) && strpos( $file, ".php" ) !== false ) {
					include_once $patch;
					$classname = substr( $file, 0, - 4 );
					if ( class_exists( $classname ) ) {
						${$classname} = new $classname();
					}
				}
			}
		}

		/**
		 * REGISTER STYLE AND SCRIPTS
		 */
		public
		function fs_register_fsflex_styles() {
			//animation
			wp_register_style( "waves.min.css", $this->fsflex_url . "assets/plugins/node-waves/waves.min.css" );
			wp_register_style( "animate.min.css", $this->fsflex_url . "assets/plugins/animate-css/animate.min.css" );
			wp_register_script( "waves.min.js", $this->fsflex_url . "assets/plugins/node-waves/waves.min.js", array(), '', true );

			//range_slider
			wp_register_style( "ion.rangeSlider.css", $this->fsflex_url . "assets/plugins/ion-rangeslider/css/ion.rangeSlider.css" );
			wp_register_style( "ion.rangeSlider.skinFlat.css", $this->fsflex_url . "assets/plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css" );
			wp_register_script( "ion.rangeSlider.js", $this->fsflex_url . "assets/plugins/ion-rangeslider/js/ion.rangeSlider.js", array(), '', true );

			//roboto
			wp_register_style( "roboto", "https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" );

			//bootstrap_notify
			wp_register_script( "bootstrap-notify.min.js", $this->fsflex_url . "assets/plugins/bootstrap-notify/bootstrap-notify.js", array(), '', true );

			//material_icon
			wp_register_style( "MaterialIcons", "https://fonts.googleapis.com/icon?family=Material+Icons" );

			//bootstrap
			wp_register_style( "bootstrap.min.css", $this->fsflex_url . "assets/plugins/bootstrap/css/bootstrap.min.css" );
			wp_register_script( "bootstrap.min.js", $this->fsflex_url . "assets/plugins/bootstrap/js/bootstrap.min.js", array(), '', true );

			//jquery_spinner
			wp_register_style( "bootstrap-spinner.min.css", $this->fsflex_url . "assets/plugins/jquery-spinner/css/bootstrap-spinner.min.css" );
			wp_register_script( "jquery.spinner.min.js", $this->fsflex_url . "assets/plugins/jquery-spinner/js/jquery.spinner.min.js", array(), '', true );

			//datetimepicker
			wp_register_style( "datetimepicker.css", $this->fsflex_url . "assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" );
			wp_register_script( "autosize.min.js", $this->fsflex_url . "assets/plugins/autosize/autosize.min.js", array(), '', true );
			wp_register_script( "moment.js", $this->fsflex_url . "assets/plugins/momentjs/moment.js", array(), '', true );
			wp_register_script( "datetimepicker.js", $this->fsflex_url . "assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js", array(), '', true );

			//bootstrap_select
			wp_register_script( "bootstrap-select.min.js", $this->fsflex_url . "assets/plugins/bootstrap-select/js/bootstrap-select.min.js", array(), '', true );
			wp_register_style( "bootstrap-select.css", $this->fsflex_url . "assets/plugins/bootstrap-select/css/bootstrap-select.min.css" );

			//tags_input
			wp_register_style( "bootstrap-tagsinput.css", $this->fsflex_url . "assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" );
			wp_register_style( "bootstrap-tagsinput-typeahead.css", $this->fsflex_url . "assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css" );
			wp_register_script( "typeahead.bundle.js", 'http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js', array(), '', true );
			wp_register_script( "bootstrap-tagsinput.min.js", $this->fsflex_url . "assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js", array(), '', true );

			//nouislider
			wp_register_style( "nouislider.min.css", $this->fsflex_url . "assets/plugins/nouislider/nouislider.min.css" );
			wp_register_script( "nouislider.js", $this->fsflex_url . 'assets/plugins/nouislider/nouislider.js', array(), '', true );

			//data_table
			wp_register_style( 'dataTables.bootstrap.css', $this->fsflex_url . 'assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css' );
			wp_register_script( "jquery.dataTables.js", $this->fsflex_url . "assets/plugins/jquery-datatable/jquery.dataTables.js", array(), '', true );
			wp_register_script( "dataTables.bootstrap.js", $this->fsflex_url . "assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js", array(), '', true );
			wp_register_script( "dataTables.buttons.min.js", $this->fsflex_url . "assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js", array(), '', true );
			wp_register_script( "buttons.flash.min.js", $this->fsflex_url . "assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js", array(), '', true );
			wp_register_script( "buttons.html5.min.js", $this->fsflex_url . "assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js", array(), '', true );
			wp_register_script( "buttons.print.min.js", $this->fsflex_url . "assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js", array(), '', true );

			//sweetalert
			wp_register_style( 'sweetalert.css', $this->fsflex_url . 'assets/plugins/sweetalert/sweetalert.css' );
			wp_register_script( "sweetalert.js", $this->fsflex_url . "assets/plugins/sweetalert/sweetalert.min.js", array(), '', true );

			//multi_select
			wp_register_style( 'multi-select.css', $this->fsflex_url . 'assets/plugins/multi-select/css/multi-select.css' );
			wp_register_script( "jquery.multi-select.js", $this->fsflex_url . "assets/plugins/multi-select/js/jquery.multi-select.js", array(), '', true );
			wp_register_script( "multi-select.js", $this->fsflex_url . "assets/js/multi-select.js", array(), '', true );

			//inputmask
			wp_register_script( 'jquery.inputmask.bundle.js', $this->fsflex_url . 'assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js', null, '', true );

			//Google map
			wp_register_script( "googlemap", 'https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAl72nEBR0IMB61ffnbTizORvrg68CBVpU', array(), '', true );
			wp_register_script( "fs-map.js", $this->fsflex_url . "assets/js/fs-map.js", array(), '', true );

			wp_register_style( "style.min.css", $this->fsflex_url . "assets/css/style.min.css" );
			wp_register_script( "admin.js", $this->fsflex_url . "assets/js/admin.js", array(), false, true );
			wp_register_script( "basic.form.elements.js", $this->fsflex_url . "assets/js/pages/forms/basic-form-elements.js", array(), '', true );
			wp_register_script( "advanced-form-elements.js", $this->fsflex_url . "assets/js/pages/forms/advanced-form-elements.js", array(), '', true );

			//custom
			wp_register_style( "fs-custom.css", $this->fsflex_url . "assets/css/fs-custom.css" );
			wp_register_script( 'fs-custom.js', $this->fsflex_url . 'assets/js/fs-custom.js', null, '', true );

		}

		/**ADD ENQUEUE SCRIPTS OR STYLES
		 *
		 * @param array $options
		 */
		public function fs_add_enqueue_scripts(
			$options = array()
		) {
//            var_dump($options);
			if ( in_array( 'jquery', $options ) ) {
				wp_enqueue_script( "jquery" );
			}

			if ( in_array( 'animation', $options ) ) {
				wp_enqueue_style( "waves.min.css" );
				wp_enqueue_style( "animate.min.css" );
				wp_enqueue_script( "waves.min.js" );
			}

			if ( in_array( 'range_slider', $options ) ) {
				wp_enqueue_style( "ion.rangeSlider.css" );
				wp_enqueue_style( "ion.rangeSlider.skinFlat.css" );
				wp_enqueue_script( "ion.rangeSlider.js" );
			}

			if ( in_array( 'roboto', $options ) ) {
				wp_enqueue_style( "roboto" );
			}

			if ( in_array( 'bootstrap_notify', $options ) ) {
				wp_enqueue_script( "bootstrap-notify.min.js" );
			}

			if ( in_array( 'material_icon', $options ) ) {
				wp_enqueue_style( "MaterialIcons" );
			}

			if ( in_array( 'bootstrap', $options ) ) {
				wp_enqueue_style( "bootstrap.min.css" );
				wp_enqueue_script( "bootstrap.min.js" );
			}

			if ( in_array( 'jquery_spinner', $options ) ) {
				wp_enqueue_style( "bootstrap-spinner.min.css" );
				wp_enqueue_script( "jquery.spinner.min.js" );
			}

			if ( in_array( 'datetimepicker', $options ) ) {
				wp_enqueue_style( "datetimepicker.css" );
				wp_enqueue_script( "autosize.min.js" );
				wp_enqueue_script( "moment.js" );
				wp_enqueue_script( "datetimepicker.js" );
			}


			if ( in_array( 'bootstrap_select', $options ) ) {
				wp_enqueue_style( "bootstrap-select.css" );
				wp_enqueue_script( "bootstrap-select.min.js" );
			}

			if ( in_array( 'tags_input', $options ) ) {
				wp_enqueue_style( "bootstrap-tagsinput.css" );
				wp_enqueue_style( "bootstrap-tagsinput-typeahead.css" );
				wp_enqueue_script( "typeahead.bundle.js" );
				wp_enqueue_script( "bootstrap-tagsinput.min.js" );
			}

			if ( in_array( 'nouislider', $options ) ) {
				wp_enqueue_style( "nouislider.min.css" );
				wp_enqueue_script( "nouislider.js" );
			}

			if ( in_array( 'data_table', $options ) ) {
				wp_enqueue_style( "dataTables.bootstrap.css" );
				wp_enqueue_script( "jquery.dataTables.js" );
				wp_enqueue_script( "dataTables.bootstrap.js" );
				wp_enqueue_script( "dataTables.buttons.min.js" );
				wp_enqueue_script( "buttons.flash.min.js" );
				wp_enqueue_script( "buttons.html5.min.js" );
				wp_enqueue_script( "buttons.print.min.js" );
			}

			if ( in_array( 'sweetalert', $options ) ) {
				wp_enqueue_style( "sweetalert.css" );
				wp_enqueue_script( "sweetalert.js" );
			}

			if ( in_array( 'sweetalert', $options ) ) {
				wp_enqueue_style( "multi-select.css" );
				wp_enqueue_script( "jquery.multi-select.js" );
				wp_enqueue_script( "multi-select.js" );
			}

			if ( in_array( 'inputmask', $options ) ) {
				wp_enqueue_script( "jquery.inputmask.bundle.js" );
			}

			if ( in_array( 'default_style', $options ) ) {
				wp_enqueue_style( 'style.min.css' );
				wp_enqueue_script( "admin.js" );
				wp_enqueue_script( "basic.form.elements.js" );
				wp_enqueue_script( "advanced-form-elements.js" );

			}

			if ( in_array( 'map', $options ) ) {
				wp_enqueue_script( 'googlemap' );
				wp_enqueue_script( 'fs-map.js' );
			}

			if ( in_array( 'custom', $options ) ) {
				wp_enqueue_media();
				wp_enqueue_style( "fs-custom.css" );
				wp_enqueue_script( 'fs-custom.js' );
			}
		}

		public function fs_get_template_file_e( $template, $data = array() ) {
			extract( $data );
			$template_file = $this->fs_get_template_file( $template );
			if ( $template_file !== false ) {
				ob_start();
				include $template_file;
				echo ob_get_clean();
			}
		}

		public function fs_get_template_file__( $template, $data = array() ) {
			extract( $data );
			$template_file = $this->fs_get_template_file( $template );
			if ( $template_file !== false ) {
				ob_start();
				include $template_file;
				return ob_get_clean();
			}
			return false;
		}

		public function fs_get_template_file( $template, $dir = null ) {

			if ( $dir === null ) {
				$dir = plugin_basename( $this->plugin_dir );
			}

			$template_file = $this->theme_dir . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $template . '.php';

			if ( file_exists( $template_file ) ) {
				return $template_file;
			} else {
				$template_file = $this->plugin_dir . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $template . '.php';
				if ( file_exists( $template_file ) ) {
					return $template_file;
				}
			}

			return false;
		}

	}
}