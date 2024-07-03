<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
get_header(); 

$url = $class = '';

if(has_post_thumbnail()) {
	
	$thumb_id = get_post_thumbnail_id();
	$thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true);
	$url = $thumb_url[0];
}
else{
	$header_class = ' no-banner';
}
?>
<!-- begin banner wrap -->
<?php if($url) { ?>
<div id="banner-wrap">
	<div class="innerbanner" style="background:url('<?php echo $url; ?>') no-repeat; ">
	</div>
</div>
<?php } ?>
<!-- finish banner wrap -->
<?php 
if( $url == '' ){
	$class = 'top-pad';
}
$page_title = get_post_meta( get_the_id(), 'TITLE_META_KEY', true );
$page_subtitle = get_post_meta( get_the_ID(), 'SUBTITLE_META_KEY', true);
?>
<div class="titleBlock <?php echo $class; ?>">
	<div class="centerBox">
		<h1>
			<?php
				$page_title = ( $page_title != '' ) ? $page_title : get_the_title();
				echo $page_title; 
			?>
		</h1>
		<?php if(strlen($page_subtitle)): ?>
			<h5>
				<?php echo $page_subtitle; ?>
			</h5>
		<?php endif; ?>
	</div>
</div>
<!-- begin Title Block -->

<!-- begin about Block -->
<div class="aboutBlock">
	<div class="centerBox">
		<div class="textBox">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			   <?php the_content(); ?>
			<?php endwhile; endif; ?>
		</div>
	</div>
</div>
<!-- begin about Block -->



<?php get_footer(); ?>