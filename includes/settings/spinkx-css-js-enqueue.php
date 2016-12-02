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
	echo '<style> .toplevel_page_spinkx-site-register .wp-menu-image img {
		padding: 6px 0 0 !important;
		opacity: .9 !important;
		max-width: 65%;
		filter: alpha(opacity=60);
	} </style>';
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
	$settings = get_option( SPINKX_CONT_LICENSE );
	$settings = maybe_unserialize( $settings );
	$custom_js = '<script>var SPINKX_CONTENT_PLUGIN_DIR = "' . SPINKX_CONTENT_PLUGIN_DIR . '";
	var spinkx_server_baseurl = "' . SPINKX_SERVER_BASEURL . '";
	var SPINKX_CONTENT_PLUGIN_URL = "' . SPINKX_CONTENT_PLUGIN_URL . '";
	var g_site_id =  "' . $settings['site_id'] . '";
	</script>';
	echo $custom_js;
	$page = helperClass::getFilterVar( 'page' );
	if ( $page ) {
		spinkx_cont_common_css_js( $page );
	}
	if ( $page && $page === 'spinkx_content_play_list' ) {
		spinkx_cont_cp_css_js();
	} elseif ( $page && $page === 'spinkx_widget_design' ) {
		spinkx_cont_widget_css_js();
	} elseif ( $page && $page === 'spinkx-site-register.php' ) {
		spinkx_cont_registration_css_js();
	} elseif ( $page && $page === 'spinkx_dashboard' ) {
		spinkx_cont_dashboard_css_js();
	} elseif ( $page && $page === 'spinkx_campaigns' ) {
		spinkx_cont_campaign_set_css_js();
		$r_flag = helperClass::getFilterVar( 'r' );
		if ( $r_flag &&  $r_flag === 'edit_campaign' ) {
			spinkx_cont_campaign_form_set_css_js();
		}
	} elseif ( $page && $page === 'spinkx_options' ) {
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
		wp_enqueue_style( 'select2', $css_url . 'select2.css' );
		wp_enqueue_style( 'date-range-picker', esc_url( '//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css' ) );
		$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/bpopup/' );
		wp_enqueue_style( 'bpopup', $css_url . 'bpopup.css' );
	}
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/dataTables/' );
	wp_enqueue_style( 'datatables', $css_url . 'jquery.dataTables.min.css' );
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/styles/' );
	wp_enqueue_style( 'master', $css_url . 'master.css' );
	/**
	 * JS Loading
	 */
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
	wp_enqueue_script( 'jquery-ui-js', $js_url . 'jquery-ui.js' );
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/js/' );
	wp_enqueue_script( 'bootstrap-js', $js_url . 'bootstrap.min.js' );

	if ( $page !== 'spinkx_options' ) {
		wp_enqueue_script( 'select2-js', $js_url . 'select2.min.js' );
		$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
		wp_enqueue_script( 'growl-js', $js_url . 'jquery.growl.js' );
		wp_enqueue_script( 'moment-js', '//cdn.jsdelivr.net/momentjs/latest/moment.min.js' );
		$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/dataTables/' );
		wp_enqueue_script( 'jquery-datatables', $js_url . 'jquery.dataTables.min.js' );
		$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/bpopup/' );
		wp_enqueue_script( 'jquery-bpopup', $js_url . 'jquery.bpopup.min.js' );
	}
	//$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
	// wp_enqueue_script( 'jquery-feedback', $js_url . 'feedback-custom.js' );
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
	$custom_css = ' .modal-body { height: 320px; overflow: auto; } 	
	.modal-backdrop { background-color: #fff; }
	.modal-backdrop.fade.in	{ opacity: .8; }
	.select2-container-multi .select2-choices { width:initial; }';
	wp_add_inline_style( 'master', $custom_css );
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
	$custom_css = ' #wpwrap { background-color: #f1f1f1;}
	.no-js #loader, .notice { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con { position: fixed; left: 0; top: 0; width: 100%; height: 100%; z-index: 9999;	
	 background: url( ' . esc_url( SPINKX_CONTENT_PLUGIN_URL ) . '/assets/images/my.gif) center no-repeat rgba(0, 0, 0, 0.2); }
	 table.dataTable { border-collapse: collapse; border-spacing: 0px; }';
	wp_add_inline_style( 'master', $custom_css );
	wp_enqueue_script( 'form-validator-js', esc_url( '//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js' ) );
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
	wp_enqueue_script( 'jquery-countdown-js', $js_url . 'jquery.countdown.min.js' );
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
function spinkx_cont_cp_css_js() {
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/widgets/assets/' );
	// wp_enqueue_style( 'bootstrap', $css_url . 'bootstrap.min.css' , array('custom-style'));
	wp_enqueue_style( 'growl', $css_url . 'add-widget.css' , array( 'custom-style' ) );
	$custom_css = ' ul li:before {content:none;} 
	ul li, ol li { padding: 0px 0 0;}
	#wpwrap { background-color: #f1f1f1;}
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con { position: fixed; left: 0; top: 0; width: 100%; height: 100%; z-index: 9999; 
	background: url( ' . esc_url( SPINKX_CONTENT_PLUGIN_URL ) . '/assets/images/my.gif) center no-repeat rgba(0, 0, 0, 0.2);; }
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
	.onoff_header input { font-size: 10px; background: #1a1a1a; border: 0; border-radius: 2px; color: #fff; font-family: Montserrat, "Helvetica Neue", sans-serif;
	font-weight: 700; letter-spacing: 0.046875em; line-height: 1; padding: 0.84375em 0.875em 0.78125em; text-transform: uppercase; }
	.hook_add_class { background-color:#e6e7e7; }
	#clock span { background-color: #469fa1; width:20px; height:20px; margin:6px; padding:5px 7px; color:#fff; }
	#clock { font-weight:bold; }
	input[type=button] { padding: 5px !important; border: 1px solid #469fa1 !important; }
	.posts_sync,th input[type=button] {	background: grey !important; }
	.select2-container-multi .select2-choices { margin:0 !important; width:100% !important; }
	select2-container input[type=text] { border: none !important; }';
	wp_add_inline_style( 'master', $custom_css );

	wp_enqueue_script( 'form-validator-js', esc_url( '//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js' ) );
	wp_enqueue_script( 'jquery-moments', '//cdn.jsdelivr.net/momentjs/latest/moment.min.js' );
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
	wp_enqueue_script( 'jquery-custom-js', $js_url . 'widget-design.js' );
	wp_enqueue_script( 'jquery-lazyloading-js', $js_url . 'lazysizes.min.js' );
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
	wp_enqueue_script( 'jquery-variation-custom-js', $js_url . 'content-playlist.js' );
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
	$custom_css = ' #wpwrap { background-color: #f1f1f1; }
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con { position: fixed; left: 0; top: 0;	width: 100%; height: 100%; z-index: 9999; 
	 background: url( ' . SPINKX_CONTENT_PLUGIN_URL . '/assets/images/my.gif) center no-repeat rgba(0, 0, 0, 0.2); }
	#wpfooter { display:none; } ';
	wp_add_inline_style( 'master', $custom_css );

	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/bpopup/' );
	wp_enqueue_script( 'jquery-bpopup', $js_url . 'jquery.bpopup.min.js' );
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/js/' );
	wp_enqueue_script( 'jquery-growl', $js_url . 'jquery.growl.js' );
	wp_enqueue_script( 'jquery-moments', '//cdn.jsdelivr.net/momentjs/latest/moment.min.js' );
	wp_enqueue_script( 'jquery-custom-js', $js_url . 'dashboard.js' );
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
function spinkx_cont_acc_set_css_js() {
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/css/' );
	$custom_css = ' #wpwrap { background-color: #f1f1f1; }
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.se-pre-con { position: fixed; left: 0; top: 0; width: 100%; height: 100%; z-index: 9999;
     background: url( ' . esc_url( SPINKX_CONTENT_PLUGIN_URL ) . '/assets/images/my.gif) center no-repeat rgba(0, 0, 0, 0.2);; }';
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
	$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/css/' );
	wp_enqueue_style( 'bootstrap-datetimepicker-css', $css_url . 'bootstrap-datetimepicker.css' );
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
	.select2-container{ margin-left: 15px; width: 95%; }
	.fade{ opacity: 1; } 
	modal{ display: inline-block;	z-index: 999999;}';
	wp_add_inline_style( 'jquery-ui', $custom_css );

	// wp_enqueue_script( 'jquery-ui-js', $js_url . 'jquery-ui.js' );
	wp_enqueue_script( 'form-validator-js', esc_url( '//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js' ) );
	wp_enqueue_script( 'jquery-countdown-js', $js_url . 'jquery.countdown.min.js' );
	// jQuery
	wp_enqueue_script('jquery');
// This will enqueue the Media Uploader script
	wp_enqueue_media();
	$js_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/js/' );
	$custom_js = ' var client_url = "' . esc_url( SPINKX_CONTENT_PLUGIN_URL ) . '";';
	$custom_js .= ' jQuery(document).ready(function() {
	jQuery(".se-pre-con").fadeOut("slow");;
	jQuery(".nav-tabs a").click(function(){
	   var id =	jQuery(this).attr("href").substr(1);
	   window.location.hash = id;
	   window.scrollTo(0, 0);
	   switch (id) {
				case "widget_design":
					var currentPage	=	"Widget Design";
					break;
				case "content_play_list":
					var currentPage	=	"Content Play List";
					break;
				case "dashboard":
					var currentPage	=	"Dashboard";
					break;
				case "campaigns":
					var currentPage	=	"Campaigns";
					break;
				case "account_setup":
					var currentPage	=	"Account Setup";
					break;
				}
	   jQuery("#toplevel_page_spinkx-site-register ul li").removeClass( "current" );
	   jQuery( "#toplevel_page_spinkx-site-register ul li" ).each(function() {
		  if(jQuery(this).text()==currentPage)
		   jQuery(this).addClass( "current" );
		});
	});
	jQuery("#campaign_subtabs").tabs();
	$=jQuery;
});';
	wp_enqueue_script( 'jquery-campaign', $js_url . 'campaign.js' );
	wp_add_inline_script( 'jquery-campaign', $custom_js );
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
 * This function for add enqueue css & js
 * spinkx_registration_css_js()
 *
 * @return void
 * @internal param void
 */
function spinkx_cont_widget_form_set_css_js() {

}
