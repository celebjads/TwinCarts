<?php

function coolstuff_woocommerce_enqueue_scripts() {
	wp_enqueue_script( 'coolstuff-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', array( 'jquery', 'suggest' ), '20131022', true );
}
add_action( 'wp_enqueue_scripts', 'coolstuff_woocommerce_enqueue_scripts' );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

/**
 */
add_filter('add_to_cart_fragments',	'coolstuff_fnc_woocommerce_header_add_to_cart_fragment' );

function coolstuff_fnc_woocommerce_header_add_to_cart_fragment( $fragments ){
	global $woocommerce;

	$fragments['#cart .mini-cart-items'] =  sprintf(_n(' <span class="mini-cart-items"> %d  </span> ', ' <span class="mini-cart-items"> %d <em></em> </span> ', $woocommerce->cart->cart_contents_count, 'coolstuff'), $woocommerce->cart->cart_contents_count);
 	$fragments['#cart .amount'] = trim( $woocommerce->cart->get_cart_total() );
 	ob_start();
 	?>
 	<div id ="pbr-offcanvas-cart" class="offcanvas-cart">
 		<div class="cart-overlay"> </div>		
			<div class="widget widget-offcanvas">
				<h3 class="widget-title">
					<span><?php esc_html_e('Shopping Cart', 'coolstuff'); ?></span>
				</h3> 
			<button class="btn-close close">
				<span><?php esc_html_e('Close', 'coolstuff'); ?></span>
			</button>
		</div>		
        <?php woocommerce_mini_cart(); ?>
   </div>	     
 	<?php
   $fragments['#pbr-cart #pbr-offcanvas-cart'] = ob_get_clean();  
    return $fragments;
}


/**
 * Mini Basket
 */
if(!function_exists('coolstuff_woocommerce_fnc_minibasket')){
    function coolstuff_woocommerce_fnc_minibasket( $style='' ){ 
        $template =  apply_filters( 'coolstuff_woocommerce_fnc_minibasket_template', coolstuff_fnc_get_header_layout( '' )  );  
        
        if( $template == 'v4' ){
        	$template = 'v4';
        }
        return get_template_part( 'woocommerce/cart/mini-cart-button', $template ); 
    }
}
if(coolstuff_fnc_theme_options("woo-show-minicart",true)){
	add_action( 'coolstuff_template_header_right', 'coolstuff_woocommerce_fnc_minibasket', 30, 0 );
}
/******************************************************
 * 												   	  *
 * Hook functions applying in archive, category page  *
 *												      *
 ******************************************************/
function coolstuff_template_woocommerce_main_container_class( $class ){ 
	if( is_product() ){
		$class .= ' '.  coolstuff_fnc_theme_options('woocommerce-single-layout') ;
	}else if( is_product_category() || is_archive()  ){ 
		$class .= ' '.  coolstuff_fnc_theme_options('woocommerce-archive-layout') ;
	}
	return $class;
}

add_filter( 'coolstuff_template_woocommerce_main_container_class', 'coolstuff_template_woocommerce_main_container_class' );
function coolstuff_fnc_get_woocommerce_sidebar_configs( $configs='' ){

	global $post; 
	$right = null; $left = null; 

	if( is_product() ){
		
		$left  =  coolstuff_fnc_theme_options( 'woocommerce-single-left-sidebar' ); 
		$right =  coolstuff_fnc_theme_options( 'woocommerce-single-right-sidebar' );  

	}else if( is_product_category() || is_archive() ){
		$left  =  coolstuff_fnc_theme_options( 'woocommerce-archive-left-sidebar' ); 
		$right =  coolstuff_fnc_theme_options( 'woocommerce-archive-right-sidebar' ); 
	}

 
	return coolstuff_fnc_get_layout_configs( $left, $right );
}

add_filter( 'coolstuff_fnc_get_woocommerce_sidebar_configs', 'coolstuff_fnc_get_woocommerce_sidebar_configs', 1, 1 );


