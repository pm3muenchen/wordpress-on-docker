<?php
if( ! defined( 'ABSPATH' ) ) exit;

class ANCR_Admin_Manage{

    public static function init(){

        add_filter( 'manage_' . ANCR_POST_TYPE . '_posts_columns', array( __CLASS__, 'column_head' ) );

        add_action( 'manage_' . ANCR_POST_TYPE . '_posts_custom_column', array( __CLASS__, 'column_content' ), 10, 2 );

    }

    public static function column_head( $columns ){

        unset( $columns[ 'views' ] );

        $columns[ 'status' ] = __( 'Status', 'sc');
        $columns[ 'display' ] = __( 'Display', 'sc');
        $columns[ 'position' ] = __( 'Position', 'sc');
        $columns[ 'sticky' ] = __( 'Sticky', 'sc');
        $columns[ 'colors' ] = __( 'Colors', 'sc');

        return $columns;

    }

    public static function column_content( $column, $post_id ){

        $announcements = Announcer::get_announcements();

        if( !array_key_exists( $post_id, $announcements ) ){
            return;
        }

        $announcement = $announcements[ $post_id ];

        $position_names = [
            'top' => __( 'Top', 'announcer' ),
            'bottom' => __( 'Bottom', 'announcer' )
        ];

        $display_names = [
            'immediate' => __( 'Immediate', 'announcer' ),
            'schedule' => __( 'Scheduled ', 'announcer' )
        ];

        $yes_no = [
            'yes' => __( 'Yes', 'announcer' ),
            'no' => __( 'No', 'announcer' )
        ];

        if( $column == 'status' ){
            echo '<label class="ancr_switch"><input class="ancr_switch_status" data-id="' . $post_id . '" type="checkbox" ' . checked( 'active', $announcement[ 'settings' ][ 'status' ], false ) . '><span class="ancr_slider round"></span></label>';
        }

        if( $column == 'position' ){
            $position = $announcement[ 'settings' ][ 'position' ];
            echo isset( $position_names[ $position ] ) ? $position_names[ $position ] : 'Top';
        }

        if( $column == 'sticky' ){
            $sticky = $announcement[ 'settings' ][ 'sticky' ];
            echo isset( $yes_no[ $sticky ] ) ? $yes_no[ $sticky ] : 'No';
        }

        if( $column == 'display' ){
            $display = $announcement[ 'settings' ][ 'display' ];
            echo isset( $display_names[ $display ] ) ? $display_names[ $display ] : 'Immediate';
            if($display == 'schedule'){
                $from = $announcement[ 'settings' ][ 'schedule_from' ];
                $to = $announcement[ 'settings' ][ 'schedule_to' ];

                if( $from && $to ){
                    echo __( 'between ', 'announcer' ) . '<span>' . $from . ' - ' . $to . '</span>';
                }elseif( $from && !$to ){
                    echo __( 'after ', 'announcer' ) . '<span>' . $from . '</span>';
                }elseif( !$from && $to ){
                    echo __( 'till ', 'announcer' ) . '<span>' . $to . '</span>';
                }else{
                    echo __( 'Not set. Always show', 'announcer' );
                }
                
            }
        }

        if( $column == 'colors' ){
            $bar_color = $announcement[ 'settings' ][ 'style_bar' ][ 'background_color' ];
            $primary_color = $announcement[ 'settings' ][ 'style_primary_btn' ][ 'background_color' ];
            $secondary_color = $announcement[ 'settings' ][ 'style_secondary_btn' ][ 'background_color' ];
            echo '<div style="background:' . $bar_color . '" title="' . __( 'Bar', 'announcer' ) . '">';
            echo '<span style="background:' . $primary_color . '" title="' . __( 'Primary button', 'announcer' ) . '"></span>';
            echo '<span style="background:' . $secondary_color . '" title="' . __( 'Secondary button', 'announcer' ) . '"></span>';
            echo '</div>';
        }

    }

}

ANCR_Admin_Manage::init();

?>