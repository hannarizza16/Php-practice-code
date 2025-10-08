<?php

use Dotenv\Dotenv;
// use App\Controllers\TodoController;

require_once __DIR__ . '/../vendor/autoload.php';

//debug
// echo "Router file loaded!<br>";
// var_dump(class_exists('TodoController')); // should now return true
// exit;

// if (class_exists(TodoController::class)) {
//     echo "TodoController FOUND!<br>";
// } else {
//     echo "TodoController NOT FOUND!<br>";
// }

// load env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

//start your router or app.
//initialize router from api.phhp
//execute the route
$router = require_once __DIR__ . '/../routes/api.php'; 


//execute router
$router->exec();

// we will be seperating our route since in the long run it will be overwhelming if
// it became a big project

