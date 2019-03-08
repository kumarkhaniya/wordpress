<?php


if ( ! defined( 'ABSPATH' ) ) {
	include( "../../../wp-blog-header.php" );
}

include_once( "categories.php" );

require_once dirname( __FILE__ ) . '/class.mobiloud-app-preview.php';
include_once dirname( __FILE__ ) . '/subscriptions/functions.php';

$return_config                                 = array();
$return_config['app_name']                     = get_option( 'ml_app_name', '' );
$return_config["enable_featured_images"]       = get_option( 'ml_show_article_featuredimage', true );
$return_config["enable_dates"]                 = get_option( 'ml_article_list_enable_dates', true );
$return_config['show-android-cat-tabs']        = get_option( 'ml_show_android_cat_tabs', false );
$return_config['google-tracking-id']           = get_option( 'ml_google_tracking_id', '' );
$return_config['facebook_appid']               = get_option( 'ml_fb_app_id', '' );
$return_config['quantcast_api_key']            = get_option( 'ml_qm_api_key', '' );
$return_config['comscore_c2']                  = get_option( 'ml_comscore_c2', '' );
$return_config['comscore_secret']              = get_option( 'ml_comscore_secret', '' );
$return_config['show_custom_field']            = get_option( 'ml_custom_field_enable', false );
$return_config['show_excerpts']                = get_option( 'ml_article_list_show_excerpt', false );
$return_config['show_comments_count']          = get_option( 'ml_article_list_show_comment_count', false );
$return_config['copyright_string']             = html_entity_decode( get_option( 'ml_copyright_string', '' ) );
$return_config['list_format']                  = get_option( 'ml_article_list_view_type', 'extended' );
$return_config['comments_system']              = get_option( 'ml_comments_system', 'wordpress' );
$return_config['disqus_shortname']             = get_option( 'ml_disqus_shortname', '' );
$return_config['show_contact_email']           = get_option( 'ml_show_email_contact_link', false );
$return_config['contact_email']                = get_option( 'ml_contact_link_email', '' );
$return_config['timezone']                     = strval( get_option( 'gmt_offset' ) );
$return_config['datetype']                     = get_option( 'ml_datetype', 'prettydate' );
$return_config['dateformat']                   = get_option( 'ml_dateformat', 'F j, Y' );
$return_config['original_size_image_list']     = get_option( 'ml_original_size_image_list', true );
$return_config['original_size_featured_image'] = get_option( 'ml_original_size_featured_image', true );

$return_config['custom_featured_image'] = get_option( 'ml_custom_featured_image', '' );

if ( (get_option( "ml_home_article_list_enabled", false ) == true)
|| (get_option( "ml_home_page_enabled", false ) == true) && !(get_option( "ml_home_page_id", false )) // also show if "Page contents" is active, but no page selected
|| (get_option( "ml_home_url_enabled", false ) == true) && !(get_option( "ml_home_url", false )) ) { // or "URL" is active, but empty
	$return_config["home_page_type"] = "article_list";
} else if ( get_option( "ml_home_page_enabled", false ) == true ) {

	$return_config["home_page_type"] = "page";
	$return_config["home_page_id"]   = get_option( "ml_home_page_id" );
	$return_config["home_page_full"] = get_option( "ml_home_page_full" );

	$return_config["show_article_list_menu_item"]  = get_option( "ml_show_article_list_menu_item", false );
	$return_config["article_list_menu_item_title"] = get_option( "ml_article_list_menu_item_title", "Articles" );


} else if ( get_option( "ml_home_url_enabled", false ) == true ) {
	$return_config["home_page_type"] = "url";
	$return_config["home_page_url"]  = get_option( "ml_home_url" );

	$return_config["show_article_list_menu_item"]  = get_option( "ml_show_article_list_menu_item", true );
	$return_config["article_list_menu_item_title"] = get_option( "ml_article_list_menu_item_title", "Articles" );

}

//advertising
$return_config['privacy_policy_url'] = Mobiloud::get_option( 'ml_privacy_policy_url' );
$return_config['advertising_platform'] = Mobiloud::get_option( 'ml_advertising_platform' );

