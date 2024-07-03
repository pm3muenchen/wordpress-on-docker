<?php
error_reporting(0);
//Meta Box for Title Box new
function dsi_add_custom_meta_box() {
	add_meta_box('title-box', __('Page Settings', 'heisengard'), 'titlebox', array('page'), 'normal', 'high' );
}
add_action('admin_init', 'dsi_add_custom_meta_box');

add_action( 'add_meta_boxes', 'bottomcontent' );
function bottomcontent(){
	global $post;
	if(!empty($post)){
		$post_id = get_the_id(); 
		$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
		if ($template_file == 'page_Travel.php') { 
			add_meta_box('bottom-box', __('Bottom Content', 'heisengard'), 'bottombox', array('page'), 'normal', 'low' );
		}
	}
}
function bottombox($post){
	$meta_box_id = 'BOTTOM_META_BOX_ID';
    $editor_id = 'BOTTOM_EDITOR_ID';
	$editor_id_fullscreen = 'BOTTOM_EDITOR_ID_FULLSCREEN';
	//Add CSS & jQuery goodness to make this work like the original WYSIWYG
        echo "
			<style type='text/css'>
					#$meta_box_id #edButtonHTML, #$meta_box_id #edButtonPreview {background-color: #F1F1F1; border-color: #DFDFDF #DFDFDF #CCC; color: #999;}
					#$editor_id{width:100%;}
					#$meta_box_id #editorcontainer{background:#fff !important;}
					#$meta_box_id #$editor_id_fullscreen{display:none;}
			</style>
		
			<script type='text/javascript'>
					jQuery(function($){
							$('#$meta_box_id #editor-toolbar > a').click(function(){
									$('#$meta_box_id #editor-toolbar > a').removeClass('active');
									$(this).addClass('active');
							});
							
							if($('#$meta_box_id #edButtonPreview').hasClass('active')){
									$('#$meta_box_id #ed_toolbar').hide();
							}
							
							$('#$meta_box_id #edButtonPreview').click(function(){
									$('#$meta_box_id #ed_toolbar').hide();
							});
							
							$('#$meta_box_id #edButtonHTML').click(function(){
									$('#$meta_box_id #ed_toolbar').show();
							});
			//Tell the uploader to insert content into the correct WYSIWYG editor
			$('#media-buttons a').bind('click', function(){
				var customEditor = $(this).parents('#$meta_box_id');
				if(customEditor.length > 0){
					edCanvas = document.getElementById('$editor_id');
				}
				else{
					edCanvas = document.getElementById('content');
				}
			});
					});
			</script>
        ";
		//Create The Editor
        $content = get_post_meta($post->ID, 'BOTTOM_META_KEY', true);
        wp_editor($content, $editor_id);
        
        //Clear The Room!
        echo "<div style='clear:both; display:block;'></div>";
}
function bottomcontentbox_save($post_id){
	$editor_id = 'BOTTOM_EDITOR_ID';
	$meta_key = 'BOTTOM_META_KEY';

	if(isset($_REQUEST[$editor_id]))
		update_post_meta($_REQUEST['post_ID'], 'BOTTOM_META_KEY', $_REQUEST[$editor_id]);
}
add_action( 'save_post', 'bottomcontentbox_save' );
function titlebox($post){
	//Create The Editor
	global $post;
	$post_id = get_the_id();
	?>
	<table class="form-table">
		<tr>
			<th style="width:20%">
				<label for="dsip_title"><?php _e( 'Title', 'heisengard' ); ?>:</label>
			</th>
			<td>
				<input type="text" name="hg_page_title" id="hg_page_title" value="<?php echo get_post_meta( $post_id, 'TITLE_META_KEY', true ); ?>" />
				
			</td>
		</tr>
		<tr>
			<th style="width:20%">
				<label for="dsip_title"><?php _e( 'Sub Title', 'heisengard' ); ?>:</label>
			</th>
			<td>
				<input type="text" name="hg_page_subtitle" id="hg_page_subtitle" value="<?php echo get_post_meta( $post_id, 'SUBTITLE_META_KEY', true ); ?>" />
				
			</td>
		</tr>
	</table>
	<div style='clear:both; display:block;'></div>
	<?php
}
function titlebox_save($post_id){

	if(isset($_REQUEST['hg_page_title'])) {
		update_post_meta($_REQUEST['post_ID'], 'TITLE_META_KEY', $_REQUEST['hg_page_title']);
	}
	if(isset($_REQUEST['hg_page_subtitle'])) {
		update_post_meta($_REQUEST['post_ID'], 'SUBTITLE_META_KEY', $_REQUEST['hg_page_subtitle']);
	}
}
add_action( 'save_post', 'titlebox_save' );
//Meta Box for Title Box