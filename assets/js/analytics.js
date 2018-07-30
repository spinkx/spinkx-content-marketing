function get_stat_now(start, end){
    jQuery('#widget_chart').prepend('<div class="spnx_wdgt_wrapper"><div class="cssload-loader"></div></div>');
    jQuery('#lp_chart').prepend('<div class="spnx_wdgt_wrapper"><div class="cssload-loader"></div></div>');
    jQuery('#bp_chart').prepend('<div class="spnx_wdgt_wrapper"><div class="cssload-loader"></div></div>');
    try {
        $.ajax({
            beforeSend: function(){
               // jQuery('.se-pre-con').bPopup( { modalClose: false } );
            },
            url : ajaxurl,
            type: 'get',
            datatype : 'json',
            data : {
                'action': 'spinkx_cont_get_dashbaord_statics',
                'site_id': g_site_id,
                'from_date' :  start,
                'to_date' : end,
            },
            complete: function(){
                //jQuery('.se-pre-con').bPopup().close();
            },
            success: function(data){
                var data = JSON.parse(data);
                spinkx_data = data
                currency = spinkx_data.currency;
                jQuery('.widget-views').text(spinkx_data.wd_views);
                jQuery('.widget-clicks').text(spinkx_data.wd_clicks + ' | ' + spinkx_data.wd_ctr+'%');
                jQuery('.widget-active').text(spinkx_data.wd_active);
                jQuery('.wd-views').text(spinkx_data.wd_views);
                jQuery('.wd-clicks').text(spinkx_data.wd_clicks);
                jQuery('.wd-ctr').text(spinkx_data.wd_ctr);
                jQuery('.lp-views').text(spinkx_data.lp_views);
                jQuery('.lp-clicks').text(spinkx_data.lp_clicks);
                jQuery('.lp-ctr').text(spinkx_data.lp_ctr);
                jQuery('.lp-active').text(spinkx_data.lp_active);
                jQuery('.bp-views').text(spinkx_data.bp_views);
                jQuery('.bp-clicks').text(spinkx_data.bp_clicks);
                jQuery('.bp-ctr').text(spinkx_data.bp_ctr);
                jQuery('.bp-active').text(spinkx_data.bp_active);
                jQuery('.tot-pts-spent').text(spinkx_data.tot_pts_spent);
                jQuery('.total-money-earn').text(  spinkx_data.tot_money_earn);
                jQuery('.total-pts-earn').text(spinkx_data.tot_pts_earn);
                jQuery('.credit-wallet-currency').text(spinkx_data.currencyEnglish);
                jQuery('.credit-wallet-bal').text(spinkx_data.wallet_bal);
                jQuery('.credit-points').text(spinkx_data.credit_points);
                drawChart();
                jQuery('.spnx_wdgt_wrapper').remove();

            },
            error: function(xhr, status, error){
                jQuery.growl.error({ message: xhr.status,
                location: 'tr',
                size: 'large' });
            },
        });
    } catch ( ex ) {
         jQuery.growl.error({ message: 'Something went wrong with the request. Data not loaded.',
                location: 'tr',
                size: 'large' });
    }
};

