<?php
/**
 * Deep Theme.
 * 
 * The template for displaying 404 pages (not found)
 * 
 * @since   1.0.0
 * @author  Webnus
 */

 
// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Deep_Free_WN_404 extends Deep_Free_WN_Core_Templates {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     Deep_Free_WN_404
	 */
	public static $instance;

	/**
	 * Provides access to a single instance of a module using the singleton pattern.
	 *
	 * @since   1.0.0
	 * @return	object
	 */
	public static function get_instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Define the core functionality of the 404.php
	 *
	 * @since	1.0.0
	 */
	public function __construct() {
		parent::__construct();
		$this->get_header();
		$this->deep_free_content();
		$this->get_footer();
	}

	/**
	 * Render deep_free_content.
	 * 
	 * @since	1.0.0
	 */
	private function deep_free_content() {
		if ( defined( 'DEEP_CORE_DIR' ) ) {
			do_action( 'notfound_page' );
		} else {
			?>
			<div class="wn-section clearfix">
				<div id="main-content" class="container">
					<h1 class="pnf404"><?php esc_html_e('404','deep-free'); ?></h1>
					<h2 class="pnf404"><?php esc_html_e('Page Not Found','deep-free'); ?></h2>
					<br>
					<h3><?php echo esc_html__( 'We are sorry, but the page you were looking for does not exist.', 'deep-free' ); ?></h3>
					<div>
						<?php get_search_form(); ?>
					</div>
					<hr class="vertical-space5">
				</div>
			</div>
			<?php
		}
	}
}
// Run
Deep_Free_WN_404::get_instance();