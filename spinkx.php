<?php
/**
 * This is main spinkx plugin file.
 *
 * In this file plugin activate & deactivate, hook fire and execute shortcode & hook fire when permalink changes
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
Version: 2.1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once dirname( __FILE__ ) . '/config.inc.php';
require_once SPINKX_CONTENT_PLUGIN_DIR . 'class/storageClass/al_helperClass.php';
require_once SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/spinkx-css-js-enqueue.php';
require_once SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/spinkx-ajax.php';
require_once SPINKX_CONTENT_PLUGIN_DIR . 'includes/display/pagination-url.php';
require_once SPINKX_CONTENT_PLUGIN_DIR . 'assets/widgets/create/save-widget-position.php';
require_once SPINKX_CONTENT_PLUGIN_DIR . 'assets/campaigns/campajx.php';


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

register_activation_hook( __FILE__, 'spinkx_cont_plugin_activated' );

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
register_uninstall_hook( __FILE__, 'spinkx_cont_server_plugin_uninstall' );

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
	$post =  maybe_unserialize(get_option( SPINKX_CONT_LICENSE ));
	if( is_multisite() ) {
		$siteArr = $wpdb->get_results( 'SELECT blog_id FROM `wp_blogs` WHERE public = 1', ARRAY_A );
		$data = array();
		foreach ( $siteArr as $currentSite ) {
			switch_to_blog($currentSite['blog_id']);
			$temp = maybe_unserialize(get_option( SPINKX_CONT_LICENSE ));
			$data[] = $temp['site_id'];
		}
		$post['ids'] = $data;
	}
	$post = maybe_serialize($post);
	$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/site/deactivate';
	helperClass::doCurl( $url, $post, false );
}
register_deactivation_hook( __FILE__, 'spinkx_cont_server_plugin_deactivate' );

/**
 *
 * This function show spinkx releated admin notice when is required
 * spinkx_cont_admin_notices()
 *
 * @return void
 * @param string $str message disolay in notice bar.
 * @param string $class notice class name.
 */
function spinkx_cont_admin_notices( $str, $class = 'notice-success' ) {
	echo '<div class="notice ' . esc_html( $class ) . ' is-dismissible"><p><strong>';
	if ( esc_attr( $str ) ) {
		echo  $str;
	} else {
		echo 'Your <a href="?page=spinkx-site-register.php">Spinkx</a> License has Expired! Please <a href="?page=spinkx-site-register.php">Register</a>';
	}
	echo '</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
}

/**
 *
 * This function fire check license date
 * spinkx_cont_get_license_date()
 *
 * @return string
 * @param date $due_date date duedate object.
 */
function spinkx_cont_get_license_date( $due_date ) {
	$datetime = strtotime( $due_date );
	$date1 = date_create( $due_date );
	$date2 = date_create( date( 'Y-m-d H:i:s' ) );
	$diff = date_diff( $date2, $date1 );
	return $diff;
}

// List of files required.
require SPINKX_CONTENT_PLUGIN_DIR . '/includes/settings/settings.php';

/**
 *
 * This function fire on post transitions
 * spinkx_cont_update_status_transitions()
 *
 * @return void
 * @param string $new_status post new status.
 * @param string $old_status post old status.
 * @param object $post post object.
 */
function spinkx_cont_update_status_transitions( $new_status, $old_status, $post ) {
	if ( ( $new_status !== $old_status ) && ( ( 'auto-draft' !== $new_status ) && ( 'new' !== $old_status ) ) ) {
		require SPINKX_CONTENT_PLUGIN_DIR . '/includes/settings/updates/post-transitions.php';
	};
}
add_action( 'transition_post_status', 'spinkx_cont_update_status_transitions', 10, 3 );

/**
 *
 * This function fire on post update
 * spinkx_cont_update_on_publish_to_publish()
 *
 * @return void
 * @param object $post post object when post update.
 */
function spinkx_cont_update_on_publish_to_publish( $post ) {
	$old_status = 'publish';
	$new_status = 'publish';
	require SPINKX_CONTENT_PLUGIN_DIR . '/includes/settings/updates/post-transitions.php';
}
add_action( 'publish_to_publish', 'spinkx_cont_update_on_publish_to_publish', 10, 3 );

