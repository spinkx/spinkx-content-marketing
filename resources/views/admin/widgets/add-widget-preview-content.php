<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $path = SPINKX_CONTENT_ADMIN_VIEW_DIR;
	$display_above_img	=	$display_below_img	=	"display:none;";
	if($unit_add_line_style == 'aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right' )
		$display_above_img	=	"display:block;";
	elseif($unit_add_line_style == 'belowimg')
		$display_below_img	=	"display:block;";
	for($row = 1; $row <= 6; $row++) { ?>

<div id="preview_content_<?php echo $row?>" style="display: none;">
	<?php  $f = 'post_excerpt_'.$row; echo $$f;?>
</div>
<?php } ?>
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
		<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right' ) { echo "display: block;"; } else { echo "display: none;"; } ?>"><?php echo $post_title_1?></h4>
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg excerpt_content_1"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?> color:<?php echo $unit_excerpt_font_color; ?>; text-transform: <?php echo $unit_excerpt_font_case?>; font-weight: <?php echo $unit_excerpt_font_style?>;">
			<?php echo substr($post_excerpt_1,0,$unit_excerpt_word_limit).'...';?>
		</p>
		<div class="pre-img">
			<img src="<?php echo $prev_img_1?>" alt="" >
		</div>
		<div class="site_name" style="font-size: 10px;padding: 5px 3px;color: grey;display: block;line-height: normal; width:100%; <?php echo (!$unit_show_views)?'display:none':''?>"><span style="max-width:60%;float:left;margin:0;padding-left: 6px"><?php echo $site_name?></span><span style="float:right;padding-right:3px;"><i class="fa fa-eye" aria-hidden="true"></i><?php echo $post_views_1?></span></div>
		<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>"><?php echo $post_title_1?></h4>

		<!--<p class="pre-author">
			<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
		</p>-->
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg excerpt_content_1" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right'  ) { echo "display: block;"; } else { echo "display: none;"; } ?> color:<?php echo $unit_excerpt_font_color; ?>; text-transform: <?php echo $unit_excerpt_font_case?>; font-weight: <?php echo $unit_excerpt_font_style?>;">
			<?php echo substr($post_excerpt_1,0,$unit_excerpt_word_limit).'...';?>
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

				<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right'  ) { echo "display: block;"; } else { echo "display: none;"; } ?>"><?php echo $post_title_1?></h4>
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg excerpt_content_1"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?> color:<?php echo $unit_excerpt_font_color; ?>; text-transform: <?php echo $unit_excerpt_font_case?>;">
					<?php echo substr($post_excerpt_1,0,$unit_excerpt_word_limit).'...';?>
				</p>
				<div class="pre-img">
					<img src="<?php echo $prev_img_1?>" alt="" >
				</div>
				<div class="site_name" style="font-size: 10px;padding: 5px 3px;color: grey;display: block;line-height: normal; width:100%; <?php echo (!$unit_show_views)?'display:none':''?>"><span style="max-width:60%;float:left;margin:0;padding-left: 6px"><?php echo $site_name?></span><span style="float:right;padding-right:3px;"><i class="fa fa-eye" aria-hidden="true"></i><?php echo $post_views_1?></span></div>
				<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>"><?php echo $post_title_1?></h4>
				<!--<p class="pre-author">
					<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
				</p>-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg excerpt_content_1"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right' ) { echo "display: block;"; } else { echo "display: none;"; } ?> color:<?php echo $unit_excerpt_font_color; ?>; text-transform: <?php echo $unit_excerpt_font_case?>;">
					<?php echo substr($post_excerpt_1,0,$unit_excerpt_word_limit).'...';?>
				</p>
				<div class="site_name" style="font-size: 10px;padding: 5px 3px;color: grey;display: block;line-height: normal; width:100%; <?php echo (!$unit_show_views)?'display:none':''?>"><span style="max-width:60%;float:left;margin:0;padding-left: 6px"><?php echo $site_name?></span><span style="float:right;padding-right:3px;"><i class="fa fa-eye" aria-hidden="true"></i><?php echo $post_views_1?></span></div>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>
			</div>
