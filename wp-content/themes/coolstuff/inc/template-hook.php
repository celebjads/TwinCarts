<?php 
/**
 * Remove javascript and css files not use
 */


/**
 * Hoo to top bar layout
 */
function coolstuff_fnc_topbar_layout(){
	$layout = coolstuff_fnc_get_header_layout();
	get_template_part( 'page-templates/parts/topbar', $layout );
	get_template_part( 'page-templates/parts/topbar', 'mobile' );
}

add_action( 'coolstuff_template_header_before', 'coolstuff_fnc_topbar_layout' );


function coolstuff_fnc_topbar_layout_v2(){
   $layout = coolstuff_fnc_get_header_layout();
   get_template_part( 'page-templates/parts/topbar', 'mobile' );
}

add_action( 'coolstuff_template_header_before_v2', 'coolstuff_fnc_topbar_layout_v2' );
/**
 * Hook to select header layout for archive layout
 */
function coolstuff_fnc_get_header_layout( $layout='' ){
	global $post; 

	$layout = $post && get_post_meta( $post->ID, 'coolstuff_header_layout', 1 ) ? get_post_meta( $post->ID, 'coolstuff_header_layout', 1 ) : coolstuff_fnc_theme_options( 'headerlayout' );
	 
 	if( $layout ){
 		return trim( $layout );
 	}elseif ( $layout = coolstuff_fnc_theme_options('header_skin','') ){
 		return trim( $layout );
 	}

	return $layout;
} 

add_filter( 'coolstuff_fnc_get_header_layout', 'coolstuff_fnc_get_header_layout' );

/**
 * Hook to select header layout for archive layout
 */
function coolstuff_fnc_get_footer_profile( $profile='default' ){

	global $post; 

	$profile =  $post? get_post_meta( $post->ID, 'coolstuff_footer_profile', 1 ):null ;

 	if( $profile ){
 		return trim( $profile );
 	}elseif ( $profile = coolstuff_fnc_theme_options('footer-style', $profile ) ){  
 		return trim( $profile );
 	}

	return $profile;
} 

add_filter( 'coolstuff_fnc_get_footer_profile', 'coolstuff_fnc_get_footer_profile' );

/**
 * Render Custom Css Renderig by Visual composer
 */
if ( !function_exists( 'coolstuff_fnc_print_style_footer' ) ) {
	function coolstuff_fnc_print_style_footer(){
		$footer =  coolstuff_fnc_get_footer_profile( 'default' );
		if($footer!='default'){
			$shortcodes_custom_css = get_post_meta( $footer, '_wpb_shortcodes_custom_css', true );
			if ( ! empty( $shortcodes_custom_css ) ) {
				echo '<style>
					'.$shortcodes_custom_css.'
					</style>';
			}
		}
	}
	add_action('wp_head','coolstuff_fnc_print_style_footer', 18);
}

/**
 * Hook to show breadscrumbs
 */
function coolstuff_fnc_render_breadcrumbs(){
	
	global $post;

	if( is_object($post) ){
		$disable = get_post_meta( $post->ID, 'coolstuff_disable_breadscrumb', 1 );  
		if(  $disable || is_front_page() ){
			return true; 
		}
		$bgimage = get_post_meta( $post->ID, 'coolstuff_image_breadscrumb', 1 );  
		$color 	 = get_post_meta( $post->ID, 'coolstuff_color_breadscrumb', 1 );  
		$bgcolor = get_post_meta( $post->ID, 'coolstuff_bgcolor_breadscrumb', 1 );  
		$style = array();
		if( $bgcolor ){
			$style[] = 'background-color:'.$bgcolor;
		}
		if( $bgimage ){ 
			$style[] = 'background-image:url(\''.wp_get_attachment_url($bgimage).'\')';
		}

		if( $color ){ 
			$style[] = 'color:'.$color;
		}

		$estyle = !empty($style)? 'style="'.implode(";", $style).'"':"";
	}else {
		$estyle = ''; 
	}
	
	echo '<section id="pbr-breadscrumb" class="pbr-breadscrumb" '.$estyle.'><div class="container">';
			coolstuff_fnc_breadcrumbs();
	echo '</div></section>';

}
add_action( 'coolstuff_template_main_before', 'coolstuff_fnc_render_breadcrumbs' ); 

/**
 * Main Container
 */
