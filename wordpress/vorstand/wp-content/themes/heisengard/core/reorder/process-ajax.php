<?php

/**
 * order Saver
 *
 * @access      public
 * @since       1.0 
*/
function vsSaveOrder() {
	
	global $wpdb;
	
	$action             = $_POST['action']; 
	$posts_array        = $_POST['post'];
	$listing_counter 	= 1;
	
	foreach ($posts_array as $post_id) {
		
		$wpdb->update( 
					$wpdb->posts, 
						array('menu_order' 	=> $listing_counter), 
						array('ID'   		=> $post_id) 
					);
		$listing_counter++;
	}
	
	die();
}
add_action('wp_ajax_update_order', 'vsSaveOrder');


/**
 * Save taxonomies and categories order
 *
 * @access      public
 * @since       1.0 
*/
function vsSaveTaxonomiesOrder() {
	global $wpdb;
	
	$action             = $_POST['action']; 
	$tags_array         = $_POST['tag'];
	$listing_counter 	= 1;
	
	foreach ($tags_array as $tag_id) {
		
		$wpdb->update( 
					$wpdb->terms, 
						array('term_group' 			=> $listing_counter), 
						array('term_id'   	=> $tag_id) 
					);

		$listing_counter++;
	}
	
	die();
}
add_action('wp_ajax_update_order_taxonomies', 'vsSaveTaxonomiesOrder');