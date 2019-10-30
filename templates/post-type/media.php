<?php
/**
 * Register and setup pjs_media post type
 */
 
	// set slug for CPT from ACF field
	$slug = get_field('pjs_mm_slug', 'option');

	if (!$slug) {
		$slug = 'media';
	}
	
	// register pjs_media post type
	register_post_type('pjs_media', 
		array(
			'labels'             => array(
				'name'               => _x('PJS Media Manager', 'post type general name'),
				'singular_name'      => _x('PJS Media', 'post type singular name'),
				'menu_name'          => _x('PJS Media', 'admin menu'),
				'name_admin_bar'     => _x('Media', 'add new on admin bar'),
				'add_new'            => _x('Add New', 'media'),
				'add_new_item'       => __('Add New Media'),
				'new_item'           => __('New Media'),
				'edit_item'          => __('Edit Media'),
				'view_item'          => __('View Media'),
				'all_items'          => __('All Media'),
				'search_items'       => __('Search Media'),
				'parent_item_colon'  => __('Parent Media:'),
				'not_found'          => __('No media found.'),
				'not_found_in_trash' => __('No media found in Trash.')
			),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array('slug' => $slug),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'menu_icon'          => 'dashicons-playlist-video',
			'supports'           => array('title', 'revisions'),
			'taxonomies'         => array('pjs-mm-series', 'pjs-mm-speakers', 'pjs-mm-keywords'),
		)
	);
	
	// register pjs-mm-series taxonomy
	register_taxonomy('pjs-mm-series', 'pjs_media',
		array(
			'labels'       => array(
				'name'         => 'Series',
				'not_found'    => 'No Series Found',
				'parent_item'  => 'Parent Series',
				'search_items' => 'Search Series',
				'add_new_item' => 'Add New Series',
			),
			'rewrite'      => array('slug' => 'pjs-mm-series'),
			'meta_box_cb'  => false,
			'hierarchical' => false,
		)
	);
	
	// register pjs-mm-speakers taxonomy
	register_taxonomy('pjs-mm-speakers', 'pjs_media',
		array(
			'labels'       => array(
				'name'         => 'Speakers',
				'not_found'    => 'No Speakers Found',
				'parent_item'  => 'Parent Speaker',
				'search_items' => 'Search Speakers',
				'add_new_item' => 'Add New Speaker',
			),
			'rewrite'      => array('slug' => 'pjs-mm-speakers'),
			'hierarchical' => false,
		)
	);
	
	// register pjs-mm-keywords taxonomy
	register_taxonomy('pjs-mm-keywords', 'pjs_media',
		array(
			'labels'       => array(
				'name'         => 'Keywords',
				'not_found'    => 'No Keywords Found',
				'parent_item'  => 'Parent Keyword',
				'search_items' => 'Search Keywords',
				'add_new_item' => 'Add New Keyword',
			),
			'rewrite'      => array('slug' => 'pjs-mm-keywords'),
			'hierarchical' => false,
		)
	);
	
	if (function_exists('acf_add_options_page')) {
		acf_add_options_sub_page(array(
			'page_title' 	=> 'PJS Media Manager Settings',
			'menu_title' 	=> 'Settings',
			'parent_slug' => 'edit.php?post_type=pjs_media',
			'position' => 99,
		));
	}