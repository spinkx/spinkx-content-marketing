<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$css_url = esc_url( SPINKX_CONTENT_PLUGIN_URL . 'assets/campaigns/css/' );
wp_enqueue_style( 'css-select2', $css_url . 'select2.css' );
	$custom_css = ' 
 .select2-choices{
	width: 240px !important;
}
.select2-input{
	width: 240px !important;
}
#s2id_global_blocked_keywords_textarea{
	margin-left: 23px;
}
#s2id_global_blocked_categories_textarea{
	margin-left: 15px;
}';
wp_add_inline_style( 'css-select2', $custom_css );
wp_enqueue_script( 'jquery-select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js' );
$tabtype = helperClass::getFilterVar( 'tabtype', INPUT_GET, FILTER_VALIDATE_INT);

?>
<div class="brand-design-content" <?php echo ( $tabtype && $tabtype == 2 )?'style="display:none;"':''?>>
	<div class="block-top-preview">
		<!--  **********************************************************************  -->
		<br>
		<!--  Widget Name Starts Here  -->
		<table class="new-table">
			<tr>
				<td>
					<span class="badge" >0</span>
				</td>
				<td class="widget_name_td">Widget Name:</td>
				<td class="widget_name_input_td">
					<?php
					if( $widget_name == "No Widget Name" )
					{
						$clear_widget_name = "";
					}
					else
					{
						$clear_widget_name = $widget_name;
					}
					?>
					<input type="text" id="widget_name" value="<?php echo $clear_widget_name; ?>" name="widget_name" placeholder="Widget Name Here" required />
				</td>
				<td class="widget_shortcode_td">
					<input type="hidden" id="main_widget_id" value="<?php echo $main_widget_id; ?>" name="main_widget_id" placeholder="" readonly />
					<div class="bw-shortcode">[spinkx id = "<?php echo $widget_auto_id; ?>"]</div>
					<input type="hidden" id="add_shortcode" value='[spinkx id=<?php echo $widget_auto_id; ?>]' name="add_shortcode" placeholder="Shortcode" />
				</td>
			</tr>
		</table>
		<!--  Widget Name Ends Here  -->
		<!--  **********************************************************************  -->
		<!--  **********************************************************************  -->
		<?php
			$key = '[spinkx id='.$widget_auto_id.']';  // pass your shortcode here
			$blog_id = get_current_blog_id();
			if(is_multisite()){
				$show_data = get_blog_option($blog_id, $key);
			}else{
				$show_data = get_option($key);
			}
		?>
		<!--<table class="new-position">
		<tr>
			<td>
				<span class="badge" >1</span>
			</td>
			<td class="widget_name_td">Widget Position:</td>
			<td></td>
			<td>
			<?php
				#option array
				/*$section_option = array('Top Of Post', 'Bottom Of Post','Sidebar');
				#check comment open
				$blog_id = get_current_blog_id();
				$key = 'default_comment_status';
				if(is_multisite()){
					$check_Comment = get_blog_option($blog_id, $key);
				}else{
					$check_Comment = get_option($key);
				}
				if ($check_Comment == 'open'){
					$section_option[] = 'Top Of Comment';
					$section_option[] = 'Bottom Of Comment';
				}*/

				#select box
				?>
				<!--<select name="wp_section" id="wp_section">
					<option value="">-select-</option>
					<?php /*foreach($section_option as $section_option_single){
						if(isset($show_data['wp_section']) && $show_data['wp_section']==$section_option_single){
							echo '<option value="'.$section_option_single.'" selected="selected">'.$section_option_single.'</option>';
						}else{
							echo '<option value="'.$section_option_single.'">'.$section_option_single.'</option>';
						}
					}*/
					?>
				</select>
			</td>

		</tr>
		</table> -->

		<div class="choosen-style-div" >
			<div class="badge" >1</div>
			<div class="choosen-style" >Choose Style:</div>
		</div>
		<!--  **********************************************************************  -->

		<!--  **********************************************************************  -->
		<!--  Widget Layout Starts Here  -->
		<table class="form-table">
			<tr>
				<td  id="widget-masonry">
					<input type="radio" id="widget_layout_type" class="widget_layout_masonary" name="widget_layout_type" <?php if ( $widget_layout_type=="masonry" ) { echo "checked"; };?> value="masonry" /><strong>Pinterest style </strong>(Suitable for Footers)
				</td>
				<td  id="widget-fixed">
					<input type="radio" id="widget_layout_type" class="widget_layout_fixed" name="widget_layout_type" <?php if ( $widget_layout_type=="fixed-width" ) { echo "checked"; };?> value="fixed-width" /><strong>Fixed Width & Height </strong>(Suitable for sidebar and all locations)
				</td>
			</tr>
		</table>
		<!--  Widget Layout Ends Here
		<div class="choosen-temp-style-div" >
			<div class="badge" >2</div>
			<div class="choosen-style" >Choose Template Style:</div>
		</div>-->
		<!--  **********************************************************************  -->

		<!--  **********************************************************************  -->
		<!--  Widget Layout Starts Here -->
		<table class="form-table">
		<?php
		//added for retaining all widgets after wide option removal
		$unit_layout_type = "tall";
		?>
			<tr style="display:none">
				<td  id="unit-tall" >
					<input type="radio" id="unit_layout_type" class="unit_layout_tall" name="unit_layout_type" <?php if ( $unit_layout_type=="tall" ) { echo "checked"; };?> value="tall" /><strong>Tall </strong>
				</td>
				<td  id="unit-wide">
					<input type="radio" id="unit_layout_type" class="unit_layout_wide" name="unit_layout_type" <?php if ( $unit_layout_type=="wide" ) { echo "checked"; };?> value="wide" /><strong>Wide</strong>
				</td>
			</tr>
		</table>
		<!--  Widget Layout Ends Here  -->
		<!--  **********************************************************************  -->
	</div>
	<div class="block-left-preview">
		<!--  **********************************************************************  -->
		<!--  Column Range Starts Here  -->
		<table class="form-table">
			<tr>
				<td >
					<span class="badge">2</span>
					<p class="content-view-td" >Number of Columns Desktop View:</p>
				</td>
			</tr>
			<tr>
				<td class="content-left-td" >
					<input type="text" id="result1" value="<?php echo $no_of_columns; ?>" name="no_of_columns" placeholder="<?php echo $no_of_columns; ?>" readonly />
					<input type="hidden" id="mob_views"  name="no_col_mob_view"  value="<?php echo $no_col_mob_view; ?>" />

					<div id="slider-range-min" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" >
						<div class="ui-slider-range ui-widget-header ui-slider-range-min" style="width: 0%;"></div>
						<?php
						$widget_no_of_cols_val = 1;
						if( $no_of_columns ) {
							$widget_no_of_cols_val = ( $no_of_columns / 6 ) * 100;
						};
						?>
						<a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: <?php echo $widget_no_of_cols_val; ?>%;"></a>
					</div>
				</td>
			</tr>
		</table>
	<!--	<table class="form-table">
			<tr>
				<td>
					<span class="badge" >3</span>
				</td>
				<td class="content-view-td" >Number of Columns Mobile View</td>
			</tr>
			<tr>
				<td  class="content-left-td">
					<input type="radio" id="mob_view"  name="no_col_mob_view" <!--?php //if ( $no_col_mob_view==1 ) { echo "checked"; };?> value="1" /><strong>1 Column</strong>
				</td>
				<td>
					<input type="radio" id="mob_views"  name="no_col_mob_view" <!--?php //if ( $no_col_mob_view==2 ) { echo "checked"; };?> value="2" /><strong>2 Column</strong>
				</td>
			</tr>
		</table>-->
		<table class="form-table" id="unit_size_tb">
			<tr>
				<td colspan="2">
					<span class="badge">3</span>
					<p class="content-view-td" >Unit Size </p>
				</td>
			</tr>
			<tr>
				<td class="form-table image-crop-fields content-left-td" style="padding:0;width: 240px;">
					<strong>Width</strong> &nbsp;<input id="img_crop_width" type="text" title="Unit Width" value="<?php echo $img_crop_width; ?>" name="img_crop_width" placeholder="<?php echo $img_crop_width; ?>" /> <strong> px</strong> |
				</td>
				<td class="form-table image-crop-fields" style="padding:0;">
					&nbsp;<strong>Height</strong> <input id="img_crop_height" type="text" title="Unit Height" value="<?php echo $img_crop_height; ?>" name="img_crop_height" placeholder="<?php echo $img_crop_height; ?>"  /> <strong>px</strong>
				</td>
				<td id="im_height_td" class="form-table image-crop-fields content-left-td" style="padding:0;width: 290px;">
					<strong>Image Height</strong>&nbsp;<input id="img_height" type="text" title="Image Height" value="<?php echo $img_height; ?>" name="img_height" /><strong>px</strong>
				</td>
				<!--<td id="im_width_td" class="form-table image-crop-fields content-left-td" style="padding:0;width: 293px;">
					<strong>Image Width</strong>&nbsp;<input id="img_width" type="text" title="Image Width" value="<?php //echo $img_height; ?>" name="img_width" /><strong>px</strong>
				</td>-->
			</tr>
		</table>
		<table class="form-table">
			<tr>
				<td ><span class="badge">4</span><p class="content-view-td" >Unit Spacing</p></td>
			</tr>
			<tr>
				<td colspan="2" class="content-left-td">
					<strong>Pixel </strong><input type="number" max="40" min="4" name="unit_spacing" value="<?php echo $unit_spacing; ?>" id="unit_spacing" /> <strong>px</strong>
				</td>
			</tr>
		</table>
		<!--  Column Range Ends Here  -->
		<!--  **********************************************************************  -->
		<!--  **********************************************************************  -->
		<h3>COLOR & DISPLAY</h3>
		<!--  **********************************************************************  -->

		<!--  **********************************************************************  -->
		<!--  Background Color Starts Here  -->
		<table class="form-table">
			<tr>
				<td>
					<span class="badge">5</span>
					<p class="content-view-td" >Widget Background Color</p>
				</td>
			</tr>
			<tr>
				<td  class="content-left-td">
					<input type="text" id="bg_color" value="<?php echo $unit_bg_color; ?>" name="unit_bg_color" placeholder="<?php echo $unit_bg_color; ?>" />
					</br>	Pick a background color (default #BBBBBB).
				</td>
			</tr>
		</table>
		<!--  Background Color Ends Here  -->
		<!--  **********************************************************************  -->

		<!--  **********************************************************************  -->
		<!--  Foreground Color Starts Here  -->
		<table class="form-table">
			<tr>
				<td>
					<span class="badge">6</span>
					<p class="content-view-td" >Unit Foreground Color</p>
				</td>
			</tr>
			<tr>
				<td class="content-left-td">
					<input type="text" id="fg_color" value="<?php echo $unit_fg_color; ?>" name="unit_fg_color" placeholder="<?php echo $unit_fg_color; ?>" /></br>
					Pick a foreground color (default #FEFEFE).
				</td>
			</tr>
		</table>
		<!--  Foreground Color Ends Here  -->
		<!--  **********************************************************************  -->

		<!--  **********************************************************************  -->
		<!--  Border Part Starts Here  -->
		<table class="form-table">
			<tr>
				<td>
					<span class="badge">7</span>
					<p class="content-view-td"  >Unit Border Style</p>
				</td>
			</tr>
			<tr>
				<td class="content-left-td">
					<input type="number" id="unit_border_width" value="<?php echo $unit_border_width; ?>" name="unit_border_width" min="0" max="45" title="border-width">px

					<select id="unit_border_style" name="unit_border_style" title="border-style" >
						<option <?php if( $unit_border_style == "none" ) { echo "selected"; }; ?> value="none">none</option>
						<option <?php if( $unit_border_style == "dotted" ) { echo "selected"; }; ?> value="dotted">dotted</option>
						<option <?php if( $unit_border_style == "dashed" ) { echo "selected"; }; ?> value="dashed">dashed</option>
						<option <?php if( $unit_border_style == "solid" ) { echo "selected"; }; ?> value="solid">solid</option>
						<option <?php if( $unit_border_style == "double" ) { echo "selected"; }; ?> value="double">double</option>
						<option <?php if( $unit_border_style == "hidden" ) { echo "selected"; }; ?> value="hidden">hidden</option>
						<option <?php if( $unit_border_style == "groove" ) { echo "selected"; }; ?> value="groove">groove</option>
						<option <?php if( $unit_border_style == "ridge" ) { echo "selected"; }; ?> value="ridge">ridge</option>
						<option <?php if( $unit_border_style == "inset" ) { echo "selected"; }; ?> value="inset">inset</option>
						<option <?php if( $unit_border_style == "outset" ) { echo "selected"; }; ?> value="outset">outset</option>
					</select>
					<div class="border-color">
						<input type="text" id="unit_border_color" value="<?php echo $unit_border_color; ?>" name="unit_border_color" placeholder="<?php echo $unit_border_color; ?>" title="border-color"/>
					</div>
				</td>
			</tr>
		</table>
		<!--  Border Part Ends Here  -->
		<!--  **********************************************************************  -->

		<!--  **********************************************************************  -->
		<!--  Border radius Starts Here  -->
		<table class="form-table">
			<tr>
				<td>
					<span class="badge">8</span>
					<p class="content-view-td"  >Unit Corner Radius</p>

					<div id="corner-div"><input type="number" id="unit_border_radius" value="<?php echo $unit_border_radius; ?>" name="unit_border_radius" min="0" max="45" title="border-radius">px</div>
				</td>
			</tr>
		</table>

		<!--  Border radius Ends Here  -->
		<!--  **********************************************************************
		<div class="block-top-preview">-->
		<h3>TEXT FONT & COLOR</h3>
		<!--  **********************************************************************  -->
		<!--  Title Font Part Starts Here  -->
		<table class="form-table" style="width:900px;">
			<tr>
				<td>
					<span class="badge badge-double">9</span>
					<p class="content-view-td" colspan="6">Headline Font</p>
				</td>

			</tr>
			<tr>
				<td class="content-left-td">
					<input type="number" id="unit_title_font_size" value="<?php echo $unit_title_font_size; ?>" name="unit_title_font_size" min="0" max="60" title="font-size">px

					<input type="number" id="unit_title_line_height" value="<?php echo $unit_title_line_height; ?>" name="unit_title_line_height" min="0" max="90" title="line-height">px

				<select id="unit_title_font_style" name="unit_title_font_style" title="font-weight" class="font_style">
					<option <?php if( $unit_title_font_style == "lighter" ) { echo "selected"; }; ?> value="lighter">lighter</option>
					<option <?php if( $unit_title_font_style == "normal" ) { echo "selected"; }; ?> value="normal">normal</option>
					<option <?php if( $unit_title_font_style == "bold" ) { echo "selected"; }; ?> value="bold">bold</option>
					<option <?php if( $unit_title_font_style == "bolder" ) { echo "selected"; }; ?> value="bolder">bolder</option>
				</select>
			<div class="border-color">
				<input type="text" id="unit_title_font_color" value="<?php echo $unit_title_font_color; ?>" name="unit_title_font_color" placeholder="<?php echo $unit_title_font_color; ?>" title="font-color"/>
			</div>
			<p style="display:none">Google Font:
				<select id="unit_title_font_family" name="unit_title_font_family" title="font-family">
					<option <?php if( $unit_title_font_family == "Carrois Gothic" ) { echo "selected"; }; ?> value="Carrois Gothic">Carrois Gothic</option>
					<option <?php if( $unit_title_font_family == "Open Sans" ) { echo "selected"; }; ?> value="Open Sans">Open Sans</option>
					<option <?php if( $unit_title_font_family == "Arial" ) { echo "selected"; }; ?> value="Arial">Arial</option>
				</select>
			</p>

				<select id="unit_title_font_case" name="unit_title_font_case" title="text-transform" class="font_case">
					<option <?php if( $unit_title_font_case == "none" ) { echo "selected"; }; ?> value="none">none</option>
					<option <?php if( $unit_title_font_case == "uppercase" ) { echo "selected"; }; ?> value="uppercase">uppercase</option>
					<option <?php if( $unit_title_font_case == "lowercase" ) { echo "selected"; }; ?> value="lowercase">lowercase</option>
					<option <?php if( $unit_title_font_case == "capitalize" ) { echo "selected"; }; ?> value="Capitalize">Capitalize</option>
					<option <?php if( $unit_title_font_case == "full-width" ) { echo "selected"; }; ?> value="full-width">full-width</option>
				</select>
			</td>
			</tr>
		</table>
		<!--  Title Font Part Ends Here  -->
		<!--  **********************************************************************  -->

		<!--  **********************************************************************  -->
		<!--  Title Font Family Starts Here  -->

		<!--  Title Font Family Ends Here  -->
		<!--  **********************************************************************  -->

		<!--  **********************************************************************  -->
		<!--  Add Line Part Starts Here  -->
		<table class="form-table">
			<tr>
				<td>
					<span class="badge badge-double" >10</span>
					<p class="content-view-td" >Headline Placement</p>
					<select id="unit_add_line_style" name="unit_add_tall_style" title="line-style" class="line-style-tall" style="<?php if( $unit_layout_type == "wide" ) { echo "display:none;"; } ?>width:150px;">
						<option <?php if( $unit_add_line_style == "aboveimg" && $unit_layout_type == "tall" ) { echo "selected"; }; ?> value="aboveimg">Above Image</option>
						<option <?php if( $unit_add_line_style == "belowimg" && $unit_layout_type == "tall") { echo "selected"; }; ?> value="belowimg">Below Image</option>
					</select>
					<select id="unit_add_line_styles" name="unit_add_wide_style" title="line-style" class="line-style-wide" style="<?php if( $unit_layout_type == "tall" ) { echo "display:none;"; } ?>width:150px;">
						<option <?php if( $unit_add_line_style == "left" && $unit_layout_type == "wide") { echo "selected"; }; ?> value="left">Image Left</option>
						<option <?php if( $unit_add_line_style == "right" && $unit_layout_type == "wide" ) { echo "selected"; }; ?> value="right">Image Right</option>
					</select>
				</td>
			</tr>
		</table>
		<!--  Add Line Part Ends Here  -->
		<!--  **********************************************************************  -->

		<!--  **********************************************************************  -->
		<!--  Content Font Part Starts Here  -->
		<table class="form-table" style="width:900px;">
			<tr>
				<td>
					<span class="badge badge-double" >11</span>
					<p class="content-view-td" >Excerpt Styling</p>
				</td>

			</tr>
			<tr>
				<td class="content-left-td">
					<input type="number" id="unit_excerpt_font_size" value="<?php echo $unit_excerpt_font_size; ?>" name="unit_excerpt_font_size" min="0" max="60" title="font-size">px

					<input type="number" id="unit_excerpt_line_height" value="<?php echo $unit_excerpt_line_height; ?>" name="unit_excerpt_line_height" min="0" max="90" title="line-height">px

					<select id="unit_excerpt_font_style" name="unit_excerpt_font_style" title="font-weight" class="font_style">
						<option <?php if( $unit_excerpt_font_style == "lighter" ) { echo "selected"; }; ?> value="lighter">lighter</option>
						<option <?php if( $unit_excerpt_font_style == "normal" ) { echo "selected"; }; ?> value="normal">normal</option>
						<option <?php if( $unit_excerpt_font_style == "bold" ) { echo "selected"; }; ?> value="bold">bold</option>
						<option <?php if( $unit_excerpt_font_style == "bolder" ) { echo "selected"; }; ?> value="bolder">bolder</option>
					</select>
				<div class="border-color">
					<input type="text" id="unit_excerpt_font_color" value="<?php echo $unit_excerpt_font_color; ?>" name="unit_excerpt_font_color" placeholder="<?php echo $unit_excerpt_font_color; ?>" title="font-color"/>
					</div>
				<p style="display:none">Google Font:
					<select id="unit_excerpt_font_family" name="unit_excerpt_font_family" title="font-family">
						<option <?php if( $unit_excerpt_font_family == "Carrois Gothic" ) { echo "selected"; }; ?> value="Carrois Gothic">Carrois Gothic</option>
						<option <?php if( $unit_excerpt_font_family == "Open Sans" ) { echo "selected"; }; ?> value="Open Sans">Open Sans</option>
						<option <?php if( $unit_excerpt_font_family == "Arial" ) { echo "selected"; }; ?> value="Arial">Arial</option>
					</select>
				</p>
					<select id="unit_excerpt_font_case" name="unit_excerpt_font_case" title="text-transform" class="font_case">
						<option <?php if( $unit_excerpt_font_case == "none" ) { echo "selected"; }; ?> value="none">none</option>
						<option <?php if( $unit_excerpt_font_case == "uppercase" ) { echo "selected"; }; ?> value="uppercase">uppercase</option>
						<option <?php if( $unit_excerpt_font_case == "lowercase" ) { echo "selected"; }; ?> value="lowercase">lowercase</option>
						<option <?php if( $unit_excerpt_font_case == "capitalize" ) { echo "selected"; }; ?> value="Capitalize">Capitalize</option>
						<option <?php if( $unit_excerpt_font_case == "full-width" ) { echo "selected"; }; ?> value="full-width">full-width</option>
					</select>
				</td>
			</tr>
		</table>
		<!--  Content Font Part Ends Here  -->
		<!--  **********************************************************************  -->

		<!--  **********************************************************************  -->

		<!--  **********************************************************************  -->
		<table class="form-table">
			<tr>
				<td>
					<span class="badge badge-double" >12</span>
					<p class="content-view-td" >Excerpt Placement</p>
					<select id="excerpt_add_line_style" name="unit_excerpt_tall_style" title="line-style" class="line-style-tall" style="<?php if( $unit_layout_type == "wide" ) { echo "display:none;"; } ?>width:150px;">
						<option <?php if( $unit_excerpt_line_style == "aboveimg" ) { echo "selected"; }; ?> value="aboveimg">Above Image</option>
						<option <?php if( $unit_excerpt_line_style == "belowimg" ) { echo "selected"; }; ?> value="belowimg">Below Image</option>
					</select>
					<select id="excerpt_add_line_styles" name="unit_excerpt_wide_style" title="line-style" class="line-style-wide" <?php if ( $unit_layout_type=="wide" ) { echo "disabled='true'"; }?> style="<?php if( $unit_layout_type == "tall" ) { echo "display:none;"; } ?>width:150px;">
						<option <?php if( $unit_excerpt_line_style == "left" ) { echo "selected"; }; ?> value="left">Image Left</option>
						<option <?php if( $unit_excerpt_line_style == "right" ) { echo "selected"; }; ?> value="right">Image Right</option>
					</select>
				</td>
			</tr>
		</table>
		<!--  **********************************************************************  -->
		<!--  Content Word Limit Starts Here  -->
		<table class="form-table" style="width:650px;">
			<tr>
				<td>
					<span class="badge badge-double">13</span>
					<p class="content-view-td" >Excerpt Character Limit</p>
					<input type="text" id="unit_excerpt_word_limit" value="<?php echo $unit_excerpt_word_limit; ?>" name="unit_excerpt_word_limit" placeholder="<?php echo $unit_excerpt_word_limit; ?>" title="excerpt-limit"/> (0 to 100, if 0 then excerpt will not show)
				</td>
			</tr>
		</table>
		<!--  Content Word Limit Ends Here  -->
		<div class="block-default-buttons">
			<?php
			/********************** Include Preview Content ************************/
			require SPINKX_CONTENT_PLUGIN_DIR . 'assets/widgets/create/widget-submit-buttons.php';
			/********************** Include Preview Content ************************/
			?>
		</div>
		<!--  **********************************************************************  -->
	</div>
</div>
<!-- Distribution Settings starts here -->
<?php
if(($web_content_settings==0)&&($global_distribution_settings==0)&&($sponsored_content_settings==0)&&$own_campaign_settings==0)
{
	$auto_enable_view	=	"display:block;";
	$manual_enable_view	=	"display:none;";
}
else
{
	$auto_enable_view	=	"display:none;";
	$manual_enable_view	=	"display:block;";
}
?>
<div class="brand-local-content" <?php echo ( ( ! $tabtype )  || ( $tabtype == 1  ) )?'style="display:none;"':''?>>
	<div id="content-msg" >
		<strong>Automatic Settings are enabled to make your website perform at its best and gain maximum, in terms of User Engagement, Exchange & Revenue.</strong>
	</div>
	<div id="auto_enable" class="well" style="<?php echo $auto_enable_view;?>">
		<strong>The Following are Enabled and managed Automatically for BEST PERFORMANCE</strong>
	</div>
	<div class="well" id="manual_enable" style="<?php echo $manual_enable_view;?>">
		<strong>Manual Settings Mode <br> Please go through <span style="color:#c00000;">SETUP GUIDE</span> to help you understand Manual Mode. Once saved it will dsable automatic mode! You may go back to Enable Automatic Mode if needed.</strong>
	</div></br></br>
	<?php
		$web_display		=	($web_content_settings==0)?"display:none;":"display:block;";
		$global_display		=	($global_distribution_settings==0)?"display:none;":"display:block;";
		$sponsor_display	=	($sponsored_content_settings==0)?"display:none;":"display:block;";
		$camp_display		=	($own_campaign_settings==0)?"display:none;":"display:block;";
		$web_color_auto		=	($web_content_settings==0)?"color:#469fa1;":"color:#c00000;";
		$web_color_manual	=	($web_content_settings==0)?"color:#c00000;":"color:#469fa1;";
		$global_color_auto		=	($global_distribution_settings==0)?"color:#469fa1;":"color:#c00000;";
		$global_color_manual	=	($global_distribution_settings==0)?"color:#c00000;":"color:#469fa1;";
		$sponsor_color_auto		=	($sponsored_content_settings==0)?"color:#469fa1;":"color:#c00000;";
		$sponsor_color_manual	=	($sponsored_content_settings==0)?"color:#c00000;":"color:#469fa1;";
		$camp_color_auto		=	($own_campaign_settings==0)?"color:#469fa1;":"color:#c00000;";
		$camp_color_manual	=	($own_campaign_settings==0)?"color:#c00000;":"color:#469fa1;";

		$settings = get_option(SPINKX_CONT_LICENSE);
		$settings = maybe_unserialize($settings);
		
		//echo $web_enable;
		$site_id = $settings['site_id'];
		$web_enable = (isset($web_enable))?$web_enable:1;
		$sponsor_enable = (isset($sponsor_enable))?$sponsor_enable:1;
		$auto_boost_post = (isset($auto_boost_post))?$auto_boost_post:1;
		$manual_boost_post = (isset($manual_boost_post))?$manual_boost_post:0;
		$global_post = (isset($global_post))?$global_post:1;
		if($auto_boost_post) {
			$manual_boost_post =0;
		}
	
	    ?>
		<table class="form-table" >
			<tr style="display:none">
				<td>
					<div class="onoffswitch" >
						<input type="checkbox" <?php if($site_id && $web_enable){ echo 'checked'; } ?> id="web_enable" name="web_enable" class="onoffswitch-checkbox">
						<label for="web_enable" class="onoffswitch-label">
							<span class="onoffswitch-inner"></span>
							<span class="onoffswitch-switch"></span>
						</label>
					</div>
					<strong>Local Post on Widget</strong>
					<!--<input type="hidden" name="web_enable" id="web_enable" value="<?php //echo $web_content_settings;?>"/>
					<a href="javascript:void(0);" style="<?php echo $web_color_auto;?>" id="website_content_auto"><strong>Automatic Settings</strong></a> | <a href="javascript:void(0);" style="<?php echo $web_color_manual;?>" id="website_content_manual"><strong>Manual Settings</strong></a> -->
				</td>
			</tr>
			<tr>
				<td>
					<div class="onoffswitch">
						<input type="checkbox" <?php if($site_id && $global_post){ echo 'checked'; }?> id="global_post" name="global_post" class="onoffswitch-checkbox">
						<label for="global_post" class="onoffswitch-label">
							<span class="onoffswitch-inner"></span>
							<span class="onoffswitch-switch"></span>
						</label>
					</div>
					<strong>Publisher posts on widget</strong><br/>
					<span class="global-allow2s">To earn point to boost your post</span>
					<!--<input type="hidden" name="web_enable" id="web_enable" value="<?php //echo $web_content_settings;?>"/>
					<a href="javascript:void(0);" style="<?php echo $web_color_auto;?>" id="website_content_auto"><strong>Automatic Settings</strong></a> | <a href="javascript:void(0);" style="<?php echo $web_color_manual;?>" id="website_content_manual"><strong>Manual Settings</strong></a> -->

					<table class="form-table global-allow">

					<tr>
						<td>
							<input type="checkbox" id="block_global_url_checkbox" name="block_global_url_checkbox" class="block_global_url_checkbox" style="width:0px !important;" <?php if( $block_global_url_checkbox == "on" ) { echo "checked"; }; ?> />

							<strong>Block URL, Keyword & Categories</strong>
						</td>

					</tr>
					<tr>
						<td>
							<div style="float: left;margin-left: 20px;">
							<p  style="margin-left:0px;">Enter Blocked URL's: seperate by " , "  </p>
							<!--<select name="global_blocked_url_textarea[]"  class="global_blocked_url_textarea" multiple="true"  ></select>-->
							<input type="text" id="global_blocked_url_textarea" name="global_blocked_url_textarea[]"  class="global_blocked_url_textarea" multiple="true" />
						</div>
						</td>
						<td>
						<div style="float: left;margin: 0 25px 0 25px;">
							<p  style="margin-left:0px;"> Enter Blocked keywords /tags: seperate by " , " </p>
							<!--<select name="global_blocked_keywords_textarea[]"  class="global_blocked_keywords_textarea" multiple="true"  ></select>-->
							<input type="text" id="global_blocked_keywords_textarea" name="global_blocked_keywords_textarea[]"  class="global_blocked_keywords_textarea" multiple="true" >
						</div>
						</td>
						<td><div>
							<p  style="margin-left:0px;"> Enter Blocked categories: Seperated by " , " </p>
							<select name="global_blocked_categories_textarea[]" id="global_blocked_categories_textarea" class="global_blocked_categories_textarea" multiple="true"  >

								<?php
								foreach($categories as $key=>$value)
								{
									echo '<option value="'.$key.'">'.$value.'</option>';
								}
								?>
							</select>
							</div>
						</td>
					</tr>
						<tr style="display: none">
							<td>
								<div class="onoffswitch">
									<input type="checkbox" <?php if($site_id && !$manual_boost_post){ echo 'checked="checked"'; }?> id="auto_boost_post" name="auto_boost_post" class="onoffswitch-checkbox">
									<label for="auto_boost_post" class="onoffswitch-label">
										<span class="onoffswitch-inner"></span>
										<span class="onoffswitch-switch"></span>
									</label>
								</div>
								<strong>Automatic post boost to get max click</strong>

								<!--<input type="hidden" name="sponso	r_enable" id="sponsor_enable" value="<?php //echo $sponsored_content_settings;?>"/>
				<a href="javascript:void(0);" style="<?php //echo $sponsor_color_auto;?>" id="Sponsored_content_auto"><strong>Automatic Settings</strong></a> | <a href="javascript:void(0);" style="<?php //echo $sponsor_color_manual;?>" id="Sponsored_content_manual"><strong>Manual Settings</strong></a> -->
							</td>
						</tr>
						<tr>
							<td>
								<div class="onoffswitch">
									<input type="checkbox" <?php if($site_id && $manual_boost_post){ echo 'checked="checked"'; }?> id="manual_boost_post" name="manual_boost_post" class="onoffswitch-checkbox">
									<label for="manual_boost_post" class="onoffswitch-label">
										<span class="onoffswitch-inner"></span>
										<span class="onoffswitch-switch"></span>
									</label>
								</div>
								<strong>Manual post boost</strong>

								<!--<input type="hidden" name="sponsor_enable" id="sponsor_enable" value="<?php //echo $sponsored_content_settings;?>"/>
				<a href="javascript:void(0);" style="<?php //echo $sponsor_color_auto;?>" id="Sponsored_content_auto"><strong>Automatic Settings</strong></a> | <a href="javascript:void(0);" style="<?php //echo $sponsor_color_manual;?>" id="Sponsored_content_manual"><strong>Manual Settings</strong></a> -->
							</td>
						</tr>
		</table>
				</td>
			</tr>

			<tr>

			</tr>
		<tr>
			<td>
				<div class="onoffswitch">
					<input type="checkbox" <?php if($site_id && $sponsor_enable){ echo 'checked="checked"'; }?> id="sponsor_enable" name="sponsor_enable" class="onoffswitch-checkbox">
					<label for="sponsor_enable" class="onoffswitch-label">
						<span class="onoffswitch-inner"></span>
						<span class="onoffswitch-switch"></span>
					</label>
				</div>
				<strong>Show Advertisements & Sponsored content on this Widget to Earn Revenue</strong>

				<!--<input type="hidden" name="sponsor_enable" id="sponsor_enable" value="<?php //echo $sponsored_content_settings;?>"/>
				<a href="javascript:void(0);" style="<?php //echo $sponsor_color_auto;?>" id="Sponsored_content_auto"><strong>Automatic Settings</strong></a> | <a href="javascript:void(0);" style="<?php //echo $sponsor_color_manual;?>" id="Sponsored_content_manual"><strong>Manual Settings</strong></a> -->
			</td>
		</tr>

	</table>
	<table>
		<tr>
			<td>
				<?php
				/********************** Include Preview Content ************************/
				require SPINKX_CONTENT_PLUGIN_DIR . 'assets/widgets/create/widget-submit-buttons.php';
				/********************** Include Preview Content ************************/
				?>
			</td>
		</tr>
	</table>
</div>
<!--Distribution Settings ends here -->
<script>
	jQuery(document).ready(function($){
		var gsite_id = '<?php echo $settings['site_id']?>';
		$('#manual_boost_post').on('change',function(){
			if($(this).prop("checked")) {
				$('#auto_boost_post').prop('checked', false);
			} else {
				$('#auto_boost_post').prop('checked', true);
			}
		});

		$('#auto_boost_post').on('change',function(){
			if($(this).prop("checked")) {
				$('#manual_boost_post').prop('checked', false);
			} else {
				$('#manual_boost_post').prop('checked', true);
			}
		});
		$('#global_post').on('change',function(){
			if($(this).prop("checked")) {
				$("table.global-allow").find("input,button,textarea,select").prop("disabled", false);
			} else {
				$("table.global-allow").find("input,button,textarea,select").prop("disabled", true);
			}
		});
		if(!gsite_id) {
			$("table.global-allow").find("input,button,textarea,select").attr("disabled", "disabled");
		} else {
			$('#global_post').trigger('change');
		}
	});
</script>
<?php
	/* Widget Fields Ends Here */
?>