<?php
/**
 * Coolstuff functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link https://codex.wordpress.org/Plugin_API
 *
 * @package WPOPAL
 * @subpackage coolstuff
 * @since Cool Stuff 1.0
 */
define( 'COOLSTUFFTHEME_VERSION', '1.0' );
define( 'COOLSTUFFPBR_THEME_URI', get_template_directory_uri() );
define( 'COOLSTUFFPBR_THEME_DIR', get_template_directory() );
define( 'PBR_THEME_DIR', COOLSTUFFPBR_THEME_DIR );
define( 'COOLSTUFFPBR_THEME_TEMPLATE_DIR', COOLSTUFFPBR_THEME_URI.'/page-templates/' );

/**
 * Set up the content width value based on the theme's design.
 *
 * @see coolstuff_fnc_content_width()
 *
 * @since Cool Stuff 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 474;
}

/**
 * Coolstuff only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'coolstuff_fnc_setup' ) ) :
/**
 * Coolstuff setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since Cool Stuff 1.0
 */
function coolstuff_fnc_setup() {

	/*
	 * Make Coolstuff available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Coolstuff, use a find and
	 * replace to change 'coolstuff' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'coolstuff', get_template_directory() . '/languages' );

	// This theme styles the visual editor to resemble the theme style.
 

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 600, 600, true );
	add_image_size( 'coolstuff-fullwidth', 1038, 9999, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => esc_html__( 'Top primary menu', 'coolstuff' ),
		'secondary' => esc_html__( 'Secondary menu in left sidebar', 'coolstuff' ),
		'topmenu'	=> esc_html__( 'Topbar Menu in Topbar sidebar', 'coolstuff' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
	// add support woocommerce

	add_theme_support( "woocommerce" );
	/*
	 * Enable support for Post Formats.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'coolstuff_fnc_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );

	
	// add support for display browser title
	add_theme_support( 'title-tag' );
	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
	
	coolstuff_fnc_get_load_plugins();

}
endif; // coolstuff_fnc_setup
add_action( 'after_setup_theme', 'coolstuff_fnc_setup' );

/**
 * batch including all files in a path.
 *
 * @param String $path : PATH_DIR/*.php or PATH_DIR with $ifiles not empty
 */
function coolstuff_fnc_includes( $path, $ifiles=array() ){

    if( !empty($ifiles) ){
         foreach( $ifiles as $key => $file ){
            $file  = $path.'/'.$file; 
            if(is_file($file)){
                require($file);
            }
         }   
    }else {
        $files = glob($path);
        foreach ($files as $key => $file) {
            if(is_file($file)){
                require($file);
            }
        }
    }
}

/**
 * Get Theme Option Value.
 * @param String $name : name of prameters 
 */
function coolstuff_fnc_theme_options($name, $default = false) {
  
    // get the meta from the database
    $options = ( get_option( 'pbr_theme_options' ) ) ? get_option( 'pbr_theme_options' ) : null;

    
   
    // return the option if it exists
    if ( isset( $options[$name] ) ) {
        return apply_filters( 'pbr_theme_options_$name', $options[ $name ] );
    }
    if( get_option( $name ) ){
        return get_option( $name );
    }
    // return default if nothing else
    return apply_filters( 'pbr_theme_options_$name', $default );
}


/**
 * Function for remove srcset (WP4.4)
 *
 */
function coolstuff_fnc_disable_srcset( $sources ) {
    return false;
}
add_filter( 'wp_calculate_image_srcset', 'coolstuff_fnc_disable_srcset' );



/**
 * Adjust content_width value for image attachment template.
 *
 * @since Cool Stuff 1.0
 */
function coolstuff_fnc_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'coolstuff_fnc_content_width' );


/**
 * Require function for including 3rd plugins
 *
 */
coolstuff_fnc_includes(  get_template_directory() . '/inc/plugins/*.php' );

