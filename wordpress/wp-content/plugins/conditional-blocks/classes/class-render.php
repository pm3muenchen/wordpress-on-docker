<?php
/**
 *  Class for handling Block Render
 *
 * @package conditional-blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class for handling Block Render
 */
class Conditional_Blocks_Render_Block {


	/**
	 * Fire off the render block functions.
	 */
	public function init() {
		add_filter( 'render_block', array( $this, 'render_block' ), 999, 2 );
	}

	/**
	 * Filter block content before displaying.
	 *
	 * @param string $block_content the block content.
	 * @param array  $block the whole Gutenberg block object including attributes.
	 * @return string $block_content the new block content.
	 */
	public function render_block( $block_content, $block ) {

		/**
		 * Prevent loading on admin & REST. Otherwise Gutenberg freaks out.
		 */
		if ( is_admin() || defined( 'REST_REQUEST' ) && REST_REQUEST ) {
			return $block_content;
		}

		// Skip empty block.
		if ( empty( $block_content ) ) {
			return $block_content;
		}

		$legacy = isset( $block['attrs']['conditionalBlocksAttributes'] ) && ! empty( $block['attrs']['conditionalBlocksAttributes'] ) ? $block['attrs']['conditionalBlocksAttributes'] : false;

		$conditions  = isset( $block['attrs']['conditionalBlocks']['conditions'] ) ? $block['attrs']['conditionalBlocks']['conditions'] : false;

		if ( $legacy && empty( $conditions ) ) {
			$conditions_array = $this->legacy_converted_conditions( $legacy );
		} else {
			$conditions_array = $conditions;
		}

		if ( empty( $conditions_array ) && ! is_array( $conditions_array ) ) {
			return $block_content;
		}

		$block_content = $this->should_block_render( $block_content, $conditions_array );

		if ( ! $block_content ) {
			return '';
		}

		return $block_content;
	}

	/**
	 * Find out if we should display the current block.
	 *
	 * @param array $conditions_array
	 * @return boolean
	 */
	public function should_block_render( $block_content, $conditions_array ) {

		$should_render = true;

		foreach ( $conditions_array as $index => $condition ) {

			$type = ! empty( $condition['type'] ) ? $condition['type'] : false;

			if ( ! $type ) {
				continue;
			}

			/**
			 * Responsive Blocks.
			 */
			if ( $type === 'responsiveScreenSizes' && is_array( $condition['showOn'] ) ) {
				$block_content = $this->apply_responsive_screensizes( $block_content, $condition['showOn'] );
			}

			/**
			 * Logged in users only.
			 */
			if ( $type === 'userLoggedIn' ) {
				if ( empty( is_user_logged_in() ) ) {
					$should_render  = false;
					break;
				}
			}

			/**
			 * Logged out users only.
			 */
			if ( $type === 'userLoggedOut' ) {
				if ( ! empty( is_user_logged_in() ) ) {
					$should_render  = false;
					break;
				}
			}

		}

		/**
		 * Additional Checks after the foreach.
		 */


		return $should_render ? $block_content : false;
	}

	/**
	 * Add device visibility per block.
	 *
	 * @param array $block_content the whole block object.
	 * @param array $show_on screensizes the block should appear on.
	 * @return string $block_content
	 */
	public function apply_responsive_screensizes( $block_content, $show_on ) {

		$html_classes = '';

		if ( ! in_array( 'showMobileScreen', $show_on, true ) ) {
			$html_classes .= 'conblock-hide-mobile ';
		}

		if ( ! in_array( 'showTabletScreen', $show_on, true ) ) {
			$html_classes .= 'conblock-hide-tablet ';
		}

		if ( ! in_array( 'showDesktopScreen', $show_on, true ) ) {
			$html_classes .= 'conblock-hide-desktop ';
		}

		if ( ! empty( $html_classes ) ) {

			// Replace the first occurance of class=" without classes.
			// We need the classes to be added directly to the blocks. Wrapping classes can sometimes block full width content.
			$needle = 'class="';

			// Find the first occurance.
			$find_class_tag = strpos( $block_content, $needle );

			if ( $find_class_tag !== false ) {
				// Our classes.
				$replacement = 'class="' . $html_classes . ' ';
				// Replace it.
				$new_block = substr_replace( $block_content, $replacement, $find_class_tag, strlen( $needle ) );
			} else {
				// Fallback to wrapping classes when block has no exsisting classes.
				$new_block = '<div class="' . $html_classes . '">' . $block_content . '</div>';
			}

			// Make sure to add frontend CSS to handle the responsive blocks.
			do_action( 'conditional_blocks_enqueue_frontend_responsive_css' );

			return $new_block;
		} else {
			return $block_content;
		}

	}



