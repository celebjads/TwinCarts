<div class="hidden-lg hidden-md"> 
    <div class="text-center header-logo__ismobile">
        <?php get_template_part( 'page-templates/parts/logo' ); ?>
    </div>
    <div class="topbar-mobile clearfix">
        <div class="item-left">
            <?php 
            if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
             global $woocommerce;
            ?>
                <div id="cart-mobile" class="dropdown">        
                    <a class="dropdown-toggle mini-cart mini-cart_large" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0" href="#" title="<?php esc_html_e('View your shopping cart', 'coolstuff'); ?>">           
                        <i class="fa  fa-shopping-bag"></i>       
                    </a>            
                    <div class="dropdown-menu">
                        <div class="widget_shopping_cart_content">
                            <?php woocommerce_mini_cart(); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>  
        <div class="search-box-wrapper search-toggle item-left">        
            <a href="#" class="cd-search-trigger"><?php esc_html_e( 'Search', 'coolstuff' ); ?><span></span></a>  
            <div class="search-toggle-dropdown">
                <?php get_search_form() ?>                              
            </div>                              
        </div>  
        <div class="item-left">
            <button data-toggle="offcanvas" class="btn btn-offcanvas btn-toggle-canvas offcanvas" type="button">
               <i class="fa fa-bars"></i>
            </button>    
        </div>
    </div>
</div>