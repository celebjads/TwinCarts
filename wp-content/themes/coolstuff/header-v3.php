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
	
	<header class="site-header header_v3 hidden-xs hidden-sm" role="banner">
		<div class="container">
			<div class="header-main text-center">
				<div class="logo-wrapper">
		 			<?php get_template_part( 'page-templates/parts/logo' ); ?>
				</div>
				<div class="header-setting">
					<div class="btn-group btn-group-toggle" role="group" aria-label="">
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-toggle btn-account dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">															
								<span>									
									<?php esc_html_e( 'Dropdown', 'coolstuff' ); ?>
								</span>
							</button>

							<?php if(has_nav_menu( 'topmenu' )): ?>
							    <nav class="pbr-topmenu-v2 dropdown-menu" role="navigation">
							        <?php
							            $args = array(
							                'theme_location'  => 'topmenu',
							                'menu_class'      => 'pbr-menu-top list-inline list-square',
							                'fallback_cb'     => '',
							                'menu_id'         => 'main-topmenu'
							            );
							            wp_nav_menu($args);
							        ?>
							    </nav>
							<?php endif; ?>  
						</div>
					</div>					
				</div>
			</div>											
		</div>	
		<div class="header-second">
			<div class="container">
				<section id="pbr-mainmenu" class="pbr-mainmenu mainmenu_v3">		
					<div class="pbr-mainmenu-inner">
						<div class="inner navbar-mega-simple"><?php get_template_part( 'page-templates/parts/nav' ); ?></div>
					</div>					
				</section>

				<section class="pbr-action">
					<div class="search-box-wrapper search-v3">								
				        <?php get_search_form() ?>								
					</div>							
					<?php do_action( 'coolstuff_template_header_right' ); ?>
				</section>			
			</div>			
		</div>	
	</header><!-- #masthead -->
	<?php do_action( 'coolstuff_template_header_before' ); ?>
	<?php do_action( 'coolstuff_template_header_after' ); ?>	
	<section id="main" class="site-main">