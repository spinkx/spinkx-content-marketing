<?php
/**
 *
 * @package wordpress.
 * @subpackage spinkx.
 */
	
/**
Plugin Name: Spinkx Content Marketing
Plugin URI: www.spinkx.com
Description: Spinkx is a full featured Content Marketing suite & an ad network. 1) Free Traffic Exchange 2) Content Distribution 3) Monetisation 4) SEO backlinks 5) Run Affiliate Campaign 6) Content analytics and <a href="http://www.spinkx.com">more..</a>
Author: SPINKX
Author URI: www.spinkx.com
Version: 3.1
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
define( 'SPINKX_CONTENT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SPINKX_CONTENT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
$data = file_get_contents ("env.json", FILE_USE_INCLUDE_PATH);
$data = json_decode( $data );
foreach($data as $key => $value) {
    if( !defined( $key ) ) {
        if(in_array($key, array('SPINKX_CONTENT_ADMIN_VIEW', 'SPINKX_CONTENT_FRONEND_VIEW','SPINKX_CONTENT_DIST'))) {
	        define( $key.'_DIR', SPINKX_CONTENT_PLUGIN_DIR.$value );
	        define( $key.'_URL', SPINKX_CONTENT_PLUGIN_URL.$value );
        } else {
	        define( $key, $value );
        }

    }
}

require_once SPINKX_CONTENT_PLUGIN_DIR . 'class/admin-manage.php';
require_once SPINKX_CONTENT_PLUGIN_DIR . 'class/helper.php';
require_once SPINKX_CONTENT_PLUGIN_DIR . 'class/mobiledetect.php';
require_once SPINKX_CONTENT_PLUGIN_DIR . 'resources/views/admin/spinkx-css-js-enqueue.php';
include_once SPINKX_CONTENT_PLUGIN_DIR . 'resources/views/admin/payments/payment-method.php';

$all_post_ids = 0;
$views_options = array( 'count' => 1, 'exclude_bots' => 1,'use_ajax' => 1 );
/**
 *
 * This function fire when plugin activate and send status update server
 * spinkx_cont_server_plugin_activate()
 *
 * @return void
 * @param string $network_wide params for multisite.
 */

/**
 *
 * This function fire when plugin deactivate and send status update server
 * spinkx_cont_server_plugin_deactivate()
 *
 * @return void
 * @param string $network_wide params for multisite.
 */

function spinkx_cont_server_plugin_uninstall( $network_wide ) {
	require  'uninstall.php';
}

/**
 *
 * This function fire after spinkx plugin activated
 * spinkx_cont_plugin_activated()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_site_registration( $blog_id = 0, $from = false ) {
	$site_id = false;
	global $wpdb;
	$spnxAdminManage = new spnxAdminManage();
	$url = esc_url( SPINKX_CONTENT_BAPI_URL . '/wp-json/spnx/v1/site/create/new' );
	$mflag = is_multisite();
	if ( $mflag ) {
		if(  $blog_id > 0 &&  $from == 'add_new_blog' ) {
			$siteArr = array( array( 'blog_id' => $blog_id ) );
		} else {
            $siteArr = $wpdb->get_results("SELECT blog_id FROM `{$wpdb->prefix}blogs` WHERE public = 1", ARRAY_A);
        }
	} else {
		$siteArr = array( array( 'blog_id' => get_current_blog_id() ) );
	}
	$data = array();
    $spinkx_version =  SPINKX_CONTENT_VERSION;
    $counter = 0;
	foreach ( $siteArr as $currentSite ) {
		if ( $mflag ) {
			switch_to_blog( $currentSite['blog_id'] );
		}
        $data[$counter]['site_email'] = get_option( 'admin_email' );
		$data[$counter]['site_name'] = get_bloginfo( 'name' );
		$data[$counter]['site_url'] = get_site_url();
		$data[$counter]['spinkx_version'] = $spinkx_version;
		$data[$counter]['agree'] = 'on';
		if ( class_exists( 'Domainmap_Utils' ) ) {
			$obj = new Domainmap_Utils();
			$temp = $obj->get_mapped_domain();
			if ( $temp ) {
				$data[$counter]['site_url'] = $temp;
			}
		}
        $data[$counter]['sflag'] = 'site_create';
		$data[$counter]['blog'] = $currentSite['blog_id'];
        $counter++;
    }
    error_log(print_r($data, true));
	$response = spnxHelper::doCurl( $url, $data, true, array(), 5000 );
    if ( $response ) {
		$output = json_decode($response, TRUE);
		error_log('response');
		error_log(print_r($response, true));

	    if ( $mflag ) {
            foreach ( $output as $site ) {

			    if ( ! isset( $site['message'] ) ) {
				    switch_to_blog( $site['blog'] );
				    unset( $site['blog'] );
				    $s = maybe_serialize( $site );
				    update_option( SPINKX_CONTENT_LICENSE, $s );
			    }
		    }
	    } else {
		    foreach ( $output as $site ) {
			    unset( $site['blog'] );
			    $s = maybe_serialize( $site );
			    update_option( SPINKX_CONTENT_LICENSE, $s );
		    }
        }
	}

}

function spinkx_cont_wpmu_add_new_blog( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {
    spinkx_cont_site_registration( $blog_id, 'add_new_blog' );
}
add_action('wpmu_new_blog',  'spinkx_cont_wpmu_add_new_blog', 10, 6);
function spinkx_registration_redirect( ) {
    $page = spnxHelper::getFilterVar('page');
    if($page == 'spinkx_widget_design' || $page == 'spinkx_content_play_list'  || $page == 'spinkx_campaigns' ) {
        $spnx_reg_update = get_option('spnx_reg_update');
        if( !$spnx_reg_update ) {
            exit( wp_redirect( admin_url( 'admin.php?page=spinkx-site-register' ) ) );
        }
    }
}
add_action('init', 'spinkx_registration_redirect');
/**
 *
 * This function fire when plugin deactivate and send status update server
 * spinkx_cont_server_plugin_deactivate()
 *
 * @return void
 * @param string $network_wide params for multisite.
 */
