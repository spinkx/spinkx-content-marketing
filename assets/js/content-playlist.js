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

jQuery( document ).ready(function() {

    jQuery(document).on("click","input.onoffswitch-checkbox",function() {
        var dataid = jQuery(this).attr("data-id");
        switch (dataid) {
            case "all_local":
                break;
            case "all_global":
                break;
            default:
                changePostStatus(jQuery(this));
        }
    });
    window.onload = function() {
        jQuery('.categories').multiselect({
            columns: 1,
            placeholder: 'Select Categories',
            search: true,
            selectAll: true
        });
    };
    jQuery('.notice-spnx').show();

    /*jQuery('.spinkx-popover-close').on('click', function(){
        jQuery(this).parent().hide();

    });*/

    jQuery(document).on("click","button.updatecategories",function() {
        var dataid = jQuery(this).attr('data-id');
        categories = jQuery('#bp_categories_'+dataid).val();
        var formData = new FormData();
        formData.append('action', 'spinkx_cont_bp_update_categories');
        formData.append('site_cat', categories);
        formData.append('post_id', dataid);
        jQuery.ajax({
            type: 'POST',
            url: ajaxurl ,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                data = JSON.parse(data);
                if (data.success) {
                    jQuery.growl.notice({
                        message: data.msg,
                        location: 'tr',
                        size: 'large'
                    });
                    window.location.reload();
                } else {
                    jQuery.growl.error({
                        message: data.msg,
                        location: 'tr',
                        size: 'large'
                    });
                }
            },
            failure: function (data) {
                //jQuery('#ab_posts_pause_loading').bPopup().close();
                jQuery.growl.error({
                    message: " Request to server failed, kind;y retry or contact support ! ",
                    location: 'tr',
                    size: 'large'
                });
                console.log(data);
            }
        });
    });

    jQuery("#sortby_local_reach").click(function () {
        console.log(global_start_date);
        //var start = jQuery('#drp-input-startdate')._$startDate.val().format('YYYY-MM-DD');
        //var end =  jQuery('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD');
        var url = addParameter(window.location.href, "post_type", "local");
        url = addParameter(url, "sortby", "reach");
        url = addParameter(url, "from_date", global_start_date);
        url = addParameter(url, "to_date", global_end_date);
        window.location.href = url;
    });
    jQuery("#sortby_local_ctr").click(function () {
       // var start = jQuery('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD');
       // var end =  jQuery('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-DD');
        var url = addParameter(window.location.href, "post_type", "local");
        url = addParameter(url, "sortby", "engagement");
        url = addParameter(url, "from_date", global_start_date);
        url = addParameter(url, "to_date", global_end_date);
        window.location.href = url;

    });
    jQuery("#bwki_sites_display #sortby_global_reach").click(function () {
      //  var start = jQuery('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD');
      //  var end =  jQuery('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-DD');
        var url = addParameter(window.location.href, "post_type", "global");
        url = addParameter(url, "sortby", "reach");
        url = addParameter(url, "from_date", global_start_date);
        url = addParameter(url, "to_date", global_end_date);
        window.location.href = url;

    });
    jQuery("#bwki_sites_display #sortby_global_ctr").click(function () {
      //  var start = jQuery('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD');
      //  var end =  jQuery('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-DD');
        var url = addParameter(window.location.href, "post_type", "global");
        url = addParameter(url, "sortby", "engagement");
        url = addParameter(url, "from_date", global_start_date);
        url = addParameter(url, "to_date", global_end_date);
        window.location.href = url;

    });

    jQuery('.spnx-sync').powerTip({
        placement: 'n',
        smartPlacement: true
    });

    jQuery('.spnx-sync').click(function(){
        var sid = jQuery(this).attr('id');
        jQuery('.se-pre-con').bPopup( { modalClose: false } );
        jQuery.ajax({
            url : ajaxurl,
            data: {'action': 'spinkx_cont_update_post_sync_cpl'},
            type : 'get',
            success : function(data){
            jQuery('.se-pre-con').bPopup().close();
            window.location.reload();
            },
            failure : function(data){
                jQuery('.se-pre-con').bPopup().close();
            }
        });
    });    
    
});
function all_onoff(type){
   // var dataid = jQuery("#playpauseswitch_"+type+"_all").attr("data-id");
    changePostStatus(type);
}