function coolstuff_fnc_get_load_plugins(){

	$plugins[] =(array(
		'name'                     => esc_html__('MetaBox', 'coolstuff'), // The plugin name
	    'slug'                     => 'meta-box', // The plugin slug (typically the folder name)
	    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
	));

	$plugins[] =(array(
		'name'                     => esc_html__('WooCommerce', 'coolstuff'), // The plugin name
	    'slug'                     => 'woocommerce', // The plugin slug (typically the folder name)
	    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
	));

	$plugins[] =(array(
		'name'                     => esc_html__('MailChimp', 'coolstuff'), // The plugin name
	    'slug'                     => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
	    'required'                 =>  true
	));

	$plugins[] =(array(
		'name'                     => esc_html__('Contact Form 7', 'coolstuff'), // The plugin name
	    'slug'                     => 'contact-form-7', // The plugin slug (typically the folder name)
	    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
	));

	$plugins[] =(array(
		'name'                     => esc_html__('WPBakery Visual Composer', 'coolstuff'), // The plugin name
	    'slug'                     => 'js_composer', // The plugin slug (typically the folder name)
	    'required'                 => true,
	    'source'				   => 'http://www.wpopal.com/thememods/js_composer.zip' 
	));

	$plugins[] =(array(
		'name'                     => esc_html__('Revolution Slider', 'coolstuff'), // The plugin name
        'slug'                     => 'revslider', // The plugin slug (typically the folder name)
        'required'                 => true ,
        'source'				   => 'http://www.wpopal.com/thememods/revslider.zip'
	));

	$plugins[] =(array(
		'name'                     => esc_html__('PBR Themer For Themes', 'coolstuff'), // The plugin name
        'slug'                     => 'pbrthemer', // The plugin slug (typically the folder name)
        'required'                 => true ,
        'source'				   => 'http://www.wpopal.com/themeframework/pbrthemer.zip'
	));


	$plugins[] =(array(
		'name'                     => esc_html__('Google Web Fonts Customizer', 'coolstuff'), // The plugin name
        'slug'                     => 'google-web-fonts-customizer-gwfc', // The plugin slug (typically the folder name)
        'required'                 => false ,
	));

	tgmpa( $plugins );
}

/**
 * Register three Coolstuff widget areas.
 *
 * @since Cool Stuff 1.0
 */
function coolstuff_fnc_registart_widgets_sidebars() {
	 
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Sidebar Default', 'coolstuff' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'coolstuff'),
		'before_widget' => '<aside id="%1$s" class="widget  clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Newsletter' , 'coolstuff'),
		'id'            => 'newsletter',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'coolstuff'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Topbar Message' , 'coolstuff'),
		'id'            => 'header-market-right',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'coolstuff'),
		'before_widget' => '<aside id="%1$s" class="widget no-margin clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));	
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Left Sidebar' , 'coolstuff'),
		'id'            => 'sidebar-left',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'coolstuff'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style  clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));
	register_sidebar(
	array(
		'name'          => esc_html__( 'Right Sidebar' , 'coolstuff'),
		'id'            => 'sidebar-right',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'coolstuff'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Blog Left Sidebar' , 'coolstuff'),
		'id'            => 'blog-sidebar-left',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'coolstuff'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));

	register_sidebar( 
	array(
		'name'          => esc_html__( 'Blog Right Sidebar', 'coolstuff'),
		'id'            => 'blog-sidebar-right',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'coolstuff'),
		'before_widget' => '<aside id="%1$s" class="widget widget-style clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));


	register_sidebar( 
	array(
		'name'          => esc_html__( 'Static Left Sidebar', 'coolstuff'),
		'id'            => 'static-sidebar-left',
		'description'   => esc_html__( 'Appears on posts and pages in the sidebar static left with header static be actived.', 'coolstuff'),
		'before_widget' => '<aside id="%1$s" class="widget widget-static clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span><span>',
		'after_title'   => '</span></span></h3>',
	));


	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 1' , 'coolstuff'),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'coolstuff'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 2' , 'coolstuff'),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'coolstuff'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 3' , 'coolstuff'),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'coolstuff'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));
	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 4' , 'coolstuff'),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'coolstuff'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));


	register_sidebar( 
	array(
		'name'          => esc_html__( 'Footer 5' , 'coolstuff'),
		'id'            => 'footer-5',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'coolstuff'),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));


	register_sidebar( 
	array(
		'name'          => esc_html__( 'Mass Footer Body' , 'coolstuff'),
		'id'            => 'mass-footer-body',
		'description'   => esc_html__( 'Appears in the end of footer section of the site.', 'coolstuff'),
		'before_widget' => '<aside id="%1$s" class="widget-footer clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title hide"><span>',
		'after_title'   => '</span></h3>',
	));
}
add_action( 'widgets_init', 'coolstuff_fnc_registart_widgets_sidebars' );

