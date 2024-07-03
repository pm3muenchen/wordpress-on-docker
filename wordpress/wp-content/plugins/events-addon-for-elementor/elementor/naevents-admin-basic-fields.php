<?php

// Basic widgets options
if ( ! function_exists( 'naeafe_basic_widgets_settings_init' ) ) {
  function naeafe_basic_widgets_settings_init() {
    $naeafe_basic_widgets = [];
    $naeafe_basic_widgets['about_me'] = array(
      'title' => __( 'About Me', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/about-me-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/about-me/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['about_us'] = array(
      'title' => __( 'About Us', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/about-us-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/about-us/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['blog'] = array(
      'title' => __( 'Blog', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/blog-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/blog/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['primary_button'] = array(
      'title' => __( 'Primary Button', 'events-addon-for-elementor' ),
      'demo_url' => '',
      'documentation_url' => '',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['chart'] = array(
      'title' => __( 'Chart', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/chart-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/chart/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['contact'] = array(
      'title' => __( 'Contact', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/contact-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/contact-details/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['gallery'] = array(
      'title' => __( 'Gallery', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/gallery-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/gallery/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['get_apps'] = array(
      'title' => __( 'Get Apps', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/get-apps-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/get-apps/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['history'] = array(
      'title' => __( 'History', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/history-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/history/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['image_compare'] = array(
      'title' => __( 'Image Compare', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/image-compare-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/image-compare/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['process'] = array(
      'title' => __( 'Process', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/process-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/process/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['separator'] = array(
      'title' => __( 'Separator', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/separator-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/separator/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['services'] = array(
      'title' => __( 'Services', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/services-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/services/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['slider'] = array(
      'title' => __( 'Slider', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/slider-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/slider/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['subscribe_contact'] = array(
      'title' => __( 'Subscribe / Contact', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/subscribe-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/subscribe/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['table'] = array(
      'title' => __( 'Table', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/table-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/table/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['team_single'] = array(
      'title' => __( 'Team Single', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/team-single-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/team-single/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['team'] = array(
      'title' => __( 'Team', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/team-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/team/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['testimonials'] = array(
      'title' => __( 'Testimonials', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/testimonials-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/testimonial/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['typewriter'] = array(
      'title' => __( 'Typewriter', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/typewriter-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/typewriter/',
      'video_url' => '',
      'is_premium' => '',
    );
    $naeafe_basic_widgets['video'] = array(
      'title' => __( 'Video', 'events-addon-for-elementor' ),
      'demo_url' => 'https://nicheaddons.com/demos/events/elements/video-element/',
      'documentation_url' => 'https://nicheaddons.com/docs/basic-elements/video/',
      'video_url' => '',
      'is_premium' => '',
    );

    return $naeafe_basic_widgets;
  }
}