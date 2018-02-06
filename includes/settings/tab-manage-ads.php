<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	$settings = get_option( $spnxAdminManage->spinkx_cont_get_license() );
	$settings = maybe_unserialize( $settings );
	$todaydate = 0;
	$enddate = 0;
	$startdate=0;
	$from_date = spnxHelper::getFilterVar( 'from_date' );
	$to_date = spnxHelper::getFilterVar( 'to_date' );
	$spnxAdminManage = new spnxAdminManage();
	$custom_date = $spnxAdminManage->spinkx_cont_last_30_days();
	if($from_date) {
	$startdate = strtotime($from_date) * 1000;

	} else {
		$from_date = date('Y-m-d', $custom_date[0]);
		$startdate =  $custom_date[0] * 1000;
		$todaydate = $custom_date[2] * 1000;
	}
	if($to_date) {
		$todaydate = strtotime("+1 Day", strtotime($to_date)) * 1000;
		$enddate = strtotime($to_date) * 1000;
	} else {
		$to_date = date('Y-m-d', $custom_date[1]);
		$enddate = $custom_date[1] * 1000;
	}

	$site_id = $settings['site_id'];
	$sortby = spnxHelper::getFilterVar( 'sortby' );
	$ptype = spnxHelper::getFilterVar( 'post_type' );

	//$p = [ 'site_id' => $settings['site_id'],'license_code' => md5( $settings['license_code'] ),'sortby' => $sortby,'post_type' => $ptype, 'from_date' => $from_date, 'to_date' => $to_date ];
	//$p = wp_json_encode( $p );
	$p = ['site_id' => $settings['site_id'], 'license_code' => $settings['license_code'], 'from_date' => $from_date, 'to_date' => $to_date, 'reg_email' => $settings['reg_email'], 'sortby' => $sortby,'post_type' => $ptype, 'plg_url' => esc_url( SPINKX_CONTENT_PLUGIN_URL )];
	$p = wp_json_encode( $p );
	$url = $spnxAdminManage->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign';
	$custom_js = '';
	if ( $todaydate ) {
		$custom_js .= 'var start = moment(' . ( $startdate ) . ');';
		$custom_js .= 'var end = moment(' . ( $enddate ) . ');';
	} else {
		$custom_js .= 'var start = moment();';
		$custom_js .= 'var end = moment();';
	}
	$bwki_sites_display_length	= spnxHelper::getFilterVar( 'bwki_sites_display_length' );
	$pageLength = ( $bwki_sites_display_length )?$bwki_sites_display_length:10;
	$loader = '<img src="'.esc_url( SPINKX_CONTENT_PLUGIN_URL ).'/assets/images/loader.gif" alt="loading"/>';
	$css_output = "
	ul.select2-choices li.select2-search-choice {display:none};
	";
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/css/' );
	wp_enqueue_style( 'campaign-css', $css_url . 'master.css' );
	wp_add_inline_style( 'campaign-css', $css_output );
	$custom_js .= 'var todaydate = start; var pageLength = ' . $pageLength . ';
	var pt = '.$p.'; jQuery(function() {  jQuery(".se-pre-con").fadeOut("slow");
	jQuery("#daterange").dateRangePicker({container: "#daterange-picker-container",numberOfMonths: 3,datepickerShowing: true, maxDate: "0D",minDate: new Date(2016, 8, 01),test: true,today: '.$todaydate.'});	
	var $ = jQuery.noConflict();
	loadDT(start, end);		
	});';
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/js/' );
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/css/' );
	wp_enqueue_style( 'bootstrap-datetimepicker-css', $css_url . 'bootstrap-datetimepicker.css' );
	wp_register_script( 'jquery', ( 'https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js' ), array(), '2.0.3', false );
	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'jquery-dateFormat-js', $js_url . 'jquery-dateFormat.min.js' );
	wp_enqueue_script( 'jquery-moment-js', $js_url . 'moment.js' );
	wp_enqueue_script( 'jquery-datetimepicker-js', $js_url . 'bootstrap-datetimepicker.js' );
	wp_enqueue_script( 'jquery-bootstrap-js', $js_url . 'bootstrap.min.js' );
	wp_localize_script('jquery-bootstrap-js', 'spinkxPUrl', array('pluginsUrl' =>  plugins_url('spinkx-content-marketing/')));
	wp_enqueue_media();
	wp_enqueue_script( 'jquery-youtubeapi', 'https://www.youtube.com/iframe_api' );
	wp_add_inline_script( 'jquery-bootstrap-js', $custom_js );///
	wp_enqueue_script( 'jquery-daterange-picker', '//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js' );
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/styles/' );
	$post = spnxHelper::getFilterPost();
