jQuery(document).ready(function($) {
    jQuery('.se-pre-con').fadeOut('slow');
    jQuery('.nav-tabs a').click(function(){
        var id =	jQuery(this).attr('href').substr(1);
        window.location.hash = id;
        window.scrollTo(0, 0);
        switch (id) {
            case 'widget_design':
                var currentPage	=	'Widget Design';
                break;
            case 'content_play_list':
                var currentPage	=	'Content Play List';
                break;
            case 'dashboard':
                var currentPage	=	'Dashboard';
                break;
            case 'campaigns':
                var currentPage	=	'Campaigns';
                break;
            case 'account_setup':
                var currentPage	=	'Account Setup';
                break;
        }
        jQuery('#toplevel_page_spinkx-site-register ul li').removeClass( 'current' );
        jQuery( '#toplevel_page_spinkx-site-register ul li' ).each(function() {
            if(jQuery(this).text()==currentPage)
                jQuery(this).addClass( 'current' );
        });

    });

    jQuery('#tabse').tabs();
    //jQuery('#campaign_subtabs').tabs();
    //added for tab stabilty

    $(".widget-checkbox").on("click", function(){
        var site_id = g_site_id;
        var widget_id = $(this).attr("data-id");
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
            $(".acc-mn-dv-cntainr").css({'height':400+'px','overflow-y':'scroll'})

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
        $(this).parent().next(".cat_wdgt_mn_cntnr_spkx").toggle();
    }); 
     $(".cmn_wdgt_tb_mn_cntnr>div:first-child").click(function() {
        
        $(this).toggleClass('bbtm_tgl_clas');
        $(this).next().slideToggle(300);
        $(this).children('.fa-chevron-right').toggleClass('dst_ar_dwn');
     })

});

function updatewidget(){
   // jQuery('.se-pre-con').bPopup( { modalClose: false } );
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
            var data = JSON.parse(data);
            jQuery('.se-pre-con').bPopup().close();
            $.each(data,function(key,stat){
                cell_imp = table.cell("#w_"+key, 4);
                if( cell_imp[0].length > 0 ) {


                    //var cell = table.cell( this );
                    cell_imp.data( stat.total_impressions ).draw();
                    //this.data()[3] = "sdf";
                    //console.log(cell_imp.data());
                    cell_click = table.cell("#w_"+key, 5);
                    cell_click.data( stat.total_clicks ).draw();

                    cell_ctr = table.cell("#w_"+key, 6);
                    cell_ctr.data( stat.widget_ctr ).draw();
                } else {
                    var mobile_widget_table = $("#bwki_mobile_widgets_display").DataTable();
                    cell_imp = mobile_widget_table.cell("#w_"+key, 3);
                    cell_imp.data( stat.total_impressions ).draw();
                    //this.data()[3] = "sdf";
                    //console.log(cell_imp.data());
                    cell_click = mobile_widget_table.cell("#w_"+key, 4);
                    cell_click.data( stat.total_clicks ).draw();

                    cell_ctr = mobile_widget_table.cell("#w_"+key, 5);
                    cell_ctr.data( stat.widget_ctr ).draw();
                }
            });
        }
    });
}
