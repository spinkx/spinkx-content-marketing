<?php
/**
 *
 * This function check site & show notice if due_date expired
 * spinkx_cont_get_dashbaord_statics()
 *
 * @return void
 * @internal param $void
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function spinkx_cont_get_dashbaord_statics() {
	$settings = maybe_unserialize( get_option( SPINKX_CONT_LICENSE ) );
	$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/dashboard';
	$post['site_id'] = $settings['site_id'];
	$from_date = helperClass::getFilterVar( 'from_date' );
	$to_date = helperClass::getFilterVar( 'to_date' );
	$post['from_date'] = $from_date;
	$post['to_date'] = $to_date;
	$output = helperClass::doCurl( $url, $post );
	echo $output;
	wp_die();
}

function spinkx_cont_new_hook() {
	$settings = get_option( SPINKX_CONT_LICENSE );
	$settings = maybe_unserialize( $settings );
	$post = helperClass::getFilterPost();
	$post['site_id'] = $settings['site_id'];
	$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/content-playlist/variation/create';
	$output = helperClass::doCurl( $url, $post );
	echo jjson_deode($output);
	wp_die();
}
function spinkx_cont_edit_hook() {
	$post = helperClass::getFilterPost();
	if ( isset( $post['type'] ) && $post['type'] == 'status_update' ) {
		//$url = SPINKX_SERVER_BASEURL . '/wp-admin/admin-ajax.php?action=spinkx_server_play_pause_hook';
		$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/content-playlist/variation/update';
	} else {
		$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/content-playlist/variation/update';
	}
	$settings = get_option( SPINKX_CONT_LICENSE );
	$settings = maybe_unserialize( $settings );
	$post['site_id'] = $settings['site_id'];
	$output = helperClass::doCurl( $url, $post );
	unset( $post );
	echo json_deode($output);
	wp_die();
}

function spinkx_cont_save_hook() {
	$post = helperClass::getFilterPost();
	$post['post_full_image'] = wp_get_attachment_image_src( $post['image_aid'],'full' )[0];
	$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/content-playlist/variation/save';
	$output = helperClass::doCurl( $url, $post );
	echo json_decode($output);
	wp_die();
}

/**  Checks if a url exists
 * TODO: refactor it into a utility library script
 *
 * @param $url to check
 * @return bool true if exists else false
 */
function spinkx_cont_is_404( $url ) {
	$handle = curl_init( $url );
	curl_setopt( $handle,  CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $handle, CURLOPT_NOBODY, true );
	curl_setopt( $handle, CURLOPT_FOLLOWLOCATION, true );

	/* Get the HTML or whatever is linked in $url. */
	$response = curl_exec( $handle );

	/* Check for 404 (file not found). */
	$httpCode = curl_getinfo( $handle, CURLINFO_HTTP_CODE );
	curl_close( $handle );

	/* If the document has loaded successfully without any redirection or error */
	if ( $httpCode >= 200 && $httpCode < 300 ) {
		return false;
	} else {
		return true;
	}
}

/** Downloads remote image and attaches to this Post
 *TODO: refactor it into a utility library script
 * @param $file URL of file to download
 * @param $parent_post_id POst to which to attach this file
 */
function spinkx_cont_download_external_media( $file, $parent_post_id ) {
	$filename = basename( $file );
	$upload_file = wp_upload_bits( $filename, null, file_get_contents( $file ) );
	if ( ! $upload_file['error'] ) {
		$wp_filetype = wp_check_filetype( $filename, null );
		$attachment = array(
			'post_mime_type' => $wp_filetype['type'],
			'post_parent' => $parent_post_id,
			'post_title' => preg_replace( '/\.[^.]+$/', '', $filename ),
			'post_content' => '',
			'post_status' => 'inherit',
		);
		$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $parent_post_id );
		if ( ! is_wp_error( $attachment_id ) ) {
			require_once( ABSPATH . 'wp-admin' . '/includes/image.php' );
			$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
			wp_update_attachment_metadata( $attachment_id, $attachment_data );
		}
	}
}

