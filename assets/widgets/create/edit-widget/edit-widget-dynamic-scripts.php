<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


$camp_site_widget_bool = ( $camp_site_widget == "mysite" )?'true':'false';
$camp_site_widget_delivery = ( $camp_site_widget == "delivery" )?'true':'false';
$camp_site_widget_external = ( $camp_site_widget == "externalsite" )?'true':'false';
$url = SPINKX_CONTENT_PLUGIN_URL;
$no_of_columns = ($no_of_columns != 0)?$no_of_columns:1;
$output = <<<EOD
     jQuery(document).ready(function( $ ) { 
     
		//Hide All The Spans That Shows Calculated Value
		$('#locMain').hide();
		$('#globMain').hide();
		$('#sponsMain').hide();
		$('#recent').hide();
		$('#popular').hide();
		$('#related').hide();
		/* $ Works! You can test it with next line if you like
		/**********************************/
		$(".create_btn_widget").hide();
		$(".update_btn_widget").show();
		/* display tabs starts here */
		$('#website_content_auto').click(function(){
			$(this).css('color','#469fa1');
			$('#website_content_manual').css('color','#c00000');
			$('.web_content_widget').hide();
			$("#local_post_percentage").val(30);
			$("#local_post_percentage_range").slider('value',30);
			$("#widget_recent_percentage").val(50);
			$("#widget_recent_percentage_range").slider('value',50);
			$("#widget_popular_percentage").val(25);
			$("#widget_popular_percentage_range").slider('value',25);
			$("#widget_related_percentage").val(25);
			$("#widget_related_percentage_range").slider('value',25);
			$('#web_enable').val(0);
			if(($('#web_enable').val()==0)&&($('#global_enable').val()==0)&&($('#sponsor_enable').val()==0)&&($('#owncamp_enable').val()==0))
			{
				$('#auto_enable').show();
				$('#manual_enable').hide();
			}
			else
			{
				$('#manual_enable').show();
				$('#auto_enable').hide();
			}
		});
		$('#website_content_manual').click(function(){
			$(this).css('color','#469fa1');
			$('#website_content_auto').css('color','#c00000');
			$('.web_content_widget').show();
			$("#local_post_percentage").val({$mysite_post_percentage});
			$("#local_post_percentage_range").slider('value',{$mysite_post_percentage});
			$("#widget_recent_percentage").val({$widget_recent_percentage});
			$("#widget_recent_percentage_range").slider('value',{$widget_recent_percentage});
			$("#widget_popular_percentage").val({$widget_popular_percentage});
			$("#widget_popular_percentage_range").slider('value',{$widget_popular_percentage});
			$("#widget_related_percentage").val({$widget_related_percentage});
			$("#widget_related_percentage_range").slider('value',{$widget_related_percentage});
			$('#web_enable').val(1);
			if(($('#web_enable').val()==0)&&($('#global_enable').val()==0)&&($('#sponsor_enable').val()==0)&&($('#owncamp_enable').val()==0))
			{
				$('#auto_enable').show();
				$('#manual_enable').hide();
			}
			else
			{
				$('#manual_enable').show();
				$('#auto_enable').hide();
			}
		});
		$('#global_distribut_auto').click(function(){
			$(this).css('color','#469fa1');
			$('#global_distribut_manual').css('color','#c00000');
			$('.global_content_widget').hide();
			$("#global_post_percentage").val(50);
			$("#global_post_percentage_range").slider('value',50);
			$("#allow_global_url_checkbox").prop('checked', true);
			$("#block_global_url_checkbox").prop('checked', true);
			$('#global_enable').val(0);
			if(($('#web_enable').val()==0)&&($('#global_enable').val()==0)&&($('#sponsor_enable').val()==0)&&($('#owncamp_enable').val()==0))
			{
				$('#auto_enable').show();
				$('#manual_enable').hide();
			}
			else
			{
				$('#manual_enable').show();
				$('#auto_enable').hide();
			}
		});
		$('#global_distribut_manual').click(function(){
			$(this).css('color','#469fa1');
			$('#global_distribut_auto').css('color','#c00000');
			$('.global_content_widget').show();
			$("#global_post_percentage").val({$global_post_percentage});
			$("#global_post_percentage_range").slider('value',{$global_post_percentage});
			$('#global_enable').val(1);
			

			if(($('#web_enable').val()==0)&&($('#global_enable').val()==0)&&($('#sponsor_enable').val()==0)&&($('#owncamp_enable').val()==0))
			{
				$('#auto_enable').show();
				$('#manual_enable').hide();
			}
			else
			{
				$('#manual_enable').show();
				$('#auto_enable').hide();
			}
		});
		$('#Sponsored_content_auto').click(function(){
			$(this).css('color','#469fa1');
			$('#Sponsored_content_manual').css('color','#c00000');
			$('.sponsored_content_widget').hide();
			$("#ad_post_percentage").val(20);
			$("#ad_post_percentage_range").slider('value',20);
			$('#sponsor_enable').val(0);
			if(($('#web_enable').val()==0)&&($('#global_enable').val()==0)&&($('#sponsor_enable').val()==0)&&($('#owncamp_enable').val()==0))
			{
				$('#auto_enable').show();
				$('#manual_enable').hide();
			}
			else
			{
				$('#manual_enable').show();
				$('#auto_enable').hide();
			}
		});
		$('#Sponsored_content_manual').click(function(){
			$(this).css('color','#469fa1');
			$('#Sponsored_content_auto').css('color','#c00000');
			$('.sponsored_content_widget').show();
			$("#ad_post_percentage").val({$sponsored_post_percentage});
			$("#ad_post_percentage_range").slider('value',{$sponsored_post_percentage});
			$('#sponsor_enable').val(1);
			if(($('#web_enable').val()==0)&&($('#global_enable').val()==0)&&($('#sponsor_enable').val()==0)&&($('#owncamp_enable').val()==0))
			{
				$('#auto_enable').show();
				$('#manual_enable').hide();
			}
			else
			{
				$('#manual_enable').show();
				$('#auto_enable').hide();
			}
		});
		$('#own_campaign_auto').click(function(){
			$(this).css('color','#469fa1');
			$('#own_campaign_manual').css('color','#c00000');
			$('.campaign_content_widget').hide();
			$("#camp_site_widget").prop('checked', false);
			$("#delivery_guarantee").prop('checked', false);
			$("#camp_external_site_widget").prop('checked', false);
			$('#owncamp_enable').val(0);
			if(($('#web_enable').val()==0)&&($('#global_enable').val()==0)&&($('#sponsor_enable').val()==0)&&($('#owncamp_enable').val()==0))
			{
				$('#auto_enable').show();
				$('#manual_enable').hide();
			}
			else
			{
				$('#manual_enable').show();
				$('#auto_enable').hide();
			}
		});
		$('#own_campaign_manual').click(function(){
			$(this).css('color','#469fa1');
			$('#own_campaign_auto').css('color','#c00000');
			$('.campaign_content_widget').show();
			$("#camp_site_widget").prop('checked', {$camp_site_widget_bool});
			$("#delivery_guarantee").prop('checked', {$camp_site_widget_delivery});
			$("#camp_external_site_widget").prop('checked', {$camp_site_widget_external});
			$('#owncamp_enable').val(1);
			if(($('#web_enable').val()==0)&&($('#global_enable').val()==0)&&($('#sponsor_enable').val()==0)&&($('#owncamp_enable').val()==0))
			{
				$('#auto_enable').show();
				$('#manual_enable').hide();
			}
			else
			{
				$('#manual_enable').show();
				$('#auto_enable').hide();
			}
		});
		$('#brand_local_button').click(function(){
			$('#brand_design_button').removeClass('active');
			$('#brand_global_button').removeClass('active');
			$('#brand_local_button').addClass('active');
			$('.brand-design-content').hide();
			$('.brand-global-content').hide();
			$('.brand-local-content').show();
			$('.block-right-preview').hide();
		});
		$('#brand_global_button').click(function(){
			$('#brand_design_button').removeClass('active');
			$('#brand_local_button').removeClass('active');
			$('#brand_global_button').addClass('active');
			$('.brand-design-content').hide();
			$('.brand-local-content').hide();
			$('.brand-global-content').show();
			$('.block-right-preview').hide();
		});
		$('#brand_design_button').click(function(){
			$('#brand_local_button').removeClass('active');
			$('#brand_global_button').removeClass('active');
			$('#brand_design_button').addClass('active');
			$('.brand-local-content').hide();
			$('.brand-global-content').hide();
			$('.brand-design-content').show();
			$('.block-right-preview').show();
		});

		/* display tabs close here */
		$( "#toplevel_page_SPINKX_widget-settings" ).addClass( "wp-has-current-submenu current" ).removeClass( "wp-not-current-submenu" );
		$('a[href*="admin.php?page=SPINKX_content_distribution_settings"]').each(function() {
			$(this).addClass('current');
			$(this).parent().addClass('current');
		});

		/* ColorPicker Script Starts Here */
		/* // Initiate the ColorPicker */
		$("#bg_color").colorpicker({
			color: "{$unit_bg_color}"
		});
		$("#fg_color").colorpicker({
			color: "{$unit_fg_color}"
		});
		$("#unit_border_color").colorpicker({
			color: "{$unit_border_color}"
		});
		$("#unit_title_font_color").colorpicker({
			color: "{$unit_title_font_color}"
		});
		$("#unit_add_line_color").colorpicker({
			color: "{$unit_add_line_color}"
		});
		$("#unit_excerpt_font_color").colorpicker({
			color: "{$unit_excerpt_font_color}"
		});

		/* // Add radius to the div containing the button */
		$(".evo-pointer").css("border-radius", "0px");
		$(".evo-pointer").css("float", "left");

		/* // Set the radius again in ColorPicker change color event */
		$(".colorPicker").on("change.color", function (event, color) {
			$(this).next().css("border-radius", "0px");
			$(this).next().css("float", "left");
		});
		/* ColorPicker Script Ends Here */
/*************************************************************************************************/
		
		
		



 /* $(".unit_layout_tall").click(function(){
	 $(".line-style-tall").show();
	 $(".line-style-wide").hide();
	 $("#excerpt_add_line_styles").attr("disabled",false);
	 $('.pre-img').css({'width':'','float':''});
	$('.divider_above_img').css({'width':'','float':''});
	$('.excerpt_belowimg').css({'width':'','float':''});
 });
 $(".unit_layout_wide").click(function(){
	$(".line-style-tall").hide();
	$(".line-style-wide").show();
	$('.excerpt_aboveimg').hide();
	$('.excerpt_belowimg').show();
	$("#excerpt_add_line_styles").attr("disabled",true);
	$('.pre-img').css({'width':'50%','float':'right'});
	$('.divider_above_img').css({'width':'50%','float':'left'});
	$('.excerpt_belowimg').css({'width':'auto','float':'left'});
 }); */
	//	$(".select2-selection").css("width","300px");
	//	$(".select2-search__field").css("width","300px");
	});
	jQuery(window).load(function( $ ){
		jQuery(function ( $ ) {
			$("#slider-range-min").slider({
				range: "min",
				value: {$no_of_columns},
				min:   0,
				max:   6,
				slide: function (event, ui) {
				$("#result1").val("" + ui.value);
				$("#result1-1").val("" + ui.value);
				}
			});
			$("#widget_recent_percentage_range").slider({
				range: "min",
				value: {$widget_recent_percentage},
				min:   0,
				max:   100,
				change: function (event, ui) {
				$("#widget_recent_percentage").val("" + ui.value);
				widgetPercentage();
				calculateValues();
				}
			});
			$("#widget_popular_percentage_range").slider({
				range: "min",
				value: {$widget_popular_percentage},
				min:   0,
				max:   100,
				change: function (event, ui) {
				$("#widget_popular_percentage").val("" + ui.value);
				widgetPercentage();
				calculateValues();
				}
			});
			$("#widget_related_percentage_range").slider({
				range: "min",
				value: {$widget_related_percentage},
				min:   0,
				max:   100,
				change: function (event, ui) {
				$("#widget_related_percentage").val("" + ui.value);
				widgetPercentage();
				calculateValues();
				}
			});
			$("#global_post_percentage_range").slider({
				range: "min",
				value: {$global_post_percentage},
				min:   0,
				max:   100,
				change: function (event, ui) {
				$("#global_post_percentage").val("" + ui.value);
				postPercentage();
				calculateValues();
				}
			});
			$("#ad_post_percentage_range").slider({
				range: "min",
				value: {$sponsored_post_percentage},
				min:   0,
				max:   100,
				change: function (event, ui) {
				$("#ad_post_percentage").val("" + ui.value);
				postPercentage();
				calculateValues();
				}
			});
			$("#local_post_percentage_range").slider({
				range: "min",
				value: {$mysite_post_percentage},
				min:   0,
				max:   100,
				change: function (event, ui) {
				$("#local_post_percentage").val("" + ui.value);
					postPercentage();
					calculateValues();
				}
			});
			$("#global_url_post_percentage_range").slider({
				range: "min",
				value: {$global_url_post_percentage},
				min:   0,
				max:   100,
				slide: function (event, ui1) {
				$("#global_url_post_percentage").val("" + ui1.value);
				}
			});
			$("#local_post_percentage").on('input',function(e){
				calculateValues();
			});
			$("#widget_recent_percentage").on('input',function(e){
				calculateValues();
			});
			$("#widget_popular_percentage").on('input',function(e){
				calculateValues();
			});
			$("#widget_related_percentage").on('input',function(e){
				calculateValues();
			});
			$("#global_post_percentage").on('input',function(e){
				calculateValues();
			});
			$("#ad_post_percentage").on('input',function(e){
				calculateValues();
			});
			
		});
	});
	/*------------------------------------------------------------------------------*/
	function postPercentage()
	{
		jQuery(".ajax_update_button").attr("disabled",false);
		jQuery(".ajax_clone_button").attr("disabled",false);
		var local_post	=	jQuery("#local_post_percentage").val();
		var global_post	=	jQuery("#global_post_percentage").val();
		var ad_post		=	jQuery("#ad_post_percentage").val();
		var sum_post	=	parseInt(local_post)+parseInt(global_post)+parseInt(ad_post);
		/*if(sum_post>100)
		{
			//alert("Maximum value of post is 100%");
			jQuery(".ajax_update_button").attr("disabled",true);
			jQuery(".ajax_clone_button").attr("disabled",true);
			return false;
		}*/
	}
	function widgetPercentage()
	{
		jQuery(".ajax_update_button").attr("disabled",false);
		jQuery(".ajax_clone_button").attr("disabled",false);
		var widget_recent	=	jQuery("#widget_recent_percentage").val();
		var widget_related	=	jQuery("#widget_related_percentage").val();
		var widget_popular		=	jQuery("#widget_popular_percentage").val();
		var sum_post	=	parseInt(widget_recent)+parseInt(widget_related)+parseInt(widget_popular);
		/*if(sum_post>100)
		{
			//alert("Maximum value of post is 100%");
			jQuery(".ajax_update_button").attr("disabled",true);
			jQuery(".ajax_clone_button").attr("disabled",true);
			return false;
		}*/
	}
	function calculateValues()
	{
		$('#locMain').show();
		$('#globMain').show();
		$('#sponsMain').show();
		$('#recent').show();
		$('#popular').show();
		$('#related').show();
		console.log("slide_time");
		jQuery(".ajax_create_button").attr("disabled",false);
		var widget_recent	=	jQuery("#widget_recent_percentage").val();
		var widget_related	=	jQuery("#widget_related_percentage").val();
		var widget_popular	=	jQuery("#widget_popular_percentage").val();
		var sub_widgets	=	parseInt(widget_recent)+parseInt(widget_related)+parseInt(widget_popular);

		//recent_percentage
		var recent_percent = (parseFloat(widget_recent/sub_widgets))*100;
		$('#recent').text(recent_percent.toFixed(2));
		//related_percentage
		var related_percent = (parseFloat(widget_related/sub_widgets))*100;
		$('#related').text(related_percent.toFixed(2));
		//popular_percentage
		var popular_percent = (parseFloat(widget_popular/sub_widgets))*100;
		$('#popular').text(popular_percent.toFixed(2));


		var widget_local	=	jQuery("#local_post_percentage").val();
		var widget_global	=	jQuery("#global_post_percentage").val();
		var widget_sponsored =	jQuery("#ad_post_percentage").val();

		var total_widgets = parseInt(widget_local)+parseInt(widget_global)+parseInt(widget_sponsored);
		//Local Percentage
		var loc_percent = (parseFloat(widget_local/total_widgets))*100;
		$('#locMain').text(loc_percent.toFixed(2));
		//Global Percentage
		var glob_percent = (parseFloat(widget_global/total_widgets))*100;
		$('#globMain').text(glob_percent.toFixed(2));
		//Sponpsored Percentage
		var spons_percent = (parseFloat(widget_sponsored/total_widgets))*100;
		$('#sponsMain').text(spons_percent.toFixed(2));

	}
	/*------------------------------------------------------------------------------*/
	/*------------------------------------------------------------------------------*/
	jQuery(document).ready(function( $ ) {
		/*------------------------------------------------------------------------------*/
		$(".ajax_update_button").attr("disabled",false);
		$(".ajax_clone_button").attr("disabled",false);
		/*------------------------------------------------------------------------------*/
		$( ".ajax_update_button" ).click(function( e ) {
			e.preventDefault();
			if($(".ajax_update_button").attr("disabled")=='disabled')
				return false;
			var form_serialized_data = $('form#SPINKX_edit_form').serialize();
			var main_widget_id = $('#main_widget_id').val();
			/*------------------------------------------------------------------------------*/
			
			var page_url = window.location.href;
			var page_new_url = page_url.split("?")[0];
			var add_shortcode = $('#add_shortcode').val();
			var wp_section = $('#wp_section').val();
			/*------------------------------------------------------------------------------*/
			$('#bpopup_ajax_loading').bPopup( { modalClose: false } );
			$.ajax({
				url : ajaxurl,
				data : {
						'action': 'spinkx_cont_widget_update',
						'form_serialized_data' : form_serialized_data,
						'main_widget_id' : main_widget_id,
						'mode' : 'update',
					},
				type : 'post',
				datatype : 'json',
				success : function(data){
					$('#bpopup_ajax_loading').bPopup().close();
					$.growl.notice({ message: "Successfully Updated!",
					location: 'tr',
					size: 'large' });					
				},
				failure : function(data){
					console.log(data);
					$('#bpopup_ajax_loading').bPopup().close();
					$.growl.error({ message: "Failed to Update!",
						location: 'tr',
						size: 'large' });
				}
			});		
		});
		
		/*------------------------------------------------------------------------------*/
		$( ".ajax_reset_button" ).click(function( e ) {
			e.preventDefault();
			if($(this).attr("disabled")=='disabled')
				return false;
			var widget_name = $('form #widget_name').val();
			var main_widget_id = $('#main_widget_id').val();
			/*------------------------------------------------------------------------------*/
			var page_url = window.location.href;
			var page_new_url = page_url.split("?")[0];
			var add_shortcode = $('#add_shortcode').val();
			var wp_section = $('#wp_section').val();
			/*------------------------------------------------------------------------------*/
			$('#bpopup_ajax_loading').bPopup( { modalClose: false } );
			$.ajax({
				url : ajaxurl,
				data : {
						'action': 'spinkx_cont_widget_reset',
						'widget_name' : widget_name,
						'main_widget_id' : main_widget_id,
						'mode' : 'reset',
				},
				type : 'post',
				datatype : 'json',
				success : function(data){
					$('#bpopup_ajax_loading').bPopup().close();
					$.growl.notice({ message: "Successfully Reset!",
					location: 'tr',
					size: 'large' });
					window.location.reload();
				},
				failure : function(data){
					$('#bpopup_ajax_loading').bPopup().close();
					$.growl.error({ message: "Failed to Update!",
						location: 'tr',
						size: 'large' });
				}
			});
		});
		/*------------------------------------------------------------------------------*/
		$( ".ajax_delete_button" ).click(function( e ) {
			e.preventDefault();
			var main_widget_id = $('#main_widget_id').val();
			/*------------------------------------------------------------------------------*/
			var page_url = window.location.href;
			var page_new_url = page_url.split("?")[0];
			/*------------------------------------------------------------------------------*/
			$('#bpopup_ajax_loading').bPopup( { modalClose: false } );
			$.ajax({
				url : ajaxurl,
				data : {
						'action': 'spinkx_cont_widget_delete',
						'main_widget_id' : main_widget_id,
					},
				type : 'post',
				datatype : 'json',
				success : function(data){
					console.log(data);
					$.growl.notice({ message: "Successfully Deleted !",
						location: 'tr',
						size: 'large' });
					window.location.href=page_new_url+'?page=spinkx_widget_design';
				},
				failure : function(data){
					console.log(data);
					$('#bpopup_ajax_loading').bPopup().close();
					$.growl.error({ message: "Failed !",
						location: 'tr',
						size: 'large' });
				}
			});
		});
		/*------------------------------------------------------------------------------*/
		/*------------------------------------------------------------------------------*/
		$( ".ajax_clone_button" ).click(function( e ) {
			e.preventDefault();
			if($("#ajax_clone_button").attr("disabled")=='disabled')
				return false;
			var form_serialized_data = $('form#SPINKX_edit_form').serialize();
			var main_widget_id = $('#main_widget_id').val();
			/*------------------------------------------------------------------------------*/
			var page_url = window.location.href;
			var page_new_url = page_url.split("?")[0];
			/*------------------------------------------------------------------------------*/
			$('#bpopup_ajax_loading').bPopup( { modalClose: false } );
			$.ajax({
				url : ajaxurl,
				data : {
						'action': 'spinkx_cont_widget_clone',
						'form_serialized_data' : form_serialized_data,
						'main_widget_id' : main_widget_id,
						'access_site_id' : '{$access_site_id}',
					},
				type : 'post',
				datatype : 'json',
				success : function(data){
					$('#bpopup_ajax_loading').bPopup().close();
					$.growl.notice({ message: data,
						location: 'tr',
						size: 'large' });

					window.location.href=page_new_url+'?page=spinkx_widget_design';
					//console.log('admin.php?page=spinkx_widget_design');
					//location.reload();
					//location.reload();
				},
				failure : function(data){
					console.log(data);
					$('#bpopup_ajax_loading').bPopup().close();
					$.growl.error({ message: " Failed !",
						location: 'tr',
						size: 'large' });
				}
			});
		});
		/*------------------------------------------------------------------------------*/
		/*------------------------------------------------------------------------------*/
	});
EOD;
//$output = sprintf($output, array(SPINKX_CONTENT_PLUGIN_URL, SPINKX_CONTENT_PLUGIN_URL, SPINKX_CONTENT_PLUGIN_URL, SPINKX_CONTENT_PLUGIN_URL );
$handle = 'jquery-evol';
$list = 'enqueued';
$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
if (wp_script_is( $handle, $list )) {
	wp_add_inline_script( "jquery-evol", $output );
} else {
	wp_enqueue_script('jquery-evol', $js_url . 'evol.colorpicker.min.js');
	wp_add_inline_script("jquery-evol", $output);
}
?>