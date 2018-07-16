<?php
/**
 * This is spinkx widget list file.
 *
 * In this file we fetch the data from server & display.
 *
 * @package wordpress.
 * @subpackage spinkx.
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly		
global $wpdb;
$spnxAdminManage = new spnxAdminManage();
$settings = get_option( SPINKX_CONTENT_LICENSE );
$settings = maybe_unserialize( $settings );
$registration_complete = true;
$settings['site_id'] = isset($settings['site_id'])?$settings['site_id']:0;
$site_id = $settings['site_id'];
$settings['license_code'] = isset($settings['license_code'])?$settings['license_code']:'';
$settings['reg_email'] = isset($settings['reg_email'])?$settings['reg_email']:'';
$settings['due_date'] = isset($settings['due_date'])?$settings['due_date']:'0000-00-00 00:00:00';

if( $settings['due_date'] != '0000-00-00 00:00:00' ) {
	if (!(isset($settings['after_registration_sync']) && $settings['after_registration_sync'])) {
		$settings['site_url'] = $spnxAdminManage->spinkx_cont_get_site_url();
		$settings['after_registration_sync'] = TRUE;
		$response = $spnxAdminManage->spinkx_cont_post_sync($settings);
		update_option(SPINKX_CONTENT_LICENSE, maybe_serialize($settings));
	}
} else {
	//$registration_complete = false;
}
$custom_date = $spnxAdminManage->spinkx_cont_last_30_days();
$from_date = date('Y-m-d', $custom_date[0]);
$to_date = date('Y-m-d', $custom_date[1]);
$todaydate = $custom_date[2] * 1000;
$custom_css = ' 
 #bwki_widgets_display.widefat tr,
	#bwki_widgets_display.widefat td,
	#bwki_widgets_display.widefat th
	{
		vertical-align: middle;
		text-align: center;
	}
	select[name=bwki_widgets_display_length] {
		width: 62px;
	}
	.widefat{
		word-wrap:	normal;
	}
	.notice{ display:none !important;}
	';
$table_js = '';
 if( $registration_complete	) {
	 $table_js = 'var table = jQuery("#bwki_widgets_display").DataTable({
			"pageLength": 10,
			"lengthMenu": [ 5, 10, 20, 50, 100 ],
			"bFilter": false,
			"order": [],
			"bSort": false,			
			});';
 }
$custom_js = $table_js ;
$custom_js .= '		
		var $ = jQuery.noConflict();
		$(document).ready(function(){			
			jQuery("#daterange").dateRangePicker({container: "#daterange-picker-container",numberOfMonths: 3,datepickerShowing: true, maxDate: "0D",minDate: new Date(2016, 8, 01),test: true,today: '.$todaydate.'}); });';
$vendor = SPINKX_CONTENT_PLUGIN_URL.'/vendor/';
wp_enqueue_script( 'jquery-countdown-js', $vendor . 'jQuery-countdown/js/jquery.countdown.min.js' );
wp_add_inline_script( 'jquery-countdown-js', $custom_js );
if( $registration_complete ) {
	?>
	<div id="widget_data" style="min-height: 475px;">
		<?php
			$tab = spnxHelper::getFilterVar('tab');
			$widget_id = spnxHelper::getFilterVar('widget_id');
			if (empty($tab) && empty($widget_id)) {
				$url = SPINKX_CONTENT_BAPI_URL . '/wp-json/spnx/v1/widget/' . $settings['site_id'] . '/' . md5($settings['license_code']);
				$wp_output = wp_remote_post($url,
					array(
						'method' => 'GET',
						'body' => array('from_date' => $from_date, 'to_date' => $to_date),
					)
				);
				if (!is_wp_error($wp_output)) {
					$result = json_decode($wp_output['body']);
				}

                $checked = '';
				if ('License Invalid' !== $result) {
                    if( $settings['due_date'] != '0000-00-00 00:00:00' ) {
                        //echo $spnxAdminManage->spinkx_cont_widget_exists();
                        if($spnxAdminManage->spinkx_cont_widget_exists()) {
                            $checked = 'checked="checked"';
                        }
					?>
                        <input type="checkbox" name="widget_install" value="1" style="margin-top: 16px;" <?php echo $checked?>/>
                        <label style="margin-left: 8px;margin-top:  20px;">Desktop Widget Install</label>
                        <div class="add_widget_button">+ Add New Widget</div>
                        <div class="clear" style="display: block; overflow: hidden;"></div>
					<div id="add_new_widget" style="display:none;margin-top: 26px;">
						<?php require SPINKX_CONTENT_ADMIN_VIEW_DIR .  'widgets/new-widget.php'; ?>
					</div>
	<div class="wdgt_mn_cntnr_spkx">
	    <div class="wdgt_lft_mn_cntnr_spkx">
			 <div class="wdgt_hdr_mn_hldr_spkx">
				<span>
					<i class="fas fa-desktop"></i>
					<span class="lft_lbl_cls">Desktop Widget</span>
					
				</span>
				<span>
					<span class="rght_lbl_cls">Active Status</span>
					<span class="icn_lbl_cls">
						<div class="onoffswitch">
	                        <input type="checkbox" checked="" id="playpauseswitch_1840" class="onoffswitch-checkbox widget-checkbox" data-id="1840" name="playpauseswitch_1840">
	                        <label for="playpauseswitch_1840" class="onoffswitch-label">
	                            <span class="onoffswitch-inner"></span>
	                            <span class="onoffswitch-switch"></span>
	                        </label>
                       </div> 
					</span>
				</span>
			 </div>
			 <div class="wdgt_cntnt_mn_hldr_spkx">
				<div class="wdgt_cntnt_sub_hldr">
					<div class="wdgt_cmn_cls_algn_txt">
						<span>Widget Name</span>
						<span>My First Widget</span>
					</div>
					<div class="wdgt_cmn_cls_algn_txt">
						<span>Shortcode</span>
						<span class="shrtcode_fnt_cls">[spinkx id="1840"]</span>
					</div>
					<div class="wdgt_cmn_cls_algn_txt">
						<span>Design</span>
						<span class="clr_cmn_wdgt">Edit</span>
					</div>
					<div class="wdgt_cmn_cls_algn_txt wdgt_glbl_pst_clas">
						<div class="frst_chld_wdgt_glbl_pst_clas">Content Distribution</div>
						<div class="secnd_chld_wdgt_glbl_pst_clas">
							<div>
								<span>Local Post</span>
								<span class="icn_lbl_cls">
									<div class="onoffswitch">
				                        <input type="checkbox" checked="" id="playpauseswitch_1840" class="onoffswitch-checkbox widget-checkbox" data-id="1840" name="playpauseswitch_1840">
				                        <label for="playpauseswitch_1840" class="onoffswitch-label">
				                            <span class="onoffswitch-inner"></span>
				                            <span class="onoffswitch-switch"></span>
				                        </label>
                                     </div> 
								</span>
							</div>
							<div>
								<span>Advertisment</span>
								<span class="icn_lbl_cls">
									<div class="onoffswitch">
				                        <input type="checkbox" checked="" id="playpauseswitch_1840" class="onoffswitch-checkbox widget-checkbox" data-id="1840" name="playpauseswitch_1840">
				                        <label for="playpauseswitch_1840" class="onoffswitch-label">
				                            <span class="onoffswitch-inner"></span>
				                            <span class="onoffswitch-switch"></span>
				                        </label>
                                     </div> 
								</span>
							</div> 						
							<div>
								<span>Global Post</span>
								<span class="icn_lbl_cls">
									 <div class="onoffswitch">
				                        <input type="checkbox" checked="" id="playpauseswitch_1840" class="onoffswitch-checkbox widget-checkbox" data-id="1840" name="playpauseswitch_1840">
				                        <label for="playpauseswitch_1840" class="onoffswitch-label">
				                            <span class="onoffswitch-inner"></span>
				                            <span class="onoffswitch-switch"></span>
				                        </label>
                                     </div> 
								</span>
								<span class="edit_cat_spnx_wdgt clr_cmn_wdgt">Edit Categories</span>

								
							</div>
							<div class="cat_wdgt_mn_cntnr_spkx">
								
								<div class="acc-mn-dv-cntainr">
									<div class="acc-sec-dv-mn-cntnr">
										<?php
	                                    $global_blocked_categories_textarea2 = explode(',', $global_blocked_categories_textarea);
	                                    foreach($categories as $key=>$category) { ?>
											<div class="cmn-cls-cntnr">
											<div class="mn-txt-cmn-dv ">
												<i class="fas fa-chevron-right"></i><span><?php echo $category[0];?></span></div>

	                                            <div class="sb-ctgry-cmn-cls">
	                                                <ul class="ul-mn-cls-chkbx">
	                                                    <li><a href="javascript:;void(0)" class="chkbx-cmn-cls-li select-deselect" style="color: #337ab7 !important;box-sizing: border-box;font-size: 9px;font-weight: 300;text-transform: capitalize;">Select All</a><input type="hidden" value="0" /></li>

	                                                    <?php foreach ($category[1] as $skey => $svalue) {
	                                                        $checked = '';
	                                                        if(in_array($skey, $global_blocked_categories_textarea2)) {
	                                                            $checked = 'checked';
	                                                        }
	                                                        ?>

	                                                        <li> <span class="chkbx-cmn-cls-li"><input  type="checkbox" name="global_blocked_categories_textarea[]" value="<?php echo $skey?>" <?php echo $checked?>></span><?php echo $svalue?>
	                                                        </li>
	                                                    <?php } ?>
	                                                </ul>
	                                            </div>

										</div>

									<?php } ?>

									</div>
								</div>
						    </div>

					    </div>
					</div>
				</div>
			</div>
		</div>
		 <div class="mp_cntnt_sub_hldr">
		        <div class="wdgt_hdr_mn_hldr_spkx">
				<span>
					<i class="fas fa-desktop"></i>
					<span class="lft_lbl_cls">Desktop Widget</span>
				</span>
				<span>
					<span class="rght_lbl_cls">Active Status</span>
					<span class="icn_lbl_cls">
						<div class="onoffswitch">
	                        <input type="checkbox" checked="" id="playpauseswitch_1840" class="onoffswitch-checkbox widget-checkbox" data-id="1840" name="playpauseswitch_1840">
	                        <label for="playpauseswitch_1840" class="onoffswitch-label">
	                            <span class="onoffswitch-inner"></span>
	                            <span class="onoffswitch-switch"></span>
	                        </label>
                        </div>
					</span>
				</span>
			    </div>
				<div class="grph_wdgt_cntnr">
					<img src="../wp-content/plugins/spinkx-content-marketing/assets/images/graph_image.png" />
				</div>	
	     </div>
	</div>
	<div class="wdgt_mn_cntnr_spkx">
	    <div class="wdgt_lft_mn_cntnr_spkx">
			 <div class="wdgt_hdr_mn_hldr_spkx">
				<span>
					<i class="fas fa-mobile-alt"></i>
					<span class="lft_lbl_cls">Mobile Widget</span>
				</span>
				<span>
					<span class="rght_lbl_cls">Active Status</span>
					<span class="icn_lbl_cls">
						<div class="onoffswitch">
	                        <input type="checkbox" checked="" id="playpauseswitch_1840" class="onoffswitch-checkbox widget-checkbox" data-id="1840" name="playpauseswitch_1840">
	                        <label for="playpauseswitch_1840" class="onoffswitch-label">
	                            <span class="onoffswitch-inner"></span>
	                            <span class="onoffswitch-switch"></span>
	                        </label>
                       </div> 
					</span>
				</span>
			 </div>
			 <div class="wdgt_cntnt_mn_hldr_spkx">
				<div class="wdgt_cntnt_sub_hldr">
					<div class="wdgt_cmn_cls_algn_txt">
						<span>Widget Name</span>
						<span>My First Widget</span>
					</div>
					<div class="wdgt_cmn_cls_algn_txt">
						<span>Shortcode</span>
						<span class="shrtcode_fnt_cls">[spinkx id="1840"]</span>
					</div>
					<div class="wdgt_cmn_cls_algn_txt">
						<span>Design</span>
						<span class="clr_cmn_wdgt">Edit</span>
					</div>
					<div class="wdgt_cmn_cls_algn_txt wdgt_glbl_pst_clas">
						<div class="frst_chld_wdgt_glbl_pst_clas">Content Distribution</div>
						<div class="secnd_chld_wdgt_glbl_pst_clas">
							<div>
								<span>Local Post</span>
								<span class="icn_lbl_cls">
									<div class="onoffswitch">
				                        <input type="checkbox" checked="" id="playpauseswitch_1840" class="onoffswitch-checkbox widget-checkbox" data-id="1840" name="playpauseswitch_1840">
				                        <label for="playpauseswitch_1840" class="onoffswitch-label">
				                            <span class="onoffswitch-inner"></span>
				                            <span class="onoffswitch-switch"></span>
				                        </label>
                                     </div> 
								</span>
							</div>
							<div>
								<span>Advertisment</span>
								<span class="icn_lbl_cls">
									<div class="onoffswitch">
				                        <input type="checkbox" checked="" id="playpauseswitch_1840" class="onoffswitch-checkbox widget-checkbox" data-id="1840" name="playpauseswitch_1840">
				                        <label for="playpauseswitch_1840" class="onoffswitch-label">
				                            <span class="onoffswitch-inner"></span>
				                            <span class="onoffswitch-switch"></span>
				                        </label>
                                     </div> 
								</span>
							</div> 						
							<div>
								<span>Global Post</span>
								<span class="icn_lbl_cls">
									 <div class="onoffswitch">
				                        <input type="checkbox" checked="" id="playpauseswitch_1840" class="onoffswitch-checkbox widget-checkbox" data-id="1840" name="playpauseswitch_1840">
				                        <label for="playpauseswitch_1840" class="onoffswitch-label">
				                            <span class="onoffswitch-inner"></span>
				                            <span class="onoffswitch-switch"></span>
				                        </label>
                                     </div> 
								</span>
								<span class="edit_cat_spnx_wdgt clr_cmn_wdgt">Edit Categories</span>

								
							</div>
							<div class="cat_wdgt_mn_cntnr_spkx">
								
								<div class="acc-mn-dv-cntainr">
									<div class="acc-sec-dv-mn-cntnr">
										<?php
	                                    $global_blocked_categories_textarea2 = explode(',', $global_blocked_categories_textarea);
	                                    foreach($categories as $key=>$category) { ?>
											<div class="cmn-cls-cntnr">
											<div class="mn-txt-cmn-dv ">
												<i class="fas fa-chevron-right"></i><span><?php echo $category[0];?></span></div>

	                                            <div class="sb-ctgry-cmn-cls">
	                                                <ul class="ul-mn-cls-chkbx">
	                                                    <li><a href="javascript:;void(0)" class="chkbx-cmn-cls-li select-deselect" style="color: #337ab7 !important;box-sizing: border-box;font-size: 9px;font-weight: 300;text-transform: capitalize;">Select All</a><input type="hidden" value="0" /></li>

	                                                    <?php foreach ($category[1] as $skey => $svalue) {
	                                                        $checked = '';
	                                                        if(in_array($skey, $global_blocked_categories_textarea2)) {
	                                                            $checked = 'checked';
	                                                        }
	                                                        ?>

	                                                        <li> <span class="chkbx-cmn-cls-li"><input  type="checkbox" name="global_blocked_categories_textarea[]" value="<?php echo $skey?>" <?php echo $checked?>></span><?php echo $svalue?>
	                                                        </li>
	                                                    <?php } ?>
	                                                </ul>
	                                            </div>

										</div>

									<?php } ?>

									</div>
								</div>
						    </div>

					    </div>
					</div>
				</div>
			</div>
		</div>
		 <div class="mp_cntnt_sub_hldr">
		        <div class="wdgt_hdr_mn_hldr_spkx">
					<span>
						<i class="fas fa-mobile-alt"></i>
						<span class="lft_lbl_cls">Mobile Widget</span>
					</span>
					<span>
						<span class="rght_lbl_cls">Active Status</span>
						<span class="icn_lbl_cls">
							<div class="onoffswitch">
		                        <input type="checkbox" checked="" id="playpauseswitch_1840" class="onoffswitch-checkbox widget-checkbox" data-id="1840" name="playpauseswitch_1840">
		                        <label for="playpauseswitch_1840" class="onoffswitch-label">
		                            <span class="onoffswitch-inner"></span>
		                            <span class="onoffswitch-switch"></span>
		                        </label>
	                        </div>
						</span>
					</span>
			    </div>
				<div class="grph_wdgt_cntnr">
					<div class="cntnt_dstr_cntnr">
						<div class="lft_cntnr_sb_cntnr">
							<div class="cmn_wdgt_tb_mn_cntnr">
								<div><i class="fas fa-tachometer-alt cmn_icn_dst"></i>Widget Styling
								<i class="fas fa-chevron-right"></i>
							    </div>
								<div class="wdgt_hdn_cntnt_spkx_cntnr mr_wdt_dst_cmn_cls_spx_ws">
									<div class="mb_sd_cm_cl">
										<span>Widget Name</span>
										<input type="text" id="widget_name" value="My First Widget" name="widget_name" placeholder="Widget Name Here" required="">
									</div>
									<div>
										<span>Background Color</span>
										
										 <div class="clr_pic_cmn_cls">
                                        	<input type="text" id="bg_color" value="transparent" name="unit_bg_color" placeholder="transparent" class="colorPicker evo-cp0" />
                                        </div>
										
									</div>
									<div class="shrtcode_fnt_cls cntnt_dstr_shrt_cde " style="display: none;">
										[spinkx id = "1840"]
										<input type="hidden" id="main_widget_id" value="1840" name="main_widget_id" placeholder="" readonly="">
										<input type="hidden" id="add_shortcode" value="[spinkx id=1840]" name="add_shortcode" placeholder="Shortcode">
									</div>	
								</div>
							</div>
							<div class="cmn_wdgt_tb_mn_cntnr">
								<div>
									<i class="fas fa-eraser cmn_icn_dst"></i>Choose Style
								    <i class="fas fa-chevron-right"></i>
						        </div>
								<div class="wdgt_hdn_cntnt_spkx_cntnr">
									<div class="mb_sd_cm_cl">
										
										<input type="radio" id="widget_layout_type" class="widget_layout_masonary" name="widget_layout_type" checked="" value="masonry" />
										<strong>Pinterest style </strong>
									</div>
									<div>
										<input type="radio" id="widget_layout_type" class="widget_layout_fixed" name="widget_layout_type" value="fixed-width" />
										<strong>Fixed Width &amp; Height </strong>

										<div id="widget-fixed-input" class="wdget_fxd_hgt_cntnr" style="display: none">
											<div>
												<span class="mn_wdth_dstr_cmn_cls">No of Row</span>
												<input type="number" name="no_of_row" id="no_of_row" min="1" max="10" value="0">
											</div>
											<div>
												<span class="mn_wdth_dstr_cmn_cls">No of Columns</span>
												<input type="number" name="no_of_columns" id="no_of_columns" value="1">
											</div>
											
											
										</div>
									</div>
								</div>
							</div>
							<div class="cmn_wdgt_tb_mn_cntnr">
								<div> 
									<i class="fas fa-columns cmn_icn_dst"></i>Number of Columns Desktop View
								    <i class="fas fa-chevron-right"></i>
								</div>
								
									<div class="wdgt_hdn_cntnt_spkx_cntnr">
										<input type="number" id="result1" value="1" name="no_of_columns" placeholder="1" readonly="">
					                    <input type="hidden" id="mob_views" name="no_col_mob_view" value="1">
                                        <div id="slider-range-min" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
						                <div class="ui-slider-range ui-widget-header ui-slider-range-min" style="width: 0%;"></div>
										<a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 16.6667%;"></a>
					                   <div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="width: 16.6667%;">
					                   </div>
					                   </div>
									</div>
							</div>
							<div class="cmn_wdgt_tb_mn_cntnr" style="display: none;">
								<div>
									<i class="fa fa-list-alt cmn_icn_dst" aria-hidden="true"></i>Unit Size
									<i class="fas fa-chevron-right"></i>
								</div>
								<div class="wdgt_hdn_cntnt_spkx_cntnr mr_wdt_dst_cmn_cls_spx">
									<div class="mb_sd_cm_cl">
										<span>Width</span>
										<input id="img_crop_width" type="number" value="236" name="img_crop_width" placeholder="236" readonly="readonly" style="cursor: not-allowed;"> 
										<span class="wdgt_px_cmn_cls_spx"> px</span> 
									</div>
									<div>
										<span>Height</span> 
										<input id="img_crop_height" type="number" value="300" name="img_crop_height" placeholder="300" readonly="readonly" style="cursor: not-allowed;"> 
										<span class="wdgt_px_cmn_cls_spx">px</span>
									</div>

								</div>
							</div>
							<div class="cmn_wdgt_tb_mn_cntnr" style="display: none;">
								<div>
									<i class="fa fa-list-alt cmn_icn_dst" aria-hidden="true"></i>Unit Spacing
									<i class="fas fa-chevron-right"></i>
								</div>
								<div class="wdgt_hdn_cntnt_spkx_cntnr mr_wdt_dst_cmn_cls_spx">
									<div>
										<span>Pixel </span>
										<input type="number" max="40" min="4" name="unit_spacing" value="20" id="unit_spacing" >
										 <span class="wdgt_px_cmn_cls_spx">px</span>
									</div>
								</div>
							</div>
							<div style="display: none;">COLOR & DISPLAY</div>	
							<div class="cmn_wdgt_tb_mn_cntnr" style="display: none;">
								<div>
									<i class="fas fa-tachometer-alt cmn_icn_dst"></i>Widget Background Color
									<i class="fas fa-chevron-right"></i>
								</div>
								<div class="wdgt_hdn_cntnt_spkx_cntnr">
									<div>
										<input type="text" id="bg_color" value="transparent" name="unit_bg_color" placeholder="transparent" class="colorPicker evo-cp0">
										
									</div>
								</div>
							</div>
							<div class="cmn_wdgt_tb_mn_cntnr" style="display: none;">
								<div>
									<i class="fa fa-list-alt cmn_icn_dst" aria-hidden="true"></i>Unit Foreground Color
								    <i class="fas fa-chevron-right"></i>
								</div>
								<div class="wdgt_hdn_cntnt_spkx_cntnr">
									<div>
										<input type="text" id="fg_color" value="#fefefe" name="unit_fg_color" placeholder="#fefefe" class="colorPicker evo-cp1">
										
								   </div>
								</div>
							</div>
							<div class="cmn_wdgt_tb_mn_cntnr">
								<div>
									<i class="fa fa-list-alt cmn_icn_dst" aria-hidden="true"></i>Unit Styling
									<i class="fas fa-chevron-right"></i>
								</div>
								<div class="wdgt_hdn_cntnt_spkx_cntnr mr_wdt_dst_cmn_cls_spx_brdr">
									
									<div class="mb_sd_cm_cl">
										<span>Border Width</span>
										<input type="number" id="unit_border_width" value="1" name="unit_border_width" min="0" max="45">
										<span class="wdgt_px_cmn_cls_spx">px</span>
									</div>
									<div class="mb_sd_cm_cl">
										<span>Border Style</span>
                                        <select id="unit_border_style" name="unit_border_style">
									         <option value="none">none</option>
										     <option value="dotted">dotted</option>
										     <option value="dashed">dashed</option>
										     <option selected="" value="solid">solid</option>
								         </select>
									</div>
                                      
	        					  	<div class="mb_sd_cm_cl">
	        					  		<span>Border Color</span>
							           <div class="clr_pic_cmn_cls">
                                        	<input type="text" id="unit_border_color" value="#d8d8d8" name="unit_border_color" placeholder="#d8d8d8" class="">
                                        </div>
							        </div>
						             <div class="mb_sd_cm_cl">
									 	<span>Border Radius</span>
									 	<input type="number" id="unit_border_radius" value="6" name="unit_border_radius" min="0" max="45">
									 	<span class="wdgt_px_cmn_cls_spx">px</span>
									</div>
									<div class="mb_sd_cm_cl">
										<span>Pixel </span>
										<input type="number" max="40" min="4" name="unit_spacing" value="20" id="unit_spacing" >
										 <span class="wdgt_px_cmn_cls_spx">px</span>
									</div>
									<div class="mb_sd_cm_cl">
										<span>Width</span>
										<input id="img_crop_width" type="number" value="236" name="img_crop_width" placeholder="236" readonly="readonly" style="cursor: not-allowed;"> 
										<span class="wdgt_px_cmn_cls_spx"> px</span> 
									</div>
									<div class="mb_sd_cm_cl">
										<span>Height</span> 
										<input id="img_crop_height" type="number" value="300" name="img_crop_height" placeholder="300" readonly="readonly" style="cursor: not-allowed;"> 
										<span class="wdgt_px_cmn_cls_spx">px</span>
									</div>
									<div >
										<span>Foreground Color</span>
										<input type="text" id="fg_color" value="#fefefe" name="unit_fg_color" placeholder="#fefefe" class="colorPicker evo-cp1">
										
								   </div>
								</div>
							</div>
							<div class="cmn_wdgt_tb_mn_cntnr" style="display: none;">
								<div>
									<i class="fa fa-list-alt cmn_icn_dst" aria-hidden="true"></i>Unit Corner Radius
									<i class="fas fa-chevron-right"></i>
								</div>
								 <div class="wdgt_hdn_cntnt_spkx_cntnr mr_wdt_dst_cmn_cls_spx_brdr" >
								 	<div>
									 	<span>Border Radius</span>
									 	<input type="number" id="unit_border_radius" value="6" name="unit_border_radius" min="0" max="45">
									 	<span class="wdgt_px_cmn_cls_spx">px</span>
									</div>
								 </div>
							</div>
							<div style="display: none;">TEXT FONT & COLOR</div>
							<div class="cmn_wdgt_tb_mn_cntnr">
								<div> 
									<i class="fas fa-edit cmn_icn_dst"></i>Headline Styling
								    <i class="fas fa-chevron-right"></i>
								</div>
								<div class="wdgt_hdn_cntnt_spkx_cntnr mr_wdt_dst_cmn_cls_hf">
									<div class="mb_sd_cm_cl">
										<span>Font Size</span>
										<input type="number" id="unit_title_font_size" value="14" name="unit_title_font_size" min="0" max="60">
										<span class="wdgt_px_cmn_cls_spx">px</span>
										
									</div>
									<div class="mb_sd_cm_cl">
										<span>Line Height</span>
	                                    <input type="number" id="unit_title_line_height" value="18" name="unit_title_line_height" min="0" max="90">
	                                    <span class="wdgt_px_cmn_cls_spx">px</span>
									</div>
									<div class="mb_sd_cm_cl">
										<span>Font Weight</span>
										<select id="unit_title_font_style" name="unit_title_font_style" class="font_style">
											<option value="lighter">lighter</option>
											<option value="normal">normal</option>
											<option selected="" value="bold">bold</option>
											<option value="bolder">bolder</option>
									   </select>
									</div>
						            <div class="mb_sd_cm_cl">
										 <span>Text Transform</span>
                                         <select id="unit_title_font_case" name="unit_title_font_case" class="font_case">
											<option selected="" value="none">none</option>
											<option value="uppercase">uppercase</option>
											<option value="lowercase">lowercase</option>
											<option value="Capitalize">Capitalize</option>
											<option value="full-width">full-width</option>
										 </select>
									</div>
									<div class="mb_sd_cm_cl">
										<span>Font Color</span>
										<div class="clr_pic_cmn_cls">
                                        	<input type="text" id="unit_title_font_color" value="#d8d8d8" name="unit_title_font_color" placeholder="#d8d8d8" class="">
                                        </div>
									</div>
									<div>
										<span>Line Style</span>
										<select id="unit_add_line_style" name="unit_add_tall_style" class="line-style-tall" style="width:150px;">
											<option value="aboveimg">Above Image</option>
											<option selected="" value="belowimg">Below Image</option>
										</select>
								    </div>
									<div>
										<p style="display:none">Google Font:
										<select id="unit_title_font_family" name="unit_title_font_family">
											<option selected="" value="Carrois Gothic">Carrois Gothic</option>
											<option value="Open Sans">Open Sans</option>
											<option value="Arial">Arial</option>
										</select>
									    </p>
	                                   
									</div>
									
								</div>
							</div>
							<div class="cmn_wdgt_tb_mn_cntnr" style="display: none;">
								<div>
									<i class="fas fa-edit cmn_icn_dst"></i>Headline Placement
								    <i class="fas fa-chevron-right"></i>
								</div>
								<div class="wdgt_hdn_cntnt_spkx_cntnr mr_wdt_dst_cmn_cls_spx_hp">
									<div>
										<span>Line Style</span>
										<select id="unit_add_line_style" name="unit_add_tall_style" class="line-style-tall" style="width:150px;">
											<option value="aboveimg">Above Image</option>
											<option selected="" value="belowimg">Below Image</option>
										</select>
								    </div>
								</div>
							</div>
							<div class="cmn_wdgt_tb_mn_cntnr">
								<div> 
									<i class="fas fa-file-alt cmn_icn_dst"></i>Excerpt Styling
								    <i class="fas fa-chevron-right"></i>
								</div>
								<div class="wdgt_hdn_cntnt_spkx_cntnr mr_wdt_dst_cmn_cls_hf">
									<div class="mb_sd_cm_cl">
										<span>Font Size</span>
										<input type="number" id="unit_excerpt_font_size" value="14" name="unit_excerpt_font_size" min="0" max="60">
									    <span class="wdgt_px_cmn_cls_spx">px</span>
									</div>
									<div class="mb_sd_cm_cl">
										<span>Line Height</span>
										<input type="number" id="unit_excerpt_line_height" value="18" name="unit_excerpt_line_height" min="0" max="90">
                                        <span class="wdgt_px_cmn_cls_spx">px</span>
									</div>
									<div class="mb_sd_cm_cl">
										<span>Font Weight</span>
										<select id="unit_excerpt_font_style" name="unit_excerpt_font_style" class="font_style">
											<option value="lighter">lighter</option>
											<option selected="" value="normal">normal</option>
											<option value="bold">bold</option>
											<option value="bolder">bolder</option>
									    </select>
									</div>
									<div class="mb_sd_cm_cl">
										<span>Text Transform</span>
										<select id="unit_excerpt_font_case" name="unit_excerpt_font_case" class="font_case">
											<option selected="" value="none">none</option>
											<option value="uppercase">uppercase</option>
											<option value="lowercase">lowercase</option>
											<option value="Capitalize">Capitalize</option>
											<option value="full-width">full-width</option>
									   </select>
									</div>
                                    <div class="mb_sd_cm_cl">
                                    	<span>Font Color</span>
                                        <div class="clr_pic_cmn_cls">
                                        	<input type="text" id="unit_excerpt_font_color" value="#d8d8d8" name="unit_excerpt_font_color" placeholder="#d8d8d8" class="">
                                        </div>
                                        
									</div>
									<div class="mb_sd_cm_cl">
										<span>Excerpt</span>
										<select id="excerpt_add_line_style" name="unit_excerpt_tall_style" title="line-style" class="line-style-tall" style="width:150px;">
											<option value="aboveimg">Above Image</option>
											<option selected="" value="belowimg">Below Image</option>
										</select>
								   </div>
								   <div>
										<span>Excerpt Limit</span>
										<input type="number" id="unit_excerpt_word_limitt" value="100" name="unit_excerpt_word_limit" placeholder="100">
									</div>
									<div style="display:none">
										<span></span>
										<p >Google Font:
										<select id="unit_excerpt_font_family" name="unit_excerpt_font_family">
											<option selected="" value="Carrois Gothic">Carrois Gothic</option>
											<option value="Open Sans">Open Sans</option>
											<option value="Arial">Arial</option>
										</select>
									   </p>
									</div>
									
									
								</div>
							</div>
							<div class="cmn_wdgt_tb_mn_cntnr" style="display: none;">
								<div>
									<i class="fas fa-file-alt cmn_icn_dst"></i>Excerpt Placement
								    <i class="fas fa-chevron-right"></i>
								</div>
								<div class="wdgt_hdn_cntnt_spkx_cntnr mr_wdt_dst_cmn_cls_spx">
									<div>
										<span>Excerpt</span>
										<select id="excerpt_add_line_style" name="unit_excerpt_tall_style" title="line-style" class="line-style-tall" style="width:150px;">
											<option value="aboveimg">Above Image</option>
											<option selected="" value="belowimg">Below Image</option>
										</select>
								   </div>
								</div>
							</div>
							<div class="cmn_wdgt_tb_mn_cntnr" style="display: none;">
								<div>
									<i class="fas fa-file-alt cmn_icn_dst"></i>Excerpt Character Limit
								    <i class="fas fa-chevron-right"></i>
								</div>
								<div class="wdgt_hdn_cntnt_spkx_cntnr mr_wdt_dst_cmn_cls_spx_brdr">
									<div>
										<span>Excerpt Limit</span>
										<input type="number" id="unit_excerpt_word_limitt" value="100" name="unit_excerpt_word_limit" placeholder="100">
									</div>	
								</div>
							</div>
							<div class="wdgt_updt_btn_mn_cntnr">
								<div class="wdgt_updt_btn_sub_cntnr">
									<a id="ajax_update_button" class="button ajax_update_button" alt="Update" href="javascript:;void(0)" style="background-color: #23bf4a;">Save</a>
									<a id="ajax_cancel_button" class="button " alt="Update" href="?page=spinkx_widget_design">Cancel</a>
									<!--  SPINKX AJAX Update Settings Ends Here  -->
									<a id="ajax_reset_button" class="button ajax_reset_button" alt="Reset" href="javascript:;void(0)">Reset Widget</a>

								</div>
							</div>
						</div>
						<div class="rght_cntnr_sb_cntnr">
							
								<div class="design_unit_main_container_spnx">
									<div class="design_unit_img_container">
										 <img src="http://localhost/wordpress/wp-content/uploads/2018/07/india-flag.png" />
									</div>
									<div class="design_unit_content_container">
										<div class="design_unit_site_view_container">
											<span>spinkx_testing</span>
											<span>
												<i class="fa fa-eye" aria-hidden="true"></i>
												0.0d
											</span>
										</div>
										<div class="design_unit_hdline_container">
											<h4>India</h4>
										</div>
										<div class="design_unit_text_continer">
											<span>
												India is a vast South Asian country with diverse terrain – from Himalayan peaks to Indian Ocean co...
											</span>
										</div>
									</div>
								</div>

								<div id="tabsp" style="display: none;">
								    <div class="tabs-content SPINKX_preview_bg" style="background: transparent;">
								    	<div id="tabsp-1" aria-labelledby="ui-id-1" class="" role="tabpanel" aria-hidden="false">
										<!----Start Masonry---->
											<div class="masonry-grid" style="background: transparent; display: block; position: relative; height: 0px;">

												<div class="SPINKX_preview_fg grid-item grid-item--height" style="height: 300px; background: rgb(254, 254, 254); border-width: 1px; border-style: solid; border-color: rgb(216, 216, 216); border-radius: 6px; margin-bottom: 8px; width: 236px !important; position: absolute; transition-property: transform, opacity; transition-duration: 0.4s;">		
													<!-- block Start -->
													<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: 14px; line-height: 18px; font-weight: bold; color: #000000; font-family: Carrois Gothic text-transform: none;display: none;">India</h4>
													<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg excerpt_content_1" id="content" style="font-size: 14px; line-height: 18px;display: none; color:#333333; text-transform: none; font-weight: normal;">
														India is a vast South Asian country with diverse terrain – from Himalayan peaks to Indian Ocean co...		</p>
													<div class="pre-img">
														<img src="http://localhost/wordpress/wp-content/uploads/2018/07/india-flag.png" alt="">
													</div>
													<div class="site_name" style="font-size: 10px;padding: 5px 3px;color: grey;display: block;line-height: normal; width:100%; ">
														<span style="max-width:60%;float:left;margin:0;padding-left: 6px">spinkx_testing
														</span>
														<span style="float:right;padding-right:3px;">     <i style="margin-right: 2px;" class="fa fa-eye" aria-hidden="true"></i>0.0d</span></div>
													<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: 14px; line-height: 18px; font-weight: bold; color: #000000; font-family: Carrois Gothic text-transform: none;display: block;">India</h4>

													
													<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg excerpt_content_1" id="content" style="font-size: 14px; line-height: 18px;display: block; color:#333333; text-transform: none; font-weight: normal;">
														India is a vast South Asian country with diverse terrain – from Himalayan peaks to Indian Ocean co...		</p>
													<ul class="likes">
													</ul>
												</div>
										    </div>
									<!----End masonry----->
		                               </div>
								    </div>	

								</div>
					
							
						</div>
					</div>	
				</div>	
	     </div>
	</div>

	
                    <?php } ?>
					<?php echo $result  . '<div style="text-align:center" id="install_guide">
			<a href="http://www.spinkx.com/how-to-install-guide/" style="text-decoration: none;color: #4bacc6;font-weight: 800;font-size: 18px; cursor: pointer;" target="_blank">How to Install Guide</a>
		</div>';
				} else {
					echo sprintf($result);
				}
			} else {
				?>
				<div class="clear" style="display: block; overflow: hidden;"></div>
				<div id="update_new_widget" style="margin-top: 26px;">
					<?php require SPINKX_CONTENT_ADMIN_VIEW_DIR .  'widgets/update-widget.php'; ?>
				</div>
			<?php } ?>
	</div>
	<?php
} else {
	echo '<div id="widget_data" style="min-height: 475px; position: absolute; top:100px;left:100px;">You are not registered on Spinkx! Please <a href="?page=spinkx-site-register.php">register</a> first.</div>';
}