<?php

    /**
     * ReduxFramework Barebones Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    /* Get Page permalink by Page title. */
    if(!function_exists('onecom_get_page_link')){

        function onecom_get_page_link($title){
            if(!isset($title) || !strlen($title))
                return;

            $page = get_page_by_title($title);

            if(isset($page->ID) && is_object($page)){
                $link = get_permalink($page->ID);
                if(isset($link) || strlen($link)){
                    return $link;

                }
                else{
                    return '#';
                }
            }
            return '#';
        }

    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "custom";
    
    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => 'Heisengard',
        'page_title'           => 'Heisengard',
		'page_slug' => 'octheme_settings',
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-admin-customizer',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 75,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Page slug used to denote the panel
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'system_info'          => false,
        'menu_icon'       => 'dashicons-admin-customizer',
        // REMOVE
        
        //'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );


    Redux::setArgs( $opt_name, $args );


Redux::setSection( $opt_name, array(
    'title'      => __( 'General', 'heisengard' ),
    'id'         => 'General_option',
    'icon'   => 'dashicons dashicons-admin-settings',
    'fields'     => array(
		array(
			'id'       => 'opt-background',
			'type'     => 'background',
			'title'    => __('Body Background', 'heisengard'),
			'subtitle' => __('Body background with image, color, etc.', 'heisengard'),
			'default'  => array(
				'background-color' => '#fff',
				'background-image' => get_template_directory_uri().'/assets/images/bg.jpg'
			)
		),
		array(
			'id'=>'global-link-color',
			'type' => 'color',
			'title' => __('Link Color', 'heisengard'),
			'default'  => '#000',
			'output'      => array('color' =>'a'),
			'validate' => 'color',
		),
		array(
			'id'=>'global-link-hover_color',
			'type' => 'color',
			'title' => __('Link Hover Color', 'heisengard'),
			'default'  => '#afa08d',
			'output'      => array('color' =>'a:hover'),
			'validate' => 'color',
		),	
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Header', 'heisengard' ),
    'id'         => 'header_option',
    'icon'   => 'dashicons dashicons-admin-customizer',
    'fields'     => array(
    	array(
			'id'=>'logo_icon',
			'type' => 'media',
			'title' => __('Logo', 'heisengard'),
			'subtitle'     => __( 'Upload logo of your website.', 'heisengard' ),
			'default'  => array(
				'url'=>get_template_directory_uri().'/assets/images/logo.png'
			),
		),
		array(
			'id'=>'favicon_icon',
			'type' => 'media',
			'title' => __('Favicon', 'heisengard'),
			'subtitle'     => __( 'Upload favicon of your website.', 'heisengard' ),
			/*'default'  => array(
				'url'=> get_template_directory_uri().'/assets/images/favicon2.ico'
			),*/
		),
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Footer', 'heisengard' ),
    'id'         => 'footer_bottom_option',
    'icon'   => 'dashicons dashicons-admin-customizer',
    'fields'     => array(
		array(
			'id'=>'Footer_bottom_Background_color',
			'type' => 'color',
			'output'  => array('background-color' =>'#footer-wrap .footer-copyright'),
			'title' => __('Background Color', 'heisengard'),
			'default'  => '#535756',
			'validate' => 'color',
		),
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Typography', 'heisengard' ),
    'id'         => 'hg_typography',
    'icon' => 'dashicons dashicons-editor-spellcheck',
    'fields'     => array(
    	array(
			'id'          => 'global-text-text',
			'type'        => 'typography', 
			'title'       => __('Body Font Style', 'heisengard'),
			'google'      => true, 
			'font-backup' => false,
			'output'      => array('body'),
			'units'       =>'px',
			'subtitle' => __('Select the font size, font family, color etc', 'heisengard'),
			'default'     => array(
				'color'       => '#000000', 
				'font-style'  => 'normal', 
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '18px', 
				'line-height' => '32px'
			),
		),
		array(
			'id'          => 'h1-text',
			'type'        => 'typography', 
			'title'       => __('H1 Font Style', 'heisengard'),
			'google'      => true, 
			'font-backup' => false,
			'output'      => array('color' =>'h1','font-size' =>'h1','line-height' =>'h1','font-style' =>'h1','font-family' =>'h1'),
			'units'       =>'px',
			'subtitle' => __('Select the font size, font family, color etc', 'heisengard'),
			'default'     => array(
				'color'       => '#000000', 
				'font-style'  => '400', 
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '43px', 
				'line-height' => '77px'
			),
		),
		array(
			'id'          => 'h2-text',
			'type'        => 'typography', 
			'title'       => __('H2 Font Style', 'heisengard'),
			'google'      => true, 
			'font-backup' => false,
			'output'      => array('color' =>'h2','font-size' =>'h2','line-height' =>'h2','font-style' =>'h2','font-family' =>'h2'),
			'units'       =>'px',
			'subtitle' => __('Select the font size, font family, color etc', 'heisengard'),
			'default'     => array(
				'color'       => '#000000', 
				'font-style'  => '400', 
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '36px', 
				'line-height' => '43px'
			),
		),					

		array(
			'id'          => 'h3-text',
			'type'        => 'typography', 
			'title'       => __('H3 Font Style', 'heisengard'),
			'google'      => true, 
			'font-backup' => false,
			'output'      => array('color' =>'h3','font-size' =>'h3','line-height' =>'h3','font-style' =>'h3','font-family' =>'h3'),
			'units'       =>'px',
			'subtitle' => __('Select the font size, font family, color etc', 'heisengard'),
			'default'     => array(
				'color'       => '#000000', 
				'font-style'  => '400', 
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '32px', 
				'line-height' => '38px'
			),
		),					

		array(
			'id'          => 'h4-text',
			'type'        => 'typography', 
			'title'       => __('H4 Font Style', 'heisengard'),
			'google'      => true, 
			'font-backup' => false,
			'output'      => array('color' =>'h4','font-size' =>'h4','line-height' =>'h4','font-style' =>'h4','font-family' =>'h4'),
			'units'       =>'px',
			'subtitle' => __('Select the font size, font family, color etc', 'heisengard'),
			'default'     => array(
				'color'       => '#000000', 
				'font-style'  => '400', 
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '28px', 
				'line-height' => '33px'
			),
		),					

		array(
			'id'          => 'h5-text',
			'type'        => 'typography', 
			'title'       => __('H5 Font Style', 'heisengard'),
			'google'      => true, 
			'font-backup' => false,
			'output'      => array('color' =>'h5','font-size' =>'h5','line-height' =>'h5','font-style' =>'h5','font-family' =>'h5'),
			'units'       =>'px',
			'subtitle' => __('Select the font size, font family, color etc', 'heisengard'),
			'default'     => array(
				'color'       => '#000', 
				'font-style'  => '400', 
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '25px', 
				'line-height' => '30px'
			),
		),					

		array(
			'id'          => 'h6-text',
			'type'        => 'typography', 
			'title'       => __('H6 Font Style', 'heisengard'),
			'google'      => true, 
			'font-backup' => false,
			'output'      => array('color' =>'h6','font-size' =>'h6','line-height' =>'h6','font-style' =>'h6','font-family' =>'h6'),
			'units'       =>'px',
			'subtitle' => __('Select the font size, font family, color etc', 'heisengard'),
			'default'     => array(
				'color'       => '#000000', 
				'font-style'  => '400', 
				'font-family' => 'Raleway', 
				'google'      => true,
				'font-size'   => '20px', 
				'line-height' => '24px'
			),
		),
		
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Social', 'heisengard' ),
    'id'         => 'social_option',
    'desc' => __( 'Enter your social profile links here:', 'heisengard' ),
    'icon' => 'dashicons dashicons-share',
    'fields'     => array(
    	array(
			'id'=>'facebook_link',
			'type' => 'text',
			'title' => __('Facebook', 'heisengard'),
			'default' => 'http://www.facebook.com'
		),
		array(
			'id'=>'twitter_link',
			'type' => 'text',
			'title' => __('Twitter', 'heisengard'),
			'default' => 'http://www.twitter.com'
		),
		array(
			'id'=>'google',
			'type' => 'text',
			'title' => __('Google Plus', 'heisengard'),
			'default' => 'https://plus.google.com'
		),		
		array(
			'id'=>'instagram_link',
			'type' => 'text',
			'title' => __('Instagram', 'heisengard'),
			'default'  =>'',
		),
		array(
			'id'=>'linkedin_link',
			'type' => 'text',
			'title' => __('Linkedin', 'heisengard'),
			'default'  =>'',
		),
		array(
			'id'=>'pinterest_link',
			'type' => 'text',
			'title' => __('Pinterest', 'heisengard'),
			'default'  =>'',
		),
		array(
			'id'=>'snapchat_link',
			'type' => 'text',
			'title' => __('Snapchat', 'heisengard'),
			'default'  =>'',
		),
		array(
			'id'=>'stumbleupon_link',
			'type' => 'text',
			'title' => __('Stumbleupon', 'heisengard'),
			'default'  =>'',
		),
		array(
			'id'=>'tumblr_link',
			'type' => 'text',
			'title' => __('Tumblr', 'heisengard'),
			'default'  =>'',
		),
		array(
			'id'=>'vimeo_link',
			'type' => 'text',
			'title' => __('Vimeo', 'heisengard'),
			'default'  =>'',
		),
		array(
			'id'=>'whatsapp_link',
			'type' => 'text',
			'title' => __('Whatsapp', 'heisengard'),
			'default'  =>'',
		),
		array(
			'id'=>'youtube_link',
			'type' => 'text',
			'title' => __('YouTube', 'heisengard'),
			'default'  =>'',
		),
		array(
			'id'=>'icon-color',
			'type' => 'color',
			'output'  => array('color' =>'.social-icon a'),
			'title' => __('Icon Color', 'heisengard'),
			'subtitle' => __('Select social icon color', 'heisengard'),
			'default'  => '#a8a8a8',
			'validate' => 'color',
		),
		array(
			'id'=>'icon-bg-color',
			'type' => 'color',
			'output'  => array('background-color' =>'.social-icon a'),
			'title' => __('Icon Background Color', 'heisengard'),
			'subtitle' => __('Select social icon background color', 'heisengard'),
			'default'  => '#ffffff',
			'validate' => 'color',
		),
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Home', 'heisengard' ),
    'id'         => 'home_page_option',
    'icon'   => 'el el-home',
    'fields'     => array(
		array(
			'id'=>'banner_image',
			'type' => 'media',
			'title' => __('Banner', 'heisengard'),
			'subtitle'     => __('Please upload the image.', 'heisengard'),
			'default'     => array(
				'url' => get_template_directory_uri().'/assets/images/hd-heisengard-home-background.png'
			)
		),
                array(
			'id'=>'header_text',
			'type' => 'textarea',
			'title' => __('Banner Text', 'heisengard'),
			'default' => 'The world is a book, and those who do not travel read only a page'
		),
		array(
			'id'=>'header_title',
			'type' => 'text',
			'title' => __('Banner Sub-text', 'heisengard'),
			'default' => 'Saint Augustine'
		),
		
		/*array(
		    'id'   =>'divider_1',
		    'type' => 'divide'
		),*/
		array(
			'id'=>'never_image',
			'type' => 'media',
			'title' => __('Left Section Image', 'heisengard'),
			'subtitle' => '( '.__('Below the banner', 'heisengard').' )',
			'desc'     => __('Please upload Image.', 'heisengard'),
			'default'     => array(
				'url' => get_template_directory_uri().'/assets/images/heisengard-foggy-mountain.png'
			)
		),
		array(
			'id'=>'never_title',
			'type' => 'text',
			'title' => __('Left Section Title', 'heisengard'),
			'subtitle' => '( '.__('Below the banner', 'heisengard').' )',
			'default' => 'Never stop dreaming'
		),
		array(
			'id'=>'never_text',
			'type' => 'textarea',
			'title' => __('Left Section Text', 'heisengard'),
			'subtitle' => '( '.__('Below the banner', 'heisengard').' )',
			'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis magna enim, a condimentum nulla '
		),
		/*array(
		    'id'   =>'divider_2',
		    'type' => 'divide'
		),*/
		array(
			'id'=>'iceland_image',
			'type' => 'media',
			'title' => __(' Full Width Section Image', 'heisengard'),
			'desc'     => __('Please upload Image.', 'heisengard'),
			'default'     => array(
				'url' => get_template_directory_uri().'/assets/images/call-to-action.png'
			)
		),
		array(
			'id'=>'iceland_content',
			'type' => 'editor',
			'title' => __('Full Width Section Text', 'heisengard'),
			'default' => '[oc_title title="Captivated by Iceland" title_tag="h1"]
[oc_title title_color="#fff" font_size="25px" title_tag="p" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis magna enim, a condimentum nulla luctus in. Pellentesque habitant morbi"]
[oc_spacer height="25px"]
[oc_button link="'.onecom_get_page_link("Our Travels").'" text="Go explore"]
[oc_spacer height="16px"]'
		),
		array(
			'id'=>'service_image1',
			'type' => 'media',
			'title' => __('Box-1 Image', 'heisengard'),
			'subtitle' => '( '.__('Below the full width section', 'heisengard').' )',
			'desc'     => __('Please upload the image.', 'heisengard'),
			'default'     => array(
				'url' => get_template_directory_uri().'/assets/images/ser1.png'
			)
		),
		array(
			'id'=>'service_title1',
			'type' => 'textarea',
			'title' => __('Box-1 Title', 'heisengard'),
			'subtitle' => '( '.__('Below the full width section', 'heisengard').' )',
			'default' => '<a href="'.onecom_get_page_link("Our Travels").'">Outdoor</a>'
		),
		array(
			'id'=>'service_text1',
			'type' => 'textarea',
			'title' => __('Box-1 Text', 'heisengard'),
			'subtitle' => '( '.__('Below the full width section', 'heisengard').' )',
			'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis magna enim, a condi'
		),
		array(
			'id'=>'service_image2',
			'type' => 'media',
			'title' => __('Box-2 Image', 'heisengard'),
			'subtitle' => '( '.__('Below the full width section', 'heisengard').' )',
			'desc'     => __('Please upload the image.', 'heisengard'),
			'default'     => array(
				'url' => get_template_directory_uri().'/assets/images/ser2.png'
			)
		),
		array(
			'id'=>'service_title2',
			'type' => 'textarea',
			'title' => __('Box-2 Title', 'heisengard'),
			'subtitle' => '( '.__('Below the full width section', 'heisengard').' )',
			'default' => '<a href="'.onecom_get_page_link("Our Travels").'">Planning</a>'
		),
		array(
			'id'=>'service_text2',
			'type' => 'textarea',
			'title' => __('Box-2 Text', 'heisengard'),
			'subtitle' => '( '.__('Below the full width section', 'heisengard').' )',
			'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis magna enim, a condi'
		),	
		array(
			'id'=>'service_image3',
			'type' => 'media',
			'title' => __('Box-3 Image', 'heisengard'),
			'subtitle' => '( '.__('Below the full width section', 'heisengard').' )',
			'desc'     => __('Please upload the image .', 'heisengard'),
			'default'     => array(
				'url' => get_template_directory_uri().'/assets/images/ser3.png'
			)
		),
		array(
			'id'=>'service_title3',
			'type' => 'textarea',
			'title' => __('Box-3 Title', 'heisengard'),
			'subtitle' => '( '.__('Below the full width section', 'heisengard').' )',
			'default' => '<a href="'.onecom_get_page_link("Our Travels").'">Wildlife</a>'
		),
		array(
			'id'=>'service_text3',
			'type' => 'textarea',
			'title' => __('Box-3 Text', 'heisengard'),
			'subtitle' => '( '.__('Below the full width section', 'heisengard').' )',
			'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis magna enim, a condi'
		),
		/*array(
		    'id'   =>'divider_4',
		    'type' => 'divide'
		),*/
		array(
			'id'=>'bottom_content',
			'type' => 'editor',
			'title' => __('Bottom Section', 'heisengard'),
				'default' => '[oc_carousel slides_to_show="1"]
<img src="'.get_template_directory_uri().'/assets/images/heisengard-foggy-mountain.png" alt="" width="940" height="627" class="alignright size-full wp-image-4" />
<img src="'.get_template_directory_uri().'/assets/images/heisengard-long-road.png" alt="" width="940" height="627" class="alignright size-full wp-image-5" />
<img src="'.get_template_directory_uri().'/assets/images/heisengard-iceberg.png" alt="" width="940" height="627" class="alignright size-full wp-image-6" />
[/oc_carousel]
[oc_spacer height="25px"]
[oc_title title="Moments to capture" title_tag="h1"]
[oc_title font_size="25px" title_tag="p" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis magna enim, a condimentum nulla luctus in. Pellentesque"]
[oc_spacer height="25px"]
[oc_button link="'.onecom_get_page_link("Contact").'" text="Read more"]
[oc_spacer height="16px"]'
		),
    )
) );

Redux::setSection( $opt_name, array(
    'title'      => __( 'Contact', 'heisengard' ),
    'id'         => 'contact',
    'icon'   	 => 'el el-envelope',
    'fields'     => array(
		array(
			'id'       => 'contact_content',
			'type'     => 'editor',
			'title'    => __('Page content', 'heisengard'),
			'subtitle' => __('Use shortcodes here, if necessary.', 'heisengard'),
			'default'  => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus lobortis magna enim, a condimentum nulla luctus in. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p><p>Nulla rhoncus imperdiet eros, eu condimentum turpis rutrum egestas. Nunc vitae finibus nisl. Praesent rutrum justo sed risus lobortis, non egestas odio ultrices. Nunc vitae leo vehicula</p>',
		),
		array(         
			'id'       => 'email-id',
			'type'     => 'text',
			'title'    => __('Recipients', 'heisengard'),
			'subtitle' => __('Insert email addresses separated by comma', 'heisengard'),
			'desc'     => __('Provide email ids on which you want to receive email from contact form. Example: info@one.com, contact@gmail.com', 'heisengard'), 
			'default'  => get_option( 'admin_email' ),
		),
    )
) );


/* Function to load plugin page inside Redux section */
if(!function_exists('ocdi_section')){
    function ocdi_section(){
        $pt_one_click_demo_import = OCDI\OneClickDemoImport::get_instance();
        $pt_one_click_demo_import->display_plugin_page();
    }
}

/* Declare section/tab for the Importer in Redux page. */
Redux::setSection( $opt_name, array(
    'title'      => __( 'Import', 'heisengard' ),
    'id'         => 'import_section',
    'icon'   	 => 'el el-download-alt',
    'fields'     => array(
		array(
			'id'       => 'ocdimport',
			'type'     => 'callback',
			'class'    => 'ocdi',
			'callback'  => 'ocdi_section',
		),
    )
) );