/**
 *
 * This function fire when shortcode execute
 * spinkx_cont_display_shortcode()
 *
 * @return string
 * @param array()     $atts shortcode params.
 * @param null|string $content this is string params.
 */
function spinkx_cont_display_shortcode( $atts, $content = null ) {

	shortcode_atts( array( 'id' => '', 'user_id' => '', 'site_id' => '' ), $atts );
	$license = get_option( SPINKX_CONT_LICENSE );
	$license_arr = maybe_unserialize( $license );
	$shortcode_output = '';
	//require SPINKX_CONTENT_PLUGIN_DIR . 'includes/display/inc.php';
	if( isset($atts['is_mobile']) && intval($atts['is_mobile']) == 1) {
		require SPINKX_CONTENT_PLUGIN_DIR . 'includes/display/show-widget-mobile-initialize.php';
	} else if( ! wp_is_mobile() ) {
		require SPINKX_CONTENT_PLUGIN_DIR . 'includes/display/show-widget.php';
	}
	return $shortcode_output;
}
add_shortcode( 'spinkx', 'spinkx_cont_display_shortcode' );

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
				$http_user_agent = helperClass::getFilterVar( 'HTTP_USER_AGENT', INPUT_SERVER );
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
				$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/site/statistics';

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
			wp_enqueue_script( 'wp-postviews-cache', plugins_url( 'assets/js/postviews-cache.js', __FILE__ ), array( 'jquery' ), '1.68', true );
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
	$postviews_id = helperClass::getFilterVar( 'postviews_id', INPUT_GET, FILTER_VALIDATE_INT );
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
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( ! function_exists( 'process_postviews' ) || ! is_plugin_active( 'WP-PostViews' ) ) {
		add_action( 'wp_head', 'spinkx_cont_process_postviews' );
	}
	if ( ! function_exists( 'wp_postview_cache_count_enqueue' ) || ! is_plugin_active( 'WP-PostViews' ) ) {
		add_action( 'wp_enqueue_scripts', 'spinkx_cont_postview_cache_count_enqueue' );
	}
	if ( ! function_exists( 'spinkx_cont_increment_views' ) || ! is_plugin_active( 'WP-PostViews' ) ) {
		add_action( 'wp_ajax_postviews', 'spinkx_cont_increment_views' );
		add_action( 'wp_ajax_nopriv_postviews', 'spinkx_cont_increment_views' );
	}
}
add_action( 'plugins_loaded', 'spinkx_cont_add_custom_action_after_plugins_loaded' );
add_action( 'update_option_permalink_structure' , 'spinkx_cont_permalink_update', 10, 2 );

/**
 *
 * This function fire after spinkx plugin activated
 * plugin_activated()
 *
 * @return void
 * @param string $old_value post old status after permalink changes.
 * @param string $new_value post new status after permalink changes.
 */
function spinkx_cont_permalink_update( $old_value, $new_value ) {
	require SPINKX_CONTENT_PLUGIN_DIR . '/includes/settings/updates/update-postdata.php';
}
add_action( 'spinkx_views_update_hook', 'spinkx_views_update_function' );

/**
 *
 * This function fire after spinkx plugin activated
 * spinkx_cont_plugin_activated()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_plugin_activated() {
	require SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/site-registration-default.php';
}


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
	$license = get_option( SPINKX_CONT_LICENSE );
	if ( isset( $license['reg_user'] ) ) {
		if ( 0 === $license['reg_user'] ) {
			$license = get_option( SPINKX_CONT_LICENSE );
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
			$shortcode_render = spinkx_cont_get_default_shortcode_output(); 	// only put below content when comments are off.
			$content .= '<br/><br />' . $shortcode_render;
		}
	}
	return $content;
}

add_filter( 'widget_text', 'do_shortcode' ); // hook for execute do_shortcode.

/**
 *
 * This function get content and return excerpt
 * spinkx_cont_get_excerpt_by_id()
 *
 * @param string  $post_content pass string in first param.
 * @param integer $excerpt_length pass integer value for content length.
 * @return string
 */
function spinkx_cont_get_excerpt_by_id( $post_content, $excerpt_length = 20 ) {
	$the_excerpt = $post_content; // Gets post_content to be used as a basis for the excerpt.
	$the_excerpt = strip_tags( strip_shortcodes( $the_excerpt ) ); // Strips tags and images.
	$words = explode( ' ', $the_excerpt, $excerpt_length + 1 );
	if ( count( $words ) > $excerpt_length ) :
		array_pop( $words );
		array_push( $words, '…' );
		$the_excerpt = implode( ' ', $words );
	endif;

	$the_excerpt = '<p>' . $the_excerpt . '</p>';
	return $the_excerpt;
}

