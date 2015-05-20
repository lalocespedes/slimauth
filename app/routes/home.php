<?php

$app->get('/', function() use ($app) {
	
	$fecha = $app->date->now();


	echo "<pre>";
	print_r ($_SESSION);
	echo "</pre>";

	//$nombre = '1234';

	//echo $app->hash->create($nombre).'<br>';

	//var_dump($app->hash->check($nombre, '$2y$10$FA355E98cXTsKxW89DOyAexRMr0RKiCRZJDpRS5xY45sTEfMcEKr2')) .'<br>';

	$app->render('home.php', [
		'fecha' => $fecha
		]);

})->name('home');