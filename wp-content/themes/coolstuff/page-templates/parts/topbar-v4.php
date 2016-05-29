<section id="pbr-topbar" class="pbr-topbar hidden">
	<div class="container"><div class="inner">
        <div class="pull-left hidden-lg hidden-md">
            <button data-toggle="offcanvas" class="btn btn-offcanvas btn-toggle-canvas offcanvas" type="button">
               <i class="fa fa-bars"></i>
            </button>
        </div>

        <div class="topbar-left">
            <?php 
                // WPML - Custom Languages Menu
                coolstuff_fnc_wpml_language_buttons();
            ?>
        </div>

        <div class="topbar-right">            

        <div class="user-login">
            <ul class="list-inline">
                <?php if( !is_user_logged_in() ){ ?>
                    <?php do_action('pbr-account-buttons'); ?> 
                <?php }else{ ?>
                    <?php $current_user = wp_get_current_user(); ?>
                  <li>  
                    <span class="hidden-xs"><?php  esc_html_e('Welcome ', 'coolstuff' ); ?><?php echo esc_html( $current_user->display_name); ?> !</span>
                  </li>
                <?php } ?>
            </ul>                 
        </div>
        <div class="user-setting">
            
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
        <?php do_action( 'coolstuff_template_header_right' ); ?>		
		</div>
		
	</div></div>	
</section>