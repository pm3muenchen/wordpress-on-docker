(function($){
$(document).ready(function(){

    var init = function(){

        init_tabs();

        cta_set_on_click_props();

        init_color_picker();

        init_date_time_picker();

        init_conditional_fields();

        init_image_selector();

        init_feedback();

        init_misc();

    }

    var init_tabs = function(){
        $('.mtab_links > a:first-child, .mtab_wrap > div:first-child, .stab_links > a:first-child, .stab_wrap > div:first-child').addClass('active');
    }

    var cta_set_on_click_props = function(){
        $('.cta_prop').hide();
        $('.cta_on_click').each(function(){
            if($(this).val() == 'open_link'){
                $(this).closest('.cta_btn_item').find('.cta_open_link_prop').show();
            }
        });
    }

    var init_color_picker = function(){
        if($.fn.wpColorPicker){
            $('.color_picker').not('.gradient_support').wpColorPicker();

            $('.gradient_support').wpColorPicker({
                change: function(e, ui){
                    var $input = $(e.target);
                    if(typeof $input.data('btn') === 'undefined'){
                        $input.data('btn', $input.closest('.wp-picker-container').find('.wp-color-result'));
                    }
                    $input.data('btn').css('background', ui.color.toString());
                }
            });

            $('.gradient_support').on('keyup', function(){
                $(this).closest('.wp-picker-container').find('.wp-color-result').css('background', $(this).val());
            });

            $('.gradient_support_wrap').each(function(){
                $(this).find('.wp-color-result').css('background', $(this).find('.wp-color-picker').val());
            });
        }
    }

    var init_date_time_picker = function(){

        if($.fn.datetimepicker){
            $('.datetime_picker').datetimepicker({
                format:'Y-m-d H:i'
            });
        }

    }

    var init_conditional_fields = function(){

        // Display
        var display = function($field){
            if($field.val() == 'immediate'){
                $('.field_schedule').hide();
            }
            if($field.val() == 'schedule'){
                $('.field_schedule').slideDown();
            }
        }

        $display = $('select[name="settings[display]"]');
        $display.on('change', function(){ display($display) });
        display($display);

        // Show on
        var show_on = function($field){
            $('.show_on').hide();
            $('.after_' + $field.val()).slideDown();
        }

        $show_on = $('select[name="settings[show_on]"]');
        $show_on.on('change', function(){ show_on($show_on) });
        show_on($show_on);

        // Keep closed
        var keep_closed = function($field){
            if($field.val() == 'yes'){
                $('.keep_closed_duration').slideDown();
            }else{
                $('.keep_closed_duration').hide();
            }
        }

        $keep_closed = $('select[name="settings[keep_closed]"]');
        $keep_closed.on('change', function(){ keep_closed($keep_closed) });
        keep_closed($keep_closed);

    }

    var init_image_selector = function(){
        $('.ancr_image_select li').click(function(){
            $(this).siblings().removeClass('selected');
            $(this).addClass('selected');
            $(this).parent().next().val($(this).data('value'));
        });

        $('.ancr_image_select').each(function(){
            var val = $(this).data('selected');
            $(this).find('[data-value="' + val + '"]').addClass('selected');
        });

    }

    var init_feedback = function(){
        if(typeof window.ANCR_VARS !== 'undefined'){

            if(ANCR_VARS['screen']['base'] == 'edit'){
                var version = '<small>v' + ANCR_VARS['ancr_version'] + '</small>';
                $('.wp-heading-inline').append(version);
            }

            if(ANCR_VARS['screen']['base'] == 'post'){
                var $note_bottom = $('.note_bottom');
                if($note_bottom.length > 0){
                    $note_bottom.appendTo('#normal-sortables');
                }
            }

            $('.subscribe_btn').click(function(e){
                e.preventDefault();
                var action = $(this).parent().data('action');
                $.ajax({
                    type: 'get',
                    url: action,
                    cache: false,
                    dataType: 'jsonp',
                    data: {
                        'EMAIL': $('.subscribe_email_box').val()
                    },
                    success : function(data) {
                    }
                });
                $('.subscribe_confirm').show();
            });

        }
    }

    var init_misc = function(){

        if(typeof window.ANCR_VARS !== 'undefined'){
            $('#content').attr('placeholder', window.ANCR_VARS.editor_placeholder);
        }

    }

    $('.cta_add').click(function(e){
        e.preventDefault();
        $('#cta_list').append($('#tmpl-cta-buttons').html());
        cta_set_on_click_props();
    });

    $(document).on('click', '.cta_delete', function(e){
        e.preventDefault();
        $(this).closest('.cta_btn_item').remove();
    })

    $(document).on('change', '.cta_on_click', function(){
        cta_set_on_click_props();
    })

    $('.mtab_links a').click(function(e){
        e.preventDefault();
        var id = $(this).attr('href').substr(1);

        $('.mtab_links > a').removeClass('active');
        $('.mtab_wrap > div').removeClass('active');

        $(this).addClass('active');

        $('.mtab_wrap > div[id="' + id + '"]').addClass('active');

    });

    $('.stab_links a').click(function(e){
        e.preventDefault();

        var id = $(this).attr('href').substr(1);
        var $main_wrap = $(this).parent().parent();

        $main_wrap.find('.stab_links > a').removeClass('active');
        $main_wrap.find('.stab_wrap > div').removeClass('active');

        $(this).addClass('active');

        $main_wrap.find('.stab_wrap > div[id="' + id + '"]').addClass('active');

    });

    $('.ancr_switch_status').change(function(){
        var data = {
            'action': 'announcer',
            'do': 'switch-status',
            'post-id': $(this).data( 'id' )
        };
        $.post(ajaxurl, data, function(response) {
            if(!response.includes('success')){
                console.error('Unable to save status', response);
            }
        });
    });

    $('.ancr_preview_btn').on('click', function(e){
        e.preventDefault();

        var $post = $('#post');
        var old_action = $post.attr('action');

        var ajax_url_split = ajaxurl.split('/');
        ajax_url_split.pop();
        ajax_url_split.pop();

        $('#post').attr('action', ajax_url_split.join('/') + '/?ancr_preview');
        $('#post').attr('target', '_blank');
        $('#post').submit();

        $post.attr('action', old_action);
        $post.removeAttr('target');
    });

    $('.ancr_preview_info').on('click', function(){
        alert('Preview will display the announcement always irrespective of the schedule, cookies and location rules configured.');
    });

    init();

});
})( jQuery );