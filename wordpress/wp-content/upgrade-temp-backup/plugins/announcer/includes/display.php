<?php

if( ! defined( 'ABSPATH' ) ) exit;

class ANCR_Display{

    public static function init(){

        add_action( 'wp_enqueue_scripts', array( __CLASS__, 'scripts_styles' ) );

        add_action( 'wp_footer', array( __CLASS__, 'display' ) );

    }

    public static function scripts_styles(){

        wp_enqueue_script( 'announcer-js', ANCR_URL . 'public/js/script.js', array( 'jquery' ), ANCR_VERSION );
        wp_enqueue_style( 'announcer-css', ANCR_URL . 'public/css/style.css', array(), ANCR_VERSION );

    }

    public static function can_display( $settings ){

        $location_rules = new \ANCR\Location_Rules();
        $loc_rules = $settings[ 'location_rules' ];

        return $location_rules->check_rule( $loc_rules );

    }

    public static function display(){

        $announcements = Announcer::get_announcements();

        $preview_data = self::handle_preview();
        if( $preview_data ){
            $announcements = $preview_data;
        }

        $positions = [ 'top', 'bottom' ];
        $stickies = [ 'yes', 'no' ];

        $groups = [];
        foreach( $announcements as $id => $post ){

            if( $post[ 'settings' ][ 'status' ] == 'inactive' ){
                continue;
            }

            if( !self::can_display( $post[ 'settings' ] ) ){
                continue;
            }

            $position = $post[ 'settings' ][ 'position' ];
            $sticky = $post[ 'settings' ][ 'sticky' ] == 'yes' ? 'sticky' : 'normal';

            if( array_key_exists( $position, $groups ) ){
                if( array_key_exists( $sticky, $groups[ $position ] ) ){
                    array_push( $groups[ $position ][ $sticky ], $id );
                }else{
                    $groups[ $position ][ $sticky ] = [
                        $id
                    ];
                }
            }else{
                $groups[ $position ] = [];
                $groups[ $position ][ $sticky ] = [
                    $id
                ];
            }

        }

        foreach( $groups as $position => $stickies ){
            foreach( $stickies as $sticky => $bars ){
                $classes = [ 'ancr-group', 'ancr-pos-' . $position, 'ancr-' . $sticky ];
                echo '<div class="' . implode( ' ', $classes ) . '">';
                foreach( $bars as $id ){
                    echo self::html( $id, $announcements[ $id ] );
                }
                echo '</div>';
            }
        }

    }

    public static function html( $id, $post ){

        $html = '';
        $content = $post[ 'content' ];
        $settings = $post[ 'settings' ];

        $classes = [ 'ancr', 'ancr-wrap' ];
        array_push( $classes, 'ancr-lo-' . esc_attr( $settings[ 'layout' ] ) );
        array_push( $classes, 'ancr-align-' . esc_attr( $settings[ 'align_content' ] ) );

        $settings_attr = $settings;

        unset( $settings_attr[ 'cta_buttons' ] );
        unset( $settings_attr[ 'style_bar' ] );
        unset( $settings_attr[ 'style_primary_btn' ] );
        unset( $settings_attr[ 'style_secondary_btn' ] );
        unset( $settings_attr[ 'location_rules' ] );
        unset( $settings_attr[ 'schedule_timezone' ] );

        $settings_attr[ 'id' ] = $id;
        $settings_attr[ 'schedule_from' ] = ANCR_Utilities::datetime_timestamp( $settings[ 'schedule_from' ], $settings[ 'schedule_timezone' ] );
        $settings_attr[ 'schedule_to' ] = ANCR_Utilities::datetime_timestamp( $settings[ 'schedule_to' ], $settings[ 'schedule_timezone' ] );

        $settings_attr = esc_attr( json_encode( $settings_attr ) );
        $class = implode( ' ', $classes );

        $html .= '<div id="ancr-' . $id . '" class="' . $class . '" data-props="' . $settings_attr . '">';
            if( $settings[ 'close_btn' ] == 'yes' ){
                $html .= self::close_btn();
            }
            $html .= '<div class="ancr-container">';
            $html .= '<div class="ancr-content">';
            $html .= '<div class="ancr-inner">';
            $html .= do_shortcode( wpautop( $content ) );
            $html .= '</div>';
            $html .= '</div>';
            $html .= self::buttons( $settings[ 'cta_buttons' ] );
            $html .= '</div>';
        $html .= '</div>';

        $html .= self::styles( $id, $settings );

        return $html;

    }

