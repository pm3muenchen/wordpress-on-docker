<?php
/**
 * Deep Theme.
 *
 * The template for displaying author pages
 *
 * @since   1.0.0
 * @author  Webnus
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Deep_Free_WN_Author extends Deep_Free_WN_Core_Templates {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     Deep_Free_WN_Author
	 */
	public static $instance;

	/**
	 * Post foramt.
	 *
	 * @since   1.0.0
	 * @access  private
	 */
	private $post_format;

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
	 * Define the core functionality of the author.php
	 *
	 * @since   1.0.0
	 */
	public function __construct() {
		parent::__construct();
		add_action( 'wp_enqueue_scripts', array( $this, 'deep_free_script' ) );
		$this->get_header();
		$this->deep_free_content();
		$this->get_footer();
	}

	/**
	 * Render deep_free_content.
	 *
	 * @since   1.0.0
	 */	 
	private function deep_free_content() {
		?>
		<section id="main-content-pin">
			<hr class="vertical-space1">
			<div class="container">
				<div class="about-author-sec">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?>
					<h5><?php wp_kses_post( the_author() ); ?></h5>					
					<p><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
				</div>
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						if ( defined( 'DEEP_CORE_DIR' ) ) {
							do_action( 'author_content' );
						} else {
							?>
							<div <?php post_class( 'col-md-4' ); ?>>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
								<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
								<p>
								<?php
								$excerpt = explode( ' ', get_the_excerpt(), 50 );
								array_pop( $excerpt );
								$excerpt = implode( ' ', $excerpt ) . '...';
								echo wp_kses_post( $excerpt );
								?>
								</p>
							</div>
							<?php
						}
					endwhile;
				endif;
				?>
				<div class="vertical-space2"></div>
			</div>
			<section class="container aligncenter">
				<?php
				if ( function_exists( 'wp_pagenavi' ) ) {
					wp_pagenavi();
				} else {
					echo '<div class="wp-pagenavi">';
					next_posts_link( esc_html__( '&larr; Previous page', 'deep-free' ) );
					previous_posts_link( esc_html__( 'Next page &rarr;', 'deep-free' ) );
					echo '</div>';
				}
				?>
				<hr class="vertical-space2">
			</section>
		</section>
		<?php
	}

	/**
	 * enqueue script
	 *
	 * @since   1.0.0
	 */
	public function deep_free_script() {
		wp_enqueue_script( 'jquery-masonry' );
	}

}
// Run
Deep_Free_WN_Author::get_instance();
