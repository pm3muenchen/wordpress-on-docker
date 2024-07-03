(function($){
	jQuery.each(
	jQuery('#sticky_menu').find('li.menu-item-has-children'),
	function(i,v){
		jQuery(v).append('<i />');
	}
);
jQuery('#sticky_menu').find('li.menu-item-has-children i').bind('click', function(){
	jQuery(this).parent().find('.sub-menu').first().slideToggle('fast').parent().toggleClass('expanded');
});
jQuery('#mobile-nav, .sticky_menu_collapse').bind('click', function(){
	if(jQuery('#section').hasClass('shifted')){
		jQuery('#section').removeClass('shifted');
	}
	else{
		jQuery('#section').addClass('shifted');
	}

});
	$(window).load(function() {
		$('.momentSlider').flexslider({
		  animation: "slide",
		  controlNav: false,
		  smoothHeight: true,
		});
		$('.testiSliderBox').flexslider({
		  animation: "fade",
		  controlNav: false,
		  directionNav: true
		});
	});
		
	$(document).ready(function() {
		$('.frmUpload').submit(function() {		
			/*var url = "../wp-content/themes/heisengard/mailSend.php"; 
			$.ajax({
				type: "POST",
				url: url,
				data: $(".frmUpload").serialize(), 
				success: function(data)
					{
					  $(".success").html(data);
					}
			});
			return false; */
			event.preventDefault();
			var data = $(".frmUpload").serialize();
			$.post(one_ajax.ajaxurl, data, function(response) {
				$(".success").html(response);
			});
			return false; 
		});
	});
})(jQuery);