function addParameter(url, parameterName, parameterValue, atStart){
    replaceDuplicates = true;
    if(url.indexOf('#') > 0){
        var cl = url.indexOf('#');
        urlhash = url.substring(url.indexOf('#'),url.length);
    } else {
        urlhash = '';
        cl = url.length;
    }
    sourceUrl = url.substring(0,cl);

    var urlParts = sourceUrl.split("?");
    var newQueryString = "";

    if (urlParts.length > 1)
    {
        var parameters = urlParts[1].split("&");
        for (var i=0; (i < parameters.length); i++)
        {
            var parameterParts = parameters[i].split("=");
            if (!(replaceDuplicates && parameterParts[0] == parameterName))
            {
                if (newQueryString == "")
                    newQueryString = "?";
                else
                    newQueryString += "&";
                newQueryString += parameterParts[0] + "=" + (parameterParts[1]?parameterParts[1]:'');
            }
        }
    }
    if (newQueryString == "")
        newQueryString = "?";

    if(atStart){
        newQueryString = '?'+ parameterName + "=" + parameterValue + (newQueryString.length>1?'&'+newQueryString.substring(1):'');
    } else {
        if (newQueryString !== "" && newQueryString != '?')
            newQueryString += "&";
        newQueryString += parameterName + "=" + (parameterValue?parameterValue:'');
    }
    return urlParts[0] + newQueryString + urlhash;
};
var flag_reload = false;
jQuery( document ).ready(function() {
    jQuery(document).on("click","input.onoffswitch-checkbox",function() {
        var dataid = jQuery(this).attr("data-id");
        switch (dataid) {
            case "all_local":
                break;
            case "all_global":
                break;
            default:
                changeCampaignStatus(jQuery(this));
        }
    });

    jQuery("#sortby_local_reach").click(function () {
        var start = jQuery('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var end =  jQuery('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-DD');
        var url = addParameter(window.location.href, "post_type", "local");
        url = addParameter(url, "sortby", "reach");
        url = addParameter(url, "from_date", start);
        url = addParameter(url, "to_date", end);
        window.location.href = url;
    });
    jQuery("#sortby_local_ctr").click(function () {
        var start = jQuery('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var end =  jQuery('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-DD');
        var url = addParameter(window.location.href, "post_type", "local");
        url = addParameter(url, "sortby", "engagement");
        url = addParameter(url, "from_date", start);
        url = addParameter(url, "to_date", end);
        window.location.href = url;

    });
    jQuery(document).on("click", 'table tbody tr.camp-group-tr', function(){
       jQuery(this).nextUntil( ".camp-group-tr" ).toggle();
        $img_object = jQuery(this).find('img');
        $img_next = $img_object.attr('data-mark');
        if($img_next == "right") {
            jQuery($img_object).css('transform', 'rotate(270deg)')
            jQuery($img_object).attr('data-mark', 'down');
        } else {
            jQuery($img_object).css('transform', 'rotate(0deg)')
            jQuery($img_object).attr('data-mark', 'right');
        }
    });

});

function createAd(buttonObj, campaign_id, $data) {
    //console.log( campaign_id )
    if(jQuery('.create-ad-main-div').length > 0) {
        return;
    }
    var campaign_image = '../wp-content/plugins/spinkx-content-marketing/assets/images/becreative.jpg';
    var campaign_headline = '';
    var campaign_excerpt = '';
    var campaign_call_to_action = 0;
    var campaign_landing_url = 'http://...Landing Url';
    var campaign_utm_source = 'spinkx';
    var campaign_utm_campaign = 'Campaign Name';
    var campaign_categories = [];
    var campaign_countries = [];
    var campaign_budget_amount = 0;
    var call_to_action_arr = ['Call to Action', 'None', 'Apply Now', 'Book Now','Contact Us', 'Download', 'Know More', 'Shop Now', 'Sign Up', 'Reserve', 'Participate'];
    var campaign_cpm_value = parseInt((1000/spinkxJs.cpm)*campaign_budget_amount);
    var campaign_start_date = start_camp;
    var campaign_end_date = end_camp;
    var test_lending_url = 'javascript:;void(0)';
    var camp_money_account = 0.00;
    var camp_balance_amount = 0.00;
    var wallet_balance_amount = 0.00;
    var optimise_for = 2;
    var campaign_display_name = 'Campaign Name';
    if(Number(jQuery('#user-balance').text()) > 0 ) {
        wallet_balance_amount =  Number(jQuery('#user-balance').text());
    }
    if(campaign_id) {
        jQuery('.se-pre-con').bPopup().close();
        campaign_image = $data.ad_image_url;
        campaign_headline = $data.campaign_title;
        campaign_excerpt = $data.campaign_description;
        campaign_call_to_action = $data.call_to_action;
        campaign_landing_url = $data.landing_url;
        campaign_utm_source = $data.utm_source;
        campaign_utm_campaign = $data.utm_campaign;
        campaign_categories = $data.categories;
        campaign_countries = $data.locations;
        campaign_budget_amount = $data.campaign_budget_amount;
        campaign_cpm_value = parseInt((1000/spinkxJs.cpm)*campaign_budget_amount);

        start_camp = moment($data.campaign_start_date);
        end_camp = moment($data.campaign_end_date);
        test_lending_url = campaign_landing_url + '?utm_source=' + campaign_utm_source + '&utm_medium=campaign&utm_campaign=' + campaign_utm_campaign;
        camp_money_account = Number($data.camp_alloc_money).toFixed(2);
        camp_balance_amount = Number($data.camp_balance_amount).toFixed(2);
        optimise_for = $data.optimise_for;
        campaign_display_name = $data.campaign_display_name;

    }
    var addhook_form = '<div class="create-ad-main-div"><form class="create-ad-form" method="post" enctype="multipart/form-data" id="c_form_new25">';
    addhook_form += '<div class="left-side-createad" style="background-color: #fff;height: 335px;border-radius: 10px;float: left; display: inline-block;width:175px; ">';
    addhook_form += '<div style="display: inline;float: left;">';
    addhook_form += '<div class="create-ad-field create-ad-image" style="height: auto;float: left;position: absolute;margin: 7px;">';
    addhook_form += '<span class="playlist_img" style="height: auto;margin-bottom: 6px;">';
    addhook_form += '<img  src="'+campaign_image+'" alt="" id="image-preview" style="height:auto;"/></span>';
    addhook_form += '<input type="hidden" name="image_attachment_id" id="image_attachment_id">';
    addhook_form += '<div class="create-ad-field create-ad-headline" style="margin-bottom: 5px;display: block; position: relative;padding: 2px;">';
    addhook_form += '<textarea class="form-control form-control2 splcaheholder" placeholder="This is your Campaign Headline. Click here to edit" id="campaign_title" name="campaign_title" style="height: 28px;line-height: 12px; margin-top: 5px; font-weight: 700;color: #337ab7;resize: none;width:155px;" rows="2" cols="30" maxlength="65">'+campaign_headline+'</textarea>';
    addhook_form +=  '<textarea id="campaign_description" class="form-control form-control2" placeholder="Introduce your campaign with a description ... Click here to edit" name="campaign_description" style="height:35px;line-height: 11px;resize: none;overflow: hidden;width:155px;" maxlength="100">'+campaign_excerpt+'</textarea>';
    addhook_form += '<select name="call_to_action" id="call-to-action">';
    temp_str = '';
    for( var index in call_to_action_arr) {
        temp_str2 = ( index == campaign_call_to_action )?'selected="selected"':'';
        temp_str += '<option value="' + index + '" '+ temp_str2 +'>' + call_to_action_arr[index] + '</option>';
    }
    addhook_form += temp_str;
    addhook_form += '</select>';
    addhook_form += '</div></div></div></div>';
    addhook_form += '<div style="display: inline-block; margin: 7px;">';
    addhook_form += '<span class="cad-icons"><input type="text" name="campaign_display_name" id="campaign_display_name" autocomplete="on"  value="'+campaign_display_name+'"/></span>';
    addhook_form += '<span class="cad-icons"><img src="../wp-content/plugins/spinkx-content-marketing/assets/images/camp-icons/url.png"/><input type="text" maxlength="legth" class="landing_url" name="landing_url" value="'+campaign_landing_url+'" autocomplete="off"/></span>';
    addhook_form += '<span class="cad-icons"><img src="../wp-content/plugins/spinkx-content-marketing/assets/images/camp-icons/utm.png" /><label style="font-weight: 100;font-size: 10px;margin-left: 10px;margin-top: 6px;">?utm_source=</label><input type="text" maxlength="10" class="utm-source" name="utm_source" value="'+campaign_utm_source+'"/><label style="font-weight: 100;font-size: 10px;margin-top: 6px;" autocomplete="off">&utm_medium=campaign&utm_campaign=</label><input type="text" maxlength="13" class="utm-campaign" name="utm_campaign" value="'+campaign_utm_campaign+'" autocomplete="off"/></span>';
    addhook_form += '<span class="cad-icons" style="height: 40px;" ><img src="../wp-content/plugins/spinkx-content-marketing/assets/images/camp-icons/targeting.png" style="float: left; margin-top: 4px;"/><div class="targeting-categories">';
    addhook_form += '<select name="categories[]" id="categories"  multiple>';
    temp_str = '';
    for( var index in spinkxJs.categories) {
        temp_str2 = ( campaign_categories.indexOf(index) > -1 )?'selected="selected"':'';
        temp_str += '<option value="' + index + '" '+ temp_str2 +'>' + spinkxJs.categories[index] + '</option>';
    }
    addhook_form += temp_str;
    addhook_form += '</select></div>';
    addhook_form += '<div class="targeting-countries"><select name="locations[]" id="locations" multiple >';
    temp_str = '';
    for( var index in spinkxJs.countries) {
        temp_str2 = ( campaign_countries.indexOf(index) > -1 )?'selected="selected"':'';
        temp_str += '<option value="' + index + '" '+ temp_str2 +'>' + spinkxJs.countries[index] + '</option>';
    }
    addhook_form += temp_str;
    addhook_form += '</select></div></span>';
    addhook_form +=  '<span class="cad-icons"><img src="../wp-content/plugins/spinkx-content-marketing/assets/images/camp-icons/budget.png" style="float: left;" /><div class="budget-optimise-for"><span style="vertical-align: middle">Campaign Budget</span>';
    addhook_form += '<i class="sub-heading fa ' + spinkxJs.currencyClass + '"></i> <input id="budget_amount" name="budget_amount" class="track" type="text" value="0" maxlength="6" autocomplete="off"><span style="font-size: 12px;">&nbsp;|</span>';
    addhook_form += '</div><div class="budget-date"><span>Duration</span><div id="reportrange_camp" class="pull-right"><span></span> <b class="caret"></b></div></div><input type="hidden" name="start_date" id="start_date" /><input type="hidden" name="end_date" id="end_date" /><select name="optimise_for" id="optimise_for">';
    if(optimise_for != 1 ) {
        addhook_form += '<option value="2">Reach</option><option value="1">Engagement</option>';
    } else {
        addhook_form += '<option value="2">Reach</option><option value="1" selected="selected">Engagement</option>';
    }
    addhook_form += ' </select><span class="cpm-outer-main">Est. ';
    if(optimise_for != 1 ) {
        addhook_form += 'Reach: ';
    } else {
        addhook_form += 'Engagement: ';
    }
    addhook_form += '<span id="cpm_value">0</span></span></span>';
    addhook_form += '<span class="cad-icons"><img src="../wp-content/plugins/spinkx-content-marketing/assets/images/camp-icons/pay.png" /><span class="add-money-message">Campaign Balance&nbsp;<i class="sub-heading fa ' + spinkxJs.currencyClass + '"></i>&nbsp;<span id="camp-money-account">'+camp_balance_amount+' </span><span id="camp-money-account-first" style="display: none">'+camp_balance_amount+' </span><input type="hidden" name="budget_amount_total" id="budget_amount_total" value="'+camp_money_account+'"/></span><span>&nbsp;&nbsp;| </span><button onClick="addMoneyForCampaign('+wallet_balance_amount+')" style="margin-right: 10px; font-size: 10px; font-weight: 500; color: #fff; border:0;background-color: #6fb7d5" type="button">Add Money</button><span style="font-size: 9px; font-weight: 400;">Wallet Balance=&nbsp;<i style="color:#23527c" class="sub-heading fa ' + spinkxJs.currencyClass + '"></i><span id="wallet_money_update">' + wallet_balance_amount + '</span>  <span style="display:none" class="parent-balance-span"><span class="without-percent-text"></span><span id="campain_balance_add">' + 0 + '</span></span>';
    addhook_form += '<span class="cad-icons"><span><a href="'+test_lending_url+'" id="test-landing-url" target="_blank">Click here to test Landing URL</a></span><span>&nbsp;&nbsp;| </span><span class="camp_agreement" style="margin-left: 5px;"><input type="checkbox" value="1" name="camp_agreement" checked style="margin: -3px 0 0 -4px;font-size: 17px;"/>&nbsp;&nbsp;<a href="https://www.spinkx.com/campaign-terms-conditions/" target="_blank">I agreee to terms and conditions</a></span></span>'
    addhook_form += '<input type="hidden" id="campaign-id" name="c_id" value="'+campaign_id+'"/>';
    addhook_form += '<div style="margin-left: 10px;display: inline-block;"><button  type="submit" class="button-cmn-class-bp-cmp-spnx" name="add_camp" style="float:right !important; margin-top:19px; color:#fff; background-color:#1dbd45;">SAVE &amp; ACTIVATE</button><button  type="button" class="btn-cancle-spnx-main-cls"  style="float:right !important; margin:19px 10px 0 0; border-radius:0;  color:#fff; " onclick="deleteCampaignMain(this, '+campaign_id+')">CANCEL</button></div>';
    addhook_form += '</form></div>';
    //jQuery('#button-create-ad').parents('tr').hide();
    imgHeight = jQuery('form.create-ad-form .playlist_img img').height();


    jQuery(buttonObj).parents('tr').after('<tr><td colspan="3">'+addhook_form+'</td></tr>');

    jQuery('form.create-ad-form div.left-side-createad').css('height',(imgHeight+107+'px'));
  //  jQuery('form.create-variation-form>div').css('height',(imgHeight+107+'px'));

    jQuery('#categories').multiselect({
        columns: 1,
        placeholder: 'Select Categories',
        search: true,
        selectAll: true
    });
    jQuery('#languages').multiselect({
        columns: 1,
        placeholder: 'Select languages',
        search: true,
        selectAll: true
    });
    jQuery('#locations').multiselect({
        columns: 1,
        placeholder: 'Select Countries',
        search: true,
        selectAll: true
    });

    jQuery('#start').datetimepicker({
        format: 'YYYY-MM-DD',
        locale: 'en'
    }).on("dp.change", function(e) {
        sflag = true;
        //  gm($('.track'));
    });
    jQuery('#end').datetimepicker({
        format: 'YYYY-MM-DD',
        locale: 'en'

    }).on("dp.change", function(e) {
        sflag = true;
        //gm($('.track'));
    });
    jQuery("#image-preview").load(function(){
        var imgheight = this.height;
        jQuery('form.create-ad-form div.left-side-createad').css('height',(imgheight+107+'px'));
    });


    jQuery("#reportrange_camp").daterangepicker({
        startDate: start_camp,
        endDate: end_camp,
        minDate:start_camp,
        ranges: {
            "7 Days": [moment(), moment().add(6, "days")],
            "15 Days": [moment(), moment().add(14, "days")],
            "30 Days": [moment(), moment().add(29, "days")]
        },

    }, cb_camp);
    cb_camp(start_camp, end_camp);
    jQuery("#start_date").val(start_camp.format("YYYY-MM-DD"));
    jQuery("#end_date").val(end_camp.format("YYYY-MM-DD"));
    jQuery("#reportrange_camp").on("apply.daterangepicker", function(ev, picker) {
        jQuery("#start_date").val(picker.startDate.format("YYYY-MM-DD"));
        jQuery("#end_date").val(picker.endDate.format("YYYY-MM-DD"));

    });
}



jQuery(document).ready(function($){
    $(document).on('focus', '.create-ad-form .create-ad-headline textarea', function(){
        $htextarea = $(this).val().trim();
        $hplaceholder = $(this).attr('placeholder');
        if( '' === $htextarea) {
            $(this).val('');
            $(this).attr('placeholder','')
        } else {
            $(this).val($htextarea.capitalize());
            $(this).attr('placeholder',$hplaceholder);
        }
    }).on('blur', '.create-ad-form .create-ad-headline textarea', function(){
        $htextarea = $(this).val().trim();
        $hplaceholder = $(this).attr('placeholder');
        if( '' === $htextarea) {
            $(this).val($htextarea);
            if( 0 === $( "textarea" ).index( this )  ) {
                $(this).attr('placeholder', 'This is your Campaign Headline. Click here to edit')
            } else {
                $(this).attr('placeholder', 'Introduce your campaign with a description ... Click here to edit')
            }
        } else {
            $(this).val($htextarea.capitalize());
            $hfieldname = $(this).attr('name');
            saveCampaign($hfieldname, $htextarea);
        }
    });

    $(document).on('focus', '.create-ad-form .utm-source', function(){
        $utm_source = $(this).val().trim();
        if( 'spinkx' === $utm_source) {
            $(this).val('');
        } else {
            $(this).val($utm_source);
        }
    }).on('blur', '.create-ad-form .utm-source', function(){
        $utm_source = $(this).val().trim();

        if( '' === $utm_source) {
            $(this).val('spinkx');
        } else {
            $(this).val($utm_source);
            $utm_campaign = $('.create-ad-form .utm-campaign').val().trim();
            if( '' !== $utm_campaign && 'Campaign Name' !== $utm_campaign) {
                $utm_code = '?utm_source=' + $utm_source + '&utm_medium=campaign&utm_campaign=' + $utm_campaign;
                $campaign_link = $('.create-ad-form .landing_url').val().trim();
                if( isValidUrl($campaign_link) ) {
                    $test_landing_url = $campaign_link + $utm_code;
                    $('#test-landing-url').attr('href', $test_landing_url);
                    saveCampaign('utm_code', $utm_source);
                }
            }
        }
    });

    $(document).on('focus', '.create-ad-form .utm-campaign', function(){
        $utm_campaign = $(this).val().trim();

        if( 'Campaign Name' === $utm_campaign) {
            $(this).val('');
        } else {
            $(this).val($utm_campaign);

        }
    }).on('blur', '.create-ad-form .utm-campaign', function(){
        $utm_campaign = $(this).val().trim();

        if( '' === $utm_campaign) {
            $(this).val('Campaign Name');
        } else {
            $(this).val($utm_campaign);
            $utm_source = $('.create-ad-form .utm-source').val().trim();
            if( '' !== $utm_source &&  'Campaign Name' !== $utm_source) {
                $utm_code = '?utm_source=' + $utm_source + '&utm_medium=campaign&utm_campaign=' + $utm_campaign
                $campaign_link = $('.create-ad-form .landing_url').val().trim();
                if( isValidUrl($campaign_link) ) {
                    $test_landing_url = $campaign_link + $utm_code;
                    $('#test-landing-url').attr('href', $test_landing_url);
                    saveCampaign('utm_code', $utm_source);
                }
            }

        }
    });

    $(document).on('focus', '.create-ad-form .landing_url', function(){
        $campaign_link = $(this).val().trim();
        if( 'http://...Landing Url' === $campaign_link) {
            $(this).val('');
        } else {
            $(this).val($campaign_link);
        }
    }).on('blur', '.create-ad-form .landing_url', function(){
       $campaign_link = $(this).val();
       if( '' === $campaign_link) {
           $(this).val('http://...Landing Url');
       } else {
           $(this).val($campaign_link);
           if( isValidUrl($campaign_link) ) {
               $utm_source = $('.create-ad-form .utm-source').val().trim();
               $utm_campaign = $('.create-ad-form .utm-campaign').val().trim();
               $test_landing_url = $campaign_link + '?utm_source=' + $utm_source + '&utm_medium=campaign&utm_campaign=' + $utm_campaign;
               $('#test-landing-url').attr('href',$test_landing_url);
               saveCampaign('landing_url', $campaign_link);
           } else {

           }
       }
   });

    $(document).on('focus', '.create-ad-form #campaign_display_name', function(){
        $campaign_link = $(this).val().trim();
        if( 'Campaign Name' === $campaign_link) {
            $(this).val('');
        } else {
            $(this).val($campaign_link);
        }
    }).on('blur', '.create-ad-form #campaign_display_name', function(){
        $campaign_link = $(this).val();
        if( '' === $campaign_link) {
            $(this).val('Campaign Name');
        } else {
            $(this).val($campaign_link);
            if( isValidUrl($campaign_link) ) {
                $utm_source = $('.create-ad-form .utm-source').val().trim();
                $utm_campaign = $('.create-ad-form .utm-campaign').val().trim();
                $test_landing_url = $campaign_link + '?utm_source=' + $utm_source + '&utm_medium=campaign&utm_campaign=' + $utm_campaign;
                $('#test-landing-url').attr('href',$test_landing_url);
                saveCampaign('landing_url', $campaign_link);
            } else {

            }
        }
    });

   $(document).on('change', '.create-ad-form #call-to-action', function(){
        $call_to_action = $(this).val();
       if( $call_to_action > 0 ) {
           //saveCampaign('call_to_action', $call_to_action);
       }
    });
    $(document).on('change', '.create-ad-form #budget_amount', function(){
        $budget = $(this).val();
        jQuery(this).removeClass('budget-amount-alert');
        $optimise_for = jQuery('#optimise_for').val();
        if( $optimise_for == 1 ) {
            $budget_amount = ( $budget / spinkxJs.cpc ).toFixed(0);
            $('.cpm-outer-main').html('Est. Engagement: <span id="cpm_value">'+$budget_amount+'</span>');
        } else {
            $budget_amount = parseInt((1000 / spinkxJs.cpm) * $budget);
            if ($budget_amount >= 1000) {
                $budget_amount = ($budget_amount / 1000).toFixed(1) + 'K';
            }
            //console.log($optimise_for);
            // $('#cpm_value').text($budget_amount);
            $('.cpm-outer-main').html('Est. Reach: <span id="cpm_value">'+$budget_amount+'</span>');
        }
        wallet_balance_amount =  Number(jQuery('#user-balance').text());
        $('#wallet_money_update').text(wallet_balance_amount);

        $budget_amount = ($budget - wallet_balance_amount).toFixed(2);
        $campfirst = Number($('#camp-money-account-first').text()).toFixed(2);
        $('#camp-money-account').text($campfirst);
        if( $budget_amount > 0 ) {
            $tax = ($budget_amount * 3 / 100).toFixed(2);
            $('.parent-balance-span .without-percent-text').text('Add ' + $budget_amount + ' + ' + $tax + ' = '  );
            $('#campain_balance_add').text( Math.round( ( $budget_amount * 1 + $tax * 1 )  ) );

            $('.parent-balance-span').show();
        } else {
            $('#campain_balance_add').text(0);
            $('.parent-balance-span').hide();
        }
    });

    $(document).on('change', '.create-ad-form #optimise_for', function(){
        $budget = jQuery('#budget_amount').val();
        $optimise_for = jQuery(this).val();
        if( $optimise_for == 1 ) {
            $budget_amount = ( $budget / spinkxJs.cpc ).toFixed(0);
            $('.cpm-outer-main').html('Est. Engagement: <span id="cpm_value">'+$budget_amount+'</span>');
        } else {
            $budget_amount = parseInt((1000 / spinkxJs.cpm) * $budget);
            if ($budget_amount >= 1000) {
                $budget_amount = ($budget_amount / 1000).toFixed(1) + 'K';
            }
            $('.cpm-outer-main').html('Est. Reach: <span id="cpm_value">'+$budget_amount+'</span>');
        }
    });

    $(document).on('click', '.cancelcampaign', function(){
       var result = confirm("Are you want to cancel this campaign and refund to wallet?", "Test");
       if (result) {
           cid = $(this).attr('data-id');
           cancelCampaign(cid);
        }
    });

    $(document).on('submit', '.create-ad-form', function(event){
        var msg = '';
        c = jQuery('#campaign-id').val();
        var t = jQuery("#campaign_display_name").val().trim();
        if( '' == t ||  'Campaign Name' == t ){
            msg += 'Campaign Name is missing\n';
        }
        t = jQuery("#campaign_title").val().trim();
        if( '' == t ||  'This is your Campaign Headline. Click here to edit' == t ){
            msg += 'Campaign Headline is missing\n';
        }
        t = jQuery("#campaign_description").val();
        if( '' == t || 'Introduce your campaign with a description ... Click here to edit' === t ){
            msg += 'Campaign description is missing\n';
        }
        t = jQuery("#call-to-action").val();
     //   console.log(t)
        if( '' == t || 0 == t ){
            msg += 'Call to Action is missing\n';
        }
        t = jQuery(".landing_url").val();
        if( '' == t || 'http://...Landing Url' === t ){
            msg += 'Landing url is missing\n';
        } else {
            if( ! isValidUrl(t) ) {
               msg += 'url is  not valid\n';
            }
        }
        t = jQuery(".utm-campaign").val();
     //   console.log(t)
        if( '' == t || 'Campaign Name' === t ){
            msg += 'Campaign Name blank\n';
        }
        t = jQuery("#categories").val();
     //   console.log(t)
        if( null == t ) {
            msg += 'Select categories\n';
        }
        /* t = jQuery("#languages").val();
         console.log(t)
         if( null == t ) {
         msg += 'languages\n';
         }*/
        t = jQuery("#locations").val();
     //   console.log(t)
        if( null == t ) {
            msg += 'Select countries\n';
        }
        /* t = jQuery("#optimise_for").val();
         console.log(t)
         if( '' == t || 0 == t ){
         msg += 'Campaign Type is not selected\n';
         }*/
        /*t = jQuery("#budget_amount").val();
        t1 = parseInt(jQuery("#budget_amount_total").val());
        if(t != t1 ) {
           msg += 'Please Add money to campaign\n';
           jQuery("#budget_amount_total").val(t1);
        }*/


        t = jQuery("#start_date").val();
     //   console.log(t)
        if(  '' == t || 0 == t  ) {
            msg += 'start date is must fill\n';
        }
        t = jQuery("#end_date").val();
        console.log(t)
        if(  '' == t || 0 == t  ) {
            msg += 'end date is must fill\n';
        }
        t = jQuery("#image_attachment_id").val();

      //  console.log(t)
        if( ( '' == t || 0 == t  ) && ( null == c || undefined == c ) ) {
            msg += 'image is not selected\n';
        }

        t = jQuery("input[name=camp_agreement]");

        if( ! t.is(':checked') ) {
            msg += 'agree is must fill\n';
        }

        if( msg.length <= 0 ) {
            //jQuery(this).unbind('submit').submit();

            return true;
        } else {
            event.preventDefault();
            alert(msg);
            return false;
        }
    });



});

function cancelCampaign( cid ) {
    var form_data = new FormData();
    form_data.append('action', 'spinkx_cont_campaign_refund_amount');
    form_data.append('cid', cid);
    jQuery.ajax({
        url : ajaxurl,
        data : form_data,
        type : 'POST',
        cache:false,
        contentType: false,
        processData: false,
        success : function(data){
            data = JSON.parse(data);
            jQuery('.se-pre-con').bPopup().close();
            if( data.error ) {
                jQuery.growl.error({ message: data.msg,
                    location: 'tr',
                    size: 'large' });

            } else {
                jQuery.growl.notice({ message: data.msg,
                    location: 'tr',
                    size: 'large' });
                window.location.reload();
            }
        },
        failure : function(data){
            jQuery('.se-pre-con').bPopup().close();
        }
    });
    return false;
}
function cb_camp(start_camp, end_camp) {
    jQuery("#reportrange_camp span").html(start_camp.format("MMMM D, YYYY") + " - " + end_camp.format("MMMM D, YYYY"));
}
var start_camp =  moment();
var m = moment();
m.add( 6, 'days');

var end_camp =  moment(m);
var first_time_call = 0;
var spinkx_camp_queue = [];
var c_id = 0;
function saveCampaign(field_name, field_value) {
    return false;
   spinkx_camp_queue[field_name] = field_value;
   var formData = new FormData();
   formData.append('action', 'spinkx_cont_campaign_save');
   var flag = false;
   for( var key in spinkx_camp_queue) {
       formData.append(key, spinkx_camp_queue[key]);
   }
   if( c_id > 0 ) {
        formData.append('c_id',c_id);
   }
    jQuery.ajax({
        type: 'POST',
        url: ajaxurl ,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            if( 0 === first_time_call) {
                jQuery('.se-pre-con').bPopup({modalClose: false});
            }
        },
        success: function (data) {
            data = JSON.parse(data);
           jQuery('.se-pre-con').bPopup().close();
          if( data instanceof Object && data.c_id > 0) {
              c_id = data.c_id;
              first_time_call = 1;
          }
        },
        failure: function (data) {
            jQuery('.se-pre-con').bPopup().close();
            jQuery.growl.error({
                message: " Request to server failed, kind;y retry or contact support ! ",
                location: 'tr',
                size: 'large'
            });
            console.log(data);
        }
    });

}

function deleteCampaignMain(buttonObj, campaign_id) {
    if(flag_reload) {
        window.location.reload();
    } else {

        jQuery(buttonObj).parents('tr').prev().css('display', '');
        jQuery(buttonObj).parents('tr').remove();
    }

}
function addMoneyForCampaign( wallet_balance ) {
    $budget =  jQuery('#budget_amount').val() * 1;
    if( $budget == 0) {
        alert('Please Enter campaign budget amount.')
        jQuery('#budget_amount').addClass('budget-amount-alert');
        return;
    }
    jQuery('#budget_amount').removeClass('budget-amount-alert');
    if( $budget > wallet_balance ) {
        jQuery('#payment-method-button').trigger('click');
    } else {
       // jQuery('#budget_amount').val(wallet_balance);
        jQuery('#wallet_money_update').text((wallet_balance - $budget).toFixed(2));
        jQuery('#camp-money-account').text( ( Number( jQuery('#camp-money-account').text() ) * 1 + $budget * 1 ).toFixed(2) );
        jQuery('#campain_balance_add').text(0);
        flag_reload = true;
    }
    //jQuery('#payment-method-button').trigger('click');
}

function addMoneyInWallet() {
    jQuery('#payment-method-button').trigger('click');
}

function isValidUrl( $url ) {
    var re = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;
    if (re.test($url)) {
        return true;
    }
    return false;
}
String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

function get_data_from_campaign( buttonObj, campaign_id, campaign_type, parent_campaign_id ) {
   jQuery('.se-pre-con').bPopup({modalClose: false});
    jQuery(buttonObj).parents('tr').hide();
    var formData = new FormData();
    formData.append('action', 'spinkx_cont_campaign_get_data');
    formData.append('c_id', campaign_id);
    if( undefined !== campaign_type) {
        formData.append('campaign_type', campaign_type);
    }
    jQuery.ajax({
        type: 'POST',
        url: ajaxurl ,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
            //jQuery('.se-pre-con').bPopup({modalClose: false});
        },
        success: function (data) {
          jQuery('.se-pre-con').bPopup().close();
            data = JSON.parse(data);
            jQuery('.se-pre-con').bPopup().close();
            if( undefined === campaign_type) {
                createAd(buttonObj, campaign_id, data)
            } else if( 'video' === campaign_type) {

                createVideoVariation(buttonObj, parent_campaign_id, campaign_id, data)
            } else  {
                jQuery(buttonObj).parents('tr').hide();
                createVariation(buttonObj, parent_campaign_id, campaign_id, data)
            }

        },
        failure: function (data) {
            jQuery('.se-pre-con').bPopup().close();
            jQuery.growl.error({
                message: " Request to server failed, kindly retry or contact support ! ",
                location: 'tr',
                size: 'large'
            });
            console.log(data);
        }
    });

}

