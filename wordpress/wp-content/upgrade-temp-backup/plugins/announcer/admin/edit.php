<?php

if( ! defined( 'ABSPATH' ) ) exit;

class ANCR_Admin_Edit{

    public static function init(){

        add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_boxes' ) );

        add_action( 'edit_form_after_title', array( __CLASS__, 'after_title' ) );

        add_action( 'save_post_' . ANCR_POST_TYPE, array( __CLASS__, 'save_post' ) );

        add_action( 'wp_ajax_announcer', array( __CLASS__, 'admin_ajax' ) );

    }

    public static function add_meta_boxes(){

        add_meta_box( 'ancr_mb_settings', __( 'Settings', 'announcer' ), array( __CLASS__, 'settings_form' ), ANCR_POST_TYPE, 'normal', 'default' );

        add_meta_box( 'ancr_mb_links', __( 'Get updates', 'announcer' ), array( __CLASS__, 'feedback' ), ANCR_POST_TYPE, 'side', 'default' );

        remove_meta_box( 'slugdiv', ANCR_POST_TYPE, 'normal' );

        remove_meta_box( 'commentstatusdiv', ANCR_POST_TYPE, 'normal' );

        remove_meta_box( 'commentsdiv', ANCR_POST_TYPE, 'normal' );

        remove_meta_box( 'pageparentdiv', ANCR_POST_TYPE, 'side' );

    }

    public static function after_title( $post ){

        if( $post->post_type != ANCR_POST_TYPE ){
            return;
        }

        $content = user_can_richedit() ? esc_textarea( $post->post_content ) : $post->post_content;

        echo '<div class="ancr_content">';
        wp_editor( $content, 'content', array(
            'wpautop' => false,
            'tinymce' => false,
            'textarea_rows' => 3,
            'quicktags' => array(
                'buttons' => 'strong,em,link,del,img,code,close,fullscreen'
            )
        ));
        echo '<p class="description">' . __( 'Supports - HTML, Shortcodes, emojis', 'announcer' ) . '</p>';
        echo '</div>';

    }

    public static function settings_form( $post ){

        ANCR_Settings_Form::render();

    }

    public static function save_post( $post_id ){

        // Checks save status
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'ancr_nonce' ] ) && wp_verify_nonce( $_POST[ 'ancr_nonce' ], 'ancr_post_nonce' ) );

        // Exits script depending on save status
        if ( $is_autosave || $is_revision || !$is_valid_nonce ){
            return;
        }

        if( array_key_exists( 'settings', $_POST ) ){
            $sanitized_data = ANCR_Admin::sanitize_post_array( $_POST[ 'settings' ] );

            $sanitized_data[ 'cta_buttons' ] = isset( $sanitized_data[ 'cta_buttons' ] ) ? $sanitized_data[ 'cta_buttons' ] : [];
            $sanitized_data[ 'cta_buttons' ] = ANCR_Admin::pivot_array( $sanitized_data[ 'cta_buttons' ] );

            update_post_meta( $post_id, 'settings', $sanitized_data );
        }

    }

    public static function admin_ajax(){

        if( !isset( $_POST[ 'do' ] ) ){
            wp_die();
        }

        $do = $_POST[ 'do' ];

        if( $do == 'switch-status' ){
            $post_id = intval( $_POST[ 'post-id' ] );
            $new_status = 'inactive';

            if( get_post_type( $post_id ) != ANCR_POST_TYPE ){
                echo 'invalid_post_type';
            }

            $settings = ANCR_Settings::get( $post_id );
            if( $settings[ 'status' ] == 'active' ) $new_status = 'inactive';
            if( $settings[ 'status' ] == 'inactive' ) $new_status = 'active';
            $settings[ 'status' ] = $new_status;

            if( update_post_meta( $post_id, 'settings', $settings ) ){
                echo 'success';
            }else{
                echo 'failed';
            }
        }

        wp_die();

    }

    public static function feedback( $post ){
        echo '<div class="feedback">';

        echo '<p>Get updates on the WordPress plugins, tips and tricks to enhance your WordPress experience. No spam.</p>';

        echo '<div class="subscribe_form" data-action="https://aakashweb.us19.list-manage.com/subscribe/post-json?u=b7023581458d048107298247e&id=ef5ab3c5c4&c=">
        <input type="email" class="subscribe_email_box" placeholder="Your email address">
        <p class="subscribe_confirm">Thanks for subscribing !</p>
        <button class="button subscribe_btn"><span class="dashicons dashicons-email"></span> Subscribe</button>
        </div>';

        echo '<ul>
        <li><a href="https://www.facebook.com/aakashweb" target="_blank">Follow on Facebook <span class="dashicons dashicons-arrow-right-alt2"></span></a></li>
        <li><a href="https://twitter.com/aakashweb" target="_blank">Follow on Twitter <span class="dashicons dashicons-arrow-right-alt2"></span></a></li>
        </ul>';

        echo '<a class="rate_review" href="https://wordpress.org/support/plugin/announcer/reviews/?rate=5#new-post" target="_blank">
        <h4>Rate &amp; Review</h4>
        <span class="dashicons dashicons-star-filled"></span>
        <p>Like this plugin ? please do rate and review.</p>
        </a>';

        echo '<div class="note_bottom">';
        echo '<h3>Feature missing/any issue ?</h3>';
        echo '<p>If you found any issue or if you are looking for a feature please submit a feedback and let me know <a href="https://www.aakashweb.com/forum/discuss/wordpress-plugins/announcer/" target="_blank">in the forum</a>.<p>';
        echo '</div>';

        echo '</div>';
    }

}

ANCR_Admin_Edit::init();

?>