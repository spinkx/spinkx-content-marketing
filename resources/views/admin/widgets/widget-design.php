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
$spnxAdminManage = new spnxAdminManage();
?>
<div class="wrap">
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
					<?php require SPINKX_CONTENT_ADMIN_VIEW_DIR. 'widgets/tab-manage-widgets.php'; ?>
				</div>
			</div>
		</div>
	</div>
</div>