function createVariation(buttonObj, parent_campaign_id, campaign_id, $data) {
    //console.log( campaign_id )
    var campaign_image = '../wp-content/plugins/spinkx-content-marketing/assets/images/becreative.jpg';
    var campaign_headline = '';
    var campaign_excerpt = '';
    var call_to_action_arr = ['Call to Action', 'None', 'Apply Now', 'Book Now','Contact Us', 'Download', 'Know More', 'Shop Now', 'Sign Up', 'Reserve', 'Participate'];
    var campaign_call_to_action = 0;

    if(campaign_id) {
        jQuery('.se-pre-con').bPopup().close();
        campaign_image = $data.ad_image_url;
        campaign_headline = $data.campaign_title;
        campaign_excerpt = $data.campaign_description;
        campaign_call_to_action = $data.call_to_action;
    }
    var addhook_form='<div class="create-variation-main-div"><form class="create-variation-form" method="post" enctype="multipart/form-data" id="c_form_new25">';
    addhook_form += '<div style="background-color: #fff;height:335px; border-radius: 10px;float: left; display: inline-block;width:175px; ">';
    addhook_form += '<div style="display: inline;float: left;">';
    addhook_form += '<div class="create-ad-field create-ad-image" style="height: auto;float: left;position: absolute;margin: 7px;">';
    addhook_form += '<span class="playlist_img" style="height: auto;margin-bottom: 6px;">';
    addhook_form += '<img  src="'+campaign_image+'" alt="" id="image-preview" class="manage-height-spnx" style="height:auto;"/></span>';
    addhook_form += '<input type="hidden" name="image_attachment_id" id="image_attachment_id">';
    addhook_form += '<div class="create-ad-field create-ad-headline" style="margin-bottom: 5px;display: block; position: relative;padding: 2px;">';
    addhook_form += '<textarea class="form-control form-control2 splcaheholder" placeholder="This is your Campaign Headline. Click here to edit" id="campaign_title" name="campaign_title" style="height: 28px;line-height: 12px; margin-top: 5px; font-weight: 700;color: #337ab7;resize: none;width:155px;" rows="2" cols="30" maxlength="65">'+campaign_headline+'</textarea>';
    addhook_form +=  '<textarea id="campaign_description" class="form-control form-control2" placeholder="Introduce your campaign with a description ... Click here to edit" name="campaign_description" style="height:35px;line-height: 11px;resize: none;overflow: hidden;width:155px;" maxlength="100">'+campaign_excerpt+'</textarea>';
    addhook_form += '<select name="call_to_action" id="call-to-action">';
    temp_str = '';
    for( var index in call_to_action_arr) {
        temp_str2 = ( index == campaign_call_to_action )?'selected="selected"':'';
        temp_str += '<option value="' + index + '" '+ temp_str2 +'>' + call_to_action_arr[index] + '</option>';
    }
    addhook_form += temp_str;
    addhook_form += '</select>';
    addhook_form += '</div></div></div></div>';
    addhook_form += '<input type="hidden" id="parent-campaign-id" name="parent_campaign_id" value="'+parent_campaign_id+'"/>';
    if( undefined === campaign_id ) {
        addhook_form += '<input type="hidden" id="campaign-id" name="c_id" value="0"/>';
    } else {
        addhook_form += '<input type="hidden" id="campaign-id" name="c_id" value="'+campaign_id+'"/>';
    }

    addhook_form += '<div style="margin-left: 10px;display: inline-block;"><button  type="submit" class="button-cmn-class-bp-cmp-spnx" name="add_camp" style="float:right !important; margin-top:19px; color:#fff; background-color:#1dbd45;">SAVE &amp; ACTIVATE</button><button  type="button" class="btn-cancle-spnx-main-cls"  style=" right !important; margin:19px 10px 0 0; border-radius:0;  color:#fff; " onclick="deleteCampaignMain(this, '+campaign_id+')">CANCEL</button></div>';
    addhook_form += '</form></div>';
    //jQuery('#button-create-ad').parents('tr').hide();
    jQuery(buttonObj).parents('tr').after('<tr><td colspan="3">'+addhook_form+'</td></tr>');
    imgHeightnew = jQuery('form.create-variation-form .playlist_img img').height();
    if(imgHeightnew>0) {
        jQuery('form.create-variation-form>div').css('height',(imgHeightnew+107+'px'));
    }
    else {
        jQuery('form.create-variation-form>div').css('height',(340+'px'));
    }

}

