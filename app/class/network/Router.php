<?php 

namespace Network;

class Router {

  private static $routes;

  public static function set($routes) {
    self::$routes = $routes;
  }

  public static function add($route, $callback) {
    self::$routes[$route] = $callback;
  }

  public static function on($request) {
    if(array_key_exists($request->params[0], self::$routes)){
      //verify class exists
      $controller = self::$routes[$request->params[0]];
      if(class_exists($controller)){
        $method = $request->method;
        $controller::$method($request->params);
      }
  
    } else { 
      self::redirect('/404.php');
    }
  }
  
  private function redirect($path) {
    header("Location: $path");
  }
  
}