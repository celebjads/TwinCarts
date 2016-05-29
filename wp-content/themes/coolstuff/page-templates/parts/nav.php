<nav  data-duration="<?php echo coolstuff_fnc_theme_options('megamenu-duration',400); ?>" class="hidden-xs hidden-sm pbr-megamenu <?php echo coolstuff_fnc_theme_options('magemenu-animation','slide'); ?> animate navbar navbar-mega" role="navigation">
        
	    <?php
	        $args = array(  'theme_location' => 'primary',
	                        'container_class' => 'collapse navbar-collapse navbar-mega-collapse',
	                        'menu_class' => 'nav navbar-nav megamenu',
	                        'fallback_cb' => '',
	                        'menu_id' => 'primary-menu',
	                        'walker' => new Coolstuff_PBR_bootstrap_navwalker() );
	        wp_nav_menu($args);
	    ?>
</nav>