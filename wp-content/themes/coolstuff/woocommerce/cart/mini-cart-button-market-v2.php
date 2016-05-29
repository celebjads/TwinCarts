<?php global $woocommerce; ?>
<div class="pbr-topcart">
 <div id="cart" class="dropdown version-2">        
        <a class="dropdown-toggle pbr-offcanvas-cart mini-cart" href="#" title="<?php esc_html_e('View your shopping cart', 'coolstuff'); ?>">
            <span class="title-cart"><?php esc_html_e('My Cart ', 'coolstuff' ); ?></span>
            <?php echo sprintf(_n(' <span class="mini-cart-items"> %d  </span> ', ' <span class="mini-cart-items"> %d <em></em> </span> ', $woocommerce->cart->cart_contents_count, 'coolstuff'), $woocommerce->cart->cart_contents_count);?><span class="mini-cart-total"> <?php echo trim( $woocommerce->cart->get_cart_total() ); ?> </span>
        </a>            
    </div>
</div>    