/**
 * Register Lato Google font for Coolstuff.
 *
 * @since Cool Stuff 1.0
 *
 * @return string
 */
function coolstuff_fnc_font_url() {
	 
	$fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $lora = _x( 'off', 'Hind font: on or off', 'coolstuff' );
 
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $open_sans = _x( 'on', 'Open Sans font: on or off', 'coolstuff' );
 
    if ( 'off' !== $lora || 'off' !== $open_sans ) {
        $font_families = array();
 
        if ( 'off' !== $lora ) {
            $font_families[] = 'Roboto+Condensed:400,700,300';
        }
 
        if ( 'off' !== $open_sans ) {
            $font_families[] = 'Raleway:400,300,700';
        }
 
        $query_args = array(
            'family' => ( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 		
 		 
 		$protocol = is_ssl() ? 'https:' : 'http:';
        $fonts_url = add_query_arg( $query_args, $protocol .'//fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Cool Stuff 1.0
 */
function coolstuff_fnc_scripts() {
	// Add Lato font, used in the main stylesheet.
	wp_enqueue_style( 'coolstuff-open-sans', coolstuff_fnc_font_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'coolstuff-fa', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '3.0.3' );

	if(isset($_GET['pbr-skin']) && $_GET['pbr-skin']) {
		$currentSkin = $_GET['pbr-skin'];
	}else{
		$currentSkin = str_replace( '.css','', coolstuff_fnc_theme_options('skin','default') );
	}
	if( is_rtl() ){
		if( !empty($currentSkin) && $currentSkin != 'default' ){ 
			wp_enqueue_style( 'coolstuff-'.$currentSkin.'-style', get_template_directory_uri() . '/css/skins/rtl-'.$currentSkin.'/style.css' );
		}else {
			// Load our main stylesheet.
			wp_enqueue_style( 'coolstuff-style', get_template_directory_uri() . '/css/rtl-style.css' );
		}
	}
	else {
		if( !empty($currentSkin) && $currentSkin != 'default' ){ 
			wp_enqueue_style( 'coolstuff-'.$currentSkin.'-style', get_template_directory_uri() . '/css/skins/'.$currentSkin.'/style.css' );
		}else {
			// Load our main stylesheet.
			wp_enqueue_style( 'coolstuff-style', get_template_directory_uri() . '/css/style.css' );
		}	
	}	
	

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'coolstuff-ie', get_template_directory_uri() . '/css/ie.css', array( 'coolstuff-style' ), '20131205' );
	wp_style_add_data( 'coolstuff-ie', 'conditional', 'lt IE 9' );


	
	wp_enqueue_script( 'bootstrap-min', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20130402' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
	}

	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.js', array( 'jquery' ), '20150315', true );

	wp_enqueue_script('prettyphoto-js',	get_template_directory_uri().'/js/jquery.prettyPhoto.js',array(),false,true);
	wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css');

	wp_enqueue_script( 'coolstuff-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150315', true );

	wp_localize_script( 'coolstuff-script', 'coolstuffAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));


	// fullpage js

	if ( is_page() ) {
		global $post;
		if (is_object($post) && get_post_meta( $post->ID, 'coolstuff_fullpage', true )) {
			wp_enqueue_script( 'coolstuff-fullpage', get_template_directory_uri() . '/js/fullpage/jquery.fullPage.js', array( 'jquery' ), '20150315', true );
			wp_enqueue_script( 'coolstuff-fullpage-init', get_template_directory_uri() . '/js/fullpage/init.js', array( 'jquery' ), '20150315', true );
			wp_enqueue_style( 'coolstuff-fullpage-style', get_template_directory_uri() . '/js/fullpage/jquery.fullPage.css' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'coolstuff_fnc_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since Cool Stuff 1.0
 */
function coolstuff_fnc_admin_fonts() {
	wp_enqueue_style( 'coolstuff-lato', coolstuff_fnc_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'coolstuff_fnc_admin_fonts' );

//load file
require_once( get_template_directory() . '/inc/plugins/loader.php' );