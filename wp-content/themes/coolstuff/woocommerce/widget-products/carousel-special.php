<?php

$_total = $loop->post_count;
$_count = 0;
$j = 1;
$_id = coolstuff_fnc_makeid();
?>
<div id="carousel-<?php echo esc_attr($_id); ?>" class="owl-carousel-play" data-ride="owlcarousel">         
    
        <?php if($posts_per_page>$columns_count && $_total>$columns_count){ ?>
            <div class="carousel-controls carousel-controls-v2 carousel-hidden bg-white">                
                <a class="left carousel-control carousel-md" href="#post-slide-<?php the_ID(); ?>" data-slide="prev"> </a>
                <a class="right carousel-control carousel-md" href="#post-slide-<?php the_ID(); ?>" data-slide="next"> </a> 
            </div>
        <?php } ?>
        
        <div class="owl-carousel products" data-slide="<?php echo esc_attr($columns_count); ?>" data-pagination="false" data-navigation="true">
            
            <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
                <?php if ( $_count%3 == 0 ): $_count = 0; ?>
                    <div class="clearfix">
                <?php endif; ?>

                    <?php if ( $_count == 0): ?>
                        <div class="col-sm-8 col-xs-12 <?php echo esc_attr($main_product_class); ?>">
                            <?php wc_get_template_part( 'content', 'frontproducts' ); ?>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                    <?php else: ?>
                            <?php wc_get_template_part( 'content', 'frontproducts' ); ?>
                    <?php endif; ?>
                    <?php if ( $_count == 2 || $j == $_total): ?>
                        </div>
                    <?php endif; ?>

                <?php if ( $_count%3 == 2 || $j == $_total ): ?>
                    </div>
                <?php endif; ?>
            <?php $_count++; $j++; endwhile; ?>
        </div>
 
</div>    
<?php wp_reset_postdata(); ?>