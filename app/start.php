<?php

require '../vendor/autoload.php';

$app = new \Slim\Slim();

session_cache_limiter(false);
session_start();

$app->config(array(
	'debug' => true,
	'mode'	=> 'development',
	'cookies.encrypt' => true,
	'cookies.lifetime' => '20 minutes',
	'cookies.path' => '/',
	'cookies.secret_key' => 'secret'
));

//db
require '../app/config/db.php';

//Views
$view = $app->view();
$view->setTemplatesDirectory('../app/views');

//Singletons
$app->container->singleton('date', function () {
	return new Carbon\Carbon;
});

$app->container->singleton('hash', function () {
	return new Hash;
});

//inicia auth
if(!isset($_SESSION['user'])) {
	$app->add(new \Auth());
}

//verificar roles

require('routes.php');

$app->run();