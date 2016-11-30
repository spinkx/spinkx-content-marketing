<?php
/**
 * This file is used for content search get request and search in database and return result in json format
 * Created by PhpStorm.
 * User: Vikash Saharan
 * Date: 12/7/16
 * Time: 5:50 PM
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ContentSearch extends WP_Query
{

    private $_keyword = null;
    public function __construct($keyword)
    {
        $this->_keyword = $keyword;
    }

    public function get_posts_result()
    {
        //$this->_keyword = 'photos';
        $result = array();
        $wpqQobj = new WP_Query(array('fields' => 'ids','post_type' => 'post','post_status' => 'publish','s'=>$this->_keyword,'orderby' => 'date',
            'order' => 'DESC'));
        $keywordArray = $wpqQobj->get_posts();
             //$myrows = $wpdb->get_results("SELECT id FROM $wpdb->posts where 1=1  AND post_status LIKE 'publish' " . $appendSearchQuery . ' order by post_modified desc');
        $live_tags_category = array(
            'post_type' => 'post',
            'fields' => 'ids',
            'post_status' => 'publish',
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'post_tag',
                    'field' => 'slug',
                    'terms' => $this->_keyword,
                ),
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $this->_keyword,
                ),
            ),
            'orderby' => 'date',
            'order' => 'DESC'
        );
        //print_r($live_tags_category);
        $wpqQobj = new WP_Query($live_tags_category);
        $catArray = $wpqQobj->get_posts();
        //global $wpdb;
        //echo $wpdb->last_query;
        //print_r($catArray);
        $unique_array = null;
        if(count($keywordArray) > 0 && count($catArray) > 0) {
            $unique_array = (array_unique(array_merge($keywordArray,$catArray)));
        } elseif((!count($keywordArray) > 0) && count($catArray) > 0) {
            $unique_array = $catArray;
        } elseif(count($keywordArray) > 0 && (!count($catArray) > 0)) {
            $unique_array = $keywordArray;
        }
        if(count($unique_array) > 0) {
            $q = new WP_Query(array('post__in' => $unique_array,'fields'=>array('ID','post_stitle')));
            $myposts = $q->get_posts();
            foreach ( $myposts as $post ) : setup_postdata( $post );
                $pid = $post->ID;
                $excerpt = $post->post_excerpt;
                if(!$excerpt) {
                    $excerpt = get_the_excerpt();
                }
                $p_thumb_id = get_post_thumbnail_id( $pid );
                $p_thumb_array = wp_get_attachment_image_src( $p_thumb_id, "full" );
                $p_thumb_image_array = wp_get_attachment_image_src( $p_thumb_id, 'thumbnail');
                $p_thumb_url = $p_thumb_array[0];
                $p_thumb_image_url = $p_thumb_image_array[0];
                $baseimage = base64_encode($p_thumb_url);
                $thumbnail_image = base64_encode($p_thumb_image_url);
                $result[] = array('ID' => $post->ID, 'title' => $post->post_title, 'excerpt' => $excerpt, 'thumbnail' => $thumbnail_image, 'base_image' => $baseimage);
            endforeach;
            wp_reset_postdata();
            if ($result && count($result) > 0) {
                return wp_json_encode($result);
            }
        }
        return false;
    }
}
function spinkx_cont_content_serach()
{
    $q =helperClass::getFilterVar('q', INPUT_GET, FILTER_SANITIZE_STRING);
    if ( $q ) {
        $csObj = new ContentSearch( $q );
        $result = $csObj->get_posts_result();
        //get_posts_result();
        echo $result;
    }
}