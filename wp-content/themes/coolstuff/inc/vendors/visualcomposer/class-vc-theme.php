<?php 

class Coolstuff_VC_Theme implements Vc_Vendor_Interface {

	public function load(){
		/*********************************************************************************************************************
		 *  Vertical menu
		 *********************************************************************************************************************/
		$option_menu  = array(); 
		if( is_admin() ){
			$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );
		    $option_menu = array('---Select Menu---'=>'');
		    foreach ($menus as $menu) {
		    	$option_menu[$menu->name]=$menu->term_id;
		    }
		}    
		vc_map( array(
		    "name" => esc_html__("PBR Quick Links Menu", 'coolstuff' ),
		    "base" => "pbr_quicklinksmenu",
		    "class" => "",
		    "category" => esc_html__('PBR Widgets', 'coolstuff'),
		    'description'	=> esc_html__( 'Show Quick Links To Access', 'coolstuff'),
		    "params" => array(
		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'coolstuff'),
					"param_name" => "title",
					"value" => 'Quick To Go'
				),
		    	array(
					"type" => "dropdown",
					"heading" => esc_html__("Menu", 'coolstuff'),
					"param_name" => "menu",
					"value" => $option_menu,
					"description" => esc_html__("Select menu.", 'coolstuff')
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
		 *  Vertical menu
		 *********************************************************************************************************************/
	 
		vc_map( array(
		    "name" => esc_html__("PBR Vertical MegaMenu", 'coolstuff' ),
		    "base" => "pbr_verticalmenu",
		    "class" => "",
		    "category" => esc_html__('PBR Widgets', 'coolstuff'),
		    "params" => array(

		    	array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'coolstuff'),
					"param_name" => "title",
					"value" => 'Vertical Menu',
					"admin_label"	=> true
				),

		    	array(
					"type" => "dropdown",
					"heading" => esc_html__("Menu", 'coolstuff'),
					"param_name" => "menu",
					"value" => $option_menu,
					"description" => esc_html__("Select menu.", 'coolstuff')
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Position", 'coolstuff'),
					"param_name" => "postion",
					"value" => array(
							'left'=>'left',
							'right'=>'right'
						),
					'std' => 'left',
					"description" => esc_html__("Postion Menu Vertical.", 'coolstuff')
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'coolstuff'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff')
				)
		   	)
		));
		 
