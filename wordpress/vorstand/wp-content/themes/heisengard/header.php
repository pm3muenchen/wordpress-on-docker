<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=990" />
<!-- Mobile Specific Metas ================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php global $custom; ?>
<?php $favicon = $custom['favicon_icon']['url'];
if($favicon){ ?>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $custom['favicon_icon']['url']; ?>" />
<?php }
?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
<?php include (TEMPLATEPATH . '/assets/css/header-css.php'); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
</head>

<body <?php body_class(); ?>>

<!-- begin section -->
<div id="section">
	
	<!-- begin page-wrap -->
	<div id="page-wrap">
		
	<!-- begin header -->
		<?php 
			$page_for_posts = get_option( 'page_for_posts' );
			$banner = false;
			if( is_home() || is_archive() || is_category() || is_tag() || is_author() ) {
				$banner_id = $page_for_posts;
			} else {
				$banner_id = get_the_ID();
			}
			if( ( $banner_id && get_post_thumbnail_id( $banner_id ) ) || is_front_page() ) {
				$banner = true;
			}
		?>
        <div id="header-wrap" class="<?php if( $banner ) { echo ' banner-img'; } else{ echo ' no-banner'; } ?>">

		<div class="centerBox">
			<?php $logo = $custom['logo_icon']['url']; ?>
			
			
			<div class="logo <?php echo (!strlen($logo)? 'logo-text' : ''); ?>">
				<button id="mobile-nav" class="micon mobile-only"></button>
			<?php if($logo){?>
				<a href ="<?php echo home_url() ?>">
					<img alt="<?php echo get_bloginfo( 'name' ); ?>" src="<?php echo $custom['logo_icon']['url']; ?>" />
					 
				</a>
			<?php } else { ?>
				<a href="<?php echo home_url() ?>"><?php bloginfo( 'name' );?></a>
			<?php }?>
			</div>
			

			<!-- begin nav -->
			<div class="nav-block desktop-only">
			<?php wp_nav_menu( array( 'theme_location' => 'primary_heisengard', 'container'=> '') ); ?>
			</div>
			<!-- finish nav -->
			
			<div class="clear"></div>
		
		</div>
		
	</div>
	<!-- finish header -->
		
		<!-- begin content -->
		<div id="content-wrap">
		
