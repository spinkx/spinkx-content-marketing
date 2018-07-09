<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wpdb;
$url = SPINKX_CONTENT_BAPI_URL.'/wp-json/spnx/v1/widget/fetchid/'.$access_site_id;
$output = spnxHelper::doCurl( $url );
$response	=	json_decode($output,true);
$widget_auto_id	=	$response['widgetid'];
$categories	=	$response['category'];

$urls =	$response['urls'];
$site_name = $response['site_name'];
$is_mobile_widget = 0;
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
//$unit_bg_color = "#ffffff";
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
$unit_show_views = 1;
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
$prev_img_1 = isset($response['post'][0]['image'])?$response['post'][0]['image']:SPINKX_CONTENT_PLUGIN_URL.'/assets/images/spinkx-intro-bg.jpg';
$prev_img_2 = isset($response['post'][1]['image'])?$response['post'][1]['image']:SPINKX_CONTENT_PLUGIN_URL.'/assets/images/bloggers-make-money.jpg';
$prev_img_3 = isset($response['post'][2]['image'])?$response['post'][2]['image']:SPINKX_CONTENT_PLUGIN_URL.'/assets/images/wordpress-content-marketing-plugin.jpg';
$prev_img_4 = isset($response['post'][3]['image'])?$response['post'][3]['image']:$prev_img_1;
$prev_img_5 = isset($response['post'][4]['image'])?$response['post'][4]['image']:$prev_img_2;
$prev_img_6 = isset($response['post'][5]['image'])?$response['post'][5]['image']:$prev_img_3;

$initial_default_title = 'It takes half your life before you discover life is a do-it-yourself project.';
$initial_default_excerpt = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. sunt in culpa qui officia deserunt mollit anim id est laborum.';
$post_title_1 = isset($response['post'][0]['post_title'])?$response['post'][0]['post_title']:$initial_default_title;
$post_title_2 = isset($response['post'][1]['post_title'])?$response['post'][1]['post_title']:$initial_default_title;
$post_title_3 = isset($response['post'][2]['post_title'])?$response['post'][2]['post_title']:$initial_default_title;
$post_title_4 = isset($response['post'][3]['post_title'])?$response['post'][3]['post_title']:$initial_default_title;
$post_title_5 = isset($response['post'][4]['post_title'])?$response['post'][4]['post_title']:$initial_default_title;
$post_title_6 = isset($response['post'][5]['post_title'])?$response['post'][5]['post_title']:$initial_default_title;

$post_excerpt_1 = isset($response['post'][0]['post_excerpt'])?$response['post'][0]['post_excerpt']:$initial_default_excerpt;
$post_excerpt_2 = isset($response['post'][1]['post_excerpt'])?$response['post'][1]['post_excerpt']:$initial_default_excerpt;
$post_excerpt_3 = isset($response['post'][2]['post_excerpt'])?$response['post'][2]['post_excerpt']:$initial_default_excerpt;
$post_excerpt_4 = isset($response['post'][3]['post_excerpt'])?$response['post'][3]['post_excerpt']:$initial_default_excerpt;
$post_excerpt_5 = isset($response['post'][4]['post_excerpt'])?$response['post'][4]['post_excerpt']:$initial_default_excerpt;
$post_excerpt_6 = isset($response['post'][5]['post_excerpt'])?$response['post'][5]['post_excerpt']:$initial_default_excerpt;

	$post_views_1 = isset($response['post'][0]['post_views'])?$response['post'][0]['post_views']:'0 . 0d';
	if ( isset( $result['post'] ) && $post_views = get_post_meta( $response['post'][0]['id'], 'spx_views', true ) ) {
		$temp_arr = explode('.', $post_views_1);
		$temp_arr[0] = intval($temp_arr[0]) + $post_views;
		$post_views_1 = implode(' .',$temp_arr);
	}
	$post_views_2 = isset($response['post'][1]['post_views'])?$response['post'][1]['post_views']:'0 . 0d';
	if ( isset( $result['post'] ) && $post_views = get_post_meta( $response['post'][1]['id'], 'spx_views', true ) ) {
		$temp_arr = explode('.', $post_views_2);
		$temp_arr[0] = intval($temp_arr[0]) + $post_views;
		$post_views_2 = implode(' .',$temp_arr);
	}
	$post_views_3 = isset($response['post'][2]['post_views'])?$response['post'][2]['post_views']:'0 . 0d';
	if ( isset( $result['post'] ) &&  $post_views = get_post_meta( $response['post'][3]['id'], 'spx_views', true ) ) {
		$temp_arr = explode('.', $post_views_3);
		$temp_arr[0] = intval($temp_arr[0]) + $post_views;
		$post_views_3 = implode(' .',$temp_arr);
	}
	$post_views_4 = isset($response['post'][3]['post_views'])?$response['post'][3]['post_views']:'0 . 0d';
	if ( isset( $result['post'] ) && $post_views = get_post_meta( $response['post'][3]['id'], 'spx_views', true ) ) {
		$temp_arr = explode('.', $post_views_4);
		$temp_arr[0] = intval($temp_arr[0]) + $post_views;
		$post_views_4 = implode(' .',$temp_arr);
	}
	$post_views_5 = isset($response['post'][4]['post_views'])?$response['post'][4]['post_views']:'0 . 0d';
	if ( isset( $result['post'] ) && $post_views = get_post_meta( $response['post'][4]['id'], 'spx_views', true ) ) {
		$temp_arr = explode('.', $post_views_5);
		$temp_arr[0] = intval($temp_arr[0]) + $post_views;
		$post_views_5 = implode(' .',$temp_arr);
	}
	$post_views_6 = isset($response['post'][5]['post_views'])?$response['post'][5]['post_views']:'0 . 0d';
	if ( isset( $result['post'] ) && $post_views = get_post_meta( $response['post'][5]['id'], 'spx_views', true ) ) {
		$temp_arr = explode('.', $post_views_6);
		$temp_arr[0] = intval($temp_arr[0]) + $post_views;
		$post_views_6 = implode(' .',$temp_arr);
	}
	$no_of_columns=1;
	$no_of_row = 1;
	$image_width = 100;
	$image_height = 100;
	$intra_exchange_url_textarea = "";
	$global_blocked_categories_textarea = (isset($response['global_blocked_categories_textarea'])) ? $response['global_blocked_categories_textarea'] : "";