<?php
add_action( 'admin_notices', 'deep_free_auto_update_notices' );
function deep_free_auto_update_notices () {
    $theme_version = wp_get_theme()->get( 'Version' );
	$check_version = wp_remote_get( 'http://webnus.net/api/theme-api/free' );		
    $expires_version = json_decode(wp_remote_retrieve_body($check_version));	
    
    if ( $theme_version < $expires_version->version ) {
        echo '<div class="deep-license-notice">            
                <p>New update is available for the theme! Click <a href="#" id="free-update">here</a> to proceed.</p>
                <span id="update-msg"></span>       
            </div>';
    }
}

add_action( 'admin_footer', 'auto_update_process' ); 
function auto_update_process() { ?>
	<script type="text/javascript" >
	    jQuery(document).ready(function($) {
            var data = {
                'action': 'deep_free_auto_update',               
            };
            jQuery('#free-update').on('click', function(e) {
               
                e.preventDefault();      

                jQuery('#update-msg').append('Updating... please wait.');

                jQuery.post(ajaxurl, data, function(response) {            
                    jQuery('#update-msg').html('Update Successful');
                });           
                            
            });
	});
	</script> <?php
}

/**
* Auto Update
*
* @since   1.0.0
*/
add_action( 'wp_ajax_deep_free_auto_update', 'deep_free_auto_update' );
function deep_free_auto_update() {
	$theme_version = wp_get_theme()->get( 'Version' );
	$check_version = wp_remote_get( 'http://webnus.net/api/theme-api/free' );		
	$expires_version = json_decode(wp_remote_retrieve_body($check_version));									
	$path = wp_upload_dir()['path'] . '/deep-free.zip';
	$themes_dir = get_theme_root();																										

	if ( $theme_version < $expires_version->version ) {
        if ( ! file_exists( $path ) ) {            
            $value = 'http://webnus.net/deep-free/deep-free.zip';

            $get_file = wp_remote_get( $value, array( 'timeout' => 999, 'httpversion' => '1.1', ) );				
            $upload = wp_upload_bits( basename( $value ), '', wp_remote_retrieve_body( $get_file ) );				

            if( !empty( $upload['error'] ) ) {
                return false;
            }	

            function move_file( $file, $to ) {
                $path_parts = pathinfo( $file );
                $newplace   = "$to/{$path_parts['basename']}";
                if ( rename( $file, $newplace ) )
                    return $newplace;
                return null;
            }								
            move_file($path, $themes_dir);	
        
            function deleteAll($str) { 
                if (is_file($str)) { 				
                    return unlink($str); 
                } 						
                elseif (is_dir($str)) { 														
                    $scan = glob(rtrim($str, '/').'/*'); 								
                    // Loop through the list of files 
                    foreach($scan as $index=>$path) { 								
                        // Call recursive function 
                        deleteAll($path); 
                    } 							
                    // Remove the directory itself 
                    return @rmdir($str); 
                } 
            } 												
            deleteAll($themes_dir . '/deep-free');  
            
            // extract
            $zip = new ZipArchive;
            if ($zip->open( $themes_dir . '/deep-free.zip' ) === TRUE) {
                $zip->extractTo( $themes_dir );
                $zip->close();							
            } 

            unlink($themes_dir . '/deep-free.zip'); 
        }	
    }	
    
	wp_die(); 
}