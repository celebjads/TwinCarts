<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WPOPAL
 * @subpackage coolstuff
 * @since Cool Stuff 1.0
 */

$coolstuff_page_layouts = apply_filters( 'coolstuff_fnc_get_woocommerce_sidebar_configs', null );

get_header( apply_filters( 'coolstuff_fnc_get_header_layout', null ) ); ?>

<?php do_action( 'coolstuff_woo_template_main_before' ); ?>

<section id="main-container" class="<?php echo apply_filters('coolstuff_template_woocommerce_main_container_class','container');?>">
	
	<div class="row">
		
		<?php if( isset($coolstuff_page_layouts['sidebars']) && !empty($coolstuff_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>

		<div id="main-content" class="main-content col-xs-12 <?php echo esc_attr($coolstuff_page_layouts['main']['class']); ?>">

	 
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">

					 <?php  woocommerce_content(); ?>

				</div><!-- #content -->
			</div><!-- #primary -->


			<?php    get_sidebar( 'content' ); ?>
		</div><!-- #main-content -->

	</div>	
</section>
<?php

get_footer();
