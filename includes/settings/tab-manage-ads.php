<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/js/' );
$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/css/' );
$css_output = ".small .modal-body { overflow-y: auto; height:600px; padding: 0; }
	#boostmodal .modal-dialog {	width:940px; height:700px; font-family: 'Open Sans'; }
	.modal-footer{ margin-top: 0; }
	.form-group{ text-align: left; }
	#left_div_modal_body { float: left; width: 400px; height: 100%; margin-left: 0; }
	.cls-padding-left { padding-left: 15px; }
	#right_div_modal_body {	width:538px; margin: 0 auto; text-align: left; height: 100%; padding: 5px 10%; background-color: silver; }
	.heading { width: 100%; background-color: #f6f7f9; border-top: 1px #e3e3e3 solid; border-bottom: 1px #e3e3e3 solid; font-size: 11px; font-weight: 700;
		margin: 15px 0; padding-top: 6px; text-transform: uppercase; padding-left: 20px; height: 30px; vertical-align: middle; }
	.pheading {	font-size: 11px; font-weight: 700; padding-top: 6px; text-transform: uppercase; height: 30px;  vertical-align: middle; color: cornflowerblue;
	}
	.sub-heading { display: inline-block; max-width: 100%; margin-bottom: 5px; font-weight: 600;  font-size: 10px; line-height: 28px; }
	.info-heading { max-width: 100%; margin-bottom: 5px; font-weight: 400;  font-size: 8px; margin-left:5px; }
	.upload-image-button { display: inline-block; max-width: 100%; margin-bottom: 5px; font-weight: 200; font-size: 10px !important; line-height: 20px; 		font-family: 'Open Sans' !important; border: 1px solid #e3e3e3; border-radius: 4px !important; background-color: #f6f7f9; }
	.form-group select { width: 40%; font-family: 'Open Sans'; font-size: 10px; font-weight: 700; height: 24px; }
	.form-group .single-line-select { width:30%; }
	.form-group { margin-bottom: 7px; }
	.form-group input[type=\"text\"], textarea { font-size: 10px !important; font-family: 'Open Sans' !important; width: 94%; border-color: #e3e3e3; box-shadow: none; }
	.select2-container-multi input[type=\"text\"] { border-color: #e3e3e3 !important;  box-shadow: none !important; font-family: 'Open Sans' !important; height: 25px !important; }
	.select2-container-multi .select2-choices { min-height:25px !important; background: none !important; border-color: #e3e3e3 !important; box-shadow: none !important; font-family: 'Open Sans' !important;  height: 25px !important; font-size: 10px; font-weight: 600; }
	#getlifetime .dropdown-menu { font-size: 10px !important; left: -10px !important; }
	.select2-container { width: 90%; }
	.btn-primary, #payment-method-button { font-family: 'Open Sans' !important; font-size: 11px !important; font-weight: 700 !important; }
	.btn-primary:hover { background-color: #469fa1; }
	#payment-method-button { background-color: #0170b6 !important; }
	.rTableHead, .rTableCell { text-align: left !important; }";
wp_enqueue_style( 'campaign-css', $css_url . 'master.css' );
wp_add_inline_style( 'campaign-css', $css_output );
wp_enqueue_style( 'bootstrap-datetimepicker-css', $css_url . 'bootstrap-datetimepicker.css' );
wp_enqueue_script( 'jquery-dateFormat-js', $js_url . 'jquery-dateFormat.min.js' );
wp_enqueue_script( 'jquery-moment-js', $js_url . 'moment.js' );
wp_enqueue_script( 'jquery-datetimepicker-js', $js_url . 'bootstrap-datetimepicker.js' );
wp_enqueue_script( 'jquery-bootstrap-js', $js_url . 'bootstrap.min.js' );
	wp_enqueue_media();
	$from_date = helperClass::getFilterVar( 'from_date' );
	$to_date = helperClass::getFilterVar( 'to_date' );
	$todaydate = null;
	$enddate = null;
	if ( $from_date && $to_date  ) {
		$todaydate = strtotime( $from_date );
		$enddate = strtotime( $to_date );
	} else {
		$url = esc_url( SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/site/get-date' );
		$post = array( 'site_id' => $settings['site_id'], 'license_code' => md5( $settings['license_code'] ) );
		$data = helperClass::doCurl( $url, $post );
		$data = json_decode( $data );

		if ( isset( $data->date ) ) {
			$todaydate = $data->date;
			$temp_today_date = strtotime('-30 days', $todaydate);
			$todaydate = $temp_today_date;
			$enddate = $data->date;
		}
	}

	if( ! $from_date ) {
		$from_date = date('Y-m-d', $todaydate);
	}
	if( ! $to_date ) {
		$to_date = date('Y-m-d', $enddate);
	}

	$custom_js = 'jQuery(function() { ';
	if ( $todaydate ) {
		$custom_js .= 'var start = moment(' . ( $todaydate * 1000 ) . ');';
		$custom_js .= 'var end = moment(' . ( $enddate * 1000 ) . ');';
	} else {
		$custom_js .= 'var start = moment();';
		$custom_js .= 'var end = moment();';
	}
	$custom_js .= 'var todaydate = start;
		function cb(start, end) {
			jQuery("#reportrange span").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));

		}
		jQuery("#reportrange").daterangepicker({
			startDate: start,
			endDate: end,
			ranges: {
				"Today": [moment(todaydate), moment(todaydate)],
				"Yesterday": [moment(todaydate).subtract(1, "days"), moment(todaydate).subtract(1, "days")],
				"Last 7 Days": [moment(todaydate).subtract(6, "days"), moment(todaydate)],
				"Last 30 Days": [moment(todaydate).subtract(29, "days"), moment(todaydate)],
				"This Month": [moment(todaydate).startOf("month"), moment(todaydate).endOf("month")],
				"Last Month": [moment(todaydate).subtract(1, "month").startOf("month"), moment(todaydate).subtract(1, "month").endOf("month")]
			}
		}, cb);

		cb(start, end);

	});
		var $ = jQuery.noConflict();
		$(document).ready(function(){
		
		
		var stoday_date = new Date().toISOString().slice(0, 10);
			$(\'#start_date\').val(stoday_date);
		var enddate = new Date(new Date().setDate(new Date().getDate() + 29)).toISOString().slice(0, 10);
			$(\'#end_date\').val(enddate);
		
			jQuery(document).on("blur","#campaign_description", function() {
			jQuery("#right_div_modal_body #content").html(jQuery(this).val());
		});
		jQuery(document).on("blur","#headline", function() {
			jQuery("#right_div_modal_body .SPINKX_preview_title_h3").html(jQuery(this).val());
		});
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$("#right_div_modal_body div.boost_img img").attr("src", e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}

		$("#uploaded-image").change(function(){
			readURL(this);
			$(".boost_img img").show();
			$(".boost_img span").show();
		});
		jQuery(".close").click(function() {
			//Code to be executed when close is clicked
			jQuery(".campaign").show();
		});
		$("#btn_upload_image").click(function(){
		$("#uploaded-image").click();
	});
	$("#btn_test_url").click(function(){
		window.open($("input[name=\"website_url\"]").val()+$("input[name=\"utm_code\"]").val());
	});
	$("input[name=\"campaign_display_name\"]").change(function () {
		var utm_campaign = $("input[name=\"campaign_display_name\"]").val();
		$("#campaign_name").html(utm_campaign);
		utm_source = "spinkx";
		$("input[name=\"utm_code\"]").val("?utm_source="+utm_source+"&utm_medium=campaign&utm_campaign="+utm_campaign);
		$(".SPINKX_preview_fg").show();
	});
	$("#payment-method-button").addClass("btn").addClass("btn-primary");

			jQuery("#reportrange").on("apply.daterangepicker", function(ev, picker) {
				//do something, like clearing an input
				//get_stat_now(picker.startDate, picker.endDate);
				updateCampaignStatics();
			});

			var table = $("#bwki_widgets_display").DataTable({
			"pageLength": 5,
			"lengthMenu": [ 5, 10, 20, 50, 100 ],
			"bFilter": false,
			"order": [],
			"bSort": false
			});
			function updateCampaignStatics(){
				var site_id = ' . $settings['site_id'] . ';
				$.ajax({
					url : ajaxurl,
					type : "get",
					datatype : "json",
					data : {
					    "action": "spinkx_cont_get_campaign_stat",
						"site_id" : site_id,
						"from_date" : jQuery("#reportrange").data("daterangepicker").startDate.format("YYYY-MM-DD"),
						"to_date" : jQuery("#reportrange").data("daterangepicker").endDate.format("YYYY-MM-DD"),
					},
					success : function(data){
						var data = JSON.parse(data);
						console.log(data);
						$.each(data,function(key,stat){
								jQuery(".impression_"+key).text( stat.impressions);
								jQuery(".clicks_"+key).text( stat.clicks);
								
								
							//});

						});
					}
				});
			}
				$("#states").select2({
				placeholder: "Select Region",
			});
			jQuery("#locations").select2({
				placeholder: "Select Country",
			}).on("change",function(e){

				$(\'#states\')
					.find(\'option\')
					.remove()
					.end();
				$("#states").select2("val", "");
				//$("#states").removeAttr("selected");
				console.log($(this).val());
				$.ajax({
					type : \'GET\',
					url : ajaxurl,
					data : {\'action\': \'spinkx_cont_camp_form_elements\',
					\'country_code\': $(this).val()
					},
					success : function(data){
						console.log(data);
						data = $.parseJSON(data);

						$.each(data,function(key,value){
							//name = $.parseHTML(value.name);
							//console.log(key + \'@\'+value);
							$("#states").append(\'<option value="\'+key+\'">\'+value+\'</option>\');
							
							//$("#states").append(\'<option value="\'+value.name+\'">\'+value.name+\'</option>\');
						});
						//console.log(data);
					}
				});

			});
			jQuery("#languages").select2({
				placeholder: "Select Languages",
			});
			jQuery("#categories").select2({
				placeholder: "Select Categories",
			});
			
			
		});';

	wp_enqueue_script( 'jquery-daterange-picker', '//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js' );
	wp_add_inline_script( 'jquery-daterange-picker', $custom_js );
	
$post = helperClass::getFilterPost();
if( is_array( $settings ) && isset($settings['site_id'])) {
	if (isset($post['add_camp'])) {
		if ($post['image_attachment_id'] > 0) {
			$image_attributes = wp_get_attachment_image_src($post['image_attachment_id'], 'medium');
			$post['ad_image_url'] = $image_attributes[0];
		}
		$post['access_key'] = $settings['license_code'];
		$post['site_id'] = $settings['site_id'];
		$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/campaign/create';
		$response = helperClass::doCurl($url, $post);
	}
}
?>
<div class="tab-contents">
	<div style="width:100%;">
		<div style="width: 60%; float: right; text-align:right;">
			<span style="line-height: 29px !important;">Show Statistics For :&nbsp;</span>
			<div id="reportrange" class="pull-right"  style="background: #fff; cursor: pointer; padding: 5px 10px; margin-right:10px; border: 1px solid #ccc;">
				<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
				<span></span> <b class="caret"></b>
			</div>
		</div>
	</div>
	<div class="campaign_page col-sm-12 col-md-12">
			<div style="float: right">Balance:<span id="user-balance"></span></div>
			<div class="add_button">
				<button class="btn btn-primary" id="add_campaign" onclick="jQuery('#boostmodal').modal({
    backdrop: 'static',
    keyboard: false,
    show: true
})"><i class="fa fa-plus"></i>Create an Ad</button>
			</div>

	</div>
<div id="boostmodal" class="modal small fade" role="dialog">
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
							<input type="text" name="campaign_display_name" data-validation="required" data-validation-error-msg="Enter a display name for your Campaign">
						</div>

						<div class="form-group cls-padding-left">
							<label class="sub-heading">Landing Page URL</label><br/>
							<input type="text" name="website_url" data-validation="required url" data-validation-error-msg="Enter your landing page URL">
						</div>

						<div class="form-group cls-padding-left">
							<label class="sub-heading">UTM Code / Tracking Pixel</label><br/>
							<input type="text" name="utm_code" > <br/><br/>
							<button class="upload-image-button" id="btn_test_url" name="btn_test_url">Test Landing URL</button>
						</div>

						<div class="heading">Design your promotion</div>


						<div class="form-group cls-padding-left">
							<div style="width:32%;">
							<label class="sub-heading">Image</label>
							<input type="file" name="uploaded_image" id="uploaded-image" style="display: none" />
							<button id="upload_image_button" class="upload-image-button" id="btn_upload_image" name="image_upload">Upload Image</button>
							<input type='hidden' name='image_attachment_id' id='image_attachment_id' value='<?php echo get_option( 'media_selector_attachment_id' ); ?>'>
							</div>
							<div class="info-heading" style="display: none"> (Image size - max 700kb.<br/>Image Width - min 250 px  max 400 px<br/>Image height - min 200 px  max 500 px)</div>
						</div>

						<div class="form-group cls-padding-left">
							<label class="sub-heading">Headline</label><br/>
							<input type="text" name="campaign_title" id="headline">
						</div>
						<div class="form-group cls-padding-left">
							<label class="sub-heading">Text</label><br/>
							<textarea  name="campaign_description" id="campaign_description" maxlength="100" data-validation="required" data-validation-error-msg="Please provide description of your campaign"></textarea>
						</div>
						<div class="form-group cls-padding-left">
							<label class="sub-heading">Call to action</label>
							<select name="call_to_action" id="call_to_action" style="width:40%">
								<option value="0">None</option>
								<option value="1">Apply Now</option>
								<option value="2">Book Now</option>
								<option value="3">Contact Us</option>
								<option value="4">Download</option>
								<option value="5">Know More</option>								
								<option value="6">Shop Now</option>
								<option value="7">Sign Up</option>
								<option value="8">Reserve</option>
								<option value="9">Participate</option>
							</select>

						</div>
					</div>
						<?php
								if( is_array( $settings ) && isset($settings['site_id'])) {
									$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/campaign/form-elements';
									$post['site_id'] = $settings['site_id'];
									$output = helperClass::doCurl($url, $post);

									$output = json_decode($output, TRUE);
								}
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
								<select name="age_group"  data-validation="required" data-validation-error-msg="Please select the age group">
									<option value="">Select Age</option>
									<option value="12 to 17">12 to 17</option>
									<option value="18+">18+</option>
									<option value="Explicit">Explicit</option>
									<option value="All">All</option>
								</select>
							</div>
							<div class="form-group cls-padding-left">            <!-- Gender -->
								<label class="sub-heading">Gender </label>
								<select name="gender_group" data-validation="required" data-validation-error-msg="Please select the gender group">
									<option value="">Select Gender</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
									<option value="All">All</option>
								</select>
							</div>
							<div class="form-group cls-padding-left">            <!-- Language -->
								<label class="sub-heading">Language </label>
								<select name="languages[]" id="languages"  data-validation="required" multiple>

									<?php
										if(isset($languages)) {
											foreach ($languages as $key => $value) {
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
												echo '<option value="' . $key . '">' . $value . '</option>';
											}
										}
									?>
								</select>
							</div>

							</div>
						<div>
							<div class="heading">Budget</div>
							<div class="form-group cls-padding-left">            <!--optimise -->
								<label class="sub-heading" >Optimise for:</label>
								<select name="optimise_for" style="width:50%" id="optimise_for">
									<option value="2">Reach</option>
									<option value="1">Engagement</option>
								</select>
								<span class="sub-heading">CPM: <i class="fa <?php echo $currencyClass?> sub-heading"></i> <?php echo $cpm?></span>
								<span class="sub-heading" style="display: none">CPC: <i class="sub-heading fa <?php echo $currencyClass?>"></i> <?php echo $cpc?></span>
							</div>

							<div class="form-group cls-padding-left">            <!-- Budget -->
								<label class="sub-heading">Budget </label>
								<select id="budget_type" name="budget_type"  onchange="getbudget(this)" style="width: 35%;">
									<option value="daily">Daily Budget</option>
									<option value="lifetime">Lifetime Budget</option>
								</select>
								<i class="sub-heading fa <?php echo $currencyClass?>" style="display: inline; margin-left:10px"></i> <input id="budget_amount" name="budget_amount" class="track" type="text" placeholder="0" data-validation="required" data-validation-error-msg="Please give the budget amount" style="width:45%">
							</div>
							<div class="form-group cls-padding-left">
								<label></label>
								<div id="site_settings" style="display: none;padding-bottom: 10px;">
									<p><input type="checkbox" name="is_also_my_site" value="1"> Show Ads on my site Widget as well (you will not be charged for this if your daily budget is met with your traffic)</p>
									<p><input type="checkbox" name="is_only_my_site" value="1"> I want to show campaigns only on my site</p>
								</div>

								<div class="clear"></div>
								<!-- Schedule -->
								<label  style="padding-top: 0px;display: none;">Schedule </label>
								<div id="scheduled" style="display: none;">
									<p><input type="radio" name="schedule" value="continuous" onclick="getdaily()" checked> Run my ad set continuously starting today</p>
									<p><input type="radio" name="schedule" value="restricted" onclick="getdate(this)"> Set a start date and end date</p>
								</div>
								<div id="getlifetime">
									<div class="period">
										<div class="form-group cls-padding-left">
											<div style="width: 100%">
												<label class="sub-heading" style="float: left;width: 45%">Start Date</label> <label class="sub-heading" style="width: 45%;float: right">End Date</label>
											</div>
											<div style="width: 100%">
											<div class="input-group date" id="start" style="width: 48%;float: left; margin-right: 1%">
												<input type="text" id="start_date" name="start_date" class="form-control track" />	<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
											</div>


												<div class="input-group date" id="end" style="width: 48%;float: right">
													<input type="text" id="end_date" name="end_date" class="form-control track" />	<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
												</div>
											</div>

										</div>

									</div><br/>
									<p class="pheading" align="center">You will spend a Total of <i class="fa <?php echo $currencyClass?>"></i><span id="calculated_budget">0.00 </span> .</p>
								</div>
							</div>

							<div class="form-group cls-padding-left" style="display:none">            <!--Pricing -->
								<label class="sub-heading">Pricing</label>
								<div>
									<p>You will be charged every time someone clicks on your ad.</p>
									<p style="display: none"><input type="radio" name="price_type" value="max_click" onclick="showhidecpc(this)" checked>Get more clicks at best price</p>
									<p><input type="radio" name="price_type" value="max_price" onclick="showhidecpc(this)">Set the max you want to pay per click</p>
									<div id="cpc_input" style="display:none">
										<p><input type="text" name="bid_price" id="bid_price"  value="10.00" data-validation="required" data-validation-error-msg="Please enter the bid amount">We'll serve your ads to people who might click on your ad (CPC).</p>
										<p style="color:#ccc;">Suggested bid: <i class="fa <?php echo $currencyClass?>"></i>5.00-<i class="fa <?php echo $currencyClass?>"></i>15.00 </p>
									</div>
								</div>
							</div>
							</div>


					</div>


					<div id="right_div_modal_body">
						<!-- widget preview -->

						<div class="SPINKX_preview_fg grid-item grid-item--height" style="width: 200px ! important; height: auto; overflow: scroll; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border-width: 1px; border-style: solid; border-color: rgb(216, 216, 216); border-radius: 10px; margin-bottom: 8px; position: absolute; transition-property: transform, opacity; transition-duration: 0.4s; display: none">		<!-- block Start -->

							<div class="boost_img image-preview-wrapper" style="position: relative;">
								<img style=" height: auto; max-width: 100%; width:100%; vertical-align: middle; display:none" src="" alt="" id="image-preview" />
								<span class="pull-right" style="font-size: 8px;color: grey;position: absolute;bottom: 1px;left:2px;display: none">sponsored</span>
							</div>
							<div id="campaign_name" style="font-size: 8px; line-height: 8px; font-weight: 700; margin-bottom: 0px; margin-top:5px;margin-left:12px; color: grey; font-family: 'Open Sans'; display: block;"></div>
							<h4 class="boost_post_title pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: 12px; line-height: 18px; font-weight: 700; margin-bottom: 0px; margin-top:4px; margin-left:12px; color: #000000; font-family: 'Open Sans'; display: block;"></h4>

							<p class="boost_post_desc pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: 10px; line-height: 18px;display: block; padding: 0px 11px 0px 11px !important; font-family: 'Open Sans';"></p>
							<input type="button" value="Buy Now" id="bbuy_now" style="    float: right; margin-right: 10px; margin-bottom: 5px; background: #f5f5f5; border: 1px solid #e3e3e3; border-radius: 4px; font-family: 'Open Sans'; font-size: 9px; padding: 2px 6px; display:none;"/>
						</div>

						<!-- end widget preview -->

					</div>
					</div>
				<div class="modal-footer">
					<?php
						if( is_array( $settings ) && isset($settings['site_id'])) {
							$url = esc_url(SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/campaign/add-money');
							$post = array('site_id' => $settings['site_id'], 'license_code' => md5($settings['license_code']), 'reg_email' => $settings['reg_email']);

							$response = helperClass::doCurl($url, $post);
							$response = json_decode($response);

							if ($response) {
								echo do_shortcode($response);
							}
						}
					?>
						<label class="pheading">Or</label>
						<button class="btn btn-primary" type="submit" name="add_camp">Save</button>


				</div>

				</div>
			</form>
		</div>
	</div>
<div class="campaign col-sm-12 col-md-12" id="c_index" style="display:block;margin-top: 10px;" >
<div>
<?php
	if( is_array( $settings ) && isset($settings['site_id'])) {
		$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/campaign';
		$post = ['site_id' => $settings['site_id'], 'license_code' => md5($settings['license_code']), 'from_date' => $from_date, 'to_date' => $to_date];
		$output = helperClass::doCurl($url, $post);
		$output = json_decode($output);
		echo $output;
	}
?>
</div></div>
<?php
add_action( 'admin_footer', 'spinkx_cont_media_selector_print_scripts' );