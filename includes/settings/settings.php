<?php
/*
 * This file used for generate spinkx menu & sub menu
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$settings = get_option( SPINKX_CONT_LICENSE );
$settings = maybe_unserialize( $settings );
function spinkx_register_settings( $settings ) {
	// check user admin or superadmin then show spinx menu
	if ( current_user_can( 'manage_network_options' ) || current_user_can( 'manage_options' ) ) {
		if ( $settings ) {
			add_action( 'admin_menu', 'register_spinkx_client_main_menu' );
		} else {
			add_action( 'admin_menu', 'site_spinkx_client_main_menu' );
		}
	}
}
add_action( 'init', 'spinkx_register_settings' );
function register_spinkx_client_main_menu() {
	add_menu_page(
		'spinkx Options',
		'Spinkx',
		'manage_options',
		'spinkx-site-register.php',
		'spinkx_register_site',
		plugin_dir_url( 'spinkx-content-marketing' ) . 'spinkx-content-marketing/assets/images/spinkx-ico.svg' ,
	'2.56' );

	add_submenu_page(
		'spinkx-site-register.php',
		'Sites - Register | Spinkx',
		'My Site',
		'manage_options',
		'spinkx-site-register.php',
		'spinkx_register_site'
	);

	add_submenu_page(
		'spinkx-site-register.php',
		'Widget - Design | Spinkx',
		'Widget Design',
		'manage_options',
		'spinkx_widget_design',
		'spinkx_client_main_menu_fn'
	);
	add_submenu_page(
		'spinkx-site-register.php',
		'Content - Play - List | Spinkx',
		'Content Play List',
		'manage_options',
		'spinkx_content_play_list',
		'spinkx_client_main_menu_fn'
	);
	add_submenu_page(
		'spinkx-site-register.php',
		'Dashboard | Spinkx',
		'Dashboard',
		'manage_options',
		'spinkx_dashboard',
		'spinkx_client_main_menu_fn'
	);
	add_submenu_page(
		'spinkx-site-register.php',
		'Campaigns | Spinkx',
		'Campaigns',
		'manage_options',
		'spinkx_campaigns',
		'spinkx_client_main_menu_fn'
	);
	add_submenu_page(
		'spinkx-site-register.php',
		'Account-Setup | Spinkx',
		'Account Setup',
		'manage_options',
		'spinkx_options',
		'spinkx_client_main_menu_fn'
	);

	/*
	add_submenu_page(
		'spinkx-site-register.php',
		'Facebook',
		'FB Settings',
		'manage_options',
		'spinkx-fb-register.php',
		'spinkx_register_fb'
	);*/

}
function site_spinkx_client_main_menu() {
	add_menu_page(
		'spinkx Options',
		'Spinkx',
		'manage_options',
		'spinkx-site-register.php',
		'spinkx_register_site',
		plugin_dir_url( 'spinkx-content-marketing' ) . 'spinkx-content-marketing/assets/images/spinkx-ico.svg' ,
	'2.56' );

	add_submenu_page(
		'spinkx-site-register.php',
		'Sites - Register | Spinkx',
		'My Site',
		'manage_options',
		'spinkx-site-register.php',
		'spinkx_register_site'
	);
	add_submenu_page(
		'spinkx-site-register.php',
		'Account-Setup | Spinkx',
		'Account Setup',
		'manage_options',
		'spinkx_options',
		'spinkx_client_main_menu_fn'
	);

	add_submenu_page(
		'spinkx-site-register.php',
		'Widget - Design | Spinkx',
		'Widget Design',
		'manage_options',
		'spinkx_widget_design',
		'spinkx_client_main_menu_fn'
	);
	add_submenu_page(
		'spinkx-site-register.php',
		'Content - Play - List | Spinkx',
		'Content Play List',
		'manage_options',
		'spinkx_content_play_list',
		'spinkx_client_main_menu_fn'
	);
	add_submenu_page(
		'spinkx-site-register.php',
		'Dashboard | Spinkx',
		'Dashboard',
		'manage_options',
		'spinkx_dashboard',
		'spinkx_client_main_menu_fn'
	);
	add_submenu_page(
		'spinkx-site-register.php',
		'Campaigns | Spinkx',
		'Campaigns',
		'manage_options',
		'spinkx_campaigns',
		'spinkx_client_main_menu_fn'
	);

	/*
	add_submenu_page(
		'spinkx-site-register.php',
		'Facebook - Register | Spinkx',
		'FB Settings',
		'manage_options',
		'spinkx-fb-register.php',
		'spinkx_register_fb'
	);*/
}

