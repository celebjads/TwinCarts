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
		$class_column = 'col-lg-2 col-md-4 col-sm-4 col-xs-6 col-xs-cus-12';
		break;
	case '5':
		$class_column='col-lg-cus-5 col-md-cus-5 col-sm-4 col-xs-6 col-xs-cus-12';
		break;	
	case '4':
		$class_column='col-md-3 col-sm-4 col-xs-6 col-xs-cus-12';
		break;
	case '3':
		$class_column='col-md-4 col-sm-4 col-xs-6 col-xs-cus-12';
		break;
	case '2':
		$class_column='col-md-6 col-sm-4 col-xs-6 col-xs-cus-12';
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
?>

<div class='widget widget-products products <?php echo (!empty($el_class) ? esc_attr($el_class) : ''); ?>'>
<?php
if($title!='') : ?>
	<h3 class="widget-title visual-title">
      <span><?php echo esc_attr( $title ); ?></span> <?php if( isset($subtitle) && $subtitle ){ ?><span class="subtitle"><?php echo esc_html($subtitle); ?></span> <?php } ?>
	</h3>
<?php endif;

if ( $loop->have_posts() ) :
	$end = $loop->post_count;
?>
	<div class="widget-content widget-products-collection space-padding-bottom-40 bg-none">
		<div class="row">
			<?php
			    $i = 0;
			    $main = $num_mainpost;

			    while($loop->have_posts()){
			        $loop->the_post();
			?>
			        <?php if( $i <= $main-1) { ?>
			            <?php if( $i == 0 ) {  ?>
			                <div  class="col-sm-12 main-posts large nopadding">
			            <?php } ?>
				            <div class="col-sm-12 col-md-6">
				             	<?php wc_get_template_part( 'content', 'product-info-list' ); ?>
		                    </div>
			            <?php if( $i == $main-1 || $i == $end -1 ) { ?>
			                </div>
			            <?php } ?>
			        <?php } else { ?>
			                <?php if( $i == $main  ) { ?>
			                <div class="col-sm-12 secondary-posts space-top-20 space-20">
			                	<div class="row">
				                <?php }  ?>
				                    <div class="<?php echo trim($class_column);?> product">
				                        <?php wc_get_template_part( 'content', 'product-inner' ); ?>
				                    </div>
				                <?php if( $i == $end-1 ) {   ?>
				                </div>
			                </div>
			                <?php } ?>
			            <?php } ?>
			<?php  $i++; } ?>
		</div>
	</div>
<?php endif; ?>

<?php wp_reset_postdata(); ?>

</div>