function coolstuff_woocommerce_breadcrumb_defaults( $args ){
	$estyle = '';
	$style = array();
	
	if(is_shop()){
		$page_id = get_option( 'woocommerce_shop_page_id' );
		$disable = get_post_meta( $page_id, 'coolstuff_disable_breadscrumb', 1 );  
		if(  $disable ){
			$args['disable'] = true;
			return $args;
		}
		$bgimage = get_post_meta( $page_id, 'coolstuff_image_breadscrumb', 1 );  
		$color 	 = get_post_meta( $page_id, 'coolstuff_color_breadscrumb', 1 );  
		$bgcolor = get_post_meta( $page_id, 'coolstuff_bgcolor_breadscrumb', 1 );  
		
		if( $bgcolor ){
			$style[] = 'background-color:'.$bgcolor;
		}
		if( $bgimage ){ 
			$style[] = 'background-image:url(\''.wp_get_attachment_url($bgimage).'\')';
		}

		if( $color ){ 
			$style[] = 'color:'.$color;
		}
		
	}else{
		$bgimage = coolstuff_fnc_theme_options('breadcrumb-product', '');
		if( $bgimage ){ 
			$style[] = 'background-image:url(\''.esc_url_raw($bgimage).'\')';
		}
	}
	$estyle = !empty($style)? 'style="'.implode(";", $style).'"':"";
	
	$args['wrap_before'] = '<div class="pbr-breadscrumb" '.$estyle.'><div class="container"><ol class="pbr-woocommerce-breadcrumb breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
	$args['wrap_after'] = '</ol></div></div>';

	return $args;
}

add_filter( 'woocommerce_breadcrumb_defaults', 'coolstuff_woocommerce_breadcrumb_defaults' );

add_action( 'coolstuff_woo_template_main_before', 'woocommerce_breadcrumb', 30, 0 );
/**
 * Remove show page results which display on top left of listing products block.
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 10 );


function coolstuff_fnc_woocommerce_after_shop_loop_start(){
	echo '<div class="products-bottom-wrap clearfix">';
}

add_action( 'woocommerce_after_shop_loop', 'coolstuff_fnc_woocommerce_after_shop_loop_start', 1 );

function coolstuff_fnc_woocommerce_after_shop_loop_after(){
	echo '</div>';
}

add_action( 'woocommerce_after_shop_loop', 'coolstuff_fnc_woocommerce_after_shop_loop_after', 10000 );


/**
 * Wrapping all elements are wrapped inside Div Container which rendered in woocommerce_before_shop_loop hook
 */
function coolstuff_woocommerce_before_shop_loop_start(){
	echo '<div class="products-top-wrap clearfix">';
}

function coolstuff_woocommerce_before_shop_loop_end(){
	echo '</div>';
}


add_action( 'woocommerce_before_shop_loop', 'coolstuff_woocommerce_before_shop_loop_start' , 0 );
add_action( 'woocommerce_before_shop_loop', 'coolstuff_woocommerce_before_shop_loop_end' , 1000 );


function coolstuff_fnc_woocommerce_display_modes(){
	global $wp;
	$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
	$woo_display = 'grid';
	if ( isset($_COOKIE['coolstuff_woo_display']) && $_COOKIE['coolstuff_woo_display'] == 'list' ) {
		$woo_display = $_COOKIE['coolstuff_woo_display'];
	}
	echo '<form action="'.  esc_url( $current_url )  .'" class="display-mode" method="get">';
 
		echo '<button title="'.esc_html__('Grid', 'coolstuff' ).'" class="btn '.($woo_display == 'grid' ? 'active' : '').'" value="grid" name="display" type="submit"><i class="fa fa-th"></i></button>';	
		echo '<button title="'.esc_html__( 'List', 'coolstuff' ).'" class="btn '.($woo_display == 'list' ? 'active' : '').'" value="list" name="display" type="submit"><i class="fa fa-th-list"></i></button>';	
	echo '</form>'; 
}

add_action( 'woocommerce_before_shop_loop', 'coolstuff_fnc_woocommerce_display_modes' , 1 );


/**
 * Processing hook layout content
 */
function coolstuff_fnc_layout_main_class( $class ){
	$sidebar = coolstuff_fnc_theme_options( 'woo-sidebar-show', 1 ) ;
	if( is_single() ){
		$sidebar = coolstuff_fnc_theme_options('woo-single-sidebar-show'); ;
	}
	else {
		$sidebar = coolstuff_fnc_theme_options('woo-sidebar-show'); 
	}

	if( $sidebar ){
		return $class;
	}

	return 'col-lg-12 col-md-12 col-xs-12';
}
add_filter( 'coolstuff_woo_layout_main_class', 'coolstuff_fnc_layout_main_class', 4 );


/**
 *
 */
