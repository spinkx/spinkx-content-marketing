<?php
/**
 * This file is used for get all post_id from server when update parmalink structure
 * Created by PhpStorm.
 * User: vikash
 * Date: 19/7/16
 * Time: 2:25 PM
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wpdb;
if ( ! function_exists( 'wpmu_get_mapped_domain' ) ) {

	function wpmu_get_mapped_domain( $blog_id ) {
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
}

$settings = get_option( SPINKX_CONT_LICENSE );
$settings = maybe_unserialize( $settings );
$post_array['site_id'] = $settings['site_id'];
$post_array['license_code'] = $settings['license_code'];
$post_array['reg_email'] = $settings['reg_email'];
$json_posts_array = base64_encode( maybe_serialize( $post_array ) );
$postData = array( 'post' => $json_posts_array );
$output = helperClass::doCurl( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/content-playlist/post/get_postdata', $postData, false );
if ( $output ) {
	$post_array = json_decode( $output );
	if ( count( $post_array ) > 0 ) {
		$data = array();
		foreach ( $post_array as $post ) {
			$post_status = get_post_status( $post->id );
			if ( $post_status == 'publish' ) {
				$permalink_url = '';
				if ( class_exists( 'Domainmap_Plugin' ) ) {
					$current_blog_id = get_current_blog_id();
					$relative_url = str_replace( home_url(), '', get_permalink( $post->id ) );
					$permalink_url = wpmu_get_mapped_domain( $current_blog_id ) . $relative_url;

				} else {
					$permalink_url = get_permalink( $post->id );
				}
				$data[ $post->id ] = $permalink_url;
			}
		}
		if ( count( $data ) > 0 ) {
			$post_array = array();
			$post_array['site_id'] = $settings['site_id'];
			$post_array['license_code'] = $settings['license_code'];
			$post_array['reg_email'] = $settings['reg_email'];
			$data['key'] = $post_array;
			$json_posts_array = base64_encode( maybe_serialize( $data ) );
			$postData = array( 'post' => $json_posts_array );
			$output = helperClass::doCurl( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/content-playlist/post/update_permalink', $postData, false );
		}
	}
}
