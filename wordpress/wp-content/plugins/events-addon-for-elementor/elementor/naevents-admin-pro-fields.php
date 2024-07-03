<?php 

// unique widgets options
if ( ! function_exists( 'naeafe_pro_widgets_settings_init' ) ) {
  function naeafe_pro_widgets_settings_init() {
    $naeafe_pro_widgets = [];
    $naeafe_pro_widgets['pro_call_to_action'] = array(
      'title' => __( 'Call To Action', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_pro_widgets['pro_events_list'] = array(
      'title' => __( 'Events List', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_pro_widgets['pro_events_attendees'] = array(
      'title' => __( 'Events Attendees', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_pro_widgets['pro_events_ticket_selector'] = array(
      'title' => __( 'Events Ticket Selector', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/ticket-element/',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_pro_widgets['pro_events_calendar'] = array(
      'title' => __( 'Events Calendar', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_pro_widgets['pro_event_categories'] = array(
      'title' => __( 'Event Categories', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => 'https://nicheaddons.com/demos/events/elements/event-category/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_pro_widgets['pro_event_form'] = array(
      'title' => __( 'Event Form', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_pro_widgets['pro_events_group'] = array(
      'title' => __( 'Events Group', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_pro_widgets['pro_event_locations'] = array(
      'title' => __( 'Event Locations', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_pro_widgets['pro_event_search'] = array(
      'title' => __( 'Event Search', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_pro_widgets['pro_events_full_calendar'] = array(
      'title' => __( 'Events Full Calendar', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_pro_widgets['pro_info_box'] = array(
      'title' => __( 'Info Box', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/info-box-element/',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_pro_widgets['pro_events_map'] = array(
      'title' => __( 'Events Map', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_pro_widgets['pro_events_subscribe'] = array(
      'title' => __( 'Events Subscribe', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/subscribe-element/',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_pro_widgets['pro_calendar_button'] = array(
      'title' => __( 'Calendar Button', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_pro_widgets['pro_chart'] = array(
      'title' => __( 'Chart', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/pro-chart/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-pro-elements/chart/',
      'video_url' => '',
      'is_premium' => true,
    );
    $naeafe_pro_widgets['pro_pricing'] = array(
      'title' => __( 'Pricing', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/pro-pricing/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-pro-elements/pricing/',
      'video_url' => '',
      'is_premium' => true,
    );
    $naeafe_pro_widgets['pro_venues'] = array(
      'title' => __( 'Venues', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/venues-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-pro-elements/venues/',
      'video_url' => '',
      'is_premium' => true,
    );
    $naeafe_pro_widgets['pro_conference'] = array(
      'title' => __( 'Conference', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/event-conference/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-pro-elements/conference/',
      'video_url' => '',
      'is_premium' => true,
    );
    $naeafe_pro_widgets['pro_countdown'] = array(
      'title' => __( 'Countdown', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/event-countdown/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-pro-elements/countdown/',
      'video_url' => '',
      'is_premium' => true,
    );
    $naeafe_pro_widgets['pro_schedule'] = array(
      'title' => __( 'Schedule', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/event-schedule/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-pro-elements/schedule/',
      'video_url' => '',
      'is_premium' => true,
    );
    $naeafe_pro_widgets['pro_upcoming_events'] = array(
      'title' => __( 'Upcoming Events', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/upcoming-evevts/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-pro-elements/upcoming-events/',
      'video_url' => '',
      'is_premium' => true,
    );
    $naeafe_pro_widgets['pro_event_search_listing'] = array(
      'title' => __( 'Event Search Listing', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => true,
    );
    $naeafe_pro_widgets['pro_event_listing'] = array(
      'title' => __( 'Event Listing', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-pro-elements/event-listing/',
      'video_url' => '',
      'is_premium' => true,
    );
    $naeafe_pro_widgets['pro_event_slider'] = array(
      'title' => __( 'Event Slider', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/event-slider/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-pro-elements/event-slider/',
      'video_url' => '',
      'is_premium' => true
    );
    $naeafe_pro_widgets['pro_sessions'] = array(
      'title' => __( 'Sessions', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/event-sessions/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-pro-elements/sessions/',
      'video_url' => '',
      'is_premium' => true
    );
    $naeafe_pro_widgets['pro_event_category'] = array(
      'title' => __( 'Event Category', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/event-category/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-pro-elements/event-category/',
      'video_url' => '',
      'is_premium' => true
    );
    $naeafe_pro_widgets['pro_organizer'] = array(
      'title' => __( 'Organizer', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/event-organizer/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-pro-elements/organizer/',
      'video_url' => '',
      'is_premium' => true
    );
    $naeafe_pro_widgets['pro_eventbrite_event'] = array(
      'title' => __( 'Eventbrite Event', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => 'https://nicheaddons.com/demos/events/elements/eventbrite-event/',
      'video_url' => '',
      'is_premium' => true
    );
    $naeafe_pro_widgets['pro_eventbrite_events'] = array(
      'title' => __( 'Eventbrite Events', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/eventbrite-events/',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => true,
    );

    return $naeafe_pro_widgets;
  }
}