<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $wpdb;
require SPINKX_PLUGIN_PATH . 'widgets/create/get-post-fields-serialized.php';

$insert_serialized_storage_meta = "INSERT INTO `".$wpdb->prefix."bwki_storage_meta`
(
`widget_id`,
`meta_key`,
`meta_value`
)
VALUES
(
'".$main_widget_id."',
'serialized_widget_data',
'".$serialized_storage_meta."'
)";
$wpdb->query( $insert_serialized_storage_meta );
