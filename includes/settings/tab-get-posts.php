<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$spnxAdminManage = new spnxAdminManage();
$settings = get_option( $spnxAdminManage->spinkx_cont_get_license() );
$settings = maybe_unserialize( $settings );
$todaydate = 0;
$enddate = 0;
$startdate = 0;

$custom_date = $spnxAdminManage->spinkx_cont_last_30_days();
$from_date = spnxHelper::getFilterVar('from_date');
$to_date = spnxHelper::getFilterVar('to_date');
$custom_js = '';
if ($from_date) {
	$startdate = strtotime($from_date) * 1000;

} else {
	$from_date = date('Y-m-d', $custom_date[0]);
	$startdate = $custom_date[0] * 1000;
	$todaydate = $custom_date[2] * 1000;
}
if ($to_date) {
	$todaydate = strtotime("+1 Day", strtotime($to_date)) * 1000;
	$enddate = strtotime($to_date) * 1000;
} else {
	$to_date = date('Y-m-d', $custom_date[1]);
	$enddate = $custom_date[1] * 1000;
}

$settings['site_id'] = isset($settings['site_id'])?$settings['site_id']:0;
$site_id = $settings['site_id'];
$settings['license_code'] = isset($settings['license_code'])?$settings['license_code']:'';
$settings['reg_email'] = isset($settings['reg_email'])?$settings['reg_email']:'';
$settings['due_date'] = isset($settings['due_date'])?$settings['due_date']:'0000-00-00 00:00:00';
$sortby = spnxHelper::getFilterVar('sortby');
$ptype = spnxHelper::getFilterVar('post_type');
$p = 0;

