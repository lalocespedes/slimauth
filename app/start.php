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

$headers = apache_request_headers();
//inicia auth
$app->add(new \Auth());

//verificar roles
function authorize($role = "user") {
    return function () use ( $role ) {
        // Get the Slim framework object
        $app = \Slim\Slim::getInstance();
        // First, check to see if the user is logged in at all
        if(!empty($_SESSION['user'])) {
            // Next, validate the role to make sure they can access the route
            // We will assume admin role can access everything
            if($_SESSION['user']['role'] == $role || $_SESSION['user']['role'] == 'admin') {
                //User is logged in and has the correct permissions... Nice!
                return true;
            }
            else {
                // If a user is logged in, but doesn't have permissions, return 403
                $app->halt(403, 'Acceso denegado!');
            }
        }
        else {
            // If a user is not logged in at all, return a 401
            $app->halt(401, 'You shall not pass!');
        }
    };
}

require('routes.php');

$app->run();