<?php

$app->get('/', function() use ($app) {
	
	$fecha = $app->date->now();

	//$nombre = '1234';

	//echo $app->hash->create($nombre).'<br>';

	//var_dump($app->hash->check($nombre, '$2y$10$FA355E98cXTsKxW89DOyAexRMr0RKiCRZJDpRS5xY45sTEfMcEKr2')) .'<br>';

	$app->render('home.php', [
		'fecha' => $fecha
		]);

	echo "<pre>";
	print_r ($_SESSION);
	echo "</pre>";

})->name('home');