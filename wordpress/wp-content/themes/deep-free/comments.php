<?php
/**
 * Deep Theme.
 * 
 * The template for displaying comments
 * 
 * @since   1.0.0
 * @author  Webnus
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Deep_Free_WN_Comments extends Deep_Free_WN_Core_Templates {

	/**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     Deep_Free_WN_Comments
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
	 * Define the core functionality of the comments.php
	 *
	 * @since	1.0.0
	 */
	public function __construct() {
		$this->deep_free_comments();
	}

	/**
	 * Render deep_free_comments.
	 * 
	 * @since	1.0.0
	 */
	private function deep_free_comments() {
		?>
		<div class="comments-wrap" id="comments">
			<div class="commentbox">
				<?php
				// Do not delete these lines
				if ( post_password_required() ) { ?>
					<p class="nocomments"><?php esc_html_e('This post is password protected. Enter the password to view comments.','deep-free'); ?></p>
					<?php
					return;
				}
				?>
				<div class="post-bottom-section">
					<div class="right">
						<?php if ( have_comments() ) : ?>
							<h4 class="comments-title">
								<strong><?php esc_html_e('Comments','deep-free'); ?></strong>
							</h4>
							<div class="navigation">
								<div class="alignleft"><?php previous_comments_link() ?></div>
								<div class="alignright"><?php next_comments_link() ?></div>
							</div>
							<ol class="commentlist">
								<?php wp_list_comments(); ?>
							</ol>
							<div class="navigation">
								<div class="alignleft"><?php previous_comments_link() ?></div>
								<div class="alignright"><?php next_comments_link() ?></div>
							</div>
						<?php endif; // have_comments() ?>
						<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :	?>
							<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'deep-free' ); ?></p>
						<?php endif; ?>
					</div>
				</div>
				<?php comment_form(); ?>
			</div>
		</div>
		<?php
	}
}
// Run
Deep_Free_WN_Comments::get_instance();
