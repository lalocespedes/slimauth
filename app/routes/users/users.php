<?php

$app->get('/users', function() use ($app) {
	
	echo "<pre>";
	print_r (User::all()->toArray());
	echo "</pre>";

});	