		vc_map( array(
		    "name" => esc_html__("Fixed Show Vertical Menu ", 'coolstuff' ),
		    "base" => "pbr_verticalmenu_show",
		    "class" => "",
		    "category" => esc_html__('PBR Widgets', 'coolstuff'),
		    "description" => esc_html__( 'Always showing vertical menu on top', 'coolstuff' ),
		    "params" => array(
		  
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", 'coolstuff'),
					"param_name" => "title",
					"description" => esc_html__("When enabled vertical megamenu widget on main navition and its menu content will be showed by this module. This module will work with header:Martket, Market-V2, Market-V3" , 'coolstuff')
				)
		   	)
		));
	 

		/******************************
		 * Our Team
		 ******************************/
		vc_map( array(
		    "name" => esc_html__("PBR Our Team Grid Style", 'coolstuff' ),
		    "base" => "pbr_team",
		    "class" => "",
		    "description" => 'Show Personal Profile Info',
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
					"type" => "attach_image",
					"heading" => esc_html__("Photo", 'coolstuff'),
					"param_name" => "photo",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Job", 'coolstuff'),
					"param_name" => "job",
					"value" => 'CEO',
					'description'	=>  ''
				),

				array(
					"type" => "textarea",
					"heading" => esc_html__("information", 'coolstuff'),
					"param_name" => "information",
					"value" => '',
					'description'	=> esc_html__('Allow  put html tags', 'coolstuff')
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Phone", 'coolstuff'),
					"param_name" => "phone",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Google Plus", 'coolstuff'),
					"param_name" => "google",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Facebook", 'coolstuff'),
					"param_name" => "facebook",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Twitter", 'coolstuff'),
					"param_name" => "twitter",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Pinterest", 'coolstuff'),
					"param_name" => "pinterest",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Linked In", 'coolstuff'),
					"param_name" => "linkedin",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "dropdown",
					"heading" => esc_html__("Style", 'coolstuff'),
					"param_name" => "style",
					'value' 	=> array( 'circle' => esc_html__('circle', 'coolstuff'), 'vertical' => esc_html__('vertical', 'coolstuff') , 'horizontal' => esc_html__('horizontal', 'coolstuff') ),
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'coolstuff'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff')
				)
		   	)
		));
	 
		/******************************
		 * Our Team
		 ******************************/
		vc_map( array(
			"name" => esc_html__("PBR Our Team List Style", 'coolstuff' ),
			"base" => "pbr_team_list",
			"class" => "",
			"description" => esc_html__('Show Info In List Style', 'coolstuff'),
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
					"type" => "attach_image",
					"heading" => esc_html__("Photo", 'coolstuff'),
					"param_name" => "photo",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Phone", 'coolstuff'),
					"param_name" => "phone",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Job", 'coolstuff'),
					"param_name" => "job",
					"value" => 'CEO',
					'description'	=>  ''
				),
				array(
					"type" => "textarea_html",
					"heading" => esc_html__("Information", 'coolstuff'),
					"param_name" => "content",
					"value" => '',
					'description'	=> esc_html__('Allow  put html tags', 'coolstuff')
				),
				array(
					"type" => "textarea",
					"heading" => esc_html__("Blockquote", 'coolstuff'),
					"param_name" => "blockquote",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Email", 'coolstuff'),
					"param_name" => "email",
					"value" => '',
					'description'	=> ''
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Facebook", 'coolstuff'),
					"param_name" => "facebook",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Twitter", 'coolstuff'),
					"param_name" => "twitter",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "textfield",
					"heading" => esc_html__("Linked In", 'coolstuff'),
					"param_name" => "linkedin",
					"value" => '',
					'description'	=> ''
				),

				array(
					"type" => "dropdown",
					"heading" => esc_html__("Style", 'coolstuff'),
					"param_name" => "style",
					'value' 	=> array( 'circle' => esc_html__('circle', 'coolstuff'), 'vertical' => esc_html__('vertical', 'coolstuff') , 'horizontal' => esc_html__('horizontal', 'coolstuff') ),
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Extra class name", 'coolstuff'),
					"param_name" => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff')
				)

		   	)
		));
	 
		
	 

		/* Heading Text Block
		---------------------------------------------------------- */
		vc_map( array(
			'name'        => esc_html__( 'PBR Widget Heading', 'coolstuff' ),
			'base'        => 'pbr_title_heading',
			"class"       => "",
			"category" => esc_html__('PBR Widgets', 'coolstuff'),
			'description' => esc_html__( 'Create title for one Widget', 'coolstuff' ),
			"params"      => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Widget title', 'coolstuff' ),
					'param_name' => 'title',
					'value'       => esc_html__( 'Title', 'coolstuff' ),
					'description' => esc_html__( 'Enter heading title.', 'coolstuff' ),
					"admin_label" => true
				),
				array(
				    'type' => 'colorpicker',
				    'heading' => esc_html__( 'Title Color', 'coolstuff' ),
				    'param_name' => 'font_color',
				    'description' => esc_html__( 'Select font color', 'coolstuff' )
				),
				 
				array(
					"type" => "textarea",
					'heading' => esc_html__( 'Description', 'coolstuff' ),
					"param_name" => "descript",
					"value" => '',
					'description' => esc_html__( 'Enter description for title.', 'coolstuff' )
			    ),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'coolstuff' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'coolstuff' )
				)
			),
		));
		
		/* Heading Text Block
		---------------------------------------------------------- */
		vc_map( array(
			'name'        => esc_html__( 'PBR Banner', 'coolstuff' ),
			'base'        => 'pbr_banner_countdown',
			"class"       => "",
			"category" => esc_html__('PBR Widgets', 'coolstuff'),
			'description' => esc_html__( 'Show CountDown with banner', 'coolstuff' ),
			"params"      => array(				
				array(
					"type" => "attach_image",
					"description" => esc_html__("If you upload an image, icon will not show.", 'coolstuff'),
					"param_name" => "image",
					"value" => '',
					'heading'	=> esc_html__('Image', 'coolstuff' )
				),				 
				array(
					"type" => "textarea_html",
					'heading' => esc_html__( 'Description', 'coolstuff' ),
					"param_name" => "content",
					"value" => '',
					'description' => esc_html__( 'Enter description for title.', 'coolstuff' )
			    ),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'coolstuff' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'coolstuff' )
				)
			),
		));
	}
}