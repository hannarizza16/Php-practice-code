<?php

use Dotenv\Dotenv;
use Core\Connection;


require_once __DIR__ . '/../vendor/autoload.php';

// load env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

//connecting to dbase
require_once  '../Core/Database.php'; //loads dbcon


//start your router or app.
//initialize router from api.phhp
//execute the route
$router = require_once __DIR__ . '/../routes/api.php'; 


//execute router
$router->exec();

// we will be seperating our route since in the long run it will be overwhelming if
// it became a big project

