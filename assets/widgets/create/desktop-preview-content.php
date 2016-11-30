<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="masonry-grid" style="background: <?php echo $unit_bg_color; ?>; <?php if ( $widget_layout_type=="masonry" ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">

	<!------------------------------------Start no_of_columns=1--------------------------------------------------------------->
	<div class="SPINKX_preview_fg dskpre_col1 grid-item grid-item--height"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==1 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<ul class="likes">
			<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
			<!--<li class="pull-right">Read more</li>-->
		</ul>
	</div>

	<!------------------------------------End no_of_columns=1--------------------------------------------------------------->
	<!------------------------------------Start no_of_columns=2--------------------------------------------------------------->
	<div class="SPINKX_preview_fg dskpre_col2 grid-item grid-item--width2 grid-item--height"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==2 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<ul class="likes">
			<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
			<!--<li class="pull-right">Read more</li>-->
		</ul>
	</div>
	<div class="SPINKX_preview_fg dskpre_col2 grid-item grid-item--width2 grid-item--height"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==2 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->
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
		</p>-->
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<ul class="likes">
			<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
			<!--<li class="pull-right">Read more</li>-->
		</ul>
	</div>
	<!------------------------------------End no_of_columns=2--------------------------------------------------------------->
	<!------------------------------------Start no_of_columns=3--------------------------------------------------------------->
	<div class="SPINKX_preview_fg dskpre_col3 grid-item grid-item--width3 grid-item--height"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==3 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
	<div class="SPINKX_preview_fg dskpre_col3 grid-item grid-item--width3 grid-item--height"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==3 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->
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
		</p>-->
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<ul class="likes">
			<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
			<!--<li class="pull-right">Read more</li>-->
		</ul>
	</div>
	<div class="SPINKX_preview_fg dskpre_col3 grid-item grid-item--width3 grid-item--height"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==3 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
		<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<div class="pre-img">
			<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/wordpress-content-marketing-plugin.jpg" alt="" >
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
	<!------------------------------------End no_of_columns=3--------------------------------------------------------------->
	<!------------------------------------Start no_of_columns=4--------------------------------------------------------------->
	<div class="SPINKX_preview_fg dskpre_col4 grid-item grid-item--width4 grid-item--height"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==4 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
		</p>-->
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
		<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<ul class="likes">
			<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li-->
			<!--<li class="pull-right">Read more</li>-->
		</ul>
	</div>
	<div class="grid-item--width4 grid-item--height SPINKX_preview_fg dskpre_col4 grid-item"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==4 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->
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
	<div class="grid-item--width4 grid-item--height SPINKX_preview_fg dskpre_col4 grid-item"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==4 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
		<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
		<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<div class="pre-img">
		<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/wordpress-content-marketing-plugin.jpg" alt="" >
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
	<div class="grid-item--width4 grid-item--height SPINKX_preview_fg dskpre_col4 grid-item"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==4 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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


	<!------------------------------------End no_of_columns=4--------------------------------------------------------------->
	<!------------------------------------Start no_of_columns=5--------------------------------------------------------------->
	<div class="grid-item--width5 grid-item--height  SPINKX_preview_fg dskpre_col5 grid-item"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==5 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
		</p-->
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
		<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<ul class="likes">
		<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li-->
		<!--<li class="pull-right">Read more</li>-->
		</ul>
	</div>
	<div class="grid-item--width5 grid-item--height  SPINKX_preview_fg dskpre_col5 grid-item"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==5 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->
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
	<div class="grid-item--width5 grid-item--height  SPINKX_preview_fg dskpre_col5 grid-item"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==5 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
		<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
		<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<div class="pre-img">
		<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/wordpress-content-marketing-plugin.jpg" alt="" >
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
	<div class="grid-item--width5 grid-item--height  SPINKX_preview_fg dskpre_col5 grid-item"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==5 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
		<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
		<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<div class="pre-img">
		<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/bloggers-make-money.jpg" alt="" >
		</div>
		<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>

	<!--	<p class="pre-author">
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
	<div class="grid-item--width5 grid-item--height SPINKX_preview_fg dskpre_col5 grid-item"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==5 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
		</p-->
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
		<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<ul class="likes">
		<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li-->
		<!--<li class="pull-right">Read more</li>-->
		</ul>
	</div>

	<!------------------------------------End no_of_columns=5--------------------------------------------------------------->
	<!------------------------------------Start no_of_columns=6--------------------------------------------------------------->
	<div class="grid-item--width6 grid-item--height  SPINKX_preview_fg dskpre_col6 grid-item"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==6 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
		<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg') { echo "display: block;"; } else { echo "display: none;"; } ?>">
		<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<div class="pre-img">
		<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/spinkx-intro-bg.jpg" alt="" >
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
	<div class="grid-item--width6 grid-item--height  SPINKX_preview_fg dskpre_col6 grid-item"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==6 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->
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
	<div class="grid-item--width6 grid-item--height  SPINKX_preview_fg dskpre_col6 grid-item"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==6 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
		<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
		<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<div class="pre-img">
		<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/wordpress-content-marketing-plugin.jpg" alt="" >
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
	<div class="grid-item--width6 grid-item--height  SPINKX_preview_fg dskpre_col6 grid-item"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==6 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
		<!--	<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li-->
			<!--<li class="pull-right">Read more</li>-->
		</ul>
	</div>
	<div class="grid-item--width6 grid-item--height  SPINKX_preview_fg dskpre_col6 grid-item"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==6 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
		</p-->
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<ul class="likes">
			<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li-->
			<!--<li class="pull-right">Read more</li>-->
		</ul>
	</div>
	<div class="grid-item--width6 grid-item--height SPINKX_preview_fg dskpre_col6 grid-item"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_of_columns==6 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
		<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
		</p>
		<div class="pre-img">
			<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/wordpress-content-marketing-plugin.jpg" alt="" >
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
	<!------------------------------------End no_of_columns=6--------------------------------------------------------------->
