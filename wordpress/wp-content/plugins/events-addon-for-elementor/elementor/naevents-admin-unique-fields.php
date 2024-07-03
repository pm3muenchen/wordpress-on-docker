<?php

// unique widgets options
if ( ! function_exists( 'naeafe_unique_widgets_settings_init' ) ) {
  function naeafe_unique_widgets_settings_init() {
    $naeafe_unique_widgets = [];
    $naeafe_unique_widgets['unique_accommodation'] = array(
      'title' => __( 'Accommodation', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/accommodation-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-unique-elements/accommodation/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_unique_widgets['unique_calendar_button'] = array(
      'title' => __( 'Calendar Button', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_unique_widgets['unique_call_action'] = array(
      'title' => __( 'Call Action', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_unique_widgets['unique_conference'] = array(
      'title' => __( 'Conference', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/conference-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-unique-elements/conference/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_unique_widgets['unique_countdown'] = array(
      'title' => __( 'Countdown', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/countdown-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-unique-elements/countdown/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_unique_widgets['unique_discussion'] = array(
      'title' => __( 'Discussion', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/discussions-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-unique-elements/discussions/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_unique_widgets['unique_event'] = array(
      'title' => __( 'Event', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/event-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-unique-elements/event/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_unique_widgets['unique_infobox'] = array(
      'title' => __( 'Infobox', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/info-box-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-unique-elements/info-box/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_unique_widgets['unique_organizer'] = array(
      'title' => __( 'Organizer', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/organizer-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-unique-elements/organizer/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_unique_widgets['unique_pricing'] = array(
      'title' => __( 'Pricing', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/pricing-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-unique-elements/pricing-table/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_unique_widgets['unique_schedule_list'] = array(
      'title' => __( 'Schedule List', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/schedule-list-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-unique-elements/schedule-list/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_unique_widgets['unique_schedule_tab'] = array(
      'title' => __( 'Schedule Tab', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/schedule-list-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-unique-elements/schedule-tab/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_unique_widgets['unique_schedule'] = array(
      'title' => __( 'Schedule', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/schedule-list-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-unique-elements/schedule/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_unique_widgets['unique_sessions'] = array(
      'title' => __( 'Sessions', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/sessions-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-unique-elements/sessions/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_unique_widgets['unique_ticket'] = array(
      'title' => __( 'Ticket', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/ticket-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-unique-elements/ticket/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_unique_widgets['unique_upcoming'] = array(
      'title' => __( 'Upcoming', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/upcoming-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-unique-elements/upcoming/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_unique_widgets['unique_venues'] = array(
      'title' => __( 'Venues', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/venues-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/events-addon-unique-elements/venues/',
      'video_url' => '',
      'is_premium' => '',
    );

    return $naeafe_unique_widgets;
  }
}