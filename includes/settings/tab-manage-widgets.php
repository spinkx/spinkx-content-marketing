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
$settings = get_option( SPINKX_CONT_LICENSE );
$settings = maybe_unserialize( $settings );
$p = [ 'site_id' => $settings['site_id'],'license_code' => md5( $settings['license_code'] ) ];
$p = wp_json_encode( $p );
$site_id = $settings['site_id'];
$url = esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/site/get-date' );
$post = array( 'site_id' => $settings['site_id'], 'license_code' => md5( $settings['license_code'] ) );
$data = helperClass::doCurl( $url, $post );
$todaydate = 0;
$data = json_decode( $data );
if ( isset( $data->date ) ) {
	$todaydate = $data->date;
} else {
	echo isset( $data->msg )? $data->msg : 'Error';
	exit;
}
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


$custom_js = 'jQuery(function() { ';
if ( $todaydate ) {
	$custom_js .= 'var start = moment(' . ( $todaydate * 1000 ) . ');';
	$custom_js .= 'var end = moment(' . ( $todaydate * 1000 ) . ');';
} else {
	$custom_js .= 'var start = moment();';
	$custom_js .= 'var end = moment();';
}
$custom_js .= 'var todaydate = start;
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

	});
		var $ = jQuery.noConflict();
		$(document).ready(function(){


			jQuery("#reportrange").on("apply.daterangepicker", function(ev, picker) {
				//do something, like clearing an input
				//get_stat_now(picker.startDate, picker.endDate);
				updatewidget();
			});

			var table = $("#bwki_widgets_display").DataTable({
			"pageLength": 5,
			"lengthMenu": [ 5, 10, 20, 50, 100 ],
			"bFilter": false,
			"order": [],
			"bSort": false
			});
			function updatewidget(){
				var site_id = "' . $site_id . '";
				$.ajax({
					url : ajaxurl,
					type : "get",
					datatype : "json",
					data : {
					    "action": "spinkx_cont_get_widget_stat",
						"site_id" : site_id,
						"from_date" : jQuery("#reportrange").data("daterangepicker").startDate.format("YYYY-MM-DD"),
						"to_date" : jQuery("#reportrange").data("daterangepicker").endDate.format("YYYY-MM-DD"),
					},
					success : function(data){
						var data = JSON.parse(data);

						$.each(data,function(key,stat){
								cell_imp = table.cell("#w_"+key, 4);
								//var cell = table.cell( this );
								cell_imp.data( stat.total_impressions ).draw();
									//this.data()[3] = "sdf";
								//console.log(cell_imp.data());
								cell_click = table.cell("#w_"+key, 5);
								cell_click.data( stat.total_clicks ).draw();

								cell_ctr = table.cell("#w_"+key, 6);
								cell_ctr.data( stat.widget_ctr ).draw();

							//});

						});
					}
				});
			}

			
		});';
wp_enqueue_script( 'jquery-daterange-picker', '//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js' );
wp_add_inline_script( 'jquery-daterange-picker', $custom_js );
?>
<div  id="widget_data" style="min-height: 10px;" >
<?php
$tab = 	helperClass::getFilterVar( 'tab' );
$widget_id = helperClass::getFilterVar( 'widget_id' );
if ( empty( $tab ) && empty( $widget_id ) ) {
	$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/widget/'. $settings['site_id'].'/'. md5($settings['license_code']);
	$wp_output = wp_remote_post( $url,
		array(
			'method' => 'GET',
			)
	);
	if ( ! is_wp_error( $wp_output ) ) {
		$result = json_decode($wp_output['body']);
	}
	if ( 'License Invalid' !== $result ) {
	?>
		<h2><div style="float: right;background-color: #469fa1;border-color: #469fa1;color: #fff;" class="add_widget_button button "  >+ Add New Widget</div></h2>
		<div class="clear" style="display: block; overflow: hidden;"></div>
		<div id="add_new_widget" style="display:none;">
		<?php require esc_url( SPINKX_CONTENT_PLUGIN_DIR ) . 'assets/widgets/create/new-widget.php'; ?>
		</div>
		<?php echo  $result . '<div style="text-align:center" id="install_guide">
			<a href="http://www.spinkx.com/how-to-install-guide/" style="text-decoration: none;color: #4bacc6;font-weight: 800;font-size: 18px;">How to Install Guide</a>
		</div>';
	} else {
		echo sprintf( $result );
	}
} else {
?>
		<div id="update_new_widget" >
			<?php require esc_url( SPINKX_CONTENT_PLUGIN_DIR ) . 'assets/widgets/create/update-widget.php'; ?>
		</div>
	<?php } ?>
</div>
<?php

