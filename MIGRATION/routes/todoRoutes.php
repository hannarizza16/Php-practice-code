<?php

// use Core\Router;
use App\Controllers\TodoController;


// define your routes 
// / -> is the endpoint
// the whole is the api route
// $router->get('/', );

//             uri  ,  callback
$router->get('/', [TodoController::class, 'getAll']);
$router->get('/todos', [TodoController::class, 'getAll']);

