<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
$page_for_posts = get_option( 'page_for_posts' );
$url = $class = '';
if(get_post_thumbnail_id( $page_for_posts ) && get_option( 'page_for_posts' ) ) {
	
	$thumb_id = get_post_thumbnail_id( $page_for_posts );
	$thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true);
	$url = $thumb_url[0];
}
?>
<!-- begin banner wrap -->
<?php if($url != '') { ?>
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
?>
<div class="titleBlock <?php echo $class; ?>">
	<div class="centerBox">
		<?php 
			if(is_tag()) {
				$prefix = single_tag_title('Tag: ', false);
			} elseif (is_category()) {
				$prefix = single_tag_title('Category: ', false);
			} elseif (is_author()) {
				$prefix = 'Author: '.get_the_author();
			} else {
				$prefix = 'Archive ';
			}
		?>
		<h1><?php echo $prefix; ?></h1>
	</div>
</div>
<!-- begin Title Block -->

<div class="bloxBox">		   
	<div class="centerBox">	
		<div class="pageleft">
		<ul>
		<?php if (have_posts()) : while (have_posts()) : the_post(); 
				get_post_meta( get_the_ID(), '_my_meta_value_key', true);?>
				<li <?php post_class(); ?> >
					<?php if( has_post_thumbnail() ): ?>
						<div class="image">
							<a href="<?php the_permalink()?>">
								<?php the_post_thumbnail(); ?>
							</a>
						</div>
					<?php endif; ?>
					
					<div class="text <?php echo (!has_post_thumbnail()) ? 'no-thumbnail' : ''; ?>">
						<h2>
							<a href="<?php the_permalink();?>">
							  <?php the_title(); ?>
							</a>
						</h2>
						<?php  ?>
						<span>In<?php the_time(' F Y'); //date(' F Y',strtotime($date));?>
							<span>By <?php the_author();?></span>
						</span>
						<div class="detail">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</li>
				<?php endwhile; the_posts_navigation(); endif; wp_reset_query(); ?>			
		</ul>
		</div>
		<div class="pageright">
		<?php get_sidebar(); ?>
		</div>
	</div>				
</div>				
<?php get_footer(); ?>
