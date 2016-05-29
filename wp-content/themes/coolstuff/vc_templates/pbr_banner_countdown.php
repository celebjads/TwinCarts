<?php 

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>

<div class="clearfix">	
	<div class="banner-countdown-widget pull-left">
		<?php if( isset($content) && $content ) : ?>
				<?php echo trim($content); ?>
			<?php endif; ?>	
	</div>
	<?php if( $image ): ?>
		<?php $img = wp_get_attachment_image_src( $image,'full' ); ?>
		 <div class="category-image pull-right">
		    <img src="<?php echo esc_url_raw( $img[0] ); ?>" title="" alt="">
		</div>
	<?php endif; ?>
</div>

