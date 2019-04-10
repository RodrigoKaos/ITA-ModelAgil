<?php

namespace Core;

use Network\Router;

// use Controllers\Home;

class App {
  

  private static $routes = array(
    '/' => 'Home',
    '/login' => 'Login'
  );

  public static function start() {
    Router::set(self::$routes);

    Router::get($_GET['url'], '',function($arg){
      // $get = $_GET['url'];
      $controller = "\\Controllers\\" . self::$routes[$_GET['url']];
      // echo $controller;
      $controller::createView();
    });

  }
 
}





// public static function start() {
//   Router::set(self::$routes);
  
//   Router::get('/login', 'login',function($args){        
//     Login::get($args);
//   });

//   Router::get('/', 'home',function($args){
//     Home::get($args);
//   });

// }

// private function isLogged(){
//   return isset($_SESSION['UID']);
// }