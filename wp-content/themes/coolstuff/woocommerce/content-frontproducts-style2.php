<?php 
global $product;
$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($product->id ), 'blog-thumbnails' );

?>
<div class="product-block product-block-v3" data-product-id="<?php echo esc_attr($product->id); ?>">
    <figure class="image">
        <?php woocommerce_show_product_loop_sale_flash(); ?>
        <a title="<?php the_title(); ?>" href="<?php echo (get_option( 'woocommerce_enable_lightbox' )=='yes' && is_product()) ? $image_attributes[0] : the_permalink(); ?>" class="product-image <?php echo (get_option( 'woocommerce_enable_lightbox' )=='yes' &&  is_product())?'zoom':'zoom-2' ;?>">
            <?php
                /**
                * woocommerce_before_shop_loop_item_title hook
                *
                * @hooked woocommerce_show_product_loop_sale_flash - 10
                * @hooked woocommerce_template_loop_product_thumbnail - 10
                */
                remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash', 10);
                do_action( 'woocommerce_before_shop_loop_item_title' );
            ?>
        </a> 
        <div class="button-action button-groups clearfix">
        <div class="action-bottom">
            <div class="action-bottom-wrap">
                <div class="button-groups add-button clearfix">
                    <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                    <?php
                        $action_add = 'yith-woocompare-add-product';
                        $url_args = array(
                            'action' => $action_add,
                            'id' => $product->id
                        );
                    ?>
                </div>
            </div>   
        </div>
    
        
        <?php if(coolstuff_fnc_theme_options('is-quickview', true)){ ?>
            <div class="quick-view">
                <a href="#" class="quickview" data-productslug="<?php echo trim($product->post->post_name); ?>" data-toggle="modal" data-target="#pbr-quickview-modal">
                   <span><i class="fa fa-eye"> </i></span>
                </a>
            </div>
        <?php } ?>
        

        <?php
            if( class_exists( 'YITH_WCWL' ) ) {
                echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
            }
        ?>   

        <?php if( class_exists( 'YITH_Woocompare' ) ) { ?>
            <?php
                $action_add = 'yith-woocompare-add-product';
                $url_args = array(
                    'action' => $action_add,
                    'id' => $product->id
                );
            ?>
            <div class="yith-compare">
                <a href="<?php echo wp_nonce_url( add_query_arg( $url_args ), $action_add ); ?>" class="compare" data-product_id="<?php echo esc_attr($product->id); ?>">
                    <em class="fa fa-exchange"></em>
                    <!-- <span><?php // esc_html_e('add to compare', 'coolstuff' ); ?></span> -->
                </a>
            </div>
        <?php } ?>                 
    </div>       
    </figure>    
     <div class="product-meta">  
            <div class="caption">
        
            <div class="meta bg-white">

             <h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php
                    /**
                    * woocommerce_after_shop_loop_item_title hook
                    *
                    * @hooked woocommerce_template_loop_rating - 5
                    * @hooked woocommerce_template_loop_price - 10
                    */
                    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
                    do_action( 'woocommerce_after_shop_loop_item_title');

                ?>
            </div>
        </div>
        </div>
</div>