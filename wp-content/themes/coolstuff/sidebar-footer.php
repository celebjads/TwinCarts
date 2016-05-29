<?php
/**
 * The Footer Sidebar
 *
 * @package WPOPAL
 * @subpackage coolstuff
 * @since Cool Stuff 1.0
 */

?>

<div class="container">
	<section class="footer-top">
		<div class="row">
			<div class="col-lg-9 col-md-9 col-xs-12">			
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<div class="inner wow fadeInUp" data-wow-duration='0.8s' data-wow-delay="200ms" >
						<?php dynamic_sidebar('footer-1'); ?>
					</div>
				<?php endif; ?>	
				<section class="pbr-copyright">
					<div class="site-info">
					<?php do_action( 'coolstuff_fnc_credits' ); ?>
					<?php 
						$copyright_text =  coolstuff_fnc_theme_options('copyright_text', '');
						if(!empty($copyright_text)){
							echo do_shortcode($copyright_text);
						}else{
							$devby = '<a target="_blank" href="http://wpopal.com" title="WpOpal Team">WpOpal Team</a>';
							$wordpress = '<a target="_blank" href="https://wordpress.org/" title="WordPress">WordPress</a>';
							printf( wp_kses_post( __( 'Proudly powered by %s. <br/>Developed by %s', 'coolstuff' ) ), $wordpress, $devby );   
						}
					?>
					</div>
					<!-- .site-info -->
				<section>						
			</div>
					
			
			<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
				<div class="col-lg-3 col-md-3 col-xs-12">
					<div class="inner wow fadeInUp" data-wow-duration='0.8s' data-wow-delay="400ms" >
						<?php dynamic_sidebar('footer-2'); ?>
					</div>
				</div>		
			<?php endif; ?>				
		</div>
	</section>
</div>

