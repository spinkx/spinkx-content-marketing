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
	<div class="bpopup" id="bpopup_ajax_loading" style="display: none; background-color:transparent;">
			<div class="popup_div" style="display: block;" >
				<img src="<?php echo esc_url( SPINKX_CONTENT_PLUGIN_URL )?>assets/images/loader.gif" alt="loading"/>
			</div>
		</div>
	<!-- Main tabs here  -->
	<!--div class="distribution-main-tabs"-->
		<!--<h2 style="font-weight: bold; padding:0px;">spinkx Distribution Settings</h2>
		<hr/>position: relative;margin-top:0;
		<br/>-->

	<!-- Main tabs here  -->
	<div id="distributiontabs" style="width:100%;">
		<?php spinkx_header_menu() ?>
		<div class="wrap-inner" style="width: 100%;">
			<div class="tab-contents" style="width: 98%;">
				<div id="widget_design">           <!--Widget Design -->
					<?php require esc_url( SPINKX_CONTENT_PLUGIN_DIR ) . '/includes/settings/tab-manage-widgets.php'; ?>
				</div>
			</div>
		</div>
	</div>
</div>