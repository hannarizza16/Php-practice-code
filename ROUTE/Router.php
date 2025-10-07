<?php
// class Router {

//     public function get($url, $message) {

//      // echo $_SERVER['REQUEST_URI'];
//        $requestUri =  $_SERVER['REQUEST_URI'];

//        if ($url === $requestUri) {
//           $message();
//        }
//      }
// }
// $route = new Router( );

// $route->get('/', function() {echo 'Hello World';});
// $route->get('/about' ,  function() {echo 'this is about';});



class Router {

     protected $requestMethod;
     protected $requestUri;
     protected $routes = [];

     public function __construct() {
          $this->requestMethod = $_SERVER['REQUEST_METHOD'];
          $this->requestUri = $_SERVER['REQUEST_URI'];
          // $this->requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


     
     }

     public function addRoute($method, $path, $callback) {
               $this->routes[] = [ 
               //associative array 'key' => 'value'
               'method' => $method,
               'path' => $path,
               'callback' => $callback
          ];
     }

     public function getRoutes() {

          return $this->routes;
     }
     
     public function get($uri, $callback) {
          $this->addRoute('GET', $uri, $callback);
               // $this->routes[] = [
               //           'method' => 'GET',
               //           'path' => $uri,
               //           'callback' => $callback
               // ];
     }

     public function post($uri, $callback) {
          $this->addRoute('POST' , $uri, $callback);
          // $this->routes[] = [ 
          //      //associative array 'key' => 'value'
          //      'method' => 'POST',
          //      'path' => $uri,
          //      'callback' => $callback
          // ];
     }

     protected function delete($uri, $callback) {
          $this->addRoute('DELETE', $uri, $callback);
          // $this->routes[] = [ 
          //      //associative array 'key' => 'value'
          //      'method' => 'DELETE',
          //      'path' => $uri,
          //      'callback' => $callback
          // ];
     }

     protected function matchRoute($path, $request) {
          $routeParts = explode('/', trim($path, '/'));
          $requestParts = explode('/', trim($request, '/'));

          if(count($routeParts) !== count($requestParts)) {
               return false ;
          } 
          // // else {
          // //     echo "matching";
          // // }

          $params = []; 
          for ($x=0; $x < count($routeParts); $x++) {
               $routePart = $routeParts[$x];
               $requestPart = $requestParts[$x];

          // if($routePart === $requestPart) {
          //     exit('true');
          // }

               if(strlen($routePart) > 2 && $routePart[0] === '{' && $routePart[strlen($routePart) - 1 ] === '}'){
                    // var_dump($routePart);
                    // exit('yehey');
                    $params[] = $requestPart;
               } elseif ($routePart !== $requestPart)
                    return false;

          }

          return $params;
     }

     public function exec() {

          foreach($this->routes as $route){
               // accessing the keys of array by using []
               // if($route['method'] === $this->requestMethod && $route['path'] === $this->requestUri) 
                    if($route['method'] === $this->requestMethod){

                    $params = $this->matchRoute ($route['path'], $this->requestUri);

                    if($params !== false) {
                         $cb = $route['callback'];

                         if(is_callable($cb)){
                              //if loop get its condition, return or cut the loop
                              return $route['callback'](...$params); 
                         } 
                         echo $route['callback']; 
                         return;
                    
                    }

          }
     }
          //if not error
          http_response_code(404);
          echo "404 PAGE NOT FOUND";
     }
} 

$router = new Router();

echo $_SERVER['REQUEST_URI'] . "<br>";
echo $_SERVER['REQUEST_METHOD'] . "<br>";


// new function for views

function view($path, $toVars = []) {

     $basePath = 'views';
     $replacedPath = str_replace('.', '/', $path);
     $viewPath = sprintf('%s/%s.php', $basePath, $replacedPath);

     //extracting associative array into variable
     extract($toVars);
     // require_once('views/cases/cases.php');
     require_once($viewPath);
     return;
}


$router->get('/users/{id}', function($x) {
     echo "Users #" . $x;
});
$router->get('/users', 'All Users');

$router->get('/string', 'string');

$router->get('/cases', function() {
     return view('cases.cases');
});
$router->get('/task', function() {
     return view('tasks.tasks');
});
$router->get('/bill', function() {
     return view('bill.bill');
});
$router->get('/list', function() {
     return view('list.list', [
          'title' => 'My grocery list',
          'groceryLists' => [

               ['list' => 'Milk fortified'],
               ['list' => 'native egg'],
               ['list' => 'unsalted butter']
          ]
          
     ]);
});


$router->get('/login', function() {
     return view('login.login');
});  

$router->post('/login', function() {
     echo "welcome to our page";
});


$router->exec();

?>