function getAttachmentData(buttonObj, ishook) {
    ishook = typeof ishook !== 'undefined' ? ishook : false;
    if(jQuery('.addhook_form').length) {
        console.log("Add Hook form already exists in DOM ");
        return;
    }

    if(ishook) {
        var post_id = jQuery(buttonObj).parents('tr').find('td .main2').attr('parent_post_id');
    } else {
        var post_id = jQuery(buttonObj).parents('tr').find('td .main').attr('global_pid');
    }
    jQuery('.se-pre-con').bPopup( { modalClose: false } );
    jQuery.ajax({
        url : ajaxurl,
        data : {
            'action': 'spinkx_cont_get_attachment_data',
            'post_id': post_id,
        },
        type : 'get',
        datatype : 'json',
        success : function(data){
            jQuery('.se-pre-con').bPopup().close();
            data = JSON.parse(data)
            if(data['success']) {
                if(ishook){
                    jQuery(buttonObj).parents('tr').css('display', 'none');}
                var div = jQuery("<ul></ul>");
                for(var i = 0; i < data.data.length; i++){
                    var img = '<li onclick="replaceChooseImage('+post_id+',\''+data.data[i]+'\'); return false;" class="addhook_each_photo"> <a href="#"> <img  src="'+data.data[i]+'" id="variation_imgs_'+post_id+'" class="variation_imgs" /> </a> </li>';
                    div.append(img);
                }
                var addhook_form = '<td> \
						<div id="addhook_form_'+post_id+'" class="addhook_form form-group"><form name="frm_addhook_form_'+post_id+'" onsubmit="event.preventDefault(); return submitVariationForm(this);" method="post" class="frm_addhook_form" id="frm_addhook_form_'+post_id+'" enctype="multipart/form-data" data-ishook='+ishook+'>\
							<div class="addhook_choose_image"><img  id="addhook_image_src_'+post_id+'" /></div> \
							<div class="addhook_title"><input class="form-control" placeholder="Variation Headline" id="addhook_title_'+post_id+'" name="title"/></div> \
							<div class="addhook_excerpt"><textarea id="addhook_excerpt_'+post_id+'" class="form-control" placeholder="Enter your Excerpt here" name="excerpt"></textarea></div>  \
							<button  type="submit" class="button-cmn-class-bp-cmp-spnx"  style="float:right !important; margin-top:42px; color:#fff; background-color:#1dbd45;">SAVE &amp; ACTIVATE</button>\
							<button  onclick="jQuery(this).parents(\'tr\').prev().css(\'display\', \'\'); jQuery(this).parents(\'tr\').remove();" type="button" class="btn-cancle-spnx-main-cls"  style="float:right; margin:42px 10px 0 0; border-radius:0;  color:#fff; ">CANCEL</button>\
							</form></div> \
							</td>\
							<td>\
							<div class="addhook_images_selector">'+div.prop('outerHTML')+'</div> \
							</td>';

                jQuery(buttonObj).parents('tr').after('<tr>'+addhook_form+'</tr>');


                if(ishook){
                    var title = jQuery(buttonObj).parents('tr').find(".playlist_post_title").html();
                    var desc = jQuery(buttonObj).parents('tr').find(".playlist_post_desc p").html();
                    var image = jQuery(buttonObj).parents('tr').find(".playlist_img img").prop("src");
                    jQuery("#addhook_title_"+post_id).val(title);
                    jQuery("#addhook_image_src_"+post_id).prop("src",image);
                    jQuery("#addhook_excerpt_"+post_id).html(desc);


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
            }else{
                jQuery.growl.error({ message: data.growl,
                    location: 'tr',
                    size: 'large' });
            }
        },
        failure : function(data){
            console.log(" Request failed");
            jQuery.growl.error({ message: "HTTP Request failed !",
                location: 'tr',
                size: 'large' });
            jQuery('#ab_posts_pause_loading').bPopup().close();
        }
    });
}


function submitVariationForm(formObj) {
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
    var title = jQuery("#addhook_title_"+post_id).val();
    var img = jQuery("#addhook_image_src_"+post_id);
    var excerpt = jQuery("#addhook_excerpt_"+post_id).val();
    excerpt = excerpt.trim();
    formData.append('image_url',img.prop('src'));
    formData.append('image_aid',img.attr('data-id'));
    formData.append('action','spinkx_cont_save_hook');
    if(g_site_id && title &&  img  &&  excerpt) {
        jQuery.ajax({
            url : ajaxurl ,
            data : formData,
            type : 'POST',
            enctype: 'multipart/form-data',
            cache:false,
            contentType: false,
            processData: false,
            success : function(data){
                //console.log(data);
                if(data == 'success') {
                    jQuery('.se-pre-con').bPopup().close();
                    window.location.reload();
                }
            },
            failure : function(data){
                jQuery('.se-pre-con').bPopup().close();
            }
        });
    }
    else{
        jQuery.growl.error({ message: "One of the fields is empty !",
            location: 'tr',
            size: 'large' });
        console.log("one of the fields is empty");
    }

    return false;

}

function replaceChooseImage(post_id, img_src){
    jQuery("#addhook_image_src_"+post_id).prop('src',img_src);
    jQuery("#addhook_image_src_"+post_id).attr('data-id', jQuery('#variation_imgs_'+post_id).attr('data-id'));
}
function refreshStat(){
    jQuery('#bwki_sites_display tr').each(function(){
    });
}

function showHooks(v){
    var jQueryparent_tr = jQuery(v);
    var parent_post_id = jQuery(v).parent('td').parent('tr').prev('tr').attr("parent_post_id");
    var global_pid = jQuery(v).attr("global_pid");
    var site_id = '<?php echo jQuerysite_id?>';
    var row_id = jQuery(v).attr("row_id");
    jQuery( 'tr.removechilds' ).not(jQuery(v)).remove();
    jQuery('.ab-show-all').not('#toggle_'+row_id).removeClass( "show_toggled_on" );
    /***********************************************************/
    if( jQuery(v).hasClass( "show_toggled_on" ) ) {
        jQuery( 'tr.removechilds' ).remove();
        jQuery(v).removeClass( "show_toggled_on" );
    } else {

        jQuery('#ab_posts_pause_loading').bPopup( { modalClose: false } );
        jQuery.ajax({
            url : ajaxurl,
            data : {
                'action':   'spinkx_cont_new_hook',
                'global_pid' 		: global_pid,
                'parent_post_id' 	: parent_post_id,
                'site_id' 			: site_id,
                'from_date'         : jQuery('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD'),
                'to_date'            : jQuery('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-DD'),
            },
            type : 'post',
            datatype : 'json',
            success : function(data){
                jQueryparent_tr.addClass( 'show_toggled_on' );
                jQuery( data ).insertAfter(jQueryparent_tr.closest('tr'));
                jQuery('#ab_posts_pause_loading').bPopup().close();
            },
            failure : function(data){
                jQuery('#ab_posts_pause_loading').bPopup().close();
            }
        });
    }
}
function editAB(v){
    var ab_id = jQuery(v).parent('tr').attr('ab_id');
    title = jQuery(v).children('b').html();
    content = jQuery(v).children('div').html()
    var html = '<form onsubmit="editAB_submit(this);return false;" class="hooks_edit_form"  id="form_'+ab_id+'">'+
        '<div class="row" style="padding:5px"><input name="title" value="'+title+'"    type="text" placeholder="Title" data-validation="required" data-validation-error-msg="Ouch!Title is required"></div>'+
        '<div class="row" style="padding:5px"><textarea name="excerpt"  placeholder="Excerpt"  data-validation="required" data-validation-error-msg="Oh!Fill me please">'+content+'</textarea></div>'+
        '<div class="row">'+
        '<div class="col-sm-4"><button class="btn btn-primary" id="submit">Update</button></div><div class="col-sm-3"><button class="btn btn-danger" id="cancel" onClick="cancelEdit(this);return false;">CANCEL</button></div></form>';
    jQuery(v).html(html);
}

function ab_submit(v){
    var row_id = jQuery(v).parent().parent().attr("row_id");
    var post_id = jQuery(v).parent().parent().parent('td').parent('tr').prev('tr').attr("parent_post_id");
    var global_pid = jQuery(v).parent().parent().parent('td').parent('tr').prev('tr').attr("global_pid");
    var site_id = jQuery(v).parent().parent().parent('td').parent('tr').prev('tr').attr("site_id");
    var formData = new FormData(v);
    formData.append("parent_post_id", post_id);
    formData.append("global_pid", global_pid);
    formData.append("site_id", site_id);
    jQuery('.se-pre-con').bPopup( { modalClose: false } );
    jQuery.ajax({
        type : "POST",
        url : SPINKX_CONTENT_PLUGIN_URL + 'assets/campaigns/campajx.php?hooks=on',
        data : formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){
            jQuery('.se-pre-con').bPopup().close();
            jQuery('input[type="text"], textarea ,file').val('');
            jQuery('#error_'+row_id).html(data);
            //jQuery('#add_'+post_id).hide();
            jQuery('.removechilds' ).remove();
            jQuery('#toggle_'+row_id+'.ab-show-all').removeClass( "show_toggled_on" );
            jQuery('#add_'+row_id).toggle();
            jQuery('#toggle_'+row_id+'.ab-show-all').trigger("click");


        },
        error: function(data){
            console.log("error");
            console.log(data);
        }
    });

}
/**
 * Cancel the edit event for hooks
 **/
