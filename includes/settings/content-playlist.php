<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="se-pre-con"></div>
<div class="wrap">
    <!-- Main tabs here  -->
	<div id="distributiontabs" style="width:100%;">
		<?php spinkx_header_menu() ?>
		<div class="wrap-inner" style="margin: 10px auto 10px auto;">
			<div class="tab-contents">
				<div id="content_play_list">
					<?php require esc_url( SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/tab-get-posts.php' ); ?>
				</div>

			</div>
		</div>
	</div>
</div>
