<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wpdb;
global $all_post_ids;
global $post;
$widget_id = $atts['id'];
$ajxrequrl = SPINKX_SERVER_BASEURL;
$ip = null;
$http_client_ip = helperClass::getFilterVar( 'HTTP_CLIENT_IP', INPUT_SERVER, FILTER_VALIDATE_IP );
$http_x_forward = helperClass::getFilterVar( 'HTTP_X_FORWARDED_FOR', INPUT_SERVER, FILTER_VALIDATE_IP );
$remote_address = helperClass::getFilterVar( 'REMOTE_ADDR', INPUT_SERVER, FILTER_VALIDATE_IP );
if ( $http_client_ip ) {
	$ip = $http_client_ip;
} elseif ( $http_x_forward ) {
	$ip = $http_x_forward;
} else {
	$ip = $remote_address;
}
$state = 0;
$country = 0;
$inf_url_msnry_url = admin_url( 'admin-ajax.php' ).'?action=spinkx_cont_display_widget_content&ifm_pge=';
$js_url = SPINKX_CONTENT_PLUGIN_URL . 'assets/js/';
$css_url = SPINKX_CONTENT_PLUGIN_URL . 'assets/styles/';
wp_enqueue_style( 'al-unit-responsive', $css_url . 'unit-static-styles.css' );
wp_enqueue_script( 'jquery' );
wp_enqueue_script( 'masonry' );
wp_enqueue_script( 'infinitescroll-js', $js_url . 'jquery.infinitescroll.min.js' );

