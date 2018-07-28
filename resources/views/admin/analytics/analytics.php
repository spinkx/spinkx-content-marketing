<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$spnxAdminManage = new spnxAdminManage;
$post = array();
$custom_date = $spnxAdminManage->spinkx_cont_last_30_days();
$post['from_date'] = date('Y-m-d', $custom_date[0]);
$post['to_date'] = date('Y-m-d', $custom_date[1]);
$todaydate = $custom_date[2] * 1000;
$custom_js = ' var client_url = "' . esc_url( SPINKX_CONTENT_PLUGIN_URL ) . '";';
$custom_js .= 'jQuery(function() { jQuery("#daterange").dateRangePicker({container: "#daterange-picker-container",numberOfMonths: 3,datepickerShowing: true, maxDate: "0D",minDate: new Date(2016, 8, 01),test: true,today: '.$todaydate.'});
});';
$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
wp_enqueue_script( 'jquery-dashboard', $js_url . 'analytics.js' );
// wp_enqueue_script( 'jquery-custom-js', $js_url . 'widget-design.js' );
wp_add_inline_script( 'jquery-dashboard', $custom_js );
?>
<div class="spnx_wdgt_wrapper"><div class="cssload-loader"></div></div>
<div class="wrap">
	<div class="bpopup" id="bpopup_ajax_loading" style="display: none;width:100px">
			<div class="popup_div" style="display: block;" >
				<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL?>assets/images/loader.gif" alt="loading"/>
			</div>
		</div>


	<!-- Main tabs here  -->
	<div id="distributiontabs" style="width:100%;">
		<?php spinkx_header_menu() ?>
		<div class="wrap-inner" style="clear: both;">
			<div class="tab-contents" style="padding-top: 20px;">
				<div id="dashboard"><!--Dashboard -->
					<?php require  SPINKX_CONTENT_ADMIN_VIEW_DIR.'analytics/tab-analytics.php' ; ?>
				</div>

			</div>

		</div>
	</div>
</div>
<?php

