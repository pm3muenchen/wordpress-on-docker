    var fm_currentDate = new Date();
    var FormCurrency_10 = '$';
    var FormPaypalTax_10 = '0';
    var check_submit10 = 0;
    var check_before_submit10 = {};
    var required_fields10 = ["1","2"];
    var labels_and_ids10 = {"1":"type_text","2":"type_submitter_mail","3":"type_textarea","4":"type_submit_reset","5":"type_map"};
    var check_regExp_all10 = [];
    var check_paypal_price_min_max10 = [];
    var file_upload_check10 = [];
    var spinner_check10 = [];
    var scrollbox_trigger_point10 = '20';
    var header_image_animation10 = '';
    var scrollbox_loading_delay10 = '0';
    var scrollbox_auto_hide10 = '1';
    var inputIds10 = '[]';
		var update_first_field_id10 = 0;
	var form_view_count10 = 0;
     function before_load10() {	
}	
 function before_submit10() {
}	
 function before_reset10() {	
}
    function onload_js10() {
  add_marker_on_map("wdform_5",0, "11.515432000000033", "48.097113", "PM3 e.V<br />Machtlfinger straße 10, 81379 München", 10,false);    }

    function condition_js10() {    }

    function check_js10(id, form_id) {
		if (id != 0) {
			x = jQuery("#" + form_id + "form_view"+id);
		}
		else {
		x = jQuery("#form"+form_id);
		}
		    }

    function onsubmit_js10() {
		
    var disabled_fields = "";
    jQuery("#form10 div[wdid]").each(function() {
      if(jQuery(this).css("display") == "none") {
        disabled_fields += jQuery(this).attr("wdid");
        disabled_fields += ",";
      }
    })
    if(disabled_fields) {
      jQuery("<input type=\"hidden\" name=\"disabled_fields10\" value =\""+disabled_fields+"\" />").appendTo("#form10");
    };    }

	function unset_fields10( values, id, i ) {
		rid = 0;
		if ( i > 0 ) {
			jQuery.each( values, function( k, v ) {
				if ( id == k.split('|')[2] ) {
					rid = k.split('|')[0];
					values[k] = '';
				}
			});
			return unset_fields10(values, rid, i - 1);
		} else {
			return values;
		}
	}
	function ajax_similarity10( obj, changing_field_id ) {
		jQuery.ajax({
			type: "POST",
			url: fm_objectL10n.form_maker_admin_ajax,
			dataType: "json",
			data: {
				nonce: fm_ajax.ajaxnonce,
				action: 'fmc_reload_input',
				page: 'form_maker',
				form_id: 10,
				inputs: obj.inputs
			},
			beforeSend: function() {
				if ( !jQuery.isEmptyObject(obj.inputs) ) {
					jQuery.each( obj.inputs, function( key, val ) {
						wdid = key.split('|')[0];
						if ( val != '' && parseInt(wdid) == parseInt(changing_field_id) ) {
							jQuery("#form10 div[wdid='"+ wdid +"']").append( '<div class="fm-loading"></div>' );
						}
					});
				}
			},
			success: function (res) {
				if ( !jQuery.isEmptyObject(obj.inputs) ) {
					jQuery.each( obj.inputs, function( key, val ) {
						wdid = key.split('|')[0];
						jQuery("#form10 div[wdid='"+ wdid +"'] .fm-loading").remove();
						if ( !jQuery.isEmptyObject(res[wdid]) && ( !val || parseInt(wdid) == parseInt(changing_field_id) ) ) {
							jQuery("#form10 div[wdid='"+ wdid +"']").html( res[wdid].html );
						}
					});
				}
			},
			complete: function() {
			}
		});
	}

	function fm_script_ready10() {
		if (jQuery('#form10 .wdform_section').length > 0) {
			fm_document_ready( 10 );
		}
		else {
			jQuery("#form10").closest(".fm-form-container").removeAttr("style")
		}
		if (jQuery('#form10 .wdform_section').length > 0) {
			formOnload(10);
		}

		var ajaxObj10 = {};
		var value_ids10 = {};

		jQuery.each( jQuery.parseJSON( inputIds10 ), function( key, values ) {
			jQuery.each( values, function( index, input_id ) {
				tagName =  jQuery('#form10 [id^="wdform_'+ input_id +'_elemen"]').prop("tagName");
				type =  jQuery('#form10 [id^="wdform_'+ input_id +'_elemen"]').prop("type");
				if ( tagName == 'INPUT' ) {
					input_value = jQuery('#form10 [id^="wdform_'+ input_id +'_elemen"]').val();
					if ( jQuery('#form10 [id^="wdform_'+ input_id +'_elemen"]').is(':checked') ) { 
						if ( input_value ) {
							value_ids10[key + '|' + input_id] = input_value;
						}
					}
					else if ( type == 'text' ) {
						if ( input_value ) {
							value_ids10[key + '|' + input_id] = input_value;
						}
					}
				}
				else if ( tagName == 'SELECT' ) {
					select_value = jQuery('#form10 [id^="wdform_'+ input_id +'_elemen"] option:selected').val();
					if ( select_value ) {
						value_ids10[key + '|' + input_id] = select_value;
					}
				}
				ajaxObj10.inputs = value_ids10;

				jQuery(document).on('change', '#form10 [id^="wdform_'+ input_id +'_elemen"]', function() {
					var id = '';
					var changing_field_id = '';
					if( jQuery(this).prop("tagName") == 'INPUT' ) {
						if( jQuery(this).is(':checked') ) {
							id = jQuery(this).val();
						}
						if( jQuery(this).attr('type') == 'text' ) {
							id = jQuery(this).val();
						}
					}
					else {
						id = jQuery(this).val();
					}
					value_ids10[key + '|' + input_id] = id;

					jQuery.each( value_ids10, function( k, v ) {
						key_arr = k.split('|');
						if ( input_id == key_arr[2] ) {
							changing_field_id = key_arr[0];
							count = Object.keys(value_ids10).length;
							value_ids10 = unset_fields10( value_ids10, changing_field_id, count );
						}
					});

					ajaxObj10.inputs = value_ids10;
					ajax_similarity10( ajaxObj10, changing_field_id );
				});
			});
		});

		ajax_similarity10( ajaxObj10, update_first_field_id10 );
	}

    jQuery(document).ready(function () {
		fm_script_ready10();
    });
    