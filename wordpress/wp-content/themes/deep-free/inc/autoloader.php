<?php
/**
 * Deep Theme.
 * 
 * Deep autoloader handler class is responsible for loading the different
 * classes needed to run the theme.
 *
 * @since   1.0.0
 * @author  Webnus
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'deep_free_autoloader' ) ) {
	class deep_free_autoloader {

		/**
		 * Instance of this class.
         *
		 * @since	1.0.0
		 * @access	private
		 * @var		deep_free_autoloader
		 */
		private static $instance;

		/**
		 * File names.
         *
		 * @since	1.0.0
		 * @access	private
		 */
		private static $file_names = [
			'Deep_Free_WN_404'				=> '404.php',
			'Deep_Free_WN_Archive'			=> 'archive.php',
			'Deep_Free_WN_Rooms_Archive'	=> 'archive-room.php',
			'Deep_Free_WN_Archive_Gallery'	=> 'archive-gallery.php',
			'Deep_Free_WN_Attachment'		=> 'attachment.php',
			'Deep_Free_WN_Author'			=> 'author.php',
			'Deep_Free_WN_Buddypress'		=> 'buddypress.php',
			'Deep_Free_WN_Comments'			=> 'comments.php',
			'Deep_Free_WN_Core_Templates'   => 'core-templates.php',
			'Deep_Free_WN_Footer'			=> 'footer.php',
			'Deep_Free_WN_Header'			=> 'header.php',
			'Deep_Free_WN_Index'			=> 'index.php',
			'Deep_Free_WN_Page'				=> 'page.php',
		];

		/**
		 * Provides access to a single instance of a module using the singleton pattern.
		 *
		 * @since	1.0.0
		 * @return	object
		 */
		public static function get_instance() {
			if ( self::$instance === null ) {
				self::$instance = new self();
            }
			return self::$instance;
		}

		/**
		 * Constructor.
		 *
		 * @since	1.0.0
		 */
		protected function __construct() {
			spl_autoload_register( [ $this, 'load_dependencies' ] );
		}

		/**
		 * Loads all the WEBNUS Header Builder dependencies.
		 *
		 * @since	1.0.0
		 */
		private function load_dependencies( $class ) {
			if ( strpos( $class, deep_free_main::CLASS_PREFIX ) !== false ) {
				$path = DEEP_DIR . self::$file_names[$class];				
				load_template( $path );
			}
		}

	}
}
