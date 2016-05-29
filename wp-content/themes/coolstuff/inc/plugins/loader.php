<?php 
/**
 * Implement rick meta box for post and page, custom post types. These 're used with metabox plugins
 */
if( is_admin() ){
	coolstuff_fnc_includes(  get_template_directory() . '/inc/admin/function.php' );
	coolstuff_fnc_includes(  get_template_directory() . '/inc/admin/metabox/*.php' );
}
coolstuff_fnc_includes(  get_template_directory() . '/inc/classes/*.php' );
coolstuff_fnc_includes(  get_template_directory() . '/inc/*.php' );
?>