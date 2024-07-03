<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

<div id="banner-wrap">

<div class="banner" style="background:url('<?php echo $custom['banner_image']['url']; ?>') no-repeat; ">
	<div class="centerBox">
	</div>
</div>

</div>
<!-- finish banner wrap -->

	<div class="centerBox top-pad">
		<div class="pageleft bottomTextBlock">
			<h1><?php echo  __('404', 'heisengard' ); ?></h1>
			<h1><?php _e( 'Page Not Found', 'heisengard' ); ?></h1>
		</div>
		<div class="pageright">
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>