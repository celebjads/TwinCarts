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

//$scolumns = $columns > 0 ? 12/$columns : 4;
$ocategory = get_term_by( 'slug', $category, 'product_cat' );
$term_id = '';
?>
<?php if ( !empty($ocategory) && !is_wp_error($ocategory) ){
	$term_id = $ocategory->term_id;
} ?>

<div class="widget widget-products widget-productcats-tabs">
<div class="woo-ajax-load-prods">
	 		
		<?php if( !empty($image_cat) ) { ?>
 		<?php $img = wp_get_attachment_image_src($image_cat,'full'); ?>
 		<div class="clearfix">
 			<img src="<?php echo esc_url_raw($img[0]); ?>" title="<?php echo esc_attr($ocategory->name); ?>">
 		</div>
 		<?php } ?>

		<div class="tab-v8">
		  	<div class="nav-inner clearfix">
		  		<?php if(isset($ocategory->name) && $ocategory->name!=''){ ?>
					<h3 class="widget-title">
						<span><?php echo trim($ocategory->name); ?></span>		
					</h3>	
				<?php }else{ ?>
					<h3 class="widget-title">
						<span><?php esc_html_e('Products', 'coolstuff') ?></span>		
					</h3>	
				<?php } ?>

			    <ul role="tablist" class="nav nav-tabs">
			    	<li class="active" data-action="wooloadproducts" data-slug="<?php echo trim( $category );?>" data-type="featured_product" data-show="<?php echo esc_attr( $columns );?>" data-limit="<?php echo esc_attr( $per_page );?>" data-href="#tab-<?php echo esc_attr($_id);?>1">
						<a  aria-expanded="false" data-toggle="tab" role="tab" href="#tab-<?php echo esc_attr($_id);?>1" ><?php esc_html_e( 'Featured', 'coolstuff'); ?></a>
					</li>
					<li  data-action="wooloadproducts" data-slug="<?php echo trim( $category );?>" data-type="newarrivals" data-show="<?php echo esc_attr( $columns );?>" data-limit="<?php echo esc_attr( $per_page );?>" data-href="#tab-<?php echo esc_attr($_id);?>2">
						<a aria-expanded="true" data-toggle="tab" role="tab" href="#tab-<?php echo esc_attr($_id);?>2" ><?php esc_html_e( 'New Arrivals', 'coolstuff'); ?></a>
					</li>
					<li data-action="wooloadproducts" data-slug="<?php echo trim( $category );?>" data-type="best_selling" data-show="<?php echo esc_attr( $columns );?>" data-limit="<?php echo esc_attr( $per_page );?>" data-href="#tab-<?php echo esc_attr($_id);?>3">
						<a  aria-expanded="false" data-toggle="tab" role="tab" href="#tab-<?php echo esc_attr($_id);?>3" ><?php esc_html_e( 'Best Seller', 'coolstuff'); ?></a>
					</li>					
			    </ul>
		  	</div>
		  <div class="widget-content tab-content">
		  	<div id="tab-<?php echo esc_attr($_id);?>1" class="tab-pane active">
	    		<?php 
				$loop = coolstuff_fnc_woocommerce_query( 'featured_product', $per_page , $term_id );
				?>
				<?php wc_get_template( 'widget-products/special-grid.php' , array( 'loop' => $loop ) ); ?>
		    </div>
		    <div id="tab-<?php echo esc_attr($_id);?>2" class="tab-pane">
	    		<?php
			 		$loop = coolstuff_fnc_woocommerce_query( 'recent_product', $per_page , $term_id );
			 	?>
			 	<?php wc_get_template( 'widget-products/special-grid.php' , array( 'loop' => $loop ) ); ?>
		    </div>
		    <div id="tab-<?php echo esc_attr($_id);?>3" class="tab-pane">
	    		<?php 
				$loop = coolstuff_fnc_woocommerce_query( 'best_selling', $per_page , $term_id );
				?>
				<?php wc_get_template( 'widget-products/special-grid.php' , array( 'loop' => $loop ) ); ?>
		    </div>
		    
		  </div>
		</div>
</div>
 
</div>
