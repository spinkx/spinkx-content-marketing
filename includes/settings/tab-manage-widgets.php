<?php
/**
 * This is spinkx widget list file.
 *
 * In this file we fetch the data from server & display.
 *
 * @package wordpress.
 * @subpackage spinkx.
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly		
global $wpdb;
$spnxAdminManage = new spnxAdminManage;
$settings = get_option( $spnxAdminManage->spinkx_cont_get_license() );
$settings = maybe_unserialize( $settings );
$registration_complete = true;
$spnxAdminManage = new spnxAdminManage(false);
if( $settings['due_date'] != '0000-00-00 00:00:00' ) {
	if (!(isset($settings['after_registration_sync']) && $settings['after_registration_sync'])) {
		$settings['site_url'] = $spnxAdminManage->spinkx_cont_get_site_url();
		$settings['after_registration_sync'] = TRUE;
		$response = $spnxAdminManage->spinkx_cont_post_sync($settings);
		update_option($spnxAdminManage->spinkx_cont_get_license(), maybe_serialize($settings));
	}
} else {
	//$registration_complete = false;
}
$site_id = $settings['site_id'];
$spnxAdminManage = new spnxAdminManage();
$custom_date = $spnxAdminManage->spinkx_cont_last_30_days();
$from_date = date('Y-m-d', $custom_date[0]);
$to_date = date('Y-m-d', $custom_date[1]);
$todaydate = $custom_date[2] * 1000;
$custom_css = ' 
 #bwki_widgets_display.widefat tr,
	#bwki_widgets_display.widefat td,
	#bwki_widgets_display.widefat th
	{
		vertical-align: middle;
		text-align: center;
	}
	select[name=bwki_widgets_display_length] {
		width: 62px;
	}
	.widefat{
		word-wrap:	normal;
	}
	.notice{ display:none !important;}
	';
$table_js = '';
 if( $registration_complete	) {
	 $table_js = 'var table = jQuery("#bwki_widgets_display").DataTable({
			"pageLength": 10,
			"lengthMenu": [ 5, 10, 20, 50, 100 ],
			"bFilter": false,
			"order": [],
			"bSort": false,			
			});';
 }
$custom_js = $table_js ;
$custom_js .= '		
		var $ = jQuery.noConflict();
		$(document).ready(function(){			
			jQuery("#daterange").dateRangePicker({container: "#daterange-picker-container",numberOfMonths: 3,datepickerShowing: true, maxDate: "0D",minDate: new Date(2016, 8, 01),test: true,today: '.$todaydate.'}); });';

	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
wp_enqueue_script( 'jquery-countdown-js', $js_url . 'jquery.countdown.min.js' );
wp_add_inline_script( 'jquery-countdown-js', $custom_js );
if( $registration_complete ) {
	?>
	<div id="widget_data" style="min-height: 475px;">
		<?php
			$tab = spnxHelper::getFilterVar('tab');
			$widget_id = spnxHelper::getFilterVar('widget_id');
			if (empty($tab) && empty($widget_id)) {
				$url = $spnxAdminManage->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/widget/' . $settings['site_id'] . '/' . md5($settings['license_code']);
				$wp_output = wp_remote_post($url,
					array(
						'method' => 'GET',
						'body' => array('from_date' => $from_date, 'to_date' => $to_date),
					)
				);
				if (!is_wp_error($wp_output)) {
					$result = json_decode($wp_output['body']);
				}
				if ('License Invalid' !== $result) {
					?>

						<div class="add_widget_button">+ Add New Widget</div>

					<div class="clear" style="display: block; overflow: hidden;"></div>
					<div id="add_new_widget" style="display:none;margin-top: 26px;">
						<?php require esc_url(SPINKX_CONTENT_PLUGIN_DIR) . 'assets/widgets/create/new-widget.php'; ?>
					</div>
					<?php echo $result . '<div style="text-align:center" id="install_guide">
			<a href="http://www.spinkx.com/how-to-install-guide/" style="text-decoration: none;color: #4bacc6;font-weight: 800;font-size: 18px; cursor: pointer;" target="_blank">How to Install Guide</a>
		</div>';
				} else {
					echo sprintf($result);
				}
			} else {
				?>
				<div class="clear" style="display: block; overflow: hidden;"></div>
				<div id="update_new_widget" style="margin-top: 26px;">
					<?php require esc_url(SPINKX_CONTENT_PLUGIN_DIR) . 'assets/widgets/create/update-widget.php'; ?>
				</div>
			<?php } ?>
	</div>
	<?php
} else {
	echo '<div id="widget_data" style="min-height: 475px; position: absolute; top:100px;left:100px;">You are not registered on Spinkx! Please <a href="?page=spinkx-site-register.php">register</a> first.</div>';
}