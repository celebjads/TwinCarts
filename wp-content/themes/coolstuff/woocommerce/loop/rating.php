<?php
/**
 * Loop Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
	return;
?>

<div class="rating">
	<?php if ( $rating_html = $product->get_rating_html() ) { ?>
		<?php echo trim( $rating_html ); ?>
	<?php }else{ ?>
	<div class="star-rating"></div>
	<?php } ?>
</div>