function cancelEdit(v){
    var parent_id = jQuery(v).closest('form').parent('td').parent('tr').attr('parent_post_id');
    var row_id = jQuery('.main[parent_post_id='+parent_id+']').attr('row_id');
    jQuery('.removechilds' ).remove();
    jQuery('#toggle_'+row_id+'.ab-show-all').removeClass( "show_toggled_on" );
    jQuery('#toggle_'+row_id+'.ab-show-all').trigger("click");
}

/**
 * Delete event for hooks
 **/

function deleteAB(v){
    var ab_id =  jQuery(v).attr('child_id');
    var parent_id = jQuery(v).parent('span').parent('li').parent('ul').parent('td').parent('tr').attr('parent_post_id');
    var row_id = jQuery('.main[parent_post_id='+parent_id+']').attr('row_id');
    //alert(parent_id);
    jQuery('#confirm_hooks_delete').modal({
            backdrop: 'static',
            keyboard: false })
        .one('click', '#delete', function (e) {
            //delete here
            jQuery('.se-pre-con').bPopup( { modalClose: false } );
            jQuery.ajax({
                type : "POST",
                url : SPINKX_CONTENT_PLUGIN_URL + 'includes/settings/ajax/deleteHook.php',
                data : {id:ab_id},
                success:function(data){
                    jQuery('.se-pre-con').bPopup().close();
                    jQuery('.removechilds' ).remove();
                    jQuery('#toggle_'+row_id+'.ab-show-all').removeClass( "show_toggled_on" );
                    jQuery('#toggle_'+row_id+'.ab-show-all').trigger("click");

                },
                error: function(data){

                    console.log("Delete failed");
                }
            });

        });
}
function editAB_submit(v){
    var formData = new FormData(v);
    var ab_id = jQuery(v).parent('td').parent('tr').attr('ab_id');
    var parent_id = jQuery(v).parent('td').parent('tr').attr('parent_post_id');
    var row_id = jQuery('.main[parent_post_id='+parent_id+']').attr('row_id');
    formData.append("ab_id",ab_id);
    formdata.append('action', 'spinkx_cont_edit_hook');
    jQuery('.se-pre-con').bPopup( { modalClose: false } );
    jQuery.ajax({
        type : "POST",
        url : ajaxurl,
        data : formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){
            jQuery('.se-pre-con').bPopup().close();
            jQuery('.removechilds' ).remove();
            jQuery('#toggle_'+row_id+'.ab-show-all').removeClass( "show_toggled_on" );
            jQuery('#toggle_'+row_id+'.ab-show-all').trigger("click");
            //jQuery('#error_'+post_id).html(data);
        },
        error: function(data){
            console.log("error");
            console.log(data);
        }
    });
}

