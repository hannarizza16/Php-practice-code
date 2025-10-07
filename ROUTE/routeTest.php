<?php

$request = '/users/1';
$routeParam = 'users/{id}';

$routeParts = explode('/', trim($routeParam, '/'));
$requestParts = explode('/', trim($request, '/'));

// if(count($routeParts) !== count($routeParts)) {
//     exit("not match");
// } else {
//     echo "matching";
// }

$params = []; 
for ($x=0; $x < count($routeParts); $x++) {
    $routePart = $routeParts[$x];
    $requestPart = $requestParts[$x];

    // if($routePart === $requestPart) {
    //     exit('true');
    // }

    if($routePart[0] === '{' && $routePart[strlen($routePart) - 1 ] === '}'){
        // var_dump($routePart);
        // exit('yehey');
        $params[] = $requestPart;
    } 

}

return $params;

