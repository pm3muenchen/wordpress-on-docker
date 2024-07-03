<?php
/** no direct access **/
defined('MECEXEC') or die();

$styling = $this->main->get_styling();
$event = $this->events[0];
$event_colorskin = (isset($styling['mec_colorskin']) || isset($styling['color'])) ? 'colorskin-custom' : '';
$settings = $this->main->get_settings();

$occurrence = (isset($event->date['start']['date']) ? $event->date['start']['date'] : (isset($_GET['occurrence']) ? sanitize_text_field($_GET['occurrence']) : ''));
$occurrence_end_date = trim($occurrence) ? $this->main->get_end_date_by_occurrence($event->data->ID, (isset($event->date['start']['date']) ? $event->date['start']['date'] : $occurrence)) : '';

// Event Location
add_action('mec_map_before_direction', function() use ($event) {
    if(isset($event->data->locations[$event->data->meta['mec_location_id']]) and !empty($event->data->locations[$event->data->meta['mec_location_id']])) {
        $location = $event->data->locations[$event->data->meta['mec_location_id']];
        ?>
        <div class="mec-single-event-location">
            <div class="mec-single-event-location-inner">
                <i class="mec-sl-location-pin"></i>
                <div class="mec-single-event-location-content">
                    <h3 class="mec-events-single-section-title mec-location"><?php echo $this->main->m('taxonomy_location', __('Location', 'mec-fl')); ?></h3>
                    <dd class="location"><address class="mec-events-address"><span class="mec-address"><?php echo (isset($location['address']) ? $location['address'] : ''); ?></span></address></dd>
                </div>
            </div>
            <?php if($location['thumbnail']): ?>
                <img class="mec-img-location" src="<?php echo esc_url($location['thumbnail'] ); ?>" alt="<?php echo (isset($location['name']) ? $location['name'] : ''); ?>">
            <?php endif; ?>
        </div>
        <?php
        $additional_locations_status = (!isset($settings['additional_locations']) or (isset($settings['additional_locations']) and $settings['additional_locations'])) ? true : false;
        if ($additional_locations_status) {
            $locations = array();
            foreach($event->data->locations as $o) if($o['id'] != $event->data->meta['mec_location_id']) $locations[] = $o;
            if (count($locations)) {
                ?>
                <div class="mec-single-event-additional-locations">
                    <?php $i = 2; ?>
                    <?php foreach($locations as $location): if($location['id'] == $event->data->meta['mec_location_id']) continue; ?>
                        <div class="mec-single-event-location">
                            <div class="mec-single-event-location-inner">
                                <i class="mec-sl-location-pin"></i>
                                <div class="mec-single-event-location-content">
                                    <h3 class="mec-events-single-section-title mec-location"><?php echo $this->main->m('taxonomy_location', __('Location', 'mec-fl')); ?> <?php echo $i; ?></h3>
                                    <dd class="location"><address class="mec-events-address"><span class="mec-address"><?php echo (isset($location['address']) ? $location['address'] : ''); ?></span></address></dd>
                                </div>
                            </div>
                            <?php if($location['thumbnail']): ?>
                                <img class="mec-img-location" src="<?php echo esc_url($location['thumbnail'] ); ?>" alt="<?php echo (isset($location['name']) ? $location['name'] : ''); ?>">
                            <?php endif; ?>
                        </div>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </div>
                <?php
            }
        }
    }
}, 1, 0);

include dirname(__FILE__) . '/render.php';
