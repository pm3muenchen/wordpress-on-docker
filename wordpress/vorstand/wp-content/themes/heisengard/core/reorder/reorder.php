<?php

class vsTaxonomyOrder_class {

	/**
	 * Constructor
	 *
	 * @access      public
	 * @since       1.0 
	*/
	function __construct() {
		global $pagenow;
		
		// Edit Posts, Pages, and CPTs
		if( $pagenow == 'edit.php') {
			add_action( 'init', array( &$this,'vsLoadScripts') );
					
		// Categories, Taxonomies
		} elseif( $pagenow == 'edit-tags.php') {
			add_action( 'init', array( &$this,'vsLoadTaxonomiesScripts') );		
			 
		} // end if
		include(dirname(__FILE__) . '/process-ajax.php');
		
		add_filter( 'pre_get_posts', array( &$this,'vsListreorder') );
		add_filter( 'get_terms_orderby', array( &$this,'vsReorderlisttaxonomies'), 10, 2 );
		
		
	}
	
	/**
	 * reorder posts, pages and custom post types with drag n drop 
	 *
	 * @access      public
	 * @since       1.0 
	*/
	function vsLoadScripts() {
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('update-order', get_template_directory_uri() . '/core/reorder/js/update-order.js');
		wp_enqueue_style('admin-styles', get_template_directory_uri() . '/core/reorder/css/admin.css');
	}
	
	/**
	 * reorder taxonomies, tags and categories with drag n drop
	 *
	 * @access      public
	 * @since       1.0 
	*/
	function vsLoadTaxonomiesScripts() {
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('update-order', get_template_directory_uri() . '/core/reorder/js/update-order-taxonomies.js');
		wp_enqueue_style('admin-styles', get_template_directory_uri() . '/core/reorder/css/admin.css');
	}

	/**
	 * Reorder elements in default list by menu_order instead of date or ID
	 *
	 * @access      public
	 * @since       1.0 
	*/
	function vsListreOrder($query) {
	
		if( is_main_query() ) {
			if($query->get('orderby') == null && $query->get('orderby') =="") {
				$query->set('orderby', 'menu_order');
				$query->set('order', 'ASC');
			}
		}

		return $query;
	}
	
	/**
	 * Reorder elements in default list by menu_order instead of name by default
	 *
	 * @access      public
	 * @since       1.0 
	*/
	function vsReorderListTaxonomies($orderby, $args) {
	
		$orderby = "t.term_group";
		
		return $orderby;

	}
		
}


$GLOBALS['vsTaxonomyOrder'] = new vsTaxonomyOrder_class();


