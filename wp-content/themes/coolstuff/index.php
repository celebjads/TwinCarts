<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WpOpal
 * @subpackage Coolstuff
 * @since Coolstuff 1.0
 */

get_header( apply_filters( 'coolstuff_fnc_get_header_layout', null ) ); ?>
<?php do_action( 'coolstuff_template_main_before' ); ?>
<section id="main-container" class="<?php echo apply_filters('coolstuff_template_main_container_class','container') ?> page-index inner"> 
	<div class="row">
		<div id="main-content" class="main-content col-lg-9 col-sm-9 col-md-9 col-xs-12 main-index">
			
			<div id="primary" class="content-area">
				<div id="content" class="site-content" role="main">
					<?php
						if ( have_posts() ) :
							// Start the Loop.
							while ( have_posts() ) : the_post();

								/*
								 * Include the post format-specific template for the content. If you want to
								 * use this in a child theme, then include a file called called content-___.php
								 * (where ___ is the post format) and that will be used instead.
								 */
								get_template_part( 'content', get_post_format() );
								 echo '<div class="clearfix"></div>';
							endwhile;
							// Previous/next post navigation.
							coolstuff_fnc_paging_nav();

						else :
							// If no content, include the "No posts found" template.
							get_template_part( 'content', 'none' );

						endif;
					?>

				</div><!-- #content -->
			</div><!-- #primary -->

		</div><!-- #main-content -->

		<div class="sidebar wpo-sidebar col-lg-3 col-xs-12">
			<?php dynamic_sidebar('sidebar-default'); ?>
		</div>	
	</div>	
</section>
<?php

get_footer();