if( is_array( $settings ) && isset($settings['site_id'])) {
	if (isset($post['add_camp'])) {
		$validate = (new spnxHelper())->campaignValidation($post);
		if( isset( $validate['success'] ) && $validate['success']) {
		 if( ! ( isset( $post['c_id'] ) &&  $post['c_id'] > 0 ) ){
			if( ! isset( $post['is_video'] ) ) {
				 if ($post['image_attachment_id'] > 0) {
					 $image_attributes = wp_get_attachment_image_src($post['image_attachment_id'], 'full');
					 $post['ad_image_url'] = $image_attributes[0];
				 }
			 }
			 $post['access_key'] = $settings['license_code'];
			 $post['site_id'] = $settings['site_id'];
			 $url = $spnxAdminManage->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign/create';
			 $response = spnxHelper::doCurl($url, $post);
		 } else {
			 if ( $post ) {
			 if( ! isset( $post['is_video'] ) ) {
				 if( $post['image_attachment_id'] > 0) {
					 $image_attributes = wp_get_attachment_image_src( $post['image_attachment_id'], 'medium' );
					 $post['ad_image_url'] = $image_attributes[0];
				 }
		     }
		         $post['access_key'] = $settings['license_code'];
		         $post['site_id'] = $settings['site_id'];
				 $url = $spnxAdminManage->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign/update';
				 $response = spnxHelper::doCurl( $url, $post );

			 }
		 }
		 $response = json_decode($response);
		 if( isset( $response->error ) ) {
			echo $response->message;
		 }
	} else { ?>
		<script>alert('<?php echo $validate['msg']?>')</script>
	   <?php }
	}
	$url = $spnxAdminManage->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/campaign/form-elements';
	$output = spnxHelper::doCurl($url,true);
	$output = json_decode($output, TRUE);

	if(isset($output['countries'])) {
		$countries = $output['countries'];
	}
	if(isset($output['categories'])) {
		$categories = $output['categories'];
	}
	if(isset($output['languages'])) {
		$languages = $output['languages'];
	}
	if(isset($output['currencyClass'])) {
		$currencyClass = $output['currencyClass'];
	}
	if(isset($output['cpm'])) {
		$cpm = $output['cpm'];
	}
	if(isset($output['cpc'])) {
		$cpc = $output['cpc'];
	}
	$group_name= '';
	if( isset($output['groupname']) ) {
		$group_name = $output['groupname'];
	}
	if($output['error'] === false) {
		wp_localize_script('jquery-bootstrap-js', 'spinkxJs', array('categories' =>$categories, 'languages' =>$languages, 'countries' => $countries, 'currencyClass' => $currencyClass, 'cpm' => $cpm,'cpc' => $cpc, 'groupList' => $group_name));
	}
}
?>
<?php if($output['error'] === false) {?>
	<div class="campaign_page col-sm-12 col-md-12">
	<div style="float: right;display: none;">Balance:<span id="user-balance"><i class="fa fa-<?php echo $currencyClass?>"></i><?php echo $output['user_bal']?></span>
		<button class="btn btn-primary" id="add_money_wallet" style="display: none" onclick="jQuery('#campaignmodaladdMoney').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
})">Add Money to Wallet</button>
	</div>
<?php } else {
	echo $output['error'];
}	?>
<?php if($output['error'] === false) {?>
<div class="content_playlist_listing">
	<table id="bwki_sites_display" class="wp-list-table table-responsive"  style="width:1024px;"><thead  style="border-bottom:1px solid #469fa1">
		<tr>
			<td  style="padding: 0px">&nbsp;</td>

			<td  style="padding: 0px;text-align: center;">
				<span><img src="<?php echo esc_url( SPINKX_CONTENT_PLUGIN_URL ); ?>assets/images/sort-icon.png" style="height: 15px; margin-right: 7px;"><a href="#" id="sortby_local_reach">Views</a>|<a href="#" id="sortby_local_ctr">Engagement</a></span>

			</td>
			<td  style="padding: 0px;text-align: center;display: none;">
				<span style=""><img src="<?php echo esc_url( SPINKX_CONTENT_PLUGIN_URL ); ?>assets/images/sort-icon.png" style="height: 15px; margin-right: 7px;"> <a href="#" id="sortby_global_reach">Views</a>|<a href="#" id="sortby_global_ctr">Engagement</a></span>
				</td>
		</tr>
		<tr style="background-color: #e4eff4 !important;height: 27px;font-size: 12px; color:#a93671;">
			<th style="padding: 0px;border:none;width:475px;">&nbsp;&nbsp;&nbsp;Campaign Details</th>
			<th style="padding: 0 0 0 12px;border:none;width:252px;">&nbsp;&nbsp;&nbsp;Campaign Statistics </th>
			<th style="padding: 0 0 0 12px;border:none;width:252px;">&nbsp;&nbsp;&nbsp; </th>
		</tr>
		<tr style="height: 27px;font-size: 12px; color:#a93671;">
			<th style="padding: 0px;border:none;width:475px;" colspan="3">&nbsp;&nbsp;&nbsp;
					<button class="btn btn-primary" id="button-create-ad" onclick="createAd(this)" style="font-size: 12px;">Create Ad</button></th>
		</tr>
		</thead><tbody><input type="hidden" id="chooks" value="0" /></tbody>
		</table></div>
<div class="clear"></div>
	<div style="display: none">
	<?php
		if ( isset( $output['add_money'] ) && $output['add_money']) {
			echo $output['add_money'];
			echo do_shortcode($output['add_money']);
		}

	?>
	</div>
	<div id="campaignmodaladdMoney" style="z-index: 9999;" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><strong>Add Money to Wallet</strong></h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="point_amount">Enter Amount</label>
						<input	type="text" class="form-control" id="wallet_amount" style="display: inline;width:40%;" value="100"/>
					</div>
					<?php
						if ( isset( $output['add_money'] ) && $output['add_money']) {
							$response_money = str_replace('flag="3"', 'flag="4"', $output['add_money']);
							echo do_shortcode($response_money);
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
	add_action( 'admin_footer', 'spinkx_cont_media_selector_print_scripts' );
}