/**
 *
 * This function execute via hook after dashboard setup
 * spinkx_cont_add_dashboard_widgets()
 *
 * @return void
 * @internal param $void
 */
function spinkx_cont_add_dashboard_widgets() {
	wp_add_dashboard_widget( 'spinkx_cont_dashboard_widget', 'SPINKX Statistics', 'spinkx_cont_dashboard_widget' );
}
add_action( 'wp_dashboard_setup', 'spinkx_cont_add_dashboard_widgets' ); // Call hook after admin dashboard setup.

/**
 *
 * This function show statistics on WordPress dashboard
 * spinkx_cont_dashboard_widget()
 *
 * @return void
 * @internal param $void
 */
function spinkx_cont_dashboard_widget() {


	$settings = maybe_unserialize( get_option( SPINKX_CONT_LICENSE ) );
	$lpost_data = wp_json_encode( array( 'site_id' => $settings['site_id'] ) );
	$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/site/statistics';
	$wp_output = wp_remote_post( $url,  array(
		'method' => 'POST',
		'body' => $lpost_data,
	) );
	$availablecredit = 0;
	$impPostTotalToday = 0;
	$impPostTotalYesterday = 0;
	if ( ! is_wp_error( $wp_output ) &&  $wp_output['body'] != null) {
		$jsonity = json_decode($wp_output['body']);
		if( is_object( $jsonity ) ) {
			if (isset($jsonity->available_credit_block->availablecredit)) {
				$availablecredit = number_format($jsonity->available_credit_block->availablecredit, 2);
			}

			$impPostTotalToday = ($jsonity->available_credit_block->impPostTotalToday) ? $jsonity->available_credit_block->impPostTotalToday : '';
			$impPostTotalYesterday = ($jsonity->available_credit_block->impPostTotalYesterday) ? $jsonity->available_credit_block->impPostTotalYesterday : '';
		}
		echo ' <div style="float:left; width: 48%;">     
				  <img src="' . esc_url( SPINKX_CONTENT_PLUGIN_URL ) . 'assets/images/logo.png" alt="Home" style="  width: 100%; margin: 0px auto; display: block;">
		   </div>
				
	  ';
		echo '<style>
	.spinkx_dashwidget_label{ float:left; color:#242E82; font-size:1.2em; height:50%; width:25%; margin: 10% 10px; align-content: center; }

.spinkx_dashwidget_value{ color:#242E82; font-size:1.5em; align-content: center; margin: 14% 25%; width:100%; height: 40%; }

.spinkx_dashwidget_value p {  margin:0; }

	</style>
	
	<div style="float:left; width:50%; height:8%; margin:0 auto;"> 
	<div class="spinkx_dashwidget_label">Credit Points</div> 
	<div class="spinkx_dashwidget_value"><p> ' . $availablecredit . '</p>
	</div> 
	<div style="clear:both;"></div> 
	<hr /> 
	<div class="spinkx_dashwidget_label">Post Reach</div> 
	<div class="spinkx_dashwidget_value" style="margin:9% 7%;"><p> ' . $impPostTotalToday . ' <span style="font-size:.5em; color:#3E933B;"> Today</span><br/>  ' . $impPostTotalYesterday . ' <span style="font-size:.7em; color:#3E933B;"> Yesterday</span></p> </div> </div> 
	<div style="clear:both;">
	</div>
	
	<div style="float:left; width:100%; margin:5px 20%;">
	  <span style="float:left; height:20px; "><a href="admin.php?page=spinkx_dashboard">Visit Dashboard</a></span> | <span><a href="admin.php?page=spinkx_content_play_list">Boost Post</a></span>
	
	
	  </div>
	  <div style="clear:both;"></div>';
	} else {
		
	}
}
/**** End dashboard widget code ******/

/**
 *
 * This function check site & show notice if due_date expired
 * spinkx_cont_show_notice()
 *
 * @return void
 * @internal param $void
 */
function spinkx_cont_show_notice() {
	$settings = maybe_unserialize( get_option( SPINKX_CONT_LICENSE ) );
	$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/site/check-license';
	$response = helperClass::doCurl( $url, $settings );
	$response = json_decode( $response );
	if (isset($response->flag) && $response->flag > 0 ) {
		if ( 1 === $response->flag ) {
			spinkx_cont_admin_notices( $response->message, 'notice-warning' );
		} elseif ( 2 === $response->flag || 3 === $response->flag ) {
			spinkx_cont_admin_notices( $response->message, 'notice-warning' );
		}
	}
}

add_action( 'admin_notices', 'spinkx_cont_show_notice' ); // call spinkx_show_notice.

function spinkx_cont_constant_update() {
	global $wpdb;
	if ( version_compare(SPINKX_VERSION, '1.0.27','<=') ) {
		if (is_multisite()) {
			$current_blog_id = get_current_blog_id();
			$blogs = $wpdb->get_results("SELECT blog_id FROM {$wpdb->blogs}", ARRAY_A);
			if ($blogs) {
				foreach($blogs as $blog) {
					switch_to_blog($blog['blog_id']);
					$value = get_option(SPINKX_CONT_LICENSE);
					if(!$value) {
						$wpdb->query("UPDATE $wpdb->options SET option_name = '" . SPINKX_CONT_LICENSE . "' WHERE option_name = '_bw_license_update'");
					}
				}
				switch_to_blog($current_blog_id);
			}
		} else {
			$value = get_option(SPINKX_CONT_LICENSE);
			if(!$value) {
				$wpdb->query("UPDATE $wpdb->options SET option_name = '" . SPINKX_CONT_LICENSE . "' WHERE option_name = '_bw_license_update'");
			}
		}
	}
	spnx_cont_update_version();
}
add_action('wp_dashboard_setup', 'spinkx_cont_constant_update');

function spinkx_cont_media_selector_print_scripts( ) {
	$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );
	?><script type='text/javascript'>

		jQuery( document ).ready( function( $ ) {

			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this

			jQuery('#upload_image_button').on('click', function( event ){

				event.preventDefault();

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
					title: 'Select a image to upload',
					button: {
						text: 'Use this image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();

					// Do something with attachment.id and/or attachment.url here
					$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' ).show();
					$( '#image-preview' ).next().show();
					$( '#image_attachment_id' ).val( attachment.id );

					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});

				// Finally, open the modal
				file_frame.open();
			});

			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
		});

	</script><?php

}


