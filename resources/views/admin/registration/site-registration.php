<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly	
$site_id = false;
global $wpdb;
$spnxAdminManage = new spnxAdminManage();
$settings = get_option(SPINKX_CONTENT_LICENSE);
$settings = maybe_unserialize($settings);
$logo_url = SPINKX_CONTENT_DIST_URL . 'images/your_logo.png';
if (  isset($settings) && $settings ) {
	$site_id = isset($settings['site_id'])?$settings['site_id']:0;
	$registeredemail = spnxHelper::getFilterVar( 'registeredemail' );
	if ( $registeredemail ) {
		$settings['reg_user_email'] = $registeredemail;
		$s = maybe_serialize( $settings );
		update_option( SPINKX_CONTENT_LICENSE,$s );
	}
}

if ( isset($_POST['agree']) &&  $_POST['agree']) {
	$post = $_POST;
	if ($post['image_attachment_id'] > 0) {
		$image_attributes = wp_get_attachment_image_src($post['image_attachment_id'], array(50, 50));
		if(isset($image_attributes[0])) {
			$post['logo_url'] = $image_attributes[0];
		}

	}
	$post['cuser_email'] = $spnxAdminManage->getCurrentUserEmail();
	// site info  is being updated
	$post['spinkx_version'] = SPINKX_CONTENT_VERSION;
	if ( $site_id ) {
		$url = SPINKX_CONTENT_BAPI_URL . '/wp-json/spnx/v1/site/update';
		$post['sflag'] = 'site_update';
	} else {
		$url = SPINKX_CONTENT_BAPI_URL .'/wp-json/spnx/v1/site/create';
		$post['sflag'] = 'site_create';
	}
	$post['site_email'] = get_option( 'admin_email' );
	$post['site_url'] = get_site_url();
	$response = spnxHelper::doCurl( $url,$post );

	// Site name editing couldn't be completed as there are some associated issues for the license validation
	if ( $settings ) {
		$site_name = spnxHelper::getFilterVar( 'site_name', INPUT_POST );
		if( $site_name ) {
			$settings['site_name'] = $site_name;
			update_option(SPINKX_CONTENT_LICENSE, maybe_serialize($settings));
		}
	}

	if ( $response && !$site_id ) {
		$output = json_decode( $response,true );
        if(isset($output['spnx_widget_list'])) {
            update_option('spnx_widget_list', maybe_serialize($output['spnx_widget_list']));
            unset($output['spnx_widget_list']);
        }
        if ( ! isset( $output['message'] ) ) {
            $s = maybe_serialize( $output );
			update_option( SPINKX_CONTENT_LICENSE,$s );
            update_option('spnx_reg_update', true);
			// sync posts here.
			$settings = get_option( SPINKX_CONTENT_LICENSE );
			$settings = maybe_unserialize( $settings );
			$response = $spnxAdminManage->spinkx_cont_post_sync($settings);
			$js_output = "<script>jQuery(document).ready(function () {
					$.growl.notice({
						message: 'Post Sync SuccessFully',
						location: 'tr',
						size: 'large'
					});
					window.location.replace('?page=spinkx_widget_design');
				});</script>";
			echo $js_output;
		} else {
			$settings = get_option( SPINKX_CONTENT_LICENSE );
			$settings = maybe_unserialize( $settings );
			$settings['reg_user'] = $output['reg_user'] ;
			$settings['due_date'] = $output['due_date'] ;
			$s = maybe_serialize( $settings );
			update_option( SPINKX_CONTENT_LICENSE, $s );
            update_option('spnx_reg_update', true);
			$js_output = "<script>jQuery(document).ready(function () {
					$.growl.notice({
						message: '".$output['message']."',
						location: 'tr',
						size: 'large'
					});
				});</script>";
			echo $js_output;
		}
	} elseif ( $response ) {

			// when user forgets to agree to terms etc.
			$output = json_decode( $response,true );
        if(isset($output['spnx_widget_list'])) {
            update_option('spnx_widget_list', maybe_serialize($output['spnx_widget_list']));
            unset($output['spnx_widget_list']);
        }
		if (  $output['message']  === 'Updated Successfully' ) {
			$settings = get_option( SPINKX_CONTENT_LICENSE );
			$settings = maybe_unserialize( $settings );
			$settings['reg_user'] = $output['reg_user'];
			$settings['due_date'] = $output['due_date'] ;
			$s = maybe_serialize( $settings );
			update_option( SPINKX_CONTENT_LICENSE, $s );
            update_option('spnx_reg_update', true);
            echo '<script>window.location.replace("?page=spinkx_widget_design");</script>';
		} else {

			if ( isset( $output['message'] ) ) {

					echo "<script>jQuery(document).ready(function () {
						jQuery.growl.error({
							message: '".$output['message']."',
							location: 'tr',
							size: 'medium'
						});
					});</script>";

			}
		}
	}
}

	/******GET REQUEST FOR FORM ELEMENTS-CREATE******/
