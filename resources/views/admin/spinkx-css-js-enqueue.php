<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function spinkx_admin_add_inline_js(){
	$css = 'scss';
	if( SPINKX_CONTENT_PRODUCTION ) {
		$css = 'css';
	}
	wp_register_style('spinkx_content_marketing_dashicons', SPINKX_CONTENT_DIST_URL .'css/spinkx-content-marketing.'.$css);
	wp_enqueue_style('spinkx_content_marketing_dashicons');
    wp_enqueue_script( 'spinkx-top-notifications', SPINKX_CONTENT_DIST_URL . 'js/common.js' );
}

/**
 *
 * This function for add inline css on spinkx icon
 * spinkx_icon_css()
 *
 * @return void
 * @internal param $void
 */

function spinkx_cont_js_var() {

	$spnxAdminManage = new spnxAdminManage;
	$settings = get_option( SPINKX_CONTENT_LICENSE );
	$settings = maybe_unserialize( $settings );
    $settings['site_id'] = isset($settings['site_id'])? $settings['site_id']:0;
	$custom_js = '<script>
    var spinkx_server_baseurl = "' . SPINKX_CONTENT_BAPI_URL . '";
	var SPINKX_CONTENT_PLUGIN_URL = "' . SPINKX_CONTENT_PLUGIN_URL . '";
	var g_site_id =  "' . $settings['site_id'] . '";
    var SPINKX_CONTENT_DIST_URL = "'.SPINKX_CONTENT_DIST_URL.'";
	</script>';
	echo $custom_js;
	$path = array(SPINKX_CONTENT_DIST_URL, SPINKX_CONTENT_PLUGIN_URL);
	$page = spnxHelper::getFilterVar( 'page' );
	
	if ( $page && $page === 'spinkx_content_play_list' ) {
		spinkx_cont_common_css_js( $page, $path );
		spinkx_cont_cp_css_js(null, $path);
	} elseif ( $page && $page === 'spinkx_widget_design' ) {
		spinkx_cont_common_css_js( $page, $path );
		spinkx_cont_widget_css_js($path);
	} elseif ( $page && $page === 'spinkx-site-register' ) {
		spinkx_cont_common_css_js( $page, $path );
		spinkx_cont_registration_css_js($path);
	} elseif ( $page && $page === 'spinkx_analytics' ) {
		spinkx_cont_common_css_js( $page, $path );
		spinkx_cont_dashboard_css_js($path);
	} elseif ( $page && $page === 'spinkx_campaigns' ) {
		spinkx_cont_common_css_js( $page, $path );
		spinkx_cont_campaign_set_css_js($path);
		spinkx_cont_cp_css_js( true, $path );
		//spinkx_cont_campaign_form_set_css_js();
		$r_flag = spnxHelper::getFilterVar( 'r' );
		if ( $r_flag &&  $r_flag === 'edit_campaign' ) {
			//spinkx_cont_common_css_js( $page );
			spinkx_cont_campaign_form_set_css_js($path);
		}
	} elseif ($page && $page === 'spinkx-site-dashboard') {
		spinkx_cont_common_css_js( $page, $path );

	}

}

