jQuery(document).ready(function($){
    jQuery('#wp-admin-bar-spinkx_notification').hover(function () {
        jQuery('#wp-admin-bar-spinkx_notification .ab-item').css('background','transparent');
    })
    jQuery('#wp-admin-bar-spinkx_notification .bl-mn-dv-cntnr-ntf-br').on('click', function(){
        jQuery(".ntf-mn-cntnr").toggleClass('show_ntf_cnr');
    });
   
    jQuery(document).on('click', function(event){
       $target = event.target;
       if($target.src == undefined) {
           if( ! ($target.className == 'ntf-mn-cntnr' ||  $target.className.indexOf('spinkx-mark-read') > 0 || $target.className == 'spinkx-notify-update-bubble' || $target.className=='dashicons-spinkx-ico' || $target.className=='bl-mn-dv-cntnr-ntf-br')) {
             str = $target.src
           //if(str.indexOf('notification-spnx.png') == -1) {
               jQuery('.ntf-mn-cntnr').removeClass('show_ntf_cnr');
           }
       }
    });
    var spnx_notify_unread = 0;
   // function loadNotifications() {
        jQuery.ajax({
            url: ajaxurl + '?action=spinkx_cont_notifications', async: false, success: function (data) {
                jQuery('.rnd-cmn-cls-dv-mn-cntr-rng').hide();
                data = JSON.parse(data);
                if (data.length < 2 || true) {
                    jQuery('.al-cntnt-mn-dv').css('overflow-y', 'none')
                }
                for (var $i = 0; $i < data.length; $i++) {
                    read_notify = '';
                    if (data[$i].log_read_status == 0) {
                        spnx_notify_unread++;
                    } else {
                        read_notify = 'spinkx-read-notify';
                    }
                    svg = '';
                    if (data[$i].log_status == true) {
                        svg = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 303.477 303.477" style="enable-background:new 0 0 303.477 303.477;" xml:space="preserve" width="20px" height="20px"><g><path d="M298.604,64.209l-49.978,49.979L204.907,98.57L189.29,54.852l49.979-49.979c-32.791-10.97-70.418-3.42-96.529,22.692  c-25.629,25.629-33.373,62.349-23.281,94.704c-1.359,1.07-2.676,2.222-3.93,3.476L12.884,228.389  c-17.178,17.177-17.178,45.027,0,62.205c17.178,17.178,45.029,17.178,62.207,0l102.645-102.645c1.254-1.254,2.404-2.57,3.475-3.929  c32.355,10.092,69.074,2.347,94.703-23.282C302.024,134.626,309.575,97.001,298.604,64.209z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#1CAFC7"/></g>' +
                            '</svg>';
                    } else {
                        svg = '<svg id="" width="25" height="30" viewBox="0 0 18 18" fit="" preserveAspectRatio="xMidYMid meet" focusable="false" class=""><g><path d="M9 2a7 7 0 1 1 0 14A7 7 0 0 1 9 2zm-1 8h2V5H8v5zm0 3h2v-2H8v2z" fill="#DA4236" fill-rule="evenodd" data-original="#DA4236" class="active-path" style="fill:#DA4236"/></g> </svg>';
                    }
                    $html = '<div class="fst-cnt-cls-mn-dv ' + read_notify + '" data-read="' + data[$i].log_read_status + '" data-id="' + data[$i].log_id + '">';
                    $html += '<div class="cm-fst-cnt-cls-mn-dv-chld">' + svg + '</div>';
                    $html += '<div class="cm-fst-cnt-cls-mn-dv-chld fnt-sz-rsz-cm-cl-n"><div class="upd-mn-dv-cls">' + data[$i].log_action + '</div> ' +
                        '<div class="fnt-opc-mn-dv">' + data[$i].log_by_email + '</div></div><div class="cm-fst-cnt-cls-mn-dv-chld fnt-opc-mn-dv">' + data[$i].log_date + '</div></div>';
                    jQuery('.al-cntnt-mn-dv').append($html);
                }
                if (spnx_notify_unread > 0) {
                    jQuery('.spinkx-notify-update-bubble').text(spnx_notify_unread).show();
                }
            }
        });
    //}

   /* setTimeout(function(){
      loadNotifications();
    },5000); // milliseconds */
    jQuery('.fst-cnt-cls-mn-dv').on('hover', function(e) {
        read_status = $(this).attr('data-read') * 1;
        divObj = $(this);
        if(read_status == 0 && spnx_notify_unread > 0) {
            $(divObj).attr('data-read', '1');
            jQuery(divObj).addClass('spinkx-read-notify');
            log_id = $(this).attr('data-id');
            jQuery.ajax({
                url: ajaxurl + '?action=spinkx_cont_noti_updstatus',
                type: "POST",
                data: {"id":[log_id]},
                success: function (data) {
                    data = JSON.parse(data);
                    if(data.status) {
                        spnx_notify_unread--;
                        if(spnx_notify_unread > 0) {
                            jQuery('.spinkx-notify-update-bubble').text(spnx_notify_unread).show();
                        } else {
                            jQuery('.spinkx-notify-update-bubble').text(spnx_notify_unread).hide();
                        }
                    } else {
                        jQuery(divObj).attr('data-read','0');
                        jQuery(divObj).removeClass('spinkx-read-notify');
                    }
                },
                error: function() {
                    jQuery(divObj).attr('data-read','0');
                    jQuery(divObj).removeClass('spinkx-read-notify');
                }
            });
        }
    });

    jQuery('.spinkx-mark-read').on('click', function(e) {
       // var arr = jQuery('.fst-cnt-cls-mn-dv');
        jQuery('.rnd-cmn-cls-dv-mn-cntr-rng').show();
        var ids = [], i=0;
        jQuery(".fst-cnt-cls-mn-dv").not(".spinkx-read-notify").each(function (index, item) {
           ids[i++] = $(this).attr('data-id');
        });
        if(ids.length> 0) {

            jQuery.ajax({
                url: ajaxurl + '?action=spinkx_cont_noti_updstatus',
                type: "POST",
                data: {"id": ids},
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.status === 1) {
                        jQuery('.fst-cnt-cls-mn-dv').attr('data-read', 1);
                        jQuery(".fst-cnt-cls-mn-dv").not(".spinkx-read-notify").each(function (index, item) {
                            jQuery(item).addClass('spinkx-read-notify');
                        });
                        spnx_notify_unread = 0;
                        jQuery('.rnd-cmn-cls-dv-mn-cntr-rng').hide();
                        jQuery('.spinkx-notify-update-bubble').text(spnx_notify_unread).hide();

                    }
                },
                error: function() {
                    jQuery('.rnd-cmn-cls-dv-mn-cntr-rng').hide();
                },

            });
        } else {
            jQuery('.rnd-cmn-cls-dv-mn-cntr-rng').hide();
        }
    });
});

