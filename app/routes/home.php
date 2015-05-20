<?php

$app->get('/', function() use ($app) {
	
	$fecha = $app->date->now();

	$app->render('home.php', [
		'fecha' => $fecha
		]);

	echo "<pre>";
	print_r (User::all()->toArray());
	echo "</pre>";;

})->name('home');