<?php
/**
*Author: Ashuwp
*Author url: http://www.ashuwp.com
*Version: 3.2
**/

/*****Meta Box********/
$ashu_meta = array();
$meta_conf = array('title' => 'Meta box', 'id'=>'seobox', 'page'=>array('page','post'), 'context'=>'normal', 'priority'=>'low', 'callback'=>'');

$ashu_meta[] = array(
  'name' => 'Title',
  'id'   => '_id_title',
  'type' => 'title'
);

$ashu_meta[] = array(
  'name' => 'Text Input',
  'id'   => '_id_text',
  'desc' => 'description or notice',
  'std'  => 'Default content',
  'size' => 40,
  'type' => 'text'
);

$ashu_meta[] = array(
  'name' => 'Password Input',
  'id'   => '_id_pass',
  'desc' => 'password',
  'std'  => '',
  'size' => 40,
  'type' => 'password'
);

$ashu_meta[] = array(
  'name' => 'Texearea Input',
  'id'   => '_id_textarea',
  'desc' => 'description or notice',
  'std'  => 'Default content',
  'size' => array(60,5),
  'type' => 'textarea'
);

$ashu_meta[] = array(
  'name' => 'Image Upload',
  'id'   => '_id_upload',
  'desc' => 'Pleas upload a image, Or fill the blank with image url',
  'std'  => '',
  'button_text' => 'Upload',
  'size' => 40,
  'type' => 'upload'
);

$ashu_meta[] = array(
  'name' => 'Image gallery',
  'id'   => '_id_gallery',
  'desc' => 'Pleas upload images',
  'std'  => '',
  'button_text' => 'Add',
  'size' => 40,
  'type' => 'gallery'
);

$ashu_meta[] = array(
  'name'    => 'Radio',
  'id'      => '_id_radio',
  'desc'    => 'Please select your gender',
  'std'     => 'thirdness',
  'buttons' => array(
    'male'      => 'Male',
    'female'    => 'Female',
    'thirdness' => 'Third gender'
  ),
  'type'    => 'radio'
);

$ashu_meta[] = array(
  'name'    => 'Checkbox',
  'id'      => '_id_checkbox',
  'desc'    => 'Which fruits do you like?',
  'std'     => array('apple','orange'),
  'buttons' => array(
    'apple'  => 'Apple',
	'orange' => 'Orange',
	'banana' => 'Banana',
	'lemon'  => 'Lemon'
  ),
  'type'    => 'checkbox'
);

$ashu_meta[] = array(
  'name'    => 'Page select',
  'id'      => '_page_select',
  'desc'    => 'Pleas select a page',
  'std'     => '',
  'subtype' => 'page',
  'type'    => 'dropdown'
);

$ashu_meta[] = array(
  'name'    => 'Category select',
  'id'      => '_category_select',
  'desc'    => 'Which fruits do you like?',
  'std'     => '',
  'subtype' => 'category',
  'type'    => 'dropdown'
);

$ashu_meta[] = array(
  'name'    => 'Menu select',
  'id'      => '_menu_select',
  'desc'    => 'Pleas select a menu',
  'std'     => '',
  'subtype' => 'menu',
  'type'    => 'dropdown'
);

$ashu_meta[] = array(
  'name'    => 'Sidebar select',
  'id'      => '_sidebar_select',
  'desc'    => 'Pleas select a sidebar',
  'std'     => '',
  'subtype' => 'sidebar',
  'type'    => 'dropdown'
);

$ashu_meta[] = array(
  'name'    => 'Other select',
  'id'      => '_other_select',
  'desc'    => 'Pleas select a sidebar',
  'std'     => '',
  'subtype' => array(
    'apple'  => 'Apple',
	'orange' => 'Orange',
	'banana' => 'Banana',
	'lemon'  => 'Lemon'
  ),
  'type' => 'dropdown'
);

$ashu_meta[] = array(
  'name' => 'A numbers array',
  'id'   => '_id_numbers',
  'desc' => 'Pleas fill in the figures and separated by commas',
  'std'  => array(1,2,3),
  'size' => 40, 
  'type' => 'numbers_array'
);

$ashu_meta[] = array(
  'name'  => 'Tinymce Input',
  'id'    => '_id_tinymce',
  'desc'  => 'Pleas add some content',
  'std'   => 'Hello, world.',
  'media' => 1,
  'type'  => 'tinymce'
);

$new_box = new ashu_meta_box($ashu_meta, $meta_conf);