//wp_localize_script( 'infinitescroll-js', 'spinkx_cont', array( 'admin_ajax_url' => admin_url( 'admin-ajax.php' ) ) );
wp_enqueue_script( 'visible-js', $js_url . 'jquery.visible.min.js' );
// below: for checking if user is actively viewing that tab
wp_enqueue_script( 'tabvisible-js', $js_url . 'ifvisible.min.js' );
wp_add_inline_script( 'visible-js', 'server_base_url = "' . $ajxrequrl . '";' );
wp_enqueue_script( 'time-js', $js_url . 'timeme.js' );
wp_add_inline_script( 'time-js', 'TimeMe.setIdleDurationInSeconds(30);
	TimeMe.setCurrentPageName("sx_widget");
	TimeMe.initialize();' );
wp_enqueue_script( 'jquery-youtubeapi', 'https://www.youtube.com/iframe_api' );
$unique_dynamic_id = helperClass::getFilterVar( 'unique_id', INPUT_REQUEST);
$ifm_pge = helperClass::getFilterVar('ifm_pge', INPUT_REQUEST, FILTER_VALIDATE_INT);

if ( ! $ifm_pge ) {
	$in_page_no = 1;
} else {
	$in_page_no = $ifm_pge;
}
if ( $in_page_no >= 2 ) {
	$pids_array = helperClass::getFilterVar('pids', INPUT_REQUEST);
} else {
	$pids_array = '';
}
$is_ajax = helperClass::getFilterVar( 'is_ajax', INPUT_REQUEST );
if ( $is_ajax ) {
	$is_ajax = null;
} else {
	wp_enqueue_script( 'pixel-js', $ajxrequrl . '/spinkxut.js' );
}
$settings = get_option( SPINKX_CONT_LICENSE );
$settings = maybe_unserialize( $settings );
$widget_array = array();
$widget_array['site_id'] = $settings['site_id'];
$widget_array['license_code'] = $settings['license_code'];
$widget_array['widget_id']	= $widget_id;
$json_widget_array = base64_encode( maybe_serialize( $widget_array ) );
$widgetData = array( 'widget_array' => $json_widget_array );
$curl_url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/settings';
$widget_settings = helperClass::doCurl( $curl_url, $widgetData, false );
$disp_unit_bg_color = 'red';
if ( $widget_settings ) {
	$settings_array = (array) ( json_decode( $widget_settings ) );
	$display_layout_type = 'masonry';
	$display_col_count = 3;

	if ( isset( $settings_array['widget_layout_type'] ) ) {
		$display_layout_type = $settings_array['widget_layout_type'];
	}
	if ( isset( $settings_array['no_of_columns'] ) ) {
		$display_col_count = $settings_array['no_of_columns'];
	}
	if ( isset( $settings_array['unit_bg_color'] ) ) {
		$disp_unit_bg_color 	= $settings_array['unit_bg_color'];
	}
	$al_brnd_styles = ' background: ' . $disp_unit_bg_color . '; display: block; clear: both; ';
};

$widget_array['in_page'] 	= $in_page_no;
if ( $unique_dynamic_id ) {
	$widget_array['unique_id'] = $unique_dynamic_id;
}
$user_agent = helperClass::getFilterVar( 'HTTP_USER_AGENT', INPUT_SERVER);
$widget_array['post_src_id'] = (isset( $post ) && $post->ID )?$post->ID:0;
$widget_array['user_agent'] = $user_agent;
$catArray = array();
if(isset( $post ) && $post->ID) {
	$catArray = get_the_category($post->ID);
}
$categories = array();
foreach ( $catArray as $key => $cat ) {
	$categories[] = $cat->cat_name;
}
$widget_array['post_cat'] = $categories;
$http_client_ip = helperClass::getFilterVar( 'HTTP_CLIENT_IP', INPUT_SERVER, FILTER_VALIDATE_IP );
$http_x_forward = helperClass::getFilterVar( 'HTTP_X_FORWARDED_FOR', INPUT_SERVER, FILTER_VALIDATE_IP );
$remote_address = helperClass::getFilterVar( 'REMOTE_ADDR', INPUT_SERVER, FILTER_VALIDATE_IP );
if ( $http_client_ip ) {
	$ip = $http_client_ip;
} elseif ( $http_x_forward ) {
	$ip = $http_x_forward;
} else {
	$ip = $remote_address;
}
$widget_array['ip'] = $ip;
$sx_id = helperClass::getFilterVar( 'sx_id', INPUT_GET);
if(! $sx_id ) {
	$sx_id = helperClass::getFilterVar('sx_id', INPUT_POST);
}
$widget_array['sx_id'] = $sx_id;
$widget_array['country'] = $country;
$widget_array['state'] = $state;
if ( $display_layout_type = 'masonry' ) {
	?>
	<script>
	var element_counter = 0;
	var $ = jQuery.noConflict();
	$( document ).ready(function() {
	var unique_dynamic_id = <?php echo ($unique_dynamic_id)?$unique_dynamic_id:0; ?>;
	var url_count = 1;
	jQuery('.al_brnd_content_<?php echo $widget_id; ?>').infinitescroll({
		loading: {
			finished: undefined,
			finishedMsg: "<em>No More Articles...</em>",
			/* img: null, */
			msg: null,
			msgText: "<em>Loading the next set of Articles...</em>",
			selector: null,
			speed: 'fast',
			start: undefined
		},
		navSelector     : "#al_inf_masnry_<?php echo $widget_id; ?>:last",
		nextSelector    : "a#al_inf_masnry_<?php echo $widget_id; ?>:last",
		itemSelector    : ".al_brnd_content_<?php echo $widget_id; ?> .al_article_<?php echo $widget_id; ?>",
		debug           : false,
		loadingImg      : "<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/loading.gif",
		dataType        : 'html',
		maxPage         : 40,
		path: function(index) {
			/* //return "index" + index + ".html"; */

			var ids = '';
			var url_var = '';
			var id_count = 0;
			var this_attr;
			jQuery('.al_article').each(function(){
				this_attr = jQuery(this).attr('al_data_id');
				if( id_count++ ){
					ids = ids+','+this_attr;
				} else {
					ids = this_attr;
				}
			});
			//if( (url_count++) == 1) {
				url_var = '&pids='+ids;
				/* $.cookie( 'pids-'+unique_dynamic_id+'-<?php echo $widget_id; ?>', ''+ids ); */
		   // } else {
			 //   url_var = '';
				/* $.cookie( 'pids-'+unique_dynamic_id+'-<?php echo $widget_id; ?>', '' ); */
		   // }
			/* alert( index+' : '+url_var ); */
			jQuery('#infscr-loading img').attr('src', "<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/slider-loader.gif");
			return "<?php echo $inf_url_msnry_url; ?>" + index + "&widget_id=<?php echo $widget_id; ?>" + "&unique_id=" + unique_dynamic_id + url_var + "&country=<?php echo $country; ?>&state=<?php echo $state; ?>&display_col_count=<?php echo $display_col_count?>&post_src_id=<?php echo $post->ID?>&is_ajax=true&sx_id=" + sx_id;

		}
	}, function(newElements, data, url){
		/* //set the container that Masonry will be inside of in a var */
		var al_msnry_container_new_<?php echo $widget_id; ?> = document.querySelector('.al_brnd_content_<?php echo $widget_id; ?>');
		imagesLoaded( al_msnry_container_new_<?php echo $widget_id; ?>, function() {
			  msnry = new Masonry(al_msnry_container_new_<?php echo $widget_id; ?>, {
					itemSelector: '.al_brnd_content .al_article_<?php echo $widget_id; ?>'
				});

			setCssOverride();
		});


		});
	/***********************************************************************/

	/**********************************************************************/
	/* //set the container that Masonry will be inside of in a var */
	var al_msnry_container_<?php echo $widget_id; ?> = document.querySelector('.al_brnd_content_<?php echo $widget_id; ?>');
	/* //create empty var msnry */
	var msnry;

	/* // initialize Masonry after all images have loaded */
	imagesLoaded( al_msnry_container_<?php echo $widget_id; ?>, function() {
		setCssOverride();
		msnry = new Masonry( al_msnry_container_<?php echo $widget_id; ?>, {
			itemSelector: '.al_brnd_content .al_article'
		});

	});



	jQuery(window).on("scroll", onScroll);
	function onScroll(event) {

		if(ifvisible.now()){ // check if page is visible
			var scrollPos = jQuery(document).scrollTop();
			jQuery('.al_article').each(function () {
				var currLink = jQuery(this);
				if (currLink.visible()) {
					setTimeout(function () {
						//console.log(256)
						if (currLink.visible()) {
							if (scrollPos == jQuery(document).scrollTop()) {
								if (!currLink.hasClass('spinkxserversent')) {
									this_attr = currLink.attr('al_data_id');
									handleScroll(this_attr); // sends rec_imp request
									currLink.addClass('spinkxserversent');
									setTimeout(function () {
										currLink.removeClass('spinkxserversent');
									}, 61000);
									//currLink.css('background-color','#fff');
									//currLink.removeClass("spinkxvisible");
								}
							}
						}
					}, 200); // time in ms to wait before sending post impression
				}
				else {
					//currLink.removeClass("spinkxvisible");
					//currLink.css('background-color','#fff');
				}

			});
		} // end of page visibility check
	}
	setInterval(onScroll,200);
	});
	</script>
	<?php
	/* -------------------------------------------------------------- */
} else {
	?>
	<script>
		var $ = jQuery.noConflict();
		var scrollTimer = null;

		jQuery( document ).ready(function() {

			/* //set the container that Masonry will be inside of in a var */
			var al_msnry_container = document.querySelector('.al_brnd_content');
			/* //create empty var msnry */
			var msnry;
			/* // initialize Masonry after all images have loaded */
			imagesLoaded( al_msnry_container, function() {
				 setCssOverride();
				msnry = new Masonry( al_msnry_container, {
					itemSelector: '.al_brnd_content .al_article'
				});
			});


//handleScroll();
			//handle hover


			jQuery(window).on("scroll", onScroll);
			function onScroll(event) {
				if(ifvisible.now()) { // check if page is visible
					var scrollPos = jQuery(document).scrollTop();
					jQuery('.al_article').each(function () {
						var currLink = jQuery(this);
						if (currLink.visible()) {
							setTimeout(function () {
								//console.log(256)
								if (currLink.visible()) {
									if (scrollPos == jQuery(document).scrollTop()) {
										if (!currLink.hasClass('spinkxserversent')) {
											this_attr = currLink.attr('al_data_id');
											handleScroll(this_attr);
											currLink.addClass('spinkxserversent');
											setTimeout(function () {
												currLink.removeClass('spinkxserversent');
											}, 61000);
											//currLink.css('background-color','#fff');
											//currLink.removeClass("spinkxvisible");
										}
									}
								}
							}, 200);
						}
						else {
							//currLink.removeClass("spinkxvisible");
							//currLink.css('background-color','#fff');
						}
					});
				} // page visibility check
			}
			setInterval(onScroll,200);
		});
	</script>
	<?php
}
// NOW COMES THE COMMON SCRIPTS
?>
<script>
	function handleScroll(this_attr){

	    var id_count = 0;
	    var ids = '';
	    ids = this_attr;
		jQuery.ajax({
			url: '<?php echo esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/content-playlist/post/impression' )?>',
			type:'POST',
			data: {
				'ids' : ids,
				'widget_id' : '<?php echo $widget_id; ?>',
				'u_id' : '<?php echo $unique_dynamic_id; ?>',
				'ref_url'  :   window.location.href,
				'sx_id' : sx_id
			},
			success: function(response) {
				console.log('Post impression updated -- ' + response);
			},
		});


	}

	window.onbeforeunload = function (event) {
		xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == XMLHttpRequest.DONE) {
				//alert(xmlhttp.responseText);
			}
		}
		xmlhttp.open("POST",'<?php echo SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/spent-time'?>',false);
		var timeSpentOnPage = TimeMe.getTimeOnCurrentPageInSeconds();
		var nform = new FormData();
		nform.append("timespentonpage", timeSpentOnPage);
		nform.append("sx_id", sx_id);
		xmlhttp.send(nform);
	};
	function setCssOverride() {
		jQuery('.powerdby').css({
			'right':'20px',
			'left': 'auto',
		});
	}
	window.onload = (function(){
		setCssOverride();
	});

