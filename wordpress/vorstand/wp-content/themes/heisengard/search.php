<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<!-- <div id="banner-wrap">
	<div class="innerbanner" style="background:url('<?php echo $url; ?>') no-repeat; ">
	</div>
</div> -->
<!-- finish banner wrap -->
<?php 
if( $url == '' ){
	$class = 'top-pad';
}
$subtitle = get_post_meta( get_the_ID(), 'TITLE_META_KEY', true);
?>
<div class="titleBlock <?php echo $class; ?>">
	<div class="centerBox">
		<h1><?php _e( 'Search Results', 'heisengard' ); ?></h1>
	</div>
</div>
<!-- begin Title Block -->

<?php 
$blg='<div class="bloxBox">';		   
		$blg.='<div class="centerBox">';		   
			$blg.='<ul>';
				if (have_posts()) : while (have_posts()) : the_post(); 
					$blg.='<li>';
						$blg.='<div class="image">';
							$blg.='<a href="'.get_permalink().'">';
									$blg.=get_the_post_thumbnail();
							$blg.='</a>';
						$blg.='</div>';
						$blg.='<div class="text">';
							$blg.='<h2><a href="'.get_permalink().'">';
							  $blg.=get_the_title();
							$blg.='</a></h2>';
							$blg.='<span>In';
								$blg.=date(' F Y',strtotime($date));
								$blg.='<span>By '.get_the_author();
							$blg.='</span></span>';
							$blg.='<div class="detail">';
							  $blg.=get_the_excerpt();
							$blg.='</div>';
						$blg.='</div>';
					$blg.='</li>';
				endwhile;

				endif; 

				if( !have_posts() )
					$blg .= '<li><h3>Not Found</h3></li>';

				wp_reset_query();
			$blg.='</ul>';		   
		$blg.="</div>";				
	$blg.="</div>";				
	echo $blg;
?>

<?php get_footer(); ?>