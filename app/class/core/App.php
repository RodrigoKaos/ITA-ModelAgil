<?php

namespace Core;

use Network\Router;
use Network\Request;

class App {  

  private static $routes = array(
    '/' => 'Controller\Home',
    '/home' => 'Controller\Home',
    '/login' => 'Controller\Login',
    '/book' => 'Controller\Book',
    '/profile' => 'Controller\Profile',
    '/ranking' => 'Controller\Ranking',
    '/logout' => 'Controller\Logout',
  );

  public static function init() {
    Router::set(self::$routes);
    Router::on(new Request($_SERVER));
  }
 
}