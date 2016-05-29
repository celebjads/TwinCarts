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
?>
<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="pbr-search">
		<input name="s" maxlength="40" class="input-large input-search" type="text" size="20" placeholder="<?php  esc_html_e('Search...', 'coolstuff'); ?>">
		<span class="input-large btn btn-search">
			<input type="submit" class="btn-search__image" value="" />
			<?php if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){ ?>
			<input type="hidden" name="post_type" value="product" />
			<?php } ?>
		</span>
	</div>
</form>


