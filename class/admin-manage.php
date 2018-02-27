<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/* Initalize Class manage function */

if ( ! class_exists( 'spnxAdminManage' ) ) :

final class spnxAdminManage {
	private $_spinkx_cont_version;
	private $_spinkx_cont_license;
	private $_spinkx_server_bapi_url;
	private $_spinkx_server_api_url;
	private $_spinkx_cont_dir;
	private $_spinkx_cont_url;

	/**
	 * The list of wp_ajax_{name} actions
	 *
	 * @private array
	 */

	private $_ajax_actions = array(
		'get_dashbaord_statics',
		'new_hook',
		'edit_hook',
		'save_hook',
		'get_attachment_data',
		'play_pause_post',
		'play_pause_campaigns',
		'get_credit_points',
		'bp_update_categories',
		'get_widget_stat',
		'get_content_playlist_stat',
		'camp_form_elements',
		'change_widget_status',
		'widget_update',
		'widget_delete',
		'widget_clone',
		'widget_create',
		'widget_reset',
		'campaign_ajax',
		'get_campaign_stat',
		'campaign_save',
		'campaign_pay',
		'campaign_get_data',
		'widget_get_site_url',
		'post_sync',
		'update_post_sync_cpl',
		'campaign_refund_amount',
		'save_notice_info',
		'withdraw_money_request');


	private $_frontend_nopriv_actions = array( 'display_widget_content', 'mobile_widget_data' );
	private $_frontend_actions = array( 'display_widget_content', 'mobile_widget_data' );
	public function __construct( $loading = false ) {
		if(!$this->_spinkx_cont_version) {
			$this->_spinkx_cont_version = '2.2.2';
		}
		if(!$this->_spinkx_cont_license) {
			$this->_spinkx_cont_license = 'spinkx_content_license_update';
		}
		if(!$this->_spinkx_server_bapi_url) {
            $this->_spinkx_server_bapi_url = 'http://localhost/spinkx-backend';
           // $this->_spinkx_server_bapi_url = 'https://backend.spinkx.com';
        }
		if(!$this->_spinkx_server_api_url) {
            $this->_spinkx_server_api_url = 'http://localhost/spinkx-frontend';
           // $this->_spinkx_server_api_url = 'https://frontend.spinkx.com';
		}
		if(!$this->_spinkx_cont_dir) {
			$this->_spinkx_cont_dir =  plugin_dir_path( __FILE__ );
		}
		if(!$this->_spinkx_cont_url) {
			$this->_spinkx_cont_url = plugin_dir_url( __FILE__ );
		}
		

		if($loading) {

			add_action('admin_menu', array($this, 'spinkx_cont_spinkx_admin_menu'));
			//add_action('admin_bar_menu', array($this, 'spinkx_cont_show_notification'));
			add_action('admin_notices', array($this, 'spinkx_cont_show_notice')); // call spinkx_show_notice.
			add_action('admin_head', 'spinkx_cont_icon_css');
			add_action('admin_enqueue_scripts', 'spinkx_cont_js_var');
			//add_action('wp_dashboard_setup', array($this, 'spinkx_cont_add_dashboard_widgets')); // Call hook after admin dashboard setup.
			add_action('spinkx_views_update_hook', 'spinkx_views_update_function');
			add_filter('the_content', array($this, 'spinkx_cont_content_add'));
			add_action('wpmu_new_blog', array($this, 'spinkx_cont_wpmu_add_new_blog'), 10, 6);

			add_action('update_option_permalink_structure', array($this, 'spinkx_cont_permalink_update'), 10, 2);
			add_action('publish_to_publish', array($this, 'spinkx_cont_update_on_publish_to_publish'), 10, 3);
			add_action('transition_post_status', array($this, 'spinkx_cont_update_status_transitions'), 10, 3);
			

			//add_action('wp_footer', 'spinkx_mobile_widget_setup');
			add_shortcode('spinkx-cont-payment-method', 'spinkx_cont_payment_method_list');

			foreach ($this->_ajax_actions as $action) {
				add_action('wp_ajax_spinkx_cont_' . $action, array($this, 'spinkx_cont_' . $action));
			}




		}
		foreach ($this->_frontend_actions as $action) {
			add_action('wp_ajax_spinkx_cont_' . $action, array($this, 'spinkx_cont_' . $action));
		}

		foreach ($this->_frontend_nopriv_actions as $action) {
			add_action('wp_ajax_nopriv_spinkx_cont_' . $action, array($this, 'spinkx_cont_' . $action));
		}
	}

	public function spinkx_cont_get_version() {
		return $this->_spinkx_cont_version;
	}

	public function spinkx_cont_get_license() {
		return $this->_spinkx_cont_license;
	}

	public function spinkx_cont_bapi_url() {
		return $this->_spinkx_server_bapi_url;
	}

	public function spinkx_cont_api_url() {
		return $this->_spinkx_server_api_url;
	}



	function spinkx_cont_show_notification() {
		global $wp_admin_bar;
		$notifications = get_option('spinkx_notify');
		if($notifications) {
			$notifications = maybe_unserialize( $notifications );
			$pending       = count( $notifications );
		} else {
			$pending = 0;
		}
		$args = array(
			'id' => 'spinkx_notification',
			'href' => admin_url('/edit.php?post_status=pending&post_type=page'),
			'parent' => 'top-secondary'
		);
		$title = 'Spinkx Notification';
		$args['meta']['title'] = $title;
		$display = '<span class="spinkx-notify-update-bubble">'.$pending.'</span><span class="spinkx-notify-text-active"><img src="'.SPINKX_CONTENT_PLUGIN_URL.'assets/images/icon-bell.png"/></span>';
		$args['title'] = $display;
		$wp_admin_bar->add_node($args);
	}