function play_pause_AB(v,u_type){
    var ab_id =  jQuery(v).attr('child_id');
    var parent_id = jQuery(v).parent('li').parent('ul').parent('td').parent('tr').attr('parent_post_id');
    //alert(parent_id);
    var row_id = jQuery('.main[parent_post_id='+parent_id+']').attr('row_id');
    jQuery.ajax({
        type : "POST",
        url : ajaxurl,
        data : {'action':'spinkx_cont_edit_hook','type':'status_update','child_id':ab_id,'status_type':u_type},
        success:function(data){
            jQuery('.removechilds' ).remove();
            jQuery('#toggle_'+row_id+'.ab-show-all').removeClass( "show_toggled_on" );
            jQuery('#toggle_'+row_id+'.ab-show-all').trigger("click");
            //jQuery('#error_'+post_id).html(data);
        },
        error: function(data){
            //console.log("error");
            //console.log(data);
        }
    });
}

function get_stat_now(start, end){

    jQuery.ajax({
        url : ajaxurl,
        type: 'get',
        datatype : 'json',
        data : {
            'action': 'spinkx_cont_get_content_playlist_stat',
            'site_id': g_site_id,
            'from_date' :  start.format('YYYY-MM-DD'),
            'to_date' : end.format('YYYY-MM-DD'),
        },
        success: function(data){
            var data = JSON.parse(data);
            jQuery.each(data,function(key,stat){
                var imp_string = '<ul>'
                    +'<li><span class="unclickable">L</span><h class="total_local_impressions">'+stat.total_local_impressions+'</h> <i class="fa fa-caret-up" style="color:#60bb46;"></i></li>'+
                    '<li><span class="unclickable">G</span><h class="total_global_impressions">'+stat.total_global_impressions+'</h><i class="fa fa-caret-up" style="color:#60bb46;"></i></li>'+
                    '<li><span class="unclickable">H</span><h class="h_total_impressions">'+stat.h_total_impressions+'</h><i class="fa fa-caret-down" style="color:red;"></i></li>'+
                    '</ul>';
                var click_string = '<ul>'+
                    '<li><span class="unclickable">L</span><h class="total_local_clicks">'+stat.total_local_clicks+'</h> <i class="fa fa-caret-up" style="color:#60bb46;"></i></li>'+
                    '<li><span class="unclickable">G</span><h class="total_global_clicks">'+stat.total_global_clicks+'</h> <i class="fa fa-caret-up" style="color:#60bb46;"></i></li>'+
                    '<li><span class="unclickable">H</span><h class="h_total_clicks">'+stat.h_total_clicks+'</h> <i class="fa fa-caret-down" style="color:red;"></i></li>'+
                    '</ul>';
                var ctr_string = '<ul>'+
                    '<li><span class="unclickable">L</span><h class="total_local_ctr"> '+stat.total_local_ctr+' </h><i class="fa fa-caret-up" style="color:#60bb46;"></i></li>'+
                    '<li><span class="unclickable">G</span><h class="total_global_ctr">'+stat.total_global_ctr+'</h> <i class="fa fa-caret-up" style="color:#60bb46;"></i></li>'+
                    '<li><span class="unclickable">H</span><h class="hooks_ctr">'+stat.hooks_ctr+'</h> <i class="fa fa-caret-down" style="color:red;"></i></li>'+
                    '</ul>';
                jQuery('#post_'+key+ ' span.playlist_post_reach_value' ).html(stat.total_local_impressions);
                jQuery('#post_'+key+ ' span.playlist_post_views_value' ).html(stat.total_local_clicks);
                jQuery('#post_'+key+ ' span.playlist_post_ctr_value' ).html(stat.total_local_ctr);
                jQuery('#post_'+key+ ' span.playlist_post_reach_value_g' ).html(stat.total_global_impressions);
                jQuery('#post_'+key+ ' span.playlist_post_views_value_g' ).html(stat.total_global_clicks);
                jQuery('#post_'+key+ ' span.playlist_post_ctr_value_g' ).html(stat.total_global_ctr);
            });
            jQuery('.se-pre-con').bPopup().close();
        }
    });
};


