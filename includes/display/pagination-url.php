<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function spinkx_cont_display_widget_content() {
	global $wpdb;
	global $post;
	$widget_id = helperClass::getFilterVar( 'widget_id', INPUT_REQUEST, FILTER_VALIDATE_INT);
	$display_col_count = helperClass::getFilterVar( 'display_col_count', INPUT_REQUEST, FILTER_VALIDATE_INT);
	$ip = null;
	$http_client_ip = helperClass::getFilterVar( 'HTTP_CLIENT_IP', INPUT_SERVER, FILTER_VALIDATE_IP );
	$http_x_forward = helperClass::getFilterVar( 'HTTP_X_FORWARDED_FOR', INPUT_SERVER, FILTER_VALIDATE_IP );
	$remote_address = helperClass::getFilterVar( 'REMOTE_ADDR', INPUT_SERVER, FILTER_VALIDATE_IP );
	if ( $http_client_ip ) {
		$ip = $http_client_ip;
	} elseif ( $http_x_forward ) {
		$ip = $http_x_forward;
	} else {
		$ip = $remote_address;
	}
	$state = 0;
	$country = 0;
	$unique_dynamic_id = helperClass::getFilterVar( 'unique_id', INPUT_REQUEST);
	$ifm_pge = helperClass::getFilterVar('ifm_pge', INPUT_REQUEST, FILTER_VALIDATE_INT);

	if ( ! $ifm_pge ) {
		$in_page_no = 1;
	} else {
		$in_page_no = $ifm_pge;
	}
	if ( $in_page_no >= 2 ) {
		$pids_array = helperClass::getFilterVar('pids', INPUT_REQUEST);
	} else {
		$pids_array = '';
	}
	$settings = get_option( SPINKX_CONT_LICENSE );
	$settings = maybe_unserialize( $settings );
	$widget_array = array();
	$widget_array['site_id'] = $settings['site_id'];
	$widget_array['license_code'] = $settings['license_code'];
	$widget_array['widget_id']	= $widget_id;
	$widget_array['pids']	= $pids_array;
	$header = array(
		'Accept'          => 'application/vnd.heroku+json; version=3',
		'Accept-Encoding' => 'gzip',
		'Content-Type'    => 'application/json',
		'Authorization'   => 'Bearer',
	);
	$widget_array['in_page'] 	= $in_page_no;
	$widget_array['is_ajax'] 	= true;
	$disp_unit_bg_color = helperClass::getFilterVar( 'disp_unit_bg_color', INPUT_REQUEST, FILTER_SANITIZE_STRING);
	if( ! $disp_unit_bg_color) {
		$disp_unit_bg_color = '#fff';
	}
	$al_brnd_styles = ' background: ' . $disp_unit_bg_color . '; display: block; clear: both; ';
	if ( $unique_dynamic_id ) {
		$widget_array['unique_id'] = $unique_dynamic_id;
	}
	$postID = helperClass::getFilterVar('post_src_id', INPUT_REQUEST, FILTER_VALIDATE_INT);
	$user_agent = helperClass::getFilterVar('HTTP_USER_AGENT', INPUT_SERVER);
	$widget_array['post_src_id'] = $postID;
	$widget_array['user_agent'] = ( $user_agent )?$user_agent:'';
	$catArray = get_the_category( $postID );
	$categories = array();
	foreach ( $catArray as $key => $cat ) {
		$categories[] = $cat->cat_name;
	}
	$widget_array['post_cat'] = $categories;
	$widget_array['ip'] = $ip;
	$sx_id = helperClass::getFilterVar( 'sx_id', INPUT_REQUEST);
	
	$widget_array['sx_id'] = $sx_id;
	$widget_array['country'] = $country;
	$widget_array['state'] = $state;
	$req_url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/display';
	$response = helperClass::doCurl( $req_url, $widget_array, true, $header, 10000, false );
	$shortcode_output = '';
	if (!$response) {
		$shortcode_output .= 'No More Articles';
	} else {
		if (strlen(trim($response)) > 0 && $response != 'null' && $response != null) {
			$shortcode_output .= $response;
		} else {
			$shortcode_output .= 'No More Articles';
		}
	}
	echo $shortcode_output;
	exit;
}