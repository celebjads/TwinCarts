<?php global $woocommerce_loop; 
	$woocommerce_loop['columns'] = $columns_count ;
	$item_style = isset($item_style) ? $item_style : 'style3';
?>
<?php $_count = 1;$_delay = 150; $_total = $loop->post_count; ?>
<div class="<?php if($columns_count<=1){ ?>w-products-list<?php }else{ ?>products products-grid<?php } ?>"><div class="row">
<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
		

		<?php

		global $product, $woocommerce_loop;
			
			// Store loop count we're currently on
			if ( empty( $woocommerce_loop['loop'] ) ) {
				$woocommerce_loop['loop'] = 0;
			}

			// Store column count for displaying the grid
			if ( empty( $woocommerce_loop['columns'] ) ) {
				$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
			}

			// Ensure visibility
			if ( ! $product || ! $product->is_visible() ) {
				return;
			}

			// Increase loop count
			$woocommerce_loop['loop']++;

			 
			// Extra post classes
			$classes = array();
			if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
				$classes[] = 'first';
			}
			if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
				$classes[] = 'last';
			}

			if($woocommerce_loop['columns'] == 5) {
				$columns = 'cus-5';
			}else {
				$columns = 12/$woocommerce_loop['columns'];
			}
			$classes[] = 'col-lg-'.$columns.' col-md-'.$columns.' col-sm-'.(($woocommerce_loop['columns']%2==0)?$columns*2 : $columns).' col-xs-12';
			?>
			<div <?php post_class( $classes ); ?>>
				<?php if ( $item_style == 'style1' ): ?>
                <?php wc_get_template_part( 'content', 'frontproducts' ); ?>
            <?php elseif( $item_style == 'style2' ): ?>
                <?php wc_get_template_part( 'content', 'frontproducts-style2' ); ?>
            <?php else: ?>
                 <?php wc_get_template_part( 'content', 'frontproducts-style3' ); ?>
            <?php endif; ?>
			</div>


<?php endwhile; ?>
</div></div>

<?php wp_reset_postdata(); ?>