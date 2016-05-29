<?php
/**
 * The Header for our theme: Top has Logo left + search right . Below is horizal main menu
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WpOpal
 * @subpackage Presta_Base
 * @since PrestaBase 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site"><div class="pbr-page-inner row-offcanvas row-offcanvas-left">		
	<header class="site-header header-absolute hidden-xs hidden-sm" role="banner">
		<div class="container">
			<div class="header-main">
				<div class="logo-wrapper">
		 			<?php get_template_part( 'page-templates/parts/logo' ); ?>
				</div>
			</div>
			<section id="pbr-mainmenu" class="pbr-mainmenu mainmenu_v2">		
				<div class="pbr-mainmenu-inner">
					<div class="inner navbar-mega-simple"><?php get_template_part( 'page-templates/parts/nav' ); ?></div>
				</div>				
				<div class="pbr-header-right">
					<div class="header-inner">							
						<div class="search-box-wrapper search-toggle">        
			        <a href="#" class="cd-search-trigger"><?php esc_html_e( 'Search', 'coolstuff' ); ?><span></span></a>  
			          <div class="search-toggle-dropdown">
			            <?php get_search_form() ?>                              
			          </div>                              
			    	</div>  
					</div>
				</div>
			</section>				
			<?php do_action( 'coolstuff_template_header_right' ); ?>						
		</div>	
	</header><!-- #masthead -->

	<?php do_action( 'coolstuff_template_header_before' ); ?>

	<?php do_action( 'coolstuff_template_header_after' ); ?>
	
	<section id="main" class="site-main">
