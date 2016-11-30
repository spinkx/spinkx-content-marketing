<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wpdb;
			$url = SPINKX_SERVER_BASEURL.'/wp-json/spnx/v1/widget/fetchid/'.$access_site_id;
			$output = helperClass::doCurl( $url );
			$response	=	json_decode($output,true);
			$widget_auto_id	=	$response['widgetid'];
			$categories	=	$response['category'];


$main_widget_id = $widget_auto_id;

/* no_of_columns Inserting Starts Here */
$no_of_columns = "1";
/* no_of_columns Inserting Starts Here */
/* no_of_columns Inserting Starts Here */
$no_col_mob_view = "1";
/* no_of_columns Inserting Starts Here */
/* widget_layout_type Inserting Starts Here 'fixed-width' or 'masonry' */
$widget_layout_type = "masonry";
/* widget_layout_type Inserting Starts Here */
/* unit_layout_type Inserting Starts Here */
$unit_layout_type = "tall";
/* unit_layout_type Inserting Starts Here */
/* unit_spacing Inserting Starts Here */
$unit_spacing = "10";
/* unit_spacing Inserting Starts Here */

/* img_crop_width Inserting Starts Here */
$img_crop_width = "236";
/* img_crop_width Inserting Starts Here */

/* img_crop_height Inserting Starts Here */
$img_crop_height = "300";
/* img_crop_height Inserting Starts Here */
$img_height = "";
$img_width = "400";
/***************************************************************************************/

/* unit_bg_color Inserting Starts Here */
$unit_bg_color = "#ffffff";
/* unit_bg_color Inserting Ends Here */

/* unit_fg_color Inserting Starts Here */
$unit_fg_color = "#fefefe";
/* unit_fg_color Inserting Ends Here */

/***************************************************************************************/

/* unit_border_width Inserting Starts Here */
$unit_border_width = "1";
/* unit_border_width Inserting Ends Here */

/* unit_border_style Inserting Starts Here */
$unit_border_style = "solid";
/* unit_border_style Inserting Ends Here */

/* unit_border_color Inserting Starts Here */
$unit_border_color = "#d8d8d8";
/* unit_border_color Inserting Ends Here */

/* unit_border_radius Inserting Starts Here */
$unit_border_radius = "6";
/* unit_border_radius Inserting Ends Here */

/***************************************************************************************/

/* unit_title_font_size Inserting Starts Here */
$unit_title_font_size = "14";
/* unit_title_font_size Inserting Ends Here */

/* unit_title_line_height Inserting Starts Here */
$unit_title_line_height = "18";
/* unit_title_line_height Inserting Ends Here */

/* unit_title_font_style Inserting Starts Here */
$unit_title_font_style = "bold";
/* unit_title_font_style Inserting Ends Here */

/* unit_title_font_color Inserting Starts Here */
$unit_title_font_color = "#000000";
/* unit_title_font_color Inserting Ends Here */

/***************************************************************************************/

/* unit_title_font_family Inserting Starts Here */
$unit_title_font_family = "Carrois Gothic";
/* unit_title_font_family Inserting Ends Here */

/* unit_title_font_case Inserting Starts Here */
$unit_title_font_case = "none";
/* unit_title_font_case Inserting Ends Here */

/***************************************************************************************/

/* unit_add_line_width Inserting Starts Here */
$unit_add_line_width = "4";
/* unit_add_line_width Inserting Ends Here */

/* unit_add_line_style Inserting Starts Here */
$unit_add_line_style = "belowimg";
/* unit_add_line_style Inserting Ends Here */

/* unit_add_line_color Inserting Starts Here */
$unit_add_line_color = "#E36C09";
/* unit_add_line_color Inserting Ends Here */

/***************************************************************************************/

/* unit_excerpt_font_size Inserting Starts Here */
$unit_excerpt_font_size = "14";
/* unit_excerpt_font_size Inserting Ends Here */