function spinkx_client_main_menu_fn() {
	// This function get current request and redirect to spinx
	$settings = get_option( SPINKX_CONT_LICENSE );
	$settings = maybe_unserialize( $settings );
	$page = helperClass::getFilterVar( 'page' );
	switch ( $page ) {
		case 'spinkx_widget_design':
			$index	= ! empty( $settings )? 0 : 1;
			break;
		case 'spinkx_content_play_list':
			$index	= ! empty( $settings )? 1 : 2;
			break;
		case 'spinkx_dashboard':
			$index	= ! empty( $settings )? 2 : 3;
			break;
		case 'spinkx_campaigns':
			$index	= ! empty( $settings )? 3 : 4;

			break;
		case 'spinkx_options':
			$index	= ! empty( $settings )? 4 : 0;
			break;
	}
	?>
	<script>
		jQuery(document).ready(function() {
			var currentIndex	=	'<?php echo $index;?>';
			var hash = window.location.hash;

			if(hash)
			{
				switch (hash) {
					case '#widget_design':
						currentIndex	=	'<?php echo $widget = ! empty( $settings )? 0 : 1 ;?>';
						var currentPage	=	'Widget Design';

						break;
					case '#content_play_list':
						currentIndex	=	'<?php echo $widget = ! empty( $settings )? 1 : 2;?>';
						var currentPage	=	'Content Play List';
						break;
					case '#dashboard':
						currentIndex	=	'<?php echo $widget = ! empty( $settings )? 2 : 3 ;?>';
						var currentPage	=	'Dashboard';
						break;
					case '#campaigns':
						currentIndex	=	'<?php echo $widget = ! empty( $settings )? 3 : 4 ;?>';
						var currentPage	=	'Campaigns';
						break;
					case '#account_setup':
						currentIndex	=	'<?php echo $widget = ! empty( $settings )? 4 : 0 ;?>';
						var currentPage	=	'Account Setup';
						break;
				}

				jQuery('#toplevel_page_spinkx-site-register ul li').removeClass( "current" );
			   jQuery( "#toplevel_page_spinkx-site-register ul li" ).each(function() {
				  if(jQuery(this).text()==currentPage)
				   jQuery(this).addClass( "current" );
				});
			}

			localStorage.setItem("currentIdx", currentIndex);
		});
	</script>
	<?php
	/****************** Functions to be involved in Settings Page ***************/
	$flag = true;
	$r_flag = helperClass::getFilterVar( 'r', INPUT_REQUEST );
	if ( $r_flag ) {
		switch ( $r_flag ) {
			case 'edit_campaign' :
				require SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/edit-campaign.php';
				break;
		}
		$flag = false;
	}
	if ( $flag ) {
		$page = helperClass::getFilterVar( 'page' );
		switch ( $page ) {
			case 'spinkx_widget_design':
				require SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/widget-design.php';
				break;
			case 'spinkx_content_play_list':
				require SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/content-playlist.php';
				break;
			case 'spinkx_dashboard':
				require SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/dashboard.php';
				break;
			case 'spinkx_campaigns':
				require SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/manage-ads.php';
				break;
			case 'spinkx_options':
				require SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/account-setup.php';
				break;
		}
	}
}
function spinkx_register_site() {
	require SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/site-registration.php';
}
function spinkx_register_fb() {
	require SPINKX_CONTENT_PLUGIN_DIR . 'includes/settings/facebook_register.php';
}
?>
