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

class Deep_Free_WN_Index extends Deep_Free_WN_Core_Templates {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     Deep_Free_WN_Index
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
	 * Define the core functionality of the theme.
	 *
	 * Load the dependencies.
	 *
	 * @since   1.0.0
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
	 * @since   1.0.0
	 */
	public function deep_free_content() {
		if ( defined( 'DEEP_CORE_DIR' ) ) {
			do_action( 'index_content' );
		} else {
			if ( is_archive() ) {
				echo '
				<section id="headline">
					<div class="container">
						<h2>';
				if ( is_day() ) :
					printf( '<small>' . esc_html__( 'Daily Archives', 'deep-free' ) . ':</small> %s', get_the_date() );
							elseif ( is_month() ) :
								printf( '<small>' . esc_html__( 'Monthly Archives', 'deep-free' ) . ':</small> %s', get_the_date( _x( 'F Y', 'monthly archives date format', 'deep-free' ) ) );
							elseif ( is_year() ) :
								printf( '<small>' . esc_html__( 'Yearly Archives', 'deep-free' ) . ':</small> %s', get_the_date( _x( 'Y', 'yearly archives date format', 'deep-free' ) ) );
							elseif ( is_category() ) :
								printf( '%s', single_cat_title( '', false ) );
							elseif ( is_tag() ) :
								printf( '<small>' . esc_html__( 'Tag', 'deep-free' ) . ':</small> %s', single_tag_title( '', false ) );
							else :
								echo esc_html__( 'Blog', 'deep-free' );
							endif;
							echo '
						</h2>
					</div>
				</section>';
			} else {
				echo '
				<section id="headline">
					<div class="container">
						<h2>' . esc_html__( 'Blog', 'deep-free' ) . '</h2>
					</div>
				</section>';
			}
			?>
			<hr class="vertical-space2">
			<div class="container">
				<aside class="col-md-3">
					<?php if( is_active_sidebar( 'Left Sidebar' ) ) dynamic_sidebar( esc_html__( 'Left Sidebar', 'deep-free' ) ); ?>
				</aside>
				<div class="col-md-9">
					<?php
					if ( have_posts() ) {
						// Load posts loop.
						while ( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/content/content' );
						}
						// Previous/next page navigation.
						if ( function_exists( 'deep_the_posts_navigation' ) ) {
							deep_the_posts_navigation(); 
						}

					} else {
						// If no content, include the "No posts found" template.
						get_template_part( 'template-parts/content/content', 'none' );
					}
					?>
				</div>
			</div>
			<?php
		} ?>
		<?php
	}
}
// Run
Deep_Free_WN_Index::get_instance();