<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$images = coolstuff_fnc_get_instagrams($username, $number);
?>
<section class="widget widget_instagram heading__center frontpage-posts section-blog widget-style <?php echo (($el_class!='')?' '.$el_class:''); ?>">
    <?php if ( !empty($title) ) : ?>
        <h3 class="widget-title">
            <span><?php echo trim($title); ?></span>
        </h3>
    <?php endif; ?>
    <div class="widget-content">
		<?php if ( !empty($images) && count($images) > 1 ): ?>
			<ul class="image-list list-unstyled list_instagram clearfix">
				<?php foreach ($images as $image) : ?>
					<li>
						<a href="<?php echo esc_url($image['link']); ?>" title="<?php echo esc_attr($image['description']); ?>" target="<?php echo esc_attr( $target ); ?>">
							<img src="<?php echo esc_url_raw( $image[$size] );?>" alt="<?php echo esc_attr($image['description']); ?>">
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php if ( !empty($follow_text) ) : ?>
				<p class="clear text-center"><a href="//instagram.com/<?php echo esc_attr( trim( $username ) ); ?>" class="btn btn-primary" rel="me" target="<?php echo esc_attr( $target ); ?>"><?php echo trim( $follow_text ); ?></a></p>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</section>