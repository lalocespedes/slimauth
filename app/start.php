<?php

require '../vendor/autoload.php';

$app = new \Slim\Slim();

//Views
$view = $app->view();
$view->setTemplatesDirectory('../app/views');

require('routes.php');

$app->run();