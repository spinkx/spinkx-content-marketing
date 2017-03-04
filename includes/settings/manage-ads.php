<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$settings = maybe_unserialize( get_option( SPINKX_CONT_LICENSE ) );
?>
<div class="se-pre-con"></div>
<div class="wrap">
	<div class="bpopup" id="bpopup_ajax_loading" style="display: none;width:100px">
			<div class="popup_div" style="display: block;" >
				<img src="<?php   echo esc_url( SPINKX_CONTENT_PLUGIN_URL )?>/assets/images/loader.gif" alt="loading"/>
			</div>
		</div>
	<!-- Main tabs here  -->
	<div id="distributiontabs" style="width:100%;">
		<?php spinkx_header_menu() ?>
		<div class="wrap-inner" style="min-height: 10px; padding: 20px; margin: 10px auto;" >
			
				<div id="campaigns">
					<div id="campaign_subtabs">
						<ul style="display: none;">
									<li><a href="#campaign_subtabs-1">Manage Ads</a></li>
									<li><a href="#campaign_subtabs-2">Payment Info</a></li>
						</ul>



						<div class="tab-contents">
							<div id="campaign_subtabs-1">
								<?php require esc_url( SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/tab-manage-ads.php' );

								?>
							</div>
							<div id="campaign_subtabs-2" style="display: none;">
								<label>Enter Amount</label>
								<input type="text" name="campaign_amount" id="campaign-amount"/>
								<?php
									$url = esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/campaign/add-money' );
									$post = array( 'site_id' => $settings['site_id'], 'license_code' => md5( $settings['license_code'] ), 'reg_email' => $settings['reg_email'] );

									$response = helperClass::doCurl( $url, $post );
									$response = json_decode($response);

									if($response) {
										echo do_shortcode($response);
									}
								?>

								<p>While we get our payment system operational, you can pay us via NEFT/RTGS/IMPS <br /> for details contact billing@brandwiki.today or dial 9971967676 </p>  </div>

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
