(function( $ ) {
 
    "use strict";

    function naevents_bw_form_submit(){
        $('.naevents-bw-settings-form').submit( function(e) {
            e.preventDefault();
            let targetForm      	= $(this);
            let targetFormArray 	= targetForm.serializeArray();
            let targetFormajaxURL 	= targetForm.attr('data-ajax-url');
            let targetFormNonce     = targetForm.attr('data-nonce');
            
            $.ajax({
                type: 'POST',
                url: targetFormajaxURL,
                data: {
                	'action': 'naevents_bw_settings_save',
                	'data' : targetFormArray,
                    'nonce' : targetFormNonce
                },
				beforeSend: function() {
				    $('.naevents-bw-settings-save').text('Saving...');
				},
                success: function (resultString) {
                	$('.naevents-bw-settings-save').text('Saved!');
                },
                complete: function () {
                	setTimeout( function() {
                		$('.naevents-bw-settings-save').text('Save');
                	}, 1000);
                },           
                error: function () {
                	
                }            
            });        
        }); 
    }
	naevents_bw_form_submit();

    function naevents_bw_toggle_submit(toggle, toggleVal){
        let targetFormajaxURL 	= toggle.attr('data-ajax-url');
        let targetFormNonce     = toggle.attr('data-nonce');
        
        $.ajax({
            type: 'POST',
            url: targetFormajaxURL,
            data: {
            	'action': 'naevents_bw_toggle_submit',
            	'data' : toggleVal,
                'nonce' : targetFormNonce
            },
            success: function (resultString) {
            	// $('.naevents-bw-settings-form').submit();
            },
            complete: function () {

            },           
            error: function () {
            	
            }            
        });
    }

	function naevents_bw_toggle_trigger(toggle){
		setTimeout(function(){
			if ($('#naevents-checkbox-toggle-bw').is(':checked')) {
				$('.naevents-bw-settings-form input[type="checkbox"]').each(function(){
					$(this).prop('checked', true);
				});
			} else {
				$('.naevents-bw-settings-form input[type="checkbox"]').each(function(){
					$(this).prop('checked', false);
				});
			}
		}, 100);
	}

	$('.naevents-checkbox-toggle-bw-slider').on('click', function(e) {
		naevents_bw_toggle_trigger($(this));
	});

	$('.naevents-bw-settings-save').on('click', function(e) {
		$('.naevents-bw-settings-form').submit();
		setTimeout(function(){
			if ($('#naevents-checkbox-toggle-bw').is(':checked')) {
				naevents_bw_toggle_submit($('.naevents-checkbox-toggle-bw-slider'), 1);
			} else {
				naevents_bw_toggle_submit($('.naevents-checkbox-toggle-bw-slider'), 0);
			}
		}, 100);		
	});	

	// Unique settings
    function naevents_uw_form_submit(){
        $('.naevents-uw-settings-form').submit( function(e) {
            e.preventDefault();
            let targetForm      	= $(this);
            let targetFormArray 	= targetForm.serializeArray();
            let targetFormajaxURL 	= targetForm.attr('data-ajax-url');
            let targetFormNonce     = targetForm.attr('data-nonce');
            
            $.ajax({
                type: 'POST',
                url: targetFormajaxURL,
                data: {
                	'action': 'naevents_uw_settings_save',
                	'data' : targetFormArray,
                    'nonce' : targetFormNonce
                },
				beforeSend: function() {
				    $('.naevents-uw-settings-save').text('Saving...');
				},
                success: function (resultString) {
                	$('.naevents-uw-settings-save').text('Saved!');
                },
                complete: function () {
                	setTimeout( function() {
                		$('.naevents-uw-settings-save').text('Save');
                	}, 1000);
                },           
                error: function () {
                	
                }            
            });        
        }); 
    }
	naevents_uw_form_submit();

    function naevents_uw_toggle_submit(toggle, toggleVal) {
        let targetFormajaxURL 	= toggle.attr('data-ajax-url');
        let targetFormNonce     = toggle.attr('data-nonce');
        
        $.ajax({
            type: 'POST',
            url: targetFormajaxURL,
            data: {
            	'action': 'naevents_uw_toggle_submit',
            	'data' : toggleVal,
                'nonce' : targetFormNonce
            },
            success: function (resultString) {
            	// $('.naevents-uw-settings-form').submit();
            },
            complete: function () {

            },           
            error: function () {
            	
            }            
        });
    }

	function naevents_uw_toggle_trigger( toggle ){
		setTimeout( function() {
			if ($('#naevents-checkbox-toggle-uw').is(':checked')) {
				$('.naevents-uw-settings-form input[type="checkbox"]').each(function(){
					$(this).prop('checked', true);
				});
			} else {
				$('.naevents-uw-settings-form input[type="checkbox"]').each(function(){
					$(this).prop('checked', false);
				});
			}
		}, 100);
	}

	$('.naevents-checkbox-toggle-uw-slider').on('click', function(e) {
		naevents_uw_toggle_trigger( $(this) );
	});

	$('.naevents-uw-settings-save').on('click', function(e) {
		$('.naevents-uw-settings-form').submit();
		setTimeout(function(){
			if ($('#naevents-checkbox-toggle-uw').is(':checked')) {
				naevents_uw_toggle_submit($('.naevents-checkbox-toggle-uw-slider'), 1);
			} else {
				naevents_uw_toggle_submit($('.naevents-checkbox-toggle-uw-slider'), 0);
			}
		}, 100);			
	});

    // Pro settings
    function naevents_pro_form_submit(){
        $('.naevents-pro-settings-form').submit( function(e) {
            e.preventDefault();
            let targetForm          = $(this);
            let targetFormArray     = targetForm.serializeArray();
            let targetFormajaxURL   = targetForm.attr('data-ajax-url');
            let targetFormNonce     = targetForm.attr('data-nonce');
            
            $.ajax({
                type: 'POST',
                url: targetFormajaxURL,
                data: {
                    'action': 'naevents_pro_settings_save',
                    'data' : targetFormArray,
                    'nonce' : targetFormNonce
                },
                beforeSend: function() {
                    $('.naevents-pro-settings-save').text('Saving...');
                },
                success: function (resultString) {
                    $('.naevents-pro-settings-save').text('Saved!');
                },
                complete: function () {
                    setTimeout( function() {
                        $('.naevents-pro-settings-save').text('Save');
                    }, 1000);
                },           
                error: function () {
                    
                }            
            });        
        }); 
    }
    naevents_pro_form_submit();

    function naevents_pro_toggle_submit(toggle, toggleVal) {
        let targetFormajaxURL   = toggle.attr('data-ajax-url');
        let targetFormNonce     = toggle.attr('data-nonce');
        
        $.ajax({
            type: 'POST',
            url: targetFormajaxURL,
            data: {
                'action': 'naevents_pro_toggle_submit',
                'data' : toggleVal,
                'nonce' : targetFormNonce
            },
            success: function (resultString) {
                // $('.naevents-pro-settings-form').submit();
            },
            complete: function () {

            },           
            error: function () {
                
            }            
        });
    }

    function naevents_pro_toggle_trigger( toggle ){
        setTimeout( function() {
            if ($('#naevents-checkbox-toggle-pro').is(':checked')) {
                $('.naevents-pro-settings-form input[type="checkbox"]').each(function(){
                    $(this).prop('checked', true);
                });
            } else {
                $('.naevents-pro-settings-form input[type="checkbox"]').each(function(){
                    $(this).prop('checked', false);
                });
            }
        }, 100);
    }

    $('.naevents-checkbox-toggle-pro-slider').on('click', function(e) {
        naevents_pro_toggle_trigger( $(this) );
    });

    $('.naevents-pro-settings-save').on('click', function(e) {
        $('.naevents-pro-settings-form').submit();
        setTimeout(function(){
            if ($('#naevents-checkbox-toggle-pro').is(':checked')) {
                naevents_pro_toggle_submit($('.naevents-checkbox-toggle-pro-slider'), 1);
            } else {
                naevents_pro_toggle_submit($('.naevents-checkbox-toggle-pro-slider'), 0);
            }
        }, 100);            
    });     	

	// Search filter
	$(".naevents-search-widget-field").on('keyup', function() {
	    var search = $(this).val().toLowerCase();
		$(".naevents-widget-col").show().filter(function() {
			return $(this).attr('data-widget-name').toLowerCase().indexOf(search) == -1;
		}).hide();

		if(search.length > 0) {
			$('.naevents-checkbox-toggle-text, .naevents-checkbox-toggle-label').hide();
		} else {
			$('.naevents-checkbox-toggle-text, .naevents-checkbox-toggle-label').show();
		}
	});	
 
})(jQuery);