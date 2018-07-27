<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$spnxAdminManage = new spnxAdminManage();
?>
<div class="spnx_wdgt_wrapper" id="spnx-wdgt-wrapper-loader"><div class="cssload-loader"></div></div>
<div class="wrap">
    <!-- Main tabs here  -->
	<div id="distributiontabs" style="width:100%;">
		<?php spinkx_header_menu() ?>
		<div class="wrap-inner" style="margin: 10px auto 10px auto; display: none">
			<div class="tab-contents">
				<div id="content_play_list">
                    <?php require  SPINKX_CONTENT_ADMIN_VIEW_DIR . 'fbp/tab-get-posts.php'; ?>
				</div>

			</div>
		</div>
	</div>
</div>
