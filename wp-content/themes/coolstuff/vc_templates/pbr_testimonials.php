<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOpal  Team <help@wpopal.com, info@wpopal.com?>
 * @copyright  Copyright (C) 2015 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/questions/
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );


extract( $atts );

$_id = coolstuff_fnc_makeid();
$_count = 0;
$args = array(
	'post_type' => 'testimonial',
	'posts_per_page' => '10',
	'post_status' => 'publish',
);

$query = new WP_Query($args);
?>

<div class="widget-nostyle pbr-testimonial testimonials testimonials-<?php echo esc_attr($skin).' '.esc_attr($el_class); ?>">
	<?php if($query->have_posts()){ ?>
		<?php if($title!=''){ ?>
			<h3 class="widget-title">
				<span><?php echo trim($title); ?></span>
			</h3>
		<?php } ?>
 
			<!-- Skin 1 -->
			<div id="carousel-<?php echo esc_attr($_id); ?>" class="widget-content owl-carousel-play" data-ride="owlcarousel">
					<div class="owl-carousel " data-slide="<?php echo esc_attr($number); ?>" data-pagination="true" data-navigation="true" data-desktop="[1199,2]" data-desktopsmall="[980,1]" data-tablet="[768,1]">
					<?php  $_count=0; while($query->have_posts()):$query->the_post(); ?>
						<!-- Wrapper for slides -->
						<div class="item">
							<?php  get_template_part( 'vc_templates/testimonials/testimonials', $skin ); ?>
						</div>
						<?php $_count++; ?>
					<?php endwhile; ?>
				</div>
				<?php if( $number  < $_count) { ?>
				<div class="carousel-controls carousel-controls-v3 carousel-hidden">
					<a class="left carousel-control carousel-md" href="#carousel-<?php the_ID(); ?>" data-slide="prev">
							<span class="fa fa-angle-left"></span>
					</a>
					<a class="right carousel-control carousel-md" href="#carousel-<?php the_ID(); ?>" data-slide="next">
							<span class="fa fa-angle-right"></span>
					</a>
				</div>
				<?php } ?>
			</div>
	<?php } ?>
</div>
<?php wp_reset_postdata(); ?>