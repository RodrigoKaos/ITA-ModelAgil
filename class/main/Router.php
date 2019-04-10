<?php 

namespace Main;

class Router {

  private static $routes;

  public static function set($routes) {
    self::$routes = $routes;
  }

  public static function add($route, $callback){
    self::$routes[$route] = $callback;
  }

  public static function get($path, $args, $callback) {
    // var_dump(self::$routes);
    if(
      $_SERVER['REQUEST_METHOD'] == 'GET' 
      && array_key_exists($path, self::$routes)
    ){
      $callback->__invoke($args);
      // call_user_func_array
    }
  }

  public static function post($path, $callback) {
    var_dump($_SERVER['REQUEST_METHOD']);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      var_dump($path);
    }
  }

}