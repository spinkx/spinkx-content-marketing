$=jQuery;
  var sflag = true;
    function getbudget(e) {
        var d=document.getElementById('getlifetime');
        var s=document.getElementById('scheduled');
        if (e.value=='lifetime') {
			//console.log('taken');
            d.style.display="block";
			//var left_div_modal_body = $('#left_div_modal_body');
			//left_div_modal_body.scrollTop(left_div_modal_body.prop("scrollHeight") - 150);
           // s.style.display="none";
        }else{
            d.style.display="none";
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
	jQuery(document).ready(function ($) {
			jQuery('input.select2-default').css({'width':'500px'})
			var d = new Date();
			//$('#start').data("DateTimePicker").defaultDate(d);
			jQuery('#start').datepicker("setDate", d );
			var m = moment(d);
			m.add('days', 1);
			m.add('months', 1);
			d = m.toDate();
			//$('#end').data("DateTimePicker").defaultDate(d);
			jQuery('#end').datepicker("setDate", d );
			jQuery.validate({
				form : '#c_form1',
/* 				onError : function($form) {
				  alert('Validation of form '+$form.attr('id')+' failed!');
				},
				onSuccess : function($form) {
				  alert('The form '+$form.attr('id')+' is valid!');
				  return false; // Will stop the submission of the form
				}, */
				onValidate : function($form) {
					if(jQuery("#locations").val()== null){
						return {
							element : jQuery('#locations'),
							message : 'Please select atleast one location'
					  }
					}
					if(jQuery("#languages").val()== null){
						return {
							element : jQuery('#languages'),
							message : 'Please select at least one language'
					  }
					}
					if(jQuery("#categories").val()== null){
						return {
							element : jQuery('#categories'),
							message : 'Please select at least one category'
					  }
					}
					if(!(jQuery('#bid_price').val() >= 5 && jQuery('#bid_price').val() <= 15 )){
						return {
							element : jQuery('#bid_price'),
							message : 'Please input price between 5 to 15'
						}
					}
				},
/* 				onElementValidate : function(valid, $el, $form, errorMess) {
				  console.log('Input ' +$el.attr('name')+ ' is ' + ( valid ? 'VALID':'NOT VALID') );
				} */
			  });
			jQuery('#add_campaign').click(function(){
				jQuery('#c_form').toggle();
				jQuery('#c_index').toggle();
			});
			/*$('.track').change(function () {
				gm(this);
			});*/
			function gm(v){
				var clicked_on = $(v).prop('id');
				//alert(clicked_on)
				var budget_type = $('#budget_type').val();
				//if budget = lifetime
				if(budget_type == 'lifetime'){
					//then output 17500 #run_schedule
					//take todate from and display in the date display area	#calculated_budget
					//if(clicked_on=='budget_type') {
						if($('#budget_amount').val() === '') {
							//$('#budget_amount').attr('placeholder', '0.00');
							$('#calculated_budget').html('0');
						} else {
							$('#calculated_budget').html($('#budget_amount').val());

						}
					//}


				}
				if(budget_type == 'daily'){
					sflag = false;
					//$('#budget_amount').val('');
					//then calculate exp/minute= daily budget/24*600
					var daily_budget = $('#budget_amount').val();
					if(clicked_on=='budget_amount') {
						if ($('#budget_amount').val() == '') {
							$('#budget_amount').attr('placeholder', '0');
						} else {
							$('#budget_amount').val(daily_budget);
						}

						//var epm = daily_budget/(24*60);
						//calculate total minuts = [end date-start date] to minutes
						var startTime = new Date($('#start_date').val());
						var endTime = new Date($('#end_date').val());
						//var difference = endTime.getTime() - startTime.getTime(); // This will give difference in milliseconds
						var timeDiff = Math.abs(endTime.getTime() - startTime.getTime());
						var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
						//var startTime = new Date($('#start_date').val());
						//var endTime = new Date($('#end_date').val());
						//	var difference = endTime.getTime() - startTime.getTime(); // This will give difference in milliseconds
						//var tm = Math.round(difference / 60000);
						//total expenditure = exp/minute*total minutes
						var payment = (diffDays + 1) * daily_budget;
						//output total expenditure
						$('#calculated_budget').html(payment);

					}
				}
			//	var end_date = $('#end_date').val();
				//var dateFormat = $.format.date(end_date, 'ddd,MMMM dd, yyyy');
				//console.log(dateFormat);
				//end_date = new Date($('#end_date').val());
				//str_date = days[ end_date.getDay() ] + ', '+ month_name[ end_date.getMonth() ] + ' ' +end_date.getDate() + ', ' +end_date.getFullYear() + '.';
				//$('#run_schedule').html('Your ad will run until ' + str_date);
			}


		$('.create_ad_btn').click(function(){
			var index = $(this).attr('index');
			$('#simpleModal'+index).modal("toggle");
			//$('#demo'+index).collapse("toggle");
		});
	$('.close').click(function(){
			var index = $(this).attr('id');//alert(index);
			formClear(index);
			  $('#simpleModal'+index).modal("toggle");
			  $('#demo'+index).load(location.href +" #demo"+index+">*","");
		});
		$('#optimise_for').change(function(){
			if($(this).val() == 1){
				$(this).next().hide();
				$(this).next().next().show();
			} else {
				$(this).next().next().hide();
				$(this).next().show();
			}

		});
			$('#call_to_action').change(function(){
				var call_to_action_text = $('#call_to_action option:selected').html();
				if ($(this).val() > 0) {
					$('#bbuy_now').val(call_to_action_text).show();
				} else {
					$('#bbuy_now').val(call_to_action_text).hide();
				}
			});

		var days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
		var month_name =  [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
		$('#budget_amount').change(function(){
				gm($('.track'));
		});

			jQuery('#start').datetimepicker({
				format: 'YYYY-MM-DD',
				locale: 'en'
			}).on("dp.change", function(e) {
				sflag = true;
				gm($('.track'));
			});
			jQuery('#end').datetimepicker({
				format: 'YYYY-MM-DD',
				locale: 'en'

			}).on("dp.change", function(e) {
				sflag = true;
				gm($('.track'));
			});
			

	});



function imageChange(e,cnt)
{

  var file_size = $("#image"+cnt)[0].files[0].size;
  var images = $("#image"+cnt).val();
  var extension = images.split('.').pop().toUpperCase();
	$('#error'+cnt).hide();
	$('#imageurl'+cnt).removeClass( "error" );
	/* if(file_size > 500000) {
		$('#error'+cnt).show();
		$('#imageurl'+cnt).addClass( "error" );
		$('#error'+cnt).html("Image size should be less than 500kb");
		return false;

	}
	else if (extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG"){
		$('#error'+cnt).show();
		$('#imageurl'+cnt).addClass( "error" );
		$('#error'+cnt).html("invalid extension "+extension);
		return false;
	}
	else { */

			$('#image_disp'+cnt).attr('src',URL.createObjectURL(e.target.files[0]));

			$('#hid_imageurl'+cnt).val(URL.createObjectURL(e.target.files[0]));

	//}

}
function imageLoad(cnt)
{
	var image_src	=	$('#imageurl'+cnt).val();
	$('#image_disp'+cnt).attr('src',image_src);
	$('#hid_imageurl'+cnt).val(image_src);
}
function imgValidate(index,id)
{
	$('#hadd'+index).val('');
	$('#errormsg'+index).html('');
	$('#mod'+index).val('');
	$('#lerror'+index).hide();
	$('#herror'+index).hide();
	$('#error'+index).hide();
	$('#headline'+index).removeClass( "error" );
	$('#landing'+index).removeClass( "error" );
	$('#imageurl'+index).removeClass( "error" );
	$('#errormsg'+index).hide();


	if(id==1 &&($('#add'+index).html()=='Cancel'))
	{
		$('#simpleModal'+index).modal('toggle');
		formClear(index);
		return false;

	}
	else if(id==2 &&($('#moderation'+index).html()=='Approve'))
	{
		$('#mod'+index).val(1);

	}
	var txt = $('#landing'+index).val();
	var re = /(http(s)?:\\)?([\w-]+\.)+[\w-]+[.com|.in|.org]+(\[\?%&=]*)?/

	if(txt=='')
	{
		$('#lerror'+index).show();
		$('#landing'+index).addClass( "error" );
		return false;
	}
	else if(txt && (re.test(txt)==false))
	{
		$('#lerror'+index).show();
		$('#landing'+index).addClass( "error" );
		return false;
	}

	else if($('#headline'+index).val()=='')
	{
		$('#herror'+index).show();
		$('#headline'+index).addClass( "error" );
		return false;
	}
	else if($('#hid_imageurl'+index).val()=='')
	{
		$('#error'+index).show();
		$('#imageurl'+index).addClass( "error" );
		return false;
	}
	else
	{
		//$("#dvLoading").show();
		$('#bpopup_ajax_loading').bPopup( { modalClose: false } );
		 var formData = new FormData($("#add_form"+index)[0]);
		formData.append('action','spinkx_cont_campaign_ajax')
		$.ajax({
			url: ajaxurl,
				data: formData,
				type: "post",
				//async: false,
				success: function(data)
				{
					//console.log(data)
					 if(data=='success')
					 {
						formClear(index);
						if(id==2)
						{
							$('#simpleModal'+index).modal('toggle');
							$('#demo'+index).load(location.href +" #demo"+index+">*","");
							$('#demo'+index).load(location.href+" #demo"+index+">*",function(){
								$('#bpopup_ajax_loading').bPopup().close();
							});

						}
						else
						{
							$('#bpopup_ajax_loading').bPopup().close();
							//formClear(index);
							//$('#demo'+index).collapse("toggle");
						}

					 }
					 else
					 {
						 $('#errormsg'+index).show();
						 $('#errormsg'+index).html(data);
					 }
					//$("#dvLoading").hide();

				},
				cache: false,
				contentType: false,
				processData: false
		});


	}

}
function formClear(index)
{
	$('#hid_addid'+index).val('');
  $('#landing'+index).val('');
  $('#headline'+index).val('');
  $('#desc'+index).val('');
  $('#image_disp'+index).attr('src','');
  $('#hid_imageurl'+index).val('');
  $('#imageurl'+index).val('');
  $('#call_action'+index).val('Show Nothing');
  $('#image'+index).replaceWith( $('#image'+index).clone() );
  $('#errormsg'+index).hide();
  $('#title_head'+index).html('Create Ad ');
  $('#add'+index).show();
  $('#add'+index).html('Submit & Add Another');
  $('#moderation'+index).html('Submit for Moderation');
}
function updateAdd(index,aid,action,camp_status)
{
	var status	=	setmode	='';
	if(camp_status!=1)
		return false;
	if(action=='addStatus')
	{
		if($('#chk_mode'+aid).val()==1)
		{
			if($('#switch-input'+aid).is(":checked"))
				status	=	1;
			else
				status	=	0;
		}
		else
			return false;

	}
	else if(action=='remove')
		status	=	2;
	else if(action=='setmode')
	{
		action	=	'edit';
		setmode	=	1;
	}

	$('#bpopup_ajax_loading').bPopup( { modalClose: false } );
	$.ajax({
            url: ajaxurl,
            data: {'action':'spinkx_cont_campaign_ajax', 'mode':action,'addid': aid,'adstatus':status},
            type: "post",
            datatype: 'json',
            success: function(data)
            {
                data = $.parseJSON(data);
                if(data && ((action=='edit')||(setmode==1)))
                {
                    if(setmode==1)
                    {
                        $('#bpopup_ajax_loading').bPopup().close();
                        $('#title_head'+index).html('Moderation Setting');
                        $('#add'+index).show();
                        $('#add'+index).html('Cancel');
                        $('#moderation'+index).html('Approve');
                    }
                    else
                    {
                        $('#bpopup_ajax_loading').bPopup().close();
                        $('#title_head'+index).html('Edit Ad');
                        $('#add'+index).hide();
                    }
                    $('#hid_addid'+index).val(data.a_id);
                    $('#landing'+index).val(data.ad_url);
                    $('#headline'+index).val(data.campaign_headline);
                    $('#desc'+index).val(data.campaign_description);
                    $('#image_disp'+index).attr('src',data.ad_image_url);
                    $('#hid_imageurl'+index).val(data.ad_image_url);
                    $('#imageurl'+index).val(data.ad_image_url);
                    $('#call_action'+index).val(data.action_type);
                    $('#simpleModal'+index).modal("toggle");
                }
                else if(data && action=='remove')
                {
                    if(data.status=='true')
                    {
                        $('#deleteModal'+aid).modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $('#demo'+index).load(location.href+" #demo"+index+">*",function(){
                                $('#bpopup_ajax_loading').bPopup().close();
                        });
                        //$("#removead"+aid).parent('div').parent('div').remove();
                    }
                }
                else
                {
                    $('#bpopup_ajax_loading').bPopup().close();
                    //$('#switch-input'+index).bootstrapSwitch();
                }
            }

    });
}
function updateCamp(cid,status,budget_over,path,index)
{
    if(status==1 && budget_over)
    {
            var r = confirm("Campaign Expired! Please update your budget or schedule!");
            if (r == false) {
                    window.location.reload();
                    return false;
            }
            window.location.href = path;
            return false;
    }
    else
    {
        $('#bpopup_ajax_loading').bPopup({modalClose:false});
		//alert(location.href);
		if($('#switch_camp'+cid).is(":checked"))
		{
			status	=	1;
			//$('#c_index').load(location.href +" #c_index>*","");
		}
		else
		{
			status	=	0;
			//$('#c_index').load(location.href +" #c_index>*","");
		}
        $.ajax({
            url: ajaxurl,
            data: {'action':'spinkx_cont_campaign_ajax', 'mode':'changeStatus','c_id': cid,'status':status},
            type: "post",
            datatype: 'json',
            success: function(data)
            {
                $('#bpopup_ajax_loading').bPopup().close();
                data = $.parseJSON(data);
				console.log(data);
            }
        });

    }


}
function viewAd(index,cid)
{
	if(($('#switch_camp'+cid).prop('checked')==false) && ($('#collapse'+cid).val() ==0))
	{
		    //alert('dfgdgf');
            $('#collapse'+cid).val(1);
            $('#demo'+index).find("input,a,li,button").prop("disabled",true);
            $('#demo'+index).fadeTo(1000, 0.5, function() {});
	}
	else
	{
		    $('#collapse'+cid).val(0);
            if($('#switch_camp'+cid).prop('checked')==false)
                $('#c_index').load(location.href +" #c_index>*","");
	}
}
function viewAmount(index,cid,action)
{
	$("#billamt"+index).show();
	$('#bill_error'+index).hide();
	var amount	=	$("#amount"+index).val();
	var remarks	=	$("#remarks"+index).val();
	$.ajax({
            url: ajaxurl,
            data: {'action':'spinkx_cont_campaign_ajax', 'mode':action,'cid': cid,'amount':amount,'remarks':remarks},
            type: "post",
            datatype: 'json',
            success: function(data)
            {
				data = $.parseJSON(data);
				if(action=='view')
                {
                    if(data.payment==1)
                    {
                            var content	=	"Your paid amount is : "+data.amount;
                    }
                    else
                    {
                            var content	=	"Your payment is pending.</br>Payment amount is : "+data.amount;
                    }
                    $("#payment-desc"+index).html(content);
                }
                else
                {
                    if(data.status=='true')
                    {
                        $('#bill_error'+index).html("Payment recieved");
                        $('#bill_error'+index).css({"color": "green","text-align": "center","display": "none"});
                        $('#bill_error'+index).show();
                        setTimeout(function() {
                          $('#billingModal'+index).modal('hide');
                          $('#c_index').load(location.href +" #c_index>*","");
                        }, 2000);



                    }
                    else
                    {
                        $('#bill_error'+index).css({"color": "red","text-align": "center","display": "none"});
                        $('#bill_error'+index).show();
                    }

                }

            }
	});
}