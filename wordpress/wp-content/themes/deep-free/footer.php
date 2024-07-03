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

class Deep_Free_WN_Footer extends Deep_Free_WN_Core_Templates {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     Deep_Free_WN_Footer
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
	 * Define the core functionality of the footer.php
	 *
	 * @since	1.0.0
	 */
	public function __construct() {
		parent::__construct();
		$this->deep_free_footer();
	}

	/**
	 * Render deep_free_footer.
	 * 
	 * @since	1.0.0
	 */
	private function deep_free_footer() {
		if ( defined( 'DEEP_CORE_DIR' ) ) {
			do_action( 'footer_content' );
		} else {
			?>
			<footer id="footer" class="litex">
				<?php
				if ( is_active_sidebar( 'footer-section-1' ) || is_active_sidebar( 'footer-section-2' ) || is_active_sidebar( 'footer-section-3' ) || is_active_sidebar( 'footer-section-4' ) ) { ?>
					<section class="container footer-in">
						<div class="row">
							<div class="col-md-3"><?php if ( is_active_sidebar( 'footer-section-1' ) ) dynamic_sidebar( 'footer-section-1' ); ?></div>
							<div class="col-md-3"><?php if ( is_active_sidebar( 'footer-section-2' ) ) dynamic_sidebar( 'footer-section-2' ); ?></div>
							<div class="col-md-3"><?php if ( is_active_sidebar( 'footer-section-3' ) ) dynamic_sidebar( 'footer-section-3' ); ?></div>
							<div class="col-md-3"><?php if ( is_active_sidebar( 'footer-section-4' ) ) dynamic_sidebar( 'footer-section-4' ); ?></div>
						</div>
					</section>
				<?php
				}
				?>
			</footer>
			</div> <!-- end #wrap -->
			<?php wp_footer(); ?>
			</body>
			</html>
			<?php
		}
	}
}
// Run
Deep_Free_WN_Footer::get_instance();
