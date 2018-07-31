jQuery(document).ready(function($) {

    $(".widget-checkbox").on("click", function(){
        var site_id = g_site_id;
        var widget_id = $(this).attr("data-id");
        var name = $(this).attr("name");
        var status = $(this).prop("checked");
        $.ajax({
            url : ajaxurl,
            type : "get",
            datatype : "json",
            data : {
                'action': 'spinkx_cont_change_widget_status',
                "site_id" : site_id,
                "widget_id": widget_id,
                "status": status,
                "name": name
            },
            success : function(data){

            }
        });
    });
    $(".mn-txt-cmn-dv").click(function() {
        if(!$(this).children('i').hasClass('activewidget')) {
            $('.cmn-cls-cntnr .mn-txt-cmn-dv >i').removeClass('activewidget');
            $('.sb-ctgry-cmn-cls').hide();
        }
        $(this).next('.sb-ctgry-cmn-cls').toggle();
        $(this).children('i').toggleClass("activewidget");
        var height=$(".acc-mn-dv-cntainr").height();


        var test=$(this).children('i').hasClass("activewidget");
        if(!(test)) {
            $(".acc-mn-dv-cntainr").css({'height':198+'px','overflow':'hidden'});
        }
        else {
             $(".acc-mn-dv-cntainr").css({'height':198+'px','overflow':'hidden'});

           $(this).parents(".acc-mn-dv-cntainr").css({'height':400+'px','overflow-y':'scroll'})

        }
    });
    $(".ul-mn-cls-chkbx li").click(function () {
        var checkbx = $(this).find("input");
        if(checkbx.is(':checked')) {
            checkbx.prop('checked', false);
        } else {
            checkbx.prop('checked', true);
        }
    });
    $(".chkbx-cmn-cls-li").click(function () {
        var checkbx = $(this).find("input");
        if(checkbx.is(':checked')) {
            checkbx.prop('checked', false);
        } else {
            checkbx.prop('checked', true);
        }
    });

/** widget custom js starts here **/
$(".unit_title_font_size").bind('blur',function() {
   var headline_font_size = $(this).val();
   if(headline_font_size < 7) {
       $(this).addClass('error_widget_val')
       return;
   } else {
      $(this).removeClass('error_widget_val');
   }

   $(this).parents('.cntnt_dstr_cntnr').find(".hd_txt_id_spx").css('font-size',+headline_font_size);
});
$(".unit_title_line_height").bind('blur',function() {
  var headline_line_height = $(this).val();
   if(headline_line_height < 7) {
       $(this).addClass('error_widget_val')
       return;
   } else {
      $(this).removeClass('error_widget_val');
   }
   $(this).parents('.cntnt_dstr_cntnr').find(".hd_txt_id_spx").css('line-height',+headline_line_height+'px');
}); 
$(".unit_title_font_style").bind('change',function() {
   var headline_font_style = $(this).val();
    $(this).parents('.cntnt_dstr_cntnr').find(".hd_txt_id_spx").css('font-weight',headline_font_style);
});
$(".unit_title_font_case").bind('change',function() {
   var headline_font_case = $(this).val();
   $(this).parents('.cntnt_dstr_cntnr').find(".hd_txt_id_spx").css('text-transform',headline_font_case);
});

$(".unit_add_line_style").bind('change',function() {
   var line_style = $(this).val();
   var parent = head_parent=null;
   if(line_style=='aboveimg') {
      parent = $(this).parents('.cntnt_dstr_cntnr').find(".hd_txt_id_spx_dv");
      $(this).parents('.cntnt_dstr_cntnr').find(".hd_txt_id_spx_dv").remove();
       head_parent = $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_main_container_spnx");
       $(parent).clone().prependTo(head_parent);
       $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_main_container_spnx>.hd_txt_id_spx_dv").addClass("aboveimg_cls_spx");
   }
    else {
    $(this).parents('.cntnt_dstr_cntnr').find(".aboveimg_cls_spx").removeClass("aboveimg_cls_spx");
     var container = $(this).parents('.cntnt_dstr_cntnr').find('.design_unit_hdline_container');
     $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_hdline_container").remove();
     $(container).clone().insertAfter(".design_unit_site_view_container");
   }

});
$(".excerpt_add_line_style").bind('change',function() {
   var line_style = $(this).val();
    var parent = container = null;
    if(line_style=='aboveimg') {
        var container = $(this).parents('.cntnt_dstr_cntnr').find('.design_unit_text_continer');
       $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_text_continer").remove();
        if($(this).parents('.cntnt_dstr_cntnr').find(".design_unit_main_container_spnx").children().first().attr('class')=='hd_txt_id_spx_dv') {
            parent = $(this).parents('.cntnt_dstr_cntnr').find('.hd_txt_id_spx_dv');
            $(container).clone().insertAfter(parent);
        } else {
            parent = $(this).parents('.cntnt_dstr_cntnr').find('.design_unit_main_container_spnx');
            $(container).clone().prependTo(parent);
        }
       $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_text_continer").addClass("aboveimg_cls_spx");
    }
    else {
      $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_text_continer").removeClass("aboveimg_cls_spx");
      container = $(this).parents('.cntnt_dstr_cntnr').find('.design_unit_text_continer');
      $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_text_continer").remove();
      parent = $(this).parents('.cntnt_dstr_cntnr').find('.design_unit_content_container');
      $(container).clone().appendTo(parent);

    }
});

$(".unit_excerpt_font_size").bind('blur',function() {
   var excerpt_font_size = $(this).val();
   if(excerpt_font_size < 7) {
    $(this).addClass('error_widget_val')
    return;
   } else {
    $(this).removeClass('error_widget_val');
   }
   $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_text_continer .excrpt_txt_id_spx").css('font-size',+excerpt_font_size+'px');
});
$(".unit_excerpt_line_height").bind('blur',function() {
   var excerpt_line_height = $(this).val();
   if(excerpt_line_height < 7) {
    $(this).addClass('error_widget_val')
    return;
   } else {
    $(this).removeClass('error_widget_val');
   }

   $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_text_continer .excrpt_txt_id_spx").css('line-height',+excerpt_line_height+'px');
});
$(".unit_excerpt_font_style").bind('change',function() {
   var excerpt_font_style = $(this).val();
    $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_text_continer .excrpt_txt_id_spx").css('font-weight',excerpt_font_style);
});
$(".unit_excerpt_font_case").bind('change',function() {
   var excerpt_font_case = $(this).val();
    $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_text_continer .excrpt_txt_id_spx").css('text-transform',excerpt_font_case);
});


$(".unit_border_width").bind('blur',function() {
    var unit_border_width = $(this).val();
   if(unit_border_width<0) {
     $(this).addClass('error_widget_val');
     return;
   } else {
    $(this).removeClass('error_widget_val');
   }
    $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_main_container_spnx").css('border-width',+unit_border_width+'px');
});
$(".unit_border_style").bind('change',function() {
   var unit_border_style = $(this).val();
   $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_main_container_spnx").css('border-style',unit_border_style);
});

$(".unit_border_radius").bind('blur',function() {

   var unit_border_radius = $(this).val();
  if(unit_border_radius<0) {
     $(this).addClass('error_widget_val')
     return;
   } else {
    $(this).removeClass('error_widget_val')
   }
   $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_main_container_spnx").css('border-radius',+unit_border_radius+'px');

});

$("#img_crop_width").bind('blur',function() {
   var img_crop_width = $(this).val();
   $(".design_unit_main_container_spnx").css('width',+img_crop_width+'px');

});
$("#img_crop_height").bind('blur',function() {
   var img_crop_height = $(this).val();
   $(".design_unit_main_container_spnx").css('height',+img_crop_height+'px');
});

$(".unit_title_font_color").wpColorPicker({
  change: function(event, ui){
    var headline_font_color = ui.color.toString();
     $(this).parents('.cntnt_dstr_cntnr').find(".hd_txt_id_spx").css('color',headline_font_color);    
  } 
});

$(".unit_border_color").wpColorPicker({
  change: function(event, ui){
    var unit_border_color = ui.color.toString();
     $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_main_container_spnx").css('border-color',unit_border_color);    
  } 
});
$(".fg_color").wpColorPicker({
  change: function(event, ui){
    var unit_foreground_color = ui.color.toString();
    $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_main_container_spnx").css('background-color',unit_foreground_color);
  }
});

$(".unit_excerpt_font_color").wpColorPicker({
    change: function(event, ui) {
    var unit_excerpt_font_color = ui.color.toString();
     $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_text_continer .excrpt_txt_id_spx").css('color',unit_excerpt_font_color);
  }
});

$(".unit_spacing").bind('blur',function() {
   var unit_spacing = $(this).val();
   if(unit_spacing<4) {
     $(this).addClass('error_widget_val')
     return;
   } else {
    $(this).removeClass('error_widget_val')
   } 

});
$(".bg_color").wpColorPicker({
    color: "' . $unit_bg_color .'"
});
$("#no_of_row,#no_of_columns").bind('blur',function() {
   var choose_style_row_column = $(this).val();
   if(choose_style_row_column<1) {
     $(this).addClass('error_widget_val')
     return;
   } else {
    $(this).removeClass('error_widget_val')
   } 

});

$("input[name='widget_layout_type']").click(function() {
  var style_val = $(this).val();
  if(style_val=='fixed-width') {
   $(".cmn_cls_unit_wdth_hght").show();
  } else {
    $(".cmn_cls_unit_wdth_hght").hide();
  }

});
$(".unit_excerpt_word_limit").bind('blur',function() {
  
  var excerpt_val = $(this).val();
  var text_container_first_val = $(".design_unit_text_continer .excrpt_txt_id_spx_hidden").text().trim();
  var text_container_final_val = text_container_first_val.substring(0,excerpt_val); 
  $(this).parents('.cntnt_dstr_cntnr').find(".design_unit_text_continer .excrpt_txt_id_spx").html(text_container_final_val+'..');
});

$(".add_widget_button").click(function() {
    var inner_text=$(this).text();
    if(inner_text=='+ Add New Widget') {
        $(this).html("Cancel");
    } else {
        $(this).html("+ Add New Widget");
    }

    $(".ad_nw_wdgt_mn_cntainer").slideToggle(300);

});

$("#close_new_widget_create").click(function() {
   $(".ad_nw_wdgt_mn_cntainer").slideUp();

   var add_wdgt_txt = $(".add_widget_button").text();
  if(add_wdgt_txt=='Cancel') {
    $(".add_widget_button").html("+ Add New Widget");
  }
})


$(".sh_hide_wdgt_grph").click(function() {
    var inner_text = $(this).text();
    if(inner_text=='Edit Widget') {
        $(this).html("Show Graph");
        $(this).parents('.wdgt_mn_cntnr_spkx').find('.cntnt_dstr_cntnr_sh').css('display','flex');
        $(this).parents('.wdgt_mn_cntnr_spkx').find('.graph-cmn-cls-spnx').hide();
       // $(this).parents('.wdgt_mn_cntnr_spkx').find('.grph_wdgt_cntnr_grp').prepend('<div class="spnx_wdgt_wrapper"><div class="cssload-loader"></div></div>');
    } else {
        $(this).html("Edit Widget");
        $(this).parents('.wdgt_mn_cntnr_spkx').find('.cntnt_dstr_cntnr_sh').hide();
        $(this).parents('.wdgt_mn_cntnr_spkx').find('.graph-cmn-cls-spnx').show();
    }

});

/** widget custom js ends here **/

    $('input[name="widget_install"]').click(function() {
        var is_check = $(this).is(':checked');
        jQuery('.se-pre-con').bPopup( { modalClose: false } );
        $.ajax({
            url: ajaxurl,
            type: "POST",
            datatype: "json",
            data: {
                "action": "spinkx_cont_desktop_widget_install",
                "site_id": g_site_id,
                "is_check": is_check,
            },
            success: function (data) {
                jQuery('.se-pre-con').bPopup().close();
                alert(data);
            }
        });
    });
    
    $(".edit_cat_spnx_wdgt").click(function() {
        var text = $(this).text();
        
        if(text == 'Edit Categories') {
          
         $(this).html("Close Categories");
        } else {

          $(this).html('Edit Categories');
        }
         $(this).parent().next(".cat_wdgt_mn_cntnr_spkx").toggle();
    });
    $(".cmn_wdgt_tb_mn_cntnr>div:first-child").click(function() {
        $(this).toggleClass('bbtm_tgl_clas');
        $(this).next().slideToggle(300);
        $(this).children('.fa-chevron-right').toggleClass('dst_ar_dwn');
     })

    google.charts.setOnLoadCallback(drawChart);


      //  $(".ajax_create_button").attr("disabled",false);
        $( ".ajax_create_button" ).click(function( e ) {
            e.preventDefault();
            var form_serialized_data = $("form#SPINKX_create_form").serialize();
            var main_widget_id = $("#main_widget_id").val();
            /*------------------------------------------------------------------------------*/
            var page_url = window.location.href;
            var page_new_url = page_url.split("?")[0];
            var add_shortcode = $("#add_shortcode").val();
            var wp_section = $("#wp_section").val();
            /*------------------------------------------------------------------------------*/
            $("#bpopup_ajax_loading").bPopup( { modalClose: false } );
            $.ajax({
                url : ajaxurl,
                data : {
                    "action": "spinkx_cont_widget_create",
                    "form_serialized_data" : form_serialized_data,
                    "main_widget_id" : main_widget_id,
                },
                type : "post",
                datatype : "json",
                success : function(data){
                    //alert(data);
                    $.growl.notice({ message: "Successfully Updated!",
                        location: "tr",
                        size: "large" });
                        location.reload();
                },
                failure : function(data){
                    $("#bpopup_ajax_loading").bPopup().close();
                    $.growl.error({ message: "Failed to Update !",
                        location: "tr",
                        size: "large" });
                }
            });
        });

    $( ".ajax_update_button" ).click(function( e ) {
        e.preventDefault();

        var form_serialized_data = $(this).parents('form#SPINKX_create_form').serialize();
        var main_widget_id = $(this).parents('form#SPINKX_create_form').find('#main_widget_id').val();
        var web_enable = $('#playpauselp_' + main_widget_id).prop('checked');
        var sponser_enable = $('#playpausead_' + main_widget_id).prop('checked');
       var global_post = $('#playpausegp_' + main_widget_id).prop('checked');
        form_serialized_data += '&web_enable='+web_enable+'&sponsor_enable='+sponser_enable+'&global_post='+global_post;
        var page_url = window.location.href;
        var page_new_url = page_url.split("?")[0];
        var add_shortcode = $('#add_shortcode').val();
        var wp_section = $('#wp_section').val();
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

    $('a#ajax_cancel_button').click(function(e) {
        e.preventDefault();
        var default_data = {'widget_name': 'My First Widget',  'no_of_columns':1,
        'unit_border_width': 1, 'unit_border_style': 'solid',  'unit_border_radius': '6', 'unit_spacing':'20',
         'unit_title_font_size': 14, 'unit_title_line_height': 18, 'unit_title_font_style': 'bold',
        'unit_title_font_case': 'none',  'unit_add_line_style': 'belowimg', 'unit_excerpt_font_size': 14,
        'unit_excerpt_line_height': 18, 'unit_excerpt_font_style': 'normal', 'unit_excerpt_font_case': 'none',
            'excerpt_add_line_style': 'belowimg', 'unit_excerpt_word_limit': 100};
        for(var id in default_data) {
            if (!default_data.hasOwnProperty(id)) continue;
            key_value = default_data[id];
            $('#' + id).val(key_value);
            if($('#'+id).attr('type')=='text' || $('#'+id).attr('type')=='number') {
                $('#'+id).trigger('blur');
            } else {
                $('#'+id).trigger('change');
              }
          }
        default_data = {'widget_layout_type': 'masonry' }
        for(var id in default_data) {
            if (!default_data.hasOwnProperty(id)) continue;
            key_value = default_data[id];
            $('#'+id).trigger('click');
        }
        default_data = {'bg_color': 'transparent', 'unit_border_color': '#d8d8d8','fg_color': '#fefefe', 'unit_title_font_color': '#000000',
        'unit_excerpt_font_color': '#333333'}
        for(var id in default_data) {
            if (!default_data.hasOwnProperty(id)) continue;
            key_value = default_data[id];
            if(id === 'bg_color') {
                 $('#' + id).iris('color', '#FFFFFFFF');
            } else {
                $('#' + id).iris('color', key_value);
            }
       }
        $(".add_widget_button").trigger('click');

    });
    $('#widget_data').show();
});
jQuery('.grph_wdgt_cntnr_grp').prepend('<div class="spnx_wdgt_wrapper"><div class="cssload-loader"></div></div>');
function updatewidget(){
   // jQuery('.se-pre-con').bPopup( { modalClose: false } );
    jQuery('.grph_wdgt_cntnr_grp').prepend('<div class="spnx_wdgt_wrapper"><div class="cssload-loader"></div></div>');
    $.ajax({
        url : ajaxurl,
        type : "get",
        datatype : "json",
        data : {
            "action": "spinkx_cont_get_widget_stat",
            "site_id" : g_site_id,
            "from_date" : global_start_date,
            "to_date" : global_end_date,
        },
        success : function(data){
            //console.log(data)
            data = JSON.parse(data);

            var update_data = data;
            $.each(data,function(key,stat) {
                $.each(stat, function(k, s){

                    if(k == 1) {
                        $('.wd-views-' + key).text(s);
                    } else if(k == 2) {
                        $('.wd-clicks-' + key).text(s);
                    } else if(k == 3) {
                        $('.wd-ctr-' + key).text(s);
                    }
                });
            });
            $.each(update_data, function(key, stat){
               $.each(stat, function(k, s){
                   if(k > 0) {
                       (update_data[key]).splice(k, 3);
                       return false;
                   }
                });
            });

            drawChart();
        }
    });
}

var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
function drawChart() {
    var startdate_arr = window.global_start_date.split('-');
    var enddate_arr =  window.global_end_date.split('-');
    var timeDiff = diffDays = null;
    var startdate =null;
    var enddate = null;
    //Create Object Visualization
    $wd_counter = 0;
    for(var index in spinkx_data) {
        if(!spinkx_data.hasOwnProperty(index)) continue;
        item = spinkx_data[index];
        var widget = null;
        widget = new google.visualization.DataTable();
        widget.addColumn('number', 'Day');
        widget.addColumn('number', 'Clicks');
        widget.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
        widget.addColumn('number', 'CTR');
        widget.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
        var $key = '';
        var dataWidImp = [];
        var dataWidClk = [];
        $widgetArr = [];
         startdate = new Date(startdate_arr[0], startdate_arr[1]-1, startdate_arr[2]);
         enddate = new Date(enddate_arr[0], enddate_arr[1]-1, enddate_arr[2]);
        timeDiff = Math.abs(enddate.getTime() - startdate.getTime());
        diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
        var counter = widclkcounter = $key = 0;
        //var dateFormatter = new google.visualization.DateFormat({pattern: 'Y,M,d,H'});
        for (; startdate <= enddate;) {
            mm = ((startdate.getMonth() + 1) >= 10) ? (startdate.getMonth() + 1) : '0' + (startdate.getMonth() + 1);
            dd = ((startdate.getDate()) >= 10) ? (startdate.getDate()) : '0' + (startdate.getDate());
            yyyy = startdate.getFullYear();
            $key = yyyy + "-" + mm + "-" + dd;
            widclkcounter++;
            if (typeof item[$key] === 'undefined') {
                $widgetArr[counter] = new Array(widclkcounter * 1, 0, showWidgetToolTip($key, 0, 0), 0, showWidgetToolTip($key, 0, 0));
            } else {
                $widgetArr[counter] = new Array(widclkcounter * 1, item[$key].clicks * 1, showWidgetToolTip($key, item[$key].clicks, item[$key].ctr), item[$key].ctr * 1, showWidgetToolTip($key, item[$key].clicks, item[$key].ctr));
                if(index == 1939) {
                    console.log($widgetArr);
                }
            }
            counter++;
            var newDate = startdate.setDate(startdate.getDate() + 1);
            startdate = new Date(newDate);
        }
        widget.addRows($widgetArr);
        if(diffDays >=  10) {
            diffDays = 10;
        } else {
            diffDays = 1;
        }
        point_size = parseInt(counter/diffDays) + 1;
        ticks = [];
        for(i = 1; i < point_size; i++ ) {
            ticks[i-1] = i * diffDays;
        }
        var widImpoptions = {
            tooltip: {isHtml: true},    // CSS styling affects only HTML tooltips.
            width: '100%',
            height: 300,
            legend: {position: 'top', alignment: 'end'},
            pointsVisible: true,
            pointShape: 'circle',
            pointSize: point_size,
            backgroundColor: 'transparent',
            chartArea: {
                left: "5%",
                top: "15%",
                height: "75%",
                width: "89%"
            },
            vAxis: {minValue: 1},
            hAxis: {
                baselineColor: 'none',
                ticks: ticks,
                gridlines: {
                    color: 'transparent'
                },


            },

        };

        var widget_views_chart = new google.visualization.LineChart(document.getElementById('widget-chart-'+index));
        widget_views_chart.draw(widget, widImpoptions);
    }
    jQuery('.spnx_wdgt_wrapper').remove();
}

function showWidgetToolTip($dt, $vw, $ctr) {
    return '<div style="white-space: nowrap; padding:5px;"><b>Date </b>: ' + $dt + '<br>' +
        '<b>Clicks</b>: ' + $vw + '<br/><b>CTR</b>: ' + $ctr + '%</div>';
}