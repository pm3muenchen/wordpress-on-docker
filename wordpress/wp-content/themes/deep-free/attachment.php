<?php
/**
 * Deep Theme.
 * 
 * The template for displaying attachment pages
 *
 * @since   1.0.0
 * @author  Webnus
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Deep_Free_WN_Attachment extends Deep_Free_WN_Core_Templates {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     Deep_Free_WN_Attachment
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
	 * Define the core functionality of the attachment.php
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
			do_action( 'attachment_content' );
		} else {
			?>
			<section class="container page-content" >
				<hr class="vertical-space">
				<aside class="col-md-3 sidebar leftside">
					<?php
					if ( is_active_sidebar( 'Left Sidebar' ) ) {
						dynamic_sidebar( esc_html__( 'Left Sidebar', 'deep-free' ) );
					}
					?>
				</aside>
				<section class="col-md-8 omega">
					<article class="blog-single-post">
						<?php
						if ( have_posts() ) :
							while( have_posts() ) :
								the_post();
								?>
								<div <?php post_class( 'post' ); ?>>
									<h1><?php the_title(); ?></h1>
									<?php
									if ( wp_attachment_is_image( get_the_ID() ) ) {	
										echo wp_get_attachment_image( get_the_ID(), 'full' );
									}
									?>
								</div>
								<?php
							endwhile;
						endif;
						?>
					</article>
					<?php comments_template(); ?>
				</section>
				<div class="vertical-space3"></div>
			</section>
			<?php
		}
	}
}
// Run
Deep_Free_WN_Attachment::get_instance();
