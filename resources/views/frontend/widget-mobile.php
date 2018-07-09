<?php
$spnxAdminManage = new spnxAdminManage;
//$settings = get_option(SPINKX_CONTENT_LICENSE);
//$settings = maybe_unserialize($settings);
$widget_list = get_option('spnx_widget_list');
$widget_list = maybe_unserialize($widget_list);
$settings_array = '';
if(is_array($widget_list) && count($widget_list)) {
	foreach ($widget_list as $widget) {
		if ($widget['widget_id'] == $widget_id) {
			$settings_array = $widget;
			break;
		}
	}
}
$display_layout_type = 'masonry';
$display_col_count = 3;
$disp_unit_bg_color = 'rgba(255,255,255, 0.9)';
$al_brnd_styles = ' clear: both; ';
if ( is_array($settings_array) ) {
	if ( isset( $settings_array['widget_layout_type'] ) ) {
		$display_layout_type = $settings_array['widget_layout_type'];
	}
	if ( isset( $settings_array['no_of_columns'] ) ) {
		$display_col_count = $settings_array['no_of_columns'];
	}
	if ( isset( $settings_array['unit_bg_color'] ) ) {
		$al_brnd_styles = ' background-color: ' . $disp_unit_bg_color . '; clear: both; ';
	} else {
		$al_brnd_styles = ' display:  clear: both; ';
	}
	$al_brnd_styles = ' clear: both; position: relative;padding-top:8px;z-index:999997;';
};
$al_brnd_content_opacity = null;
$al_brnd_content_opacity = ';'; 
$content_id = 'id="al_brnd_content_mobile"';
$data_column = '';
if ($display_layout_type == 'masonry') {
	$data_column = 'data-column="' . $display_col_count . '" ';
} else {
	$data_column = 'data-column="1" ';
}
$shortcode_output .= '<div class="middle-div"></div><div style="' . $al_brnd_styles . $al_brnd_content_opacity . '" ' . $content_id . ' data-role="collapsible" class="al_brnd_content al_brnd_content_' . $widget_id . ' display-units-' . $display_col_count . ' " wid="' . $widget_id . '" > <ul class="waterfall" id="spnxads-waterfall-'.$widget_id.'" ' . $data_column . ' >';
$shortcode_output .= '</ul></div> <div style="clear:both;"></div>';
return $shortcode_output;


