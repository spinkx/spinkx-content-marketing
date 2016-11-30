<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	/* no_of_columns Inserting Starts Here */
	$no_of_columns = helperClass::getFilterVar( 'no_of_columns', INPUT_POST, FILTER_VALIDATE_INT);
	$unserialized_storage_meta['no_of_columns'] = $no_of_columns;
	/* no_of_columns Inserting Starts Here */

	/* widget_layout_type Inserting Starts Here */
	$widget_layout_type = helperClass::getFilterVar( 'widget_layout_type', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['widget_layout_type'] = $widget_layout_type;
	/* widget_layout_type Inserting Starts Here */
	/* unit_layout_type Inserting Starts Here */
	$unit_layout_type = helperClass::getFilterVar( 'unit_layout_type', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['unit_layout_type'] = $unit_layout_type;
	/* unit_layout_type Inserting Starts Here */
	/* unit_spacing Inserting Starts Here */
	$unit_spacing = helperClass::getFilterVar( 'unit_spacing', INPUT_POST, FILTER_VALIDATE_INT);
	$unserialized_storage_meta['unit_spacing'] = $unit_spacing;
	/* unit_spacing Inserting Starts Here */

	/* img_crop_width Inserting Starts Here */
	$img_crop_width = helperClass::getFilterVar( 'img_crop_width', INPUT_POST, FILTER_VALIDATE_INT);
	$unserialized_storage_meta['img_crop_width'] = $img_crop_width;
	/* img_crop_width Inserting Starts Here */

	/* img_crop_height Inserting Starts Here */
	$img_crop_height = helperClass::getFilterVar( 'img_crop_height', INPUT_POST, FILTER_VALIDATE_INT);
	$unserialized_storage_meta['img_crop_height'] = $img_crop_height;

	$img_height = helperClass::getFilterVar( 'img_height', INPUT_POST, FILTER_VALIDATE_INT);
	$unserialized_storage_meta['img_height'] = $img_height;
	/* img_crop_height Inserting Starts Here */

	/***************************************************************************************/

	/* unit_bg_color Inserting Starts Here */
	$unit_bg_color = helperClass::getFilterVar( 'unit_bg_color', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['unit_bg_color'] = $unit_bg_color;
	/* unit_bg_color Inserting Ends Here */

	/* unit_fg_color Inserting Starts Here */
	$unit_fg_color = helperClass::getFilterVar( 'unit_fg_color', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['unit_fg_color'] = $unit_fg_color;
	/* unit_fg_color Inserting Ends Here */

	/***************************************************************************************/

	/* unit_border_width Inserting Starts Here */
	$unit_border_width = helperClass::getFilterVar( 'unit_border_width', INPUT_POST, FILTER_VALIDATE_INT);
	$unserialized_storage_meta['unit_border_width'] = $unit_border_width;
	/* unit_border_width Inserting Ends Here */

	/* unit_border_style Inserting Starts Here */
	$unit_border_style = helperClass::getFilterVar( 'unit_border_style', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['unit_border_style'] = $unit_border_style;
	/* unit_border_style Inserting Ends Here */

	/* unit_border_color Inserting Starts Here */
	$unit_border_color = helperClass::getFilterVar( 'unit_border_color', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['unit_border_color'] = $unit_border_color;
	/* unit_border_color Inserting Ends Here */

	/* unit_border_radius Inserting Starts Here */
	$unit_border_radius = helperClass::getFilterVar( 'unit_border_radius', INPUT_POST, FILTER_VALIDATE_INT);
	$unserialized_storage_meta['unit_border_radius'] = $unit_border_radius;
	/* unit_border_radius Inserting Ends Here */

	/***************************************************************************************/

	/* unit_title_font_size Inserting Starts Here */
	$unit_title_font_size = helperClass::getFilterVar( 'unit_title_font_size', INPUT_POST, FILTER_VALIDATE_INT);
	$unserialized_storage_meta['unit_title_font_size'] = $unit_title_font_size;
	/* unit_title_font_size Inserting Ends Here */

	/* unit_title_line_height Inserting Starts Here */
	$unit_title_line_height = helperClass::getFilterVar( 'unit_title_line_height', INPUT_POST, FILTER_VALIDATE_INT);
	$unserialized_storage_meta['unit_title_line_height'] = $unit_title_line_height;
	/* unit_title_line_height Inserting Ends Here */

	/* unit_title_font_style Inserting Starts Here */
	$unit_title_font_style = helperClass::getFilterVar( 'unit_title_font_style', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['unit_title_font_style'] = $unit_title_font_style;
	/* unit_title_font_style Inserting Ends Here */

	/* unit_title_font_color Inserting Starts Here */
	$unit_title_font_color = helperClass::getFilterVar( 'unit_title_font_color', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['unit_title_font_color'] = $unit_title_font_color;
	/* unit_title_font_color Inserting Ends Here */

	/***************************************************************************************/

	/* unit_title_font_family Inserting Starts Here */
	$unit_title_font_family = helperClass::getFilterVar( 'unit_title_font_family', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['unit_title_font_family'] = $unit_title_font_family;
	/* unit_title_font_family Inserting Ends Here */

	/* unit_title_font_case Inserting Starts Here */
	$unit_title_font_case = helperClass::getFilterVar( 'unit_title_font_case', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['unit_title_font_case'] = $unit_title_font_case;
	/* unit_title_font_case Inserting Ends Here */

	/***************************************************************************************/

	/* unit_add_line_width Inserting Starts Here */
	$unit_add_line_width = helperClass::getFilterVar( 'unit_add_line_width', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['unit_add_line_width'] = $unit_add_line_width;
	/* unit_add_line_width Inserting Ends Here */

	/* unit_add_line_style Inserting Starts Here */
	$unit_add_line_style = helperClass::getFilterVar( 'unit_add_line_style', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['unit_add_line_style'] = $unit_add_line_style;
	/* unit_add_line_style Inserting Ends Here */

	/* unit_add_line_color Inserting Starts Here */
	$unit_add_line_color = helperClass::getFilterVar( 'unit_add_line_color', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['unit_add_line_color'] = $unit_add_line_color;
	/* unit_add_line_color Inserting Ends Here */

	/***************************************************************************************/

	/* unit_excerpt_font_size Inserting Starts Here */
	$unit_excerpt_font_size = helperClass::getFilterVar( 'unit_excerpt_font_size', INPUT_POST, FILTER_VALIDATE_INT);
	$unserialized_storage_meta['unit_excerpt_font_size'] = $unit_excerpt_font_size;
	/* unit_excerpt_font_size Inserting Ends Here */

	/* unit_excerpt_line_height Inserting Starts Here */
	$unit_excerpt_line_height = helperClass::getFilterVar( 'unit_excerpt_line_height', INPUT_POST, FILTER_VALIDATE_INT);
	$unserialized_storage_meta['unit_excerpt_line_height'] = $unit_excerpt_line_height;
	/* unit_excerpt_line_height Inserting Ends Here */

	/* unit_excerpt_font_style Inserting Starts Here */
	$unit_excerpt_font_style = helperClass::getFilterVar( 'unit_excerpt_font_style', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['unit_excerpt_font_style'] = $unit_excerpt_font_style;
	/* unit_excerpt_font_style Inserting Ends Here */

	/* unit_excerpt_font_color Inserting Starts Here */
	$unit_excerpt_font_color = helperClass::getFilterVar( 'unit_excerpt_font_color', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['unit_excerpt_font_color'] = $unit_excerpt_font_color;
	/* unit_excerpt_font_color Inserting Ends Here */

	/***************************************************************************************/

	/* unit_excerpt_font_family Inserting Starts Here */
	$unit_excerpt_font_family = helperClass::getFilterVar( 'unit_excerpt_font_family', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['unit_excerpt_font_family'] = $unit_excerpt_font_family;
	/* unit_excerpt_font_family Inserting Ends Here */

	/* unit_excerpt_font_case Inserting Starts Here */
	$unit_excerpt_font_case = helperClass::getFilterVar( 'unit_excerpt_font_case', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['unit_excerpt_font_case'] = $unit_excerpt_font_case;
	/* unit_excerpt_font_case Inserting Ends Here */

	/***************************************************************************************/

	/* unit_excerpt_word_limit Inserting Starts Here */
	$unit_excerpt_word_limit = helperClass::getFilterVar( 'unit_excerpt_word_limit', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['unit_excerpt_word_limit'] = $unit_excerpt_word_limit;
	/* unit_excerpt_word_limit Inserting Ends Here */

	/***************************************************************************************/

	/******************* Local Distribution Field Values Starts Here ***********************/

	/* widget_recent_percentage Inserting Starts Here */
	$widget_recent_percentage = helperClass::getFilterVar( 'widget_recent_percentage', INPUT_POST, FILTER_SANITIZE_STRING);
	if( $widget_recent_percentage == "" ) {
		$widget_recent_percentage = "50";
	};
	$unserialized_storage_meta['widget_recent_percentage'] = $widget_recent_percentage;
	/* widget_recent_percentage Inserting Ends Here */

	/* widget_popular_percentage Inserting Starts Here */
	$widget_popular_percentage = helperClass::getFilterVar( 'widget_popular_percentage', INPUT_POST, FILTER_SANITIZE_STRING);
	if( $widget_popular_percentage == "" ) {
		$widget_popular_percentage = 25;
	};
	$unserialized_storage_meta['widget_popular_percentage'] = $widget_popular_percentage;
	/* widget_popular_percentage Inserting Ends Here */

	/* widget_related_percentage Inserting Starts Here */
	$widget_related_percentage = helperClass::getFilterVar( 'widget_related_percentage', INPUT_POST, FILTER_SANITIZE_STRING);
	if( $widget_related_percentage == "" ) {
		$widget_related_percentage = 25;
	};
	$unserialized_storage_meta['widget_related_percentage'] = $widget_related_percentage;
	/* widget_related_percentage Inserting Ends Here */

	/******************** Local Distribution Field Values Ends Here ************************/

	/****************** Global Distribution Field Values Starts Here ***********************/
	
	/* allow_global_checkbox Inserting Starts Here */
	$allow_global_checkbox = helperClass::getFilterVar( 'allow_global_checkbox', INPUT_POST, FILTER_SANITIZE_STRING);
	if( $allow_global_checkbox == "" ) {
		$allow_global_checkbox = "on";
	};
	$unserialized_storage_meta['allow_global_checkbox'] = $allow_global_checkbox;
	/* allow_global_checkbox Inserting Starts Here */

	/* global_post_percentage Inserting Starts Here */
	$global_post_percentage = helperClass::getFilterVar( 'global_post_percentage', INPUT_POST, FILTER_SANITIZE_STRING);
	if( $global_post_percentage == "" ) {
		$global_post_percentage = 50;
	};
	$unserialized_storage_meta['global_post_percentage'] = $global_post_percentage;
	/* global_post_percentage Inserting Starts Here */
	/* local_post_percentage Inserting Starts Here */
	$mysite_post_percentage = helperClass::getFilterVar( 'local_post_percentage', INPUT_POST, FILTER_SANITIZE_STRING);
	if( $mysite_post_percentage == "" ) {
		$mysite_post_percentage = 30;
	};
	$unserialized_storage_meta['local_post_percentage'] = $mysite_post_percentage;
	/* local_post_percentage Inserting Starts Here */
	/* ad_post_percentage Inserting Starts Here */
	$sponsored_post_percentage = helperClass::getFilterVar( 'ad_post_percentage', INPUT_POST, FILTER_SANITIZE_STRING);
	if( $sponsored_post_percentage == "" ) {
		$sponsored_post_percentage = 20;
	};
	$unserialized_storage_meta['ad_post_percentage'] = $sponsored_post_percentage;
	/* ad_post_percentage Inserting Starts Here */
	/* page_takeover_checkbox Inserting Starts Here */
	$page_takeover_checkbox = helperClass::getFilterVar( 'page_takeover_checkbox', INPUT_POST, FILTER_SANITIZE_STRING);
	if( $page_takeover_checkbox == "" ) {
		$page_takeover_checkbox = "on";
	};
	$unserialized_storage_meta['page_takeover_checkbox'] = $page_takeover_checkbox;
	/* page_takeover_checkbox Inserting Starts Here */

	/* allow_global_url_checkbox Inserting Starts Here */
	$allow_global_url_checkbox = helperClass::getFilterVar( 'allow_global_url_checkbox', INPUT_POST, FILTER_SANITIZE_STRING);
	if( $allow_global_url_checkbox == "" ) {
		$allow_global_url_checkbox = "on";
	};
	$unserialized_storage_meta['allow_global_url_checkbox'] = $allow_global_url_checkbox;
	/* allow_global_url_checkbox Inserting Starts Here */

	/* allow_global_url_textarea Inserting Starts Here */
	$allow_global_url_textarea = helperClass::getFilterVar( 'allow_global_url_textarea', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['allow_global_url_textarea'] = $allow_global_url_textarea;
	/* allow_global_url_textarea Inserting Starts Here */

	/* global_url_post_percentage Inserting Starts Here */
	$global_url_post_percentage = helperClass::getFilterVar( 'global_url_post_percentage', INPUT_POST, FILTER_SANITIZE_STRING);
	if( $global_url_post_percentage == "" ) {
		$global_url_post_percentage = 70;
	};
	$unserialized_storage_meta['global_url_post_percentage'] = $global_url_post_percentage;
	/* global_url_post_percentage Inserting Starts Here */

	/* block_global_url_checkbox Inserting Starts Here */
	$block_global_url_checkbox = helperClass::getFilterVar( 'block_global_url_checkbox', INPUT_POST, FILTER_SANITIZE_STRING);
	if( $block_global_url_checkbox == "" ) {
		$block_global_url_checkbox = "on";
	};
	$unserialized_storage_meta['block_global_url_checkbox'] = $block_global_url_checkbox;
	/* block_global_url_checkbox Inserting Starts Here */

	/* global_blocked_url_textarea Inserting Starts Here */
	$global_blocked_url_textarea = helperClass::getFilterVar( 'global_blocked_url_textarea', INPUT_POST, FILTER_SANITIZE_STRING);
	$blocked_url_textarea	=	'';
	if(!empty($global_blocked_url_textarea))
	{
		foreach($global_blocked_url_textarea as $blocked_url)
		{
			$blocked_url_textarea.=(substr($blocked_url,-1)=='/')?substr($blocked_url,0, -1).",":$blocked_url.",";
			
		}
	}
	$gb_blocked_url_textarea	= ($blocked_url_textarea!='')?rtrim($blocked_url_textarea,","):$blocked_url_textarea;
	
	$unserialized_storage_meta['global_blocked_url_textarea'] = $gb_blocked_url_textarea;
	/* global_blocked_url_textarea Inserting Starts Here */

	/* global_blocked_keywords_textarea Inserting Starts Here */
	$global_blocked_keywords_textarea = helperClass::getFilterVar( 'global_blocked_keywords_textarea', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['global_blocked_keywords_textarea'] =implode(',',$global_blocked_keywords_textarea);
	/* global_blocked_keywords_textarea Inserting Starts Here */

	/* global_blocked_categories_textarea Inserting Starts Here */
	$global_blocked_categories_textarea = helperClass::getFilterVar( 'global_blocked_categories_textarea', INPUT_POST, FILTER_SANITIZE_STRING);
	$unserialized_storage_meta['global_blocked_categories_textarea'] = implode(',',$global_blocked_categories_textarea);
	/* global_blocked_categories_textarea Inserting Starts Here */

	/****************** Global Distribution Field Values Ends Here ***********************/
	
	
	$serialized_storage_meta = maybe_serialize( $unserialized_storage_meta );