	function spinkx_cont_show_notice() {
		$settings = get_option( (new spnxAdminManage)->spinkx_cont_get_license() );
		$settings = maybe_unserialize( $settings );
		$post = array();
		if(!(isset($settings['site_id']) && isset($settings['reg_email']) &&$settings['license_code'])) {
			return false;
		}
		$spnxAdminManage = new spnxAdminManage;
		$url = $spnxAdminManage->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/site/check-license';
		$response = spnxHelper::doCurl( $url, true );
		$response = json_decode( $response );
		if (isset($response->flag) && $response->flag > 0 ) {
            if (1 === $response->flag) {
                $this->spinkx_cont_admin_notices($response->message, 'notice-warning notice-spnx');
            } elseif (2 === $response->flag || 3 === $response->flag) {
                $this->spinkx_cont_admin_notices($response->message, 'notice-warning notice-spnx');
            }
        }
	}

	/**
	 *
	 * This function show spinkx releated admin notice when is required
	 * spinkx_cont_admin_notices()
	 *
	 * @return void
	 * @param string $str message disolay in notice bar.
	 * @param string $class notice class name.
	 */
	function spinkx_cont_admin_notices( $str, $class = 'notice-success' ) {
		echo '<div class="notice ' . esc_html( $class ) . ' is-dismissible"><p><strong>';
		if ( esc_attr( $str ) ) {
			echo  $str;
		} else {
			echo 'Your <a href="?page=spinkx-site-register.php">Spinkx</a> License has Expired! Please <a href="?page=spinkx-site-register.php">Register</a>';
		}
		echo '</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
	}






	function spinkx_cont_get_dashbaord_statics() {
		$url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/dashboard';
		$from_date = spnxHelper::getFilterVar( 'from_date' );
		$to_date = spnxHelper::getFilterVar( 'to_date' );
		$post['from_date'] = $from_date;
		$post['to_date'] = $to_date;
		$output = spnxHelper::doCurl( $url,$post, true, array(), 3000);
		echo $output;
		exit;
	}

	function spinkx_cont_new_hook() {
		$post = spnxHelper::getFilterPost();
		$url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/content-playlist/variation/create';
		$output = spnxHelper::doCurl( $url, $post );
		echo json_decode($output);
		exit;
	}
	function spinkx_cont_edit_hook() {
		$post = spnxHelper::getFilterPost();
		if ( isset( $post['type'] ) && $post['type'] == 'status_update' ) {
			//$url = SPINKX_SERVER_BASEURL . '/wp-admin/admin-ajax.php?action=spinkx_server_play_pause_hook';
			$url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/content-playlist/variation/update';
		} else {
			$url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/content-playlist/variation/update';
		}
		$output = spnxHelper::doCurl( $url, $post );
		unset( $post );
		echo json_decode($output);
		exit;
	}

	function spinkx_cont_save_hook() {
		$post = spnxHelper::getFilterPost();
		if(isset( $post['image_aid'])) {
			$post['post_full_image'] = wp_get_attachment_image_src( $post['image_aid'],'full' )[0];
			//$post['post_thumbnail'] = wp_get_attachment_image_src( $post['image_aid'],'full' )[0];
			$url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/content-playlist/variation/save';
			$output = spnxHelper::doCurl( $url, $post );
			echo json_decode($output);
		}
		exit;
	}

