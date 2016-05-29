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
    global $woocommerce_loop; 
 
    add_action( 'woocommerce_before_shop_loop_item_title', 'coolstuff_woocommerce_fnc_before_shop_loop_item_title');
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );


    $woocommerce_loop['columns'] = $columns_count ;
    $deals = array();

    $loop = coolstuff_fnc_woocommerce_query('on_sale', $number);
    $wp_query = $loop;

    $_id = coolstuff_fnc_makeid();
 
    $_total =  $loop->found_posts;  

    $layout= 'product';


    if( $loop->have_posts()  ) { ?>
        <div class="woocommerce products woo-onsale"> 


    <div id="pbr-filter" class="clearfix products-top-wrap">
        <?php
            coolstuff_fnc_woocommerce_display_modes();
        ?>
        <?php
            /**
             * woocommerce_before_shop_loop hook
             *
             * @hooked woocommerce_result_count - 20
             * @hooked woocommerce_catalog_ordering - 30
             */
             //woocommerce_show_messages();
          woocommerce_catalog_ordering();
        ?>
    </div>
        <div class="products-list row-products row">
            <?php     while ( $loop->have_posts() ) :   $loop->the_post();  global $product;
                $time_sale = get_post_meta( $product->id, '_sale_price_dates_to', true );
            ?>
            <?php
                wc_get_template_part( 'content', 'product' );
            ?>
            <?php
                endwhile; 
            ?>
        </div>
        <div class="clearfix"></div>
        <div class="widget clearfix product-bottom">
        	<?php echo coolstuff_fnc_pagination_nav( $number, $_total ); ?>
        </div>
        <?php wp_reset_postdata(); ?>
          

    </div>
 
    <?php } ?>