jQuery(document).ready(function() {
   jQuery(".nav-tabs a").click(function(){
        var id =	jQuery(this).attr("href").substr(1);
        window.location.hash = id;
        window.scrollTo(0, 0);
        switch (id) {
            case 'widget_design':
                var currentPage = 'Widget Design';
                break;
            case 'content_play_list':
                var currentPage = 'Content Play List';
                break;
            case 'dashboard':
                var currentPage = 'Dashboard';
                break;
            case 'campaigns':
                var currentPage = 'Campaigns';
                break;
            case 'account_setup':
                var currentPage = 'Account Setup';
                break;
        }
        jQuery('#toplevel_page_spinkx-site-register ul li').removeClass( "current" );
        jQuery( "#toplevel_page_spinkx-site-register ul li" ).each(function() {
            if(jQuery(this).text()==currentPage)
                jQuery(this).addClass( "current" );
        });
    });
    $=jQuery;
    $('.withdraw-money').click(function(){
        $wall_bal = parseFloat($('.credit-wallet-bal').text()).toFixed(2);
            if (spinkx_data.wallet_bal >= spinkx_data.min_bal) {
                try {
                    $.ajax({
                        beforeSend: function () {
                            jQuery('.se-pre-con').bPopup({modalClose: false});
                        },
                        url: ajaxurl,
                        type: 'get',
                        datatype: 'json',
                        data: {
                            'action': 'spinkx_cont_withdraw_money_request',
                        },
                        complete: function () {
                            jQuery('.se-pre-con').bPopup().close();
                        },
                        success: function (data) {
                            jQuery('.se-pre-con').bPopup().close();
                            var data = JSON.parse(data);
                            alert(data.msg);
                        },
                        error: function (xhr, status, error) {
                            jQuery('.se-pre-con').bPopup().close();
                            jQuery.growl.error({
                                message: xhr.status,
                                location: 'tr',
                                size: 'large'
                            });
                        },
                    });
                } catch (ex) {
                    jQuery.growl.error({
                        message: 'Something went wrong with the request. Your request not loaded.',
                        location: 'tr',
                        size: 'large'
                    });
                }
            } else {
                alert('Sorry you cannot withdraw money at this point. We have a minimum payout of ' + spinkx_data.currencyEnglish + ' ' + spinkx_data.min_bal + '. We request you to wait till you collect the minimum payout amount.');
            }

    });

    jQuery('#buy_point').on('keyup', function(event){
        var points = parseInt($(this).val());
        if(points === undefined || isNaN(points)) {
            document.getElementById('payment-method-button').style.backgroundColor = 'lightblue';
            alert('Please enter amount in a number.');
            return;
        }
        if (points < 100) {
            document.getElementById('payment-method-button').style.backgroundColor = 'lightblue';
            alert('A minimum of 100 points are required for a purchase.');
            return;
        }
        document.getElementById('payment-method-button').style.backgroundColor = 'lightblue';
        jQuery.ajax({
            url : spinkx_server_baseurl + '/wp-json/spnx/v1/site/get-point-price',
            type : "post",
            beforeSend: function() {
                document.getElementById('payment-method-button').disabled = true;
            },
            data : {
                "site_id" : g_site_id,
                "points": points,
                "license_code": spinkx_data.lkey,
                "reg_email": spinkx_data.semail,
            },
            success : function(data) {
                $('#reach').text(data.reach);
                $('#amount').text(data.price);
                $('#point_amount').val(data.price);
                $('button#payment-method-button').prop('disabled', false);
                document.getElementById('payment-method-button').style.backgroundColor = '#337ab7';
            }
        });
    });
    jQuery('.spnx_wdgt_wrapper').remove();
    jQuery('#widget_chart').prepend('<div class="spnx_wdgt_wrapper" style="left: 27%; top:30%;"><div class="cssload-loader"></div></div>');
    jQuery('#lp_chart').prepend('<div class="spnx_wdgt_wrapper"><div class="cssload-loader"></div></div>');
    jQuery('#bp_chart').prepend('<div class="spnx_wdgt_wrapper"><div class="cssload-loader"></div></div>');
    google.charts.setOnLoadCallback(drawChart);
});
function getpoints() {
    jQuery('#boostmodal').modal('hide');
    jQuery('#boostmodalbuyPoint').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
    });
}


