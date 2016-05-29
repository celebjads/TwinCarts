<?php

 /**
  * Register Woocommerce Vendor which will register list of shortcodes
  */
function coolstuff_fnc_init_vc_vendors(){
	
	$vendor = new Coolstuff_VC_News();
	add_action( 'vc_after_set_mode', array(
		$vendor,
		'load'
	), 99 );


	$vendor = new Coolstuff_VC_Theme();
	add_action( 'vc_after_set_mode', array(
		$vendor,
		'load'
	), 99 );

	$vendor = new Coolstuff_VC_Elements();
	add_action( 'vc_after_set_mode', array(
		$vendor,
		'load'
	), 99 );

	
}
add_action( 'after_setup_theme', 'coolstuff_fnc_init_vc_vendors' , 99 );   

/**
 * Add parameters for row
 */
function coolstuff_fnc_add_params(){

 	/**
	 * add new params for row
	 */
	vc_add_param( 'vc_row', array(
	    "type" => "checkbox",
	    "heading" => esc_html__("Parallax", 'coolstuff'),
	    "param_name" => "parallax",
	    "value" => array(
	        'Yes, please' => true
	    )
	));

	$row_class =  array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'Background Styles', 'coolstuff' ),
        'param_name' => 'bgstyle',
        'description'	=> esc_html__('Use Styles Supported In Theme, Select No Use For Customizing on Tab Design Options', 'coolstuff' ),
        'value' => array(
				esc_html__( 'No Use', 'coolstuff' ) => '',
				esc_html__( 'Background Color Primary', 'coolstuff' ) => 'bg-primary',
				esc_html__( 'Background Color Info', 'coolstuff' ) 	 => 'bg-info',
				esc_html__( 'Background Color Danger', 'coolstuff' )  => 'bg-danger',
				esc_html__( 'Background Color Warning', 'coolstuff' ) => 'bg-warning',
				esc_html__( 'Background Color Success', 'coolstuff' ) => 'bg-success',
				esc_html__( 'Background Color Theme', 'coolstuff' ) 	 => 'bg-theme',
			    esc_html__( 'Background Image 1 Dark', 'coolstuff' ) => 'bg-style-v1',
				esc_html__( 'Background Image 2 Dark', 'coolstuff' ) => 'bg-style-v2',
				esc_html__( 'Background Image 3 Blue', 'coolstuff' ) => 'bg-style-v3',
				esc_html__( 'Background Image 4 Red', 'coolstuff' ) => 'bg-style-v4',
        )
    );

	$row_padding = array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Padding Style', 'coolstuff' ),
        'param_name' => 'row_padding',
        'value' => array(
				esc_html__( 'Default', 'coolstuff' ) => '',
				esc_html__( 'Remove Padding for columns', 'coolstuff' ) => 'remove-padding',
        )
	);

	vc_add_param( 'vc_row', $row_class );
	vc_add_param('vc_row', $row_padding);
	vc_add_param( 'vc_row_inner', $row_class );
 

	 vc_add_param( 'vc_row', array(
	     "type" => "dropdown",
	     "heading" => esc_html__("Is Boxed", 'coolstuff'),
	     "param_name" => "isfullwidth",
	     "value" => array(
	     				esc_html__('Yes, Boxed', 'coolstuff') => '1',
	     				esc_html__('No, Wide', 'coolstuff') => '0'
	     			)
	));

	vc_add_param( 'vc_row', array(
	    "type" => "textfield",
	    "heading" => esc_html__("Icon", 'coolstuff'),
	    "param_name" => "icon",
	    "value" => '',
		'description'	=> esc_html__( 'This support display icon from FontAwsome, Please click', 'coolstuff' )
						. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fortawesome.github.io/Font-Awesome/" target="_blank">'
						. esc_html__( 'here to see the list, and use class icons-lg, icons-md, icons-sm to change its size', 'coolstuff' ) . '</a>'
	));
	// add param for image elements

	 vc_add_param( 'vc_single_image', array(
	     "type" => "textarea",
	     "heading" => esc_html__("Image Description", 'coolstuff'),
	     "param_name" => "description",
	     "value" => "",
	     'priority'	
	));

	vc_add_param( 'vc_single_image', array(
	    'type' => 'dropdown',
		'heading' => esc_html__( 'CSS Animation', 'coolstuff' ),
		'param_name' => 'css_animation',
		'admin_label' => true,
		'value' => array(
			esc_html__( 'No', 'coolstuff' ) => '',
			esc_html__( 'effect v1', 'coolstuff' ) => 'effect-v1',
			esc_html__( 'effect v2', 'coolstuff' ) => 'effect-v2',
			esc_html__( 'effect v3', 'coolstuff' ) => 'effect-v3',
			esc_html__( 'effect v4', 'coolstuff' ) => 'effect-v4',
			esc_html__( 'effect v5', 'coolstuff' ) => 'effect-v5',
			esc_html__( 'effect v6', 'coolstuff' ) => 'effect-v6',
			esc_html__( 'effect v7', 'coolstuff' ) => 'effect-v7',
			esc_html__( 'effect v8', 'coolstuff' ) => 'effect-v8',
			esc_html__( 'effect v9', 'coolstuff' ) => 'effect-v9',
			esc_html__( 'effect v10', 'coolstuff' ) => 'effect-v10',
		),
		'description' => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'coolstuff' ),
	)); 
}
add_action( 'after_setup_theme', 'coolstuff_fnc_add_params', 99 );
 
 /** 
  * Replace pagebuilder columns and rows class by bootstrap classes
  */
