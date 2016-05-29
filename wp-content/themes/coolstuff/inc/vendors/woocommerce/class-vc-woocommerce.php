<?php 
if( class_exists("WPBakeryShortCode") ){
	/**
	 * Class coolstuff_VC_Woocommerces
	 *
	 */
	class Coolstuff_VC_Woocommerce  implements Vc_Vendor_Interface  {

		/**
		 * register and mapping shortcodes
		 */
		

		/**
		 * Since
		 *
		 * @since 4.5.3
		 *
		 * @param $term
		 *
		 * @return array
		 */
		public static function vc_get_term_object( $term ) {
			$vc_taxonomies_types = vc_taxonomies_types();

			return array(
				'label' => $term->name,
				'value' => $term->slug,
				'group_id' => $term->taxonomy,
				'group' => isset( $vc_taxonomies_types[ $term->taxonomy ], $vc_taxonomies_types[ $term->taxonomy ]->labels, $vc_taxonomies_types[ $term->taxonomy ]->labels->name ) ? $vc_taxonomies_types[ $term->taxonomy ]->labels->name : __( 'Taxonomies', 'js_composer' ),
			);
		}

		public function product_category_field_search( $search_string ) {
			$data = array();
			$vc_taxonomies_types = array('product_cat');
			$vc_taxonomies = get_terms( $vc_taxonomies_types, array(
				'hide_empty' => false,
				'search' => $search_string
			) );
			if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
				foreach ( $vc_taxonomies as $t ) {
					if ( is_object( $t ) ) {
						$data[] = self::vc_get_term_object( $t );
					}
				}
			}
			return $data;
		}
		

		public function product_category_render($query) {  
			if( is_numeric($query['value']) ){
				$category = get_term_by('id', (int)$query['value'], 'product_cat');
			}else {
				$category = get_term_by('slug', $query['value'], 'product_cat');
			}	
			if ( ! empty( $query ) && !empty($category)) {
				$data = array();
				$data['value'] = $category->slug;
				$data['label'] = $category->name;
				return ! empty( $data ) ? $data : false;
			}
			return false;
		}

		/**
		 * register and mapping shortcodes
		 */
		public function load(){  

			$shortcodes = array( 'pbr_categoriestabs', 'pbr_products', 'pbr_products_collection', 'pbr_frontcategoryproducts' ); 

			foreach( $shortcodes as $shortcode ){
				add_filter( 'vc_autocomplete_'. $shortcode .'_categories_callback', array($this, 'product_category_field_search'), 10, 1 );
			 	add_filter( 'vc_autocomplete_'. $shortcode .'_categories_render', array($this, 'product_category_render'), 10, 1 );
			}


			$order_by_values = array(
				'',
				esc_html__( 'Date', 'coolstuff' ) => 'date',
				esc_html__( 'ID', 'coolstuff' ) => 'ID',
				esc_html__( 'Author', 'coolstuff' ) => 'author',
				esc_html__( 'Title', 'coolstuff' ) => 'title',
				esc_html__( 'Modified', 'coolstuff' ) => 'modified',
				esc_html__( 'Random', 'coolstuff' ) => 'rand',
				esc_html__( 'Comment count', 'coolstuff' ) => 'comment_count',
				esc_html__( 'Menu order', 'coolstuff' ) => 'menu_order',
			);

			$order_way_values = array(
				'',
				esc_html__( 'Descending', 'coolstuff' ) => 'DESC',
				esc_html__( 'Ascending', 'coolstuff' ) => 'ASC',
			);
			$product_categories_dropdown = array(esc_html__('None', 'coolstuff')=> '' );
			$block_styles = coolstuff_fnc_get_widget_block_styles();
			
			$product_columns_deal = array(1, 2, 3, 4);

			if( is_admin() ){
					$args = array(
						'type' => 'post',
						'child_of' => 0,
						'parent' => '',
						'orderby' => 'name',
						'order' => 'ASC',
						'hide_empty' => false,
						'hierarchical' => 1,
						'exclude' => '',
						'include' => '',
						'number' => '',
						'taxonomy' => 'product_cat',
						'pad_counts' => false,

					);

					$categories = get_categories( $args );
					coolstuff_fnc_woocommerce_getcategorychilds( 0, 0, $categories, 0, $product_categories_dropdown );
					
			}
		    vc_map( array(
		        "name" => esc_html__("PBR Product Deals", 'coolstuff' ),
		        "base" => "pbr_product_deals",
		        "class" => "",
		    	"category" => esc_html__('PBR Woocommerce', 'coolstuff' ),
		    	'description'	=> esc_html__( 'Display Product Sales with Count Down', 'coolstuff' ),
		        "params" => array(
		            array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Title', 'coolstuff' ),
		                "param_name" => "title",
		            ),

		             array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'coolstuff' ),
		                "param_name" => "subtitle",
		            ),

		            array(
		                "type" => "textfield",
		                "heading" => esc_html__("Extra class name", 'coolstuff'),
		                "param_name" => "el_class",
		                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff')
		            ),
		            array(
		                "type" => "textfield",
		                "heading" => esc_html__("Number items to show", 'coolstuff'),
		                "param_name" => "number",
		                'std' => '1',
		                "description" => esc_html__("", 'coolstuff')
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__("Columns count", 'coolstuff' ),
		                "param_name" => "columns_count",
		                "value" => $product_columns_deal,
		                'std' => '2',
		                "description" => esc_html__("Select columns count.", 'coolstuff' )
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__("Layout", 'coolstuff' ),
		                "param_name" => "layout",
		                "value" => array(esc_html__('Carousel', 'coolstuff') => 'carousel', esc_html__('Grid', 'coolstuff') =>'grid' ),
		                "admin_label" => true,
		                "description" => esc_html__("Select columns count.", 'coolstuff' )
		            )
		        )
		    ));
		   

			vc_map( array(
		        "name" => esc_html__("PBR Timing Deals", 'coolstuff' ),
		        "base" => "pbr_timing_deals",
		        "class" => "",
		    	"category" => esc_html__('PBR Woocommerce', 'coolstuff' ),
		    	'description'	=> esc_html__( 'Display Product Sales with Count Down', 'coolstuff' ),
		        "params" => array(
		            array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Title', 'coolstuff' ),
		                "param_name" => "title",
		                "admin_label" => true
		            ),
		             array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'coolstuff' ),
		                "param_name" => "subtitle",
		            ),
		             array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Desciption', 'coolstuff' ),
		                "param_name" => "description",
		                "admin_label" => false
		            ),
		             array(
					    'type' => 'textfield',
					    'heading' => esc_html__( 'End Date', 'coolstuff' ),
					    'param_name' => 'input_datetime',
					    'description' => esc_html__( 'Enter Date Count down', 'coolstuff' ),
					    "value" => ""

					),
		             array(
		                "type" => "dropdown",
		                "heading" => esc_html__("Columns count", 'coolstuff' ),
		                "param_name" => "columns_count",
		                "value" => array(6,5,4,3,2,1),
		                "admin_label" => false,
		                "description" => esc_html__("Select columns count.", 'coolstuff' )
		            ),

		            array(
		                "type" => "textfield",
		                "heading" => esc_html__("Extra class name", 'coolstuff'),
		                "param_name" => "el_class",
		                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff')
		            )

		            
		        )
		    ));
	 
		    //// 
		    vc_map( array(
		        "name" => esc_html__( "PBR Products On Sale", 'coolstuff' ),
		        "base" => "pbr_products_onsale",
		        "class" => "",
		    	"category" => esc_html__( 'PBR Woocommerce', 'coolstuff' ),
		    	'description'	=> esc_html__( 'Display Products Sales With Pagination', 'coolstuff' ),
		        "params" => array(
		            array(
		                "type" 		  => "textfield",
		                "class" 	  => "",
		                "heading" 	  => esc_html__( 'Title', 'coolstuff' ),
		                "param_name"  => "title",
		                "admin_label" => true
		            ),
		             array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'coolstuff' ),
		                "param_name" => "subtitle",
		            ),
		            array(
		                "type" => "textfield",
		                "heading" => esc_html__("Number items to show", 'coolstuff'),
		                "param_name" => "number",
		                'std' => '9',
		                "description" => esc_html__("", 'coolstuff'),
		                  "admin_label" => true
		            ),
		             array(
		                "type" 		  => "dropdown",
		                "heading" 	  => esc_html__( "Columns count", 'coolstuff' ),
		                "param_name"  => "columns_count",
		                "value" 	  => array(6,5,4,3,2,1),
		                "admin_label" => false,
		                "description" => esc_html__( "Select columns count.", 'coolstuff' )
		            ),

		            array(
		                "type" 		  => "textfield",
		                "heading" 	  => esc_html__( "Extra class name", 'coolstuff' ),
		                "param_name"  => "el_class",
		                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff')
		            )
		        )
		    ));
		  
			/**
			 * pbr_productcategory
			 */
		 

			$product_layout = array('Grid'=>'grid','List'=>'list','Carousel'=>'carousel', 'Special'=>'special', 'List-v1' => 'list-v1');
			$product_type = array('Best Selling'=>'best_selling','Featured Products'=>'featured_product','Top Rate'=>'top_rate','Recent Products'=>'recent_product','On Sale'=>'on_sale','Recent Review' => 'recent_review' );
			$product_columns = array(6 ,5 ,4 , 3, 2, 1);
			$show_tab = array(
			                array('recent', esc_html__('Latest Products', 'coolstuff')),
			                array( 'featured_product', esc_html__('Featured Products', 'coolstuff' )),
			                array('best_selling', esc_html__('BestSeller Products', 'coolstuff' )),
			                array('top_rate', esc_html__('TopRated Products', 'coolstuff' )),
			                array('on_sale', esc_html__('Special Products', 'coolstuff' ))
			            );

			vc_map( array(
			    "name" => esc_html__("PBR Product Category", 'coolstuff' ),
			    "base" => "pbr_productcategory",
			    "class" => "",
			 "category" => esc_html__('PBR Woocommerce', 'coolstuff' ),
			     'description'=> esc_html__( 'Show Products In Carousel, Grid, List, Special', 'coolstuff' ), 
			    "params" => array(
			    	array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__('Title', 'coolstuff'),
						"param_name" => "title",
						"value" =>''
					),
					 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'coolstuff' ),
		                "param_name" => "subtitle",
		            ),
			    	array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__('Category', 'coolstuff'),
						"param_name" => "category",
						"value" => $product_categories_dropdown,
						"admin_label" => true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'coolstuff' ),
						"param_name" => "style",
						"value" => $product_layout
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories", 'coolstuff'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'coolstuff' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show", 'coolstuff' ),
						"param_name" => "number",
						"value" => '4'
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Columns count", 'coolstuff' ),
						"param_name" => "columns_count",
						"value" => array(6, 5, 4, 3, 2, 1),
						"admin_label" => true,
						"description" => esc_html__("Select columns count.", 'coolstuff' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Icon", 'coolstuff' ),
						"param_name" => "icon"
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Block Styles", 'coolstuff' ),
						"param_name" => "block_style",
						"value" => $block_styles,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.", 'coolstuff' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'coolstuff' ),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff' )
					)
			   	)
			));
			 
			vc_map( array(
			    "name" => esc_html__("PBR Products Category Index", 'coolstuff' ),
			    "base" => "pbr_productcategory_index",
			    "class" => "",
				 "category" => esc_html__('PBR Woocommerce', 'coolstuff' ),
			     'description'=> esc_html__( 'Show Products In Carousel, Grid, List, Special', 'coolstuff' ), 
			    "params" => array(
			    	array(
						"type" => "textfield",
						"class" => "",
						"heading" => esc_html__('Title', 'coolstuff'),
						"param_name" => "title",
						"value" =>''
					),

					 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'coolstuff' ),
		                "param_name" => "subtitle",
		            ),
			    	array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__('Category', 'coolstuff'),
						"param_name" => "category",
						"value" => $product_categories_dropdown,
						"admin_label" => true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'coolstuff' ),
						"param_name" => "style",
						"value" => $product_layout
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories", 'coolstuff'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'coolstuff' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show", 'coolstuff' ),
						"param_name" => "number",
						"value" => '4'
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Columns count", 'coolstuff' ),
						"param_name" => "columns_count",
						"value" => array(6, 5, 4, 3, 2, 1),
						"admin_label" => true,
						"description" => esc_html__("Select columns count.", 'coolstuff' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Block Styles", 'coolstuff' ),
						"param_name" => "block_style",
						"value" => $block_styles,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.", 'coolstuff' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Icon", 'coolstuff' ),
						"param_name" => "icon",
						'value'	=> 'fa-gear'
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'coolstuff' ),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff' )
					)
			   	)
			));
			 
			/**
			* pbr_category_filter
			*/
		 
			vc_map( array(
					"name"     => esc_html__("PBR Product Categories Filter", 'coolstuff' ),
					"base"     => "pbr_category_filter",
					'description' => esc_html__( 'Show images and links of sub categories in block', 'coolstuff' ),
					"class"    => "",
					"category" => esc_html__('PBR Woocommerce', 'coolstuff' ),
					"params"   => array(

					array(
						"type" => "dropdown",
						"heading" => esc_html__('Category', 'coolstuff'),
						"param_name" => "term_id",
						"value" =>$product_categories_dropdown,	"admin_label" => true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'coolstuff'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Default', 'coolstuff') => '', 
							//esc_html__('style 1', 'coolstuff') => 'style1',
						),
						'std' => ''
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories (190px x 190px)", 'coolstuff'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'coolstuff' )
					),

					array(
						"type"       => "textfield",
						"heading"    => esc_html__("Number of categories to show", 'coolstuff' ),
						"param_name" => "number",
						"value"      => '5',

					),

					array(
						"type"        => "textfield",
						"heading"     => esc_html__("Extra class name", 'coolstuff' ),
						"param_name"  => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff' )
					)
			   	)
			));

			/**
			 * pbr_products
			 */
			vc_map( array(
			    "name" => esc_html__("PBR Products", 'coolstuff' ),
			    "base" => "pbr_products",
			    'description'=> esc_html__( 'Show products as bestseller, featured in block', 'coolstuff' ),
			    "class" => "",
			   "category" => esc_html__('PBR Woocommerce', 'coolstuff' ),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'coolstuff' ),
						"param_name" => "title",
						"admin_label" => true,
						"value" => ''
					),
					 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'coolstuff' ),
		                "param_name" => "subtitle",
		            ),
					array(
					    'type' => 'autocomplete',
					    'heading' => esc_html__( 'Categories', 'coolstuff' ),
					    'value' => '',
					    'param_name' => 'categories',
					    "admin_label" => true,
					    'description' => esc_html__( 'Select Categories', 'coolstuff' ),
					    'settings' => array(
					     	'multiple' => true,
					     	'unique_values' => true
					    ),
				   	),
			    	array(
						"type" => "dropdown",
						"heading" => esc_html__("Type", 'coolstuff' ),
						"param_name" => "type",
						"value" => $product_type,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.", 'coolstuff' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type", 'coolstuff' ),
						"param_name" => "layout_type",
						"value" => $product_layout
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Product Item Style", 'coolstuff' ),
						"param_name" => "item_style",
						"value" => array(
							__('Style 1', 'coolstuff') => 'style1',
							__('Style 2', 'coolstuff') => 'style2',
							__('Style 3', 'coolstuff') => 'style3',
						)
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Columns count", 'coolstuff' ),
						"param_name" => "columns_count",
						"value" => $product_columns,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.", 'coolstuff' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show", 'coolstuff' ),
						"param_name" => "number",
						"value" => '4'
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'coolstuff' ),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff' )
					)
			   	)
			));
			 

			/**
			 * pbr_all_products
			 */
			vc_map( array(
			    "name" => esc_html__("PBR Products Tabs", 'coolstuff' ),
			    "base" => "pbr_tabs_products",
			    'description'	=> esc_html__( 'Display BestSeller, TopRated ... Products In tabs', 'coolstuff' ),
			    "class" => "",
			   "category" => esc_html__('PBR Woocommerce', 'coolstuff' ),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'coolstuff' ),
						"param_name" => "title",
						"value" => ''
					),
					 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'coolstuff' ),
		                "param_name" => "subtitle",
		            ),
					array(
			            "type" => "sorted_list",
			            "heading" => esc_html__("Show Tab", 'coolstuff'),
			            "param_name" => "show_tab",
			            "description" => esc_html__("Control teasers look. Enable blocks and place them in desired order.", 'coolstuff'),
			            "value" => "recent,featured_product,best_selling",
			            "options" => $show_tab
			        ),
			        array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'coolstuff' ),
						"param_name" => "style",
						"value" => $product_layout
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show", 'coolstuff' ),
						"param_name" => "number",
						"value" => '4'
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Columns count", 'coolstuff' ),
						"param_name" => "columns_count",
						"value" => $product_columns,
						"description" => esc_html__("Select columns count.", 'coolstuff' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'coolstuff' ),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff' )
					)
			   	)
			));

			vc_map( array(
				"name"     => esc_html__("PBR Product Categories List", 'coolstuff' ),
				"base"     => "pbr_category_list",
				"class"    => "",
				"category" => esc_html__('PBR Woocommerce', 'coolstuff' ),
				'description' => esc_html__( 'Show Categories as menu Links', 'coolstuff' ),
				"params"   => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => esc_html__('Title', 'coolstuff'),
					"param_name" => "title",
					"value"      => '',
				),
				 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'coolstuff' ),
		                "param_name" => "subtitle",
		            ),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show post counts', 'coolstuff' ),
					'param_name' => 'show_count',
					'description' => esc_html__( 'Enables show count total product of category.', 'coolstuff' ),
					'value' => array( esc_html__( 'Yes, please', 'coolstuff' ) => 'yes' )
				),
				array(
					"type"       => "checkbox",
					"heading"    => esc_html__("show children of the current category", 'coolstuff' ),
					"param_name" => "show_children",
					'description' => esc_html__( 'Enables show children of the current category.', 'coolstuff' ),
					'value' => array( esc_html__( 'Yes, please', 'coolstuff' ) => 'yes' )
				),
				array(
					"type"       => "checkbox",
					"heading"    => esc_html__("Show dropdown children of the current category ", 'coolstuff' ),
					"param_name" => "show_dropdown",
					'description' => esc_html__( 'Enables show dropdown children of the current category.', 'coolstuff' ),
					'value' => array( esc_html__( 'Yes, please', 'coolstuff' ) => 'yes' )
				),

				array(
					"type"        => "textfield",
					"heading"     => esc_html__("Extra class name", 'coolstuff' ),
					"param_name"  => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff' )
				)
		   	)
		));
	 


		/**
		 * pbr_all_products
		 */
		 
		vc_map( array(
				'name' => esc_html__( 'PBR Product categories ', 'coolstuff' ),
				'base' => 'pbr_special_product_categories',
				'icon' => 'icon-wpb-woocommerce',
				'category' => esc_html__( 'PBR Woocommerce', 'coolstuff' ),
				'description' => esc_html__( 'Display product categories in carousel and sub categories', 'coolstuff' ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Per page', 'coolstuff' ),
						'value' => 12,
						'param_name' => 'per_page',
						'description' => esc_html__( 'How much items per page to show', 'coolstuff' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Columns', 'coolstuff' ),
						'value' => 4,
						'param_name' => 'columns',
						'description' => esc_html__( 'How much columns grid', 'coolstuff' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'coolstuff' ),
						'param_name' => 'orderby',
						'value' => $order_by_values,
						'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'coolstuff' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order way', 'coolstuff' ),
						'param_name' => 'order',
						'value' => $order_way_values,
						'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'coolstuff' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Category', 'coolstuff' ),
						'value' => $product_categories_dropdown,
						'param_name' => 'category',
						"admin_label" => true,
						'description' => esc_html__( 'Product category list', 'coolstuff' ),
					),
				)
			) );
	
		/**
		 * pbr_productcats_tabs
		 */
		$sortby = array(
            array('recent_product', esc_html__('Latest Products', 'coolstuff')),
            array('featured_product', esc_html__('Featured Products', 'coolstuff' )),
            array('best_selling', esc_html__('BestSeller Products', 'coolstuff' )),
            array('top_rate', esc_html__('TopRated Products', 'coolstuff' )),
            array('on_sale', esc_html__('Special Products', 'coolstuff' )),
            array('recent_review', esc_html__('Recent Products Reviewed', 'coolstuff' ))
        );
        $layout_type = array(
        	esc_html__('Carousel', 'coolstuff') => 'carousel',
        	esc_html__('Grid', 'coolstuff') => 'grid'
    	);
		vc_map( array(
				'name' => esc_html__( 'PBR Categories Tabs ', 'coolstuff' ),
				'base' => 'pbr_categoriestabs',
				'icon' => 'icon-wpb-woocommerce',
				'category' => esc_html__( 'PBR Woocommerce', 'coolstuff' ),
				'description' => esc_html__( 'Display  categories in Tabs', 'coolstuff' ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Per page', 'coolstuff' ),
						'value' => 12,
						'param_name' => 'per_page',
						'description' => esc_html__( 'How much items per page to show', 'coolstuff' ),
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories (190px x 190px)", 'coolstuff'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'coolstuff' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Columns', 'coolstuff' ),
						'value' => 3,
						'param_name' => 'columns',
						'description' => esc_html__( 'How much columns grid', 'coolstuff' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'coolstuff' ),
						'param_name' => 'sortby',
						'std' => 'recent_product',
						'value' => $sortby,
						'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'coolstuff' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
					    'type' => 'autocomplete',
					    'heading' => esc_html__( 'Categories', 'coolstuff' ),
					    'value' => '',
					    'param_name' => 'categories',
					    "admin_label" => true,
					    'description' => esc_html__( 'Select Categories', 'coolstuff' ),
					    'settings' => array(
					     'multiple' => true,
					     'unique_values' => true,
					     // In UI show results except selected. NB! You should manually check values in backend
					    ),
				   	),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Layout Type', 'coolstuff' ),
						'param_name' => 'layout_type',
						'std' => 'carousel',
						'value' => $layout_type,
						'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'coolstuff' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),

				)
			) );

		
		 
		/**
		 * pbr_productcats_normal
		 */

		vc_map( array(
				'name' => esc_html__( 'Product Categories Style 1 ', 'coolstuff' ),
				'base' => 'pbr_productcats_normal',
				'icon' => 'icon-wpb-woocommerce',
				'category' => esc_html__( 'PBR Woocommerce', 'coolstuff' ),
				'description' => esc_html__( 'Display product categories in carousel and sub categories', 'coolstuff' ),

				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Per page', 'coolstuff' ),
						'value' => 12,
						'param_name' => 'per_page',
						'description' => esc_html__( 'How much items per page to show', 'coolstuff' ),
						
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories (190px x 190px)", 'coolstuff'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'coolstuff' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Float', 'coolstuff' ),
						'param_name' => 'image_float',
						'value' => array( esc_html__('Left', 'coolstuff' ) =>'pull-left', esc_html__('Right', 'coolstuff' ) =>'pull-right' ),
						'description' =>  esc_html__( 'Display banner image on left or right', 'coolstuff' ),
						'std' => 'pull-left'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Columns', 'coolstuff' ),
						'value' => 3,
						'param_name' => 'columns',
						'description' => esc_html__( 'How much columns grid', 'coolstuff' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'coolstuff' ),
						'param_name' => 'orderby',
						'value' => $order_by_values,
						'std' => 'date',
						'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'coolstuff' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order way', 'coolstuff' ),
						'param_name' => 'order',
						'value' => $order_way_values,
						'std' => 'DESC',
						'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'coolstuff' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Category', 'coolstuff' ),
						'value' => $product_categories_dropdown,
						'param_name' => 'category',
						'description' => esc_html__( 'Product category list', 'coolstuff' ),'admin_label'	=> true
					),
					array(
					"type"        => "textfield",
					"heading"     => esc_html__("Extra class name", 'coolstuff' ),
					"param_name"  => "el_class",
					"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff' )
				)
				)
			) );
			
			vc_map( array(
			    "name" => esc_html__("PBR Products Collection", 'coolstuff' ),
			    "base" => "pbr_products_collection",
			    'description'=> esc_html__( 'Show products as bestseller, featured in block', 'coolstuff' ),
			    "class" => "",
			   	"category" => esc_html__('PBR Woocommerce', 'coolstuff' ),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'coolstuff' ),
						"param_name" => "title",
						"admin_label" => true,
						"value" => ''
					),
					 array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'coolstuff' ),
		                "param_name" => "subtitle",
		            ),
					array(
					    'type' => 'autocomplete',
					    'heading' => esc_html__( 'Categories', 'coolstuff' ),
					    'value' => '',
					    'param_name' => 'categories',
					    "admin_label" => true,
					    'description' => esc_html__( 'Select Categories', 'coolstuff' ),
					    'settings' => array(
					     'multiple' => true,
					     'unique_values' => true,
					     // In UI show results except selected. NB! You should manually check values in backend
					    ),
				   	),
			    	array(
						"type" => "dropdown",
						"heading" => esc_html__("Type", 'coolstuff' ),
						"param_name" => "type",
						"value" => $product_type,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.", 'coolstuff' )
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Main Posts", 'coolstuff'),
						"param_name" => "num_mainpost",
						"value" => array( 1 , 2 , 3 , 4 , 5 , 6),
						"std" => 1
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Columns count", 'coolstuff' ),
						"param_name" => "columns_count",
						"value" => $product_columns,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.", 'coolstuff' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show", 'coolstuff' ),
						"param_name" => "number",
						"value" => '4'
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'coolstuff' ),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff' )
					)
			   	)
			));
			
			/**
			 * pbr_products
			 */
			vc_map( array(
			    "name" => esc_html__("PBR Front Products", 'coolstuff' ),
			    "base" => "pbr_frontproducts",
			    'description'=> esc_html__( 'Show products as bestseller, featured in block', 'coolstuff' ),
			    "class" => "",
			   "category" => esc_html__('PBR Woocommerce', 'coolstuff' ),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'coolstuff' ),
						"param_name" => "title",
						"admin_label" => true,
						"value" => ''
					),
					array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'coolstuff' ),
		                "param_name" => "subtitle",
		            ),
					array(
						"type" => "attach_image",
						"heading" => esc_html__("Image", 'coolstuff'),
						"param_name" => "image",
						"value" => '',
						'description'	=> ''
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Image Url", 'coolstuff'),
						"param_name" => "image_url",
						"value" => '',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Alignment', 'coolstuff' ),
						'param_name' => 'image_align',
						'value' => array(
							esc_html__( 'Align left', 'coolstuff' )   => 'pull-left',
							esc_html__( 'Align right', 'coolstuff' )  => 'pull-right'
						),
						'std' => 'pull-right'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Main Products', 'coolstuff' ),
						'param_name' => 'num_mainpost',
						'value' => array(
							esc_html__( '0', 'coolstuff' )  => '0',
							esc_html__( '1', 'coolstuff' )  => '1',
							esc_html__( '2', 'coolstuff' )  => '2',
							esc_html__( '3', 'coolstuff' )  => '3',
							esc_html__( '4', 'coolstuff' )  => '4',
							esc_html__( '5', 'coolstuff' )  => '5',
							esc_html__( '6', 'coolstuff' )  => '6',
						),
						'std' => '0'
					),
					array(
					    'type' => 'autocomplete',
					    'heading' => esc_html__( 'Categories', 'coolstuff' ),
					    'value' => '',
					    'param_name' => 'categories',
					    "admin_label" => true,
					    'description' => esc_html__( 'Select Categories', 'coolstuff' ),
					    'settings' => array(
					     	'multiple' => true,
					     	'unique_values' => true
					    ),
				   	),
			    	array(
						"type" => "dropdown",
						"heading" => esc_html__("Type", 'coolstuff' ),
						"param_name" => "type",
						"value" => $product_type,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.", 'coolstuff' )
					),
					// array(
					// 	"type" => "dropdown",
					// 	"heading" => esc_html__("Style", 'coolstuff' ),
					// 	"param_name" => "style",
					// 	"value" => $product_layout
					// ),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Columns count", 'coolstuff' ),
						"param_name" => "columns_count",
						"value" => $product_columns,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.", 'coolstuff' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show", 'coolstuff' ),
						"param_name" => "number",
						"value" => '4'
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'coolstuff' ),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff' )
					)
			   	)
			));

		/**
		 * pbr_productcats_tabs
		 */
		vc_map( array(
				'name' => esc_html__( 'PBR Product Categories Tabs ', 'coolstuff' ),
				'base' => 'pbr_productcats_tabs',
				'icon' => 'icon-wpb-woocommerce',
				'class' => '',
				'category' => esc_html__( 'PBR Woocommerce', 'coolstuff' ),
				'description' => esc_html__( 'Display product categories in carousel and sub categories', 'coolstuff' ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Per page', 'coolstuff' ),
						'value' => 12,
						'param_name' => 'per_page',
						'description' => esc_html__( 'How much items per page to show', 'coolstuff' ),
					),
					array(
						"type"        => "attach_image",
						"description" => esc_html__("Upload an image for categories (190px x 190px)", 'coolstuff'),
						"param_name"  => "image_cat",
						"value"       => '',
						'heading'     => esc_html__('Image', 'coolstuff' )
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Columns', 'coolstuff' ),
						'value' => 3,
						'param_name' => 'columns',
						'description' => esc_html__( 'How much columns grid', 'coolstuff' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order by', 'coolstuff' ),
						'param_name' => 'orderby',
						'std' => 'date',
						'value' => $order_by_values,
						'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'coolstuff' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Order way', 'coolstuff' ),
						'param_name' => 'order',
						'std' => 'DESC',
						'value' => $order_way_values,
						'description' => sprintf( esc_html__( 'Designates the ascending or descending order. More at %s.', 'coolstuff' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Category', 'coolstuff' ),
						'value' => $product_categories_dropdown,
						"admin_label" => true,
						'param_name' => 'category',
						'description' => esc_html__( 'Product category list', 'coolstuff' ),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Layout Type', 'coolstuff' ),
						'param_name' => 'layout_type',
						'std' => 'carousel',
						'value' => $layout_type,
						'description' => sprintf( esc_html__( 'Select how to sort retrieved products. More at %s.', 'coolstuff' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
					),
				)
			) );
			
			/**
			 * pbr_products
			 */
			vc_map( array(
			    "name" => esc_html__("PBR Front Category Products ", 'coolstuff' ),
			    "base" => "pbr_frontcategoryproducts",
			    'description'=> esc_html__( 'Show products by category in block', 'coolstuff' ),
			    "class" => "",
			   	"category" => esc_html__('PBR Woocommerce', 'coolstuff' ),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'coolstuff' ),
						"param_name" => "title",
						"admin_label" => true,
						"value" => ''
					),
					array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Sub Title', 'coolstuff' ),
		                "param_name" => "subtitle",
		            ),
		            array(
						"type" => "dropdown",
						"heading" => esc_html__("Title Style", 'coolstuff' ),
						"param_name" => "title_style",
						"value" => array(
							esc_html__('Light Blue', 'coolstuff') => 'light_blue',
							esc_html__('Yellow', 'coolstuff') => 'yellow',
							esc_html__('Pink', 'coolstuff') => 'pink',
						)
					),
		            array(
					    'type' => 'autocomplete',
					    'heading' => esc_html__( 'Categories', 'coolstuff' ),
					    'value' => '',
					    'param_name' => 'categories',
					    "admin_label" => true,
					    'description' => esc_html__( 'Select Categories', 'coolstuff' ),
					    'settings' => array(
					     	'multiple' => false,
					     	'unique_values' => true
					    ),
				   	),
					array(
						"type" => "attach_image",
						"heading" => esc_html__("Image", 'coolstuff'),
						"param_name" => "image",
						"value" => '',
						'description'	=> ''
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Image Url", 'coolstuff'),
						"param_name" => "image_url",
						"value" => '',
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Image Alignment', 'coolstuff' ),
						'param_name' => 'image_align',
						'value' => array(
							esc_html__( 'Align left', 'coolstuff' )   => 'pull-left',
							esc_html__( 'Align right', 'coolstuff' )  => 'pull-right'
						),
						'std' => 'pull-right'
					),
			    	array(
						"type" => "dropdown",
						"heading" => esc_html__("Type", 'coolstuff' ),
						"param_name" => "type",
						"value" => $product_type,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.", 'coolstuff' )
					),
					
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Columns count", 'coolstuff' ),
						"param_name" => "columns_count",
						"value" => $product_columns,
						"admin_label" => true,
						"description" => esc_html__("Select columns count.", 'coolstuff' )
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number of products to show", 'coolstuff' ),
						"param_name" => "number",
						"value" => '4'
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type", 'coolstuff' ),
						"param_name" => "layout_type",
						"value" => array(
							esc_html__('Layout 1 (Image banner)', 'coolstuff' ) => 'layout1',
							esc_html__('Layout 2 (Left title, products grid)', 'coolstuff' ) => 'layout2',
							esc_html__('Layout 3 (Right title, products special1)', 'coolstuff' ) => 'layout3',
							esc_html__('Layout 4 (Left title, products special2)', 'coolstuff' ) => 'layout4',
						)
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'coolstuff' ),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'coolstuff' )
					)
			   	)
			));
		}
	}	

	/**
	  * Register Woocommerce Vendor which will register list of shortcodes
	  */
	function coolstuff_fnc_init_vc_woocommerce_vendor(){

		$vendor = new Coolstuff_VC_Woocommerce();
		add_action( 'vc_after_set_mode', array(
			$vendor,
			'load'
		) );

	}
	add_action( 'after_setup_theme', 'coolstuff_fnc_init_vc_woocommerce_vendor' , 9 );   
}		