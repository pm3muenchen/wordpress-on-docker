<?php
/**
 Template name: Contact Page
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
		<?php if( $page_subtitle != '' ) : ?>
			<h5>
				<?php echo $page_subtitle; ?>
			</h5>
		<?php endif; ?>
	</div>
</div>
<!-- begin Title Block -->

<!-- begin contact Block -->
<div class="contactBlock">
	<div class="centerBox">
		<?php if (have_posts()): the_post(); ?>
		<div class="textBox">
			<?php echo wpautop($custom['contact_content']); ?>
		</div>
		<div class="contactform">
			<form action="" method="post" class="frmUpload"  name="frmUpload">
				<input type="hidden" name="action" value="send_contact_form" />
				<ul>
					<li>
						<label>Name *</label>
						<input type="text" class="field" name="name" value="" required/>
					</li>
					<li>
						<label>Email *</label>
						<input type="email" class="field" name="email" value="" required/>
					</li>
					<li>
						<label>Message</label>
						<textarea name="message"></textarea>
					</li>
					<li>
						<input type="submit" name="name" class="submit" value="Send now"/>
					</li>
				</ul>
				<div class="clear"></div>
			</form>
			<div class="success"></div>
		</div>
		<?php endif; ?>
		<div class="vcfx">
			<?php the_content(); ?>	
		</div>
	</div>
</div>
<!-- begin contact Block -->

<?php get_footer(); ?>