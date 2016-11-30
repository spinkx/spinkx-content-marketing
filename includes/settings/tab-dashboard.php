<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/dashboard';
$post['site_id'] = $settings['site_id'];
if( helperClass::getFilterVar( 'from_date' ) ) {
	$post['from_date'] = helperClass::getFilterVar( 'from_date' );
}
if( helperClass::getFilterVar( 'to_date' ) ) {
	$post['to_date'] = helperClass::getFilterVar( 'to_date' );
}
global $wpdb;
if ( ! ( isset($post['from_date']) && isset($post['to_date']) ) ) {
	$from_date = $to_date = $wpdb->get_var( 'SELECT current_date()' );
	$post['from_date'] = $from_date;
	$post['to_date'] = $to_date;
}
$data = helperClass::doCurl( $url,$post );
$data = json_decode( $data, true );
?>
<div class="dashboard-main-div" style="width:36%; float:left;margin-right: 8px;">
	<h3>Your Site Statistics</h3>
	<div class="well dashboard_cols" style="background-color:#3E933B; color:#333;border-radius: 15px;" >
		<table width="100%">
			<tr>
				<th>Active Posts</th>
				<th>Reach</th>
				<th>Engagement</th>
				<th>CTR</th>

			</tr>
			<tr>
				<td id="apb_activepost"><?php echo $data['active_post_block']['activepost']?></td>
				<td id="apb_imppost"><?php echo $data['active_post_block']['imppost'] ?></td>
				<td id="apb_clickpost"><?php echo $data['active_post_block']['clickpost'] ?></td>
				<td id="apb_ctrPostTotal" ><?php echo $data['active_post_block']['ctrPostTotal']?></td>
			</tr>
		</table>


	</div>
</div>
<div class="dashboard-main-div" style="width:62%; float:left;">
	<h3>Boosted Post Statistics</h3>
	<div class="well dashboard_cols" style="background-color:#0170b6; color:#fff;border-radius: 15px;">
		<table width="100%">
			<tr>
				<th>Available Credits</th>
				<th>Credit Spend</th>
				<th>Credit Earned</th>
				<th>Post reach</th>
				<th>Engagement</th>
			</tr>
			<tr>
				<td id="acb_availablecredit" ><?php echo $data['available_credit_block']['availablecredit']?></td>
				<td id="acb_spentcredit" >-<?php echo $data['available_credit_block']['spentcredit'] ?></td>
				<td id="acb_earncredit" >+<?php echo $data['available_credit_block']['earncredit'] ?></td>
				<td id="acb_impposttotalglobal"><?php echo $data['available_credit_block']['impposttotalglobal']?></td>
				<td id="acb_clicksposttotalglobal" ><?php echo $data['available_credit_block']['clicksposttotalglobal'] ?></td>
			</tr>
		</table>
	</div>
</div>
<div class="dashboard-main-div" style="width:36%; float:left; margin-right: 8px;">
	<h3>Widget Statistics</h3>
	<div class="well dashboard_cols" style="background-color:#E4D629; color:#333;border-radius: 15px;">
		<table width="100%">
			<tr>
				<th>Active Widgets</th>
				<th>Reach</th>
				<th>Engagement</th>
				<th>CTR</th>
			</tr>
			<tr>
				<td id="widget_activewidget" ><?php echo $data['widget']['widgetActive']; ?></td>
				<td id="widget_impressions" ><?php echo $data['widget']['total_impressions'] ?></td>
				<td id="widget_engagement" ><?php echo $data['widget']['total_clicks'] ?></td>
				<td id="widget_ctr" ><?php echo $data['widget']['widget_ctr']?></td>
			</tr>
		</table>
	</div>
</div>
	<div class="dashboard-main-div" style="width:62%; float:left;">
		<h3>Site Revenue</h3>
		<div class="well dashboard_cols" style="background-color:#fff; color:#333;border: #3E933B 2px solid; border-radius: 15px;">
			<table width="100%">
				<tr>
					<th>Site Revenue Total</th>
					<th>Revenue From Reach</th>
					<th>Revenue From Click</th>
				</tr>
				<tr>
					<td id="site_revenue_total"><?php echo $data['site']['revenue_total']; ?></td>
					<td id="site_revenue_from_reach" ><?php echo $data['site']['revenue_from_reach'] ?></td>
					<td id="site_revenue_from_clicks" ><?php echo $data['site']['revenue_from_clicks'] ?></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="dashboard-main-div" style="width:36%; float:left; margin-right: 8px;">
		<h3>Campaign Statistics</h3>
		<div class="well dashboard_cols" style="background-color:#E4D629; color:#333;border-radius: 15px;">
			<table width="100%">
				<tr>
					<th>User Balance</th>
					<th>Money Spent</th>
					<th>Ad Reach</th>
					<th>Ad Engagement</th>
					<th>CTR</th>
				</tr>
				<tr>
					<td id="user_user_balance" ><?php echo $data['user']['user_balance']; ?></td>
					<td id="user_money_spent" ><?php echo $data['user']['money_spent'] ?></td>
					<td id="user_reach" ><?php echo $data['user']['reach'] ?></td>
					<td id="user_engagement" ><?php echo $data['user']['engagement']?></td>
					<td id="user_ctr" ><?php echo $data['user']['ctr']?></td>
				</tr>
			</table>
		</div>
	</div>
<div style="clear:both;"></div>
<?php
