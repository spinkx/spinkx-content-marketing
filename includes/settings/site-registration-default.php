<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly		
	$site_id = false;
	global $wpdb;
	$url = esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/site/create' );

	$mflag = is_multisite();
if ( $mflag ) {
	$siteArr = $wpdb->get_results( 'SELECT blog_id FROM `wp_blogs` WHERE public = 1', ARRAY_A );
	// $siteArr = wp_get_sites(array('public' => 1));
} else {
	$siteArr = array( array( 'blog_id' => get_current_blog_id() ) );
}
	$data = array();
foreach ( $siteArr as $currentSite ) {
	if ( $mflag ) {
		switch_to_blog( $currentSite['blog_id'] );
	}
		$data['site_email'] = get_option( 'admin_email' );
		$data['site_name'] = get_bloginfo( 'name' );
		$data['site_url'] = get_site_url();
		$data['agree'] = 'on';
	if ( class_exists( 'Domainmap_Utils' ) ) {
		$obj = new Domainmap_Utils();
		$temp = $obj->get_mapped_domain();
		if ( $temp ) {
			$data['site_url'] = $temp;
		}
		// echo $selected_url.'v';
	}
	    $data['sflag'] = 'site_create';
		$response = helperClass::doCurl( $url, $data );

	if ( $response && ! $site_id ) {
		$output = json_decode( $response, true );

		if ( ! isset( $output['message'] ) ) {
			if ( ! isset( $output['user_id'] ) ) {
				$output['reg_user'] = 0;
			} else {
				$output['reg_user'] = $output['user_id'];
			}
			$s = maybe_serialize( $output );
			update_option( SPINKX_CONT_LICENSE, $s );
			// }
			// sync posts here
			$settings = get_option( SPINKX_CONT_LICENSE );

			$settings = maybe_unserialize( $settings );

			$settings['current_blog_id'] = $currentSite['blog_id'];
			$settings['site_url'] = $data['site_url'];
			$response = spinkx_cont_post_sync($settings);

			if ( $response || true ) {
					$post = helperClass::getFilterPost();
					$post['site_id'] = $settings['site_id'];
					$postdata = array();
					// vikash Default widget creation and default settings insertion
					$postdata['widget_name'] = 'Demo Widget';
					/* no_of_columns Inserting Starts Here */
					$postdata['no_of_columns'] = '1';
					/*
				 no_of_columns Inserting Starts Here */
					/* no_of_columns Inserting Starts Here */
					$postdata['no_col_mob_view'] = '1';
					/*
				 no_of_columns Inserting Starts Here */
					/* widget_layout_type Inserting Starts Here 'fixed-width' or 'masonry'*/
					$postdata['widget_layout_type'] = 'masonry';
					/*
				 widget_layout_type Inserting Starts Here */
					/* unit_layout_type Inserting Starts Here */
					$postdata['unit_layout_type'] = 'tall';
					/*
				 unit_layout_type Inserting Starts Here */
					/* unit_spacing Inserting Starts Here */
					$postdata['unit_spacing'] = '20';
					/* unit_spacing Inserting Starts Here */

					/* img_crop_width Inserting Starts Here */
					$postdata['img_crop_width'] = '236';
					/* img_crop_width Inserting Starts Here */

					/* img_crop_height Inserting Starts Here */
					$postdata['img_crop_height'] = '300';
					/* img_crop_height Inserting Starts Here */
					$postdata['img_height'] = '';
					$postdata['img_width'] = '400';


					/* unit_bg_color Inserting Starts Here */
					$postdata['unit_bg_color'] = '#ffffff';
					/* unit_bg_color Inserting Ends Here */

					/* unit_fg_color Inserting Starts Here */
					$postdata['unit_fg_color'] = '#fefefe';
					/* unit_fg_color Inserting Ends Here */



					/* unit_border_width Inserting Starts Here */
					$postdata['unit_border_width'] = '1';
					/* unit_border_width Inserting Ends Here */

					/* unit_border_style Inserting Starts Here */
					$postdata['unit_border_style'] = 'solid';
					/* unit_border_style Inserting Ends Here */

					/* unit_border_color Inserting Starts Here */
					$postdata['unit_border_color'] = '#d8d8d8';
					/* unit_border_color Inserting Ends Here */

					/* unit_border_radius Inserting Starts Here */
					$postdata['unit_border_radius'] = '6';
					/* unit_border_radius Inserting Ends Here */



					/* unit_title_font_size Inserting Starts Here */
					$postdata['unit_title_font_size'] = '14';
					/* unit_title_font_size Inserting Ends Here */

					/* unit_title_line_height Inserting Starts Here */
					$postdata['unit_title_line_height'] = '18';
					/* unit_title_line_height Inserting Ends Here */

					/* unit_title_font_style Inserting Starts Here */
					$postdata['unit_title_font_style'] = 'bold';
					/* unit_title_font_style Inserting Ends Here */

					/* unit_title_font_color Inserting Starts Here */
					$postdata['unit_title_font_color'] = '#000000';
					/* unit_title_font_color Inserting Ends Here */



					/* unit_title_font_family Inserting Starts Here */
					$postdata['unit_title_font_family'] = 'Carrois Gothic';
					/* unit_title_font_family Inserting Ends Here */

					/* unit_title_font_case Inserting Starts Here */
					$postdata['unit_title_font_case'] = 'none';
					/* unit_title_font_case Inserting Ends Here */



					/* unit_add_line_width Inserting Starts Here */
					$postdata['unit_add_line_width'] = '4';
					/* unit_add_line_width Inserting Ends Here */

					/* unit_add_line_style Inserting Starts Here */
					$postdata['unit_add_line_style'] = 'belowimg';
					/* unit_add_line_style Inserting Ends Here */

					/* unit_add_line_color Inserting Starts Here */
					$postdata['unit_add_line_color'] = '#E36C09';
					/* unit_add_line_color Inserting Ends Here */



					/* unit_excerpt_font_size Inserting Starts Here */
					$postdata['unit_excerpt_font_size'] = '14';
					/* unit_excerpt_font_size Inserting Ends Here */

					/* unit_excerpt_line_height Inserting Starts Here */
					$postdata['unit_excerpt_line_height'] = '18';
					/* unit_excerpt_line_height Inserting Ends Here */

					/* unit_excerpt_font_style Inserting Starts Here */
					$postdata['unit_excerpt_font_style'] = 'normal';
					/* unit_excerpt_font_style Inserting Ends Here */

					/* unit_excerpt_font_color Inserting Starts Here */
					$postdata['unit_excerpt_font_color'] = '#333333';
					/*
				 unit_excerpt_font_color Inserting Ends Here */
					/* unit_excerpt_line_style Inserting Starts Here */
					$postdata['unit_excerpt_line_style'] = 'belowimg';
					/*
				 unit_excerpt_line_style Inserting Ends Here */


					/* unit_excerpt_font_family Inserting Starts Here */
					$postdata['unit_excerpt_font_family'] = 'Carrois Gothic';
					/* unit_excerpt_font_family Inserting Ends Here */

					/* unit_excerpt_font_case Inserting Starts Here */
					$postdata['unit_excerpt_font_case'] = 'none';
					/* unit_excerpt_font_case Inserting Ends Here */



					/* unit_excerpt_word_limit Inserting Starts Here */
					$postdata['unit_excerpt_word_limit'] = '100';
					/* unit_excerpt_word_limit Inserting Ends Here */
					$postdata['web_enable'] = 'on';
					$postdata['global_post'] = 'on';
					$postdata['sponsor_enable'] = 'on';
					$postdata['auto_boost_post'] = 'off';
					$postdata['manual_boost_post'] = 'on';
					$post['form_serialized_data'] = http_build_query( $postdata );
					$post['wt'] = '1';
					$surl = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/create';
					$response = helperClass::doCurl( $surl, $post );
					$response = json_decode($response);
					if(is_int($response) && $response > 0 ) {
						$settings['default_widget_id'] = $response;
						$s = maybe_serialize( $settings );
						update_option( SPINKX_CONT_LICENSE, $s );
					}
			}
		}
	}
}


