<?php
/**
 * Created by PhpStorm.
 * User: vikash
 * Date: 19/7/16
 * Time: 2:25 PM
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$pid = helperClass::getFilterVar( 'pid', INPUT_POST, FILTER_VALIDATE_INT);
if( $pid ) {
        $post = get_post($pid,ARRAY_A);
        echo wp_json_encode($post);
}