/***tab**/
$tab_meta = array();
$tab_conf = array('title' => 'Tab Title', 'id'=>'tabbox', 'page'=>array('page','post'), 'context'=>'normal', 'priority'=>'low', 'callback'=>'', 'tab'=>true);

$tab_meta[] = array(
  'name' => 'Texearea Input',
  'id'   => '_tab_textarea',
  'desc' => 'description or notice',
  'std'  => 'Default content',
  'size' => array(60,5),
  'type' => 'textarea'
);
$tab_meta[] = array(
  'name'  => 'Tinymce Input',
  'id'    => '_tab_tinymce',
  'desc'  => 'Pleas add some content',
  'std'   => 'Hello, world.',
  'media' => 1,
  'type'  => 'tinymce'
);
$tab_meta[] = array(
  'name' => 'Image gallery',
  'id'   => '_tab_gallery',
  'desc' => 'Pleas upload images',
  'std'  => '',
  'button_text' => 'Add',
  'size' => 40,
  'type' => 'gallery'
);

$tab_box = new ashu_meta_box($tab_meta, $tab_conf);

/*********Options************/
$page_info = array(
  'full_name' => 'General Options',
  'optionname'=>'general',
  'child'=>false,
  'filename' => 'generalpage'
);

$ashu_options = array();

$ashu_options[] = array(
  'type' => 'open',
  'name' => 'hello world.',
  'id'   => '_id_open'
);

$ashu_options[] = array(
  'name' => 'Title',
  'id'   => '_id_title',
  'desc' => '',
  'type' => 'title'
);

$ashu_options[] = array(
  'name' => 'Text Input',
  'id'   => '_id_text',
  'desc' => 'description or notice',
  'std'  => 'Default content',
  'size' => 40,
  'type' => 'text'
);

$ashu_options[] = array(
  'name' => 'Password Input',
  'id'   => '_id_pass',
  'desc' => 'password',
  'std'  => '',
  'size' => 40,
  'type' => 'password'
);

$ashu_options[] = array(
  'name' => 'Textarea Input',
  'id'   => '_id_textarea',
  'desc' => 'description or notice',
  'std'  => 'Default content',
  'size' => array(60,5),
  'type' => 'textarea'
);

$ashu_options[] = array(
  'name' => 'Image Upload',
  'id'   => '_id_upload',
  'desc' => 'Pleas upload a image, Or fill the blank with image url',
  'std'  => '',
  'size' => 40,
  'button_text' => 'Upload',
  'type' => 'upload'
);

$ashu_options[] = array(
  'name' => 'Gallery',
  'id'   => '_id_gallery',
  'desc' => 'Pleas upload a images',
  'std'  => '',
  'size' => 40,
  'button_text' => 'Upload',
  'type' => 'gallery'
);

$ashu_options[] = array(
  'name'    => 'Radio',
  'id'      => '_id_radio',
  'desc'    => 'Please select your gender',
  'std'     => 'thirdness',
  'buttons' => array(
    'male'      => 'Male',
	'female'    => 'Female',
	'thirdness' => 'Third gender'
  ),
  'type'    => 'radio'
);

$ashu_options[] = array(
  'name'    => 'Checkbox',
  'id'      => '_id_checkbox',
  'desc'    => 'Which fruits do you like?',
  'std'     => array('apple','orange'),
  'buttons' => array(
    'apple'  => 'Apple',
	'orange' => 'Orange',
	'banana' => 'Banana',
	'lemon'  => 'Lemon'
  ),
  'type'    => 'checkbox'
);

$ashu_options[] = array(
  'name'    => 'Page select',
  'id'      => '_page_select',
  'desc'    => 'Pleas select a page',
  'std'     => '',
  'subtype' => 'page',
  'type'    => 'dropdown'
);

$ashu_options[] = array(
  'name'    => 'Category select',
  'id'      => '_category_select',
  'desc'    => 'Which fruits do you like?',
  'std'     => '',
  'subtype' => 'category',
  'type'    => 'dropdown'
);

$ashu_options[] = array(
  'name'    => 'Menu select',
  'id'      => '_menu_select',
  'desc'    => 'Pleas select a menu',
  'std'     => '',
  'subtype' => 'menu',
  'type'    => 'dropdown'
);

$ashu_options[] = array(
  'name'    => 'Sidebar select',
  'id'      => '_sidebar_select',
  'desc'    => 'Pleas select a sidebar',
  'std'     => '',
  'subtype' => 'sidebar',
  'type'    => 'dropdown'
);

