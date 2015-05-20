<?php

$app->get('/users', authorize('admin'), function() use ($app) {
	
	echo "<pre>";
	print_r (User::all()->toArray());
	echo "</pre>";

});