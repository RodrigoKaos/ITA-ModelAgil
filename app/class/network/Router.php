<?php 

namespace Network;

class Router {

  private $routes;

  public function set($routes) {
    $this->routes = $routes;
  }

  public function add($route, $callback) {
    $this->routes[$route] = $callback;
  }

  public function on($request) {
    if(array_key_exists($request->params[0], $this->routes)){

      $controller = 'Controller\\' . $this->routes[$request->params[0]];
      if(class_exists($controller)) {
        $method = $request->method;
        $controller::$method($request->params);
      }
  
    } else { 
      $this->redirect('/404.php');
    }
  }
  
  public function redirect($path) {
    header("Location: $path");
  }
  
}