$ashu_options[] = array(
  'name'    => 'Other select',
  'id'      => '_other_select',
  'desc'    => 'Pleas select a sidebar',
  'std'     => '',
  'subtype' => array(
    'apple'  => 'Apple',
	'orange' => 'Orange',
	'banana' => 'Banana',
	'lemon'  => 'Lemon'
  ),
  'type' => 'dropdown'
);

$ashu_options[] = array(
  'name' => 'A numbers array',
  'id'   => '_id_numbers',
  'desc' => 'Pleas fill in the figures and separated by commas',
  'std'  => array(1,2,3),
  'size' => 40, 
  'type' => 'numbers_array'
);

$ashu_options[] = array(
  'name'  => 'Tinymce Input',
  'id'    => '_id_tinymce',
  'desc'  => 'Pleas add some content',
  'std'   => 'Hello, world.',
  'media' => 1,
  'type'  => 'tinymce'
);

$ashu_options[] = array(
  'type' => 'close',
  'name' => 'hello world.',
  'id'   => '_id_open'
);
$option_page = new ashu_option_class($ashu_options, $page_info);

/*********Child Options************/
$child_info = array(
  'full_name' => 'Child Options',
  'optionname'=>'childoption',
  'child'=>true,
  'parent_slug'=>'generalpage',
  'filename' => 'childpage'
);

$child_option = array();

$child_option[] = array(
  'type' => 'open',
  'name' => 'hello world.',
  'id'   => '_id_open'
);
$child_option[] = array(
  'name' => 'A numbers array',
  'id'   => '_id_numbers',
  'desc' => 'Pleas fill in the figures and separated by commas',
  'std'  => array(1,2,3),
  'size' => 40, 
  'type' => 'numbers_array'
);
$child_option[] = array(
  'type' => 'close',
  'name' => 'hello world.',
  'id'   => '_id_open'
);
$child_page = new ashu_option_class($child_option, $child_info);

/*********Other top page************/
$tab_info = array(
  'full_name' => 'Top page',
  'optionname'=>'toppage',
  'child'=>false,
  'filename' => 'toppage_slug',
  'tab'=>true
);

$tab_option = array();
/*tab1*/
$tab_option[] = array(
  'name' => 'Tab1',
  'id'   => 'option_tab1',
  'type' => 'open'
);
$tab_option[] = array(
  'name' => 'Test input in tab1',
  'id'   => '_tab1_text',
  'desc' => '',
  'std'  => 'hello word',
  'size' => 40, 
  'type' => 'text'
);
$tab_option[] = array(
  'name' => 'Textarea in tab1',
  'id'   => '_tab1_textarea',
  'desc' => '',
  'std'  => 'hello word',
  'size' => 40, 
  'type' => 'textarea'
);
$tab_option[] = array(
  'type' => 'close',
  'name' => 'hello world.'
);
/*tab2*/
$tab_option[] = array(
  'name' => 'Tab2',
  'id'   => 'option_tab2',
  'type' => 'open'
);
$tab_option[] = array(
  'name' => 'Image Upload in tab2',
  'id'   => '_tab2_upload',
  'desc' => 'Pleas upload a image, Or fill the blank with image url',
  'std'  => '',
  'size' => 40,
  'button_text' => 'Upload',
  'type' => 'upload'
);
$tab_option[] = array(
  'name' => 'Gallery in tab2',
  'id'   => '_tab2_gallery',
  'desc' => 'Pleas upload a images',
  'std'  => '',
  'size' => 40,
  'button_text' => 'Upload',
  'type' => 'gallery'
);
$tab_option[] = array(
  'type' => 'close',
  'name' => ''
);
/*tab3*/
$tab_option[] = array(
  'name' => 'Tab3',
  'id'   => 'option_tab3',
  'type' => 'open'
);
$tab_option[] = array(
  'name'  => 'Tinymce Input in tab3',
  'id'    => '_tab3_tinymce',
  'desc'  => 'Pleas add some content',
  'std'   => 'Hello, world.',
  'media' => 1,
  'type'  => 'tinymce'
);
$tab_option[] = array(
  'type' => 'close',
  'name' => ''
);
$tab_page = new ashu_option_class($tab_option, $tab_info);

/****import-export*****/
$import_info = array(
  'full_name' => 'Import/Export',
  'child'=>true,
  'parent_slug'=>'generalpage',
  'filename' => 'import_page'
);
$import_page = new ashu_option_import_class($import_info);

/*****taxonomy feild ******/
$ashu_feild = array();
$taxonomy_cof = array('category','post_tag');

$ashu_feild[] = array(
  'name'      => 'Title',
  'id'        => '_id_title',
  'desc'      => 'I am a h3 tag',
  'edit_only' => false,
  'type'      => 'title'
);