</div>
<!------------------------------------End Masonary--------------------------------------------------------------->

<!------------------------------------Start Fixed Width--------------------------------------------------------------->

<div class="fixed-grid" style="background: <?php echo $unit_bg_color; ?>; <?php if ( $widget_layout_type=="fixed-width" ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">
<!------------------------------------Start no_of_columns=1--------------------------------------------------------------->
<div class="col-sm-12 col-md-12  SPINKX_preview_fg dskpre_col1"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>!important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==1 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
			<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
			<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<div class="pre-img">
					<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/spinkx-intro-bg.jpg" alt="">
				</div>
				<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>

				<!--<p class="pre-author">
					<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>

<!------------------------------------End no_of_columns=1--------------------------------------------------------------->
<!------------------------------------Start no_of_columns=2--------------------------------------------------------------->
<div class="col-sm-5 col-md-5  SPINKX_preview_fg dskpre_col2"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==2 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			<div class="col-sm-5 col-md-5  SPINKX_preview_fg dskpre_col2"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==2 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->
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
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
<!------------------------------------End no_of_columns=2--------------------------------------------------------------->
<!------------------------------------Start no_of_columns=3--------------------------------------------------------------->
<div class="col-sm-3 col-md-3  SPINKX_preview_fg dskpre_col3 dskprefix_col3"  style="width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==3 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			<div class="col-sm-3 col-md-3  SPINKX_preview_fg dskpre_col3 dskprefix_col3"  style="width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==3 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->
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
				<!--	<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			<div class="col-sm-3 col-md-3  SPINKX_preview_fg dskpre_col3 dskprefix_col3"  style="width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right: <?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==3 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
			<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
			<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<div class="pre-img">
					<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/wordpress-content-marketing-plugin.jpg" alt="" >
				</div>
				<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>

				<!--<p class="pre-author">
					<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
<!------------------------------------End no_of_columns=3--------------------------------------------------------------->
<!------------------------------------Start no_of_columns=4--------------------------------------------------------------->
<div class="col-sm-2 col-md-2  SPINKX_preview_fg dskpre_col4"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right: <?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==4 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			<div class="col-sm-2 col-md-2  SPINKX_preview_fg dskpre_col4"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right: <?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==4 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->
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
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			<div class="col-sm-2 col-md-2  SPINKX_preview_fg dskpre_col4"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right: <?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==4 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
			<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
			<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<div class="pre-img">
					<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/wordpress-content-marketing-plugin.jpg" alt="" >
				</div>
				<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>

				<!--<p class="pre-author">
					<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			<div class="col-sm-2 col-md-2  SPINKX_preview_fg dskpre_col4"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==4 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
				<!--	<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>


<!------------------------------------End no_of_columns=4--------------------------------------------------------------->
<!------------------------------------Start no_of_columns=5--------------------------------------------------------------->
<div class="col-sm-3 col-md-3  SPINKX_preview_fg dskpre_col5"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right: <?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==5 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<ul class="likes">
				<!--	<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			<div class="col-sm-3 col-md-3  SPINKX_preview_fg dskpre_col5"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right: <?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==5 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->
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
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			<div class="col-sm-3 col-md-3  SPINKX_preview_fg dskpre_col5"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right: <?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==5 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
			<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
			<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<div class="pre-img">
					<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/wordpress-content-marketing-plugin.jpg" alt="" >
				</div>
				<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>

				<!--<p class="pre-author">
					<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			<div class="col-sm-4 col-md-4  SPINKX_preview_fg dskpre_col5"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==5 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			<div class="col-sm-4 col-md-4  SPINKX_preview_fg dskpre_col5"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==5 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>

<!------------------------------------End no_of_columns=5--------------------------------------------------------------->
<!------------------------------------Start no_of_columns=6--------------------------------------------------------------->
<div class="col-sm-3 col-md-3  SPINKX_preview_fg dskpre_col6"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==6 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			<div class="col-sm-3 col-md-3  SPINKX_preview_fg dskpre_col6"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right: <?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==6 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->
			<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
			<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<div class="pre-img">
					<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/bloggers-make-money.jpg" alt="" >
				</div>
				<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>

			<!--	<p class="pre-author">
					<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			<div class="col-sm-3 col-md-3  SPINKX_preview_fg dskpre_col6"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right: <?php echo $unit_spacing; ?>px !important;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==6 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
			<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
			<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<div class="pre-img">
					<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/wordpress-content-marketing-plugin.jpg" alt="" >
				</div>
				<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>

				<!--<p class="pre-author">
					<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			<div class="col-sm-3 col-md-3  SPINKX_preview_fg dskpre_col6"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==6 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			<div class="col-sm-3 col-md-3  SPINKX_preview_fg dskpre_col6"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right: <?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==6 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
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
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			<div class="col-sm-3 col-md-3  SPINKX_preview_fg dskpre_col6"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px !important; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px !important;<?php if ( $no_of_columns==6 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
			<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>
			<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($im_my_post_content,0,$unit_excerpt_word_limit);?>
				</p>
				<div class="pre-img">
					<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/wordpress-content-marketing-plugin.jpg" alt="" >
				</div>
				<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>">It takes half your life before you discover life is a do-it-yourself project.</h4>

			<!--	<p class="pre-author">
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
<!------------------------------------End no_of_columns=6--------------------------------------------------------------->
</div>
<!------------------------------------End Fixed Width--------------------------------------------------------------->
