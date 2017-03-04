<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly	
$settings = get_option( SPINKX_CONT_LICENSE );
$settings = maybe_unserialize( $settings );
$todaydate = 0;
$enddate = 0;
$from_date = helperClass::getFilterVar( 'from_date' );
$to_date = helperClass::getFilterVar( 'to_date' );
if ( $from_date && $to_date  ) {
	$todaydate = strtotime( $from_date );
	$enddate = strtotime( $to_date );
} else {
	$url = esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/site/get-date' );
	$post = array( 'site_id' => $settings['site_id'], 'license_code' => md5( $settings['license_code'] ) );
	$data = helperClass::doCurl( $url, $post );

	$data = json_decode( $data );

	if ( isset( $data->date ) ) {
		$todaydate = $data->date;
		$temp_today_date = strtotime('-30 days', $todaydate);
		$todaydate = $temp_today_date;
		$enddate = $data->date;

	} else {
		echo isset( $data->msg ) ? $data->msg : '';
		exit;
	}
}
$site_id = $settings['site_id'];
$sortby = helperClass::getFilterVar( 'sortby' );
$ptype = helperClass::getFilterVar( 'post_type' );
if( ! $from_date ) {
	$from_date = date('Y-m-d', $todaydate);
}
if( ! $to_date ) {
	$to_date = date('Y-m-d', $enddate);
}
$p = [ 'site_id' => $settings['site_id'],'license_code' => md5( $settings['license_code'] ),'sortby' => $sortby,'post_type' => $ptype, 'from_date' => $from_date, 'to_date' => $to_date ];
$p = wp_json_encode( $p );
$url = esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/content-playlist' );
$custom_js = 'jQuery(function() { ';
if ( $todaydate ) {
	$custom_js .= 'var start = moment(' . ( $todaydate * 1000 ) . ');';
	$custom_js .= 'var end = moment(' . ( $enddate * 1000 ) . ');';
} else {
	$custom_js .= 'var start = moment();';
	$custom_js .= 'var end = moment();';
}
$bwki_sites_display_length	= helperClass::getFilterVar( 'bwki_sites_display_length' );
$pageLength = ( $bwki_sites_display_length )?$bwki_sites_display_length:10;
	$loader = '<img src="<?php echo esc_url( SPINKX_CONTENT_PLUGIN_URL )?>/assets/images/loader.gif" alt="loading"/>';
