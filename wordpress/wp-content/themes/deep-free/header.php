<?php
/**
 * Deep Theme.
 *
 * The header for our theme
 * This is the template that displays all of the <head> section and everything up until <div id="wrap">
 *
 * @since   1.0.0
 * @author  Webnus
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Deep_Free_WN_Header extends Deep_Free_WN_Core_Templates {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     Deep_Free_WN_Header
	 */
	public static $instance;

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
	 * Define the core functionality of the header.
	 *
	 * @since   1.0.0
	 */
	public function __construct() {
		parent::__construct();
		$this->deep_free_get_head();
	}

	/**
	 * Render head.
	 *
	 * @since   1.0.0
	 */
	private function deep_free_get_head() {
		if ( defined( 'DEEP_CORE_DIR' ) ) {
			do_action( 'header_content' );
		} else {
			?>
			<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
			<head>
				<meta charset="<?php bloginfo( 'charset' ); ?>">
				<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
				<meta name="viewport" content="width=1200,user-scalable=yes">				
				<link rel="profile" href="http://gmpg.org/xfn/11">
				<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
					<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">				
				<?php endif; ?>
				<?php wp_head(); ?>
			</head>
			<body <?php body_class(); ?> >
				<!-- Start the #wrap div -->
				<div id="wrap" class="wn-wrap">
					<div class="container">
						<header id="masthead" class="<?php echo is_singular() && deep_can_show_post_thumbnail() ? 'site-header featured-image' : 'site-header'; ?>">
							<div class="site-branding-container">
								<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
							</div><!-- .site-branding-container -->
						</header><!-- #masthead -->
					</div>
				<?php
		}
	}
}
// Run
Deep_Free_WN_Header::get_instance();
