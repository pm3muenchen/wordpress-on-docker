<?php
/**
 * Deep Theme.
 *
 * The main theme handler class is responsible for initializing Deep.
 *
 * @since   1.0.0
 * @author  Webnus
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'deep_free_main' ) ) {
	class deep_free_main {

		/**
		 * Instance of this class.
		 *
		 * @since   1.0.0
		 * @access  public
		 * @var     deep_free_main
		 */
		public static $instance;

		/**
		 * The modules variable holds all modules of the theme.
		 *
		 * @since   1.0.0
		 * @access  public
		 * @var     object
		 */
		public $modules = [];

		/**
		 * The current version of the theme.
		 *
		 * @since    1.0.0
		 */
		const VERSION = DEEP_VERSION;

		/**
		 * The theme prefix to reference classes inside it.
		 *
		 * @since   1.0.0
		 */
		const CLASS_PREFIX = 'WN_';

		/**
		 * Provides access to a single instance of a module using the singleton pattern.
		 *
		 * @since   1.0.0
		 * @return  object
		 */
		public static function get_instance() {
			if ( self::$instance === null ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Define the core functionality of the theme.
		 *
		 * Load the dependencies.
		 *
		 * @since   1.0.0
		 */
		public function __construct() {
			$this->load_autoloader();
			$this->call_modules();
		}

		/**
		 * Load autoloader of theme.
		 *
		 * @since   1.0.0
		 */
		public function load_autoloader() {			
			load_template( DEEP_INCLUDES_DIR . 'autoloader.php' );
		}

		/**
		 * Call all functionality modules.
		 *
		 * @since   1.0.0
		 */
		public function call_modules() {
			$this->modules['deep_free_autoloader'] = deep_free_autoloader::get_instance();
		}

	}

	// Run
	deep_free_main::get_instance();
}