function spinkx_cont_server_plugin_deactivate( $network_wide ) {
	global $wpdb;
	$spnxAdminManage = new spnxAdminManage();
	$post = array();
	if( is_multisite() ) {
		$siteArr = $wpdb->get_results( "SELECT blog_id FROM `{$wpdb->prefix}blogs` WHERE public = 1", ARRAY_A );
		$data = array();
		foreach ( $siteArr as $currentSite ) {
			switch_to_blog($currentSite['blog_id']);
			$temp = maybe_unserialize(get_option( SPINKX_CONTENT_LICENSE ));
			$data[] = $temp['site_id'];
		}
		$post['ids'] = $data;
	}
	if(!count($post)) {
		$post = true;
	}
	$url = SPINKX_CONTENT_BAPI_URL. '/wp-json/spnx/v1/site/deactivate';
    spnxHelper::doCurl( $url, $post, false );
}
function spinkx_cont_db_setup() {
    include_once 'includes/settings/db-setup.php';
}
register_uninstall_hook( __FILE__, 'spinkx_cont_server_plugin_uninstall');
register_activation_hook( __FILE__,   'spinkx_cont_site_registration' );
register_deactivation_hook( __FILE__,  'spinkx_cont_server_plugin_deactivate' );
/**
 *
 * This function fire when shortcode execute
 * spinkx_cont_display_shortcode()
 *
 * @return string
 * @param array()     $atts shortcode params.
 * @param null|string $content this is string params.
 */
