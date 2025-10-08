<?php

use Core\Router;
// initialize class router
$router = new Router();

// load all rooutes
require_once __DIR__ . "/todoRoutes.php";
// 2nd route
//3rd route


return $router;