<!------------------------------------End Fixed Width--------------------------------------------------------------->
		</div>
		<div id="tabsp-2" >
			<?php require "{$path}widgets/desktop-preview-content.php"; ?>
		</div>
		<div id="tabsp-3" >
		<!------------------------------------Start Masonry--------------------------------------------------------------->
		<div class="masonry-grid" style="background: <?php echo $unit_bg_color; ?>; <?php if ( $widget_layout_type=="masonry" ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">
			<div class="SPINKX_preview_fg grid-item grid-item--height mob_col"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_col_mob_view==1 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->
		<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right' ) { echo "display: block;"; } else { echo "display: none;"; } ?>"><?php echo $post_title_1?></h4>
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg excerpt_content_1"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?> color:<?php echo $unit_excerpt_font_color; ?>; text-transform: <?php echo $unit_excerpt_font_case?>; font-weight: <?php echo $unit_excerpt_font_style?>;"">
			<?php echo substr($post_excerpt_1,0,$unit_excerpt_word_limit).'...';?>
		</p>
		<div class="pre-img">
			<img src="<?php echo $prev_img_1?>" alt="" >
		</div>
		<div class="site_name" style="font-size: 10px;padding: 5px 3px;color: grey;display: block;line-height: normal; width:100%; <?php echo (!$unit_show_views)?'display:none':''?>"><span style="max-width:60%;float:left;margin:0;padding-left: 6px"><?php echo $site_name?></span><span style="float:right;padding-right:3px;"><i class="fa fa-eye" aria-hidden="true"></i><?php echo $post_views_1?></span></div>
		<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>"><?php echo $post_title_1?></h4>

		<!--<p class="pre-author">
			<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
		</p>-->
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg excerpt_content_1" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?> color:<?php echo $unit_excerpt_font_color; ?>; text-transform: <?php echo $unit_excerpt_font_case?>; font-weight: <?php echo $unit_excerpt_font_style?>;"">
			<?php echo substr($post_excerpt_1,0,$unit_excerpt_word_limit).'...';?>
		</p>
		<ul class="likes">
			<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
			<!--<li class="pull-right">Read more</li>-->
		</ul>
	</div>
			<div class="SPINKX_preview_fg mob_column grid-item grid-item--width2 grid-item--height"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_col_mob_view==2 ) { echo "display: block;"; } else { echo "display: none;"; } ?> ">		<!-- block Start -->
		<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>"><?php echo $post_title_1?></h4>
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg excerpt_content_1"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($post_excerpt_1,0,$unit_excerpt_word_limit).'...';?>
		</p>
		<div class="pre-img">
			<img src="<?php echo $prev_img_1?>" alt="" >
		</div>
		<div class="site_name" style="font-size: 10px;padding: 5px 3px;color: grey;display: block;line-height: normal; width:100%; <?php echo (!$unit_show_views)?'display:none':''?>"><span style="max-width:60%;float:left;margin:0;padding-left: 6px"><?php echo $site_name?></span><span style="float:right;padding-right:3px;"><i class="fa fa-eye" aria-hidden="true"></i><?php echo $post_views_1?></span></div>
		<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>"><?php echo $post_title_1?></h4>

		<!--<p class="pre-author">
			<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
		</p>-->
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg excerpt_content_1" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg'|| $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($post_excerpt_1,0,$unit_excerpt_word_limit).'...';?>
		</p>
		<ul class="likes">
			<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li>-->
			<!--<li class="pull-right">Read more</li>-->
		</ul>
	</div>
	<div class="SPINKX_preview_fg mob_column  grid-item grid-item--width2 grid-item--height"  style="width:<?php echo $img_crop_width;?>px;height:<?php echo $img_crop_height;?>px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px;<?php if ( $no_col_mob_view==2 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->
		<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>"><?php echo $post_title_2?></h4>
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg excerpt_content_2"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($post_excerpt_2,0,$unit_excerpt_word_limit).'...';?>
		</p>
		<div class="pre-img">
			<img src="<?php echo $prev_img_2?>" alt="" >
		</div>
		<div class="site_name" style="font-size: 10px;padding: 5px 3px;color: grey;display: block;line-height: normal; width:100%; <?php echo (!$unit_show_views)?'display:none':''?>"><span style="max-width:60%;float:left;margin:0;padding-left: 6px"><?php echo $site_name?></span><span style="float:right;padding-right:3px;"><i class="fa fa-eye" aria-hidden="true"></i><?php echo $post_views_2?></span></div>
		<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>"><?php echo $post_title_1?></h4>

		<!--<p class="pre-author">
		<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
		</p-->
		<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg excerpt_content_2" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
			<?php echo substr($post_excerpt_2,0,$unit_excerpt_word_limit).'...';?>
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
				<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right' ) { echo "display: block;"; } else { echo "display: none;"; } ?>"><?php echo $post_title_1?></h4>
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg excerpt_content_2"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($post_excerpt_1,0,$unit_excerpt_word_limit).'...';?>
				</p>
				<div class="pre-img">
					<img src="<?php echo $prev_img_1?>" alt="" >
				</div>
			<div class="site_name" style="font-size: 10px;padding: 5px 3px;color: grey;display: block;line-height: normal; width:100%; <?php echo (!$unit_show_views)?'display:none':''?>"><span style="max-width:60%;float:left;margin:0;padding-left: 6px"><?php echo $site_name?></span><span style="float:right;padding-right:3px;"><i class="fa fa-eye" aria-hidden="true"></i><?php echo $post_views_1?></span></div>
				<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>"><?php echo $post_title_1?></h4>
				<!--<p class="pre-author">
					<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg excerpt_content_2"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($post_excerpt_1,0,$unit_excerpt_word_limit).'...';?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>

			<div class="col-sm-5 col-md-5 mob_column SPINKX_preview_fg" style="overflow:auto;margin-bottom:8px;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;margin-right:<?php echo $unit_spacing; ?>px !important;margin-bottom:8px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px; <?php if ( $no_col_mob_view==2 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->

			<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>"><?php echo $post_title_1?></h4>

			<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg excerpt_content_1"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($post_excerpt_1,0,$unit_excerpt_word_limit).'...';?>
				</p>
				<div class="pre-img">
					<img src="<?php echo $prev_img_1?>" alt="" >
				</div>
				<div class="site_name" style="font-size: 10px;padding: 5px 3px;color: grey;display: block;line-height: normal; width:100%; <?php echo (!$unit_show_views)?'display:none':''?>"><span style="max-width:60%;float:left;margin:0;padding-left: 6px"><?php echo $site_name?></span><span style="float:right;padding-right:3px;"><i class="fa fa-eye" aria-hidden="true"></i><?php echo $post_views_1?></span></div>
				<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>"><?php echo $post_title_1?></h4>

				<!--<p class="pre-author">
					<img src="<?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg excerpt_content_1"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>">
					<?php echo substr($post_excerpt_1,0,$unit_excerpt_word_limit).'...';?>
				</p>
				<ul class="likes">
					<!--<li class="pull-left"><i class="fa fa-heart"></i>0 likes</li-->
					<!--<li class="pull-right">Read more</li>-->
				</ul>
			</div>

			<div class="col-sm-5 col-md-5 mob_column SPINKX_preview_fg"  style="overflow:auto;width:<?php echo $img_crop_width;?>px !important;height:<?php echo $img_crop_height;?>px;background: <?php echo $unit_fg_color; ?>; border-width: <?php echo $unit_border_width; ?>px; border-style: <?php echo $unit_border_style; ?>; border-color:<?php echo $unit_border_color; ?>; border-radius:<?php echo $unit_border_radius; ?>px; <?php if ( $no_col_mob_view==2 ) { echo "display: block;"; } else { echo "display: none;"; } ?>">		<!-- block Start -->
			<h4 class="pre-title SPINKX_preview_title_h3 divider_above_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='aboveimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?>"><?php echo $post_title_2?></h4>
			<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_aboveimg excerpt_content_2"  id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='aboveimg' ) { echo "display: block;"; } else { echo "display: none;"; } ?> color:<?php echo $unit_excerpt_font_color; ?>;">
					<?php echo substr($post_excerpt_2,0,$unit_excerpt_word_limit).'...';?>
				</p>
				<div class="pre-img">
					<img src="<?php echo $prev_img_2?>" alt="" >
				</div>
				<div class="site_name" style="font-size: 10px;padding: 5px 3px;color: grey;display: block;line-height: normal; width:100%; <?php echo (!$unit_show_views)?'display:none':''?>"><span style="max-width:60%;float:left;margin:0;padding-left: 6px"><?php echo $site_name?></span><span style="float:right;padding-right:3px;"><i class="fa fa-eye" aria-hidden="true"></i><?php echo $post_views_2?></span></div>
				<h4 class="pre-title SPINKX_preview_title_h3 divider_below_img" style="font-size: <?php  echo $unit_title_font_size;?>px; line-height: <?php  echo $unit_title_line_height;?>px; font-weight: <?php echo $unit_title_font_style; ?>; color: <?php echo $unit_title_font_color; ?>; font-family: <?php echo $unit_title_font_family;?> text-transform: <?php echo $unit_title_font_case;?>;<?php if ( $unit_add_line_style=='belowimg' || !$unit_add_line_style ) { echo "display: block;"; } else { echo "display: none;"; } ?>"><?php echo $post_title_2?></h4>

				<!--<p class="pre-author">
					<img src="<-?php echo SPINKX_CONTENT_PLUGIN_URL; ?>/assets/images/auth-img.png" width="15px" height="15px" class="auth_img" alt="Author">BW Author <i class="fa fa-user"></i> &nbsp; <i class="fa fa-envelope"></i> &nbsp; <i class="fa fa-files-o"></i> &nbsp; December 30,2015, Wellness, Life &nbsp; <i class="fa fa-comments"></i>0
				</p-->
				<p class="pre-desc alter excerpt_content SPINKX_preview_content excerpt_belowimg excerpt_content_2" id="content" style="font-size: <?php echo $unit_excerpt_font_size; ?>px; line-height: <?php echo $unit_excerpt_line_height; ?>px;<?php if ( $unit_excerpt_line_style=='belowimg' || $unit_add_line_style=='left' || $unit_add_line_style=='right') { echo "display: block;"; } else { echo "display: none;"; } ?> color:<?php echo $unit_excerpt_font_color; ?>;">
					<?php echo substr($post_excerpt_2,0,$unit_excerpt_word_limit).'...';?>
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

