<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 *
 * This function for add inline css on spinkx icon
 * spinkx_cont_icon_css()
 *
 * @return void
 * @internal param $void
 */

function spinkx_cont_icon_css() {
	echo '<style>.toplevel_page_spinkx-site-register .wp-menu-image img {
		padding: 6px 0 0 !important;
		opacity: .9 !important;
		max-width: 65%;
		filter: alpha(opacity=60);
	} span.spinkx-notify-update-bubble{
    position: absolute !important;
    top: 6px !important;
    left: 20px !important;
    -webkit-border-radius: 10px !important;
    -khtml-border-radius: 10px !important;
    -moz-border-radius: 10px !important;
    border-radius: 10px !important;
    background: #ccc !important;
    color: #464646 !important;
    width: 10px !important;
    height: 10px !important;
    padding: 3px !important;
    font-size: 11px !important;
    line-height: 10px !important;
    display: inline-block !important;
    text-align: center !important;
    text-shadow: none !important;
    font-weight: bold !important;
    z-index: 2;
}
span.spinkx-notify-text-active{
    position: relative !important;
    margin-left: 14px !important;
    color: #91b1c6 !important;
    font-weight: bold !important;
    text-shadow: 0px 0px 1px #000 !important;
}</style>';

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
	$settings = get_option( $spnxAdminManage->spinkx_cont_get_license() );
	$settings = maybe_unserialize( $settings );
	if( ! isset($settings['site_id']) ) {
		return;
	}
	$custom_js = '<script>var SPINKX_CONTENT_PLUGIN_DIR = "' . SPINKX_CONTENT_PLUGIN_DIR . '";
	var spinkx_server_baseurl = "' . $spnxAdminManage->spinkx_cont_bapi_url() . '";
	var SPINKX_CONTENT_PLUGIN_URL = "' . SPINKX_CONTENT_PLUGIN_URL . '";
	
	var g_site_id =  "' . $settings['site_id'] . '";
	</script>';
	echo $custom_js;
	$page = spnxHelper::getFilterVar( 'page' );
	
	if ( $page && $page === 'spinkx_content_play_list' ) {
		spinkx_cont_common_css_js( $page );
		spinkx_cont_cp_css_js();
	} elseif ( $page && $page === 'spinkx_widget_design' ) {
		spinkx_cont_common_css_js( $page );
		spinkx_cont_widget_css_js();
	} elseif ( $page && $page === 'spinkx-site-register' ) {
		spinkx_cont_common_css_js( $page );
		spinkx_cont_registration_css_js();
	} elseif ( $page && $page === 'spinkx_dashboard' ) {
		spinkx_cont_common_css_js( $page );
		spinkx_cont_dashboard_css_js();
	} elseif ( $page && $page === 'spinkx_campaigns' ) {
		spinkx_cont_common_css_js( $page );
		spinkx_cont_campaign_set_css_js();
		spinkx_cont_cp_css_js( true );
		//spinkx_cont_campaign_form_set_css_js();
		$r_flag = spnxHelper::getFilterVar( 'r' );
		if ( $r_flag &&  $r_flag === 'edit_campaign' ) {
			//spinkx_cont_common_css_js( $page );
			spinkx_cont_campaign_form_set_css_js();
		}
	} elseif ( $page && $page === 'spinkx_options' ) {
		spinkx_cont_common_css_js( $page );
		spinkx_cont_acc_set_css_js();
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
function spinkx_cont_common_css_js( $page  ) {
	/**
	 * CSS Loading
	 */

	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/css/' );
	wp_enqueue_style( 'bootstrap', $css_url . 'bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', $css_url . 'font-awesome.min.css' );
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/styles/' );
	if ( $page !== 'spinkx_campaigns' ) {
		wp_enqueue_style( 'jquery-ui', $css_url . 'jquery-ui.css' );

	}
	if ( $page !== 'spinkx_options' ) {
		wp_enqueue_style( 'growl', $css_url . 'jquery.growl.css' );
		$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/css/' );
		if ( $page !== 'spinkx_campaigns' ) {
			wp_enqueue_style('select2', $css_url . 'select2.css');
		}
		wp_enqueue_style( 'date-range-picker', esc_url( '//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css' ) );
	}
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/dataTables/' );
	wp_enqueue_style( 'datatables', $css_url . 'jquery.dataTables.min.css' );
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/styles/' );
	wp_enqueue_style( 'jquery-daterange-picker', $css_url . 'jquery-daterange-picker.css' );
	wp_enqueue_style( 'master', $css_url . 'master.css' );
	/**
	 * JS Loading
	 */
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
	wp_enqueue_script( 'smooch-js', $js_url .'smooch.min.js' );

	wp_add_inline_script('smooch-js', "Smooch.init({ appToken: 'aa9cksz2rzpy071aqxhe31yvs' });");
	wp_enqueue_script( 'jquery-ui-js', $js_url . 'jquery-ui.js' );
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/js/' );
	wp_enqueue_script( 'bootstrap-js', $js_url . 'bootstrap.min.js' );


	if ( $page !== 'spinkx_options' ) {
		if ( $page !== 'spinkx_campaigns' ) {
			wp_enqueue_script('select2-js', $js_url . 'select2.min.js');
		}
		$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
		wp_enqueue_script( 'growl-js', $js_url . 'jquery.growl.js' );
		wp_enqueue_script( 'moment-js', $js_url.'moment.min.js' );
		wp_enqueue_script( 'jquery-bpopup', $js_url . 'jquery.bpopup.min.js' );
		wp_enqueue_script( 'jquery-daterange-picker-js', $js_url . 'jquery-daterange-picker.js' );
		$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/dataTables/' );
		wp_enqueue_script( 'jquery-datatables', $js_url . 'jquery.dataTables.min.js' );
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
function spinkx_cont_registration_css_js() {
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/styles/' );
	wp_enqueue_style( 'jquery-multiselect-css', $css_url . 'jquery.multiselect.css' );
	$custom_css = ' .modal-body { height: 320px; overflow: auto; } 	
	.modal-backdrop { background-color: #fff; }
	.modal-backdrop.fade.in	{ opacity: .8; }
	.select2-container-multi .select2-choices { width:initial; }
	.buy-msg { display: block; font-weight: 600; font-size:11px; border: 1px solid ##F1F1F1; background: #dde5ec; width: 254px; float: right;
    text-align: right; border-radius: 5px; padding:5px; margin-top:10px; }';
	wp_add_inline_style( 'master', $custom_css );
	wp_enqueue_script( 'jquery-multiselect-js', $js_url . 'jquery.multiselect.js' );
	wp_enqueue_script('registration-js', $js_url . 'registration.js');
}

/**
 *
 * This function for add enqueue css & js
 * spinkx_registration_css_js()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_widget_css_js() {
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/styles/' );
	wp_enqueue_style( 'css-multiselect', $css_url . 'jquery.multiselect.css' );
	$custom_css = ' .no-js #loader, .notice { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con { position: fixed; left: 0; top: 0; width: 100%; height: 100%; z-index: 9999;	
	 background: url( ' . esc_url( SPINKX_CONTENT_PLUGIN_URL ) . '/assets/images/loader.gif) center no-repeat rgba(0, 0, 0, 0.2); }
	 table.dataTable { border-collapse: collapse; border-spacing: 0px; }
	 ';
	wp_add_inline_style( 'master', $custom_css );
	wp_enqueue_script( 'form-validator-js', esc_url( '//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js' ) );
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
	wp_enqueue_script( 'jquery-multiselect', $js_url . 'jquery.multiselect.js' );
	wp_enqueue_script( 'jquery-custom-js', $js_url . 'widget-design.js' );
}

/**
 *
 * This function for add enqueue css & js
 * spinkx_registration_css_js()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_cp_css_js( $callFrom = null ) {
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/styles/' );
	// wp_enqueue_style( 'bootstrap', $css_url . 'bootstrap.min.css' , array('custom-style'));
	wp_enqueue_style( 'css-powertrip', $css_url . 'jquery.powertip.min.css' );
	wp_enqueue_style( 'jquery-multiselect-css', $css_url . 'jquery.multiselect.css' );
	wp_enqueue_style( 'growl', $css_url . 'add-widget.css' , array( 'custom-style' ) );
	$custom_css = ' ul li:before {content:none;} 
	ul li, ol li { padding: 0px 0 0;}
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con { position: fixed; left: 0; top: 0; width: 100%; height: 100%; z-index: 9999; 
	background: url( ' . esc_url( SPINKX_CONTENT_PLUGIN_URL ) . '/assets/images/loader.gif) center no-repeat rgba(0, 0, 0, 0.2);; }
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
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
	wp_enqueue_script( 'jquery-lazyloading-js', $js_url . 'lazysizes.min.js' );
	wp_enqueue_script( 'jquery-multiselect-js', $js_url . 'jquery.multiselect.js' );
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
	if( ! $callFrom ) {
		wp_enqueue_script('jquery-variation-custom-js', $js_url . 'content-playlist.js');
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
function spinkx_cont_dashboard_css_js() {
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
	$custom_css = ' .no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.#wpwrap, .wrap, #wpcontent, #wpfooter { background-color: #319de4 !important;}
	.se-pre-con { position: fixed; left: 0; top: 0;	width: 100%; height: 100%; z-index: 9999; 
	 background: url( ' . SPINKX_CONTENT_PLUGIN_URL . '/assets/images/loader.gif) center no-repeat rgba(0, 0, 0, 0.2); } ';
	wp_add_inline_style( 'master', $custom_css );
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
	wp_enqueue_script( 'jquery-growl', $js_url . 'jquery.growl.js' );
	wp_enqueue_script( 'jquery-google-chart', $js_url . 'loader.js' );
	wp_enqueue_script( 'jquery-bpopup', $js_url . 'jquery.bpopup.min.js' );

}

/**
 *
 * This function for add enqueue css & js
 * spinkx_registration_css_js()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_acc_set_css_js() {
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/css/' );
	$custom_css = ' #wpwrap { background-color: #f1f1f1; }
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con { position: fixed; left: 0; top: 0; width: 100%; height: 100%; z-index: 9999;
     background: url( ' . esc_url( SPINKX_CONTENT_PLUGIN_URL ) . '/assets/images/loader.gif) center no-repeat rgba(0, 0, 0, 0.2);; }';
	wp_add_inline_style( 'master', $custom_css );
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
	wp_enqueue_script( 'jquery-custom-js', $js_url . 'widget-design.js' );
}

/**
 *
 * This function for add enqueue css & js
 * spinkx_registration_css_js()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_campaign_set_css_js() {
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/styles/' );
	wp_enqueue_style( 'jquery-ui', $css_url . 'jquery-ui.css' );
	wp_enqueue_style( 'jquery-multiselect-css', $css_url . 'jquery.multiselect.css' );
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/css/' );
	wp_enqueue_style( 'bootstrap-datetimepicker-css', $css_url . 'bootstrap-datetimepicker.css' );
	$custom_css = ' .no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con { position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; z-index: 9999;
	 background: url(' . SPINKX_CONTENT_PLUGIN_URL . 'assets/images/loader.gif) center no-repeat #fff; }
	#dvLoading { background:url(' . SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/images/loader.gif) 50% 50% no-repeat rgba(255,255,255,0.15); height: 100px;
    width: 96px; position: fixed; z-index: 1100; left: 51%; top: 25%; margin: -25px 0 0 -25px; display: none; }
	.form-group{ text-align: left; }
	.form-group input[type="text"],
	textarea{ 	width: 100%;}
	}';
	wp_add_inline_style( 'jquery-ui', $custom_css );
	wp_enqueue_media();
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/js/' );
	wp_enqueue_script( 'jquery-campaign', $js_url . 'campaign.js' );
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
	wp_enqueue_script( 'jquery-multiselect-js', $js_url . 'jquery.multiselect.js' );
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
	$custom_css = ' .no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con { position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; z-index: 9999;
	 background: url(' . SPINKX_CONTENT_PLUGIN_URL . 'assets/images/loader.gif) center no-repeat #fff; }
	#dvLoading { background:url(' . SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/images/loader.gif) 50% 50% no-repeat rgba(255,255,255,0.15); height: 100px;
    width: 96px; position: fixed; z-index: 1100; left: 51%; top: 25%; margin: -25px 0 0 -25px; display: none; }
	#wpfooter { display: none; } 
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
	$settings = get_option( $spnxAdminManage->spinkx_cont_get_license() );
	$settings = maybe_unserialize( $settings );
	$site_id = $settings['site_id'];
	?><div><div class="spnx-menu-logo"><span><a href="https://www.spinkx.com"><img src="<?php echo esc_url( SPINKX_CONTENT_PLUGIN_URL ); ?>assets/images/spinkx-logo.png" /></a></span></div>
	<ul class="nav nav-tabs">
		<?php if( ! ($settings['due_date'] != '0000-00-00 00:00:00' ) ) { ?>
		<li <?php echo ('spinkx-site-register.php' === $page)?'class="active"':''?>><a href="?page=spinkx-site-register.php">Registration</a></li>
		<?php } ?>
		<li <?php echo ('spinkx_widget_design' === $page)?'class="active"':''?>><a href="?page=spinkx_widget_design">Widget Settings</a></li>
		<li <?php echo ('spinkx_content_play_list' === $page)?'class="active"':''?>><a href="?page=spinkx_content_play_list">Free Boost Post</a></li>
		<li <?php echo ('spinkx_campaigns' === $page)?'class="active"':''?>><a href="?page=spinkx_campaigns">Paid Campaigns</a></li>
		<li <?php echo ('spinkx_dashboard' === $page)?'class="active"':''?>><a href="?page=spinkx_dashboard">Dashboard</a></li>
	</ul>
	<?php if ('spinkx_content_play_list' === $page) { ?>
	<div class="spnx-sync" title="Post ReSync"><img  id="posts_<?php echo $site_id ?>" class="posts_sync" src="<?php echo esc_url( SPINKX_CONTENT_PLUGIN_URL ); ?>assets/images/sync-icon.png"  /></div>
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
			$spnxAdminManage->spinkx_cont_admin_notices('Important Features of Boost Post<br/><span class="message">“Boost Post” is a Traffic Builder & SEO Backlink Builder for your website. It helps your content to reach out to audience outside your network by displaying your posts on other websites who use Spinkx as well.<br/>- It is run using a Traffic Exchange points mechanism. You earn points when other sites boost post are displayed on your site widget and you can use those points to keep on boosting your posts and get more traffic to your site Free for life.<br/>- You already have 100 points to begin with which will give your posts a 1000 reach and if you buy this plugin for $60, you get 1000 points with 10,000 reach. Enjoy boosting and see your SEO rise with backlinks and keep getting more traffic back!.<br/>- You can only promote Posts with featured images in it, and not pages or home page (for this you need to go to Campaigns and run a Paid Campaign)<br/>- “Create Variations” is a very very important tool to Multiply your Reach & backlinks. It helps you create more variations for your post with different Headlines, Descriptions & Images. Allowing you  a higher chance of getting clicks back. It will tell you what users like to read more, when you look at the CTR performance.<br/>- The Variation Posts also can be shared on Social Media,  creating more opportunities of engagement for the same post and we can actually now count how many people clicked and landed on to your website. And what worked better!</span>', 'notice-info notice-spnx-cp');
			$noitce_flag = true;
		} else {
			echo '<a href="javascript:;void(0)" class="spnx-faq" onclick="showNoticeCP();" style="margin-top: 10px; margin-left: 355px;"><i>Boost Post FAQ\'s</i></a>';
			$info_flag = true;
		}
	 } else if('spinkx_campaigns' === $page ) {
	    $campaigns_noitce_info = get_option('notice-spnx-campaigns', 1);
		if(  $campaigns_noitce_info ) {
			$spnxAdminManage->spinkx_cont_admin_notices('Important Features of Campaign<br/><span class="message">- Campaigns have more Features than Boost Post. The more important ones are “Geo Targeting” & “Call to Action”.<br/>- You can promote any URL (may be of your Client, if you are a digital Marketeer) and give them guaranteed Reach across Spinkx Network. (If you want to promote your posts and your Site, its better to use Boost Post for Free Traffic, Reach & Backlinks)<br/>- You can measure the effectiveness of the campaign by looking at the eCPC data (It means, the monetary value of your Clicks)<br/>- It is important for you to add multiple creatives to your campaign to drive lowest eCPC and get the Reach Faster. The more creatives you add the faster your campaign works.<br/>- When other people run Campaigns and they auto-display on your site sidebar, you get to earn 80% of the campaign money for the number of reach given by your website.<br/>- You can go to your Spinkx-dashboard to see how much money you have earned or spent, and you may withdraw the money to your Paypal account.</span>', 'notice-info notice-spnx-campaigns');
			$noitce_flag = true;
		} else {
			echo '<a href="javascript:;void(0)" class="spnx-faq" onclick="showNoticeCampaign();" style="margin-top: 10px; margin-left: 509px;"><i>Campaign FAQ\'s</i></a>';
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
