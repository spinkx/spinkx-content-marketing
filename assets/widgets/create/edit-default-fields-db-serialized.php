<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	$url = SPINKX_SERVER_BASEURL.'/wp-json/spnx/v1/widget/get/'.$widget_auto_id.'/'.$access_site_id;
	$output = helperClass::doCurl( $url );
	$result	=	json_decode($output,true);
	$widget_name				=	$result['widget']['widget_name'];
	$unserialized_widget_data	= 	maybe_unserialize( $result['widget']['meta_value'] );
	$categories					=	$result['category'];
	$is_mobile_widget = 0;
	if( $result['widget']['is_mobile_widget'] == 0 ) {
		$site_name = $result['site_name'];
		$no_of_columns = $unserialized_widget_data['no_of_columns'];
		$no_col_mob_view = (!empty($unserialized_widget_data['no_col_mob_view'])) ? $unserialized_widget_data['no_col_mob_view'] : 2;
		$widget_layout_type = $unserialized_widget_data['widget_layout_type'];
		$unit_layout_type = $unserialized_widget_data['unit_layout_type'];
		$unit_spacing = $unserialized_widget_data['unit_spacing'];
		$img_crop_width = $unserialized_widget_data['img_crop_width'];
		$img_crop_height = $unserialized_widget_data['img_crop_height'];
		$img_height = $unserialized_widget_data['img_height'];
		$unit_bg_color = $unserialized_widget_data['unit_bg_color'];
		$unit_fg_color = $unserialized_widget_data['unit_fg_color'];
		$unit_border_width = $unserialized_widget_data['unit_border_width'];
		$unit_border_style = $unserialized_widget_data['unit_border_style'];
		$unit_border_color = $unserialized_widget_data['unit_border_color'];
		$unit_border_radius = $unserialized_widget_data['unit_border_radius'];
		$unit_title_font_size = $unserialized_widget_data['unit_title_font_size'];
		$unit_title_line_height = $unserialized_widget_data['unit_title_line_height'];
		$unit_title_font_style = $unserialized_widget_data['unit_title_font_style'];
		$unit_title_font_color = $unserialized_widget_data['unit_title_font_color'];
		$unit_title_font_family = $unserialized_widget_data['unit_title_font_family'];
		$unit_title_font_case = $unserialized_widget_data['unit_title_font_case'];
		$unit_add_line_style = $unserialized_widget_data['unit_add_line_style'];
		$unit_excerpt_font_size = $unserialized_widget_data['unit_excerpt_font_size'];
		$unit_excerpt_line_height = $unserialized_widget_data['unit_excerpt_line_height'];
		$unit_excerpt_font_style = $unserialized_widget_data['unit_excerpt_font_style'];
		$unit_excerpt_font_color = $unserialized_widget_data['unit_excerpt_font_color'];
		$unit_excerpt_font_family = $unserialized_widget_data['unit_excerpt_font_family'];
		$unit_excerpt_font_case = $unserialized_widget_data['unit_excerpt_font_case'];
		$unit_excerpt_line_style = (isset($unserialized_widget_data['unit_excerpt_line_style'])) ? $unserialized_widget_data['unit_excerpt_line_style'] : 'belowimg';
		$unit_excerpt_word_limit = $unserialized_widget_data['unit_excerpt_word_limit'];
		$unit_show_views = isset($unserialized_widget_data['unit_show_views']) ? $unserialized_widget_data['unit_show_views'] : 0;
		$widget_recent_percentage = $unserialized_widget_data['widget_recent_percentage'];
		$widget_popular_percentage = $unserialized_widget_data['widget_popular_percentage'];
		$widget_related_percentage = $unserialized_widget_data['widget_related_percentage'];
		$allow_global_url_checkbox = $unserialized_widget_data['allow_global_url_checkbox'];
		$block_global_url_checkbox = $unserialized_widget_data['block_global_url_checkbox'];

		$global_post_percentage = $unserialized_widget_data['global_post_percentage'];
		$mysite_post_percentage = (isset($unserialized_widget_data['local_post_percentage'])) ? $unserialized_widget_data['local_post_percentage'] : 0;
		$sponsored_post_percentage = (isset($unserialized_widget_data['ad_post_percentage'])) ? $unserialized_widget_data['ad_post_percentage'] : 0;
		$global_blocked_url_textarea = $unserialized_widget_data['global_blocked_url_textarea'];
		$global_blocked_keywords_textarea = $unserialized_widget_data['global_blocked_keywords_textarea'];
		$global_blocked_categories_textarea = $unserialized_widget_data['global_blocked_categories_textarea'];
		$camp_site_widget = (isset($unserialized_widget_data['campaign_widget'])) ? $unserialized_widget_data['campaign_widget'] : '';
		$web_content_settings = (isset($unserialized_widget_data['web_content_settings'])) ? $unserialized_widget_data['web_content_settings'] : 0;
		$global_distribution_settings = (isset($unserialized_widget_data['global_content_settings'])) ? $unserialized_widget_data['global_content_settings'] : 0;
		$sponsored_content_settings = (isset($unserialized_widget_data['sponsor_content_settings'])) ? $unserialized_widget_data['sponsor_content_settings'] : 0;
		$own_campaign_settings = (isset($unserialized_widget_data['campaign_content_settings'])) ? $unserialized_widget_data['campaign_content_settings'] : 0;
		/***************************************************************************************/
		$unit_add_line_width = (isset($unserialized_widget_data['unit_add_line_width'])) ? $unserialized_widget_data['unit_add_line_width'] : 0;
		$allow_global_checkbox = (isset($unserialized_widget_data['allow_global_checkbox'])) ? $unserialized_widget_data['allow_global_checkbox'] : '';
		$unit_add_line_color = (isset($unserialized_widget_data['unit_add_line_color'])) ? $unserialized_widget_data['unit_add_line_color'] : '#fff;';
		$page_takeover_checkbox = (isset($unserialized_widget_data['page_takeover_checkbox'])) ? $unserialized_widget_data['page_takeover_checkbox'] : '';
		$allow_global_url_textarea = (isset($unserialized_widget_data['allow_global_url_textarea'])) ? $unserialized_widget_data['allow_global_url_textarea'] : '';
		$global_url_post_percentage = (isset($unserialized_widget_data['global_url_post_percentage'])) ? $unserialized_widget_data['global_url_post_percentage'] : 0;
		//Vikash get data and put in variable


		$prev_img_1 = isset($result['post'][0]['image']) ? $result['post'][0]['image'] : SPINKX_CONTENT_PLUGIN_URL . '/assets/images/spinkx-intro-bg.jpg';
		$prev_img_2 = isset($result['post'][1]['image']) ? $result['post'][1]['image'] : SPINKX_CONTENT_PLUGIN_URL . '/assets/images/bloggers-make-money.jpg';
		$prev_img_3 = isset($result['post'][2]['image']) ? $result['post'][2]['image'] : SPINKX_CONTENT_PLUGIN_URL . '/assets/images/wordpress-content-marketing-plugin.jpg';
		$prev_img_4 = isset($result['post'][3]['image']) ? $result['post'][3]['image'] : $prev_img_1;
		$prev_img_5 = isset($result['post'][4]['image']) ? $result['post'][4]['image'] : $prev_img_2;
		$prev_img_6 = isset($result['post'][5]['image']) ? $result['post'][5]['image'] : $prev_img_3;

		$initial_default_title = 'It takes half your life before you discover life is a do-it-yourself project.';
		$initial_default_excerpt = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. sunt in culpa qui officia deserunt mollit anim id est laborum.';
		$post_title_1 = isset($result['post'][0]['post_title']) ? $result['post'][0]['post_title'] : $initial_default_title;
		$post_title_2 = isset($result['post'][1]['post_title']) ? $result['post'][1]['post_title'] : $initial_default_title;
		$post_title_3 = isset($result['post'][2]['post_title']) ? $result['post'][2]['post_title'] : $initial_default_title;
		$post_title_4 = isset($result['post'][3]['post_title']) ? $result['post'][3]['post_title'] : $initial_default_title;
		$post_title_5 = isset($result['post'][4]['post_title']) ? $result['post'][4]['post_title'] : $initial_default_title;
		$post_title_6 = isset($result['post'][5]['post_title']) ? $result['post'][5]['post_title'] : $initial_default_title;

		$post_excerpt_1 = isset($result['post'][0]['post_excerpt']) ? $result['post'][0]['post_excerpt'] : $initial_default_excerpt;
		$post_excerpt_2 = isset($result['post'][1]['post_excerpt']) ? $result['post'][1]['post_excerpt'] : $initial_default_excerpt;
		$post_excerpt_3 = isset($result['post'][2]['post_excerpt']) ? $result['post'][2]['post_excerpt'] : $initial_default_excerpt;
		$post_excerpt_4 = isset($result['post'][3]['post_excerpt']) ? $result['post'][3]['post_excerpt'] : $initial_default_excerpt;
		$post_excerpt_5 = isset($result['post'][4]['post_excerpt']) ? $result['post'][4]['post_excerpt'] : $initial_default_excerpt;
		$post_excerpt_6 = isset($result['post'][5]['post_excerpt']) ? $result['post'][5]['post_excerpt'] : $initial_default_excerpt;
		$post_views = 0;

		$post_views_1 = isset($result['post'][0]['post_views']) ? $result['post'][0]['post_views'] : '0 . 0d';
		if (isset($result['post']) && $post_views = get_post_meta($result['post'][0]['id'], 'spx_views', TRUE)) {
			$temp_arr = explode('.', $post_views_1);
			$temp_arr[0] = intval($temp_arr[0]) + $post_views;
			$post_views_1 = implode(' .', $temp_arr);
		}
		$post_views_2 = isset($result['post'][1]['post_views']) ? $result['post'][1]['post_views'] : '0 . 0d';
		if (isset($result['post']) && $post_views = get_post_meta($result['post'][1]['id'], 'spx_views', TRUE)) {
			$temp_arr = explode('.', $post_views_2);
			$temp_arr[0] = intval($temp_arr[0]) + $post_views;
			$post_views_2 = implode(' .', $temp_arr);
		}
		$post_views_3 = isset($result['post'][2]['post_views']) ? $result['post'][2]['post_views'] : '0 . 0d';
		if (isset($result['post']) && $post_views = get_post_meta($result['post'][3]['id'], 'spx_views', TRUE)) {
			$temp_arr = explode('.', $post_views_3);
			$temp_arr[0] = intval($temp_arr[0]) + $post_views;
			$post_views_3 = implode(' .', $temp_arr);
		}
		$post_views_4 = isset($result['post'][3]['post_views']) ? $result['post'][3]['post_views'] : '0 . 0d';
		if (isset($result['post']) && $post_views = get_post_meta($result['post'][3]['id'], 'spx_views', TRUE)) {
			$temp_arr = explode('.', $post_views_4);
			$temp_arr[0] = intval($temp_arr[0]) + $post_views;
			$post_views_4 = implode(' .', $temp_arr);
		}
		$post_views_5 = isset($result['post'][4]['post_views']) ? $result['post'][4]['post_views'] : '0 . 0d';
		if (isset($result['post']) && $post_views = get_post_meta($result['post'][4]['id'], 'spx_views', TRUE)) {
			$temp_arr = explode('.', $post_views_5);
			$temp_arr[0] = intval($temp_arr[0]) + $post_views;
			$post_views_5 = implode(' .', $temp_arr);
		}
		$post_views_6 = isset($result['post'][5]['post_views']) ? $result['post'][5]['post_views'] : '0 . 0d';
		if (isset($result['post']) && $post_views = get_post_meta($result['post'][5]['id'], 'spx_views', TRUE)) {
			$temp_arr = explode('.', $post_views_6);
			$temp_arr[0] = intval($temp_arr[0]) + $post_views;
			$post_views_6 = implode(' .', $temp_arr);
		}
	} else {
		$is_mobile_widget = 1;
		$own_campaign_settings = $sponsored_content_settings = $web_content_settings = $web_content_settings = $global_distribution_settings = $web_content_settings = $global_distribution_settings = 0;
		$allow_global_url_checkbox = $block_global_url_checkbox = $camp_site_widget = $mysite_post_percentage = $widget_popular_percentage = $global_post_percentage = $widget_recent_percentage = 0;
		$widget_related_percentage = $sponsored_post_percentage = $unit_bg_color = $unit_fg_color = $unit_border_color = $unit_title_font_color = $unit_add_line_color = $unit_excerpt_font_color = 0;
		$global_blocked_categories_textarea = $global_blocked_keywords_textarea = $global_blocked_url_textarea = $no_of_columns = $widget_recent_percentage = $sponsored_post_percentage = $global_url_post_percentage = $widget_layout_type = $unit_add_line_style = $img_crop_height = $img_crop_width = $prev_img_1 = $prev_img_2 = $prev_img_3 = $prev_img_4 = $prev_img_5 = $prev_img_6 = $initial_default_title = $initial_default_excerpt = $post_title_1 = $post_title_2 = $post_title_3 = $post_title_4 = $post_excerpt_5 = $post_title_6 = $post_excerpt_1 = $post_excerpt_2 = $post_excerpt_3 = $post_excerpt_4 = $post_excerpt_5 = $post_excerpt_6 = 0;

		$web_enable = (isset($unserialized_widget_data['web_enable']) && strtolower($unserialized_widget_data['web_enable']) == 'on') ? 1 : 0;
		$sponsor_enable = (isset($unserialized_widget_data['sponsor_enable']) && strtolower($unserialized_widget_data['sponsor_enable']) == 'on') ? 1 : 0;
		$auto_boost_post = (isset($unserialized_widget_data['auto_boost_post']) && strtolower($unserialized_widget_data['auto_boost_post']) == 'on') ? 1 : 0;
		$manual_boost_post = (isset($unserialized_widget_data['manual_boost_post']) && strtolower($unserialized_widget_data['manual_boost_post']) == 'on') ? 1 : 0;
		$global_post = (isset($unserialized_widget_data['global_post']) && strtolower($unserialized_widget_data['global_post']) == 'on') ? 1 : 0;

		$global_post_percentage = isset($unserialized_widget_data['global_post_percentage']) ? $unserialized_widget_data['global_post_percentage'] : 0;
		$mysite_post_percentage = (isset($unserialized_widget_data['local_post_percentage'])) ? $unserialized_widget_data['local_post_percentage'] : 0;
		$sponsored_post_percentage = (isset($unserialized_widget_data['ad_post_percentage'])) ? $unserialized_widget_data['ad_post_percentage'] : 0;
		$global_blocked_url_textarea = (isset($unserialized_widget_data['global_blocked_url_textarea'])) ? $unserialized_widget_data['global_blocked_url_textarea'] : "";
		$global_blocked_keywords_textarea = (isset($unserialized_widget_data['global_blocked_keywords_textarea'])) ? $unserialized_widget_data['global_blocked_keywords_textarea'] : "";
		$global_blocked_categories_textarea = (isset($unserialized_widget_data['global_blocked_categories_textarea'])) ? $unserialized_widget_data['global_blocked_categories_textarea'] : "";
		$camp_site_widget = (isset($unserialized_widget_data['campaign_widget'])) ? $unserialized_widget_data['campaign_widget'] : '';
		$web_content_settings = (isset($unserialized_widget_data['web_content_settings'])) ? $unserialized_widget_data['web_content_settings'] : 0;
		$global_distribution_settings = (isset($unserialized_widget_data['global_content_settings'])) ? $unserialized_widget_data['global_content_settings'] : 0;
		$sponsored_content_settings = (isset($unserialized_widget_data['sponsor_content_settings'])) ? $unserialized_widget_data['sponsor_content_settings'] : 0;
		$own_campaign_settings = (isset($unserialized_widget_data['campaign_content_settings'])) ? $unserialized_widget_data['campaign_content_settings'] : 0;
	}

	$allow_global_url_textarea = (isset($unserialized_widget_data['allow_global_url_textarea'])) ? $unserialized_widget_data['allow_global_url_textarea'] : '';
	$global_url_post_percentage = (isset($unserialized_widget_data['global_url_post_percentage'])) ? $unserialized_widget_data['global_url_post_percentage'] : 0;
	//Vikash get data and put in variable

    if( isset($auto_boost_post) && $auto_boost_post) {
        $manual_boost_post = 0;
    }