if ( ! $site_id ) {
	$api_form_elements_url = SPINKX_CONTENT_BAPI_URL . '/wp-json/spnx/v1/site/form-elements';
	$output = spnxHelper::doCurl( $api_form_elements_url, true );
	$dropdown = json_decode( $output );
	if(isset($dropdown->message)) {
		?>
<div class="spnx-reg-mn-cntainter">
	<div class="text-spninks">
		<div class="image-container-cls-reg-spnx"><img src="<?php echo esc_url( SPINKX_CONTENT_DIST_URL ); ?>spinkx-logo.png" /></div>
		<div class="reg-lbl-txt">REGISTRATION</div>
	</div>
	<div>
		<?php echo $dropdown->message;
		exit;
		?>
	</div>
</div>

<?php	}
	$buy_now = '';
	if( isset( $dropdown->selected_site ) ) {
		$buy_now = $dropdown->selected_site->buy_now;
	}
	$selected_url	= get_site_url();
	if ( class_exists( 'Domainmap_Utils' ) ) {
		$selected_url = \Domainmap_Utils::get_mapped_domain();
		// echo $selected_url;
	}
} /******GET REQUEST FOR FORM ELEMENTS-UPDATE******/
else {

	$api_form_elements_url = SPINKX_CONTENT_BAPI_URL . '/wp-json/spnx/v1/site/form-elements/' . $site_id;
	$output = spnxHelper::doCurl( $api_form_elements_url, false );
	$dropdown = json_decode( $output );
	$selected_url = '';
	if( isset( $dropdown->selected_site->site_url ) ) {
		$selected_url = $dropdown->selected_site->site_url;
	}
	$user_key = null;
	if( isset( $dropdown->selected_site->user_key ) ) {
		$user_key = $dropdown->selected_site->user_key;

	}
	$business_name='';
	if(isset($dropdown->selected_site->business_name))
	{
		$business_name=$dropdown->selected_site->business_name;
	}
	$business_address='';
	if(isset($dropdown->selected_site->address))
	{
      $business_address=$dropdown->selected_site->address;
	}
	$business_city='';
	if(isset($dropdown->selected_site->city))
	{
		$business_city=$dropdown->selected_site->city;
	}
	$business_pincode='';
	if(isset($dropdown->selected_site->pincode))
	{
		$business_pincode=$dropdown->selected_site->pincode;
	}
	$business_state='';
	if(isset($dropdown->selected_site->state))
	{
		$business_state=$dropdown->selected_site->state;
	}
	$business_phone='';
	if(isset($dropdown->selected_site->phone))
	{
		$business_phone=$dropdown->selected_site->phone;
	}
	$business_paypal_id='';
	if(isset($dropdown->selected_site->paypal_email_id))
	{
		$business_paypal_id=$dropdown->selected_site->paypal_email_id;
	}
	$country_id=0;

	if( isset($dropdown->selected_site->country_id) ) {
		$country_id = $dropdown->selected_site->country_id;
	}
	$category_arr=array();
	if(isset($dropdown->selected_site->categories_id)) {
		$category_arr=explode(',',$dropdown->selected_site->categories_id);

	}
	$buy_now=null;
	if( isset( $dropdown->selected_site->buy_now ) &&  $dropdown->selected_site->buy_now) {
		$buy_now .= $dropdown->selected_site->buy_now;
	}

	if(isset( $dropdown->selected_site->logo_url ) &&  $dropdown->selected_site->logo_url  ) {
	    $logo_url = $dropdown->selected_site->logo_url;
    }
	$settings['due_date'] =isset($dropdown->selected_site->due_date)?$dropdown->selected_site->due_date:null;
	if ( isset( $dropdown->selected_site->registeredemail ) ) {
		$registeredemail = $dropdown->selected_site->registeredemail;
		if ( isset( $registeredemail ) ) {
			$settings['reg_user_email'] = $registeredemail;
			$s = maybe_serialize( $settings );
			update_option( SPINKX_CONTENT_LICENSE, $s );
		}
	}
}
// gets mapped domain if it's in use to use actual domain
if ( class_exists( 'Domainmap_Utils' ) ) {
	$obj = new Domainmap_Utils();
	$temp = $obj->get_mapped_domain();
	if ( $temp ) {
		$selected_url = $temp;
	}
}