function spinkx_cont_get_attachment_data()
{
	$post_id = helperClass::getFilterVar('post_id', INPUT_REQUEST, FILTER_VALIDATE_INT);
	$content = get_post_field('post_content', $post_id);
	$doc = new DOMDocument();
	@$doc->loadHTML($content);
	$length = $doc->getElementsByTagName('img')->length;
	$img_data = array();
	for ($i = 0; $i < $length; $i++) {
		$src_url = @$doc->getElementsByTagName('img')->item($i)->getAttribute('src');
		if (!spinkx_cont_is_404($src_url)) {
			$img_data[] = $src_url;
		}
	}
	if (count($img_data) > 0) {
		echo wp_json_encode(array('success' => TRUE, 'data' => $img_data));
	} else {
		echo wp_json_encode(array('success' => FALSE, 'growl' => 'No images found in Post body <br/> kindly add atleast 1 to create a Variation'));
	}
	wp_die();
}

function spinkx_cont_update_credit_points() {
	$license_check = base64_encode( get_option( SPINKX_CONT_LICENSE ) );
	$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/content-playlist/post/update-credit-points';
	$post = helperClass::getFilterPost();
	$json_posts_array = base64_encode( maybe_serialize( $post ) );
	$postData = array( 'post' => $json_posts_array, 'key' => $license_check );
	$output = helperClass::doCurl( $url, $postData, false );
	echo $output;
	wp_die();
}

function spinkx_cont_get_credit_points() {
	$license_check = get_option( SPINKX_CONT_LICENSE );
	if ( is_array( $license_check ) ) {
		$license_check = maybe_serialize( $license_check );
	}
	$license_check = base64_encode( $license_check );
	$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/content-playlist/post/get-credit-points';
	$post = helperClass::getFilterPost();
	$json_posts_array = base64_encode( maybe_serialize( $post ) );
	$postData = array( 'post' => $json_posts_array, 'key' => $license_check );
	$output = helperClass::doCurl( $url, $postData, false );
	echo $output;
	wp_die();
}

function spinkx_cont_play_pause_post() {
	$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/content-playlist/post/activation';
	$post = helperClass::getFilterPost();
	$output = helperClass::doCurl( $url, $post );
	echo $output;
	wp_die();
}

function spinkx_cont_get_widget_stat() {
	$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/statistics/';
	$get = helperClass::getFilterGet();
	$output = helperClass::doCurl( $url, $get );
	echo $output;
	wp_die();
}

function spinkx_cont_get_campaign_stat() {
		$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/campaign/statistics';
		$get = helperClass::getFilterGet();
		$output = helperClass::doCurl( $url, $get );
		echo $output;
		wp_die();
}

function spinkx_cont_get_content_playlist_stat() {
	$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/content-playlist/post/statistics';
	$get = helperClass::getFilterGet();
	$output = helperClass::doCurl( $url, $get );
	echo $output;
	wp_die();
}

function spinkx_cont_camp_form_elements() {
	$get = helperClass::getFilterGet();
	if(count($get['country_code'] > 0)) {
		$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/campaign/form-elements';
		$data = array('country_code' => $get['country_code']);
		$output = helperClass::doCurl($url, $data);
		echo $output;
	}
	wp_die();
}

function spinkx_cont_change_widget_status(){
	$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/activation/';
	$get = helperClass::getFilterGet();
	$settings = maybe_unserialize( get_option( SPINKX_CONT_LICENSE ) );
	$get['reg_email'] = $settings['reg_email'];
	$get['license_code'] = $settings['license_code'];
	$output = helperClass::doCurl( $url, $get, false );
	echo wp_json_encode($output);
	wp_die();
}

function spinkx_cont_update_post_sync_cpl() {
	$settings = get_option(SPINKX_CONT_LICENSE);
	$settings = maybe_unserialize($settings);
	$settings['current_blog_id'] = get_current_blog_id();
	$output = spinkx_cont_post_sync($settings);
	echo $output;
	wp_die();
}

