<?php
/**
 * The Template for displaying all single posts
 *
 * @package WPOPAL
 * @subpackage coolstuff
 * @since Cool Stuff 1.0
 */

$coolstuff_page_layouts = apply_filters( 'coolstuff_fnc_get_single_sidebar_configs', null );

get_header( apply_filters( 'coolstuff_fnc_get_header_layout', null ) );

?>
<?php do_action( 'coolstuff_template_main_before' ); ?>
<section id="main-container" class="container <?php echo apply_filters( 'coolstuff_template_main_content_class', coolstuff_fnc_theme_options('blog-single-layout') ); ?>">
	<div class="row">
		<?php if( isset($coolstuff_page_layouts['sidebars']) && !empty($coolstuff_page_layouts['sidebars']) ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>
		<div id="main-content" class="main-content col-sm-12 <?php echo esc_attr($coolstuff_page_layouts['main']['class']); ?>">

			<div id="primary" class="content-area">
				<div id="content" class="site-content single_blog" role="main">
					<?php
						// Start the Loop.
						while ( have_posts() ) : the_post();

							/*
							 * Include the post format-specific template for the content. If you want to
							 * use this in a child theme, then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part( 'content', get_post_format() );

							if( coolstuff_fnc_theme_options('blog-show-share-post', true) ){
								get_template_part( 'page-templates/parts/sharebox' );
							}

							// Previous/next post navigation.
							coolstuff_fnc_post_nav();

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}

							if( coolstuff_fnc_theme_options('blog-show-related-post', true) ): ?>
							<div class="related-posts">
								<?php
				                    $relate_count = coolstuff_fnc_theme_options('blog-items-show', 3);
				                    coolstuff_fnc_related_post($relate_count, 'post', 'category');
			                    ?>
			                <?php endif; ?>
			                </div>
			                <?php

						endwhile;
					?>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div>	

	</div>	
</section>
<?php
get_footer();
