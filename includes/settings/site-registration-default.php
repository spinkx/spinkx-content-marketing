<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly		
	$site_id = false;
	global $wpdb;
	$url = esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/site/create' );
	$mflag = is_multisite();
if ( $mflag ) {
	if( isset( $blog_id ) && $blog_id > 0) {
		$siteArr = array( array( 'blog_id' => $blog_id ) );
	} else {
		$siteArr = $wpdb->get_results('SELECT blog_id FROM `wp_blogs` WHERE public = 1', ARRAY_A);
	}
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
	}
	    $data['sflag'] = 'site_create';

		$response = helperClass::doCurl( $url, $data );
		
	if ( $response && ! $site_id ) {


		$output = json_decode($response, TRUE);
		if (!isset($output['message'])) {
			$output['current_blog_id'] = $currentSite['blog_id'];
			$s = maybe_serialize($output);
			update_option(SPINKX_CONT_LICENSE, $s);
		}
	}
}