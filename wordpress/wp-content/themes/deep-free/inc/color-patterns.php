<?php
/**
 * Deep Free: Color Patterns
 *
 * @package WordPress
 * @subpackage Deep Free
 * @since 1.0
 */

/**
 * Generate the CSS for the current primary color.
 */
function deep_free_custom_colors_css() {

	$primary_color = 199;
	if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
		$primary_color = absint( get_theme_mod( 'primary_color_hue', 199 ) );
	}

	/**
	 * Filter Deep Free default saturation level.
	 *
	 * @since Deep Free 1.0
	 *
	 * @param int $saturation Color saturation level.
	 */
	$saturation = apply_filters( 'deepfree_custom_colors_saturation', 100 );
	$saturation = absint( $saturation ) . '%';

	/**
	 * Filter Deep Free default selection saturation level.
	 *
	 * @since Deep Free 1.0
	 *
	 * @param int $saturation_selection Selection color saturation level.
	 */
	$saturation_selection = absint( apply_filters( 'deepfree_custom_colors_saturation_selection', 50 ) );
	$saturation_selection = $saturation_selection . '%';

	/**
	 * Filter Deep Free default lightness level.
	 *
	 * @since Deep Free 1.0
	 *
	 * @param int $lightness Color lightness level.
	 */
	$lightness = apply_filters( 'deepfree_custom_colors_lightness', 33 );
	$lightness = absint( $lightness ) . '%';

	/**
	 * Filter Deep Free default hover lightness level.
	 *
	 * @since Deep Free 1.0
	 *
	 * @param int $lightness_hover Hover color lightness level.
	 */
	$lightness_hover = apply_filters( 'deepfree_custom_colors_lightness_hover', 23 );
	$lightness_hover = absint( $lightness_hover ) . '%';

	/**
	 * Filter Deep Free default selection lightness level.
	 *
	 * @since Deep Free 1.0
	 *
	 * @param int $lightness_selection Selection color lightness level.
	 */
	$lightness_selection = apply_filters( 'deepfree_custom_colors_lightness_selection', 90 );
	$lightness_selection = absint( $lightness_selection ) . '%';

	echo '
		#wrap a,
		#wrap a:visited,
		#wrap .main-navigation .main-menu>li,
		#wrap .main-navigation ul.main-menu>li>a,
		#wrap .post-navigation .post-title,
		#wrap .entry .entry-meta a:hover,
		#wrap .entry .entry-footer a:hover,
		#wrap .entry .entry-content .more-link:hover,
		#wrap .main-navigation .main-menu>li>a+svg,
		#wrap blockquote:before,		
		#wrap .comment .comment-metadata>a:hover,
		#wrap .comment .comment-metadata .comment-edit-link:hover,
		#wrap #colophon .site-info a:hover,
		#wrap #commentform input[type=submit], .widget form input[type=submit]#searchsubmit, a.readmore,
		#wrap .widget a {
			color: hsl( ' . esc_html( $primary_color ) . ', ' . esc_html( $saturation ) . ', ' . esc_html( $lightness ) . ' );
		}

		.gallery-item > div > a:focus {
			box-shadow: 0 0 0 2px hsl( ' . esc_html( $primary_color ) . ', ' . esc_html( $saturation ) . ', ' . esc_html( $lightness ) . ' ); /* base: #0073a8; */
		}

		#wrap .commentbox h3.comment-reply-title:before,
		#wrap .commentbox h4.comments-title:before,
		#wrap .container.rec-posts h3.rec-title:before,
		.archive .wp-pagenavi a,
		.error404 h1.pnf404:before,
		#wrap .rec-posts-type3 h3.rec-posts-type3-title:before { 
			background: hsl( ' . esc_html( $primary_color ) . ', ' . esc_html( $saturation_selection ) . ', ' . esc_html( $lightness_selection ) . ' ); /* base: #005177; */
		}
		
		::selection {
			background-color: hsl( ' . esc_html( $primary_color ) . ', ' . esc_html( $saturation_selection ) . ', ' . esc_html( $lightness_selection ) . ' ); /* base: #005177; */
		}
		::-moz-selection {
			background-color: hsl( ' . esc_html( $primary_color ) . ', ' . esc_html( $saturation_selection ) . ', ' . esc_html( $lightness_selection ) . ' ); /* base: #005177; */
		}';
}
