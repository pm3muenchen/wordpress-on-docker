jQuery(document).ready(function($) {
	$('#the-list').sortable({
		items: 'tr',
		opacity: 0.6,
		cursor: 'move',
		axis: 'y',
		update: function() {
			var order = $(this).sortable('serialize') + '&action=update_order_taxonomies';
			$.post(ajaxurl, order, function(response) {
				// success
				//alert( order );
			});
		}
		
	});
});