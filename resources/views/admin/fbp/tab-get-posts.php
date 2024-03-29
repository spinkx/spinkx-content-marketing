<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$spnxAdminManage = new spnxAdminManage();
$settings = get_option( SPINKX_CONTENT_LICENSE );
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
$catlists = [];
if($settings['due_date']=='0000-00-00 00:00:00') {
	echo 'You are not a registered user. You can create a boost post after registration. Click Here to <a href="admin.php?page=spinkx-site-register">Register</a>';
} else {

    $url      = esc_url( SPINKX_CONTENT_BAPI_URL . '/wp-json/spnx/v1/system/cat-lists' );
    $catlists = json_decode( spnxHelper::doCurl( $url, true ), true );

	$url = esc_url(SPINKX_CONTENT_BAPI_URL . '/wp-json/spnx/v1/site/get-auto-boost');
	$auto_boost = json_decode(spnxHelper::doCurl($url, true), true);
	$p = ['site_id' => $settings['site_id'], 'license_code' => $settings['license_code'], 'reg_email' => $settings['reg_email'], 'sortby2' => $sortby, 'post_type2' => $ptype, 'from_date' => $from_date, 'to_date' => $to_date, 'url' => esc_url(SPINKX_CONTENT_DIST_URL)];
	$p = wp_json_encode($p);
	$url = esc_url(SPINKX_CONTENT_BAPI_URL . '/wp-json/spnx/v1/content-playlist');
}
$bwki_sites_display_length = spnxHelper::getFilterVar('bwki_sites_display_length');
$pageLength = ($bwki_sites_display_length) ? $bwki_sites_display_length : 10;
$custom_js = 'var pt = ' . $p . '; var pageLength = ' . $pageLength . '; ';
$custom_js .= 'var start = moment(' . ($startdate) . ');';
$custom_js .= 'var end = moment(' . ($enddate) . '); jQuery(function() {';

