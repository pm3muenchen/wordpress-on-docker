<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Gutentor_P1' ) ) {

	/**
	 * Functions related to Blog Post
	 *
	 * @package Gutentor
	 * @since 1.0.1
	 */

	class Gutentor_P1 extends Gutentor_Block_Base {

		/**
		 * Name of the block.
		 *
		 * @access protected
		 * @since 1.0.1
		 * @var string
		 */
		protected $block_name = 'p1';

		/**
		 * Gets an instance of this object.
		 * Prevents duplicate instances which avoid artefacts and improves performance.
		 *
		 * @static
		 * @access public
		 * @since 1.0.1
		 * @return object
		 */
		public static function get_instance() {

			// Store the instance locally to avoid private static replication
			static $instance = null;

			// Only run these methods if they haven't been ran previously
			if ( null === $instance ) {
				$instance = new self();
			}

			// Always return the instance
			return $instance;

		}

		/**
		 * Load Dependencies
		 * Used for blog template loading
		 *
		 * @since      1.0.1
		 * @package    Gutentor
		 * @author     Gutentor <info@gutentor.com>
		 */
		public function load_dependencies() {

			require_once GUTENTOR_PATH . 'includes/block-templates/normal/class-normal-p1-templates.php';
			require_once GUTENTOR_PATH . 'includes/block-templates/normal/class-normal-p1-woo-templates.php';
			require_once GUTENTOR_PATH . 'includes/block-templates/normal/class-normal-p1-edd-templates.php';
		}

		/**
		 * Returns attributes for this Block
		 *
		 * @static
		 * @access public
		 * @since 1.0.1
		 * @return array
		 */
		public function get_attrs() {
			$blog_post_attr = array(
				'gID'                             => array(
					'type'    => 'string',
					'default' => '',
				),
				/*column*/
				'blockItemsColumn'                => array(
					'type'    => 'object',
					'default' => array(
						'desktop' => 'grid-md-4',
						'tablet'  => 'grid-sm-4',
						'mobile'  => 'grid-xs-12',
					),
				),
				'timestamp'                       => array(
					'type'    => 'number',
					'default' => 0,
				),
				'gName'                           => array(
					'type'    => 'string',
					'default' => 'gutentor/p1',
				),
				'p1Temp'                          => array(
					'type'    => 'string',
					'default' => 'gutentor_p1_template1',
				),
				'gStyle'                          => array(
					'type'    => 'string',
					'default' => 'gutentor-blog-grid',
				),
				'pTaxTerm'                        => array(
					'type'  => 'array',
					'items' => array(
						'type'  => 'object',
						'label' => array(
							'type' => 'string',
						),
						'value' => array(
							'type' => 'number',
						),
					),
				),
				'pTaxType'                        => array(
					'type'    => 'string',
					'default' => 'category',
				),
				'pPostType'                       => array(
					'type'    => 'string',
					'default' => 'post',
				),
				'pIncludePosts'                   => array(
					'type' => 'string',
				),
				'pExcludePosts'                   => array(
					'type' => 'string',
				),
				'pOffsetPosts'                    => array(
					'type' => 'number',
				),
				'postsToShow'                     => array(
					'type'    => 'number',
					'default' => 6,
				),
				'order'                           => array(
					'type'    => 'string',
					'default' => 'desc',
				),
				'orderBy'                         => array(
					'type'    => 'string',
					'default' => 'date',
				),
				'pNoFoundTxt'                     => array(
					'type'    => 'string',
					'default' => 'Nothing Found',
				),
				'categories'                      => array(
					'type'    => 'string',
					'default' => '',
				),
				'gutentorBlogPostImageLink'       => array(
					'type'    => 'boolean',
					'default' => false,
				),
				'pReverseContent'                 => array(
					'type'    => 'boolean',
					'default' => false,
				),
				'pOnColInList'                    => array(
					'type'    => 'boolean',
					'default' => false,
				),
				'gutentorBlogPostImageLinkNewTab' => array(
					'type'    => 'boolean',
					'default' => false,
				),
			);
			$blog_partial_attrs = array_merge_recursive( $blog_post_attr, $this->get_module_common_attrs() );
			$blog_partial_attrs = array_merge_recursive( $blog_partial_attrs, $this->get_module_query_elements_common_attrs() );
			return $blog_partial_attrs;
		}


		/**
		 * Render Blog Post Data
		 *
		 * @since    1.0.1
		 * @access   public
		 *
		 * @param array  $attributes
		 * @param string $content
		 * @return string
		 */
		public function render_callback( $attributes, $content ) {

			$blockID = isset( $attributes['pID'] ) ? $attributes['pID'] : $attributes['gID'];
			$gID     = isset( $attributes['gID'] ) ? $attributes['gID'] : '';
			$output  = $default_class = '';

            if ( isset( $attributes['className'] ) ) {
                $default_class = esc_attr( $attributes['className'] );
            }

			$tag                     = $attributes['mTag'] ? $attributes['mTag'] : 'div';
			$template                = $attributes['p1Temp'] ? $attributes['p1Temp'] : '';
			$align                   = isset( $attributes['align'] ) ? 'align' . $attributes['align'] : '';
			$blockComponentAnimation = isset( $attributes['mAnimation'] ) ? $attributes['mAnimation'] : '';
			$post_type               = isset( $attributes['pPostType'] ) ? $attributes['pPostType'] : '';
			$nothing_found_text      = isset( $attributes['pNoFoundTxt'] ) ? $attributes['pNoFoundTxt'] : '';
			$thumb_class             = '';
			$access_no_thumbnail     = array( 'product', 'download' );

			/*query args*/
			$query_args = array(
				'posts_per_page'      => isset( $attributes['postsToShow'] ) ? $attributes['postsToShow'] : 6,
				'post_type'           => isset( $attributes['pPostType'] ) ? $attributes['pPostType'] : 'post',
				'orderby'             => isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date',
				'order'               => isset( $attributes['order'] ) ? $attributes['order'] : 'desc',
				'paged'               => isset( $attributes['paged'] ) ? $attributes['paged'] : 1,
				'ignore_sticky_posts' => true,
				'post_status'         => 'publish',
			);

			/*Backward compatible*/
			if ( isset( $attributes['categories'] ) && ! empty( $attributes['categories'] ) ) {
				if ( is_array( $attributes['categories'] ) && ! gutentor_is_array_empty( $attributes['categories'] ) ) {
					$query_args['taxonomy'] = 'category';
					$query_args['term']     = $attributes['categories'];
				}
				if ( ! is_array( $attributes['categories'] ) ) {
					$query_args['taxonomy'] = 'category';
					$query_args['term']     = $attributes['categories'];
				}
			}

			if ( isset( $attributes['pTaxType'] ) && ! empty( $attributes['pTaxType'] ) &&
				isset( $attributes['pTaxTerm'] ) && ! empty( $attributes['pTaxTerm'] ) ) {

				$query_args['taxonomy'] = $attributes['pTaxType'];

				if ( is_array( $attributes['pTaxTerm'] ) ) {
					$p1_terms = array();
					foreach ( $attributes['pTaxTerm'] as $p1_term ) {
						$p1_terms [] = $p1_term['value'];
					}
					$query_args['term'] = $p1_terms;
				} elseif ( is_string( $attributes['pTaxTerm'] ) || is_numeric( $attributes['pTaxTerm'] ) ) {
					$query_args['term'] = $attributes['pTaxTerm'];
				}
			}
            if ( isset( $attributes['pAuthor'] ) && ! empty( $attributes['pAuthor'] ) ) {
                if ( is_array( $attributes['pAuthor'] ) ) {
                    $author_list = array();
                    foreach ( $attributes['pAuthor'] as $data ) {
                        $author_list[] = $data['value'];
                    }
                    $query_args['author__in'] = $author_list;
                }
            }

			if ( isset( $attributes['pOffsetPosts'] ) ) {
				$query_args['offset'] = $attributes['pOffsetPosts'];
			}
			if ( isset( $attributes['pIncludePosts'] ) && ! empty( $attributes['pIncludePosts'] ) ) {
				$query_args['post__in'] = $attributes['pIncludePosts'];
			}
			if ( isset( $attributes['pExcludePosts'] ) && ! empty( $attributes['pExcludePosts'] ) ) {
				$query_args['post__not_in'] = $attributes['pExcludePosts'];
			}

			/*Search query*/
			if ( isset( $attributes['s'] ) && ! empty( $attributes['s'] ) ) {
				$query_args['s'] = $attributes['s'];
			}
			$the_query = new WP_Query( gutentor_get_query( $query_args ) );

			$output .= '<' . $tag . ' class="' . apply_filters( 'gutentor_post_module_main_wrap_class', gutentor_concat_space( 'gutentor-post-module', 'section-' . $gID, 'gutentor-post-module-p1', $template, $align,$default_class ), $attributes ) . '" id="' . esc_attr( $blockID ) . '" data-gbid="' . esc_attr( $gID ) . '" ' . GutentorAnimationOptionsDataAttr( $blockComponentAnimation ) . '>' . "\n";
			$output .= apply_filters( 'gutentor_post_module_before_container', '', $attributes );
			$output .= "<div class='" . apply_filters( 'gutentor_post_module_container_class', 'grid-container', $attributes ) . "'>";
			$output .= apply_filters( 'gutentor_post_module_before_block_items', '', $attributes );
			$output .= "<div class='" . apply_filters( 'gutentor_post_module_grid_row_class', 'grid-row', $attributes ) . "' " . gutentor_get_html_attr( apply_filters( 'gutentor_post_module_attr', array(), $attributes ) ) . '>';

			if ( $the_query->have_posts() ) :
				while ( $the_query->have_posts() ) :
					$the_query->the_post();
					if ( ! in_array( $post_type, $access_no_thumbnail ) ) {
						$thumb_class = has_post_thumbnail() ? '' : 'gutentor-post-no-thumb';
					}
					$output .= "<article class='" . apply_filters( 'gutentor_post_module_grid_column_class', gutentor_concat_space( 'gutentor-post', $thumb_class ), $attributes ) . "'>";
					$output .= '<div class="gutentor-post-item">';
					$output .= apply_filters( 'gutentor_post_module_p1_query_data', '', get_post(), $attributes );
					$output .= '</div>';/*.gutentor-post-item*/
					$output .= '</article>';/*.article*/
				endwhile;

			else :
				$output .= '<header class="g-n-f-t-1"><h2 class="g-n-f-title">' . esc_html( $nothing_found_text ) . '</h2></header>';
			endif;

			$output .= '</div>';/*.grid-row*/
			$output .= apply_filters( 'gutentor_post_module_after_block_items', '', $attributes );
			$output .= '</div>';/*.grid-container*/
			$output .= apply_filters( 'gutentor_post_module_after_container', '', $attributes );
			$output .= '</' . $tag . '>';/*
			.gutentor-blog-post-wrapper*/
			// Restore original Post Data
			wp_reset_postdata();
			return $output;
		}
	}
}
Gutentor_P1::get_instance()->run();