    public static function buttons( $buttons ){

        if( !is_array( $buttons ) || empty( $buttons ) ){
            return '';
        }

        $defaults = ANCR_Settings::template_defaults( 'cta_buttons' );

        $html = '<div class="ancr-btn-wrap">';

        foreach( $buttons as $button ){

            $button = wp_parse_args( $button, $defaults );

            $link = '#';
            $link_target = '_self';
            $classes = [ 'ancr-btn', 'ancr-btn-' . $button[ 'type' ] ];

            if( $button[ 'on_click' ] == 'open_link' ){
                $link = $button[ 'link_url' ];
                $link_target = $button[ 'link_target' ] == 'new_window' ? '_blank' : '_self';
            }

            if( $button[ 'on_click' ] == 'close_bar' || $button[ 'link_do_close' ] == 'yes' ){
                array_push( $classes, 'ancr-close' );
            }

            $class = implode( ' ', $classes );

            $html .= '<a href="' . $link . '" target="' . $link_target . '" class="' . $class . '" title="' . $button[ 'title' ] . '">' . $button[ 'text' ] . '</a>';
        }

        $html .= '</div>';

        return $html;

    }

    public static function close_btn(){

        $icon = '<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="ancr-close-icon" viewBox="0 0 352 512"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"/></svg>';
        return '<a href="#" class="ancr-close-btn ancr-close" title="Close">' . $icon . '</a>';

    }

    public static function styles( $id, $settings ){
        $bar_style = ANCR_Utilities::style_generator( $settings[ 'style_bar' ] );
        $primary_btn_style = ANCR_Utilities::style_generator( $settings[ 'style_primary_btn' ] );
        $secondary_btn_style = ANCR_Utilities::style_generator( $settings[ 'style_secondary_btn' ] );

        $container_width = $settings[ 'container_width' ];

        $bar_links = '';
        if( !empty( $settings[ 'style_bar' ]['link_color'] ) ){
            $bar_links = "#ancr-$id .ancr-content a{color: {$settings[ 'style_bar' ]['link_color']}; }";
        }

        if( $settings[ 'style_bar' ][ 'shadow' ] == 'yes' && $settings[ 'position' ] == 'bottom' ){
            $bar_style .= 'box-shadow: 0 -2px 4px -2px rgba(0, 0, 0, 0.5);';
        }

        return "<style>
#ancr-$id{ $bar_style }
#ancr-$id .ancr-btn-primary{ $primary_btn_style }
#ancr-$id .ancr-btn-secondary{ $secondary_btn_style }
#ancr-$id .ancr-container{ max-width: $container_width; }
{$bar_links}
</style>";

    }

    public static function handle_preview(){

        if( isset( $_GET[ 'ancr_preview' ] ) && !empty( $_POST ) && isset( $_POST[ 'ancr_preview_nonce' ] ) ){

            if( !wp_verify_nonce( $_POST[ 'ancr_preview_nonce' ], 'ancr_preview_nonce' ) ){
                return false;
            }

            $_POST = stripslashes_deep( $_POST );
            $defaults = ANCR_Settings::defaults();

            $content = isset( $_POST[ 'content' ] ) ? wp_filter_post_kses( $_POST[ 'content' ] ) : '';
            $settings = isset( $_POST[ 'settings' ] ) ? ANCR_Admin::sanitize_post_array( $_POST[ 'settings' ] ) : array();

            $settings = wp_parse_args( $settings , $defaults );

            $settings[ 'cta_buttons' ] = isset( $settings[ 'cta_buttons' ] ) ? $settings[ 'cta_buttons' ] : [];
            $settings[ 'cta_buttons' ] = ANCR_Admin::pivot_array( $settings[ 'cta_buttons' ] );
            $settings[ 'status' ] = 'active';
            $settings[ 'display' ] = 'immediate';
            $settings[ 'location_rules' ][ 'type' ] = 'show_all';

            return array(
                'PREVIEW' => array(
                    'content' => wp_unslash( $content ),
                    'settings' => $settings
                )
            );
        }

        return false;

    }

}

ANCR_Display::init();

?>