function coolstuff_template_main_container_class( $class ){
	global $post; 
	global $coolstuff_wpopconfig;

	$layoutcls = get_post_meta( $post->ID, 'coolstuff_enable_fullwidth_layout', 1 );
	
	if( $layoutcls ) {
		$coolstuff_wpopconfig['layout'] = 'fullwidth';
		return 'container-fluid';
	}
	return $class;
}
add_filter( 'coolstuff_template_main_container_class', 'coolstuff_template_main_container_class', 1 , 1  );
add_filter( 'coolstuff_template_main_content_class', 'coolstuff_template_main_container_class', 1 , 1  );

function coolstuff_template_footer_before(){
	return get_sidebar( 'newsletter' );
}

add_action( 'coolstuff_template_footer_before', 'coolstuff_template_footer_before' );

/**
 * Get Configuration for Page Layout
 *
 */
function coolstuff_fnc_get_page_sidebar_configs( $configs='' ){

	global $post; 

	$left  =  get_post_meta( $post->ID, 'coolstuff_leftsidebar', 1 );
	$right =  get_post_meta( $post->ID, 'coolstuff_rightsidebar', 1 );

	return coolstuff_fnc_get_layout_configs( $left, $right );
}

add_filter( 'coolstuff_fnc_get_page_sidebar_configs', 'coolstuff_fnc_get_page_sidebar_configs', 1, 1 );


function coolstuff_fnc_get_single_sidebar_configs( $configs='' ){

	global $post; 

	$left  =  get_post_meta( $post->ID, 'coolstuff_leftsidebar', 1 );
	$right =  get_post_meta( $post->ID, 'coolstuff_rightsidebar', 1 );

	if ( empty( $left ) ) {
		$left  =  coolstuff_fnc_theme_options( 'blog-single-left-sidebar' ); 
	}

	if ( empty( $right ) ) {
		$right =  coolstuff_fnc_theme_options( 'blog-single-right-sidebar' ); 
	}

	return coolstuff_fnc_get_layout_configs( $left, $right );
}

add_filter( 'coolstuff_fnc_get_single_sidebar_configs', 'coolstuff_fnc_get_single_sidebar_configs', 1, 1 );

function coolstuff_fnc_get_archive_sidebar_configs( $configs='' ){

	global $post; 


	$left  =  coolstuff_fnc_theme_options( 'blog-archive-left-sidebar' ); 
	$right =  coolstuff_fnc_theme_options( 'blog-archive-right-sidebar' ); 
 	
	return coolstuff_fnc_get_layout_configs( $left, $right );
}

add_filter( 'coolstuff_fnc_get_archive_sidebar_configs', 'coolstuff_fnc_get_archive_sidebar_configs', 1, 1 );
add_filter( 'coolstuff_fnc_get_category_sidebar_configs', 'coolstuff_fnc_get_archive_sidebar_configs', 1, 1 );

/**
 *
 */
function coolstuff_fnc_get_layout_configs( $left, $right ){
	$configs = array();
	$configs['main'] = array( 'class' => 'col-lg-9 col-md-9' );

	$configs['sidebars'] = array( 
		'left'  => array( 'sidebar' => $left, 'active' => is_active_sidebar( $left ), 'class' => 'col-lg-3 col-md-3'  ),
		'right' => array( 'sidebar' => $right, 'active' => is_active_sidebar( $right ), 'class' => 'col-lg-3 col-md-3' ) 
	); 

	if( $left && $right ){
		$configs['main'] = array( 'class' => 'col-lg-6 col-md-6' );
	} elseif( empty($left) && empty($right) ){
		$configs['main'] = array( 'class' => 'col-lg-12 col-md-12' );
	}
	return $configs; 
}

if(!function_exists('coolstuff_fnc_related_post')){
    function coolstuff_fnc_related_post( $relate_count = 4, $posttype = 'post', $taxonomy = 'category' ){
      
        $terms = get_the_terms( get_the_ID(), $taxonomy );
        $termids =array();

        if($terms){
            foreach($terms as $term){
                $termids[] = $term->term_id;
            }
        }

        $args = array(
            'post_type' => $posttype,
            'posts_per_page' => $relate_count,
            'post__not_in' => array( get_the_ID() ),
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'id',
                    'terms' => $termids,
                    'operator' => 'IN'
                )
            )
        );
        $template_name = 'related_'.$posttype.'.php';

        $relates = new WP_Query( $args );

        if (is_file(get_template_directory().'/page-templates/' . $template_name)) {
            include(get_template_directory().'/page-templates/' . $template_name);
        }
    }
}


function coolstuff_fnc_sidebars_others_configs(){
	
	global $coolstuff_page_layouts;
	
	return $coolstuff_page_layouts; 
}

add_filter("coolstuff_fnc_sidebars_others_configs", "coolstuff_fnc_sidebars_others_configs");