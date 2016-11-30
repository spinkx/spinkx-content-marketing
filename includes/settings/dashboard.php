<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


$url = esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/site/get-date' );
$post = array( 'site_id' => $settings['site_id'],'license_code' => md5( $settings['license_code'] ) );
$data = helperClass::doCurl( $url, $post );
$todaydate = 0;
$data = json_decode( $data );
if ( isset( $data->date ) ) {
	$todaydate = $data->date;
} else {
	echo isset( $data->msg )?$data->msg:'';
	wp_die();
}

$custom_js = ' var client_url = "' . esc_url( SPINKX_CONTENT_PLUGIN_URL ) . '";';
$custom_js .= 'jQuery(function() { jQuery(".se-pre-con").fadeOut("slow"); ';
if ( $todaydate ) {
	$custom_js .= ' var start = moment(' . ( $todaydate * 1000 ) . ');';
	$custom_js .= ' var end = moment(' . ( $todaydate * 1000 ) . ');';
} else {
	$custom_js .= ' var start = moment();';
	$custom_js .= ' var end = moment();';
}
$custom_js .= ' var todaydate = start;
	jQuery("#reportrange").on("apply.daterangepicker", function(ev, picker) {
		//do something, like clearing an input
		get_stat_now(picker.startDate, picker.endDate);
	});

	jQuery(".paginate_button").on("click", function(){
		//jQuery("#reportrange").trigger("apply.daterangepicker");
		get_stat_now(start, end);
	});

	function cb(start, end) {
		jQuery("#reportrange span").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));

	}

	jQuery("#reportrange").daterangepicker({
		startDate: start,
		endDate: end,
		ranges: {
			"Today": [moment(todaydate), moment(todaydate)],
			"Yesterday": [moment(todaydate).subtract(1, "days"), moment(todaydate).subtract(1, "days")],
			"Last 7 Days": [moment(todaydate).subtract(6, "days"), moment(todaydate)],
			"Last 30 Days": [moment(todaydate).subtract(29, "days"), moment(todaydate)],
			"This Month": [moment(todaydate).startOf("month"), moment(todaydate).endOf("month")],
			"Last Month": [moment(todaydate).subtract(1, "month").startOf("month"), moment(todaydate).subtract(1, "month").endOf("month")]
		}
	}, cb);
	cb(start, end);
});';
wp_enqueue_script( 'jquery-daterangepicker', '//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js' );
wp_add_inline_script( 'jquery-daterangepicker', $custom_js );
?>
<div class="se-pre-con"></div>
<div class="wrap">
	<div class="bpopup" id="bpopup_ajax_loading" style="display: none;width:100px">
			<div class="popup_div" style="display: block;" >
				<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL?>/assets/images/loader.gif" alt="loading"/>
			</div>
		</div>
	<div style="float:right;padding:10px;">
		<span style="float:left; margin-top:6px;">Show Statistics For :</span>
		<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; margin-right:10px; border: 1px solid #ccc; ">
			<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
			<span></span> <b class="caret"></b>
		</div>
	</div>

	<!-- Main tabs here  -->
	<div id="distributiontabs" style="width:100%;">
		<ul class="nav nav-tabs">
		<?php if ( ! $settings ) {
			echo '
			<li><a href="?page=spinkx_options#account_setup"><strong> Account Setup</strong></a></li>
			<li><a href="?page=spinkx_widget_design#widget_design"><strong> Widget Design</strong></a></li>
			<li><a href="?page=spinkx_content_play_list#content_play_list"><strong> Content Play List</strong></a></li>
			<li class="active"><a href="?page=spinkx_dashboard#dashboard"><strong> Dashboard </strong></a></li>
			<li><a href="?page=spinkx_campaigns#campaigns"><strong> Campaigns </strong></a></li>';
} else { 			echo '
			<li><a href="?page=spinkx_widget_design#widget_design"><strong> Widget Design</strong></a></li>
			<li><a href="?page=spinkx_content_play_list#content_play_list"><strong> Content Play List</strong></a></li>
			<li class="active"><a href="?page=spinkx_dashboard#dashboard"><strong> Dashboard </strong></a></li>
			<li><a href="?page=spinkx_campaigns#campaigns"><strong> Campaigns </strong></a></li>';
}
			echo '<li><a href="?page=spinkx_options#account_setup"><strong> Account Setup</strong></a></li>';
		?>
		</ul>
		<div class="wrap-inner" style="min-height: 10px; padding: 20px; margin: 10px auto;" >
			<div class="tab-contents">

				<div id="dashboard"><!--Dashboard -->
					<?php require esc_url( SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/tab-dashboard.php' ); ?>
				</div>

			</div>

		</div>
	</div>
</div>
<?php