if ( ! $selected_url ) {
	$selected_url	= get_site_url();
}
$userkey = 	spnxHelper::getFilterVar( 'userkey' );
if ( $userkey ) {
	$user_key = $userkey;
}
$datetime = null;
$color = '#469fa1';

if ( isset($settings['due_date']) && $settings['due_date'] != '0000-00-00 00:00:00' ) {
	$datetime = strtotime( $settings['due_date'] );

	$diff = $spnxAdminManage->spinkx_cont_get_license_date( $settings['due_date'] );
	if ( intval( $diff->format( '%R%a days' ) ) < 0 ) {
		$color = '#f69fa1';
		do_action( 'network_admin_notices' );
	}
}
$plugin_type_id = isset($dropdown->selected_site->plugin_type_id)?$dropdown->selected_site->plugin_type_id:0;
?>
<div class="spnx_wdgt_wrapper"><div class="cssload-loader"></div></div>
<script type='text/javascript'>
	/* <![CDATA[ */
	var spnx_sec_cats = <?php echo wp_json_encode(isset($dropdown->categories)?$dropdown->categories:'')?>; /* ]]> */
</script>
<div class="spnx-reg-mn-cntainter">
	<div class="text-spninks">
	<div class="image-container-cls-reg-spnx"><a target="_blank" href="https://www.spinkx.com"><img src="<?php echo SPINKX_CONTENT_DIST_URL?>images/spinkx-logo.png" /></a></div>
	<div class="reg-lbl-txt">REGISTRATION</div>
    </div>
	<form method="post" enctype="multipart/form-data">
	<div class="spnx-sec-mn-cntainter">

		<div class="spnx-stckr-cmn-class spnx-box-reg-cmn-cls">

			<div class="cmn-cls-verticl-bus-spnx-reg-sitename">
                <div style="width:40px; height: 40px; margin-bottom: 10px; display: inline-block; margin-right: 24px;">
	                <img  alt="" id="image-preview"  style="width: 40px; height: 40px; object-fit:contain;" src="<?php echo $logo_url?>">
	                <input type="hidden" name="image_attachment_id" id="image_attachment_id">
                </div>
                <span class="reg_upload_file_type catog-des-cmn-cls-spnx-reg reg-upload-logo">
                	<i class="fas fa-file"></i>
                	Add Logo
                </span>
                <span class="error-cmn-clas-spnx">Logo Required</span>

                
				
            </div>
			<div class="vrticl-align-cmn-cls-spnx-reg">
				<span class="catog-des-cmn-cls-spnx-reg">Site url </span>
				<span class="horizntal-align-cmn-cls-spnx-reg align-spnx-css"> <?php echo $selected_url; ?></span>
				<input type="hidden" name="site_url" value="<?php echo $selected_url; ?>">
			</div>
			<div class="cmn-cls-verticl-bus-spnx-reg-sitename ">
				<span class="catog-des-cmn-cls-spnx-reg">Site name </span>
				<span class="horizntal-align-cmn-cls-spnx-reg">
				<?php if ( isset($settings['site_name']) && $settings['site_name'] ) { ?>
					<input type="text" class="awsome_input-spnx-reg-sitename" name="site_name" required value="<?php echo $settings['site_name']; ?>"/>
				<?php } else { ?>
					<input type="text"  class="awsome_input-spnx-reg-sitename" name="site_name" required value="<?php echo get_bloginfo( 'name' ); ?>"/>
				<?php } ?>
				</span>
			</div>
            
		</div>
