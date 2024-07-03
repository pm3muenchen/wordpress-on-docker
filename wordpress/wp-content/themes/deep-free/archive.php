<?php
/**
 * Deep Theme.
 * 
 * The template for displaying archive pages
 *
 * @since   1.0.0
 * @author  Webnus
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

load_template( get_template_directory() . '/index.php' );
Deep_Free_WN_Index::$instance;