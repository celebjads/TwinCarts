<section id="pbr-topbar" class="pbr-topbar pbr-topbar-v2 hidden-xs hidden-sm">
	<div class="container">
			<div class="inner">                
        <div class="pull-left hidden-xs hidden-sm">            
            <?php 
              // WPML - Custom Languages Menu
            	coolstuff_fnc_wpml_language_buttons();
            ?>
            <?php if(has_nav_menu( 'topmenu' )): ?>
	            <nav class="pbr-topmenu" role="navigation">
	                <?php
	                    $args = array(
	                        'theme_location'  => 'topmenu',
	                        'menu_class'      => 'pbr-menu-top list-inline list-square',
	                        'fallback_cb'     => '',
	                        'menu_id'         => 'main-topmenu'
	                    );
	                    wp_nav_menu($args);
	                ?>
	            </nav>
            <?php endif; ?>                            
        </div>
          
        <div class="topbar-right pull-right">
        	<?php do_action( 'coolstuff_template_header_right' ); ?>
        </div>

	</div>
	</div>	
</section>