function updateCpm_bak() {
    var timeseconds = new Date().getTime() + 60000;
    jQuery('#clock').countdown(timeseconds, function (event) {
        var jQuerythis = jQuery(this);
        jQuerythis.html(event.strftime('Page will be refreshed within : <span>%H</span>:<span>%M</span>:<span>%S</span>'));
    });
    jQuery.ajax({
        url: ajaxurl,
        type: 'get',
        datatype: 'json',
        data: {
            'site_id': g_site_id,
            'from_date': jQuery('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD'),
            'to_date': jQuery('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-DD'),
        },
        success: function (data) {
            var data = JSON.parse(data);
            jQuery.each(data, function (key, stat) {
                var imp_string = '<ul>'
                    + '<li><span class="unclickable">L</span><h class="total_local_impressions">' + stat.total_local_impressions + '</h> <i class="fa fa-caret-up" style="color:#60bb46;"></i></li>' +
                    '<li><span class="unclickable">G</span><h class="total_global_impressions">' + stat.total_global_impressions + '</h><i class="fa fa-caret-up" style="color:#60bb46;"></i></li>' +
                    '<li><span class="unclickable">H</span><h class="h_total_impressions">' + stat.h_total_impressions + '</h><i class="fa fa-caret-down" style="color:red;"></i></li>' +
                    '</ul>';
                var click_string = '<ul>' +
                    '<li><span class="unclickable">L</span><h class="total_local_clicks">' + stat.total_local_clicks + '</h> <i class="fa fa-caret-up" style="color:#60bb46;"></i></li>' +
                    '<li><span class="unclickable">G</span><h class="total_global_clicks">' + stat.total_global_clicks + '</h> <i class="fa fa-caret-up" style="color:#60bb46;"></i></li>' +
                    '<li><span class="unclickable">H</span><h class="h_total_clicks">' + stat.h_total_clicks + '</h> <i class="fa fa-caret-down" style="color:red;"></i></li>' +
                    '</ul>';
                var ctr_string = '<ul>' +
                    '<li><span class="unclickable">L</span><h class="total_local_ctr"> ' + stat.total_local_ctr + ' </h><i class="fa fa-caret-up" style="color:#60bb46;"></i></li>' +
                    '<li><span class="unclickable">G</span><h class="total_global_ctr">' + stat.total_global_ctr + '</h> <i class="fa fa-caret-up" style="color:#60bb46;"></i></li>' +
                    '<li><span class="unclickable">H</span><h class="hooks_ctr">' + stat.hooks_ctr + '</h> <i class="fa fa-caret-down" style="color:red;"></i></li>' +
                    '</ul>';

                cell_imp = table.cell('#post_' + key, 3);
                cell_imp.data(imp_string).draw(false);
                cell_click = table.cell('#post_' + key, 4);
                cell_click.data(click_string).draw(false);
                cell_ctr = table.cell('#post_' + key, 5);
                cell_ctr.data(ctr_string).draw(false);
            });
        }
    });
}

function changePostStatus(the_element) {
    var status = null;
    var site_id = null;
    var post_id = null;
    var post_type= null;
    var post_enbp = null;
    if (typeof the_element === 'string' || the_element instanceof String) {
        post_id = the_element;
        status = jQuery("#playpauseswitch_"+the_element+"_all").prop("checked");
        site_id = jQuery("#playpauseswitch_"+the_element+"_all").attr("data-site");
        if(the_element === 'local') {
            post_type = 'l';
        } else {
            post_type = 'g';
        }

    } else {
        var dataid = the_element.attr("data-id");
         status = the_element.prop("checked");
         temp = dataid.split("_");
         site_id = temp[1];
         post_id = temp[2];
         post_type = temp[0];
         if(temp[3] !== undefined) {
             post_enbp = temp[3];
         }
    }
    var enabled = status ? 1 : 0;
    jQuery('.se-pre-con').bPopup({modalClose: false});
    jQuery.ajax({
        url: ajaxurl,
        data: {
            'action': 'spinkx_cont_play_pause_post',
            'post_id': post_id,
            'site_id': site_id,
            'post_type': post_type,
            'status': enabled,
            'post_enbp': post_enbp
        },
        type: 'post',
        datatype: 'json',
        success: function (data) {
            console.log(data);
            var data = JSON.parse(data);
            if (typeof the_element === 'string' || the_element instanceof String) {
                if (data.error == 1) {
                    jQuery.growl.error({
                        message: data.msg,
                        location: 'tr',
                        size: 'large'
                    });
                    the_element.prop("checked", false);
                } else {
                    if(the_element === 'local') {
                        post_type = 'onoff_local';
                        if (data.msg >= 1 && enabled == 1) {
                            jQuery("input."+post_type).prop("checked", true);
                        } else {
                            jQuery("input."+post_type).prop("checked", false);
                        }
                    } else {
                        post_type = 'onoff_global';
                        if (data.msg >= 1 && enabled == 1) {
                            jQuery("input."+post_type).prop("checked", true);
                        } else {
                            jQuery("input."+post_type).prop("checked", false);
                        }
                    }
                    jQuery.growl.notice({
                        message: "Successfully Status updates",
                        location: 'tr',
                        size: 'large'
                    });
                }
                jQuery('.se-pre-con').bPopup().close();
               // window.location.reload();
            } else {
                if (data.error == 1) {
                    jQuery.growl.error({
                        message: data.msg,
                        location: 'tr',
                        size: 'large'
                    });
                    the_element.prop("checked", false);
                } else {
                    if (data.msg == "active" || data.msg == 1) {
                        the_element.prop("checked", true);
                    } else {
                        the_element.prop("checked", false);
                    }
                    jQuery.growl.notice({
                        message: "Successfully Status updates",
                        location: 'tr',
                        size: 'large'
                    });
                }
            }
            jQuery('.se-pre-con').bPopup().close();
        },
        failure: function (data) {
            jQuery.growl.error({
                message: " Request to server failed !",
                location: 'tr',
                size: 'large'
            });
        }
    });
}

