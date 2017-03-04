<?php
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
$license_check = maybe_unserialize( get_option( SPINKX_CONT_LICENSE ) );
$current_blog_id = get_current_blog_id();
$curl_url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/content-playlist/post/update';
if ( $post->post_type != 'post' ) {
	return;
};
$post_title = $post->post_title;
$post->post_publish_date = $post->post_date_gmt;
setup_postdata( $post );
/*if ( strtotime( $post->post_publish_date ) < strtotime( '-6 months' ) ) {
	return;
}*/
$post_content = $post->post_content;
$post_excerpt = spinkx_cont_get_excerpt_by_id( $post_content );
$post->post_author_email = get_the_author_meta( 'email' );
$post->post_author_name = get_the_author_meta( 'display_name' );
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
	return;
}
$post_array['post_full_image'] =  base64_encode( $p_thumb_url );
$post_array['post_thumb_image'] = base64_encode( $p_thumb_image_url );
$permalink_url = '';
if ( class_exists( 'Domainmap_Plugin' ) ) {
	$relative_url = str_replace( home_url(), '', get_permalink( $pid ) );
	$permalink_url = wpmu_get_mapped_domain( $current_blog_id ) . $relative_url;
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
//$api = $curl_url . '?post=' . $json_posts_array . '&key=' . base64_encode( maybe_serialize( $license_check ) );
$postData = array( 'post' => $json_posts_array, 'key' => base64_encode( maybe_serialize( $license_check ) ) );
$output = helperClass::doCurl( $curl_url, $postData, false );

