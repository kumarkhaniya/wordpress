<?php

class Mobiloud {

	private static $option_key = 'ml_options';

	private static $initiated = false;

	public static function init() {
		if ( ! self::$initiated ) {
			self::init_hooks();
			self::set_default_options();
		}
	}

	/**
	* Initializes WordPress hooks
	*/
	private static function init_hooks() {
		self::$initiated = true;

		//add_filter('get_avatar', array('Mobiloud', 'get_avatar'),10,2);

		if ( get_option( 'ml_push_notification_enabled' ) ) {
			add_action( 'transition_post_status', 'ml_pb_post_published_notification', 10, 3 );
			//add_action('transition_post_status','ml_pb_post_published_notification');
			//add_action('publish_future_post','ml_pb_post_published_notification_future');
		}

		add_action( 'wp_head', array( 'Mobiloud', 'on_head' ) );

		add_action( 'comment_post', array( 'Mobiloud', 'my_comment_callback' ) );
		add_action( 'comment_edit', array( 'Mobiloud', 'my_comment_callback' ) );

		add_rewrite_rule( '^ml-api/v1/posts/?', 'index.php?__ml-api=posts', 'top' );
		add_rewrite_rule( '^ml-api/v1/config/?', 'index.php?__ml-api=config', 'top' );
		add_rewrite_rule( '^ml-api/v1/menu/?', 'index.php?__ml-api=menu', 'top' );
		add_rewrite_rule( '^ml-api/v1/login/?', 'index.php?__ml-api=login', 'top' );
		add_rewrite_rule( '^ml-api/v1/page/?', 'index.php?__ml-api=page', 'top' );
		add_rewrite_rule( '^ml-api/v1/post/?', 'index.php?__ml-api=post', 'top' );
		add_rewrite_rule( '^ml-api/v1/version/?', 'index.php?__ml-api=version', 'top' );
		add_rewrite_rule( '^ml-api/v1/comments/disqus/?', 'index.php?__ml-api=disqus', 'top' );
		add_rewrite_rule( '^ml-api/v1/comments/?', 'index.php?__ml-api=comments', 'top' );
		add_rewrite_rule( '^ml-api/v1/manifest/?', 'index.php?__ml-api=manifest', 'top' );
	}

	public static function my_comment_callback( $id ) {
		include_once MOBILOUD_PLUGIN_DIR . 'api/controllers/MLCacheController.php';
		$ml_cache = new MLCacheController();
		$ml_cache->flush_cache( 'ml_json' );
		$id   = get_comment( $id )->comment_post_ID;
		$ml_cache->flush_post_cache( $id );
	}

	public static function mobiloud_activate() {
		set_transient( 'ml_activation_redirect', 1, 60);

		self::set_default_options(true);
		self::run_db_install();
		self::set_default_values();

		add_rewrite_rule( '^ml-api/v1/posts/?', 'index.php?__ml-api=posts', 'top' );
		add_rewrite_rule( '^ml-api/v1/config/?', 'index.php?__ml-api=config', 'top' );
		add_rewrite_rule( '^ml-api/v1/menu/?', 'index.php?__ml-api=menu', 'top' );
		add_rewrite_rule( '^ml-api/v1/login/?', 'index.php?__ml-api=login', 'top' );
		add_rewrite_rule( '^ml-api/v1/page/?', 'index.php?__ml-api=page', 'top' );
		add_rewrite_rule( '^ml-api/v1/post/?', 'index.php?__ml-api=post', 'top' );
		add_rewrite_rule( '^ml-api/v1/version/?', 'index.php?__ml-api=version', 'top' );
		add_rewrite_rule( '^ml-api/v1/comments/disqus/?', 'index.php?__ml-api=disqus', 'top' );
		add_rewrite_rule( '^ml-api/v1/comments/?', 'index.php?__ml-api=comments', 'top' );
		add_rewrite_rule( '^ml-api/v1/manifest/?', 'index.php?__ml-api=manifest', 'top' );
		flush_rewrite_rules();
	}

