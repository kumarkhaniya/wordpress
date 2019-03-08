<?php

include( "../../../wp-load.php" );

$debug = false;

header('Content-type: application/json');
$response = '{}';
if (class_exists( 'MLApiController' )) {
	$api = new MLApiController();
	$api->set_error_handlers( $debug );

	$response = $api->handle_request();
}

echo $response;
?>