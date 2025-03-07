<?php
/** no direct access **/
defined('MECEXEC') or die();

// Returns abbr weekday labels
add_filter('mec_weekday_abbr_labels', function ($labels) {
    foreach ($labels as $key => $label) {
        switch ($label) {
            case 'MO':
                $labels[$key] = esc_html__('MON', 'mec-fl');
                break;
            case 'TU':
                $labels[$key] = esc_html__('TUE', 'mec-fl');
                break;
            case 'WE':
                $labels[$key] = esc_html__('WED', 'mec-fl');
                break;
            case 'TH':
                $labels[$key] = esc_html__('TUH', 'mec-fl');
                break;
            case 'FR':
                $labels[$key] = esc_html__('FRI', 'mec-fl');
                break;
            case 'SA':
                $labels[$key] = esc_html__('SAT', 'mec-fl');
                break;
            case 'SU':
                $labels[$key] = esc_html__('SUN', 'mec-fl');
                break;
        }
    }

    return $labels;
}, 1, 1);

// table headings
$headings = $this->main->get_weekday_abbr_labels();
$currentDayText = date('D');

echo '<dl class="mec-calendar-table-head">';
foreach ($headings as $heading) {
    $activeClass = strtolower($currentDayText) == strtolower($heading) ? ' active' : '';
    echo '<dt class="mec-calendar-day-head' . $activeClass . '">' . $heading . '</dt>';
}
echo '</dl>';

// Start day of week
$week_start = $this->main->get_first_day_of_week();

// Get date suffix
$settings = $this->main->get_settings();

// days and weeks vars
$running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
$days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
$days_in_previous_month = date('t', strtotime('-1 month', strtotime($this->active_day)));

$days_in_this_week = 1;
$day_counter = 0;

