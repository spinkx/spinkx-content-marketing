<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	function spinkx_cont_save_widget_position() {
		global $wpdb;
		/************************* Constants Defined Here *************************/
		$add_shortcode = $reserve_key = spnxHelper::getFilterVar( 'add_shortcode', INPUT_POST);;
		$data = $reserve_data = array();
		$blog_id = get_current_blog_id();
		$section = spnxHelper::getFilterVar( 'wp_section', INPUT_POST);;
		$wp_section = $section;

		if ($add_shortcode) {
			$data['shortcode'] = $add_shortcode;

			#post section save
			if ($wp_section == 'Top Of Post' || $wp_section == 'Bottom Of Post') {
				$data['where'] = $wp_section;
				$key = 'addBA_content_post';
				if (is_multisite()) {
					update_blog_option($blog_id, $key, $data);
				} else {
					update_option($key, $data);
				}
				$reserve_data['wp_section'] = $wp_section;
				//$reserve_data['wp_section_where'] = $wp_where;
			} else {
				$key = 'addBA_content_post';
				if (is_multisite()) {
					update_blog_option($blog_id, $key, '');
				} else {
					update_option($key, '');
				}
			}

			#comment section save
			if ($wp_section == 'Top Of Comment' || $wp_section == 'Bottom Of Comment') {
				$data['where'] = $wp_section;
				$key = 'addBA_content_comment';
				if (is_multisite()) {
					update_blog_option($blog_id, $key, $data);
				} else {
					update_option($key, $data);
				}
				$reserve_data['wp_section'] = $wp_section;
				//$reserve_data['wp_section_where'] = $wp_where;
			} else {
				$key = 'addBA_content_comment';
				if (is_multisite()) {
					update_blog_option($blog_id, $key, '');
				} else {
					update_option($key, '');
				}
			}

			#sidebar section save
			if ($wp_section == 'Sidebar') {
				$data['where'] = '';
				$key = 'addBA_content_sidebar';
				if (is_multisite()) {
					update_blog_option($blog_id, $key, $data);
				} else {
					update_option($key, $data);
				}
				$reserve_data['wp_section'] = $wp_section;
				//$reserve_data['wp_section_where'] = '';
			} else {
				$key = 'addBA_content_sidebar';
				if (is_multisite()) {
					update_blog_option($blog_id, $key, '');
				} else {
					update_option($key, '');
				}
			}

			#save some data to show user
			if (is_multisite()) {
				update_blog_option($blog_id, $reserve_key, $reserve_data);
			} else {
				update_option($reserve_key, $reserve_data);
			}
		} else {
			echo "save";
		}
		wp_die();
	}
