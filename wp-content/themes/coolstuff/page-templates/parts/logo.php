 <?php if( coolstuff_fnc_theme_options('logo') ):  ?>
<div class="logo">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <img src="<?php echo esc_url_raw( coolstuff_fnc_theme_options('logo') ); ?>" alt="<?php bloginfo( 'name' ); ?>">
    </a>
</div>
<?php else: ?>
    <div class="logo logo-theme">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
             <img src="<?php echo esc_url_raw( get_template_directory_uri() ) . '/images/logo.png'; ?>" alt="<?php bloginfo( 'name' ); ?>" />
        </a>
    </div>
<?php endif; ?>