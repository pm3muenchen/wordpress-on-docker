<?php
/** no direct access **/
defined('MECEXEC') or die();

$current_month_divider = $this->request->getVar('current_month_divider', 0);
$settings = $this->main->get_settings();
$this->localtime = isset($this->skin_options['include_local_time']) ? $this->skin_options['include_local_time'] : false;
$display_label = isset($this->skin_options['display_label']) ? $this->skin_options['display_label'] : false;
$reason_for_cancellation = isset($this->skin_options['reason_for_cancellation']) ? $this->skin_options['reason_for_cancellation'] : false;
?>
<?php foreach($this->events as $date=>$events): ?>
    <?php $month_id = date('Ym', strtotime($date)); if($this->month_divider and $month_id != $current_month_divider): $current_month_divider = $month_id; ?>
        <div class="mec-month-divider" data-toggle-divider="mec-toggle-<?php echo date('Ym', strtotime($date)); ?>-<?php echo $this->id; ?>"><span><?php echo $this->main->date_i18n('F Y', strtotime($date)); ?></span><i class="mec-sl-arrow-down"></i></div>
    <?php endif; ?>
    <div class="mec-events-agenda">
        <div class="mec-agenda-date-wrap">
            <span class="mec-agenda-day"><?php echo $this->main->date_i18n('l', strtotime($date)); ?></span>
            <span class="mec-agenda-date"><?php echo $this->main->date_i18n('M d', strtotime($date)); ?></span>
        </div>

        <div class="mec-agenda-events-wrap">
            <?php
            foreach($events as $event) {
                $location = isset($event->data->locations[$event->data->meta['mec_location_id']]) ? $event->data->locations[$event->data->meta['mec_location_id']] : array();
                $organizer = isset($event->data->organizers[$event->data->meta['mec_organizer_id']]) ? $event->data->organizers[$event->data->meta['mec_organizer_id']] : array();
                $start_time = (isset($event->data->time) ? $event->data->time['start'] : '');
                $end_time = (isset($event->data->time) ? $event->data->time['end'] : '');
                $event_color = isset($event->data->meta['mec_color']) ? '#' . $event->data->meta['mec_color'] : '';
                $event_start_date = !empty($event->date['start']['date']) ? $event->date['start']['date'] : '';

                $label_style = '';
                if(!empty($event->data->labels))
                {
                    foreach($event->data->labels as $label)
                    {
                        if(!isset($label['style']) or (isset($label['style']) and !trim($label['style']))) continue;

                        if($label['style']  == 'mec-label-featured') $label_style = esc_html__('Featured' , 'mec');
                        elseif($label['style']  == 'mec-label-canceled') $label_style = esc_html__('Canceled' , 'mec');
                    }
                }

                // MEC Schema
                do_action('mec_schema', $event);
                ?>
                
                <div class="<?php echo (isset($event->data->meta['event_past']) and trim($event->data->meta['event_past'])) ? 'mec-past-event ' : ''; ?>mec-agenda-event <?php echo $this->get_event_classes($event); ?>">
                    <i class="mec-sl-clock "></i>
                    <span class="mec-agenda-time">
                        <?php
                            if(trim($start_time))
                            {
                                echo '<span class="mec-start-time">'.$start_time.'</span>';
                                if(trim($end_time)) echo ' - <span class="mec-end-time">'.$end_time.'</span>';
                            }
                        ?>
                    </span>
                    <div class="mec-event-article" style="border-color: <?php echo esc_attr($event_color); ?>;">
                        <span class="mec-event-bg" style="background-color: <?php echo esc_attr($event_color); ?>;"></span>
                        <h4 class="mec-event-title mec-agenda-event-title">
                            <a class="mec-color-hover" data-event-id="<?php echo $event->data->ID; ?>" href="<?php echo $this->main->get_event_date_permalink($event, $event->date['start']['date']); ?>" style="color: <?php echo esc_attr($event_color); ?>;"><?php echo $event->data->title; ?></a>
                        </h4>
                    </div>
                    <?php if($this->localtime) echo $this->main->module('local-time.type1', array('event'=>$event)); ?>
                    <?php echo $this->main->get_flags($event->data->ID, $event_start_date); ?>
                    <?php if ( !empty($label_style) ) echo '<span class="mec-fc-style">'.$label_style.'</span>'; echo $this->main->get_normal_labels($event, $display_label).$this->main->display_cancellation_reason($event->data->ID, $reason_for_cancellation); ?>
                    <?php do_action( 'mec_agenda_skin_attribute', $organizer, $location ); ?>
                </div>
            <?php } ?>
        </div>
    </div>
<?php endforeach;