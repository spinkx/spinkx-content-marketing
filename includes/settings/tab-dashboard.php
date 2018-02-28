<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$url = $spnxAdminManage->spinkx_cont_bapi_url() . '/wp-json/spnx/v1/dashboard';
if( spnxHelper::getFilterVar( 'from_date' ) ) {
    $post['from_date'] = spnxHelper::getFilterVar( 'from_date' );
}
if( spnxHelper::getFilterVar( 'to_date' ) ) {
    $post['to_date'] = spnxHelper::getFilterVar( 'to_date' );
}
$data = spnxHelper::doCurl( $url,$post, true, array(), 3000);
$data = json_decode( $data, true );
$spnxAdminManage = new spnxAdminManage();
$settings = get_option($spnxAdminManage->spinkx_cont_get_license());
$settings = unserialize($settings);
if( is_array($data)) {
    ?><div class="spnx-dshb-mn-cntr">
        <div class="spnx-sec-mn-cntr">
            <div class="spnx-sec-one-chld-mn-cntnr cmn-cls-spnx-tab">
                <div class="spnx-thrd-chld-mn-cntr spnx-flex-strt spnx-flex-new-cmn">
                    <div class="bold-spnx-txt-cmn-cls">
                        SPINKX WALLET
                    </div>
                    <div class="ver-alg-fnt-awe-main" style="width:50px;">
                        <img style="width: 100%;" src="<?php echo SPINKX_CONTENT_PLUGIN_URL?>assets/images/walletico.png">
                    </div>
                </div>
                <div class="spnx-thrd-chld-mn-cntr spnx-flex-center spnx-flex-new-cmn">
                    <div class="label-pints-mny-cmn-cls">
                        Points
                    </div>
                    <div class="points-cmn-cls-spnx credit-points">
                        <?php echo $data['credit_points']?>
                    </div>

                    <div class="dashb-buy-points">
                        <button   id="buy-more-point" onclick="getpoints()">Buy More Point</button>
                    </div>

                </div>
                <div class="spnx-thrd-chld-mn-cntr spnx-flex-end ">
                    <div class="label-pints-mny-cmn-cls">
                        Money
                    </div>
                    <div class="points-cmn-cls-spnx">
                        <span class="credit-wallet-currency"><?php echo $data['currency']?></span> <span class="credit-wallet-bal"><?php echo $data['wallet_bal']?></span>
                    </div>
                    <div class="withdraw-money dashb-buy-points">
                        <button >Withdraw Money</button>
                    </div>
                </div>
            </div>
            <div class="spnx-sec-one-chld-mn-cntnr cmn-cls-spnx-tab" style="display: none;">
                <div class="spnx-thrd-chld-mn-cntr spnx-flex-strt">
                    <div class="bold-spnx-txt-cmn-cls">
                        SITE VISITS
                    </div>
                    <div class="ver-alg-fnt-awe-main">
                        <i class="fa fa-google-wallet fa-2x" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="spnx-thrd-chld-mn-cntr spnx-flex-center-second">
                    <div>
                        Page Views
                    </div>
                    <div class="points-cmn-cls-spnx">
                        100
                    </div>
                </div>
                <div class="spnx-thrd-chld-mn-cntr spnx-flex-end">
                    <div>
                        Bots
                    </div>
                    <div class="points-cmn-cls-spnx">
                        200
                    </div>
                </div>
            </div>
            <div class="spnx-sec-one-chld-mn-cntnr">
                <div class="spnx-thrd-chld-mn-cntr spnx-flex-strt">
                    <div class="bold-spnx-txt-cmn-cls">
                        SPINKX LICENSE
                    </div>
                    <div class="site-dtls-cmn-cls-spnx">
                        <div ><span class="label-pints-mny-cmn-cls">Site :</span> <span><?php echo $data['surl']?></span></div>
                        <div ><span class="label-pints-mny-cmn-cls">User : </span><span><?php echo $data['uname']?></span></div>
                    </div>
                    <div class="liceence-key-cls"><span class="label-pints-mny-cmn-cls">License Key:</span> <span > <?php echo $data['lkey']?></span></div>
                </div>
                <div class="spnx-thrd-chld-mn-cntr spnx-flex-end">
                    <div class="label-pints-mny-cmn-cls">
                        Valid for
                    </div>
                    <?php if($data['days'] !== '0000-00-00') {?>
                        <div class="points-cmn-cls-spnx">
                            <?php echo $data['days']?>
                        </div>
                        <?php  if ( intval( $data['days'] ) < 0 ) { ?>
                            <div style="font-size: 10px;" class="purchase-plugin dashb-buy-points"><button id="payment-method-buttonpn" class="btn-primary pbuy-now" style="    color: #fff;
    background-color: #0170B9;">Buy Now</button></div>
                        <?php  } ?>
                    <?php } else { ?><div class="points-cmn-cls-spnx" style="font-size:13px;"><?php echo "Not Registered";?></div> <?php } ?>
                </div>


            </div>
        </div>
        <div class="spnx-sec-mn-cntr">
            <div class="spnx-thrd-chld-mn-cntr-grph">
                <span class="bold-spnx-txt-cmn-cls cmn-hrzntl-cls-spn">SPINKX WIDGETS (<?php echo  $data['wd_active']?>)</span>
                <span >
					<span class="cmn-hrzntl-cls-spn"><span class="wd-views"><?php echo  $data['wd_views']?></span> views</span>
					<span class="cmn-hrzntl-cls-spn"><span class="wd-clicks"><?php echo  $data['wd_clicks']?></span> clicks</span>
					<span class="cmn-hrzntl-cls-spn"><span class="wd-ctr"><?php echo  $data['wd_ctr']?></span>% ctr</span>
				</span>
                <span class="ellispses-cmn-cls-spnx">
					<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
				</span>
                <div  class="graph-cmn-cls-spnx"><div id="widget_chart"></div></div>
            </div>
            <div class="spnx-thrd-chld-mn-cntr-views-clmn">
                <div class="widget-cmn-cls-wid">
                    <div class="bold-spnx-txt-cmn-cls">
                        Widget Views
                    </div>
                    <div class="points-cmn-cls-spnx">
                        <div class="wid-rev-point-icon-dv-cmn">
                            <img style="width: 100%;" src="<?php echo SPINKX_CONTENT_PLUGIN_URL?>assets/images/eyeico.png" />
                        </div>
                        <span class="widget-views fnt-size-cmn-cls-spnx"><?php echo $data['wd_views']?></span>
                    </div>
                </div>
                <div class="widget-cmn-cls-wid">
                    <div class="bold-spnx-txt-cmn-cls">
                        Widget Clicks |&nbsp;CTR
                    </div>
                    <div class="points-cmn-cls-spnx">
                        <div class="wid-rev-point-icon-dv-cmn">
                            <img style="width: 100%;" src="<?php echo SPINKX_CONTENT_PLUGIN_URL?>assets/images/Clicksico.png" />
                        </div>
                        <span class="widget-clicks fnt-size-cmn-cls-spnx"><?php echo $data['wd_clicks'] . ' | '.$data['wd_ctr']?>%</span>
                    </div>
                </div>
                <div class="widget-cmn-cls-wid">
                    <div class="bold-spnx-txt-cmn-cls">
                        Points Accumulated
                    </div>
                    <div class="points-cmn-cls-spnx">
                        <div class="wid-rev-point-icon-dv-cmn">
                            <img style="width: 100%;" src="<?php echo SPINKX_CONTENT_PLUGIN_URL?>assets/images/pointsico.png" />
                        </div>
                        <span class="total-pts-earn fnt-size-cmn-cls-spnx"><?php echo $data['tot_pts_earn']?></span>
                    </div>
                </div>
                <div class="widget-cmn-cls-wid">
                    <div class="bold-spnx-txt-cmn-cls">
                        Revenue Earned
                    </div>
                    <div class="points-cmn-cls-spnx">
                        <div class="wid-rev-point-icon-dv-cmn">
                            <img style="width: 100%;" src="<?php echo SPINKX_CONTENT_PLUGIN_URL?>assets/images/revenueico.png" />
                        </div>
                        <span class="total-money-earn fnt-size-cmn-cls-spnx"><?php echo $data['tot_money_earn']?></span>
                    </div>
                </div>

            </div>
        </div>
        <div class="spnx-sec-mn-cntr">
            <div class="locl-pst-bst-pst-cmn-cls lcl-hrzntl-cls">
                <div>
                    <span class="cmn-hrzntl-cls-spn bold-spnx-txt-cmn-cls">LOCAL POSTS (<span class="class="lp_active""><?php echo  $data['lp_active']?></span> Active)</span>
                    <span class="cmn-hrzntl-cls-spn"><span class="lp-views"><?php echo  $data['lp_views']?></span> views</span>
                    <span class="cmn-hrzntl-cls-spn"><span class="lp-clicks"><?php echo  $data['lp_clicks']?></span> clicks</span>
                    <span class="cmn-hrzntl-cls-spn"><span class="lp-ctr"><?php echo  $data['lp_ctr']?></span>% ctr</span>
                </div>
                <div class="graph-cmn-cls-spnx"><div id="lp_chart"></div></div>
            </div>
            <div class="locl-pst-bst-pst-cmn-cls lcl-hrzntl-cls-second">
                <div>
                    <span class="cmn-hrzntl-cls-spn bold-spnx-txt-cmn-cls">BOOST POSTS (<span class="bp_active"><?php echo  $data['bp_active']?></span> Active)</span>
                    <span class="cmn-hrzntl-cls-spn"><span class="bp-views"><?php echo  $data['bp_views']?></span> views</span>
                    <span class="cmn-hrzntl-cls-spn"><span class="bp-clicks"><?php echo  $data['bp_clicks']?></span> clicks</span>
                    <span class="cmn-hrzntl-cls-spn"><span class="bp-ctr"><?php echo  $data['bp_ctr']?></span>% ctr</span>
                    <span class="cmn-hrzntl-cls-spn"><span class="tot-pts-spent"><?php echo  $data['tot_pts_spent']?></span> Points spent</span>
                </div>
                <div  class="graph-cmn-cls-spnx"><div id="bp_chart"></div></div>
            </div>
        </div>
    </div>
    <div id="boostmodalbuyPoint" style="z-index: 9999;" class="modal small fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><strong>Buy Points</strong></h4>
                </div>
                <div class="modal-body">
                    <?php if(isset($data['reach'])) { ?>
                        <div class="form-group">
                            <label for="point_amount">Points</label><br/>
                            <br/><input	type="text" class="form-control" id="buy_point"  style="display: inline;width:40%;" value="100"/>
                        </div>
                        <div class="form-group">
                            <label>Reach</label>
                            <label id="reach" style="margin-left: 20px"><?php echo $data['reach']?></label>
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <label style="margin-left: 20px"><i id="currency_format" class="fa fa-<?php echo strtolower($data['currency']) ?>" style="display: inline;"></i><span id="amount"><?php echo $data['price']?></label>
                            <input type="hidden" id="point_amount" value="<?php echo $data['price']?>" />
                        </div>
                        <?php
                        if(isset($data['buy_points'])) {
                            echo do_shortcode($data['buy_points']);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        var spinkx_data = <?php echo json_encode($data); ?>;
        <?php if(isset($data['buy_now'])) { ?>
        jQuery(document).ready(function(){
            function pluginPaymentSuccessHandler(transaction){transaction.amount =pnoptions.amount; pluginPayment(transaction);}
            <?php echo $data['buy_now']?>;
        });
        <?php } ?>

    </script>
    <?php
} else {
    echo $data;
}
?>