<!--<?php echo $dropdown->selected_site->logo_url?> -->
		<div class="spnx-box-reg-cmn-cls">
			<div class="header-cmn-cls-spnx">Tell us about your goals. Choose one</div>
			<div class="spnx-rdio-dv-cmn-cls">
				<div class="radio-cntnr-mn-cls-cmommon"><input type="radio" name="plugin-type" id="plugin-type-1" value="1"  <?php if($plugin_type_id==1) { echo "checked='checked'"; }?>/></div>
				<div class="label-cntnr-mn-cls-cmommon-sec"> I want to only earn Revenue. I have more than 100,000 visitors per month.</div>
			</div>
			<div class="spnx-rdio-dv-cmn-cls">
				<div class="radio-cntnr-mn-cls-cmommon"><input type="radio" value="2" name="plugin-type" id="plugin-type-2" <?php if($plugin_type_id==2) {echo "checked='checked'"; }?>/></div>
				<div  class="label-cntnr-mn-cls-cmommon-sec"> I want to grow my website traffic for free + SEO + Backlinks & multiply my Ad Revenue by upto 15% per mon</div>
			</div>
			<div class="spnx-rdio-dv-cmn-cls">
				<div class="radio-cntnr-mn-cls-cmommon"><input type="radio" value="3" name="plugin-type" id="plugin-type-3" <?php if($plugin_type_id==3) {echo "checked='checked'"; }?>/></div>
				<div  class="label-cntnr-mn-cls-cmommon-sec"> My site is new. I want to grow my website traffic for Free + SEO + Backlinks </div>
			</div>
			<div class="spnx-rdio-dv-cmn-cls">
				<div class="radio-cntnr-mn-cls-cmommon"><input type="radio" value="4" name="plugin-type" id="plugin-type-4" <?php if($plugin_type_id==4) { echo "checked='checked'"; }?>/></div>
				<div  class="label-cntnr-mn-cls-cmommon-sec"> I want to promote my website. Product or Services. I do not do any blogging or content marketing.</div>
			</div>
			<div class="spnx-rdio-dv-cmn-cls">
				<div class="radio-cntnr-mn-cls-cmommon"><input type="radio" value="5" name="plugin-type" id="plugin-type-5" <?php if($plugin_type_id==5) { echo "checked='checked'"; }?>/></div>
				<div  class="label-cntnr-mn-cls-cmommon-sec"> I am a Digital Ad-agency. I would like to run campaigns for my Clients & make money from client margins.</div>
			</div>
			<div class="spnx-rdio-dv-cmn-cls">
				<div class="radio-cntnr-mn-cls-cmommon"><input type="radio" value="6" name="plugin-type" id="plugin-type-6" <?php if($plugin_type_id==6) { echo "checked='checked'"; }?>/></div>
				<div  class="label-cntnr-mn-cls-cmommon-sec"> I am a Multisite Network. I want to earn commissions out of every sales of plugin or Ad Revenue.</div>
			</div>
			<div class="spnx-rdio-dv-cmn-cls">
				<div class="radio-cntnr-mn-cls-cmommon"><input type="radio" value="7" name="plugin-type" id="plugin-type-6" <?php if($plugin_type_id==7) {echo "checked='checked'";}?>/></div>
				<div  class="label-cntnr-mn-cls-cmommon-sec">I would like to build my own Ad network. i want a White Labeled version of Spinkx. I can earn large commission from the network i build. </div>
			</div>
            <div class="error-cmn-clas-spnx chck-radio-btn-error-cls">Please Select Your Goal</div>
			<div class="spnx-knw-more-cmn-cls"><a href="https://www.spinkx.com/use-case/" target="_blank">Know More</a></div>
		</div>

	</div>
	<div class="spnx-sec-mn-cntainter">
		<div class="spnx-stckr-cmn-class spnx-box-reg-cmn-cls">
			<div class="vrticl-align-cmn-cls-spnx-reg">
				<span class=" catog-des-cmn-cls-spnx-reg">Registered site email</span>
				<span class="horizntal-align-cmn-cls-spnx-reg"><?php echo $settings['reg_email']; ?> <br/></span>
			</div>
			<div class="vrticl-align-cmn-cls-spnx-reg " style="display: none;">
				<span class=" catog-des-cmn-cls-spnx-reg">Registered user email</span>
				<span class="horizntal-align-cmn-cls-spnx-reg"><?php echo isset( $settings['reg_user_email'] )?$settings['reg_user_email']:''; ?></span>
			</div>

		</div>
		<div class="spnx-box-reg-cmn-cls">
			<div class="header-cmn-cls-spnx">Geography & Language</div>
			<div class="catog-des-cmn-cls-spnx-reg vrticl-btm-cmn-cls-reg">Country</div>
			<div class="select-div-common-class-spnx-reg select-vrticl-align-cmn-cls" id="geography-spnx-reg" style="position: relative;">
				<div style="position: relative;">
				<select name="site_target" id="site-gerography-select" class="target-country-cmn">
					<?php foreach ( $dropdown->countries as $key => $value ) {
						$countries = '';
						if ( isset(  $dropdown->selected_site->country_id ) && $key == 1 && !$dropdown->selected_site->country_id) {
							$countries = "selected='selected'";
						} elseif ( isset(  $dropdown->selected_site->country_id ) &&  $key == $dropdown->selected_site->country_id  ) {
							$countries = "selected='selected'";
						}
						echo '<option  value="' . $key . '" ' . $countries . '>' . $value . '</option>';
					} ?>
				</select>
					<span class="cmn-arw-cmn-clas-dv"><i class="fa fa-sort-down fa-lg" aria-hidden="true"></i></span>
				</div>
			</div>
			<div class="catog-des-cmn-cls-spnx-reg vrticl-btm-cmn-cls-reg">Language</div>
			<div class="select-div-common-class-spnx-reg select-vrticl-align-cmn-cls" style="position: relative;">
				<div style="position: relative;">
				<select name="site_language">
					<?php foreach ( $dropdown->languages as $key => $value ) {
						$languages = '';
						if ( isset($dropdown->selected_site->language_id ) && $key == 1 && ! $dropdown->selected_site->language_id ) {
							$languages = "selected='selected'";
						} elseif (  isset(  $dropdown->selected_site->language_id ) &&  $key == $dropdown->selected_site->language_id  ) {
							$languages = "selected='selected'";
						}
						echo '<option  value="' . $key . '" ' . $languages . '>' . $value . '</option>';
					} ?>
				</select>
					<span class="cmn-arw-cmn-clas-dv"><i class="fa fa-sort-down fa-lg" aria-hidden="true"></i></span>

				</div>
			</div>

			<div class="spnx-knw-more-cmn-cls" style="margin-top: 11px;"></div>
		</div>

		<div class="spnx-box-reg-cmn-cls">
			<div class="header-cmn-cls-spnx">Category</div>
			<div class="catog-des-cmn-cls-spnx-reg vrticl-btm-cmn-cls-reg">Category describe what your business is, not what it does or sells.</div>
			<div class="catog-des-cmn-cls-spnx-reg vrticl-btm-cmn-cls-reg">Primary category</div>
			<div class="select-div-common-class-spnx-reg select-vrticl-align-cmn-cls">
				<div style="position: relative;"><select name="primary_category">
                     <?php foreach ($dropdown->primary_categories as $key => $value ) {
						$primary_cat = '';
						if (  isset(  $dropdown->selected_site->pri_cat_id ) &&  $key == $dropdown->selected_site->pri_cat_id  ) {
							$primary_cat = "selected='selected'";
						}
						echo '<option value="' . $key . '" ' . $primary_cat . '>' . $value . '</option>';
					} ?>
				</select>
					<span class="cmn-arw-cmn-clas-dv"><i class="fa fa-sort-down fa-lg" aria-hidden="true"></i></span>
			</div>


			</div>
			<div class="catog-des-cmn-cls-spnx-reg vrticl-btm-cmn-cls-reg">Additional category</div>
			<div class="select-div-common-class-spnx-reg select-vrticl-align-cmn-cls select-add-cat" style="position: relative; width:100%; display:none;">
				<div class="select-drtn-cls">
					<select class="categories"  id="categories" multiple name="site_cat[]">
						<?php
							$categories = $dropdown->categories;
							$selected_categories = '';
							foreach ($categories as $key => $category) {
								if($key == $dropdown->selected_site->pri_cat_id) {
									$selected_categories = (array)$category;
									break;
								}
							}
							if($selected_categories) {
							foreach ( $selected_categories as $key => $value ) {
							$category = '';
							if ( isset( $category_arr ) && in_array( $key, $category_arr ) ) {
								$category = "selected='selected'";
							}
							echo '<option  value="' . $key . '" ' . $category . '>' . $value . '</option>';
						} }?>
					</select>
					<div class="error-cmn-clas-spnx error-cmn-clas-spnx-additional-act">Please select at least one additional category</div>
				</div>
				<!--<span class="font-awesome-icon-align-cmn-cls-down-ctegry"><i class="fa fa-sort-desc" aria-hidden="true"></i></span>

                  <span class="fa-time-cmn-cls-cross">
                      <i class="fa fa-times" aria-hidden="true"></i>
                  </span>-->
			</div>

			<div class="spnx-knw-more-cmn-cls" style="padding-bottom:14px; clear: both;"> </div>
		</div>
		<div class="lower-text-cmon-cls-spnx-reg">
             <span>
                 <span class="pls-note-cmn-cls-spnx">Please note:</span>
                 <span class="lower-color-cmn-cls-spnx-reg">Edit may be reviewed for quality and can take up to 3 days to published.</span>
                    <span class="spnx-knw-more-cmn-cls lrn-more-spnx-reg"> <a href="https://www.spinkx.com/faqs/" target="_blank">Learn More</a></span>

             </span>
		</div>
	</div>
	<div class="spnx-sec-mn-cntainter">
		<div class="spnx-box-reg-cmn-cls bs-cmn-class-thrd">
			<div class="cmn-cls-verticl-bus-spnx-reg">
				<div class="catog-des-cmn-cls-spnx-reg">Business name</div>
				<div>
					<input class="awsome_input-spnx-reg" type="text" name="bussiness_name" value="<?php echo $business_name;?>" id="bussiness-name-spnx">
					<span class="awsome_input_border-spnx-reg"></span>
					<div class="error-cmn-clas-spnx">Business Name Required</div>
				</div>
				<span class="font-awesome-icon-align-cmn-cls"><i class="fa fa-user" aria-hidden="true"></i></span>
			</div>
			<div class="cmn-cls-verticl-bus-spnx-reg cntry-rgn-cmn-cls-spnx-reg">
				<div class="catog-des-cmn-cls-spnx-reg">Country / Region </div>
				<div>
					<select name="bussiness_region" class="random">
						<?php foreach ( $dropdown->countries as $key => $value ) {
							$countries = '';
							if ( isset(  $dropdown->selected_site->country) && $key == 1 && !$dropdown->selected_site->country) {
								$countries = "selected='selected'";
							} elseif ( isset(  $dropdown->selected_site->country ) &&  $key == $dropdown->selected_site->country  ) {
								$countries = "selected='selected'";
							}
							echo '<option value="' . $key . '" ' . $countries . '>' . $value . '</option>';
						} ?>
					</select>
				</div>
				<span class="font-awesome-icon-align-cmn-cls-down"><i class="fa fa-sort-down fa-lg" aria-hidden="true"></i></span>
			</div>
			<div class="cmn-cls-verticl-bus-spnx-reg">
				<div class="catog-des-cmn-cls-spnx-reg">Street Address</div>
				<div>
					<input class="awsome_input-spnx-reg" type="text" name="bussiness_street" value="<?php echo $business_address; ?>" id="street-ad-bs-spnx">
					<span class="awsome_input_border-spnx-reg"></span>
					<div class="error-cmn-clas-spnx">Street Address Required</div>
				</div>
			</div>
			<div class="cmn-cls-verticl-bus-spnx-reg">
				<div class="catog-des-cmn-cls-spnx-reg">City </div>
				<div><input class="awsome_input-spnx-reg" type="text" name="bussiness_city" value="<?php echo $business_city; ?>" id="city-bs-spnx">
					<span class="awsome_input_border-spnx-reg"></span>
					<div class="error-cmn-clas-spnx">City Required</div>
				</div>
			</div>
			<div class="cmn-cls-verticl-bus-spnx-reg">
				<div class="pin-code-main-cntnr">
					<div class="catog-des-cmn-cls-spnx-reg">Zip code</div>
					<div>
						<input class="awsome_input-spnx-reg" type="text" id="zip_code_number" name="bussiness_zip" value="<?php  echo $business_pincode;?>">
						<span class="awsome_input_border-spnx-reg"></span>
						<div class="error-cmn-clas-spnx">Please Enter Valid Zip code</div>
					</div>
				</div>
				<div class="state-main-cntnr">
					<div class="catog-des-cmn-cls-spnx-reg">State</div>
					<div>
						<input class="awsome_input-spnx-reg" type="text" name="bussiness_state" value="<?php echo $business_state; ?>" id="state-ad-bs-spnx">
						<span class="awsome_input_border-spnx-reg"></span>
						<div class="error-cmn-clas-spnx">State Required</div>
					</div>
				</div>
			</div>
			<div class="cmn-cls-verticl-bus-spnx-reg">
				<div class="catog-des-cmn-cls-spnx-reg">Main business phone</div>
				<div>
					<input class="awsome_input-spnx-reg" type="number" name="bussiness_phone" value="<?php echo $business_phone;?>" id="phone-ad-bs-spnx">
					<span class="awsome_input_border-spnx-reg"></span>
					<div class="error-cmn-clas-spnx">Please Enter Valid Phone Number</div>
				</div>
			</div>
		</div>
		<div class="spnx-box-reg-cmn-cls money-trnsfer-main-class-spnx-cntnr">
			<div class="header-cmn-cls-spnx">Money Tranfer to your account</div>
			<div>
				<input type="email" placeholder="Paypal email id" name="paypal_id" value="<?php echo $business_paypal_id;?>" id="paypal-bs-spnx">
				<div class="error-cmn-clas-spnx error-cmn-clas-spnx-paypl">Please Enter Valid Email</div>

			</div>
		</div>
		<div class="lower-text-cmon-cls-spnx-reg">
			<div>
				<span class="pls-note-cmn-cls-spnx"> Please note:</span><span class="lower-color-cmn-cls-spnx-reg"> Minimum Transfer amount $100. Payment made every month. It may take upto 15 working days to transfer money & we may ask you for your tax information as per your country law.</span>
			</div>
		</div>
		<div class="spnx-box-reg-cmn-cls">
			<div class="continue-spnx-reg-button-cntnr">
				<span style="font-size:13px;">
					<input type="checkbox" name="agree" id="checked-registration" <?php echo isset( $settings['reg_user'] ) ? 'checked' : ''; ?> />
					I agree with the
					<a target="_blank" href="http://www.spinkx.com/terms-conditions/">
						Terms & Conditions
					</a>
				</span>
				<span style="text-align: right;"><button type="submit" >SUBMIT</button></span>
				<div class="error-cmn-clas-spnx error-cmn-clas-spnx-terms-condition">Please Check Terms and conditions</div>
			</div>
		</div>
		<div class="lower-text-cmon-cls-spnx-reg">
			<div>
				<span class="lower-color-cmn-cls-spnx-reg"><?php echo isset($dropdown->selected_site->msg_buy)?$dropdown->selected_site->msg_buy:''?></span>
				<span class="spnx-knw-more-cmn-cls buy-now-shrt-code"><?php echo ($buy_now)?do_shortcode( $buy_now ):'';?></span>
			</div>
		</div>
	</div>

	</form>
</div>
<?php add_action( 'admin_footer', 'spinkx_cont_media_selector_print_scripts' );
function my_editor_image_sizes( $sizes ) {
	$sizes = array_merge( $sizes, array(
		'wide-image' => __( 'Image 900px wide' )
	));
	return $sizes;
}
add_filter( 'image_size_names_choose', 'my_editor_image_sizes' );

