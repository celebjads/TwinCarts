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

switch ($columns_count) {
	case '6': 
		$class_column = 'col-lg-2 col-md-4 col-sm-6 col-xs-12';
		break;
	case '4':
		$class_column='col-md-3 col-sm-6';
		break;
	case '3':
		$class_column='col-md-4 col-sm-4';
		break;
	case '2':
		$class_column='col-md-6 col-sm-6';
		break;
	default:
		$class_column='col-md-12 col-sm-12';
		break;
}

if($type=='') return;


global $woocommerce;

$_id = coolstuff_fnc_makeid();
$_count = 1;

if (isset($categories) && !empty($categories))
    $categories = array_map('trim', explode(',', $categories));
else
	$categories = '';
$loop = coolstuff_fnc_woocommerce_query($type, $number, $categories);

echo "<div class='widget widget-".esc_attr($layout_type) . " widget-products widget-products-bg products".((!empty($el_class))?" ".$el_class:'')."'>";

if($title!=''){ ?>
	<h3 class="widget-title visual-title">
      <span><?php echo esc_attr( $title ); ?></span> <?php if( isset($subtitle) && $subtitle ){ ?><span class="subtitle"><?php echo esc_html($subtitle); ?></span> <?php } ?>
	</h3>
<?php }

if ( $loop->have_posts() ) : ?>
	<div class="widget-content space-padding-bottom-40 bg-none">
		<div class="<?php echo esc_attr( $layout_type ); ?>-wrapper">
			<?php wc_get_template( 'widget-products/'.$layout_type.'.php' , array( 'loop'=>$loop,'columns_count'=>$columns_count,'class_column'=>$class_column,'posts_per_page'=>$number, 'item_style' => $item_style ) ); ?>
		</div>
	</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php echo "</div>" ?>
