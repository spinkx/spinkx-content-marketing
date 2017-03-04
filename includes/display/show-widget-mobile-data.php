<?php
global $wpdb;
global $all_post_ids;
global $post;
$widget_id = helperClass::getFilterVar('widget_id', INPUT_REQUEST, FILTER_VALIDATE_INT);;
$ajxrequrl = SPINKX_SERVER_BASEURL;
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
$inf_url_msnry_url = admin_url( 'admin-ajax.php' ).'?action=spinkx_cont_display_widget_content&ifm_pge=';
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
$is_ajax = helperClass::getFilterVar( 'is_ajax', INPUT_REQUEST );
if ( $is_ajax ) {
	$is_ajax = null;
} else {
	wp_enqueue_script( 'pixel-js', $ajxrequrl . '/spinkxut.js' );
}
$settings = get_option( SPINKX_CONT_LICENSE );
$settings = maybe_unserialize( $settings );
$widget_array = array();
$widget_array['site_id'] = $settings['site_id'];
$widget_array['license_code'] = $settings['license_code'];
$widget_array['widget_id']	= $widget_id;
$json_widget_array = base64_encode( maybe_serialize( $widget_array ) );
$widgetData = array( 'widget_array' => $json_widget_array );
$curl_url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/settings';
$widget_settings = helperClass::doCurl( $curl_url, $widgetData, false );
$display_layout_type = 'masonry';
$display_col_count = 3;
$disp_unit_bg_color = 'rgba(255,255,255, 0.9)';
	$al_brnd_styles = ' clear: both; ';
if ( $widget_settings ) {
	$settings_array = (array) ( json_decode( $widget_settings ) );
	if ( isset( $settings_array['widget_layout_type'] ) ) {
		$display_layout_type = $settings_array['widget_layout_type'];
	}
	if ( isset( $settings_array['no_of_columns'] ) ) {
		$display_col_count = $settings_array['no_of_columns'];
	}
	if ( isset( $settings_array['unit_bg_color'] ) ) {
		//$disp_unit_bg_color 	= $settings_array['unit_bg_color'];
		$al_brnd_styles = ' background-color: ' . $disp_unit_bg_color . '; clear: both; ';
	} else {
		$al_brnd_styles = ' display:  clear: both; ';
	}
	$al_brnd_styles = ' clear: both; position: relative;padding-top:8px;z-index:999997;';
};
$widget_array['in_page'] 	= $in_page_no;
if ( $unique_dynamic_id ) {
	$widget_array['unique_id'] = $unique_dynamic_id;
}
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$widget_array['post_src_id'] = $post->ID;
$widget_array['user_agent'] = $user_agent;
$catArray = get_the_category( $post->ID );
$categories = array();
foreach ( $catArray as $key => $cat ) {
	$categories[] = $cat->cat_name;
}
$widget_array['post_cat'] = $categories;
if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
	$ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
	$ip = $_SERVER['REMOTE_ADDR'];
}
$widget_array['ip'] = $ip;
$widget_array['sx_id'] = isset( $_REQUEST['sx_id'] )?$_REQUEST['sx_id']:0;
$widget_array['country'] = $country;
$widget_array['state'] = $state;
$al_brnd_content_opacity = null;
$al_brnd_content_opacity = ';'; 
$content_id = 'id="al_brnd_content_mobile"';
$header = array(
	'Accept'          => 'application/vnd.heroku+json; version=3',
	'Accept-Encoding' => 'gzip',
	'Content-Type' => 'application/json',
	'Authorization' => 'Bearer',
);
$data_column = '';
if ($display_layout_type == 'masonry') {
	$data_column = 'data-column="' . $display_col_count . '" ';
} else {
	$data_column = 'data-column="1" ';
}
$req_url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/display';
$response = helperClass::doCurl($req_url, $widget_array, TRUE, $header, 10000, false);
if (!$response) {
	$shortcode_output .= '<br/>Access Denied!';
} else {
	$shortcode_output .= '<div class="middle-div"></div><div style="' . $al_brnd_styles . $al_brnd_content_opacity . '" ' . $content_id . ' data-role="collapsible" class="al_brnd_content al_brnd_content_' . $widget_id . ' display-units-' . $display_col_count . ' " wid="' . $widget_id . '" > <ul class="waterfall" id="waterfall-'.$widget_id.'" ' . $data_column . ' >';
	if (strlen(trim($response)) > 0) {
		if($response !== 'error' ) {
			$shortcode_output .= $response;
			$shortcode_output .= '</ul></div> <div style="clear:both;"></div>';
		}
	} else {
		$shortcode_output .= 'No More Articles';
	}
}


