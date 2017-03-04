<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="se-pre-con"></div>
<div class="wrap">
	<div class="bpopup" id="bpopup_ajax_loading" style="display: none;width:100px; background-color:transparent;">
			<div class="popup_div" style="display: block;" >
				<img src="<?php echo esc_url( SPINKX_CONTENT_PLUGIN_URL) ?>/assets/images/loader.gif" alt="loading" />
			</div>
		</div>
	<!-- Main tabs here  -->
	<div id="distributiontabs" style="width:100%;">
		<?php spinkx_header_menu() ?>
		<div class="wrap-inner" style="min-height: 10px; padding: 20px; margin: 10px auto;" >
			<div class="tab-contents">
				<div id="content_play_list">
					<?php require esc_url( SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/tab-get-posts.php' ); ?>
				</div>

			</div>
		</div>
	</div>
</div>