$first = 0;
add_action( 'wp_head', function(){
    if(!spinkx_cont_bot_detection() && shortcode_exists( 'spinkx' ) && !is_admin() ) {
    global $post;
    $spnxAdminManage = new spnxAdminManage;
    $license = get_option( SPINKX_CONTENT_LICENSE );
    $license_arr = maybe_unserialize( $license );
	$widget_list = get_option('spnx_widget_list');
    $spnx_widget_list_updated = get_option('spnx_widget_list_updated');
	$md = new SpnxMobileDetect;
	if($widget_list && $spnx_widget_list_updated) {
		$widget_list = maybe_unserialize($widget_list);
	} else {
		if(!$spnxAdminManage->update_widget_list()) {
			echo '<script>console.log("Widget list not updated")</script>';
            return;
		} else {
			$widget_list = get_option('spnx_widget_list');
			if($widget_list) {
				$widget_list = maybe_unserialize($widget_list);
			}
		}
	}
	if(!$widget_list) {
		return false;
	}
    $spnxwdArr = array();
    $deviceType = ($md->isMobile() ? ($md->isTablet() ? 'tablet' : 'phone') : 'desktop');

		foreach ($widget_list as $widget) {
			$is_mobile = (boolean)$widget['is_mobile'];
		if( $deviceType == 'desktop' && $is_mobile === false ) {
			$spnxwdArr[] =array("w"=>$widget['widget_id'], "c"=>$license_arr['license_code'], "s"=>$license_arr['site_id'], "p"=>0, "is_mobile" => $is_mobile, 'f' => $widget['fixed'] );
		} else if( $deviceType != 'desktop' && $is_mobile === true ) {
			$spnxwdArr[] =array("w"=>$widget['widget_id'], "c"=>$license_arr['license_code'], "s"=>$license_arr['site_id'], "p"=>0, "is_mobile" => $is_mobile, 'f' => $widget['fixed'] );
		}

	}
	if(is_object($post)) {
		$catArray = get_the_category($post->ID);
		$categories = array();
		foreach ($catArray as $key => $cat) {
			$categories[] = $cat->cat_name;
		}
		$widget_array['post_cat'] = $categories;
	} else {
		$post = new stdClass();
		$post->ID = 0;
		$categories = array();
	}
    ?>   
	<script>
    var spnx_server_base_url = '<?= SPINKX_CONTENT_API_URL?>/';
    var server_base_url = spnx_server_base_url;
    var assetsurl = '<?= SPINKX_CONTENT_DIST_URL?>';
    var spnx_cdn_url = '<?= SPINKX_CONTENT_DIST_URL?>';
    var sx_id = "";
    var post_src_id = <?= $post->ID?>;
    var spnx_pcat = <?= json_encode($categories)?>;
    var spnxWdArr = <?= json_encode($spnxwdArr)?>;
    var admin_ajax_url= '<?= admin_url('admin-ajax.php' ) ?>';
   <?php  if(SPINKX_CONTENT_PRODUCTION) { ?>
        (function (d, s) {
            var spnxl = !0;
            c = document.createElement('script');
            c.async = !0;
            c.src =  '<?= SPINKX_CONTENT_CDN_URL?>js/spnx_init.min.js';
            d.head.appendChild(c);
            d.head.addEventListener("load", function (event) {
                if (event.target.nodeName === "SCRIPT") {
                    if (event.target.getAttribute("src").indexOf('embeds.js') != -1) {
                        if (undefined !== window.spnx) {
                            csx_id = window.spnx.getId();
                            if (undefined != csx_id) {
                                sx_id = csx_id;
                                spnx.setId('sx_id', sx_id, 15);
                                spnx.initialize(spnxWdArr);
                            }
                            b = document.createElement('script');
                            b.async = !0;
                            b.src = '<?= SPINKX_CONTENT_CDN_URL?>js/spinkxut.js';
                            d.head.appendChild(b);
                        }
                    }
                    if (event.target.getAttribute("src").indexOf('spinkxut.js') != -1) {
                        if (spnxl && sx_id) {
                            spnxl = !0
                        }
                    }
                }
            }, !0)
        }(document, 'script'));
   <?php  } else { ?>
        (function (d, s) {
            var spnxl = !0;
            c = document.createElement('script');
            c.async = !0;
            c.src =  assetsurl +  'fjs/spnx_init.min.js';
            d.head.appendChild(c);
            d.head.addEventListener("load", function (event) {
                if (event.target.nodeName === "SCRIPT") {
                    if (event.target.getAttribute("src").indexOf('embeds.js') != -1) {
                        if (undefined !== window.spnx) {
                            csx_id = window.spnx.getId();
                            if (undefined != csx_id) {
                                sx_id = csx_id;
                                spnx.setId('sx_id', sx_id, 15);
                                spnx.initialize(spnxWdArr);
                            }
                            b = document.createElement('script');
                            b.async = !0;
                            b.src = assetsurl + 'fjs/spinkxut.js';
                            d.head.appendChild(b);
                        }
                    }
                    if (event.target.getAttribute("src").indexOf('spinkxut.js') != -1) {
                        if (spnxl && sx_id) {
                            spnxl = !0
                        }
                    }
                }
            }, !0)
        }(document, 'script'));
   <?php  } ?>
</script><?php }});
function spinkx_cont_bot_detection() {
	if (preg_match('/bot|crawl|curl|dataprovider|search|get|spider|find|java|majesticsEO|google|yahoo|teoma|contaxe|yandex|libwww-perl|facebookexternalhit/i', $_SERVER['HTTP_USER_AGENT'])) {
		return true;
	}
	return false;
}