if ($week_start == 0) {
    $running_day = $running_day; // Sunday
} elseif ($week_start == 1) { // Monday
    if ($running_day != 0) {
        $running_day = $running_day - 1;
    } else {
        $running_day = 6;
    }
} elseif ($week_start == 6) { // Saturday
    if ($running_day != 6) {
        $running_day = $running_day + 1;
    } else {
        $running_day = 0;
    }
} elseif ($week_start == 5) { // Friday
    if ($running_day < 4) {
        $running_day = $running_day + 2;
    } elseif ($running_day == 5) {
        $running_day = 0;
    } elseif ($running_day == 6) {
        $running_day = 1;
    }
}
?>
<dl class="mec-calendar-row mec-more-events-controller">
    <?php
        // print "blank" days until the first of the current week
    for ($x = 0; $x < $running_day; $x++) {
        echo '<dt class="mec-table-nullday">'.($days_in_previous_month - ($running_day-1-$x)).'</dt>';
        $days_in_this_week++;
    }

        // keep going with days ....
    for ($list_day = 1; $list_day <= $days_in_month; $list_day++) {
        $time = strtotime($year.'-'.$month.'-'.$list_day);
        $date_suffix = (isset($settings['date_suffix']) && $settings['date_suffix'] == '0') ? date_i18n('jS', $time) : date_i18n('j', $time);

        $today = date('Y-m-d', $time);
        $day_id = date('Ymd', $time);
        $selected_day = (str_replace('-', '', $this->active_day) == $day_id) ? ' mec-selected-day' : '';
        $selected_day_date = (str_replace('-', '', $this->active_day) == $day_id) ? 'mec-color' : '';
        // Print events
        if (isset($events[$today]) and count($events[$today])) {
            echo '<dt class="mec-calendar-day'.$selected_day.'" data-mec-cell="'.$day_id.'" data-day="'.$list_day.'" data-month="'.date('Ym', $time).'"><div class="'.$selected_day_date.'">'.$list_day.'</div>';
            $eventItems = 0;
            $moreEventsHTML = '';
            foreach ($events[$today] as $event) {
                $location = isset($event->data->locations[$event->data->meta['mec_location_id']])? $event->data->locations[$event->data->meta['mec_location_id']] : array();
                $event_color = isset($event->data->meta['mec_color'])? '#'.$event->data->meta['mec_color']:'';
                $start_time = (isset($event->data->time) ? $event->data->time['start'] : '');
                $end_time = (isset($event->data->time) ? $event->data->time['end'] : '');

                if ($eventItems >= 2) {
                    $moreEventsHTML .= '
                            <div class="'.((isset($event->data->meta['event_past']) and trim($event->data->meta['event_past'])) ? 'mec-past-event ' : '').'ended-relative simple-skin-ended" style="border-color:' . $event_color . ';">
                                <div class="mec-event-image">' . $event->data->thumbnails['thumbnail'] . '</div>
                                <div class="mec-more-events-content">
                                    <h4 class="mec-event-title"><a data-event-id="'.$event->data->ID.'" href="'.$this->main->get_event_date_permalink($event, $event->date['start']['date']).'">'.$event->data->title.'</a></h4>
                                    <i class="mec-sl-clock"></i>
                                    <span class="mec-event-start-time">' . $start_time . '</span>
                                    <span class="mec-event-end-time">' . $end_time . '</span>
                                </div>
                            </div>';
                } else {
                    echo '<div class="'.((isset($event->data->meta['event_past']) and trim($event->data->meta['event_past'])) ? 'mec-past-event ' : '').'ended-relative simple-skin-ended" style="border-color:' . $event_color . ';" data-start-time="' . esc_attr($start_time) . '" data-end-time="' . esc_attr($end_time) . '">';
                    echo '<span class="mec-event-bg" style="background-color:' . esc_attr($event_color) . ';"></span>';
                    echo '<h4 class="mec-event-title"><a style="color:' . $event_color . ';" class="event-single-link-simple" href="'.$this->main->get_event_date_permalink($event, $event->date['start']['date']).'">'.$event->data->title.'</a></h4>';
                    echo '</div>';
                }

                if (!next($events[$today]) && $eventItems >= 2) {
                    echo '<span class="mec-more-events-icon">...</span>';
                    echo '
                        <div class="mec-more-events-wrap">
                            <div class="mec-more-events">
                                <h5 class="mec-more-events-header">' . date('l, F d, Y', $time) . '</h5>
                                <div class="mec-more-events-body">
                                    ' . $moreEventsHTML . '
                                </div>
                            </div>
                        </div>';
                }
                    
                $speakers = '""';
                if (!empty($event->data->speakers)) {
                    $speakers= [];
                    foreach ($event->data->speakers as $key => $value) {
                        $speakers[] = array(
                            "@type"     => "Person",
                            "name"      => $value['name'],
                            "image"     => $value['thumbnail'],
                            "sameAs"    => $value['facebook'],
                        );
                    }
                    $speakers = json_encode($speakers);
                }
                $startDate = !empty($event->data->meta['mec_date']['start']['date']) ? $event->data->meta['mec_date']['start']['date'] : '';
                $endDate = !empty($event->data->meta['mec_date']['end']['date']) ? $event->data->meta['mec_date']['end']['date'] : '' ;
                $location_name = isset($location['name']) ? $location['name'] : '' ;
                $location_image = isset($location['thumbnail']) ? esc_url($location['thumbnail']) : '' ;
                $location_address = isset($location['address']) ? $location['address'] : '' ;
                $image = !empty($event->data->featured_image['full']) ? esc_html($event->data->featured_image['full']) : '' ;
                $price_schema = isset($event->data->meta['mec_cost']) ? $event->data->meta['mec_cost'] : '' ;
                $currency_schema = isset($settings['currency']) ? $settings['currency'] : '' ;
                $schema_settings = isset($settings['schema']) ? $settings['schema'] : '';
                if ($schema_settings == '1') :
                    echo '
                    <script type="application/ld+json">
                    {
                        "@context" 		: "http://schema.org",
                        "@type" 		: "Event",
                        "startDate" 	: "' . $startDate . '",
                        "endDate" 		: "' . $endDate  . '",
                        "location" 		:
                        {
                            "@type" 	: "Place",
                            "name" 		: "' . $location_name . '",
                            "image"		: "' . $location_image  . '",
                            "address"	: "' .  $location_address . '"
                        },
                        "offers": {
                            "url": "'. $event->data->permalink .'",
                            "price": "' . $price_schema.'",
                            "priceCurrency" : "' . $currency_schema .'"
                        },
                        "performer":  '. $speakers . ',
                        "description" 	: "' . esc_html(preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<div class="figure">$1</div>', preg_replace('/\s/u', ' ', $event->data->post->post_content))) . '",
                        "image" 		: "'. $image . '",
                        "name" 			: "' .esc_html($event->data->title) . '",
                        "url"			: "'. $this->main->get_event_date_permalink($event, $event->date['start']['date']) . '"
                    }
                    </script>';
                endif;
                $eventItems++;
            }
            echo '</dt>';
        } else {
            echo '<dt class="mec-calendar-day'.$selected_day.'" data-mec-cell="'.$day_id.'" data-day="'.$list_day.'" data-month="'.date('Ym', $time).'">'.$list_day.'</dt>';
            echo '</dt>';
        }

        if ($running_day == 6) {
            echo '</dl>';
                
            if ((($day_counter+1) != $days_in_month) or (($day_counter+1) == $days_in_month and $days_in_this_week == 7)) {
                echo '<dl class="mec-calendar-row mec-more-events-controller">';
            }

            $running_day = -1;
            $days_in_this_week = 0;
        }

        $days_in_this_week++;
        $running_day++;
        $day_counter++;
    }

        // finish the rest of the days in the week
    if ($days_in_this_week < 8) {
        for ($x = 1; $x <= (8 - $days_in_this_week); $x++) {
            echo '<dt class="mec-table-nullday">'.$x.'</dt>';
        }
    }
    ?>
</dl>
