<?php

if(function_exists("register_field_group")) {
    
    register_field_group(array(
		'id' => 'acf_homepage',
		'title' => 'Homepage',
		'fields' => 
		array(
			0 => 
			array(
				'key' => 'field_5875434b7f1a6',
				'label' => 'Carousel Slides',
				'name' => 'carousel_slides',
				'_name' => 'carousel_slides',
				'type' => 'repeater',
				'order_no' => 0,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-carousel_slides',
				'class' => 'repeater',
				'conditional_logic' => 
				array(
					'status' => 0,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'null',
							'operator' => '==',
						),
					),
					'allorany' => 'all',
				),
				'sub_fields' => 
				array(
					0 => 
					array(
						'key' => 'field_5875436d7f1a7',
						'label' => 'Carousel Image',
						'name' => 'carousel_image',
						'_name' => 'carousel_image',
						'type' => 'image',
						'order_no' => 0,
						'instructions' => '',
						'required' => 0,
						'id' => 'acf-field-carousel_image',
						'class' => 'image',
						'conditional_logic' => 
						array(
							'status' => 0,
							'allorany' => 'all',
							'rules' => 0,
						),
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					1 => 
					array(
						'key' => 'field_587543907f1a8',
						'label' => 'Carousel Title',
						'name' => 'carousel_title',
						'_name' => 'carousel_title',
						'type' => 'text',
						'order_no' => 1,
						'instructions' => '',
						'required' => 0,
						'id' => 'acf-field-carousel_title',
						'class' => 'text',
						'conditional_logic' => 
						array(
							'status' => 0,
							'allorany' => 'all',
							'rules' => 0,
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					2 => 
					array(
						'key' => 'field_58788cd6126b8',
						'label' => 'Carousel Sub-Title',
						'name' => 'carousel_subtitle',
						'_name' => 'carousel_subtitle',
						'type' => 'text',
						'order_no' => 2,
						'instructions' => '',
						'required' => 0,
						'id' => 'acf-field-carousel_subtitle',
						'class' => 'text',
						'conditional_logic' => 
						array(
							'status' => 0,
							'allorany' => 'all',
							'rules' => 0,
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					3 => 
					array(
						'key' => 'field_58764c19af523',
						'label' => 'Title Position',
						'name' => 'title_position',
						'_name' => 'title_position',
						'type' => 'select',
						'order_no' => 3,
						'instructions' => '',
						'required' => 0,
						'id' => 'acf-field-title_position',
						'class' => 'select',
						'conditional_logic' => 
						array(
							'status' => 0,
							'allorany' => 'all',
							'rules' => 0,
						),
						'column_width' => '',
						'choices' => 
						array(
							'top_left' => 'Top Left',
							'top_middle' => 'Top Middle',
							'top_right' => 'Top Right',
							'center_left' => 'Center Left',
							'center_middle' => 'Center Middle',
							'center_right' => 'Center Right',
							'bottom_left' => 'Bottom Left',
							'bottom_middle' => 'Bottom Middle',
							'bottom_right' => 'Bottom Right',
						),
						'default_value' => 'center_left',
						'allow_null' => 0,
						'multiple' => 0,
					),
					4 => 
					array(
						'key' => 'field_5875439a7f1a9',
						'label' => 'Carousel Url',
						'name' => 'carousel_url',
						'_name' => 'carousel_url',
						'type' => 'text',
						'order_no' => 4,
						'instructions' => '',
						'required' => 0,
						'id' => 'acf-field-carousel_url',
						'class' => 'text',
						'conditional_logic' => 
						array(
							'status' => 0,
							'allorany' => 'all',
							'rules' => 0,
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => 'http://',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					5 => 
					array(
						'key' => 'field_58767b1ba8391',
						'label' => 'Use white text?',
						'name' => 'dark_image',
						'_name' => 'dark_image',
						'type' => 'true_false',
						'order_no' => 5,
						'instructions' => 'Improve readability with dark images.',
						'required' => 0,
						'id' => 'acf-field-dark_image',
						'class' => 'true_false',
						'conditional_logic' => 
						array(
							'status' => 0,
							'allorany' => 'all',
							'rules' => 0,
						),
						'column_width' => '',
						'message' => '',
						'default_value' => 0,
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Slide',
				'field_group' => 5780,
			),
		),
		'location' => 
		array(
			0 => 
			array(
				0 => 
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
				1 => 
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-homepage.php',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => 
		array(
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array(
			),
		),
		'menu_order' => 0,
	)); 
    register_field_group(array(
		'id' => 'acf_page-layout',
		'title' => 'Page &#8211; Layout',
		'fields' => 
		array(
			0 => 
			array(
				'key' => 'field_5661828e4ad11',
				'label' => 'Page layout',
				'name' => 'page_layout',
				'_name' => 'page_layout',
				'type' => 'radio_image',
				'order_no' => 0,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-page_layout',
				'class' => 'radio_image',
				'conditional_logic' => 
				array(
					'status' => 0,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'field_597995c10953c',
							'operator' => '!=',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'choices' => 
				array(
					'full' => 
					array(
						'label' => 'Boxed',
						'img' => 'layout_page/portfolio-no-sidebar.png',
					),
					'sidebar' => 
					array(
						'label' => 'Sidebar',
						'img' => 'layout_page/portfolio-right.png',
					),
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'full',
				'layout' => 'vertical',
				'field_group' => 4188,
			),
			1 => 
			array(
				'key' => 'field_597995c10953c',
				'label' => 'Hide title',
				'name' => 'hide_title',
				'_name' => 'hide_title',
				'type' => 'true_false',
				'order_no' => 1,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-hide_title',
				'class' => 'true_false',
				'conditional_logic' => 
				array(
					'status' => 0,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'field_5661828e4ad11',
							'operator' => '==',
							'value' => 'full',
						),
					),
					'allorany' => 'all',
				),
				'message' => '',
				'default_value' => 0,
				'field_group' => 4188,
			),
			2 => 
			array(
				'key' => 'field_597996e0e5af4',
				'label' => 'Top title',
				'name' => 'top_title',
				'_name' => 'top_title',
				'type' => 'text',
				'order_no' => 2,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-top_title',
				'class' => 'text',
				'conditional_logic' => 
				array(
					'status' => 1,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'field_597995c10953c',
							'operator' => '!=',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'field_group' => 4188,
			),
			3 => 
			array(
				'key' => 'field_56b314fd65089',
				'label' => 'Custom page title',
				'name' => 'custom_page_title',
				'_name' => 'custom_page_title',
				'type' => 'text',
				'order_no' => 3,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-custom_page_title',
				'class' => 'text',
				'conditional_logic' => 
				array(
					'status' => 1,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'field_597995c10953c',
							'operator' => '!=',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'field_group' => 4188,
			),
			4 => 
			array(
				'key' => 'field_56b315156508a',
				'label' => 'Sub title',
				'name' => 'sub_title',
				'_name' => 'sub_title',
				'type' => 'text',
				'order_no' => 4,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-sub_title',
				'class' => 'text',
				'conditional_logic' => 
				array(
					'status' => 1,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'field_597995c10953c',
							'operator' => '!=',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'field_group' => 4188,
			),
			5 => 
			array(
				'key' => 'field_59799b5c35869',
				'label' => 'Heading text alignment',
				'name' => 'heading_text_alignment',
				'_name' => 'heading_text_alignment',
				'type' => 'select',
				'order_no' => 5,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-heading_text_alignment',
				'class' => 'select',
				'conditional_logic' => 
				array(
					'status' => 1,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'field_597995c10953c',
							'operator' => '!=',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'choices' => 
				array(
					'left' => 'Left',
					'center' => 'Center',
					'right' => 'Right',
				),
				'default_value' => 'center',
				'allow_null' => 0,
				'multiple' => 0,
				'field_group' => 4188,
			),
			6 => 
			array(
				'key' => 'field_5979a01f60daa',
				'label' => 'Heading background color',
				'name' => 'heading_bg_color',
				'_name' => 'heading_bg_color',
				'type' => 'color_picker',
				'order_no' => 6,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-heading_bg_color',
				'class' => 'color_picker',
				'conditional_logic' => 
				array(
					'status' => 1,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'field_597995c10953c',
							'operator' => '!=',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'field_group' => 4188,
			),
			7 => 
			array(
				'key' => 'field_5979a09352a03',
				'label' => 'Heading background image',
				'name' => 'heading_image',
				'_name' => 'heading_image',
				'type' => 'image',
				'order_no' => 7,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-heading_image',
				'class' => 'image',
				'conditional_logic' => 
				array(
					'status' => 1,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'field_597995c10953c',
							'operator' => '!=',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'id',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'field_group' => 4188,
			),
			8 => 
			array(
				'key' => 'field_5976f5c2ac4f7',
				'label' => 'Use dark header text',
				'name' => 'dark_header_text',
				'_name' => 'dark_header_text',
				'type' => 'true_false',
				'order_no' => 8,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-dark_header_text',
				'class' => 'true_false',
				'conditional_logic' => 
				array(
					'status' => 1,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'field_597995c10953c',
							'operator' => '!=',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'message' => '',
				'default_value' => 0,
				'field_group' => 4188,
			),
		),
		'location' => 
		array(
			0 => 
			array(
				0 => 
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => 
		array(
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => 
			array(
			),
		),
		'menu_order' => 0,
	)); 
    register_field_group(array(
		'id' => 'acf_post-layout',
		'title' => 'Post &#8211; Layout',
		'fields' => 
		array(
			0 => 
			array(
				'key' => 'field_56434e54ebf16',
				'label' => 'Page layout',
				'name' => 'page_layout',
				'_name' => 'page_layout',
				'type' => 'radio_image',
				'order_no' => 0,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-page_layout',
				'class' => 'radio_image',
				'conditional_logic' => 
				array(
					'status' => 0,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'field_5686c376ce94e',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'choices' => 
				array(
					'full' => 
					array(
						'label' => 'Fullwidth',
						'img' => 'layout_page/portfolio-no-sidebar.png',
					),
					'sidebar' => 
					array(
						'label' => 'Sidebar',
						'img' => 'layout_page/portfolio-right.png',
					),
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'full',
				'layout' => 'vertical',
				'field_group' => 2514,
			),
		),
		'location' => 
		array(
			0 => 
			array(
				0 => 
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => 
		array(
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => 
			array(
			),
		),
		'menu_order' => 0,
	)); 
    register_field_group(array(
		'id' => 'acf_post-format-gallery',
		'title' => 'Post format &#8211; gallery',
		'fields' => 
		array(
			0 => 
			array(
				'key' => 'field_53cd164750f27',
				'label' => 'Click the button below and create your gallery',
				'name' => 'bw_gallery',
				'_name' => 'bw_gallery',
				'type' => 'gallery-advanced',
				'order_no' => 0,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-bw_gallery',
				'class' => 'gallery-advanced',
				'conditional_logic' => 
				array(
					'status' => 0,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'null',
							'operator' => '==',
							'value' => '',
						),
					),
					'allorany' => 'all',
				),
				'advanced' => 0,
				'field_group' => 1044,
				'layout' => 'vertical',
				'choices' => 
				array(
				),
				'default_value' => '',
				'other_choice' => 0,
				'save_other_choice' => 0,
			),
		),
		'location' => 
		array(
			0 => 
			array(
				0 => 
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
				1 => 
				array(
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'gallery',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => 
		array(
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array(
			),
		),
		'menu_order' => 0,
	)); 
    register_field_group(array(
		'id' => 'acf_post-format-link',
		'title' => 'Post format &#8211; link',
		'fields' => 
		array(
			0 => 
			array(
				'key' => 'field_545518b92c1af',
				'label' => 'Link content',
				'name' => 'link_content',
				'_name' => 'link_content',
				'type' => 'text',
				'order_no' => 0,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-link_content',
				'class' => 'text',
				'conditional_logic' => 
				array(
					'status' => 0,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'null',
							'operator' => '==',
							'value' => '',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'field_group' => 1745,
			),
			1 => 
			array(
				'key' => 'field_545518cd2c1b0',
				'label' => 'Link url',
				'name' => 'link_url',
				'_name' => 'link_url',
				'type' => 'text',
				'order_no' => 1,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-link_url',
				'class' => 'text',
				'conditional_logic' => 
				array(
					'status' => 0,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'field_545518d52c1b1',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => 'http://',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'field_group' => 1745,
			),
			2 => 
			array(
				'key' => 'field_545518d52c1b1',
				'label' => 'New tab',
				'name' => 'new_tab',
				'_name' => 'new_tab',
				'type' => 'true_false',
				'order_no' => 2,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-new_tab',
				'class' => 'true_false',
				'conditional_logic' => 
				array(
					'status' => 0,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'null',
							'operator' => '==',
							'value' => '',
						),
					),
					'allorany' => 'all',
				),
				'message' => '',
				'default_value' => 0,
				'field_group' => 1745,
			),
			3 => 
			array(
				'key' => 'field_56863c9d3fc92',
				'label' => 'Image background',
				'name' => 'link_image_background',
				'_name' => 'link_image_background',
				'type' => 'image',
				'order_no' => 3,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-link_image_background',
				'class' => 'image',
				'conditional_logic' => 
				array(
					'status' => 0,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'field_545518d52c1b1',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'url',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'field_group' => 1745,
			),
		),
		'location' => 
		array(
			0 => 
			array(
				0 => 
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
				1 => 
				array(
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'link',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => 
		array(
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array(
			),
		),
		'menu_order' => 0,
	)); 
    register_field_group(array(
		'id' => 'acf_post-format-quote',
		'title' => 'Post format &#8211; quote',
		'fields' => 
		array(
			0 => 
			array(
				'key' => 'field_53ce7ed078d52',
				'label' => 'Quote content',
				'name' => 'quote_content',
				'_name' => 'quote_content',
				'type' => 'textarea',
				'order_no' => 0,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-quote_content',
				'class' => 'textarea',
				'conditional_logic' => 
				array(
					'status' => 0,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'null',
							'operator' => '==',
							'value' => '',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'formatting' => 'br',
				'field_group' => 1159,
			),
			1 => 
			array(
				'key' => 'field_53ce7ee578d53',
				'label' => 'Quote author',
				'name' => 'quote_author',
				'_name' => 'quote_author',
				'type' => 'text',
				'order_no' => 1,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-quote_author',
				'class' => 'text',
				'conditional_logic' => 
				array(
					'status' => 0,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'null',
							'operator' => '==',
							'value' => '',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'field_group' => 1159,
			),
		),
		'location' => 
		array(
			0 => 
			array(
				0 => 
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
				1 => 
				array(
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'quote',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => 
		array(
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array(
			),
		),
		'menu_order' => 0,
	)); 
    register_field_group(array(
		'id' => 'acf_post-format-video',
		'title' => 'Post format &#8211; video',
		'fields' => 
		array(
			0 => 
			array(
				'key' => 'field_588f0ed1253c6',
				'label' => 'Upload Video',
				'name' => 'upload_video',
				'_name' => 'upload_video',
				'type' => 'file',
				'order_no' => 0,
				'instructions' => '',
				'required' => 0,
				'id' => 'acf-field-upload_video',
				'class' => 'file',
				'conditional_logic' => 
				array(
					'status' => 0,
					'rules' => 
					array(
						0 => 
						array(
							'field' => 'null',
							'operator' => '==',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'object',
				'library' => 'all',
				'field_group' => 1155,
			),
		),
		'location' => 
		array(
			0 => 
			array(
				0 => 
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
				1 => 
				array(
					'param' => 'post_format',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => 
		array(
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array(
			),
		),
		'menu_order' => 0,
	)); 
}