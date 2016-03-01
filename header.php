<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package skyhigh
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!--<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'skyhigh' ); ?></a>-->	

	<header id="masthead" class="site-header container" role="banner">
	
	
		<div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php bloginfo('url'); ?>/wp-content/themes/skyhigh/images/logo.png" alt="<?php bloginfo( 'name' ); ?>"></a></a>
				</h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php bloginfo('url'); ?>/wp-content/themes/skyhigh/images/logo.png" alt="<?php bloginfo( 'name' ); ?>"></a></p>
			<?php
			endif;
			?>
			
			
		</div><!-- .site-branding -->

		
	</header><!-- #masthead -->
	
	<nav id="site-navigation" class="nav-main" role="navigation">	
		<div class="container">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</div>
	</nav><!-- #site-navigation -->

	
