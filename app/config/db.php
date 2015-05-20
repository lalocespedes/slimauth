<?php

use Illuminate\Database\Capsule\Manager as Capsule;
/**
 * Configure the database and boot Eloquent
 */
$capsule = new Capsule;
$capsule->addConnection(array(
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'pqf',
    'username'  => 'root',
    'password'  => 'root',
    'charset'   => 'utf8',
    'collation' => 'utf8_general_ci',
    'prefix'    => ''
));
$capsule->setAsGlobal();
$capsule->bootEloquent();
// set timezone for timestamps etc
date_default_timezone_set('Mexico/General');