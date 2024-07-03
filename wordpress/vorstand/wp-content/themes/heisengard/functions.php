<?php
/** 
* Include API hook file
**/
include_once trailingslashit( get_template_directory() ).'inc/api-hooks.php';

function heisengard_setup() {

	require_once ( get_template_directory() .'/core/core_functions.php' );
	require_once ( get_template_directory() .'/one-shortcodes/shortcode.php' );
	require_once ( get_template_directory() .'/metabox/metabox.php' );
	
	load_theme_textdomain( 'heisengard', get_template_directory() . '/languages' );

	if (function_exists('add_theme_support')) {
		add_theme_support('menus');
	}

	$content_width = 450;
	
	add_theme_support('post-thumbnails');
	add_image_size('sliderimg', 940, 338, true);
	add_image_size('sliderimg2', 940, 499, true);
	add_image_size('testiimg', 288, 288, true);
	add_image_size('blogimg', 221, 164, true);

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

}
add_action( 'after_setup_theme', 'heisengard_setup' );

function heisengard_widgets_init() {
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar-1',
		'description' => 'This area for home page first sidebar that is top right after nvigation',	
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
        
        register_sidebar( array(
		'name'          => __( 'Footer 1', 'heisengard' ),
		'id'            => 'footer-sidebar-1',
		'description'   => __( 'Add widgets here.', 'heisengard' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'heisengard' ),
		'id'            => 'footer-sidebar-2',
		'description'   => __( 'Add widgets here.', 'heisengard' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'heisengard' ),
		'id'            => 'footer-sidebar-3',
		'description'   => __( 'Add widgets here.', 'heisengard' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'heisengard_widgets_init' );

add_action( 'wp_enqueue_scripts', 'my_scripts' );
function my_scripts(){
	wp_enqueue_script('jquery');

	$resource_extension = ( SCRIPT_DEBUG || SCRIPT_DEBUG == 'true') ? '' : '.min'; // Adding .min extension if SCRIPT_DEBUG is enabled
	$resource_min_dir = ( SCRIPT_DEBUG || SCRIPT_DEBUG == 'true') ? '' : 'min-'; // Adding min- as a minified directory of resources if SCRIPT_DEBUG is enabled

	wp_register_style( 'my-style', get_stylesheet_uri() );
	wp_register_style( 'styless', get_template_directory_uri() . '/assets/'.$resource_min_dir.'css/styles'.$resource_extension.'.css' );
	wp_register_style( 'mmenu-css', get_template_directory_uri() . '/assets/'.$resource_min_dir.'css/mmenu'.$resource_extension.'.css' );
	wp_register_style( 'style-heisengard-all', get_template_directory_uri() . '/assets/min-css/style.min.css' );

	wp_register_style( 'my-google-font', '//fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,200,100,800',false );
	wp_enqueue_style( 'my-google-font' );
	
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'font-awesome' );

	wp_register_script( 'mmenu-js', get_template_directory_uri() . '/assets/'.$resource_min_dir.'js/mmenu'.$resource_extension.'.js', array('jquery'), null, true );
	wp_register_script( 'flexslider-js', get_template_directory_uri() . '/assets/'.$resource_min_dir.'js/flexslider'.$resource_extension.'.js', array('jquery'), null, true );
	wp_register_script('custom-js', get_template_directory_uri() . '/assets/'.$resource_min_dir.'js/z-custom'.$resource_extension.'.js', array( 'jquery', 'mmenu-js', 'flexslider-js' ), null, true );
	wp_register_script( 'script-heisengard-all', get_template_directory_uri() . '/assets/min-js/script.min.js', array('jquery'), null, true );	
	

	if( (WP_DEBUG != true || WP_DEBUG != 'true' ) && (SCRIPT_DEBUG != true || SCRIPT_DEBUG != 'true' ) ) { 
		wp_enqueue_style('style-heisengard-all');
		wp_enqueue_script('script-heisengard-all');
		
		/* Localization */
		wp_localize_script( 'script-heisengard-all', 'one_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	} else {
		wp_enqueue_style( 'my-style');
		wp_enqueue_style( 'mmenu-css' );
		wp_enqueue_style( 'styless' );

		wp_enqueue_script( 'mmenu-js' );
		wp_enqueue_script( 'flexslider-js' );
		wp_enqueue_script('custom-js');
		/* Localization */
		wp_localize_script( 'custom-js', 'one_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}
}

function register_my_menus() {
	register_nav_menus(
		array(
	'primary_heisengard' => __('Primary - Heisengard', 'heisengard'),
	)
	);
}
add_action( 'init', 'register_my_menus' );

function my_post_type_testimonial() {
	register_post_type( 'testimonial',
                array( 
				'label' => __('Testimonial', 'heisengard'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'rewrite' => true,
				'hierarchical' => false,
				'menu_position' => 5,
				'supports' => array(
						'title','editor','thumbnail')
					) 
				);
	flush_rewrite_rules();	
}
add_action('init', 'my_post_type_testimonial');

function my_post_type_travel() {
	register_post_type( 'travel',
                array( 
				'label' => __('Travel', 'heisengard'), 
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'rewrite' => true,
				'hierarchical' => false,
				'menu_position' => 5,
				'supports' => array(
						'title','editor','thumbnail')
					) 
				);
	flush_rewrite_rules();	
}
add_action('init', 'my_post_type_travel');


// show attachment data
function wp_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}
  

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function myplugin_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['myplugin_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce'], 'myplugin_save_meta_box_data' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['myplugin_new_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['myplugin_new_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_my_meta_value_key', $my_data );
}
add_action( 'save_post', 'myplugin_save_meta_box_data' );

function pbd_events_jquery_datepicker() {
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script( 'jquery-ui-datepicker' );
}
add_action('admin_print_scripts-post-new.php', 'pbd_events_jquery_datepicker');
add_action('admin_print_scripts-post.php', 'pbd_events_jquery_datepicker');

function pbd_events_jquery_datepicker_css() {
    wp_enqueue_style(
        'jquery-ui-datepicker',
        esc_url( get_template_directory_uri() ) . '/admin/assets/css/jquery-ui.css'
    );
}
add_action('admin_print_styles-post-new.php', 'pbd_events_jquery_datepicker_css');
add_action('admin_print_styles-post.php', 'pbd_events_jquery_datepicker_css');


/**
 * Outputs the content of the meta box
 */
function prfx_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'prfx_nonce' );
	$prfx_stored_meta = get_post_meta( $post->ID );
	?>

	<p>
	<label for="meta-text" class="prfx-row-title" style="width: 70px; float: left; "><?php _e( 'Group', 'heisengard' )?></label>
	<input type="text" name="meta-text" id="meta-text" value="<?php if ( isset ( $prfx_stored_meta['meta-text'] ) ) echo $prfx_stored_meta['meta-text'][0]; ?>" />
	</p>

	<p>
	<label for="meta-text2" class="prfx-row-title" style="width: 70px; float: left; "><?php _e( 'Price', 'heisengard' )?></label>
	<input type="text" name="meta-text2" id="meta-text2" value="<?php if ( isset ( $prfx_stored_meta['meta-text2'] ) ) echo $prfx_stored_meta['meta-text2'][0]; ?>" />
	</p>
	<p>
	<label for="meta-text3" class="prfx-row-title" style="width: 70px; float: left; "><?php _e( 'Breakfast', 'heisengard' )?></label>
	<input type="text" name="meta-text3" id="meta-text3" value="<?php if ( isset ( $prfx_stored_meta['meta-text3'] ) ) echo $prfx_stored_meta['meta-text3'][0]; ?>" />
	</p>
	<p>
	<label for="meta-text4" class="prfx-row-title" style="width: 70px; float: left; "><?php _e( 'Flight', 'heisengard' )?></label>
	<input type="text" name="meta-text4" id="meta-text4" value="<?php if ( isset ( $prfx_stored_meta['meta-text4'] ) ) echo $prfx_stored_meta['meta-text4'][0]; ?>" />
	</p>
	<p>
	<label for="meta-text5" class="prfx-row-title" style="width: 70px; float: left; "><?php _e( 'Guide', 'heisengard' )?></label>
	<input type="text" name="meta-text5" id="meta-text" value="<?php if ( isset ( $prfx_stored_meta['meta-text5'] ) ) echo $prfx_stored_meta['meta-text5'][0]; ?>" />
	</p>
	<p>
	<label for="meta-text6" class="prfx-row-title" style="width: 70px; float: left; "><?php _e( 'Car', 'heisengard' )?></label>
	<input type="text" name="meta-text6" id="meta-text6" value="<?php if ( isset ( $prfx_stored_meta['meta-text6'] ) ) echo $prfx_stored_meta['meta-text6'][0]; ?>" />
	</p>
	
 

	<?php
}
/**
 * Saves the custom meta input
 */
function prfx_meta_save( $post_id ) {
 
	// Checks save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'prfx_nonce' ] ) && wp_verify_nonce( $_POST[ 'prfx_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
	// Exits script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		return;
	}
 
	// Checks for input and sanitizes/saves if needed
	if( isset( $_POST[ 'meta-text' ] ) ) {
		update_post_meta( $post_id, 'meta-text', sanitize_text_field( $_POST[ 'meta-text' ] ) );
	}
	if( isset( $_POST[ 'meta-text2' ] ) ) {
		update_post_meta( $post_id, 'meta-text2', sanitize_text_field( $_POST[ 'meta-text2' ] ) );
	}
	if( isset( $_POST[ 'meta-text3' ] ) ) {
		update_post_meta( $post_id, 'meta-text3', sanitize_text_field( $_POST[ 'meta-text3' ] ) );
	}
	if( isset( $_POST[ 'meta-text4' ] ) ) {
		update_post_meta( $post_id, 'meta-text4', sanitize_text_field( $_POST[ 'meta-text4' ] ) );
	}
	if( isset( $_POST[ 'meta-text5' ] ) ) {
		update_post_meta( $post_id, 'meta-text5', sanitize_text_field( $_POST[ 'meta-text5' ] ) );
	}
	if( isset( $_POST[ 'meta-text6' ] ) ) {
		update_post_meta( $post_id, 'meta-text6', sanitize_text_field( $_POST[ 'meta-text6' ] ) );
	}
	
}
add_action( 'save_post', 'prfx_meta_save' );
add_action( 'add_meta_boxes', 'cd_meta_box_add' );
function cd_meta_box_add()
{
	global $post;
	$post_id = $post->post_id ; 
	$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
	//echo $template_file;
	if ($template_file == 'default') { 
		add_meta_box( 'my-meta-box-id', 'Select Sidebar', 'cd_meta_box_cb', array('page'), 'normal', 'high' );
	}
	
}
function cd_meta_box_cb( $post )
{
	$values = get_post_custom( $post->ID );
	$selected = isset( $values['my_meta_box_select'] ) ? esc_attr( $values['my_meta_box_select'][0] ) : '';
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
?>
<p>  
    <label for="my_meta_box_select">Select Sidebar</label>  
    <select name="my_meta_box_select" id="my_meta_box_select">  
        <option value="0" <?php selected( $selected, '0' ); ?>>No Sidebar</option>  
        <option value="1" <?php selected( $selected, '1' ); ?>>Left Sidebar</option> 
        <option value="2" <?php selected( $selected, '2' ); ?>>Right Sidebar</option> 
        <option value="3" <?php selected( $selected, '3' ); ?>>Both Sidebar</option>  
    </select>  
</p>     
<?php   
}
add_action( 'save_post', 'cd_meta_box_save' );
function cd_meta_box_save( $post_id )
{
	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	// if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce(        $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;
	// now we can actually save the data
	$allowed = array( 
		'a' => array( // on allow a tags
        'href' => array() // and those anchords can only have href attribute
		)
	);
// Probably a good idea to make sure your data is set
	if( isset( $_POST['my_meta_box_select'] ) )
    update_post_meta( $post_id, 'my_meta_box_select', esc_attr( $_POST['my_meta_box_select'] ) );
}

/* handle contact form request */
add_action( 'wp_ajax_send_contact_form', 'one_contact_form_handler', 10 );
add_action( 'wp_ajax_nopriv_send_contact_form', 'one_contact_form_handler', 10 );

function one_contact_form_handler() {
	global $custom; 
	$too = $custom['email-id'];
	if($too){
		$to = $custom['email-id'];
	} else{
		$to = get_option( 'admin_email' );
	} 
	//$to = get_option( 'admin_email' );
	$subject="Contact Information";   
	$body = "Contact Information \n\n\n".
	"Name: ".$_POST['name']." \n".
	"E-mail: ".$_POST['email']." \n".
	"message: ".$_POST['message']." \n".
	$email=$_POST['email'];

	/*
	 * Leaving the "from" field blank in mail-headers so that wordpress@domain.tld can act as sender
	 * More details: https://app.asana.com/0/307895785186248/529519894576281/f
	 */

	/*$headers = "From: $email \r\n";*/
	$headers = "Reply-To: $email \r\n";
	$mailSuc = wp_mail($to, $subject, $body, $headers);
	if($mailSuc){
		echo "Your message has been successfully sent.";
	} else{
		echo "Error!!";
	}
	die();
}

add_action( 'admin_enqueue_scripts', 'one_hg_admin_assets' );
function one_hg_admin_assets() {
	wp_register_style( $handle = 'one-hg-font-icons', get_template_directory_uri().'/admin/assets/fonts/onecom/style.css', null, null, 'all' );
	wp_enqueue_style( 'one-hg-font-icons' );
}

remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

add_filter('use_default_gallery_style', '__return_false');
add_filter( 'the_content', 'remove_br_gallery', 11, 2);
function remove_br_gallery($output) {
    return preg_replace('/\<br[^\>]*\>/','',$output);
}

add_filter('http_request_reject_unsafe_urls','__return_false');
add_filter( 'http_request_host_is_external', '__return_true' );
/*
add_action( 'http_api_debug', 'debug_http_api' );
function debug_http_api( $response, $context, $class, $args, $url ) {
	echo '<pre>';
	print_r( $response );
	echo '</pre>';

	echo '<pre>';
	print_r( $context );
	echo '</pre>';

	echo '<pre>';
	print_r( $class );
	echo '</pre>';

	echo '<pre>';
	print_r( $args );
	echo '</pre>';

	echo '<pre>';
	print_r( $url );
	echo '</pre>';
}*/
if( ! class_exists( 'ONECOM_UPDATER' ) ) {
    require_once get_template_directory( __FILE__ ).'/inc/update.php';
}

/* Include the One Click Importer */
if(!class_exists('OCDI_Plugin')){
	require_once ( get_template_directory() .'/importer/importer.php' );
}

/* Pass the importable files in the importer function. */
if(!function_exists('ocdi_import_files')){

    function ocdi_import_files(){
        return array(
            array(
                'import_file_name'             => 'Theme demo data',
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'importer/content.xml',
            ),
        );
    }

}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );

if( ! function_exists( 'ocdi_after_import_setup' ) ){
	function ocdi_after_import_setup() {
		/* Assign menus to their locations. */
		$main_menu = get_term_by( 'name', 'Primary - Heisengard', 'nav_menu' );
		set_theme_mod( 'nav_menu_locations', array(
				'primary_heisengard' => $main_menu->term_id,
			)
		);

        /* Assign front page and posts page (blog page). */
        $front_page_id = get_page_by_title('Home');
        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);

    }
}
add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );

function login_redirect( $redirect_to, $request, $user ){
    return home_url('');
}
add_filter( 'login_redirect', 'login_redirect', 10, 3 );

