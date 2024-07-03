<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Deep_Free
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside class="col-md-3 sidebar leftside">
	<?php dynamic_sidebar( esc_html__( 'Left Sidebar', 'deep-free' ) ); ?>
</aside>