$ashu_feild[] = array(
  'name'      => 'Text Input',
  'id'        => '_id_text',
  'desc'      => 'description or notice',
  'std'       => 'Default content',
  'edit_only' => false,
  'size'      => 40,
  "type"      => "text"
);

$ashu_feild[] = array(
  'name'      => 'Password Input',
  'id'        => '_id_text',
  'desc'      => 'password',
  'std'       => '',
  'edit_only' => false,
  'size'      => 40,
  "type"      => "password"
);

$ashu_feild[] = array(
  'name'      => 'Textarea Input',
  'id'        => '_id_textarea',
  'desc'      => 'description or notice',
  'std'       => 'Default content',
  'edit_only' => false,
  'size'      => array(60,5),
  "type"      => "textarea"
);

$ashu_feild[] = array(
  'name'        => 'Image Upload',
  'id'          => '_id_upload',
  'desc'        => 'Pleas upload a image, Or fill the blank with image url',
  'std'         => '',
  'button_text' => 'Upload',
  'edit_only'   => true,
  'size'        => 40,
  'type'        => 'upload'
);

$ashu_feild[] = array(
  'name'        => 'Gallery',
  'id'          => '_id_gallery',
  'desc'        => 'Pleas upload a images',
  'std'         => '',
  'button_text' => 'Upload',
  'edit_only'   => true,
  'size'        => 40,
  'type'        => 'gallery'
);

$ashu_feild[] = array(
  'name'    => 'Radio',
  'id'      => '_id_radio',
  'desc'    => 'Please select your gender',
  'std'     => 'thirdness',
  'buttons' => array(
    'male'      => 'Male',
	'female'    => 'Female',
	'thirdness' => 'Third gender'
  ),
  'edit_only'   => false,
  'type'    => 'radio'
);

$ashu_feild[] = array(
  'name'    => 'Checkbox',
  'id'      => '_id_checkbox',
  'desc'    => 'Which fruits do you like?',
  'std'     => array('apple','orange'),
  'buttons' => array(
    'apple'  => 'Apple',
    'orange' => 'Orange',
    'banana' => 'Banana',
    'lemon'  => 'Lemon'
  ),
  'edit_only'   => false,
  'type'    => 'checkbox'
);

$ashu_feild[] = array(
  'name'    => 'Page select',
  'id'      => '_page_select',
  'desc'    => 'Pleas select a page',
  'std'     => '',
  'subtype' => 'page',
  'edit_only'   => false,
  'type'    => 'dropdown'
);

$ashu_feild[] = array(
  'name'    => 'Category select',
  'id'      => '_category_select',
  'desc'    => 'Which fruits do you like?',
  'std'     => '',
  'subtype' => 'category',
  'edit_only'   => false,
  'type'    => 'dropdown'
);

$ashu_feild[] = array(
  'name'    => 'Menu select',
  'id'      => '_menu_select',
  'desc'    => 'Pleas select a menu',
  'std'     => '',
  'subtype' => 'menu',
  'edit_only'   => false,
  'type'    => 'dropdown'
);

$ashu_feild[] = array(
  'name'    => 'Sidebar select',
  'id'      => '_sidebar_select',
  'desc'    => 'Pleas select a sidebar',
  'std'     => '',
  'subtype' => 'sidebar',
  'edit_only'   => false,
  'type'    => 'dropdown'
);

$ashu_feild[] = array(
  'name'    => 'Other select',
  'id'      => '_other_select',
  'desc'    => 'Pleas select a sidebar',
  'std'     => '',
  'subtype' => array(
    'apple'  => 'Apple',
	'orange' => 'Orange',
	'banana' => 'Banana',
	'lemon'  => 'Lemon'
  ),
  'edit_only'   => false,
  'type' => 'dropdown'
);

$ashu_feild[] = array(
  'name' => 'A numbers array',
  'id'   => '_id_numbers',
  'desc' => 'Pleas fill in the figures and separated by commas',
  'std'  => array(1,2,3),
  'size' => 40,
  'edit_only'   => false,
  'type' => 'numbers_array'
);

$ashu_feild[] = array(
  'name'  => 'Tinymce Input',
  'id'    => '_id_tinymce',
  'desc'  => 'Pleas add some content',
  'std'   => 'Hello, world.',
  'media' => 1,
  'edit_only'   => true,
  'type'  => 'tinymce'
);

$ashu_taxonomy_feild = new ashu_taxonomy_feild($ashu_feild, $taxonomy_cof);
?>