<?php
/**
 * This is spinkx payment method shortcode execute file.
 *
 * In this file we define some function that use save pay and execute shortcode & payment method configuration form show.
 *
 * @package wordpress.
 * @subpackage spinkx.
 */

/**
 *
 * This function fire shortcode execute
 * show_payment_method_list()
 *
 * @return string
 * @param array() $atts payment method params.
 * @param string  $content if any content available.
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$showFlag = true;
function spinkx_cont_payment_method_list( $atts, $content = null ) {
	global $wpdb;
	global $showFlag;
	shortcode_atts(
		array(
			'site_url' => get_site_url(),
			'flag' => 0,
		), $atts
	);
	if( 0 === intval( $atts['flag'] ) ) {
		return 0;
	}

	$shortcode_output = '';
	$row = new stdClass();
	$display_currency = '';
	$display_amount = '';
	$current_rate = 1;
	$spnxAdminManage  = new spnxAdminManage();
	$currencies = spnxHelper::doCurl(SPINKX_CONTENT_BAPI_URL . '/wp-json/spnx/v1/system/currencies');
	$site_url = '';
	$spnxAdminManage = new spnxAdminManage();
	$settings = get_option( SPINKX_CONTENT_LICENSE );
	$settings = maybe_unserialize( $settings );
	$currencies = json_decode($currencies, true);
	if ( 1 === intval( $atts['flag'] ) || 2 === intval( $atts['flag'] ) || 3 === intval( $atts['flag'] ) || 4 === intval( $atts['flag'] ) ) {
		$row->status = $atts['status'];
		$row->amount = $atts['amount'];
		$row->merchant_name = $atts['merchant_name'];
		$row->api_key = $atts['api_key'];
		$row->description = $atts['description'];
		$row->site_logo_url = $atts['site_logo_url'];

		if( isset( $atts['usd_amount'] ) && $atts['usd_amount'] >= 0) {
			$display_currency = '"display_currency": "USD",';
			$display_amount = '"display_amount":"' . $atts['usd_amount'] . '",';
		} else {
			$display_amount = '"display_amount": sx_cont_amount,';
		}
		if( isset( $atts['currency-format'] ) ) {

			if( $atts['currency-format'] === 'INR' ) {
				$current_rate = 1;
			} elseif( $atts['currency-format'] === 'USD' ) {
				$current_rate = $currencies['dollar_rate'];
				$display_currency = '"display_currency": "'.$atts['currency-format'].'",';
			}  elseif( $atts['currency-format'] === 'EUR' ) {
				$current_rate = $currencies['euro_rate'];
				$display_currency = '"display_currency": "'.$atts['currency-format'].'",';
			} elseif( $atts['currency-format'] === 'GBP' ) {
                $current_rate = $currencies['gbp_rate'];
                $display_currency = '"display_currency": "'.$atts['currency-format'].'",';
            }
		}
	} else {
		check_admin_referer();
		$prefix = $wpdb->get_blog_prefix( get_current_blog_id() ) . 'payment_methods';
		$row = wp_cache_get( $prefix . 'payment_methods' );
		if ( false === $row ) {
			$payment_method_name = 'Razor Pay';
			$row = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM %s WHERE `payment_method_name` = %s AND site_url = %s', $prefix, $payment_method_name , $atts['site_url'] ) );
			wp_cache_set( $prefix . 'payment_methods', $row );
		}
	}
	if ( $row->status ) {
		$flag = true;
		$amount = spnxHelper::getFilterVar('amount', INPUT_POST, FILTER_SANITIZE_NUMBER_FLOAT);
		if ( $amount ) {
			$row->amount = $amount * 100; // rupees to paisa conversion.
		} elseif ( $row->amount > 0 ) {
			$row->amount *= 100;
		} else {
			echo 'Error: amount is not set';
			$flag = false;
		}
		if ( ! isset( $row->merchant_name ) ) {
			echo 'Error: Merchant Name is requried';
			$flag = false;
		}
		if ( ! isset( $row->api_key ) ) {
			echo 'Error: API Key is requried';
			$flag = false;
		}
		$description = spnxHelper::getFilterVar('description', INPUT_POST, FILTER_SANITIZE_STRING);
		if ( $description ) {
			$row->description = $description;
		} elseif ( ! isset( $row->description ) ) {
			echo 'Error: Description is requried';
			$flag = false;
		}
		if ( ! $flag ) {
			return;
		}
		$row->amount = intval( $row->amount );
		if ( 1 === $atts['flag'] || 2 === intval( $atts['flag'] ) || 3 === intval( $atts['flag'] ) || 4 === intval( $atts['flag'] ) ) {
			$url = $atts['other-url'];
		} else {
			$url = SPINKX_CONTENT_BAPI_URL . '/wp-json/spnx/v1/payment-method/charge';
		}
		if ( 1 === $atts['flag'] ) {
			$shortcode_output = '<button id="payment-method-button">Buy Now</button>';
		} elseif ( 2 === intval( $atts['flag'] ) ) {
			$shortcode_output = '<button id="payment-method-button" class="btn-primary pbuy-now">Buy Points</button>';
		} elseif ( 3 === intval( $atts['flag'] ) ) {
			$shortcode_output = '<span class="sub-heading"><button id="payment-method-button">Add Money to wallet</button></span>';
		} elseif ( 4 === intval( $atts['flag'] ) ) {
			$shortcode_output = '<span class="sub-heading"><button id="add-money-campaign-wallet" class="btn-primary pbuy-now cmpgn-ad-mny-pts">Add Money</button></span>';

		} else {
			$shortcode_output = '<button id="payment-method-button" class="btn-primary pbuy-now" style="    color: #fff;
    background-color: #0170B9;">Buy Now</button>';
		}
		$after_transaction = '';

		if(2 === intval( $atts['flag'] )) {
			$after_transaction = 'window.location.reload()';
		} elseif(3 === intval( $atts['flag'] )) {
			$after_transaction = 'var final_amount = ( data.final_amount + document.getElementById("wallet_money_update").innerText * 1 ); var spnx_am  = (Number(document.getElementById("camp-money-account").innerText) + Number(document.getElementById("budget_amount").value) ).toFixed(2); console.log(spnx_am); document.getElementById("camp-money-account").innerText = spnx_am; document.getElementById("wallet_money_update").innerText=final_amount;document.getElementById("campain_balance_add").innerText=0;document.getElementById("wallet_money_update").innerText= (Number(document.getElementById("wallet_money_update").innerText)-Number(document.getElementById("budget_amount").value)).toFixed(2);jQuery(".parent-balance-span").hide();';
			//$after_transaction='document.getElementById(\'camp-money-account\').innerHTML = parseInt(document.getElementById(\'camp-money-account\').innerHTML) + options.amount;document.getElementById(\'budget_amount\').disabled = true; document.getElementById(\'payment-method-button\').disabled = true;';
			//$after_transaction='';
		} elseif(4 === intval( $atts['flag'] )) {
			$after_transaction='document.getElementById(\'wallet_amount\').disabled = true;
			document.getElementById(\'add-money-campaign-wallet\').disabled = true;';
			$after_transaction = '';
		} else {
			$after_transaction = 'window.location.reload()';
		}
		$temp_variable = null;
		if(4 === intval( $atts['flag'] ) ) {
			//$temp_variable = 'var current_rate = '.$current_rate.';';
			$temp_variable .= <<<EOD
			     	var current_rate = {$current_rate};
			    	sx_cont_amount = document.getElementById('wallet_amount').value;
			     	displayAmount = Math.round(sx_cont_amount * 100 * current_rate);
					options.amount = displayAmount;
					options.display_amount = sx_cont_amount;					
					var rzp1 = new Razorpay( options );
					
EOD;
		} elseif(3 === intval( $atts['flag'] ) ) {
					//$temp_variable = 'var current_rate = '.$current_rate.';';
			     	$temp_variable .= <<<EOD
			     	var current_rate = {$current_rate};
			     	sx_cont_amount = document.getElementById('campain_balance_add').innerText;
			     	displayAmount = Math.round(sx_cont_amount * 100 * current_rate);
					options.amount = displayAmount;
					options.display_amount = sx_cont_amount;
					var rzp1 = new Razorpay( options );
					//document.getElementById('budget_amount').disabled = true; 
					//document.getElementById('payment-method-button').disabled = true;
					
EOD;
		} elseif(1 === intval( $atts['flag'] )) {
			$temp_variable .= <<<EOD

					options.amount = sx_cont_amount;
					var rzp1 = new Razorpay( options );
EOD;
		} if(2 === intval( $atts['flag'] )) {
			//$temp_variable = 'var current_rate = '.$current_rate.';';
			$temp_variable .= <<<EOD
			     	var current_rate = {$current_rate};
					sx_cont_amount = document.getElementById('point_amount').value;
					displayAmount = Math.round(sx_cont_amount * 100 * current_rate);
					options.amount = displayAmount;
					options.display_amount = sx_cont_amount;
					var rzp1 = new Razorpay( options );
					
EOD;
		}
		wp_enqueue_script( 'razorpay-js', 'https://checkout.razorpay.com/v1/checkout.js' );
		$disAmount = $row->amount * $current_rate;
		$js_output = '';
		if( $showFlag ) {
			$js_output = "var loadingWindow = false;  var sx_cont_amount = $row->amount; var displayAmount = $disAmount; function paymentSuccessHandler(transaction) {		
	var http = new XMLHttpRequest();
var url = '" . $url . "';
var params = 'razorpay_payment_id='+transaction.razorpay_payment_id+'&amount=' + displayAmount;
http.open('POST', url, true);
//Send the proper header information along with the request
http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

http.onreadystatechange = function() {//Call a function when the state changes.
  if (http.readyState === 4 && http.status === 200) {
	data = JSON.parse(http.responseText);
   if (data.status == 0){
	 alert('Error:' + data.msg);
   } else {
	 alert(data.msg);
	  jQuery(\"#boostmodalbuyPoint\").hide();
   }
   if( loadingWindow  ) { window.location.reload() }
	  " . $after_transaction . "
   
  }
  
}
http.send(params);
}";
			$js_output .= 'var options = {
	"key": "' . $row->api_key . '",
	"amount": sx_cont_amount, // 2000 paise = INR 20
	"name": "' . $row->merchant_name . '",
	"description": "' . $row->description . '",
	' . $display_currency . '
	' . $display_amount . ' 
	"image": "' . SPINKX_CONTENT_DIST_URL . 'images/spinkx-logo.png",
	"handler": paymentSuccessHandler,
	"notes": {
		"shopping_order_id": ' .  $settings['site_id'] . ',
		"cuser_email": "'.$spnxAdminManage->getCurrentUserEmail().'"
	},
	"theme": {
		"color": "#F37254"
	}
};';

				$js_output .= 'document.getElementById(\'payment-method-button\').onclick = function(e){
				
' . $temp_variable . '
	rzp1.open();
	e.preventDefault();  
}';
			$showFlag = false;
			}
			if(4 === intval( $atts['flag'] )) {
	$js_output .= 'document.getElementById(\'add-money-campaign-wallet\').onclick = function(e){
' . $temp_variable . '
loadingWindow = true;
rzp1.open();
e.preventDefault();  
}';
		}
			wp_add_inline_script('razorpay-js', $js_output);

	}
	return $shortcode_output;
}

