<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class MLAPI {

	/**
	* Add public query vars
	* @return array $vars
	*/
	public static function add_query_vars( $vars ) {
		$vars[] = '__ml-api';

		return $vars;
	}

	/**
	* Add Endpoint
	* @return void
	*/
	public static function add_endpoint() {
		add_rewrite_rule( '^ml-api/v1/posts/?', 'index.php?__ml-api=posts', 'top' );
		add_rewrite_rule( '^ml-api/v1/config/?', 'index.php?__ml-api=config', 'top' );
		add_rewrite_rule( '^ml-api/v1/menu/?', 'index.php?__ml-api=manu', 'top' );
		add_rewrite_rule( '^ml-api/v1/page/?', 'index.php?__ml-api=page', 'top' );
		add_rewrite_rule( '^ml-api/v1/post/?', 'index.php?__ml-api=post', 'top' );
		add_rewrite_rule( '^ml-api/v1/version/?', 'index.php?__ml-api=version', 'top' );
		add_rewrite_rule( '^ml-api/v1/comments/disqus/?', 'index.php?__ml-api=disqus', 'top' );
		add_rewrite_rule( '^ml-api/v1/comments/?', 'index.php?__ml-api=comments', 'top' );
		add_rewrite_rule( '^ml-api/v1/manifest/?', 'index.php?__ml-api=manifest', 'top' );
	}

	/**
	* Check Requests
	*/
	public static function check_requests() {
		global $wp;
		$api_endpoint_isset = isset( $wp->query_vars['__ml-api'] );

		if ( $api_endpoint_isset ) {
			MLAPI::disable_new_relic();
			$api_endpoint_url = $wp->query_vars['__ml-api'];
			MLAPI::request( $api_endpoint_url );
			exit;
		}
	}

	/**
	* Handle Requests
	* @return void
	*/
	protected static function request( $api_endpoint ) {
		switch ( $api_endpoint ) {
			case 'config':
				self::php_notices();
				self::add_headers(false);
				include_once MOBILOUD_PLUGIN_DIR . 'config.php';
				break;
			case 'menu':
				self::php_notices();
				self::add_headers(false);
				include_once MOBILOUD_PLUGIN_DIR . 'get_categories.php';
				break;
			case 'comments':
				include_once MOBILOUD_PLUGIN_DIR . 'comments.php';
				break;
			case 'disqus':
				include_once MOBILOUD_PLUGIN_DIR . '/comments/disqus.php';
				break;
			case 'page':
				include_once MOBILOUD_PLUGIN_DIR . 'get_page.php';
				break;
			case 'post':
				include_once MOBILOUD_PLUGIN_DIR . 'post/post.php';
				break;
			case 'version':
				self::php_notices();
				self::add_headers(false);
				include_once MOBILOUD_PLUGIN_DIR . 'version.php';
				break;
			case 'login':
				self::php_notices();
				include_once MOBILOUD_PLUGIN_DIR . '/subscriptions/login.php';
				self::add_headers();
				break;
			case 'posts':
				include_once MOBILOUD_PLUGIN_DIR . '/api/controllers/MLApiController.php';
				$debug = false;

				$api = new MLApiController();
				$api->set_error_handlers( $debug );
				self::php_notices();
				self::add_headers();

				$response = $api->handle_request();
				$api->send_response( $response );

				break;
			default:
				echo 'Mobiloud API v1.';
		}

	}

	private static function disable_new_relic() {
		if ( extension_loaded( 'newrelic' ) && function_exists( 'newrelic_disable_autorum' ) ) {
			newrelic_disable_autorum();
		}
	}

	private static function add_headers( $is_private = true, $is_json = true ) {
		if ($is_json) {
			header( 'Content-Type: application/json' );
		}
		$time = absint(Mobiloud::get_option( 'ml_cache_expiration', 30)) * 60;
		header( "Cache-Control: " . ($is_private ? 'private' : 'public' ) . ", max-age=$time, s-max-age=$time", true );
	}

	private static function php_notices() {
		if (get_option( 'ml_disable_notices', true )) {
			$level = error_reporting();
			error_reporting($level & ~E_NOTICE & ~E_WARNING & ( defined( 'E_STRICT' ) ? ~E_STRICT : 1) & ( defined( 'E_DEPRECATED' ) ? ~E_DEPRECATED : 1));
		}
	}
}