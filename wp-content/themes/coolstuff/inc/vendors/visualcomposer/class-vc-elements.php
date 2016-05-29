<?php 

class Coolstuff_VC_Elements implements Vc_Vendor_Interface {

	public function load(){ 
		
		/*********************************************************************************************************************
		 *  Our Service
		 *********************************************************************************************************************/
		vc_map( array(
		    "name" => esc_html__("PBR Featured Box", 'coolstuff' ),
		    "base" => "pbr_featuredbox",
		
		    "description"=> esc_html__('Decreale Service Info', 'coolstuff'),
		    "class" => "",
		    "category" => esc_html__('PBR Widgets', 'coolstuff'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'coolstuff'),
					"param_name" => "title",
					"value" => '',    "admin_label" => true,
				),
				array(
				    'type' => 'colorpicker',
				    'heading' => esc_html__( 'Title Color', 'coolstuff' ),
				    'param_name' => 'title_color',
				    'description' => esc_html__( 'Select font color', 'coolstuff' )
				),

		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Sub Title", 'coolstuff'),
					"param_name" => "subtitle",
					"value" => '',
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Style", 'coolstuff'),
					"param_name" => "style",
					'value' 	=> array(
						esc_html__('Default', 'coolstuff') => '', 
						esc_html__('Version 1', 'coolstuff') => 'v1', 
						esc_html__('Version 2', 'coolstuff') => 'v2', 
						esc_html__('Version 3', 'coolstuff' )=> 'v3',
						esc_html__('Version 4', 'coolstuff') => 'v4'
					),
					'std' => ''
				),

				array(
					'type'                           => 'dropdown',
					'heading'                        => esc_html__( 'Title Alignment', 'coolstuff' ),
					'param_name'                     => 'title_align',
					'value'                          => array(
					esc_html__( 'Align left', 'coolstuff' )   => 'separator_align_left',
					esc_html__( 'Align center', 'coolstuff' ) => 'separator_align_center',
					esc_html__( 'Align right', 'coolstuff' )  => 'separator_align_right'
					),
					'std' => 'separator_align_left'
				),

			 	array(
					"type" => "textfield",
					"heading" => esc_html__("FontAwsome Icon", 'coolstuff'),
					"param_name" => "icon",
					"value" => 'fa fa-gear',
					'description'	=> esc_html__( 'This support display icon from FontAwsome, Please click', 'coolstuff' )
									. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fortawesome.github.io/Font-Awesome/" target="_blank">'
									. esc_html__( 'here to see the list', 'coolstuff' ) . '</a>'
				),
				array(
				    'type' => 'colorpicker',
				    'heading' => esc_html__( 'Icon Color', 'coolstuff' ),
				    'param_name' => 'color',
				    'description' => esc_html__( 'Select font color', 'coolstuff' )
				),	
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Background Icon', 'coolstuff' ),
					'param_name' => 'background',
					'value' => array(
						esc_html__( 'None', 'coolstuff' ) => 'nostyle',
						esc_html__( 'Success', 'coolstuff' ) => 'bg-success',
						esc_html__( 'Info', 'coolstuff' ) => 'bg-info',
						esc_html__( 'Danger', 'coolstuff' ) => 'bg-danger',
						esc_html__( 'Warning', 'coolstuff' ) => 'bg-warning',
						esc_html__( 'Light', 'coolstuff' ) => 'bg-default',
					),
					'std' => 'nostyle',
				),

