<?php
/**
 * Creates the ACF field groups necessary for our plugin
 */

$domain = get_site_url();

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5d72fa26d2610',
		'title' => 'PJS Media Details',
		'fields' => array(
			array(
				'key' => 'field_5db8cc2cca045',
				'label' => '',
				'name' => '',
				'type' => 'message',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => 'When creating a new media item, you must first have a series created for the media item to live under. You can create a new series here: <a href="/wp-admin/edit-tags.php?taxonomy=pjs-mm-series&post_type=pjs_media">PJS Media > Series</a>',
				'new_lines' => 'wpautop',
				'esc_html' => 0,
			),
			array(
				'key' => 'field_5db8b6079791a',
				'label' => 'Series',
				'name' => 'series',
				'type' => 'taxonomy',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'taxonomy' => 'pjs-mm-series',
				'field_type' => 'select',
				'allow_null' => 0,
				'add_term' => 0,
				'save_terms' => 0,
				'load_terms' => 0,
				'return_format' => 'object',
				'multiple' => 0,
			),
			array(
				'key' => 'field_5d72faf7e0b3c',
				'label' => 'Video URL',
				'name' => 'video_url',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d72fb27e0b3d',
				'label' => 'Audio URL',
				'name' => 'audio_url',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d9cf3183c615',
				'label' => 'Download URL',
				'name' => 'download_url',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d72fb2be0b3e',
				'label' => 'Notes URL',
				'name' => 'notes_url',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d72fb3fe0b3f',
				'label' => 'Description',
				'name' => 'description',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 0,
				'delay' => 0,
			),
			array(
				'key' => 'field_5d72fb54e0b40',
				'label' => 'Graphic',
				'name' => 'graphic',
				'type' => 'image',
				'instructions' => 'Recommended size: 1600w x 900h<br>This will override the selected series graphic.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'min_width' => 800,
				'min_height' => 450,
				'min_size' => '',
				'max_width' => 1920,
				'max_height' => 1080,
				'max_size' => '.5',
				'mime_types' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'pjs_media',
				),
			),
		),
		'menu_order' => -1,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5d961a9eaad07',
		'title' => 'PJS Media Series',
		'fields' => array(
			array(
				'key' => 'field_5db9adce95487',
				'label' => 'Series Start Date',
				'name' => 'series_start_date',
				'type' => 'date_picker',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'display_format' => 'd/m/Y',
				'return_format' => 'd/m/Y',
				'first_day' => 0,
			),
			array(
				'key' => 'field_5d961aed40faf',
				'label' => 'Series Graphic',
				'name' => 'series_graphic',
				'type' => 'image',
				'instructions' => 'Recommended size: 1600w x 900h<br>Used as a display graphic for each media item in this series. Shown on the media landing page and media item page.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'min_width' => 800,
				'min_height' => 450,
				'min_size' => '',
				'max_width' => 1920,
				'max_height' => 1080,
				'max_size' => '.5',
				'mime_types' => '',
			),
			array(
				'key' => 'field_5db8b3bb43928',
				'label' => 'Wide Series Graphic',
				'name' => 'wide_series_graphic',
				'type' => 'image',
				'instructions' => 'Recommended size: 1620w x 540h<br>Used as a background display graphic on the media landing page when a media item in this series is featured.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'min_width' => 1620,
				'min_height' => 540,
				'min_size' => '',
				'max_width' => 1920,
				'max_height' => 640,
				'max_size' => '.5',
				'mime_types' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'pjs-mm-series',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'field',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5d7fef4220da5',
		'title' => 'PJS Media Settings',
		'fields' => array(
			array(
				'key' => 'field_5d7fef89a70ca',
				'label' => 'Slug',
				'name' => 'pjs_mm_slug',
				'type' => 'text',
				'instructions' => 'Slug used for the PJS Media Manager.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '33.3',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'media',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d7fefdaa70cb',
				'label' => 'Archive Title',
				'name' => 'pjs_mm_archive_title',
				'type' => 'text',
				'instructions' => 'Title used on the media landing page for the media archive list.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '33.3',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d7ff03ba70cc',
				'label' => 'Related Title',
				'name' => 'pjs_mm_related_title',
				'type' => 'text',
				'instructions' => 'Title used on the media pages for the related items in the series.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '33.3',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d7ff0dfa70cd',
				'label' => 'View All Label',
				'name' => 'pjs_mm_view_all_label',
				'type' => 'text',
				'instructions' => 'Button label used to link back to the media landing page.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '33.3',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'View All Media',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d7ff100a70ce',
				'label' => 'View Media Label',
				'name' => 'pjs_mm_view_media_label',
				'type' => 'text',
				'instructions' => 'Button label used to link to the media page.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '33.3',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'View Media',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d7ff255a70cf',
				'label' => 'Load More Label',
				'name' => 'pjs_mm_load_more_label',
				'type' => 'text',
				'instructions' => 'Text used for the load more link on the media landing page.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '33.3',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => 'Load More Media',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d93d3af1dd30',
				'label' => 'Display by Series',
				'name' => 'pjs_mm_display_series',
				'type' => 'true_false',
				'instructions' => 'If checked, the media landing page will display by series instead of individual media items.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-settings',
				),
			),
		),
		'menu_order' => 1,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'field',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	acf_add_local_field_group(array(
		'key' => 'group_5d924e580d9d0',
		'title' => 'PJS Podcast Settings',
		'fields' => array(
			array(
				'key' => 'field_5d924eb11bbc5',
				'label' => 'Enable Podcast',
				'name' => 'pjs_podcast_enable',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => '',
				'default_value' => 0,
				'ui' => 0,
				'ui_on_text' => '',
				'ui_off_text' => '',
			),
			array(
				'key' => 'field_5d924e951bbc4',
				'label' => 'Image',
				'name' => 'pjs_podcast_image',
				'type' => 'image',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d924eb11bbc5',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
				'min_width' => 1400,
				'min_height' => 1400,
				'min_size' => '',
				'max_width' => 3000,
				'max_height' => 3000,
				'max_size' => '.5',
				'mime_types' => '',
			),
			array(
				'key' => 'field_5d925032ee669',
				'label' => 'Title',
				'name' => 'pjs_podcast_title',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d924eb11bbc5',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d925040ee66a',
				'label' => 'Sub Title',
				'name' => 'pjs_podcast_sub_title',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d924eb11bbc5',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d925055ee66b',
				'label' => 'Description',
				'name' => 'pjs_podcast_description',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d924eb11bbc5',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 4,
				'new_lines' => 'br',
			),
			array(
				'key' => 'field_5d925087ee66c',
				'label' => 'Owner Name',
				'name' => 'pjs_podcast_owner_name',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d924eb11bbc5',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d925092ee66d',
				'label' => 'Owner Email',
				'name' => 'pjs_podcast_owner_email',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d924eb11bbc5',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d925096ee66e',
				'label' => 'Category',
				'name' => 'pjs_podcast_category',
				'type' => 'text',
				'instructions' => '',
				'required' => 1,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d924eb11bbc5',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d92509bee66f',
				'label' => 'Sub Category',
				'name' => 'pjs_podcast_sub_category',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d924eb11bbc5',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '50',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d9250a7ee670',
				'label' => 'Keywords',
				'name' => 'pjs_podcast_keywords',
				'type' => 'text',
				'instructions' => 'Keywords must be separated by commas.',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d924eb11bbc5',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5d93d431fab76',
				'label' => 'Podcast URL',
				'name' => '',
				'type' => 'message',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => array(
					array(
						array(
							'field' => 'field_5d924eb11bbc5',
							'operator' => '==',
							'value' => '1',
						),
					),
				),
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'message' => 'You can view your podcast RSS feed here: <a href="/podcast/audio" target="_blank">' . $domain . '/podcast/audio</a>',
				'new_lines' => 'wpautop',
				'esc_html' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options-settings',
				),
			),
		),
		'menu_order' => 2,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'field',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

endif;