/**
 *
 * This function for add enqueue css & js
 * spinkx_registration_css_js()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_common_css_js( $page, $path  ) {
	/**
	 * CSS Loading
	 */
	$css = 'scss';
	if(SPINKX_CONTENT_PRODUCTION) {
		$css = 'css';
	}
	$vendor = $path[1] . 'vendor/';
	wp_enqueue_style( 'bootstrap', $vendor.'bootstrap/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', $vendor . 'fontawesome/css/fontawesome-all.min.css' );
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/styles/' );
	if ( $page !== 'spinkx_campaigns' ) {
		wp_enqueue_style( 'jquery-ui', $vendor . 'jQuery/css/jquery-ui.css' );

	}
	if ( $page !== 'spinkx_options' ) {
		wp_enqueue_style( 'growl', $vendor . 'jQuery-growl/css/jquery.growl.css' );
		/*if ( $page !== 'spinkx_campaigns' ) {
			wp_enqueue_style('select2', $css_url . 'select2.css');
		}*/
		wp_enqueue_style( 'date-range-picker', esc_url( '//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css' ) );
	}
	$css_url = esc_url( $vendor . 'dataTables/' );
	wp_enqueue_style( 'datatables', $vendor . 'dataTables/jquery.dataTables.min.css' );
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/styles/' );
	wp_enqueue_style( 'jquery-daterange-picker', $vendor . 'jQuery-daterange-picker/css/jquery-daterange-picker.css' );
	wp_enqueue_style( 'master', $path[0] . 'css/master.'.$css );
	/**
	 * JS Loading
	 */
	$js_url = esc_url( SPINKX_CONTENT_DIST_URL . 'js/' );
	wp_enqueue_script( 'smooch-js', $vendor .'smooch/js/smooch.min.js' );

	wp_add_inline_script('smooch-js', "Smooch.init({ appId: '585e57e650cedf70007fab2e' });");
	wp_enqueue_script( 'jquery-ui-js', $vendor . 'jQuery/js/jquery-ui.js' );
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/js/' );
	wp_enqueue_script( 'bootstrap-js', $vendor . 'bootstrap/js/bootstrap.min.js' );


	if ( $page !== 'spinkx_options' ) {
		if ( $page !== 'spinkx_campaigns' ) {
			//wp_enqueue_script('select2-js', $vendor . 'select2/js/select2.min.js');
		}
        wp_enqueue_script( 'growl-js', $vendor . 'jQuery-growl/js/jquery.growl.js' );
		wp_enqueue_script( 'moment-js', $vendor.'moment/js/moment.min.js' );
		wp_enqueue_script( 'jquery-bpopup', $vendor . 'bpopup/js/jquery.bpopup.min.js' );
		wp_enqueue_script( 'jquery-daterange-picker-js', $vendor . 'jQuery-daterange-picker/js/jquery-daterange-picker.js' );
		$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/dataTables/' );
		wp_enqueue_script( 'jquery-datatables', $vendor . 'dataTables/jquery.dataTables.min.js' );
	}

}


