<?php
/**
 * Displays header site branding
 *
 * @package WordPress
 * @subpackage deep_free
 * @since 1.0.0
 */
?>
<div class="site-branding">
	<div class="site-logo col-md-4">
		<?php if ( has_custom_logo() ) : ?>
			<?php the_custom_logo(); ?>
		<?php endif; ?>
		<?php $blog_info = get_bloginfo( 'name' ); ?>		
		<?php if (( ! empty( $blog_info ) )) : ?>
			<div class="siteinfowrap">
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif; ?>
				<?php
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo wp_kses_post( $description ); ?></p>
					<?php
				endif;
				?>
			</div>
		<?php endif; ?>
	</div>

	<?php if ( has_nav_menu( 'primary' ) ) : ?>
		<div class='primary-menu'>
			<nav role="navigation" id="site-navigation" class="col-md-8 main-navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'deep-free' ); ?>">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'deep-free' ); ?></h1>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_class'     => 'main-menu',
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					)
				);
				?>
			</nav>
		</div>
	<?php endif; ?>
</div>