//add_action( 'the_content', 'spinkx_cont_display_shortcode' );


/**
 *
 * This function count post views if WP_CACHE is disabled
 * spinkx_cont_process_postviews()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_process_postviews() {

	global $current_user, $post, $views_options;

	if ( is_int( $post ) ) {
		$post_obj = get_post( $post );
	} else {
		$post_obj = $post;
	}
	if ( ! wp_is_post_revision( $post_obj ) && ! is_preview() ) {
		if ( is_single() || is_page() ) {
			$id = intval( $post_obj->ID );
			$views_options = array( 'count' => 1, 'exclude_bots' => 1,'use_ajax' => 1 );
			if ( ! $post_views = get_post_meta( $post_obj->ID, 'spx_views', true ) ) {
				$post_views = 0;
			}
			$spx_month_views_var = 'spx_'.date('M').'_'.date('Y');
			if ( ! $spx_month_views = get_post_meta( $post_obj->ID, "$spx_month_views_var", true ) ) {
				$spx_month_views = 0;
			}
			update_post_meta( $id,  "$spx_month_views_var", ( $spx_month_views + 1 ) );
			$should_count = false;
			switch ( intval( $views_options['count'] ) ) {
				case 0:
					$should_count = true;
					break;
				case 1:
					if ( ! isset( $_COOKIE['USER_COOKIE'] ) && intval( $current_user->ID ) === 0 ) {
						$should_count = true;
					}
					break;
				case 2:
					if ( intval( $current_user->ID ) > 0 ) {
						$should_count = true;
					}
					break;
			}
			if ( intval( $views_options['exclude_bots'] ) === 1 ) {
				$bots = array( 'Google Bot' => 'googlebot', 'Google Bot' => 'google', 'MSN' => 'msnbot', 'Alex' => 'ia_archiver', 'Lycos' => 'lycos', 'Ask Jeeves' => 'jeeves', 'Altavista' => 'scooter', 'AllTheWeb' => 'fast-webcrawler' );
				$bots = array_merge( $bots, array( 'Inktomi' => 'slurp@inktomi', 'Turnitin.com' => 'turnitinbot', 'Technorati' => 'technorati', 'Yahoo' => 'yahoo', 'Findexa' => 'findexa', 'NextLinks' => 'findlinks', 'Gais' => 'gaisbo', 'WiseNut' => 'zyborg', 'WhoisSource' => 'surveybot' ) );
				$bots = array_merge( $bots, array( 'Bloglines' => 'bloglines', 'BlogSearch' => 'blogsearch', 'PubSub' => 'pubsub', 'Syndic8' => 'syndic8', 'RadioUserland' => 'userland', 'Gigabot' => 'gigabot' ) );
				$bots = array_merge( $bots, array( 'Become.com' => 'become.com', 'Baidu' => 'baiduspider', 'so.com' => '360spider', 'Sogou' => 'spider', 'soso.com' => 'sosospider', 'Yandex' => 'yandex' ) );
				$http_user_agent = spnxHelper::getFilterVar( 'HTTP_USER_AGENT', INPUT_SERVER );
				if ( $http_user_agent ) {
					$useragent = sanitize_text_field( wp_unslash( $http_user_agent ) );
					foreach ( $bots as $name => $lookfor ) {
						if ( stristr( $useragent, $lookfor ) !== false ) {
							$should_count = false;
							break;
						}
					}
				}
			}
			if ( $should_count && ( ( isset( $views_options['use_ajax'] ) && intval( $views_options['use_ajax'] ) === 0 ) || ( ! defined( 'WP_CACHE' ) || ! WP_CACHE ) ) ) {
					update_post_meta( $id, 'spx_views', ( $post_views + 1 ) );

				//$url = SPINKX_CONTENT_BAPI_URL . '/wp-json/spnx/v1/site/statistics';

			}
		}
	}
}


/**
 *
 * This function count post views if WP_CACHE is enabled
 * spinkx_cont_postview_cache_count_enqueue()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_postview_cache_count_enqueue() {
	global $current_user, $post, $views_options;

	if ( ! defined( 'WP_CACHE' ) || ! WP_CACHE ) {
		return;
	}

	$views_options = array( 'count' => 1, 'exclude_bots' => 1,'use_ajax' => 1 );
	if ( isset( $views_options['use_ajax'] ) && intval( $views_options['use_ajax'] ) === 0 ) {
		return;
	}

	if ( ! wp_is_post_revision( $post ) && ( is_single() || is_page() ) ) {
		$should_count = false;
		switch ( intval( $views_options['count'] ) ) {
			case 0:
				$should_count = true;
				break;
			case 1:
				if ( empty( $_COOKIE['USER_COOKIE'] ) && intval( $current_user->ID ) === 0 ) {
					$should_count = true;
				}
				break;
			case 2:
				if ( intval( $current_user->ID ) > 0 ) {
					$should_count = true;
				}
				break;
		}
		if ( $should_count ) {
			wp_enqueue_script( 'wp-postviews-cache',  SPINKX_CONTENT_DIST_URL . 'js/postviews-cache.js', array( 'jquery' ), '1.68', true );
			wp_localize_script( 'wp-postviews-cache', 'viewsCacheL10n', array( 'admin_ajax_url' => admin_url( 'admin-ajax.php' ), 'post_id' => intval( $post->ID ) ) );
		}
	}
}

/**
 *
 * This function count post views if WP_CACHE is enabled
 * spinkx_cont_increment_views()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_increment_views() {
	global $views_options;
	$postviews_id = spnxHelper::getFilterVar( 'postviews_id', INPUT_GET, FILTER_VALIDATE_INT );
	if ( empty( $postviews_id ) ) {
		return;
	}

	if ( ! defined( 'WP_CACHE' ) || ! WP_CACHE ) {
		return;
	}

	if ( isset( $views_options['use_ajax'] ) && intval( $views_options['use_ajax'] ) === 0 ) {
		return;
	}

	$post_id = intval( $postviews_id );
	if ( $post_id > 0 ) {
		$post_views = get_post_custom( $post_id );
		$post_views = intval( $post_views['spx_views'][0] );
		update_post_meta( $post_id, 'spx_views', ( $post_views + 1 ) );
		$spx_month_views_var = 'spx_'.date('M').'_'.date('Y');
		if ( ! $spx_month_views = get_post_meta($post_id, "$spx_month_views_var", true ) ) {
			$spx_month_views = 0;
		}
		update_post_meta( $post_id,  "$spx_month_views_var", ( $spx_month_views + 1 ) );
		exit();
	}
}

/**
 *
 * This function fire after all plugins loaded and WP-PostViews plugin is not available then add our hook
 * spinkx_cont_add_custom_action_after_plugins_loaded()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_add_custom_action_after_plugins_loaded() {
	$inital= null;
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if(is_admin()) {
		if ( current_user_can( 'manage_network_options' ) || current_user_can( 'manage_options' ) ) {
			$inital = new spnxAdminManage(true);
		}
	} else {
		if (!function_exists('process_postviews') || !is_plugin_active('WP-PostViews')) {
			add_action('wp_head', 'spinkx_cont_process_postviews');
		}
		if (!function_exists('wp_postview_cache_count_enqueue') || !is_plugin_active('WP-PostViews')) {
			add_action('wp_enqueue_scripts', 'spinkx_cont_postview_cache_count_enqueue');
		}
		if (!function_exists('spinkx_cont_increment_views') || !is_plugin_active('WP-PostViews')) {
			add_action('wp_ajax_postviews', 'spinkx_cont_increment_views');
			add_action('wp_ajax_nopriv_postviews', 'spinkx_cont_increment_views');
		}
	}
}
add_action( 'plugins_loaded', 'spinkx_cont_add_custom_action_after_plugins_loaded' );

/**
 *
 * This function display widget
 * spinkx_cont_get_default_shortcode_output()
 *
 * @return string
 * @internal param void
 */
