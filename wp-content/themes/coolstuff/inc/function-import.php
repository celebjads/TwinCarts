<?php

function coolstuff_fnc_import_remote_demos() { 
   return array(
      'coolstuff' => array( 'name' => 'coolstuff',  'source'=> 'http://wpsampledemo.com/coolstuff/coolstuff.zip' ),
   );
}

add_filter( 'pbrthemer_import_remote_demos', 'coolstuff_fnc_import_remote_demos' );



function coolstuff_fnc_import_theme() {
   return 'coolstuff';
}
add_filter( 'pbrthemer_import_theme', 'coolstuff_fnc_import_theme' );

function coolstuff_fnc_import_demos() {
   $folderes = glob( get_template_directory().'/inc/import/*', GLOB_ONLYDIR ); 

   $output = array(); 

   foreach( $folderes as $folder ){
      $output[basename( $folder )] = basename( $folder );
   }
   
   return $output;
}
add_filter( 'pbrthemer_import_demos', 'coolstuff_fnc_import_demos' );

function coolstuff_fnc_import_types() {
   return array(
         'all' => 'All',
         'content' => 'Content',
         'widgets' => 'Widgets',
         'page_options' => 'Theme + Page Options',
         'menus' => 'Menus',
         'rev_slider' => 'Revolution Slider',
         'vc_templates' => 'VC Templates'
      );
}
add_filter( 'pbrthemer_import_types', 'coolstuff_fnc_import_types' );