function spinkx_cont_post_sync($settings = null)
{
	global $wpdb;
	global $post;
	$request = null;
	if($settings) {
		$request = $settings;
	} else {
		$request = json_decode(file_get_contents('php://input'), TRUE);
	}

	$site_id = $request['site_id'];
	$license_code = $request['license_code'];
	$reg_email = $request['reg_email'];
	$site_url = $request['site_url'];
	$current_blog_id = $request['current_blog_id'];
	$array_to_serialize = array();

	$array_to_serialize['site_id'] = $site_id;
	$array_to_serialize['license_code'] = $license_code;
	$array_to_serialize['reg_email'] = $reg_email;
	$serialized_data = maybe_serialize($array_to_serialize);
	if (!function_exists('wpmu_get_mapped_domain')) {
		function wpmu_get_mapped_domain($blog_id)
		{
			global $wpdb;

			$data = $wpdb->get_row('SELECT * FROM ' . $wpdb->base_prefix . "domain_mapping WHERE blog_id = $blog_id");

			// echo "data--".$data;
			if (!$data) {
				return get_site_url($blog_id);
			}

			if ($data->scheme == 1) {
				$schem = 'https://';
			} else {
				$schem = 'http://';
			}

			return $schem . $data->domain;
		}
	}
	if (is_multisite()) {
		switch_to_blog($current_blog_id);
	}
	$args = array(
		'posts_per_page' => 100,
		'meta_key' => '_thumbnail_id',
	);
	$posts_array = get_posts($args);
	$all_posts_count = 0;
	$counter = 0;
	$post_array = array();

	foreach ($posts_array as $post) {
		setup_postdata($post);
		if (strtotime($post->post_date_gmt) < strtotime('-6 months')) {
			continue;
		}
		$pid = $post->ID;
		$p_thumb_id = get_post_thumbnail_id($pid);
		$p_thumb_array = wp_get_attachment_image_src($p_thumb_id, 'full');
		$p_thumb_image_array = wp_get_attachment_image_src($p_thumb_id, 'medium');  // added by Vikash Saharan
		$p_thumb_url = $p_thumb_array[0];
		$p_thumb_image_url = $p_thumb_image_array[0]; // added by Vikash Saharan
		if (!($p_thumb_id && $p_thumb_image_url)) {
			continue;
		}
		$post_status = 1;
		if ($post->post_status == 'publish') {
			$counter++;
			if ($counter > 20) {
				$post_status = 0;
			}
		}
		$post_array['posts'][$all_posts_count]['post_title'] = $post->post_title;
		$post_array['posts'][$all_posts_count]['post_status'] = $post_status;
		$post_array['posts'][$all_posts_count]['post_publish_date'] = $post->post_date_gmt;
		if (strtotime($post_array['posts'][$all_posts_count]['post_publish_date']) < strtotime('-6 months')) {
			continue;
		}
		//$post = get_post($pid);
		$post_excerpt = get_the_excerpt();
		if(!$post_excerpt) {

		}
		$post_array['posts'][$all_posts_count]['post_excerpt'] = base64_encode($post_excerpt); // viksedit we need post_excerpt
		$post_array['posts'][$all_posts_count]['post_author_email'] = get_the_author_meta('email'); // Vikash
		$post_array['posts'][$all_posts_count]['post_author_name'] = get_the_author_meta('display_name');   // Vikash
		$post_array['posts'][$all_posts_count]['post_src_id'] = $post->ID; // Vikash
		$post_array['posts'][$all_posts_count]['post_full_image'] = base64_encode($p_thumb_url);
		$post_array['posts'][$all_posts_count]['post_thumb_image'] = base64_encode($p_thumb_image_url); // added by Vikash Saharan
		$permalink_url = '';
		if (class_exists('Domainmap_Plugin')) {
			$relative_url = str_replace(home_url(), '', get_permalink($pid));
			$permalink_url = wpmu_get_mapped_domain($current_blog_id) . $relative_url;
		} else {
			$permalink_url = get_permalink($pid);
		}
		$post_array['posts'][$all_posts_count]['post_url'] = $permalink_url;  // get_permalink($pid);
		$post_views_count = get_post_meta($pid, 'views', TRUE);
		if (empty($post_views_count)) {
			$post_array['posts'][$all_posts_count]['post_views'] = 0;
		} else {
			$post_array['posts'][$all_posts_count]['post_views'] = intval($post_views_count);
		}
		$tags = wp_get_post_tags($pid);
		$p_tags = array();
		foreach ($tags as $tag) {
			$p_tags[] = $tag->name;
		}
		$post_array['posts'][$all_posts_count]['post_tags'] = implode(',', $p_tags);
		$categories = wp_get_post_categories($pid);
		$p_cats = array();
		foreach ($categories as $c) {
			$cat = get_category($c);
			$p_cats[] = $cat->name;
		}
		$post_array['posts'][$all_posts_count]['post_categories'] = implode(',', $p_cats);
		$all_posts_count++;
	}
	if (count($post_array) && count($post_array['posts']) > 0) {
		$post_array['license_code'] = $license_code;
		$post_array['site_id'] = $site_id;
		$post_array['site_url'] = $site_url;
		$post_array['reg_email'] = $reg_email;
		$json_posts_array = base64_encode(maybe_serialize($post_array));
		$curl_url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/content-playlist/post/sync';
		$postData = array('post' => $json_posts_array);
		$response = wp_remote_post($curl_url , array(
			'method' => 'POST',
			'timeout' => 60,
			'body' => $postData,
		));
		if (is_wp_error($response)) {
			$error_message = $response->get_error_message();
			return "Something went wrong: $error_message";
		} else {
			$output = $response['body'];
			return $output;
		}
	}
}

