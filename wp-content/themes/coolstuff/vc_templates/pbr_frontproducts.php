<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOPAL Team <help@wpopal.com, info@wpopal.com?>
 * @copyright  Copyright (C) 2015 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/questions/
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


$scolumn = ceil(12/$columns_count);
if ($type == '') return;


global $woocommerce;

$_id = coolstuff_fnc_makeid();
$_count = 1;

if (isset($categories) && !empty($categories))
    $categories = array_map('trim', explode(',', $categories));
else
	$categories = '';
$loop = coolstuff_fnc_woocommerce_query($type, $number, $categories);

echo "<div class='widget widget-products widget-carousel widget-products-bg products".((!empty($el_class))?" ".$el_class:'')."'>";

if ($title!=''): ?>
	<h3 class="widget-title visual-title">
      <span><?php echo esc_attr( $title ); ?></span> <?php if( isset($subtitle) && $subtitle ){ ?><span class="subtitle"><?php echo esc_html($subtitle); ?></span> <?php } ?>
	</h3>
<?php endif; ?>

<?php if ( $loop->have_posts() ) : ?>
	<div class="widget-content">
		<?php if (!empty($image)): ?>
			<?php $img = wp_get_attachment_image_src($image,'full'); ?>
			<div class="row">
				<div class="col-sm-12 col-md-6 text-center <?php echo esc_attr($image_align); ?>">
					<?php if ( isset($img[0]) ): ?>
						<?php if (!empty($image_url)): ?>
							<a href="<?php echo esc_url($image_url); ?>">
						<?php endif; ?>
						<img src="<?php echo esc_url_raw($img[0]);?>" class="image-icon" alt="">
						<?php if (!empty($image_url)): ?>
							</a>
						<?php endif; ?>
					<?php endif; ?>
				</div>
				<div class="col-sm-12 col-md-6">
		<?php endif; ?>

			<div class="row">
				<?php
				    $i = 0;
				    $end = $loop->post_count;
				    $main = $num_mainpost;

				    while($loop->have_posts()) {
				        $loop->the_post();
				        if ( $main == 0): ?>
				        	<div class=" col-sm-<?php echo esc_attr($scolumn); ?> col-xs-12">
		                        <?php wc_get_template_part( 'content', 'frontproducts' ); ?>
		                    </div>
					    <?php else: ?>
					        <?php if( $i <= $main-1) : ?>
					            <?php if( $i == 0 ) :  ?>
					                <div  class="col-sm-12 col-md-6 main-products large">
					            <?php endif; ?>
						            
						            <div class="products-grid product">
						            	<?php wc_get_template_part( 'content', 'frontproducts' ); ?>
				                    </div>

					            <?php if( $i == $main-1 || $i == $end -1 ) : ?>
					                </div>
					            <?php endif; ?>

					        <?php else : ?>
					                <?php if( $i == $main  ) : ?>
					                <div class="col-sm-12 col-md-6 secondary-products space-20">
					                	<div class="row">
					                <?php endif; ?>
					                    
					                    <div class=" col-sm-<?php echo esc_attr($scolumn); ?>">
					                        <?php wc_get_template_part( 'content', 'frontproducts' ); ?>
					                    </div>

					                <?php if( $i == $end-1 ) :   ?>
					                	</div>
				                    </div>
					                <?php endif; ?>
				            <?php endif; ?>
			            <?php endif; ?>
				<?php  $i++; } ?>
			</div>

		<?php if (!empty($image)): ?>
				</div>
			</div>
		<?php endif; ?>



	</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php echo "</div>" ?>
