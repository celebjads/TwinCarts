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

$_id = coolstuff_fnc_makeid();

if($categories == '') return;
$_count = 1;

$ocategory = get_term_by( 'id', $categories, 'product_cat' );
$category_id = '';
if ( !empty($ocategory) && !is_wp_error($ocategory) ) {
	$category_id = $ocategory->term_id;
}
$loop = coolstuff_fnc_woocommerce_query('', $number, array($category_id));

?>

<div class="widget pbr-productcategory owl-controls-hidden widget-products heading__center <?php echo esc_attr($layout_type); ?>  <?php echo (($el_class!='')?' '.$el_class:''); ?>">
	
	<?php if ( $loop->have_posts() ) : ?>
		<?php if ( $layout_type == 'layout1' ) : ?>
			<!-- Image description, grid products -->
			<div class="widget-content columns">
				<div class="row">
					<?php if ($image) { ?>
						<div class="widget-banner effect-v3 col-sm-12 col-md-3 column hidden-xs hidden-sm <?php echo esc_attr($image_align); ?>">
							<?php echo wp_get_attachment_image( $image , 'full'); ?>
						</div>
					<?php } ?>
					<div class="col-md-9 col-sm-12 column">
						<?php if ($title) : ?>
							<div class="text-center <?php echo esc_attr($title_style); ?>">
								<h3 class="widget-title visual-title  <?php echo esc_attr($title_style); ?>">
							      	<span><?php echo esc_attr( $title ); ?></span><?php if( isset($subtitle) && $subtitle ){ ?>
							      	<span class="subtitle"><?php echo esc_html($subtitle); ?></span> <?php } ?>
								</h3>
							</div>
						<?php endif ?>
						<div class="product-items">
							<?php wc_get_template( 'widget-products/carousel.php' , array( 'loop' => $loop, 'columns_count' => $columns_count, 'posts_per_page' => $number ) ); ?>
						</div>
					</div>
				</div>	
			</div>
		<?php elseif ( $layout_type == 'layout2' ) : ?>
			<!-- Left Title, grid products -->
			<div class="widget-content columns">
				<div class="row">
					<?php if ($title) : ?>
						<div class=" col-md-3 col-sm-12 column">
							<div class="widget-product-banner <?php echo esc_attr($title_style); ?>">
								<h3 class="widget-title visual-title">
						      	    <span><?php echo esc_attr( $title ); ?></span><?php if( isset($subtitle) && $subtitle ){ ?>
					      		    <span class="subtitle"><?php echo esc_html($subtitle); ?></span> <?php } ?>
							    </h3>
							</div>
						</div>
					<?php endif ?>
					<div class="col-md-9 col-sm-12 column">
						<div class="products <?php echo 'pbr-'.$image_align;?>">
							<?php wc_get_template( 'widget-products/grid.php' , array( 'loop' => $loop, 'columns_count' => $columns_count, 'posts_per_page' => $number, 'item_style'=> 'style1' ) ); ?>
						</div>
					</div>
				</div>
			</div>
		<?php elseif ( $layout_type == 'layout3' ) : ?>
			<!-- Right Title, special products -->
			<div class="widget-content columns">
				<div class="row">
					<div class="col-md-9 col-sm-12 column">
						<div class="products <?php echo 'pbr-'.$image_align;?>">
							<?php wc_get_template( 'widget-products/carousel-special.php' , array( 'loop' => $loop, 'columns_count' => $columns_count, 'posts_per_page' => $number, 'main_product_class' => 'pull-left' ) ); ?>
						</div>
					</div>
					<?php if ($title) : ?>
						<div class="col-md-3 col-sm-12 column">
							<div class="widget-product-banner  <?php echo esc_attr($title_style); ?>">
								<h3 class="widget-title visual-title">
							      	<span><?php echo esc_attr( $title ); ?></span><?php if( isset($subtitle) && $subtitle ){ ?>
						      		<span class="subtitle"><?php echo esc_html($subtitle); ?></span> <?php } ?>
								</h3>
							</div>						
						</div>
					<?php endif ?>
				</div>	
			</div>
		<?php elseif ( $layout_type == 'layout4' ) : ?>
			<!-- Right Title, special products -->
			<div class="widget-content columns">
				<div class="row">
					<?php if ($title) : ?>
						<div class=" col-md-3 col-sm-12 column">
							<div class="widget-product-banner <?php echo esc_attr($title_style); ?>">
								<h3 class="widget-title visual-title">
							      	<span><?php echo esc_attr( $title ); ?></span><?php if( isset($subtitle) && $subtitle ){ ?>
						      		<span class="subtitle"><?php echo esc_html($subtitle); ?></span> <?php } ?>
								</h3>
							</div>						
						</div>
					<?php endif ?>
					<div class="col-md-9 col-sm-12 column">
						<div class="products <?php echo 'pbr-'.$image_align;?>">
							<?php wc_get_template( 'widget-products/carousel-special.php' , array( 'loop' => $loop, 'columns_count' => $columns_count, 'posts_per_page' => $number, 'main_product_class' => 'pull-right' ) ); ?>
						</div>
					</div>
				</div>	
			</div>
		<?php endif; ?>

	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
</div>