function coolstuff_woocommerce_fnc_archive_image(){ 
	if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0 ) { 
		$thumb =  get_woocommerce_term_meta( get_queried_object()->term_id, 'thumbnail_id', true ) ;

		if( $thumb ){
			$img = wp_get_attachment_image_src( $thumb, 'full' ); 
		
			echo '<p class="category-banner"><img src="'.esc_url_raw( $img[0] ).'""></p>'; 
		}
	}
}
add_action( 'woocommerce_archive_description', 'coolstuff_woocommerce_fnc_archive_image', 9 );
/**
 * Add action to init parameter before processing
 */

function coolstuff_fnc_before_woocommerce_init(){
	if( isset($_GET['display']) && ($_GET['display']=='list' || $_GET['display']=='grid') ){  
		setcookie( 'coolstuff_woo_display', trim($_GET['display']) , time()+3600*24*100,'/' );
		$_COOKIE['coolstuff_woo_display'] = trim($_GET['display']);
	}
}

add_action( 'init', 'coolstuff_fnc_before_woocommerce_init' );
/***************************************************
 * 												   *
 * Hook functions applying in single product page  *
 *												   *
 ***************************************************/

function coolstuff_woocommerce_show_product_thumbnails( $layout ){ 
	$layout = $layout.'-h';
	return $layout;
}

add_filter( 'pbrthemer_woocommerce_show_product_thumbnails', 'coolstuff_woocommerce_show_product_thumbnails'  );


function coolstuff_woocommerce_show_product_images( $layout ){ 
	$layout = $layout.'-h';
	return $layout;
}

add_filter( 'pbrthemer_woocommerce_show_product_images', 'coolstuff_woocommerce_show_product_images'  );

/**
 * Show/Hide related, upsells products
 */
function coolstuff_woocommerce_related_upsells_products($located, $template_name) {
	$options      = get_option('pbr_theme_options');
	$content_none = get_template_directory() . '/woocommerce/content-none.php';

	if ( 'single-product/related.php' == $template_name ) {
		if ( isset( $options['wc_show_related'] ) && 
			( 1 == $options['wc_show_related'] ) ) {
			$located = $content_none;
		}
	} elseif ( 'single-product/up-sells.php' == $template_name ) {
		if ( isset( $options['wc_show_upsells'] ) && 
			( 1 == $options['wc_show_upsells'] ) ) {
			$located = $content_none;
		}
	}

	return apply_filters( 'coolstuff_woocommerce_related_upsells_products', $located, $template_name );
}

add_filter( 'wc_get_template', 'coolstuff_woocommerce_related_upsells_products', 10, 2 );

/**
 * Number of products per page
 */
function coolstuff_woocommerce_shop_per_page($number) {
	$value = coolstuff_fnc_theme_options('woo-number-page', get_option('posts_per_page'));
	if ( is_numeric( $value ) && $value ) {
		$number = absint( $value );
	}
	return $number;
}

add_filter( 'loop_shop_per_page', 'coolstuff_woocommerce_shop_per_page' );

/**
 * Number of products per row
 */
function coolstuff_woocommerce_shop_columns($number) {
	$value = coolstuff_fnc_theme_options('wc_itemsrow', 3);
	if ( in_array( $value, array(2, 3, 4, 6) ) ) {
		$number = $value;
	}
	return $number;
}

add_filter( 'loop_shop_columns', 'coolstuff_woocommerce_shop_columns' );

function coolstuff_fnc_woocommerce_share_box() {
	if ( coolstuff_fnc_theme_options('wc_show_share_social', 1) ) {
		get_template_part( 'page-templates/parts/sharebox' );
	}
}
add_filter( 'woocommerce_single_product_summary', 'coolstuff_fnc_woocommerce_share_box', 100 );


function coolstuff_offcanvas_cart() {
    ?>
   <div id="pbr-cart">
		<div id="pbr-offcanvas-cart" class="offcanvas-cart">
			<div class="cart-overlay"> </div>		
			<div class="widget widget-offcanvas">
				<h3 class="widget-title">
					<span><?php esc_html_e('Shopping Cart', 'coolstuff'); ?></span>
				</h3> 
			<button class="btn-close close">
				<span><?php esc_html_e('Close', 'coolstuff'); ?></span>
			</button>

			</div>	
			<div class="update-content-cart">	
	        <?php woocommerce_mini_cart(); ?>
	       </div>
	    </div>
	   </div> 
<?php    
}
add_action( 'wp_footer', 'coolstuff_offcanvas_cart' );  