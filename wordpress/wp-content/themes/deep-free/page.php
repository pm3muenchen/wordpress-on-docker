<?php
/**
 * Deep Theme.
 * 
 * The template for displaying all pages
 *
 * @since   1.0.0
 * @author  Webnus
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Deep_Free_WN_Page extends Deep_Free_WN_Core_Templates {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     Deep_Free_WN_Page
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
	 * Define the core functionality of the theme.
	 *
	 * Load the dependencies.
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
			do_action( 'page_content' );
		} else {
			?>
			<section id="headline" class="page-title">
				<div class="container">
					<h1><?php the_title(); ?></h1>
				</div>
			</section>
			<section id="main-content" class="container">
				<aside class="col-md-3 sidebar leftside">
					<?php if( is_active_sidebar( 'Left Sidebar' ) ) dynamic_sidebar( esc_html__( 'Left Sidebar', 'deep-free' ) ); ?>
				</aside>
				<?php
				if ( have_posts() ) :
					while( have_posts() ):
						the_post();
						?>
						<div class="col-md-9 cntt-w">
							<?php
							the_post_thumbnail();
							the_content();
							?>
						</div>
						<?php
					endwhile;
				endif;
				?>
			</section>
			<?php
			// Comment template
			echo '<div class="container">';
			wp_link_pages();
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			echo '</div>';
		}
	}
}

// Run
Deep_Free_WN_Page::get_instance();