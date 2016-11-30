<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	$display_above_img	=	$display_below_img	=	"display:none;";
	if($unit_add_line_style == 'aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right' )
		$display_above_img	=	"display:block;";
	elseif($unit_add_line_style == 'belowimg')
		$display_below_img	=	"display:block;";

	?>
<div id="preview_content" style="display: none;">
	<?php echo $im_my_post_content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. sunt in culpa qui officia deserunt mollit anim id est laborum."; ?>
</div>
<div id="tabsp">
	<ul>
		<li><a href="#tabsp-1">Unit Preview</a></li>
		<li><a href="#tabsp-2">Desktop Preview</a></li>
		<li><a href="#tabsp-3">Mobile Preview</a></li>
	</ul>
	<div class="tabs-content SPINKX_preview_bg" style="background: <?php echo $unit_bg_color; ?>;">
		<div id="tabsp-1" >
		<!------------------------------------Start Masonry--------------------------------------------------------------->
		<div class="masonry-grid" style="background: <?php echo $unit_bg_color; ?>; <?php if ( $widget_layout_type=="masonry" ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">

	<div class="SPINKX_preview_fg grid-item grid-item--height"  style="width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;margin-right:<?php echo $unit_spacing; ?>;margin-bottom:8px;">		<!-- block Start -->
		<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<div class="pre-img">
			<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/spinkx-intro-bg.jpg" alt="" >
		</div>
		<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>

		<!--<p class="pre-author">
			<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
		</p>-->
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right'  ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<ul class="likes">
			<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
			<!--<li class="pull-right">Read more</li>-->
		</ul>
	</div>
	</div>
	<!------------------------------------End masonry--------------------------------------------------------------->
		<!------------------------------------Start Fixed Width--------------------------------------------------------------->

			<div class="fixed-grid" style="background: <?php echo $unit_bg_color; ?>; <?php if ( $widget_layout_type=="fixed-width" ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">
			<div class="col-sm-12 col-md-12 SPINKX_preview_fg"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;margin-right:<?php echo $unit_spacing; ?>;margin-bottom:8px;">		<!-- block Start -->

				<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right'  ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<div class="pre-img">
					<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/spinkx-intro-bg.jpg" alt="" >
				</div>

				<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
				<!--<p class="pre-author">
					<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
				</p>-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			</div>
<!------------------------------------End Fixed Width--------------------------------------------------------------->
		</div>
		<div id="tabsp-2" >
			<?php require SPINKX_CONTENT_PLUGIN_DIR . 'assets/widgets/create/desktop-preview-content.php'; ?>
		</div>
		<div id="tabsp-3" >
		<!------------------------------------Start Masonry--------------------------------------------------------------->
		<div class="masonry-grid" style="background: <?php echo $unit_bg_color; ?>; <?php if ( $widget_layout_type=="masonry" ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">
			<div class="SPINKX_preview_fg grid-item grid-item--height mob_col"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_col_mob_view==1 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->
		<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<div class="pre-img">
			<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/spinkx-intro-bg.jpg" alt="" >
		</div>
		<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>

		<!--<p class="pre-author">
			<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
		</p>-->
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<ul class="likes">
			<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
			<!--<li class="pull-right">Read more</li>-->
		</ul>
	</div>
			<div class="SPINKX_preview_fg mob_column grid-item grid-item--width2 grid-item--height"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_col_mob_view==2 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
		<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<div class="pre-img">
			<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/spinkx-intro-bg.jpg" alt="" >
		</div>
		<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>

		<!--<p class="pre-author">
			<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
		</p>-->
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg'|| $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<ul class="likes">
			<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
			<!--<li class="pull-right">Read more</li>-->
		</ul>
	</div>
	<div class="SPINKX_preview_fg mob_column  grid-item grid-item--width2 grid-item--height"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_col_mob_view==2 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->
		<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<div class="pre-img">
			<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/bloggers-make-money.jpg" alt="" >
		</div>
		<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>

		<!--<p class="pre-author">
		<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
		</p-->
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<ul class="likes">
			<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li-->
			<!--<li class="pull-right">Read more</li>-->
		</ul>
	</div>
		</div>
	<!------------------------------------End masonry--------------------------------------------------------------->
		<!------------------------------------Start Fixed Width--------------------------------------------------------------->

			<div class="fixed-grid" style="background: <?php echo $unit_bg_color; ?>; <?php if ( $widget_layout_type=="fixed-width" ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">
		<div class="col-sm-12 col-md-12 mob_col SPINKX_preview_fg" style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px; <?php if ( $no_col_mob_view==1 ) { echo "display: block;"; } else { echo "display: none;"; } ?>" >		<!-- block Start -->
				<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<div class="pre-img">
					<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/spinkx-intro-bg.jpg" alt="" >
				</div>
				<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
				<!--<p class="pre-author">
					<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>

			<div class="col-sm-5 col-md-5 mob_column SPINKX_preview_fg" style="overflow:auto;margin-bottom:8px;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px; <?php if ( $no_col_mob_view==2 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->

			<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>

			<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<div class="pre-img">
					<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/spinkx-intro-bg.jpg" alt="" >
				</div>
				<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>

				<!--<p class="pre-author">
					<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>

			<div class="col-sm-5 col-md-5 mob_column SPINKX_preview_fg"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px; <?php if ( $no_col_mob_view==2 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->
			<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
			<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<div class="pre-img">
					<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/bloggers-make-money.jpg" alt="" >
				</div>
				<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>

				<!--<p class="pre-author">
					<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			</div>
			
<!------------------------------------End Fixed Width--------------------------------------------------------------->
		</div>
	</div>
</div>		<!-- tabsp end -->

