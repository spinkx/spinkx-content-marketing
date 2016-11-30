<?php
	/**
	 * Created by PhpStorm.
	 * User: t001
	 * Date: 30/11/16
	 * Time: 2:07 PM
	 */

?>
<div class="modal-dialog">

	<!-- Modal content-->
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"><strong>Create New Ad</strong></h4>
		</div>
		<form method="post" enctype="multipart/form-data" id="c_form1"  >
			<div class="modal-body">
				<div id="left_div_modal_body" >
					<div>
						<div class="form-group cls-padding-left">
							<label class="sub-heading">Campaign Name</label><br/>
							<input type="text" name="campaign_display_name" data-validation="required" data-validation-error-msg="Enter the display name for your Ad" value="<?php echo $campaign->campaign_display_name?>">
						</div>

						<div class="form-group cls-padding-left">
							<label class="sub-heading">Landing Page URL</label><br/>
							<input type="text" name="website_url" data-validation="required url" data-validation-error-msg="Enter the landing page URL" value="<?php echo $campaign->landing_url?>">
						</div>

						<div class="form-group cls-padding-left">
							<label class="sub-heading">UTM Code / Tracking Pixel</label><br/>
							<input type="text" name="utm_code" value="<?php echo $campaign->utm_code?>" > <br/><br/>
							<button class="upload-image-button" id="btn_test_url" name="btn_test_url">Test Landing URL</button>
						</div>

						<div class="heading">Design your promotion</div>


						<div class="form-group cls-padding-left">
							<label class="sub-heading">Image</label>
							<input type="file" name="uploaded_image" id="uploaded-image" style="display: none" />
							<button class="upload-image-button" id="btn_upload_image" name="image_upload">Upload Image</button>
						</div>
						<div class="form-group cls-padding-left">
							<label class="sub-heading">Headline</label><br/>
							<input type="text" name="campaign_title" id="headline" value="<?php echo $campaign->campaign_title ?>">
						</div>
						<div class="form-group cls-padding-left">
							<label class="sub-heading">Text</label><br/>
							<textarea  name="campaign_description" id="campaign_description" maxlength="100" data-validation="required" data-validation-error-msg="Please give description"><?php echo $campaign->campaign_description?></textarea>
						</div>
						<div class="form-group cls-padding-left">
							<label class="sub-heading">Call to action</label>
							<select name="call_to_action" id="call_to_action" style="width:40%">
								<option value="0" <?php echo ($campaign->call_to_action == 0 || !$campaign->call_to_action)?'selected="selected"':''?>>None</option>
								<option value="1" <?php echo ($campaign->call_to_action == 1)?'selected="selected"':''?>>Apply Now</option>
								<option value="2" <?php echo ($campaign->call_to_action == 2)?'selected="selected"':''?>>Book Now</option>
								<option value="3" <?php echo ($campaign->call_to_action == 3)?'selected="selected"':''?>>Contact Us</option>
								<option value="4" <?php echo ($campaign->call_to_action == 4)?'selected="selected"':''?>>Download</option>
								<option value="5" <?php echo ($campaign->call_to_action == 5)?'selected="selected"':''?>>Know More</option>
								<option value="6" <?php echo ($campaign->call_to_action == 6)?'selected="selected"':''?>>Shop Now</option>
								<option value="7" <?php echo ($campaign->call_to_action == 7)?'selected="selected"':''?>>Sign Up</option>
								<option value="8" <?php echo ($campaign->call_to_action == 8)?'selected="selected"':''?>>Reserve</option>
								<option value="9" <?php echo ($campaign->call_to_action == 9)?'selected="selected"':''?>>Participate</option>
							</select>

						</div>
					</div>
					<?php

						$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/campaign/form-elements';
						$post['site_id'] = $settings['site_id'];
						$output = helperClass::doCurl( $url, $post );

						$output = json_decode( $output,true );
						if(isset($output['countries'])) {
							$countries = $output['countries'];
						}
						if(isset($output['categories'])) {
							$categories = $output['categories'];
						}
						if(isset($output['languages'])) {
							$languages = $output['languages'];
						}
						if(isset($output['currencyClass'])) {
							$currencyClass = $output['currencyClass'];
						}
						if(isset($output['cpm'])) {
							$cpm = $output['cpm'];
						}
						if(isset($output['cpc'])) {
							$cpc = $output['cpc'];
						}
					?>
					<div>
						<div class="heading" style="margin-top: 15px">Audience</div>
						<div class="form-group cls-padding-left">            <!-- Locations -->
							<label class="sub-heading">Country </label>
							<select name="locations[]" id="locations" multiple data-validation="required" >
								<?php
									if(isset($countries)) {
										foreach ($countries as $key => $value) {
											$selected = '';
											if ( in_array( $key, $x ) ) { $selected = 'selected="selected"'; }
											echo '<option value="' . $key . '">' . $value . '</option>';
										}
									}
								?>
							</select>
						</div>
						<div class="form-group cls-padding-left">            <!-- Locations -->
							<label class="sub-heading" >Region </label>
							<select name="states[]" id="states"  multiple  >

								<?php
									/*
									 foreach($states as $key=>$value){
										echo '<option value="'.$key.'">'.$value.'</option>';
									} */
								?>
							</select>
						</div>
						<div class="form-group cls-padding-left">            <!-- Age -->
							<label class="sub-heading">Age </label>
							<select name="age_group single-line-select"  data-validation="required" data-validation-error-msg="Please select the age group">
								<option value="" <?php echo  (! isset($campaign->campaign_age_group ) )?'selected="selected"':'';?>>Select</option>
								<option value="12 to 17" <?php echo ($campaign->campaign_age_group == '12 to 17')?'selected="selected"':'' ?>>12 to 17</option>
								<option value="18+" <?php echo ($campaign->campaign_age_group == '18+')?'selected="selected"':'' ?>>18+</option>
								<option value="Explicit" <?php echo ($campaign->campaign_age_group == 'Explicit')?'selected="selected"':'' ?>>Explicit</option>
								<option value="All" <?php echo ($campaign->campaign_age_group == 'All')?'selected="selected"':'' ?>>All</option>
							</select>
						</div>
						<div class="form-group cls-padding-left">            <!-- Gender -->
							<label class="sub-heading">Gender </label>
							<select name="gender_group" data-validation="required" data-validation-error-msg="Please select the gender group">
								<option value="" <?php echo ( ! isset($campaign->campaign_gender_group) )?'selected="selected"':'' ?>>Select</option>
								<option value="Male" <?php echo ($campaign->campaign_gender_group == 'Male')?'selected="selected"':'' ?>>Male</option>
								<option value="Female" <?php echo ($campaign->campaign_gender_group == 'Female')?'selected="selected"':'' ?>>Female</option>
								<option value="All" <?php echo ($campaign->campaign_gender_group == 'All')?'selected="selected"':'' ?>>All</option>
							</select>
						</div>
						<div class="form-group cls-padding-left">            <!-- Language -->
							<label class="sub-heading">Language </label>
							<select name="languages[]" id="languages"  data-validation="required" multiple>

								<?php
									if(isset($languages)) {
										foreach ($languages as $key => $value) {
											$selected='';
											if ( in_array( $key, $exist_language ) ) { $selected = 'selected="selected"'; }
											echo '<option value="' . $key . '">' . $value . '</option>';
										}
									}
								?>
							</select>
						</div>
						<div class="form-group cls-padding-left">            <!-- Categories -->
							<label class="sub-heading">Interests </label>
							<select name="categories[]" id="categories"  data-validation="required" multiple>
								<?php
									if(isset($categories)) {
										foreach ($categories as $key => $value) {
											$selected='';
											if ( in_array( $key, $exist_categories ) ) { $selected = 'selected="selected"'; }
											echo '<option value="' . $key . '">' . $value . '</option>';
										}
									}
								?>
							</select>
						</div>

					</div>
					<div>
						<div class="heading" st>Budget</div>
						<div class="form-group cls-padding-left">            <!--optimise -->
							<label class="sub-heading" >Optimise for:</label>
							<select name="optimise_for" style="width:50%" id="optimise_for">
								<option value="2" <?php echo ($campaign->optimise_for == 2)?'selected="selected"':''; ?>>Reach</option>
								<option value="1" <?php echo ($campaign->optimise_for == 1 || ! ($campaign->optimise_for))?'selected="selected"':''; ?>>Engagement</option>
							</select>
							<span class="sub-heading">CPM: <i class="fa <?php echo $currencyClass?> sub-heading"></i> <?php echo $cpm?></span>
							<span class="sub-heading" style="display: none">CPC: <i class="sub-heading fa <?php echo $currencyClass?>"></i> <?php echo $cpc?></span>
						</div>

						<div class="form-group cls-padding-left">            <!-- Budget -->
							<label class="sub-heading">Budget </label>
							<select id="budget_type" name="budget_type"  onchange="getbudget(this)" style="width: 35%;">
								<option value="daily" <?php echo ($campaign->campaign_budget_type == 'daily')?'selected="selected"':''?>>Daily Budget</option>
								<option value="lifetime" <?php echo ($campaign->campaign_budget_type == 'lifetime')?'selected="selected"':''?>>Lifetime Budget</option>
							</select>
							<i class="sub-heading fa <?php echo $currencyClass?>" style="display: inline; margin-left:10px"></i> <input id="budget_amount" name="budget_amount" class="track" type="text" placeholder="0" data-validation="required" data-validation-error-msg="Please give the budget amount" style="width:45%" value="<?php echo $campaign->campaign_budget_amount; ?>">
						</div>
						<div class="form-group cls-padding-left">
							<label></label>
							<div id="site_settings" style="display: none;padding-bottom: 10px;">
								<p><input type="checkbox" name="is_also_my_site" value="1"> Show Ads on my site Widget as well (you will not be charged for this if your daily budget is met with your traffic)</p>
								<p><input type="checkbox" name="is_only_my_site" value="1"> I want to show campaigns only on my site</p>
							</div>

							<div class="clear"></div>
							<!-- Schedule -->
							<?php
								$continuous = '';
								$restricted = '';
								if ( $campaign->campaign_schedule_type == 'continuous' ) {
									$continuous = 'checked';
								}
								if ( $campaign->campaign_schedule_type == 'restricted' ) {
									$restricted = 'checked';
								}
							?>
							<label  style="padding-top: 0px;display: none;">Schedule </label>
							<div id="scheduled" style="display: none;">
								<p><input type="radio" style="display: inline-block" name="schedule" value="continuous" onclick="getdaily()" <?php echo $continuous;?>> Run my ad set continuously starting today</p>
								<p><input type="radio" style="display: inline-block" name="schedule" value="restricted" onclick="getdate(this)" <?php echo $restricted;?>> Set a start date and end date</p>
							</div>
							<div id="getlifetime">
								<div class="period">
									<div class="form-group cls-padding-left">
										<div style="width: 100%">
											<label class="sub-heading" style="float: left;width: 45%">Start Date</label> <label class="sub-heading" style="width: 45%;float: right">End Date</label>
										</div>
										<div style="width: 100%">
											<div class="input-group date" id="start" style="width: 48%;float: left; margin-right: 1%">
												<input type="text" id="start_date" name="start_date" class="form-control track" value="<?php echo  $campaign->campaign_start_date?>" />	<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
											</div>


											<div class="input-group date" id="end" style="width: 48%;float: right">
												<input type="text" id="end_date" name="end_date" class="form-control track" value="<?php echo  $campaign->campaign_end_date?>" />	<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
											</div>
										</div>

									</div>

								</div><br/>
								<p class="pheading" align="center">You'll spend up to <i class="fa <?php echo $currencyClass?>"></i><span id="calculated_budget">0.00 </span> total.</p>
							</div>
						</div>

						<div class="form-group cls-padding-left" style="display:none">            <!--Pricing -->
							<?php
								$max_click = '';
								$max_price = '';
								if ( $campaign->campaign_price_type == 'max_click' ) {
									$max_click = 'checked';
								}
								if ( $campaign->campaign_price_type == 'max_price' ) {
									$max_price = 'checked';
								}
							?>
							<label class="sub-heading">Pricing</label>
							<div>
								<p>You will be charged every time someone clicks on your ad.</p>
								<p style="display: none"><input type="radio" name="price_type" value="max_click" onclick="showhidecpc(this)" checked>Get more clicks at best price</p>
								<p><input type="radio" name="price_type" value="max_price" onclick="showhidecpc(this)">Set the max you want to pay per click</p>
								<div id="cpc_input" style="display:none">
									<p style="display: none"><input type="radio" name="price_type" value="max_click" onclick="showhidecpc(this)" <?php echo $max_click; ?>>Get more clicks at best price</p>
									<p><input type="radio" name="price_type" value="max_price" onclick="showhidecpc(this)" <?php echo $max_price; ?>>Set the max you want to pay per click</p>
								</div>
							</div>
						</div>
					</div>


				</div>


				<div id="right_div_modal_body">
					<!-- widget preview -->

					<div class="SPINKX_preview_fg grid-item grid-item--height" style="width: 200px ! important; height: auto; overflow: scroll; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border-width: 1px; border-style: solid; border-color: rgb(216, 216, 216); border-radius: 10px; margin-bottom: 8px; position: absolute; transition-property: transform, opacity; transition-duration: 0.4s;">		<!-- block Start -->

						<div class="boost_img" style="position: relative;">
							<img style=" height: auto; max-width: 100%; width:100%; vertical-align: middle;" src="<?php echo $campaign->ad_image_url?>" alt="" />
							<span class="pull-right" style="font-size: 8px;color: grey;position: absolute;bottom: 1px;left:2px;">sponsored</span>
						</div>
						<div id="campaign_name" style="font-size: 8px; line-height: 8px; font-weight: 700; margin-bottom: 0px; margin-left:12px; color: grey; font-family: 'Open Sans'; display: block;"></div>
						<h4 class="boost_post_title pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: 12px; line-height: 18px; font-weight: 700; margin-bottom: 0px; margin-top:4px; margin-left:12px; color: #000000; font-family: 'Open Sans'; display: block;"><?php echo $campaign->campaign_title?></h4>

						<p class="boost_post_desc pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: 10px; line-height: 18px;display: block; padding: 0px 11px 0px 11px !important; font-family: 'Open Sans';"><?php echo $campaign->campaign_description?></p>
						<input type="button" value="<?php echo $buy_now?>" id="bbuy_now" style="    float: right; margin-right: 10px; margin-bottom: 5px; background: #f5f5f5; border: 1px solid #e3e3e3; border-radius: 4px; font-family: 'Open Sans'; font-size: 9px; padding: 2px 6px; <?php echo ($campaign->call_to_action == 0 || !$campaign->call_to_action)?'display:none':''?>"/>
					</div>

					<!-- end widget preview -->

				</div>
			</div>
			<div class="modal-footer">
				<?php
					$url = esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/campaign/add-money' );
					$post = array( 'site_id' => $settings['site_id'], 'license_code' => md5( $settings['license_code'] ), 'reg_email' => $settings['reg_email'] );

					$response = helperClass::doCurl( $url, $post );
					$response = json_decode($response);

					if($response) {
						echo do_shortcode($response);
					}
				?>
				<label class="pheading">Or</label>
				<button class="btn btn-primary" type="submit" name="add_camp">Save</button>


			</div>

	</div>
	</form>
</div>
</div>