$return_config['ios_admob_app_id']               = Mobiloud::get_option( 'ml_ios_admob_app_id' );
$return_config['ios_phone_banner_unit_id']       = Mobiloud::get_option( 'ml_ios_phone_banner_unit_id' );
$return_config['ios_tablet_banner_unit_id']      = Mobiloud::get_option( 'ml_ios_tablet_banner_unit_id' );
$return_config['ios_banner_position']            = Mobiloud::get_option( 'ml_ios_banner_position' );
$return_config['ios_interstitial_unit_id']       = Mobiloud::get_option( 'ml_ios_interstitial_unit_id' );
$return_config['ios_interstitial_interval']      = Mobiloud::get_option( 'ml_ios_interstitial_interval' );
$return_config['ios_native_ad_unit_id']          = Mobiloud::get_option( 'ml_ios_native_ad_unit_id' );
$return_config['ios_native_ad_interval']         = Mobiloud::get_option( 'ml_ios_native_ad_interval' );
$return_config['ios_native_ad_type']             = Mobiloud::get_option( 'ml_ios_native_ad_type', 'medium' );
$return_config['ios_native_ad_article_unit_id']  = Mobiloud::get_option( 'ml_ios_native_ad_article_unit_id' );
$return_config['ios_native_ad_article_position'] = Mobiloud::get_option( 'ml_ios_native_ad_article_position', 'both' );
$return_config['ios_native_ad_article_type']     = Mobiloud::get_option( 'ml_ios_native_ad_article_type', 'medium' );

$return_config['android_admob_app_id']               = Mobiloud::get_option( 'ml_android_admob_app_id' );
$return_config['android_phone_banner_unit_id']       = Mobiloud::get_option( 'ml_android_phone_banner_unit_id' );
$return_config['android_tablet_banner_unit_id']      = Mobiloud::get_option( 'ml_android_tablet_banner_unit_id' );
$return_config['android_banner_position']            = Mobiloud::get_option( 'ml_android_banner_position' );
$return_config['android_interstitial_unit_id']       = Mobiloud::get_option( 'ml_android_interstitial_unit_id' );
$return_config['android_interstitial_interval']      = Mobiloud::get_option( 'ml_android_interstitial_interval' );
$return_config['android_native_ad_unit_id']          = Mobiloud::get_option( 'ml_android_native_ad_unit_id' );
$return_config['android_native_ad_interval']         = Mobiloud::get_option( 'ml_android_native_ad_interval' );
$return_config['android_native_ad_type']             = Mobiloud::get_option( 'ml_android_native_ad_type', 'medium' );
$return_config['android_native_ad_article_unit_id']  = Mobiloud::get_option( 'ml_android_native_ad_article_unit_id' );
$return_config['android_native_ad_article_position'] = Mobiloud::get_option( 'ml_android_native_ad_article_position', 'both' );
$return_config['android_native_ad_article_type']     = Mobiloud::get_option( 'ml_android_native_ad_article_type', 'medium' );

$return_config["enable_hierarchical_pages"] = get_option( 'ml_hierarchical_pages_enabled', false );
$return_config["show_favorites"]            = get_option( 'ml_menu_show_favorites', true );
$return_config["followimagelinks"]          = get_option( 'ml_followimagelinks', 1 );

$return_config['interface_images_updated'] = date( 'c', get_option( 'ml_preview_upload_image_time' ) );
$return_config['interface_images']         = array(
	'navigation_bar_logo' => get_option( "ml_preview_upload_image" )
);

$navigation_bar_text = '#000000';
if ( Mobiloud_App_Preview::get_color_brightness( get_option( 'ml_preview_theme_color' ) ) < 190 ) {
	$navigation_bar_text = '#FFFFFF';
}
$return_config['interface_colors'] = array(
	'navigation_bar_background'  => get_option( 'ml_preview_theme_color' ),
	'navigation_bar_text'        => $navigation_bar_text,
	'navigation_bar_button_text' => $navigation_bar_text
);
$return_config["image_cache_preload"] = get_option( 'ml_image_cache_preload', false );

$return_config['show_rating_prompt'] = get_option( 'ml_show_rating_prompt', false );
$return_config['days_interval_rating_prompt'] = get_option( 'ml_days_interval_rating_prompt', 1 );

$return_config['welcome_screen_url'] = get_option( 'ml_welcome_screen_url', '' );
$return_config['welcome_screen_required_version'] = get_option( 'ml_welcome_screen_required_version', '1.0' );

$return_config['rtl_text_enable'] = get_option( 'ml_rtl_text_enable', false );