/* unit_excerpt_line_height Inserting Starts Here */
$unit_excerpt_line_height = "18";
/* unit_excerpt_line_height Inserting Ends Here */

/* unit_excerpt_font_style Inserting Starts Here */
$unit_excerpt_font_style = "normal";
/* unit_excerpt_font_style Inserting Ends Here */

/* unit_excerpt_font_color Inserting Starts Here */
$unit_excerpt_font_color = "#333333";
/* unit_excerpt_font_color Inserting Ends Here */
/* unit_excerpt_line_style Inserting Starts Here */
$unit_excerpt_line_style = "belowimg";
/* unit_excerpt_line_style Inserting Ends Here */
/***************************************************************************************/

/* unit_excerpt_font_family Inserting Starts Here */
$unit_excerpt_font_family = "Carrois Gothic";
/* unit_excerpt_font_family Inserting Ends Here */

/* unit_excerpt_font_case Inserting Starts Here */
$unit_excerpt_font_case = "none";
/* unit_excerpt_font_case Inserting Ends Here */

/***************************************************************************************/

/* unit_excerpt_word_limit Inserting Starts Here */
$unit_excerpt_word_limit = "100";
/* unit_excerpt_word_limit Inserting Ends Here */

/***************************************************************************************/

/******************* Local Distribution Field Values Starts Here ***********************/

/* widget_recent_percentage Inserting Starts Here */
$widget_recent_percentage = "50";
/* widget_recent_percentage Inserting Ends Here */

/* widget_popular_percentage Inserting Starts Here */
$widget_popular_percentage = "25";
/* widget_popular_percentage Inserting Ends Here */

/* widget_related_percentage Inserting Starts Here */
$widget_related_percentage = "25";
/* widget_related_percentage Inserting Ends Here */

/******************** Local Distribution Field Values Ends Here ************************/

/****************** Global Distribution Field Values Starts Here ***********************/
$web_content_settings			=	0;
$global_distribution_settings	=	0;
$sponsored_content_settings		=	0;
$own_campaign_settings			=	0;
/* allow_global_checkbox Inserting Starts Here */
$allow_global_checkbox = "on";
/* allow_global_checkbox Inserting Starts Here */

/* global_post_percentage Inserting Starts Here */
$global_post_percentage = "50";
/* global_post_percentage Inserting Starts Here */
/* local_post_percentage Inserting Starts Here */
$mysite_post_percentage = "30";
/* local_post_percentage Inserting Starts Here */
/* ad_post_percentage Inserting Starts Here */
$sponsored_post_percentage = "20";
/* ad_post_percentage Inserting Starts Here */

/* page_takeover_checkbox Inserting Starts Here */
$page_takeover_checkbox = "on";
/* page_takeover_checkbox Inserting Starts Here */

/* allow_global_url_checkbox Inserting Starts Here */
$allow_global_url_checkbox = "on";
/* allow_global_url_checkbox Inserting Starts Here */

/* allow_global_url_textarea Inserting Starts Here */
$allow_global_url_textarea = "";
/* allow_global_url_textarea Inserting Starts Here */

/* global_url_post_percentage Inserting Starts Here */
$global_url_post_percentage = "70";
/* global_url_post_percentage Inserting Starts Here */

/* block_global_url_checkbox Inserting Starts Here */
$block_global_url_checkbox = "on";
/* block_global_url_checkbox Inserting Starts Here */

/* global_blocked_url_textarea Inserting Starts Here */
$global_blocked_url_textarea = "";
/* global_blocked_url_textarea Inserting Starts Here */

/* global_blocked_keywords_textarea Inserting Starts Here */
$global_blocked_keywords_textarea = "";
/* global_blocked_keywords_textarea Inserting Starts Here */

/* global_blocked_categories_textarea Inserting Starts Here */
$global_blocked_categories_textarea = "";
/* global_blocked_categories_textarea Inserting Starts Here */
$camp_site_widget="";
/*******************************************************************************/
