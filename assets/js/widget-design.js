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
});

function updatewidget(){
    jQuery('#bpopup_ajax_loading').bPopup( { modalClose: false } );
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
            jQuery('#bpopup_ajax_loading').bPopup().close();
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
