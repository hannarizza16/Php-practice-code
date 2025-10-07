<?php 

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createimmutable(__DIR__);
$dotenv->load();

echo 'hello world';
// var_dump(__DIR__);
phpinfo(); 

?>