function spnx_cont_mobile_widget_data() {
	$widget_id = $_REQUEST['widget_id'];
	$shortcode_output = '';
	require SPINKX_CONTENT_PLUGIN_DIR . 'includes/display/show-widget-mobile-data.php';
	echo $shortcode_output;
	exit;
}

function spnx_cont_update_version() {
	$current = get_site_transient( 'update_plugins' );
	$plugin = plugin_basename( __FILE__ );
	if(  isset( $current->response[ $plugin ] ) ) {
		$spinkx_object = $current->response[$plugin];
	}
	$current_blog_id = get_current_blog_id();
	if( isset( $spinkx_object ) && $spinkx_object->new_version != SPINKX_VERSION ) {
		$data = array();
		if( is_multisite() ) {
			$args = array(
				'public'     => 1,
				'number'      => 2000,
				'offset'     => 0,
			);
			$sites_array = get_sites( $args );

			foreach ( $sites_array as $site ) {
				switch_to_blog( $site->blog_id );
				$settings = maybe_unserialize( get_option( SPINKX_CONT_LICENSE ) );
				$data[] = $settings['site_id'];
			}
		} else {
			$settings = maybe_unserialize( get_option( SPINKX_CONT_LICENSE ) );
			$data[] = $settings['site_id'];
		}
		$lpost_data = wp_json_encode(array( "id" => $data, "current_version" => SPINKX_VERSION));
		$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/site/update_version';

		wp_remote_post( $url, array(
			'method' => 'POST',
			'body' => $lpost_data,
		));

	}
}

