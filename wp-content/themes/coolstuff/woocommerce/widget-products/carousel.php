<?php

$_total = $loop->post_count;
$_count = 1;
$_id = coolstuff_fnc_makeid();
$item_style = isset($item_style) ? $item_style : 'style3';
?>
<div id="carousel-<?php echo esc_attr($_id); ?>" class="owl-carousel-play" data-ride="owlcarousel">         
    
        <?php if($posts_per_page>$columns_count && $_total>$columns_count){ ?>
            <div class="carousel-controls carousel-controls-v1 carousel-hidden">
                <a class="left carousel-control carousel-md" href="#post-slide-<?php the_ID(); ?>" data-slide="prev">                       
                </a>
                <a class="right carousel-control carousel-md" href="#post-slide-<?php the_ID(); ?>" data-slide="next">                       
                </a>
            </div> 
        <?php } ?>
         <div class="owl-carousel products" data-slide="<?php echo esc_attr($columns_count); ?>" data-pagination="false" data-navigation="true">
            <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                <div class="item">
                    <div class="products-grid product">
                        <?php if ( $item_style == 'style1' ): ?>
                            <?php wc_get_template_part( 'content', 'frontproducts' ); ?>
                        <?php elseif( $item_style == 'style2' ): ?>
                            <?php wc_get_template_part( 'content', 'frontproducts-style2' ); ?>
                        <?php else: ?>
                             <?php wc_get_template_part( 'content', 'frontproducts-style3' ); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
 
</div>    
<?php wp_reset_postdata(); ?>