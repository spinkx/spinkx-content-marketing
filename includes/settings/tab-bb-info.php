<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly		
global $wpdb;
$settings = get_option( SPINKX_CONT_LICENSE );
$settings = maybe_unserialize( $settings );
$url = esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/site/site-profile/' . $settings['site_id'] );
$output = helperClass::doCurl( $url . '/fetch' );
$input = json_decode( $output, true );
$bb_info = helperClass::getFilterVar( 'bb-info', INPUT_POST);
if ( $bb_info ) {
	$post_filter = helperClass::getFilterPost();
	$post = wp_json_encode( $post_filter );
	$output = helperClass::doCurl( $url . '&type=update', $post, false );
	?>
	<script>window.location.reload();</script>
	<?php
}
?>
<form method="post">
	<div class="info-form">
		<fieldset>
			<div class="form-group">
				<label>Your Name</label>
				<input type="text" name="Name" value="<?php echo (isset($input['site_owner']))?$input['site_owner']:''; ?>">
			</div>
			<div class="form-group">
				<label>Designation</label>
				<input type="text" name="Designation" value="<?php echo (isset($input['site_owner_designation']))?$input['site_owner_designation']:''; ?>"
			</div>
		</fieldset>
		<hr class=divider"></hr>

		<h4>Business Info</h4>
		<fieldset>
			<div class="form-group">
				<label>Name of Business under which you operate</label>
				<input type="text" name="Auto Name Fill from FB" value="<?php echo (isset($input['site_company']))?$input['site_company']:''; ?>">
			</div>

		</fieldset>

		<fieldset>
			<div class="form-group">
				<label>Office Address</label>
				<input type="text" name="Address" value="<?php echo (isset($input['company_address']))?$input['company_address']:''; ?>">
			</div>
		</fieldset>

		<fieldset>
			<div class="form-group">
				<label>City</label>
				<input type="text" name="City" value="<?php echo (isset($input['city']))?$input['city']:''; ?>">
			</div>
			<div class="form-group">
				<label>State</label>
				<input type="text" name="State" value="<?php echo (isset($input['state']))?$input['state']:''; ?>">
			</div>
		</fieldset>

		<fieldset>
			<div class="form-group">
				<label>Pin Code</label>
				<input type="text" name="Pin Code" value="<?php echo (isset($input['zip_code']))?$input['zip_code']:''; ?>">
			</div>
			<div class="form-group">
				<label>Country</label>
				<input type="text" name="Country" placeholder="Country" value="<?php echo (isset($input['country']))?$input['country']:''; ?>">
			</div>
		</fieldset>
		<fieldset>
		<p><button class="btn btn-info" type ="submit" name="bb-info" disabled>Update</button></p>
		</fieldset>

	</div>
	</form>