function spinkx_cont_get_default_shortcode_output() {
	$atts = array();
	$spnxAdminManage = new spnxAdminManage;
	$license = get_option( SPINKX_CONTENT_LICENSE );
	if ( isset( $license['reg_user'] ) ) {
		if ( 0 === $license['reg_user'] ) {
			$license = get_option( SPINKX_CONTENT_LICENSE );
			$atts['id'] = $license['default_widget_id'];
			$atts['site_id'] = $license['site_id'];
			$atts['user_id'] = $license['reg_user'];
			$license_arr = maybe_unserialize( $license );
			$shortcode_output = '';
			//require SPINKX_CONTENT_PLUGIN_DIR . 'includes/display/inc.php';  // call widget file.
			//return $shortcode_output;
		}
	}
}

/**
 *
 * This function call get_default_shortcode_output() function
 * above_comment_widget_default()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_above_comment_widget_default() {
	if ( is_single() ) {
		global $post;
		$postid = $post->ID;
		if ( comments_open( $postid ) ) {
			echo esc_attr( spinkx_cont_get_default_shortcode_output() );
		}
	}
}

add_filter( 'widget_update_callback', function( $instance, $new, $old, $obj )
{
    if( 'text' === $obj->id_base && ! empty( $instance['text'] ) )
    {
       // print_r($instance);

    }
    return $instance;
}, 10, 4 );

/**
 *
 * This function append widget content in single page content
 * spinkx_cont_below_content_widget_default()
 *
 * @return string
 * @param  string $content single page article content.
 */
