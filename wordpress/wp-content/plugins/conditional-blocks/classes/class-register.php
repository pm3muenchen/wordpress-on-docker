<?php
/**
 *  Class for registering Conditional Blocks.
 *
 * @package conditional-blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class for registering blocks.
 */
class Conditional_Blocks_Register_Blocks {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// Late prirotiy to make sure all blocks have been registered first.
		add_action( 'wp_loaded', array( $this, 'register_for_server_side_render' ), 999 );
	}

	/**
	 * Register the conditional blocks block attribute for each blocks
	 * This allows us to bypass the REST API error for server side rendered block.
	 * We are keeping this until this issue is resolved https://github.com/WordPress/gutenberg/issues/16850
	 */
	public function register_for_server_side_render() {

		$registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();

		foreach ( $registered_blocks as $name => $block ) {

			// Keep legacy conditions. We need them for converting.
			$block->attributes['conditionalBlocksAttributes'] = array(
				'type'    => 'object',
				'default' => array(),
			);

			$block->attributes['conditionalBlocks'] = array(
				'type'    => 'array',
				'default' => array(),
			);
		}

	}
}

new Conditional_Blocks_Register_Blocks();
