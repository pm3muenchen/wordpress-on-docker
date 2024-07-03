<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.1
 * @author     Thomas Griffin
 * @author     Gary Jones
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

load_template( get_template_directory() . '/inc/plugins/plugin-activator/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'deep_free_register_required_plugins' );
function deep_free_register_required_plugins() {
	$plugin_url = is_ssl() ? 'https://deeptem.com' : 'http://deeptem.com';
	if ( defined( 'DEEPFREE') ) {
		$plugins    = array(
			array(
				'name'      => esc_html__( 'Elementor', 'deep-free' ),
				'slug'      => 'elementor',
				'required'  => false,
				'image_src' => get_template_directory_uri() . '/inc/plugins/plugin-activator/images/dp-admin-plugins-pix43.jpg',
				'category'  => 'builder free',
			),		
			array(
				'name'      => esc_html__( 'Modern events calendar lite', 'deep-free' ),
				'slug'      => 'modern-events-calendar-lite',
				'required'  => false,
				'image_src' => get_template_directory_uri() . '/inc/plugins/plugin-activator/images/dp-admin-plugins-pix08.jpg',
				'category'  => 'free',
			),
			array(
				'name'      => esc_html__( 'Contact Form 7', 'deep-free' ),
				'slug'      => 'contact-form-7',
				'required'  => false,
				'image_src' => get_template_directory_uri() . '/inc/plugins/plugin-activator/images/dp-admin-plugins-pix22.jpg',
				'category'  => 'free',
			),		
			array(
				'name'      => esc_html__( 'WP PageNavi', 'deep-free' ),
				'slug'      => 'wp-pagenavi',
				'required'  => false,
				'image_src' => get_template_directory_uri() . '/inc/plugins/plugin-activator/images/dp-admin-plugins-pix21.jpg',
				'category'  => 'free',
			),
			array(
				'name'      => esc_html__( 'WP Cloudy', 'deep-free' ),
				'slug'      => 'wp-cloudy',
				'required'  => false,
				'image_src' => get_template_directory_uri() . '/inc/plugins/plugin-activator/images/dp-admin-plugins-pix21.jpg',
				'category'  => 'free',
			),
			array(
				'name'      => esc_html__( 'Post Rating', 'deep-free' ),
				'slug'      => 'post-ratings',
				'required'  => false,
				'image_src' => get_template_directory_uri() . '/inc/plugins/plugin-activator/images/dp-admin-plugins-pix21.jpg',
				'category'  => 'free',
			),
			array(
				'name'      => esc_html__( 'Deeper Comments', 'deep-free' ),
				'slug'      => 'deeper-comments',
				'required'  => false,
				'image_src' => get_template_directory_uri() . '/inc/plugins/plugin-activator/images/dp-admin-plugins-pix05.jpg',
				'category'  => 'free',
			),
			array(
				'name'      => esc_html__( 'Social Count Plus', 'deep-free' ),
				'slug'      => 'social-count-plus',
				'required'  => false,
				'image_src' => get_template_directory_uri() . '/inc/plugins/plugin-activator/images/dp-admin-plugins-pix21.jpg',
				'category'  => 'free',
			),
		);
	} else {
		$plugins    = array(
			array(
				'name'				=> esc_html__( 'Deep Core', 'deep-free' ),
				'slug'				=> 'deepcore',
				'source'			=> $plugin_url .'/deep-downloads/download.php?deepcore',
				'version'           => '1.0.1'
			),
		);
	}
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => false,                   // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);
	tgmpa( $plugins, $config );
}
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( $disable_updater = true );
}
