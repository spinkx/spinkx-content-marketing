<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

	<div class="wrap SPINKX_edit" >
	<div class="wrap-inner">
		<form id="SPINKX_edit_form" class="SPINKX_form" action="" method="post">

		<!--  SPINKX All Site Blogs Starts Here  -->
		<input type="hidden" id="wid" value="<?php echo $widget_auto_id; ?>" name="wid_hidden" readonly />
		<!--  SPINKX All Site Blogs Ends Here  -->
		<!-- Add widget second level tabs starts here -->
			<input type="hidden" id="main_widget_id" value="<?php echo $main_widget_id; ?>" name="main_widget_id" placeholder="" readonly />
		<div class="distribution-sub-menu-tabs">
		<?php if( $is_mobile_widget == 0 ) { ?>
			<button type="button" id="brand_design_button" class="dist-sub-second-link <?php echo ( $tabtype == 1 )?'active':''?>">Design</button>
		<?php } ?>
			<button type="button" id="brand_local_button" class="dist-sub-second-link <?php echo ( $tabtype == 2 )?'active':''?>">Content Distribution</button>
		</div>
		<!-- Add widget second level tabs ends here  -->

		<div class="block-preview">
			<?php
			/********************** Include Preview Content ************************/
			require SPINKX_CONTENT_PLUGIN_DIR . 'assets/widgets/widget-fields.php';
			/********************** Include Preview Content ************************/
			?>
		</div>


		<!--  **********************************************************************  -->
		</form>
	</div>
	</div>
<?php
	require SPINKX_CONTENT_PLUGIN_DIR . 'assets/widgets/create/edit-widget/edit-widget-dynamic-scripts.php';
	?>