function changeAbStatus(v) {

    var post_id = jQuery(v).attr("data_id");
    var global_pid = jQuery(v).attr("global_pid");
    var parent_class = jQuery(v);
    var child_class = jQuery(v).children();
    var row_id = jQuery(v).parent('td').parent('tr').attr("row_id");
    jQuery('.se-pre-con').bPopup({modalClose: false});
    jQuery.ajax({
        url: ajaxurl,
        data: {
            'action': 'spinkx_cont_play_pause_post',
            'post_id': post_id,
            'global_pid': global_pid,
            'type': 'ab_status'
        },
        type: 'post',
        datatype: 'json',
        success: function (data) {
            jQuery('.se-pre-con').bPopup().close();
            if (data == "active") {

                parent_class.removeClass('off_danger');
            } else {

                parent_class.addClass('off_danger');
            }
            jQuery('.removechilds').remove();
            jQuery('#toggle_' + row_id + '.ab-show-all').removeClass("show_toggled_on");
            jQuery('#toggle_' + row_id + '.ab-show-all').trigger("click");

        },
        failure: function (data) {
            console.log(data);
            alert('Failed!!!');
        }
    });
}

function triggerFileUpload(v) {
    var id = jQuery(v).parent().parent().attr('ab_id');
    jQuery("input[id='img_" + id + "']").click();
}

function upload(v) {
    var ab_id = jQuery(v).parent().parent('td').parent('tr').attr('ab_id');
    var formData = new FormData(jQuery('#image_only_' + ab_id)[0]);
    var parent_id = jQuery(v).parent().parent('td').parent('tr').attr('parent_post_id');
    var row_id = jQuery('.main[parent_post_id=' + parent_id + ']').attr('row_id');
    formData.append("ab_id", ab_id);
    formData.append("type", "image_only");
    jQuery('.se-pre-con').bPopup({modalClose: false});
    jQuery.ajax({
        type: "POST",
        url: SPINKX_CONTENT_PLUGIN_URL + 'assets/campaigns/campajx.php?hooks=on',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            jQuery('.se-pre-con').bPopup().close();
            jQuery('input[type="file"]').val('');
            alert(data);
            //jQuery('#add_'+post_id).hide();
            jQuery('.removechilds').remove();
            jQuery('#toggle_' + row_id + '.ab-show-all').removeClass("show_toggled_on");
            jQuery('#toggle_' + row_id + '.ab-show-all').trigger("click");


        },
        error: function(data) {
            console.log("error");
            console.log(data);
        }
    });
}

var boost_post_id;

function getEstimation() {
    var remaining = parseInt(jQuery('#max_credit_left').text());
    var creditpoint = parseInt(jQuery('#credit_points').val());

    var reach = Math.ceil(creditpoint * 10);
    var lessreach = Math.ceil(reach - (20 / 100 * reach));
    var percent = parseFloat((creditpoint / remaining) * 100).toFixed(2);

    if (creditpoint > remaining) {
        jQuery.growl.error({
            message: "You can't spend more than what you have , enter credits value <=  " + remaining,
            location: 'tr',
            size: 'large'
        });

        jQuery('#credit_points').val("0");
        percent = 0.00;
    }

    jQuery('#left_div_modal_body #estimation_reach').remove();
    jQuery('#left_div_modal_body .progress').remove();

    if (creditpoint > 0) {
       jQuery('#left_div_modal_body .form-group:eq(0)').after('<div id="estimation_reach"> Estimated ' + lessreach + ' - ' + reach + ' people </div><div class="progress">' +
            '<div class="progress-bar" role="progressbar" aria-valuenow="' + percent + '" ' +
            'aria-valuemin="0" aria-valuemax="100" style="width:' + percent + '%">' +
            '<span>' + percent + '%</span></div></div>');
    }
}