if($settings['due_date']=='0000-00-00 00:00:00') {
	echo 'You are not a registered user. You can create a boost post after registration. Click Here to <a href="admin.php?page=spinkx-site-register">Register</a>';
} else {


	$url = esc_url($spnxAdminManage->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/site/get-auto-boost');
	$auto_boost = json_decode(spnxHelper::doCurl($url, true), true);
	$p = ['site_id' => $settings['site_id'], 'license_code' => $settings['license_code'], 'reg_email' => $settings['reg_email'], 'sortby2' => $sortby, 'post_type2' => $ptype, 'from_date' => $from_date, 'to_date' => $to_date, 'plg_url' => esc_url(SPINKX_CONTENT_PLUGIN_URL)];
	$p = wp_json_encode($p);
	$url = esc_url($spnxAdminManage->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/content-playlist');
}
$bwki_sites_display_length = spnxHelper::getFilterVar('bwki_sites_display_length');
$pageLength = ($bwki_sites_display_length) ? $bwki_sites_display_length : 10;
$custom_js = 'var pt = ' . $p . '; var pageLength = ' . $pageLength . '; ';
$custom_js .= 'var start = moment(' . ($startdate) . ');';
$custom_js .= 'var end = moment(' . ($enddate) . '); jQuery(function() {';
$loader = '<img src="' . esc_url(SPINKX_CONTENT_PLUGIN_URL) . 'assets/images/loader.gif" alt="loading"/>';
$custom_js .= 'jQuery(".se-pre-con").fadeOut("slow");';
if($settings['due_date']!='0000-00-00 00:00:00') {
$custom_js .= 'jQuery("#daterange").dateRangePicker({container: "#daterange-picker-container",numberOfMonths: 3,datepickerShowing: true, maxDate: "0D",minDate: new Date(2016, 8, 01),test: true,today: ' . $todaydate . '});
	var $ = jQuery.noConflict();	
	loadDT(start.format(\'YYYY-MM-DD\'), end.format(\'YYYY-MM-DD\'));	
	});';
} else {
    $custom_js .= '});';
}
wp_enqueue_script( 'jquery-youtubeapi', 'https://www.youtube.com/iframe_api' );
$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
wp_enqueue_script( 'jquery-powertip', $js_url . 'jquery.powertip.min.js' );
wp_add_inline_script( 'jquery-powertip', $custom_js );///
if($settings['due_date']!='0000-00-00 00:00:00') {
?>

<div class="content_playlist_listing">

	<table id="bwki_sites_display" class="wp-list-table table-responsive " style="width:1024px;"><thead  style="border-bottom:1px solid #469fa1">
		<tr>
			<td  style="padding: 0px;text-align: right;">
				<span class="duration-text-first-span-span-crnt">Current points: <span id="credit_points_value"><?php echo $spnxAdminManage->spinkx_cont_get_credit_points();?></span></span>
				<button  class=" buy-more-point" id="buy-more-point" onclick="getpoints()">Buy More Point</button>

			</td>

			<td  style="padding: 0px;text-align: center;">
				<span><img src="<?php echo esc_url( SPINKX_CONTENT_PLUGIN_URL ); ?>assets/images/sort-icon.png" style="height: 15px; margin-right: 7px;"><a href="#" id="sortby_local_reach">Views</a>|<a href="#" id="sortby_local_ctr">Engagement</a></span>

			</td>
			<td  style="padding: 0px;text-align: center;">
				<span style=""><img src="<?php echo esc_url( SPINKX_CONTENT_PLUGIN_URL ); ?>assets/images/sort-icon.png" style="height: 15px; margin-right: 7px;"> <a href="#" id="sortby_global_reach">Views</a>|<a href="#" id="sortby_global_ctr">Engagement</a></span>
			</td>
		</tr>
		<tr style="background-color: #e4eff4 !important;height: 27px;font-size: 12px; color:#a93671;">
			<th style="padding: 0px;border:none;width:475px;">&nbsp;&nbsp;&nbsp;Post Details</th>
			<th style=" padding: 0 0 0 12px;border:none;width:252px;">&nbsp;&nbsp;&nbsp;Your Post Stats <div class="onoff_header" >
					<div class="onoffswitch">
						<input type="checkbox" data-id="all_local" data-site="<?php echo $settings['site_id']?>" name="playpauseswitch_local_all" class="onoffswitch-checkbox" id="playpauseswitch_local_all"  checked >
						<label class="onoffswitch-label" for="playpauseswitch_local_all">
							<span class="onoffswitch-inner"></span>
							<span class="onoffswitch-switch"></span>
						</label>

					</div>
					<input type="button" onclick="all_onoff('local')" value="Switch All" />
				</div></th>
			<th style="padding: 0 0 0 12px;border:none;width:252px;">&nbsp;&nbsp;&nbsp;Boost Post Stats <div class="onoff_header" >
					<div class="onoffswitch"  >
						<input type="checkbox" data-id="all_global" data-site="<?php echo $settings['site_id']?>" name="playpauseswitch_global_all" class="onoffswitch-checkbox" id="playpauseswitch_global_all"  checked >
						<label class="onoffswitch-label" for="playpauseswitch_global_all">
							<span class="onoffswitch-inner"></span>
							<span class="onoffswitch-switch"></span>
						</label>
					</div>
					<input type="button" onclick="all_onoff('global')" value="Auto Boost"  />
				</div></th>

		</tr>
		</thead><tbody><input type="hidden" id="chooks" value="0" /></tbody>
	</table></div>
<div class="clear"></div>
</div>
<!-- Modal -->

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
			$url = esc_url( $spnxAdminManage->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/site/get-point-price' );
			$post = array('points' => 100 );
			$response = spnxHelper::doCurl( $url, $post);
			$response = json_decode($response, true);
			?>
			<div class="modal-body">
				<?php if(isset($response['reach'])) { ?>
					<div class="form-group">
						<label for="point_amount">Points</label><br/>
						<br/><input	type="number" class="form-control" id="buy_point" style="display: inline;width:40%;" value="100"/>
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
					if(isset($response['buy_points'])) {
						echo do_shortcode($response['buy_points']);
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
    jQuery(document).ready(function($) {
        jQuery('#buy_point').on('keyup', function(event){
            var points = parseInt($(this).val());
            if(points === undefined || isNaN(points)) {
                document.getElementById('payment-method-button').style.backgroundColor = 'lightblue';
                alert('Please enter amount in a number.');
                return;
            }
            if (points < 100) {
                document.getElementById('payment-method-button').style.backgroundColor = 'lightblue';
                alert('A minimum of 100 points are required for a purchase.');
                return;
            }
            document.getElementById('payment-method-button').style.backgroundColor = 'lightblue';
            jQuery.ajax({
                url : spinkx_server_baseurl + '/wp-json/spnx/v1/site/get-point-price',
                type : "post",
                beforeSend: function() {
                    document.getElementById('payment-method-button').disabled = true;
                },
                data : {
                    "site_id" : g_site_id,
                    "points": points,
                    "license_code": '<?php echo $settings['license_code']?>',
                    "reg_email": '<?php echo $settings['reg_email']?>',
                },
                success : function(data) {
                    $('#reach').text(data.reach);
                    $('#amount').text(data.price);
                    $('#point_amount').val(data.price);
                    $('button#payment-method-button').prop('disabled', false);
                    document.getElementById('payment-method-button').style.backgroundColor = '#337ab7';
                }
            });
        });

    });

</script>
<?php } ?>