if($settings['due_date']!='0000-00-00 00:00:00') {
$custom_js .= 'jQuery("#daterange").dateRangePicker({container: "#daterange-picker-container",numberOfMonths: 3,datepickerShowing: true, maxDate: "0D",minDate: new Date(2016, 8, 01),test: true,today: ' . $todaydate . '});
	var $ = jQuery.noConflict();	
	loadDT(start.format(\'YYYY-MM-DD\'), end.format(\'YYYY-MM-DD\'));	
	});';
} else {
    $custom_js .= 'jQuery(\'.spnx_wdgt_wrapper\').hide(); });';
}
wp_enqueue_script( 'jquery-youtubeapi', 'https://www.youtube.com/iframe_api' );
$vendor = SPINKX_CONTENT_PLUGIN_URL . '/vendor/';
wp_enqueue_script( 'jquery-powertip', $vendor . 'jQuery-powertip/js/jquery.powertip.min.js' );
wp_add_inline_script( 'jquery-powertip', $custom_js );///
if($settings['due_date']!='0000-00-00 00:00:00') {
?>

<div class="content_playlist_listing">

	<table id="bwki_sites_display" class="wp-list-table table-responsive " style="width:1024px;"><thead  style="border-bottom:1px solid #469fa1">
		<tr>
			<td  style="padding: 0px;text-align: right;">
				<span class="duration-text-first-span-span-crnt">Current Points: <span id="credit_points_value" class="pts_mny_cmn_cls"><?php echo $spnxAdminManage->spinkx_cont_get_credit_points();?></span></span>
				

			</td>
			<td style="padding: 0px;">
				&nbsp;&nbsp;&nbsp;<button  class=" buy-more-point" id="buy-more-point" onclick="getpoints()">Buy More Point</button>

			</td>
			<td  style="padding: 0px;text-align:right;">
                <?php if(is_array($catlists) && count($catlists) > 0) { ?>
                <div class="glbal_bp_main_cntnr">	
				<span class="duration-text-first-span-span-crnt glbl_stngs_lbl">Global Settings</span>
				<span class="glbl_setng_cb"><i class="fa fa-cog" aria-hidden="true" aria-hidden="true" onclick="modifiedcategory('g')"></i></span>
                    <div class="cntnr-main-drn-cls modified-category-g" style="display:none;">
                    	<span class="duration-text-first-span"> Modified category</span>
                                       <span class="fnt-awsm-spn"><i class="fa fa-times fnt-click-disable-drn fnt-click-close-drn" aria-hidden="true" onclick="modifiedcategory('1728')"></i></span>


                        <div class="select-drtn-cls">
                            <select class="categories" id="bp_categories_g" multiple="">
	                            <?php 
                                $flag = isset($catlists[1]);
                                foreach ($catlists[0] as $key => $value) {
	                                $selected='';
	                                if($flag) {
		                                if ( in_array( $key, $catlists[1] ) ) {
			                                $selected = 'selected';
		                                }
	                                }
                                    echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
	                             }
	                             ?>

                            </select>
                        </div>
                        <div style="clear: both;">
                        </div>
                        <div style="margin-top:10px;">
                                  <span style="display:none;" class="tt-txt-btn-cmn-cls-input">
                                    <span class="duration-text-first-span">Duration</span>
                                       <input type="number" id="bp_categories_g" class="txt-box-days" min="1" max="9999" placeholder="∞">
                                  </span>
                            <button class="clrsave updatecategories" type="button" data-id="g">save</button>
                        </div>

                    </div>
                </div>    
               <?php } ?>
			</td>
			

		</tr>
		<tr style="background-color: #e4eff4 !important;height: 27px;font-size: 12px; color:#0170b6;">
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
			<div class="modal-header modal_header_cc_spnkx">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><i class="fas fa-bullseye"></i><strong>Buy Points</strong></h4>
			</div>
			<?php
			$url = esc_url( SPINKX_CONTENT_BAPI_URL . '/wp-json/spnx/v1/site/get-point-price' );
			$post = array('points' => 100 );
			$response = spnxHelper::doCurl( $url, $post);
			$response = json_decode($response, true);
			?>
			<div class="modal-body modal_body_cc_spnkx">
				<?php if(isset($response['reach'])) { ?>
					<div class="cmn_cntnt_body_mdl">
						<span>Points</span>
						<input	type="number" class="form-control" id="buy_point"  value="100"/>
					</div>
					<div class="cmn_cntnt_body_mdl">
						<span>Views</span>
						<span id="reach"><?php echo $response['reach']?></span>
					</div>

					<div class="cmn_cntnt_body_mdl">
						<span>Price</span>
						<span><i id="currency_format" class="fa fa-<?php echo strtolower($response['currency_format']) ?>" style="display: inline;"></i><span id="amount"><?php echo $response['price']?></span>
						<input type="hidden" id="point_amount" value="<?php echo $response['price']?>" />
					</div>
					</div>
					<div class="modal-footer modal_footer_cc_spnkx">
					<?php
					if(isset($response['buy_points'])) {
						echo do_shortcode($response['buy_points']);
						}
					} else {
						echo $response;
					}
					?>
					<button data-dismiss="modal">CANCEL</button>
					</div>
					
			
		</div>
	</div>
</div>
</div>
<script>
    jQuery(document).ready(function($) {
        jQuery('#buy_point').on('blur', function(event){
            var points = parseInt($(this).val());
            if(points === undefined || isNaN(points)) {
                document.getElementById('payment-method-button').style.backgroundColor = 'lightblue';
                alert('Please enter amount in a number.');
                $("#payment-method-button").prop('disabled',true);
                return;
            }
            else if (points < 100) {
                document.getElementById('payment-method-button').style.backgroundColor = 'lightblue';
                alert('A minimum of 100 points are required for a purchase.');
                $("#payment-method-button").prop('disabled',true);

                return;
            } else {
            	$("#payment-method-button").prop('disabled',false);

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
                    document.getElementById('payment-method-button').style.backgroundColor = '#23bf4a';
                }
            });
        });

    });

</script>
<?php } ?>