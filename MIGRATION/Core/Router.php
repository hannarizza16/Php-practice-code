<?php

namespace Core;

class Router
{
	protected $requestMethod;
	protected $requestUri;
	protected $routes = [];

    // first to run
	public function __construct()
	{
		$this->requestMethod = $_SERVER['REQUEST_METHOD'];
		$this->requestUri = $_SERVER['REQUEST_URI'];
	}

	public function getRoutes()
	{
		return $this->routes;
	}

	public function get($uri, $callback)
	{
		$this->addRoute('GET', $uri, $callback);
	}

	public function put($uri, $callback)
	{
		$this->addRoute('PUT', $uri, $callback);
	}

	public function patch($uri, $callback)
	{
		$this->addRoute('PATCH', $uri, $callback);
	}

	public function delete($uri, $callback)
	{
		$this->addRoute('DELETE', $uri, $callback);
	}

	public function post($uri, $callback)
	{
		$this->addRoute('POST', $uri, $callback);
	}

	protected function addRoute($method, $path, $callback)
	{
		$this->routes[] = [
			'method' => $method,
			'path' => $path,
			'callback' => $callback,
		];
	}

	protected function matchRoute($path, $request)
	{
		$routeParts = explode('/', trim($path, '/'));
		$requestParts = explode('/', trim($request, '/'));

		// 1. Match by count
		// fail-fast logic
		if (count($routeParts) !== count($requestParts)) {
			return false;
		}
        // echo "Matching route: $path with request: $request\n";

		// 2. Compare each segment, to make sure that each parts matches
		$params = [];
		for ($x = 0; $x < count($routeParts); $x++) {
			$routePart = $routeParts[$x];
			$requestPart = $requestParts[$x];

			// Check if the string starts with { and ends with }
			if (strlen($routePart) > 2 && $routePart[0] === '{' && $routePart[strlen($routePart) - 1] === '}') {
				$params[] = $requestPart;
			} elseif ($routePart !== $requestPart) {
				return false;
			}
		}


		return $params;
	}

	public function exec()
	{
    // echo "<pre>";
    // echo "=== Router Debug ===\n";
    // echo "Request Method: " . $this->requestMethod . "\n";
    // echo "Request URI: " . $this->requestUri . "\n";
    // echo "Registered Routes:\n";
    // var_dump($this->routes);
    // echo "====================\n";
		foreach ($this->routes as $route) {
			if ($route['method'] === $this->requestMethod) {
				$params = $this->matchRoute($route['path'], $this->requestUri);

				if ($params !== false) {
					// If the user passed an array, ensure that the array passed only contains  
					// tuples, and ensure that the class exists and the method exists
					if (is_array($route['callback'])) {
						if (count($route['callback']) !== 2) {
							$this->abort(404);
						}

						[$className, $fnName] = $route['callback'];

						if (!class_exists($className)) {
                            echo "Class $className does not exist.";
                            $this->abort(404);
                        }
							$cls = new $className; 

							if (!method_exists($cls, $fnName)) {
                                echo "Method $fnName not found in $className.";
								$this->abort(404);
							}

                            $result = $cls->$fnName();
                            if ($result !== null){
                                echo $result;
                            }
                            return;
							// return $cls->$fnName();
					}
                    
					if (is_callable($route['callback'])) {
						return $route['callback'](...$params);
					}

					if (class_exists($route['callback'])) {
						$cls = new $route['callback'];

						if (!method_exists($cls, 'invoke')) {
							$this->abort(404);
						}
						return $cls->invoke();
					}

					echo $route['callback'];
					return;
				}
			}
            
		}
        $this->abort(404);
	}

	protected function abort($httpCode = 404)
	{
		http_response_code(404);
		echo "404 - Page not found";
		exit;
	}
}