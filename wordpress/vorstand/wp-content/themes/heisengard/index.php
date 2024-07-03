<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); 
$page_for_posts = get_option( 'page_for_posts' );
$url = $class = '';

if(get_post_thumbnail_id( $page_for_posts ) && $page_for_posts ) {
	
	$thumb_id = get_post_thumbnail_id( $page_for_posts );
	$thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true);
	$url = $thumb_url[0];
}
else{
	$header_class = ' no-banner';
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
$page_title = get_post_meta( $page_for_posts, 'TITLE_META_KEY', true );
$page_subtitle = get_post_meta( $page_for_posts, 'SUBTITLE_META_KEY', true);
?>
<div class="titleBlock <?php echo $class; ?>">
	<div class="centerBox">
		<h1>
			<?php
				$page_title = ( $page_title != '' ) ? $page_title : get_the_title( $page_for_posts );
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