function spinkx_cont_post_transitions() {
	global $wpdb;
	global $post;
	if (!function_exists('wpmu_get_mapped_domain')) {

		function wpmu_get_mapped_domain($blog_id)
		{
			global $wpdb;

			$data = $wpdb->get_row('SELECT * FROM ' . $wpdb->base_prefix . "domain_mapping WHERE blog_id = $blog_id");

			// echo "data--".$data;
			if (!$data) {
				return get_site_url($blog_id);
			}

			if ($data->scheme == 1) {
				$schem = 'https://';
			} else {
				$schem = 'http://';
			}

			return $schem . $data->domain;
		}
	}
	$license_check = maybe_unserialize(get_option(SPINKX_CONT_LICENSE));
	$current_blog_id = get_current_blog_id();
	$curl_url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/content-playlist/post/update';
	if ($post->post_type != 'post') {
		return;
	};
	$post_title = $post->post_title;
	$post->post_publish_date = $post->post_date_gmt;
	setup_postdata($post);
	if (strtotime($post->post_publish_date) < strtotime('-6 months')) {
		return;
	}
	$post_content = $post->post_content;
	$post_excerpt = spinkx_cont_get_excerpt_by_id($post_content);
	$post->post_author_email = get_the_author_meta('email');
	$post->post_author_name = get_the_author_meta('display_name');
	$post->post_excerpt = base64_encode($post_excerpt);
	$post->guid = '';
	$post->post_src_id = $post->ID;
	$post_array = (array)$post;
	unset($post_array['ping_status']);
	unset($post_array['comment_status']);
	$pid = $post->ID;
	$p_thumb_id = get_post_thumbnail_id($pid);
	$p_thumb_array = wp_get_attachment_image_src($p_thumb_id, 'full');
	$p_thumb_image_array = wp_get_attachment_image_src($p_thumb_id, 'medium');
	$p_thumb_url = $p_thumb_array[0];
	$p_thumb_image_url = $p_thumb_image_array[0];
	if (!($p_thumb_id && $p_thumb_image_url)) {
		return;
	}
	$post_array['post_full_image'] = base64_encode($p_thumb_url);
	$post_array['post_thumb_image'] = base64_encode($p_thumb_image_url);
	$permalink_url = '';
	if (class_exists('Domainmap_Plugin')) {
		$relative_url = str_replace(home_url(), '', get_permalink($pid));
		$permalink_url = wpmu_get_mapped_domain($current_blog_id) . $relative_url;
	} else {
		$permalink_url = get_permalink($pid);
	}
	$post_array['post_url'] = $permalink_url;
	$post_views_count = get_post_meta($pid, 'views', TRUE);
	if (empty($post_views_count)) {
		$post_array['post_views'] = 0;
	} else {
		$post_array['post_views'] = intval($post_views_count);
	}
	$tags = wp_get_post_tags($pid);
	$p_tags = array();
	foreach ($tags as $tag) {
		$p_tags[] = $tag->name;
	}
	$post_array['post_tags'] = implode(',', $p_tags);
	$categories = wp_get_post_categories($pid);
	$p_cats = array();
	foreach ($categories as $c) {
		$cat = get_category($c);
		$p_cats[] = $cat->name;
	}
	$post_array['post_categories'] = implode(',', $p_cats);
	$json_posts_array = base64_encode(maybe_serialize($post_array));
	$api = $curl_url . '?post=' . $json_posts_array . '&key=' . base64_encode(maybe_serialize($license_check));
	$postData = array('post' => $json_posts_array, 'key' => base64_encode(maybe_serialize($license_check)));
	$output = helperClass::doCurl($curl_url, $postData, FALSE);

}

