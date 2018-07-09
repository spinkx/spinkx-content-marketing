<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$spnxAdminManage = new spnxAdminManage();
$js_url = esc_url( SPINKX_CONTENT_DIST_URL . 'js/' );
$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'vendor/evol-colorpicker/css/evol.colorpicker.min.css' );
$css = 'scss';
if(SPINKX_CONTENT_PRODUCTION ) {
    $css = 'css';
}
wp_enqueue_style( 'css-evol-colorpicker', $css_url  );
$css_url = esc_url( SPINKX_CONTENT_DIST_URL . 'css/' );
wp_enqueue_style( 'css-add-widget', $css_url . 'add-widget.'.$css );
wp_enqueue_style( 'css-add-widget-preview', $css_url . 'add-widget-preview.'.$css );
/***************************************************************************************/
$access_user_id = get_current_user_id();
/***************************************************************************************/
/* Check the default widget id value : Initially it will be empty */
$widget_auto_id = spnxHelper::getFilterVar( 'widget_id', INPUT_GET, FILTER_VALIDATE_INT);
/***************************************************************************************/
$access_site_id = spnxHelper::getFilterVar( 'site_id', INPUT_GET, FILTER_VALIDATE_INT);

	/***************************************************************************************/
$main_widget_id = $widget_auto_id;
$tabtype = spnxHelper::getFilterVar( 'tabtype', INPUT_GET, FILTER_VALIDATE_INT);
$path = SPINKX_CONTENT_ADMIN_VIEW_DIR;
/****************************** Get Field Values ***********************************/
require $path . 'widgets/edit-default-fields-db-serialized.php';
/****************************** Get Field Values ***********************************/
if( $is_mobile_widget == 0 ) {
	?>

	<div class="wrap SPINKX_edit">
		<div class="wrap-inner2">
			<form id="SPINKX_edit_form" class="SPINKX_form" action="" method="post">

				<!--  SPINKX All Site Blogs Starts Here  -->
				<input type="hidden" id="wid" value="<?php echo $widget_auto_id; ?>" name="wid_hidden" readonly/>
				<!--  SPINKX All Site Blogs Ends Here  -->
				<!-- Add widget second level tabs starts here -->
				<div class="distribution-sub-menu-tabs">

					<button type="button" id="brand_design_button"
					        class="dist-sub-second-link <?php echo ($tabtype == 1) ? 'active' : '' ?>">Design
					</button>

					<button type="button" id="brand_local_button"
					        class="dist-sub-second-link <?php echo ($tabtype == 2) ? 'active' : '' ?>">Content
						Distribution
					</button>
				</div>
				<!-- Add widget second level tabs ends here  -->

				<div class="block-preview">
					<?php
						/********************** Include Preview Content ************************/
						require  "{$path}widgets/widget-fields.php";
						/********************** Include Preview Content ************************/
					?>
				</div>
				<div class="block-right-preview" <?php echo ($tabtype == 2) ? 'style="display:none;"' : '' ?>>
					<?php
						/********************** Include Preview Content ************************/
						require  "{$path}widgets/add-widget-preview-content.php";
						/********************** Include Preview Content ************************/
					?>
				</div>
				<!--<div class="block-default-buttons">
			<?php
					/********************** Include Preview Content ************************/
					//require SPINKX_CONTENT_PLUGIN_DIR . 'assets/widgets/create/widget-submit-buttons.php';
					/********************** Include Preview Content ************************/
				?>
		</div>-->
				<!--  **********************************************************************  -->
			</form>
		</div>
	</div>
	<?php

	/****************************** Include Page Scripts *********************************/
	require  "{$path}widgets/edit-widget-dynamic-scripts.php";
	/****************************** Include Page Scripts *********************************/
	/**************************** Include Preview Scripts ********************************/
	require  "{$path}widgets/add-widget-preview-scripts.php";
	/**************************** Include Preview Scripts ********************************/
	/* Include Page Scripts Ends Here */
	//}
} else {
	require  "{$path}widgets/update-mobile-widget.php";
}
?>