jQuery(document).ready(function($) {
    $(document).on('focus', '.create-variation-form .create-ad-headline textarea', function () {
        console.log($(this));
        $htextarea = $(this).val().trim();
        $hplaceholder = $(this).attr('placeholder');
        if ('' === $htextarea) {
            $(this).val('');
            $(this).attr('placeholder', '')
        } else {
            $(this).val($htextarea.capitalize());
            $(this).attr('placeholder', $hplaceholder);
        }
    }).on('blur', '.create-variation-form .create-ad-headline textarea', function () {
        $htextarea = $(this).val().trim();
        $hplaceholder = $(this).attr('placeholder');
        if ('' === $htextarea) {
            $(this).val($htextarea);
            if (0 === $("textarea").index(this)) {
                $(this).attr('placeholder', 'This is your Campaign Headline. Click here to edit')
            } else {
                $(this).attr('placeholder', 'Introduce your campaign with a description ... Click here to edit')
            }
        } else {
            $(this).val($htextarea.capitalize());
            $hfieldname = $(this).attr('name');
            saveCampaign($hfieldname, $htextarea);
        }
    });

    $(document).on('change', '.create-variation-form #call-to-action, .create-video-form #call-to-action', function () {
        $call_to_action = $(this).val();
        if ($call_to_action > 0) {
            saveCampaign('call_to_action', $call_to_action);
        }
    });

    $(document).on('submit', '.create-variation-form', function(event) {
        var msg = '';
        var t = jQuery("#campaign_title").val().trim();
        if ('' == t || 'This is your Campaign Headline. Click here to edit' == t) {
            msg += 'Campaign Headline is missing\n';
        }
        t = jQuery("#campaign_description").val();
        console.log(t)
        if ('' == t || 'Introduce your campaign with a description ... Click here to edit' === t) {
            msg += 'Campaign description is missing\n';
        }
        t = jQuery("#call-to-action").val();
        console.log(t)
        if ('' == t || 0 == t) {
            msg += 'Call to Action is missing\n';
        }
        t = jQuery("#image_attachment_id").val();
        console.log('t'+( '' == t || 0 == t ));
        c = jQuery('#campaign-id').val();
        console.log(c);
        console.log('c'+( null == c || undefined == c ));
        console.log(( '' == t || 0 == t  ) && ( null == c || undefined == c || '' == c));
        if (( '' == t || 0 == t  ) && ( null == c || undefined == c || '' == c)) {
            msg += 'image is not selected\n';
        }
        if( msg.length <= 0 ) {
            //jQuery(this).unbind('submit').submit();
            console.log('submit');
            return true;
        } else {
            alert(msg);
            return false;
        }
    });
    $(document).on('submit', '.create-video-form', function(event) {
        var msg = '';
        var t = jQuery("input[name=campaign_title]").val().trim();
        if ('' == t || 'This is your Campaign Headline. Click here to edit' == t) {
            msg += 'Video Tittle is missing\n';
        }
        t = jQuery("textarea[name=campaign_description]").val();
        console.log(t)
        if ('' == t || 'Introduce your campaign with a description ... Click here to edit' === t) {
            msg += 'Video description is missing\n';
        }
        t = jQuery("#call-to-action").val();
        console.log(t)
        if ('' == t || 0 == t) {
            msg += 'Call to Action is missing\n';
        }
        t = jQuery("input[name=ad_image_url]").val().trim();
        if ( '' == t || 0 == t  ) {
            msg += 'Video Url\n';
        }
        if( msg.length <= 0 ) {
            //jQuery(this).unbind('submit').submit();
            console.log('submit');
            return true;
        } else {
            alert(msg);
            return false;
        }
    });
});


