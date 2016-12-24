<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly	

$site_id = false;
$settings = get_option( SPINKX_CONT_LICENSE );
$settings = maybe_unserialize( $settings );
$post = helperClass::getFilterPost();
if ( $settings ) {
	$site_id = $settings['site_id'];
	$registeredemail = helperClass::getFilterVar( 'registeredemail' );
	if ( $registeredemail ) {
		$settings['reg_user_email'] = $registeredemail;
		$s = maybe_serialize( $settings );
		update_option( SPINKX_CONT_LICENSE,$s );
	}
}
if ( $post ) {
	// site info  is being updated
	if ( $site_id ) {
		$url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/site/update';
		$post['sflag'] = 'site_update';
		$post['site_id'] = $site_id;
		$post['license_code'] = md5( $settings['license_code'] );
	} else {
		$url = SPINKX_SERVER_BASEURL .'/wp-json/spnx/v1/site/create';
		$post['sflag'] = 'site_create';
	}
	$post['site_email'] = get_option( 'admin_email' );
	// $_POST['site_name'] = get_bloginfo('name');
	$response = helperClass::doCurl( $url,$post );

	// Site name editing couldn't be completed as there are some associated issues for the license validation
	if ( $settings ) {
		$site_name = helperClass::getFilterVar( 'site_name', INPUT_POST );
		if( $site_name ) {
			$settings['site_name'] = $site_name;
			update_option(SPINKX_CONT_LICENSE, maybe_serialize($settings));
		}
	}

	if ( $response && ! $site_id ) {
		$output = json_decode( $response,true );

		if ( ! isset( $output['message'] ) ) {

			$s = maybe_serialize( $output );
			update_option( SPINKX_CONT_LICENSE,$s );
			// sync posts here.
			$settings = get_option( SPINKX_CONT_LICENSE );
			$settings = maybe_unserialize( $settings );
			$response = spinkx_cont_post_sync($settings);
			$js_output = "<script>jQuery(document).ready(function () {
					$.growl.notice({
						message: 'Post Sync SuccessFully',
						location: 'tr',
						size: 'large'
					});
					window.location.replace('?page=spinkx_options');
				});</script>";
			echo $js_output;
		} else {
			$settings = get_option( SPINKX_CONT_LICENSE );
			$settings = maybe_unserialize( $settings );
			$settings['reg_user'] = $output['reg_user'] ;
			$settings['due_date'] = $output['due_date'] ;
			$s = maybe_serialize( $settings );
			update_option( SPINKX_CONT_LICENSE,$s );
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


		if ( isset($output['reg_user']) && $output['reg_user'] ) {
			$settings = get_option( SPINKX_CONT_LICENSE );
			$settings = maybe_unserialize( $settings );
			$settings['reg_user'] = $output['reg_user'];
			$s = maybe_serialize( $settings );
			update_option( SPINKX_CONT_LICENSE, $s );
			echo '<script>window.location.replace("?page=spinkx_options");</script>';
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
	$api_form_elements_url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/site/form-elements';
	$output = helperClass::doCurl( $api_form_elements_url, null );
	$dropdown = json_decode( $output );
	$selected_url	= get_site_url();
	$buy_now = $dropdown->selected_site->buy_now;
	if ( class_exists( Domainmap_Utils ) ) {

		$selected_url = \Domainmap_Utils::get_mapped_domain();
		// echo $selected_url;
	}
} /******GET REQUEST FOR FORM ELEMENTS-UPDATE******/
else {
	$api_form_elements_url = SPINKX_SERVER_BASEURL . '/wp-json/spnx/v1/site/form-elements/' . $site_id;
	$output = helperClass::doCurl( $api_form_elements_url, null );
	$dropdown = json_decode( $output );
	$selected_url = '';
	if( isset( $dropdown->selected_site->site_url ) ) {
		$selected_url = $dropdown->selected_site->site_url;
	}
	if( isset( $dropdown->selected_site->user_key ) ) {
		$user_key = $dropdown->selected_site->user_key;
	}
	$buy_now=null;
	if( isset( $dropdown->selected_site->buy_now ) ) {
		$buy_now = $dropdown->selected_site->buy_now;
	}
	$settings['due_date'] = $dropdown->selected_site->due_date;
	if ( isset( $dropdown->selected_site->registeredemail ) ) {
		$registeredemail = $dropdown->selected_site->registeredemail;
		if ( isset( $registeredemail ) ) {
			$settings['reg_user_email'] = $registeredemail;
			$s = maybe_serialize( $settings );
			update_option( SPINKX_CONT_LICENSE, $s );
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
$userkey = 	helperClass::getFilterVar( 'userkey' );
if ( $userkey ) {
	$user_key		= $userkey;
}
$datetime = null;
$color = '#469fa1';
if ( $settings ) {
	$datetime = strtotime( $settings['due_date'] );
	$diff = spinkx_cont_get_license_date( $settings['due_date'] );
	if ( intval( $diff->format( '%R%a days' ) ) < 0 ) {
		$color = '#f69fa1';
		do_action( 'network_admin_notices' );
	}
}
?>
<div class="wrap">
	<header class="container-fluid">
		<div class="container">
			
			<div class="row">
				<div class="col-sm-4 col-md-4">

				</div>
				<div class="col-sm-4 col-md-4" style="text-align: center">
					<img src="<?php echo esc_url( SPINKX_CONTENT_PLUGIN_URL ); ?>assets/images/spinkx-logo.png" alt="Home" align="center" style="max-width: 60%">
				</div>
				<div class="col-sm-4 col-md-4" style="text-align: right; vertical-align: middle;">
					<div class="">
						<p style="color: grey;font-weight: bold;">Plugin Version <?php echo SPINKX_VERSION;?></p>

						<p style="color: grey;font-weight: bold;width: 100%;float: right" >Licence Valid Till :
						<?php if ( $datetime ) {
								echo date( 'd',$datetime ) . ' ' . date( 'F',$datetime ) . ' ' . date( 'Y',$datetime ) . '(' . $diff->format( '%R%a days' ) . ')';
}
							if ( ! $datetime ) { echo '(xx days)'; }
							echo '<br/>';
							echo '<span class="buy-msg">Buy the plugin and get 1000 Free Boost Points<br/>to reach 10,000 new visitors. Limited Offer!</span>';

						?> </p>
						<p style="display: block"><?php echo do_shortcode( $buy_now );?></p>
					</div>
				</div>
			</div>
		</div>
	</header>
	<section class="main_container container">
		<form method="post" enctype="multipart/form-data">
			<div class="auto-pick form-group">
				<label for="site_url">Site URL</label>
				<input type="text" name="site_url" value="<?php echo $selected_url; ?>"
				       placeholder="URL - (Auto Pick from current URL)" readonly>
			</div>
			<div class="auto-pick form-group">
				<label for="site_name">Site Name</label>
				<?php if ( $settings['site_name'] ) { ?>
					<input type="text" name="site_name" value="<?php echo $settings['site_name']; ?>"/>
				<?php } else { ?>
					<input type="text" name="site_name" value="<?php echo get_bloginfo( 'name' ); ?>"/>
				<?php } ?>
			</div>
			<?php // if(!isset($settings['reg_user'])) { ?>
			<div class="auto-pick form-group">
				<input type="hidden" id="user_key" name="user_key" value="<?php if ( $user_key ) {
					echo $user_key;
} ?>" placeholder="KEY - (Enter your user key)" readonly>
				<?php if ( ! $user_key ) { ?>
					<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info getUserKey"
					        id="get	key">SPINKX Registration
					</button>
				<?php } else { ?>
					<label for="site_name">Registered Site Email:- </label>
					<?php echo $settings['reg_email']; ?> <br/>
					<label for="site_name">Registered User Email:- </label>
					<?php echo isset( $settings['reg_user_email'] )?$settings['reg_user_email']:''; ?>
				<?php } ?>
			</div>

			<?php $display = ''; ?>
			<?php if ( $user_key ) { ?>
				<div id="step-2" style="<?php // echo $display?>">
					<div class="row" style="margin-bottom: 40px;"><!-- row start -->
						<div class="website_category col-sm-8 col-md-8">    <!-- category start -->
							<label>Website / Blog Content Category (you can choose multiple)</label>
							<script type="text/javascript">
								jQuery(document).ready(function () {
									jQuery(".site-cat-multiple").select2();
								});
							</script>
							<br/><br/>
							<select style="width:100%;" class="site-cat-multiple" name="site_cat[]" multiple>
								<?php foreach ( $dropdown->categories as $key => $value ) {
									$category = '';
									if ( isset( $dropdown->selected_category ) && in_array( $key, $dropdown->selected_category ) ) {
										$category = "selected='selected'";
									}
									echo '<option value="' . $key . '" ' . $category . '>' . $value . '</option>';
} ?>
							</select>
						</div>      <!-- category end -->

						<div class="col-sm-4 col-md-4"><!-- right column start -->
							<div class="form-group">
								<label>Age Restriction</label>
								<select name="age_group">
									<?php foreach ( $dropdown->age_groups as $key => $value ) {
										$selected_gender = '';
										if ( $value == 'All' && ! $dropdown->selected_site->age ) {
											$selected_gender = "selected='selected'";
										} elseif ( $value == $dropdown->selected_site->age ) {
											$selected_gender = "selected='selected'";
										}
										echo '<option value="' . $value . '" ' . $selected_gender . '>' . $value . '</option>';
} ?>
								</select>
							</div>
							<div class="form-group">
								<label>Gender Specific Content</label>
								<select name="gender_group">
									<?php foreach ( $dropdown->gender_groups as $key => $value ) {
										$selected_age = '';
										if ( $value == 'All' && ! $dropdown->selected_site->gender ) {
											$selected_age = "selected='selected'";
										} elseif ( $value == $dropdown->selected_site->gender ) {
											$selected_age = "selected='selected'";
										}
										echo '<option value="' . $value . '" ' . $selected_age . '>' . $value . '</option>';
} ?>
								</select>
							</div>
							<div class="form-group">
								<label>Content Target Geography</label>
								<select name="site_target[]">
									<?php foreach ( $dropdown->countries as $key => $value ) {
										$countries = '';
										if ( isset(  $dropdown->selected_country ) && $key == 1 && ! count( $dropdown->selected_country ) ) {
											$countries = "selected='selected'";
										} elseif ( isset(  $dropdown->selected_country ) && in_array( $key, $dropdown->selected_country ) ) {
											$countries = "selected='selected'";
										}
										echo '<option value="' . $key . '" ' . $countries . '>' . $value . '</option>';
} ?>
								</select>
							</div>
							<div class="form-group">
								<label>Content Language</label>
								<select name="site_language[]">
									<?php foreach ( $dropdown->languages as $key => $value ) {
										$languages = '';
										if ( isset(  $dropdown->selected_language ) && $key == 1 && ! count( $dropdown->selected_language ) ) {
											$languages = "selected='selected'";
										} elseif (  isset(  $dropdown->selected_language ) && in_array( $key, $dropdown->selected_language ) ) {
											$languages = "selected='selected'";
										}
										echo '<option value="' . $key . '" ' . $languages . '>' . $value . '</option>';
} ?>
								</select>
							</div>
						</div><!-- right column end -->

					</div><!-- row close -->
					<p style="text-align: center;"><input type="checkbox"
					                                      name="agree" <?php echo $settings['reg_user'] ? 'checked' : ''; ?> >
						I have read & accept the Terms & Conditions - <a target="_blank"
						                                                 href="http://www.spinkx.com/terms-conditions/">Read
							Terms & Conditions</a></p>
					<p class="fb-image">
						<?php if ( ! $user_key ) { ?>
							<span style="font-size:1.2em; ">Step 2 &rarr;</span>
						<?php } elseif ( ! $settings['reg_user'] && $user_key ) {
						?>
							<script>
								window.load = function() {
									$.growl.notice({
										message: "Great ! Now proceed to fill the remaining form & agree to our 'Terms & Conditions' and press 'Save Settings'  to complete Signup :) ",
										location: 'tr',
										size: 'medium',
										fixed: true
									});
								}
							</script>
						<?php } ?>
						<input value="Save Settings" type="submit"/></p>
				</div>
			<?php } ?>

		</form>
	</section>


</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myModalLabel">Login to Spinkx Server</h4>
					<p>This will allow us to add credit points you earn to your account &amp; other goodies !</p>
				</div>
				<div class="modal-body">
					<iframe
						src="<?php echo esc_url( SPINKX_SERVER_BASEURL ) ?>/spinkx_login?loginFacebook=1&redirect=<?php echo esc_url( SPINKX_SERVER_BASEURL ) ?>/viewkey?url=<?php echo get_site_url(); ?>"
						id="info" class="iframe" scrolling="no" name="info" width="100%" height="90%"></iframe>
				</div>

			</div>
		</div>
	</div> <!-- /#myModal -->
<?php
