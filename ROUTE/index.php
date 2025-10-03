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

      public function delete($uri, $callback) {
          $this->addRoute('DELETE', $uri, $callback);
          // $this->routes[] = [ 
          //      //associative array 'key' => 'value'
          //      'method' => 'DELETE',
          //      'path' => $uri,
          //      'callback' => $callback
          // ];
     }

     public function addRoute($method, $path, $callback) {
               $this->routes[] = [ 
               //associative array 'key' => 'value'
               'method' => $method,
               'path' => $path,
               'callback' => $callback
          ];
     }

     public function exec() {
          foreach($this->routes as $route){
               // accessing the keys of array by using []
               if($route['method'] === $this->requestMethod && $route['path'] === $this->requestUri)
               {
                    //if loop get its condition, return or cut the loop
                    return $route['callback']();
               }
          }
          //if not error
          http_response_code(404);
          echo "404 PAGE NOT FOUND";
     }
} 

$router = new Router();

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