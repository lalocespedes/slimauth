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

//Views
$view = $app->view();
$view->setTemplatesDirectory('../app/views');

//inicia auth
if(!isset($_SESSION['user'])) {
	$app->add(new \Auth());
}

require('routes.php');

$app->run();