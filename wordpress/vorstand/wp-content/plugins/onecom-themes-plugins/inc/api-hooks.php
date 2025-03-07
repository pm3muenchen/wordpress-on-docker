<?php
/**
* WordPress action to trigger after activating the theme
**/
add_action( 'after_switch_theme', 'onecom_activate_theme_trigger' );
/**
* WordPress action to trigger after deactivating the theme
**/
add_action( 'switch_theme', 'onecom_deactivate_theme_trigger', 10, 3 );
/**
* Function after activating the theme
**/
if( ! function_exists( 'onecom_activate_theme_trigger' ) ) {
	function onecom_activate_theme_trigger() {
	    $theme = wp_get_theme();
	    if( 'one.com' !== strtolower( $theme->display( 'Author', FALSE ) ) ) {
	    	return false;
		}
	    onecom_trigger_log( $request = 'themes', $slug = $theme->stylesheet, $action = 'activate' );
	}
}
/**
* Function after dectivating the theme
**/
if( ! function_exists( 'onecom_deactivate_theme_trigger' ) ) {
	function onecom_deactivate_theme_trigger( $new_name, $new_theme, $old_theme ) {
	    if( 'one.com' !== strtolower( $old_theme->display( 'Author', FALSE ) ) ) {
	    	return false;
		}
	    onecom_trigger_log( $request = 'themes', $slug = $old_theme->stylesheet, $action = 'deactivate' );
	}
}
/**
* Trigger log to WP API
**/
if( ! function_exists( 'onecom_trigger_log' ) ) {
	function onecom_trigger_log( $request, $slug, $action, $is_ajax = false ) {
	    global $onecom_log_url, $onecom_log_request, $onecom_log_slug, $onecom_log_action;

	    $url = MIDDLEWARE_URL.'/stats/'.$request.'/'.$slug.'/'.$action;

	    $onecom_log_url 	= $url;
	    $onecom_log_action	= $action;
	    $onecom_log_request	= $request;
	    $onecom_log_slug 	= $slug;

	    if( 'deactivate' === $action || 'plugins' === $request || $is_ajax === true ) {
	    	onecom_trigger_log_by_wp();
	    } else {
	    	add_action( 'admin_head', 'onecom_trigger_log_by_js' );
	    }

	    return false;
	}
}

/**
* Function to call log API Synchronously (deactivate not working with Asynchronusly)
**/
if( ! function_exists( 'onecom_trigger_log_by_wp' ) ) {
	function onecom_trigger_log_by_wp() {
		global $onecom_log_url, $onecom_log_request, $onecom_log_slug, $onecom_log_action;

		$option = 'onecom_activation_'.$onecom_log_request.'_'.$onecom_log_slug;

		if( $onecom_log_action === 'activate' ) {
			if( true === get_site_option( $option ) ) {
				return false;
			}
		}	

		$ip = ( isset( $_SERVER[ 'ONECOM_CLIENT_IP' ] ) && ! empty( $_SERVER[ 'ONECOM_CLIENT_IP' ] ) ) ? $_SERVER[ 'ONECOM_CLIENT_IP' ] : '127.0.0.0';
		$domain = ( isset( $_SERVER[ 'ONECOM_DOMAIN_NAME' ] ) && ! empty( $_SERVER[ 'ONECOM_DOMAIN_NAME' ] ) ) ? $_SERVER[ 'ONECOM_DOMAIN_NAME' ] : 'localhost';
		onecom_write_log( $onecom_log_url );

		global $wp_version;

		$args = array(
	        'method' => 'GET',
	        'timeout'       => 10,
	        'httpversion'   => '1.0',
	        'user-agent'    => 'WordPress/' . $wp_version . '; ' . home_url(),
	        'compress'      => false,
	        'decompress'    => true,
	        'sslverify'     => true,
	        'stream'        => false,
	        'headers'       => array(
	            'X-ONECOM-CLIENT-IP' => $ip,
	            'X-ONECOM-CLIENT-DOMAIN' => $domain
	        )
	    );

	    if( $onecom_log_action === 'activate' ) {
			update_site_option( $option, true );
		} else if( $onecom_log_action === 'deactivate' ) {
			delete_site_option( $option );
		}
	    
	    $response = wp_safe_remote_get( $onecom_log_url, $args );
	    //$body = wp_remote_retrieve_body( $response );
	   	//onecom_write_log( $body );
	    return false;
	}
}

/**
* Function to call log API Asynchronusly
**/
if( ! function_exists( 'onecom_trigger_log_by_js' ) ) {
	function onecom_trigger_log_by_js() {
		global $onecom_log_url, $onecom_log_request, $onecom_log_slug, $onecom_log_action;
		?>
		    <script type="text/javascript">
		    	( function( $ ) {
		    		$( document ).ready( function() {
		    			var data = {
							'action'		: 'onecom_log_activate_ajax',
							'request'		: '<?php echo $onecom_log_request; ?>',
							'slug'			: '<?php echo $onecom_log_slug; ?>',
							'log_action'	: '<?php echo $onecom_log_action; ?>',
						};

						$.post(ajaxurl, data, function(response) {
							console.log(response);
						});
		    		} );
		    	} )( jQuery );
		    </script>
		<?php 
	}
}

/**
* Ajax action to call trigger 
**/
if( ! function_exists( 'onecom_log_activate_ajax_callback' ) ) {
	function onecom_log_activate_ajax_callback() {
		$request 	= $_POST[ 'request' ];
		$action 	= $_POST[ 'log_action' ];
		$slug 		= $_POST[ 'slug' ];
		onecom_trigger_log( $request , $slug, $action, $is_ajax = true );
		wp_die();
	}
}
add_action( 'wp_ajax_onecom_log_activate_ajax', 'onecom_log_activate_ajax_callback' );

/**
* Function to write logs 
**/
if ( ! function_exists( 'onecom_write_log' ) ) {
	function onecom_write_log( $log ) {
		if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
	}
}