function spinkx_cont_widget_clone() {
	$post = helperClass::getFilterPost();
	$post = wp_json_encode($post);
	$url = esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/clone' );
	$response = helperClass::doCurl( $url, $post, false );
	echo json_decode($response);
	wp_die();
}

function spinkx_cont_widget_delete() {
	$post = helperClass::getFilterPost();
	$post = wp_json_encode($post);
	$url = esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/delete' );
	$response = helperClass::doCurl( $url, $post, false );
	echo json_decode($response);
	wp_die();
}

function spinkx_cont_widget_update() {
	$post = helperClass::getFilterPost();
	$post['mode'] = 'update';
	$post = wp_json_encode($post);
	$url = esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/update' );
	$response = helperClass::doCurl( $url, $post, false );
	echo json_decode($response);
	wp_die();
}

function spinkx_cont_widget_create() {
	$post = helperClass::getFilterPost();
	$post['mode'] = 'create';
	$post = wp_json_encode($post);
	$url = esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/create' );
	$response = helperClass::doCurl( $url, $post, FALSE );
	echo json_decode($response);
	wp_die();
}

	function spinkx_cont_campaign_ajax() {

		$action_arr = array('remove', 'edit', 'addStatus', 'changeStatus', 'view', 'receive');
		$settings = get_option(SPINKX_CONT_LICENSE);
		$settings = maybe_unserialize($settings);
		$mode = helperClass::getFilterVar( 'mode', INPUT_POST);
		$post = helperClass::getFilterPost();
		if ( $mode ) {
			if (in_array( $mode, $action_arr)) {
				$url = esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/campaign/update' );
				$result = helperClass::doCurl($url, $post);
				echo $result;
				wp_die();
			}
		} else {
			//print_r($_FILES);die;
			$url = SPINKX_CONTENT_PLUGIN_URL;
			$folderpath = str_replace("\\", "/", dirname(__FILE__));
			$files = helperClass::getFilterFiles();
			if (!empty($files['image']['name'])) {
				$image_upload = imageUpload($files, $folderpath, $url);//echo "<pre>";print_r($image_upload);echo "</pre>";exit;
				if (!empty($image_upload['error'])) {
					echo $error_msg = $image_upload['error'];
					wp_die();
				} else {
					$post['imageurl'] = "";
					$post['image_url'] = $image_upload['link'];
				}

			} elseif (!empty($post['imageurl'])) {
				$name = basename($post['imageurl']);
				$location = SPINKX_CONTENT_PLUGIN_DIR . 'assets/campaigns/AddImage/' . $name;
				$upload = file_put_contents($location, file_get_contents($post['imageurl']));
				unset($post['imageurl']);
				if ($upload) {
					$post['image_url'] = SPINKX_CONTENT_PLUGIN_URL . "assets/campaigns/AddImage/" . $name;
				}
			}
			$hooks = helperClass::getFilterVar( 'hooks' );
			if ( $hooks ) { // added for hooks image save.
				//$url = SPINKX_SERVER_BASEURL . '/wp-admin/admin-ajax.php?action=spinkx_server_campaigns_save_hook'; correction
				$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/campaign/add/advertisement';
			} else {
				$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/campaign/add/advertisement';
			}
			$post['site_id'] = $settings['site_id'];
			$result = helperClass::doCurl($url, $post);
			$result = json_decode($result);
			unset($post['site_id']);
			if ($result !== "Insetion failed") {
				$result = fbpostCurl($result, $post);
				echo "success";
				wp_die();
			}
			echo $result;

		}
		wp_die();
	}
	/*
	 * to post inforation to the facebook
	 * @param id : int containing id for add_id
	 * @param attachment : array contains data to be posted
	 */
	function fbpostCurl($id,$data){
		// comment when online
		//$server_url='http://spinkx1.spoooly.com';
		if ( isset($data['global_pid']) ){

			$site_url = get_site_url();
			$post_name = get_post($data['global_pid'])->post_name;
			$s_url = $site_url.'/'.$post_name;
			if(!isset($result)){
				$result=0;
			}
			$token="CAAOp9ogUgn8BALAyYOibLsgvWi64pCrQVB7hdquYVCe32BVTe7l4IkuiJ8FAwNUYrN2PDNZAk4UZAol2RODqNbQWZCeR0srmdLHm7TrrSL55pZAPrcZB4fSAxVnR8Fm5jBvgkKIZCP1zHvutz4IEg3ssGYIcZBZCVpxnXLl8L7D7izwyZC3U3uZCZCHzxjH2xNvVA0ZD";
			$link = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/campaign/fb/impression/' . $result . '/' . $s_url;

		} else {
			$link = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/campaign/fb/impression/'.$id.'/'.$data['landing'];
		}
		// to get time line page id to campare;
		global $wpdb;
		//$my_page_id=$wpdb->query("select * from ".$wpdb->baseprefix."bw_facebook_page order by id desc limit 1" );
		//if ( empty( $data['FBpost'] ) ) {
		//	return false;
		//}

		foreach ($data['FBpost'] as $key => $value) {
			$message=(isset($data['title']))?$data['title']:$data['headline'];
			$name=(isset($data['title']))?$data['title']:$data['headline'];
			$desc=(isset($data['excerpt']))?$data['excerpt']:$data['desc'];
			$page_info= explode('-', $value);
			$attachment =  array(
				'access_token' => $page_info[1],
				'message' => $message,
				'name' => $name,
				'link' => $link,
				'description' => $desc,
			);
			//if ( $my_page_id[0]['page_id'] !== $page_info[0]){
			//	$attachment['picture']=$data['image_url'];
			//}else{
				$attachment['source']=$data['image_url'];
			//}
			fuCurl($page_info[0],$attachment);
		}




	}
	/*
	 * to post inforation to the facebook using curl
	 * @param id : int containing id for page or facebook
	 * @param attachment : array contains data to be posted
	 */
	function fuCurl($id,$attachment) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,'https://graph.facebook.com/'.$id.'/feed');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $attachment);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output
		$result = curl_exec($ch);
		curl_close ($ch);

	}

	/** To upload images for ads
	 ** Params: image,folder path(full)
	 ** used for ad creation,image upload via url
	 ** Returns array
	 **/
	function imageUpload($image,$folder,$url)
	{
		global $wpdb;
		$results	=	array();
		$size	=	getimagesize($image['image']['tmp_name']);
		$width	=	$size[0];
		$height	=	$size[1];
		$tmp	=	$image['image']['tmp_name'];
		$path 	= 	$image['image']['name'];
		$type	=	trim($image['image']['type']);
		$type_arr=	array('image/png','image/jpeg','image/jpg','image/gif');
		/* if($image['image']['size']>500000)
		{
				$results['error']	=	'Image size should be less than 500kb';
		}
		elseif(!in_array($type,$type_arr))
		{
				$results['error']	=	'Invalid image type';
		}
		elseif(($width < 300 || $height < 300))
		{
				$results['error']	=	'Image minimum width and height 300px';
		}
		elseif(($width > 2000 || $height > 2000))
		{
				$results['error']	=	'Image maximum width and height 600px';
		}
		else
		{		 */
		$location = $folder;
		move_uploaded_file($tmp, $location.'/'.$path);
		$results['link']= $url . '/'.$path;
		//}
		return $results;
	}





