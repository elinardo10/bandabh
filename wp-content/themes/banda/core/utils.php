<?php

/*
	UTILITIES FUNCTIONS
*/
function LUCILLE_SWP_getIDFromShortURL($short_url) 
{
	@$elements = explode("/", $short_url);
	@$dim = count($elements); 
	
	if ($dim == 0) {
		return "";
	} else {
		return $elements[ $dim - 1];
	}
}

function LUCILLE_SWP_get_tax_name_by_post_type($post_type) {
	switch($post_type) {
		case "js_albums":
			return 'album_category';
		case 'js_events':
			return 'event_category';
		case 'js_photo_albums':
			return 'photo_album_category';
		case 'js_videos':
			return 'video_category';
		default:
			return 'category';
	}
}

function LUCILLE_SWP_get_tax_name_by_page_template($page_template) {
	switch ($page_template) {
		case 'template-events-past.php':
		case 'template-events-upcoming.php':
		case 'template-events-all.php':
			return LUCILLE_SWP_get_tax_name_by_post_type('js_events');
		case 'template-photo-gallery.php':
			return LUCILLE_SWP_get_tax_name_by_post_type('js_photo_albums');
		default:
			return 'category';
	}
}


function LUCILLE_SWP_emphasize_title_for_this_page() {
	$templates_to_match = array(
		'template-events-all.php',
		'template-events-past.php',
		'template-events-upcoming.php',
		'template-photo-gallery.php',
		'template-blog.php',
		'template-videos.php',
		'template-discography.php'
	);

	if (is_page_template($templates_to_match)) {
		return true;
	}

	return false;
}

function LUCILLE_SWP_get_translated_month($english_month_name) {

	switch (strtolower($english_month_name)) {
	    case "january":
			return esc_html__("january", "lucille");
	    case "february":
			return esc_html__("february", "lucille");
	    case "march":
			return esc_html__("march", "lucille");
	    case "april":
			return esc_html__("april", "lucille");
	    case "may":
			return esc_html__("may", "lucille");
	    case "june":
			return esc_html__("june", "lucille");
	    case "july":
			return esc_html__("july", "lucille");
	    case "august":
			return esc_html__("august", "lucille");
	    case "september":
			return esc_html__("september", "lucille");
	    case "october":
			return esc_html__("october", "lucille");
	    case "november":
			return esc_html__("november", "lucille");
	    case "december":
			return esc_html__("december", "lucille");
	}

	return $english_month_name;
}

function LUCILLE_SWP_is_sharing_visible() {
	/*always disable sharing for some pages*/
	if (function_exists("is_checkout")) {
		if (is_checkout() || is_cart()) {
			return false;
		}
	}

	return LUCILLE_SWP_show_sharing_icons_by_setting();
}

function LUCILLE_SWP_is_woocommerce_active()
{
	if (class_exists('woocommerce')) {
		return true;
	}

	return false;
}

function LUCILLE_SWP_is_woocommerce_special_page() {
	if (function_exists("is_shop")) {
		if (is_shop()) {
			return true;
		}
	}
	if (function_exists("is_product")) {
		if (is_product()) {
			return true;
		}
	}
	if (function_exists("is_cart")) {
		if (is_cart()) {
			return true;
		}
	}

	return false;
}

?>