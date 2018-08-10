<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="dsb_mn_cntr_spx">
    <div class="wdgt_cntnt_sub_hldr dsh_cntnt_sub_hldr">
            <iframe id="landing_url" width="100%" height="1410" src="https://www.spinkx.com/landing_page_url/3">
            </iframe>


		</div>
    </div>
<script>
    jQuery(document).ready(function($){
        $('#landing_url').load(function () {
            console.log($(".dsh_cntnt_sub_hldr").find());
            /*if (typeof callback == 'function') {
                callback($('body', this.contentWindow.document).html());
            }
            setTimeout(function () {$('#frameId').remove();}, 50);*/
        });
     // console.log($("#landing_url").contents());
    });
</script>