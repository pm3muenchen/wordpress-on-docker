<?php
/** no direct access **/
defined('MECEXEC') or die();

$year = $this->year;
$month = $this->month;
$events = $this->events;

// Get layout path
$render_path = dirname(__FILE__) . '/render.php';

// before/after Month
$_1month_before = strtotime('first day of -1 month', strtotime($this->start_date));
$_1month_after = strtotime('first day of +1 month', strtotime($this->start_date));

// Current month time
$current_month_time = strtotime($this->start_date);

// Generate Month
ob_start();
include $render_path;
$month_html = ob_get_clean();

$navigator_html = '';

// Generate Month Navigator
if($this->next_previous_button) {
    $navigator_html .= '<div class="mec-calendar-header"><h2>'.date_i18n('F Y', $current_month_time).'</h2></div>';

    // Show previous month handler if showing past events allowed
    if(!isset($this->atts['show_past_events']) or 
       (isset($this->atts['show_past_events']) and $this->atts['show_past_events']) or
       (isset($this->atts['show_past_events']) and !$this->atts['show_past_events'] and strtotime(date('Y-m-t', $_1month_before)) >= time())
    )
    {
        $navigator_html .= '<div class="mec-previous-month mec-load-month" data-mec-year="'.date('Y', $_1month_before).'" data-mec-month="'.date('m', $_1month_before).'"><i class="mec-sl-angle-left"></i></div>';
    }
    
    // Show next month handler if needed
    if(!$this->show_only_expired_events or
       ($this->show_only_expired_events and strtotime(date('Y-m-01', $_1month_after)) <= time())
    )
    {
        $navigator_html .= '<div class="mec-next-month mec-load-month" data-mec-year="'.date('Y', $_1month_after).'" data-mec-month="'.date('m', $_1month_after).'"><i class="mec-sl-angle-right"></i></div>';
    }
}

// Return the data if called by AJAX
if(isset($this->atts['return_items']) and $this->atts['return_items'])
{
    echo json_encode(array(
        'month'=>$month_html,
        'events_side'=>(in_array($this->style, array('clean', 'modern')) ? $this->events_str : ''),
        'navigator'=>$navigator_html,
        'previous_month'=>array('label'=>date_i18n('Y F', $_1month_before), 'id'=>date('Ym', $_1month_before), 'year'=>date('Y', $_1month_before), 'month'=>date('m', $_1month_before)),
        'current_month'=>array('label'=>date_i18n('Y F', $current_month_time), 'id'=>date('Ym', $current_month_time), 'year'=>date('Y', $current_month_time), 'month'=>date('m', $current_month_time)),
        'next_month'=>array('label'=>date_i18n('Y F', $_1month_after), 'id'=>date('Ym', $_1month_after), 'year'=>date('Y', $_1month_after), 'month'=>date('m', $_1month_after)),
    ));
    exit;
}

// Generating javascript code tpl
$javascript = '<script type="text/javascript">
jQuery(document).ready(function()
{
    jQuery("#mec_monthly_view_month_'.$this->id.'_'.date('Ym', $current_month_time).'").mecMonthlyView(
    {
        id: "'.$this->id.'",
        today: "'.date('Ymd', strtotime($this->active_day)).'",
        month_id: "'.date('Ym', $current_month_time).'",
        active_month: {year: "'.date('Y', strtotime($this->start_date)).'", month: "'.date('m', strtotime($this->start_date)).'"},
        next_month: {year: "'.date('Y', $_1month_after).'", month: "'.date('m', $_1month_after).'"},
        events_label: "'.esc_attr__('Events', 'mec-fl').'",
        event_label: "'.esc_attr__('Event', 'mec-fl').'",
        month_navigator: '.($this->next_previous_button ? 1 : 0).',
        atts: "'.http_build_query(array('atts'=>$this->atts), '', '&').'",
        style: "'.(isset($this->skin_options['style']) ? $this->skin_options['style'] : NULL).'",
        ajax_url: "'.admin_url('admin-ajax.php', NULL).'",
        sed_method: "'.$this->sed_method.'",
        image_popup: "'.$this->image_popup.'",
        sf:
        {
            container: "'.($this->sf_status ? '#mec_search_form_'.$this->id : '').'",
        },
    });
});
</script>';

// Include javascript code into the page
if($this->main->is_ajax()) echo $javascript;
else $this->factory->params('footer', $javascript);

$styling = $this->main->get_styling();
$event_colorskin = (isset($styling['mec_colorskin'] ) || isset($styling['color'])) ? 'colorskin-custom' : '';
$cal_style = 'mec-box-calendar mec-event-calendar-classic mec-event-container-'.$this->style;

do_action('mec_start_skin' , $this->id);
do_action('mec_monthly_skin_head');
?>

<?php if (isset($this->skin_options['wrapper_bg_color']) and trim($this->skin_options['wrapper_bg_color'])) { ?>
    <div class="mec-fluent-bg-wrap" style="background-color: <?php echo esc_attr($this->skin_options['wrapper_bg_color']); ?>">
<?php } ?>

<div id="mec_skin_<?php echo $this->id; ?>" class="mec-wrap mec-fluent-wrap mec-fluent-monthly-wrap <?php echo $event_colorskin . ' ' . $this->html_class; ?>">
    <?php if($this->next_previous_button): ?>
        <div class="mec-skin-monthly-view-month-navigator-container">
            <div class="mec-month-navigator" id="mec_month_navigator_<?php echo $this->id; ?>_<?php echo date('Ym', $current_month_time); ?>"><?php echo $navigator_html; ?></div>
        </div>
    <?php else: ?>
        <div class="mec-skin-monthly-view-month-navigator-container">
            <div class="mec-calendar-header"><h2><?php echo date_i18n('Y F', $current_month_time); ?></h2></div>
        </div>
    <?php endif; ?>

    <div class="mec-calendar <?php echo $cal_style; ?>">
        <?php if($this->sf_status) echo $this->sf_search_form(); ?>
        <div class="mec-calendar-side mec-clear">
            <div class="mec-calendar-table" id="mec_skin_events_<?php echo $this->id; ?>">
                <div class="mec-month-container mec-month-container-selected" id="mec_monthly_view_month_<?php echo $this->id; ?>_<?php echo date('Ym', $current_month_time); ?>" data-month-id="<?php echo date('Ym', $current_month_time); ?>"><?php echo $month_html; ?></div>
            </div>
        </div>
    </div>
</div>

<?php if (isset($this->skin_options['wrapper_bg_color']) and trim($this->skin_options['wrapper_bg_color'])) { ?>
    </div>
<?php } ?>