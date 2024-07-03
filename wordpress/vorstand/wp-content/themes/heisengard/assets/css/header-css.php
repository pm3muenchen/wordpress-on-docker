<?php global $custom; ?>
<style type="text/css">
body, #section{
	<?php if(isset($custom['opt-background']['background-image'])){ ?>
	background-image:url(<?php echo $custom['opt-background']['background-image']; ?>)!important;
	<?php } ?>
	<?php if(isset($custom['opt-background']['background-repeat'])){ ?>
	background-repeat:<?php echo $custom['opt-background']['background-repeat']; ?>!important;
	<?php } ?>
	<?php if(isset($custom['opt-background']['background-size'])){ ?>
	background-size:<?php echo $custom['opt-background']['background-size']; ?>!important;
	<?php } ?>
	<?php if(isset($custom['opt-background']['background-attachment'])){ ?>
	background-attachment:<?php echo $custom['opt-background']['background-attachment']; ?>!important;
	<?php } ?><?php if(isset($custom['opt-background']['background-position'])){ ?>
	background-position:<?php echo $custom['opt-background']['background-position'];  ?>!important;
	<?php } ?><?php if(isset($custom['opt-background']['background-color'])){ ?>
	background-color:<?php echo $custom['opt-background']['background-color'];  ?>!important;
	<?php } ?>

	<?php if(isset($custom['global-text-text']['font-family'])) { ?>
		font-family:<?php echo $custom['global-text-text']['font-family'];  ?>;
	<?php } ?>

	<?php if(isset($custom['global-text-text']['font-size'])) { ?>
		font-size:<?php echo $custom['global-text-text']['font-size']; ?>;
	<?php } ?>

	<?php if(isset($custom['global-text-text']['line-height'])) { ?>
		line-height:<?php echo $custom['global-text-text']['line-height'];  ?>;
	<?php } ?>

	<?php if(isset($custom['global-text-text']['color'])) { ?>
		color:<?php echo $custom['global-text-text']['color'];  ?>;
	<?php } ?>
	
	<?php if(isset($custom['global-text-text']['font-family'])) { ?>
		font-family:<?php echo $custom['global-text-text']['font-family'];  ?>;
	<?php } ?>

	<?php if(isset($custom['global-text-text']['font-style'])) { ?>
		font-style:<?php echo $custom['global-text-text']['font-style'];  ?>; 
	<?php } ?>
} 
/*For Footer css*/
#footer-wrap {
	<?php if(isset($custom['Footer_bottom_Background_color'])) { ?>
		background:<?php echo $custom['Footer_bottom_Background_color'];  ?>; 
	<?php } ?>
}
/*Global css*/
h1 {
	<?php if(isset($custom['h1-text']['font-size'])) { ?>
		font-size:<?php echo $custom['h1-text']['font-size']; ?>; 
	<?php } ?>

	<?php if(isset($custom['h1-text']['line-height'])) { ?>
		line-height:<?php echo $custom['h1-text']['line-height'];  ?>;
	<?php } ?>

	<?php if(isset($custom['h1-text']['color'])) { ?>
		color:<?php echo $custom['h1-text']['color'];  ?>;
	<?php } ?>

	<?php if(isset($custom['h1-text']['font-family'])) { ?>
		font-family:<?php echo $custom['h1-text']['font-family'];  ?>;
	<?php } ?>	

	<?php if(isset($custom['h1-text']['font-style'])) { ?>
		font-style:<?php echo $custom['h1-text']['font-style'];  ?>;
	<?php } ?>
}
h2 {
	<?php if(isset($custom['h2-text']['font-size'])) { ?>
		font-size:<?php echo $custom['h2-text']['font-size']; ?>; 
	<?php } ?>

	<?php if(isset($custom['h2-text']['line-height'])) { ?>
		line-height:<?php echo $custom['h2-text']['line-height'];  ?>;
	<?php } ?>

	<?php if(isset($custom['h2-text']['color'])) { ?>
		color:<?php echo $custom['h2-text']['color'];  ?>;
	<?php } ?>

	<?php if(isset($custom['h2-text']['font-family'])) { ?>
		font-family:<?php echo $custom['h2-text']['font-family'];  ?>;
	<?php } ?>	

	<?php if(isset($custom['h2-text']['font-style'])) { ?>
		font-style:<?php echo $custom['h2-text']['font-style'];  ?>;
	<?php } ?>
}
h3 {
	<?php if(isset($custom['h3-text']['font-size'])) { ?>
		font-size:<?php echo $custom['h3-text']['font-size']; ?>; 
	<?php } ?>

	<?php if(isset($custom['h3-text']['line-height'])) { ?>
		line-height:<?php echo $custom['h3-text']['line-height'];  ?>;
	<?php } ?>

	<?php if(isset($custom['h3-text']['color'])) { ?>
		color:<?php echo $custom['h3-text']['color'];  ?>;
	<?php } ?>

	<?php if(isset($custom['h3-text']['font-family'])) { ?>
		font-family:<?php echo $custom['h3-text']['font-family'];  ?>;
	<?php } ?>	

	<?php if(isset($custom['h3-text']['font-style'])) { ?>
		font-style:<?php echo $custom['h3-text']['font-style'];  ?>;
	<?php } ?>
}
h4 {
	<?php if(isset($custom['h4-text']['font-size'])) { ?>
		font-size:<?php echo $custom['h4-text']['font-size']; ?>; 
	<?php } ?>

	<?php if(isset($custom['h4-text']['line-height'])) { ?>
		line-height:<?php echo $custom['h4-text']['line-height'];  ?>;
	<?php } ?>

	<?php if(isset($custom['h4-text']['color'])) { ?>
		color:<?php echo $custom['h4-text']['color'];  ?>;
	<?php } ?>

	<?php if(isset($custom['h4-text']['font-family'])) { ?>
		font-family:<?php echo $custom['h4-text']['font-family'];  ?>;
	<?php } ?>	

	<?php if(isset($custom['h4-text']['font-style'])) { ?>
		font-style:<?php echo $custom['h4-text']['font-style'];  ?>;
	<?php } ?>
}
h5 {
	<?php if(isset($custom['h5-text']['font-size'])) { ?>
		font-size:<?php echo $custom['h5-text']['font-size']; ?>; 
	<?php } ?>

	<?php if(isset($custom['h5-text']['line-height'])) { ?>
		line-height:<?php echo $custom['h5-text']['line-height'];  ?>;
	<?php } ?>

	<?php if(isset($custom['h5-text']['color'])) { ?>
		color:<?php echo $custom['h5-text']['color'];  ?>;
	<?php } ?>

	<?php if(isset($custom['h5-text']['font-family'])) { ?>
		font-family:<?php echo $custom['h5-text']['font-family'];  ?>;
	<?php } ?>	

	<?php if(isset($custom['h5-text']['font-style'])) { ?>
		font-style:<?php echo $custom['h5-text']['font-style'];  ?>;
	<?php } ?>
}
h6 {
	<?php if(isset($custom['h6-text']['font-size'])) { ?>
		font-size:<?php echo $custom['h6-text']['font-size']; ?>; 
	<?php } ?>

	<?php if(isset($custom['h6-text']['line-height'])) { ?>
		line-height:<?php echo $custom['h6-text']['line-height'];  ?>;
	<?php } ?>

	<?php if(isset($custom['h6-text']['color'])) { ?>
		color:<?php echo $custom['h6-text']['color'];  ?>;
	<?php } ?>

	<?php if(isset($custom['h6-text']['font-family'])) { ?>
		font-family:<?php echo $custom['h6-text']['font-family'];  ?>;
	<?php } ?>	

	<?php if(isset($custom['h6-text']['font-style'])) { ?>
		font-style:<?php echo $custom['h6-text']['font-style'];  ?>;
	<?php } ?>
}
a {
	<?php if(isset($custom['global-link-text'])) { ?>
		color:<?php echo $custom['global-link-text'];  ?>;
	<?php } ?>	
}
a:hover {
	<?php if(isset($custom['global-link-hover_color'])) { ?>
		color:<?php echo $custom['global-link-hover_color'];  ?>;
	<?php } ?>
}
p, li {
	<?php if(isset($custom['global-text-text']['color'])) { ?>
		color:<?php echo $custom['global-text-text']['color'];  ?>;
	<?php } ?>

	<?php if(isset($custom['global-text-text']['font-size'])) { ?>
		font-size:<?php echo $custom['global-text-text']['font-size']; ?>;
	<?php } ?>

	<?php if(isset($custom['global-text-text']['line-height'])) { ?>
		line-height:<?php echo $custom['global-text-text']['line-height'];  ?>;
	<?php } ?>

	<?php if(isset($custom['global-text-text']['font-family'])) { ?>
		font-family:<?php echo $custom['global-text-text']['font-family'];  ?>;
	<?php } ?>	
	
	<?php if(isset($custom['global-text-text']['font-style'])) { ?>
		font-style:<?php echo $custom['global-text-text']['font-style'];  ?>;
	<?php } ?>	
}
/*.icelandBlock .text h1
{
	<?php if(isset($custom['global-text-text']['font-style'])) { ?>
		color:<?php echo $custom['h1-text']['color'];  ?>;
	<?php } ?>	
}*/
</style>