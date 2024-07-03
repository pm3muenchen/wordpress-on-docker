<?php
/**
 Template name: Travel Page
 */
get_header(); 
$url = $class = '';
if(has_post_thumbnail()) {
	$thumb_id = get_post_thumbnail_id();
	$thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true);
	$url = $thumb_url[0];
}
?>
<!-- begin banner wrap -->
<?php if($url){ ?>
<div id="banner-wrap">
	<div class="innerbanner" style="background:url('<?php echo $url; ?>') no-repeat; ">
	</div>
</div>
<?php } ?>
<!-- finish banner wrap -->

<!-- begin Title Block -->
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
		<?php if( $page_subtitle != '' ) : ?>
			<h5>
				<?php echo $page_subtitle; ?>
			</h5>
		<?php endif; ?>
	</div>
</div>
<!-- begin Title Block -->

<!-- begin contact Block -->
<div class="aboutBlock travelBlock">
	<div class="centerBox">
		<div class="textBox">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			   <?php the_content(); ?>
			<?php endwhile; endif; ?>
		</div>
	</div>
</div>
<!-- begin contact Block -->
<div class="clear"></div>
<!-- begin Testimonail Block -->
<div class="testimonailBlock">
	<div class="centerBox">
		<div class="testiSliderBox">
			<ul class="slides">
				<?php 
				query_posts('post_type=testimonial&showposts=-1');
				if (have_posts()) : while (have_posts()) : the_post(); ?>
					<li>
					<?php the_post_thumbnail('testiimg'); ?>
						<h1><?php the_title(); ?></h1>
						<p><?php the_content(); ?></p>
					</li>
				<?php endwhile; endif; wp_reset_query(); ?>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
<!-- begin Testimonail Block -->

<div class="clear"></div>

<!-- begin Bottom Text Block -->
<div class="bottomTextBlock">
	<div class="centerBox">	
		<?php $content_middle = apply_filters('the_content', get_post_meta( get_the_ID(), 'BOTTOM_META_KEY', true));
         echo $content_middle; ?>
	</div>
</div>
<!-- begin Bottom Text Block -->

<?php 
	query_posts('post_type=travel&showposts=-1');
	if (have_posts()) : 
		?>	
		<div class="travelBlock">
			<div class="centerBox bloxBox">
				<h2><?php _e( 'Earlier Travels', 'heisengard' ) ?></h2>
				<ul>
					<?php
					while (have_posts()) : the_post();
						?>
							<li>
								<a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
								<span><?php echo get_the_date( 'd/m/Y' ); ?></span>
							</li>
						<?php
					endwhile;
					?>
				</ul>
			</div>
		</div>
		<?php
	endif;
	wp_reset_query(); 
?>

<?php get_footer(); ?>