function spinkx_cont_below_content_widget_default( $content ) {
	if ( is_single() ) {
		global $post;
		$postid = $post->ID;
		if ( ! comments_open( $postid ) ) {
			//$shortcode_render = spinkx_cont_get_default_shortcode_output(); 	// only put below content when comments are off.
			//$content .= '<br/><br />' . $shortcode_render;
		}
	}
	return $content;
}
add_shortcode('spinkx', array(new spnxAdminManage, 'spinkx_cont_display_shortcode'));
add_filter( 'widget_text', 'do_shortcode' ); // hook for execute do_shortcode.

/**
 *
 * This function check site & show notice if due_date expired
 * spinkx_cont_show_notice()
 *
 * @return void
 * @internal param $void
 */
function spinkx_cont_media_selector_print_scripts( ) {
	$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );
	?><script type='text/javascript'>

		jQuery( document ).ready( function( $ ) {

			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this

			//jQuery('#upload_image_button').on('click', function( event ){
			jQuery(document).on('click', 'form.create-ad-form span.playlist_img, form.create-variation-form span.playlist_img, .reg-upload-logo', function( event ){
                event.preventDefault();
                ptitle = 'Select a image to add campaign';
                ptext= 'Add Campaign Image';
                if($(this).attr('class').indexOf('reg-upload-logo') >=0 ) {
                    ptitle = 'Select a image to add site icon';
                    ptext= 'Add Site Icon';
                }
				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					// Open frame
					file_frame.open();

					return;
				} else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					wp.media.model.settings.post.id = set_to_post_id;
				}

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: ptitle,
					button: {
						text: ptext,
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();

					// Do something with attachment.id and/or attachment.url here
					//$( '#upload_image_button' ).hide();
					//$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' ).show();
					//$( '#image-preview' ).prev().show();
					$( '#image_attachment_id' ).val( attachment.id );
					//console.log($('.playlist_img img').prop('naturalHeight'));
					$("#image-preview").load(function(){
						var imgheight = this.height;
						var form_class =  $(this).parents('form').attr('class');
						$('form.'+form_class+'>div').css('height',(imgheight+107+'px'));
					}).attr("src", attachment.url);
					//$('form.create-ad-form').parent().parent().css('height',($('.playlist_img img').height()+200+'px'));

					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});

				// Finally, open the modal
				file_frame.open();
				//console.log($('.playlist_img img').height());
			});

			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
				//$('form.create-ad-form').parent().parent().css('height',($('.playlist_img img').height()+200+'px'));

			});
			jQuery(document).on('click', 'form.create-ad-form span.cad_icons img', function(){
				jQuery(this).next().show();
			});

		});

	</script><?php

}


function spinkx_mobile_widget_setup() {
	if( ! is_admin() && wp_is_mobile() ) {
		$spnxAdminManage = new spnxAdminManage();
		$url = SPINKX_CONTENT_BAPI_URL.'/wp-json/spnx/v1/widget/is_mobile_widget_exist';
		$wp_output = spnxHelper::doCurl($url, true);
		$wp_output = json_decode( $wp_output );

		if( is_object( $wp_output ) ) {
			if( $wp_output->widget_id > 0) {
				echo do_shortcode('[spinkx id="'.$wp_output->widget_id.'" is_mobile=1]');
			}
		}
	}
}
add_action( 'admin_enqueue_scripts', 'spinkx_admin_add_inline_js', 99 );

