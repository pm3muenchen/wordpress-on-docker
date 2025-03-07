<?php
/**
 * Do things related with Gutentor settings
 *
 * @since 3.0.3
 */

if ( ! class_exists( 'Gutentor_Admin_Settings' ) ) {
	/**
	 * Class Gutentor_Admin_Settings.
	 */
	class Gutentor_Admin_Settings {

		protected static $page_slug = 'gutentor-settings';

		public function __construct() {

			add_action( 'admin_menu', array( __CLASS__, 'admin_pages' ) );
			add_action( 'admin_init', array( $this, 'gutentor_settings_init' ) );
			add_filter( 'register_post_type_args', array( $this, 'enable_rest_api' ), 20, 2 );
			add_filter( 'use_block_editor_for_post_type', array( $this, 'enable_gutenberg_post_type' ), 999, 2 );

			add_action( 'init', array( $this, 'add_page_templates_in_post_types' ) ,999);

		}


		/**
		 * Admin Page Menu and submenu page
		 *
		 * @since 3.0.3
		 */
		public static function admin_pages() {

			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			add_submenu_page(
				'gutentor',
				esc_html__( 'Settings', 'gutentor' ),
				esc_html__( 'Settings', 'gutentor' ),
				'manage_options',
				'gutentor-settings',
				array( __CLASS__, 'gutentor_settings_template' )
			);
		}

		/**
		 * Render Settings Template
		 *
		 * @since 3.0.3
		 */
		public static function gutentor_settings_template() {
			require_once GUTENTOR_PATH . 'includes/admin/templates/settings.php';
		}

		/**
		 * Gutentor settings
		 */
		public static function gutentor_settings_init() {

			// Register a new setting for "gutentor_settings" page.
			register_setting(
			        'gutentor_settings',
                'gutentor_settings_options',
                array(
                    'sanitize_callback' => array( __CLASS__, 'sanitize' ),
                )
            );

			/*General Settings*/
			add_settings_section(
				'gutentor_general_settings',
				'',
				'',
				'gutentor_general_settings'
			);

			// Register a new setting filed in the "gutentor_general_settings" section.
			add_settings_field(
				'gutentor_enable_editor_in_pt',
				esc_html__( 'Enable Gutenberg Editor in Post Types.', 'gutentor' ),
				array( __CLASS__, 'post_types_list_field' ),
				'gutentor_general_settings',
				'gutentor_general_settings'
			); // id, title, display cb, page, section

			/*
			 * How to add Page Templates to Post or Custom Post Types
			 * */
			add_settings_field(
				'gutentor_enable_g_page_templates_in_pt',
				esc_html__( 'Enable Gutentor Page Templates in Post Types.', 'gutentor' ),
				array( __CLASS__, 'post_types_page_template_field' ),
				'gutentor_general_settings',
				'gutentor_general_settings'
			); // id, title, display cb, page, section

            // Register gutentor_enable_import_block filed in the "gutentor_general_settings" section.
            add_settings_field(
                'gutentor_enable_import_block',
                esc_html__( 'Enable Template library in editor.', 'gutentor' ),
                array( __CLASS__, 'enable_import_block' ),
                'gutentor_general_settings',
                'gutentor_general_settings'
            ); // id, title, display cb, page, section

            // Register gutentor_enable_export_block filed in the "gutentor_general_settings" section.
            add_settings_field(
                'gutentor_enable_export_block',
                esc_html__( 'Enable Export Template Button.', 'gutentor' ),
                array( __CLASS__, 'enable_export_block' ),
                'gutentor_general_settings',
                'gutentor_general_settings'
            ); // id, title, display cb, page, section

           /*Edd Settings*/
            add_settings_section(
                'gutentor_edd_settings',
                '',
                '',
                'gutentor_edd_settings'
            );

            // Register a new setting filed in the "gutentor_general_settings" section.
            add_settings_field(
                'gutentor_enable_edd_demo_url',
                esc_html__( 'Enable Demo URL.', 'gutentor' ),
                array( __CLASS__, 'edd_demo_url' ),
                'gutentor_edd_settings',
                'gutentor_edd_settings'
            ); // id, title, display cb, page, section
		}

		/**
		 * Callback Function for Settings Field
		 * gutentor_enable_editor_in_pt
		 *
		 * @since 3.0.3
		 */
		public static function post_types_list_field() {
			$options = get_option( 'gutentor_settings_options' );
			$value   = array();
			if ( isset( $options['gutentor_enable_editor_in_pt'] ) && ! empty( $options['gutentor_enable_editor_in_pt'] ) ) {
				$value = $options['gutentor_enable_editor_in_pt'];
			}
			?>
			<label>
				<input type="checkbox" name="post" value="post" checked disabled/>
				<?php esc_attr_e( 'Post', 'gutentor' ); ?>
			</label>
			<br>
			<label>
				<input type="checkbox" name="page" value="page" checked disabled/>
				<?php esc_attr_e( 'Page', 'gutentor' ); ?>
			</label>
			<br>
			<?php
			$contents = gutentor_admin_get_post_types();
			foreach ( $contents as $post_type ) :
				?>
				<label>
					<input type="checkbox" name="gutentor_settings_options[gutentor_enable_editor_in_pt][]" value="<?php echo esc_attr( $post_type['value'] ); ?>" <?php echo in_array( $post_type['value'], $value ) ? 'checked' : ''; ?>/>
					<?php echo $post_type['label']; ?>
				</label>
				<br>
				<?php
			endforeach;
			esc_html_e( 'Enabling Gutenberg Editor will also enable show_in_rest in post types.', 'gutentor' );
		}

		/**
		 * Callback Function for Settings Field
		 * gutentor_enable_g_page_templates_in_pt
		 *
		 * @since 3.0.3
		 */
		public static function post_types_page_template_field() {
			$options = get_option( 'gutentor_settings_options' );
			$value   = array();
			if ( isset( $options['gutentor_enable_page_templates_in_pt'] ) && ! empty( $options['gutentor_enable_page_templates_in_pt'] ) ) {
				$value = $options['gutentor_enable_page_templates_in_pt'];
			}
			?>
			<label>
				<input type="checkbox" name="page" value="page" checked disabled/>
				<?php esc_attr_e( 'Page', 'gutentor' ); ?>
			</label>
			<br>
			<?php
			$contents = gutentor_admin_get_post_types( array(), array( 'post' ) );
			foreach ( $contents as $post_type ) :
				?>
				<label>
					<input type="checkbox" name="gutentor_settings_options[gutentor_enable_page_templates_in_pt][]" value="<?php echo esc_attr( $post_type['value'] ); ?>" <?php echo in_array( $post_type['value'], $value ) ? 'checked' : ''; ?>/>
					<?php echo $post_type['label']; ?>
				</label>
				<br>
				<?php
			endforeach;
		}

        /**
         * Enable Template Library
         * gutentor_enable_import_block
         *
         * @since 3.0.3
         */
        public static function enable_import_block() {
            $value = gutentor_setting_enable_template_library();
            ?>
            <label>
                <input type="checkbox" name="gutentor_settings_options[gutentor_enable_import_block]" value="1" <?php checked($value,1)?>/>
                <?php esc_attr_e( 'Check to enable', 'gutentor' ); ?>
            </label>
            <br>
            <?php
        }

        /**
         * Enable Export Template
         * gutentor_enable_export_block
         *
         * @since 3.0.3
         */
        public static function enable_export_block() {
            $value = gutentor_setting_enable_export_template_button();
            ?>
            <label>
                <input type="checkbox" name="gutentor_settings_options[gutentor_enable_export_block]" value="1" <?php checked($value,1)?>/>
                <?php esc_attr_e( 'Check to enable', 'gutentor' ); ?>
            </label>
            <br>
            <?php
        }

        /**
         * EDD Demo URL
         * gutentor_enable_edd_demo_url
         *
         * @since 3.0.3
         */
        public static function edd_demo_url() {
            $options = get_option( 'gutentor_settings_options' );
            $value   = false;
            if ( isset( $options['gutentor_enable_edd_demo_url'] ) && ! empty( $options['gutentor_enable_edd_demo_url'] ) ) {
                $value = $options['gutentor_enable_edd_demo_url'];
            }
            ?>
            <label>
                <input type="checkbox" name="gutentor_settings_options[gutentor_enable_edd_demo_url]" value="1" <?php checked($value,1)?>/>
                <?php esc_attr_e( 'Check to enable', 'gutentor' ); ?>
            </label>
            <br>
            <?php
        }

		/**
		 * Enable rest api post types
		 *
		 * @since 3.0.3
		 */
		public static function enable_rest_api( $args, $post_type ) {

			$gutentor_settings = get_option( 'gutentor_settings_options' );
			if ( isset( $gutentor_settings['gutentor_enable_editor_in_pt'] ) ) {
				$gutenberg_enable_post_types = $gutentor_settings['gutentor_enable_editor_in_pt'];
				if ( in_array( $post_type, $gutenberg_enable_post_types ) ) {
					$args['show_in_rest'] = true;
				}
			}
			return $args;
		}

		/**
		 * Enable Gutenberg Editor in Post Types
		 *
		 * @since 3.0.3
		 */
		public static function enable_gutenberg_post_type( $can_edit, $post_type ) {

			$gutentor_settings = get_option( 'gutentor_settings_options' );
			if ( isset( $gutentor_settings['gutentor_enable_editor_in_pt'] ) ) {
				$gutenberg_enable_post_types = $gutentor_settings['gutentor_enable_editor_in_pt'];
				if ( in_array( $post_type, $gutenberg_enable_post_types ) ) {
					return true;
				}
			}
			return $can_edit;
		}

		/**
		 * How to add Page Templates to Post or Custom Post Types
		 * https://www.gutentor.com/documentation/article/how-to-add-page-templates-to-post-or-custom-post-types/
		 *
		 * @since 3.0.3
		 */
		public function add_page_templates_in_post_types() {
			$pts               = array();
			$pts[]             = 'page';
			$gutentor_settings = get_option( 'gutentor_settings_options' );
			if ( isset( $gutentor_settings['gutentor_enable_page_templates_in_pt'] ) ) {
				$pt = maybe_unserialize( $gutentor_settings['gutentor_enable_page_templates_in_pt'] );
				if ( is_array( $pt ) && ! empty( $pt ) ) {
					foreach ( $pt as $p ) {
						$pts[] = $p;
					}
				}
			}
			if( !is_array( $pts)){
			    return;
            }
			foreach ( $pts as $p ) {
				add_filter( 'theme_' . $p . '_templates', array( gutentor_hooks(), 'gutentor_add_page_template' ) );
			}
			if( in_array('page', $pts)){
                add_filter( 'page_template', [ gutentor_hooks(), 'gutentor_redirect_page_template' ] );
            }
			if( count(array_diff( $pts, array('page') )) > 0){
                add_filter( 'single_template', [ gutentor_hooks(), 'gutentor_redirect_page_template' ] );
            }
		}

        /**
         * Add sanitize
         * sanitize
         *
         * @since 3.0.3
         */
        public static function sanitize($setting) {
            $new_setting = array();
            $check_import_block = $check_export_block = false;
            if(is_array($setting)) {
                foreach ($setting as $key => $value) {
                    if ('gutentor_enable_import_block' == $key) {
                        $new_setting[$key] = (isset($value) && '1' == $value) ? "1" : "0";
                        $check_import_block = true;
                    } elseif ('gutentor_enable_export_block' == $key) {
                        $new_setting[$key] = (isset($value) && '1' == $value) ? "1" : "0";
                        $check_export_block = true;
                    } else {
                        $new_setting[$key] = $value;
                    }
                }
            }
            if(!$check_import_block){
                $new_setting['gutentor_enable_import_block'] = "0";
            }
            if(!$check_export_block){
                $new_setting['gutentor_enable_export_block'] = "0";
            }
            return  $new_setting;
        }
	}
}
new Gutentor_Admin_Settings();
