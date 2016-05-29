<?php 
/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image except in Multisite signup and activate pages.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since Cool Stuff 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function coolstuff_fnc_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} elseif ( ! in_array( $GLOBALS['pagenow'], array( 'wp-activate.php', 'wp-signup.php' ) ) ) {
		$classes[] = 'masthead-fixed';
	}

	 
	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	$currentSkin = str_replace( '.css','',coolstuff_fnc_theme_options('skin','default') ); 
	
	if( $currentSkin ){
		$class[] = 'skin-'.$currentSkin;
	}

	return $classes;
}
add_filter( 'body_class', 'coolstuff_fnc_body_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Cool Stuff 1.0
 *
 * @global int $paged WordPress archive pagination page count.
 * @global int $page  WordPress paginated post page count.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function coolstuff_fnc_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'coolstuff' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'coolstuff_fnc_wp_title', 10, 2 );

 
/**
 * upbootwp_breadcrumbs function.
 * Edit the standart breadcrumbs to fit the bootstrap style without producing more css
 * @access public
 * @return void
 */
function coolstuff_fnc_breadcrumbs() {

	$delimiter = ' / ';
	$home = 'Home';
	$before = '<li class="active">';
	$after = '</li>';

	if (!is_home() && !is_front_page() || is_paged()) {

		echo '<ol class="breadcrumb">';

		global $post;
		$homeLink = esc_url( home_url() );
		echo '<li><a href="' . ($homeLink) . '">' . $home . '</a> ' . $delimiter . '</li> ';

		if (is_category()) {

			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
			echo trim($before) . single_cat_title('', false) . $after;
			$title = single_cat_title('', false);
		} elseif (is_day()) {
			echo '<li><a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
			echo '<li><a href="' . esc_url( get_month_link(get_the_time('Y'),get_the_time('m')) ) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
			echo trim($before) . get_the_time('d') . $after;
			$title = get_the_time('d');
		} elseif (is_month()) {
			echo '<a href="' . esc_url( get_year_link(get_the_time('Y')) ) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
			echo trim($before) . get_the_time('F') . $after;
			$title = get_the_time('F');
		} elseif (is_year()) {
			echo trim($before) . get_the_time('Y') . $after;
			$title = get_the_time('Y');
		} elseif (is_single() && !is_attachment()) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a href="' . ( $homeLink ) . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
				echo trim($before) . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo trim($before) . get_the_title() . $after;
			}
			$title = get_the_title();
		} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
			$post_type = get_post_type_object(get_post_type());
			if(isset($post_type)){
				echo trim($before) . $post_type->labels->singular_name . $after;
				$title = $post_type->labels->singular_name;
			}
		} elseif (is_attachment()) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			echo '<a href="' . esc_url( get_permalink($parent) ) . '">' . $parent->post_title . '</a></li> ' . $delimiter . ' ';
			echo trim($before) . get_the_title() . $after;
			$title = get_the_title();
		} elseif ( is_page() && !$post->post_parent ) {
			echo trim($before) . get_the_title() . $after;
			$title = get_the_title();

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . esc_url( get_permalink($page->ID) ) . '">' . get_the_title($page->ID) . '</a></li>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo trim($crumb) . ' ' . $delimiter . ' ';
			echo trim($before) . get_the_title() . $after;
			$title = get_the_title();
		} elseif ( is_search() ) {
			echo trim($before) . esc_html__('Search results for "', 'coolstuff' )  . get_search_query() . '"' . $after;
			$title = esc_html__('Search results for "', 'coolstuff' )  . get_search_query();
		} elseif ( is_tag() ) {
			echo trim($before) . esc_html__('Posts tagged "', 'coolstuff'). single_tag_title('', false) . '"' . $after;
			$title = esc_html__('Posts tagged "', 'coolstuff'). single_tag_title('', false);
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo trim($before) . esc_html__('Articles posted by ', 'coolstuff') . $userdata->display_name . $after;
			$title = esc_html__('Articles posted by ', 'coolstuff') . $userdata->display_name;
		} elseif ( is_404() ) {
			echo trim($before) . esc_html__('Error 404', 'coolstuff') . $after;
			$title = esc_html__('Error 404', 'coolstuff');
		}

		// if ( get_query_var('paged') ) {
		// 	if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
		// 	echo '<li>' . esc_html__('Page', 'coolstuff' ) . ' ' . get_query_var('paged');
		// 	if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		// }

		echo '</ol>';
		if(isset($title)){
			echo '<h2>'.$title.'</h2>';
		}
	}
}

 
if(!function_exists('coolstuff_fnc_categories_searchform')){
    function coolstuff_fnc_categories_searchform(){
        if( class_exists('WooCommerce') ){
		global $wpdb;
			$dropdown_args = array(
			    'show_counts'        => false,
			    'hierarchical'       => true,
			    'show_uncategorized' => 0
			);
		?>
		<form method="get" class="input-group search-category" action="<?php echo esc_url( home_url('/') ); ?>"><div class="input-group-addon search-category-container">
		  <div class="select">
		    <?php wc_product_dropdown_categories( $dropdown_args ); ?>
		  </div>
		</div>
		<input name="s" maxlength="60" class="form-control search-category-input" type="text" size="20" placeholder="<?php esc_html_e('What do you need...', 'coolstuff'); ?>"> 

		<div class="input-group-btn">
		    <label class="btn btn-link btn-search">
		      <span class="title-search hidden"><?php esc_html_e('Search', 'coolstuff') ?></span>
		      <input type="submit" class="fa searchsubmit" value="&#xf002;"/>
		    </label>
		    <input type="hidden" name="post_type" value="product"/>
		</div>
		</form>
		<?php
		}else{
			get_search_form();
		}
    }
}