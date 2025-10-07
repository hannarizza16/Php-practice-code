<?php

//imports 
use App\Controllers\IndexController;
use Core\Router;

$router = new Router();

// $router->get('/', function () {
// 	echo 'hhellloo world';
// });
//
// $router->get('/', [IndexController::class, 'index']);
// $router->method('path', class , 'function')
$router->get('/testing', [IndexController::class, 'index']);

$router->get('/test', function () {
	echo 'test';
});

$router->exec();