<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	$url = SPINKX_SERVER_BASEURL.'/wp-json/spnx/v1/widget/get/'.$widget_auto_id.'/'.$access_site_id;
	$output = helperClass::doCurl( $url );
	$result	=	json_decode($output,true);
	$widget_name				=	$result['widget']['widget_name'];
	$unserialized_widget_data	= 	maybe_unserialize( $result['widget']['meta_value'] );
	$categories					=	$result['category'];
	$no_of_columns				=	$unserialized_widget_data['no_of_columns'];
	$no_col_mob_view			=	(!empty($unserialized_widget_data['no_col_mob_view']))?$unserialized_widget_data['no_col_mob_view']:2;
    $widget_layout_type 		=	$unserialized_widget_data['widget_layout_type'];
	$unit_layout_type 		=	$unserialized_widget_data['unit_layout_type'];
    $unit_spacing				=	$unserialized_widget_data['unit_spacing'];
    $img_crop_width				=	$unserialized_widget_data['img_crop_width'];
    $img_crop_height			=	$unserialized_widget_data['img_crop_height'];
	$img_height					=	$unserialized_widget_data['img_height'];
    $unit_bg_color				=	$unserialized_widget_data['unit_bg_color'];
    $unit_fg_color				=	$unserialized_widget_data['unit_fg_color'];
    $unit_border_width			=	$unserialized_widget_data['unit_border_width'];
    $unit_border_style			=	$unserialized_widget_data['unit_border_style'];
    $unit_border_color			=	$unserialized_widget_data['unit_border_color'];
    $unit_border_radius			=	$unserialized_widget_data['unit_border_radius'];
    $unit_title_font_size		=	$unserialized_widget_data['unit_title_font_size'];
    $unit_title_line_height		=	$unserialized_widget_data['unit_title_line_height'];
    $unit_title_font_style		=	$unserialized_widget_data['unit_title_font_style'];
    $unit_title_font_color		=	$unserialized_widget_data['unit_title_font_color'];
    $unit_title_font_family		=	$unserialized_widget_data['unit_title_font_family'];
    $unit_title_font_case		=	$unserialized_widget_data['unit_title_font_case'];
	$unit_add_line_style		=	$unserialized_widget_data['unit_add_line_style'];
    $unit_excerpt_font_size 	=	$unserialized_widget_data['unit_excerpt_font_size'];
    $unit_excerpt_line_height	=	$unserialized_widget_data['unit_excerpt_line_height'];
    $unit_excerpt_font_style	=	$unserialized_widget_data['unit_excerpt_font_style'];
    $unit_excerpt_font_color	=	$unserialized_widget_data['unit_excerpt_font_color'];
    $unit_excerpt_font_family	=	$unserialized_widget_data['unit_excerpt_font_family'];
    $unit_excerpt_font_case		=	$unserialized_widget_data['unit_excerpt_font_case'];
	$unit_excerpt_line_style	=	(isset($unserialized_widget_data['unit_excerpt_line_style']))?$unserialized_widget_data['unit_excerpt_line_style']:'belowimg';
    $unit_excerpt_word_limit	=	$unserialized_widget_data['unit_excerpt_word_limit'];
    $widget_recent_percentage	=	$unserialized_widget_data['widget_recent_percentage'];
    $widget_popular_percentage	=	$unserialized_widget_data['widget_popular_percentage'];
    $widget_related_percentage	=	$unserialized_widget_data['widget_related_percentage'];
	$allow_global_url_checkbox	=	$unserialized_widget_data['allow_global_url_checkbox'];
	$block_global_url_checkbox	=	$unserialized_widget_data['block_global_url_checkbox'];
    $global_post_percentage		=	$unserialized_widget_data['global_post_percentage'];
	$mysite_post_percentage		=	(isset($unserialized_widget_data['local_post_percentage']))?$unserialized_widget_data['local_post_percentage']:0;
	$sponsored_post_percentage	=	(isset($unserialized_widget_data['ad_post_percentage']))?$unserialized_widget_data['ad_post_percentage']:0;
    $global_blocked_url_textarea		=	$unserialized_widget_data['global_blocked_url_textarea'];
    $global_blocked_keywords_textarea	=	$unserialized_widget_data['global_blocked_keywords_textarea'];
    $global_blocked_categories_textarea	=	$unserialized_widget_data['global_blocked_categories_textarea'];
	$camp_site_widget					=	(isset($unserialized_widget_data['campaign_widget']))?$unserialized_widget_data['campaign_widget']:'';
	$web_content_settings				=	(isset($unserialized_widget_data['web_content_settings']))?$unserialized_widget_data['web_content_settings']:0;
	$global_distribution_settings		=	(isset($unserialized_widget_data['global_content_settings']))?$unserialized_widget_data['global_content_settings']:0;
	$sponsored_content_settings			=	(isset($unserialized_widget_data['sponsor_content_settings']))?$unserialized_widget_data['sponsor_content_settings']:0;
	$own_campaign_settings				=	(isset($unserialized_widget_data['campaign_content_settings']))?$unserialized_widget_data['campaign_content_settings']:0;
	/***************************************************************************************/
	$unit_add_line_width		=	(isset($unserialized_widget_data['unit_add_line_width']))?$unserialized_widget_data['unit_add_line_width']:0;
    $allow_global_checkbox		=	(isset($unserialized_widget_data['allow_global_checkbox']))?$unserialized_widget_data['allow_global_checkbox']:'';
    $unit_add_line_color		=	(isset($unserialized_widget_data['unit_add_line_color']))?$unserialized_widget_data['unit_add_line_color']:'#fff;';
    $page_takeover_checkbox		=	(isset($unserialized_widget_data['page_takeover_checkbox']))?$unserialized_widget_data['page_takeover_checkbox']:'';
    $allow_global_url_textarea	=	(isset($unserialized_widget_data['allow_global_url_textarea']))?$unserialized_widget_data['allow_global_url_textarea']:'';
    $global_url_post_percentage	=	(isset($unserialized_widget_data['global_url_post_percentage']))?$unserialized_widget_data['global_url_post_percentage']:0;

    //Vikash get data and put in variable
    $web_enable = (isset($unserialized_widget_data['web_enable']) && strtolower($unserialized_widget_data['web_enable']) == 'on')?1:0;
    $sponsor_enable = (isset($unserialized_widget_data['sponsor_enable']) && strtolower($unserialized_widget_data['sponsor_enable']) == 'on')?1:0;
    $auto_boost_post = (isset($unserialized_widget_data['auto_boost_post']) && strtolower($unserialized_widget_data['auto_boost_post']) == 'on')?1:0;
    $manual_boost_post = (isset($unserialized_widget_data['manual_boost_post']) && strtolower($unserialized_widget_data['manual_boost_post']) == 'on')?1:0;
    $global_post = (isset($unserialized_widget_data['global_post']) && strtolower($unserialized_widget_data['global_post']) == 'on')?1:0;
    if($auto_boost_post) {
        $manual_boost_post = 0;
    }
