<?php
/**
 * Plugin Name: Conditional Blocks
 * Author URI: https://conditionalblocks.com/
 * Description: Conditionally show or hide any Gutenberg Block for any reason.
 * Author: Conditional Blocks
 * Version: 2.0.1
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: conditional-blocks
 *
 * @package conditional_blocks
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define the plugin path.
if ( ! defined( 'CONDITIONAL_BLOCKS_PATH' ) ) {
	define( 'CONDITIONAL_BLOCKS_PATH', __FILE__ );
}

/**
 * CONBLOCK_Init int the plugin.
 */
class CONBLOCK_Init {
	/**
	 * Access all plugin constants
	 *
	 * @var array
	 */
	public $constants;

	/**
	 * Access notices class.
	 *
	 * @var class
	 */
	private $notices;

	/**
	 * Plugin init.
	 */
	public function __construct() {

		$this->constants = array(
			'name'           => 'Conditional Blocks',
			'version'        => '2.0.1',
			'slug'           => plugin_basename( __FILE__, ' . php' ),
			'base'           => plugin_basename( __FILE__ ),
			'name_sanitized' => basename( __FILE__, '. php' ),
			'path'           => plugin_dir_path( __FILE__ ),
			'url'            => plugin_dir_url( __FILE__ ),
			'file'           => __FILE__,
		);

		// include Notices.
		include_once plugin_dir_path( __FILE__ ) . 'classes/class-admin-notices.php';
		// Set notices to class.
		$this->notices = new conblock_admin_notices();
		// Activation.
		register_activation_hook( __FILE__, array( $this, 'activation' ) );
		// Load text domain.
		add_action( 'init', array( $this, 'load_textdomain' ) );
		// Load plugin when all plugins are loaded.
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	/**
	 * Load plugin textdomain.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'conditional-blocks', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}


	/**
	 * Plugin init.
	 */
	public function init() {


		require_once plugin_dir_path( __FILE__ ) . 'classes/class-register.php';
		require_once plugin_dir_path( __FILE__ ) . 'classes/class-rest.php';
		require_once plugin_dir_path( __FILE__ ) . 'classes/class-render.php';
		require_once plugin_dir_path( __FILE__ ) . 'classes/class-enqueue.php';

	}

	public function activation() {
		$text = __(
			'Thank you for installing Conditional Blocks! Select any block in the Block Editor to add conditions.   ',
			'conditional-blocks'
		) . '<a class="button button-secondary" target="_blank" href="' . esc_url( 'https://conditionalblocks.com/docs/?cb=activated-free' ) . '">' . __( 'Learn more', 'conditional-blocks' ) . '</a>';
		$this->notices->add_notice(
			'success',
			$text
		);

	}
}

new CONBLOCK_Init();

