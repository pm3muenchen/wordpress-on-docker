<?php
/**
 * Accessibility functions
 * @package free
 * @author webnus
 * @since 1.0.0
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class deep_free_accessibility {
    /**
	 * Instance of this class.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     Deep_Free_WN_Core_Templates
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
		add_action( 'wp_enqueue_scripts', array( $this, 'deep_free_enqueue_scripts' ) );		
		add_action( 'comment_post', array( $this, 'deep_free_ajax_comments' ), 20, 2 );		
		add_filter( 'genesis_attr_site-inner', array( $this, 'deep_free_theme_add_content_id' ), 15 );				
		add_action( 'genesis_before', array( $this, 'deep_free_theme_add_skip_link' ), 1 );	
		if ( ! function_exists( 'deep_free_excerpt_more' ) && ! is_admin() ) {
			add_filter( 'excerpt_more', array( $this, 'deep_free_excerpt_more' ) );		
		}
	}

    /**
	 * Enqueue scripts.
	 *
	 * @since   1.0.0
	 */
    public function deep_free_enqueue_scripts() {
		/**
		* Enqueue scripts to handle AJAX comments. Localize script to pass translated responses.
		* Enqueue comment-reply scripts.
		*/
		if ( is_singular() && comments_open() ) {			
			wp_enqueue_script( 'deep-free-accessibility', DEEP_URL . '/assets/dist/js/frontend/comments.js', ['jquery'], DEEP_VERSION, true );
			$comment_i18n = array( 
				'processing' => __( 'Processing...', 'deep-free' ),
				/* translators: %s: comment */
				'flood' => sprintf( __( 'Your comment was either a duplicate or you are posting too rapidly. <a href="%s">Edit your comment</a>', 'deep-free' ), '#comment' ),
				'error' => __( 'There were errors in submitting your comment; complete the missing fields and try again!', 'deep-free' ),
				'emailInvalid' => __( 'That email appears to be invalid.', 'deep-free' ),
				'required' => __( 'This is a required field.', 'deep-free' )
			);
			wp_localize_script( 'deep-free-accessibility', 'deepFreeComments', $comment_i18n );			
		}		

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		/**		
		* Enqueue dropdown scripts.
		*/		
		wp_enqueue_script( 'deep-free-navigation', DEEP_URL . '/assets/dist/js/frontend/dropdown.js', array(), DEEP_VERSION, true );	
		
		/**		
		* Enqueue skiplink-fix scripts.
		*/		
		wp_enqueue_script( 'theme_skiplink-fix', DEEP_URL . '/assets/dist/js/frontend/skiplink-fix.js', array(), DEEP_VERSION, true );	

		/**		
		* Enqueue navigation scripts.
		*/		
		wp_enqueue_script( 'deep-free-menu-arrow-nav', DEEP_URL . '/assets/dist/js/frontend/navigation.js', ['jquery'], DEEP_VERSION, true );

		/**		
		* Enqueue skip-link-focus-fix scripts.
		*/	
		wp_enqueue_script( 'deep-free-skip-link-focus-fix', DEEP_URL . '/assets/dist/js/frontend/skip-link-focus-fix.js', array(), DEEP_VERSION, true );
	}
	
	/**
	* Provide responses to comments.js based on detecting an XMLHttpRequest parameter.
	*
	* @param $comment_ID     ID of new comment.
	* @param $comment_status Status of new comment. 
	*
	* @return echo JSON encoded responses with HTML structured comment, success, and status notice.
	*/
	function deep_free_ajax_comments( $comment_ID, $comment_status ) {
		if ( strtolower( wp_unslash( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ) ) ) {
			
			// This is an AJAX request. Handle response data. 
			switch ( $comment_status ) {
				case '0':
					// Comment needs moderation; notify comment moderator.
					wp_notify_moderator( $comment_ID );
					$return = array( 
						'response' => '', 
						'success'  => 1, 
						'status'   => __( 'Your comment has been sent for moderation. It should be approved soon!', 'deep-free' ) 
					);
					wp_send_json( $return );
					break;
				case '1':
					// Approved comment; generate comment output and notify post author.
					$comment            = get_comment( $comment_ID );
					$comment_class      = comment_class( 'deep-free-ajax-comment', $comment_ID, $comment->comment_post_ID, false );
					
					$comment_output     = '
							<li id="comment-' . $comment->comment_ID . '"' . $comment_class . ' tabindex="-1">
								<article id="div-comment-' . $comment->comment_ID . '" class="comment-body">
									<footer class="comment-meta">
									<div class="comment-author vcard">'.
										get_avatar( $comment->comment_author_email )
										.'<b class="fn">' . __( 'You said:', 'deep-free' ) . '</b> </div>
									<div class="comment-meta commentmetadata"><a href="#comment-'. $comment->comment_ID .'">' . 
										get_comment_date( 'F j, Y \a\t g:i a', $comment->comment_ID ) .'</a>
									</div>
									</footer>
									
									<div class="comment-content">' . $comment->comment_content . '</div>
								</article>
							</li>';
					
					if ( $comment->comment_parent == 0 ) {
						$output = $comment_output;
					} else {
						$output = "<ul class='children'>$comment_output</ul>";
					}

					wp_notify_postauthor( $comment_ID );
					$return = array( 
						'response'=>$output, 
						'success' => 1, 
						/* translators: %s: comment */
						'status'=> sprintf( __( 'Thanks for commenting! Your comment has been approved. <a href="%s">Read your comment</a>', 'deep-free' ), "#comment-$comment_ID" ) 
					);
					wp_send_json( $return );
					break;
				default:
					// The comment status was not a valid value. Only 0 or 1 should be returned by the comment_post action.
					$return = array( 
						'response' => '', 
						'success'  => 0, 
						'status'   => __( 'There was an error posting your comment. Try again later!', 'deep-free' ) 
					);
					wp_send_json( $return );
			}
		}
	}

	/**
    * Adds "inner" id to the site-inner content/sidebar wrap element on HTML5 child themes.
    * Using inner, since Genesis uses this id when HTML5 is disabled.
    * @param  array $attributes Array of element attributes
    * @return array Same array of element attributes with the id added
    */
    function deep_free_theme_add_content_id( $attributes ) {
        $attributes['id'] = "inner";

        return $attributes;
	}    
	
	/**
    * Add a link first thing after the body element that will skip to the inner element.
    */
    function deep_free_theme_add_skip_link() {
		
        echo '<a class="skip-link" href="#inner">' . esc_html__('Skip to content', 'deep-free') . '</a>';
	}    
	
	/**
	* Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
	*
	* @since 1.0
	*
	* @return string 'Continue reading' link prepended with an ellipsis.
	*/
	function deep_free_excerpt_more( $more ) {
		$deep_free_link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( __( 'Continue reading %s', 'deep-free' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
			);
		return ' &hellip; ' . $deep_free_link;
	}			

}

// Run
deep_free_accessibility::get_instance();