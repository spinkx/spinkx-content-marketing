function get_stat_now(start, end){
    $.ajax({
        beforeSend: function(){
            jQuery('#bpopup_ajax_loading').bPopup( { modalClose: false } );
        },
        url : ajaxurl,
        type: 'get',
        datatype : 'json',
        data : {
            'action': 'spinkx_cont_get_dashbaord_statics',
            'site_id': g_site_id,
            'from_date' :  start.format('YYYY-MM-DD'),
            'to_date' : end.format('YYYY-MM-DD'),
        },
        complete: function(){
            jQuery('#bpopup_ajax_loading').bPopup().close();
        },
        success: function(data){

            var data = JSON.parse(data);
            $("#apb_activepost").html(data.active_post_block.activepost);
            $("#apb_imppost").html(data.active_post_block.imppost);
            $("#apb_clickpost").html(data.active_post_block.clickpost);
            $("#apb_ctrPostTotal").html(data.active_post_block.ctrPostTotal);

            $("#acb_availablecredit").html(data.available_credit_block.availablecredit);
            $("#acb_spentcredit").html("-"+data.available_credit_block.spentcredit);
            $("#acb_earncredit").html("+"+data.available_credit_block.earncredit);
            $("#acb_clicksposttotalglobal").html(data.available_credit_block.clicksposttotalglobal);
            $("#acb_impposttotalglobal").html(data.available_credit_block.impposttotalglobal);

            $("#widget_activewidget").html(data.widget.widgetActive);
            $("#widget_impressions").html(data.widget.total_impressions);
            $("#widget_engagement").html(data.widget.total_clicks);
            $("#widget_ctr").html(data.widget.widget_ctr);

            $("#site_revenue_total").html(data.site.revenue_total);
            $("#site_revenue_from_reach").html(data.site.revenue_from_reach);
            $("#site_revenue_from_clicks").html(data.site.revenue_from_clicks);


            $("#user_user_balance").html(data.user.user_balance);
            $("#user_money_spent").html(data.user.money_spent);
            $("#user_reach").html(data.user.reach);
            $("#user_engagement").html(data.user.engagement);
            $("#user_ctr").html(data.user.ctr);
        }
    });
};
jQuery(document).ready(function() {
   jQuery(".nav-tabs a").click(function(){
        var id =	jQuery(this).attr("href").substr(1);
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
        jQuery('#toplevel_page_spinkx-site-register ul li').removeClass( "current" );
        jQuery( "#toplevel_page_spinkx-site-register ul li" ).each(function() {
            if(jQuery(this).text()==currentPage)
                jQuery(this).addClass( "current" );
        });
    });
    $=jQuery;
});