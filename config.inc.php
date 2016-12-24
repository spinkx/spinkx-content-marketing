<?php
/**
 * This is spinkx confiuration file.
 *
 * In this file we define some constant that required for run this plugin
 *
 * @package wordpress.
 * @subpackage spinkx.
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly	

define( 'SPINKX_VERSION', '1.1.3' );
define( 'SPINKX_OPERATION_MODE', 1 );
define( 'SPINKX_SERVER_BASEURL', 'http://bwdev.local/spinkx-server' );
//define( 'SPINKX_SERVER_BASEURL', 'https://api.spinkx.com' );
define( 'SPINKX_CONT_LICENSE', 'spinkx_content_license_update' );
define( 'SPINKX_CONTENT_PLUGIN_DIR', plugin_dir_path( __FILE__ )  );
define( 'SPINKX_CONTENT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'FACEBOOK_CALLBACK_URL', admin_url( 'admin.php?page=custompage' ) );