function coolstuff_fnc_change_bootstrap_class( $class_string,$tag ){
 
	if ($tag=='vc_column' || $tag=='vc_column_inner') {
		$class_string = preg_replace('/vc_span(\d{1,2})/', 'col-md-$1', $class_string);
		$class_string = preg_replace('/vc_hidden-(\w)/', 'hidden-$1', $class_string);
		$class_string = preg_replace('/vc_col-(\w)/', 'col-$1', $class_string);
		$class_string = str_replace('wpb_column', '', $class_string);
		$class_string = str_replace('vc_column_container', '', $class_string);
		$class_string = str_replace('column_container', '', $class_string);
	}
	return $class_string;
}

add_filter( 'vc_shortcodes_css_class', 'coolstuff_fnc_change_bootstrap_class',10,2);

function coolstuff_fnc_get_instagrams($username, $number = 6) {

	$username = strtolower( $username );
	$username = str_replace( '@', '', $username );

	if ( false === ( $instagram = get_transient( 'instagram-media-5-'.sanitize_title_with_dashes( $username ) ) ) ) {

		$remote = wp_remote_get( 'http://instagram.com/'.trim( $username ) );

		if ( is_wp_error( $remote ) )
			return new WP_Error( 'site_down', esc_html__( 'Unable to communicate with Instagram.', 'coolstuff' ) );

		if ( 200 != wp_remote_retrieve_response_code( $remote ) )
			return new WP_Error( 'invalid_response', esc_html__( 'Instagram did not return a 200.', 'coolstuff' ) );

		$shards = explode( 'window._sharedData = ', $remote['body'] );
		$insta_json = explode( ';</script>', $shards[1] );
		$insta_array = json_decode( $insta_json[0], TRUE );

		if ( ! $insta_array )
			return new WP_Error( 'bad_json', esc_html__( 'Instagram has returned invalid data.', 'coolstuff' ) );

		if ( isset( $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'] ) ) {
			$images = $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
		} else {
			return new WP_Error( 'bad_json_2', esc_html__( 'Instagram has returned invalid data.', 'coolstuff' ) );
		}

		if ( ! is_array( $images ) )
			return new WP_Error( 'bad_array', esc_html__( 'Instagram has returned invalid data.', 'coolstuff' ) );

		$instagram = array();

		foreach ( $images as $image ) {

			$image['thumbnail_src'] = preg_replace( "/^https:/i", "", $image['thumbnail_src'] );
			$image['thumbnail'] = str_replace( 's640x640', 's160x160', $image['thumbnail_src'] );
			$image['small'] = str_replace( 's640x640', 's320x320', $image['thumbnail_src'] );
			$image['large'] = $image['thumbnail_src'];
			$image['display_src'] = preg_replace( "/^https:/i", "", $image['display_src'] );

			if ( $image['is_video'] == true ) {
				$type = 'video';
			} else {
				$type = 'image';
			}

			$caption = esc_html__( 'Instagram Image', 'coolstuff' );
			if ( ! empty( $image['caption'] ) ) {
				$caption = $image['caption'];
			}

			$instagram[] = array(
				'description'   => $caption,
				'link'		  	=> '//instagram.com/p/' . $image['code'],
				'time'		  	=> $image['date'],
				'comments'	  	=> $image['comments']['count'],
				'likes'		 	=> $image['likes']['count'],
				'thumbnail'	 	=> $image['thumbnail'],
				'small'			=> $image['small'],
				'large'			=> $image['large'],
				'original'		=> $image['display_src'],
				'type'		  	=> $type
			);
		}

		// do not set an empty transient - should help catch private or empty accounts
		if ( ! empty( $instagram ) ) {
			$instagram = serialize( $instagram );
			set_transient( 'instagram-media-5-'.sanitize_title_with_dashes( $username ), $instagram, apply_filters( 'null_instagram_cache_time', HOUR_IN_SECONDS*2 ) );
		}
	}

	if ( ! empty( $instagram ) ) {
		$instagram = unserialize( $instagram  );
		return array_slice( $instagram, 0, $number );
	} else {
		return new WP_Error( 'no_images', esc_html__( 'Instagram did not return any images.', 'coolstuff' ) );
	}
}
