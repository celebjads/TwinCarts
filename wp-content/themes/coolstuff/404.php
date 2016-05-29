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
/*
*Template Name: 404 Page
*/

get_header( apply_filters( 'coolstuff_fnc_get_header_layout', null ) ); ?>

<section id="main-container" class="inner clearfix notfound-page">
	<div class="container">
		<div class="row">
			<div id="main-content" class="main-content col-lg-12 text-center">
				<div id="primary" class="content-area">
					 <div id="content" class="site-content" role="main">
						<div class="title">
							<span class="big-title">404</span>
							<span class="sub-title"><?php esc_html_e( 'Oops ! That page cant\'t be found.', 'coolstuff' ); ?></span>
						</div>
						<div class="error-description">
							<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try to search?', 'coolstuff' ); ?></p>
						</div><!-- .page-content -->
						<?php get_search_form() ?>
					</div><!-- #content -->
				</div><!-- #primary -->
			</div><!-- #main-content -->
		</div>
	</div>		
</section>
<?php

get_footer();

 