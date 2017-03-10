<?php
global $wpdb;
global $all_post_ids;
global $post;
$widget_id = $atts['id'];
$settings = get_option( SPINKX_CONT_LICENSE );
$settings = maybe_unserialize( $settings );
$widget_array = array();
$widget_array['site_id'] = $settings['site_id'];
$widget_array['license_code'] = $settings['license_code'];
$widget_array['widget_id']	= $widget_id;
$widget_array['is_mobile'] = 0;
$json_widget_array = base64_encode( maybe_serialize( $widget_array ) );
$widgetData = array( 'widget_array' => $json_widget_array );
$curl_url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/settings';
$widget_settings = helperClass::doCurl( $curl_url, $widgetData, false );
$settings_array = (array) ( json_decode( $widget_settings ) );
if( isset( $settings_array['error'])  ) {
	echo $settings_array['msg'];
	return;
}
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
$inf_url_msnry_url = admin_url( 'admin-ajax.php' ).'?action=spinkx_cont_display_widget_content&ifm_pge=';

	$js_url = SPINKX_CONTENT_PLUGIN_URL . 'assets/js/';
	$css_url = SPINKX_CONTENT_PLUGIN_URL . 'assets/styles/';
	wp_enqueue_style('al-unit-responsive', $css_url . 'unit-static-styles.css');
	$css_url = SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/css/';
	wp_enqueue_style('font-awesome', $css_url . 'font-awesome.min.css');
	$css_url = SPINKX_CONTENT_PLUGIN_URL . 'assets/styles/';
	wp_enqueue_style('jquery-ui',  $css_url . 'jquery-ui.css');
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui', '//code.jquery.com/ui/1.12.1/jquery-ui.js');
	wp_enqueue_script('visible-js', $js_url . 'jquery.visible.min.js');
	wp_enqueue_script('waterfall-js', $js_url . 'newWaterfall.js' );
	wp_add_inline_script('visible-js', 'server_base_url = "' . $ajxrequrl . '";');
