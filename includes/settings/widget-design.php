<?php
/**
 * This is spinkx widget design file.
 *
 * In this file we manage includes css & js for widget design.
 *
 * @package wordpress.
 * @subpackage spinkx.
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly	

?>
<div class="se-pre-con"></div>
<div class="wrap">
	<div class="bpopup" id="bpopup_ajax_loading" style="display: none;width:100px; background-color:transparent;">
			<div class="popup_div" style="display: block;" >
				<img src="<?php echo esc_url( SPINKX_CONTENT_PLUGIN_URL )?>/assets/images/loader.gif" alt="loading"/>
			</div>
		</div>
	<!-- Main tabs here  -->
	<!--div class="distribution-main-tabs"-->
		<!--<h2 style="font-weight: bold; padding:0px;">spinkx Distribution Settings</h2>
		<hr/>
		<br/>-->
	<!-- Main tabs here  -->
	<div id="distributiontabs" style="width:100%;">
		<ul class="nav nav-tabs">
<?php if ( ! $settings ) {
			echo '
			<li><a href="?page=spinkx_options#account_setup"><strong> Account Setup</strong></a></li>
			<li class="active"><a href="?page=spinkx_widget_design#widget_design"><strong> Widget Design</strong></a></li>
			<li><a href="?page=spinkx_content_play_list#content_play_list"><strong> Content Play List</strong></a></li>
			<li><a href="?page=spinkx_dashboard#dashboard"><strong> Dashboard </strong></a></li>
			<li><a href="?page=spinkx_campaigns#campaigns"><strong> Campaigns </strong></a></li>';
} else {
			echo '
			<li class="active"><a href="?page=spinkx_widget_design#widget_design"><strong> Widget Design</strong></a></li>
			<li><a href="?page=spinkx_content_play_list#content_play_list"><strong> Content Play List</strong></a></li>
			<li><a href="?page=spinkx_dashboard#dashboard"><strong> Dashboard </strong></a></li>
			<li><a href="?page=spinkx_campaigns#campaigns"><strong> Campaigns </strong></a></li>';
			echo '<li><a href="?page=spinkx_options#account_setup"><strong> Account Setup</strong></a></li>';
}
?>
		</ul>
		<div class="wrap-inner" style="min-height: 10px; padding: 20px; margin: 10px auto;" >
			<div class="tab-contents">
				<div id="widget_design">           <!--Widget Design -->
					<?php require esc_url( SPINKX_CONTENT_PLUGIN_DIR ) . '/includes/settings/tab-manage-widgets.php'; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php