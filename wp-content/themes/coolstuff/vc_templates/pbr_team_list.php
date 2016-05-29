<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


?>
<div class="pbr-our-team-list">
	<?php $img = wp_get_attachment_image_src($photo,'full'); ?>
	<?php if( isset($img[0]) )  { ?>
	<p class="pbr-our-team-avata">
		<img class="img-responsive" src="<?php echo esc_attr($img[0]);?>" alt="<?php echo esc_attr($title); ?>"  />
	</p>
		<?php } ?>
	<div class="pbr-our-team-list">
		<h3 class="team__name"><?php echo esc_html($title); ?></h3>
		<p class="team__job"><?php echo esc_html($job); ?></p>
		<div class="team-info">
			<?php echo trim($content); ?>
		</div>
		<ul class="list-inline">
			<?php if( $facebook ){  ?>
			<li><a class="fa fa-facebook" href="<?php echo esc_url($facebook); ?>"> </a></li>
				<?php } ?>
			<?php if( $twitter ){  ?>
			<li><a class="fa fa-twitter" href="<?php echo esc_url($twitter); ?>"> </a></li>
			<?php } ?>
			<?php if( $linkedin ){  ?>
			<li><a class="fa fa-linkedin" href="<?php echo esc_url($linkedin); ?>"> </a></li>
			<?php } ?>
		</ul>
	</div>
</div>