function changeCampaignStatus(the_element) {
    var status = null;
    var user_id = null;
    var post_id = null;
    var post_type= null;
    var dataid = the_element.attr("data-id");
    status = the_element.prop("checked");
    temp = dataid.split("_");
    user_id = temp[1];
    post_id = temp[2];
    post_type = temp[0];

    var enabled = status ? 1 : 0;
    jQuery('.se-pre-con').bPopup({modalClose: false});
    jQuery.ajax({
        url: ajaxurl,
        data: {
            'action': 'spinkx_cont_play_pause_campaigns',
            'post_id': post_id,
            'user_id': user_id,
            'post_type': post_type,
            'status': enabled
        },
        type: 'post',
        datatype: 'json',
        success: function (data) {
            jQuery('.se-pre-con').bPopup().close();
            var data = JSON.parse(data);
                if (data.error == 1) {
                    jQuery.growl.error({
                        message: data.msg,
                        location: 'tr',
                        size: 'large'
                    });
                    the_element.prop("checked", !enabled);
                } else {
                    if (data.msg == "active" || data.msg == 1) {
                        the_element.prop("checked", enabled);
                    } else {
                        the_element.prop("checked", enabled);
                    }
                    jQuery.growl.notice({
                        message: "Successfully Status updates",
                        location: 'tr',
                        size: 'large'
                    });
                }
            jQuery('.se-pre-con').bPopup().close();
        },
        failure: function (data) {
            jQuery('.se-pre-con').bPopup().close();
            jQuery.growl.error({
                message: " Request to server failed !",
                location: 'tr',
                size: 'large'
            });
        }
    });
}

