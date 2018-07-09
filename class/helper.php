<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/* Helper Class manage helping function */
class spnxHelper {

	/** To perform a curl request to server
	 * * Post null for get requests
	 **/
	public static function doCurl( $url, $post = null, $is_json_encode = true, $headers = array(), $timeout = 0, $error_print = true ) {
		$output = null;
		if ( ! $post ) {
			if(!$headers) {
				$wp_output = wp_remote_get($url);
			} else {
				$wp_output = wp_remote_get($url, array('headers'=>$headers));
			}
			if ( is_wp_error( $wp_output ) ) {
				$error_message = $wp_output->get_error_message();
				$output =  "Something went wrong: $error_message";
			} else {
				$output = $wp_output['body'];
			}
		} else {
			if(is_bool($post)) {
				$post = array();
			}
			if(!strstr($url, '/site/create')) {
				$post = $post + self::_getAdditionalData();
			}
			if($is_json_encode) {
				$post = wp_json_encode($post);
			}
		/*	echo $url;
			print_r($post);*/
			if($timeout){
				$wp_output = wp_remote_post( $url,  array(
					'method' => 'POST',
					'timeout' => $timeout,
					'body' => $post,
				) );
			} else {
				$wp_output = wp_remote_post( $url,  array(
					'method' => 'POST',
					'body' => $post,
				) );
			}

			if ( is_wp_error( $wp_output ) ) {
				if( $error_print ) {
					$error_message = $wp_output->get_error_message();
					$output = "Something went wrong: $error_message";
				} else {
					$output = 'error';
				}

			} else {
				$output = $wp_output['body'];
			}
		}
		return $output;
	}

	public static function isEnabled( $func ) {
		return is_callable( $func ) && false === stripos( ini_get( 'disable_functions' ), $func );
	}

	public static function getIP() {
		$ip = null;
		if ( self::isEnabled( 'shell_exec' ) ) {
			$ip = trim( shell_exec( 'dig +short myip.opendns.com @resolver1.opendns.com' ) );
		} else {
			$ip = file_get_contents( 'http://ipv4bot.whatismyipaddress.com/' );
		}
		return $ip;
	}

	static public function getFilterPost( $args = array() ) {
		if( count( $args ) > 0 ) {
			return filter_input_array( INPUT_POST, $args );
		} else {
			return filter_input_array( INPUT_POST );
		}
	}

	static public function getFilterGet( $args = array() ) {
		if( count( $args ) > 0 ) {
			return filter_input_array( INPUT_GET, $args );
		} else {
			return filter_input_array( INPUT_GET );
		}
	}

	static public function getFilterSERVER($args) {
		if( count( $args ) > 0 ) {
			return filter_input_array( INPUT_SERVER, $args);
		} else {
			return filter_input_array( INPUT_SERVER );
		}
	}

	static public function getFilterCookies() {
		return filter_input_array(INPUT_COOKIE);
	}

	static public function getFilterFiles() {
		return filter_var_array($_FILES);
	}

	static public function getFilterRequest($args) {
		if( count( $args ) > 0 ) {
			return filter_input_array( INPUT_REQUEST, $args );

		} else {
			return filter_input_array( INPUT_REQUEST );
		}
	}

	static public function getFilterVar($variable, $input_type = INPUT_GET, $filter_validation = null, $options = array()) {
		if (INPUT_REQUEST === $input_type) {
			$input_type = INPUT_GET;
			if (filter_has_var($input_type, $variable)) {
				if ($filter_validation && count($options) > 0) {
					return filter_input($input_type, $variable, $filter_validation, $options);
				} elseif ($filter_validation) {
					return filter_input($input_type, $variable, $filter_validation);
				} else {
					return filter_input($input_type, $variable);
				}
			} else {
				$input_type = INPUT_POST;
				if (filter_has_var($input_type, $variable)) {
					if ($filter_validation && count($options) > 0) {
						return filter_input($input_type, $variable, $filter_validation, $options);
					} elseif ($filter_validation) {
						return filter_input($input_type, $variable, $filter_validation);
					} else {
						return filter_input($input_type, $variable);
					}
				} else {
					return NULL;
				}
			}
		} else {
			if (filter_has_var($input_type, $variable)) {
				if ($filter_validation && count($options) > 0) {
					return filter_input($input_type, $variable, $filter_validation, $options);
				} elseif ($filter_validation) {
					return filter_input($input_type, $variable, $filter_validation);
				} else {
					return filter_input($input_type, $variable);
				}
			} else {
				return NULL;
			}
		}
	}

	private static function _getAdditionalData() {
	    $spnxAdmin = new spnxAdminManage();
		$settings = get_option( SPINKX_CONTENT_LICENSE );
		$settings = maybe_unserialize( $settings );
		$post = array();
		if(isset($settings['site_id']) && isset($settings['reg_email']) &&$settings['license_code']) {
			$post['site_id'] = $settings['site_id'];
			$post['reg_email'] = $settings['reg_email'];
			$post['license_code'] = $settings['license_code'];
            $post['cuser_email'] = $spnxAdmin->getCurrentUserEmail();
		}
		return $post;
	}
	
	public function campaignValidation( $post ) {
		$msg = '';
		if( ! isset( $post['is_video'] ) ) {
			if ((empty($post['image_attachment_id']) || 0 == $post['image_attachment_id']) && !(isset($post['c_id']) && $post['c_id'] > 0)) {
				$msg .= 'image is not selected\n';
			}
		}
		if( false == $post['campaign_title']  || 'This is your Campaign Headline. Click here to edit' == $post['campaign_title'] ) {
			$msg .= 'Campaign Headline is missing\n';
		}
		if( false ==  $post['campaign_description']  || 'Introduce your campaign with a description ... Click here to edit' == $post['campaign_description'] ) {
			$msg .= 'Campaign description is missing\n';
		}
		if( 0 == $post['call_to_action'] ) {
			$msg .= 'Call to Action is missing\n';
		}
		if( empty( $post['parent_campaign_id'] ) ) {
			if (FALSE == $post['landing_url'] || 'http://...Landing Url' == $post['landing_url']) {
				$msg .= 'Landing url is missing\n';
			} else {
				if (filter_var($post['landing_url'], FILTER_VALIDATE_URL) === FALSE) {
					$msg .= 'URL is  not valid\n';
				}
			}

			if (!isset($post['utm_source']) && !isset($post['parent_campaign_id'])) {
				$msg .= 'UTM source blank\n';
			}
			if ((empty($post['utm_campaign']) || 'Campaign Name' == $post['utm_campaign']) && empty($post['parent_campaign_id'])) {
				$msg .= 'Campaign Name blank\n';
			}
			if (empty($post['categories']) || count($post['categories']) <= 0 && empty($post['parent_campaign_id'])) {
				$msg .= 'Select categories\n';
			}
			if (empty($post['locations']) || count($post['locations']) <= 0 && empty($post['parent_campaign_id'])) {
				$msg .= 'Select countries\n';
			}
			
			if ((!isset($post['camp_agreement'])) || 0 == $post['camp_agreement'] && empty($post['parent_campaign_id'])) {
				$msg .= 'agree is must fill\n';
			}
		}
		if( strlen($msg) > 1) {
			return array('success'=>false, 'msg' => $msg );
		} else {
			return array('success'=>true );
		}
	}

	public function sendMail() {

	}
}