function spnx_mobile_widget_setup() {
	if( ! is_admin() && wp_is_mobile() ) {
		$settings = maybe_unserialize(get_option(SPINKX_CONT_LICENSE));
		$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/is_mobile_widget_exist';
		$wp_output = helperClass::doCurl($url, $settings);
		$wp_output = json_decode( $wp_output );
		if( is_object( $wp_output ) ) {
			if( $wp_output->widget_id > 0) {
				echo do_shortcode('[spinkx id="'.$wp_output->widget_id.'" is_mobile=1]');
			}
		}
	}
}
function spinkx_cont_get_site_url() {
	$site_url = '';
	if ( class_exists( 'Domainmap_Utils' ) ) {
		$obj = new Domainmap_Utils();
		$temp = $obj->get_mapped_domain();
		if ( $temp ) {
			$site_url = $temp;
		}
	}
	if ( ! $site_url ) {
		$site_url	= get_site_url();
	}
	return $site_url;
}
add_action( 'wp_footer', 'spnx_mobile_widget_setup' );
function spinkx_cont_content_add( $content ) {
	$content .= '<div id="spinkx_cont_aritcle_end"></div>';
	return $content;
}
add_filter( 'the_content', 'spinkx_cont_content_add' );
function spnx_cont_wpmu_add_new_blog( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {
	
	require SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/site-registration-default.php';
}
add_action( 'wpmu_new_blog', 'spnx_cont_wpmu_add_new_blog', 10, 6 );

add_action( 'admin_head', 'spinkx_cont_icon_css' );
add_action( 'admin_enqueue_scripts', 'spinkx_cont_js_var' );
add_action( 'wp_ajax_spinkx_cont_get_dashbaord_statics', 'spinkx_cont_get_dashbaord_statics' );
add_action( 'wp_ajax_spinkx_cont_new_hook', 'spinkx_cont_new_hook' );
add_action( 'wp_ajax_spinkx_cont_edit_hook', 'spinkx_cont_edit_hook' );
add_action( 'wp_ajax_spinkx_cont_save_hook', 'spinkx_cont_save_hook' );
add_action( 'wp_ajax_spinkx_cont_get_attachment_data', 'spinkx_cont_get_attachment_data' );
add_action( 'wp_ajax_spinkx_cont_play_pause_post', 'spinkx_cont_play_pause_post' );
add_action( 'wp_ajax_spinkx_cont_get_credit_points', 'spinkx_cont_get_credit_points' );
add_action( 'wp_ajax_spinkx_cont_update_credit_points', 'spinkx_cont_update_credit_points' );
add_action( 'wp_ajax_spinkx_cont_get_widget_stat', 'spinkx_cont_get_widget_stat' );
add_action( 'wp_ajax_spinkx_cont_get_content_playlist_stat', 'spinkx_cont_get_content_playlist_stat' );
add_action( 'wp_ajax_spinkx_cont_camp_form_elements', 'spinkx_cont_camp_form_elements' );
add_action( 'wp_ajax_spinkx_cont_change_widget_status', 'spinkx_cont_change_widget_status' );
add_action( 'wp_ajax_spinkx_cont_widget_update', 'spinkx_cont_widget_update' );
add_action( 'wp_ajax_spinkx_cont_widget_delete', 'spinkx_cont_widget_delete' );
add_action( 'wp_ajax_spinkx_cont_widget_clone', 'spinkx_cont_widget_clone' );
add_action( 'wp_ajax_spinkx_cont_widget_create', 'spinkx_cont_widget_create' );
add_action( 'wp_ajax_spinkx_cont_widget_reset', 'spinkx_cont_widget_reset' );
add_action( 'wp_ajax_spinkx_cont_campaign_ajax', 'spinkx_cont_campaign_ajax' );
add_action( 'wp_ajax_spinkx_cont_get_campaign_stat', 'spinkx_cont_get_campaign_stat' );

add_action( 'wp_ajax_spinkx_cont_post_sync', 'spinkx_cont_post_sync' );
add_action( 'wp_ajax_spinkx_cont_update_post_sync_cpl', 'spinkx_cont_update_post_sync_cpl' );


add_action( 'wp_ajax_spinkx_cont_display_widget_content', 'spinkx_cont_display_widget_content' );
add_action( 'wp_ajax_nopriv_spinkx_cont_display_widget_content', 'spinkx_cont_display_widget_content' );

add_action('wp_ajax_spnx_cont_mobile_widget_data', 'spnx_cont_mobile_widget_data');
add_action( 'wp_ajax_nopriv_spnx_cont_mobile_widget_data', 'spnx_cont_mobile_widget_data' );

include_once SPINKX_CONTENT_PLUGIN_DIR . 'payment-method.php';