				array(
					"type" => "attach_image",
					"heading" => esc_html__("Photo", 'coolstuff'),
					"param_name" => "photo",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textarea",
					"heading" => esc_html__("information", 'coolstuff'),
					"param_name" => "information",
					"value" => 'Your Description Here',
					'description'	=> esc_html__('Allow  put html tags', 'coolstuff' )
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'coolstuff'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff')
				)
		   	)
		));
		 
	   	/*********************************************************************************************************************
		 * Pricing Table
		 *********************************************************************************************************************/
		vc_map( array(
		    "name" => esc_html__("PBR Pricing", 'coolstuff' ),
		    "base" => "pbr_pricing",
		    "description" => esc_html__('Make Plan for membership', 'coolstuff' ),
		    "class" => "",
		    "category" => esc_html__('PBR Widgets', 'coolstuff'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'coolstuff'),
					"param_name" => "title",
					"value" => '',
						"admin_label" => true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Price", 'coolstuff'),
					"param_name" => "price",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Currency", 'coolstuff'),
					"param_name" => "currency",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Period", 'coolstuff'),
					"param_name" => "period",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle", 'coolstuff'),
					"param_name" => "subtitle",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Is Featured", 'coolstuff'),
					"param_name" => "featured",
					'value' 	=> array(  esc_html__('No', 'coolstuff') => 0,  esc_html__('Yes', 'coolstuff') => 1 ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Skin", 'coolstuff'),
					"param_name" => "skin",
					'value' 	=> array(  esc_html__('Skin 1', 'coolstuff') => 'v1',  esc_html__('Skin 2', 'coolstuff') => 'v2', esc_html__('Skin 3', 'coolstuff') => 'v3' ),
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Box Style", 'coolstuff'),
					"param_name" => "style",
					'value' 	=> array( 'boxed' => esc_html__('Boxed', 'coolstuff')),
				),

				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Content", 'coolstuff'),
					"param_name" => "content",
					"value" => '',
					'description'	=> esc_html__('Allow  put html tags', 'coolstuff')
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Link Title", 'coolstuff'),
					"param_name" => "linktitle",
					"value" => 'SignUp',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Link", 'coolstuff'),
					"param_name" => "link",
					"value" => 'http://yourdomain.com',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'coolstuff'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff')
				)
		   	)
		));
 		

 		/*********************************************************************************************************************
		 *  PBR Counter
		 *********************************************************************************************************************/
		vc_map( array(
		    "name" => esc_html__("PBR Counter", 'coolstuff' ),
		    "base" => "pbr_counter",
		    "class" => "",
		    "description"=> esc_html__('Counting number with your term', 'coolstuff'),
		    "category" => esc_html__('PBR Widgets', 'coolstuff'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'coolstuff'),
					"param_name" => "title",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Description", 'coolstuff'),
					"param_name" => "description",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Number", 'coolstuff'),
					"param_name" => "number",
					"value" => ''
				),

			 	array(
					"type" => "textfield",
					"heading" => esc_html__("FontAwsome Icon", 'coolstuff'),
					"param_name" => "icon",
					"value" => '',
					'description'	=> esc_html__( 'This support display icon from FontAwsome, Please click', 'coolstuff' )
									. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fortawesome.github.io/Font-Awesome/" target="_blank">'
									. esc_html__( 'here to see the list', 'coolstuff' ) . '</a>'
				),


				array(
					"type" => "attach_image",
					"description" => esc_html__("If you upload an image, icon will not show.", 'coolstuff'),
					"param_name" => "image",
					"value" => '',
					'heading'	=> esc_html__('Image', 'coolstuff' )
				),

		 

				array(
					"type" => "colorpicker",
					"heading" => esc_html__("Text Color", 'coolstuff'),
					"param_name" => "text_color",
					'value' 	=> '',
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'coolstuff'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff')
				)
		   	)
		));
		$sizes = array(
			__('Thumbnail', 'coolstuff') => 'thumbnail',
			__('Small', 'coolstuff') => 'small',
			__('Large', 'coolstuff') => 'large',
			__('Original', 'coolstuff') => 'original'
		);
		$targets = array(
			__('Same window', 'coolstuff') => '_self',
			__('New Window', 'coolstuff') => '_blank'
		);
		vc_map( array(
		    "name" => esc_html__("PBR Instagam", 'coolstuff' ),
		    "base" => "pbr_instagram",
		    "class" => "",
		    "description"=> esc_html__('Show instagram images', 'coolstuff'),
		    "category" => esc_html__('PBR Widgets', 'coolstuff'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'coolstuff'),
					"param_name" => "title",
					"value" => '',
					"admin_label"	=> true
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Username", 'coolstuff'),
					"param_name" => "username",
					"value" => ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Number", 'coolstuff'),
					"param_name" => "number",
					"value" => ''
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Image Size", 'coolstuff'),
					"param_name" => "size",
					"value" => $sizes
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Open link?", 'coolstuff'),
					"param_name" => "target",
					"value" => $targets
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Follow Text", 'coolstuff'),
					"param_name" => "follow_text",
					"value" => 'Follow me'
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'coolstuff'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff')
				)
		   	)
		));
	}
}