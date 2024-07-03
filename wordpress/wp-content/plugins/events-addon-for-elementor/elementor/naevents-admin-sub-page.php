<?php
// Output on Admin Page
if ( ! function_exists( 'naevents_admin_sub_page' ) ) {
  function naevents_admin_sub_page() { ?>
    
    <?php 
      $eafe_bw_settings  = get_option('eafe_bw_settings') ? get_option('eafe_bw_settings') : [];
      $eafe_uw_settings  = get_option('eafe_unqw_settings') ? get_option('eafe_unqw_settings') : [];
      $eafe_pro_settings = get_option('eafe_prow_settings') ? get_option('eafe_prow_settings') : [];
      $eafe_bw_toggle    = get_option('eafe_bw_toggle') ? get_option('eafe_bw_toggle') : 0;
      $eafe_uw_toggle    = get_option('eafe_uw_toggle') ? get_option('eafe_uw_toggle') : 0;
      $eafe_pro_toggle  = get_option('eafe_prow_toggle') ? get_option('eafe_prow_toggle') : 0;
    ?>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="//fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <div class="naeafe-admin-options naeafe-container">

      <div class="mb-4 mt-4">
        <h1>Welcome to the <strong>Events Addon for Elementor</strong></h1>
        <p class="lead">Events Addon for Elementor covers all the must-needed elements for creating a perfect Event website using Elementor Page Builder. 30+ Unique & Basic Elementor widget covers all of the Event elements. Including getting a list of event posts from the most popular Events WordPress plugins.</p>
      </div>

      <div class="naeafe-row">
        <div class="naeafe-col-8">
          <div class="naeafe-row align-items-center">
            <div class="naeafe-col-6">
              <div class="d-flex align-items-center naeafe-logo-wrapper">
                <img src="<?php echo NAEAFE_URL . 'assets/images/logo.png'; ?>" alt="logo" class="naeafe-logo">
                <span>
                  by <a href="https://nicheaddons.com/" target="_blank"><strong>Nichaddons</strong></a> / Version: <?php echo NAEAFE_VERSION; ?>
                </span>
              </div>
            </div>
            <div class="naeafe-col-6">
              <div class="d-flex justify-content-end">
                <div class="naeafe-search-widget-holder">
                  <svg class="naeafe-search-widget-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20"><path d="M18.869 19.162l-5.943-6.484c1.339-1.401 2.075-3.233 2.075-5.178 0-2.003-0.78-3.887-2.197-5.303s-3.3-2.197-5.303-2.197-3.887 0.78-5.303 2.197-2.197 3.3-2.197 5.303 0.78 3.887 2.197 5.303 3.3 2.197 5.303 2.197c1.726 0 3.362-0.579 4.688-1.645l5.943 6.483c0.099 0.108 0.233 0.162 0.369 0.162 0.121 0 0.242-0.043 0.338-0.131 0.204-0.187 0.217-0.503 0.031-0.706zM1 7.5c0-3.584 2.916-6.5 6.5-6.5s6.5 2.916 6.5 6.5-2.916 6.5-6.5 6.5-6.5-2.916-6.5-6.5z"></path></svg>
                  <input class="naevents-search-widget-field naeafe-search-widget-field naeafe-input" value="" placeholder="Search widgets">
                </div>
              </div>
            </div>
          </div>

          <!-- Basic Widgets Area -->
          <div class="naeafe-widgets-section">
            <div class="naeafe-widgets-section-inner">
              <div class="naeafe-widgets-section-title-holder">
                <h3 class="naeafe-widgets-section-title"><?php esc_html_e('Basic Widgets', 'events-addon-for-elementor'); ?></h3>
                <div class="naeafe-checkbox-toggle naeafe-field">
                  <h6 class="naevents-checkbox-toggle-text"><?php esc_html_e('Activate All', 'events-addon-for-elementor'); ?></h6>
                  <label class="switch naevents-checkbox-toggle-label">
                    <input type="checkbox" <?php checked( $eafe_bw_toggle, 1 ); ?> id="naevents-checkbox-toggle-bw" value="1">
                    <span class="naevents-checkbox-toggle-bw-slider slider round" data-ajax-url="<?php echo admin_url('admin-ajax.php'); ?>" data-nonce="<?php echo wp_create_nonce( 'eafe_bw_toggle_nonce' ); ?>"></span>
                  </label>
                  <button 
                  class="button button-outline basic-submit-class naevents-bw-settings-save" 
                  ><?php esc_html_e('Save', 'events-addon-for-elementor'); ?></button>
                </div>
              </div>
              
              <form method="post" class="naevents-bw-settings-form" data-ajax-url="<?php echo admin_url('admin-ajax.php'); ?>" data-nonce="<?php echo wp_create_nonce( 'naevents-bw-settings' ); ?>">
                <div class="naeafe-row">
                  <?php foreach (naeafe_basic_widgets_settings_init() as $id => $option) { ?>
                  <!-- Widgets start -->
                  <div class="naeafe-col-6 naevents-widget-col" data-widget-name="<?php echo strtolower( $option['title'] ); ?>"> 
                    <div class="naeafe-widget-grid<?php if($option['is_premium']) { ?> naeafe-widget-premium<?php } ?>">
                      <div class="naeafe-widget-grid-inner">
                        <!-- Widget start -->
                        <div class="naeafe-widgets-item naeafe-col-sm-12 naeafe-col-md-6">
                          <div class="naeafe-widgets-item-top">
                            <h4 class="naeafe-widgets-title">
                              <span class="naeafe-widgets-title-inner">
                                <?php echo esc_html($option['title']); ?>
                                <?php if($option['is_premium']) { ?>
                                  <sup class="naeafe-widgets-premium-label"><?php esc_html_e('premium', 'events-addon-for-elementor'); ?></sup>
                                <?php } ?>
                              </span>
                            </h4>
                            <div class="naeafe-checkbox-toggle naeafe-field">
                              <label class="switch">
                                <?php $eafe_bw_id = isset($eafe_bw_settings['nbeds_' . $id]) ? $eafe_bw_settings['nbeds_' . $id] : '' ;?>
                                <input type="checkbox" <?php checked( $eafe_bw_id, 1 ); ?> name="nbeds_<?php echo esc_attr($id); ?>" id="nbeds_<?php echo esc_attr($id); ?>-id" value="1">
                                <span class="slider round"></span>
                              </label>
                            </div>
                          </div>
                          <?php if($option['demo_url']) { ?>
                            <a href="<?php echo $option['demo_url']; ?>" target="_blank"><?php esc_html_e('Demo', 'events-addon-for-elementor'); ?></a>
                          <?php } if($option['documentation_url']) { ?>
                            <a href="<?php echo $option['documentation_url']; ?>" target="_blank"><?php esc_html_e('Documentation', 'events-addon-for-elementor'); ?></a>
                          <?php } if($option['video_url']) { ?>
                            <a href="<?php echo $option['video_url']; ?>" target="_blank"><?php esc_html_e('Video', 'events-addon-for-elementor'); ?></a>
                          <?php } ?>
                        </div>                  
                      </div>  
                    </div>
                  </div><!-- Widgets end -->
                  <?php } ?> 
                </div>
              </form>
            </div>
          </div><!-- Basic Widgets Area End -->

          <!-- Unique Widgets Area -->
          <div class="naeafe-widgets-section">
            <div class="naeafe-widgets-section-inner">
              <div class="naeafe-widgets-section-title-holder">
                <h3 class="naeafe-widgets-section-title"><?php esc_html_e('Unique Widgets', 'events-addon-for-elementor'); ?></h3>
                <div class="naeafe-checkbox-toggle naeafe-field">
                  <h6 class="naevents-checkbox-toggle-text"><?php esc_html_e('Activate All', 'events-addon-for-elementor'); ?></h6>
                  <label class="switch naevents-checkbox-toggle-label">
                    <input type="checkbox" <?php checked( $eafe_uw_toggle, 1 ); ?> id="naevents-checkbox-toggle-uw" value="1">
                    <span class="naevents-checkbox-toggle-uw-slider slider round" data-ajax-url="<?php echo admin_url('admin-ajax.php'); ?>" data-nonce="<?php echo wp_create_nonce( 'eafe_uw_toggle_nonce' ); ?>"></span>
                  </label>
                  <button 
                  class="button button-outline basic-submit-class naevents-uw-settings-save" 
                  ><?php esc_html_e('Save', 'events-addon-for-elementor'); ?></button>
                </div>
              </div>
              
              <form method="post" class="naevents-uw-settings-form" data-ajax-url="<?php echo admin_url('admin-ajax.php'); ?>" data-nonce="<?php echo wp_create_nonce( 'naevents-uw-settings' ); ?>">
                <div class="naeafe-row">
                  <?php foreach (naeafe_unique_widgets_settings_init() as $id => $option) { ?>
                  <!-- Widgets start -->
                  <div class="naeafe-col-6 naevents-widget-col" data-widget-name="<?php echo strtolower( $option['title'] ); ?>"> 
                    <div class="naeafe-widget-grid <?php if($option['is_premium']) { ?>naeafe-widget-premium<?php } ?>">
                      <div class="naeafe-widget-grid-inner">
                        <!-- Widget start -->
                        <div class="naeafe-widgets-item naeafe-col-sm-12 naeafe-col-md-6">
                          <div class="naeafe-widgets-item-top">
                            <h4 class="naeafe-widgets-title">
                              <span class="naeafe-widgets-title-inner">
                                <?php echo esc_html($option['title']); ?>
                                <?php if($option['is_premium']) { ?>
                                  <sup class="naeafe-widgets-premium-label"><?php esc_html_e('premium', 'events-addon-for-elementor'); ?></sup>
                                <?php } ?>
                              </span>
                            </h4>
                            <div class="naeafe-checkbox-toggle naeafe-field">
                              <?php if(eafe_fs()->is_free_plan() && $option['is_premium']) { 
                                $plan_class = 'free-plan'; 
                              } else { 
                                $plan_class = 'paid-plan'; 
                              } ?>
                              <img class="img-toggle <?php echo $plan_class; ?>" src="<?php echo NAEAFE_URL . 'assets/images/toggle.png'; ?>" alt="toggle">
                              <label class="switch main-toggle <?php echo $plan_class; ?>">
                                <?php $eafe_uw_id = (!empty($eafe_uw_settings) && isset($eafe_uw_settings['naeafe_' . $id])) ? $eafe_uw_settings['naeafe_' . $id] : 0 ;?>
                                <input type="checkbox" <?php checked( $eafe_uw_id, 1 ); ?> data-d="<?php echo $eafe_uw_settings['naeafe_' . $id]; ?>" name="naeafe_<?php echo esc_attr($id); ?>" id="naeafe_<?php echo esc_attr($id); ?>-id" value="1">
                                <span class="slider round"></span>
                              </label>
                            </div>
                          </div>
                          <?php if($option['demo_url']) { ?>
                            <a href="<?php echo $option['demo_url']; ?>" target="_blank"><?php esc_html_e('Demo', 'events-addon-for-elementor'); ?></a>
                          <?php } if($option['documentation_url']) { ?>
                            <a href="<?php echo $option['documentation_url']; ?>" target="_blank"><?php esc_html_e('Documentation', 'events-addon-for-elementor'); ?></a>
                          <?php } if($option['video_url']) { ?>
                            <a href="<?php echo $option['video_url']; ?>" target="_blank"><?php esc_html_e('Video', 'events-addon-for-elementor'); ?></a>
                          <?php } if(eafe_fs()->is_free_plan() && $option['is_premium']) { ?>
                            <a href="<?php echo admin_url('admin.php?page=naevents_admin_page-pricing'); ?>" class="naeafe-update-pro" target="_blank"><?php esc_html_e('Upgrade', 'events-addon-for-elementor'); ?></a>
                          <?php } ?>
                        </div>
                      </div>  
                    </div>
                  </div><!-- Widgets end -->
                  <?php } ?> 
                </div>
              </form>
            </div>
          </div><!-- Unique Widgets Area End -->        

          <!-- Pro Widgets Area -->
          <div class="naeafe-widgets-section">
            <div class="naeafe-widgets-section-inner">
              <div class="naeafe-widgets-section-title-holder">
                <h3 class="naeafe-widgets-section-title"><?php esc_html_e('Pro Widgets', 'events-addon-for-elementor'); ?></h3>
                <div class="naeafe-checkbox-toggle naeafe-field">
                  <h6 class="naevents-checkbox-toggle-text"><?php esc_html_e('Activate All', 'events-addon-for-elementor'); ?></h6>
                  <label class="switch naevents-checkbox-toggle-label">
                    <input type="checkbox" <?php checked( $eafe_pro_toggle, 1 ); ?> id="naevents-checkbox-toggle-pro" value="1">
                    <span class="naevents-checkbox-toggle-pro-slider slider round" data-ajax-url="<?php echo admin_url('admin-ajax.php'); ?>" data-nonce="<?php echo wp_create_nonce( 'eafe_pro_toggle_nonce' ); ?>"></span>
                  </label>
                  <button 
                  class="button button-outline basic-submit-class naevents-pro-settings-save" 
                  ><?php esc_html_e('Save', 'events-addon-for-elementor'); ?></button>
                </div>
              </div>
              
              <form method="post" class="naevents-pro-settings-form" data-ajax-url="<?php echo admin_url('admin-ajax.php'); ?>" data-nonce="<?php echo wp_create_nonce( 'naevents-pro-settings' ); ?>">
                <div class="naeafe-row">
                  <?php foreach (naeafe_pro_widgets_settings_init() as $id => $option) { ?>
                  <!-- Widgets start -->
                  <div class="naeafe-col-6 naevents-widget-col" data-widget-name="<?php echo strtolower( $option['title'] ); ?>"> 
                    <div class="naeafe-widget-grid <?php if($option['is_premium']) { ?>naeafe-widget-premium<?php } ?>">
                      <div class="naeafe-widget-grid-inner">
                        <!-- Widget start -->
                        <div class="naeafe-widgets-item naeafe-col-sm-12 naeafe-col-md-6">
                          <div class="naeafe-widgets-item-top">
                            <h4 class="naeafe-widgets-title">
                              <span class="naeafe-widgets-title-inner">
                                <?php echo esc_html($option['title']); ?>
                                <?php if($option['is_premium']) { ?>
                                  <sup class="naeafe-widgets-premium-label"><?php esc_html_e('premium', 'events-addon-for-elementor'); ?></sup>
                                <?php } ?>
                              </span>
                            </h4>
                            <div class="naeafe-checkbox-toggle naeafe-field">
                              <?php if(eafe_fs()->is_free_plan() && $option['is_premium']) { 
                                $plan_class = 'free-plan'; 
                              } else { 
                                $plan_class = 'paid-plan'; 
                              } ?>
                              <img class="img-toggle <?php echo $plan_class; ?>" src="<?php echo NAEAFE_URL . 'assets/images/toggle.png'; ?>" alt="toggle">
                              <label class="switch main-toggle <?php echo $plan_class; ?>">
                                <?php $eafe_pro_id = (!empty($eafe_pro_settings) && isset($eafe_pro_settings['naeafe_' . $id])) ? $eafe_pro_settings['naeafe_' . $id] : 0 ;?>
                                <input type="checkbox" <?php checked( $eafe_pro_id, 1 ); ?> data-d="<?php echo $eafe_pro_settings['naeafe_' . $id]; ?>" name="naeafe_<?php echo esc_attr($id); ?>" id="naeafe_<?php echo esc_attr($id); ?>-id" value="1">
                                <span class="slider round"></span>
                              </label>
                            </div>
                          </div>
                          <?php if($option['demo_url']) { ?>
                            <a href="<?php echo $option['demo_url']; ?>" target="_blank"><?php esc_html_e('Demo', 'events-addon-for-elementor'); ?></a>
                          <?php } if($option['documentation_url']) { ?>
                            <a href="<?php echo $option['documentation_url']; ?>" target="_blank"><?php esc_html_e('Documentation', 'events-addon-for-elementor'); ?></a>
                          <?php } if($option['video_url']) { ?>
                            <a href="<?php echo $option['video_url']; ?>" target="_blank"><?php esc_html_e('Video', 'events-addon-for-elementor'); ?></a>
                          <?php } if(eafe_fs()->is_free_plan() && $option['is_premium']) { ?>
                            <a href="<?php echo admin_url('admin.php?page=naevents_admin_page-pricing'); ?>" class="naeafe-update-pro" target="_blank"><?php esc_html_e('Upgrade', 'events-addon-for-elementor'); ?></a>
                          <?php } ?>
                        </div>
                      </div>  
                    </div>
                  </div><!-- Widgets end -->
                  <?php } ?> 
                </div>
              </form>
            </div>
          </div><!-- Pro Widgets Area End -->  

        </div>
        <!-- Advertisements start -->
        <div class="naeafe-col-4">
          <div class="nichads-wrapper ms-3">
            <div class="single-nichads mb-4">
              <a href="//nicheaddons.com">
                <img src="//nicheaddons.com/wp-content/uploads/2023/07/420x250-nichbase.jpg" alt="nichbase">
              </a>            
            </div>
            <div class="naeafe-row">
              <div class="naeafe-col-6">
                <div class="naeafe-info-box">
                  <a href="//nicheaddons.com/demos/events/" target="_blank">
                    <span class="ti-blackboard"></span>
                    <span>Live Demo</span>
                  </a>
                </div>
              </div>
              <div class="naeafe-col-6">
                <div class="naeafe-info-box">
                  <a href="//wordpress.org/plugins/events-addon-for-elementor/" target="_blank">
                    <span class="ti-world"></span>
                    <span>Plugins Page</span>
                  </a>
                </div>
              </div>
              <div class="naeafe-col-6">
                <div class="naeafe-info-box">
                  <a href="//nicheaddons.com/docs/basic-elements/" target="_blank">
                    <span class="ti-book"></span>
                    <span>Documentation</span>
                  </a>
                </div>
              </div>
              <div class="naeafe-col-6">
                <div class="naeafe-info-box">
                  <a href="<?php echo admin_url('admin.php?page=naevents_admin_page-contact') ?>" target="_blank">
                    <span class="ti-headphone-alt"></span>
                    <span>Support</span>
                  </a>
                </div>
              </div>
            </div>
            <div class="single-nichads mb-4">
              <a href="//nicheaddons.com/plugins/restaurant-addon/" target="_blank">
                <img src="//nicheaddons.com/wp-content/uploads/2023/08/420x680-restaurant-pro.jpg" alt="event-pro">
              </a>               
            </div>
            <div class="single-nichads mb-4">
              <a href="//nicheaddons.com/themes/nichebase/" target="_blank">
                <img src="//nicheaddons.com/wp-content/uploads/2023/07/420x680-nichbase-2.jpg" alt="nichbase">
              </a>               
            </div>
            <div class="single-nichads mb-4">
              <a href="//nicheaddons.com/plugin/" target="_blank">
                <img src="//nicheaddons.com/wp-content/uploads/2023/08/420x680-other-plugins.jpg" alt="other-plugins">
              </a>               
            </div>
          </div>
        </div><!-- Advertisements end -->
      </div>
    </div>
    
    <?php
  }
}
