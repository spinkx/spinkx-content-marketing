jQuery(document).ready(function($){
    jQuery('#wp-admin-bar-spinkx_notification').hover(function () {
        jQuery('#wp-admin-bar-spinkx_notification .ab-item').css('background','transparent');
    })
    jQuery('#wp-admin-bar-spinkx_notification span.img-cntnr-gf-mn-dv').click(function(){
        jQuery('.ntf-mn-cntnr').toggle();
    });
    var spnx_notify_unread = 0;
    jQuery.ajax({url: ajaxurl+'?action=spinkx_cont_notifications', async: false, success: function(data) {
        jQuery('.rnd-cmn-cls-dv-mn-cntr-rng').remove();
        data = JSON.parse(data);
        if(data.length < 2 || true) {
            jQuery('.al-cntnt-mn-dv').css('overflow-y', 'none')
        }
        for(var $i=0; $i < data.length; $i++) {
            if(data[$i].log_read_status == 0) {
                spnx_notify_unread++;
            }
            $html = '<div class="fst-cnt-cls-mn-dv" data-read="'+data[$i].log_read_status+'" data-id="'+data[$i].log_id+'">';
            $html += '<div class="cm-fst-cnt-cls-mn-dv-chld" style="width: 22px !important; height: 22px !important;"><svg viewBox="0 0 22 22"><g stroke="none" stroke-width="1">  <g fill="#00B8D4">    <g transform="translate(6.292893, 7.000000)          rotate(-315.000000)          translate(-6.292893, -7.000000)          translate(1.792893, -0.500000)">      <path d="M6.5,0.704972086 C7.96591517,1.29835946            9,2.73552479 9,4.41421356 C9,6.62335256            7.209139,8.41421356 5,8.41421356            C2.790861,8.41421356           1,6.62335256 1,4.41421356 C1,2.73552479            2.03408483,1.29835946 3.5,0.704972086            L3.5,4.41421356 L6.5,4.41421356 L6.5,0.704972086            L6.5,0.704972086 Z"></path>      <rect x="3" y="6" width="4" height="9" rx="2"></rect>    </g>  </g></g></svg></div>';
            $html += '<div class="cm-fst-cnt-cls-mn-dv-chld fnt-sz-rsz-cm-cl-n"><div class="upd-mn-dv-cls">'+data[$i].log_action+'</div> ' +
                '<div class="fnt-opc-mn-dv">'+data[$i].log_by_email+'</div></div><div class="cm-fst-cnt-cls-mn-dv-chld fnt-opc-mn-dv">'+data[$i].log_date+'</div></div>';
            jQuery('.al-cntnt-mn-dv').append($html);
        }
        if(spnx_notify_unread > 0) {
            jQuery('.spinkx-notify-update-bubble').text(spnx_notify_unread).show();
        }
      }
    });
    jQuery('.fst-cnt-cls-mn-dv').on('hover', function(e) {
        read_status = $(this).attr('data-read') * 1;
        divObj = $(this);
        if(!read_status) {
            $(divObj).attr('data-read', '2');
            log_id = $(this).attr('data-id');
            jQuery.ajax({
                url: ajaxurl + '?action=spinkx_cont_noti_updstatus',
                type: "POST",
                async: true,
                data: {"id": log_id},
                success: function (data) {
                    data = JSON.parse(data);
                    if(data.status) {
                        $(divObj).attr('data-read', '1');
                        spnx_notify_unread--;
                        jQuery('.spinkx-notify-update-bubble').text(spnx_notify_unread).show();
                    }
                }
            });
        }
    });
});
