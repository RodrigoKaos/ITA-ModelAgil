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
      
      $controllerName = 'Controllers\\' . $this->routes[$request->params[0]];
      if(class_exists($controllerName)) {
        $methodName = $request->method;
        $controller = new $controllerName();
        $controller->$methodName($request->params);
      }  
    } else { 
      $this->redirect('/404.php');
    }
  }
  
  public function redirect($path) {
    header("Location: $path");
  }
  
}