	/**  Checks if a url exists
	 * TODO: refactor it into a utility library script
	 *
	 * @param $url to check
	 * @return bool true if exists else false
	 */
	function spinkx_cont_is_404( $url ) {
		/*$handle = curl_init( $url );
		curl_setopt( $handle,  CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $handle, CURLOPT_NOBODY, true );
		curl_setopt( $handle, CURLOPT_FOLLOWLOCATION, true );
	
		/* Get the HTML or whatever is linked in $url. *
		$response = curl_exec( $handle );
	
		/* Check for 404 (file not found). *
		$httpCode = curl_getinfo( $handle, CURLINFO_HTTP_CODE );
		curl_close( $handle );*/
		$wp_output = wp_remote_head( $url );
		if( is_wp_error( $wp_output ) ) {
			return false;
		}
		/* If the document has loaded successfully without any redirection or error */
		if ( $wp_output['response']['code'] >= 200 &&  $wp_output['response']['code'] < 300 ) {
			return true;
		} else {
			return false;
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
		$post_id = spnxHelper::getFilterVar('post_id', INPUT_REQUEST, FILTER_VALIDATE_INT);
		$img_data = $this->spinkx_cont_get_attachment_image( $post_id );
		if (count($img_data) > 0) {
			echo wp_json_encode(array('success' => TRUE, 'data' => $img_data));
		} else {
			echo wp_json_encode(array('success' => FALSE, 'growl' => 'No images found in Post body <br/> kindly add atleast 1 to create a Variation'));
		}
		exit;
	}

	function spinkx_cont_get_attachment_image( $post_id, $length = 0 )
	{
		$content = get_post_field('post_content', $post_id);
		$doc = new DOMDocument();
		@$doc->loadHTML($content);
		$length = $doc->getElementsByTagName('img')->length;
		$img_data = array();
		for ($i = 0; $i < $length; $i++) {
			$src_url = @$doc->getElementsByTagName('img')->item($i)->getAttribute('src');
			if ($this->spinkx_cont_is_404($src_url)) {
				$img_data[] = $src_url;
			}
			if( $length == ($i+1) ) {
				break;
			}

		}
		return $img_data;
	}

	function spinkx_cont_bp_update_categories() {
		$spnxAdminManage = new spnxAdminManage();
		$url = $spnxAdminManage->spinkx_cont_bapi_url(). '/wp-json/spnx/v1/content-playlist/post/update-categories';
		$post = spnxHelper::getFilterPost();
		$json_posts_array = base64_encode( maybe_serialize( $post ) );
		$postData = array( 'post' => $json_posts_array );
		$output = spnxHelper::doCurl( $url, $postData, false );
		echo $output;
		exit;
	}

	function spinkx_cont_get_credit_points() {
		$spnxAdminManage = new spnxAdminManage();
		$url = $spnxAdminManage->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/content-playlist/post/get-credit-points';
		$output = json_decode(spnxHelper::doCurl( $url, true ), true);
		if(isset($output['success'], $output['credit']) && $output['success']  ) {
			return $output['credit'];
		} else {
			return isset($output['msg'])?$output['msg']:'';
		}
	}

	function spinkx_cont_play_pause_post() {
        $url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/content-playlist/post/activation';
		$post = spnxHelper::getFilterPost();
		$output = spnxHelper::doCurl( $url, $post );
		echo $output;
		exit;
	}

	function spinkx_cont_play_pause_campaigns() {
        $url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign/change-status';
		$post = spnxHelper::getFilterPost();
		$output = spnxHelper::doCurl( $url, $post );
		echo $output;
		exit;
	}

	function spinkx_cont_get_widget_stat() {
		$url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/widget/statistics/';
		$get = spnxHelper::getFilterGet();
		$output = spnxHelper::doCurl( $url, $get );
		echo $output;
		wp_die();
	}

	function spinkx_cont_get_campaign_stat() {
		$url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign/statistics';
		$get = spnxHelper::getFilterGet();
		$output = spnxHelper::doCurl( $url, $get );
		echo $output;
		wp_die();
	}

	function spinkx_cont_get_content_playlist_stat() {
		$url = $this->spinkx_cont_bapi_url(). '/wp-json/spnx/v1/content-playlist/post/statistics';
		$get = spnxHelper::getFilterGet();
		$output = spnxHelper::doCurl( $url, $get );
		echo $output;
		wp_die();
	}

	function spinkx_cont_camp_form_elements() {
		$get = spnxHelper::getFilterGet();
		if(count($get['country_code'] > 0)) {
			$url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign/form-elements';
			$data = array('country_code' => $get['country_code']);
			$output = spnxHelper::doCurl($url, $data);
			echo $output;
		}
		wp_die();
	}

	function spinkx_cont_change_widget_status(){
		global $wpdb;
		$url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/widget/activation/';
		$get = spnxHelper::getFilterGet();
		$output = spnxHelper::doCurl( $url, $get, false );
		if( $output ) {
			$this->update_widget_list();
		}
		echo $output;
		wp_die();
	}

	public function update_widget_list() {
		$curl_url = $this->spinkx_cont_api_url() . '/wp-json/spnx/v1/widget/list';
		$widget_list = spnxHelper::doCurl($curl_url, true, false);
        $widget_list = json_decode($widget_list, true);
		if(!( is_array($widget_list) && count($widget_list))) {
			return;
		}
        if(isset($widget_list[0]['widget_id'])) {
			if(update_option('spnx_widget_list', maybe_serialize($widget_list))) {
				return true;
			}
		}
	}

	function spinkx_cont_update_post_sync_cpl() {
		$settings = get_option($this->spinkx_cont_get_license());
		$settings = maybe_unserialize($settings);
		$settings['current_blog_id'] = get_current_blog_id();
		$output = $this->spinkx_cont_post_sync($settings);
		echo $output;
		wp_die();
	}

	function spinkx_cont_post_sync( $settings = null) {
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
		$current_blog_id = isset($request['current_blog_id'])?$request['current_blog_id']:0;
		$array_to_serialize = array();
		if(  ( isset(  $request['after_registration_sync'] ) && $request['after_registration_sync'] ) ) {
			$array_to_serialize['after_registration_sync'] = true;
		}
		//print_r($array_to_serialize);
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
		/*$ptData = array();
		foreach ( get_post_types( '', 'names' ) as $post_type ) {
			//if(!in_array($post_type, array('attachment','revision','nav_menu_item'))) {
				$ptData[] = $post_type;
			//}
		}*/
		$args = array(
			'posts_per_page' => 100

		);
		$posts_array = get_posts($args);
		$all_posts_count = 0;
		$counter = 0;
		$post_array = array();

		foreach ($posts_array as $post) {
			setup_postdata($post);
			/*if (strtotime($post->post_date_gmt) < strtotime('-6 months')) {
				continue;
			}*/
			$pid = $post->ID;
			$p_thumb_id = get_post_thumbnail_id($pid);
			$p_thumb_array = wp_get_attachment_image_src($p_thumb_id, 'full');
			$p_thumb_image_array = wp_get_attachment_image_src($p_thumb_id, 'medium');  // added by Vikash Saharan
			$p_thumb_url = $p_thumb_array[0];
			$p_thumb_image_url = $p_thumb_image_array[0]; // added by Vikash Saharan
			if (!($p_thumb_id && $p_thumb_image_url)) {
				$p_thumb_image_url =  $this->spinkx_cont_get_attachment_image($pid, 1 );
				if(isset($p_thumb_image_url[0]) && strlen($p_thumb_image_url[0]) > 15 ) {
					$p_thumb_id = $this->spinkx_cont_get_attachment_id($p_thumb_image_url[0]);
					if( $p_thumb_id ) {
						$p_thumb_array = wp_get_attachment_image_src($p_thumb_id, 'full');
						$p_thumb_image_array = wp_get_attachment_image_src($p_thumb_id, 'medium');
						$p_thumb_url = $p_thumb_array[0];
						$p_thumb_image_url = $p_thumb_image_array[0];
					} else {
						$p_thumb_image_url = null;
					}
				}
				if ( ! ($p_thumb_id && $p_thumb_image_url) ) {
					continue;
				}
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
			/*if (strtotime($post_array['posts'][$all_posts_count]['post_publish_date']) < strtotime('-6 months')) {
				continue;
			}*/
			//$post = get_post($pid);
			$post_excerpt = get_the_excerpt();
			if($post_excerpt) {
				$post_excerpt = $this->spinkx_cont_get_excerpt_by_id($post_excerpt);
			} else {

			}
			$post_array['posts'][$all_posts_count]['post_excerpt'] = base64_encode ( $post_excerpt ); // viksedit we need post_excerpt
			$post_array['posts'][$all_posts_count]['post_author_email'] = get_the_author_meta('email'); // Vikash
			$post_array['posts'][$all_posts_count]['post_author_name'] = get_the_author_meta('display_name');   // Vikash
			$post_array['posts'][$all_posts_count]['post_src_id'] = $post->ID; // Vikash
			$post_array['posts'][$all_posts_count]['post_full_image'] = base64_encode( $p_thumb_url );
			$post_array['posts'][$all_posts_count]['post_thumb_image'] = base64_encode( $p_thumb_image_url ); // added by Vikash Saharan
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
		if(  ( isset(  $request['after_registration_sync'] ) && $request['after_registration_sync'] ) ) {
			$post_array['after_registration_sync'] = true;
		}
		if( $post_array['after_registration_sync'] || ( count($post_array) && count($post_array['posts']) > 0 ) ) {
			$post_array['license_code'] = $license_code;
			$post_array['site_id'] = $site_id;
			$post_array['site_url'] = $site_url;
			$post_array['reg_email'] = $reg_email;

			$json_posts_array = base64_encode(maybe_serialize($post_array));
			$curl_url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/content-playlist/post/sync';
			$postData = array('post' => $json_posts_array);
			$response = wp_remote_post($curl_url , array(
				'method' => 'POST',
				'timeout' => 120,
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

	function spinkx_cont_widget_clone() {
		$post = spnxHelper::getFilterPost();
		$post = wp_json_encode($post);
		$url = esc_url( $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/widget/clone' );
		$response = spnxHelper::doCurl( $url, $post, false );
		echo json_decode($response);
		wp_die();
	}

	function spinkx_cont_widget_delete() {
		$post = spnxHelper::getFilterPost();
		$post = wp_json_encode($post);
		$url = esc_url( $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/widget/delete' );
		$response = spnxHelper::doCurl( $url, $post, false );
		echo json_decode($response);
		wp_die();
	}

	function spinkx_cont_widget_update() {
		$post = spnxHelper::getFilterPost();
		$post['mode'] = 'update';
		$url = esc_url( $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/widget/update' );
		unset($post['action']);
		$response = spnxHelper::doCurl( $url, $post );
		echo json_decode($response);
		wp_die();
	}
	function spinkx_cont_widget_reset() {

		$post = spnxHelper::getFilterPost();
		$post['form_serialized_data'] = $this->get_default_form_serialized_data($post['widget_name']);
		unset($post['widget_name']);
		$post['mode'] = 'update';
        $url = esc_url( $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/widget/update' );
		$response = spnxHelper::doCurl( $url, $post );
        echo json_decode($response);
		wp_die();
	}

	function spinkx_cont_widget_create() {
		$post = spnxHelper::getFilterPost();
		$post['mode'] = 'create';
		$url = esc_url( $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/widget/create' );
		$response = spnxHelper::doCurl( $url, $post );
		$response = json_decode($response);
		if( is_int($response) && $response > 0 ) {
			add_option("spinkx_static_id", $response);
		}
		echo $response;
		exit;
	}

	function spinkx_cont_campaign_ajax() {

		$action_arr = array('remove', 'edit', 'addStatus', 'changeStatus', 'view', 'receive');
		$mode = spnxHelper::getFilterVar( 'mode', INPUT_POST);
		$post = spnxHelper::getFilterPost();
		if ( $mode ) {
			if (in_array( $mode, $action_arr)) {
				$url = esc_url( $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign/update' );
				$result = spnxHelper::doCurl($url, $post);
				echo $result;
				wp_die();
			}
		} else {
			//print_r($_FILES);die;
			$url = SPINKX_CONTENT_PLUGIN_URL;
			$folderpath = str_replace("\\", "/", dirname(__FILE__));
			$files = spnxHelper::getFilterFiles();
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
			$hooks = spnxHelper::getFilterVar( 'hooks' );
			if ( $hooks ) { // added for hooks image save.
				//$url = SPINKX_SERVER_BASEURL . '/wp-admin/admin-ajax.php?action=spinkx_server_campaigns_save_hook'; correction
				$url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign/add/advertisement';
			} else {
				$url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign/add/advertisement';
			}
			$result = spnxHelper::doCurl($url, $post);
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
			$link = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign/fb/impression/' . $result . '/' . $s_url;

		} else {
			$link = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign/fb/impression/'.$id.'/'.$data['landing'];
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

	function  get_default_form_serialized_data( $widget_name  ) {
		$postdata = array();
		// vikash Default widget creation and default settings insertion
		$postdata['widget_name'] = $widget_name;
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

		$postdata['unit_show_views'] = 1;

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
		return http_build_query( $postdata );
	}

	function spinkx_cont_campaign_save() {
		$post = spnxHelper::getFilterPost();
		//$post['post_full_image'] = wp_get_attachment_image_src( $post['image_aid'],'full' )[0];
		if( isset( $post['c_id'] ) && $post['c_id'] > 0 ) {
			$url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign/update';
		} else {
			$url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign/create';
		}
		$output = spnxHelper::doCurl( $url, $post );
		print_r($output);
		exit;
	}

	function spinkx_cont_campaign_pay() {
		$settings = get_option( $this->spinkx_cont_get_license() );
		$settings = maybe_unserialize( $settings );
		if( is_array( $settings ) && isset($settings['site_id'])) {
			$url = esc_url($this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign/add-money');
			$response = spnxHelper::doCurl($url, true);
			$response_money = json_decode($response);
			if ($response_money) {
				do_shortcode($response_money);
			}
		}
		exit;
	}

	function spinkx_cont_campaign_get_data() {
		$settings = get_option( $this->spinkx_cont_get_license() );
		$settings = maybe_unserialize( $settings );
		if( is_array( $settings ) && isset($settings['site_id'])) {
			$post = spnxHelper::getFilterPost();
			$post['access_key'] = $settings['license_code'];
			$post['site_id'] = $settings['site_id'];
			$url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign/get';
			$output = spnxHelper::doCurl($url, $post );
			echo $output;
		}
		exit;
	}

	function spinkx_cont_save_notice_info() {
		$option_key = spnxHelper::getFilterVar('key', INPUT_POST);
		if( $option_key  ) {
			if( ! update_option($option_key, 0 ) ) {
				add_option($option_key, 0);
			}
		}
		exit;
	}

	function spinkx_cont_campaign_refund_amount() {
		$settings = get_option( $this->spinkx_cont_get_license() );
		$settings = maybe_unserialize( $settings );
		if( is_array( $settings ) && isset($settings['site_id'])) {
			$post = spnxHelper::getFilterPost();
			$url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign/refund-amount';
			$output = spnxHelper::doCurl($url, $post );
			echo $output;
		}
		exit;
	}

	function spinkx_cont_widget_get_site_url() {
		$post = spnxHelper::getFilterPost();
		if( isset($post['categories'])) {
			$url = esc_url($this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/widget/get-site-url');
			$response = json_decode(spnxHelper::doCurl($url, $post));
			wp_send_json_success(array("urls" => $response));
		} else{
			wp_send_json_error(array("msg"=>"Invalid Request"));
		}
		exit;
	}


	function spinkx_cont_get_attachment_id( $url ) {
		global $wpdb;
		$attachment_id = 0;
		//$dir = wp_upload_dir();
		//if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
		$file = basename( $url );
		$query_args = array(
			'post_type'   => 'attachment',
			'post_status' => 'inherit',
			'fields'      => 'ids',
			'meta_query'  => array(
				array(
					'value'   => $file,
					'compare' => 'LIKE',
					'key'     => '_wp_attachment_metadata',
				),
			)
		);
		$query = new WP_Query( $query_args );
		if ( $query->have_posts() ) {
			foreach ( $query->posts as $post_id ) {
				$meta = wp_get_attachment_metadata( $post_id );
				$original_file       = basename( $meta['file'] );
				$cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
				if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
					$attachment_id = $post_id;
					break;
				}
			}
		}
		//}
		return $attachment_id;
	}

	public function spinkx_cont_spinkx_admin_menu() {
		if ( current_user_can( 'manage_network_options' ) || current_user_can( 'manage_options' ) ) {
            $settings = get_option( $this->spinkx_cont_get_license() );
            $settings = maybe_unserialize( $settings );
            $parent_menu_slug = isset($settings['due_date'])?'spinkx_analytics':'spinkx-site-register';

            add_menu_page('Spinkx Options', 'Spinkx', 'manage_options', $parent_menu_slug, array($this, 'spinkx_cont_show_page'), SPINKX_CONTENT_PLUGIN_URL . 'assets/images/spinkx-ico.svg', '2.56');
            if(isset($settings['due_date'])) {
                add_submenu_page($parent_menu_slug, 'Analytics | Spinkx', 'Analytics', 'manage_options', 'spinkx_analytics', array($this, 'spinkx_cont_show_page'));
                add_submenu_page($parent_menu_slug, 'Registration | Spinkx', 'Registration', 'manage_options', 'spinkx-site-register', array($this, 'spinkx_cont_show_page'));
            } else {
                add_submenu_page($parent_menu_slug, 'Registration | Spinkx', 'Registration', 'manage_options', 'spinkx-site-register', array($this, 'spinkx_cont_show_page'));
                add_submenu_page($parent_menu_slug, 'Analytics | Spinkx', 'Analytics', 'manage_options', 'spinkx_analytics', array($this, 'spinkx_cont_show_page'));
            }
            add_submenu_page($parent_menu_slug, 'Widget Settings | Spinkx', 'Widget Settings', 'manage_options', 'spinkx_widget_design', array($this, 'spinkx_cont_show_page'));
			add_submenu_page($parent_menu_slug, 'Boost Post | Spinkx', 'Free Boost Post', 'manage_options', 'spinkx_content_play_list', array($this, 'spinkx_cont_show_page'));
			add_submenu_page($parent_menu_slug, 'Campaigns | Spinkx', 'Paid Campaigns', 'manage_options', 'spinkx_campaigns', array($this, 'spinkx_cont_show_page'));
        }
	}

	public function spinkx_cont_show_page() {
		$flag = true;
		$r_flag = spnxHelper::getFilterVar( 'r', INPUT_REQUEST );
		$page = spnxHelper::getFilterVar( 'page' );
		switch ( $page ) {
			case 'spinkx_widget_design':
				require SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/widget-design.php';
				break;
			case 'spinkx_content_play_list':
				require SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/content-playlist.php';
				break;
			case 'spinkx_analytics':
				require SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/dashboard.php';
				break;
			case 'spinkx_campaigns':
				require SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/manage-ads.php';
				break;
			case 'spinkx-site-register':
				require SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/site-registration.php';
				break;
		}
	}

	public function spinkx_cont_display_shortcode( $atts, $content = null ) {
		shortcode_atts( array( 'id' => '', 'user_id' => '', 'site_id' => '' ), $atts );
		if( isset($atts['id']) && ! $atts['id'] ) {
			echo 'Your widget code not autorized';
		}
		//$license = get_option( $this->spinkx_cont_get_license() );
		//$license_arr = maybe_unserialize( $license );
		$shortcode_output = '';
		$spnx_widget = get_option('spnx_widget_'.$atts['id'], 'not-exist' );

		/*if( $spnx_widget != false  || 'not-exist' == $spnx_widget) {*/

		if (isset($atts['is_mobile']) && intval($atts['is_mobile']) == 1) {
			require_once SPINKX_CONTENT_PLUGIN_DIR . 'includes/display/show-widget-mobile-data.php';
		} else {
			require_once SPINKX_CONTENT_PLUGIN_DIR . 'includes/display/show-widget.php';
		}
		return $shortcode_output;
	}

	public function  spinkx_cont_mobile_widget_data() {
		$widget_id = $_REQUEST['widget_id'];
		$shortcode_output = '';
		require SPINKX_CONTENT_PLUGIN_DIR . 'includes/display/show-widget-mobile-data.php';
		echo $shortcode_output;
		exit;
	}

	

	/**
	 *
	 * This function fire check license date
	 * spinkx_cont_get_license_date()
	 *
	 * @return string
	 * @param date $due_date date duedate object.
	 */
	public function spinkx_cont_get_license_date( $due_date ) {
		$datetime = strtotime( $due_date );
		$date1 = date_create( $due_date );
		$date2 = date_create( date( 'Y-m-d H:i:s' ) );
		$diff = date_diff( $date2, $date1 );
		return $diff;
	}


	/**
	 *
	 * This function fire when plugin ondemand api hit
	 * spinkx_cont_content_search()
	 *
	 * @return void
	 *
	 */
	public function spinkx_cont_content_search() {
		$q = spnxHelper::getFilterVar('q', INPUT_GET, FILTER_SANITIZE_STRING);
		if ( $q ) {
			$csObj = new spnxContentSearch( $q );
			$result = $csObj->get_posts_result();
			echo $result;
		}
	}

	/**
	 *
	 * This function print post data base on post_id
	 * spinkx_cont_get_post_data()
	 *
	 * @return void
	 *
	 */
	public function spinkx_cont_get_post_data() {
		$pid = spnxHelper::getFilterVar( 'pid', INPUT_POST, FILTER_VALIDATE_INT);
		if( $pid ) {
			$post = get_post($pid, ARRAY_A);
			echo wp_json_encode($post);
		}
	}

	/**
	 *
	 * This function get content and return excerpt
	 * spinkx_cont_get_excerpt_by_id()
	 *
	 * @param string  $post_content pass string in first param.
	 * @param integer $excerpt_length pass integer value for content length.
	 * @return string
	 */
	public function spinkx_cont_get_excerpt_by_id( $post_content, $excerpt_length = 20 ) {
		$the_excerpt = $post_content; // Gets post_content to be used as a basis for the excerpt.
		$the_excerpt = strip_tags( strip_shortcodes( $the_excerpt ) ); // Strips tags and images.
		$words = explode( ' ', $the_excerpt, $excerpt_length + 1 );
		if ( count( $words ) > $excerpt_length ) :
			array_pop( $words );
			array_push( $words, '…' );
			$the_excerpt = implode( ' ', $words );
		endif;
		$the_excerpt = $the_excerpt;
		return $the_excerpt;
	}

	/**
	 *
	 * This function fire on post transitions
	 * spinkx_cont_update_status_transitions()
	 *
	 * @return void
	 * @param string $new_status post new status.
	 * @param string $old_status post old status.
	 * @param object $post post object.
	 */
	public function spinkx_cont_update_status_transitions( $new_status, $old_status, $post ) {

		if ( ( $new_status !== $old_status ) && ( ( 'auto-draft' !== $new_status ) && ( 'new' !== $old_status ) ) ) {
			 $this->spinkx_cont_update_on_publish_to_publish($post);
		};
	}


	/**
	 *
	 * This function fire on post update
	 * spinkx_cont_update_on_publish_to_publish()
	 *
	 * @return void
	 * @param object $post post object when post update.
	 */
	public function spinkx_cont_update_on_publish_to_publish( $post ) {
		//$license_check = maybe_unserialize( get_option( $this->spinkx_cont_get_license() ) );
		$current_blog_id = get_current_blog_id();
		$curl_url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/content-playlist/post/update';
		$post->post_publish_date = $post->post_date_gmt;
		setup_postdata( $post );
		$post_content = wp_strip_all_tags(strip_shortcodes($post->post_content));
		$post_excerpt = $this->spinkx_cont_get_excerpt_by_id( $post_content );
		$post->post_author_email = esc_attr( get_the_author_meta( 'email' ) );
		$post->post_author_name = esc_attr(get_the_author_meta( 'display_name' ));
		$post->post_excerpt =  base64_encode( $post_excerpt );
		$post->guid = '';
		$post->post_src_id = $post->ID;
		$post_array = (array) $post;
		unset( $post_array['ping_status'] );
		unset( $post_array['comment_status'] );
		$pid = $post->ID;
		$p_thumb_id = get_post_thumbnail_id( $pid );
		$p_thumb_array = wp_get_attachment_image_src( $p_thumb_id, 'full' );
		$p_thumb_image_array = wp_get_attachment_image_src( $p_thumb_id, 'medium' );
		$p_thumb_url = $p_thumb_array[0];
		$p_thumb_image_url = $p_thumb_image_array[0];
		if ( ! ($p_thumb_id && $p_thumb_image_url) ) {
			$p_thumb_image_url =  $this->spinkx_cont_get_attachment_image($pid, 1 );
			if(isset($p_thumb_image_url[0]) && strlen($p_thumb_image_url[0]) > 15 ) {
				$p_thumb_id = $this->spinkx_cont_get_attachment_id($p_thumb_image_url[0]);
				if( $p_thumb_id ) {
					$p_thumb_array = wp_get_attachment_image_src($p_thumb_id, 'full');
					$p_thumb_image_array = wp_get_attachment_image_src($p_thumb_id, 'medium');
					$p_thumb_url = $p_thumb_array[0];
					$p_thumb_image_url = $p_thumb_image_array[0];
				} else {
					$p_thumb_array = $p_thumb_image_array = $p_thumb_image_url[0];
					$p_thumb_image_url = null;
				}
			}
			if ( ! ($p_thumb_id && $p_thumb_image_url) ) {
				return;
			}
		}
		$post_array['post_full_image'] =  base64_encode( $p_thumb_url );
		$post_array['post_thumb_image'] = base64_encode( $p_thumb_image_url );
		if ( class_exists( 'Domainmap_Plugin' ) ) {
			$relative_url = str_replace( home_url(), '', get_permalink( $pid ) );
			$permalink_url = $this->wpmu_get_mapped_domain( $current_blog_id ) . $relative_url;
		} else {
			$permalink_url = get_permalink( $pid );
		}
		$post_array['post_url'] = $permalink_url;
		$post_views_count = get_post_meta( $pid, 'views', true );
		if ( empty( $post_views_count ) ) {
			$post_array['post_views'] = 0;
		} else {
			$post_array['post_views'] = intval( $post_views_count );
		}
		$tags = wp_get_post_tags( $pid );
		$p_tags = array();
		foreach ( $tags as $tag ) {
			$p_tags[] = $tag->name;
		}
		$post_array['post_tags'] = implode( ',', $p_tags );
		$categories = wp_get_post_categories( $pid );
		$p_cats = array();
		foreach ( $categories as $c ) {
			$cat = get_category( $c );
			$p_cats[] = $cat->name;
		}
		$post_array['post_categories'] = implode( ',', $p_cats );
		$json_posts_array = base64_encode( maybe_serialize( $post_array ) );
		//$postData = array( 'post' => $json_posts_array, 'key' => base64_encode( maybe_serialize( $license_check ) ) );
		$postData = array( 'post' => $json_posts_array);
		spnxHelper::doCurl( $curl_url, $postData, false );
	}

	public function wpmu_get_mapped_domain( $blog_id ) {
		global $wpdb;
		$data = $wpdb->get_row( 'SELECT * FROM ' . $wpdb->base_prefix . "domain_mapping WHERE blog_id = $blog_id" );
		// echo "data--".$data;
		if ( ! $data ) { return get_site_url( $blog_id );
		}
		if ( $data->scheme == 1 ) {
			$schem = 'https://';
		} else {
			$schem = 'http://';
		}
		return $schem . $data->domain;
	}

	/**
	 *
	 * This function fire after spinkx plugin activated
	 * plugin_activated()
	 *
	 * @return void
	 * @param string $old_value post old status after permalink changes.
	 * @param string $new_value post new status after permalink changes.
	 */
	public function spinkx_cont_permalink_update( $old_value, $new_value ) {
		if($old_value != $new_value) {
			$output = spnxHelper::doCurl($this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/content-playlist/post/get_postdata', true, FALSE);
			if ($output) {
				$post_array = json_decode($output);
				if (count($post_array) > 0) {
					$data = array();
					foreach ($post_array as $post) {
						$post_status = get_post_status($post->id);
						if ($post_status == 'publish') {
							$permalink_url = '';
							if (class_exists('Domainmap_Plugin')) {
								$current_blog_id = get_current_blog_id();
								$relative_url = str_replace(home_url(), '', get_permalink($post->id));
								$permalink_url =  $this->wpmu_get_mapped_domain($current_blog_id) . $relative_url;

							} else {
								$permalink_url = get_permalink($post->id);
							}
							$data[$post->id] = $permalink_url;
						}
					}
					if (count($data) > 0) {
						/**$post_array = array();
						$post_array['site_id'] = $settings['site_id'];
						$post_array['license_code'] = $settings['license_code'];
						$post_array['reg_email'] = $settings['reg_email'];
						$data['key'] = $post_array;
						$json_posts_array = base64_encode(maybe_serialize($data));
						$postData = array('post' => $json_posts_array); **/
						$output = spnxHelper::doCurl($this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/content-playlist/post/update_permalink',true, FALSE);
					}
				}
			}
		}
	}

	public function spinkx_cont_wpmu_add_new_blog( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {
		$this->spinkx_cont_site_registration( $blog_id );
	}

	public function spinkx_cont_content_add( $content ) {
		$content .= '<div id="spinkx_cont_aritcle_end"></div>';
		if ( is_single() ) {
			$spinkx_static_id = get_option('spinkx_static_id');
			if ( $spinkx_static_id && $spinkx_static_id > 0) {
				//$shortcode_render = do_shortcode('[spinkx id="'.$spinkx_static_id.'"]');
				//$content .= '<br/><br />' . $shortcode_render;
			}
		}
		return $content;
	}

	/**
	 *
	 * This function execute via hook after dashboard setup
	 * spinkx_cont_add_dashboard_widgets()
	 *
	 * @return void
	 * @internal param $void
	 */
	public function spinkx_cont_add_dashboard_widgets() {
		//wp_add_dashboard_widget(  'spinkx_cont_dashboard_widget', 'SPINKX Statistics', array($this, 'spinkx_cont_dashboard_widget')  );
		//$this->spinkx_cont_update_version();
	}


	/**
	 *
	 * This function show statistics on WordPress dashboard
	 * spinkx_cont_dashboard_widget()
	 *
	 * @return void
	 * @internal param $void
	 */
	public function spinkx_cont_dashboard_widget() {
        $url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/site/statistics';
        $wp_output = spnxHelper::doCurl($url, true);
        $availablecredit = 0;
		$impPostTotalToday = 0;
		$impPostTotalYesterday = 0;
		if ( ! is_wp_error( $wp_output ) &&  $wp_output['body'] != null) {
			$jsonity = json_decode($wp_output['body']);
			if( is_object( $jsonity ) ) {
				if (isset($jsonity->available_credit_block->availablecredit)) {
					$availablecredit = number_format($jsonity->available_credit_block->availablecredit, 2);
				}
                $impPostTotalToday = ($jsonity->available_credit_block->impPostTotalToday) ? $jsonity->available_credit_block->impPostTotalToday : '';
				$impPostTotalYesterday = ($jsonity->available_credit_block->impPostTotalYesterday) ? $jsonity->available_credit_block->impPostTotalYesterday : '';
			}
			echo '<div style="float:left; width: 48%;">     
				  <img src="' . esc_url( SPINKX_CONTENT_PLUGIN_URL ) . 'assets/images/logo.png" alt="Home" style="  width: 100%; margin: 0px auto; display: block;">
		   </div>';
			echo '<style>
	.spinkx_dashwidget_label{ float:left; color:#242E82; font-size:1.2em; height:50%; width:25%; margin: 10% 10px; align-content: center; }

.spinkx_dashwidget_value{ color:#242E82; font-size:1.5em; align-content: center; margin: 14% 25%; width:100%; height: 40%; }

.spinkx_dashwidget_value p {  margin:0; }

	</style>
	
	<div style="float:left; width:50%; height:8%; margin:0 auto;"> 
	<div class="spinkx_dashwidget_label">Credit Points</div> 
	<div class="spinkx_dashwidget_value"><p> ' . $availablecredit . '</p>
	</div> 
	<div style="clear:both;"></div> 
	<hr /> 
	<div class="spinkx_dashwidget_label">Post Reach</div> 
	<div class="spinkx_dashwidget_value" style="margin:9% 7%;"><p> ' . $impPostTotalToday . ' <span style="font-size:.5em; color:#3E933B;"> Today</span><br/>  ' . $impPostTotalYesterday . ' <span style="font-size:.7em; color:#3E933B;"> Yesterday</span></p> </div> </div> 
	<div style="clear:both;">
	</div>
	
	<div style="float:left; width:100%; margin:5px 20%;">
	  <span style="float:left; height:20px; "><a href="admin.php?page=spinkx_analytics">Visit Dashboard</a></span> | <span><a href="admin.php?page=spinkx_content_play_list">Boost Post</a></span>
	
	
	  </div>
	  <div style="clear:both;"></div>';
		} else {

		}
	}


	public function spinkx_cont_update_version() {
		$current = get_site_transient( 'update_plugins' );
		$plugin = plugin_basename( __FILE__ );
		if(  isset( $current->response[ $plugin ] ) ) {
			$spinkx_object = $current->response[$plugin];
		}
		$current_blog_id = get_current_blog_id();
		if( isset( $spinkx_object ) && $spinkx_object->new_version != $this->_spinkx_cont_version ) {
			$data = array();
			if( is_multisite() ) {
				$args = array(
					'public'     => 1,
					'number'      => 2000,
					'offset'     => 0,
				);
				$sites_array = get_sites( $args );

				foreach ( $sites_array as $site ) {
					switch_to_blog( $site->blog_id );
					$settings = maybe_unserialize( get_option( $this->spinkx_cont_get_license() ) );
					$data[] = $settings['site_id'];
				}
			} else {
				$settings = maybe_unserialize( get_option( $this->spinkx_cont_get_license() ) );
				$data[] = $settings['site_id'];
			}
			$lpost_data = wp_json_encode(array( "id" => $data, "current_version" => $this->_spinkx_cont_version));
			$url = $this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/site/update_version';
			wp_remote_post( $url, array(
				'method' => 'POST',
				'body' => $lpost_data,
			));

		}
	}

	public function spinkx_cont_get_site_url() {
		$site_url = '';
		if ( class_exists( 'Domainmap_Utils' ) ) {
			$obj = new Domainmap_Utils();
			$temp = $obj->get_mapped_domain();
			if ( $temp ) {
				$site_url = $temp;
			}
		}
		if ( ! $site_url ) {
			$site_url	= get_site_url();
		}
		return $site_url;
	}

	public function spinkx_cont_last_30_days() {
		$yesterday = strtotime('-1 Day');
		$last_30_days = strtotime("today -30 Days");
		$today = strtotime('today');
		return array($last_30_days, $yesterday, $today);
	}

	public function spinkx_cont_withdraw_money_request () {
		$output = spnxHelper::doCurl($this->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign/withdraw-money', true);
		echo $output;
		exit;
	}
}
endif;
