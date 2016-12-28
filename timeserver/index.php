<?php
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', ltrim($_SERVER['REQUEST_URI'], '/'));
$input = json_decode(file_get_contents('php://input'),true);

//var_dump($request);
if(empty($request[0])) {
	header('HTTP/1.1 404 Not Found');
	Show404Error();
} else switch(array_shift($request)) {
	case 'getTime':
		getTime($request);
		break;
	case 'getTimeZone':
		getTimeZone($request);
		break;
	case 'getTimeOffset':
		getTimeOffset($request);
		break;
	case 'getTimeRaw':
		getTimeRaw($request);
		break;
	default:
		header('HTTP/1.1 404 Not Found');
		Show404Error();
}

function Show404Error() {
	echo 'Bad request';
}

function getTime($args) {
	$tz = implode('/', $args);
	date_default_timezone_set($tz);
	echo date('Y,m,d,H,i,s', time());
}

function getTimeZone($args) {
	$tz = implode('/', $args);
	date_default_timezone_set($tz);
	echo date('T');
}

function getTimeOffset($args) {
	$tz = implode('/', $args);
	date_default_timezone_set($tz);
	echo 'GMT'.date('O');
}

function getTimeRaw($args) {
	$tz = implode('/', $args);
	date_default_timezone_set($tz);
	echo date('r');
}
