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
      $controller = self::$routes[$request->params[0]];
      $method = $request->method;
      $controller::$method($request->params);
  
    } else { 
      self::redirect('/404');
    }
  }
  
  private function redirect($path) {
    header("Location: $path");
  }
  
}