$return_config['related_posts'] = get_option( 'ml_related_posts', false );
$return_config['related_header'] = get_option( 'ml_related_header', '' );
$return_config['related_image'] = get_option( 'ml_related_image', false );
$return_config['related_excerpt'] = get_option( 'ml_related_excerpt', false );
$return_config['related_date'] = get_option( 'ml_related_date', false );

$return_config['app_subscription_enabled'] = get_option( 'ml_app_subscription_enabled', false );
$return_config['app_subscription_ios_in_app_purchase_id'] = get_option( 'ml_app_subscription_ios_in_app_purchase_id', '' );
$return_config['app_subscription_android_in_app_purchase_id'] = get_option( 'ml_app_subscription_android_in_app_purchase_id', '' );
$return_config['app_subscriptions_subscribe_link_text'] = get_option( 'ml_app_subscriptions_subscribe_link_text', '' );
$return_config['app_subscriptions_manage_subscription_link_text'] = get_option( 'ml_app_subscriptions_manage_subscription_link_text', '' );
$return_config['app_subscription_logo'] = get_option( 'ml_app_subscription_logo', '' );
$return_config['app_subscription_background_color'] = get_option( 'ml_app_subscription_background_color', '' );
$return_config['app_subscription_title'] = get_option( 'ml_app_subscription_title', '' );
$return_config['app_subscription_description'] = get_option( 'ml_app_subscription_description', '' );
$return_config['app_subscription_call_to_action_color'] = get_option( 'ml_app_subscription_call_to_action_color', '' );
$return_config['app_subscription_btn_title'] = get_option( 'ml_app_subscription_btn_title', '' );
$return_config['app_subscription_btn_description'] = get_option( 'ml_app_subscription_btn_description', '' );
$return_config['app_subscription_trial_btn_title'] = get_option( 'ml_app_subscription_trial_btn_title', '' );
$return_config['app_subscription_trial_btn_description'] = get_option( 'ml_app_subscription_trial_btn_description', '' );
$return_config['app_subscription_btn_text_color'] = get_option( 'ml_app_subscription_btn_text_color', '' );
$return_config['app_subscription_btn_background_color'] = get_option( 'ml_app_subscription_btn_background_color', '' );
$return_config['app_subscription_small_description'] = get_option( 'ml_app_subscription_small_description', '' );
$return_config['app_subscription_small_description_color'] = get_option( 'ml_app_subscription_small_description_color', '' );
$return_config['app_subscription_close_btn_color'] = get_option( 'ml_app_subscription_close_btn_color', '' );

$return_config['ios_phone_banner_app_subscription_show'] = get_option( 'ml_ios_phone_banner_app_subscription_show', true );
$return_config['android_phone_banner_app_subscription_show'] = get_option( 'ml_android_phone_banner_app_subscription_show', true );
$return_config['ios_tablet_banner_app_subscription_show'] = get_option( 'ml_ios_tablet_banner_app_subscription_show', true );
$return_config['android_tablet_banner_app_subscription_show'] = get_option( 'ml_android_tablet_app_subscription_show', true );
$return_config['ios_interstitial_app_subscription_show'] = get_option( 'ml_ios_interstitial_app_subscription_show', true );
$return_config['android_interstitial_app_subscription_show'] = get_option( 'ml_android_interstitial_app_subscription_show', true );
$return_config['ios_native_ad_app_subscription_show'] = get_option( 'ml_ios_native_ad_app_subscription_show', true );
$return_config['android_native_ad_app_subscription_show'] = get_option( 'ml_android_native_ad_app_subscription_show', true );
$return_config['ios_native_ad_article_app_subscription_show'] = get_option( 'ml_ios_native_ad_article_app_subscription_show', true );
$return_config['android_native_ad_article_app_subscription_show'] = get_option( 'ml_android_native_ad_article_app_subscription_show', true );
$return_config['banner_above_content_app_subscription_show'] = get_option( 'ml_banner_above_content_app_subscription_show', true ) ? '1' : '';
$return_config['banner_above_title_app_subscription_show'] = get_option( 'ml_banner_above_title_app_subscription_show', true ) ? '1' : '';
$return_config['banner_below_content_app_subscription_show'] = get_option( 'ml_banner_below_content_app_subscription_show', true ) ? '1' : '';

if ( ! empty( $return_config ) ) {
	foreach ( $return_config as $key => $val ) {
		if ( $val === null ) {
			$return_config[ $key ] = '';
		}
	}
}

$json_string = json_encode( $return_config );
echo $json_string;
?>