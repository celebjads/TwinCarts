<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WPOPAL
 * @subpackage coolstuff
 * @since Cool Stuff 1.0
 */
$footer_profile =  apply_filters( 'coolstuff_fnc_get_footer_profile', 'default' );
$footer =  get_post($footer_profile);
if($footer_profile){
	$footer 		= get_post($footer_profile);
	$class_footer 	= isset($footer->post_name)?$footer->post_name:'default';
}else{
	$class_footer = 'default';
}  
?>

		</section><!-- #main -->
		<?php do_action( 'coolstuff_template_main_after' ); ?>
		<?php do_action( 'coolstuff_template_footer_before' ); ?>		
		<footer id="pbr-footer" class="pbr-footer footer-<?php echo esc_attr($class_footer);?>" role="contentinfo">
			<?php if( $footer_profile && $footer_profile != 'default' ) : ?>
			<div class="inner">
				<div class="pbr-footer-profile">
					<?php coolstuff_fnc_render_post_content( $footer_profile ); ?>
				</div>
			</div>
			<?php else: ?>
			<div class="inner footer-default">
				<?php get_sidebar( 'footer' ); ?>
			</div>
			<?php endif; ?>				
				<?php get_sidebar( 'mass-footer-body' );  ?>	
		</footer><!-- #colophon -->		

		<?php do_action( 'coolstuff_template_footer_after' ); ?>
		<?php get_sidebar( 'offcanvas' );  ?>
	</div>
</div>
	<!-- #page -->

<?php wp_footer(); ?>
</body>
</html>