var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
function drawChart() {
    var startdate_arr = window.global_start_date.split('-');
    var enddate_arr =  window.global_end_date.split('-');
    var startdate = new Date(startdate_arr[0], startdate_arr[1]-1, startdate_arr[2]);
    var enddate = new Date(enddate_arr[0], enddate_arr[1]-1, enddate_arr[2]);
    var timeDiff = Math.abs(enddate.getTime() - startdate.getTime());
    var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
    //Create Object Visualization
    var widget= new google.visualization.DataTable();
    var local_post= new google.visualization.DataTable();
    var boost_post = new google.visualization.DataTable();;

    //Add Column
    widget.addColumn('number', 'Day');
    widget.addColumn('number', 'Clicks');
    widget.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
    widget.addColumn('number', 'CTR');
    widget.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});

    //Add Column
    local_post.addColumn('number', 'Day');
    local_post.addColumn('number', 'Clicks');
    local_post.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
    local_post.addColumn('number', 'CTR');
    local_post.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});

    //Add Column
    boost_post.addColumn('number', 'Day');
    boost_post.addColumn('number', 'Clicks');
    boost_post.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});
    boost_post.addColumn('number', 'CTR');
    boost_post.addColumn({type: 'string', role: 'tooltip', 'p': {'html': true}});

    // var startdate = new Date(window.global_start_date);
    // var enddate = new Date(window.global_end_date);
    var dataWidImp = [];
    var dataWidClk=[];
    $key = '';
    $widgetArr = new Array();
    $lpArr = new Array();
    $bpArr = new Array();
    var counter = widclkcounter = 0;
    //var dateFormatter = new google.visualization.DateFormat({pattern: 'Y,M,d,H'});
    for (; startdate <= enddate;  ) {
        mm = ((startdate.getMonth()+1)>=10)?(startdate.getMonth()+1):'0'+(startdate.getMonth()+1);
        dd = ((startdate.getDate())>=10)? (startdate.getDate()) : '0' + (startdate.getDate());
        yyyy = startdate.getFullYear();
        $key = yyyy+"-"+mm+"-"+dd;

        widclkcounter++;

        $widgetArr[counter] = new Array(widclkcounter * 1, spinkx_data[$key].wd.clicks * 1, showWidgetToolTip($key,  spinkx_data[$key].wd.clicks, spinkx_data[$key].wd.ctr ) , spinkx_data[$key].wd.ctr * 1, showWidgetToolTip($key,  spinkx_data[$key].wd.clicks, spinkx_data[$key].wd.ctr ) );

        $lpArr[counter] = new Array(widclkcounter * 1, spinkx_data[$key].lp.clicks * 1, showWidgetToolTip($key,  spinkx_data[$key].lp.clicks, spinkx_data[$key].lp.ctr ) , spinkx_data[$key].lp.ctr * 1, showWidgetToolTip($key,  spinkx_data[$key].lp.clicks, spinkx_data[$key].lp.ctr ) );

        $bpArr[counter] = new Array(widclkcounter * 1, spinkx_data[$key].bp.clicks * 1, showWidgetToolTip($key,  spinkx_data[$key].bp.clicks, spinkx_data[$key].bp.ctr ) , spinkx_data[$key].bp.ctr * 1, showWidgetToolTip($key,  spinkx_data[$key].bp.clicks, spinkx_data[$key].bp.ctr ) );

        counter++;
        var newDate = startdate.setDate(startdate.getDate() + 1);
        startdate = new Date(newDate);
    }

    widget.addRows($widgetArr);
    local_post.addRows($lpArr);
    boost_post.addRows($bpArr);
    if(diffDays >=  10) {
        diffDays = 10;
    } else {
        diffDays = 1;
    }
    wid_point_size = parseInt($widgetArr.length/diffDays) + 1;
    lp_point_size = parseInt($lpArr.length/diffDays) + 1;
    bp_point_size = parseInt($bpArr.length/diffDays) + 1;
    wd_ticks = lp_ticks = bp_ticks = [];
    for(i = 1; i < wid_point_size; i++ ) {
        wd_ticks[i-1] = i * diffDays;
    }
    for(i = 1; i < lp_point_size; i++ ) {
        lp_ticks[i-1] = i * diffDays;
    }
    for(i = 1; i < bp_point_size; i++ ) {
        bp_ticks[i-1] = i * diffDays;
    }
    var widImpoptions = {
        tooltip: { isHtml: true },    // CSS styling affects only HTML tooltips.
        title: 'Widget Clicks / CTR',
        width: '100%',
        height: 300,
        legend: { position: 'top', alignment: 'end' },
        pointsVisible: true,
        pointShape: 'circle',
        pointSize: wid_point_size,
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
            ticks: wd_ticks,
            gridlines: {
                color: 'transparent'
            },


        },

    };


    var LPoptions = {
        tooltip: { isHtml: true },    // CSS styling affects only HTML tooltips.
        title: 'Local Post Clicks / CTR',
        width: '100%',
        height: 300,
        legend: { position: 'top', alignment: 'end' },
        pointsVisible: true,
        pointShape: 'circle',
        pointSize: lp_point_size,
        backgroundColor: 'transparent',
        chartArea: {
            left: "5%",
            top: "15%",
            height: "75%",
            width: "90%"
        },
        vAxis: {minValue: 1},
        hAxis: {
            baselineColor: 'none',
            ticks: lp_ticks,
            gridlines: {
                color: 'transparent'
            }

        },
    };
    var BPoptions = {
        tooltip: { isHtml: true },    // CSS styling affects only HTML tooltips.
        title: 'Boost Post Clicks / CTR',
        width: '100%',
        height: 300,
        legend: { position: 'top', alignment: 'end' },
        pointsVisible: true,
        pointShape: 'circle',
        pointSize: bp_point_size,
        backgroundColor: 'transparent',
        chartArea: {
            left: "5%",
            top: "15%",
            height: "75%",
            width: "90%"
        },
        vAxis: {minValue: 1},
        hAxis: {
            baselineColor: 'none',
            ticks: bp_ticks,
            gridlines: {
                color: 'transparent'
            }
        },
    };
    var widget_views_chart =  new google.visualization.LineChart(document.getElementById('widget_chart'));
    widget_views_chart.draw(widget,widImpoptions);
    var lp_chart =  new google.visualization.LineChart(document.getElementById('lp_chart'));
    lp_chart.draw(local_post,LPoptions);
    var bp_chart =  new google.visualization.LineChart(document.getElementById('bp_chart'));
    bp_chart.draw(boost_post,BPoptions);
}


function showWidgetToolTip($dt, $vw, $ctr) {
    return '<div style="white-space: nowrap; padding:5px;"><b>Date </b>: ' + $dt + '<br>' +
        '<b>Clicks</b>: ' + $vw + '<br/><b>CTR</b>: ' + $ctr + '%</div>';
}
jQuery(window).on("resize", function (event) {
    drawChart();
});

function pluginPayment(transaction) {
     var http = new XMLHttpRequest();
     var url = spinkx_server_baseurl + '/wp-json/spnx/v1/payment-method/charge';
     var params = 'razorpay_payment_id='+transaction.razorpay_payment_id+'&amount=' + transaction.amount;
     http.open('POST', url, true);
     http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
     http.onreadystatechange = function() {//Call a function when the state changes.
         if (http.readyState === 4 && http.status === 200) {
            data = JSON.parse(http.responseText);
            if (data.status == 0){
                alert('Error:' + data.msg);
            } else {
                 alert(data.msg);
            }
            window.location.reload()
         }
     }
     http.send(params);
}
