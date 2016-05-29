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

if (isset($categories) && !empty($categories)):
    $categories = array_map('trim', explode(',', $categories));
    $i = 0;
    $scolumn = $columns > 0 ? 12/$columns : 3;
?>
    <div class="widget widget-products widget-categoriestabs">
        <ul role="tablist" class="nav nav-tabs">
            <?php foreach ($categories as $category_id) : ?>
                <?php $category = get_term( $category_id, 'product_cat' ); ?>
                <li<?php echo ($i == 0 ? ' class="active"' : ''); ?>>
                    <a href="#tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($category_id); ?>" data-toggle="tab"><?php echo trim($category->name); ?></a>
                </li>
            <?php $i++; endforeach; ?>
        </ul>
        <div class="widget-content widget-inner">
            <?php if( !empty($image_cat) ) : ?>
                <?php $img = wp_get_attachment_image_src($image_cat,'full'); ?>
                <div class="col-lg-3 hidden-md hidden-sm hidden-xs <?php echo esc_attr( $image_float );?>">
                    <img src="<?php echo esc_url_raw($img[0]); ?>" title="<?php echo esc_attr($ocategory->name); ?>" alt="">
                </div>
            <?php endif; ?>
            <div class="<?php echo !empty($image_cat) ? 'col-lg-9 col-xs-12' : 'col-xs-12'; ?>">
                <div class="tab-content">
                    <?php if ($layout_type == 'carousel'): ?>
                        <?php $i = 0; foreach ($categories as $category_id) : ?>
                            <div id="tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($category_id); ?>" class="tab-pane <?php echo ($i == 0 ? 'active' : ''); ?>">
                                <?php
                                    $_count = 0;
                                    $loop = coolstuff_fnc_woocommerce_query( $sortby, $per_page , array($category_id) );
                                ?>
                                    
                                <div id="carousel-<?php echo esc_attr($_id); ?>" class="widget-content text-center owl-carousel-play" data-ride="owlcarousel">
                                    <div class="owl-carousel " data-slide="<?php echo esc_attr($columns); ?>" data-pagination="false" data-navigation="true">
                                        <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                                            <?php wc_get_template_part( 'content', 'product-inner' ); ?>
                                        <?php  $_count++ ; endwhile; ?>
                                        <?php wp_reset_postdata(); ?>
                                    </div>
                                    <?php if( $columns  < $_count) { ?>
                                        <a class="left carousel-control carousel-xs radius-x" href="#" data-slide="prev">
                                            <span class="fa fa-angle-left"></span>
                                        </a>
                                        <a class="right carousel-control carousel-xs radius-x" href="#" data-slide="next">
                                            <span class="fa fa-angle-right"></span>
                                        </a>
                                    <?php } ?>
                                </div>  
                                    
                            </div>
                        <?php $i++; endforeach; ?>
                    <?php else: ?>
                        <?php $i = 0; foreach ($categories as $category_id) : ?>
                            <div id="tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($category_id); ?>" class="tab-pane <?php echo ($i == 0 ? 'active' : ''); ?>">
                                <?php
                                    $_count = 0;
                                    $loop = coolstuff_fnc_woocommerce_query( $sortby, $per_page , array($category_id) );
                                ?>
                                <div class="row">
                                    <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                                        <div class="col-sm-<?php echo esc_attr($scolumn); ?>">
                                            <?php wc_get_template_part( 'content', 'product-inner' ); ?>
                                        </div>
                                    <?php  $_count++ ; endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                                </div>
                            </div>
                        <?php $i++; endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>