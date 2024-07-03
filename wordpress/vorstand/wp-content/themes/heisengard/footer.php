<?php global $custom; ?>

	</div>
        <!-- finish content -->

        <!-- begin footer -->
        <div id="footer-wrap">

            <!-- begin copy block -->
            <div class="footer-block">
                    
                <?php if ( is_active_sidebar( 'footer-sidebar-1' ) || is_active_sidebar( 'footer-sidebar-2') || is_active_sidebar( 'footer-sidebar-3' ) ) : ?>
                <?php
                    $active_footer_siderbar = 0;
                    if( is_active_sidebar( 'footer-sidebar-1' ) ) {
                        $active_footer_siderbar++;
                    }
                    if( is_active_sidebar( 'footer-sidebar-2' ) ) {
                        $active_footer_siderbar++;
                    }
                    if( is_active_sidebar( 'footer-sidebar-3' ) ) {
                        $active_footer_siderbar++;
                    }
                    $footer_col_class = 'six';
                    if( $active_footer_siderbar == 2 ) {
                        $footer_col_class = 'six';
                    } elseif( $active_footer_siderbar == 3 ) {
                        $footer_col_class = 'four';
                    }
                ?>
                <div class="footer-widgets centering centerBox">
                    <aside class="widget-area" role="complementary">
                        <?php
                        if ( is_active_sidebar( 'footer-sidebar-1' ) ) { ?>
                                <div class="widget-column footer-widget-1 one-column <?php echo $footer_col_class ?>">
                                        <?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
                                </div>
                        <?php }
                        if ( is_active_sidebar( 'footer-sidebar-2' ) ) { ?>
                                <div class="widget-column footer-widget-2 one-column <?php echo $footer_col_class ?>">
                                        <?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
                                </div>
                        <?php }
                        if ( is_active_sidebar( 'footer-sidebar-3' ) ) { ?>
                                <div class="widget-column footer-widget-2 one-column <?php echo $footer_col_class ?>">
                                        <?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
                                </div>
                        <?php } ?>
                    </aside><!-- .widget-area -->
                </div>
                <?php endif; ?>

                <div class="centerBox">
                    <ul class="social-icon">
                        <?php
                            $instagram_link = $custom[ 'instagram_link' ];
                            $linkedin_link = $custom[ 'linkedin_link' ];
                            $pinterest_link = $custom[ 'pinterest_link' ];
                            $snapchat_link = $custom[ 'snapchat_link' ];
                            $stumbleupon_link = $custom[ 'stumbleupon_link' ];
                            $tumblr_link = $custom[ 'tumblr_link' ];
                            $vimeo_link = $custom[ 'vimeo_link' ];
                            $whatsapp_link = $custom[ 'whatsapp_link' ];
                            $youtube_link = $custom[ 'youtube_link' ];
                        ?>
                        <?php if($custom['facebook_link']){ ?>
                        <li><a href="<?php echo $custom['facebook_link']; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <?php } ?>
                        <?php if($custom['google']){ ?>
                        <li><a href="<?php echo $custom['google']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                        <?php } ?>
                        <?php if($custom['twitter_link']){ ?>
                        <li><a href="<?php echo $custom['twitter_link']; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <?php } ?>
                        <?php if ($instagram_link) : ?>
                        <li>
                            <a href="<?php echo $instagram_link; ?>" target="_blank" >
                                <i class="fa fa-instagram"> </i>
                            </a>
                        </li>
                        <?php endif ?>
                        <?php if ($linkedin_link) : ?>
                        <li>
                            <a href="<?php echo $linkedin_link; ?>" target="_blank" >
                                <i class="fa fa-linkedin"> </i>
                            </a>
                        </li>
                        <?php endif ?>
                        <?php if ($pinterest_link) : ?>
                        <li>
                            <a href="<?php echo $pinterest_link; ?>" target="_blank" >
                                <i class="fa fa-pinterest"> </i>
                            </a>
                        </li>
                        <?php endif ?>
                        <?php if ($snapchat_link) : ?>
                        <li>
                            <a href="<?php echo $snapchat_link; ?>" target="_blank" >
                                <i class="fa fa-snapchat"> </i>
                            </a>
                        </li>
                        <?php endif ?>
                        <?php if ($stumbleupon_link) : ?>
                        <li>
                            <a href="<?php echo $stumbleupon_link; ?>" target="_blank" >
                                <i class="fa fa-stumbleupon"> </i>
                            </a>
                        </li>
                        <?php endif ?>
                        <?php if ($tumblr_link) : ?>
                        <li>
                            <a href="<?php echo $tumblr_link; ?>" target="_blank" >
                                <i class="fa fa-tumblr"> </i>
                            </a>
                        </li>
                        <?php endif ?>
                        <?php if ($vimeo_link) : ?>
                        <li>
                            <a href="<?php echo $vimeo_link; ?>" target="_blank" >
                                <i class="fa fa-vimeo"> </i>
                            </a>
                        </li>
                        <?php endif ?>
                        <?php if ($whatsapp_link) : ?>
                        <li>
                            <a href="<?php echo $whatsapp_link; ?>" target="_blank" >
                                <i class="fa fa-whatsapp"> </i>
                            </a>
                        </li>
                        <?php endif ?>
                        <?php if ($youtube_link) : ?>
                        <li>
                            <a href="<?php echo $youtube_link; ?>" target="_blank" >
                                <i class="fa fa-youtube"> </i>
                            </a>
                        </li>
                        <?php endif ?>
                    </ul>
                </div>
            </div>
            <!-- finish copy block -->

		</div>
		<!-- finish footer -->
		
	</div>
	<!-- finish page wrap -->
	
</div>
<!-- finish section -->

<div id="sticky_menu_wrapper" class="mobile-only">
	<div class="sticky_menu_header">
		<div class="sticky_menu_logo">
			<?php $logo = $custom['logo_icon']['url']; ?>
			<?php if($logo){?>
				<a href ="<?php echo home_url(); ?>">
					<img alt="<?php echo get_bloginfo( 'name' ); ?>" src="<?php echo $custom['logo_icon']['url']; ?>" />
				</a>
			<?php } else { ?>
				<a href="<?php echo home_url() ?>"><?php bloginfo( 'name' );?></a>
			<?php }?>
		</div>
	</div>
	<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary_heisengard',
				'menu_id' => 'sticky_menu',
				'container' => '',
			)
		);
	?>
	<div class="sticky_menu_collapse">
		<i></i>
	</div>
</div>
<?php wp_footer(); ?>

</body>
</html>