	/**
	 * Convert legacy blocks to match the new condition layout.
	 *
	 * @param [type] $block
	 * @return void
	 */
	public function legacy_converted_conditions( $legacy_condtions ) {

		$conditions = array();

		$legacy_condtions['userState'] === 'logged-in' ? array_push(
			$conditions,
			array(
				'id' => wp_generate_uuid4(),
				'type' => 'userLoggedIn',
			)
		) : false;

		$legacy_condtions['userState'] === 'logged-out' ? array_push(
			$conditions,
			array(
				'id' => wp_generate_uuid4(),
				'type' => 'userLoggedOut',
			)
		) : false;

		$has_screensize = false;

		$show_on = array(
			'showMobileScreen',
			'showTabletScreen',
			'showDesktopScreen',
		);

		if ( isset( $legacy_condtions['hideOnMobile'] ) && $legacy_condtions['hideOnMobile'] === true ) {
			unset( $show_on[0] );
			$has_screensize = true;
		}

		if ( isset( $legacy_condtions['hideOnTablet'] ) && $legacy_condtions['hideOnTablet'] === true ) {
			unset( $show_on[1] );
			$has_screensize = true;
		}

		if ( isset( $legacy_condtions['hideOnDesktop'] ) && $legacy_condtions['hideOnDesktop'] === true ) {
			unset( $show_on[2] );
			$has_screensize = true;
		}

		if ( $has_screensize ) {
			array_push(
				$conditions,
				array(
					'id' => wp_generate_uuid4(),
					'type' => 'responsiveScreenSizes',
					'showOn' => array_values( $show_on ), // Make sure we only have the values.
				)
			);
		}

		if ( ! empty( $legacy_condtions['userRoles'] ) && is_array( $legacy_condtions['userRoles'] ) ) {
			array_push(
				$conditions,
				array(
					'id' => wp_generate_uuid4(),
					'type' => 'userRoles',
					'allowedRoles' => $legacy_condtions['userRoles'],
				)
			);
		}

		if ( ! empty( $legacy_condtions['httpUserAgent'] ) && is_array( $legacy_condtions['httpUserAgent'] ) ) {
			array_push(
				$conditions,
				array(
					'id' => wp_generate_uuid4(),
					'type' => 'userAgents',
					'allowedAgents' => $legacy_condtions['httpUserAgent'],
				)
			);
		}

		if ( ! empty( $legacy_condtions['httpReferer'] ) ) {
			array_push(
				$conditions,
				array(
					'id' => wp_generate_uuid4(),
					'type' => 'domainReferrers',
					'domainReferrers' => $legacy_condtions['httpReferer'],
				)
			);
		}

		if ( ! empty( $legacy_condtions['dates'] ) && is_array( $legacy_condtions['dates'] ) ) {

			foreach ( $legacy_condtions['dates'] as $date_range ) {

				if ( ! empty( $date_range['start'] ) && ! empty( $date_range['end'] ) ) {
					array_push(
						$conditions,
						array(
							'id' => wp_generate_uuid4(),
							'type' => 'dateRange',
							'startTime' => $date_range['start'],
							'endTime' => $date_range['end'],
							'hasEndDate' => true,
						)
					);
				}
			}
		}

		if ( isset( $legacy_condtions['postMeta']['key'] ) && ! empty( $legacy_condtions['postMeta']['key'] ) ) {

			array_push(
				$conditions,
				array(
					'id' => wp_generate_uuid4(),
					'type' => 'postMeta',
					'metaKey' => isset( $legacy_condtions['postMeta']['key'] ) ? $legacy_condtions['postMeta']['key'] : false,
					'metaOperator' => isset( $legacy_condtions['postMeta']['operator'] ) ? $legacy_condtions['postMeta']['operator'] : false,
					'metaValue' => isset( $legacy_condtions['postMeta']['value'] ) ? $legacy_condtions['postMeta']['value'] : false,
				)
			);
		}

		return $conditions;
	}
}

$class = new Conditional_Blocks_Render_Block();
$class->init();

