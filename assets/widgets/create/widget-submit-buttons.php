<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<!--  **********************************************************************  -->
<!--  SPINKX Update Settings Starts Here  -->
<div class="create_btn_widget" style="display:none;">
	<p class="submit">
		<input  type="submit" name="update" id="ajax_create_button" class="button ajax_create_button" alt="Update" value="Save" style="background-color: #23bf4a" />
		<a id="ajax_cancel_button" class="button " alt="Update" href="?page=spinkx_widget_design" >Cancel</a>
		<!--  SPINKX AJAX Update Settings Starts Here  -->
	</p>
</div>
<!--  SPINKX Update Settings Ends Here  -->
<!--  **********************************************************************  -->

<!--  **********************************************************************  -->
<!--  SPINKX Update Settings Starts Here  -->
<div class="update_btn_widget">
	<p class="submit">

		<a id="ajax_update_button" class="button ajax_update_button" alt="Update" href="javascript:;void(0)" style="background-color: #23bf4a">Save</a>
		<?php if( $is_mobile_widget == 0 ) { ?>
		<!--  SPINKX AJAX Update Settings Starts Here  -->
		<a id="ajax_delete_button" class="button ajax_delete_button" alt="Delete" href="javascript:;void(0)">Delete</a>
		<!--  SPINKX AJAX Update Settings Ends Here  -->

		<!--  SPINKX AJAX Update Settings Starts Here  -->
		<a id="ajax_clone_button" class="button ajax_clone_button" alt="Clone" href="javascript:;void(0)">Clone</a>
		<!--  SPINKX AJAX Update Settings Ends Here  -->
		<?php } ?>
		<!--  SPINKX AJAX Update Settings Starts Here  -->

		<!--  SPINKX AJAX Update Settings Ends Here  -->
		<!--  SPINKX AJAX Update Settings Starts Here  -->

		<a id="ajax_cancel_button" class="button " alt="Update" href="?page=spinkx_widget_design" >Cancel</a>
		<!--  SPINKX AJAX Update Settings Ends Here  -->
		<?php if( $is_mobile_widget == 0 ) { ?>
		<a id="ajax_reset_button" class="button ajax_reset_button" alt="Reset" href="javascript:;void(0)">Reset Widget</a>

		<?php } ?>
	</p>
</div>