/**
 *
 * This function for add enqueue css & js
 * spinkx_registration_css_js()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_registration_css_js($path) {
	$vendor = $path[1] . 'vendor/';
	wp_enqueue_style( 'jquery-multiselect-css', $vendor . 'jQuery-multiselect/css/jquery.multiselect.css' );
	$custom_css = ' .modal-body { height: 320px; overflow: auto; } 	
	.modal-backdrop { background-color: #fff; }
	.modal-backdrop.fade.in	{ opacity: .8; }
	.select2-container-multi .select2-choices { width:initial; }
	.buy-msg { display: block; font-weight: 600; font-size:11px; border: 1px solid ##F1F1F1; background: #dde5ec; width: 254px; float: right;
    text-align: right; border-radius: 5px; padding:5px; margin-top:10px; }';
	wp_add_inline_style( 'master', $custom_css );
	wp_enqueue_script( 'jquery-multiselect-js', $vendor . 'jQuery-multiselect/js/jquery.multiselect.js' );
	wp_enqueue_script('registration-js', $path[0] . 'js/registration.js');
	wp_enqueue_media();
}

/**
 *
 * This function for add enqueue css & js
 * spinkx_registration_css_js()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_widget_css_js($path) {
	$vendor = $path[1] . 'vendor/';
	$css = 'scss';
	if(SPINKX_CONTENT_PRODUCTION) {
		$css = 'css';
	}
	wp_enqueue_style( 'css-add-widget', $path[0]  . 'css/add-widget.'.$css );
	wp_enqueue_style( 'css-multiselect', $vendor . 'jQuery-multiselect/css/jquery.multiselect.css' );
	wp_enqueue_style( 'wp-color-picker' );
	$custom_css = 'table.dataTable { border-collapse: collapse; border-spacing: 0px; }
	 ';
	wp_add_inline_style( 'master', $custom_css );
	wp_enqueue_script( 'jquery-google-chart', $vendor . 'google-chart/loader.js' );
	wp_enqueue_script( 'form-validator-js', esc_url( '//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js' ) );
    wp_enqueue_script( 'jquery-multiselect', $vendor . 'jQuery-multiselect/js/jquery.multiselect.js' );
    wp_enqueue_script( 'wp-color-picker-alpha', plugins_url(     'custom-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );

}

/**
 *
 * This function for add enqueue css & js
 * spinkx_registration_css_js()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_cp_css_js( $callFrom = null, $path ) {
	$vendor = $path[1] . 'vendor/';
	$css = 'scss';
	if(SPINKX_CONTENT_PRODUCTION) {
		$css = 'css';
	}
	// wp_enqueue_style( 'bootstrap', $css_url . 'bootstrap.min.css' , array('custom-style'));
	wp_enqueue_style( 'css-powertrip', $vendor . 'jQuery-powertip/css/jquery.powertip.min.css' );
	wp_enqueue_style( 'jquery-multiselect-css', $vendor . 'jQuery-multiselect/css/jquery.multiselect.css' );
    wp_enqueue_style( 'growl', $path[0] . 'css/add-widget.'.$css , array( 'custom-style' ) );
	$custom_css = ' ul li:before {content:none;} 
	ul li, ol li { padding: 0px 0 0;}
	.hook_add_class{ background-color:#e6e7e7; }
    .main{ /*background-color: !*#e4f4fa*! #F1F1F1 !important;*/ }
	#clock span{ background-color: #469fa1; width:20px;	height:20px; margin:6px; padding:5px 7px; color:#fff; }
	#clock{ font-weight:bold; }
	#wpfooter { display:none; }
	table { border-right:none !important; border-left:none !important; border-top:none !important; }
	td { border:none !important; }
	th { border-right:none !important; border-left:none !important; border-top:none !important; }
	#bwki_sites_display_length { padding-top: 34px; position: absolute; }
	tr { background:none !important; }
	.onoff_header input { font-size: 8px; background: #f0f0f0; border: 0;  color: #000; font-family: "Open Sans";
	font-weight: 300; letter-spacing: 0.046875em; line-height: 1; padding: 0.84375em 0.875em 0.78125em; text-transform: uppercase; }
	.hook_add_class { background-color:#e6e7e7; }
	#clock span { background-color: #469fa1; width:20px; height:20px; margin:6px; padding:5px 7px; color:#fff; }
	#clock { font-weight:bold; }
	input[type=button] { padding: 5px !important; border: 1px solid #2986c1 !important; }
	.progress { float: left;
            width: 190px;
            height: 9px !important;
            line-height: 9px;
            margin-bottom: 0px;
            margin-top: 3px;
            border-radius: 9px !important;
            font-size: 8px;
            font-weight: bolder;
            text-align: center;
        }      
        .progress-bar {
         font-size: 8px;
          height: 9px;
          line-height: 9px;
          text-align: center;
        }
        table.dataTable.no-footer {
            border-bottom: none;
        }

        table.dataTable tbody td {
            padding: 8px 0px;
        }
        table.dataTable thead .sorting, table.dataTable thead .sorting_asc  { background-image:none; };';
	wp_add_inline_style( 'master', $custom_css );

	wp_enqueue_script( 'form-validator-js', esc_url( '//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js' ) );

	wp_enqueue_script( 'jquery-lazyloading-js', $vendor . 'lazysizes/js/lazysizes.min.js' );
	wp_enqueue_script( 'jquery-multiselect-js', $vendor . 'jQuery-multiselect/js/jquery.multiselect.js' );
	if( ! $callFrom ) {
		wp_enqueue_script('jquery-variation-custom-js', $path[0] . 'js/content-playlist.js');
	}
}

/**
 *
 * This function for add enqueue css & js
 * spinkx_registration_css_js()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_dashboard_css_js($path) {
	$vendor = $path[1] . 'vendor/';
	$custom_css = '.#wpwrap, .wrap, #wpcontent, #wpfooter { background-color: #319de4 !important;}';
	wp_add_inline_style( 'master', $custom_css );
	wp_enqueue_script( 'jquery-growl', $vendor . 'jQuery-growl/js/jquery.growl.js' );
	wp_enqueue_script( 'jquery-google-chart', $vendor . 'google-chart/loader.js' );
	wp_enqueue_script( 'jquery-bpopup', $vendor . 'bpopup/js/jquery.bpopup.min.js' );

}

/**
 *
 * This function for add enqueue css & js
 * spinkx_registration_css_js()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_acc_set_css_js($path) {
	$custom_css = ' #wpwrap { background-color: #f1f1f1; }';
	wp_add_inline_style( 'master', $custom_css );
	//wp_enqueue_script( 'jquery-custom-js', $path[0] . 'js/widget-design.js' );
}

/**
 *
 * This function for add enqueue css & js
 * spinkx_registration_css_js()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_campaign_set_css_js($path) {
	$vendor = $path[1] . 'vendor/';
	wp_enqueue_style( 'jquery-ui', $vendor . 'jQuery/css/jquery-ui.css' );
	wp_enqueue_style( 'jquery-multiselect-css', $vendor . 'jQuery-multiselect/css/jquery.multiselect.css' );
	wp_enqueue_style( 'bootstrap-datetimepicker-css', $vendor . 'bootstrap/css/bootstrap-datetimepicker.css' );
	$custom_css = '.form-group{ text-align: left; }
	.form-group input[type="text"],
	textarea{ 	width: 100%;}
	}';
	wp_add_inline_style( 'jquery-ui', $custom_css );
	wp_enqueue_media();
	wp_enqueue_script( 'jquery-dateFormat-js', $vendor . 'jQuery-dateformat/js/jquery-dateFormat.min.js' );
	wp_enqueue_script( 'jquery-moment-js', $vendor . 'moment/js/moment.min.js' );
	wp_enqueue_script( 'jquery-datetimepicker-js', $vendor . 'bootstrap/js/bootstrap-datetimepicker.js' );
	wp_enqueue_script( 'jquery-campaign', $path[0] . 'js/campaign.js' );
	$js_url = esc_url( SPINKX_CONTENT_DIST_URL . 'js/' );
	wp_enqueue_script( 'jquery-multiselect-js', $vendor . 'jQuery-multiselect/js/jquery.multiselect.js' );
}

/**
 *
 * This function for add enqueue css & js
 * spinkx_registration_css_js()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_campaign_form_set_css_js() {
	$custom_css = '#wpfooter { display: none; } 
	.small .modal-body {	overflow-y: auto; }
	.form-group{ text-align: left; }
	.form-group input[type="text"],
	textarea{ 	width: 100%;}
	.fade{ opacity: 1; } 
	modal{ display: inline-block;	z-index: 999999;}';
	wp_add_inline_style( 'jquery-ui', $custom_css );
}

/**
 *
 * This function is for adding menu buttons on page
 * spinkx_header_menu()
 *
 * @return void
 * @internal param void
 */

function spinkx_header_menu() {
	$page = spnxHelper::getFilterVar('page');
	$tab = spnxHelper::getFilterVar('tab');
	$spnxAdminManage = new spnxAdminManage;
	$settings = get_option( SPINKX_CONTENT_LICENSE );
	$settings = maybe_unserialize( $settings );
	$site_id = isset($settings['site_id'])?$settings['site_id']:0;
    $settings['due_date'] = isset($settings['due_date'])?$settings['due_date']:'0000-00-00 00:00:00';
    ?><div><div class="spnx-menu-logo"><span><a target="_blank" href="https://www.spinkx.com"><img src="<?php echo SPINKX_CONTENT_DIST_URL; ?>images/spinkx-logo.png" /></a></span></div>
	<ul class="nav nav-tabs">
        <?php if(  $settings['due_date'] == '0000-00-00 00:00:00'  ) {?>
		<li <?php echo ('spinkx-site-register' === $page)?'class="active"':''?>><a href="?page=spinkx-site-register">Registration</a></li>
		<?php } else { ?>
            <li <?php echo ('spinkx_analytics' === $page)?'class="active"':''?>><a href="?page=spinkx_analytics">Analytics</a></li>
        <?php } ?>
		<li <?php echo ('spinkx_widget_design' === $page)?'class="active"':''?>><a href="?page=spinkx_widget_design">Widget Settings</a></li>
		<li <?php echo ('spinkx_content_play_list' === $page)?'class="active"':''?>><a href="?page=spinkx_content_play_list">Free Boost Post</a></li>
		<li <?php echo ('spinkx_campaigns' === $page)?'class="active"':''?>><a href="?page=spinkx_campaigns">Paid Campaigns</a></li>
    </ul>
	<?php if ('spinkx_content_play_list' === $page) { ?>
	<div class="spnx-sync" title="Post ReSync"><img  id="posts_<?php echo $site_id ?>" class="posts_sync" src="<?php echo SPINKX_CONTENT_CDN_URL; ?>media/sync-icon.png"  /></div>
	<?php } ?>

	<?php  if ('edit-widget' !== $tab ) { ?>
	<div class="spnx-statistcs">
		<div class="input-group">
			<input id="daterange" class="form-control" readonly="">
			<span class="drop-down-date">
            </span>
		</div>
		<div id="daterange-picker-container"></div>
	</div>
	<div style="clear: both"></div>
	<?php  }
	$noitce_flag = false;
	$info_flag = false;
	if('spinkx_content_play_list' === $page ) {
		$cp_noitce_info = get_option('notice-spnx-cp', 1);
		if( $cp_noitce_info ) {
			$spnxAdminManage->spinkx_cont_admin_notices('Important Features of Boost Post<br/><span class="message">“Boost Post” is a Traffic Builder & SEO Backlink Builder for your website. It helps your content to reach out to audience outside your network by displaying your posts on other websites who use Spinkx as well.<br/>- It is run using a Traffic Exchange points mechanism. You earn points when other sites boost post are displayed on your site widget and you can use those points to keep on boosting your posts and get more traffic to your site Free for life.<br/>- You already have 100 points to begin with which will give your posts a 1000 reach and if you buy this plugin for $60, you get 1000 points with 10,000 reach. Enjoy boosting and see your SEO rise with backlinks and keep getting more traffic back!.<br/>- You can only promote Posts with featured images in it, and not pages or home page (for this you need to go to Campaigns and run a Paid Campaign)<br/>- “Create Variations” is a very very important tool to Multiply your Reach & backlinks. It helps you create more variations for your post with different Headlines, Descriptions & Images. Allowing you  a higher chance of getting clicks back. It will tell you what users like to read more, when you look at the CTR performance.<br/>- The Variation Posts also can be shared on Social Media,  creating more opportunities of engagement for the same post and we can actually now count how many people clicked and landed on to your website. And what worked better!</span>', 'notice-info notice-spnx notice-spnx-cp');
			$noitce_flag = true;
		} else {
			echo '<a href="javascript:;void(0)" class="spnx-faq" onclick="showNoticeCP();" style="margin-top: 10px; margin-left:450px;"><i>Boost Post FAQ\'s</i></a>';
			$info_flag = true;
		}
	 } else if('spinkx_campaigns' === $page ) {
	    $campaigns_noitce_info = get_option('notice-spnx-campaigns', 1);
		if(  $campaigns_noitce_info ) {
			$spnxAdminManage->spinkx_cont_admin_notices('Important Features of Campaign<br/><span class="message">- Campaigns have more Features than Boost Post. The more important ones are “Geo Targeting” & “Call to Action”.<br/>- You can promote any URL (may be of your Client, if you are a digital Marketeer) and give them guaranteed Reach across Spinkx Network. (If you want to promote your posts and your Site, its better to use Boost Post for Free Traffic, Reach & Backlinks)<br/>- You can measure the effectiveness of the campaign by looking at the eCPC data (It means, the monetary value of your Clicks)<br/>- It is important for you to add multiple creatives to your campaign to drive lowest eCPC and get the Reach Faster. The more creatives you add the faster your campaign works.<br/>- When other people run Campaigns and they auto-display on your site sidebar, you get to earn 80% of the campaign money for the number of reach given by your website.<br/>- You can go to your Spinkx-dashboard to see how much money you have earned or spent, and you may withdraw the money to your Paypal account.</span>', 'notice-info notice-spnx notice-spnx-campaigns');
			$noitce_flag = true;
		} else {
			echo '<a href="javascript:;void(0)" class="spnx-faq" onclick="showNoticeCampaign();" style="margin-top: 10px; margin-left:605px;"><i>Campaign FAQ\'s</i></a>';
			$info_flag = true;
		}
	 }
	 if( $noitce_flag ) {
		 $custom_js = "<script>jQuery(document).on('click', '.notice-spnx-cp .notice-dismiss, .notice-spnx-campaigns .notice-dismiss', function(){
			var skey = null;
			if( jQuery(this).parent().hasClass('notice-spnx-cp') ) {
				skey = 'notice-spnx-cp';
			} else if( jQuery(this).parent().hasClass('notice-spnx-campaigns') ) {
				skey = 'notice-spnx-campaigns';
			}
			if( skey ) {
				jQuery.ajax({
					url : ajaxurl,
					data : {'action':'spinkx_cont_save_notice_info', 'key':skey},
					type : 'POST',
					success : function(data){ console.log(data);},
					failure : function(data){}
				});
			}	
		});</script>";
		echo $custom_js;
	 }
	if( $info_flag ) {
		if('spinkx_content_play_list' === $page ) {
			$msg = 'Important Features of Boost Post\n\n==================================\n\n“Boost Post” is a Traffic Builder & SEO Backlink Builder for your website. It helps your content to reach out to audience outside your network by displaying your posts on other websites who use Spinkx as well.\n - It is run using a Traffic Exchange points mechanism. You earn points when other sites boost post are displayed on your site widget and you can use those points to keep on boosting your posts and get more traffic to your site Free for life.\n - You already have 100 points to begin with which will give your posts a 1000 reach and if you buy this plugin for $60, you get 1000 points with 10,000 reach. Enjoy boosting and see your SEO rise with backlinks and keep getting more traffic back!.\n  - You can only promote Posts with featured images in it, and not pages or home page (for this you need to go to Campaigns and run a Paid Campaign)\n - “Create Variations” is a very very important tool to Multiply your Reach & backlinks. It helps you create more variations for your post with different Headlines, Descriptions & Images. Allowing you  a higher chance of getting clicks back. It will tell you what users like to read more, when you look at the CTR performance.\n  - The Variation Posts also can be shared on Social Media,  creating more opportunities of engagement for the same post and we can actually now count how many people clicked and landed on to your website. And what worked better!';

			$custom_js = "<script>function showNoticeCP(){ alert('$msg' ); }</script>";
		} else if('spinkx_campaigns' === $page ) {
			$msg = 'Important Features of Campaign\n\n==================================\n\n - Campaigns have more Features than Boost Post. The more important ones are “Geo Targeting” & “Call to Action”.\n - You can promote any URL (may be of your Client, if you are a digital Marketeer) and give them guaranteed Reach across Spinkx Network. (If you want to promote your posts and your Site, its better to use Boost Post for Free Traffic, Reach & Backlinks)\n - You can measure the effectiveness of the campaign by looking at the eCPC data (It means, the monetary value of your Clicks)\n - It is important for you to add multiple creatives to your campaign to drive lowest eCPC and get the Reach Faster. The more creatives you add the faster your campaign works.\n - When other people run Campaigns and they auto-display on your site sidebar, you get to earn 80% of the campaign money for the number of reach given by your website.\n- You can go to your Spinkx-dashboard to see how much money you have earned or spent, and you may withdraw the money to your Paypal account.';
			$custom_js = "<script>function showNoticeCampaign(){ alert('$msg' ); }</script>";
		}
		echo $custom_js;
	}
	?>
	</div>
<?php }
