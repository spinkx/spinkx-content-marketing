<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$post_filter = helperClass::getFilterPost();
$cid = helperClass::getFilterVar( 'cid', INPUT_GET, FILTER_VALIDATE_INT );
if ( $post_filter ) {
	if( $post_filter['image_attachment_id'] > 0) {
		$image_attributes = wp_get_attachment_image_src( $post_filter['image_attachment_id'], 'medium' );
		$post_filter['ad_image_url'] = $image_attributes[0];
	}
	$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/campaign/update';
	$post_filter['c_id'] = $cid;
	$output = helperClass::doCurl( $url, $post_filter );
	echo '<script>window.location.href = "?page=spinkx_campaigns"</script>';
	exit;
}
if ( $cid ) {
	$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/campaign/get/' . $cid;
	$output = helperClass::doCurl( $url, null );
	$campaign = json_decode( $output );
	$camp = json_decode( $output,true );
	$x = json_decode( $campaign->locations,true );
	$exist_categories = json_decode( $campaign->categories,true );
	$exist_language = json_decode( $campaign->languages,true );
	//print_r($exist_language);
	$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/campaign/form-elements';
	$post_filter['site_id'] = $settings['site_id'];
	$post_filter['c_id'] = $cid;
	$output = helperClass::doCurl( $url, $post_filter );
	$output = json_decode( $output,true );
	$countries = $output['countries'];
	$categories = $output['categories'];
	$languages = $output['languages'];
	$states = $output['states'];
	$currencyClass = $output['currencyClass'];
	$buy_now = "";
	switch ( $campaign->call_to_action ) {
		case 1:
			$buy_now = "Apply Now";
		break;
		case 2:
			$buy_now = "Book Now";
		break;
		case 3:
			$buy_now = "Contact Us";
		break;
		case 4:
			$buy_now = "Download";
		break;
		case 5:
			$buy_now = "Know More";
		break;
		case 6:
			$buy_now = "Shop Now";
		break;
		case 7:
			$buy_now = "Sign Up";
		break;
		case 8:
			$buy_now = "Reserve";
		break;
		case 9:
			$buy_now = "Participate";
		break;
		default:
			$buy_now = "None";
	}
}
$strdate_timpstamp = strtotime($campaign->campaign_start_date);
$enddate_timestamp = strtotime($campaign->campaign_end_date);
$campaign->campaign_start_date = date('Y-m-d', $strdate_timpstamp);
$campaign->campaign_end_date = date('Y-m-d',$enddate_timestamp);
$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/css/' );
wp_enqueue_style( 'bootstrap', $css_url . 'bootstrap.min.css' );
wp_enqueue_style( 'font-awesome', $css_url . 'font-awesome.min.css' );
wp_enqueue_style( 'master-css', $css_url . 'master.css' );
wp_enqueue_style( 'select2-css', $css_url . 'select2.css' );
wp_enqueue_style( 'bootstrap-datetimepicker-css', $css_url . 'bootstrap-datetimepicker.css' );
$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/bpopup/' );