$custom_js .= 'var todaydate = start;
	jQuery("#reportrange").on("apply.daterangepicker", function(ev, picker) {
		//get_stat_now(picker.startDate, picker.endDate);
		loadDT(picker.startDate, picker.endDate);
	});

	jQuery(".paginate_button").on("click", function(){
		//var table = jQuery("#bwki_sites_display").DataTable
		loadDT(start,end);
	});
	
	function cb(start, end) {
		jQuery("#reportrange span").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));

	}
	
	jQuery("#reportrange").daterangepicker({
	startDate: start,
	endDate: end,
	ranges: {
	"Today": [moment(), moment()],
			"Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
			"Last 7 Days": [moment().subtract(6, "days"), moment()],
			"Last 30 Days": [moment().subtract(29, "days"), moment()],
			"This Month": [moment().startOf("month"), moment().endOf("month")],
			"Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
	}
	}, cb);

	cb(start, end);
	var $ = jQuery.noConflict();
	var pageLength = ' . $pageLength . ';
	var pt = '.$p.';
	loadDT(start, end);
	function loadDT(startDate, endDate) {
		//jQuery(\'#bpopup_ajax_loading\').bPopup( { modalClose: false } );
		pt.from_date = startDate.format(\'YYYY-MM-DD\');
		pt.to_date = endDate.format(\'YYYY-MM-DD\');
		var table = jQuery("#bwki_sites_display").DataTable({
		"pageLength": pageLength,
	    "processing": false,
		"serverSide": true,
		"destroy":true,
		"ajax": {
			beforeSend: function(){
	            jQuery(\'#bpopup_ajax_loading\').bPopup( { modalClose: false } );
            },
            headers: {
                "Accept" : "application/json; charset=utf-8",
                "Content-Type": "application/javascript; charset=utf-8",
                "Access-Control-Allow-Origin" : "*"
            },
			"url": spinkx_server_baseurl + \'/wp-json/spnx/v1/content-playlist\',
			  "dataType": "jsonp",			  
			data: pt,
			complete: function(){
                jQuery(\'#bpopup_ajax_loading\').bPopup().close();
              
             },
		},	
		
		});
		jQuery(\'#bpopup_ajax_loading\').bPopup().close();
	} 
	
	jQuery(".site-cat-multiple").select2();
	
	jQuery(document).on("click","input.onoffswitch-checkbox",function() {
            var dataid = jQuery(this).attr("data-id");                     
            switch (dataid) {
                case "all_local":
                    break;
                case "all_global":
                    break;
                default:
                    changePostStatus(jQuery(this));
            }
		}); 
	});';
wp_enqueue_script( 'jquery-youtubeapi', 'https://www.youtube.com/iframe_api' );
wp_enqueue_script( 'jquery-daterange-picker', '//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js' );
wp_add_inline_script( 'jquery-daterange-picker', $custom_js );
?>
<div style="width:100%;">
	<div style="width: 40%; float: left;">
		<input type="button" value="ReSync" id="posts_<?php echo $site_id ?>" class="posts_sync">
	</div>
	<div style="width: 60%; float: right; text-align:right;">
		<span style="line-height: 29px !important;">Show Statistics For :&nbsp;</span>
		<div id="reportrange" class="pull-right"
		     style="background: #fff; cursor: pointer; padding: 5px 10px; margin-right:10px; border: 1px solid #ccc;">
			<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
			<span></span> <b class="caret"></b>
		</div>
	</div>
</div><div class="content_playlist_listing">

	<table id="bwki_sites_display" class="wp-list-table table-responsive "><thead  style="border-bottom:1px solid #469fa1">
		<tr>
			<td width="500px" height="10px" style="padding: 0px">&nbsp;</td>

			<td width="300px" height="10px" style="padding: 0px"><div class="onoff_header" >
					<div class="onoffswitch">
						<input type="checkbox" data-id="all_local" data-site="<?php echo $settings['site_id']?>" name="playpauseswitch_local_all" class="onoffswitch-checkbox" id="playpauseswitch_local_all"  checked >
						<label class="onoffswitch-label" for="playpauseswitch_local_all">
							<span class="onoffswitch-inner"></span>
							<span class="onoffswitch-switch"></span>
						</label>

					</div>
					<input type="button" onclick="all_onoff('local')" value="Apply to All" />
				</div>
			</td>
			<td width="300px" height="10px" style="padding: 0px"> <div class="onoff_header" >
					<div class="onoffswitch">
						<input type="checkbox" data-id="all_global" data-site="<?php echo $settings['site_id']?>" name="playpauseswitch_global_all" class="onoffswitch-checkbox" id="playpauseswitch_global_all"  checked >
						<label class="onoffswitch-label" for="playpauseswitch_global_all">
							<span class="onoffswitch-inner"></span>
							<span class="onoffswitch-switch"></span>
						</label>

					</div>
					<input type="button" onclick="all_onoff('global')" value="Apply to All" />

				</div></td>
		</tr>
		<tr>
			<th width="500px" height="10px" style="padding: 0px">&nbsp;&nbsp;&nbsp;Post Details</th>

			<th width="300px"  height="10px" style="padding: 0px; text-align: center;padding-right: 60px;">Your Post Statistics<br/><span>Sort By :-  <a href="#" id="sortby_local_reach">Reach</a>|<a href="#" id="sortby_local_ctr">Engagement</a></span></th>
			<th width="300px" height="10px" style="padding: 0px; text-align: center;padding-right: 60px;">Boosted Post Statistics<br/><span>Sort By :-  <a href="#" id="sortby_global_reach">Reach</a>|<a href="#" id="sortby_global_ctr">Engagement</a></span> </th>

		</tr>

		</thead><tbody><input type="hidden" id="chooks" value="0" /></tbody>
		</table></div>
<div class="clear"></div>
</div>
<div id="confirm_hooks_delete" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Confirm Delete</h3>
		  </div>
		  <div class="modal-body">
			Are you sure you want to delete this hook?
		  </div>
		  <div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>
			<button type="button" data-dismiss="modal" class="btn">Cancel</button>
		  </div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="boostmodal" class="modal small fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><strong>Boost Post</strong></h4>
			</div>
			<form name="boostpost" id="boostpost" onsubmit="boost_submit(this); return false;">
				<div class="modal-body">
					<div id="left_div_modal_body" >


						<div class="form-group">
							<label for="credit_points">Credit Points to Spend</label>
							<input type="text" class="form-control" name="credit_points" id="credit_points" onkeyup="getEstimation()" />
							<small>Enter credit value you wish to spend in boosting this post ! </small>
						</div>

						<div class="form-group">    <!-- category start -->
							<label>Select Boost Post Categories</label>

							<br /><br />
							<select style="width:100%;" class="site-cat-multiple" name="site_cat[]" multiple>
								<?php
								$url = esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/system/categories' );
								$response = helperClass::doCurl( $url  );
								if ( strlen( $response ) > 0 ) {
									$categories = json_decode( $response );
									foreach ( $categories as $key => $value ) {
										echo '<option value="' . $key . '">' . $value . '</option>';
									}
								}
								?>
							</select>
							<script>
								jQuery(document).ready(function(){

								});
							</script>


						</div>      <!-- category end -->

					</div>
					<div id="right_div_modal_body">
<!-- widget preview -->
						<h4> Widget Preview </h4>
						<div class="SPINKX_preview_fg grid-item grid-item--height" style="width: 320px ! important; height: 350px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border-width: 1px; border-style: solid; border-color: rgb(216, 216, 216); border-radius: 10px; margin-bottom: 8px; position: absolute; transition-property: transform, opacity; transition-duration: 0.4s;">		<!-- block Start -->

							<div class="boost_img pre-img ">
								<img style="height: 200px;" src="" alt="" />
							</div>

							<h4 class="boost_post_title pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: 14px; line-height: 18px; font-weight: bold; margin-left:12px; color: #000000; font-family: Carrois Gothic text-transform: none;display: block;"></h4>

							<p class="boost_post_desc pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: 14px; line-height: 18px;display: block;"></p>

						</div>
<!-- end widget preview -->

				</div>
				<div class="modal-footer">
					<a href="javascript:;void(0)" id="buy-more-point" style="float: left">Buy More Point</a>

					<button class='btn btn-danger' data-dismiss='modal' aria-hidden='true'>Cancel</button>
					<input type="submit" class='btn btn-success' value="Boost Post" />
				</div>
				</div>
			</form>
		</div>

	</div>
</div>
<div id="boostmodalshowMsgWidgetNotFrontShow" style="z-index: 9999;" class="modal small fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><strong>Boost Post</strong></h4>
			</div>

			<div class="modal-body">
				Please activate Spinkx Widget in your Front End  - <br/>1. Go to <a href="admin.php?page=spinkx_widget_design#widget_design">Widget Design</a> & Copy the Short code - which should look like this - [ spinkx id=”xx” ]
				<br/>2. Go to <a href="widgets.php">Appearances > Widgets</a> of your WordPress Sidebar and scroll to the bottom add “TEXT” to your Main Sidebar.	<br/>3. To accumulate more boost points and advertising revenue, try and place your widget on the top.
			</div>
		</div>
	</div>
</div>
<div id="boostmodalshowMsgWidgetNotActivate" style="z-index: 9999;" class="modal small fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><strong>Boost Post</strong></h4>
			</div>
			<div class="modal-body">
				All your Sidebar Widget are Inactive. All your Boost Posts will be Stopped! Please  <a href="admin.php?page=spinkx_widget_design#widget_design">activate the Widget</a> and display it on your Front end to enable display of 'Boost Post’ on other Websites
			</div>
		</div>
	</div>
</div>
<div id="boostmodalshowMsg" style="z-index: 9999;" class="modal small fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><strong>Boost Post</strong></h4>
			</div>
			<div class="modal-body">
				Your site is not registered. Kindly <a href="admin.php?page=spinkx-site-register.php">Register</a> to start using credit points to boost post.
			</div>

		</div>
	</div>
</div>
<div id="boostmodalbuyPoint" style="z-index: 9999;" class="modal small fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><strong>Buy Points</strong></h4>
			</div>
			<?php
				$url = esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/site/get-point-price' );
				$post = array( 'site_id' => $settings['site_id'], 'license_code' => md5($settings['license_code']), 'reg_email' => $settings['reg_email'], 'points' => 100 );
				$response = helperClass::doCurl( $url, $post );
				$response = json_decode($response, true);
			?>

			<div class="modal-body">
				<?php if(isset($response['reach'])) { ?>
				<div class="form-group">
					<label for="point_amount">Points</label><br/>
					<br/><input
						type="text" class="form-control" id="buy_point" style="display: inline;width:40%;" value="100"/>
				</div>
				<div class="form-group">
					<label>Reach</label>
					<label id="reach" style="margin-left: 20px"><?php echo $response['reach']?></label>
				</div>

				<div class="form-group">
					<label>Price</label>
					<label style="margin-left: 20px"><i id="currency_format" class="fa fa-<?php echo strtolower($response['currency_format']) ?>" style="display: inline;"></i><span id="amount"><?php echo $response['price']?></label>
					<input type="hidden" id="point_amount" value="<?php echo $response['price']?>" />
				</div>
				<?php
						$url = esc_url(SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/site/buy-points');
						$post = array('site_id' => $settings['site_id'], 'license_code' => md5($settings['license_code']), 'reg_email' => $settings['reg_email']);
						$response = helperClass::doCurl($url, $post);
						$response = json_decode($response);
						if ($response) {
							echo do_shortcode($response);
						}
					} else {
					echo $response;
				}
				?>
				</div>
			</div>

		</div>

	</div>

</div>
<script>
	jQuery(document).ready(function($){
		$('#buy-more-point').click(function(){
			jQuery('#boostmodal').modal('hide');
			jQuery('#boostmodalbuyPoint').modal({
				backdrop: 'static',
				keyboard: false,
				show: true
			});
		});
		$('#buy_point').change(function(){
			var points = $(this).val();
			//console.log(points);
			//console.log(g_site_id);
			$.ajax({
				url : spinkx_server_baseurl + '/wp-json/spnx/v1/site/get-point-price',
				type : "post",
				data : {
					"site_id" : g_site_id,
					"points": points,
				},
				success : function(data){
					$('#reach').text(data.reach);
					$('#amount').text(data.price);
					$('#point_amount').val(data.price);
				}
			});

		});


	});
</script>
