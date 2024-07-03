<?php

// Save Admin Page Options Basic
function naevents_bw_settings_save_func() {
    if ( wp_verify_nonce( $_POST['nonce'], 'naevents-bw-settings' ) && current_user_can( 'manage_options' ) ) {
        $updated_value = [];
        if ( isset( $_POST['data'] ) && !empty( $_POST['data'] ) ) {
            foreach ( $_POST['data'] as $option ) {
                $updated_value[$option['name']] = $option['value'];
            }
            update_option( 'eafe_bw_settings', $updated_value );
        } else {
            update_option( 'eafe_bw_settings', '' );
        }
    }
    die;
}

add_action( 'wp_ajax_naevents_bw_settings_save', 'naevents_bw_settings_save_func' );
function naevents_bw_toggle_submit_func() {
    if ( wp_verify_nonce( $_POST['nonce'], 'eafe_bw_toggle_nonce' ) && current_user_can( 'manage_options' ) ) {
        update_option( 'eafe_bw_toggle', $_POST['data'] );
    }
    die;
}

add_action( 'wp_ajax_naevents_bw_toggle_submit', 'naevents_bw_toggle_submit_func' );
// Save Admin Page Options Unique
function naevents_uw_settings_save_func() {
    if ( wp_verify_nonce( $_POST['nonce'], 'naevents-uw-settings' ) && current_user_can( 'manage_options' ) ) {
        $updated_value = [];
        if ( isset( $_POST['data'] ) && !empty( $_POST['data'] ) ) {
            foreach ( $_POST['data'] as $option ) {
                $updated_value[$option['name']] = $option['value'];
            }
            update_option( 'eafe_unqw_settings', $updated_value );
        } else {
            update_option( 'eafe_unqw_settings', '' );
        }
    }
    die;
}

add_action( 'wp_ajax_naevents_uw_settings_save', 'naevents_uw_settings_save_func' );
function naevents_uw_toggle_submit_func() {
    if ( wp_verify_nonce( $_POST['nonce'], 'eafe_uw_toggle_nonce' ) && current_user_can( 'manage_options' ) ) {
        update_option( 'eafe_uw_toggle', $_POST['data'] );
    }
    die;
}

add_action( 'wp_ajax_naevents_uw_toggle_submit', 'naevents_uw_toggle_submit_func' );
// Save Admin Page Options Pro
function naevents_pro_settings_save_func() {
    if ( wp_verify_nonce( $_POST['nonce'], 'naevents-pro-settings' ) && current_user_can( 'manage_options' ) ) {
        $updated_value = [];
        if ( isset( $_POST['data'] ) && !empty( $_POST['data'] ) ) {
            foreach ( $_POST['data'] as $option ) {
                $updated_value[$option['name']] = $option['value'];
            }
            update_option( 'eafe_prow_settings', $updated_value );
        } else {
            update_option( 'eafe_prow_settings', '' );
        }
    }
    die;
}

add_action( 'wp_ajax_naevents_pro_settings_save', 'naevents_pro_settings_save_func' );
function naevents_pro_toggle_submit_func() {
    if ( wp_verify_nonce( $_POST['nonce'], 'eafe_pro_toggle_nonce' ) && current_user_can( 'manage_options' ) ) {
        update_option( 'eafe_prow_toggle', $_POST['data'] );
    }
    die;
}

add_action( 'wp_ajax_naevents_pro_toggle_submit', 'naevents_pro_toggle_submit_func' );