$css_output = "	.small .modal-body { overflow-y: auto; height:600px; padding: 0; }
	#boostmodal2 .modal-dialog {	width:940px; height:700px; font-family: 'Open Sans'; }
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
	.select2-container { width: 90% !important; }
	.btn-primary, #payment-method-button { font-family: 'Open Sans' !important; font-size: 11px !important; font-weight: 700 !important; }
	.btn-primary:hover { background-color: #469fa1; }
	#payment-method-button { background-color: #0170b6 !important; }
	.rTableHead, .rTableCell { text-align: left !important; }";
wp_enqueue_style( 'bpopup-css', $css_url . 'bpopup.css' );
wp_add_inline_style( 'bpopup-css', $css_output );
$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/js/' );
wp_enqueue_script( 'jquery-dateFormat', $js_url . 'jquery-dateFormat.min.js' );
wp_enqueue_script( 'jquery-moment', $js_url . 'moment.js' );
wp_enqueue_media();
wp_enqueue_script( 'jquery-bootstrap-datetimepicker', $js_url . 'bootstrap-datetimepicker.js' );
wp_enqueue_script( 'form-validator-js', esc_url( '//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js' ) );
wp_enqueue_script( 'jquery-bootstrap', $js_url . 'bootstrap.min.js' );
$custom_js = <<<EOD
$=jQuery;
	function getbudget(e) {
		var d=document.getElementById('getlifetime');
		var s=document.getElementById('scheduled');
		if (e.value=='lifetime') {
			 d.style.display="block";
			//var left_div_modal_body = $('#left_div_modal_body');
			//left_div_modal_body.scrollTop(left_div_modal_body.prop("scrollHeight") - 150);
			//$('.track').change();
		}else{
			 d.style.display="none";
			//$('.track').change();
           document.getElementById('getlifetime').style.display="block";
			if(jQuery('input:radio[name=schedule]:checked').val()=='restricted'){
				d.style.display="block";
			}
		}
	}
	function getdate(e) {
		var g=document.getElementById('getlifetime');
		if (e.value=='restricted') {
			g.style.display="block";
		}else {
			g.style.display="none";
		}
	}
	function getdaily() {
		var dele=document.getElementById('getlifetime');
		if (dele.style.display=='block') {
			dele.style.display="none";
		}else {
			dele.style.display="none";
		}
	}
	function showhidecpc(t){
		var cpc = document.getElementById('cpc_input');
		if(t.value == 'max_click')
			cpc.style.display="none";
		if(t.value == 'max_price')
			cpc.style.display="block";
	}
	$(document).ready(function () {
	
			$('#call_to_action').change(function(){
				var call_to_action_text = $('#call_to_action option:selected').html();
				if ($(this).val() > 0) {
					$('#bbuy_now').val(call_to_action_text).show();
				} else {
					$('#bbuy_now').val(call_to_action_text).hide();
				}
			});
			
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
		jQuery('.close').click(function() {
			window.location.href = "?page=spinkx_campaigns";
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
			
			//--------------------------------------------------//
			var location_select = $("#locations").select2({
					placeholder: "Select locations",
			}).on("change",function(e){
					//alert('changed');
					$('#states')
							.find('option')
							.remove()
							.end();
					$("#states").select2("val", "");
					//$("#states").removeAttr("selected");
					$.ajax({
							type : 'GET',
							url : ajaxurl,
							data : {
							'action': 'spinkx_cont_camp_form_elements',
							'country_code': $(this).val()
							},
							success : function(data){
									data = $.parseJSON(data);
									$.each(data,function(key,value){
											console.log(value.name);
										$("#states").append('<option value="'+key+'">'+value+'</option>');
										var states = $campaign->states;
		var state_arr = [];
		$.each(states,function(m,n){
			console.log('element at index ' + m + ' is ' + n);
			state_arr.push(n);
			//state_select.select2('val',n);
		});
		//alert(state_arr);
		state_select.val(state_arr).trigger("change");
										   // $("#states").append('<option value='+value.name+'>'+value.name+'</option>');
									});
									//console.log(data);
							}
					});

			});
			var locs = JSON.parse('{$campaign->locations}');
		   $("#locations").val(locs).change();
		   /* var loc_arr = [];
			$.each(locs,function(m,n){
				  //  console.log('element at index ' + m + ' is ' + n);
					//loc_arr.push(n.location_id);
					$("#locations").select2('val',n);
			});*/

			//$("#locations").val(loc_arr).trigger("change");
			
			var state_select = $("#states").select2({
					placeholder : "Select Region",
			});
		 
			
			//--------------------------------------------------//
			var language_select = $("#languages").select2({
					placeholder: "Select languages",
			});
			var lans = JSON.parse('{$campaign->languages}');
			var lan_arr = [];
			$.each(lans,function(m,n){
					lan_arr.push(n);
			});
			language_select.val(lan_arr).trigger("change");

			//--------------------------------------------------//
			var category_selector = $("#categories").select2({
					placeholder: "Select categories",
			});
			var cats = JSON.parse('{$campaign->categories}');
			var cat_arr = [];
			$.each(cats,function(m,n){
					cat_arr.push(n.category_id);
			});
			category_selector.val(cat_arr).trigger("change");

			//--------------------------------------------------//
			$('#gender_group').val('{$campaign->campaign_gender_group}');
			$('#age_group').val('{$campaign->campaign_age_group}');
			$('#budget_type').val('{$campaign->campaign_budget_type}');

			var sc_type = '{$campaign->campaign_schedule_type}';
			if(sc_type == 'restricted')
					$('#getlifetime').show();
					//alert("yes");
			var p_type = '{$campaign->campaign_price_type}';
			if(p_type == 'max_price')
					$('#cpc_input').show();
			//----------------------------------------------------//
			$('#start').datetimepicker({
							format: 'YYYY-MM-DD hh:mm:ss a',
							locale: 'en'
					  }).on("dp.change", function(e) {
											gm();
					  });;
			$('#end').datetimepicker({
							format: 'YYYY-MM-DD hh:mm:ss a',
							locale: 'en'
					  }).on("dp.change", function(e) {
											gm();
					  });;
			$('#start').data("DateTimePicker").defaultDate('{$campaign->campaign_start_date}');
			$('#end').data("DateTimePicker").defaultDate('{$campaign->campaign_end_date}');
			//------------------------------------------------------------------------------//

			$.validate({
					form : '#c_form',
/* 				onError : function(form) {
					  alert('Validation of form '+form.attr('id')+' failed!');
					},
					onSuccess : function(form) {
					  alert('The form '+form.attr('id')+' is valid!');
					  return false; // Will stop the submission of the form
					}, */
					onValidate : function(form) {
							if($("#locations").val()== null){
									return {
											element : $('#locations'),
											message : 'Please select atleast one location'
							  }
							}
							if($("#languages").val()== null){
									return {
											element : $('#languages'),
											message : 'Please select atleast one language'
							  }
							}
							if($("#categories").val()== null){
									return {
											element : $('#categories'),
											message : 'Please select atleast one category'
							  }
							}
					},
/* 				onElementValidate : function(valid, el, form, errorMess) {
					  console.log('Input ' +el.attr('name')+ ' is ' + ( valid ? 'VALID':'NOT VALID') );
					} */
			  });
			

			
		}
	);
	
EOD;
$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/js/' );
wp_enqueue_script( 'jquery-select2', $js_url . 'select2.min.js' );
wp_add_inline_script( 'jquery-select2', $custom_js );

?><style>

</style>

<div id="c_form2">

	<div id="boostmodal2" class="modal small fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><strong>Create New Ad</strong></h4>
				</div>
				<form method="post" enctype="multipart/form-data" id="c_form"  >
					<div class="modal-body">
						<div id="left_div_modal_body" >
							<div>
								<div class="form-group cls-padding-left">
									<label class="sub-heading">Campaign Name</label><br/>
									<input type="text" name="campaign_display_name" data-validation="required" data-validation-error-msg="Enter a display name for your Campaign" value="<?php echo $campaign->campaign_display_name?>">
								</div>

								<div class="form-group cls-padding-left">
									<label class="sub-heading">Landing Page URL</label><br/>
									<input type="text" name="website_url" data-validation="required url" data-validation-error-msg="Enter your landing page URL" value="<?php echo $campaign->landing_url?>">
								</div>

								<div class="form-group cls-padding-left">
									<label class="sub-heading">UTM Code / Tracking Pixel</label><br/>
									<input type="text" name="utm_code" value="<?php echo $campaign->utm_code?>" > <br/><br/>
									<button class="upload-image-button" id="btn_test_url" name="btn_test_url">Test Landing URL</button>
								</div>

								<div class="heading">Design your promotion</div>


								<div class="form-group cls-padding-left">
									<div style="width:32%;">
										<label class="sub-heading">Image</label>
										<input type="file" name="uploaded_image" id="uploaded-image" style="display: none" />
										<button id="upload_image_button" class="upload-image-button" id="btn_upload_image" name="image_upload">Upload Image</button>
										<input type='hidden' name='image_attachment_id' id='image_attachment_id' value=''>
									</div>
									<div class="info-heading" style="display: none"> (Image size - max 700kb.<br/>Image Width - min 250 px  max 400 px<br/>Image height - min 200 px  max 500 px)</div>
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
									<select name="age_group"  data-validation="required" data-validation-error-msg="Please select the age group">
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
														<input type="text" id="start_date" name="start_date" class="form-control track"  />	<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
													</div>


													<div class="input-group date" id="end" style="width: 48%;float: right">
														<input type="text" id="end_date" name="end_date" class="form-control track"  />	<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
													</div>
												</div>

											</div>

										</div><br/>
										<p class="pheading" align="center">You will spend a Total of <i class="fa <?php echo $currencyClass?>"></i><span id="calculated_budget">0.00 </span></p>
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

								<div class="boost_img image-preview-wrapper" style="position: relative;">
									<img style=" height: auto; max-width: 100%; width:100%; vertical-align: middle;" src="<?php echo $campaign->ad_image_url?>" alt="" id="image-preview" />
									<span class="pull-right" style="font-size: 8px;color: grey;position: absolute;bottom: 1px;left:2px;">sponsored</span>
								</div>

								<div id="campaign_name" style="font-size: 8px; line-height: 8px; font-weight: 700; margin-bottom: 0px; margin-top:5px; margin-left:12px; color: grey; font-family: 'Open Sans'; display: block;"><?php echo $campaign->campaign_display_name?></div>
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
						<button class="btn btn-primary" type="submit">Update</button>
					</div>

			</div>
			</form>
		</div>
	</div>

</div>
<script>
	jQuery(document).ready(function(){
	<?php if (  count($post_filter) > 0 ) {	?>
		jQuery('#boostmodal2').modal({
			backdrop: 'static',
			keyboard: false,
			show: true
		});
	<?php } ?>
		date = new Date("<?php echo date('Y/m/d H:i:s', $strdate_timpstamp)?>");
		$('#start_date').val( date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate() );
		date1 = new Date("<?php echo date('Y/m/d H:i:s',$enddate_timestamp)?>");
		$('#end_date').val( date1.getFullYear() + '-' + (date1.getMonth() + 1) + '-' + date1.getDate() );
		$('#budget_amount').trigger('change');


	});
</script>
<?php
 add_action( 'admin_footer', 'spinkx_cont_media_selector_print_scripts' );
