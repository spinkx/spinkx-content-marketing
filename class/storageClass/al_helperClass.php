<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/* Helper functions for client */
class helperClass {


	/** To perform a curl request to server
	 * * Post null for get requests
	 **/
	public static function doCurl( $url, $post = null, $is_json_encode = true, $headers = array(), $timeout = 0 ) {
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
			if($is_json_encode) {
				$post = wp_json_encode($post);
			}
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
				$error_message = $wp_output->get_error_message();
				$output =  "Something went wrong: $error_message";
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

}
