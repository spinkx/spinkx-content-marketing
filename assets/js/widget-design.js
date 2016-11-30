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
                console.log(data);
            }
        });
    });

});

