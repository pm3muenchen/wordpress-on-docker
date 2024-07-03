<?php

if( ! defined( 'ABSPATH' ) ) exit;

class ANCR_Settings{

    public static function init(){

    }

    public static function defaults(){

        return [
            // Status
            'status' => 'active',

            // CTA
            'cta_buttons' => [],

            // Display
            'display' => 'immediate',
            'show_on' => 'page_open',
            'show_after_duration' => '0',
            'show_after_scroll' => '0',
            'open_animation' => 'slide',
            'schedule_from' => '',
            'schedule_to' => '',
            'schedule_timezone' => get_option( 'timezone_string' ),

            // Position
            'position' => 'bottom',
            'sticky' => 'yes',

            // Design
            'layout' => 'same_row',
            'align_content' => 'left',
            'container_width' => '1000px',
            'style_bar' => [],
            'style_primary_btn' => [],
            'style_secondary_btn' => [],

            // Close
            'close_btn' => 'yes',
            'close_animation' => 'slide',
            'auto_close' => '0',

            'keep_closed' => 'no',
            'closed_duration' => '0',

            // Location rules
            'location_rules' => [
                'type' => 'show_all',
                'rule' => 'W10='
            ],
            'devices' => 'all'

        ];

    }

    public static function template_defaults( $for, $sub_type = false ){

        if( $for == 'cta_buttons' ){
            return [
                'text' => '',
                'type' => '',
                'on_click' => 'open_link',
                'link_url' => '',
                'link_target' => 'new_window',
                'link_do_close' => 'no',
                'title' => ''
            ];
        }

        if( $for == 'designer' ){
            $defaults = [
                'background_color' => '',
                'font_color' => '',
                'font_size' => '',
                'link_color' => '',
                'border_width' => '',
                'border_style' => '',
                'border_color' => '',
                'border_radius' => '',
                'width' => '',
                'shadow' => 'yes',
            ];

            if( $sub_type == 'style_bar' ){
                $defaults[ 'background_color' ] = '#D61F1F';
                $defaults[ 'font_color' ] = '#fff';
                $defaults[ 'link_color' ] = '#fff';
            }

            if( $sub_type == 'style_primary_btn' ){
                $defaults[ 'background_color' ] = '#fff';
                $defaults[ 'font_color' ] = '#000';
            }

            if( $sub_type == 'style_secondary_btn' ){
                $defaults[ 'background_color' ] = '#F9DF74';
                $defaults[ 'font_color' ] = '#000';
            }

            return $defaults;

        }

    }

    public static function get( $post_id = false ){

        if( !$post_id ){
            global $post;
            $post_id = $post->ID;
        }

        $defaults = self::defaults();
        $actual_settings = get_post_meta( $post_id, 'settings', true );
        $settings = wp_parse_args( $actual_settings, $defaults );

        return $settings;

    }

}

?>