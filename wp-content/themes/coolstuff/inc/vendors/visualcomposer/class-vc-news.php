<?php 
class Coolstuff_VC_News implements Vc_Vendor_Interface  {
	
	public function load(){
		 
		$newssupported = true; 
 
			/**********************************************************************************
			 * Front Page Posts
			 **********************************************************************************/
			// front page 2
			vc_map( array(
				'name' => esc_html__( '(News) FrontPage 2', 'coolstuff' ),
				'base' => 'pbr_frontpageposts2',
				'icon' => 'icon-wpb-news-8',
				"category" => esc_html__('PBR News', 'coolstuff'),
				'description' => esc_html__( 'Create Post having blog styles', 'coolstuff' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'coolstuff' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'coolstuff' ),
						"admin_label" => true
					),

					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'coolstuff' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'coolstuff' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Main Posts", 'coolstuff'),
						"param_name" => "num_mainpost",
						"value" => array( 1 , 2 , 3 , 4 , 5 , 6),
						"std" => 1
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'coolstuff' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'coolstuff' ),
						'value' => array( esc_html__( 'Yes, please', 'coolstuff' ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'coolstuff' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'coolstuff' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'coolstuff' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'coolstuff' )
					)
				)
			) );
			// front page 3
			vc_map( array(
				'name' => esc_html__( '(News) FrontPage 3', 'coolstuff' ),
				'base' => 'pbr_frontpageposts3',
				'icon' => 'icon-wpb-news-3',
				"category" => esc_html__('PBR News', 'coolstuff'),
				'description' => esc_html__( 'Create Post having blog styles', 'coolstuff' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'coolstuff' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'coolstuff' ),
						"admin_label" => true
					),

					 

					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'coolstuff' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'coolstuff' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Main Posts", 'coolstuff'),
						"param_name" => "num_mainpost",
						"value" => array( 1 , 2 , 3 , 4 , 5 , 6),
						"std" => 1
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'coolstuff' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'coolstuff' ),
						'value' => array( esc_html__( 'Yes, please', 'coolstuff' ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'coolstuff' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'coolstuff' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'coolstuff' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'coolstuff' )
					)
				)
			) );
			
		vc_map( array(
				'name' => esc_html__( '(News) Categories Post', 'coolstuff' ),
				'base' => 'pbr_categoriespost',
				'icon' => 'icon-wpb-news-3',
				"category" => esc_html__('PBR News', 'coolstuff'),
				'description' => esc_html__( 'Create Post having blog styles', 'coolstuff' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'coolstuff' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'coolstuff' ),
						"admin_label" => true
					),

					 

					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'coolstuff' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'coolstuff' )
					),
					 

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'coolstuff' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'coolstuff' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'coolstuff' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'coolstuff' )
					)
				)
			) );	

		// front page 9
			vc_map( array(
				'name' => esc_html__( '(News) FrontPage 9', 'coolstuff' ),
				'base' => 'pbr_frontpageposts9',
				'icon' => 'icon-wpb-news-9',
				"category" => esc_html__('PBR News', 'coolstuff'),
				'description' => esc_html__( 'Create Post having blog styles', 'coolstuff' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'coolstuff' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'coolstuff' ),
						"admin_label" => true
					),
 
					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'coolstuff' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'coolstuff' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Grid Columns", 'coolstuff'),
						"param_name" => "grid_columns",
						"value" => array( 1 , 2 , 3 , 4 , 5 , 6),
						"std" => 1
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'coolstuff' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'coolstuff' ),
						'value' => array( esc_html__( 'Yes, please', 'coolstuff' ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'coolstuff' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'coolstuff' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'coolstuff' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'coolstuff' )
					)
				)
			) );

			// front page 3
			vc_map( array(
				'name' => esc_html__( '(Blog) TimeLine Post', 'coolstuff' ),
				'base' => 'pbr_timelinepost',
				'icon' => 'icon-wpb-news-10',
				"category" => esc_html__('PBR News', 'coolstuff'),
				'description' => esc_html__( 'Create Post having blog styles', 'coolstuff' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'coolstuff' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'coolstuff' ),
						"admin_label" => true
					),
 
					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'coolstuff' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'coolstuff' )
					),					 

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'coolstuff' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'coolstuff' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'coolstuff' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'coolstuff' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Enable Pagination', 'coolstuff' ),
						'param_name' => 'pagination',
						'value' => array( 'No'=>'0', 'Yes'=>'1'),
						'std' => '0',
						'admin_label' => true,
						'description' => esc_html__( 'Select style display.', 'coolstuff' )
					)
				)
			) );

			/****/
			vc_map( array(
				'name' => esc_html__( '(News) Categories Tab Post', 'coolstuff' ),
				'base' => 'pbr_categorytabpost',
				'icon' => 'icon-wpb-application-icon-large',
				"category" => esc_html__('PBR News', 'coolstuff'),
				'description' => esc_html__( 'Create Post having blog styles', 'coolstuff' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'coolstuff' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'coolstuff' ),
						"admin_label" => true
					),
					 
					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'coolstuff' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'coolstuff' )
					),

					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Main Posts", 'coolstuff'),
						"param_name" => "num_mainpost",
						"value" => array( 1 , 2 , 3 , 4 , 5 , 6),
						"std" => 1
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'coolstuff' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'coolstuff' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'coolstuff' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'coolstuff' )
					)
				)
			) );
			
			$layout_image = array(
				esc_html__('Grid', 'coolstuff')             => 'grid-1',
				esc_html__('List', 'coolstuff')             => 'list-1',
				esc_html__('List not image', 'coolstuff')   => 'list-2',
			);
			
			vc_map( array(
				'name' => esc_html__( '(News) Grid Posts', 'coolstuff' ),
				'base' => 'pbr_gridposts',
				'icon' => 'icon-wpb-news-2',
				"category" => esc_html__('PBR News', 'coolstuff'),
				'description' => esc_html__( 'Post having news,managzine style', 'coolstuff' ),
			 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'coolstuff' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'coolstuff' ),
						"admin_label" => true
					),
				 
					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'coolstuff' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'coolstuff' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type", 'coolstuff'),
						"param_name" => "layout",
						"layout_images" => $layout_image,
						"value" => $layout_image,
						"admin_label" => true,
						"description" => esc_html__("Select Skin layout.", 'coolstuff')
					),

					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'coolstuff' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'coolstuff' ),
						'value' => array( esc_html__( 'Yes, please', 'coolstuff' ) => 'yes' )
					),

					array(
						"type" => "dropdown",
						"heading" => esc_html__("Grid Columns", 'coolstuff'),
						"param_name" => "grid_columns",
						"value" => array( 1 , 2 , 3 , 4 , 6),
						"std" => 3
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'coolstuff' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'coolstuff' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'coolstuff' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'coolstuff' )
					)
				)
			) );
			
			/**********************************************************************************
			 * Mega Blogs
			 **********************************************************************************/

			/// Front Page 1
			vc_map( array(
				'name' => esc_html__( '(Blog) FrontPage', 'coolstuff' ),
				'base' => 'pbr_frontpageblog',
				'icon' => 'icon-wpb-news-1',
				"category" => esc_html__('PBR News', 'coolstuff'),
				'description' => esc_html__( 'Create Post having blog styles', 'coolstuff' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'coolstuff' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'coolstuff' ),
						"admin_label" => true
					),
					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'coolstuff' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'coolstuff' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Main Posts", 'coolstuff'),
						"param_name" => "num_mainpost",
						"value" => array( 1 , 2 , 3 , 4 , 5 , 6),
						"std" => 1
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'coolstuff' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'coolstuff' ),
						'value' => array( esc_html__( 'Yes, please', 'coolstuff' ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'coolstuff' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'coolstuff' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'coolstuff' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'coolstuff' )
					)
				)
			) );

			vc_map( array(
				'name' => esc_html__('(Blog) Grids ', 'coolstuff' ),
				'base' => 'pbr_megablogs',
				'icon' => 'icon-wpb-news-2',
				"category" => esc_html__('PBR News', 'coolstuff'),
				'description' => esc_html__( 'Create Post having blog styles', 'coolstuff' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'coolstuff' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'coolstuff' ),
						"admin_label" => true
					),

					array(
						'type' => 'textarea',
						'heading' => esc_html__( 'Description', 'coolstuff' ),
						'param_name' => 'descript',
						"value" => ''
					),

					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'coolstuff' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 10 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'coolstuff' )
					),
					
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout", 'coolstuff' ),
						"param_name" => "layout",
						"value" => array( esc_html__('Default Style', 'coolstuff' ) => 'blog' , esc_html__('Default Style 2', 'coolstuff' ) => 'blog-v2'  ,  esc_html__('Special Style 1', 'coolstuff' ) => 'special-1',  esc_html__('Special Style 2', 'coolstuff' ) => 'special-2',  esc_html__('Special Style 3', 'coolstuff' ) => 'special-3' ),
						"std" => 3,
						'admin_label'=> true
					),

					array(
						"type" => "dropdown",
						"heading" => esc_html__("Grid Columns", 'coolstuff'),
						"param_name" => "grid_columns",
						"value" => array( 1 , 2 , 3 , 4 , 6),
						"std" => 3
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'coolstuff' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'coolstuff' ),
						'value' => array( esc_html__( 'Yes, please', 'coolstuff' ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'coolstuff' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'coolstuff' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'coolstuff' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'coolstuff' )
					)
				)
			) );

			// front page 3
			vc_map( array(
				'name' => esc_html__( 'List Posts', 'coolstuff' ),
				'base' => 'pbr_listposts',
				"category" => esc_html__('PBR News', 'coolstuff'),
				'description' => esc_html__( 'Create Post having blog styles', 'coolstuff' ),
				 
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'coolstuff' ),
						'param_name' => 'title',
						'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'coolstuff' ),
						"admin_label" => true
					),

					array(
						'type' => 'loop',
						'heading' => esc_html__( 'Grids content', 'coolstuff' ),
						'param_name' => 'loop',
						'settings' => array(
							'size' => array( 'hidden' => false, 'value' => 4 ),
							'order_by' => array( 'value' => 'date' ),
						),
						'description' => esc_html__( 'Create WordPress loop, to populate content from your site.', 'coolstuff' )
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination Links', 'coolstuff' ),
						'param_name' => 'show_pagination',
						'description' => esc_html__( 'Enables to show paginations to next new page.', 'coolstuff' ),
						'value' => array( esc_html__( 'Yes, please', 'coolstuff' ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Thumbnail size', 'coolstuff' ),
						'param_name' => 'thumbsize',
						'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'coolstuff' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'coolstuff' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'coolstuff' )
					)
				)
			) );
	}
}