function createVideoVariation(buttonObj, parent_campaign_id, campaign_id, $data) {
    ishook = typeof ishook !== 'undefined' ? ishook : false;
    if(jQuery('.addhook_videoform').length) {
        console.log("Add Hook form already exists in DOM ");
        return;
    }
    var campaign_headline = '';
    var campaign_excerpt = '';
    var call_to_action_arr = ['Call to Action', 'None', 'Apply Now', 'Book Now','Contact Us', 'Download', 'Know More', 'Shop Now', 'Sign Up', 'Reserve', 'Participate'];
    var campaign_call_to_action = 0;
    var video_url = '';

    if(campaign_id) {
        jQuery('.se-pre-con').bPopup().close();
        campaign_headline = $data.campaign_title;
        campaign_excerpt = $data.campaign_description;
        campaign_call_to_action = $data.call_to_action;
        video_url  = $data.ad_image_url;
    }
    var div = jQuery("<ul></ul>");
    var addhook_form = '<td colspan="2"> \
						<div id="addhook_form_'+campaign_id+'" class="addhook_form  addhook_videoform form-group"><form name="frm_addhook_videoform_'+campaign_id+'" method="post" class="frm_addhook_form create-video-form" id="frm_addhook_form_'+campaign_id+'" enctype="multipart/form-data" data-ishook='+ishook+' style="margin-left:10px;padding-top: 10px;">\
							 <div class="addhook_choose_video" style="display: none"><div id="div_YouTube'+campaign_id+'"><img  id="addhook_image_src_'+campaign_id+'" /></div></div>';

    if(!campaign_id) {
        addhook_form += '<div class="addhook_form2" style="height:160px;"><div class="addhook_title addhook_title2"><input class="form-control video_url" placeholder="Video URL" id="addhook_video_url_' + campaign_id + '" name="ad_image_url" value="'+video_url+'" /></div>';
    } else {
        addhook_form += '<div class="addhook_form2" style="height:142px;">';
    }
    addhook_form += '<div class="addhook_title addhook_title2" style="margin-top: 13px;margin-bottom: 13px;"><input class="form-control" placeholder="Video Title" id="addhook_video_title_'+campaign_id+'" name="campaign_title" value="'+campaign_headline+'"/></div> \
							<div class="addhook_excerpt2" style=""><textarea id="addhook_video_excerpt_'+campaign_id+'" class="form-control" placeholder="Add your Video Description ..." name="campaign_description" style="height:50px;">'+campaign_excerpt+'</textarea></div>';
    addhook_form += '<div class="addhook_title addhook_title2"><select name="call_to_action" id="call-to-action"  style="height: 30px;">';
    temp_str = '';
    for( var index in call_to_action_arr) {
        temp_str2 = ( index == campaign_call_to_action )?'selected="selected"':'';
        temp_str += '<option value="' + index + '" '+ temp_str2 +'>' + call_to_action_arr[index] + '</option>';
    }
    addhook_form += temp_str;
    addhook_form += '</select></div></div>';
    addhook_form += '<input type="hidden" id="parent-campaign-id" name="parent_campaign_id" value="'+parent_campaign_id+'"/>';
    if( undefined === campaign_id ) {
        addhook_form += '<input type="hidden" id="campaign-id" name="c_id" value="0"/>';
    } else {
        addhook_form += '<input type="hidden" id="campaign-id" name="c_id" value="'+campaign_id+'"/>';
    }
    addhook_form += '<input type="hidden" name="is_video" value="1"/>';
    addhook_form += ' <button  type="submit" class="button-cmn-class-bp-cmp-spnx" name="add_camp" style="float:right !important; margin-top:19px; color:#fff; background-color:#1dbd45;">SAVE &amp; ACTIVATE</button>\
							<button  onclick="deleteCampaignMain(this, '+campaign_id+')" type="button" class="btn-cancle-spnx-main-cls"  style="float:right; margin:19px 10px 0 0; border-radius:0;  color:#fff; ">CANCEL</button>\
							</div></form></div> \
							</td>\
							<td></td>';
    //jQuery('#button-create-ad').parents('tr').hide();
    jQuery(buttonObj).parents('tr').after('<tr>'+addhook_form+'</tr>');


    if(campaign_id){
        video_url  = $data.ad_image_url;
        videoArr = video_url.split('/');
        video_id = videoArr[videoArr.length - 1];
        videoArr = video_id.split('=');
        video_id = videoArr[1];
        // jQuery("#addhook_video_url_"+post_id).val(video_id);
        vid = 'div_YouTube' + campaign_id;
        jQuery('#frm_addhook_form_'+campaign_id+' .addhook_choose_video').show();
        onYouTubeIframeAPIReady(vid, video_id );
    }
    // to show overlay over hook image selector
    var jQueryoverlay = jQuery('<div id="addhook_images_overlay"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i></div>');
    jQuery(".addhook_each_photo span")
        .mouseenter(function(){

            jQuery(this).append(jQueryoverlay.show());

        })
        .mouseleave(function(){
            jQueryoverlay.hide();
        });



}
jQuery(document).on('change','.video_url',function(){
    var tid = jQuery(this).attr('id');
    tidArr = tid.split('_');
    var vid = 'div_YouTube' + tidArr[tidArr.length-1];
    var video_id = jQuery(this).val();
    if(jQuery('#'+vid).length && jQuery('#'+vid).parent().find('iframe').length > 0) {
        temp_arr = video_id.split('?v=');
       //  console.log(temp_arr);
          // console.log(video_id);
        video_id = temp_arr[1];
        jQuery("#"+vid).attr("src", "https://www.youtube.com/embed/"+video_id);
    } else {
        temp_arr = video_id.split('?v=');
        //console.log(temp_arr);
        video_id = temp_arr[1];
        //console.log(video_id);
        onYouTubeIframeAPIReady(vid, video_id );

    }
    jQuery('#frm_addhook_form_'+tidArr[tidArr.length-1]+' .addhook_choose_video').show();

});