// below: for checking if user is actively viewing that tab
	wp_enqueue_script('tabvisible-js', $js_url . 'ifvisible.min.js');
	wp_localize_script( 'tabvisible-js', 'ajaxurl', array( 'admin_ajax_url' => admin_url( 'admin-ajax.php' )));
	wp_enqueue_script('time-js', $js_url . 'timeme.js');

	wp_add_inline_script('time-js', 'TimeMe.setIdleDurationInSeconds(30);
	TimeMe.setCurrentPageName("sx_widget");
	TimeMe.initialize();');
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

$display_layout_type = 'masonry';
$display_col_count = 3;
$disp_unit_bg_color = '#ffffff';
	$al_brnd_styles = ' clear: both; ';
if ( $widget_settings ) {

	if ( isset( $settings_array['widget_layout_type'] ) ) {
		$display_layout_type = $settings_array['widget_layout_type'];
	}
	if ( isset( $settings_array['no_of_columns'] ) ) {
		$display_col_count = $settings_array['no_of_columns'];
	}
	if ( isset( $settings_array['unit_bg_color'] ) ) {
		$disp_unit_bg_color 	= $settings_array['unit_bg_color'];
		$al_brnd_styles = ' background-color: ' . $disp_unit_bg_color . '; clear: both; ';
	} else {
		$al_brnd_styles = ' display:  clear: both; ';
	}
};
$widget_array['in_page'] 	= $in_page_no;
if ( $unique_dynamic_id ) {
	$widget_array['unique_id'] = $unique_dynamic_id;
}
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$widget_array['post_src_id'] = $post->ID;
$widget_array['user_agent'] = $user_agent;
$catArray = get_the_category( $post->ID );
$categories = array();
foreach ( $catArray as $key => $cat ) {
	$categories[] = $cat->cat_name;
}
$widget_array['post_cat'] = $categories;
if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
	$ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
	$ip = $_SERVER['REMOTE_ADDR'];
}
$widget_array['ip'] = $ip;
$widget_array['sx_id'] = isset( $_REQUEST['sx_id'] )?$_REQUEST['sx_id']:0;
$widget_array['country'] = $country;
$widget_array['state'] = $state;
$al_brnd_content_opacity = null;
$content_id = 'id="al_brnd_content"';

		?>

		<script>
			var element_counter = 0;
			var $ = jQuery.noConflict();
			$(document).ready(function () {
				var unique_dynamic_id = '<?php echo $unique_dynamic_id; ?>';
				var url_count = 1;
				jQuery(window).on("scroll", onScroll);
				function onScroll(event) {

					if (ifvisible.now()) { // check if page is visible
						var scrollPos = jQuery(document).scrollTop();
						jQuery('.al_article').each(function () {
							var currLink = jQuery(this);
							//console.log(currLink);
							if (currLink.visible()) {
								setTimeout(function () {
									//console.log(256)
									if (currLink.visible()) {
										if (scrollPos == jQuery(document).scrollTop()) {
											if (!currLink.hasClass('spinkxserversent')) {
												this_attr = currLink.attr('al_data_id');
												wid = currLink.attr('wid');
												handleScroll(this_attr, wid); // sends rec_imp request
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

				setInterval(onScroll, 200);
				//jQuery('.waterfall li .art_img_block .youtube-player').css({ width: jQuery(window).innerWidth() + 'px', height: jQuery(window).innerHeight() + 'px' });



			});


			var scrollTimer = null;


		

		function handleScroll(this_attr, widget_id) {

			var id_count = 0;
			var ids = '';
			ids = this_attr;
			if( 'g_1_1' === ids ) {
				return;
			}
			jQuery.ajax({
				url: '<?php echo esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/content-playlist/post/impression' )?>',
				type:'POST',
				data: {
					'ids': ids,
					'widget_id': widget_id,
					'u_id': '0',
					'ref_url': window.location.href,
					'sx_id': sx_id
				},
				success: function (result) {
					console.log('Post impression updated -- ' + result);
				},
				});


		}

		window.onbeforeunload = function (event) {
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function () {
				if (xmlhttp.readyState == XMLHttpRequest.DONE) {
					//alert(xmlhttp.responseText);
				}
			}
			xmlhttp.open("POST", '<?php echo SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/spent-time'?>', false);
			var timeSpentOnPage = TimeMe.getTimeOnCurrentPageInSeconds();
			var nform = new FormData();
			nform.append("timespentonpage", timeSpentOnPage);
			nform.append("sx_id", sx_id);
			xmlhttp.send(nform);
		};


		function setCssOverride() {
			jQuery('.powerdby').css({
				'right': '20px',
				'left': 'auto',
			});
		}




		var <?php echo "ifm_pge_".$widget_id?> = 1;
		var $ = jQuery.noConflict();
		jQuery(document).ready(function ($) {
			if ($(this).find('#waterfall-<?php echo $widget_id?>') && $(this).find('#waterfall-<?php echo $widget_id?>').is(":visible")) {
				<?php if( $display_layout_type != 'masonry') { ?>
				$('#waterfall-<?php echo $widget_id?>').NewWaterfall({
					'width':<?php echo $settings_array['img_crop_width']?>,
					'height':<?php echo $settings_array['img_crop_height']?>});
				<?php } else { ?>
				$('#waterfall-<?php echo $widget_id?>').NewWaterfall();
				<?php } ?>
			}


		});

			jQuery(window).resize(function(){
				if(jQuery(document).width() <= 768) {
					if( ! jQuery('#spinkx-cont-popup').is(':visible') ) {
						jQuery('#mobile-spinkx-arrow').show();
					}
				} else {
					jQuery('#mobile-spinkx-arrow').hide();
					jQuery('#down-arrow').click();
				}

			});

		var loading = false;
		var dist = 700;
		var num = 1;
		function spinx_cont_load_ajax_data() {
			if (jQuery(window).scrollTop() >= jQuery('#al_brnd_content').height() - dist && !loading && jQuery('#waterfall-<?php echo $widget_id?> li:last').visible()) {
				loading = true;
				<?php echo "ifm_pge_".$widget_id?> = <?php echo "ifm_pge_".$widget_id?> + 1;
				ids = null;
				var id_count = 0;
				var this_attr;
				jQuery('#waterfall-<?php echo $widget_id?> li.al_article').each(function () {
					this_attr = jQuery(this).attr('al_data_id');
					if (id_count++) {
						ids = ids + ',' + this_attr;
					} else {
						ids = this_attr;
					}
				});
				url_var = '&pids=' + ids;
				unique_dynamic_id = 0;
				jQuery("#waterfall-<?php echo $widget_id?>").append('<li id="wait">Load More ...<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL ?>assets/images/slider-loader.gif"/></li>');
				aurl = "<?php echo $inf_url_msnry_url; ?>" + <?php echo "ifm_pge_".$widget_id?> + "&widget_id=<?php echo $widget_id; ?>" + "&unique_id=" + unique_dynamic_id + url_var + "&country=<?php echo $country; ?>&state=<?php echo $state; ?>&display_col_count=<?php echo $display_col_count?>&disp_unit_bg_color=<?php echo $disp_unit_bg_color?>&post_src_id=<?php echo $post->ID?>&is_ajax=true&sx_id=" + sx_id + '&is_mobile=-1';
				jQuery.ajax({
					type: "GET",
					url: aurl,
					success: function (data) {
						//console.log(data.stringTrimLeft());
						if (data.indexOf('No More Articles') == -1) {
							loading = false;
						} else {
							data = '<li style="text-align: center; "><div style="display:inline; color:#333333; text-decoration: none; vertical-align:top;  font-size: 12px;">' + data + '</div></li>';
						}

						jQuery("#waterfall-<?php echo $widget_id?> li#wait").remove();
						jQuery("#waterfall-<?php echo $widget_id?>").append(data);

					},
				});

			}
		}
		$(document).ready(function () {

			setInterval(function () {
				if( ! loading ) {
					spinx_cont_load_ajax_data();
				}
			}, 1000);
			
		});
			
	</script>

	<?php

	$header = array(
		'Accept'          => 'application/vnd.heroku+json; version=3',
		'Accept-Encoding' => 'gzip',
		'Content-Type' => 'application/json',
		'Authorization' => 'Bearer',
	);
	$data_column = '';
	if ($display_layout_type == 'masonry') {
		$data_column = 'data-column="' . $display_col_count . '" ';
	} else {
		$data_column = 'data-column="1" ';
	}
	$req_url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/display';
	$response = helperClass::doCurl($req_url, $widget_array, TRUE, $header, 10000, false);
	if (!$response) {
		$shortcode_output .= 'Access Denied!';
	} else {
		$shortcode_output .= '<div style="' . $al_brnd_styles . $al_brnd_content_opacity . '" ' . $content_id . ' data-role="collapsible" class="al_brnd_content al_brnd_content_' . $widget_id . ' display-units-' . $display_col_count . ' " wid="' . $widget_id . '" > <ul class="waterfall" id="waterfall-'.$widget_id.'" ' . $data_column . ' >';
		if (strlen(trim($response)) > 0) {
			//if($response !== 'error' ) {
				$shortcode_output .= $response;
				$shortcode_output .= '</ul></div> <div style="clear:both;"></div>';
				/*$shortcode_output .= "$(document).ready(function () {	jQuery('.waterfall li .art_img_block .youtube-player').css({ width: jQuery(window).innerWidth() + 'px', height: jQuery(window).innerHeight() + 'px' });
				
			});</script>";*/
			//}
		} else {
			$shortcode_output .= 'No More Articles';
		}
	}
	return $shortcode_output;

