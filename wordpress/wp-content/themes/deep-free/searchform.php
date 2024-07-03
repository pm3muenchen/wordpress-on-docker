<?php
/**
 * Deep Theme.
 *
 * @since   1.0.0
 * @author  Webnus
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<form role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
	<div>
		<input name="s" type="text" placeholder="<?php echo esc_attr__( 'Enter Keywords...', 'deep-free' ); ?>" class="search-side">
		<input type="submit" id="searchsubmit" value="<?php echo esc_attr__( 'Search', 'deep-free' ); ?>" class="btn">
	</div>
</form>
