<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>
<!-- begin banner wrap -->
<div id="banner-wrap">

<div class="banner" style="background:url('<?php echo $custom['banner_image']['url']; ?>') no-repeat; ">
	<div class="centerBox">
		<div class="bannerText">
			<h2><?php echo $custom['header_text']; ?></h2>
			<p><?php echo $custom['header_title']; ?></p>
		</div>
	</div>
</div>

</div>
<!-- finish banner wrap -->
<div class="vcfx">
	<div class="centerBox">
		<?php 
			if(have_posts()){
				the_post();
				the_content(); 
			}
		?>
	</div>
</div>

<?php get_footer(); ?>