	public static function set_default_options($force_update = false) {
		if ($force_update) {
			delete_option( 'ml_schedule_dismiss' );
		}
		if ($force_update || (Mobiloud::get_option('ml_version') != MOBILOUD_PLUGIN_VERSION)) {
			if ( Mobiloud::get_option( 'ml_article_list_include_post_types', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_article_list_include_post_types', 'post' );
			}
			if ( Mobiloud::get_option( 'ml_custom_featured_image', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_custom_featured_image', '' );
			}
			if ( Mobiloud::get_option( 'ml_menu_show_favorites', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_menu_show_favorites', true );
			}
			if ( Mobiloud::get_option( 'ml_show_android_cat_tabs', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_show_android_cat_tabs', true );
			}
			if ( Mobiloud::get_option( 'ml_article_list_enable_dates', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_article_list_enable_dates', true );
			}

			if ( Mobiloud::get_option( 'ml_original_size_featured_image', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_original_size_featured_image', true );
			}

			if ( Mobiloud::get_option( 'ml_show_article_featuredimage', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_show_article_featuredimage', true );
			}
			if ( Mobiloud::get_option( 'ml_post_author_enabled', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_post_author_enabled', true );
			}
			if ( Mobiloud::get_option( 'ml_page_author_enabled', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_page_author_enabled', false );
			}
			if ( Mobiloud::get_option( 'ml_followimagelinks', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_followimagelinks', 0 );
			}
			if ( Mobiloud::get_option( 'ml_post_date_enabled', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_post_date_enabled', true );
			}
			if ( Mobiloud::get_option( 'ml_page_date_enabled', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_page_date_enabled', false );
			}
			if ( Mobiloud::get_option( 'ml_post_title_enabled', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_post_title_enabled', true );
			}
			if ( Mobiloud::get_option( 'ml_page_title_enabled', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_page_title_enabled', true );
			}

			$lang = get_bloginfo( 'language' );
			if ( Mobiloud::get_option( 'ml_rtl_text_enable', 'none' ) == 'none' && ( is_rtl() || $lang == 'ar' || $lang == 'he-IL' ) ) {
				Mobiloud::set_option( 'ml_rtl_text_enable', true );
			}

			if ( Mobiloud::get_option( 'ml_internal_links', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_internal_links', true );
			}

			if ( Mobiloud::get_option( 'ml_article_list_view_type', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_article_list_view_type', 'compact' );
			}

			if ( Mobiloud::get_option( 'ml_datetype', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_datetype', 'prettydate' );
			}

			if ( Mobiloud::get_option( 'ml_dateformat', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_dateformat', 'F j, Y' );
			}

			if ( Mobiloud::get_option( 'ml_show_email_contact_link', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_show_email_contact_link', true );
			}
			if ( Mobiloud::get_option( 'ml_contact_link_email', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_contact_link_email', get_bloginfo( 'admin_email' ) );
			}
			if ( Mobiloud::get_option( 'ml_copyright_string', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_copyright_string', '&copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) );
			}
			if ( Mobiloud::get_option( 'ml_comments_system', 'none' ) == 'none' || Mobiloud::get_option( 'ml_comments_system', 'none' ) == '' ) {
				Mobiloud::set_option( 'ml_comments_system', 'wordpress' );
			}

			if ( Mobiloud::get_option( 'ml_related_header', 'none' ) == 'none' ) {
				add_option( 'ml_related_header', 'Related Posts' );
			}
			if ( Mobiloud::get_option( 'ml_related_image', 'none' ) == 'none' ) {
				Mobiloud::set_option( 'ml_related_image', true );
			}
			// value "1" removed from list
			if ( 1 == Mobiloud::get_option( 'ml_ios_native_ad_interval' )) {
				Mobiloud::set_option( 'ml_ios_native_ad_interval', 2 );
			}
			if ( 1 == Mobiloud::get_option( 'ml_android_native_ad_interval' )) {
				Mobiloud::set_option( 'ml_android_native_ad_interval', 2 );
			}
			Mobiloud::set_option( 'ml_version', MOBILOUD_PLUGIN_VERSION);
		}
	}

	/**
	* Pre-fill menu pages, categories, links from "primary" or just a first existing menu
	*/
	private static function configure_items_from_menu() {
		// find main location
		$location_name = false;
		$locations = get_registered_nav_menus();
		if (!empty($locations)) {
			if (isset($locations[ 'primary' ])) {
				$location_name = 'primary';
			} else {
				foreach ($locations as $key => $value) {
					if (false !== strpos($key, 'main' )) {
						$location_name = $key;
						break;
					}
				}
			}
		}
		$theme_locations = get_nav_menu_locations();
		$menu = false;

		// find menu
		if (!empty($theme_locations) && !empty( $theme_locations[ $location_name ])) {
			$menu = wp_get_nav_menu_object( $theme_locations[ $location_name ] );
		}

		if(empty($menu)) {
			return 0;
		};
		// get menu items
		$items = wp_get_nav_menu_items($menu->term_id, array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order',
			'output'     => ARRAY_A,
			'output_key' => 'menu_order',
		));

		// get pages, categories, links
		$pages = array();
		$cats = array();
		$menu_links = array();

		if (!empty($items) && is_array($items)) {
			foreach ($items as $item) {
				if ( 'page' == $item->object ) {
					$pages[] = $item->object_id;
				} elseif ( 'category' == $item->object ) {
					$cats[] = $item->object_id;
				} elseif ( 'custom' == $item->object && !empty($item->url)) {
					$menu_links[] = array( 'urlTitle' => $item->title, 'url' => $item->url);
				}
			}
		}

		if (!empty($pages)) {
			include_once MOBILOUD_PLUGIN_DIR . 'pages.php';
			ml_remove_all_pages();
			foreach ( $pages as $page_id ) {
				ml_add_page( $page_id );
			}
		}

		if (!empty($menu_links)) {
			Mobiloud::set_option( 'ml_menu_urls', $menu_links );
		}
		if (!empty($cats)) {
			include_once MOBILOUD_PLUGIN_DIR . 'categories.php';
			ml_remove_all_categories();
			foreach ( $cats as $cat_id ) {
				ml_add_category( $cat_id );
			}
		} elseif (count($pages) + count($menu_links) > 0) {
			// if no categories found, but pages or links found
			include_once MOBILOUD_PLUGIN_DIR . 'categories.php';
			// prefill menu config with top 5 categories by count of posts
			$cats = get_categories(array('orderby' => 'count', 'order' => 'DESC', 'number' => 5, 'hide_empty' => 1));
			foreach ($cats as $cat) {
				ml_add_category($cat->cat_ID);
				$cats[] = $cat->cat_ID;
			}
		}

		return count($pages) + count($cats) + count($menu_links);
	}

	/**
	* Pre-fill configuration
	*
	*/
	private static function set_default_values() {
		$default_timeout = ini_get('default_socket_timeout');
		ini_set('default_socket_timeout', 5); // wait 5 sec

		include_once MOBILOUD_PLUGIN_DIR . "/categories.php";
		include_once MOBILOUD_PLUGIN_DIR . "/pages.php";

		$current_cat = ml_categories();
		$menu_links = Mobiloud::get_option( 'ml_menu_urls' );
		$menu_tags = Mobiloud::get_option( 'ml_menu_tags' );
		if (empty($current_cat) && empty($menu_links) && empty($menu_tags) && !count(ml_pages())) {
			if (!self::configure_items_from_menu()) {

				// Prefill menu config with top 5 categories by count of posts
				$cats = get_categories(array('orderby' => 'count', 'order' => 'DESC', 'number' => 5, 'hide_empty' => 1));
				foreach ($cats as $cat) {
					ml_add_category($cat->cat_ID);
				}

				// Prefill menu config with a page with name about*
				global $wpdb;
				$sql = $wpdb->prepare( "
					SELECT ID
					FROM $wpdb->posts
					WHERE post_title LIKE %s
					AND post_type = 'page'
					AND post_status = 'publish'
					ORDER BY post_date ASC
					LIMIT 1", 'about%' ); // only published pages (not posts)
				$pages = $wpdb->get_col( $sql );
				if (is_array($pages) && count($pages)) {
					foreach ($pages as $id) {
						ml_add_page($id);
					}
				}
			}
		}

		// Configure logo image
		$logo_url = get_option( 'ml_preview_upload_image' );
		if (empty($logo_url)) {
			if (function_exists( 'gridlove_get_option' )) {
				$logo_url = gridlove_get_option( 'logo_retina' );
				if (empty($logo_url)) {
					$logo_url = gridlove_get_option( 'logo' );
				}
				Mobiloud::set_option( "ml_preview_upload_image", $logo_url);
			}
		}
		if (empty($logo_url)) {
			if (function_exists( 'get_site_icon_url' )) {
				$logo_url = get_site_icon_url(192);
			} else {
				$site_icon_id = get_option( 'site_icon' );
				if ( $site_icon_id ) {
					$size_data = array( 192, 192 );
					$logo_url = wp_get_attachment_image_url( $site_icon_id, $size_data );
				}
			}
			if (!empty($logo_url) && filter_var($logo_url, FILTER_VALIDATE_URL) !== false) {
				Mobiloud::set_option( "ml_preview_upload_image", $logo_url);
			}
		}
		if (empty($logo_url)) {
			$logo_url = get_site_icon_url(128); // set desired width of the logo image to 128px
			if (empty($logo_url)) { // or use external API to retrieve the logo
				$logo_url = "http://logo.clearbit.com/" . urlencode(parse_url(get_site_url(), PHP_URL_HOST));
				$data = wp_remote_get($logo_url); // check
				if (empty($data) || is_wp_error($data) || false !== strpos($data[ 'body' ], '<html>' )) { // image not found
					$logo_url = '';
				}
			}
			if (!empty($logo_url) && filter_var($logo_url, FILTER_VALIDATE_URL) !== false) {
				Mobiloud::set_option( "ml_preview_upload_image", $logo_url);
			}
		}

		// Configure bar background color
		$color = get_option('ml_preview_theme_color');
		if (empty($color) || ( '#1e73be' == $color)) { // did not set or has default value (class.mobiloud-admin.php: function menu_get_started())

			if (function_exists( 'gridlove_get_option' )) {
				$color = gridlove_get_option( 'color_header_main_bg' );
			}

			if (empty($color)) {
				$color = get_theme_mod( 'header_background_color', '' );
			}
			if (empty($color) && function_exists( 'get_background_color' )) {
				$color = get_background_color();
			}
			if (empty($color)) {
				$url = 'https://www.colorfyit.com/api/swatches/list.json?url=' . urlencode(get_site_url());
				$data = wp_remote_get($url, array( 'sslverify' => false ));
				if (!is_wp_error($data)) {
					$json_data = json_decode($data['body'], true);
					if (is_array($json_data) && isset($json_data['colors']) && is_array($json_data['colors'])) {
						$color = ''; // Ex: {"colors":[{"Hex":"#003388","Rgb":{"r":0,"g":51,"b":136}...
						foreach ($json_data['colors'] as $item) {
							if (!empty($item['Hex']) && is_string($item['Hex'])) {
								$color = $item['Hex'];
							}
						}
					}
				}
			}
			if (!empty($color)) {
				Mobiloud::set_option("ml_preview_theme_color", sanitize_text_field(false === strpos($color, '#') ? '#' . $color : $color));
			}
		}
		ini_set('default_socket_timeout', $default_timeout); // restore
	}

	public static function run_db_update_notifications() {
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$table_name = $wpdb->prefix . "mobiloud_notifications";

		//check if there is the column 'url'
		$results = $wpdb->get_results( "SHOW FULL COLUMNS FROM `" . $table_name . "` LIKE 'url'", ARRAY_A );
		if ( $results == null || count( $results ) == 0 ) {
			//update the table
			$sql = "ALTER TABLE `" . $table_name . "` ADD `url` VARCHAR(255) NULL DEFAULT NULL AFTER `post_id`";
			$wpdb->query( $sql );
		}
	}

	private static function run_db_install() {
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$table_name = $wpdb->prefix . "mobiloud_notifications";
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
			$sql = "CREATE TABLE " . $table_name . " (
			id bigint(11) NOT NULL AUTO_INCREMENT,
			time bigint(11) DEFAULT '0' NOT NULL,
			post_id bigint(11),
			msg blob,
			android varchar(1) NOT NULL,
			ios varchar(1) NOT NULL,
			tags blob,
			UNIQUE KEY id (id)
			);";

			dbDelta( $sql );
		}

		self::run_db_update_notifications();

		$table_name = $wpdb->prefix . "mobiloud_notification_categories";

		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
			$sql = "CREATE TABLE " . $table_name . " (
			id bigint(11) NOT NULL AUTO_INCREMENT,
			cat_ID bigint(11) NOT NULL,
			UNIQUE KEY id (id)
			);";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}

		$table_name = $wpdb->prefix . "mobiloud_categories";

		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
			//install della tabella
			$sql = "CREATE TABLE " . $table_name . " (
			id bigint(11) NOT NULL AUTO_INCREMENT,
			time bigint(11) DEFAULT '0' NOT NULL,
			cat_ID bigint(11) NOT NULL,
			UNIQUE KEY id (id)
			);";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}

		$table_name = $wpdb->prefix . "mobiloud_pages";

		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
			//install della tabella
			$sql = "CREATE TABLE " . $table_name . " (
			id bigint(11) NOT NULL AUTO_INCREMENT,
			time bigint(11) DEFAULT '0' NOT NULL,
			page_ID bigint(11) NOT NULL,
			UNIQUE KEY id (id)
			);";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}

		//check if there is the column 'ml_render'
		$results = $wpdb->get_results( "SHOW FULL COLUMNS FROM `" . $table_name . "` LIKE 'ml_render'", ARRAY_A );
		if ( $results == null || count( $results ) == 0 ) {
			//update the table
			$sql = "ALTER TABLE $table_name ADD ml_render TINYINT(1) NOT NULL DEFAULT 1;";
			$wpdb->query( $sql );
		}
	}

	public static function set_generic_option( $name, $value ) {
		if ( ! update_option( $name, $value ) ) {
			add_option( $name, $value );
		}
	}

	public static function get_avatar( $avatar, $comment ) {
		$id_or_email = $comment->comment_author_email != null ? $comment->comment_author_email : $comment->user_id;

		return $avatar;
	}

	/**
	* Get ML option value
	*
	* @param string $name
	* @param mixed $default
	*
	* @return mixed
	*/
	public static function get_option( $name, $default = null ) {
		/*$options = get_option(self::$option_key, array());

		if(isset($options[$name])) {
		return $options[$name];
		} else {
		return $default;
		}*/
		return get_option( $name, $default );
	}

	/**
	* Set ML option value
	*
	* @param string $name
	* @param mixed $value
	*
	* @return boolean
	*/
	public static function set_option( $name, $value ) {
		/*$options = get_option(self::$option_key, array());
		$options[$name] = $value;
		return update_option(self::$option_key, $options);*/
		return update_option( $name, $value );
	}

	public static function trim_string( $string, $length = 30 ) {
		if ( strlen( $string ) <= $length ) {
			return $string;
		} else {
			return substr( $string, 0, $length ) . '...';
		}
	}

	public static function get_plugin_url() {
		return MOBILOUD_PLUGIN_URL;
	}

	private static function is_mobiloud_app() {
		$ua = isset($_SERVER[ 'HTTP_USER_AGENT' ]) ? $_SERVER[ 'HTTP_USER_AGENT' ] : '';
		$req_app = isset($_SERVER[ 'HTTP_X_REQUESTED_WITH' ]) ? $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] : '';
		$android_app_name = stripslashes(  Mobiloud::get_option( 'ml_embedded_android_name', '' ) );
		return false !== stripos($ua, 'mobiloud' ) || (!empty($android_app_name)) && ( $android_app_name == $req_app);
	}

	/**
	* Add custom CSS for embedded pages
	*
	*/
	public static function on_head() {
		if (self::is_mobiloud_app()) {
			$css = array();
			if (self::get_option( 'ml_embedded_header_hide' )) {
				$css[] = "header.site-header, header.app-header, #header, #main-header {display:none !important;}";
			}
			if (self::get_option('ml_embedded_footer_hide')) {
				$css[] = "footer.site-footer, #footer, #main-footer {display:none !important;}";
			}
			$custom_css = stripslashes(self::get_option( 'ml_embedded_page_css', '' ));
			if (!empty($custom_css)) {
				$css[] = $custom_css;
			}
			if (!empty($css)) {
?>
				<style type="text/css" media="screen"><?php echo implode( "\n", $css); ?></style><?php
			}
		}
	}
}