function onYouTubeIframeAPIReady(id, video_id, is_edit) {
    var player;
    if(typeof id !== "undefined") {
        player = new YT.Player(id, {
            videoId: video_id,     // THE VIDEO ID.
            width: 390,
            height: 200,
            playerVars: {
                'autoplay': 0,
                'controls': 1,
                'showinfo': 0,
                'modestbranding': 0,
                'loop': 0,
                'fs': 0,
                'cc_load_policty': 0,
                'wmode': 'opaque',
                'iv_load_policy': 3
            },
            events: {
                'onReady': function (e) {
                    e.target.mute();
                    e.target.setVolume(50);      // YOU CAN SET VALUE TO 100 FOR MAX VOLUME.
                }
            }
        });
    }

}
function submitVideoVariationForm(formObj) {
    jQuery('.se-pre-con').bPopup( { modalClose: false } );
    var formData = new FormData(formObj);
    formData.append('site_id',  g_site_id);
    var idArr = jQuery(formObj).attr('id').split("_");
    var post_id = idArr[idArr.length - 1];
    if( jQuery(formObj).data("ishook")) {
        // If hook update then add hook_id as POST param
        formData.append("hook_id", jQuery(formObj).data("ishook") );

    }
    formData.append('parent_post_id', post_id);
    var title = jQuery("#addhook_video_title_"+post_id).val();
    var excerpt = jQuery("#addhook_video_excerpt_"+post_id).val();
    console.log(jQuery(formObj[0]).val());
    if(!jQuery(formObj).data("ishook")) {
        if(jQuery(formObj[0]).val() == '' ) {
            jQuery.growl.error({ message: 'video url missing',
                location: 'tr',
                size: 'large' });
            jQuery('.se-pre-con').bPopup().close();
            return false;
        }
        var img = jQuery("#addhook_video_url_"+post_id);
        formData.append('image_url', img.prop('src'));
        formData.append('image_aid',img.attr('data-id'));
    } else {
        var img = true;
    }
    formData.append('type','video');

    formData.append('action','spinkx_cont_save_hook');
    if(g_site_id && title &&  img  &&  excerpt) {
        jQuery.ajax({
            url : ajaxurl,
            data : formData,
            type : 'POST',
            enctype: 'multipart/form-data',
            cache:false,
            contentType: false,
            processData: false,
            success : function(data){

                if(data == 'success') {
                    jQuery('.se-pre-con').bPopup().close();
                    jQuery.growl.notice({ message: "Video Saved",
                        location: 'tr',
                        size: 'large' });
                    window.location.reload();
                } else {
                    jQuery.growl.error({ message: data,
                        location: 'tr',
                        size: 'large' });
                    jQuery('.se-pre-con').bPopup().close();
                }
            },
            failure : function(data){
                jQuery('.se-pre-con').bPopup().close();
            }
        });
    } else {
        jQuery.growl.error({ message: "One of the fields is empty !",
            location: 'tr',
            size: 'large' });
        jQuery('.se-pre-con').bPopup().close();
        //console.log("one of the fields is empty");
    }
    return false;
}
function loadDT(startDate,endDate) {
    //jQuery(\'#bpopup_ajax_loading\').bPopup( { modalClose: false } );
    pt.from_date = global_start_date;
    pt.to_date = global_end_date;
    var table = jQuery("#bwki_sites_display").DataTable({
        "pageLength": pageLength,
        "processing": false,
        "ordering": false,
        "serverSide": true,
        "destroy":true,
        "language": {
            "lengthMenu": "Display _MENU_ Posts"
        },
        "ajax": {
            beforeSend: function(){
                //jQuery('.se-pre-con').bPopup( { modalClose: false } );
            },
            headers: {
                "Accept" : "application/json; charset=utf-8",
                "Content-Type": "application/javascript; charset=utf-8",
                "Access-Control-Allow-Origin" : "*"
            },
            "url": spinkx_server_baseurl + '/wp-json/spnx/v1/campaign',
            "dataType": "jsonp",
            data: pt,
            complete: function(){
                jQuery('.camp-group-name').parents('tr').addClass("camp-group-tr");
                jQuery('.camp-group-name').parent().attr('colspan', '3');
                jQuery('.camp-group-name').parent().next().remove();
                jQuery('.camp-group-name').parent().next().remove();
                //$datalength = jQuery('.camp-group-name').attr('data-length');
                jQuery('.se-pre-con').bPopup().close();
            },
        },

    });
}
