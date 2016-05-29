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
	
	<header class="site-header header_v6" role="banner">
		<?php do_action( 'coolstuff_template_header_before' ); ?>
		<div class="container hidden-xs hidden-sm">
			<section class="pbr-action clearfix">
				<div class="search-box-wrapper pull-left">								
			        <?php get_search_form() ?>								
				</div>							
				<div class="pull-right">
					<?php do_action( 'coolstuff_template_header_right' ); ?>					
				</div>				
			</section>
			<div class="logo-wrapper text-center">
	 			<?php get_template_part( 'page-templates/parts/logo' ); ?>
			</div>
			<section id="pbr-mainmenu" class="pbr-mainmenu mainmenu_v5">		
				<div class="pbr-mainmenu-inner">
					<div class="inner navbar-mega-simple"><?php get_template_part( 'page-templates/parts/nav' ); ?></div>
				</div>					
			</section>	
		</div>		
	</header><!-- #masthead -->
	<?php do_action( 'coolstuff_template_header_after' ); ?>	
	<section id="main" class="site-main">