</script>
<?php
$header = array(
	'Accept'          => 'application/vnd.heroku+json; version=3',
	'Accept-Encoding' => 'gzip',
	'Content-Type'    => 'application/json',
	'Authorization'   => 'Bearer',
);

$req_url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/display';
$response = helperClass::doCurl( $req_url, $widget_array, true, $header );

// $shortcode_output .= '<div data-role="collapsible-set" data-content-theme="d" id="set"><div data-role="collapsible" id="set1" data-collapsed="true">';
if ( ! $response ) {
	$shortcode_output .= '<br/>Access Denied!';
} else {
	$shortcode_output .= '<div style="' . $al_brnd_styles . '" id="al_brnd_content" data-role="collapsible" class="al_brnd_content al_brnd_content_' . $widget_id . ' display-units-' . $display_col_count . ' " wid="' . $widget_id . '" >';
	if ( strlen( trim( $response ) ) > 0 ) {
		$shortcode_output .= $response;
		$shortcode_output .= '</div> <div style="clear:both;"></div>';
	} else {
		$shortcode_output .= 'No More Articles';
	}
	if ( $display_layout_type == 'masonry' ) {
		$shortcode_output .= '<a style="display: none; clear: both; overflow: hidden;" id="al_inf_masnry_' . $widget_id . '" href="#">Load More...</a>';
	};
}

$shortcode_output .= '';
return $shortcode_output;
