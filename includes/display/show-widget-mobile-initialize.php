<?php
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
$display_layout_type = 'masonry';
$display_col_count = 3;
$disp_unit_bg_color = 'rgba(255,255,255, 0.9)';
	$al_brnd_styles = ' clear: both; ';
if ( $widget_settings ) {
	$settings_array = (array) ( json_decode( $widget_settings ) );
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
	$al_brnd_styles = ' background-color: ' . $disp_unit_bg_color . '; clear: both; ';
};
$widget_array['in_page'] 	= $in_page_no;
if ( $unique_dynamic_id ) {
	$widget_array['unique_id'] = $unique_dynamic_id;
}
$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$categories = array();
if( isset($post) && isset($post->ID)  ) {
	$widget_array['post_src_id'] = $post->ID;
	$catArray = get_the_category( $post->ID );

	foreach ( $catArray as $key => $cat ) {
		$categories[] = $cat->cat_name;
	}
} else {
	$widget_array['post_src_id'] = 0;
	$post = new stdClass();
	$post->ID = 0;
}
$widget_array['user_agent'] = $user_agent;
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
<!--<script type="text/javascript" src="<?php //echo $js_url ?>newWaterfall.js"></script> -->
<script>
		    var element_counter = 0;
			var $ = jQuery.noConflict();
			var firstDivID = '';
		    var spinkx_widget_first_time = true;

			$(document).ready(function () {
				var unique_dynamic_id = '<?php echo $unique_dynamic_id; ?>';
				var url_count = 1;
				var spinkx_selector =  'body div#spinkx_cont_aritcle_end';
				spinkx_selector = $(spinkx_selector).parents();
				spinkx_selector  = spinkx_selector[ spinkx_selector.length - 3 ];
				firstDivID = $(spinkx_selector).attr('id');
					if (firstDivID === undefined || firstDivID === null) {
						firstDivID = $(spinkx_selector).parent().attr('class').split(' ')[0];
						if (firstDivID !== undefined || firstDivID !== null) {
							firstDivID = '.' + firstDivID;
						}
					} else {
						firstDivID = '#' + firstDivID;
					}


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

			});

			var $ = jQuery.noConflict();
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
					'u_id': '<?php echo $unique_dynamic_id; ?>',
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
		window.onload = (function () {
			<?php if( is_single() ) { ?>
				jQuery(window).scroll(function(){
					var docViewTop = $(window).scrollTop();
					var docViewBottom = docViewTop + $(window).height();
					elem = '#spinkx_cont_aritcle_end';
					var elemTop = $(elem).offset().top;
					var elemBottom = elemTop + $(elem).height();
					if( (elemBottom <= docViewBottom) && (elemTop >= docViewTop) && spinkx_widget_first_time ){
						jQuery('#mobile-spinkx-arrow').click();
					}
				});
			<?php } ?>
			//}
			//jQuery('#spinkx-cont-popup .waterfall li .art_img_block iframe.youtube-player').css({ width: jQuery(window).innerWidth() + 'px', height: jQuery(window).innerHeight() + 'px' });
		});
        jQuery(window).resize(function(){
	        if(jQuery(document).width() <= 768) {
		        console.log(3);
		        if( ! jQuery('#spinkx-cont-popup').is(':visible') ) {			        
			        jQuery('#mobile-spinkx-arrow').show();
		        }
	        } else {
		       jQuery('#mobile-spinkx-arrow').hide();
		       jQuery('#down-arrow').click();
	        }
	       // $('.waterfall li .art_img_block .youtube-player').css({ width: $(window).innerWidth() + 'px', height: $(window).innerHeight() + 'px' });
        });

		var <?php echo "ifm_pge_".$widget_id?> = 1;
		var $ = jQuery.noConflict();
		jQuery(document).ready(function () {
			jQuery('body').append('<div id="spinkx-cont-popup" ></div>');
			$(document).on('click', '#mobile-spinkx-arrow', function () {
				//$('body').animate( { scrollTop: 0 }, 0 );
				$('body').css('overflow','hidden')
				$(this).hide();
				$(window).scroll(function() { return false; });
				$('#spinkx-cont-popup').show();
				//$(firstDivID).css('position','fixed').css('overflow','hidden');
				$('#waterfall-<?php echo $widget_id?>').NewWaterfall();
				$url = '<?php echo esc_url( SPINKX_SERVER_BASEURL .'/wp-json/spnx/v1/widget/impression' )?>';
				$url += '?'+str_data;
				jQuery.ajax({ url: $url,data: {'wid':'<?php echo $widget_id?>','site_id':'<?php echo $settings['site_id']?>','sx_id':sx_id } ,success: function(response){
					console.log('Widget impression updated -- '+response); },});

			});
			$(function () {
				$.ajax({
					type: "GET",
					url: ajaxurl.admin_ajax_url,
					data: {'action': 'spnx_cont_mobile_widget_data', 'widget_id': '<?php echo $widget_id?>'},
					success: function (data) {
						$('#spinkx-cont-popup').html('<div style="width:100%; z-index:999998;position:absolute;top:30px;"><img width="100%" id="down-arrow" src="<?php echo SPINKX_CONTENT_PLUGIN_URL . 'assets/images/down-arrow-mob.png';?>" /></div>');
						$('#spinkx-cont-popup').css({'width':'95%', 'overflow':'hidden', 'padding': 0, 'clear':'both', 'position':'fixed', 'left':'2.5%', 'right':'2.5%', 'bottom':0, 'z-index':999999 });
						$('#spinkx-cont-popup').append(data);
						jQuery('body').append('<div id="mobile-spinkx-arrow"><img width="100%" src="<?php echo SPINKX_CONTENT_PLUGIN_URL . 'assets/images/up-arrow-mob.png';?>"/></div>');
						if (data.indexOf('No More Articles') == -1) {
							loading_mobile = false;
						}
						//jQuery('.waterfall li .art_img_block .youtube-player').css({ width: jQuery(window).innerWidth() / 2 + 'px', height: jQuery(window).innerWidth() / 2 + 'px' });

						//jQuery(window).trigger('scroll');
						load_widget_data_ajax();

					},
				});

			});

		});

		jQuery(document).on('click','#down-arrow', function(){
			//jQuery('#spinkx-cont-popup').dialog('close');
			jQuery('#spinkx-cont-popup').hide();
			//$(firstDivID).css('position','').css('overflow','');
			$('body').css('overflow','auto');
			jQuery('#mobile-spinkx-arrow').show();
			spinkx_widget_first_time = false;
		});

		    var loading_mobile = false;
		    var dist = 700;
		    var num = 1;


  function load_widget_data_ajax () {

			if (jQuery(window).scrollTop() >= jQuery('#spinkx-cont-popup  #al_brnd_content_mobile').height() - dist && !loading_mobile) {
				loading_mobile = true;
				<?php echo "ifm_pge_".$widget_id?> = <?php echo "ifm_pge_".$widget_id?> + 1;
				ids = null;
				var id_count = 0;
				var this_attr;
				jQuery('#spinkx-cont-popup #waterfall-<?php echo $widget_id?> li.al_article').each(function () {
					this_attr = jQuery(this).attr('al_data_id');
					if (id_count++) {
						ids = ids + ',' + this_attr;
					} else {
						ids = this_attr;
					}
				});
				url_var = '&pids=' + ids;
				unique_dynamic_id = 0;
				jQuery("#spinkx-cont-popup #waterfall-<?php echo $widget_id?>").append('<li id="wait">Load More ...<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL ?>assets/images/slider-loader.gif"/></li>');
				aurl = "<?php echo $inf_url_msnry_url; ?>" + <?php echo "ifm_pge_".$widget_id?> + "&widget_id=<?php echo $widget_id; ?>" + "&unique_id=" + unique_dynamic_id + url_var + "&country=<?php echo $country; ?>&state=<?php echo $state; ?>&display_col_count=<?php echo $display_col_count?>&disp_unit_bg_color=<?php echo $disp_unit_bg_color?>&post_src_id=<?php echo $post->ID?>&is_ajax=true&sx_id=" + sx_id +'&is_mobile=3';
				jQuery.ajax({
					type: "GET",
					url: aurl,
					success: function (data) {
						if (data.indexOf('No More Articles') == -1) {
							loading_mobile = false;
						} else {
							data = '<li style="text-align: center; "><div class="no-more-article">'+data+'</div></li>';
						}
						jQuery("#spinkx-cont-popup #waterfall-<?php echo $widget_id?> li#wait").remove();
						jQuery("#spinkx-cont-popup #waterfall-<?php echo $widget_id?>").append(data);
					},
				});

			}
	  setTimeout(load_widget_data_ajax, 1000);
	}

		</script>

