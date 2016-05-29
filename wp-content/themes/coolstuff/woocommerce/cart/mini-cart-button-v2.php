<?php   global $woocommerce; ?>
<div class="pbr-topcart pbr-topcart__v4">
 <div id="cart" class="dropdown">        
    <a class="dropdown-toggle pbr-offcanvas-cart mini-cart mini-cart_large" href="#" title="<?php esc_html_e('View your shopping cart', 'coolstuff'); ?>">           
        <span class="mini-cart-icon">
            <span class="mini-cart-icon-inner"></span>
        </span>    
        <?php echo sprintf(_n('<span class="mini-cart-items"> %d </span>', ' <span class="mini-cart-items"> %d  </span> ', $woocommerce->cart->cart_contents_count, 'coolstuff'), $woocommerce->cart->cart_contents_count);?>
    </a>  
    </div>
</div>    