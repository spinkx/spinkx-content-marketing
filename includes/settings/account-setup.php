<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="se-pre-con"></div>
<div class="wrap">
	<div class="bpopup" id="bpopup_ajax_loading" style="display: none; background-color:transparent; width:100px;" >
			<div class="popup_div" style="display: block;" >
				<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL?>/assets/images/loader.gif" alt="loading"/>
			</div>
		</div>
	<div id="distributiontabs" style="width:100%;">
		<ul class="nav nav-tabs">
		<?php if ( ! $settings ) {
			echo '
			<li class="active"><a href="?page=spinkx_options#account_setup"><strong> Account Setup</strong></a></li>
			<li><a href="?page=spinkx_widget_design#widget_design"><strong> Widget Design</strong></a></li>
			<li><a href="?page=spinkx_content_play_list#content_play_list"><strong> Content Play List</strong></a></li>
			<li><a href="?page=spinkx_dashboard#dashboard"><strong> Dashboard </strong></a></li>
			<li><a href="?page=spinkx_campaigns#campaigns"><strong> Campaigns </strong></a></li>';
} else {
			echo '
			<li><a href="?page=spinkx_widget_design#widget_design"><strong> Widget Design</strong></a></li>
			<li><a href="?page=spinkx_content_play_list#content_play_list"><strong> Content Play List</strong></a></li>
			<li><a href="?page=spinkx_dashboard#dashboard"><strong> Dashboard </strong></a></li>
			<li><a href="?page=spinkx_campaigns#campaigns"><strong> Campaigns </strong></a></li>
			<li class="active"><a href="?page=spinkx_options#account_setup"><strong> Account Setup</strong></a></li>';
}
		?>

		</ul>
		<div class="wrap-inner" style="min-height: 10px; padding: 20px; margin: 10px auto;" >
			<div class="tab-contents">
				 <div id="account_setup">           <!--Account Setup -->
					<div id="tabse" style="width:100%;">
							<ul>
									<li><a href="#tabse-1">Licence</a></li>
									<li><a href="#tabse-2">Business & Banking Info</a></li>
							</ul>
						<div class="tab-contents">
							<div id="tabse-1">
								<?php require esc_url(SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/tab-license.php'); ?>
							</div>
							<div id="tabse-2">
							<?php require esc_url(SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/tab-bb-info.php'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

