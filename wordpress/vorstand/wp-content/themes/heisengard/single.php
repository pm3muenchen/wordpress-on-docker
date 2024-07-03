<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
$url = '';
if(has_post_thumbnail()) {
	$thumb_id = get_post_thumbnail_id();
	$thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true);
	$url = $thumb_url[0];
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
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
			<cite>
				<?php $date =get_post_meta( get_the_ID(), '_my_meta_value_key', true); ?>
				<?php 
				_e( 'Published on: ', 'heisengard' );
				if($date){
					echo date('d F Y',strtotime($date));
				} else {
					the_date('d F Y');
				}
				echo ' <br/> By '.get_the_author(); ?>
			</cite>
		<?php endwhile; endif; ?>
	</div>
</div>
<!-- begin Title Block -->

<!-- begin contact Block -->
<div class="aboutBlock travelBlock">
	<div class="centerBox">
		<div class="textBox left">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php
				/*if( has_post_thumbnail() ){
					
					the_post_thumbnail();
				}*/
				?>
			   <?php the_content(); ?>
			   <?php 
				// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			   ?>

				<?php if( get_post_type() == 'triptype' ) : ?>
					<ul>
					<?php 
						$prfx_stored_meta = get_post_meta(get_the_id());
						if ( isset ( $prfx_stored_meta['meta-text'] ) ) {
							?>
								<li><?php _e( 'Group: ', 'heisengard' ); echo $prfx_stored_meta['meta-text'][0]; ?></li>
							<?php 
						}

						if ( isset ( $prfx_stored_meta['meta-text2'] ) ) {
							?>
								<li><?php _e( 'Price: ', 'heisengard' ); echo $prfx_stored_meta['meta-text2'][0]; ?></li>
							<?php 
						}

						if ( isset ( $prfx_stored_meta['meta-text3'] ) ) {
							?>
								<li><?php _e( 'Breakfast: ', 'heisengard' ); echo $prfx_stored_meta['meta-text3'][0]; ?></li>
							<?php 
						}

						if ( isset ( $prfx_stored_meta['meta-text4'] ) ) {
							?>
								<li><?php _e( 'Flight: ', 'heisengard' ); echo $prfx_stored_meta['meta-text4'][0]; ?></li>
							<?php 
						}

						if ( isset ( $prfx_stored_meta['meta-text5'] ) ) {
							?>
								<li><?php _e( 'Guide: ', 'heisengard' ); echo $prfx_stored_meta['meta-text5'][0]; ?></li>
							<?php 
						}

						if ( isset ( $prfx_stored_meta['meta-text6'] ) ) {
							?>
								<li><?php _e( 'Car: ', 'heisengard' ); echo $prfx_stored_meta['meta-text6'][0]; ?></li>
							<?php 
						}
					?>
					</ul>
				<?php endif; ?>
				<?php the_tags( '<footer class="entry-meta"><span class="tag-links">', ',', '</span></footer>' ); ?>
			<?php endwhile; endif; ?>
		</div>
		<!--<div class="right">
			<?php //get_sidebar();?>
		</div>-->
	</div>
</div>
<!-- begin contact Block -->

<?php get_footer(); ?>