function setPostId(v) {
    boost_post_id = jQuery(v).parents('tr').find('td .main').attr('global_pid');
    var formData = new FormData();
    formData.append("post_id", boost_post_id);
    formData.append("action", 'spinkx_cont_get_credit_points');
    jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            jQuery('form#boostpost #credit_points').val('');
            jQuery('div.modal-body div#left_div_modal_body > table').remove();
            jQuery('div.modal-body div#left_div_modal_body > div#temp_div').remove();
            post_img = jQuery(v).parents('tr').find('span.playlist_img > img').attr('src');
            jQuery('div.modal-body div.boost_img > img').attr('src', post_img);
            post_title = jQuery(v).parents('tr').find('a.playlist_post_title').text();
            jQuery('div.modal-body h4.boost_post_title').text(post_title);
            post_content = jQuery(v).parents('tr').find('div.playlist_post_desc').text();
            jQuery('div.modal-body p.boost_post_desc').text(post_content);
            jQuery('#left_div_modal_body #estimation_reach').remove();
            jQuery('#left_div_modal_body .progress').remove();
            jQuery('#left_div_modal_body h4').remove();
            data = JSON.parse(data);
            if (data.success) {
                var tb = jQuery('<h4> Boost Settings </h4> <table class="table" id="show_estimation"><tr><th>Credits Left</th><th>Estimated Reach</th><th>Est. Engagement</th></tr>' +
                    '<tr><td id="max_credit_left">' + parseFloat(data.credit).toFixed(2) + '</td><td>' + parseFloat(data.credit * 10).toFixed(2) + '</td><td>' + parseFloat(2 / 100 * (data.credit * 10)).toFixed(2)
                    + '</td></tr></table>');
                jQuery('div.modal-body>div#left_div_modal_body').prepend(tb);
                jQuery('div.modal-body').find("input,button,textarea,select").removeAttr("disabled");
                var catArray = [];
                for (i = 0; i < data.categories.length; i++) {
                    catArray.push(data.categories[i].c_id);
                }
                jQuery(".site-cat-multiple").val(catArray).change();
                //jQuery(".site-cat-multiple").select2("val", [2]);

            } else {
                jQuery('div.modal-body>div#left_div_modal_body').prepend('<div id="temp_div" style="color:red">' + data.msg + '</div>');
                jQuery('div.modal-body').find("input,button,textarea,select").attr("disabled", "disabled");
            }
            jQuery('#boostmodal').modal('show');
        },
        failure: function (data) {
            console.log(data);
        }
    });

}

function showMsgRegister() {
    jQuery('#boostmodalshowMsg').modal('show');
}

function boost_submit(formObj) {
    var formData = new FormData(formObj);
    formData.append('post_id', boost_post_id);
    formData.append('action', 'spinkx_cont_update_credit_points');
    jQuery.ajax({
        type: 'POST',
        url: ajaxurl ,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            data = JSON.parse(data);
            if (data.success) {
                jQuery.growl.notice({
                    message: data.msg,
                    location: 'tr',
                    size: 'large'
                });
                jQuery('#boostmodal .close').trigger('click');
                //window.location.href = window.location.href+"&jumpto="+boost_post_id;
                window.location.reload();
            } else {
                jQuery.growl.error({
                    message: data.msg,
                    location: 'tr',
                    size: 'large'
                });
            }
        },
        failure: function (data) {
            //jQuery('#ab_posts_pause_loading').bPopup().close();
            jQuery.growl.error({
                message: " Request to server failed, kind;y retry or contact support ! ",
                location: 'tr',
                size: 'large'
            });
            console.log(data);
        }
    });
}

