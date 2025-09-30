<?php 

spl_autoload_register('myAutoloader');

function myAutoloader($className) {
    //__DIR__ is a magic constant that returns the directory of the current file

    

    $path = __DIR__ . '/' . $className . '.php';

    if (file_exists($path)) {
        include_once $path;
    } else {
        echo "The file $path does not exist.";
    }
}


?>