function getAttachmentDataVideo(buttonObj, ishook) {
    ishook = typeof ishook !== 'undefined' ? ishook : false;
    if(jQuery('.addhook_form').length) {
        console.log("Add Hook form already exists in DOM ");
        return;
    }
    if(ishook) {
        var post_id = jQuery(buttonObj).parents('tr').find('td .main2').attr('parent_post_id');
    } else {
        var post_id = jQuery(buttonObj).parents('tr').find('td .main').attr('global_pid');
    }
    if(ishook) { jQuery(buttonObj).parents('tr').css('display', 'none'); }
    var div = jQuery("<ul></ul>");
    var addhook_form = '<td> \
            <div id="addhook_videoform_'+post_id+'" class="addhook_form addhook_videoform form-group"><form name="frm_addhook_videoform_'+post_id+'" onsubmit="event.preventDefault(); return submitVideoVariationForm(this);" method="post" class="frm_addhook_form" id="frm_addhook_form_'+post_id+'" enctype="multipart/form-data" data-ishook='+ishook+'>\
                <div class="addhook_choose_video"><div id="div_YouTube'+post_id+'"><img  id="addhook_image_src_'+post_id+'" /></div></div> \
                <div class="addhook_form2"><div class="addhook_title" style="width: auto"><input class="form-control video_url" placeholder="Video URL" id="addhook_video_url_'+post_id+'" name="video_url" /></div> \
                <div class="addhook_title"><input class="form-control" placeholder="Video Title" id="addhook_video_title_'+post_id+'" name="title"/></div> \
                <div class="addhook_excerpt addhook_excerpt2"><textarea id="addhook_video_excerpt_'+post_id+'" class="form-control" placeholder="Add your Video Description ..." name="excerpt"></textarea></div>  \
                <button  type="submit" class="button-cmn-class-bp-cmp-spnx"  style="float:right !important; margin-top:62px; color:#fff; background-color:#1dbd45; margin-right: 10px;">SAVE &amp; ACTIVATE</button>\
                <button  onclick="jQuery(this).parents(\'tr\').prev().css(\'display\', \'\'); jQuery(this).parents(\'tr\').remove();" type="button" class="btn-cancle-spnx-main-cls"  style="float:right!important; margin:62px 10px 0 0; border-radius:0;  color:#fff; ">CANCEL</button>\
                </div></form></div> \
                </td>\
                <td>\
                </td>';
    var addhook_form = '<td> \
						<div id="addhook_form_'+post_id+'" class="addhook_form  addhook_videoform form-group"><form name="frm_addhook_videoform_'+post_id+'" onsubmit="event.preventDefault(); return submitVideoVariationForm(this);" method="post" class="frm_addhook_form" id="frm_addhook_form_'+post_id+'" enctype="multipart/form-data" data-ishook='+ishook+' style="margin-left:10px;padding-top: 10px;">\
							 <div class="addhook_choose_video" style="display: none"><div id="div_YouTube'+post_id+'"><img  id="addhook_image_src_'+post_id+'" /></div></div>';

                            if(!ishook) {
                                addhook_form += '<div class="addhook_form2"><div class="addhook_title addhook_title2"><input class="form-control video_url" placeholder="Video URL" id="addhook_video_url_' + post_id + '" name="video_url" /></div>';
                            } else {
                                addhook_form += '<div class="addhook_form2" style="height:107px;">';
                            }
							addhook_form += '<div class="addhook_title addhook_title2" style="margin-top: 13px;margin-bottom: 13px;"><input class="form-control" placeholder="Video Title" id="addhook_video_title_'+post_id+'" name="title"/></div> \
							<div class="addhook_excerpt2" style=""><textarea id="addhook_video_excerpt_'+post_id+'" class="form-control" placeholder="Add your Video Description ..." name="excerpt" style="height:50px;"></textarea></div>  \
							<button  type="submit" class="button-cmn-class-bp-cmp-spnx"  style="float:right !important; margin-top:19px; color:#fff; background-color:#1dbd45;">SAVE &amp; ACTIVATE</button>\
							<button  onclick="jQuery(this).parents(\'tr\').prev().css(\'display\', \'\'); jQuery(this).parents(\'tr\').remove();" type="button" class="btn-cancle-spnx-main-cls"  style="float:right !important; margin:19px 10px 0 0; border-radius:0;  color:#fff; ">CANCEL</button>\
							</div></form></div> \
							</td>\
							<td></td>';
    jQuery(buttonObj).parents('tr').after('<tr>'+addhook_form+'</tr>');


    if(ishook){
        var title = jQuery(buttonObj).parents('tr').find(".playlist_post_title").html();
        var desc = jQuery(buttonObj).parents('tr').find(".playlist_post_desc p").html();
        var video_url = jQuery(buttonObj).parents('tr').find(".playlist_img iframe").prop("src");
        jQuery("#addhook_video_title_"+post_id).val(title);
        jQuery("#addhook_video_excerpt_"+post_id).html(desc);
        videoArr = video_url.split('/');
        video_id = videoArr[videoArr.length - 1];
        videoArr = video_id.split('?');
        video_id = videoArr[0];
       // jQuery("#addhook_video_url_"+post_id).val(video_id);
        vid = 'div_YouTube' + post_id;
        jQuery('#frm_addhook_form_'+post_id+' .addhook_choose_video').show();
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
     //   console.log(video_id);
        video_id = temp_arr[1];
        jQuery("#"+vid).attr("src", "https://www.youtube.com/embed/"+video_id);
    } else {
        temp_arr = video_id.split('?v=');
       // console.log(temp_arr);
        video_id = temp_arr[1];
      //  console.log(video_id);
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
    }
    else{
        jQuery.growl.error({ message: "One of the fields is empty !",
            location: 'tr',
            size: 'large' });
        jQuery('.se-pre-con').bPopup().close();
        //console.log("one of the fields is empty");
    }
    return false;
}
function loadDT(startDate, endDate) {
    //jQuery('.se-pre-con').bPopup( { modalClose: false } );
    pt.from_date = startDate;
    pt.to_date = endDate;
    var table = jQuery("#bwki_sites_display").DataTable({
        "pageLength": pageLength,
        "serverSide": true,
        "deferRender": true,
        "ordering": false,
        "destroy":true,
        "language": {
            "lengthMenu": "Display_MENU_Posts"
        },
        "ajax": {
            beforeSend: function(){
               // jQuery('.se-pre-con').bPopup( { modalClose: false } );
            },
            headers: {
                "Accept" : "application/json; charset=utf-8",
                "Content-Type": "application/javascript; charset=utf-8",
                "Access-Control-Allow-Origin" : "*"
            },
            "url": spinkx_server_baseurl + '/wp-json/spnx/v1/content-playlist',
            "dataType": "jsonp",
            data: pt,
            complete: function(){
                jQuery('.se-pre-con').bPopup().close();
                jQuery('#wpcontent').css('height',jQuery('#bwki_sites_display').height()+250);
            },
        },

    });
}
function getpoints() {
    jQuery('#boostmodal').modal('hide');
    jQuery('#boostmodalbuyPoint').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
    });
}
function modifiedcategory($id) {
    jQuery('#bp_categories_'+$id).multiselect({
        columns: 1,
        placeholder: 'Select Categories',
        search: true,
        selectAll: true
    });
    jQuery(".modified-category-"+$id).toggle();
}